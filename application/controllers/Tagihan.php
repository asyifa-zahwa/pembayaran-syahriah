<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tagihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("status") != 'login') {
            $this->session->set_flashdata('error', 'Silahkan Login Terlebih Dahulu !!');
            redirect('auth');
        }
        $this->load->model('m_tagihan');
        $this->load->model('m_santri');
    }
    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan/index/';
        $config['total_rows'] = $this->m_santri->getAllNum();
        $config['per_page'] = 10;

       
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data Pembayaran SPP',
            'isi'     => 'tagihan/v_data',
            'tagihan' => $this->m_tagihan->get($config['per_page'], $data['start']),
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function detail($id_santri)
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan/detail/'.$id_santri;
        $config['total_rows'] = $this->m_tagihan->getAllNum($id_santri);
        $config['per_page'] = 10;

        
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $detail = $this->m_tagihan->detail($id_santri, $config['per_page'], $data['start']);
        $bayar = $this->m_tagihan->bayar($id_santri);
        $title = $this->m_santri->title($id_santri);
        
        $data = [
            'title' => 'Data Pembayaran SPP : ' . $title->row()->nama,
            'isi'     => 'tagihan/v_detail',
            'detail' => $detail,
            'pembayar' => $bayar,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function hapus($id_tagihan)
    {
        $this->m_tagihan->delete($id_tagihan);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan');
    }
    public function bayar($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan');
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan');
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail/' . $id_santri);
    }
    public function bayar_detail($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan/detail/' . $id_santri);
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan/detail/' . $id_santri);
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail/' . $id_santri);
    }
    public function update_bayar($id_santri)
    {
        $order_id = base64_decode($this->input->post('order_id'));
        $gross_amount = $this->input->post('bayar');
        $this->db->update('tb_bayar', ['gross_amount' => $gross_amount], ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
        redirect('tagihan/detail/' . $id_santri);
    }
    public function hapus_bayar($id_santri)
    {
        $order_id = base64_decode($this->input->get('order_id'));
        $this->db->delete('tb_bayar', ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan/detail/' . $id_santri);
    }
    public function excel()
    {
        $data = [
            'spp' => $this->db->get('tb_spp'),
            'detail' => $this->m_tagihan->getExcel(),
        ];
        $this->load->view('tagihan/v_excel', $data);
    }

    //BUlanan

    public function bulanan()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan/bulanan/';
        $config['total_rows'] = $this->m_santri->getAllNum();
        $config['per_page'] = 10;

       
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data Pembayaran SPP',
            'isi'     => 'tagihan/v_data_bulanan',
            'tagihan' => $this->m_tagihan->get_bulanan($config['per_page'], $data['start']),
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function detail_bulanan($id_santri)
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan/detail_bulanan/'.$id_santri;
        $config['total_rows'] = $this->m_tagihan->getAllNum_bulanan($id_santri);
        $config['per_page'] = 10;

        
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $detail = $this->m_tagihan->detail_bulanan($id_santri, $config['per_page'], $data['start']);
        $bayar = $this->m_tagihan->bayar_bulanan($id_santri);
        $title = $this->m_santri->title($id_santri);
        $data = [
            'title' => 'Data Pembayaran SPP : ' . $title->row()->nama,
            'isi'     => 'tagihan/v_detail_bulanan',
            'detail' => $detail,
            'pembayar' => $bayar,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function hapus_bulanan($id_tagihan_bulanan)
    {
        $this->m_tagihan->delete_bulanan($id_tagihan_bulanan);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan/bulanan');
    }
    public function bayar_bulanan($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan/bulanan');
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan/bulanan');
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar_bulanan', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail_bulanan/' . $id_santri);
    }
    public function bayar_detail_bulanan($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan/detail_bulanan/' . $id_santri);
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan/detail_bulanan/' . $id_santri);
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar_bulanan', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail_bulanan/' . $id_santri);
    }
    public function update_bayar_bulanan($id_santri)
    {
        $order_id = base64_decode($this->input->post('order_id'));
        $gross_amount = $this->input->post('bayar');
        $this->db->update('tb_bayar_bulanan', ['gross_amount' => $gross_amount], ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
        redirect('tagihan/detail_bulanan/' . $id_santri);
    }
    public function hapus_bayar_bulanan($id_santri)
    {
        $order_id = base64_decode($this->input->get('order_id'));
        $this->db->delete('tb_bayar_bulanan', ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan/detail_bulanan/' . $id_santri);
    }

    public function excel_bulanan()
    {
        $data = [
            'spp' => $this->db->get('tb_spp_bulanan'),
            'detail' => $this->m_tagihan->getExcel_bulanan(),
        ];
        $this->load->view('tagihan/v_excel_bulanan', $data);
    }

    //tahunan

    public function tahunan()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan_tahunan/';
        $config['total_rows'] = $this->m_santri->getAllNum();
        $config['per_page'] = 10;

       
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data Pembayaran SPP',
            'isi'     => 'tagihan/v_data_tahunan',
            'tagihan' => $this->m_tagihan->get_tahunan($config['per_page'], $data['start']),
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function detail_tahunan($id_santri)
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/tagihan/detail_tahunan/'.$id_santri;
        $config['total_rows'] = $this->m_tagihan->getAllNum_tahunan($id_santri);
        $config['per_page'] = 10;

       
                // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(4);
        $detail = $this->m_tagihan->detail_tahunan($id_santri, $config['per_page'], $data['start']);
        $bayar = $this->m_tagihan->bayar_tahunan($id_santri);
        $title = $this->m_santri->title($id_santri);
        $data = [
            'title' => 'Data Pembayaran SPP : ' . $title->row()->nama,
            'isi'     => 'tagihan/v_detail_tahunan',
            'detail' => $detail,
            'pembayar' => $bayar,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function hapus_tahunan($id_tagihan_tahunan)
    {
        $this->m_tagihan->delete_tahunan($id_tagihan_tahunan);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan_tahunan');
    }
    public function bayar_tahunan($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan_tahunan');
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan_tahunan');
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar_tahunan', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail_tahunan/' . $id_santri);
    }
    public function bayar_detail_tahunan($id_santri)
    {
        if ($this->input->post('bayar') == 0) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Kosong');
            redirect('tagihan/detail_tahunan/' . $id_santri);
        } elseif ($this->input->post('bayar') <= -1) {
            $this->session->set_flashdata('error', 'Jumlah Pembayaran Tidak Boleh Negatif');
            redirect('tagihan/detail_tahunan/' . $id_santri);
        }
        $total = $this->input->post('bayar');
        $data = [
            'order_id' => 'OFF#' . rand(),
            'id_santri' => $id_santri,
            'gross_amount' => $total,
            'transaction_time' => date("Y-m-d H:i:s O", time()),
            'status_code' => 200,
            'payment_type' => 'offline',
            'payment_ket' => 'offline',
            // 'pdf_url' => '',
        ];
        $this->db->insert('tb_bayar_tahunan', $data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di simpan');
        redirect('tagihan/detail_tahunan/' . $id_santri);
    }
    public function update_bayar_tahunan($id_santri)
    {
        $order_id = base64_decode($this->input->post('order_id'));
        $gross_amount = $this->input->post('bayar');
        $this->db->update('tb_bayar_tahunan', ['gross_amount' => $gross_amount], ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
        redirect('tagihan/detail_tahunan/' . $id_santri);
    }
    public function hapus_bayar_tahunan($id_santri)
    {
        $order_id = base64_decode($this->input->get('order_id'));
        $this->db->delete('tb_bayar_tahunan', ['order_id' => $order_id]);
        $this->session->set_flashdata('pesan', 'Data Berhasil Di Hapus');
        redirect('tagihan/detail_tahunan/' . $id_santri);
    }
    public function excel_tahunan()
    {
        $data = [
            'spp' => $this->db->get('tb_spp_tahunan'),
            'detail' => $this->m_tagihan->getExcel_tahunan(),
        ];
        $this->load->view('tagihan/v_excel_tahunan', $data);
    }
}
