@extends('user.common')

@section('content')
    <div class="container">
        <section class="section">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-4 col-md-4 col-lg-4 col-xl-4">
                        <h4>Instructions:</h4>
                        <ol>
                            <li>Please enter your information carefully.</li>
                            <li>* means information is required.</li>
                            <li>Photo and signature should not exceed 248 kilobytes and 128 kilobytes respectively.</li>
                            <li>Send the form to your concerned Admin-cell.</li>
                            <li>Click on Submission-Status to know current status.</li>
                            <li>For any technical queries, cotact with Biman IT Division Extension: 2235</li>
                        </ol>
                    </div>
                    <div class="col-12 col-sm-10 col-md-10 col-lg-8 col-xl-8 ">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    {!! implode('', $errors->all('<li class="text-white text-500">:message</li>')) !!}
                                </ul>
                            </div>
                        @endif
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-has-icon">
                                <div class="alert-icon"><i class="far fa-check-circle"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Thank you for submitting the form.</div>
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                            <hr>
                        @endif
                        @if(session()->has('message'))
                            <div class="alert alert-danger alert-has-icon">
                                <div class="alert-icon"><i class="far fa-check-circle"></i></div>
                                <div class="alert-body">
                                    <div class="alert-title">Sorry</div>
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                            <hr>
                        @endif
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>ID Card Form</h4>
                            </div>
                            <div class="card-body">
                                <!-- Form Grid with Labels *************************-->
                                <form class="row g-3 mb-6" action="{{route('user.form.submit')}}" method="POST"
                                      id="permanent-emp-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-2">
                                        <label>Type</label><span class="text-danger">*</span>
                                        <select class="form-control" id="type" name="type" required>
                                            <option value="" disabled selected>Select</option>
                                            <option>P</option>
                                            <option>G</option>
                                            <option>C</option>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label>Staff Number</label><span class="text-danger">*</span>
                                        <input id="emp_no" name="emp_no" type="number" class="form-control" required>
                                    </div>
                                    <div class="col-4">
                                        <label>Full Name</label><span class="text-danger">*</span>
                                        <input id="full_name" name="full_name" type="text" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-3">
                                        <label>Bangle Name</label><span class="text-danger">*</span>
                                        <input id="bangleName" name="bangla_name" type="text" class="form-control"
                                               required>
                                    </div>


                                    <div class="col-4">
                                        <label>Father's Name</label><span class="text-danger">*</span>
                                        <input id="fatherName" name="father_name" type="text" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-4">
                                        <label>Mother's Name</label><span class="text-danger">*</span>
                                        <input id="motherName" name="mother_name" type="text" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-4">
                                        <label>Spouse's Name</label>
                                        <input id="spouseName" name="spouse_name" type="text" class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label>Designation</label><span class="text-danger">*</span>
                                        <select class="form-control" name="desig" required>
                                            @foreach ($desgs as $desg)
                                                <option value="{{$desg->name}}">{{$desg->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label>Department</label><span class="text-danger">*</span>
                                        <select class="form-control" id="dept" name="dept" required>
                                            @foreach ($depts as $dept)
                                                <option value="{{$dept->name}}">{{$dept->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="example-flatpickr-custom">Appointment Date</label><span
                                            class="text-danger">*</span>
                                        <input type="date" class="form-control datetimepicker" id="app_date"
                                               name="app_date" placeholder="d-m-Y" data-date-format="d-M-Y" required>
                                    </div>

                                    <div class="col-4">
                                        <label>Station</label><span class="text-danger">*</span>
                                        <select class="form-control" name="station" required>
                                            @foreach ($stats as $stat)
                                                <option value="{{$stat->name_en}}">
                                                    {{$stat->name_en}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label>Shop No</label><span class="text-danger">*</span>
                                        <select class="form-control" name="shop_no" required>
                                            @foreach ($shops as $shop)
                                                <option value="{{$shop->dept_no}}">
                                                    {{$shop->dept_no}}-{{$shop->name}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label>Location No</label><span class="text-danger">*</span>
                                        <select class="form-control" name="loc_no" required>
                                            @foreach ($locs as $loc)
                                                <option value="{{$loc->location_no}}">
                                                    {{$loc->location_no}}-{{$loc->name_en}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label>Nationality</label><span class="text-danger">*</span>
                                        <input id="natl" name="natl" type="text" class="form-control" placeholder=""
                                               required>
                                    </div>
                                    <div class="col-4">
                                        <label>National ID Card no.</label><span class="text-danger">*</span>
                                        <input id="nid" name="nid" type="number" placeholder="" class="form-control"
                                               required>
                                    </div>
                                    <div class="col-4">
                                        <label>Mobile Number (11 Digit)</label><span class="text-danger">*</span>
                                        <input id="mobile" name="mobile" type="text" minlength="11"
                                               maxlength="11" placeholder="017xxx" class="form-control" required>
                                    </div>

                                    <div class="col-4">
                                        <label>Place of Birth</label><span class="text-danger">*</span>
                                        <input id="pob" name="pob" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-4">
                                        <label for="example-flatpickr-custom">Date of Birth</label><span
                                            class="text-danger">*</span>
                                        <input type="date" class="form-control datetimepicker" id="dob" name="dob"
                                               placeholder="d-m-Y" data-date-format="d-m-Y" required>
                                    </div>
                                    <div class="col-2">
                                        <label>Blood Group</label><span class="text-danger">*</span>
                                        <select class="form-control" name="bgrp" required>
                                            <option>A+</option>
                                            <option>A-</option>
                                            <option>B+</option>
                                            <option>B-</option>
                                            <option>O+</option>
                                            <option>O-</option>
                                            <option>AB+</option>
                                            <option>AB-</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <label>Height(cm)</label><span class="text-danger">*</span>
                                        <input id="height" name="height" type="number" class="form-control" required>
                                    </div>

                                    <div class="col-6">
                                        <label>Full Permanent Address</label><span class="text-danger">*</span>
                                        <input id="perm_add" name="perm_add" type="text" class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label>Full Present/Local/Mailing Address</label><span
                                            class="text-danger">*</span>
                                        <input id="curr_add" name="curr_add" type="text" class="form-control" required>
                                    </div>

                                    <div class="col-6">
                                        <label>Email Address</label><span class="text-danger">*</span>
                                        <input id="email" name="email" type="email" class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label>Identification mark (if any)</label>
                                        <input id="ident_mark" name="ident_mark" type="text" class="form-control">
                                    </div>

                                    <div class="col-4">
                                        <label for="example-flatpickr-custom">Validity of current card</label>
                                        <input type="date" class="form-control datetimepicker" id="card_val"
                                               name="card_val" placeholder="d-m-Y" data-date-format="d-m-Y">
                                    </div>

                                    <div class="col-6">
                                        <label for="">Send To (Admin-cell)</label><span class="text-danger">*</span>
                                        <select class="form-control" id="receiver" name="receiver" required>
                                            @foreach ($users as $user)
                                                <option value={{$user->id}}>{{$user->name}}-{{$user->email}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-8">
                                        <label>Reason for requesting new ID card</label><span
                                            class="text-danger">*</span>
                                        <input id="birthPlace" name="change_reason" type="text" class="form-control"
                                               required>
                                    </div>

                                    <div class="col-6 mb-3">
                                        <label for="image" class="form-label">Upload Image</label><span
                                            class="text-danger"> Max 248 kilobytes*</span>
                                        <input type="file" class="form-control" id="image" name="image">
                                        <img id="preview_image" src="#" alt="Preview"
                                             style="display: none; max-width: 50%; margin-top: 10px;">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label for="signature" class="form-label">Choose Signature</label><span
                                            class="text-danger"> Max 128 kilobytes*</span>
                                        <input type="file" class="form-control" id="signature" name="signature">
                                        <img id="preview_signature" src="#" alt="Preview"
                                             style="display: none; max-width: 50%; margin-top: 10px;">
                                    </div>

                                    <a href="#" data-toggle="modal" data-target="#modal-terms">I hereby declare that the
                                        information provided is true and correct. Any willful dishonesty may render for
                                        refusal of this application or immediate action.</a>

                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="val-terms"
                                               name="val-terms" value="1" required>
                                        <label class="custom-control-label" for="val-terms">I agree <span
                                                class="text-danger">*</span></label>
                                    </div>

                                    <div class="col-sm-6 col-lg-4 col-lx-4 d-flex">
                                        <button type="submit" class="btn btn-rounded btn-success w-100"><i
                                                class="fa fa-paper-plane"></i> Submit Form
                                        </button>
                                        <span id="form-spinner" class="spinner-border spinner-border-sm m-2 d-none"
                                              role="status" aria-hidden="true"></span>
                                    </div>
                                </form>
                                <!-- END Form Grid with Labels -->
                                {{--******************************************--}}

                            </div>
                            <div class="mb-4 text-muted text-center">
                                For any queries contact <a>Biman ID Section ext: </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('javascript')
    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewImage = document.getElementById('preview_image');
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        // Preview for Signature
        document.getElementById('signature').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewSignature = document.getElementById('preview_signature');
                    previewSignature.src = e.target.result;
                    previewSignature.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

