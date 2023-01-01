<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("status") != 'login') {
            $this->session->set_flashdata('error', 'Silahkan Login Terlebih Dahulu !!');
            redirect('auth');
        }
    }
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'isi'     => 'temp/v_dashboard',
            'tagihan' => $this->db->select('sum(tagihan) as jumlah_tagihan')->get('tb_tagihan')->row()->jumlah_tagihan,
            'bayar' => $this->db->select('sum(gross_amount) as total_bayar')->where(['status_code' => 200])->get('tb_bayar')->row()->total_bayar,
            'santri' => $this->db->get('tb_santri')->num_rows(),
            'spp' => $this->db->get('tb_spp')->num_rows(),
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
}
