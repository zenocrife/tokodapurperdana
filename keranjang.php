<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dapur Perdana</title>
  <link rel="stylesheet" href="css/keranjangstyle.css" />
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
  <nav class="navbar">
    <i class="fa-solid fa-bars" id="sidebar-close"></i>
    <i class="fa-solid fa-shopping-cart" id="cart-icon"></i>
  </nav>
  <main class="main">
    <div class="container">
      <h2><span class="text_keranjang">Keranjang</span></h2>
      <div class="grid_container">
        <div class="item item-kasir"> 
          <div class="teks_kasir"><b>Kasir : </b><span id="textNamaKasir">Nama Kasir</span></div>
          <div class="teks_tanggal_transaksi"><p><b>Tanggal Transaksi :</b><span class="tanggalTransaksi" id="textTanggalTransaksi">10/08/2023</span></p></div>
        </div>
        <div class="item item-pembayaran"> 
          <span class="teksTipePembayaran"><b>Tipe Pembayaran</b></span>   
           <label class="radio-container">Cash
            <input type="radio" checked="checked" name="radioCash" >
            <span class="checkmark"></span>
           </label>
           <label class="radio-container">Transfer
            <input type="radio" checked="checked" name="radioCash" >
            <span class="checkmark"></span>
           </label>
        </div>
        <div class="item item-buttonCancel">
           <button class="selesai-button">Selesai</button>
        </div>
        <div class="item item-total"> 
          <div class="teks_total"><b>Total : </b><span id="grandTotal">Rp.1.500.000</span></div>
        </div>
        <div class="item item-buttonSelesai"> 
          <button class="batal-button">Batalkan</button>
        </div> 
      </div>
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
    </div>
  </main>

  <script src="js/script.js"></script>
</body>

</html>