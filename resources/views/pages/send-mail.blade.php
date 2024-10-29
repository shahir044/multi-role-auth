@extends('layouts.common')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Email
                </div>
                <div class="card-body">
                    <form action="{{route('idsection.sendemail')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>EMAIL TO</label>
                            <select name="email_to[]" id="email_to" class="form-control select2" multiple="">
                                    <option value="">Select Recipient</option>
                                @foreach($records as $record)
                                    <option value="{{$record->email}}">{{$record->emp_no}}-{{$record->full_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>SUBJECT</label>
                            <input class="form-control" type="text" name="subject" id="subject" placeholder="Subject"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label>EMAIL BODY</label>
                            <textarea class="form-control" type="text" name="body" id="body"
                                      placeholder="Email Description" rows="5" required>

                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> SEND EMAIL
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
