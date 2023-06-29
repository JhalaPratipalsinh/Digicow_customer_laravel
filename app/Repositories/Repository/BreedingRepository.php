<?php

namespace App\Repositories\Repository;

use App\Models\Breeding;
use App\Models\FarmerVet;
use App\Repositories\Interfaces\BreedingRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BreedingRepository implements BreedingRepositoryInterface
{
    public function getTotalBreeding(array $filter = [])
    {
        $breeding = Breeding::where('id', '<>', null);
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

    /**
     * Get All
     *
     * @param array $with
     * @param [type] $start
     * @param [type] $rawperpage
     * @param [type] $columnName
     * @param [type] $columnSortOrder
     * @param [type] $searchValue
     * @param array $filter
     * @return array
     */
    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []) : array
    {
        $breeding = Breeding::where('breedings.id', '<>', null);

        if (!empty($with)) {
            $breeding->with($with);
        }

        if($filter)
        {
            if(isset($filter['mobile'])){

                $breeding->where('mobile', '=', $filter['mobile']);
            }
        }

        if ($searchValue) {
            $breeding->where('farmer_name', 'like', '%' . $searchValue . '%');
        }

        $clone_breeding = clone $breeding;
        $totalRecords = $clone_breeding->count();
        if ($rawperpage) {
            $breeding->take($rawperpage)->skip($start);
        }

        $result = $breeding->get();
        // $result = $breeding->get()->sortByDesc("created_at");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function createOrUpdate(array $data, string $id = null) : Breeding
    {
        if (!isset($id)) {
            $Breeding = new Breeding($data);
        } else {
            $Breeding = Breeding::find($id);

            foreach ($data as $key => $value) {
                $Breeding->$key = $value;
            }
        }
        $Breeding->save();
        return $Breeding;
    }

    public function getTotalBreedingAmount(array $filter = [])
    {
        $breeding = Breeding::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $breeding->where('vet_id', '=', $filter['vet_id']);
            $breeding->where('is_verified', '=', 1);
        }
        return $breeding->sum('wallet_amount');
    }

    public function getAllBreedingfByFarmer(array $with = [], array $filter = []) : array
    {
        $breeding = Breeding::select(DB::raw('*' ))->where('id', '<>', null);//DATE_ADD(expected_date_of_birth, INTERVAL 14 DAY) as first_heat, DATE_ADD(expected_date_of_birth, INTERVAL 55 DAY) as second_heat

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
        $Breeding = Breeding::where('vet_id', '=', $vet_id);
        $Breeding->where('vet_id', '=', $vet_id);
        $Breeding->where('is_paid', '=', 0);
        $Breeding->where('is_verified', '=', 1);
        $Breeding->where('deleted_at', '=', NULL);
        $Breeding->update($breeding_health_update);
        return true;
    }

    public function getPaidBreedingList(array $filter = [])
    {
        $Breeding = Breeding::where('id', '<>', null);
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
        $Breeding = Breeding::where('id', '<>', null);

        $Breeding->where('mobile', '=', $mobile);

        $result = $Breeding->get();

        return $result;

    }

    public function getHieghestRepeatAI(array $where = [])
    {
        $breeding = Breeding::select(DB::raw('SUM(repeats) as repeats, cow_name'))->where($where);
        $breeding->groupBy('cow_name');
        $breeding->orderByDesc('repeats');
        $breeding->limit(1);
        $result = $breeding->get();
        return $result[0]['cow_name'];
    }
}
