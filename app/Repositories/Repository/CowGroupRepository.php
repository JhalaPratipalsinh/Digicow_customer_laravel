<?php

namespace App\Repositories\Repository;

use App\Models\Cow;
use App\Models\CowBreed;
use App\Models\CowGroup;
use App\Repositories\Interfaces\CowGroupRepositoryinterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CowGroupRepository implements CowGroupRepositoryinterface
{

    public function createOrUpdate(array $data, string $id = null) : Cow
    {
        if (!isset($id)) {
            $Cow = new CowGroup($data);
        } else {
            $Cow = CowGroup::find($id);

            foreach ($data as $key => $value) {
                $Cow->$key = $value;
            }
        }
        $Cow->save();
        return $Cow;
    }


    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null) : array
    {
        $vet = CowGroup::where('id', '<>', null);

        if (!empty($with)) {
            $vet->with($with);
        }

        if ($searchValue) {

            // $vet->where('vet_fname', 'like', '%' . $searchValue . '%');
            // $vet->orWhere('vet_sname', 'like', '%' . $searchValue . '%');
        }

        $clone_vet = clone $vet;
        $totalRecords = $clone_vet->count();

        if ($rawperpage) {
            $vet->take($rawperpage)->skip($start);
        }

        $result = $vet->get();

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
