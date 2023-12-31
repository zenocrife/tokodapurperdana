<?php
session_start();

$username = $_SESSION['uname'];
?>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dapur Perdana</title>
  <link rel="stylesheet" href="keranjangstyle.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
  <nav class="sidebar">
    <a href="#" class="logo">Dapur Perdana</a>
    <span class="hamburger-icon"></span>
    <div class="menu-content">
      <ul class="menu-items">

        <li class="item">
          <a href="index.php">DASHBOARD</a>
        </li>
        <li class="item">
          <a href="index.php">SUPPLIER</a>
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
          <a href="index.php">PENYESUAIAN</a>
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
              <a href="#">LAPORAN PENJUALAN</a>
            </li>
          </ul>
        </li>
      </ul>
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
          <div class="teks_tgl_transaksi">Tanggal Transaksi</div>
          <div class="teks_Invoice">Invoice</div>
          <div class="teks_edit_Nama">Nama Kasir</div>
          <div class="teks_edit_Invoice">YP102987389</div>
          <div class="teks_edit_tgl">10/08/2023</div>
        </div>
        <div class="item item-pembayaran">
          <span class="teksTipePembayaran"><b>Tipe Pembayaran</b></span><p>
          <div class="radio-column">
            <label class="radio-container">Cash
            <input type="radio" checked="checked" name="payment">
            <span class="checkmark"></span>
            </label>
          </div>
          <div class="radio-column">
            <label class="radio-container">Transfer
            <input type="radio" name="payment">
            <span class="checkmark"></span>
            </label>
          </div>
        </div>
        <div class="item item-cash">
           <div class="teksCashTitle">Cash</div>
           <div class="teksChange">Change</div>
           <div class="teks_edit_change">Rp. 1.000</div>
           <div class="teksCash">Cash</div>
           <input type="text" class="teksInputCash" name="teksInputCash">
        </div>
        <div class="item item-total">
          <div class="total">Rp. 15.000,00</div>
          <div class="teksTotal">Total</div>
        </div>
        <div class="item item-button">
          <button class="selesai-button">Selesai</button>
          <button class="batal-button">Batalkan</button>
        </div>
        <div class="item item-table">
          <div class="table-wrapper">
            <table class="table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Qty</th>
                  <th>Harga</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>023123</td>
                  <td>Pisau Dapur</td>
                  <td>15 unit</td>
                  <td>Rp. 15.000,00</td>
                  <td>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">X</button>
                </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>023123</td>
                  <td>Pisau Dapur</td>
                  <td>15 unit</td>
                  <td>Rp. 15.000,00</td>
                  <td>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">X</button>
                </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>023123</td>
                  <td>Pisau Dapur</td>
                  <td>15 unit</td>
                  <td>Rp. 15.000,00</td>
                  <td>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">X</button>
                </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>023123</td>
                  <td>Pisau Dapur</td>
                  <td>15 unit</td>
                  <td>Rp. 15.000,00</td>
                  <td>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">X</button>
                </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>023123</td>
                  <td>Pisau Dapur</td>
                  <td>15 unit</td>
                  <td>Rp. 15.000,00</td>
                  <td>
                    <button class="edit-button">Edit</button>
                    <button class="delete-button">X</button>
                </td>
                </tr>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="js/script.js"></script>
</body>

</html>