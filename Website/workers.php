<?php
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	@media print {
		a[href]:after {
		content: none !important;
		}
	}
	</style>
  <script>
  function printDiv(divName) 
	{
		var printContents = document.getElementById(divName).innerHTML;
		var originalContents = document.body.innerHTML;
		document.body.innerHTML = printContents;
		window.print();
		document.body.innerHTML = originalContents;
	}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX3wiSSmdoxAgiajKxe3iJSXSmoQgMZOo&callback=initMap"
  type="text/javascript"></script>
    <script type="text/javascript">
        window.onload = function () {
            var mapOptions = {
                center: new google.maps.LatLng(17.5392, 76.8713),
                zoom: 6,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var infoWindow = new google.maps.InfoWindow();
            var latlngbounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
            google.maps.event.addListener(map, 'click', function (e) {
                alert("Latitude: " + e.latLng.lat() + "\r\nLongitude: " + e.latLng.lng());
				document.getElementById("latitude").value = e.latLng.lat();
				document.getElementById("longitude").value = e.latLng.lng();
            });
        }

		
		function geocodeLatLng(geocoder, map, infowindow) {
        var lati = document.getElementById('latitude').value;
		var lngi = document.getElementById('longitude').value;
        var latlng = {lat: parseFloat(lati), lng: parseFloat(lngi)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(11);
              var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });
			  document.getElementById("address").value = results[0].formatted_address;
              infowindow.setContent(results[0].formatted_address);
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
      }
	  
	  
	  $(document).ready(function (e) {
	$("#newworker").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "add_worker.php",
			type: "POST",
			data:  new FormData(this),
			beforeSend: function(){$("#body-overlay").show();},
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
			$("#addworkerresponse").html(data);
			location.reload();
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
	}));
});
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">John Abraham</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  John Abraham
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="#" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="workers.php">
            <i class="fa fa-group"></i> <span>Workers</span>
          </a>
        </li>
        <li>
          <a href="settings.html">
            <i class="fa fa-gears"></i> <span>Settings</span>
          </a>
        </li>
		
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<section class="content-header">
					<h1>
						Workers
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.html"><i class="fa fa-dashboard"></i> Home</a></li>
						<li class="active">Workers</li>
					</ol>
				</section>
	
				
				<section class="content">
					<div id="demo" class="collapse">
						<div class="row">
							<div class="col-md-6">
								<div class="box box-primary">
									<div class="box-header with-border">
										<h3 class="box-title">Quick Example</h3>
									</div>
									<form role="form" id="newworker">
									<div id="addworkerresponse"></div>
										<div class="box-body">
											<div class="form-group">
												<label for="exampleInputEmail1">Name</label>
												<input type="text" class="form-control" name="name" id="name" placeholder="Enter Full Name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Mobile</label>
												<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Full Name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">UserName</label>
												<input type="text" class="form-control" name="username" id="username" placeholder="Enter User Name">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Password</label>
												<input type="text" class="form-control" name="password" id="password" placeholder="Enter password ">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Latitude</label>
												<input type="text" class="form-control" name="latitude" id="latitude" placeholder="Click on the Map">
											</div>
											<div class="form-group">
												<label for="exampleInputEmail1">Longtiude</label>
												<input type="text" class="form-control" name="longitude" id="longitude" placeholder="Click on the Map">
											</div>
											<div class="form-group">
												<label for="exampleInputFile">Worker Image</label>
												<input type="file" name="userfile1[]" id="userfile1[]">
											</div>
											<div class="form-group">
												<input type="submit" name="Add Worker">
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="col-md-6">
								<div id="dvMap" style="width: 530px; height: 530px">
								</div>
								<button onclick="geocodeLatLng()">af</button>
							</div>
						</div>
					</div>
	
	
	<div class="row" id="print_data">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Worker's Details</h3>
			  <div class="box-tools">
                <ul class="pagination pagination-sm no-margin pull-right">
				
				  <li><button type="button" class="btn btn-info btn-sm" data-toggle="collapse" data-target="#demo"><i class="fa fa-plus"></i></button></li>
				  <li><button type="button" class="btn btn-info btn-sm" onclick="printDiv('print_data')"><i class="fa fa-print"></i></button></li>
                </ul>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Worker id</th>
                  <th>Worker Name</th>
                  <th>Last Login</th>
                  <th>Username</th>
                  <th>Latitude</th>
				  <th>Longitude</th>
				  <th>Tools</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$query = "select * from users";
				$query = mysqli_query($db,$query);
				foreach($query as $que)
				{
				?>
                <tr>
                  <td><?php echo $que["id"]; ?></td>
                  <td><?php echo $que["name"]; ?></td>
                  <td><?php echo $que["lastlogin"]; ?></td>
                  <td><?php echo $que["username"]; ?></td>
                  <td><?php echo $que["latitude"]; ?></td>
				  <td><?php echo $que["longitude"]; ?></td>
				  <td>
				  <center>
					<button class="btn btn-xs btn-info"><i class="fa fa-picture-o"></i></button>
					<button class="btn btn-xs btn-info"><i class="fa fa-map"></i></button>
					<button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
					</center>
                </tr>
				<?php } ?>
                </tfoot>
              </table>
            </div>
			<div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-left">
                <li><a href="#">&laquo;</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
            <!-- /.box-body -->
          </div>
        </div>
      <!-- Small boxes (Stat box) -->
	  </div>
	  </div>
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
