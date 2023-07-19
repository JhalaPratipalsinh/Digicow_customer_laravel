<?php
namespace App\Repositories\Repository;

use App\Models\MilkProduction;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MilkProductionRepositort implements MilkProductionRepositortInterface
{
    public function createOrUpdate(array $data, string $id = null) : MilkProduction
    {
        if (!isset($id)) {
            $milk_production = new MilkProduction($data);
        } else {
            $milk_production = MilkProduction::find($id);

            foreach ($data as $key => $value) {
                $milk_production->$key = $value;
            }
        }
        $milk_production->save();
        return $milk_production;
    }

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $milk_production = MilkProduction::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $milk_production->where('id', '=', $filter['id']);
            }
            if (isset($filter['cow_id'])) {
                $milk_production->where('cow_id', '=', $filter['cow_id']);
            }
            if (isset($filter['cow'])) {
                $milk_production->where('cow', '=', $filter['cow']);
            }
            if (isset($filter['milking_date'])) {
                $milk_production->where('milking_date', '=', $filter['milking_date']);
            }
            if (isset($filter['milk_time_id'])) {
                $milk_production->where('milk_time_id', '=', $filter['milk_time_id']);
            }
            if (isset($filter['mobile_number'])) {
                $milk_production->where('mobile_number', '=', $filter['mobile_number']);
            }
        }

        $milk_production->where('deleted_at', '=', NULL);
        $clone_dead_cow = clone $milk_production;
        $totalRecords = $clone_dead_cow->count();

        if ($rawperpage) {
            $milk_production->take($rawperpage)->skip($start);
        }

        $result = $milk_production->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getAllMilkProductionReport(array $filter = []): array
    {
        // $milk_production = MilkProduction::select(DB::raw('GROUP_CONCAT(milk_quantity) AS milk','cow_id'))->where('id', '<>', null);
        $milk_production = MilkProduction::select(DB::raw("GROUP_CONCAT(milk_quantity SEPARATOR',') AS milk, GROUP_CONCAT(milk_time_id SEPARATOR',') AS time, milking_date"))->where('id', '<>', null);


        if ($filter) {
            if (isset($filter['mobile_number'])) {
                $milk_production->where('mobile_number', '=', $filter['mobile_number']);
            }
            if (isset($filter['cow_id'])) {
                $milk_production->where('cow_id', '=', $filter['cow_id']);
            }

            if (isset($filter['from_date']) || isset($filter['to_date'])) {
                $milk_production->whereBetween('milking_date', [$filter['from_date'], $filter['to_date']]);
            }

            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $milk_production->whereDate('created_at', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $milk_production->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                if ($filter['datetype'] == 'month') {
                    $milk_production->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                }
                if ($filter['datetype'] == 'year') {
                    $milk_production->whereYear('created_at',  Carbon::now()->year);
                }
            }
        }

        $milk_production->where('deleted_at', '=', NULL);

        $milk_production->groupBy('cow','milking_date');

        $milk_production->orderBy('milking_date', 'DESC');

        $clone_dead_cow = clone $milk_production;
        $totalRecords = $clone_dead_cow->count();

        $result = $milk_production->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getHieghestmilkProducer(array $where = [])
    {
        $milk_production = MilkProduction::select(DB::raw('SUM(milk_quantity) as milk_quantity, cow'))->where($where);
        $milk_production->groupBy('cow');
        $milk_production->orderByDesc('milk_quantity');
        $milk_production->limit(1);
        $result = $milk_production->get();
        $final = !empty($result[0]['cow']) ? $result[0]['cow'] : '-' ;
        return $final;
    }

    public function getLowestmilkProducer(array $where = [])
    {
        $milk_production = MilkProduction::select(DB::raw('SUM(milk_quantity) as milk_quantity, cow'))->where($where);
        $milk_production->groupBy('cow');
        $milk_production->orderBy('milk_quantity','asc');
        $milk_production->limit(1);
        $result = $milk_production->get();
        $final = !empty($result[0]['cow']) ? $result[0]['cow'] : '-';
        return $final;
    }

    public function getTotalProductionofToday(array $where = [])
    {
        $today = Carbon::today()->format('Y-m-d');
        $milk_production = MilkProduction::select(DB::raw('SUM(milk_quantity) as milk_quantity'))->where($where);
        $milk_production->where('milking_date', '=', $today);
        $result = $milk_production->get();
        if($result){
            return round($result[0]['milk_quantity'],2);
        }
        else{
            return 0;
        }
    }

    public function getAvgProduction(array $where = [])
    {
        $milk_production = MilkProduction::select(DB::raw('AVG(milk_quantity) as milk_quantity'))->where($where);
        $result = $milk_production->get();
        if($result){
            return round($result[0]['milk_quantity'],2);
        }
        else{
            return 0;
        }
    }

    public function getTotalProduction(array $where = [])
    {
        $milk_production = MilkProduction::select(DB::raw('SUM(milk_quantity) as milk_quantity'))->where($where);
        $result = $milk_production->get();
        if($result){
            return round($result[0]['milk_quantity'],2);
        }
        else{
            return 0;
        }
    }
}
