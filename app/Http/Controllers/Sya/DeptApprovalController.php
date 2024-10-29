<?php

namespace App\Http\Controllers\Sya;

use App\Http\Controllers\Controller;
use App\Models\ApprovalStatus;
use App\Models\CardRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeptApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = CardRequest::join('approval_status', 'form_no', 'card_requests.id')->
        select('card_requests.id as id', 'approval_status.id as app_id', 'uuid', 'emp_no', 'full_name', 'dept', 'desig', 'mobile', 'receiver', 'stage_name', 'action', 'card_requests.created_at')
            ->where('stage_name','dept-approval')
            ->where('sub_to',\auth()->user()->id)
            ->get();
//        dd($records);
        return view('pages.dept-approval.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $app_id = $request->app_id;
        $approval_record = ApprovalStatus::where('id', $app_id)->first();

        if ($request->action == 'reject') {
            $approval_record->update([
                'action' => 'rejected',
                'remarks' => $request->remarks,
            ]);
            return redirect()->route('deptapproval.index')->with('success', 'Submission Successfully rejected');
        }

        if ($request->action == 'approve') {
            $request->validate([
                'remarks' => 'required',
            ]);

            try {
                DB::beginTransaction();

                $approval_record->update([
                    'action' => 'approved',
                    'remarks' => $request->remarks,
                ]);

                $approval = new ApprovalStatus();
                $approval->form_no = $approval_record->form_no;
                $approval->stage_name = 'id-section'; //next stage after admin-cell
                $approval->sub_to = $request->receiver ?? null;
                $approval->sub_from = \auth()->user()->id;
                $approval->action = 'pending';
                $approval->save();

                DB::commit();

                return redirect()->route('deptapproval.index')->with('success', 'Submission Successfully forwarded');

            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, int $app_id)
    {
        $uuid = $id;
        $form = CardRequest::join('approval_status', 'approval_status.form_no', 'card_requests.id')
            ->where('uuid', $uuid)
            ->where('approval_status.id', $app_id)
            ->select('card_requests.id', 'uuid', 'type',
                'emp_no',
                'full_name',
                'bangla_name',
                'father_name',
                'mother_name',
                'spouse_name',
                'desig',
                'dept',
                'app_date',
                'station',
                'shop_no',
                'loc_no',
                'natl',
                'nid',
                'mobile',
                'pob',
                'dob',
                'bgrp',
                'height',
                'perm_add',
                'curr_add',
                'email',
                'ident_mark',
                'card_val',
                'change_reason',
                'ip_add',
                'receiver',
                'image_path',
                'signature_path',
                'card_requests.created_at',
                'approval_status.id as app_id','approval_status.action','approval_status.remarks')
            ->where('stage_name','dept-approval')
            ->where('sub_to',\auth()->user()->id)
            ->first();
        $approvals = ApprovalStatus::where('id', $app_id)->first();
        $users = User::orderBy('name')->get();
        return view('pages.dept-approval.show', compact('form', 'users', 'app_id', 'approvals'));
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
}
