<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('M_mapel');
        // $this->load->model('M_peserta_didik');
        // $this->load->model('M_Gtk');
        // $this->load->model('M_rombel');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper(array('form', 'url'));
		
		if($this->session->userdata('role') == null){
			echo "<script>
			alert('Anda belum login');
			window.location.href = '" . base_url('Auth') . "';
		</script>"; //Url tujuan
		} else if ($this->session->userdata('role') == 'bidan') {
			echo "<script>
			alert('Anda sudah login sebagai Bidan');
			window.location.href = '" . base_url('Bidan') . "';
		</script>"; //U
		} else if ($this->session->userdata('role') == 'user') {
			echo "<script>
			alert('Anda sudah login sebagai User');
			window.location.href = '" . base_url('User') . "';
		</script>"; //U
		}
    }

    public function index()
    {
        // $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        // $data['countnon'] = $this->M_peserta_didik->getCountSiswaNonAktif();
        // $data['countgtk'] = $this->M_Gtk->getCountGTK();
        // $data['countrombel'] = $this->M_rombel->getCountRombel();

        // $this->load->helper('tgl_indo');
        // $waktu = date('Y-m-d');
        // $data['waktu'] = formatHariTanggal($waktu);
        // $data['jabatan'] = $this->session->userdata('jabatan');
        // $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $this->load->view('Admin/index');
    } 
	public function addPosyandu(){
		$this->load->view('Admin/add_posyandu');
	}
	public function addPosyanduAction(){
		$data = [
			'nama_posyandu' => htmlspecialchars($this->input->post('nama_posyandu')),
			'penanggung_jawab' => htmlspecialchars($this->input->post('penanggung_jawab')),
			'longitude' => $this->input->post('longitude'),
			'latitude' => $this->input->post('latitude'),
			'keterangan' => $this->input->post('keterangan')
		];
		$this->db->insert('posyandu', $data);
		redirect('Admin/listPosyandu');
	}
	public function listPosyandu(){
		$data['posyandu'] = $this->db->query("SELECT * FROM posyandu")->result();
		$this->load->view('Admin/list_posyandu', $data);
	}



	public function addImunisasi(){
		$this->load->view('Admin/add_imunisasi');
	}
	public function addImunisasiAction(){
		$data = [
			'nama_vaksin' => htmlspecialchars($this->input->post('nama_vaksin')),
			'umur' => htmlspecialchars($this->input->post('umur'))
		];
		$this->db->insert('imunisasi', $data);
		redirect('Admin/listImunisasi');
	}
	public function listImunisasi(){
		$data['imunisasi'] = $this->db->query("SELECT * FROM imunisasi")->result();
		$this->load->view('Admin/list_imunisasi', $data);
	}



	public function addBidan(){
		$this->load->view('Admin/add_bidan');
	}
	public function addBidanAction(){
		$data = [
			'nama' => htmlspecialchars($this->input->post('nama_bidan')),
			'email' => htmlspecialchars($this->input->post('email')),
			'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
			'foto_ktp' => 'default.jpg',
			'longitude' => '-',
			'latitude' => '-',
			'is_active' => 1,
			'role' => 'bidan'
		];
		$this->db->insert('user', $data);
		redirect('Admin/listBidan');
	}
	public function is_active(){
		$id = $this->uri->segment(3);
		$this->db->select('is_active');
		$set_active = $this->db->get_where('user', array('id' => $id));
		$this->db->set('is_active', $set_active == 1 ? 0 : 1);
		$this->db->where('id', $id);
		$this->db->update('user');
		redirect('Admin/listBidan');
	}
	public function deleteBidan(){
		$id = $this->uri->segment(3);
		$this->db->delete('user', array('id' => $id));
		redirect('Admin/listBidan');
	}
	public function listBidan(){
		$data['bidan'] = $this->db->query("SELECT * FROM user WHERE role='bidan'")->result();
		$this->load->view('Admin/list_bidan',$data);
	}

	
	

	
	
    
}
