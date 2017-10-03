@extends('main')
@section('content')

    {{--<div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('viewAssigSub') }}" class="btn btn-info pull-right">Assign Subject 1 <i class="fa fa-arrow-right"></i></a>
    </div>--}}

    <!-- panel -->
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-book"></i> Add Subject</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <form id="form-subject" data-parsley-validate class="form-horizontal">
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <input type="hidden" id="id" name="id" value="" />
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control" required="required"  name="subjectname" id="subject-name" placeholder="Subject name">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control"  name="subjectcode" id="subject-code" placeholder="subject code (eg. s123)  [not required]">
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="submit" id="btn-add" class="btn btn-success">Submit</button>
                        <button type="submit" id="btn-cancel" class="btn btn-success">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->

    <!-- panel -->
    <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2><i class="fa fa-table"></i> Table view</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Subject name</th>
                        <th>Subject code</th>
                        <th>Options</th>
                    </tr>
                    </thead>


                    <tbody id="subject-table">
                        @if(isset($subjects))
                            <?php $count = 1 ?>
                            @foreach($subjects as $row)
                                <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $row->subject_name }}</td>
                                <td>{{ $row->subject_code }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Action</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="editSubject({{ $row->subject_id }})"><i class="fa fa-edit"></i> Edit</a>
                                            </li>
                                            <li><a href="#" onclick="deleteSubject({{ $row->subject_id }})"><i class="fa fa-trash"></i> Delete</a>
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

            </div>
        </div>
    </div>
    <!-- /.panel -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        var save_method = 'add';
        $(document).ready(function () {
            $('#btn-cancel').hide();

           $('#btn-add').click(function (e) {
               sValidateForm($('#form-subject'), function (isValid) {
                   if(isValid){
                       e.preventDefault();
                       addSubject();

                   }
               });
           });

           $('#btn-cancel').click(function (e) {
               e.preventDefault();
               save_method = 'add';
               $('#form-subject')[0].reset();
               $(this).hide();
               $('#btn-add').html('submit');
           });
        });

        function addSubject() {
            var url;
            var message;
            showWaitDialog('Processing....')
            if(save_method == 'add'){
                url = '{{ route('addSubject') }}';
                message = 'Subject added';
            }else{
                url = '{{ route('updateSub') }}';
                message = 'Subject updated';
            }
           $.ajax({
                url: url,
                type: 'POST',
                dataType: 'JSON',
                data: $('#form-subject').serialize(),
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    updateTable(data)
                    save_method = 'add';
                    $('#form-subject')[0].reset();
                    $('#btn-cancel').hide();
                    $('#btn-add').html('submit');
                    Notify('Done', message, 'success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });

        }

        function editSubject(id) {
            showWaitDialog('Processing....')
            $.ajax({
                url: '{{ route('gSubFEdit') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token : $('[name = "_token"]').val()
                },
                success: function (data) {
                    hideWaitDialog()
                    console.log(data)
                    save_method = 'update';
                    $('#subject-name').val(data.subject_name);
                    $('#subject-code').val(data.subject_code);
                    $('#id').val(data.subject_id);
                    $('#btn-cancel').show();
                    $('#btn-add').html('update');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }

        function deleteSubject(id) {
            confirmDiaglog('Are you sure ?',function () {
                showWaitDialog('Processing....')
                $.ajax({
                    url: '{{ route('deleteSub') }}',
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id: id,
                        _token : $('[name = "_token"]').val()
                    },
                    success: function (data) {
                        hideWaitDialog()
                        console.log(data)
                        updateTable(data)
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown)
                    }
                });

            });

        }


        function updateTable(data){
            $("#dataTable-table1").dataTable().fnDestroy()
            $('#subject-table').html(data);
            $("#dataTable-table1").dataTable({
                responsive: true,
                dom: "lfrtip",
            });
        }
    </script>

@endsection