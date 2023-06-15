<?php

namespace App\Http\Controllers;

use App\Http\Requests\HealthStoreRequest;
use App\Http\Requests\HealthUpdateRequest;
use App\Repositories\Interfaces\CowRepositoryInterface;
use App\Repositories\Interfaces\HealthRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DataTableRS;
use Illuminate\Http\RedirectResponse;

class HealthController extends Controller
{

    /**
     * @var HealthRepositoryInterface
     */
    protected $healthRepository;

    /**
     *
     * @var CowRepositoryInterface
     */
    protected $cowRepository;


    public function __construct(
        HealthRepositoryInterface $healthRepository,
        CowRepositoryInterface $cowRepository,
    ) {
        $this->healthRepository = $healthRepository;
        $this->cowRepository = $cowRepository;
    }

    public function CreateTreatment()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.health.treatment_cerate', $data);
    }


    public function treatmentStore(HealthStoreRequest $request)
    {
        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['treatment_date']));

            $request_data = [
                'health_category' => "Treatment",
                'diagnosis'  => $request->diagnosis,
                'created_at' => date('Y-m-d H:i:s'),
                'cost'   => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'treatment' => $request->treatment,
                'insert_from' => 'web',
                'treatment_date' => $date,
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->healthRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Health insert successfully');
            return redirect('health-record/create-treatment');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function createVaccine()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.health.vaccine_cerate', $data);
    }


    public function vaccineStore(HealthStoreRequest $request)
    {
        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['treatment_date']));

            $request_data = [
                'health_category' => "Vaccine",
                'diagnosis'  => $request->diagnosis,
                'created_at' => date('Y-m-d H:i:s'),
                'cost'   => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'treatment' => 'vaccine_treatment',
                'insert_from' => 'web',
                'treatment_date' => $date,
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->healthRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Health Record insert successfully');
            return redirect('health-record/create-vaccine');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function createDewormer()
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.health.dewormer_cerate', $data);
    }

    public function dewormerStore(HealthStoreRequest $request)
    {
        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['treatment_date']));

            $request_data = [
                'health_category' => "Dewormer",
                'diagnosis'  => $request->diagnosis,
                'created_at' => date('Y-m-d H:i:s'),
                'cost'   => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'treatment' => 'deworm_treatment',
                'insert_from' => 'web',
                'treatment_date' => $date,
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->healthRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Health Record insert successfully');
            return redirect('health-record/create-vaccine');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function allTreatmentList()
    {

        return view('components.health.treatment_list');
    }


    public function paginatTreatment(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'health_category' => 'Treatment',
        ];
        $result = $this->healthRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }

    public function treatmentRemove(string $treatment_id): RedirectResponse
    {
        $this->healthRepository->destroy($treatment_id);
        Session::flash('message_success', 'health treatment successfully deleted');
        return redirect('health-report/list-treatment');
    }


    public function editTreatment($id)
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'health_category' => 'Treatment',
            'id' => $id,
        ];
        $data['healt'] = $this->healthRepository->getAll($with = [], null, null, null, null, null, $where)['data'][0];

        return view('components.health.treatment_edit', $data);
    }


    public function updateTreatment(HealthUpdateRequest $request, $id)
    {

        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['treatment_date']));

            $request_data = [
                'health_category' => "Treatment",
                'diagnosis'  => $request->diagnosis,
                'created_at' => date('Y-m-d H:i:s'),
                'cost'   => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'treatment' => $request->treatment,
                //'insert_from' => 'web',
                'treatment_date' => $date,
                //'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->healthRepository->createOrUpdate($request_data, $id);

            Session::flash('message_success', 'Health Update successfully');
            return redirect('health-report/list-treatment');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }






    public function allVaccineList()
    {

        return view('components.health.vaccine_list');
    }


    public function paginatVaccine(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'health_category' => 'Vaccine',
        ];
        $result = $this->healthRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }


    public function allDewormerList()
    {

        return view('components.health.dewormer_list');
    }


    public function paginatDewormer(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'health_category' => 'Dewormer',
        ];
        $result = $this->healthRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }


    public function dewormerRemove(string $treatment_id): RedirectResponse
    {
        $this->healthRepository->destroy($treatment_id);
        Session::flash('message_success', 'health dewormer successfully deleted');
        return redirect('health-report/list-dewormer');
    }


    public function editDewormer($id)
    {
        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
            'health_category' => 'Dewormer',
            'id' => $id,
        ];
        $data['dewormer'] = $this->healthRepository->getAll($with = [], null, null, null, null, null, $where)['data'][0];

        return view('components.health.Dewormer_edit', $data);
    }


    public function updateDewormer(HealthUpdateRequest $request, $id)
    {

        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['treatment_date']));

            $request_data = [
                'health_category' => "Dewormer",
                'diagnosis'  => $request->diagnosis,
                'created_at' => date('Y-m-d H:i:s'),
                'cost'   => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'treatment_date' => $date,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->healthRepository->createOrUpdate($request_data, $id);

            Session::flash('message_success', 'Health Update successfully');
            return redirect('health-report/list-dewormer');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }
}
