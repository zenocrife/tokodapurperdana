<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dapur Perdana</title>
    <link rel="stylesheet" href="kategoriproduk.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>

<body>
    <div class="overlay" id="overlay"></div>
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
                <span class="user-name">Michael</span>
            </div>
        </div>
    </nav>
    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>
    <main class="main">
        <div class="container">
            <div class="add-kategori">
                <div class="action-buttons">
                    <button class="add-button" id="add-kategori" onclick="openAddForm()">Add</button>
                </div>
                <div class="line"></div>
            </div>
            <div class="title-filter-search">
                <div class="title-wrapper">
                    <h2>Kategori Produk</h2>
                </div>
                <div class="filter-search">
                    <input type="text" placeholder="Search..." id="search" />
                    <button id='search-button'><i class='fa-solid fa-search'></i></button>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kategori</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Alat Masak</td>
                            <td>
                                <button class='edit-button' onclick='openEditForm()'>Edit</button>
                                <button class='delete-button' onclick='openDeleteConfirmation()'>Delete</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Alat Makan</td>
                            <td>
                                <button class='edit-button' onclick='openEditForm()'>Edit</button>
                                <button class='delete-button' onclick='openDeleteConfirmation()'>Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="popup-form" id="addForm">
        <div class="form-header">
            <span class="form-title">Add Kategori</span>
            <span class="close-icon" onclick="closeAddForm()">&#10006;</span>
        </div>
        <form class="form-container">
            <input type="text" placeholder="Nama Kategori" required />
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeAddForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitAddForm">Add</button>
            </div>
        </form>
    </div>

    <div class="popup-form" id="editForm">
        <div class="form-header">
            <span class="form-title">Edit Kategori</span>
            <span class="close-icon" onclick="closeEditForm()">&#10006;</span>
        </div>
        <form class="form-container">
            <input type="text" placeholder="Nama Kategori" required />
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeEditForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitEditForm">Edit</button>
            </div>
        </form>
    </div>

    <div class="popup-form" id="deleteConfirmation">
        <div class="form-container">
            <p>Apakah Anda yakin ingin menghapusnya?</p>
            <div class="button-container">
                <button type="submit" class="submit-button">Yes</button>
                <button type="button" class="cancel-button" onclick="closeDeleteConfirmation()">No</button>
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