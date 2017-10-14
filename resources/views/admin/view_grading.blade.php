@extends('main')
@section('content')

    <div class="row">
        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grading</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form class="form-horizontal" id="form-grading" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />

                        <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                            <select class="form-control" id="gradecat-select" name="gradecat" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose Grading category</option>
                                @if(isset($gradeCats))
                                    @foreach($gradeCats as $row)
                                        <option value="{{ $row->gradCat_id }}">{{ $row->gradCat_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                            <button id="btn-view" class="btn btn-success"><i class="fa fa-eye"></i> View </button>
                            <button  id="btn-add"  class="btn btn-success"><i class="fa fa-plus"></i> Grading </button>
                        </div>
                    </form>

                    <br/><br/>
                    <table id="dataTable-table1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Range</th>
                            <th>Comment</th>
                            <th>Consist of</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody id="grading-table">

                        @if(isset($grading))
                            <?php $count ?>
                            @foreach($grading as $row)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->grade_name }}</td>
                                    <td>{{ $row->range_from.' -- '.$row->range_to }}</td>
                                    <td>{{ $row->grade_comment }}</td>
                                    <td>{{ $row->consist_of }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Action</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="editGrade({{ $row->grading_id }})"><i class="fa fa-edit"></i> Edit</a>
                                                </li>
                                                <li><a href="#" onclick="deleteGrade({{ $row->grading_id }})"><i class="fa fa-trash"></i> Delete</a>
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
                        <input type="hidden"  id="data-id" name="id">
                        <input type="hidden" name="task" id="task" value="">
                        <input type="hidden" name="gradecat" id="grade-cat">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="range_from" id="range-from" placeholder="Range from" value="">
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="range_to" id="range-to" placeholder="Range to" value="">
                        </div>


                        <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="grade_name" id="grade-name" placeholder="name" value="">
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12 form-group">
                            <input type="number" class="form-control" required="required" name="consist_of" id="consist-of" placeholder="consist of" value="">
                        </div>

                        <div class="col-md-8 col-sm-8 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="comment" id="comment" placeholder="Comment" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="submitGrading()" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //tableData()

            $('#btn-add').click(function (e) {
                sValidateForm($('#form-grading'), function (isValid) {
                    if(isValid){
                        e.preventDefault()
                        $('#grade-cat').val($('#gradecat-select').val());
                        showModal()
                    }
                });

            });

            $('#btn-view').click(function (e) {
                sValidateForm($('#form-grading'), function (isValid) {
                    if(isValid){
                        e.preventDefault()
                        viewGradingByCat()
                    }
                });
            });
            
        });

        function showModal() {
            $('#task').val('add')
            $('#modal-form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add Grading of '+ $('#gradecat-select option:selected').text());
        }

        function submitGrading(){
            showWaitDialog('Please wait....')
            $('#id').val($('#subject-select').val());
           $.ajax({
                url: '{{ route('processGrading') }}',
                type: 'post',
                dataType: 'json',
                data: $('#modal-form').serialize(),
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    updateTable(data)
                    Notify('Done','Data added','success')
                    if($('#task').val() == 'update'){
                        $('#modal_form').modal('hide');
                    }
                },
                error: function (j, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function editGrade(id){
            $('#task').val('update')
            $.ajax({
                url: '{{ route('updateGrade') }}',
                type: 'POST',
                dataType: 'JSON',
                data:{
                  id : id,
                  _token : $('[name = "_token"]').val()
                },
                success: function (data) {
                    console.log(data)

                    $('#data-id').val(data.grading_id);
                    $('#grade-cat').val(data.grading_cat);
                    $('#grade-name').val(data.grade_name);
                    $('#range-from').val(data.range_from);
                    $('#range-to').val(data.range_to);
                    $('#consist-of').val(data.consist_of);
                    $('#comment').val(data.grade_comment)
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit  Grade');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function deleteGrade(id) {
            $.ajax({
                url: '{{ route('processGrading') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id : id,
                    _token : $('[name = "_token"]').val(),
                    task : 'delete',
                    gradecat: $('#grade-cat').val()
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

        function viewGradingByCat(){
            $.ajax({
                url: '{{ route('popGradeTable') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id : $('#gradecat-select').val(),
                    _token : $('[name = "_token"]').val(),
                },
                success: function (data) {
                    $('#grade-cat').val($('#gradecat-select').val());
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

@endsection