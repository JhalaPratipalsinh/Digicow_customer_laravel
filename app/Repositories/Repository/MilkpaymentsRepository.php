<?php
namespace App\Repositories\Repository;

use App\Models\MilkPayments;
use App\Repositories\Interfaces\MilkpaymentsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class MilkpaymentsRepository implements MilkpaymentsRepositoryInterface
{

    public function createOrUpdate(array $data, string $id = null): MilkPayments
    {
        if (!isset($id)) {
            $milk_payments = new MilkPayments($data);
        } else {
            $milk_payments = MilkPayments::find($id);

            foreach ($data as $key => $value) {
                $milk_payments->$key = $value;
            }
        }
        $milk_payments->save();
        return $milk_payments;
    }

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $milk_payments = MilkPayments::select(DB::raw('*'))->where('id', '<>', null);
        if ($filter) {
            if (isset($filter['id'])) {
                $milk_payments->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile_number'])) {
                $milk_payments->where('mobile_number', '=', $filter['mobile_number']);
            }
            if (isset($filter['consumer_id'])) {
                $milk_payments->where('consumer_id', '=', $filter['consumer_id']);
            }
            if (isset($filter['consumer_type_id'])) {
                $milk_payments->where('consumer_type_id', '=', $filter['consumer_type_id']);
            }

            //dd($filter['milk_pament_date']);
            if (isset($filter['milk_pament_date'])) {
                $milk_payments->where('milk_pament_date', '=', $filter['milk_pament_date']);
            }
        }
        $milk_payments->where('deleted_at', '=', NULL);
        $clone_milk_payments = clone $milk_payments;
        $totalRecords = $clone_milk_payments->count();

        if ($rawperpage) {
            $milk_payments->take($rawperpage)->skip($start);
        }

        $result = $milk_payments->get()->sortByDesc("id");

        return ['total' => $totalRecords, 'data' => $result];
    }

}
