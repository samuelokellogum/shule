@extends('main')
@section('content')
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">		 	 
		  		@if ($message = Session::get('success'))
					<div class="alert alert-success" role="alert">
						{{ Session::get('success') }}
					</div>
				@endif

				@if ($message = Session::get('error'))
					<div class="alert alert-danger" role="alert">
						{{ Session::get('error') }}
					</div>
				@endif
                    <a href="{{ route('createStudent') }}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add Student</a>            
				<h4>Import/Export Data</h4>
				<form style="border: 1px solid #a1a1a1;margin-top: 15px;padding: 20px;" action="{{ URL::to('importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">

					<input type="file" name="import_file" />
					{{ csrf_field() }}
					<br/>
					<button class="btn btn-primary">Import CSV or Excel File</button>

                    <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success btn-md">Download Excel xls</button></a>
					<a href="{{ url('downloadExcel/xlsx') }}"><button class="btn btn-success btn-md">Download Excel xlsx</button></a>
					<a href="{{ url('downloadExcel/csv') }}"><button class="btn btn-success btn-md">Download CSV</button></a>				
                </form>
				

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Students</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <table id="dataTable-table1" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Image </th>
                            <th>Student Name</th>
                            <th>Student Number</th>
                            <th>Admission Date</th>                            
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($student))
                            <?php $count = 1; ?>
                            @foreach($student as $row)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td><img src="{{ route('userImage',['filename' => $row->image])}}" alt="..." class="img-circle" style="width: 50px;height: 50px"></td>
                                    <td>{{ $row->fname}} {{ $row->lname }}</td>
                                    <td>{{ $row->student_id }}</td>
                                    <td>{{ $row->adminYear }}</td>                                    
                                    <td>{{ $row->status }}</td>
                                    <td>

                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success">Action</button>
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{ route('viewStudentById',['userid' => $row->student_id]) }}" ><i class="fa fa-edit"></i> Edit</a>
                                                </li>
                                                <li><a href="{{route('deleteStudent', ['userid' => $row->student_id])}}"><i class="fa fa-trash"></i> Delete</a>
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
