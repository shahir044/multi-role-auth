@extends('layouts.common')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
                <div class="card card-primary">
                    <div class="row m-0">
                        <div class="col-12 col-md-12 col-lg-5 p-0">
                            <div class="card-header text-center">
                                <h4>Contact Us</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST">
                                    <div class="form-group floating-addon">
                                        <label>Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="far fa-user"></i>
                                                </div>
                                            </div>
                                            <input id="name" type="text" class="form-control" name="name" autofocus placeholder="Name" value="M. Shahir Rahman" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group floating-addon">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </div>
                                            </div>
                                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="shahir.rahman@biman.gov.bd" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group floating-addon">
                                        <label>Extension and Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fas fa-phone-square"></i>
                                                </div>
                                            </div>
                                            <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone" value="2235 or 01931131690" disabled>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-lg-7 p-0">
                            <div id="map" class="contact-map"></div>
                        </div>
                    </div>
                </div>
                <div class="simple-footer">
                    Copyright &copy; Biman IT 2024
                </div>
            </div>
        </div>
    </div>
@endsection
