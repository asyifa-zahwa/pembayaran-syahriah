<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Santri extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("status") != 'login') {
            $this->session->set_flashdata('error', 'Silahkan Login Terlebih Dahulu !!');
            redirect('auth');
        }
        $this->load->model('m_santri');
        $this->load->model('m_tagihan');

    }
    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/santri/index/';
        $config['total_rows'] = $this->m_santri->getAllNum();
        $config['per_page'] = 10;

        

        // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data Santri',
            'isi'     => 'santri/data',
            'santri' => $this->m_santri->get($config['per_page'], $data['start'])
        ];
        
        
        $this->load->view('temp/v_master_admin', $data);
    }
    public function tambah()
    {
        $this->form_validation->set_rules('kode', 'kode', 'required', ['required' => '* Kode Wajib di Isi !!']);
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => '* Nama Wajib di Isi !!']);
        // $this->form_validation->set_rules('no_hp', 'no_hp', 'required', ['required' => '* Tanggal Lahir Wajib di Isi !!']);
        // $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => '* Alamat Wajib di Isi !!']);
        // $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required', ['required' => '* Nama Wali Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('santri');
        } else {
            // $kode = date('Y') . substr(rand(), 0, 4);
            $data = [
                // 'kode' => $kode,
                'kode' => $this->input->post('kode'),
                'nama' => ucwords(strtolower($this->input->post('nama'))),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => ucwords(strtolower($this->input->post('alamat'))),
                'nama_wali' => ucwords(strtolower($this->input->post('nama_wali'))),
                'status' => $this->input->post('status'),
            ];
            $this->m_santri->input($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
            redirect('santri');
        }
    }
    public function update($id_santri)
    {
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => '* Nama Wajib di Isi !!']);
        $this->form_validation->set_rules('kode', 'kode', 'required', ['required' => '* Kode Wajib di Isi !!']);
        // $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => '* Nama Wajib di Isi !!']);
        // $this->form_validation->set_rules('no_hp', 'no_hp', 'required', ['required' => '* Tanggal Lahir Wajib di Isi !!']);
        // $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => '* Alamat Wajib di Isi !!']);
        // $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required', ['required' => '* Nama Wali Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('santri');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => ucwords(strtolower($this->input->post('nama'))),
                'no_hp' => $this->input->post('no_hp'),
                'alamat' => ucwords(strtolower($this->input->post('alamat'))),
                'nama_wali' => ucwords(strtolower($this->input->post('nama_wali'))),
                'status' => $this->input->post('status'),
            ];
            $this->m_santri->update($id_santri, $data);
            $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
            redirect('santri');
        }
    }
    public function hapus($id_santri)
    {
        $this->m_santri->delete($id_santri);
        $this->m_santri->delete_bayar($id_santri);
        $this->m_tagihan->delete_santri($id_santri);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('santri');
    }
}
