<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Manager extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('username', 'role_id')) {
			$data = base_url();
			$this->session->unset_userdata('username', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$userdata = $this->session->userdata();
		if ($userdata['role_id'] != 3) {
			$data = base_url();
			$this->session->unset_userdata('username', 'role_id');
			$this-> session ->set_flashdata('message', '<div class = "mt-3 alert alert-danger" role="alert">Login terlebih dahulu!</div>');
			redirect($data);
		}
		$this->load->library('form_validation');
		$this->load->model('Manager_model');
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['title'] = 'Beranda';
		$data['kategori'] = $this->Manager_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('manager/index');
		$this->load->view('template/footer', $data);
	}

	public function laporan($idkategori=null)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Manager_model->getKategori();
		$data['role'] = $this->db->get('user_role')->result();
		$iduser = $data['user']['id'];

		if ($idkategori != null) {
			$data['kategoriid'] = $this->db->get_where('kategori',['id' => $idkategori])->row_array();
			$data['title'] = $data['kategoriid']['kategori'];
			$data['fileupload'] = $this->Manager_model->getListDataFilterKategori($idkategori);
			if($this->input->get('tgl_mulai') && $this->input->get('tgl_akhir')){
				$data['fileupload'] = $this->Manager_model->getSortirByKategori($idkategori, $iduser);
			}
		}else{
			$data['title'] = "Lihat Semua Laporan";
			$data['fileupload'] = $this->Manager_model->getListData();
			if($this->input->get('tgl_mulai') && $this->input->get('tgl_akhir')){
				$data['fileupload'] = $this->Manager_model->getSortir()->result();
			}
		}
		$data['akun'] = $this->db->get('user')->result();
		$data['idkategori'] = $idkategori;

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('manager/laporan', $data);
		$this->load->view('template/footer', $data);
	}

	public function export($tanggal, $idkategori=null)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$iduser = $data['user']['id'];
		$data['role'] = $this->db->get('user_role')->result();

		if ($idkategori != null) {
			if ($tanggal != 0) {
				$explode = explode("--", $tanggal);
				$tglmulai = trim($explode[0]);
				$tglakhir= trim($explode[1]);
				if ($tglmulai != null && $tglakhir !=null) {
					$datafile = $this->Manager_model->getDataToExcelFilterWithKategori($idkategori, $iduser, $tglmulai, $tglakhir);
				}elseif ($tanggal == "--") {
					$datafile = $this->Manager_model->getDataToExcelNoFilter($idkategori,$iduser)->result();
				}
			}else{
				$datafile = $this->Manager_model->getDataToExcelByKategori($idkategori)->result();
			}
		}else if ($idkategori == 0) {
			if ($tanggal != 0) {
				$explode = explode("--", $tanggal);
				$tglmulai = trim($explode[0]);
				$tglakhir= trim($explode[1]);
				if ($tglmulai != null && $tglakhir !=null) {
					$datafile = $this->Manager_model->getDataToExcelFilter($tglmulai, $tglakhir)->result();	
				}elseif($tanggal == "--"){
					$datafile = $this->Manager_model->getDataToExcel()->result();
				}
			}else{
				$datafile = $this->Manager_model->getDataToExcel()->result();
			}	
		}

		$spreadsheet = new Spreadsheet;

		$spreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No')
		->setCellValue('B1', 'Judul')
		->setCellValue('C1', 'Tanggal Upload')
		->setCellValue('D1', 'File Upload')
		->setCellValue('E1', 'Pengupload');

		$kolom = 2;
		$nomor = 1;
		foreach($datafile  as $df) {

			$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A' . $kolom, $nomor)
			->setCellValue('B' . $kolom, $df->judul)
			->setCellValue('C' . $kolom, date('d F Y', strtotime($df->date_uploaded)))
			->setCellValue('D' . $kolom, $df->nama_file)
			->setCellValue('E' . $kolom, $df->nama);

			$kolom++;
			$nomor++;

		}

		$writer = new Xlsx($spreadsheet);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Rekap Bank Data.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function profile(){
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Manager_model->getKategori();
		$id = $data['user']['id'];
		$old_username = $data['user']['username'];
		$data['role'] = $this->db->get('user_role')->result();

		$this->form_validation->set_rules('nama', 'Nama', 'required',[
			'required' => 'Nama tidak boleh kosong!'
		]);

		$this->form_validation->set_rules('username', 'Username', 'required',[
			'required' => ' Username tidak boleh kosong!'
		]);

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Edit Profile';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('manager/profile', $data);
			$this->load->view('template/footer', $data);
		}else{
			$nama = $this->input->post('nama');
			$username = $this->input->post('username');
			$pwlama = $this->input->post('pwlama');
			$pwbaru = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$upload_image = $_FILES['image']['name'];

			if($upload_image){
				$config['allowed_types'] = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
				$config['max_size'] = '2048';
				$config['upload_path'] = './assets/profile/';

				$this->load->library('upload', $config);

				if($this->upload->do_upload('image'))
				{
					$old_image = $data['user']['image'];
					if($old_image != 'default.png'){
						unlink(FCPATH . 'assets/profile/'. $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				}
				else
				{
					echo $this->upload->display_errors();
				}
			}

			if ($username == $old_username) {
				$this->db->set('nama', $nama);
				$this->db->where('id', $id);
				$this->db->update('user');

				$this->session->set_flashdata('message', '
					<div class="alert alert-success text-success">Profile berhasil diperbarui!
					</div>');
				redirect('manager/profile');
			}else{
				$this->db->set('nama', $nama);
				$this->db->set('username', $username);
				$this->db->where('id', $id);
				$this->db->update('user');

				$this->session->unset_userdata('username');
				$this->session->unset_userdata('role_id');
				$this->session->set_flashdata('message', '
					<div class="mt-3 alert alert-success text-success">Profile berhasil diperbarui! Silahkan login kembali!
					</div>');
				redirect('auth');
			}
		}
	}

	public function hapusGambar($id)
	{
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

		$old_image = $data['user']['image'];

		if($old_image != 'default.png'){
			unlink(FCPATH . 'assets/profile/'. $old_image);
		}

		$name = "default.png";
		$this->db->set('image', $name);
		$this->db->where('id', $id);
		$this->db->update('user');

		$this->session->set_flashdata('message', '
			<div class="alert alert-success text-success">Profile berhasil dihapus!
			</div>');
		redirect('manager/profile');
	}

	public function ubah_password(){
		
		$data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
		$data['kategori'] = $this->Manager_model->getKategori();
		$id = $data['user']['id'];
$data['role'] = $this->db->get('user_role')->result();
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'required'=> 'Password tidak boleh kosong!',
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek. Min 8 char!'
		]);
		$this->form_validation->set_rules('password2', 'Passoword', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Ubah Kata Sandi';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('manager/ubah_password', $data);
			$this->load->view('template/footer', $data);
		}else{
			$pwbaru = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$this->db->set('password', $pwbaru);
			$this->db->where('id', $id);
			$this->db->update('user');
			$this->session->set_flashdata('message', '<div class="alert alert-success">
				Password berhasil diubah!</div>');
			redirect('manager/ubah_password');
		}
	}
}