<?php
require 'class.php';

$edit_nama = $_POST['edi_nama'];
$edit_alamat = $_POST['edit_alamat'];
$edit_nomortelp = $_POST['edit_telp'];
$id_sup_edit = $_POST['idSupplierToEdit'];

$supplier = new Supplier();
$result = ($supplier)->updateSupplier($id_sup_edit,$edit_nama, $edit_alamat, $edit_nomortelp) ;
?>