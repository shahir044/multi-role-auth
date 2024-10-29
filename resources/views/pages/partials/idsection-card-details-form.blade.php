@csrf

<input name="form_no" value="{{$form->id}}" hidden>
<div>
    <h5 class="card-title" style="text-decoration: underline grey">For ID Section Official Use</h5>
</div>
<div class="col-4">
    <label>Control Number (14 Digit)</label><span class="text-danger">*</span>
    <input id="control_num" name="control_num" type="text" class="form-control" value="{{$form->control_num}}" maxlength="14" minlength="14" required >
</div>
<div class="col-4">
    <label for="example-flatpickr-custom">Validity of New Card</label><span class="text-danger">*</span>
    <input type="date" class="form-control datetimepicker" id="new_validity" name="new_validity"  value="{{$form->new_validity}}" placeholder="d-m-Y" data-date-format="d-m-Y"  required >
</div>
<div class="col-4">
    <label>Issue Type (New/Replacement)</label><span class="text-danger">*</span>
    <select class="form-control" name="issue_type" required >
        <option value="New" {{$form->issue_type == 'New' ? 'selected':''}}>New</option>
        <option value="Replacement" {{$form->issue_type == 'Replacement' ? 'selected':''}}>Replacement</option>
    </select>
</div>
<div class="col-6 mb-3">
    <label for="image" class="form-label">Upload Image</label><span
        class="text-danger"> Max 248 kilobytes*</span>
    <input type="file" class="form-control" id="image" name="image" >
    <img id="preview_image" src="{{asset($form->idsec_image_path)}}" alt="Upload to see preview"
         style="display: none; max-width: 50%; margin-top: 10px;">
</div>
<div class="col-6 mb-3">
    <label for="image" class="form-label">Upload Image</label><span
        class="text-danger"> Max 128 kilobytes*</span>
    <input type="file" class="form-control" id="sign" name="sign" >
    <img id="preview_sign" src="{{asset($form->idsec_sign_path)}}" alt="Preview"
         style="display: none; max-width: 50%; margin-top: 10px;">
</div>

@role('id-section')
<div class="col-sm-8 col-lg-8 col-lx-4 d-flex">
    <button type="submit" value="approve" name="action" class="btn btn-rounded btn-success w-50 m-2"><i class="fa fa-paper-plane"></i>
        Update Form
    </button>
</div>
@endrole
