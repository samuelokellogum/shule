@extends('main')
@section('content')
<div class="row">
    <!-- panel -->
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Main menu</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form  class="form-horizontal" id="form-menu" data-parsley-validate>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control" required="required"  name="menuname" id="menu-name" placeholder="Menu name">
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" id="btn-menu" class="btn btn-success pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->
    <!-- panel -->
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Sub menus</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form class="form-horizontal" id="form-s-menu" data-parsley-validate>
                    <input type="hidden" name="_token" value="{{ Session::token() }}" />
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <select class="form-control" name="menu"  data-required="true"  data-trigger="change" required="required" id="select-menu">
                            <option value="">Choose menu</option>
                            @if(isset($menus))
                                @foreach($menus as $row)
                                    <option value="{{ $row->menu_id }}">{{ $row->menu_name }}</option>
                                @endforeach
                                @endif
                        </select>
                    </div>

                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control" required="required" name="sname" id="sub-m-name" placeholder="Sub menu name">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                        <input type="text" class="form-control" required="required" name="slink" id="sub-m-link" placeholder="link / route">
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" id="btn-s-menu" class="btn btn-success pull-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.panel -->


</div>

<!-- jQuery -->
<script src="{{ URL::to('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#btn-menu').click(function (e) {
            sValidateForm($('#form-menu'), function (isValid) {
                if(isValid){
                    e.preventDefault()
                    addMenu();
                    //console.log($('[name ="_token"]').val())
                }
            });
        });

        $('#btn-s-menu').click(function (e) {
            sValidateForm($('#form-s-menu'), function (isValid) {
                if(isValid){
                    e.preventDefault();
                    addSubMenu()
                }
            });
        });

    });

    function addMenu() {
        showWaitDialog('Please wait...');
        $.ajax({
            url: "{{ route('addMenu') }}",
            type: "POST",
            data: $('#form-menu').serialize(),
            dataType:"JSON",
            success: function (data) {
                hideWaitDialog();
                console.log(data);
                $('#select-menu').html(data);
                Notify('DONE','Menu added','success');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }

    function addSubMenu(){
        $.ajax({
            url: "{{ route('addSubMenu') }}",
            type: "POST",
            data: $('#form-s-menu').serialize(),
            dataType:"JSON",
            success: function (data) {
                console.log(data);
                $('#select-menu').html(data);
                Notify('DONE','Sub menu added','success');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    }




</script>
@endsection