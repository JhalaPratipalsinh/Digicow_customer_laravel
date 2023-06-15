<?php

namespace App\Repositories\Repository;

use App\Http\Controllers\api\v2\FarmerClientsController;
use App\Models\FarmerClients;
use App\Repositories\Interfaces\FarmerClientsRepositoryInterface;
use Illuminate\Support\Facades\DB;

class FarmerClientsRepository implements FarmerClientsRepositoryInterface
{
    public function createOrUpdate(array $data, string $id = null): FarmerClients
    {
        if (!isset($id)) {
            $farmer_clients = new FarmerClients($data);
        } else {
            $farmer_clients = FarmerClients::find($id);

            foreach ($data as $key => $value) {
                $farmer_clients->$key = $value;
            }
        }
        $farmer_clients->save();
        return $farmer_clients;
    }

    public function getAll(array $with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null, array $filter = []): array
    {
        $clients_farmer = FarmerClients::select(DB::raw('*'))->where('id', '<>', null);

        if ($filter) {
            if (isset($filter['id'])) {
                $clients_farmer->where('id', '=', $filter['id']);
            }
            if (isset($filter['name'])) {
                $clients_farmer->where('name', '=', $filter['name']);
            }
            if (isset($filter['location'])) {
                $clients_farmer->where('location', '=', $filter['location']);
            }
            if (isset($filter['client_mobile'])) {
                $clients_farmer->where('client_mobile', '=', $filter['client_mobile']);
            }
            if (isset($filter['farmer_mobile'])) {
                $clients_farmer->where('farmer_mobile', '=', $filter['farmer_mobile']);
            }
            if (isset($filter['user_type'])) {
                $clients_farmer->where('user_type', '=', $filter['user_type']);
            }
        }

        // if ($searchValue) {
        //     $dead_cow->where('cow_name', 'like', '%' . $searchValue . '%');
        // }
        $clients_farmer->where('deleted_at', '=', NULL);
        $clone_dead_cow = clone $clients_farmer;
        $totalRecords = $clone_dead_cow->count();

        if ($rawperpage) {
            $clients_farmer->take($rawperpage)->skip($start);
        }

        $result = $clients_farmer->get();

        return ['total' => $totalRecords, 'data' => $result];
    }
}
