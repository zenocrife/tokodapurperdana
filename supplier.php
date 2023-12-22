<?php
session_start();
require 'class.php';

if (!isset($_SESSION['uname']) && !isset($_SESSION['pwd'])) {
    header("location: login.php");
}

$username = $_SESSION['uname'];

$supplier = new Supplier();

if (isset($_GET['key'])) {
    $search = "%" . $_GET['key'] . "%";
} else {
    $search = "%";
}

$result = ($supplier)->bacaData($search);

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
    <div class="overlay" id="overlay"></div>
    <nav class="sidebar">
        <a href="#" class="logo">Dapur Perdana</a>
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
            <div class="add-supplier">
                <div class="action-buttons">
                    <button class="add-button" id="add-supp" onclick="openAddForm()">Add</button>
                </div>
                <div class="line"></div>
            </div>
            <div class="title-filter-search">
                <div class="title-wrapper">
                    <h2>Supplier</h2>
                </div>
                <div class="filter-search">
                    <form action="" method="GET">
                        <?php echo '<input type="text" name="key" placeholder="Search..." id="search" value="' . $key . '">'; ?>
                        <button type="submit" id="search-button" name="submit"><i class="fa-solid fa-search"></i></button>
                    </form>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td class='left-align'>" . $row['nama'] . "</td>";
                        echo "<td class='left-align'>" . $row['alamat'] . "</td>";
                        echo "<td>" . $row['nomor_telepon'] . "</td>";
                        $idsupplier = $row['id'];
                        //ini masuk ke script (?)
                        echo "<td>  <button class='edit-button' onclick='openEditForm($idsupplier)'>Edit</button>
                                    <button class='delete-button' onclick='openDeleteConfirmation()'>Delete</button></td>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </main>

    <!-- TAMBAH  -->
    <div class="popup-form" id="addForm">
        <div class="form-header">
            <span class="form-title">Add Supplier</span>
            <span class="close-icon" onclick="closeAddForm()">&#10006;</span>
        </div>

        <form class="form-container">
            <input type="text" placeholder="Nama" required />
            <input type="text" placeholder="Alamat" required />
            <input type="text" placeholder="Nomor Telepon" required />
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeAddForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitAddForm">Add</button>
            </div>
        </form>
    </div>


    <!-- EDIT (Masih Error)-->

    <div class="popup-form" id="editForm">
        <div class="form-header">
            <span class="form-title">Edit Supplier</span>
            <span class="close-icon" onclick="closeEditForm()">&#10006;</span>
        </div>

        <!-- Tes php buat edit -->
        <?php
        $con = new mysqli("localhost", "root", "", "dbdapurperdana");

        if ($con->connect_errno) {
            die("Failed Connect: " . $con->connect_error);
        } else {
            echo "Connection Success. <br>";
        }
        
        //ambil dari line 140 - 141
        $id_edit = $_GET['idsupplier'];

        $sql = "SELECT * FROM supplier WHERE id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id_edit);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        ?>

        <form class="form-container" method="POST" action="updateSupplier_proses.php">
            <input type='text' placeholder='Nama' required name='edit_nama' value='<?php echo $row['nama']; ?>'>
            <input type='text' placeholder='Alamat' required name='edit_alamat' value='<?php echo $row['alamat']; ?>'>
            <input type='text' placeholder='Nomor Telepon' required name='edit_telp' value='<?php echo $row['nomor_telepon']; ?>'>
            <input type='hidden' name='idSupplier' value='<?php echo $idSupplierToEdit; ?>'> <!-- Menggunakan variabel di sini -->
            <div class='button-container'>
                <button type='button' class='cancel-button' onclick='closeEditForm()'>Cancel</button>
                <button type='submit' class='submit-button' id='submitEditForm' name='edit_btn'>Edit</button>
            </div>
        </form>
    </div>

    <!-- HAPUS (Belum lanjut)-->
    <div class="popup-form" id="deleteConfirmation">
        <div class="form-container">
            <p>Apakah Anda yakin ingin menghapusnya?</p>
            <div class="button-container">
                <form action="" method="GET">
                    <button type="submit" class="submit-button"><a href='deleteSupplier.php?id=<?php echo isset($row['id']) ? $row['id'] : ''; ?>'>Yes</a></button>
                    <button type="button" class="cancel-button" onclick="closeDeleteConfirmation()">No</button>
                </form>
            </div>
        </div>
    </div>

    <div class="popup-form" id="addSuccessForm">
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
    </div>

    <script src="js/script.js"></script>
</body>

</html>