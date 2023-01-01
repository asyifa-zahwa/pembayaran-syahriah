<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("status") != 'login') {
            $this->session->set_flashdata('error', 'Silahkan Login Terlebih Dahulu !!');
            redirect('auth');
        }
        $this->load->model('m_spp');
        $this->load->model('m_santri');
        $this->load->model('m_tagihan');
    }
    public function index()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/spp/index/';
        $config['total_rows'] = $this->m_spp->getAllNum();
        $config['per_page'] = 10;

       

        // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_data',
            'spp' => $this->m_spp->get($config['per_page'], $data['start'])
        ];
        $this->load->view('temp/v_master_admin', $data);
    }

    public function bulanan()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/spp/bulanan/';
        $config['total_rows'] = $this->m_spp->getAllNum_bulanan();
        $config['per_page'] = 10;

        

        // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_data_bulanan',
            'spp' => $this->m_spp->get_bulanan($config['per_page'], $data['start'])
        ];
        $this->load->view('temp/v_master_admin', $data);
    }

    public function tahunan()
    {
        $this->load->library('pagination');
        $config['base_url'] = 'https://almuhsin.id/spp/spp/tahunan/';
        $config['total_rows'] = $this->m_spp->getAllNum_tahunan();
        $config['per_page'] = 10;

       

        // $config['display_pages'] = FALSE;



        $this->pagination->initialize($config);
        $data['start'] = $this->uri->segment(3);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_data_tahunan',
            'spp' => $this->m_spp->get_tahunan($config['per_page'], $data['start'])
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function form()
    {
        $data = [
            'title' => 'Form Tambah SPP',
            'isi'     => 'spp/v_form',
            'santri' => $this->m_santri->getSpp()
        ];
        $this->load->view('temp/v_master_admin', $data);
    }

    public function form_bulanan()
    {
        $data = [
            'title' => 'Form Tambah SPP',
            'isi'     => 'spp/v_form_bulanan',
            'santri' => $this->m_santri->getSpp()
        ];
        $this->load->view('temp/v_master_admin', $data);
    }

    public function form_tahunan()
    {
        $data = [
            'title' => 'Form Tambah SPP',
            'isi'     => 'spp/v_form_tahunan',
            'santri' => $this->m_santri->getSpp()
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function tambah()
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp');
        } else {
            $data = [
                'ket' => ucwords($this->input->post('ket')),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->input($data);
            $id_santri = explode(',', $this->input->post('id_santri'));
            $id_spp = $this->db->select('max(id_spp) as max')->get('tb_spp')->row()->max;
            if ($id_santri[0] != '') {
                foreach ($id_santri as $id) {
                    $data2 = [
                        'id_santri' => $id,
                        'id_spp' => $id_spp,
                        // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                        'tagihan' => $data['jumlah'],
                    ];
                    $this->m_tagihan->input($data2);
                }
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
            redirect('spp');
        }
    }
    public function update($id_spp)
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp');
        } else {
            $data = [
                'ket' => $this->input->post('ket'),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->update($id_spp, $data);
            $data2 = [
                'tagihan' => $data['jumlah'],
            ];
            $this->m_tagihan->update_spp($id_spp, $data2);
            $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
            redirect('spp');
        }
    }
    public function hapus($id_spp)
    {
        $this->m_spp->delete($id_spp);
        $this->m_tagihan->delete_spp($id_spp);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp');
    }
    public function detail($id_spp)
    {
        $detail =  $this->m_spp->detail($id_spp);
        $santri =  $this->m_tagihan->detail_spp($id_spp);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_detail',
            'detail' => $detail,
            'santri' => $santri,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function formsantri($id_spp, $jumlah)
    {
        $santri = $this->m_tagihan->detail_spp($id_spp)->result();
        $id_santri[] = '';
        foreach ($santri as $key) {
            $id_santri[] = $key->id_santri;
        }
        $data = [
            'id_spp' => $id_spp,
            'jumlah' => $jumlah,
            'santri' => $this->m_santri->detail2($id_santri)
        ];
        $this->load->view('spp/v_form_santri', $data);
    }
    public function tambahsantri($id_spp, $jumlah)
    {
        $id_santri = explode(',', $this->input->post('id_santri'));
        if ($id_santri[0] != '') {
            foreach ($id_santri as $id) {
                $data2 = [
                    'id_santri' => $id,
                    'id_spp' => $id_spp,
                    // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                    'tagihan' => $jumlah,
                ];
                $this->m_tagihan->input($data2);
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
        }
        redirect('spp/detail/' . $id_spp);
    }
    public function hapustagihan($id_spp, $id_tagihan)
    {
        $this->m_tagihan->delete($id_tagihan);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp/detail/' . $id_spp);
    }

    //bulanan

    public function tambah_bulanan()
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp/bulanan');
        } else {
            $data = [
                'ket' => ucwords($this->input->post('ket')),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->input_bulanan($data);
            $id_santri = explode(',', $this->input->post('id_santri'));
            $id_spp_bulanan = $this->db->select('max(id_spp_bulanan) as max')->get('tb_spp_bulanan')->row()->max;
            if ($id_santri[0] != '') {
                foreach ($id_santri as $id) {
                    $data2 = [
                        'id_santri' => $id,
                        'id_spp_bulanan' => $id_spp_bulanan,
                        // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                        'tagihan_bulanan' => $data['jumlah'],
                    ];
                    $this->m_tagihan->input_bulanan($data2);
                }
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
            redirect('spp/bulanan');
        }
    }
    public function update_bulanan($id_spp_bulanan)
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp/bulanan');
        } else {
            $data = [
                'ket' => $this->input->post('ket'),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->update_bulanan($id_spp_bulanan, $data);
            $data2 = [
                'tagihan_bulanan' => $data['jumlah'],
            ];
            $this->m_tagihan->update_spp_bulanan($id_spp_bulanan, $data2);
            $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
            redirect('spp/bulanan');
        }
    }
    public function hapus_bulanan($id_spp_bulanan)
    {
        $this->m_spp->delete_bulanan($id_spp_bulanan);
        $this->m_tagihan->delete_spp_bulanan($id_spp_bulanan);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp/bulanan');
    }
    public function detail_bulanan($id_spp_bulanan)
    {
        $detail =  $this->m_spp->detail_bulanan($id_spp_bulanan);
        $santri =  $this->m_tagihan->detail_spp_bulanan($id_spp_bulanan);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_detail_bulanan',
            'detail' => $detail,
            'santri' => $santri,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function formsantri_bulanan($id_spp_bulanan, $jumlah)
    {
        $santri = $this->m_tagihan->detail_spp_bulanan($id_spp_bulanan)->result();
        $id_santri[] = '';
        foreach ($santri as $key) {
            $id_santri[] = $key->id_santri;
        }
        $data = [
            'id_spp_bulanan' => $id_spp_bulanan,
            'jumlah' => $jumlah,
            'santri' => $this->m_santri->detail2($id_santri)
        ];
        $this->load->view('spp/v_form_santri_bulanan', $data);
    }
    public function tambahsantri_bulanan($id_spp_bulanan, $jumlah)
    {
        $id_santri = explode(',', $this->input->post('id_santri'));
        if ($id_santri[0] != '') {
            foreach ($id_santri as $id) {
                $data2 = [
                    'id_santri' => $id,
                    'id_spp_bulanan' => $id_spp_bulanan,
                    // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                    'tagihan_bulanan' => $jumlah,
                ];
                $this->m_tagihan->input_bulanan($data2);
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
        }
        redirect('spp/detail_bulanan/' . $id_spp_bulanan);
    }
    public function hapustagihan_bulanan($id_spp_bulanan, $id_tagihan_bulanan)
    {
        $this->m_tagihan->delete_bulanan($id_tagihan_bulanan);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp/detail_bulanan/' . $id_spp_bulanan);
    }

    //tahunan
    public function tambah_tahunan()
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp/tahunan');
        } else {
            $data = [
                'ket' => ucwords($this->input->post('ket')),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->input_tahunan($data);
            $id_santri = explode(',', $this->input->post('id_santri'));
            $id_spp_tahunan = $this->db->select('max(id_spp_tahunan) as max')->get('tb_spp_tahunan')->row()->max;
            if ($id_santri[0] != '') {
                foreach ($id_santri as $id) {
                    $data2 = [
                        'id_santri' => $id,
                        'id_spp_tahunan' => $id_spp_tahunan,
                        // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                        'tagihan_tahunan' => $data['jumlah'],
                    ];
                    $this->m_tagihan->input_tahunan($data2);
                }
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
            redirect('spp/tahunan');
        }
    }
    public function update_tahunan($id_spp_tahunan)
    {
        $this->form_validation->set_rules('ket', 'ket', 'required', ['required' => '* Keterangan Wajib di Isi !!']);
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required', ['required' => '* Jumlah Wajib di Isi !!']);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('spp/tahunan');
        } else {
            $data = [
                'ket' => $this->input->post('ket'),
                'jumlah' => $this->input->post('jumlah'),
            ];
            $this->m_spp->update_tahunan($id_spp_tahunan, $data);
            $data2 = [
                'tagihan_tahunan' => $data['jumlah'],
            ];
            $this->m_tagihan->update_spp_tahunan($id_spp_tahunan, $data2);
            $this->session->set_flashdata('pesan', 'Data Berhasil di Update');
            redirect('spp/tahunan');
        }
    }
    public function hapus_tahunan($id_spp_tahunan)
    {
        $this->m_spp->delete_tahunan($id_spp_tahunan);
        $this->m_tagihan->delete_spp_tahunan($id_spp_tahunan);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp/tahunan');
    }
    public function detail_tahunan($id_spp_tahunan)
    {
        $detail =  $this->m_spp->detail_tahunan($id_spp_tahunan);
        $santri =  $this->m_tagihan->detail_spp_tahunan($id_spp_tahunan);
        $data = [
            'title' => 'Data SPP',
            'isi'     => 'spp/v_detail_tahunan',
            'detail' => $detail,
            'santri' => $santri,
        ];
        $this->load->view('temp/v_master_admin', $data);
    }
    public function formsantri_tahunan($id_spp_tahunan, $jumlah)
    {
        $santri = $this->m_tagihan->detail_spp_tahunan($id_spp_tahunan)->result();
        $id_santri[] = '';
        foreach ($santri as $key) {
            $id_santri[] = $key->id_santri;
        }
        $data = [
            'id_spp_tahunan' => $id_spp_tahunan,
            'jumlah' => $jumlah,
            'santri' => $this->m_santri->detail2($id_santri)
        ];
        $this->load->view('spp/v_form_santri_tahunan', $data);
    }
    public function tambahsantri_tahunan($id_spp_tahunan, $jumlah)
    {
        $id_santri = explode(',', $this->input->post('id_santri'));
        if ($id_santri[0] != '') {
            foreach ($id_santri as $id) {
                $data2 = [
                    'id_santri' => $id,
                    'id_spp_tahunan' => $id_spp_tahunan,
                    // 'nama_santri' => $this->db->where('id_santri', $id)->get('tb_santri')->row()->nama,
                    'tagihan_tahunan' => $jumlah,
                ];
                $this->m_tagihan->input_tahunan($data2);
            }
            $this->session->set_flashdata('pesan', 'Data Berhasil di Simpan');
        }
        redirect('spp/detail_tahunan/' . $id_spp_tahunan);
    }
    public function hapustagihan_tahunan($id_spp_tahunan, $id_tagihan_tahunan)
    {
        $this->m_tagihan->delete_tahunan($id_tagihan_tahunan);
        $this->session->set_flashdata('pesan', 'Data Berhasil di Hapus');
        redirect('spp/detail_tahunan/' . $id_spp_tahunan);
    }
}
