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
          <a href="index.php">DASHBOARD</a>
        </li>
        <li class="item">
          <a href="supplier.php">SUPPLIER</a>
        </li>
        <li class="item">
          <div class="submenu-item">
            <span>PRODUK</span>
            <i class="fa-solid fa-chevron-right"></i>
          </div>
          <ul class="menu-items submenu">
            <div class="menu-title">
              <i class="fa-solid fa-chevron-left"></i>
              PRODUK
            </div>
            <li class="item">
              <a href="kategoriproduk.php">KATEGORI PRODUK</a>
            </li>
            <li class="item">
              <a href="daftarproduk.php">DAFTAR PRODUK</a>
            </li>
          </ul>
        </li>
        <li class="item">
          <a href="penyesuaian.php">PENYESUAIAN</a>
        </li>
        <li class="item">
          <div class="submenu-item">
            <span>LAPORAN</span>
            <i class="fa-solid fa-chevron-right"></i>
          </div>
          <ul class="menu-items submenu">
            <div class="menu-title">
              <i class="fa-solid fa-chevron-left"></i>
              LAPORAN
            </div>
            <li class="item">
              <a href="laporanpenjualan.php">LAPORAN PENJUALAN</a>
            </li>
          </ul>
        </li>
        <li class="item">
          <a href="">LOGOUT</a>
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
            <button class="add-button" id="add-supp" onclick="">Cart</button>
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
            <button type="submit" id="search-button" name="submit"><i class="fa-solid fa-search"></i></button>
          </div>
        </div>
      </form>

      <div class="table-wrapper">
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

            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td><img width='70' height='70' src=" . $row['url'] . "></td>";
            echo "<td class='left-align'>" . $row['nama'] . "</td>";
            echo "<td>" . $row['stok_tersedia'] . "</td>";
            echo "<td class='right-align'>" . number_format($row['harga_jual'], 0, ',', '.') . "</td>";
            echo "<td class='center-align'>" . $namaK['nama'] . "</td>";
            echo "<td><button class='add-button' id='add-butt'>+ Add</button></td>";
          }
          ?>
        </table>
      </div>

    </div>
  </main>

  <script type="text/javascript" src="js/code.jquery.com_jquery-3.7.0.js"></script>
  <script type="text/javascript" src="js/script.js"></script>
</body>

</html>