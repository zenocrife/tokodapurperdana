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
                <?php echo '<span class="user-name">'.$username.'</span>'; ?>
            </div>
        </div>
    </nav>
    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>
    <main class="main">
        <div class="container">
            <div class="title-filter-search">
                <div class="title-wrapper">
                    <h2>Laporan Penjualan</h2>
                </div>
                <div class="filter-search">
                    <button id='print-button'><i class='fa-solid fa-print'></i></button>
                    <input type="text" placeholder="Search..." id="search" />
                    <button id='search-button'><i class='fa-solid fa-search'></i></button>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Total Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>10-10-2023</td>
                            <td class='left-align'>Panci</td>
                            <td class='right-align'>105000</td>
                            <td class='right-align'>110000</td>
                        </tr>

                        <?php
                        // while ($row = $result->fetch_assoc()) {
                        //     echo "<tr>";
                        //     echo "<td>" . $row['id'] . "</td>";
                        //     echo "<td><img width='70' height='70' src=" . $row['url'] . "></td>";
                        //     echo "<td>" . $row['nama'] . "</td>";
                        //     echo "<td>" . $row['stok_tersedia'] . "</td>";
                        //     echo "<td>" . $row['harga_jual'] . "</td>";
                        //     echo "<td>" . $row['id_kategori'] . "</td>";
                        //     echo "<td><button class='add-button'>+ Add</button></td>";
                        // }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script src="js/script.js"></script>
</body>

</html>