<?php
  session_start();
  include('includes/config.php');
  $x=0;
  $w=70;
  $m=50;
  $cons=$_SESSION['cons'];
  // echo "<script type='text/javascript'> alert('$cons') </script>";
  $sql ="SELECT `cons`,`week`,`month` FROM `limits` WHERE `cons`=:co";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':co', $cons, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  $x=empty($results);
  if(!$x){
    $w=$results[0]->week;
    $t=100/$w;
    $m=$results[0]->month;
    $u=100/$m;
  }
  // echo "<script type='text/javascript'> alert('$x') </script>";

  if(isset($_POST['sub'])){
    $start=$_POST['start'];
    $end=$_POST['end'];
    $week=$_POST['week'];
    $month=$_POST['month'];
    if($week<120 || $month<120){
      echo "<script type='text/javascript'> alert('Limit already crossed! Try to give higher values') </script>";
    }else{
    if(empty($results)){
      $sql ="INSERT INTO `limits`( `cons`,`start`, `end`, `week`, `month`) VALUES (:co,:st,:en,:we,:mo)";
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':co', $cons, PDO::PARAM_STR);
      $query-> bindParam(':st', $start, PDO::PARAM_STR);
      $query-> bindParam(':en', $end, PDO::PARAM_STR);
      $query-> bindParam(':we', $week, PDO::PARAM_STR);
      $query-> bindParam(':mo', $month, PDO::PARAM_STR);
      $query-> execute();
      $lastInsertId = $dbh->lastInsertId();
      if($lastInsertId){
        echo "<script type='text/javascript'> alert('Inserted') </script>";
      // echo "<script type='text/javascript'> document.location = 'otp.php'; </script>";s
      } else{
        echo "<script>alert('Insertion failed');</script>";
      }
    }else{
      $sql ="UPDATE `limits` SET `start`=:st,`end`=:en,`week`=:we,`month`=:mo WHERE `cons`=:co";
      $query= $dbh -> prepare($sql);
      $query-> bindParam(':st', $start, PDO::PARAM_STR);
      $query-> bindParam(':en', $end, PDO::PARAM_STR);
      $query-> bindParam(':we', $week, PDO::PARAM_STR);
      $query-> bindParam(':mo', $month, PDO::PARAM_STR);
      $query-> bindParam(':co', $cons, PDO::PARAM_STR);
      $query-> execute();
      echo "<script type='text/javascript'> alert('Updated') </script>";
      
    }
  }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zing | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" width="450px" height="450px" src="dist/img/user2-160x160.jpg" alt="AdminLTELogo" height="60" width="60">
  </div>
  
  <?php include('includes/sidebar.php');?>

  <!-- Main Sidebar Container -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
    
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>444</h3>

                <p>Cost </p>
              </div>
              <div class="icon">
                <i class="fas fa-rupee-sign"></i>
              </div>
              <a href="https://wss.kseb.in/selfservices/quickpay" class="small-box-footer">Pay Now <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>120</h3>

                <p>Units Used</p>
              </div>
              <div class="icon">
                <i class="ion ion-flash"></i>
              </div>
              <a href="stat.php" class="small-box-footer">View Stats <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>3.52</h3>

                <p>Cost/Unit</p>
              </div>
              <div class="icon">
                <i class="fas fa-rupee-sign"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h4>Weekly limit : <?php echo htmlentities($w)?></h6>
                <h4>Monthly limit : <?php echo htmlentities($m)?></h6>
              </div>
              <div class="icon">
              <i class="fas fa-align-justify"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Usage
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#sales-chart" data-toggle="tab">Pie</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="limit.php">Set Limit</a>
                    </li> -->
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="#revenue-chart" data-toggle="tab">Line</a>
                    </li> -->
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                   
                  <!--<div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 200px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div> -->

                  
                  <div class="chart tab-pane active bg-transparent" id="sales-chart">
                    <div class="row">
                      <div class="col-6 text-center">
                        <input type="text" class="knob" data-readonly="true" value="<?php echo htmlentities($t*120)?>" data-width="240" data-height="240"
                               data-fgColor="#39CCCC">

                        <div class="text-black">Weekly Limit in %</div>
                      </div>
                      <!-- ./col -->
                      <div class="col-6 text-center">
                        <input type="text" class="knob" data-readonly="true" value="<?php echo htmlentities($u*120)?>" data-width="240" data-height="240"
                               data-fgColor="#39CCCC">
    
                        <div class="text-black">Monthly Limit in %</div>
                      </div>
                      <!-- ./col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->


            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Daily Usage
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">
                      <a class="nav-link" href="#revenue-chart" data-toggle="tab">Yesterday</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link active" href="#sales-chart" data-toggle="tab">Today</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                   
                  <!-- <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 200px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div> -->
                  <div class="chart tab-pane active bg-transparent" id="sales-chart">
                    <div class="chart tab-pane" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  </div>
                  
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            

            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Tips For Improving
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <!-- <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div> -->
                    <!-- todo text -->
                    <span class="text">Reduce fan</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-success"><i class="far fa-clock"></i> 5% increase</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <!-- <i class="fas fa-edit"></i> -->
                      <i class="fas fa-trash"></i>
                    </div>
                  </li>
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <!-- <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div> -->
                    <!-- todo text -->
                    <span class="text">Tip 2</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-success"><i class="far fa-clock"></i> 45% increase</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <i class="fas fa-trash"></i>
                      <!-- <i class="fas fa-trash-o"></i> -->
                    </div>
                  </li>
                  <li>
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <!-- checkbox -->
                    <!-- <div  class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="" name="todo1" id="todoCheck1">
                      <label for="todoCheck1"></label>
                    </div> -->
                    <!-- todo text -->
                    <span class="text">Tip 3</span>
                    <!-- Emphasis label -->
                    <small class="badge badge-danger"><i class="far fa-clock"></i> 20% decrease</small>
                    <!-- General tools such as edit or delete-->
                    <div class="tools">
                      <!-- <i class="fas fa-edit"></i> -->
                      <i class="fas fa-trash"></i>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
              <!-- <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
              </div> -->
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            <!-- Calendar -->
            <div class="card bg-gradient-success">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-flash"></i>
                  Limit
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->

                <form method="POST">
                <div class="card card-danger">
              <div class="card-body">
                <!-- Date dd/mm/yyyy -->
                <div class="form-group">
                  <label class="text-primary">Start and End Date</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control" name="start" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- Date mm/dd/yyyy -->
                <div class="form-group">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="date" class="form-control" name="end" data-inputmask-alias="datetime" data-inputmask-inputformat="mm/dd/yyyy" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label class="text-primary">Limit in Units(Weekly)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-algolia"></i></span>
                    </div>
                    <input type="text" class="form-control" name="week" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- phone mask -->
                <div class="form-group">
                  <label class="text-primary">Limit in Units(Monthly)</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fab fa-algolia"></i></span>
                    </div>
                    <input type="text" class="form-control" name="month"
                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>

                <div class="form-group">

                  <div class="input-group">
                    
                    <input type="submit" class="form-control" name="sub"
                           data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" data-mask>
                  </div>
                  <!-- /.input group -->
                </div>


                <!-- /.form group -->
              </form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
            </div>
            <!-- Map card -->
            <div class="card bg-gradient-primary">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-map-marker-alt mr-1"></i>
                  Power Plants
                </h3>
                <!-- card tools -->
                <div class="card-tools">
                  <!-- <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                    <i class="far fa-calendar-alt"></i>
                  </button> -->
                  <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <div class="card-body">
                <div id="world-map" style="height: 400px; width: 100%;"><img src="dist/img/map.jpg"></div>
              </div>
              <!-- /.card-body-->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <div id="sparkline-1"></div>
                    <div class="text-white">Total</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-2"></div>
                    <div class="text-white">Production</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <div id="sparkline-3"></div>
                    <div class="text-white">Consumption</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->

        </div>
        <!-- /.row (main row) -->
        
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
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
