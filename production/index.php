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
        <div class="right_col" role="main" style="background-color: white;"> <!-- Menambahkan style untuk mengatur background-color menjadi kuning -->
          <!-- top tiles -->
          <div class="row">
            <div class="col-md-3 col-sm-4  tile_stats_count">
              <div class="count_box">
                <span class="count_top" style="font-size: 1.2em;"><i class="fa fa-user"></i> Total Siswa</span>
                <?php 
                $queryUser = "SELECT COUNT(*) AS hasil FROM siswa";
                $hasilUser = mysqli_query($conn, $queryUser);
                $user = mysqli_fetch_array($hasilUser);
                ?>
                <div class="count"><?php echo $user['hasil']; ?></div>
              </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <div class="count_box">
                <span class="count_top" style="font-size: 1.2em;"><i class="fa fa-user"></i> Total Petugas</span>
                <?php 
                $queryPetugas = "SELECT COUNT(*) AS hasil FROM petugas";
                $hasilPetugas = mysqli_query($conn, $queryPetugas);
                $user = mysqli_fetch_array($hasilPetugas);
                ?>
                <div class="count"><?php echo $user['hasil']; ?></div>
              </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <div class="count_box">
                <span class="count_top" style="font-size: 1.2em;"><i class="fa fa-user"></i> Total Kelas</span>
                <?php 
                $queryKelas = "SELECT COUNT(*) AS hasil FROM kelas";
                $hasilKelas = mysqli_query($conn, $queryKelas);
                $user = mysqli_fetch_array($hasilKelas);
                ?>
                <div class="count"><?php echo $user['hasil']; ?></div>
              </div>
            </div>

            <div class="col-md-3 col-sm-4  tile_stats_count">
              <div class="count_box">
                <span class="count_top" style="font-size: 1.2em;"><i class="fa fa-user"></i> Total SPP</span>
                <?php 
                $querySpp = "SELECT COUNT(*) AS hasil FROM spp";
                $hasilSpp = mysqli_query($conn, $querySpp);
                $user = mysqli_fetch_array($hasilSpp);
                ?>
                <div class="count"><?php echo $user['hasil']; ?></div>
              </div>
            </div>
          </div>
          <!-- /top tiles -->
          <marquee behavior="scroll" direction="left" scrollamount="30">
            <h1 style="color: #31708f;">Selamat Datang Di Aplikasi Pembayaran SPP</h1>
          </marquee>
          <img src="images/school.jfif" style="width: 500px; height: auto; display: block; margin-left: auto; margin-right: auto;">

          <br/>

          <div class="row">
            <!-- Start to do list -->
            <!-- end of weather widget -->
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include("footer.php")?> 
        <!-- /footer content -->
      </div>
    </div>

    <?php include("script.php")?>

    <!-- CSS untuk memperbaiki tampilan formulir -->
    <style>
      .count_box {
        background: linear-gradient(to bottom, #778899 0%, white 50%, #778899 100%);
        border-radius: 5px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .count_top {
        font-weight: bold;
        color: black;
        font-family: Dubai;
      }

      .count {
        font-size: 34px;
        margin-top: 10px;
        color: #333;
      }

      marquee {
        font-size: 18px;
        color: #31708f;
        margin-top: 20px;
        margin-bottom: 20px;
      }
    </style>
  </body>
</html>
