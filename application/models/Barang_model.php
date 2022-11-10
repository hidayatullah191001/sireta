<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
	
	public function getBarang(){
		$query = "SELECT barang.id, id_cabang, title, cabang, stok FROM barang INNER JOIN ms_cabang ON barang.id_cabang = ms_cabang.id";
		return $this->db->query($query)->result_array();
	}

	public function getBarangById($id_barang){
		return $this->db->get_where('barang', ['id' => $id_barang])->row_array();
	}

	public function getCabang(){
		return $this->db->get('ms_cabang')->result();
	}

	public function getPinjam(){
		$query = "SELECT pinjam.id_barang, pinjam FROM pinjam INNER JOIN barang ON pinjam.id_barang = barang.id";
		return $this->db->query($query)->result_array();
	}

	public function getDetailPinjam(){
		$query = "SELECT p.title, p.stok, d.*  FROM barang as p 
		INNER JOIN detail_pinjam as d on p.id = d.id_barang";
		return $this->db->query($query)->result_array();
	}

	public function getDataPinjamByParam($cabang, $id_barang, $jumlah_pinjam){
		$query = "SELECT b.title, b.stok, c.cabang, p.* FROM pinjam as p 
		INNER JOIN ms_cabang as c on c.id = $cabang INNER JOIN barang as b on b.id = $id_barang 
		WHERE p.id_cabang = $cabang AND p.id_barang = $id_barang AND p.pinjam = $jumlah_pinjam";
		return $this->db->query($query)->row_array();
	}
}
