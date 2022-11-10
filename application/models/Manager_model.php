<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager_model extends CI_Model
{
	private $_table = "user";
	private $_tablelist = "fileupload";

	public $id;
	public $nama;
	public $username;
	public $role_id;
	public $status;

	public function getById($id_user) {
		return $this->db->get_where($this->_table, ["id" => $id_user])->row();
	}

	public function getListById($id_user) {
		return $this->db->get_where($this->_tablelist, ["id" => $id_user])->row();
	}

	public function getAll() {
		return $this->db->get($this->_table)->result();
	}

	public function getKategori() {
		return $this->db->get('kategori')->result();
	}
	
	public function getListDataFilterKategori($id_kategori) {
		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->where('id_kategori', $id_kategori);
		return $this->db->get()->result();
	}

	public function getListData() {
		$this->db->select('*');
		$this->db->from('fileupload');
		return $this->db->get()->result();
	}

	public function getDataToExcelFilterWithKategori($idkategori, $iduser, $tglmulai, $tglakhir) {

		$query = "SELECT *
		FROM fileupload f
		inner join user u ON f.id_kategori = '".$idkategori."'
		where u.id ='".$iduser."' AND date_uploaded >= '".$tglmulai."' AND date_uploaded <= '".$tglakhir."'";
		return $this->db->query($query)->result();
	}

	public function getDataToExcelFilterWithKategori2($iduser, $tglmulai, $tglakhir) {

		$query = "SELECT *
		FROM fileupload f
		inner join user u ON u.id = f.id_user
		where date_uploaded >= '".$tglmulai."' AND date_uploaded <= '".$tglakhir."'";
		return $this->db->query($query)->result();
	}


	public function getDataToExcelFilter($tglmulai, $tglakhir) {

		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->join('user', 'user.id = fileupload.id_user');
		$this->db->where('date_uploaded >=', $tglmulai);
		$this->db->where('date_uploaded <=', $tglakhir);
		return $this->db->get();
	}

	public function getDataToExcelNoFilter($idkategori, $iduser) {

		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->join('user', "fileupload.id_kategori = '".$idkategori."'");
		$this->db->where('user.id = ', $iduser);
		return $this->db->get();
	}

	public function getDataToExcel() {

		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->join('user', 'user.id = fileupload.id_user');
		return $this->db->get();
	}

	public function getDataToExcelByKategori($idkategori) {

		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->join('user', 'user.id = fileupload.id_user');
		$this->db->where('fileupload.id_kategori', $idkategori);
		return $this->db->get();
	}

	public function getSortir(){
		
		$tgl_mulai = $this->input->get('tgl_mulai');
		$tgl_akhir = $this->input->get('tgl_akhir');
		
		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->join('user', 'user.id = fileupload.id_user');
		$this->db->where('date_uploaded >=', $tgl_mulai);
		$this->db->where('date_uploaded <=', $tgl_akhir);
		return $this->db->get();
	}

	public function getSortirByKategori($idkategori, $iduser){
		
		$tgl_mulai = $this->input->get('tgl_mulai');
		$tgl_akhir = $this->input->get('tgl_akhir');

		$query = "SELECT *
		FROM fileupload f
		inner join user u ON f.id_kategori = '".$idkategori."'
		where u.id ='".$iduser."' AND date_uploaded >= '".$tgl_mulai."' AND date_uploaded <= '".$tgl_akhir."'";
		return $this->db->query($query)->result();
	}

}