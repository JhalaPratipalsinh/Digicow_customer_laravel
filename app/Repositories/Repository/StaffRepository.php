<?php

namespace App\Repositories\Repository;

use App\Models\Staff;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class StaffRepository implements StaffRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null) : Staff
    {
        if (!isset($id)) {
            $staff = new Staff($data);
        } else {
            $staff = Staff::find($id);

            foreach ($data as $key => $value) {
                $staff->$key = $value;
            }
        }
        $staff->save();
        return $staff;
    }

    public function checkMobileAvailable(string $staff_mobile_number = null, string $id = null) : array
    {
        $staff = Staff::select(DB::raw('*'))->where('staff_mobile_number', '=', $staff_mobile_number);
        $staff->where('id', '<>', $id);
        $staff->where('deleted_at', '=', NULL);
        $clone_staff = clone $staff;
        $totalRecords = $clone_staff->count();
        return ['total' => $totalRecords];
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $staff = Staff::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $staff->where('id', '=', $filter['id']);
            }
            if (isset($filter['mobile_number'])) {
                $staff->where('mobile_number', '=', $filter['mobile_number']);
            }

            if (isset($filter['status'])) {
                $staff->where('status', '=', $filter['status']);
            }
        }

        $staff->where('deleted_at', '=', NULL);
        $clone_staff = clone $staff;
        $totalRecords = $clone_staff->count();

        if ($rawperpage) {
            $staff->take($rawperpage)->skip($start);
        }

        $result = $staff->get();

        return ['total' => $totalRecords, 'data' => $result];
    }


}


