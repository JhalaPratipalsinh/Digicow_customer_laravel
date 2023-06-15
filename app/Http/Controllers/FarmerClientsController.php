<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmerClientsStoreRequest;
use App\Http\Requests\FarmerClientsUpdateRequest;
use App\Models\FarmerClients;
use App\Repositories\Interfaces\FarmerClientsRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DataTableRS;

class FarmerClientsController extends Controller
{

    protected $farmerclientsRepository;

    public function __construct(
        FarmerClientsRepositoryInterface $farmerclientsRepository
    ) {
        $this->farmerclientsRepository = $farmerclientsRepository;
    }

    public function customerCreate()
    {
        return view('components.clientFarmer.customer_create');
    }

    public function customerStore(FarmerClientsStoreRequest $request)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'client_mobile'     =>  $request->client_mobile,
        ];

        try {
            $getall_farmerclients = $this->farmerclientsRepository->getAll([],  null, null, null, null, null, $filter);

            if ($getall_farmerclients['total'] != 0) {
                Session::flash('message_error', 'This farmer is already added');
                return redirect('farmer-clients-customer/create');
            }

            $request_data = [
                'name' => $request->name,
                'location' => $request->location,
                'client_mobile' => $request->client_mobile,
                'farmer_mobile' => $mobile,
                'status' => 'active',
                'user_type' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->farmerclientsRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Stored farmer clients');

            return redirect('farmer-clients-customer/create');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function customerList()
    {
        return view('components.clientFarmer.customer_list');
    }

    public function paginatCustomerReport(Request $request): JsonResponse
    {

        $where = [
            'farmer_mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'user_type' =>  1,
        ];
        $result = $this->farmerclientsRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;

        //dd($result);
        return response()->json(new DataTableRs($result));
    }

    public function farmarClientRemove(string $id)
    {
        $request_data = [
            'id' => $id
        ];
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->farmerclientsRepository->createOrUpdate($request_data, $id);

        Session::flash('message_success', 'Delete Farmer Clients');

        return redirect('farmer-clients-customer/customer-list');
    }

    public function farmarClientEdit($id)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'id'     =>  $id,
        ];

        $data['client'] = $this->farmerclientsRepository->getAll([],  null, null, null, null, null, $filter)['data'][0];
        return view('components.clientFarmer.customer_edit', $data);
    }


    public function customerUpdate(FarmerClientsUpdateRequest $request, $id)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];

        $request_data = [
            'name' => $request->name,
            'location' => $request->location,
            'client_mobile' => $request->client_mobile,
            'farmer_mobile' => $mobile,
            'status' => 'active',
            'user_type' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->farmerclientsRepository->createOrUpdate($request_data, $id);
        Session::flash('message_success', 'Stored farmer clients');

        return redirect('farmer-clients-customer/customer-list');
    }



    public function coopCreate()
    {
        return view('components.clientFarmer.coop_create');
    }


    public function coopStore(FarmerClientsStoreRequest $request)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'client_mobile'     =>  $request->client_mobile,
        ];

        try {
            $getall_farmerclients = $this->farmerclientsRepository->getAll([],  null, null, null, null, null, $filter);

            if ($getall_farmerclients['total'] != 0) {
                Session::flash('message_error', 'This farmer is already added');
                return redirect('farmer-clients-coop/create');
            }

            $request_data = [
                'name' => $request->name,
                'location' => $request->location,
                'client_mobile' => $request->client_mobile,
                'farmer_mobile' => $mobile,
                'status' => 'active',
                'user_type' => 2,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->farmerclientsRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Stored farmer clients');

            return redirect('farmer-coop/create');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function coopList()
    {
        return view('components.clientFarmer.coop_list');
    }

    public function paginatCoopReport(Request $request): JsonResponse
    {
        $where = [
            'farmer_mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'user_type' =>  2,
        ];
        $result = $this->farmerclientsRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }

    public function farmarCoopRemove(string $id)
    {
        $request_data = [
            'id' => $id
        ];
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->farmerclientsRepository->createOrUpdate($request_data, $id);

        Session::flash('message_success', 'Delete Farmer Co-operative');

        return redirect('farmer-coop/coop-list');
    }

    public function farmarCoopEdit($id)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'id'     =>  $id,
        ];

        $data['client'] = $this->farmerclientsRepository->getAll([],  null, null, null, null, null, $filter)['data'][0];
        return view('components.clientFarmer.coop_edit', $data);
    }


    public function coopUpdate(FarmerClientsUpdateRequest $request, $id)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];

        $request_data = [
            'name' => $request->name,
            'location' => $request->location,
            'client_mobile' => $request->client_mobile,
            'farmer_mobile' => $mobile,
            'status' => 'active',
            'user_type' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->farmerclientsRepository->createOrUpdate($request_data, $id);
        Session::flash('message_success', 'Stored farmer Co-operative');

        return redirect('farmer-coop/coop-list');
    }




}
