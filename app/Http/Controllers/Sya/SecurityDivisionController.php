<?php

namespace App\Http\Controllers\Sya;

use App\Http\Controllers\Controller;
use App\Models\ApprovalStatus;
use App\Models\CardRequest;
use App\Models\FinalCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecurityDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = CardRequest::join('approval_status', 'form_no', 'card_requests.id')->
        select('card_requests.id as id', 'approval_status.id as app_id', 'uuid', 'emp_no', 'full_name', 'dept', 'desig', 'mobile', 'receiver', 'stage_name', 'action', 'card_requests.created_at')
            ->where('stage_name','gm-security')
            ->get();
//        dd($records);
        return view('pages.gm-security.index', compact('records'));
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
            return redirect()->route('idsection.index')->with('success', 'Submission Successfully rejected');
        }

        if ($request->action == 'approve') {
            $request->validate([
                'remarks' => 'required',
            ]);

            try {
                DB::beginTransaction();

                /*Approval Status Table*/

                $approval_record->update([
                    'action' => 'approved',
                    'remarks' => $request->remarks,
                ]);

                $card_request = CardRequest::where('id',$approval_record->form_no)->first();

                $data = new FinalCard();
                $data->uuid = $card_request->uuid;
                $data->control_num = $card_request->control_num;
                $data->new_validity = $card_request->new_validity;
                $data->issue_type = $card_request->issue_type;
                $data->idsec_image_path = $card_request->new_validity;
                $data->idsec_sign_path = $card_request->new_validity;
                $data->authority_remarks = $card_request->new_validity;
                $data->updated_user = $card_request->updated_user;
                $data->type = $card_request->type;
                $data->emp_no = $card_request->emp_no;
                $data->full_name = $card_request->full_name;
                $data->bangla_name = $card_request->bangla_name;
                $data->father_name = $card_request->father_name;
                $data->mother_name = $card_request->mother_name;
                $data->spouse_name = $card_request->spouse_name;
                $data->desig = $card_request->desig;
                $data->dept = $card_request->dept;
                $data->app_date = $card_request->app_date;
                $data->station = $card_request->station;
                $data->shop_no = $card_request->shop_no;
                $data->loc_no = $card_request->loc_no;
                $data->natl = $card_request->natl;
                $data->nid = $card_request->nid;
                $data->mobile = $card_request->mobile;
                $data->pob = $card_request->pob;
                $data->dob = $card_request->dob;
                $data->bgrp = $card_request->bgrp;
                $data->height = $card_request->height;
                $data->perm_add = $card_request->perm_add;
                $data->curr_add = $card_request->curr_add;
                $data->email = $card_request->email;
                $data->ident_mark = $card_request->ident_mark;
                $data->card_val = $card_request->card_val;
                $data->change_reason = $card_request->change_reason;
                $data->ip_add = $card_request->ip_add;
                $data->receiver = $card_request->receiver;
                $data->image_path = $card_request->image_path;
                $data->signature_path = $card_request->signature_path;
                $data->save();

                DB::commit();

                return redirect()->route('gmsecurity.index')->with('success', 'Submission Successfully forwarded');

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
                'control_num',
                'issue_type',
                'new_validity',
                'idsec_image_path',
                'idsec_sign_path',
                'card_requests.created_at',
                'approval_status.id as app_id','approval_status.action','approval_status.remarks')
            ->where('stage_name','gm-security')
            ->first();

        $approvals = ApprovalStatus::where('id', $app_id)->first();
        $users = User::orderBy('name')->get();
        return view('pages.gm-security.show', compact('form', 'users', 'app_id', 'approvals'));
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
