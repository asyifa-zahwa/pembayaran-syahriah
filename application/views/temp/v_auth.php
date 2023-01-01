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
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="<?= base_url() ?>asset/temp/assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
    <!-- jquery -->
    <script src="<?= base_url() ?>asset/jquery/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-200">
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg blur border-radius-xl top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
                    <div class="container-fluid ps-2 pe-0">
                        <!-- <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="<?= base_url() ?>">
                            Pondok Pesantren Al-Muhsin
                        </a> -->
                        <a href="">
                            <img src="<?= base_url() ?>asset/mylogo.png" alt="" width="35" height="35" class="d-inline-block align-top">
                            <h4 class="m-1 ms-3 d-inline-block">Syahriyah Pondok Pesantren Al-Muhsin</h4>
                        </a>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>
        </div>
    </div>
    <main class="main-content  mt-0">
        <!-- <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');"> -->
        <div class="page-header align-items-start min-vh-100" style="background-image: url('<?= base_url() ?>asset/mybg.jpg');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container my-auto">
                <div class="row">
                    <div class="col-lg-4 col-md-8 col-12 mx-auto">
                        <div class="card z-index-0 fadeIn3 fadeInBottom">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-success shadow-success border-radius-lg py-3 pe-1">
                                    <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Bendahara Pondok</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="<?= base_url() ?>auth/login" method="post">
                                    <div class="input-group input-group-outline my-3">
                                        <!-- <label class="form-label">Username</label> -->
                                        <input type="text" class="form-control" name="username" placeholder="Username">
                                    </div>
                                    <div class="input-group input-group-outline mb-3">
                                        <!-- <label class="form-label">Password</label> -->
                                        <input type="password" class="form-control" name="password" placeholder="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-success w-100 my-4 mb-2">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="footer position-absolute bottom-2 py-2 w-100">
                <div class="container">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-12 col-md-6 my-auto">
                            <div class="copyright text-center text-sm text-white text-lg-start">
                                Copyright &copy; 2022-<?= date('Y') ?> <a class="font-weight-bold text-white" href="">Pondok Pesantren Al-Muhshin</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>
    <!-- notif -->
    <div class="position-fixed bottom-1 end-1 z-index-2">
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