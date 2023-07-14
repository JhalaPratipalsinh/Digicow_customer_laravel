<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeadCalfRegisterSroreRequest;
use App\Http\Requests\GeneticcalfRegisterRequest;
use App\Http\Requests\NewCalfRegisterStoreRequest;
use App\Http\Requests\SoldCalfRegisterSroreRequest;
use App\Http\Resources\DataTableRS;
use App\Models\Calf;
use App\Repositories\Interfaces\CalfRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\CowBreedRepositoryinterface;
use App\Repositories\Interfaces\CowGroupRepositoryinterface;
use App\Repositories\Interfaces\CowRepositoryInterface;

class CowCalfController extends Controller
{

     /**
     *
     * @var CowBreedRepositoryInterface
     */
    protected $cowBreedRepository;

    /**
     *
     * @var CowGroupRepositoryInterface
     */
    protected $cowGroupRepository;

    /**
     *
     * @var CalfRepositoryInterface
     */
    protected $calfRepository;

     /**
     *
     * @var CowRepositoryInterface
     */
    protected $cowRepository;

    /**
     *
     * @param CowBreedRepositoryInterface $cowBreedRepository
     * @param CowGroupRepositoryInterface $cowGroupRepository
     * @param CalfRepositoryInterface $calfRepository
     * @param CowRepositoryInterface $cowRepository
     */

    public function __construct(
        CowBreedRepositoryinterface $cowBreedRepository,
        CowGroupRepositoryinterface $cowGroupRepository,
        CalfRepositoryInterface     $calfRepository,
        CowRepositoryInterface      $cowRepository,
    ) {
        $this->cowBreedRepository = $cowBreedRepository;
        $this->cowGroupRepository = $cowGroupRepository;
        $this->calfRepository = $calfRepository;
        $this->cowRepository = $cowRepository;
    }


    /**
     * Load View
     *
     * @return View
     */
    public function newRegister()
    {
        $cow_breed = $this->cowBreedRepository->getAll($with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null)['data'];
        $data['breed'] = $cow_breed->pluck('name', 'id');

        $cow_breed = $this->cowGroupRepository->getAll($with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null)['data'];
        $data['group'] = $cow_breed->pluck('name', 'id');

        return view('components.calf.newcalfregister',$data);
    }

    public function registerStore(NewCalfRegisterStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $whereforcow = [
                'mobile_number' => Auth::guard('web')->user()['mobile_number'],
                'calf_name' => $request->calf_name
            ];
            $calf = $this->calfRepository->getCalfByWhere($whereforcow);

            if ($calf->count() != 0) {
                Session::flash('message_error', 'The calf name is already exist');
                return redirect('calfs/new-register');
            }
            $data = [
                'sid' => ' ',
                'calf_code' => '',
                'expected_mature_date' => date('Y-m-d H:i:s'),
                'breed_id' => $request->breed_id,
                'calf_weight' => $request->calf_weight,
                'd_o_b' => $request->d_o_b,
                'sex' => $request->sex,
                'calf_name' => $request->calf_name,
                'mobile_number' => $mobile_number,
                'status' => 'active',
                'insert_from' => 'web excel',
                'created_at' => date('Y-m-d H:i:s'),
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if($request->breed_id == 13){
                $data['cow_breeding_1'] = $request->cow_breeding_1;
                $data['cow_breeding_2'] = $request->cow_breeding_2;
            }

            $result = $this->calfRepository->createOrUpdate($data);

            Session::flash('message_success', 'Stored Calf');
            return redirect('calfs/new-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }

    /**
     * Load View
     *
     * @return View
     */
    public function soldRegister()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $data['cow'] = $this->calfRepository->getCalfByWhere($whereforcow)->pluck('calf_name', 'id');

        return view('components.calf.soldcalfregister', $data);
    }

    public function soldRegisterStore(SoldCalfRegisterSroreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $cowname = Calf::find($request->cow_id);

            $data = ([
                "status" => "sold",
            ]);

            $request_data = [
                'amount' => $request->amount,
                'buyer_name' => $request->buyer_name,
                'phone_number' => $mobile_number,
                'cow_category' => 'calf',
                'insert_from' => 'web',
                'cow_id' => $request->cow_id,
                'cow_name' => $cowname->calf_name,
                'sales_date' => $request->sales_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->calfRepository->createOrUpdate($data, $request->cow_id);
            $result = $this->cowRepository->createOrUpdateSoldCow($request_data);

            Session::flash('message_success', 'Stored Sold-calf');
            return redirect('calfs/sold-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    /**
     * Load View
     *
     * @return View
     */
    public function deadRegister()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->calfRepository->getCalfByWhere($whereforcow)->pluck('calf_name', 'id');

        return view('components.calf.deadcalfregister', $data);
    }

    public function deadRegisterStore(DeadCalfRegisterSroreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $cowname = Calf::find($request->cow_id);

            $data = ([
                "status" => "dead",
            ]);

            $request_data = [
                'carcass_amount' => $request->carcass_amount,
                'cause_of_death' => $request->cause_of_death,
                'mobile_number' => $mobile_number,
                'cow_category' => 'calf',
                'insert_from' => 'web',
                'cow_id' => $request->cow_id,
                'cow_name' => $cowname->calf_name,
                'death_date' => $request->death_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->calfRepository->createOrUpdate($data, $request->cow_id);
            $result = $this->cowRepository->createOrUpdateDeadCow($request_data);

            Session::flash('message_success', 'Stored Dead-Calf');
            return redirect('calfs/dead-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


     /**
     * Load View
     *
     * @return View
     */
    public function geneticRegister()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->calfRepository->getCalfByWhere($whereforcow)->pluck('calf_name', 'id');

        return view('components.calf.geneticcalfregister', $data);
    }

    public function geneticRegisterStore(GeneticcalfRegisterRequest $request)
    {
        try {
            $request_data = [
                'calf_code' => $request->calf_code,
                'dam' => $request->dam,
                'dam_code' => $request->dam_code,
                'dam_father' => $request->dam_father,
                "dam_father_code" => $request->dam_father_code,
                "dam_id" => $request->dam_id,
                "dam_mother" => $request->dam_mother,
                "dam_mother_code" => $request->dam_mother_code,
                "sire" => $request->sire,
                "sire_code" => $request->sire_code,
                "sire_father" => $request->sire_father,
                "sire_father_code" => $request->sire_father_code,
                "sire_mother" => $request->sire_mother,
                "sire_mother_code" => $request->sire_mother_code,
            ];

            $result = $this->calfRepository->createOrUpdate($request_data, $request->cow_id);
            Session::flash('message_success', 'Update Cow');
            return redirect('cow/genetic-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }


    public function cowList(){

        return view('components.calf.calflist');
    }

    /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginateCalf(Request $request): JsonResponse
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $result = $this->calfRepository->getAll($with = ['breed','group'], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRS($result));
    }

    public function deleteActiveCalf($id)
    {
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->calfRepository->createOrUpdate($request_data, $id);
        Session::flash('message_success', 'Active Calf deleted');
        return redirect('calfs/list');
    }


    public function deadList(){

        return view('components.calf.deadcalflist');
    }

    /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginateDead(Request $request): JsonResponse
    {

        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $result = $this->calfRepository->getAllDeadCow($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }

    public function deleteDeadCow($id)
    {
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->calfRepository->createOrUpdateDeadCow($request_data, $id);
        Session::flash('message_success', 'Dead Calf Deleted');
        return redirect('calfs/dead-list');
    }


    public function soldList(){

        return view('components.calf.soldcalflist');
    }

    /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginateSold(Request $request): JsonResponse
    {

        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $result = $this->calfRepository->getAllSoldCow($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }

    public function deleteSoldCow($id)
    {
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->calfRepository->createOrUpdateSoldCow($request_data, $id);
        Session::flash('message_success', 'Sold Calf Deleted');
        return redirect('calfs/sold-list');
    }


    public function deletedList(){

        return view('components.calf.deletedlist');
    }

    /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginateDeleted(Request $request): JsonResponse
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $result = $this->calfRepository->getAllDeleteCow($with = ['breed','group'], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }





}
