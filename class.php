<?php 
	class Koneksi {
		protected $con;

		public function __construct(){
			$this->con = new mysqli("localhost", "root", "", "dbdapurperdana");
		}

		public function getError(){
			if ($this->con->connect_errno) {
				return "Failed Connect: ".$this->con->connect_errno;
			}
		}

		public function __destruct(){
			$this->con->close();
		}
	}

	class User extends Koneksi{
		public function __construct(){
			parent::__construct();
		}

        // lanjut ntar
		public function daftar($user, $nama, $pwd, $role){
			$stmt = $this->con->prepare("INSERT INTO user VALUES(?, ?, ?, ?)");
			$stmt->bind_param("ssss", $user, $pwd, $nama, $role);
			
			$stmt->execute();

			$result = "";

			if (!$stmt->error) {
				$result = "Pendaftaran berhasil";
				header("location: index.php");
			} else {
				$result = "Pendaftaran gagal";
			}

			return $result;
		}

		public function getUser($id){
			$stmt = $this->con->prepare("SELECT * FROM user WHERE id = ?");
			$stmt->bind_param("s", $id);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

        public function cekLogin($uname) {
            $stmt = $this->con->prepare("SELECT * FROM user WHERE username=?");
            $stmt->bind_param("s", $uname);
            $stmt->execute();

            $result = $stmt->get_result();

            return $result;
        }
	}

	class Barang extends Koneksi{
		public function __construct(){
			parent::__construct();
		}

		
		//UNTUK SEARCH
		public function getTotalData($search)
        {
            $stmt = $this->con->prepare("SELECT * FROM barang WHERE nama LIKE ?");
            $stmt->bind_param("s", $search);
            $stmt->execute();

            $result = $stmt->get_result();
            return $result;
        }

		public function bacaData($searchby, $search){
			$stmt = $this->con->prepare("SELECT * FROM barang WHERE ? LIKE ? ");
			$stmt->bind_param("ss", $searchby, $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahBarang($idbarang, $nama, $hargajual, $hargabeli, $stok, $idkategori){
			$stmt = $this->con->prepare('INSERT INTO barang VALUES(?, ?, ?, ?, ?, ?)');
			$stmt->bind_param('isiiii', $idbarang, $nama, $hargabeli, $hargajual, $stok, $idkategori);
			$stmt->execute();
		}

		public function updateBarang($idbarang, $nama, $hbeli, $hjual, $url, $stok, $idkategori){
			$stmt = $this->con->prepare('UPDATE barang SET nama=?, harga_beli=?, harga_jual=?, url=?, stok_tersedia=?, id_kategori=? WHERE id=?');
			$stmt->bind_param("ssiisiii", $nama, $hbeli, $hjual, $url, $stok, $idkategori, $idbarang);
			$stmt->execute();
		}

		public function hapusBarang($idbarang) {
			$stmt = $this->con->prepare('DELETE FROM barang WHERE id=?');
			$stmt->bind_param("i", $idbarang);
			$stmt->execute();
		}

		// UNTUK STOK
		public function bacaStok($idbarang){
			$stmt = $this->con->prepare("SELECT stok_tersedia FROM barang WHERE id LIKE ? ");
			$stmt->bind_param("i", $idbarang);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function updateStok($idbarang, $stok){
			$stmt = $this->con->prepare('UPDATE barang SET stok_tersedia=? WHERE id=?');
			$stmt->bind_param("ii", $stok, $idbarang);
			$stmt->execute();
		}
	}

	class Kategori extends Koneksi{
		public function __construct(){
			parent::__construct();
		}

		public function bacaData($search){
			$stmt = $this->con->prepare("SELECT * FROM kategori_barang WHERE nama LIKE ? ");
			$stmt->bind_param("s", $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahKategori($nama, $url){
			$stmt = $this->con->prepare('INSERT INTO kategori_barang(nama, url) VALUES(?, ?)');
			$stmt->bind_param('ss', $nama, $url);
			$stmt->execute();
		}

		public function updateKategori($idkategori, $nama, $url){
			$stmt = $this->con->prepare('UPDATE kategori_barang SET nama=?, url=? WHERE id=?');
			$stmt->bind_param("ssi", $nama, $url, $idkategori);
			$stmt->execute();
		}

		public function hapusKategori($idkategori) {
			$stmt = $this->con->prepare('DELETE FROM kategori_barang WHERE id=?');
			$stmt->bind_param("i", $idkategori);
			$stmt->execute();
		}
	}

	class Supplier extends Koneksi {
		public function __construct(){
			parent::__construct();
		}

		public function updateSupplier($idsupplier, $namasupplier, $alamat, $notelepon){
			$stmt = $this->con->prepare('UPDATE supplier SET nama=?, alamat=?, nomor_telepon=? WHERE id=?');
			$stmt->bind_param("sssi", $namasupplier, $alamat, $notelepon, $idsupplier);
			$stmt->execute();
		}

		public function bacaData($search){
			$stmt = $this->con->prepare("SELECT * FROM supplier WHERE nama LIKE ?");
			$stmt->bind_param("s", $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahSupplier($namasupplier, $alamat, $notelepon){
			$stmt = $this->con->prepare('INSERT INTO supplier(nama, alamat, nomor_telepon) VALUE(?, ?, ?)');
			$stmt->bind_param("sss", $namasupplier, $alamat, $notelepon);
			$stmt->execute();
		}

		public function hapusSupplier($idsupplier) {
			$stmt = $this->con->prepare('DELETE FROM supplier WHERE id=?');
			$stmt->bind_param("i", $idsupplier);
			$stmt->execute();
		}
	}

	class DetailPenjualan extends Koneksi { //ini belom samsek
		public function __construct(){
			parent::__construct();
		}

		public function updateSupplier($idsupplier, $namasupplier, $alamat, $notelepon){
			$stmt = $this->con->prepare('UPDATE supplier SET nama=?, alamat=?, nomor_telepon=? WHERE id=?');
			$stmt->bind_param("sssi", $namasupplier, $alamat, $notelepon, $idsupplier);
			$stmt->execute();
		}

		public function bacaData($search){
			$stmt = $this->con->prepare("SELECT * FROM detail_transaksi_penjualan");
			$stmt->bind_param("s", $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahSupplier($namasupplier, $alamat, $notelepon){
			$stmt = $this->con->prepare('INSERT INTO supplier(nama, alamat, nomor_telepon) VALUE(?, ?, ?)');
			$stmt->bind_param("sss", $namasupplier, $alamat, $notelepon);
			$stmt->execute();
		}

		public function hapusKSupplier($idsupplier) {
			$stmt = $this->con->prepare('DELETE FROM supplier WHERE id=?');
			$stmt->bind_param("i", $idsupplier);
			$stmt->execute();
		}
	}

	class Penyesuaian extends Koneksi {
		public function __construct(){
			parent::__construct();
		}

		

		public function bacaData($search){
			$stmt = $this->con->prepare("SELECT * FROM penyesuaian WHERE keterangan LIKE ?");
			$stmt->bind_param("s", $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahPenyesuaian($tanggal, $keterangan, $stok, $idbarang){
			$stmt = $this->con->prepare('INSERT INTO penyesuaian(tanggal, keterangan, stok_penyesuaian, id_barang) VALUE(?, ?, ?, ?)');
			$stmt->bind_param("ssii", $tanggal, $keterangan, $stok, $idbarang);
			$stmt->execute();

			$barang = new Barang();

			$result = ($barang)->bacaStok($idbarang);

			if ($row = $result->fetch_assoc()) {
				$stok_akhir = $row['stok_tersedia'] - $stok;
				($barang)->updateStok($idbarang, $stok_akhir);
			}
		}
	}

?>