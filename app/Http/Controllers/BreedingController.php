<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtificialStoreRequest;
use App\Repositories\Interfaces\BreedingRepositoryInterface;
use App\Repositories\Interfaces\CowRepositoryInterface;
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
     * @var BreedingRepositoryInterface
     */
    protected $breedingRepository;

    /**
     *
     * @param CowRepositoryInterface $cowRepository
     * @param BreedingRepositoryInterface $breedingRepository
     */

    public function __construct(
        CowRepositoryInterface $cowRepository,
        BreedingRepositoryInterface $breedingRepository,
    ) {
        $this->cowRepository = $cowRepository;
        $this->breedingRepository = $breedingRepository;
    }

    public function staffArtificial()
    {
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
            $expected_drying_date->add(new DateInterval('P210D'));

            $expected_streaming_date = new DateTime($date);
            $expected_streaming_date->add(new DateInterval('P221D'));

            $expected_confirmation_date = new DateTime($date);
            $expected_confirmation_date->add(new DateInterval('P90D'));

            $request_data = [
                'bull_code'  => $request->bull_code,
                'bull_name'   => $request->bull_name,
                'created_at' => date('Y-m-d H:i:s'),
                'date' =>  date('Y-m-d H:i:s', strtotime($request->date)),
                'cost' => $request->cost,
                'cow_id' => $request->cow_id,
                'cow_name' => $cow_name[0],
                'mobile' => $mobile,
                'repeats' => 0,
                'insert_from' => 'web',
                'pg_status' => "0",
                'drying_date' => $expected_drying_date->format('Y-m-d H:i:s'),
                'expected_date_of_birth' => $expected_date_of_birth->format('Y-m-d H:i:s'),
                'expected_repeat_date' => $expected_repeat_date->format('Y-m-d H:i:s'),
                'pregnancy_date' => $expected_confirmation_date->format('Y-m-d H:i:s'),
                'strimingup_date' => $expected_streaming_date->format('Y-m-d H:i:s'),
                'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

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
