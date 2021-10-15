<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mapel');
        $this->load->model('M_peserta_didik');
        $this->load->model('M_Gtk');
        $this->load->model('M_rombel');
    }

    public function indexkepsek()
    {
        $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $data['countnon'] = $this->M_peserta_didik->getCountSiswaNonAktif();
        $data['countgtk'] = $this->M_Gtk->getCountGTK();
        $data['countrombel'] = $this->M_rombel->getCountRombel();

        $this->load->helper('tgl_indo');
        $waktu = date('Y-m-d');
        $data['waktu'] = formatHariTanggal($waktu);
        $data['jabatan'] = $this->session->userdata('jabatan');
        $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $this->load->view('index', $data);
    }       
    public function indexguru()
    {
        $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $data['countnon'] = $this->M_peserta_didik->getCountSiswaNonAktif();
        $data['countgtk'] = $this->M_Gtk->getCountGTK();
        $data['countrombel'] = $this->M_rombel->getCountRombel();
        $data['gtk'] = $this->session->userdata('id_gtk');
        $waktu = date('Y-m-d');
        $data['waktu'] = formatHariTanggal($waktu);
        $date = formatHariTanggal($waktu);
        // $data['cek'] = $this->db->get('tb_absensi')->row();
        /*-----------------Apa Ini-----------------*/

        list($hari) = mb_split('[,]', $date);
        $id_gtk = $this->session->userdata('id_gtk');
        $this->load->helper('tgl_indo');
        $data['info'] = $this->db->get('tb_jenis_info')->result();
        $data['jadwal'] = $this->M_mapel->jadwalAjar($id_gtk, $hari);
        $data['pr'] = $this->M_mapel->jadwalAjar($id_gtk, $hari);
        $data['jabatan'] = $this->session->userdata('jabatan');
        if ($data == 0) {
            $this->session->set_flashdata(
                'kosong',
                '<div class="alert alert-success">
                <p> Jadwal anda hari ini kosong!</p>
                </div>'
            );
            $this->load->view('index', $data);
        } else {
            $this->load->view('index', $data);
        }
    }
    public function indexoperator()
    {
        $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $data['countnon'] = $this->M_peserta_didik->getCountSiswaNonAktif();
        $data['countgtk'] = $this->M_Gtk->getCountGTK();
        $data['countrombel'] = $this->M_rombel->getCountRombel();
       
       $waktu = date('Y-m-d');
        $data['waktu'] = formatHariTanggal($waktu);
        $date = formatHariTanggal($waktu);
        list($hari) = mb_split('[,]', $date);
        $id_gtk = $this->session->userdata('id_gtk');
        $this->load->helper('tgl_indo');
        $data['info'] = $this->db->get('tb_jenis_info')->result();
        $data['jadwal'] = $this->M_mapel->jadwalAjar($id_gtk, $hari);
        $data['pr'] = $this->M_mapel->jadwalAjar($id_gtk, $hari);
        
        $data['waktu'] = formatHariTanggal($waktu);
        $data['jabatan'] = $this->session->userdata('jabatan');
        
        $this->load->view('index', $data);
    }
    public function indextu()
    {
        $data['count'] = $this->M_peserta_didik->getCountSiswaAktif();
        $data['countnon'] = $this->M_peserta_didik->getCountSiswaNonAktif();
        $data['countgtk'] = $this->M_Gtk->getCountGTK();
        $data['countrombel'] = $this->M_rombel->getCountRombel();
        $this->load->helper('tgl_indo');
        $waktu = date('Y-m-d');
        $data['waktu'] = formatHariTanggal($waktu);
        $data['jabatan'] = $this->session->userdata('jabatan');
        $this->load->view('index', $data);
    }
}
