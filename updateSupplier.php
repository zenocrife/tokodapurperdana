<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dapur Perdana</title>
    <link rel="stylesheet" href="dashboardstyle.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
</head>
<body>
<?php
        $con = new mysqli("localhost","root","","dbdapurperdana");

        if ($con->connect_errno)
        {
            // echo "Failed Connect : ".$con->connect_error;
            die ("Failed Connect : ".$con->connect_error);
        }
        else
        {
            echo "Connection Success. <br>";
        }

        $id = $_GET['id'];

        $sql = "SELECT * FROM supplier WHERE id=?";
        $stmt = $con->prepare($sql);

        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();

        if($row = $result->fetch_assoc()){
            echo "Tampilkan Data di Form. <br>";
        }
        else{
            header("location: Tes Koneksi.php");
        }
    ?>

    <form class="form-container" method="POST" action="updateSupplier_proses.php">
            <input type="text" placeholder="Nama" required name="edit_nama" value="<?php echo isset($row['nama']) ? $row['nama'] : ''; ?>">
            <input type="text" placeholder="Alamat" required name="edit_alamat" value="<?php echo isset($row['alamat']) ? $row['alamat'] : ''; ?>">
            <input type="text" placeholder="Nomor Telepon" required name="edit_telp" value="<?php echo isset($row['nomor_telepon']) ? $row['nomor_telepon'] : ''; ?>">
            <input type="hidden" name="id" value="<?=$row['id']?>">
            <div class="button-container">
                <button type="button" class="cancel-button" onclick="closeEditForm()">Cancel</button>
                <button type="submit" class="submit-button" id="submitEditForm" name="submit">Edit</button>
            </div>
    </form>
    <!-- <div class="popup-form" id="editForm">
        <div class="form-header">
            <span class="form-title">Edit Supplier</span>
            <span class="close-icon" onclick="closeEditForm()">&#10006;</span>
        </div>

    </div>  -->

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
</body>
</html>