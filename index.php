<?php
session_start();
require 'class.php';

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
  header("location: login.php");
}

$username = $_SESSION['uname'];

$barang = new Barang();

if (isset($_GET['key'])) {
  $search = "%" . $_GET['key'] . "%";
} else {
  $search = "%";
}

if (isset($_GET['kategori'])) {
  $kategori = "%" . $_GET['kategori'] . "%";
} else {
  $kategori = "%";
}

$result = ($barang)->getTotalData($kategori, $search);

if (isset($_GET['key'])) {
  $key = $_GET['key'];
} else {
  $key = "";
}

if (isset($_GET['kategori'])) {
  $kate = $_GET['kategori'];
} else {
  $kate = "";
}

$resultK = (new Kategori)->bacaData('%');

if (isset($_GET['cart'])) {
  header("location: keranjang.php");
}

//ini ngetes
if (isset($_POST['addbutton'])) {
  $idproduk = $_POST['idproduk'];
  header("location: keranjang.php?idproduk=$idproduk");
}
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dapur Perdana</title>
  <link rel="stylesheet" href="dashboardstyle.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
  <nav class="sidebar">
    <a class="logo">Dapur Perdana</a>
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
      <form action="" method="GET">
        <div class="add-produk">
          <div class="action-buttons">
            <button class="add-button" id="add-supp" name="cart" onclick="">Cart</button>
          </div>
          <div class="line"></div>
        </div>
        <div class="title-filter-search">
          <h2>Produk</h2>
          <div class="filter-search">
            <?php
            echo '<input type="text" name="kategori" placeholder="Kategori..." value="' . $kate . '">';
            echo '<input type="text" name="key" placeholder="Search..." id="search" value="' . $key . '">';
            ?>
            <button type="submit" id="search-button" name="search"><i class="fa-solid fa-search"></i></button>
          </div>
        </div>
      </form>

      <div class="table-wrapper">
        <form action="" method="POST">
          <table class="table">
            <tr>
              <th>Kode</th>
              <th>Gambar</th>
              <th>Nama</th>
              <th>Stok Tersedia</th>
              <th>Harga</th>
              <th>Kategori</th>
              <th colspan=2>Action</th>
            </tr>

            <?php
            while ($row = $result->fetch_assoc()) {
              $resultK = (new Kategori)->bacaDataById($row['id_kategori']);
              $namaK = $resultK->fetch_assoc();
              $idproduk = $row['id'];

              echo "<tr>";
              echo "<td>" . $idproduk . "</td>";
              echo "<td><img width='70' height='70' src=" . $row['url'] . "></td>";
              echo "<td class='left-align'>" . $row['nama'] . "</td>";
              echo "<td>" . $row['stok_tersedia'] . "</td>";
              echo "<td class='right-align'>" . number_format($row['harga_jual'], 0, ',', '.') . "</td>";
              echo "<td class='center-align'>" . $namaK['nama'] . "</td>";
              echo "<td><button class='add-button' id='add-butt' name='addbutton'>+ Add</button></td>";

              // ini cuman muncul id terakhir, butuh array
              echo "<input type='hidden' name='idproduk' value='$idproduk'>";
            }
            ?>
          </table>
        </form>
      </div>

    </div>
  </main>

  <script type="text/javascript" src="js/code.jquery.com_jquery-3.7.0.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>