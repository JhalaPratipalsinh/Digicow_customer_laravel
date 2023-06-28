<?php

namespace App\Repositories\Repository;

use App\Models\Salary;
use App\Repositories\Interfaces\SalaryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalaryRepository implements SalaryRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : Salary
    {
        if (!isset($id)) {
            $salary = new Salary($data);
        } else {
            $salary = Salary::find($id);

            foreach ($data as $key => $value) {
                $salary->$key = $value;
            }
        }
        $salary->save();
        return $salary;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $salary = Salary::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $salary->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile_number'])) {
                $salary->where('mobile_number', '=', $filter['mobile_number']);
            }

            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $salary->whereDate('date', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $salary->whereBetween('date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $salary->whereBetween('date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $salary->whereYear('date',  Carbon::now()->year);
                }
            }
        }

        $salary->where('deleted_at', '=', NULL);
        $clone_dead_cow = clone $salary;
        $totalRecords = $clone_dead_cow->count();

        if ($rawperpage) {
            $salary->take($rawperpage)->skip($start);
        }

        $result = $salary->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function getAllSalaryByFarmer(array $with = [],  array $filter = []): array
    {
        $salary = Salary::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['mobile_number'])) {
                $salary->where('mobile_number', '=', $filter['mobile_number']);
            }

            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $salary->whereDate('date', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $salary->whereBetween('date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $salary->whereBetween('date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $salary->whereYear('date',  Carbon::now()->year);
                }
            }
        }

        $salary->where('deleted_at', '=', NULL);
        $clone_dead_cow = clone $salary;
        $totalRecords = $clone_dead_cow->count();

        $result = $salary->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }


}
