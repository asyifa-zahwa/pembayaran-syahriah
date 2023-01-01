<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        $this->load->view('temp/v_auth');
    }
    function login()
    {
        $this->form_validation->set_rules('username', 'username', 'required', ['required' => '* Username Wajib di Isi !!']);
        $this->form_validation->set_rules('password', 'password', 'required', ['required' => '* Password Wajib di Isi !!']);
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('auth');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
            $cek = $this->db->get_where('tb_user', $where);
            if ($cek->num_rows() > 0) {

                $data_session = array(
                    'nama' => $username,
                    'role' => $cek->row()->role,
                    'status' => "login"
                );
                $this->session->set_userdata($data_session);
                $this->session->set_flashdata('pesan', 'Berhasil Login');
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username dan password salah');
                redirect('auth');
            }
        }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan', 'Berhasil Logout');
        redirect('auth');
    }
}
