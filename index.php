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


if (isset($_GET['search'])) {    
    $username = $_GET['search'];
    $mahasiswas = $conn->query("SELECT * FROM users WHERE username LIKE '%$username%'");
} else {
    $mahasiswas = $conn->query("SELECT * FROM users");
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
                        <li><a href="<?= $pathUrl ?>mahasiswa_index.php">Data Mahasiswa</a></li>
                    <?php endif ?>
                    <li>
                        <form action="" method="GET">                            
                            <input type="text" name="search" id="search" class="form-control search-form" placeholder="Search">
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <li>
                        <a href="#">Lowongan</a>
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

    <div class="container">
        <div class="col-md-10">
            <?php while ($mahasiswa = $mahasiswas->fetch_assoc()) { ?>
                <div class="jumbotron" style="padding: 30px;">
                    <div class="media">
                        <a class="pull-left" href="#" style="padding-right: 20px;">
                            <img class="media-object" src="<?= $pathUrl ?>upload/<?= $mahasiswa['foto'] ?>" alt="Image" class="img img-responsive" style="height: 80px;">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><b><?= $mahasiswa['username'] ?></b></h4>
                            <div class="col-md-5">
                                NIM : <?= $mahasiswa['nim'] ?> 
                                <br>
                                Program Studi : <?= $mahasiswa['program_studi'] ?> 
                                <br> 
                                Jenjang Studi : <?= $mahasiswa['jenjang_studi'] ?>
                                <br>
                            </div>
                            <div class="col-md-7">
                                Tempat Lahir : <?= $mahasiswa['tempat_lahir'] ?> 
                                <br>
                                Email : <?= $mahasiswa['email'] ?>
                                <br>  
                                <a href="<?= $pathUrl ?>mahasiswa_show.php?nim=<?= $mahasiswa['nim']; ?>" class="btn btn-link pull-right">Selengkapnya</a>
                            </div>
                        </div>
                    </div>                    
                </div>
            <?php } ?>            
        </div>
    </div>

    <script src="assets/js/jquery-2.2.0.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>
