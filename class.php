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



		public function bacaDataBarang($searchby, $search){
			// $stmt = $this->con->prepare("SELECT b.id_barang, b.nama_barang, b.stok_tersedia, b.harga_jual FROM barang b INNER JOIN kategori_barang k ON b.kategori_barang_id_kategori = k.id_kategori WHERE k.nama_kategori LIKE ?");
			$stmt = $this->con->prepare("SELECT * FROM barang WHERE ? LIKE ? ");
			$stmt->bind_param("ss", $searchby, $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function paginationWithLimit($search, $start, $item = 7){
			// $stmt = $this->con->prepare('SELECT b.id_barang, b.nama_barang, b.stok_tersedia, b.harga_jual FROM barang b INNER JOIN kategori_barang k ON b.kategori_barang_id_kategori = k.id_kategori WHERE k.nama_kategori LIKE ? LIMIT ?,?');
			$stmt = $this->con->prepare("SELECT * FROM barang WHERE id LIKE ? LIMIT ?,?");
			$stmt->bind_param("sii", $search, $start, $item);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}

		public function tambahBarang($idbarang, $nama, $hargajual, $hargabeli, $stok, $idkategori){
			$stmt = $this->con->prepare('INSERT INTO barang VALUES(?, ?, ?, ?, ?, ?)');
			$stmt->bind_param('isiiii', $idbarang, $nama, $hargabeli, $hargajual, $stok, $idkategori);
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

		public function pagination($search){
			$stmt = $this->con->prepare("SELECT * FROM supplier WHERE id LIKE ?");
			$stmt->bind_param("s", $search);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}
		
		public function paginationWithLimit($search, $start, $item = 7){
			$stmt = $this->con->prepare("SELECT * FROM supplier WHERE id LIKE ? LIMIT ?,?");
			$stmt->bind_param("sii", $search, $start, $item);
			$stmt->execute();

			$result = $stmt->get_result();

			return $result;
		}
	}
?>