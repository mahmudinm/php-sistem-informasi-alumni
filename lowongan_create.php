<?php
ob_start();
session_start();
require_once 'dbconnect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
// select logged in users detail
$res = $conn->query("SELECT * FROM users WHERE id=" . $_SESSION['user']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

    // Tambah data
    if (isset($_POST['submit'])) {

        $nama = $_POST['nama'];
        $deskripsi = $_POST['deskripsi'];

        $query = "INSERT INTO `lowongan` (`nama`, `deskripsi`) VALUES ('$nama', '$deskripsi')";        

        // var_dump($_POST);

        mysqli_query($conn, $query);

        header('location:lowongan_index.php');
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
                <a class="navbar-brand" href="<?= $pathUrl ?>index.php">Sistem Informasi Alumni</a>
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
        <form action="" method="POST" class="form-horizontal">

            <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama Lowongan</label>
                <div class="col-md-6">                
                    <input type="text" name="nama" id="nama" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="deskripsi" class="col-sm-2 control-label">Deskripsi Lowongan</label>
                <div class="col-md-6">                
                    <textarea name="deskripsi" id="deskripsi" class="form-control" style="height: 200px;"></textarea>
                </div>
            </div>


            <div class="form-group">
                <label for="foto" class="col-sm-2 control-label"></label>
                <div class="col-md-6">    
                    <input type="submit" name="submit" value="Create Lowongan" class="btn btn-primary btn-block">
                </div>
            </div>

        </form>
    </div>
    
    <br>


    <script src="assets/js/jquery-2.2.0.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
