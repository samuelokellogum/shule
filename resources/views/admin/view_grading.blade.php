@extends('main')
@section('content')

    <!-- panel -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Grading</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <form class="form-horizontal" id="form-subject" data-parsley-validate>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />

                    <div class="col-md-2 col-sm-3 col-xs-12 form-group">
                        <select class="form-control" id="subject-select" name="subject" data-required="true"  data-trigger="change" required="required">
                            <option value="">Choose subject</option>
                            @if(isset($subjects))
                                @foreach($subjects as $row)
                                    <option value="{{ $row->subject_id }}">{{ $row->subject_name.'  '.$row->subject_code }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-3 col-xs-12 form-group">
                        <select class="form-control" id="subject-select" name="subject" data-required="true"  data-trigger="change" required="required">
                            <option value="">Choose subject</option>
                            @if(isset($subjects))
                                @foreach($subjects as $row)
                                    <option value="{{ $row->subject_id }}">{{ $row->subject_name.'  '.$row->subject_code }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                        <button  id="btn-add" onclick="showModal()"  class="btn btn-success"><i class="fa fa-plus"></i> Grading </button>
                        <button id="btn-view" class="btn btn-success"><i class="fa fa-eye"></i> View </button>
                    </div>
                    <h2 class="pull-right" id="class-text"> Grading [Commerce c1002 ]</h2>
                </form>

                <br/><br/>
                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Range from</th>
                        <th>Range to</th>
                        <th>Label</th>
                        <th>Consist of</th>
                    </tr>
                    </thead>


                    <tbody id="grading-table">

                    @if(isset($grading))
                        <?php $count ?>
                        @foreach($grading as $row)
                            <tr>
                                <td>{{ $row->grading_id }}</td>
                                <td>{{ $count }}</td>
                                <td>{{ $row->range_from }}</td>
                                <td>{{ $row->range_to }}</td>
                                <td>{{ $row->label }}</td>
                                <td>{{ $row->consist_of }}</td>
                                <td></td>
                            </tr>
                            @endforeach
                        @endif

                    </tbody>
                </table>


                <div class="col-md-12 col-sm-12 col-xs-12">
                    <br/>
                    <button class="btn btn-success pull-right"> Submit</button>
                </div>

            </div>
        </div>
    </div>
    <!-- /.panel -->


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
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="range_from" id="range-from" placeholder="Range from" value="">
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="range_to" id="range-to" placeholder="Range to" value="">
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="label" id="label" placeholder="Label" value="">
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <input type="text" class="form-control" required="required" name="consist_of" id="consist-of" placeholder="consist of" value="">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="addGrade()" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Finish</button>
                </div>
            </div>
        </div>
    </div>
    <!-- ./modal -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        var grades = [];
        $(document).ready(function () {
            //tableData()

            $('#btn-add').click(function (e) {
                e.preventDefault()
            });
            
        });
        
        
       /* function tableData() {

            $('#dataTable-table-edit').Tabledit({
                url: '',
                hideIdentifier: true,
                deleteButton: false,
                columns: {
                    identifier: [0, 'id'],
                    editable: [[2, 'range_from'], [3, 'range_to'], [4, 'label'], [5, 'consist_of']]
                },
                onSuccess: function (data) {
                    console.log(data);
                    updateTable(data);

                },
                onDraw: function () {

                },
                onFail: function (jqXHR, textStatus, errorThrown) {
                    console.log('onFail(jqXHR, textStatus, errorThrown)');
                    console.log(jqXHR);
                    console.log(textStatus);
                    console.log(errorThrown);
                },
                onAlways: function () {
                    //console.log('onAlways()');
                },
                onAjax: function (action, serialize) {
                    console.log('onAjax(action, serialize)');
                    console.log(action);
                    console.log(serialize);
                }
            });

        }*/

        function showModal() {
            $('#modal-form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Add Grade');
        }

        function submitGrading(){
            showWaitDialog('Please wait....')
            $('#id').val($('#subject-select').val());
           $.ajax({
                url: '{{ route('addGrading') }}',
                type: 'post',
                dataType: 'json',
                data: $('#modal-form').serialize(),
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    updateTable(data)
                    Notify('Done','Data added','success')
                },
                error: function (j, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }



        function updateTable(data){
            $('#grading-table').html(data);
        }
    </script>

@endsection