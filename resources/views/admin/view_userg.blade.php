@extends('main')
@section('content')
<div class="row">

    <!-- panel -->
    <div class="col-md-5 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Group</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  class="form-horizontal" id="form-u-group" data-parsley-validate>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control" required="required"  name="usergroup" id="user-group" placeholder="User group">
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="submit" id="btn-add" class="btn btn-success">Add group</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->

    <!-- panel -->
    <div class="col-md-7 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Table view</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>User Group</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                    <tbody id="usergroup-table">
                        <?php $count = 1; ?>
                    @if(isset($usergroups))
                        @foreach($usergroups as $row)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $row->userg_name }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Action</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="showModal({{ $row->ug_id }})" ><i class="fa fa-edit"></i> Edit</a>
                                            </li>
                                            <li><a href="#" onclick="deleteUgrp({{ $row->ug_id }})"><i class="fa fa-trash"></i> Delete</a>
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
                        <input type="text" class="form-control" required="required" name="usergroup" id="usergroup" placeholder="user group" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="updateUgrp()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- ./modal -->


<!-- jQuery -->
<script src="{{ URL::to('js/jquery.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('#btn-add').click(function (e) {
            sValidateForm($('#form-u-group'), function (isValid) {
                if(isValid){
                    e.preventDefault();
                    addUserGroup();
                }
            });
        });
    });

    function addUserGroup() {
        showWaitDialog('Please wait...')
        $.ajax({
            url: "{{ route('addUserGroup') }}",
            type: "POST",
            data: $('#form-u-group').serialize(),
            dataType:"JSON",
            success: function (data) {
                hideWaitDialog()
                console.log(data);
                updateTable(data);
                Notify('DONE','User group added','success');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }


    function updateTable(data){
        $("#dataTable-table1").dataTable().fnDestroy()
        $('#usergroup-table').html(data);
        $("#dataTable-table1").dataTable({
            responsive: true,
            dom: "lfrtip",
        });
    }

    function showModal(id){
        showWaitDialog('Processing....')
        $.ajax({
            url: "{{ route('showForEdit') }}",
            type: "POST",
            data: {
                id: id,
                _token : $('[name = "_token"]').val()
            },
            dataType:"JSON",
            success: function (data) {
                console.log(data);
                hideWaitDialog()
                setTimeout(function () {
                    $('#modal-form')[0].reset();
                    $('.form-group').removeClass('has-error');
                    $('.help-block').empty();
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Update');
                    $('#btnSave').text('Update');
                    token = $('[name = "_token"]').val();
                    $('#usergroup').val(data.userg_name);
                    $('#id').val(id);
                }, 500);

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });

    }



    function updateUgrp(){
        showWaitDialog('Please wait...')
        $.ajax({
            url: "{{ route('updateUserGroup') }}",
            type: "POST",
            data: $('#modal-form').serialize(),
            dataType:"JSON",
            success: function (data) {
                hideWaitDialog()
                console.log(data);
                $('#modal_form').modal('hide');
                updateTable(data)
                Notify('DONE','User group updated','success');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }

    function deleteUgrp(id){
        confirmDiaglog('Are you sure ?', function () {
            showWaitDialog('Deleting....')
            $.ajax({
                url: "{{ route('deleteUserGroup') }}",
                type: "POST",
                data: {
                    id: id,
                    _token: $('[name ="_token"]').val()
                },
                dataType:"JSON",
                success: function (data) {
                    hideWaitDialog()
                    console.log(data);
                    updateTable(data)
                    Notify('DONE','User group deleted','success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });

    }
</script>
@endsection