<?php include('core.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zing | Algorithm</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include('includes/sidebar.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Table of Datasets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataSets</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Time</th>
                      <th>Housing</th>
                      <th>Commercial</th>
                      <th>Education</th>
                      <th>Shop</th>
                      <th>Hospital</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                        for($i=0;$i<24;$i++){?>
                           
                    <tr>
                      <td><?php echo htmlentities($i+1)?></td>
                      <td><?php echo htmlentities(date('H:i:s',strtotime('00:00:00 ')+60*$i*60))?></td>
                      <td><?php echo htmlentities(round($houses[$i],2))?> </td>
                      <td><?php echo htmlentities(round($com[$i],2))?> </td>
                      <td><?php echo htmlentities($edu[$i])?> </td>
                      <td><?php echo htmlentities(round($shop[$i],2))?> </td>
                      <td><?php echo htmlentities($hospital[$i])?> </td>
                      <td><?php echo htmlentities(round($total[$i],2))?> </td>
                      <!-- <td><span class="badge bg-danger"></span></td> -->
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
          </div>
          </div>
          </div>
          </div>
        </div>
      </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
