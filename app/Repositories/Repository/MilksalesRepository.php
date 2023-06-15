<?php
namespace App\Repositories\Repository;

use App\Models\MilkSales;
use App\Repositories\Interfaces\MilksalesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MilksalesRepository implements MilksalesRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null ):MilkSales
    {
        if (!isset($id)) {
            $milk_sales = new MilkSales($data);
        }else{
            $milk_sales = MilkSales::find($id);

            foreach ($data as $key => $value) {
                $milk_sales->$key = $value;
            }
        }
        $milk_sales->save();
        return $milk_sales;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $milk_sales = MilkSales::select(DB::raw('*'))->where('id', '<>', null);
        if ($filter) {
            if (isset($filter['id'])) {
                $milk_sales->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile_number'])) {
                $milk_sales->where('mobile_number', '=', $filter['mobile_number']);
            }
            if (isset($filter['consumer_id'])) {
                $milk_sales->where('consumer_id', '=', $filter['consumer_id']);
            }
            if (isset($filter['consumer_type_id'])) {
                $milk_sales->where('consumer_type_id', '=', $filter['consumer_type_id']);
            }
            if (isset($filter['milk_sales_date'])) {
                $milk_sales->where('milk_sales_date', '=', $filter['milk_sales_date']);
            }
            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $milk_sales->whereDate('milk_sales_date', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                }
                if ($filter['datetype'] == 'month') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
                }
                if ($filter['datetype'] == 'year') {
                    $milk_sales->whereYear('milk_sales_date',  Carbon::now()->year);
                }
            }

        }
        $milk_sales->where('deleted_at', '=', NULL);
        $clone_milk_sales = clone $milk_sales;
        $totalRecords = $clone_milk_sales->count();

        if ($rawperpage) {
            $milk_sales->take($rawperpage)->skip($start);
        }

        $result = $milk_sales->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getAllSalesMilkReport(array $filter = []): array
    {
        $milk_sales = MilkSales::select(DB::raw('*'))->where('id', '<>', null);
        if ($filter) {
            if (isset($filter['mobile_number'])) {
                $milk_sales->where('mobile_number', '=', $filter['mobile_number']);
            }
            if (isset($filter['consumer_id'])) {
                $milk_sales->where('consumer_id', '=', $filter['consumer_id']);
            }
            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $milk_sales->whereDate('milk_sales_date', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $milk_sales->whereYear('milk_sales_date',  Carbon::now()->year);
                }
            }

        }
        $milk_sales->where('deleted_at', '=', NULL);
        $clone_milk_sales = clone $milk_sales;
        $totalRecords = $clone_milk_sales->count();

        $result = $milk_sales->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getAllMilkSalesByFarmer(array $with = [], array $filter = []): array
    {
        $milk_sales = MilkSales::select(DB::raw('*'))->where('id', '<>', null);
        if ($filter) {

            if (isset($filter['mobile_number'])) {
                $milk_sales->where('mobile_number', '=', $filter['mobile_number']);
            }
            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $milk_sales->whereDate('milk_sales_date', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $milk_sales->whereBetween('milk_sales_date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $milk_sales->whereYear('milk_sales_date',  Carbon::now()->year);
                }
            }

        }
        $milk_sales->where('deleted_at', '=', NULL);
        $clone_milk_sales = clone $milk_sales;
        $totalRecords = $clone_milk_sales->count();

        $result = $milk_sales->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }
}
