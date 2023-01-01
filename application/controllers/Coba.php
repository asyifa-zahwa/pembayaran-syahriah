<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Coba extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

    }
    public function index()
    {
        
        
        $this->load->view('coba/coba');
    }
    public function tambah()
    {
        $this->form_validation->set_rules('kode', 'kode', 'required', ['required' => '* Kode Wajib di Isi !!']);
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => '* Nama Wajib di Isi !!']);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required', ['required' => '* Tanggal Lahir Wajib di Isi !!']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => '* Alamat Wajib di Isi !!']);
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required', ['required' => '* Nama Wali Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('santri');
        } else {
            // $kode = date('Y') . substr(rand(), 0, 4);
            $data = [
                // 'kode' => $kode,
                'kode' => $this->input->post('kode'),
                'nama' => ucwords(strtolower($this->input->post('nama'))),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
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
        $this->form_validation->set_rules('nama', 'nama', 'required', ['required' => '* Nama Wajib di Isi !!']);
        $this->form_validation->set_rules('tgl_lahir', 'tgl_lahir', 'required', ['required' => '* Tanggal Lahir Wajib di Isi !!']);
        $this->form_validation->set_rules('alamat', 'alamat', 'required', ['required' => '* Alamat Wajib di Isi !!']);
        $this->form_validation->set_rules('nama_wali', 'nama_wali', 'required', ['required' => '* Nama Wali Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('santri');
        } else {
            $data = [
                'kode' => $this->input->post('kode'),
                'nama' => ucwords(strtolower($this->input->post('nama'))),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
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
        $this->m_tagihan->delete_santri($id_santri);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('santri');
    }
}
