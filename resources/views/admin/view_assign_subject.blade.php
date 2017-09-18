@extends('main')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="#" onclick="showModal()" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Assign Subject</a>
        <a href="{{ route('viewSubject') }}" class="btn btn-success pull-left"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    <!-- panel -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Title</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Subject name</th>
                        <th>Class</th>
                        <th>Teachers</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>

                    </tbody>
                </table>
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

                    <form class="form-horizontal" id="modal-form-assign" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <input type="text" hidden value="" id="id" name="id">

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="select-subject" data-required="true"  data-trigger="change" required="required">
                                <option value="">Select subject</option>
                                @if(isset($subjects))
                                    @foreach($subjects as $row)
                                        <option value="{{ $row->subject_id }}">{{ $row->subject_name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="select-class" name="selectclass"  data-required="true"  data-trigger="change" required="required">
                                <option value="">Select Class</option>
                                @if(isset($classes))
                                    @foreach($classes as $row)
                                        <option value="{{ $row->class_id }}">{{ $row->class_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                            <select class="form-control" id="select-teacher" name="teacher" multiple="multiple"   data-required="true"  data-trigger="change" required="required">
                                <option value="">Select Teacher</option>
                                @if(isset($teachers))
                                    @foreach($teachers as $row)
                                        <option value="{{ $row->user_id }}">{{ $row->fname.' '.$row->lname }}</option>
                                    @endforeach
                                @endif

                            </select>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" onclick="assignSubject()" class="btn btn-primary">Save</button>
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
        $(document).ready(function () {
            $('#select-teacher').select2({
                placeholder: 'Select teacher(s)',
                width: '100%'
            });

            $('#select-class').select2({
                placeholder: 'Select class',
                width: '100%'
            });

            $('#select-subject').select2({
                placeholder: 'Select Subject',
                width: '100%'
            });
        });

        function showModal(){
            save_method = 'add';
            $('#modal-form-assign')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Assign Subject');
            $('#btnSave').text('Save');
        }


        function assignSubject() {
            sValidateForm($('#modal-form-assign'),function (isValid) {
                if(isValid){
                    showWaitDialog('Processing....')
                    $.ajax({
                        url: '{{ route('assignSub') }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            subject: $('#select-subject').val(),
                            class: $('#select-class').val(),
                            teachers: JSON.stringify($('#select-teacher').val()),
                            _token : $('[name = "_token"]').val()
                        },
                        success: function (data) {
                            hideWaitDialog()
                            Notify('Message', data.success,'info')
                            console.log(data);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(errorThrown)
                        }
                    });
                }
            });

        }
    </script>

@endsection