<?php
class Koneksi
{
	protected $con;

	public function __construct()
	{
		$this->con = new mysqli("localhost", "root", "", "dbdapurperdana");
	}

	public function getError()
	{
		if ($this->con->connect_errno) {
			return "Failed Connect: " . $this->con->connect_errno;
		}
	}

	public function __destruct()
	{
		$this->con->close();
	}
}

class User extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	// lanjut ntar
	public function daftar($user, $nama, $pwd, $role)
	{
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

	public function getUser($id)
	{
		$stmt = $this->con->prepare("SELECT * FROM user WHERE id = ?");
		$stmt->bind_param("s", $id);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function cekLogin($uname)
	{
		$stmt = $this->con->prepare("SELECT * FROM user WHERE username=?");
		$stmt->bind_param("s", $uname);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}
}

class Barang extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function bacaDataById($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM barang WHERE id LIKE ? ");
		$stmt->bind_param("i", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM barang WHERE nama LIKE ? ");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	//UNTUK SEARCH
	public function getTotalData($kategori, $search)
	{
		// $stmt = $this->con->prepare("SELECT * FROM barang WHERE id_kategori LIKE ? AND nama LIKE ?");
		$stmt = $this->con->prepare("SELECT b.* FROM barang b INNER JOIN kategori_barang kb ON b.id_kategori = kb.id WHERE kb.nama LIKE ? AND b.nama LIKE ? ORDER BY b.id");
		$stmt->bind_param("ss", $kategori, $search);
		$stmt->execute();

		$result = $stmt->get_result();
		return $result;
	}

	public function tambahBarang($nama, $hargabeli, $hargajual, $url, $stok, $idkategori)
	{
		// $idbarang,
		$stmt = $this->con->prepare('INSERT INTO barang(nama,harga_beli,harga_jual,url,stok_tersedia,id_kategori) VALUES(?, ?, ?, ?, ?, ?)');
		$stmt->bind_param('siisii', $nama, $hargabeli, $hargajual, $url, $stok, $idkategori);
		$stmt->execute();
	}

	public function updateBarang($idbarang, $nama, $hbeli, $hjual, $url, $stok, $idkategori)
	{
		$stmt = $this->con->prepare('UPDATE barang SET nama=?, harga_beli=?, harga_jual=?, url=?, stok_tersedia=?, id_kategori=? WHERE id=?');
		$stmt->bind_param("siisiii", $nama, $hbeli, $hjual, $url, $stok, $idkategori, $idbarang);
		$stmt->execute();
	}

	public function hapusBarang($idbarang)
	{
		$stmt = $this->con->prepare('DELETE FROM barang WHERE id=?');
		$stmt->bind_param("i", $idbarang);
		$stmt->execute();
	}

	// UNTUK STOK
	public function bacaStok($idbarang)
	{
		$stmt = $this->con->prepare("SELECT nama, stok_tersedia, harga_jual FROM barang WHERE id LIKE ? ");
		$stmt->bind_param("i", $idbarang);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function updateStok($idbarang, $stok)
	{
		$stmt = $this->con->prepare('UPDATE barang SET stok_tersedia=? WHERE id=?');
		$stmt->bind_param("ii", $stok, $idbarang);
		$stmt->execute();
	}
}

class Kategori extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM kategori_barang WHERE nama LIKE ? ");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function bacaDataById($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM kategori_barang WHERE id LIKE ? ");
		$stmt->bind_param("i", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function tambahKategori($nama, $url)
	{
		$stmt = $this->con->prepare('INSERT INTO kategori_barang(nama, url) VALUES(?, ?)');
		$stmt->bind_param('ss', $nama, $url);
		$stmt->execute();
	}

	public function updateKategori($idkategori, $nama, $url)
	{
		$stmt = $this->con->prepare('UPDATE kategori_barang SET nama=?, url=? WHERE id=?');
		$stmt->bind_param("ssi", $nama, $url, $idkategori);
		$stmt->execute();
	}

	public function hapusKategori($idkategori)
	{
		$stmt = $this->con->prepare('DELETE FROM kategori_barang WHERE id=?');
		$stmt->bind_param("i", $idkategori);
		$stmt->execute();
	}
}

class Supplier extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function updateSupplier($idsupplier, $namasupplier, $alamat, $notelepon)
	{
		$stmt = $this->con->prepare('UPDATE supplier SET nama=?, alamat=?, nomor_telepon=? WHERE id=?');
		$stmt->bind_param("sssi", $namasupplier, $alamat, $notelepon, $idsupplier);
		$stmt->execute();
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM supplier WHERE nama LIKE ?");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function bacaDataById($id)
	{
		$stmt = $this->con->prepare("SELECT * FROM supplier WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function tambahSupplier($namasupplier, $alamat, $notelepon)
	{
		$stmt = $this->con->prepare('INSERT INTO supplier(nama, alamat, nomor_telepon) VALUE(?, ?, ?)');
		$stmt->bind_param("sss", $namasupplier, $alamat, $notelepon);
		$stmt->execute();
	}

	public function hapusSupplier($idsupplier)
	{
		$stmt = $this->con->prepare('DELETE FROM supplier WHERE id=?');
		$stmt->bind_param("i", $idsupplier);
		$stmt->execute();
	}
}

class DetailPenjualan extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT DATE_FORMAT(tp.tanggal,'%Y-%m-%d') Hari, DATE_FORMAT(tp.tanggal,'%H:%i:%s') Waktu, b.nama, dtp.jumlah_terjual, dtp.total, tp.metode_pembayaran, b.harga_beli, dtp.total-harga_beli untung
		FROM transaksi_penjualan tp INNER JOIN detail_transaksi_penjualan dtp ON tp.id_transaksi = dtp.id_transaksi_penjualan
		INNER JOIN barang b ON dtp.id_barang = b.id WHERE tp.tanggal LIKE ?");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function tambahDataTransaksiPenjualan($idkaryawan, $metodepembayaran = 'Tunai', $jumlahtotal = 0)
	{
		$stmt = $this->con->prepare('INSERT INTO transaksi_penjualan(metode_pembayaran, jumlah_total, id_user) VALUE(?, ?, ?)');
		$stmt->bind_param("sii", $metodepembayaran, $jumlahtotal, $idkaryawan);
		$stmt->execute();
	}

	public function tambahDataDetailTransaksiPenjualan($idtransaksi, $idbarang, $jumlah, $harga, $total, $diskon)
	{
		$stmt = $this->con->prepare('INSERT INTO detail_transaksi_penjualan(jumlah_terjual, harga_satuan, total, diskon, id_transaksi_penjualan, id_barang) VALUE(?, ?, ?, ?, ?, ?)');
		$stmt->bind_param("iiiiii", $jumlah, $harga, $total, $diskon, $idtransaksi, $idbarang);
		$stmt->execute();
	}
}

class Penyesuaian extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM penyesuaian WHERE keterangan LIKE ?");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function tambahPenyesuaian($keterangan, $stok, $idbarang)
	{
		$stmt = $this->con->prepare('INSERT INTO penyesuaian(keterangan, stok_penyesuaian, id_barang) VALUE(?, ?, ?)');
		$stmt->bind_param("sii", $keterangan, $stok, $idbarang);
		$stmt->execute();
	}
}
class Pegawai extends Koneksi
{
	public function __construct()
	{
		parent::__construct();
	}

	public function updatePegawai($idpegawai, $usernamepegawai, $password, $namapegawai, $role)
	{
		$stmt = $this->con->prepare('UPDATE user SET username=?, password=?, nama=?, role=? WHERE id=?');
		$stmt->bind_param("ssssi",$usernamepegawai, $password, $namapegawai, $role, $idpegawai);
		$stmt->execute();
	}

	public function bacaData($search)
	{
		$stmt = $this->con->prepare("SELECT * FROM user WHERE nama LIKE ?");
		$stmt->bind_param("s", $search);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function bacaDataById($id)
	{
		$stmt = $this->con->prepare("SELECT * FROM user WHERE id = ?");
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$result = $stmt->get_result();

		return $result;
	}

	public function tambahPegawai($usernamepegawai, $password, $namapegawai, $role)
	{
		$stmt = $this->con->prepare('INSERT INTO user(username, password, nama, role) VALUE(?, ?, ?, ?)');
		$stmt->bind_param("ssss", $usernamepegawai, $password, $namapegawai, $role);
		$stmt->execute();
	}

	public function hapusPegawai($idpegawai)
	{
		$stmt = $this->con->prepare('DELETE FROM user WHERE id=?');
		$stmt->bind_param("i", $idpegawai);
		$stmt->execute();
	}
}
