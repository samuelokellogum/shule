@extends('main')
@section('content')

    <div class="row">
        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Grading Categories</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <button  id="btn-add" onclick="showModal()"  class="btn btn-success pull-right"><i class="fa fa-plus"></i> Grading </button>
                    <br/><br/>
                    <table id="dataTable-table1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody id="grading-table">

                        @if(isset($gradingCat))
                            <?php $count = 0 ?>
                            @foreach($gradingCat as $row)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $row->gradCat_name }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Action</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#" onclick="editGradCat({{ $row->gradCat_id }})"><i class="fa fa-edit"></i> Edit</a>
                                                </li>
                                                <li><a href="#" onclick="deleteGradCat({{ $row->gradCat_id }})"><i class="fa fa-trash"></i> Delete</a>
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
                        <input type="hidden" name="id">
                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="grad_cat" id="grad-cat" placeholder="Grading category" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="addGradingCategory()" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Finish</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        var save_method = 'add';
        $(document).ready(function () {
            //tableData()

            $('#btn-add').click(function (e) {
                e.preventDefault()
            });

        });

        
        function showModal() {
            $('#modal-form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add Grading category');
        }
        
        function addGradingCategory() {
            sValidateForm($('#modal-form'), function (isValid) {
               if(isValid){
                   if(save_method == 'add'){
                       task = 'add';
                   }else{
                       task = 'update';
                   }
                   $.ajax({
                       url: '{{ route('processGradCat') }}',
                       type: 'POST',
                       dataType: 'JSON',
                       data: {
                           task: task,
                           _token : $('[name = "_token"]').val(),
                           grade_cat : $('[name = "grad_cat"]').val(),
                           id: $('[name = "id"]').val()
                       },
                       success: function (data) {
                           console.log(data)
                           updateTable(data)
                           $('#modal_form').modal('hide');
                           $('#modal-form')[0].reset();
                       },
                       error: function (jqXHR, textStatus, errorThrown) {
                           alert(errorThrown)
                       }
                   });
               }
            });

        }


        function editGradCat(id){
            $.ajax({
                url: '{{ route('updateGradCat') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token : $('[name = "_token"]').val(),
                },
                success: function (data) {
                    console.log(data)
                    save_method = 'update';
                    $('[name = "id"]').val(data.gradCat_id)
                    $('[name = "grad_cat"]').val(data.gradCat_name)
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Edit Grading category');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function deleteGradCat(id){
            $.ajax({
                url: '{{ route('processGradCat') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token : $('[name = "_token"]').val(),
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

@endsection