<?php
include 'koneksi.php'; // Include the connection file
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];
    $query = "SELECT * FROM siswa WHERE nisn='$nisn'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $siswa = $result->fetch_assoc();
    } 
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn_baru = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nisn = $_POST['nisn_lama'];
    $nama = $_POST['nama'];
    $id_kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telepon = $_POST['no_telepon'];
    $id_spp = $_POST['id_spp'];

    $query = "UPDATE siswa SET nisn = '$nisn_baru', nis = '$nis', nama = '$nama', id_kelas = '$id_kelas', alamat = '$alamat', no_telp = '$no_telepon' WHERE nisn = '$nisn'";
    if ($conn->query($query) === TRUE) {
        echo "<script>
            alert('Data Siswa Berhasil Diedit!');
            window.location.href = 'list_siswa.php';
        </script>";
        exit;
    } else {
        echo "<script>
            alert('Data Siswa Gagal Diedit!');
            window.location.href = 'list_siswa.php';
        </script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<?php include("head.php");?> 
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
        <?php include("sidebar.php");?> 
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
                            <h3>Halaman Edit Siswa</h3>
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
                                    <h2>Edit Siswa</h2>
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
                                        <input type="hidden" name="nisn_lama" value="<?php echo $nisn; ?>">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NISN <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nisn" value="<?php echo $siswa['nisn']; ?>" type="text" id="nisn" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">NIS <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nis" value="<?php echo $siswa['nis']; ?>" type="text" id="nis" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="nama" value="<?php echo $siswa['nama']; ?>" type="text" id="nama" required="required" class="form-control ">
											</div>
										</div>
                                        <div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Kelas <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
                                            <select class="form-control" name="kelas">
                                                <option>Pilih Kelas</option>
                                                <?php
                                                    $queryKelas = "SELECT * FROM kelas";
                                                    $kelasResult = $conn->query($queryKelas);
                                                    if ($kelasResult->num_rows > 0) { 
                                                    while ($kelas = $kelasResult->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $kelas['id_kelas']; ?>"><?php echo $kelas['nama_kelas']; ?>&nbsp;<?php echo $kelas['kompetensi_keahlian']; ?></option>
                                                        <?php
                                                    }
                                                    }
                                                ?>
                                            </select>
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Alamat <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="alamat" value="<?php echo $siswa['alamat']; ?>" type="text" id="alamat" required="required" class="form-control ">
											</div>
										</div>
										<div class="item form-group">
											<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">No Telepon <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 ">
												<input name="no telepon" value="<?php echo $siswa['no_telp']; ?>" type="text" id="first-name" required="required" class="form-control ">
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
