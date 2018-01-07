<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$nim = $_GET['nim'];
$sql = "SELECT * FROM users WHERE nim = '$nim'";
$mahasiswas   = $conn->query($sql);
if ($mahasiswas->num_rows > 0) {
    $mahasiswa = $mahasiswas->fetch_assoc();
}   

// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Hello,<?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="assets/css/index.css" type="text/css"/>
</head>
<body>

    <!-- Navigation Bar-->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= $pathUrl ?>index.php">Sistem Informasi Alumni</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if ($userRow['admin'] == 1): ?>                    
                        <li><a href="<?= $pathUrl ?>mahasiswa_index.php">Dashboard</a></li>
                    <?php endif ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="lowongan.php">Lowongan</a>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span
                                class="glyphicon glyphicon-user"></span>&nbsp;Logged
                            in: <?php echo $userRow['email']; ?>
                            &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= $pathUrl ?>mahasiswa_show.php?nim=<?= $userRow['nim']; ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>
                            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <br> <br>

    <div class="container">
        <form action="" method="POST" class="form-horizontal" enctype="multipart/form-data">
            
            <div class="form-group">
                <label for="foto" class="col-sm-2 control-label">Foto</label>
                <div class="col-md-6">                
                    <img class="media-object" src="<?= $pathUrl ?>upload/<?= $mahasiswa['foto'] ?>" alt="Image" class="img img-responsive" style="height: 80px;">
                </div>
            </div>

            <div class="form-group">
                <label for="nim" class="col-sm-2 control-label">NIM Mahasiswa</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['nim'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Nama Mahasiswa</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['username'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email Mahasiswa</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['email'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="program_studi" class="col-sm-2 control-label">Program Studi</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['program_studi'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="jenjang_studi" class="col-sm-2 control-label">Jenjang Studi</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['jenjang_studi'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk" class="col-sm-2 control-label">Tanggal Masuk</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['tanggal_masuk'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="propinsi_asal" class="col-sm-2 control-label">Propinsi Asal</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['propinsi_asal'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="alamat_rumah" class="col-sm-2 control-label">Alamat Rumah</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['alamat_rumah'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['kode_pos'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="kota" class="col-sm-2 control-label">Kota</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['kota'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="nama_sekolah" class="col-sm-2 control-label">Nama Sekolah</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['nama_sekolah'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['tempat_lahir'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="agama" class="col-sm-2 control-label">Agama</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['agama'] ?>
                </div>
            </div>

            <div class="form-group">
                <label for="handphone" class="col-sm-2 control-label">Handphone</label>
                <div class="col-md-6">                
                     <?= $mahasiswa['handphone'] ?>
                </div>
            </div>


            <div class="form-group">
                <label for="foto" class="col-sm-2 control-label">Status</label>
                <div class="col-md-6">    
                    <?= ($mahasiswa['status'] == 1) ? 'Aktif' : ''; ?>
                    <?= ($mahasiswa['status'] == 2) ? 'Alumni' : ''; ?>
                    <?= ($mahasiswa['status'] == 3) ? 'DO' : ''; ?>
                </div>
            </div>


        </form>
    </div>
    
    <br>


    <script src="assets/js/jquery-2.2.0.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
