<?php
    // $namasupplier = $_POST['nama'];
    // $alamat = $_POST['alamat'];
    // $notelepon = $_POST['nomor_telepon'];
    // $idsupplier = $_POST['id'];

    // require 'class.php';

    // $supplier = new Supplier();
    // $status = $supplier->updateSupplier($idsupplier, $namasupplier, $alamat, $notelepon);
    // if($status){
    //     echo"berhasil";
    // }else{
    //     echo "error";
    // }
    
    if(isset($_GET['submit'])){
        $namasupplier = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $notelepon = $_POST['nomor_telepon'];
        $idsupplier = $_POST['id'];
        require_once("class/supplier.php");
        $supplier = new Supplier();
        $status = $supplier->updateSupplier( $namasupplier, $alamat, $notelepon,$idsupplier);
        if($status){
            echo"berhasil";
        }else{
            echo "error";
        }
    }
?>
