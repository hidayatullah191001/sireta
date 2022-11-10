<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
	private $_table = "user";
	private $_tablelist = "fileupload";

	public $id;
	public $nama;
	public $username;
	public $password;
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
	
	public function getListDataFilterKategori($id) {
		$this->db->select('*');
		$this->db->from('fileupload');
		$this->db->where('id_kategori', $id);
		return $this->db->get()->result();
	}

	public function getListData() {
		$this->db->select('*');
		$this->db->from('fileupload');
		return $this->db->get()->result();
	}

	public function countUser()
	{
		return $this->db->get('user')->num_rows();
	}

	public function delete($id_user)
	{
		return $this->db->delete($this->_table, array("id" => $id_user));
	}

	public function update_user(){
		$post = $this->input->post();
		$pwlama = $post['pwlama'];
		$inputpwbaru = $post['password1'];

		$pwbaru = password_hash($inputpwbaru, PASSWORD_DEFAULT);

		$username = $post['username'];

		$this->id = $post['id'];
		$this->nama = $post['nama'];
		$this->username = $username;


		if ($inputpwbaru == "") {
			$this->password = $pwlama;
		}else{
			$this->password = $pwbaru;
		}

		$this->role_id = $post['role'];

		if(isset($_POST['status']) )
		{
			$this->status = $post["status"];
		}
		else
		{
			$this->status = 0;
		}
		$this->db->update($this->_table, $this, array('id' => $post['id']));
	}
}
