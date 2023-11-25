<?php
  session_start();

  if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
  }

  $barang = new Barang;

  if (isset($_GET['key'])) {
		$search = "%".$_GET['key']."%";
	} else {
		$search = "%";
	}

	//pagination, awalnya tentuin data per page, total data, dan total pagenya berapa
	$result = ($barang)->pagination($search);
	$perpage = 7;
	$totaldata = $result->num_rows; //untuk dapatkan jumlah data
	$totalpage = ceil($totaldata/$perpage); //untuk bulatkan ke atas

	//DATA WITH LIMIT
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	
	$start = ($page-1) * $perpage;

	// $sql = "SELECT * FROM cerita WHERE judul LIKE ? LIMIT ?,?";
	$result = ($barang)->paginationWithLimit($search, $start, $perpage);

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
  <link rel="stylesheet" href="dashboardstyle.css" />
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
      <div class="title-filter-search">
        <h2>Produk</h2>
        <div class="filter-search">
          <select name="filterBy" id="filterBy">
            <option value="">Filter By</option>
            <option value="alat makan">Alat Makan</option>
            <option value="alat masak">Alat Masak</option>
          </select>
          <input type="text" placeholder="Search..." id="search" />
        </div>
      </div>
      <div class="table-wrapper">
        <table class="table">
          <thead>
            <tr>
              <th>No.</th>
              <th>Gambar</th>
              <th>Kode</th>
              <th>Nama Barang</th>
              <th>Stok Tersedia</th>
              <th>Harga</th>
              <th>Action</th>
            </tr>
          </thead>

          <?php
            echo '<tbody>';
              echo '<tr>';
                while (true) {
                  $num = 1;
                  echo "<td>".$num."</td>";
                  echo '<td>Gambar</td>';
                  echo "<td>".$row['id_barang']."</td>";
                  echo "<td>".$row['nama_barang']."</td>";
                  echo "<td>".$row['stok_tersedia']."</td>";
                  echo "<td>".$row['harga_jual']."</td>";
                  echo '<td><button class="add-button">+ Add</button></td>';
                  $num++;
                }
              echo '</tr>';
            echo '</tbody>';
          ?>
        </table>
      </div>

    </div>
  </main>

  <script src="script.js"></script>
</body>
</html>