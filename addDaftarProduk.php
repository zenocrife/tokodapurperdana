<?php
session_start();
require 'class.php';

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];
$role = $_SESSION['role'];

$kategori = new Kategori();

$resultKAdd = ($kategori)->bacaData('%');
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
                <?php
                if ($role == 'pemilik') {
                    echo '<li class="item">';
                    echo '<a href="pegawai.php"> <i class="fa-solid fa-user-plus"></i>Pegawai</a>';
                    echo '</li>';
                }
                ?>
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
    <form class="form-container popup-form" method="POST" action="addDaftarProduk_proses.php">
        <span class="form-title">Add Produk</span>
        <input type="text" placeholder="Nama Barang" required name="addNama_daftarproduk" />
        <input type="number" placeholder="Harga Jual" required name="addJual_daftarproduk" />
        <input type="number" placeholder="Harga Beli" required name="addBeli_daftarproduk" />
        <input type="text" placeholder="URL" required name="addUrl_daftarproduk" />
        <input type="number" placeholder="Stok Tersedia" required name="addStok_daftarproduk" />
        <select name="addKategori_daftarproduk" required>
            <option value="">Select kategori</option>
            <?php
            while ($rowK = $resultKAdd->fetch_assoc()) {
                echo '<option value=' . $rowK['id'] . '>' . $rowK['nama'] . '</option>';
            }
            ?>
        </select>
        <div class="button-container">
            <button type="button" class="cancel-button" onclick="closeAddForm()">Cancel</button>
            <button type="submit" class="submit-button" id="submitAddForm">Add</button>
        </div>
    </form>
</body>

</html>