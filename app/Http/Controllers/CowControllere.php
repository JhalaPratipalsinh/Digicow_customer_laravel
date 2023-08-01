<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeadRegisterStoreRequest;
use App\Http\Requests\GeneticRegisterRequest;
use App\Http\Requests\NewRegisterStoreRequest;
use App\Http\Requests\SoldRegisterStoreRequest;
use App\Models\Cow;
use App\Repositories\Interfaces\CowBreedRepositoryinterface;
use App\Repositories\Interfaces\CowGroupRepositoryinterface;
use App\Repositories\Interfaces\CowRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\DataTableRS;
use App\Imports\MyExcelImport;
use Maatwebsite\Excel\Facades\Excel;

class CowControllere extends Controller
{

    /**
     *
     * @var CowRepositoryInterface
     */
    protected $cowRepository;


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
     * @param CowRepositoryInterface $cowRepository
     * @param CowBreedRepositoryInterface $cowBreedRepository
     * @param CowGroupRepositoryInterface $cowGroupRepository
     */

    public function __construct(
        CowRepositoryInterface $cowRepository,
        CowBreedRepositoryinterface $cowBreedRepository,
        CowGroupRepositoryinterface $cowGroupRepository
    ) {
        $this->cowRepository = $cowRepository;
        $this->cowBreedRepository = $cowBreedRepository;
        $this->cowGroupRepository = $cowGroupRepository;
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

        return view('components.cow.newregister', $data);
    }

    public function registerStore(NewRegisterStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $whereforcow = [
                'mobile_number' => Auth::guard('web')->user()['mobile_number'],
                'title' => $request->title
            ];
            $cow = $this->cowRepository->getCowByWhere($whereforcow);

            if ($cow->count() != 0) {
                Session::flash('message_error', 'The cow name is already exist');
                return redirect('cow/new-register');
            }
            $data = [
                'title' => $request->title,
                'breed_id' => $request->breed_id,
                'group_id' => $request->group_id,
                'date_of_birth' => $request->date_of_birth,
                'calving_lactation' => $request->calving_lactation,
                'mobile_number' => $mobile_number,
                'status' => 'active',
               // 'insert_from' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
                'sync_at' => date('Y-m-d H:i:s'),
            ];
            if($request->breed_id == 13){
                $data['cow_breeding_1'] = $request->cow_breeding_1;
                $data['cow_breeding_2'] = $request->cow_breeding_2;
            }

            $result = $this->cowRepository->createOrUpdate($data);

            Session::flash('message_success', 'Stored Cow');
            return redirect('cow/new-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }

    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,csv,txt' // Validate the uploaded file format
        ]);
        $file = $request->file('excel_file'); // Use the correct name 'excel_file'
        $import = new MyExcelImport;

        Excel::import($import, $file);

        return redirect()->back()->with('success', 'Excel file imported and data inserted into the database successfully.');
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
        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.cow.soldregister', $data);
    }

    public function soldRegisterStore(SoldRegisterStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $cowname = Cow::find($request->cow_id);

            $data = ([
                "status" => "sold",
            ]);

            $request_data = [
                'amount' => $request->amount,
                'buyer_name' => $request->buyer_name,
                'phone_number' => $mobile_number,
                'cow_category' => 'cow',
                'insert_from' => 'web',
                'cow_id' => $request->cow_id,
                'cow_name' => $cowname->title,
                'sales_date' => $request->sales_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->cowRepository->createOrUpdate($data, $request->cow_id);
            $result = $this->cowRepository->createOrUpdateSoldCow($request_data);

            Session::flash('message_success', 'Stored Sold-Cow');
            return redirect('cow/sold-register');
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

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.cow.deadregister', $data);
    }

    public function deadRegisterStore(DeadRegisterStoreRequest $request)
    {
        $mobile_number = Auth::guard('web')->user()['mobile_number'];
        try {

            $cowname = Cow::find($request->cow_id);

            $data = ([
                "status" => "dead",
            ]);

            $request_data = [
                'carcass_amount' => $request->carcass_amount,
                'cause_of_death' => $request->cause_of_death,
                'mobile_number' => $mobile_number,
                'cow_category' => 'cow',
                'insert_from' => 'web',
                'cow_id' => $request->cow_id,
                'cow_name' => $cowname->title,
                'death_date' => $request->death_date,
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $result = $this->cowRepository->createOrUpdate($data, $request->cow_id);
            $result = $this->cowRepository->createOrUpdateDeadCow($request_data);

            Session::flash('message_success', 'Stored Dead-Cow');
            return redirect('cow/dead-register');
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

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.cow.geneticregister', $data);
    }

    public function geneticRegisterStore(GeneticRegisterRequest $request)
    {
        try {
            $request_data = [
                'ear_code' => $request->ear_code,
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

            $result = $this->cowRepository->createOrUpdate($request_data, $request->cow_id);
            Session::flash('message_success', 'Update Cow');
            return redirect('cow/genetic-register');
        } catch (Exception $ex) {
            // TODO : Manaage Exceptpion
            DB::rollBack();
            dd($ex);
        }
    }

    public function cowList(){

        return view('components.cow.cowlist');
    }

    /**
     * Paginate list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function paginateCow(Request $request): JsonResponse
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $result = $this->cowRepository->getAll($with = ['breed','group'], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }

    public function deadList(){

        return view('components.cow.deadlist');
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

        $result = $this->cowRepository->getAllDeadCow($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }

    public function deleteDeadCow($id)
    {
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->cowRepository->createOrUpdateDeadCow($request_data, $id);
        Session::flash('message_success', 'Delete Dead Cow');
        return redirect('cow/dead-list');
    }



    public function soldList(){

        return view('components.cow.soldlist');
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

        $result = $this->cowRepository->getAllSoldCow($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }

    public function deleteSoldCow($id)
    {
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->cowRepository->createOrUpdateSoldCow($request_data, $id);
        Session::flash('message_success', 'Delete Sold Cow');
        return redirect('cow/dead-list');
    }


    public function deletedList(){

        return view('components.cow.deletedlist');
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

        $result = $this->cowRepository->getAllDeleteCow($with = ['breed','group'], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $whereforcow);
        $result['draw'] = $request->draw;

        return response()->json(new DataTableRs($result));
    }

}
