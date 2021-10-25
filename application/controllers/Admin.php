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
	public function listPosyandu(){
		$this->load->view('Admin/list_posyandu');
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
	public function listBidan(){
		$data['bidan'] = $this->db->query("SELECT * FROM user WHERE role='bidan'")->result();
		$this->load->view('Admin/list_bidan',$data);
	}

	
	

	
	
    
}
