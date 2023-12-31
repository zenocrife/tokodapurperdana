<?php
session_start();
require 'class.php';

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];
$role = $_SESSION['role'];

$barang = new Barang();
$kategori = new Kategori();

if (isset($_GET['key'])) {
    $search = "%" . $_GET['key'] . "%";
} else {
    $search = "%";
}

if (isset($_GET['kategori'])) {
    $kate = "%" . $_GET['kategori'] . "%";
} else {
    $kate = "%";
}

$result = ($barang)->getTotalData($kate, $search);

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

// $resultKAdd = ($kategori)->bacaData('%');
// $resultKEdit = ($kategori)->bacaData('%');
$nourut = 1;
$resultK = ($kategori)->bacaData('%');
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
            <div class="add-produk">
                <div class="action-buttons">
                    <!-- ADD -->
                    <a class="add-button" id="add-supp" href="addDaftarProduk.php" style='text-decoration:none;text-align:center'>Add</a>
                </div>
                <div class="line"></div>
            </div>
            <div class="title-filter-search">
                <div class="title-wrapper">
                    <h2>Daftar Produk</h2>
                </div>
                <div class="filter-search">
                    <form action="" method="GET">
                        <?php
                        echo '<input type="text" name="kategori" placeholder="Kategori..." value="' . $kate . '">';
                        echo '<input type="text" name="key" placeholder="Search..." id="search" value="' . $key . '">';
                        ?>
                        <button type="submit" id="search-button" name="submit"><i class="fa-solid fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Stok Tersedia</th>
                        <th>Kategori</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        $kategoribarang = (new Kategori)->bacaDataById($row['id_kategori']);
                        $namaK = $kategoribarang->fetch_assoc();

                        echo "<tr>";
                        echo "<td>" . $nourut . "</td>";
                        $nourut++;
                        echo "<td class='left-align'>" . $row['nama'] . "</td>";
                        echo "<td class='right-align'>Rp" . number_format($row['harga_jual'], 0, ',', '.') . "</td>";
                        echo "<td class='right-align'>Rp" . number_format($row['harga_beli'], 0, ',', '.') . "</td>";
                        echo "<td>" . $row['stok_tersedia'] . "</td>";
                        echo "<td class='center-align'>" . $namaK['nama'] . "</td>";
                        // echo "<td>
                        //         <button class='edit-button' onclick='openEditForm()'>Edit</button>
                        //         <button class='delete-button' onclick='openDeleteConfirmation()'>Delete</button>
                        //     </td>";
                        $idDaftarProduk = $row['id'];
                        echo "<td>
                                <a href='updateDaftarProduk.php?id=$idDaftarProduk' class='edit-button'>Edit</a>
                                <a href='deleteDaftarProduk.php?id=$idDaftarProduk' class='delete-button'>Delete</a>
                                </td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
            </div>
        </div>
    </main>

    <!-- TAMBAH PRODUK -->
    <!-- <div class="popup-form" id="addForm">
        <div class="form-header">
            <span class="form-title">Add Produk</span>
            <span class="close-icon" onclick="closeAddForm()">&#10006;</span>
        </div>
        <form class="form-container">
            <input type="text" placeholder="Nama Barang" required />
            <input type="number" placeholder="Harga Jual" required />
            <input type="number" placeholder="Harga Beli" required />
            <input type="number" placeholder="Stok Tersedia" required />
            <select name="kategori" required>
                <option value="">Select kategori</option>
                // while ($rowK = $resultKAdd->fetch_assoc()) {
                //     echo '<option value=' . $rowK['id'] . '>' . $rowK['nama'] . '</option>';
                // }
            </select>
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeAddForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitAddForm">Add</button>
            </div>
        </form>
    </div> -->

    <!-- EDIT PRODUK -->
    <!-- <div class="popup-form" id="editForm">
        <div class="form-header">
            <span class="form-title">Edit Produk</span>
            <span class="close-icon" onclick="closeEditForm()">&#10006;</span>
        </div>
        <form class="form-container">
            <input type="text" placeholder="Nama Barang" required />
            <input type="number" placeholder="Harga Jual" required />
            <input type="number" placeholder="Harga Beli" required />
            <input type="number" placeholder="Stok Tersedia" required />
            <select name="kategori" required>
                <?php
                // while ($rowK = $resultKEdit->fetch_assoc()) {
                //     echo '<option value=' . $rowK['id'] . '>' . $rowK['nama'] . '</option>';
                // }
                ?>
            </select>
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeEditForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitEditForm">Edit</button>
            </div>
        </form>
    </div> -->

    <!-- <div class="popup-form" id="deleteConfirmation">
        <div class="form-container">
            <p>Apakah Anda yakin ingin menghapusnya?</p>
            <div class="button-container">
                <button type="submit" class="submit-button">Yes</button>
                <button type="button" class="cancel-button" onclick="closeDeleteConfirmation()">No</button>
            </div>
        </div>
    </div> -->

    <!-- <div class="popup-form" id="addSuccessForm">
        <div class="success-content">
            <i class="fa-regular fa-circle-check success-icon"></i>
            <div class="success-text">
                <p>Sukses</p>
                <div class="line"></div>
                <p>Sukses menambah data</p>
            </div>
            <button class="close-button" onclick="closeAddSuccessForm()">OK</button>
        </div>
    </div>
    <div class="popup-form" id="editSuccessForm">
        <div class="success-content">
            <i class="fa-regular fa-circle-check success-icon"></i>
            <div class="success-text">
                <p>Sukses</p>
                <div class="line"></div>
                <p>Sukses mengubah data</p>
            </div>
            <button class="close-button" onclick="closeEditSuccessForm()">OK</button>
        </div>
    </div> -->
    <script src="js/script.js"></script>
</body>

</html>