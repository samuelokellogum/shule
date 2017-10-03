@extends('main')
@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('viewAssigSub') }}" class="btn btn-success pull-left"><i class="fa fa-arrow-left"></i>  Go back</a>
    </div>

    <!-- panel -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ $class_name }}  @if(isset($teachers))  [ {{ $teachers[0]->subject_name.'   '.$teachers[0]->subject_code }} ]  Teachers @endif</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody id="teachers-table">
                    @if(isset($teachers))
                        <?php $count = 1; ?>
                        @foreach($teachers as $row)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $row->fname}} {{ $row->lname }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->contact }}</td>
                                <td>

                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success">Action</button>
                                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#" onclick="removeTeacher({{ $row->st_id }})"><i class="fa fa-trash"></i> Remove</a>
                                            </li>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                            <?php $count++; ?>
                        @endforeach
                    @endif

                    </tbody>
                </table>

                <form>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <input type="hidden" id="count-val" value="{{ count($teachers) }}"/>
                    <input type="hidden" id="class-id" value="{{ count($class_id) }}"/>
                    <input type="hidden" id="subject-id" value="{{ count($subject_id) }}">

                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->

    <!-- jQuery -->
    <script src="{{ URL::to('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        function removeTeacher(id) {
            if(parseInt($('#count-val').val()) > 1){
                confirmDiaglog('Are you sure ?', function () {
                    showWaitDialog('Removing...')
                    $.ajax({
                        url:'{{ route('removeTeacher') }}',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            id: id,
                            _token : $('[name = "_token"]').val(),
                            class_id: $('#class-id').val(),
                            subject_id: $('#subject-id').val()
                        },
                        success: function (data) {
                            hideWaitDialog()
                            console.log(data)
                            updateTableClass(data)
                            Notify('Done', 'Teacher removed', 'success');
                        },
                        error: function(j, textStatus, errorThrown){
                            alert(errorThrown)
                        }
                    });
                });

            }else{
                alertDialog('Subject must have atleast one teacher')
            }
        }
        function updateTableClass(data){
            $("#dataTable-table1").dataTable().fnDestroy()
            $('#teachers-table').html(data);
            $("#dataTable-table1").dataTable({
                responsive: true,
                dom: "lfrtip",
            });
        }
    </script>

@endsection