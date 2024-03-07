<?php 
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $id_pembayaran = $_POST['id_pembayaran'];
        $id_petugas = $_POST['id_petugas'];
        $nisn = $_POST['nisn'];
        $tgl_bayar = $_POST['tgl_bayar'];
        $bulan_dibayar = $_POST['bulan_dibayar'];
        $tahun_dibayar = $_POST['tahun_dibayar'];
        $id_spp = $_POST['id_spp'];
        $jumlah_bayar = $_POST['jumlah_bayar'];

        // Gunakan prepared statement untuk mencegah SQL injection
        $query = "INSERT INTO pembayaran (id_pembayaran, id_petugas, nisn, tgl_bayar, bulan_dibayar, tahun_dibayar, id_spp, jumlah_bayar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
		
        $stmt = $conn->prepare($query);

        // Periksa apakah pernyataan telah berhasil disiapkan
        if ($stmt) {
            $stmt->bind_param("isssssss", $id_pembayaran, $id_petugas, $nisn, $tgl_bayar, $bulan_dibayar, $tahun_dibayar, $id_spp, $jumlah_bayar);
            
            try {
                // Upaya untuk menjalankan pernyataan
                if ($stmt->execute()) {
                    echo "<script>
                            alert('Pembayaran Berhasil ditambahkan!');
                            window.location.href= 'list_pembayaran.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Pembayaran Gagal ditambahkan!');
                            window.location.href= 'list_pembayaran.php';
                          </script>";
                }
            } catch (mysqli_sql_exception $e) {
                // Tangani exception, tampilkan pesan kesalahan
                echo "Error: " . $e->getMessage();
            }

            $stmt->close(); // Tutup pernyataan setelah dieksekusi
        } else {
            echo "<script>
                    alert('Error in preparing statement!');
                    window.location.href= 'tambah_pembayaran.php';
                  </script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include("head.php")?> 
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		<?php include("sidebar.php")?> 
			<!-- top navigation -->
			<div class="top_nav">
			<?php include 'header.php'; ?>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Halaman Tambah Pembayaran</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5  form-group pull-right top_search">
								<div class="input-group">
									<span class="input-group-btn">
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel">
								<div class="x_title">
									<h2>Tambah Pembayaran</h2>
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
                                        <?php 
                                        $id = mt_rand(1000, 9999);
                                        ?>
										<div class="item form-group" style="display:none;">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Id Pembayaran <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="id pembayaran" type="text" id="nisn" required="required" class="form-control " value="<?php echo $id; ?>"> 
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="id_petugas">Nama petugas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" name="id_petugas">
                                                <option>Pilih Nama petugas</option>
                                                <?php
                                                    $querypetugas = "SELECT * FROM petugas";
                                                    $petugasResult = $conn->query($querypetugas);
                                                    if ($petugasResult->num_rows > 0) { 
                                                    while ($petugas = $petugasResult->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $petugas['id_petugas']; ?>"><?php echo $petugas['nama_petugas']; ?></option>
                                                        <?php
                                                    }
                                                    }
                                                ?>
                                            </select>
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NISN <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nisn" type="tel" id="nisn" required="required" class="form-control" maxlength="10">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tanggal Bayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input name="tgl_bayar" type="date" id="tanggal_bayar" required="required" class="form-control ">
</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Bulan Dibayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input name="bulan_dibayar" type="text" id="bulan_dibayar" required="required" class="form-control ">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tahun Dibayar <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
											<input name="tahun_dibayar" type="text" id="tahun_dibayar" required="required" class="form-control ">

											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="id_spp">Id SPP <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" name="id_spp">
                                                <option>Pilih Id SPP</option>
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
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Jumlah Bayar <span class="required"></span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input type="text" id="last-name" name="jumlah bayar" required="required" class="form-control">
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
