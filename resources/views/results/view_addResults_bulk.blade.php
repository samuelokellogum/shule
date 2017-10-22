@extends('main')
@section('content')
    <div class="row">

        <!-- panel -->
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Add class results</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                    <form class="form-horizontal" id="form-re" data-parsley-validate>
                        <input type="hidden" name="_token" value="{{ Session::token() }}" />

                        <div class="col-md-2 col-sm-4 col-xs-12 form-group">
                            <select class="form-control" id="class-select" name="class" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose Class</option>
                                @if(isset($classes))
                                    @foreach($classes as $row)
                                        <option value="{{ $row->class_id }}">{{ $row->class_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-4 col-xs-12 form-group">
                            <select class="form-control" id="class-section-select" name="class_sec" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose subject</option>
                            </select>
                        </div>

                        {{--<div class="col-md-2 col-sm-4 col-xs-12 form-group">
                            <select class="form-control" id="class-section-select" name="class_sec" data-required="true"  data-trigger="change" required="required">
                                <option value="">Choose section</option>
                            </select>
                        </div>--}}

                        <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            {{--<button id="btn-import" class="btn btn-success"><i class="fa fa-upload"></i> Import File </button>--}}
                            <input id="school-badge" name="file"  type="file" class="file form-control " data-show-upload="false">
                            <button id="btn-import" class="btn btn-success pull-right"><i class="fa fa-upload"></i> Import </button>

                        </div>
                        <div class="col-md-4 col-sm-12 col-xs-12 form-group">
                            <button id="btn-confirm" class="btn btn-success pull-right"><i class="fa fa-check"></i> Approve </button>
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

            $('#school-badge').fileinput({
                allowedFileExtensions: ['xls','xlsx'],
                showPreview: false
            });

            $('#class-select').change(function () {
                var id = $(this).val();
                if(id != ""){
                    populateClassSections(id)
                }
            });

            $('#btn-import').click(function (e) {
                e.preventDefault();
                var classId = $('#class-select').val();
                if(classId == ""){
                    alertDialog('Alert !!','Please select class')
                }
            });

        });

        function populateClassSections(id){
            $.ajax({
                url: '{{ route('popClassSecR') }}',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    id: id,
                    _token: $('[name = "_token"]').val()
                },
                success: function (data) {
                    console.log(data)
                    $('#class-section-select').html(data)
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(errorThrown)
                }
            });
        }
    </script>

@endsection