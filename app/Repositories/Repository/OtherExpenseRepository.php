<?php

namespace App\Repositories\Repository;

use App\Models\Other_expense;
use App\Repositories\Interfaces\OtherExpenseRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OtherExpenseRepository implements OtherExpenseRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : Other_expense
    {
        if (!isset($id)) {
            $Other_expense = new Other_expense($data);
        } else {
            $Other_expense = Other_expense::find($id);

            foreach ($data as $key => $value) {
                $Other_expense->$key = $value;
            }
        }
        $Other_expense->save();
        return $Other_expense;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $other_expense = Other_expense::select(DB::raw('*' ))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $other_expense->where('id', '=', $filter['id']); // Specify table name for salary.id
            }
            if (isset($filter['mobile'])) {
                $other_expense->where('mobile', '=', $filter['mobile']); // Specify table name for salary.mobile_number
            }
        }

        $other_expense->where('deleted_at', '=', NULL);


        if ($searchValue) {
            $other_expense->where(function($data) use ($searchValue){

                $data->where('name', 'like', '%' . $searchValue . '%');

                $data->orWhere('amount', 'like', '%' . $searchValue . '%');

                $data->orWhere('date_selected', 'like', '%' . $searchValue . '%');

            });
        }

        if ($rawperpage) {
            $other_expense->take($rawperpage)->skip($start);
        }

        $totalRecords = $other_expense->count();

        $result = $other_expense->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

}
