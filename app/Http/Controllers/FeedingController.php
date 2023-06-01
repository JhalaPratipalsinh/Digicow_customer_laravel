<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedGrassStoreRequest;
use App\Http\Requests\FeedHayStoreRequest;
use App\Http\Requests\FeedMineralsStoreRequest;
use App\Http\Requests\FeedOtherStoreRequest;
use App\Http\Requests\FeedStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\FeedingRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DataTableRS;

class FeedingController extends Controller
{
    /**
     * @var FeedingRepositoryInterface
     */
    protected $feedingRepository;

    public function __construct(
        FeedingRepositoryInterface $feedingRepository
    ) {
        $this->feedingRepository = $feedingRepository;
    }

    public function feedCreate()
    {

        return view('components.Feeding.feed-consum-conce');
    }

    public function feedStore(FeedStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {
            $request_data = [
                'category' => "Concentrates",
                'created_at' => date('Y-m-d H:i:s'),
                'mobile' => $mobile_number,
                'feed' => $request->feed,
                'insert_from' => 'web',
                'quantity' => $request->quantity,
                'total' => $request->total,
                'type' => "Consumption",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored feeding');
            return redirect('feeding/feed-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function feedMineralsCreate()
    {

        return view('components.Feeding.feed-consum-minerals');
    }


    public function feedMineralsStore(FeedMineralsStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {
            $request_data = [
                'category' => "Minerals and Others",
                'units' => $request->units,
                'created_at' => date('Y-m-d H:i:s'),
                'mobile' => $mobile_number,
                'feed' => $request->feed,
                'insert_from' => 'web',
                'quantity' => $request->quantity,
                'total' => $request->total,
                'type' => "Consumption",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored feed Minerals');
            return redirect('feeding/feed-minerals-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }

    public function feedBasalCreate()
    {
        return view('components.Feeding.feed-consum-basal');
    }

    public function feedConsumGrassCreate()
    {
        return view('components.Feeding.feed-consum-grass');
    }


    public function feedGrassStore(FeedGrassStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {
            $request_data = [
                'category' => "Basal",
                'created_at' => date('Y-m-d H:i:s'),
                'mobile' => $mobile_number,
                'feed' => 'NapierGrass',
                'insert_from' => 'web',
                'quantity' => 0,
                'total' => $request->total,
                'type' => "Consumption",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored feed Basal');
            return redirect('feeding/feed-consum-grass-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function feedConsumHayCreate()
    {
        return view('components.Feeding.feed-consum-hay');
    }

    public function feedHayStore(FeedHayStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {
            $request_data = [
                'category' => "Basal",
                'created_at' => date('Y-m-d H:i:s'),
                'mobile' => $mobile_number,
                'feed' => 'Hay',
                'insert_from' => 'web',
                'quantity' => $request->quantity,
                'total' => $request->total,
                'type' => "Consumption",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored feed Hay');
            return redirect('feeding/feed-consum-hay-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function feedConsumOtherCreate()
    {
        return view('components.Feeding.feed-consum-other');
    }

    public function feedOtherStore(FeedOtherStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {
            $request_data = [
                'category' => "Basal",
                'created_at' => date('Y-m-d H:i:s'),
                'mobile' => $mobile_number,
                'feed' => $request->feed,
                'insert_from' => 'web',
                'quantity' => $request->quantity,
                'total' => $request->total,
                'type' => "Consumption",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored feed Basal');
            return redirect('feeding/feed-consum-other-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function feedReportList(){
        return view('components.Feeding.feed-Report-list');
    }

     /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginatFeeedReport(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'type' =>  'Consumption',
        ];
        $result = $this->feedingRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
         $result['draw'] = $request->draw;

         //dd($result);
        return response()->json(new DataTableRs($result));
    }


}
