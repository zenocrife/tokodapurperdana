<?php
    $id=  $_GET['id'];
    require_once("class.php");
    $supplier = new Supplier();
    $result=$supplier->hapusSupplier($id);
    if($result){
        header("Location:supplier.php");
    }
?>