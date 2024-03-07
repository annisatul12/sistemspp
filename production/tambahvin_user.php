<?php
require 'koneksi.php';
session_start();
// Check if the user is not logged in
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

// Get the username from the session
$username = $_SESSION["username"];

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('user baru berhasil ditambahkan!');document.location='list-user.php'
                </script>";
    } else {
        echo mysqli_error($conn);
    }
}
function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $peran = strtolower(stripslashes($data["peran"]));
    $id_user = strtolower(stripslashes($data["id_user"]));

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username sudah terdaftar!');
              </script>";
        return false;
    }

    // Tambahkan pengguna baru ke database
    $query = "INSERT INTO user (username, password, peran, id_user) VALUES ('$username', '$password', '$peran', '$id_user')";
    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn);
        return false;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php' ?>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <?php include 'header.php' ?>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <?php include 'sidebar.php' ?>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Tambah Data User</h3>
                            </div><!-- /.box-header -->
                            <!-- form start //MSK-00097-->
                            <form role="form" action="" method="post" enctype="multipart/form-data">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="col-xs-3">
                                            <label for="peran">Peran</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <select name="peran" id="peran" onchange="loadIdUserOptions()">
                                                <option value="">Pilih Peran</option>
                                                <option value="siswa">Siswa</option>
                                                <option value="guru">Guru</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-3">
                                            <label for="id_user">ID User</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <select class="form-control" name="id_user" id="id_user">
                                                <option value="">Pilih ID User</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-3">
                                            <label>Username</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" placeholder="Masukkan Username"
                                                name="username" autocomplete="off" readonly>
                                        </div>
                                    </div>
                                    <?php
                                    $pass = "user" . mt_rand(1000, 9999);
                                    ?>

                                    <div class="form-group" id="divIndexNumber">
                                        <div class="col-xs-3">
                                            <label>Password</label>
                                        </div>
                                        <div class="col-xs-9">
                                            <input type="text" class="form-control" name="password"
                                                value="<?php echo $pass; ?>" readonly>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="hidden" name="do" value="add_teacher" />
                                    <button name="register" type="submit" class="btn btn-primary"
                                        id="btnSubmit">Submit</button>
                                </div>
                            </form>



                        </div><!-- /.box -->
                    </div>
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <?php include 'footer.php'; ?>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->


        <script>
            function loadIdUserOptions() {
                var peranSelect = document.getElementById("peran");
                var idUserSelect = document.getElementById("id_user");
                var usernameInput = document.getElementsByName("username")[0];

                // Kosongkan opsi yang sudah ada
                idUserSelect.innerHTML = '<option value="">Pilih ID User</option>';

                var peran = peranSelect.value;

                if (peran === "guru") {
                    // Tambahkan opsi guru
                    <?php
                    $query = "SELECT * FROM data_guru WHERE id NOT IN (SELECT id_user FROM user)";
                    $hasil = mysqli_query($conn, $query);

                    if ($hasil) {
                        while ($idnyaguru = mysqli_fetch_array($hasil)) {
                            echo 'idUserSelect.innerHTML += \'<option value="' . $idnyaguru['id'] . '">' . $idnyaguru['nama_lengkap'] . '</option>\';';
                        }
                    } else {
                        echo 'console.error("Error: ' . mysqli_error($conn) . '");';
                    }
                    ?>
                } else if (peran === "siswa") {
                    // Tambahkan opsi siswa
                    <?php
                    $query = "SELECT * FROM data_siswa WHERE id NOT IN (SELECT id_user FROM user)";
                    $hasil = mysqli_query($conn, $query);

                    if ($hasil) {
                        while ($idnyasiswa = mysqli_fetch_array($hasil)) {
                            echo 'idUserSelect.innerHTML += \'<option value="' . $idnyasiswa[0] . '">' . $idnyasiswa[1] . '</option>\';';
                        }
                    } else {
                        echo 'console.error("Error: ' . mysqli_error($conn) . '");';
                    }
                    ?>
                }

                // Tambahkan event listener untuk mengisi otomatis username
                idUserSelect.addEventListener('change', function () {
                    // Mendapatkan kata pertama dari nama yang dipilih
                    var selectedName = idUserSelect.options[idUserSelect.selectedIndex].text;
                    var firstName = selectedName.split(' ')[0]; // Mengambil kata pertama

                    // Mengubah huruf menjadi huruf kecil
                    var lowerCaseFirstName = firstName.toLowerCase();

                    // Menambahkan angka acak di belakang
                    var randomNumber = Math.floor(Math.random() * 10000); // Angka random antara 0-9999
                    var username = lowerCaseFirstName + randomNumber;

                    // Mengisi nilai pada input username
                    usernameInput.value = username;
                });
            }
        </script>


        </script>
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="vendors/chart.js/Chart.min.js"></script>
        <script src="vendors/datatables.net/jquery.dataTables.js"></script>
        <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
        <script src="js/dataTables.select.min.js"></script>

        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/template.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <script src="js/Chart.roundedBarCharts.js"></script>
        <!-- End custom js for this page-->
</body>

</html>