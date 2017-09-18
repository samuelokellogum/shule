@extends('main')
@section('content')
<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href="{{ route('viewAddUser') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add user</a>
    </div>

    <!-- panel -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Users</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />

                <table id="dataTable-table1" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                     @if(isset($users))
                         <?php $count = 1; ?>
                         @foreach($users as $row)
                             <tr>
                                 <td>{{ $count }}</td>
                                 <td><img src="{{ route('userImage',['filename' => $row->image])}}" alt="..." class="img-circle" style="width: 50px;height: 50px"></td>
                                 <td>{{ $row->fname}} {{ $row->lname }}</td>
                                 <td>{{ $row->email }}</td>
                                 <td>{{ $row->contact }}</td>
                                 <td>{{ $row->userg_name }}</td>
                                 <td>

                                     <div class="btn-group">
                                         <button type="button" class="btn btn-success">Action</button>
                                         <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                             <span class="caret"></span>
                                             <span class="sr-only">Toggle Dropdown</span>
                                         </button>
                                         <ul class="dropdown-menu" role="menu">
                                             <li><a href="{{ route('viewUserById',['userid' => $row->user_id]) }}" ><i class="fa fa-edit"></i> Edit</a>
                                             </li>
                                             <li><a href="#"><i class="fa fa-trash"></i> Delete</a>
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
            </div>
        </div>
    </div>
    <!-- /.panel -->

</div>
@endsection