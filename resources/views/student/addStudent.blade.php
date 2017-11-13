@extends('main')
@section('content')

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <a href="{{ route('viewStudents') }}" class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
        </div>

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add Student</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="{{ route('viewStudents') }}" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="@if(isset($id)) {{ $id }} @endif">
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="hidden" name="task" value="@if(isset($task)) {{ $task }}@endif">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="fname" required="required" value="@if(isset($student)) {{ $student->fname }} @endif" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="last-name" name="lname" required="required" value="@if(isset($student)) {{ $student->lname }} @endif" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Admission Date <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="adminyear" class="datepicker form-control col-md-7 col-xs-12" required="required" value="@if(isset($student)) {{ $student->adminYear }} @endif" class="form-control col-md-7 col-xs-12" >
                                 <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                      
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input  name="dob" class="datepicker form-control col-md-7 col-xs-12" required="required" value="@if(isset($student)) {{ $student->dob }} @endif" readonly type="text">
                                <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                        </div>
                 
                        @if(!isset($student))
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Student image<span class="required"> *</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="person-img" name="personimg"  type="file" class="file form-control col-md-7 col-xs-12" data-show-upload="false">
                                </div>
                            </div>
                        @endif
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success pull-right">@if(isset($student)) Update @else Submit @endif</button>
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