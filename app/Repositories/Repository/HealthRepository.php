<?php

namespace App\Repositories\Repository;

use App\Models\Health;
use App\Repositories\Interfaces\HealthRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HealthRepository implements HealthRepositoryInterface
{

    public function getTotalHealth(array $filter = [])
    {
        // return Health::all()->count();
        $health = Health::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $health->where('vet_id', '=', $filter['vet_id']);
        }
        if(isset($filter['is_paid'])){
            $health->where('is_paid', '=', $filter['is_paid']);
        }
        if(isset($filter['is_verified'])){
            $health->where('is_verified', '=', $filter['is_verified']);
        }
        else{
            $health->where('is_verified', '!=', 3);
        }
        if(isset($filter['mobile'])){
            $health->where('mobile', '=', $filter['mobile']);
        }
        return $health->count();
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
        $health = Health::select(DB::raw('*' ))->where('id', '<>', null);//DATE_ADD(expected_date_of_birth, INTERVAL 14 DAY) as first_heat, DATE_ADD(expected_date_of_birth, INTERVAL 55 DAY) as second_heat

        if(isset($filter['mobile'])){
            $health->where('mobile', '=', $filter['mobile']);
        }

        if(isset($filter['health_category'])){
            $health->where('health_category', '=', $filter['health_category']);
        }

        if(isset($filter['vet_id'])){
            $health->where('vet_id', '=', $filter['vet_id']);
        }
        if(isset($filter['id'])){
            $health->where('id', '=', $filter['id']);
        }
        if(isset($filter['is_paid'])){
            $health->where('is_paid', '=', $filter['is_paid']);
        }
        if(isset($filter['is_verified'])){
            $is_verified_array = explode(',', $filter['is_verified']);
            $health->whereIn('is_verified', $is_verified_array);
        }
        if(isset($filter['datetype'])){
            $curr_date = Carbon::now()->format('Y-m-d');
            if ($filter['datetype'] == 'today') {
                $health->whereDate('treatment_date', $curr_date );
            }
            if ($filter['datetype'] == 'week') {
                $health->whereBetween('treatment_date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
            }
            if ($filter['datetype'] == 'month') {
                $health->whereBetween('treatment_date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
            }
            if ($filter['datetype'] == 'year') {
                $health->whereYear('treatment_date',  Carbon::now()->year);
            }
        }

        $clone_health = clone $health;
        $totalRecords = $clone_health->count();

        if ($rawperpage) {
            $health->take($rawperpage)->skip($start);
        }
        // $result = $health->get()->sortByDesc("created_at");
        $result = $health->get();

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function createOrUpdate(array $data, string $id = null) : Health
    {
        if (!isset($id)) {
            $Health = new Health($data);
        } else {
            $Health = Health::find($id);

            foreach ($data as $key => $value) {
                $Health->$key = $value;
            }
        }
        $Health->save();
        return $Health;
    }

    public function getTotalHealthAmount(array $filter = [])
    {
        $health = Health::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $health->where('vet_id', '=', $filter['vet_id']);
            $health->where('is_verified', '=', 1);
        }
        return $health->sum('wallet_amount');
    }

    public function getAllHealthByFarmer(array $with = [], array $filter = []) : array
    {
        $health = Health::select(DB::raw('*' ))->where('id', '<>', null);

        if(isset($filter['mobile_number'])){
            $health->where('mobile', '=', $filter['mobile_number']);
        }

        if(isset($filter['datetype'])){
            $curr_date = Carbon::now()->format('Y-m-d');
            if ($filter['datetype'] == 'today') {
                $health->whereDate('treatment_date', $curr_date );
            }
            if ($filter['datetype'] == 'week') {
                $health->whereBetween('treatment_date', [Carbon::now()->subDays(7)->format('Y-m-d'), $curr_date]);
            }
            if ($filter['datetype'] == 'month') {
                $health->whereBetween('treatment_date', [Carbon::now()->subDays(30)->format('Y-m-d'), $curr_date]);
            }
            if ($filter['datetype'] == 'year') {
                $health->whereYear('treatment_date',  Carbon::now()->year);
            }
        }

        $clone_health = clone $health;
        $totalRecords = $clone_health->count();

        $result = $health->get()->sortByDesc("treatment_date");

        return ['total' => $totalRecords, 'data' => $result];
    }

    public function updateHealthbyVet(array $breeding_health_update = [], string $vet_id = null)
    {
        $Health = Health::where('vet_id', '=', $vet_id);
        $Health->where('vet_id', '=', $vet_id);
        $Health->where('is_paid', '=', 0);
        $Health->where('is_verified', '=', 1);
        $Health->where('deleted_at', '=', NULL);
        $Health->update($breeding_health_update);
        return true;
    }

    public function getPaidHealthList(array $filter = [])
    {
        $health = Health::where('id', '<>', null);
        if(isset($filter['vet_id'])){
            $health->where('vet_id', '=', $filter['vet_id']);
            $health->where('is_paid', '=', $filter['is_verified']);
            $health->where('is_verified', '=', $filter['is_paid']);
        }
        $result = $health->get();

        return $result;

    }

    public function destroy(string $multiple_id)
    {
        return Health::destroy($multiple_id);
    }

    public function getHieghestHealthExpense(array $where = [])
    {
        $milk_production = Health::select(DB::raw('SUM(cost) as cost, cow_name'))->where($where);
        $milk_production->groupBy('cow_name');
        $milk_production->orderByDesc('cost');
        $milk_production->limit(1);
        $result = $milk_production->get();
        return $result[0]['cow_name'];
    }
}
