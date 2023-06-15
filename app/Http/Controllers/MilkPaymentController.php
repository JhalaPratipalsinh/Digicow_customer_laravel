<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoopPayStoreRequest;
use App\Http\Requests\CustomerPayStoreRequest;
use App\Repositories\Interfaces\FarmerClientsRepositoryInterface;
use App\Repositories\Interfaces\MilkpaymentsRepositoryInterface;
use App\Repositories\Repository\MilksalesRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MilkPaymentController extends Controller
{
    protected $milkpaymentsRepository;
    protected $farmerclientsRepository;
    protected $milksalesRepository;

    public function __construct(
        MilkpaymentsRepositoryInterface $milkpaymentsRepository,
        FarmerClientsRepositoryInterface $farmerclientsRepository,
        MilksalesRepository  $milksalesRepository,
    ) {
        $this->milkpaymentsRepository = $milkpaymentsRepository;
        $this->farmerclientsRepository = $farmerclientsRepository;
        $this->milksalesRepository  = $milksalesRepository;
    }
    public function customerPayCreate()
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'user_type'     =>  1,
        ];

        $data['farmer_client'] = $this->farmerclientsRepository->getAll([], null, null, null, null, null, $filter)['data']->pluck('name', 'id');

        return view('components.milkPayment.customer_pay_create', $data);
    }

    public function customerPayStore(CustomerPayStoreRequest $request)
    {

        $mobile = Auth::guard('web')->user()['mobile_number'];

        $where = [
            'consumer_id' =>  $request->get('consumer_id', null),
            'consumer_type_id' =>  $request->get('consumer_type_id', null),
        ];

        try {

            $milk_sales_income = $this->milksalesRepository->getAll([],  null, null, null, null, null, $where);
            if ($milk_sales_income['total'] == 0) {

                Session::flash('message_error', 'No Milk sales Record Found');
                return redirect('milk-payment/customer-pay-create');
            }

            $milk_payments = $this->milkpaymentsRepository->getAll([],  null, null, null, null, null, $where);
            $total_income = $milk_sales_income['data']->sum('income');
            $total_paid = $milk_payments['data']->sum('paid');

            $total = $total_income - $total_paid;
            $request_data = [
                'balance' =>  $total - $request->paid,
                'consumer_id' => $request->consumer_id,
                'consumer_type_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'mobile_number' => $mobile,
                'paid' => $request->paid,
                'insert_from' => 'web',
                'milk_pament_date' => date('Y-m-d H:i:s', strtotime($request->milk_pament_date)),
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->milkpaymentsRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Stored milk payments sucess');

            return redirect('milk-payment/customer-pay-create');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function coopPayCreate()
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'user_type'     =>  2,
        ];

        $data['farmer_client'] = $this->farmerclientsRepository->getAll([], null, null, null, null, null, $filter)['data']->pluck('name', 'id');
        return view('components.milkPayment.coop_pay_create', $data);
    }

    public function coopPayStore(CoopPayStoreRequest $request)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $where = [
            'consumer_id' =>  $request->get('consumer_id', null),
            'consumer_type_id' =>  $request->get('consumer_type_id', null),
        ];

        try {

            $milk_sales_income = $this->milksalesRepository->getAll([],  null, null, null, null, null, $where);
            if ($milk_sales_income['total'] == 0) {

                Session::flash('message_error', 'No Milk sales Record Found');
                return redirect('milk-payment/coop-pay-create');
            }

            $milk_payments = $this->milkpaymentsRepository->getAll([],  null, null, null, null, null, $where);
            $total_income = $milk_sales_income['data']->sum('income');
            $total_paid = $milk_payments['data']->sum('paid');

            $total = $total_income - $total_paid;

            $request_data = [
                'balance' =>  '1',
                'consumer_id' => $request->consumer_id,
                'consumer_type_id' => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'mobile_number' => $mobile,
                'paid' => $request->paid,
                'insert_from' => 'web',
                'milk_pament_date' => date('Y-m-d H:i:s', strtotime($request->milk_pament_date)),
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->milkpaymentsRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Milk Payment insert successfully');

            return redirect('milk-payment/coop-pay-create');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }
}
