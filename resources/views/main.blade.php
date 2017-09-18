@include('includes.header')
<body class="nav-md">
	<div class="container body">
      <div class="main_container">
      @include('includes.sidemenu')
	@include('includes.topnav')
	  
	  <!-- page content -->
        <div class="right_col" role="main">
			@yield('content')
		</div>
		<!-- /page content -->
	  </div>
    </div>
	<!-- footer content -->
	<footer>
		<div class="pull-right">
			Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
		</div>
		<div class="clearfix"></div>
	</footer>
	<!-- /footer content -->
	@include('includes.footer')
</body>
</html>