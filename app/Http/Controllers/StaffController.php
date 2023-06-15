<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffStoreRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Repositories\Interfaces\StaffRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Resources\DataTableRS;
use App\Models\Staff;

class StaffController extends Controller
{

    protected $staffRepository;

    public function __construct(
        StaffRepositoryInterface $staffRepository
    ) {
        $this->staffRepository = $staffRepository;
    }

    public function staffCreate()
    {

        return view('components.staff.create_staff');
    }


    public function staffStore(StaffStoreRequest $request)
    {
        try {

            $mobile = Auth::guard('web')->user()['mobile_number'];
            $request_data = [
                'id_number'  => $request->id_number,
                'location'   => $request->location,
                'name' => $request->name,
                'staff_mobile_number' => $request->staff_mobile_number,
                'mobile_number' => $mobile,
                'status' => 'active',
                //'insert_from' => 'web',
                //'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->staffRepository->createOrUpdate($request_data);
            Session::flash('message_success', 'Stored Staff');
            return redirect('staff/create-staff');
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }

    public function allstaffList()
    {

        $where = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
        ];

        $data['staff'] = $this->staffRepository->getAll([], null, null, null, null, null, $where)['data'];

        return view('components.staff.staff_list',$data);
    }

    public function changeStatus(Request $request)
    {
        $user = Staff::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success'=>'Status change successfully.']);
    }


    public function editStaff($staff_id)
    {
        $where = [
            'mobile_number' =>  Auth::guard('web')->user()['mobile_number'],
            'id' => $staff_id
        ];
        $data['staff'] = $this->staffRepository->getAll([], null, null, null, null, null, $where)['data'][0];

        return view('components.staff.edit_staff' , $data);
    }

    public function updateStaff(StaffUpdateRequest $request , $staff_id){

        try {
            $mobile = Auth::guard('web')->user()['mobile_number'];
            $request_data = [
                'id_number'  => $request->id_number,
                'location'   => $request->location,
                'name' => $request->name,
                'staff_mobile_number' => $request->staff_mobile_number,
                'mobile_number' => $mobile,
                'status' => 'active',
                //'insert_from' => 'web',
                //'sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->staffRepository->createOrUpdate($request_data , $staff_id);
            Session::flash('message_success', 'Update Staff');
            return redirect('staff/staff-list');

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
        }
    }
}
