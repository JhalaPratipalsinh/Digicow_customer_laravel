<?php

namespace App\Http\Controllers;

use App\Http\Requests\CoopStoreRequest;
use App\Http\Requests\CustomerStoreRequest;
use App\Models\MilkProduction;
use App\Repositories\Interfaces\FarmerClientsRepositoryInterface;
use App\Repositories\Interfaces\MilkpaymentsRepositoryInterface;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use App\Repositories\Interfaces\MilksalesRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MilkSalesController extends Controller
{

    /**
     * @var MilkSalesRepositoryInterface
     */
    protected $milksalesRepository;
    protected $farmerclientsRepository;
    protected $milkproductionRepository;
    protected $milkpaymentsRepository;


    public function __construct(
        MilksalesRepositoryInterface $milksalesRepository,
        FarmerClientsRepositoryInterface $farmerclientsRepository,
        MilkProductionRepositortInterface $milkproductionRepository,
        MilkpaymentsRepositoryInterface  $milkpaymentsRepository
    ) {
        $this->milksalesRepository = $milksalesRepository;
        $this->farmerclientsRepository = $farmerclientsRepository;
        $this->milkproductionRepository = $milkproductionRepository;
        $this->milkpaymentsRepository   = $milkpaymentsRepository;
    }
    public function customerCreate()
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'user_type'     =>  1,
        ];

        $data['farmer_client'] = $this->farmerclientsRepository->getAll([], null, null, null, null, null, $filter)['data']->pluck('name', 'id');

        return view('components.milkSales.customer-create', $data);
    }

    public function customerStore(CustomerStoreRequest $request)
    {

        $mobile = Auth::guard('web')->user()['mobile_number'];
        $income = $request->quantity * $request->milk_price;
        try {

            $where = [
                'mobile_number' =>  $mobile,
                'milking_date' =>  $request->milk_sales_date,
            ];
            $getall_milk_production = $this->milkproductionRepository->getAll([], null, null, null, null, null, $where);

            if ($getall_milk_production['total'] == 0) {
                Session::flash('message_error', 'Mobile number and milk sales date not metch');
                return redirect('milk-sales/customer-create');
            }


            if ($getall_milk_production['data']->sum('milk_quantity') >= $request->quantity) {

                $request_data = [
                    'consumer_id' => $request->consumer_id,
                    'created_at' => date('Y-m-d H:i:s'),
                    'consumer_type_id' => 1,
                    'mobile_number' => $mobile,
                    'income' => $income,
                    'insert_from' => 'web',
                    'milk_price' => $request->milk_price,
                    'milk_sales_date' => date('Y-m-d H:i:s', strtotime($request->milk_sales_date)),
                    'milk_time' => $request->milk_time,
                    'quantity' => $request->quantity,
                    'sync_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $this->milksalesRepository->createOrUpdate($request_data);
                Session::flash('message_success', 'Store Milk');
                return redirect('milk-sales/customer-create');
            } else {

                Session::flash('message_error', 'Your milk quantity is higher than you have');
                return redirect('milk-sales/customer-create');
            }
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function coopCreate()
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $filter = [
            'farmer_mobile' =>  $mobile,
            'user_type'     =>  2,
        ];
        $data['farmer_client'] = $this->farmerclientsRepository->getAll([], null, null, null, null, null, $filter)['data']->pluck('name', 'id');
        return view('components.milkSales.coop-create', $data);
    }

    public function coopStore(CoopStoreRequest $request)
    {
        $mobile = Auth::guard('web')->user()['mobile_number'];
        $income = $request->quantity * $request->milk_price;
        try {

            $where = [
                'mobile_number' =>  $mobile,
                'milking_date' =>  $request->milk_sales_date,
            ];
            $getall_milk_production = $this->milkproductionRepository->getAll([], null, null, null, null, null, $where);

            if ($getall_milk_production['total'] == 0) {
                Session::flash('message_error', 'Mobile number and milk sales date not metch');
                return redirect('milk-sales/coop-create');
            }


            if ($getall_milk_production['data']->sum('milk_quantity') >= $request->quantity) {


                $request_data = [
                    'consumer_id'  => $request->consumer_id,
                    'consumer_type_id' => 2,
                    'created_at' => date('Y-m-d H:i:s'),
                    'mobile_number' => $mobile,
                    'income' => $income,
                    'insert_from' => 'web',
                    'milk_price' => $request->milk_price,
                    'milk_sales_date' => date('Y-m-d H:i:s', strtotime($request->milk_sales_date)),
                    'milk_time' => $request->milk_time,
                    'quantity' => $request->quantity,
                    'sync_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->milksalesRepository->createOrUpdate($request_data);
                Session::flash('message_success', 'Milk Sales insert successfully');
                return redirect('milk-sales/coop-create');
            } else {

                Session::flash('message_error', 'Your milk quantity is higher than you have');
                return redirect('milk-sales/customer-create');
            }
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function allCustomerList(){

        $mobile = Auth::guard('web')->user()['mobile_number'];

        $where = [
            'mobile_number' =>  $mobile,
            'consumer_type_id' =>  1,
        ];

       $data['milk_sale'] = $this->milksalesRepository->getAll([''], null, null, null, null, null, $where)['data'];

       $data['payment'] =  $this->milkpaymentsRepository->getAll([''], null, null, null, null, null, $where)['data'];

        // foreach ($milk_sale as $key => $milk) {

        //     $where = [
        //         'mobile_number' =>  $mobile,
        //         'milk_pament_date' =>  $milk['milk_sales_date'],
        //     ];

        //    $payment[] =  $this->milkpaymentsRepository->getAll([''], null, null, null, null, null, $where)['data'];

        // }



        //$data = array_merge(collect($milk_sale), $payment);
       return view('components.milkSales.all_customer',$data);

    }
}
