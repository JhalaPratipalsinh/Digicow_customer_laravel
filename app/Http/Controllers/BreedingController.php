<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtificialStoreRequest;
use App\Repositories\Interfaces\BreedingRepositoryInterface;
use App\Repositories\Interfaces\CowRepositoryInterface;
use App\Repositories\Interfaces\CowBreedRepositoryinterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DateTime;
use DateInterval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\DataTableRS;

class BreedingController extends Controller
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
     * @var BreedingRepositoryInterface
     */
    protected $breedingRepository;

    /**
     *
     * @param CowRepositoryInterface $cowRepository
     * @param CowBreedRepositoryInterface $cowBreedRepository
     * @param BreedingRepositoryInterface $breedingRepository
     */

    public function __construct(
        CowRepositoryInterface $cowRepository,
        CowBreedRepositoryinterface $cowBreedRepository,
        BreedingRepositoryInterface $breedingRepository,
    ) {
        $this->cowRepository = $cowRepository;
        $this->cowBreedRepository = $cowBreedRepository;
        $this->breedingRepository = $breedingRepository;
    }

    public function staffArtificial()
    {
        $cow_breed = $this->cowBreedRepository->getAll($with = [], $start = null, $rawperpage = null, $columnName = null, $columnSortOrder = null, $searchValue = null)['data'];
        $data['breed'] = $cow_breed->pluck('name', 'id');

        $whereforcow = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['cow'] = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title', 'id');

        return view('components.breeding.create_artificial', $data);
    }


    public function artificialStore(ArtificialStoreRequest $request)
    {
        try {
            $whereforcow = [
                'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
                'id'            => $request->cow_id
            ];

            $cow_name = $this->cowRepository->getCowByWhere($whereforcow)->pluck('title');

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $date = date('Y-m-d H:i:s', strtotime($_POST['date']));

            $expected_date_of_birth = new DateTime($date);
            $expected_date_of_birth->add(new DateInterval('P281D'));

            $expected_repeat_date = new DateTime($date);
            $expected_repeat_date->add(new DateInterval('P18D'));

            $expected_drying_date = new DateTime($date);
            $expected_drying_date->add(new DateInterval('P212D'));

            $expected_streaming_date = new DateTime($date);
            $expected_streaming_date->add(new DateInterval('P243D'));

            $expected_confirmation_date = new DateTime($date);
            $expected_confirmation_date->add(new DateInterval('P91D'));

            $first_heat_date = new DateTime($date);
            $first_heat_date->add(new DateInterval('P295D'));

            $second_heat_date = new DateTime($date);
            $second_heat_date->add(new DateInterval('P316D'));

            $request_data = [
                'bull_code'  => $request->bull_code,
                'bull_name'   => $request->bull_name,
                'created_at' => date('Y-m-d H:i:s'),
                'date' =>  date('Y-m-d H:i:s', strtotime($request->date)),
                'cost' => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'no_straw' => $request->no_straw,
                'repeats' => 0,
                'straw_breed' => $request->straw_breed,
                'pg_status' => "0",
                'drying_date' => $expected_drying_date->format('Y-m-d H:i:s'),
                'expected_date_of_birth' => $expected_date_of_birth->format('Y-m-d H:i:s'),
                'expected_repeat_date' => $expected_repeat_date->format('Y-m-d H:i:s'),
                'pregnancy_date' => $expected_confirmation_date->format('Y-m-d H:i:s'),
                'strimingup_date' => $expected_streaming_date->format('Y-m-d H:i:s'),
                'first_heat' => $first_heat_date->format('Y-m-d H:i:s'),
                'second_heat' => $second_heat_date->format('Y-m-d H:i:s'),
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            if($request->straw_breed == 13){
                $data['breed1'] = $request->breed1;
                $data['breed2'] = $request->breed2;
            }
            $this->breedingRepository->createOrUpdate($request_data);

            Session::flash('message_success', 'Breeding insert successfully');
            return redirect('staff/create-staff');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }


    public function allArtificialList(){

        // $where = [
        //     'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        // ];

        // $data['staff'] = $this->staffRepository->getAll([], null, null, null, null, null, $where)['data'];

        return view('components.breeding.artificial_list');
    }

    public function paginatArtificial(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $result = $this->breedingRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }
}
