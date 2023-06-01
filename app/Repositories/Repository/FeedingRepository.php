<?php
namespace App\Repositories\Repository;

use App\Models\Feeding;
use App\Repositories\Interfaces\FeedingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FeedingRepository implements FeedingRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : Feeding
    {
        if (!isset($id)) {
            $feeding = new Feeding($data);
        } else {
            $feeding = Feeding::find($id);

            foreach ($data as $key => $value) {
                $feeding->$key = $value;
            }
        }
        $feeding->save();
        return $feeding;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $feeding = Feeding::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $feeding->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile'])) {
                $feeding->where('mobile', '=', $filter['mobile']);
            }
            if (isset($filter['date_selected'])) {
                $feeding->where('date_selected', '=', $filter['date_selected']);
            }
            if (isset($filter['type'])) {
                $feeding->where('type', '=', $filter['type']);
            }
            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $feeding->whereDate('date_selected', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $feeding->whereBetween('date_selected', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $feeding->whereBetween('date_selected', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $feeding->whereYear('date_selected',  Carbon::now()->year);
                }
            }
        }

        // if ($searchValue) {
        //     $dead_cow->where('cow_name', 'like', '%' . $searchValue . '%');
        // }
        $feeding->where('deleted_at', '=', NULL);
        $clone_dead_cow = clone $feeding;
        $totalRecords = $clone_dead_cow->count();

        if ($rawperpage) {
            $feeding->take($rawperpage)->skip($start);
        }

        $result = $feeding->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getCount(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        // $feeding = Feeding::sum('total');
        $feeding = Feeding::where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $feeding->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile'])) {
                $feeding->where('mobile', '=', $filter['mobile']);
            }
            if (isset($filter['date_selected'])) {
                $feeding->where('date_selected', '=', $filter['date_selected']);
            }
            if (isset($filter['type'])) {
                $feeding->where('type', '=', $filter['type']);
            }
            if(isset($filter['type'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['type'] == 'today') {
                    $feeding->whereDate('date_selected', $curr_date );
                }
                if ($filter['type'] == 'week') {
                    $feeding->whereBetween('date_selected', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['type'] == 'year') {
                    $feeding->whereYear('date_selected',  Carbon::now()->year);
                }
            }
        }
        $feeding->where('deleted_at', '=', NULL);
        $result = $feeding->sum('total');
        // dd($result);
        return ['total' => $result];
    }

    public function getAllFeedingByFarmer(array $with = [], array $filter = []): array
    {
        DB::enableQueryLog();
        $feeding = Feeding::select(DB::raw('*'))->where('id', '<>', null);
        $feeding->where('type', '=' , 'Consumption');
        if ($filter) {
            if (isset($filter['mobile_number'])) {
                $feeding->where('mobile', '=', $filter['mobile_number']);
            }
            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $feeding->whereDate('date_selected', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $feeding->whereBetween('date_selected', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $feeding->whereBetween('date_selected', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $feeding->whereYear('date_selected',  Carbon::now()->year);
                }
            }
        }
        $feeding->whereNull('deleted_at');
        $clone_feeding = clone $feeding;
        $totalRecords = $clone_feeding->count();

        $result = $feeding->get()->sortByDesc("id");


        return ['total' => $totalRecords, 'data' => $result];
    }

}
