<?php

namespace App\Http\Controllers\Sya;

use App\Http\Controllers\Controller;
use App\Models\ApprovalStatus;
use Illuminate\Http\Request;

class CurrentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = ApprovalStatus::join('card_requests','approval_status.form_no','card_requests.id')->select('form_no','full_name','emp_no','desig','stage_name','action','approval_status.created_at')->groupBy('full_name','emp_no','form_no','desig','stage_name','approval_status.created_at','action')->get();
        /*dd($records);*/
        return view('pages.card-current-status',['records'=>$records]);
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
}
