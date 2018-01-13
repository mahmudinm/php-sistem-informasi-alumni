<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$nim = $_GET['nim'];
$sql = "SELECT * FROM alumni WHERE nim = '$nim'";
$mahasiswas   = $conn->query($sql);
if ($mahasiswas->num_rows > 0) {
    $mahasiswa = $mahasiswas->fetch_assoc();
}   

// select logged in users detail
$res = $conn->query("SELECT * FROM alumni WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    // Tambah data
    if (isset($_POST['submit'])) {

        if(!empty($_FILES['foto']))
        {
            // Ganti URL ini dengan nama folder kalian 
            $path = $pathUpload;
            $path = $path . $_FILES['foto']['name'];
            
            if(move_uploaded_file($_FILES['foto']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['foto']['name']). 
                " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }

        $nim = $_POST['nim'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $propinsi_asal = $_POST['propinsi_asal'];
        $program_studi = $_POST['program_studi'];
        $jenjang_studi = $_POST['jenjang_studi'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $alamat_rumah = $_POST['alamat_rumah'];
        $kode_pos = $_POST['kode_pos'];
        $kota = $_POST['kota'];
        $nama_sekolah = $_POST['nama_sekolah'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $agama = $_POST['agama'];
        $handphone = $_POST['handphone'];
        $foto = $_FILES['foto']['name'];
        $status = $_POST['status'];

        $query = "UPDATE alumni SET username='$username', email='$email', program_studi='$program_studi', jenjang_studi='$jenjang_studi', tanggal_masuk='$tanggal_masuk', propinsi_asal='$propinsi_asal', alamat_rumah='$alamat_rumah', kode_pos='$kode_pos', kota='$kota', nama_sekolah='$nama_sekolah', tempat_lahir='$tempat_lahir', agama='$agama', handphone='$handphone', foto='$foto', status='$status' WHERE nim='$nim'";

        mysqli_query($conn, $query);

        header('location:index.php');
    }

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
                <a class="navbar-brand" href="<?= $pathUrl; ?>index.php">Sistem Informasi Alumni</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <?php if ($userRow['admin'] == 1): ?>                    
                        <li><a href="<?= $pathUrl ?>mahasiswa_index.php">Dashboard</a></li>
                    <?php endif ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <span
                                class="glyphicon glyphicon-user"></span>&nbsp;Logged
                            in: <?php echo $userRow['email']; ?>
                            &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= $pathUrl; ?>mahasiswa_show.php?nim=<?= $userRow['nim']; ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;Profile</a></li>
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
                    <input type="file" name="foto" id="foto" class="form-control" >
                </div>
            </div>

            <div class="form-group">
                <label for="nim" class="col-sm-2 control-label">NIM Mahasiswa</label>
                <div class="col-md-6">                
                    <input type="number" name="nim" id="nim" class="form-control" value="<?= $mahasiswa['nim'] ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <label for="username" class="col-sm-2 control-label">Nama Mahasiswa</label>
                <div class="col-md-6">                
                    <input type="text" name="username" id="username" class="form-control" value="<?= $mahasiswa['username'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email Mahasiswa</label>
                <div class="col-md-6">                
                    <input type="email" name="email" id="email" class="form-control" value="<?= $mahasiswa['email'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="program_studi" class="col-sm-2 control-label">Program Studi</label>
                <div class="col-md-6">                
                    <input type="text" name="program_studi" id="program_studi" class="form-control" value="<?= $mahasiswa['program_studi'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="jenjang_studi" class="col-sm-2 control-label">Jenjang Studi</label>
                <div class="col-md-6">                
                    <input type="text" name="jenjang_studi" id="jenjang_studi" class="form-control" value="<?= $mahasiswa['jenjang_studi'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="tanggal_masuk" class="col-sm-2 control-label">Tanggal Masuk</label>
                <div class="col-md-6">                
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" value="<?= $mahasiswa['tanggal_masuk'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="propinsi_asal" class="col-sm-2 control-label">Propinsi Asal</label>
                <div class="col-md-6">                
                    <input type="text" name="propinsi_asal" id="propinsi_asal" class="form-control" value="<?= $mahasiswa['propinsi_asal'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="alamat_rumah" class="col-sm-2 control-label">Alamat Rumah</label>
                <div class="col-md-6">                
                    <input type="text" name="alamat_rumah" id="alamat_rumah" class="form-control" value="<?= $mahasiswa['alamat_rumah'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="kode_pos" class="col-sm-2 control-label">Kode Pos</label>
                <div class="col-md-6">                
                    <input type="text" name="kode_pos" id="kode_pos" class="form-control" value="<?= $mahasiswa['kode_pos'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="kota" class="col-sm-2 control-label">Kota</label>
                <div class="col-md-6">                
                    <input type="text" name="kota" id="kota" class="form-control" value="<?= $mahasiswa['kota'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="nama_sekolah" class="col-sm-2 control-label">Nama Sekolah</label>
                <div class="col-md-6">                
                    <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" value="<?= $mahasiswa['nama_sekolah'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="tempat_lahir" class="col-sm-2 control-label">Tempat Lahir</label>
                <div class="col-md-6">                
                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $mahasiswa['tempat_lahir'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="agama" class="col-sm-2 control-label">Agama</label>
                <div class="col-md-6">                
                    <input type="text" name="agama" id="agama" class="form-control" value="<?= $mahasiswa['agama'] ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="handphone" class="col-sm-2 control-label">Handphone</label>
                <div class="col-md-6">                
                    <input type="text" name="handphone" id="handphone" class="form-control" value="<?= $mahasiswa['handphone'] ?>">
                </div>
            </div>


            <div class="form-group">
                <label for="foto" class="col-sm-2 control-label">Status</label>
                <div class="col-md-6">    
                    <select name="status" id="status" class="form-control">
                        <option value="1" <?= ($mahasiswa['status'] == 1) ? 'selected' : ''; ?> >Aktif</option>
                        <option value="2" <?= ($mahasiswa['status'] == 2) ? 'selected' : ''; ?> >Alumni</option>
                        <option value="3" <?= ($mahasiswa['status'] == 3) ? 'selected' : ''; ?> >DO</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="foto" class="col-sm-2 control-label"></label>
                <div class="col-md-6">    
                    <input type="submit" name="submit" value="Update Mahasiswa" class="btn btn-primary btn-block">
                </div>
            </div>

        </form>
    </div>
    
    <br>


    <script src="assets/js/jquery-2.2.0.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
