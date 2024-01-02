<?php
session_start();
require 'class.php';
$barang = new Barang();

$idbarang = $_GET['id'];

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];

$result = ($barang)->bacaStok($idbarang);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Perdana</title>
    <link rel="stylesheet" href="dashboardstyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <div class="overlay" id="overlay"></div>
    <nav class="sidebar">
        <a class="logo">Dapur Perdana</a>
        <div class="menu-content">
            <ul class="menu-items">
                <li class="item">
                    <a href="index.php"><i class="fa-solid fa-gauge-high"></i>Dashboard</a>
                </li>
                <li class="item">
                    <a href="supplier.php"><i class="fa-solid fa-truck-field"></i>Supplier</a>
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
                            <a href="kategoriproduk.php"> <i class="fa-solid fa-circle"></i>Kategori Produk</a>
                        </li>
                        <li class="item">
                            <a href="daftarproduk.php"><i class="fa-solid fa-circle"></i>Daftar Produk</a>
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
                            <a href="laporanpenjualan.php"> <i class="fa-solid fa-circle"></i>Laporan Penjualan</a>
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
    <form class="form-container popup-form" method="POST" action="addJumlahProduk_proses.php">
        <span class="form-title">Tambah Produk</span>
        <?php
        $row = $result->fetch_assoc();
        $stok = $row['stok_tersedia'];
        echo '<div class="form-group">';
        echo '<label for="productName">Nama Produk</label>';
        echo '<input type="text" id="productName" name="productName" placeholder="Nama Produk" value="' . $row['nama'] . '" readonly />';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="availableStock">Stok Tersedia</label>';
        echo '<input type="text" id="availableStock" name="availableStock" value="' . $stok . '"  readonly />';
        echo '</div>';
        echo '<div class="form-group">';
        echo '<label for="quantity">Jumlah Produk</label>';
        echo '<input type="number" id="quantity" name="quantity" placeholder="Jumlah Produk" required value="1" min="1" max="' . $stok . '"/>';
        echo '</div>';
        echo '<input type="hidden" name="idbrng" value="' . $idbarang . '">';
        echo '<input type="hidden" name="harga" value="' . $row['harga_jual'] . '">';
        ?>
        <div class="button-container">
            <a type="button" class="cancel-button" href="index.php" style='text-decoration:none;text-align:center'>Cancel</a>
            <button type="submit" class="submit-button" id="submitAddForm">Tambah</button>
        </div>
    </form>
</body>

</html>