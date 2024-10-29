@csrf

<input name="app_id" value="{{$app_id}}" hidden>
<input name="emp_no" value="{{$form->emp_no}}" hidden>

<h4 class="card-title" style="text-decoration: underline grey ">User Form</h4>

<div class="col-6 mb-3">
    <label for="image" class="form-label"> Image</label>
    <img src="{{asset($form->image_path)}}" alt="Preview" style="display: block; max-width: 40%; margin-top: 10px;">
</div>

<div class="col-6 mb-3">
    <label for="signature" class="form-label"> Signature</label>
    <img src="{{asset($form->signature_path)}}" alt="NoPhotoFound..." style="display: block; max-width: 50%; margin-top: 10px;">
</div>

<div class="col-md-4">
    <label>Emp Type</label><span class="text-danger">*</span>
    <input id="type" name="type" type="text" value="{{$form->type}}" class="form-control" disabled>
</div>
<div class="col-md-4">
    <label>PG Number</label><span class="text-danger">*</span>
    <input id="emp_no" name="emp_no" type="number" value="{{$form->emp_no}}" class="form-control" disabled>
</div>
<div class="col-4">
    <label>Full Name</label><span class="text-danger">*</span>
    <input id="full_name" name="full_name" type="text" value="{{$form->full_name}}" class="form-control" disabled>
</div>
<div class="col-4">
    <label>Bangle Name</label><span class="text-danger">*</span>
    <input id="bangleName" name="bangla_name" type="text" value="{{$form->bangla_name}}" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Father's Name</label><span class="text-danger">*</span>
    <input id="fatherName" name="father_name" type="text" value="{{$form->father_name}}" class="form-control" disabled>
</div>
<div class="col-4">
    <label>Mother's Name</label><span class="text-danger">*</span>
    <input id="motherName" name="mother_name" type="text" value="{{$form->mother_name}}" class="form-control" disabled>
</div>
<div class="col-4">
    <label>Spouse's Name</label>
    <input id="spouseName" name="spouse_name" type="text" value="{{$form->spouse_name}}" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Designation</label><span class="text-danger">*</span>
    <input id="desig" name="desig" value="{{$form->desig}}" type="text" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Department</label><span class="text-danger">*</span>
    <input id="dept" name="dept" value="{{$form->dept}}" type="text" class="form-control" disabled>
</div>

<div class="col-4">
    <label for="example-flatpickr-custom">Appointment Date</label><span class="text-danger">*</span>
    <input type="date" class="form-control datetimepicker" id="app_date" name="app_date" placeholder="d-m-Y" data-date-format="d-M-Y" value="{{$form->app_date}}" disabled>
</div>

<div class="col-4">
    <label>Station</label><span class="text-danger">*</span>
    <input id="station" name="station" value="{{$form->station}}" type="text" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Shop_no</label><span class="text-danger">*</span>
    <input id="shop_no" name="shop_no" value="{{$form->shop_no}}" type="text" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Location No</label><span class="text-danger">*</span>
    <input id="loc_no" name="loc_no" value="{{$form->loc_no}}" type="text" class="form-control" disabled>
</div>


<div class="col-4">
    <label>Nationality</label><span class="text-danger">*</span>
    <input id="natl" name="natl" type="text" class="form-control" value="{{$form->natl}}" placeholder="" disabled>
</div>
<div class="col-4">
    <label>National ID Card no.</label><span class="text-danger">*</span>
    <input id="nid" name="nid" type="number" placeholder="" value="{{$form->nid}}" class="form-control" disabled>
</div>
<div class="col-4">
    <label>Mobile Number (11 Digit)</label><span class="text-danger">*</span>
    <input id="mobile" name="mobile" type="text" minlength="11"
           maxlength="11" placeholder="017xxx" value="{{$form->mobile}}" class="form-control" disabled>
</div>

<div class="col-4">
    <label>Place of Birth</label><span class="text-danger">*</span>
    <input id="pob" name="pob" type="text" value="{{$form->pob}}" class="form-control" disabled>
</div>

<div class="col-4">
    <label for="example-flatpickr-custom">Date of Birth</label><span class="text-danger">*</span>
    <input type="date" class="form-control datetimepicker" id="dob" name="dob" placeholder="d-m-Y" data-date-format="d-m-Y" value="{{$form->dob}}" disabled>
</div>

<div class="col-4">
    <label for="example-flatpickr-custom">Date of Birth</label><span class="text-danger">*</span>
    <input type="text" class="form-control datetimepicker" id="bgrp" name="bgrp" value="{{$form->bgrp}}" disabled>
</div>


<div class="col-2">
    <label>Height(cm)</label><span class="text-danger">*</span>
    <input id="height" name="height" type="number" value="{{$form->height}}" class="form-control" disabled>
</div>

<div class="col-6">
    <label>Full Permanent Address</label><span class="text-danger">*</span>
    <input id="perm_add" name="perm_add" type="text" value="{{$form->perm_add}}" class="form-control" disabled>
</div>
<div class="col-6">
    <label>Full Present/Local/Mailing Address</label><span class="text-danger">*</span>
    <input id="curr_add" name="curr_add" type="text" value="{{$form->curr_add}}" class="form-control" disabled>
</div>

<div class="col-6">
    <label>Email Address</label><span class="text-danger">*</span>
    <input id="email" name="email" type="email" value="{{$form->email}}" class="form-control" disabled>
</div>
<div class="col-6">
    <label>Identification mark (if any)</label>
    <input id="ident_mark" name="ident_mark" value="{{$form->ident_mark}}" type="text" class="form-control" disabled>
</div>

<div class="col-4">
    <label for="example-flatpickr-custom">Validity of current card</label>
    <input type="date" class="form-control datetimepicker" id="card_val" name="card_val" placeholder="d-m-Y" data-date-format="d-m-Y" value="{{$form->card_valcard_val}}" disabled>
</div>

<div class="col-8">
    <label>Reason for requesting new ID card</label><span class="text-danger">*</span>
    <input id="change_reason" name="change_reason" value="{{$form->change_reason}}" type="text" class="form-control" disabled>
</div>

<hr>

<div class="custom-control custom-checkbox">
    <label class="custom-control-label" >Remarks on your approval or rejection<span class="text-danger">*</span></label>
    <textarea type="text" class="form-control" id="remarks" name="remarks" placeholder="Example: All information is valid or Information is wrong please submit again" required></textarea>
</div>

@if($form->stage_name=='admin-cell')
    <div class="col-4">
        <label for="">Send To/Receiver (required)<span class="text-danger">*</span></label>
        <select class="form-control" id="receiver" name="receiver" required>
            <option selected disabled>---Select User to Send---</option>
            @foreach ($users as $user)
                <option value={{$user->id}}>{{$user->name}}-{{$user->email}}</option>
            @endforeach
        </select>
    </div>
@endif


<div class="col-sm-8 col-lg-8 col-lx-4 d-flex">
    @if($form->action == 'approved')
        <h5 class="text-danger"> This is application has been approved already.</h5>
    @elseif($form->action == 'rejected')
        <h5 class="text-danger"> This is application has been rejected already.</h5>
    @else
        <button type="submit" value="approve" name="action" class="btn btn-rounded btn-success w-50 m-2"><i class="fa fa-paper-plane"></i>
            Approve
        </button>
        <button type="submit" value="reject" name="action" class="btn btn-rounded btn-danger w-50 m-2"><i class="fa fa-paper-plane"></i> Reject</button>
    @endif

</div>

