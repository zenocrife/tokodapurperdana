<?php
session_start();
require 'class.php';

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];

if (isset($_GET['key'])) {
    $search = "%" . $_GET['key'] . "%";
} else {
    $search = "%";
}

$result = (new DetailPenjualan)->bacaData($search);

if (isset($_GET['key'])) {
    $key = $_GET['key'];
} else {
    $key = "";
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Perdana</title>
    <script type="text/javascript" src="js/code.jquery.com_jquery-3.7.0.js"></script>
    <link rel="stylesheet" href="dashboardstyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <nav class="sidebar">
        <a href="#" class="logo">Dapur Perdana</a>
        <div class="menu-content">
            <ul class="menu-items">

                <li class="item">
                    <a href="index.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                </li>
                <li class="item">
                    <a href="supplier.php"><i class="fa-solid fa-truck-field"></i> Supplier</a>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span> <i class="fa-solid fa-box"></i>Produk</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Produk
                        </div>
                        <li class="item">
                            <a href="kategoriproduk.php"> <i class="fa-solid fa-circle"></i></i>Kategori Produk</a>
                        </li>
                        <li class="item">
                            <a href="daftarproduk.php"><i class="fa-solid fa-circle"></i></i> Daftar Produk</a>
                        </li>
                    </ul>
                </li>
                <li class="item">
                    <a href="penyesuaian.php"> <i class="fa-solid fa-boxes-stacked"></i>Penyesuaian</a>
                </li>
                <li class="item">
                    <div class="submenu-item">
                        <span> <i class="fa-solid fa-book"></i>Laporan</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Laporan
                        </div>
                        <li class="item">
                            <a href="laporanpenjualan.php"> <i class="fa-solid fa-circle"></i></i>Laporan Penjualan</a>
                        </li>
                    </ul>
                </li>
                <li class="item">
                    <a href="logout.php"> <i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
                </li>
            </ul>
            <div class="user-profile">
                <i class="fas fa-user-circle user-icon"></i>
                <?php echo '<span class="user-name">' . $username . '</span>'; ?>
            </div>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <div class="title-filter-search">
                <div class="title-wrapper">
                    <h2>Laporan Penjualan</h2>
                </div>
                <div class="filter-search">
                    <button id='print-button' name="print" type="submit"><i class="fa-solid fa-print"></i></button>
                    <form action="" method="get">
                        <?php echo '<input type="date" id="search" name="key" value="' . $key . '"/>'; ?>
                        <button type="submit" id='search-button' name="submit"><i class='fa-solid fa-search'></i></button>
                    </form>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table" id="table-output">
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Barang</th>
                        <th>Jumlah</th>
                        <th>Harga Jual</th>
                        <th>Metode</th>
                        <th>HPP</th>
                        <th>Untung</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['Hari'] . "</td>";
                        echo "<td>" . $row['Waktu'] . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['jumlah_terjual'] . "</td>";
                        echo "<td>" . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['metode_pembayaran'] . "</td>";
                        echo "<td>" . number_format($row['harga_beli'], 0, ',', '.') . "</td>";
                        echo "<td>" . number_format($row['untung'], 0, ',', '.') . "</td>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
    <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
    <script type="text/javascript" src="js/print.js"></script>
</body>

</html>