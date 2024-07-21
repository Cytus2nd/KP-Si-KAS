<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SiKas | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- sweet alert 2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- css -->
  <link rel="stylesheet" href="./assets/css/login.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box bg-light rounded-lg shadow-lg">
    <div class="login-logo">
      <img src="./assets/img/logo.png" alt="" class="img-fluid mt-2">
      <p><b class="fw-bold">SI-Kas Maitreyawira</b></p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body rounded-lg login-card-body">
        <p class="login-box-msg">Harap Masuk Terlebih Dahulu</p>

        <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan Username...">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Masukkan Password...">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
                <label for="exampleFormControlSelect1">Pilih Jabatan</label>
                <div class="input-group">
                    <select class="form-control" id="exampleFormControlSelect1">
                        <option value="" disabled selected>Pilih Jabatan Anda...</option>
                        <option>Waka Kesiswaan</option>
                        <option>Bendahara</option>
                        <option>Kepala Sekolah</option>
                        <option>Bendahara Osis</option>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fa fa-tasks"></span>
                        </div>
                    </div>
                </div>
            </div>
          <!-- /.col -->
          <div class="col-12">
            <a type="submit" href="./starter.html" class="btn btn-primary btn-block">Sign In</a>
          </div>
          <!-- /.col -->
      </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="app/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="app/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="app/dist/js/adminlte.min.js"></script>
  <!-- sweet alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>