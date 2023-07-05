<?php

namespace App\Http\Controllers;
use App\Http\Requests\OtherExpenseStoreRequest;
use App\Repositories\Interfaces\OtherExpenseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\DataTableRS;

class OtherExpenseController extends Controller
{
    /**
     * @var OtherExpenseRepositoryInterface
     */
    protected $otherExpenseRepository;

    public function __construct(
        OtherExpenseRepositoryInterface $otherExpenseRepository,
    ) {
        $this->otherExpenseRepository = $otherExpenseRepository;
    }

    public function createIncome()
    {
        return view('components.other_expense.create_other_expense');
    }


    public function storeOtherIncomes(OtherExpenseStoreRequest $request)
    {
        try {

            $mobile = Auth::guard('web')->user()['mobile_number'];

            $request_data = [
                'name'  => $request->name,
                'mobile' => $mobile,
                'amount'   => $request->amount,
                'date_selected' => $request->date_selected,
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->otherExpenseRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Income record inserted successfully.');
            return redirect('other_expenses/create-expense');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function allIncomeList()
    {
        return view('components.other_expense.other_expense_list');
    }

    public function paginatIncome(Request $request): JsonResponse
    {
        $where = [
            'mobile' =>  Auth::guard('web')->user()['mobile_number'],
        ];
        $result = $this->otherExpenseRepository->getAll($with = [], $request->start, $request->rowperpage, $request->columnName, $request->columnSortOrder, $request->searchValue, $where);
        $result['draw'] = $request->draw;
        return response()->json(new DataTableRs($result));
    }

    public function incomeRemove(string $id)
    {
        $request_data = [
            'id' => $id
        ];
        $request_data['deleted_at'] = date('Y-m-d H:i:s');

        $this->otherExpenseRepository->createOrUpdate($request_data, $id);

        Session::flash('message_success', 'Income record removed.');

        return redirect('other_expenses/list-expense');
    }
}
