<?php
session_start();
require 'class.php';
$transaksi = new DetailPenjualan();
$barang = new Barang();

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
  header("location: login.php");
}

$username = $_SESSION['uname'];
$role = $_SESSION['role'];

if (isset($_SESSION['keranjang'])) {
  $arrKeranjang = $_SESSION['keranjang'];
}

$idkeranjang = (new DetailPenjualan)->getId()->fetch_assoc();

$total = 0;
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dapur Perdana</title>
  <script type="text/javascript" src="js/code.jquery.com_jquery-3.7.0.js"></script>
  <link rel="stylesheet" href="keranjangstyle.css" />
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

  <main class="main">
    <div class="container">
      <div class="grid_container">
        <div class="item item-keranjang">
          <h2>Keranjang<h2>
        </div>
        <div class="item item-kasir">
          <div class="teks_Kasir">Kasir</div>
          <div class="teks_tgl_transaksi">Invoice</div>
          <div class="teks_Invoice">Tanggal Transaksi</div>
          <?php
          echo '<div class="teks_edit_Nama">' . $username . '</div>';
          echo '<div class="teks_edit_Invoice">' . ($idkeranjang['id'] + 1) . '</div>';
          echo '<div class="teks_edit_tgl">' . date("Y/m/d") . '</div>';
          ?>
        </div>
        <div class="item item-pembayaran">
          <span class="teksTipePembayaran"><b>Tipe Pembayaran</b></span>
          <p>
          <div class="radio-column">
            <label class="radio-container">Cash
              <input type="radio" checked="checked" name="payment" value="Tunai">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="radio-column">
            <label class="radio-container">Transfer
              <input type="radio" name="payment" value="Transfer">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="radio-column">
            <label class="radio-container">Kartu Kredit
              <input type="radio" name="payment" value="Kartu Kredit">
              <span class="checkmark"></span>
            </label>
          </div>
          <div class="radio-column">
            <label class="radio-container">QRIS
              <input type="radio" name="payment" value="QRIS">
              <span class="checkmark"></span>
            </label>
          </div>
        </div>
        <div class="item item-cash">
          <div class="teksCashTitle">Nominal</div>
          <div class="teksChange">Kembalian</div>
          <div class="teks_edit_change">Rp0</div>
          <div class="teksCash"><b>Pembayaran</b></div>
          <input type="text" class="teksInputCash" name="teksInputCash">
        </div>
        <div class="item item-total">
          <div class="total">
            Rp
            <?php
            if (isset($_SESSION['keranjang'])) {
              foreach ($arrKeranjang as $key => $value) {
                $diskon = $value['diskon'];
                $totalperbarang = ($value['qty'] * $value['price']) - ($value['qty'] * $value['price'] * $diskon / 100);
                $total = $total + $totalperbarang;
              }
              echo $total;
              // echo '<input type="hidden" id="totalSemua" value="' . $total . '">';
            }
            ?>
          </div>
          <div class="teksTotal">Total</div>
        </div>
        <div class="item item-button">
          <form action="keranjangProses.php" method="post">
            <?php
            echo '<input type="hidden" id="totalSemua" value="' . $total . '">';
            echo '<input type="hidden" id="metode" name="metode" value="Tunai">';
            // echo '<input type="hidden" id="diskon" name="diskon" value="' . $diskon . '">';
            ?>
            <button class="selesai-button">Selesai</button>
          </form>
          <form action="clearkeranjang.php" method="post">
            <button class="batal-button">Batalkan</button>
          </form>
        </div>
        <div class="item item-table">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Total</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_SESSION['keranjang'])) {
                  foreach ($arrKeranjang as $key => $value) {
                    $totalperbarang = ($value['qty'] * $value['price']) - ($value['qty'] * $value['price'] * $diskon / 100);
                    $idbarang = $value['idbarang'];

                    $resBarang = ($barang)->bacaDataById($idbarang)->fetch_assoc();

                    echo '<tr>';
                    echo '<td>' . $idbarang . '</td>';
                    echo '<td>' . $resBarang['nama'] . '</td>';
                    echo '<td>' . $value['qty'] . ' unit</td>';
                    echo '<td>Rp' . $value['price'] . '</td>';
                    echo '<td>Rp' . $totalperbarang . '</td>';
                    echo '<td>';
                    echo '<a href="updateKeranjang.php?idbarang=' . $idbarang . '" class="edit-button">Edit</a>
                          <a href="deleteKeranjang.php?idbarang=' . $idbarang . '" class="delete-button">X</a>'; //tambah id item
                    echo '</td>';
                    echo '</tr>';
                  }
                }
                ?>

          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/script.js"></script>
  <script type="text/javascript" src="js/keranjang.js"></script>
</body>

</html>