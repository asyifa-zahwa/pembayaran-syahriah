<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>asset/mylogo.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>asset/mylogo.png">
  <title>
    Pesantren Al-Muhsin
  </title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="<?= base_url() ?>asset/temp/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url() ?>asset/temp/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="<?= base_url() ?>asset/temp/assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
  <!-- jquery -->
  <script src="<?= base_url() ?>asset/jquery/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="">
        <img src="<?= base_url() ?>asset/mylogo.png" class="navbar-brand-img ms-4 h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white text-center">SAHAM<br>Syahriyah Pesantren Al-Muhsin</span>
        <!-- div>
          <span class="ms-1 font-weight-bold text-white text-center"></span>
        </div> -->
          
          <!-- <span class="ms-1 font-weight-bold text-white">Al-Muhsin</span> -->

        
        <!-- <span class="ms-1 font-weight-bold text-white">SPP <?= $this->uri->segment(1); ?>☻</span> -->
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height: calc(100vh - 150px);">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($this->uri->segment(1) == 'dashboard') {
                                          echo 'active bg-gradient-success';
                                        } ?>" href="<?= base_url() ?>dashboard">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">dashboard</i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($this->uri->segment(1) == 'santri') {
                                          echo 'active bg-gradient-success';
                                        } ?>" href="<?= base_url() ?>santri">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Data Santri</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($this->uri->segment(1) == 'spp') {
                                          echo 'active bg-gradient-success';
                                        } ?>" href="<?= base_url() ?>spp/bulanan">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">table_view</i>
            </div>
            <span class="nav-link-text ms-1">Data SPP</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white <?php if ($this->uri->segment(1) == 'tagihan') {
                                          echo 'active bg-gradient-success';
                                        } ?>" href="<?= base_url() ?>tagihan/bulanan">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">receipt_long</i>
            </div>
            <span class="nav-link-text ms-1">Pembayaran SPP</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white " href="<?= base_url() ?>auth/logout">
            <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
              <i class="material-icons opacity-10">logout</i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <!-- <span type="button" class="badge badge-sm bg-gradient-success" onclick="history.go(-1)">&laquo; </span>
            <span type="button" class="badge badge-sm bg-gradient-success" onclick="history.go(1)"> &raquo;</span> -->
            <!-- <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="<?= $this->uri->segment(1)  ?>" style="text-transform: capitalize;"><?= $this->uri->segment(1)  ?></a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?= $title  ?></li> -->
          </ol>
          <h6 class="font-weight-bolder mb-0"><?= $title  ?></h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <!-- <div class="input-group input-group-outline">
              <label class="form-label">Type here...</label>
              <input type="text" class="form-control">
            </div> -->
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="<?= base_url() ?>auth/logout" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-sign-out me-sm-1"></i>
                <span class="d-sm-inline d-none">Logout</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <!-- <button class="btn btn-sm btn-info" onclick="hapus('<?= base_url() ?>santri', 'Apakah Anda Yakin Ingin Menghapus.!!')">hapus</button> -->
      <?php if ($isi) {
        $this->load->view($isi);
      } ?>
      <footer  class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-12 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                Copyright &copy; 2021-<?= date('Y') ?> <a href="">Pondok Pesantren Al-Muhshin</a>
              </div>
            </div>
            <!-- <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div> -->
          </div>
        </div>
      </footer>
    </div>
  </main>
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="material-icons py-2">settings</i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Material UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="material-icons">clear</i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3 d-flex">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
        <hr class="horizontal dark my-3">
        <div class="mt-2 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <hr class="horizontal dark my-sm-4">
        <!-- di setting -->
      </div>
    </div>
  </div>
  <!-- modal hapus -->
  <div class="modal fade" id="hapus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="kata"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <a type="button" class="btn btn-success" id="url">Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <!-- end modal hapus -->
  <!-- notifikasi -->
  <div class="position-fixed top-2 end-1 z-index-2">
    <?php if ($this->session->flashdata('pesan')) { ?>
      <div class="toast fade show pesan p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-success me-2">
            check
          </i>
          <span class="me-auto font-weight-bold">Sukses</span>
          <small class="text-body">.</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          <h1>
            <p><?= $this->session->flashdata('pesan'); ?></p>
          </h1>
        </div>
      </div>
    <?php }
    if ($this->session->flashdata('error')) { ?>

      <div class="toast fade show pesan p-2 mt-2 bg-white" role="alert" aria-live="assertive" id="dangerToast" aria-atomic="true">
        <div class="toast-header border-0">
          <i class="material-icons text-danger me-2">
            campaign
          </i>
          <span class="me-auto text-gradient text-danger font-weight-bold">Error </span>
          <small class="text-body">.</small>
          <i class="fas fa-times text-md ms-3 cursor-pointer" data-bs-dismiss="toast" aria-label="Close"></i>
        </div>
        <hr class="horizontal dark m-0">
        <div class="toast-body">
          <h1>
            <p><?= $this->session->flashdata('error'); ?></p>
          </h1>
        </div>
      </div>
    <?php } ?>
  </div>
  <!-- end notifikasi -->
  <!--   Core JS Files   -->
  <script src="<?= base_url() ?>asset/temp/assets/js/core/popper.min.js"></script>
  <script src="<?= base_url() ?>asset/temp/assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>asset/temp/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="<?= base_url() ?>asset/temp/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    setTimeout(function() {
      $(".pesan").removeClass('show');
      $(".pesan").addClass('hide');
    }, 5000);

    function hapus(url, kata) {
      $('#hapus').modal('show');
      $('#url').attr('href', url);
      $('#kata').html(kata)
    }
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?= base_url() ?>asset/temp/assets/js/material-dashboard.min.js?v=3.0.2"></script>
</body>

</html>