@extends('main')
@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="{{ route('viewUsers') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add User</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('addUser') }}" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="hidden" name="task" value="@if(isset($task)) {{ $task }}@endif">
                        <input type="hidden" name="userid" value="@if(isset($userid)) {{ $userid }} @endif">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="fname" required="required" value="@if(isset($userdata)) {{ $userdata->fname }} @endif" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="lname" required="required" value="@if(isset($userdata)) {{ $userdata->lname }} @endif" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Email <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="email" required="required" value="@if(isset($userdata)) {{ $userdata->email }} @endif" class="form-control col-md-7 col-xs-12" type="email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="contact" required="required" value="@if(isset($userdata)) {{ $userdata->contact }} @endif" class="form-control col-md-7 col-xs-12" type="text" name="contact">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  name="dob" class="datepicker form-control col-md-7 col-xs-12" required="required" value="@if(isset($userdata)) {{ $userdata->dob }} @endif" readonly type="text">
                                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select user group<span class="required"> *</span></label>
                            <div class="col-md-6 col-xs-12">
                                <select class="form-control"  data-required="true"  data-trigger="change" required="required" name="usergroup" id="usergroup">
                                    @if(isset($userdata))
                                        <option value="{{ $userdata->userg }}">{{ $userdata->userg_name }}</option>
                                        @else
                                        <option value="">Select user group</option>
                                        @endif

                                    @if(isset($usergroups))
                                        @foreach($usergroups as $row)
                                            <option value="{{ $row->ug_id }}">{{ $row->userg_name }}</option>
                                            @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        @if(!isset($userdata))
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Person image<span class="required"> *</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="person-img" name="personimg"  type="file" class="file form-control col-md-7 col-xs-12" data-show-upload="false">
                            </div>
                        </div>
                        @endif
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success pull-right">@if(isset($userdata)) Update @else Submit @endif</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.panel -->
    </div>

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#person-img').fileinput({
                allowedFileExtensions: ['jpg','png','jpeg']
            });
        });
    </script>

@endsection