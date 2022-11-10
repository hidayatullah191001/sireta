<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
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

	public function getCount()
    {
        return $this->db->get('fileupload')->num_rows();
    }
	
	public function getListDataFilterKategori($id_kategori) {
		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->where('id_kategori', $id_kategori);
		return $this->db->get()->result_array();
	}

	public function getListData() {
		$this->db->select('*');
		$this->db->from('fileupload');
		return $this->db->get()->result_array();
	}

	public function getListDataPage($id_kategori, $limit, $start) {
		$this->db->where('id_kategori', $id_kategori);
		$this->db->order_by('id','desc');
        return $this->db->get('fileupload', $limit, $start)->result_array();
	}

	public function getListDataPageAll($limit, $start) {
		return $this->db->get('fileupload', $limit, $start)->result_array();
	}

	public function getSearchByKategori($id_kategori, $iduser){
		$key = $this->input->post('key', true);
		
		$query = "SELECT u.nama, f.id, f.judul, f.nama_file, f.date_uploaded, f.id_user, f.id_kategori
		FROM fileupload f
		inner join user u ON f.id_kategori = '".$id_kategori."'
		where u.id = '".$iduser."' and judul like '%".$key."%' or nama like '%".$key."%'";

		return $this->db->query($query)->result_array();
	}

	public function getSearch(){
		$keyword = $this->input->post('key', true);
		$this->db->select('u.nama, f.id, f.judul, f.nama_file, f.date_uploaded, f.id_user');
		$this->db->from('fileupload f');
		$this->db->join('user u', 'u.id = f.id_user');
		$this->db->like('judul', $keyword);
		$this->db->or_like('nama', $keyword);
		return $this->db->get()->result_array();
	}
	public function total($id_user)
	{   
		$this->db->select('*');
		$this->db->from('bookmark');
		$this->db->where('id_user', $id_user);
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}
	public function getSearchBookmark(){
		$keyword = $this->input->post('key', true);
		$this->db->select('u.nama, f.id, f.judul, f.nama_file, f.date_uploaded, f.id_user');
		$this->db->from('bookmark b');
		$this->db->join('fileupload f', 'b.id_file = f.id');
		$this->db->join('user u', 'u.id = b.id_user');
		$this->db->like('judul', $keyword);
		$this->db->or_like('nama', $keyword);
		return $this->db->get()->result_array();
	}

	public function total2()
	{   
		$this->db->select('*');
		$this->db->from('bookmark');
		$query = $this->db->get();
		if($query->num_rows()>0)
		{
			return $query->num_rows();
		}
		else
		{
			return 0;
		}
	}

	public function getBookmark($iduser){
		$query = "SELECT DISTINCT b.id_file, b.status, f.id, f.judul, f.nama_file, f.date_uploaded, f.id_user, f.id_kategori FROM bookmark b INNER JOIN fileupload f ON b.id_file = f.id WHERE b.id_user = '".$iduser."'";
		return $this->db->query($query)->result();
	}


	public function getData($iduser){
		$this->db->select('b.id_file, b.status');
		$this->db->from('bookmark b');
		$this->db->join('fileupload f', 'b.id_file = f.id');
		$this->db->where_in('b.id_user', $iduser);
		return $this->db->get()->result();
	}
}