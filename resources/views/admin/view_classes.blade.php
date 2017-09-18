@extends('main')
@section('content')
    <div class="row">

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage Classes</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i>  Class list</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Class section</a>
                            </li>

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                                <!-- cotent class tab -->
                                <button id="btn-add-class" onclick="showAddClassModal()" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Class</button>
                                <br/><br/><br/>



                                <table id="dataTable-table1" class="table table-striped table-bordered" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Class name</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody id="class-table">

                                    @if(isset($classes))
                                        <?php $count = 1 ?>
                                        @foreach($classes as $row)
                                            <tr>
                                                <td>{{ $count }}</td>
                                                <td>{{ $row->class_name }} </td>
                                                <td>Level {{  $row->level }}</td>
                                                <td>

                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Action</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#" onclick="editClass({{ $row->class_id }})"><i class="fa fa-edit"></i> Edit</a>
                                                            </li>
                                                            <li><a href="#" onclick="deleteClass({{ $row->class_id }})"><i class="fa fa-trash"></i> Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $count++ ?>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>

                                <!-- ./ class tab -->

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                                <!-- cotent class sections tab -->

                                <form class="form-horizontal" id="form-class-sec" data-parsley-validate>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                                    <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                                        <select class="form-control" id="class-select" name="class" data-required="true"  data-trigger="change" required="required">
                                            <option value="">Choose class</option>
                                            @if(isset($classes))
                                                @foreach($classes as $row)
                                                    <option value="{{ $row->class_id }}">{{ $row->class_name }}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                                        <button id="btn-view" class="btn btn-success"><i class="fa fa-eye"></i> View </button>
                                        <button  id="btn-add"  class="btn btn-success"><i class="fa fa-plus"></i> Section </button>
                                    </div>
                                    <h2 class="pull-right" id="class-text"> Sections [Class ]</h2>
                                </form>

                                <br/>

                                    <table id="dataTable-table2" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Section name</th>
                                            <th>Class teacher</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>


                                        <tbody id="class-sec-table">

                                        </tbody>
                                    </table>

                                <!-- ./ class tab -->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /.panel -->

    </div>

    <!-- modal classs -->
    <div class="modal fade" id="modal-class" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body form">

                    <form class="form-horizontal" id="modal-form-class" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="text" hidden value="" id="id" name="id">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="classname" id="class-name" placeholder="class name" value="">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="level" name="level"  data-required="true"  data-trigger="change" required="required">
                                <option value="">Select level</option>
                                @if(isset($levels))
                                    <?php $i = 1 ?>
                                    @while($i <= $levels)
                                        <option value="{{ $i }}">Level {{ $i }}</option>
                                        <?php $i++ ?>
                                        @endwhile
                                    @endif

                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="addClass()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- modal class section -->
    <div class="modal fade" id="modal-class-section" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body form">

                    <form class="form-horizontal" id="modal-form-class-sections" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="text" hidden value="" id="class-sec-id" name="classid">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="classec" id="class-sec-name" placeholder="class name" value="">
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="user-group" name="usergroup"  data-required="true"  data-trigger="change" required="required">
                                <option value="">Select User Group</option>
                                @if(isset($usergroups))
                                    @foreach($usergroups as $row)
                                        <option value="{{ $row->ug_id }}">{{ $row->userg_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="teacher" name="teacher"   data-required="true"  data-trigger="change" required="required">
                                <option value="">Select User</option>
                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="addClassSec()" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        var save_method;
        var save_method_2;
        $(document).ready(function () {
            $('#btn-view').click(function (e) {
                sValidateForm($('#form-class-sec'),function (isValid) {
                    if(isValid){
                        e.preventDefault();
                        showClasSecContent($('[name ="class"]').val());
                    }
                });
            });

            $('#btn-add').click(function (e) {
                sValidateForm($('#form-class-sec'),function (isValid) {
                    if(isValid){
                        e.preventDefault();
                       showClassSecModal();
                    }
                });
            });

            $('#user-group').change(function () {
                var id = $(this).val();
                if(id != ""){
                    fetchUsers(id);
                }
            });

        });



        function showAddClassModal() {
            save_method = 'add';
            $('#modal-form-class')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal-class').modal('show');
            $('.modal-title').text('Add class');
            $('#btnSave').text('Save');
        }

        function editClass(id){
            showWaitDialog('Processing...')
            save_method = 'update';
            $.ajax({
                url: '{{ route('getCForEdit') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token: $('[name ="_token"]').val()
                },
                success: function (data) {
                     hideWaitDialog()
                    console.log(data)
                    setTimeout(
                        function()
                        {$('#modal-form-class')[0].reset();
                            $('.form-group').removeClass('has-error');
                            $('.help-block').empty();
                            $('#modal-class').modal('show');
                            $('.modal-title').text('Add Update class');
                            $('#btnSave').text('Update');

                            $('#class-name').val(data.class_name);
                            $('#level').val(data.level);
                            $('#id').val(data.class_id);
                        }, 500);




                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function addClass(){
            var message;
            sValidateForm($('#modal-form-class'),function (isValid) {
                var url;
                if (isValid) {
                    showWaitDialog('Please wait...')
                    if (save_method == 'add') {
                        url = "{{ route('addClass') }}";
                        message = 'Class added';
                    } else if (save_method == 'update') {
                        url = "{{ route('updateClass') }}";
                        message = 'Class updated';
                    }

                    $.ajax({
                     url: url,
                     type: 'POST',
                     dataType: 'JSON',
                     data: $('#modal-form-class').serialize(),
                     success: function (data) {
                         hideWaitDialog()
                     //console.log(data)
                     $('#modal-class').modal('hide');
                       updateTableClass(data);
                         updateClassList()
                     Notify('DONE', message ,'success');
                     },
                     error: function (jqXHR, textStatus, errorThrown) {
                     alert(errorThrown)
                     }
                     });
                }
            });

        }

        function deleteClass(id){
            showWaitDialog('Deleting....')
            $.ajax({
                url: '{{ route('deleteClass') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token: $('[name ="_token"]').val()
                },
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    updateTableClass(data)
                    updateClassList()
                    Notify('DONE','Class deleted','success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function updateClassList(){
            $.ajax({
                url: '{{ route('updateClassList') }}',
                type: 'GET',
                dataType: 'JSON',
                success: function (data) {
                    console.log(data)
                    $('#class-select').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function updateTableClass(data){
            $("#dataTable-table1").dataTable().fnDestroy()
            $('#class-table').html(data);
            $("#dataTable-table1").dataTable({
                responsive: true,
                dom: "lfrtip",
            });
        }

        function showClasSecContent(classid) {
            showWaitDialog('Loading data...')
            $.ajax({
                url: "{{ route('popCSecTale') }}",
                type: 'POST',
                dataType: 'JSON',
                data: $('#form-class-sec').serialize(),
                success: function (data) {
                    console.log(data)
                    hideWaitDialog()
                    updateTableClassSec(data)
                    $('#class-text').html('Sections ['+ $('#class-select option:selected').text() +']');
                    $('#profile-tab').html('Sections ['+ $('#class-select option:selected').text() +']');
                    Notify('DONE', 'Table updated' ,'success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function showClassSecModal() {
             save_method_2 = 'add';
             $('#modal-form-class')[0].reset();
             $('.form-group').removeClass('has-error');
             $('.help-block').empty();
             $('#modal-class-section').modal('show');
             $('.modal-title').text('Add section to '+$('#class-select option:selected').text());
             $('#btnSave').text('Save');
             $('#class-sec-id').val($('[name = "class"]').val());

        }

        function fetchUsers(usergroup){
            showWaitDialog('processing....')
            $.ajax({
                url: '{{ route('gUserT') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    usergroup: usergroup,
                    _token: $('[name ="_token"]').val()
                },
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    $('#teacher').html(data)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function addClassSec() {
            sValidateForm($('#modal-form-class-sections'),function (isValid) {
                if(isValid){
                    showWaitDialog('please wait...')
                    var url;
                    var message;
                    if(save_method_2 == 'add'){
                        url = "{{ route('addClassSec') }}";
                        message = 'Class section added';
                    }else{
                        url = "{{ route('updateCsec') }}";
                        message = 'Class section updated';
                    }
                    $.ajax({
                        url: url,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $('#modal-form-class-sections').serialize(),
                        success: function (data) {
                            hideWaitDialog()
                            console.log(data)
                            $('#class-sec-table').html(data)
                            $('#modal-class-section').modal('hide');
                            Notify('DONE', message ,'success');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown)
                        }
                    });
                }
            });
        }

        function editClassSec(id) {
            showWaitDialog('please wait....')
            save_method_2 = 'update';
            $.ajax({
                url: '{{ route('gCesFEdit') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    classid: id,
                    _token: $('[name ="_token"]').val()
                },
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    setTimeout(function () {
                        $('#modal-form-class')[0].reset();
                        $('.form-group').removeClass('has-error');
                        $('.help-block').empty();
                        $('#modal-class-section').modal('show');
                        $('.modal-title').text('Class name ');
                        $('#btnSave').text('Update');

                        $('#class-sec-name').val(data.section_name);
                        $('#teacher').val(data.class_teacher);
                        $('#class-sec-id').val(data.cs_id);
                    }, 500);


                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function deleteClassSec(id){
            showWaitDialog('Deleting...')
            $.ajax({
                url: '{{ route('deleteClassSec') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    classid: $('[name = "class"]').val(),
                    _token: $('[name ="_token"]').val()
                },
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    updateTableClassSec(data)
                    Notify('DONE','Class Section','success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function updateTableClassSec(data){
            $("#dataTable-table2").dataTable().fnDestroy()
            $('#class-sec-table').html(data);
            $("#dataTable-table2").dataTable({
                responsive: true,
                dom: "lfrtip",
            });
        }
    </script>
@endsection