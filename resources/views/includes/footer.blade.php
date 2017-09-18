
<!-- jQuery -->
<script src="{{ URL::to('js/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ URL::to('js/bootstrap.min.js') }}"></script>
<!-- Smart wizard -->
<script src="{{ URL::to('js/jquery.smartWizard.js') }}"></script>

<!-- Parsley -->
<script src="{{ URL::to('js/parsley.min.js') }}"></script>

<!-- bootstrap date picker  -->
<script src="{{ URL::to('js/bootstrap-datepicker.min.js') }}"></script>

<!-- Data tables  -->
<script src="{{ URL::to('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('js/dataTables.bootstrap.min.js') }}"></script>



<!-- select 2 js-->
<script src="{{ URL::to('js/select2.min.js') }}"></script>

<!-- resize image file input plugin -->
<script src="{{ URL::to('js/piexif.min.js') }}"></script>

<!-- purify preview from file input preview helper -->
<script src="{{ URL::to('js/purify.min.js') }}"></script>

<!-- sort files in file input plugin-->
<script src="{{ URL::to('js/sortable.min.js') }}"></script>

<!-- main js for file input plugin-->
<script src="{{ URL::to('js/fileinput.min.js') }}"></script>

<!-- Pnotify -->
<script src="{{ URL::to('js/pnotify.js') }}"></script>
<script src="{{ URL::to('js/pnotify.buttons.js') }}"></script>
<script src="{{ URL::to('js/pnotify.nonblock.js') }}"></script>

<!-- comfirm dialogs -->
<script src="{{ URL::to('js/jquery-confirm.min.js') }}"></script>

<!-- waiting-->
<script src="{{ URL::to('js/waitingfor.js') }}"></script>


<!-- Custom Theme Scripts -->
<script src="{{ URL::to('js/custom.min.js') }}"></script>


<!-- Shule Scripts -->
<script src="{{ URL::to('js/shule.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.datepicker').datepicker({
            autoclose: true,
            format: "yyyy-mm-dd",
            todayHighlight: true,
            orientation: "top auto",
            todayBtn: true,
            todayHighlight: true,

        });

        $('#dataTable-table1').DataTable({
            responsive: true,
            dom: "lfrtip",
        });

        $('#dataTable-table2').DataTable({
            responsive: true,
            dom: "lfrtip",
        })

    });
</script>
