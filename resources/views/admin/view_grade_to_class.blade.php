@extends('main')
@section('content')
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
        <button id="btn-view" onclick="showModal()" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Assign </button>
        </div>


        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grading</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <table id="dataTable-table1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Class</th>
                            <th>Grading</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $count = 1; ?>
                            @if(isset($grades))
                                @foreach($grades as $row)
                                    <tr>
                                    <td>{{ $count++ }}</td>
                                    <td>{{ $row->class_name }}</td>
                                    <td>{{ $row->gradCat_name }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Action</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="editAssgnGrade({{ $row->gtl_id }})"><i class="fa fa-edit"></i> Edit</a>
                                                </li>
                                                <li><a href="#" onclick="deleteGradeAssign({{ $row->gtl_id }})"><i class="fa fa-trash"></i> Delete</a>
                                                </li>
                                            </ul>
                                        </div>

                                    </td>
                                    </tr>
                                    @endforeach
                                @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!-- /.panel -->
    </div>

    <!-- modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                </div>
                <div class="modal-body form">
                    <form class="form-horizontal" id="modal-form" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="text" hidden value="" id="id" name="id">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="class-select" name="class" data-required="true"  data-trigger="change" required="required">
                                @if(isset($class))
                                    @if(count($class) > 0)
                                <option value="">Choose Class</option>
                                    @foreach($class as $row)
                                        <option value="{{ $row->class_id }}">{{ $row->class_name }}</option>
                                    @endforeach
                                        @else
                                        <option value="">All classes assigned</option>
                                        @endif
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="gradecat-select" name="gradecat" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose Grading category</option>
                                @if(isset($gradeCats))
                                    @foreach($gradeCats as $row)
                                        <option value="{{ $row->gradCat_id }}">{{ $row->gradCat_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="addAssignGrade()" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
     var save_method;

        function showModal() {
            save_method = 'add';
            $('#modal-form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Assign Grade to class ');
        }


        function editAssgnGrade(id){
            $.ajax({
                url: '{{ route('updateGradeAssign') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id : id,
                    _token : $('[name ="_token"]').val()
                },
                success: function (data) {
                    console.log(data)
                    $('#id').val(data.gtl_id)
                    $('#class-select').html('')
                    $('#class-select')
                        .append($("<option></option>")
                            .attr("value",data.class)
                            .text(data.class_name));
                    $('#gradecat-select').val(data.grading_cat)
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit data');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function addAssignGrade() {
            if(save_method == 'add'){
                task = 'add';
            }else{
                task = 'update';
            }

           sValidateForm($('#modal-form'), function (isValid) {
                if(isValid){
                    $.ajax({
                        url: '{{ route('processGradeAssign') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            id : $('#id').val(),
                            _token : $('[name ="_token"]').val(),
                            task : task,
                            class : $('#class-select').val(),
                            gradecat : $('#gradecat-select').val()
                        },
                        success: function (data) {
                            console.log(data)
                           // updateTable(data)
                            $('#modal_form').modal('hide');
                            window.location.replace('{{ route('viewAssignGrade') }}');
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown)
                        }
                    });
                }
            });
        }

        function deleteGradeAssign(id) {
            $.ajax({
                url: '{{ route('processGradeAssign') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id : id,
                    _token : $('[name ="_token"]').val(),
                    task : 'delete'
                },
                success: function (data) {
                    console.log(data)
                    updateTable(data)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

     function updateTable(data){
         $("#dataTable-table1").dataTable().fnDestroy()
         $('#grading-table').html(data);
         $("#dataTable-table1").dataTable({
             responsive: true,
             dom: "lfrtip",
         });

     }

    </script>
    <!-- /jQuery -->
@endsection