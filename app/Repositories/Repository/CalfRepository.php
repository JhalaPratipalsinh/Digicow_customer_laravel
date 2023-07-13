<?php

namespace App\Repositories\Repository;

use App\Models\Calf;
use App\Models\DeadCow;
use App\Models\SoldCow;
use App\Repositories\Interfaces\CalfRepositoryInterface;

class CalfRepository implements CalfRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null): Calf
    {
        if (!isset($id)) {
            $Cow = new Calf($data);
        } else {
            $Cow = Calf::find($id);

            foreach ($data as $key => $value) {
                $Cow->$key = $value;
            }
        }
        $Cow->save();
        return $Cow;
    }


    /**
     * Get Cow By where
     *
     * @param array $where
     * @return mixed
     */
    public function getCalfByWhere(array $where): mixed
    {
        return Calf::orderBy('calf_name')->where($where)->where('deleted_at', '=', NULL)->where('status', '=', 'active')->get();
    }


    public function createOrUpdateSoldCow(array $data, string $id = null): SoldCow
    {

        if (!isset($id)) {
            $Sold_cow = new SoldCow($data);
        } else {
            $Sold_cow = SoldCow::find($id);

            foreach ($data as $key => $value) {
                $Sold_cow->$key = $value;
            }
        }
        $Sold_cow->save();
        return $Sold_cow;
    }

    public function createOrUpdateDeadCow(array $data, string $id = null): DeadCow
    {

        if (!isset($id)) {
            $dead_cow = new DeadCow($data);
        } else {
            $dead_cow = DeadCow::find($id);

            foreach ($data as $key => $value) {
                $dead_cow->$key = $value;
            }
        }
        $dead_cow->save();
        return $dead_cow;
    }


    /**
     * Get All
     *
     * @param array $with
     * @param [type] $start
     * @param [type] $rawperpage
     * @param [type] $columnName
     * @param [type] $columnSortOrder
     * @param [type] $searchValue
     * @return array
     */
    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where): array
    {
        $cow = Calf::where('id', '<>', null);

        if (!empty($with)) {
            $cow->with($with);
        }

        if ($searchValue) {

            $cow->where('cow_fname', 'like', '%' . $searchValue . '%');
            $cow->orWhere('cow_sname', 'like', '%' . $searchValue . '%');
        }

        if (!empty($where)) {
            $cow->where('mobile_number', $where['mobile_number']);
        }
        $cow->where('deleted_at', '=', NULL);
        $clone_cow = clone $cow;
        $totalRecords = $clone_cow->count();

        if ($rawperpage) {
            $cow->take($rawperpage)->skip($start);
        }

        $result = $cow->get();

        return ['total' => $totalRecords, 'data' => $result];
    }


    /**
     * Get All
     *
     * @param array $with
     * @param [type] $start
     * @param [type] $rawperpage
     * @param [type] $columnName
     * @param [type] $columnSortOrder
     * @param [type] $searchValue
     * @return array
     */
    public function getAllDeadCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where): array
    {
        $dedcow = DeadCow::where('id', '<>', null);

        if (!empty($with)) {
            $dedcow->with($with);
        }

        if (!empty($where)) {
            $dedcow->where('mobile_number', $where['mobile_number']);
        }

        if ($searchValue) {

            $dedcow->where('cow_fname', 'like', '%' . $searchValue . '%');
            $dedcow->orWhere('cow_sname', 'like', '%' . $searchValue . '%');
        }
        $dedcow->where('cow_category', 'calf');
        $dedcow->where('deleted_at', '=', NULL);
        $clone_cow = clone $dedcow;
        $totalRecords = $clone_cow->count();

        if ($rawperpage) {
            $dedcow->take($rawperpage)->skip($start);
        }

        $result = $dedcow->get();

        return ['total' => $totalRecords, 'data' => $result];
    }


    /**
     * Get All
     *
     * @param array $with
     * @param [type] $start
     * @param [type] $rawperpage
     * @param [type] $columnName
     * @param [type] $columnSortOrder
     * @param [type] $searchValue
     * @return array
     */
    public function getAllSoldCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where): array
    {
        $soldcow = SoldCow::where('id', '<>', null);

        if (!empty($with)) {
            $soldcow->with($with);
        }

        if (!empty($where)) {
            $soldcow->where('phone_number', $where['mobile_number']);
        }
        $soldcow->where('cow_category', '=', 'calf');
        $soldcow->where('deleted_at', '=', NULL);
        $clone_cow = clone $soldcow;
        $totalRecords = $clone_cow->count();

        if ($rawperpage) {
            $soldcow->take($rawperpage)->skip($start);
        }

        $result = $soldcow->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

    /**
     * Get All
     *
     * @param array $with
     * @param [type] $start
     * @param [type] $rawperpage
     * @param [type] $columnName
     * @param [type] $columnSortOrder
     * @param [type] $searchValue
     * @return array
     */
    public function getAllDeleteCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where): array
    {
        $soldcow = Calf::where('id', '<>', null);

        if (!empty($with)) {
            $soldcow->with($with);
        }

        if (!empty($where)) {
            $soldcow->where('mobile_number', $where['mobile_number']);
        }

        $soldcow->where('deleted_at', '!=', NULL);
        $clone_cow = clone $soldcow;
        $totalRecords = $clone_cow->count();

        if ($rawperpage) {
            $soldcow->take($rawperpage)->skip($start);
        }

        $result = $soldcow->get();

        return ['total' => $totalRecords, 'data' => $result];
    }
}
