<?php
include 'koneksi.php'; // Include the connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$nama = $_POST['nama'];
   		$id_pembayaran = $_POST['id_pembayaran'];
        $id_petugas= $_POST['id_petugas'];
        $nisn = $_POST['nisn'];
        $tgl_bayar = $_POST['tgl_bayar'];
        $bulan_dibayar = $_POST['bulan_dibayar'];
        $tahun_dibayar = $_POST['tahun_dibayar'];
        $id_spp = $_POST['id_spp'];
		$jumlah_bayar = $_POST['jumlah_bayar'];

	$query = "UPDATE pembayaran SET nisn = '$nisn', nama = '$nama', id_pembayaran = '$id_pembayaran', id_petugas = '$id_petugas', tgl_bayar = '$tgl_bayar', bulan_dibayar = '$bulan_dibayar', tahun_dibayar = '$tahun_dibayar', jumlah_bayar = '$jumlah_bayar' WHERE id_spp = '$id_spp'";

    if ($conn->query($query) === TRUE) {
        echo "<script>
            alert('Data Pembayaran Berhasil Diedit!');
            window.location.href = 'list_pembayaran.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data Pembayaran Gagal Diedit!');
            window.location.href = 'list_pembayaran.php';
        </script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id_pembayaran = $_GET['id'];

    $query = "SELECT * FROM pembayaran WHERE id_pembayaran='$id_pembayaran'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $kelas = $result->fetch_assoc();
    } else {
        echo "Failed to fetch data: " . mysqli_error($conn);
        exit;
    }
}
?>
<!-- ... (HTML code remains unchanged) ... -->



<!DOCTYPE html>
<html lang="en">
<?php include("head.php")?> 
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		<?php include("sidebar.php")?> 
			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i></a>
					</div>
					<nav class="nav navbar-nav">
						<ul class=" navbar-right"></ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Halaman Edit Pembayaran</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Edit Pembayaran</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a class="dropdown-item" href="#">Settings 1</a>
												</li>
												<li><a class="dropdown-item" href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close-link"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<br />
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"  action="" method="post">
									<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nama" value="<?php echo $kelas['nama']; ?>"  type="text" id="id_pembayaran" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Id Pembayaran <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="id_pembayaran" value="<?php echo $kelas['id_pembayaran']; ?>"  type="text" id="id_pembayaran" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Id Petugas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="id_petugas" value="<?php echo $kelas['id_petugas']; ?>"  type="text" id="id_petugas" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nisn <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nisn" value="<?php echo $kelas['nisn']; ?>" type="text" id="nisn" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Bayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="tgl_bayar" value="<?php echo $kelas['tgl_bayar']; ?>"  type="text" id="tgl_bayar" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Bulan Dibayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="bulan_dibayar" value="<?php echo $kelas['bulan_dibayar']; ?>" type="text" id="first-name" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tahun Dibayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="tahun_dibayar" value="<?php echo $kelas['tahun_dibayar']; ?>" type="text" id="first-name" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="id_spp">Id SPP <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" name="id_spp">
											<option><?php echo $kelas['id_spp']; ?></option>
                                                <?php
                                                    $queryspp = "SELECT * FROM spp";
                                                    $sppResult = $conn->query($queryspp);
                                                    if ($sppResult->num_rows > 0) { 
                                                    while ($spp = $sppResult->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $spp['id_spp']; ?>"><?php echo $spp['tahun']; ?></option>
                                                        <?php
                                                    }
                                                    }
                                                ?>
                                            </select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Jumlah Bayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="jumlah_bayar" value="<?php echo $kelas['jumlah_bayar']; ?>" type="text" id="first-name" required="required" class="form-control ">
											</div>
										</div>
										
										<div class="ln_solid"></div>
										<div class="item form-group">
											<div class="col-md-6 col-sm-6 offset-md-3">
												<button class="btn btn-primary" type="button" onclick="window.history.back()">Cancel</button>
												<button class="btn btn-primary" type="reset">Reset</button>
												<button type="submit" name="submit" class="btn btn-success">Submit</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<!-- /page content -->

			<?php include("footer.php")?> 
		</div>
	</div>

	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="../vendors/moment/min/moment.min.js"></script>
	<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="../vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="../vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="../vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="../vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>

</body></html>

