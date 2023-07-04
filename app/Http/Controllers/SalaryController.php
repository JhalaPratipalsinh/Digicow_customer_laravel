<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryStoreRequest;
use App\Repositories\Interfaces\SalaryRepositoryInterface;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\DataTableRS;

class SalaryController extends Controller
{
    /**
     * @var SalaryRepositoryInterface
     */
    protected $salaryRepository;

    /**
     * @var staffRepositoryInterface
     */
    protected $staffRepository;

    public function __construct(
        SalaryRepositoryInterface $salaryRepository,
        StaffRepositoryInterface $staffRepository
    ) {
        $this->salaryRepository = $salaryRepository;
        $this->staffRepository  = $staffRepository;
    }

    public function createSalary()
    {
        $filter = [
            'mobile_number'  =>  Auth::guard('web')->user()['mobile_number'],
            'status'   =>  'active'
        ];
        $data['staff'] = $this->staffRepository->getAll($with = [], null, null, null, null, null, $filter)['data']->pluck('name', 'id');

        return view('components.salary.create_salary', $data);
    }


    public function salaryStore(SalaryStoreRequest $request)
    {
        try {

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $request_data = [
                'employe_id'  => $request->employee_id,
                'amount'   => $request->amount,
                'date' => $request->date,
                'mobile_number' => $mobile,
                'insert_from' => 'web',
                'created_at' => date('Y-m-d H:i:s'),
            ];

            $this->salaryRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'salary record(s) insert successfully');
            return redirect('salary/create-salary');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function allSalaryList()
    {
        return view('components.salary.salary_list');
    }

    public function paginatSalary(Request $request): JsonResponse
    {
        $where = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $result = $this->salaryRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }

    public function salaryRemove(string $id)
    {
        $request_data = [
            'id' => $id
        ];
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->salaryRepository->createOrUpdate($request_data, $id);

        Session::flash('message_success', 'Salary record removed.');

        return redirect('salary/list-salary');
    }
}
