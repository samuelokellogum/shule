@extends('main')
@section('content')
    <div class="row">

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>View results</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form class="form-horizontal" id="form-grading" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />

                        <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                            <select class="form-control" id="class-select" name="class" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose Class</option>
                                @if(isset($classes))
                                    @foreach($classes as $row)
                                        <option value="{{ $row->gradCat_id }}">{{ $row->gradCat_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                            <select class="form-control" id="class-section-select" name="class_sec" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose Class sestion</option>
                                @if(isset($classes))
                                    @foreach($classes as $row)
                                        <option value="{{ $row->gradCat_id }}">{{ $row->gradCat_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-4 col-sm-3 col-xs-12 form-group">
                            <button id="btn-view" class="btn btn-success"><i class="fa fa-eye"></i> View </button>
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
@endsection