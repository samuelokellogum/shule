@extends('global.main2')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

            </div>

        </div>
        <div class="row" style="background: white;">
            <h1 class="text-center">Welcome to shule </h1>
            <hr/>
            <div class="x_content">

                <div class="x_title">
                    <h2>System configuration <small></small></h2>
                    <div class="clearfix"></div>
                </div>

                <!-- Smart Wizard -->
                <div id="wizard" class="form_wizard wizard_horizontal">
                    <ul class="wizard_steps">
                        <li>
                            <a href="#step-1">
                                <span class="step_no">1</span>
                                <span class="step_descr">
                        Step 1<br />
                        <small>Fill in the school details</small>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-2">
                                <span class="step_no">2</span>
                                <span class="step_descr">
                        Step 2<br />
                        <small>Fill in personal details<br/>please provide a valid email</small>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-3">
                                <span class="step_no">3</span>
                                <span class="step_descr">
                        Step 3<br />
                        <small>Create your password</small>
                    </span>
                            </a>
                        </li>
                        <li>
                            <a href="#step-4">
                                <span class="step_no">4</span>
                                <span class="step_descr">
                        Step 4<br />
                        <small>Finish</small>
                    </span>
                            </a>
                        </li>
                    </ul>
                    <div id="step-1">
                        <form id="form-sch-data" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ Session::token() }}" />
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">School name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="school-name" name="schoolname" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">School contact <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="school-contact" name="schoolcontact" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">School address<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="school-address" class="form-control col-md-7 col-xs-12" type="text" required="required" name="schooladdress">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School moto <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="school-moto" name="schoolmoto" class="form-control col-md-7 col-xs-12" required="required" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School classes <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="school-class" name="schoolclass" class="form-control col-md-7 col-xs-12" required="required" type="number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School website
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="school-web" name="schoolweb" placeholder="www.example.com" class="form-control col-md-7 col-xs-12"  type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">School Logo / badge<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="school-badge" name="schoolbadge"  type="file" class="file form-control col-md-7 col-xs-12" data-show-upload="false">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-2">
                        <form id="form-p-data" data-parsley-validate class="form-horizontal form-label-left">
                            <input type="hidden" name="_token" value="{{ Session::token() }}" />

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="first-name" name="fname" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Last Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="last-name" name="lname" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Contact<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="contact" name="contact" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="birthday" name="dob" class="datepicker form-control col-md-7 col-xs-12" required="required" readonly type="text">
                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                            </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Person image
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="person-img" name="personimg"  type="file" class="file form-control col-md-7 col-xs-12" data-show-upload="false">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-3">
                        <form id="form-password" data-parsley-validate class="form-horizontal form-label-left">
                            <input type="hidden" name="_token" value="{{ Session::token() }}" />
                            <input type="hidden" name="userid" value="" />
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="password" name="password" data-parsley-minlength="5" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="c-password">Confirm password <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" id="c-password"  name="c-password" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="step-4">
                        <h2 class="text-center">Congulations ,system has been set up<span class="fa fa-check" aria-hidden="true"></span></h2>
                        <p class="text-center">Verification link has been sent to yo email.</p>
                    </div>

                </div>
                <!-- End SmartWizard Content -->
            </div>
        </div>
        <br/><br/>
    </div>
    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <!-- jQuery Smart Wizard -->
    <script>
        $(document).ready(function() {

            $('#school-badge').fileinput({
                allowedFileExtensions: ['jpg','png','jpeg']
            });

            $('#person-img').fileinput({
                allowedFileExtensions: ['jpg','png','jpeg']
            });

            $('#wizard').smartWizard({
                onLeaveStep:leaveAStepCallback,
                onFinish:onFinishCallback
            });

            $('#wizard_verticle').smartWizard({
                transitionEffect: 'slide'
            });

            $('.buttonNext').addClass('btn btn-success');
            $('.buttonPrevious').addClass('btn btn-primary');
            $('.buttonFinish').addClass('btn btn-default');
            $('.buttonPrevious').hide();
            $('.buttonFinish').hide();
            $('.buttonFinish').click(function () {
                window.location.replace("{{ route('startup') }}");
            });

        });

        function leaveAStepCallback(obj, context){
            return validateStep(context.fromStep, context.toStep);
            
        }

        function onFinishCallback(objs, context){
            return true;
        }

        function validateStep(stepNumber, toStep){

            if(stepNumber == 1){
                var go = true;
              var formcheck =  validateForm($('#form-sch-data'));
              if(formcheck != 1){
                  go = false;
              }else{
                  if($('#school-badge').val() == ""){
                      alert('Please add school badge / logo');
                      go = false;
                  }else{
                     addSchoolDetils(function (success) {
                        if(success == 1){
                            go = true;
                        }else{
                            go = false;
                        }
                     });
                  }
              }
              return go;
            }else if(stepNumber == 2){
                var go = true;
               var formcheck =  validateForm($('#form-p-data'));
                if(formcheck != 1){
                    go = false;
                }else{
                    addPersonData(function (success) {
                        if(success == 1){
                            go = true;
                        }else{
                            go = false;
                        }
                    });
                }
                return go;
            }else if(stepNumber == 3){
                var go = true;
                var formcheck =  validateForm($('#form-password'));
                if(formcheck != 1){
                    go = false;
                }else{
                    if($('#password').val() != $('#c-password').val()){
                        alert('password did not match');
                        go = false;
                    }else{
                        $('.buttonFinish').show();
                        $('.buttonNext').hide();
                        addPassword(function (success) {
                            if(success == 1){
                                go = true;
                            }else{
                                go = false;
                            }
                        });
                    }
                }

                return go;
            }else if(stepNumber == 4){
                var go = true;
                return go;
            }
            return true;
        }

        function validateForm(form){
            var retVal = 0;
            //$('#form-sch-data')
            var valFront = function () {
                if (true === form.parsley().isValid()) {
                    $('.bs-callout-info').removeClass('hidden');
                    $('.bs-callout-warning').addClass('hidden');
                    retVal = 1;
                } else {
                    $('.bs-callout-info').addClass('hidden');
                    $('.bs-callout-warning').removeClass('hidden');
                    retVal = 0;
                }
            }
            $.listen('parsley:field:validate', function() {
               valFront();
            });
            form.parsley().validate();
            valFront();

            return retVal;
        }
    </script>
    <!-- /jQuery Smart Wizard -->
    
    <!-- scripts interactions-->
    <script>
        function addSchoolDetils(success) {
            showWaitDialog('Processing....')
            var file_data = $('#school-badge').prop('files')[0];
            var form_data = new FormData();
            form_data.append('logo',file_data);
            var other_data = $('#form-sch-data').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });
            $.ajax({
                url: "{{ route('addSchData') }}",
                type: 'POST',
                data: form_data,
                contentType: false,
                processData: false,
                success: function (data) {
                    hideWaitDialog()
                    console.log(data);
                    if(data.success == 1){
                        success = 1;
                    }else{
                        success = 0;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }).done(success);

        }

        function  addPersonData(success) {
            showWaitDialog('Processing....')
            var file_data = $('#person-img').prop('files')[0];
            var form_data = new FormData();
            form_data.append('image',file_data);
            var other_data = $('#form-p-data').serializeArray();
            $.each(other_data,function(key,input){
                form_data.append(input.name,input.value);
            });
            $.ajax({
                url: "{{ route('addPrsnData') }}",
                type: 'POST',
                dataType: 'JSON',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (data) {
                    hideWaitDialog()
                    console.log(data);
                    if(data.success == 1){
                        success = 1;
                        $('[name = "userid"]').val(data.userid);
                    }else{
                        success = 0;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }).done(success);
        }

        function addPassword(success){
            showWaitDialog('Processing....')
            $.ajax({
                url: "{{ route('addPassword') }}",
                type: 'POST',
                dataType: 'JSON',
                data: $('#form-password').serialize(),
                success: function (data) {
                    hideWaitDialog()
                    console.log(data);
                    if(data.success == 1){
                        success = 1;
                    }else{
                        success = 0;
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            }).done(success);
        }

    </script>
    <!-- /scripts interactions-->
    @endsection
