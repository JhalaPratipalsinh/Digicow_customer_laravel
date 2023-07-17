<?php

namespace App\Repositories\Repository;

use App\Models\Other_incomes;
use App\Repositories\Interfaces\OtherIncomeRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OtherIncomeRepository implements OtherIncomeRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : Other_incomes
    {
        if (!isset($id)) {
            $Other_incomes = new Other_incomes($data);
        } else {
            $Other_incomes = Other_incomes::find($id);

            foreach ($data as $key => $value) {
                $Other_incomes->$key = $value;
            }
        }
        $Other_incomes->save();
        return $Other_incomes;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $other_income = Other_incomes::select(DB::raw('*' ))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $other_income->where('id', '=', $filter['id']); // Specify table name for salary.id
            }
            if (isset($filter['mobile'])) {
                $other_income->where('mobile', '=', $filter['mobile']); // Specify table name for salary.mobile_number
            }
        }

        $other_income->where('deleted_at', '=', NULL);

        if ($searchValue) {
            $other_income->where(function($data) use ($searchValue){

                $data->where('name', 'like', '%' . $searchValue . '%');

                $data->orWhere('amount', 'like', '%' . $searchValue . '%');

                $data->orWhere('date_selected', 'like', '%' . $searchValue . '%');

            });
        }

        if ($rawperpage) {
            $other_income->take($rawperpage)->skip($start);
        }

        $totalRecords = $other_income->count();

        $result = $other_income->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

}
