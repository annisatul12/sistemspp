<?php 
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $nisn = $_POST['nisn'];
        $nis= $_POST['nis'];
        $nama = $_POST['nama'];
        $kelas = $_POST['kelas'];
        $alamat = $_POST['alamat'];
        $no_telepon = $_POST['no_telepon'];
        $id_spp = $_POST['id_spp'];
        $query = "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, id_spp) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iss", $nisn, $nis, $nama, $id_kelas, $alamat, $no_telepon, $id_spp);
        if ($stmt->execute()) {
            echo "<script>
            alert('List Petugas Berhasil ditambahkan!);
            window.location.href= 'tambah_siswa';
            </script>";
        } else {
            echo "<script>
            alert('List Petugas Gagal ditambahkan!);
            window.location.href= 'tambah_siswa';
            </script>";
        }
    }
} ?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php")?> 
<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		<?php include("sidebar.php")?> 
			<!-- top navigation -->
			<div class="top_nav">
			<?php include("header.php")?>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Halaman List Siswa</h3>
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
									<h2>Data List Siswa </h2>
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
									<div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tabel Siswa </h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  <table class="table">
    <thead>
        <tr>
            <th>Nisn</th>
            <th>Nis</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Alamat</th>
            <th>No Telefon</th>
			<th>Id SPP</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php 
       $queryUser = "SELECT siswa.*, kelas.nama_kelas 
	   FROM siswa 
	   JOIN kelas ON siswa.id_kelas = kelas.id_kelas";
        $userResult = $conn->query($queryUser);

        if ($userResult->num_rows > 0) {
            while ($user = $userResult->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $user['nisn']; ?></td>
                    <td><?php echo $user['nis']; ?></td>
                    <td><?php echo $user['nama']; ?></td>
                    <td><?php echo $user['nama_kelas']; ?></td>
                    <td><?php echo $user['alamat']; ?></td>
                    <td><?php echo $user['no_telp']; ?></td>
					<td><?php echo $user['id_spp']; ?></td>
                    <td>
					<a href="hapus_siswa.php?nisn=<?php echo $user['nisn']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Kamu Yakin?')"><i class="fa fa-trash"></i></a>
<a href="edit_siswa.php?nisn=<?php echo $user['nisn']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
							</td>
                </tr>
            <?php }} 
        ?>
    </tbody>
</table>

						</div></div>
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
