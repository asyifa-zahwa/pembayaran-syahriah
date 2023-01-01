<!DOCTYPE html>
<html lang="en">

<head>
	<title>Pesantren Al-Muhsin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Asyifa Zahwa">

	<link rel="icon" href="<?= base_url() ?>asset/mylogo.png">
	<link id="pagestyle" href="<?= base_url() ?>asset/temp/assets/css/material-dashboard.css?v=3.0.2" rel="stylesheet" />
	<!-- <link href="http://localhost/codeigniter/sekolah/assets/plugin/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
	<link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/home/home.css">

	<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>


<style>
	body {
		background-color: #f3f3f3;
	}
</style>
</head>

<body>
	<!-- jam dan Back to Top-->
	<h3 style="color: black; position: fixed; bottom:40px ; right: 40px;z-index: 1;">
		<div class="btn btn-sm btn-light backTop" style="border: 2px solid black;">
			<div id='jam'></div>
		</div>
	</h3>
	<div class="super_container">
		<!-- Header -->
		<header class="header">
			<nav class="main-header navbar navbar-expand-lg bg-light" style="border-bottom: 3px solid #14bdee;">
				<div class="container">
					<a href="">
						<img src="<?= base_url() ?>asset/mylogo.png" alt="" width="55" height="55" class="d-inline-block align-top">
						<h6 class="m-1 ms-3 d-inline-block">SAHAM <br>Syahriyah Al-Muhsin </h6>
						<h6 class="m-1 ms-3 d-inline-block"></h6>
					</a>
					<div class="top_bar_login ml-auto mb-0">
						<a class="btn btn-sm btn-blue m-0" href="<?= base_url() ?>auth">Login</a>
					</div>
				</div>
			</nav>
		</header>
		<!-- content -->
		<?php if ($isi) {
			$this->load->view($isi);
		} ?>
		<!-- Footer -->
		<footer class="footer" style="margin-top: 100px;">
			<!-- <div class="footer_background" style="background-image:url(<?= base_url() ?>asset/home/footer_background.png)">
			</div> -->
			<div class="container">
				<div class="row footer_row">
					<div class="col">
						<div class="footer_content">
							<div class="row">

								<div class="col-md-6 footer_col">

									<!-- Footer About -->
									<div class="footer_section footer_about text-center">
										<div class="footer_logo_container">
											<a href="#">
												<div class="footer_logo_text">Pondok Pesantren Al-Muhsin</div>
											</a>
										</div>
										<div class="footer_about_text">
											<p>Terwujudnya Peserta Didik Yang Beriman, Cerdas, Terampil, Mandiri Dan
												Berwawasan Global </p>
										</div>
										<!-- <div >
											<ul>
												<li><a href="https://www.facebook.com/ponpesalmuhsinjogja/"><i class="fa fa-facebook-official" style="color:blue"></i></a>
												</li>
												<li><a href="https://www.youtube.com/channel/UCgQznsSTdxYyPlWerbqJdPw"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
												<li><a href="https://instagram.com/almuhsin_yogyakarta/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
											</ul>
										</div> -->
									</div>

								</div>

								<div class="col-md-6 footer_col" style="text-align: left;">

									<!-- Footer Contact -->
									<div class="footer_section footer_contact">
										<div class="footer_title text-center">Kontak</div>
										<div class="footer_contact_info">
											<ul>
												<li>Email : almuhsinwp@gmail.com </li>
												<li>No Telepon : 089616371068 (wa) </li>
												<li>Alamat : Jl. Masjid Nglaren No.112 Condong Catur, Depok, Sleman, Yogyakarta 55283</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row copyright_row">
					<div class="col">
						<div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-center">
							<div class="cr_text ">
								Copyright &copy; 2022-<?= date('Y') ?> <a class="font-weight-bold text-white" href="">Pondok Pesantren Al-Muhshin</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="position-fixed top-8 end-1 z-index-2">
		<?php if ($this->session->flashdata('pesan')) { ?>
			<div class="toast fade show pesan p-2 bg-white" role="alert" aria-live="assertive" id="successToast" aria-atomic="true">
				<div class="toast-header border-0">
					<span class="me-auto font-weight-bold">Sukses</span>
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
					<span class="me-auto text-gradient text-danger font-weight-bold">Error </span>
				</div>
				<hr class="horizontal dark m-0">
				<div class="toast-body">
					<h1>
						<p><?= $this->session->flashdata('error'); ?></p>
					</h1>
				</div>
			</div>
		<?php } ?>
		<!-- <script src="http://localhost/codeigniter/sekolah/assets/js/jquery-3.2.1.min.js"></script> -->

		<script>
			setTimeout(function() {
				$(".pesan").removeClass('show');
				$(".pesan").addClass('hide');
			}, 5000);
		</script>

		<!-- back to top -->
		<script type="text/javascript">
			var $backToTop = $(".backTop");
			$backToTop.on('click', function(e) {
				$("html, body").animate({
					scrollTop: 0
				}, 500);
			});
		</script>

		<!-- jam -->
		<script type="text/javascript">
			window.setTimeout("waktu()", 1000);

			function waktu() {
				var tanggal = new Date();
				setTimeout("waktu()", 1000);
				document.getElementById("jam").innerHTML = tanggal.getHours() + ":" + tanggal.getMinutes() + ":" + tanggal.getSeconds();
			}
		</script>

</body>

</html>