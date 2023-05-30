<?php

namespace App\Http\Controllers;

use App\Http\Requests\MilkStoreRequest;
use App\Repositories\Interfaces\CowRepositoryInterface;
use App\Repositories\Interfaces\MilkProductionRepositortInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;

class RecordMilkProductionController extends Controller
{

    /**
     *
     * @var CowRepositoryInterface
     */
    protected $cowRepository;

    /**
     * @var MilkProductionRepositoryInterface
     */
    protected $milkproductionRepository;


    /**
     *
     * @param CowRepositoryInterface $cowRepository
     * @param MilkProductionRepositortInterface $milkproductionRepository
     */

    public function __construct(
        CowRepositoryInterface $cowRepository,
        MilkProductionRepositortInterface $milkproductionRepository
    ) {
        $this->cowRepository = $cowRepository;
        $this->milkproductionRepository = $milkproductionRepository;
    }


    public function recordMilkProduction()
    {

        $whereforcow = [
            'mobile_number' => Auth::guard('web')->user()['mobile_number'],
        ];
        $data['cows'] = $this->cowRepository->getCowByWhere($whereforcow);

        return view('components.milkRecord.record-milk-production', $data);
    }



    public function milkStore(Request $request)
    {
        $mobile_no = Auth::guard('web')->user()['mobile_number'];

        if (!empty($request->cow)) {
            for ($i = 0; $i < count($request->cow); $i++) {

                $val = explode("|", $request->cow[$i]);
                $cow_name = $val[0];
                $cow_id  = $val[1];

                //Morning
                if ($request->morning[$i] != null) {
                    $morning = $request->morning[$i];
                    $where = [
                        'cow' =>  $cow_name,
                        'milking_date' => $request->milk_date,
                        'milk_time_id' => 1
                    ];
                    $getall = $this->milkproductionRepository->getAll([],  null, null, null, null, null, $where);

                    if ($getall['total'] == 0) {
                        $request_morning = [
                            'cow_id' => $cow_id,
                            'cow' => $cow_name,
                            'milk_quantity' => $morning,
                            'insert_from' => 'web',
                            "milk_time_id" => 1,
                            "milking_date" => $request->milk_date,
                            "mobile_number" => $mobile_no,
                        ];

                        $this->milkproductionRepository->createOrUpdate($request_morning);
                    } else {
                        Session::flash('message_error', 'Morning Milk Production Already Added');
                        return redirect('record-milk-production/list');
                    }
                }

                //Afternoon
                if ($request->afternoon[$i] != null) {
                    $afternoon = $request->afternoon[$i];

                    $where = [
                        'cow' =>  $cow_name,
                        'milking_date' => $request->milk_date,
                        'milk_time_id' => 2
                    ];
                    $getall = $this->milkproductionRepository->getAll([],  null, null, null, null, null, $where);

                    if ($getall['total'] == 0) {
                        $request_afternoon = [
                            'cow_id' => $cow_id,
                            'cow' => $cow_name,
                            'milk_quantity' => $afternoon,
                            'insert_from' => 'web',
                            "milk_time_id" => 2,
                            "milking_date" => $request->milk_date,
                            "mobile_number" => $mobile_no,
                        ];
                        $this->milkproductionRepository->createOrUpdate($request_afternoon);
                    } else {
                        Session::flash('message_error', 'Afternoon Milk Production Already Added');
                        return redirect('record-milk-production/list');
                    }
                }

                //Evening
                if ($request->evening[$i] != null) {
                    $evening = $request->evening[$i];
                    $where = [
                        'cow' =>  $cow_name,
                        'milking_date' => $request->milk_date,
                        'milk_time_id' => 3
                    ];
                    $getall = $this->milkproductionRepository->getAll([],  null, null, null, null, null, $where);

                    if ($getall['total'] == 0) {
                        $request_evening = [
                            'cow_id' => $cow_id,
                            'cow' => $cow_name,
                            'milk_quantity' => $evening,
                            'insert_from' => 'web',
                            "milk_time_id" => 3,
                            "milking_date" => $request->milk_date,
                            "mobile_number" => $mobile_no,
                        ];
                        $this->milkproductionRepository->createOrUpdate($request_evening);
                    } else {
                        Session::flash('message_error', 'Evening Milk Production Already Added');
                        return redirect('record-milk-production/list');
                    }
                }

                //wholedayg
                if ($request->wholedayg[$i] != null) {
                    $wholedayg = $request->wholedayg[$i];

                    $where = [
                        'cow' =>  $cow_name,
                        'milking_date' => $request->milk_date,
                        'milk_time_id' => 4
                    ];
                    $getall = $this->milkproductionRepository->getAll([],  null, null, null, null, null, $where);

                    if ($getall['total'] == 0) {
                        $request_wholedayg = [
                            'cow_id' => $cow_id,
                            'cow' => $cow_name,
                            'milk_quantity' => $wholedayg,
                            'insert_from' => 'web',
                            "milk_time_id" => 4,
                            "milking_date" => $request->milk_date,
                            "mobile_number" => $mobile_no,
                        ];
                        $this->milkproductionRepository->createOrUpdate($request_wholedayg);
                    } else {
                        Session::flash('message_error', 'Wholedayg Milk Production Already Added');
                        return redirect('record-milk-production/list');
                    }
                }
            }
        } else {
            Session::flash('message_error', 'No Milk production added');
            return redirect('record-milk-production/list');
        }

        Session::flash('message_success', 'Stored Milk Product');
        return redirect('record-milk-production/list');
    }

    public function perCowReport()
    {
        $data['cows'] = $this->cowRepository->getCowByWhere(['mobile_number' => Auth::guard('web')->user()['mobile_number']])->pluck('title', 'id');

        //$data['milk_production'] = $this->milkproductionRepository->getAllMilkProductionReport(['mobile_number' => Auth::guard('web')->user()['mobile_number']])['data'];
        $data['milk_production'] = [];
        return view('components.milkRecord.per-cow', $data);
    }

    public function jsonPerCow(Request $request)
    {
        $data['cow_id'] =  $request->cow_id;
        $data['from_date'] =  $request->from_date;
        $data['to_date'] =  $request->to_date;
        $where = [
            'mobile_number' => Auth::guard('web')->user()['mobile_number'],
            'cow_id' => $request->cow_id,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
        ];

        $data['cows'] = $this->cowRepository->getCowByWhere(['mobile_number' => Auth::guard('web')->user()['mobile_number']])->pluck('title', 'id');

        $data['milk_production'] = $this->milkproductionRepository->getAllMilkProductionReport($where)['data'];
        if(!empty($request->all_cow)){
            return view('components.milkRecord.all-cow', $data);
        }else{
            return view('components.milkRecord.per-cow', $data);
        }

    }

    public function allCowReport()
    {
        $data['cows'] = $this->cowRepository->getCowByWhere(['mobile_number' => Auth::guard('web')->user()['mobile_number']])->pluck('title', 'id');

        $data['milk_production'] = $this->milkproductionRepository->getAllMilkProductionReport(['mobile_number' => Auth::guard('web')->user()['mobile_number']])['data'];
        return view('components.milkRecord.all-cow', $data);
    }
}
