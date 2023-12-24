<?php
require 'class.php';

$edit_nama = $_POST['edit_nama'];
$edit_alamat = $_POST['edit_alamat'];
$edit_nomortelp = $_POST['edit_telp'];
$id_sup_edit = $_POST['id'];

$supplier = new Supplier();
$result = ($supplier)->updateSupplier($id_sup_edit,$edit_nama, $edit_alamat, $edit_nomortelp) ;
?>
<a href="supplier.php">Back</a>