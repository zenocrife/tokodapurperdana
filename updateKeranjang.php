<?php
session_start();
require 'class.php';
$barang = new Barang();

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];
$role = $_SESSION['role'];

if (isset($_SESSION['keranjang'])) {
    $arrKeranjang = $_SESSION['keranjang'];
}

$id = $_GET['idbarang'];
foreach ($arrKeranjang as $key => $value) {
    if ($id == $value['idbarang']) {
        $qty = $_SESSION['keranjang'][$key]['qty'];
        $disc = $_SESSION['keranjang'][$key]['diskon'];
    }
}

$row = ($barang)->bacaDataById($id)->fetch_assoc();
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
    <form class="form-container popup-form" method="POST" action="updateKeranjang_Proses.php">
        <span class="form-title">Edit Keranjang</span>
        <input type="text" placeholder="Nama Alat" name="edit_nama" disabled value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>" />


        <?php
        echo '<input type="number" min="0" max="' . $row['stok_tersedia'] . '" placeholder="Quantity" name="edit_qty" required value="' . $qty . '" />';
        echo '<input type="number" max="100" min="0" placeholder="Discount" name="edit_disc" required value="' . $disc . '" />';
        ?>
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <div class="button-container">
            <a type="button" class="cancel-button" href="keranjang.php" style='text-decoration:none;text-align:center'>Cancel</a>
            <button type="submit" class="submit-button" id="submitEditForm" name="submit">Edit</button>
        </div>
    </form>
</body>

</html>