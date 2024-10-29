<?php

namespace App\Http\Controllers\Sya;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmail;
use App\Mail\IdCardMail;
use App\Models\ApprovalStatus;
use App\Models\CardRequest;
use App\Models\FinalCard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class IdSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = CardRequest::join('approval_status', 'form_no', 'card_requests.id')->
        select('card_requests.id as id', 'approval_status.id as app_id', 'uuid', 'emp_no', 'full_name', 'dept', 'desig', 'mobile', 'receiver', 'stage_name', 'action', 'card_requests.created_at')
            ->where('stage_name','id-section')
            ->get();
//        dd($records);
        return view('pages.id-section.index', compact('records'));
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
                $approval = new ApprovalStatus();
                $approval->form_no = $approval_record->form_no;
                $approval->stage_name = 'gm-security'; //next stage after id-sec
                $approval->sub_to = $request->receiver ?? null;
                $approval->sub_from = \auth()->user()->id;
                $approval->action = 'pending';
                $approval->save();

                DB::commit();

                return redirect()->route('idsection.index')->with('success', 'Submission Successfully forwarded');

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
            ->where('stage_name','id-section')
            ->first();

        $approvals = ApprovalStatus::where('id', $app_id)->first();
        $users = User::orderBy('name')->get();
        return view('pages.id-section.show', compact('form', 'users', 'app_id', 'approvals'));
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
//        dd($request);
        /*Card Requests Table Update*/
        $request->validate([
            'image' => 'required|file|mimes:jpeg,png,jpg|max:248', //248 kilobytes
            'sign' => 'required|file|mimes:jpeg,png,jpg|max:128', //248 kilobytes
            'control_num' => 'required',
            'issue_type' => 'required',
            'new_validity' => 'required',
        ]);

        $card_requests = CardRequest::where('id',$id);
        if($card_requests){
            $imageName = 'img_'.$request->emp_no.'_'.date('Ymd').'.'.$request->image->extension();
            $signName = 'sign_'.$request->emp_no.'_'.date('Ymd').'.'.$request->sign->extension();
            $card_requests->update([
                'control_num' => $request->control_num,
                'new_validity' => $request->new_validity,
                'issue_type' => $request->issue_type,
                'idsec_image_path' => 'id-section/image/' . $imageName,
                'idsec_sign_path' => 'id-section/sign/' . $signName,
                'updated_user' => auth()->user()->id,
            ]);

            $request->image->move(public_path('id-section/image'), $imageName);
            $request->sign->move(public_path('id-section/sign'), $signName);
        }
        return redirect()->back()->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /*
     * Send Email
    */
    public function emailPage(){
        $records = CardRequest::join('approval_status', 'form_no', 'card_requests.id')->
        select('card_requests.id as id', 'approval_status.id as app_id', 'uuid', 'emp_no', 'full_name', 'dept', 'desig', 'mobile','email', 'receiver', 'stage_name', 'action', 'card_requests.created_at')
            ->where('stage_name','id-section')
            ->get();
//        dd($records);
        return view('pages.send-mail',compact('records'));
    }

    public function sendEmail(Request $request)
    {
        /*dd($request);*/
        $details = [
//            'email' => [$request->email_to],
            'email' => ['bgit044@gmail.com'],
            'subject' => $request->subject,
            'body' => $request->body
        ];
//        $status = Mail::to($request->email_to)->send(new IdCardMail($details));
        SendEmail::dispatch($details);
        echo "<h2>MAIL SEND SUCCESS</h2>";
    }
}
