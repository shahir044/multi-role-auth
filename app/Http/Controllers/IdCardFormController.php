<?php

namespace App\Http\Controllers;

use App\Models\CardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdCardFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $roles = $user->getRoleNames();
        $stageName = null;
        $userId = $user->id;

        if ($user->hasAnyRole('admin-cell')) $stageName='admin-cell';
        if ($user->hasAnyRole('dept-approval')) $stageName='dept-approval';

        $records = CardRequest::join('approval_status','form_no','card_requests.id')
                    ->select('card_requests.id','emp_no','full_name','dept','desig','mobile','stage_name','card_requests.created_at')->where('stage_name',$stageName)->where('sub_to',$user->id)->get();

        return view('pages.idcard-form.index',compact('records'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $form = CardRequest::where('id',$id)->first();
        return view('pages.idcard-form.show',compact('form'));
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
