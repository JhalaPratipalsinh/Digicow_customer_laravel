<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedGrassStoreRequest;
use App\Http\Requests\FeedHayStoreRequest;
use App\Http\Requests\FeedMineralsStoreRequest;
use App\Http\Requests\FeedOtherStoreRequest;
use App\Http\Requests\FeedStoreRequest;
use App\Http\Requests\StockStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\FeedingRepositoryInterface;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DataTableRS;

class StockController extends Controller
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

    public function stockCreate()
    {

        return view('components.Stock.stock-consum-conce');
    }

    public function stockStore(StockStoreRequest $request)
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
                'type' => "Stock",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored stock');
            return redirect('feed/stock-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function stockMineralsCreate()
    {

        return view('components.Stock.stock-consum-minerals');
    }


    public function stockMineralsStore(FeedMineralsStoreRequest $request)
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

            Session::flash('message_success', 'Stored Stock Minerals');
            return redirect('feed/stock-minerals-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }

    public function stockBasalCreate()
    {
        return view('components.Stock.stock-consum-basal');
    }

    public function stockConsumGrassCreate()
    {
        return view('components.Stock.stock-consum-grass');
    }


    public function stockGrassStore(FeedGrassStoreRequest $request)
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
                'type' => "Stock",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored Stock Basal');
            return redirect('feed/stock-consum-grass-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function stockConsumHayCreate()
    {
        return view('components.Stock.stock-consum-hay');
    }

    public function stockHayStore(FeedHayStoreRequest $request)
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
                'type' => "Stock",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored Stock Hay');
            return redirect('feed/stock-consum-hay-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function stockConsumOtherCreate()
    {
        return view('components.Stock.stock-consum-other');
    }

    public function stockOtherStore(FeedOtherStoreRequest $request)
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
                'type' => "Stock",
                'date_selected' => date('Y-m-d H:i:s', strtotime($request->date_selected)) . ".000"
            ];

            $this->feedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Stored stock Basal');
            return redirect('feed/stock-consum-other-create');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }
}
