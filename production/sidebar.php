<div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Pembayaran SPP</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/smk.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome</span>
                <h2>Di Sistem Pembayaran SPP</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />
<?php
include 'koneksi.php';
session_start();
$username = $_SESSION['username'];
$result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username'");
if ($result->num_rows === 1) {
  $row = mysqli_fetch_assoc($result); 
$level = $row['level'];
}
?>
            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <?php if($level == 'admin') { ?>
    <li>
        <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
    </li>
    <li>
        <a><i class="fa fa-edit"></i> Data Siswa <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="tambah_siswa.php">Tambah Siswa</a></li>
            <li><a href="list_siswa.php">List Data Siswa</a></li>                      
        </ul>
    </li>
    <li>
        <a><i class="fa fa-desktop"></i> Data Petugas <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="tambah_petugas.php">Tambah Petugas</a></li>
            <li><a href="list_petugas.php">List Data Petugas</a></li>
        </ul>
    </li>
    <li>
        <a><i class="fa fa-table"></i> Data Kelas <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="tambah_kelas.php">Tambah Kelas</a></li>
            <li><a href="list_kelas.php">List Data Kelas</a></li>
        </ul>
    </li>
    <li>
        <a><i class="fa fa-bar-chart-o"></i> Data SPP <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="tambah_spp.php">Tambah Data SPP</a></li>
            <li><a href="list_spp.php">List Data SPP</a></li>
        </ul>
    </li>
    <li>
        <a href="tambah_pembayaran.php"><i class="fa fa-bar-chart-o"></i> Entri Transaksi</a>
    </li>
    <li>
        <a href="list_pembayaran.php"><i class="fa fa-home"></i>History Pembayaran</a>
    </li> 
    <?php }else if($level == 'petugas') { ?>    
      <li>
        <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
    </li>       
    <li>
        <a href="tambah_pembayaran.php"><i class="fa fa-bar-chart-o"></i> Entri Transaksi</a>
    </li>
    <li>
        <a href="list_pembayaran.php"><i class="fa fa-home"></i>History Pembayaran</a>
    </li><?php }else { ?>
      <li>
        <a href="index.php"><i class="fa fa-home"></i> Dashboard</a>
    </li>
    <li>
        <a href="historyhal_siswa.php"><i class="fa fa-home"></i>History Pembayaran</a>
    </li>    <?php } ?>              
</ul>

              </div>

            </div>
            <!-- /sidebar menu -->

           
            <!-- /menu footer buttons -->
          </div>
        </div>
