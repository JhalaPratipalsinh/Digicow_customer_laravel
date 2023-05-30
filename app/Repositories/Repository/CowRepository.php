<?php

namespace App\Repositories\Repository;

use App\Models\Cow;
use App\Models\DeadCow;
use App\Models\SoldCow;
use App\Repositories\Interfaces\CowRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class CowRepository implements CowRepositoryInterface
{

    public function createOrUpdate(array $data, string $id = null) : Cow
    {
        if (!isset($id)) {
            $Cow = new Cow($data);
        } else {
            $Cow = Cow::find($id);

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
    public function getCowByWhere(array $where): mixed
    {
        return Cow::orderBy('title')->where($where)->where('deleted_at', '=', NULL)->where('status', '=', 'active')->get();
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
    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $where) : array
    {
        $cow = Cow::where('id', '<>', null);

        if (!empty($with)) {
            $cow->with($with);
        }

        if ($searchValue) {

            $cow->where('cow_fname', 'like', '%' . $searchValue . '%');
            $cow->orWhere('cow_sname', 'like', '%' . $searchValue . '%');
        }

        if (!empty($where)) {
            $cow->where('mobile_number', $where['mobile_number']) ;
        }

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
    public function getAllDeadCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null , array $where) : array
    {
        $dedcow = DeadCow::where('id', '<>', null);

        if (!empty($with)) {
            $dedcow->with($with);
        }

        if (!empty($where)) {
            $dedcow->where('mobile_number', $where['mobile_number']) ;
        }

        if ($searchValue) {

            $dedcow->where('cow_fname', 'like', '%' . $searchValue . '%');
            $dedcow->orWhere('cow_sname', 'like', '%' . $searchValue . '%');
        }

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
    public function getAllSoldCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null , array $where) : array
    {
        $soldcow = SoldCow::where('id', '<>', null);

        if (!empty($with)) {
            $soldcow->with($with);
        }

        if (!empty($where)) {
            $soldcow->where('phone_number', $where['mobile_number']) ;
        }



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
    public function getAllDeleteCow(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null , array $where) : array
    {
        $soldcow = Cow::where('id', '<>', null);

        if (!empty($with)) {
            $soldcow->with($with);
        }

        if (!empty($where)) {
            $soldcow->where('mobile_number', $where['mobile_number']) ;
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




    /*
    public function getTotalBreeding(array $filter = [])
    {
        dd('sandip');

        $breeding = Cow::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $breeding->where('vet_id', '=', $filter['vet_id']);
        }
        if(isset($filter['is_paid'])){
            $breeding->where('is_paid', '=', $filter['is_paid']);
        }
        if(isset($filter['is_verified'])){
            $breeding->where('is_verified', '=', $filter['is_verified']);
        }
        else{
            $breeding->where('is_verified', '!=', 3);

        }
        if(isset($filter['mobile'])){
            $breeding->where('mobile', '=', $filter['mobile']);
        }
        return $breeding->count();
    }


    public function getTotalBreedingAmount(array $filter = [])
    {
        $breeding = Cow::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $breeding->where('vet_id', '=', $filter['vet_id']);
            $breeding->where('is_verified', '=', 1);
        }
        return $breeding->sum('wallet_amount');
    }

    public function getAllBreedingfByFarmer(array $with = [], array $filter = []) : array
    {
        $breeding = Cow::select(DB::raw('*' ))->where('id', '<>', null);//DATE_ADD(expected_date_of_birth, INTERVAL 14 DAY) as first_heat, DATE_ADD(expected_date_of_birth, INTERVAL 55 DAY) as second_heat

        if (!empty($with)) {
            $breeding->with($with);
        }
        if($filter)
        {
            if(isset($filter['mobile_number'])){
                $breeding->where('mobile', '=', $filter['mobile_number']);
            }

            if(isset($filter['datetype'])){
                $curr_date = Carbon::now()->format('Y-m-d');
                if ($filter['datetype'] == 'today') {
                    $breeding->whereDate('date_dt', $curr_date );
                }
                if ($filter['datetype'] == 'week') {
                    $breeding->whereBetween('date_dt', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'month') {
                    $breeding->whereBetween('date_dt', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
                }
                if ($filter['datetype'] == 'year') {
                    $breeding->whereYear('date_dt',  Carbon::now()->year);
                }
            }
        }

        $clone_breeding = clone $breeding;
        $totalRecords = $clone_breeding->count();

        $result = $breeding->get()->sortByDesc("date_dt");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function updateBreedingbyVet(array $breeding_health_update = [], string $vet_id = null)
    {
        $Breeding = Cow::where('vet_id', '=', $vet_id);
        $Breeding->where('vet_id', '=', $vet_id);
        $Breeding->where('is_paid', '=', 0);
        $Breeding->where('is_verified', '=', 1);
        $Breeding->where('deleted_at', '=', NULL);
        $Breeding->update($breeding_health_update);
        return true;
    }

    public function getPaidBreedingList(array $filter = [])
    {
        $Breeding = Cow::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $Breeding->where('vet_id', '=', $filter['vet_id']);
            $Breeding->where('is_paid', '=', $filter['is_paid']);
            $Breeding->where('is_verified', '=', $filter['is_verified']);
        }
        $clone_Breeding = clone $Breeding;
        $totalRecords = $clone_Breeding->count();
        $result = $Breeding->get();

        return $result;

    }

    public function getBreeding($mobile)
    {
        $Breeding = Cow::where('id', '<>', null);

        $Breeding->where('mobile', '=', $mobile);

        $result = $Breeding->get();

        return $result;

    }
    */

}
