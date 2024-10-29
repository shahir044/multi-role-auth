<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ApprovalStatus;
use App\Models\CardRequest;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Location;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use PHPUnit\Logging\Exception;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depts = Department::orderBy('name')->get();
        $shops = Department::orderBy('dept_no')->get();
        $desgs = Designation::orderBy('name')->get();
        $locs = Location::orderBy('location_no')->get();
        $stats = Location::orderBy('name_en')->get();
        $users = User::join('model_has_roles','model_id','users.id')->join('roles','roles.id','role_id')->where('roles.name','=','admin-cell')->orderBy('roles.name')->get(['users.id','users.name','users.email']);
        return view("user.idcard_form",compact('depts','shops','desgs','locs','stats','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'emp_no' => 'required',
            'full_name' => 'required',
            'bangla_name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'spouse_name' => 'nullable',
            'desig' => 'required',
            'dept' => 'required',
            'app_date' => 'required|date',
            'station' => 'required',
            'shop_no' => 'required',
            'loc_no' => 'required',
            'natl' => 'required',
            'nid' => 'required',
            'mobile' => 'required',
            'pob' => 'required',
            'dob' => 'required|date',
            'bgrp' => 'required',
            'height' => 'required|integer',
            'perm_add' => 'required',
            'curr_add' => 'required',
            'email' => 'required|email',
            'ident_mark' => 'nullable',
            'card_val' => 'nullable|date',
            'change_reason' => 'required',
            'receiver' => 'required',
            'image' => 'required|file|mimes:jpeg,png,jpg|max:248', //248 kilobytes
            'signature' => 'required|file|mimes:jpeg,png,jpg|max:128', //128 kilobytes
        ]);


        $imageName = 'img'.$request->emp_no.'_'.date('Ymd').'.'.$request->image->extension();
        $signatureName = 'sign'.$request->emp_no.'_'.date('Ymd').'.'.$request->signature->extension();

        $validatedData['image_path'] = 'user/images/' . $imageName;
        $validatedData['signature_path'] = 'user/signatures/' . $signatureName;
        $validatedData['uuid'] = Str::uuid();

        try {
            DB::beginTransaction();
            $record = CardRequest::create($validatedData);
            $result = $this->storeToApprovalTable($record);

            if ($result) {
                $request->image->move(public_path('user/images'), $imageName);
                $request->signature->move(public_path('user/signatures'), $signatureName);
                DB::commit();

                return redirect()->route('user.form')->with('success','Form Submission Sucessful');
            }else{
                DB::rollBack();
                return redirect()->route('user.form')->with('message','Sorry, Something went wrong!...');
            }

        }catch (\Exception $e){
            throw new Exception($e->getMessage(),Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function formatDate($date){ // $date (yyyy-mm-dd) => dd-mm

    }

    private function storeToApprovalTable($record){
        $approvalStatus = new ApprovalStatus();
        $approvalStatus->form_no = $record->id;
        $approvalStatus->stage_name = 'admin-cell';
        $approvalStatus->sub_to = $record->receiver;
        $approvalStatus->sub_from = $record->emp_no;
        $approvalStatus->action = 'pending';
        return $approvalStatus->save();
    }

    public function currentStatusIndex()
    {
        $records = [];
        /*dd($records);*/
        return view('user.current_status',['records'=>$records]);
    }

    public function currentStatusPost(Request $request)
    {
        $records = ApprovalStatus::join('card_requests','approval_status.form_no','card_requests.id')->select('form_no','full_name','emp_no','desig','stage_name','action','approval_status.created_at')->where('emp_no',$request->emp_no)->groupBy('full_name','emp_no','form_no','desig','stage_name','approval_status.created_at','action')->get();
        /*dd($records);*/
        return view('user.current_status',['records'=>$records]);
    }
}
