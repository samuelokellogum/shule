@extends('main')
@section('content')
    <div class="row">

        <!-- panel -->
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Assign menus</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form class="form-horizontal" id="form-assign" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />
                        <div class="col-md-12 col-sm-9 col-xs-12 form-group">
                            <select class="form-control" id="user-group" name="usergroup" required="required" data-required="true"  data-trigger="change">
                                <option value="">Select user group</option>
                                @if(isset($usergroups))
                                    @foreach($usergroups as $row)
                                        <option value="{{ $row->ug_id }}">{{ $row->userg_name }}</option>
                                        @endforeach
                                    @endif
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-9 col-xs-12 form-group">
                            <select class="form-control" id="select-menu" name="menu" required="required" data-required="true"  data-trigger="change">
                                <option value="">Select Menu</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <button type="submit" id="btn-assign" class="btn btn-success">Assign</button>
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
                            <th>Menu</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody id="menu-table">
                        @if(isset($tabledata))
                            <?php $count = 1; ?>
                            @foreach($tabledata as $row)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $row->userg_name }}</td>
                                    <td> {{ $row->menu_name }}</td>
                                    <td>
                                        <a href="#"onclick="unAssing({{ $row->mid }})"><i class="fa fa-trash-o fa-fw"></i></a>
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

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#user-group').change(function () {
                var id = $(this).val();
                if(id !=  ""){
                    populateMenu(id);
                }
            });

            $('#btn-assign').click(function (e) {

                sValidateForm($('#form-assign'), function (isValid) {
                    if(isValid){
                        e.preventDefault();
                        assignMenu();

                    }
                });
            });
        });

        function populateMenu(usergroup){
            showWaitDialog('loading data..')
            $.ajax({
                url: "{{ route('popMenuByUG') }}",
                type: "POST",
                data:{
                    usergroup: usergroup,
                    _token : $('[name ="_token"]').val()
                } ,
                dataType:"JSON",
                success: function (data) {
                    console.log(data);
                    $('#select-menu').html(data);
                    hideWaitDialog()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function assignMenu() {
            $.ajax({
                url: "{{ route('aUmenus') }}",
                type: "POST",
                data: $('#form-assign').serialize(),
                dataType:"JSON",
                success: function (data) {
                    console.log(data);
                    updateTable(data)
                    Notify('DONE','Menu assigned','success');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        }

        function unAssing(id) {
          if(confirm('Are you sure ?')){
              $.ajax({
                  url: "{{ route('unAssign') }}",
                  type: "POST",
                  data: {
                      id:id,
                      _token: $('[name ="_token"]').val()
                  },
                  dataType:"JSON",
                  success: function (data) {
                      console.log(data);
                      updateTable(data)
                      Notify('DONE','Menu removed','success');
                  },
                  error: function (jqXHR, textStatus, errorThrown) {
                      alert(errorThrown);
                  }
              });
          }
        }

        function updateTable(data){
            $("#dataTable-table1").dataTable().fnDestroy()
            $('#menu-table').html(data);
            $("#dataTable-table1").dataTable({
                responsive: true,
                dom: "lfrtip",
            });
        }


    </script>
@endsection