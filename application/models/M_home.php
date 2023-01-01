<?php

class M_home extends CI_Model
{
    public function get()
    {
        $nama = $this->input->post('nama');
        $kode = $this->input->post('kode');
        

        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_bulanan.id_santri', 'left');
        $this->db->join('tb_spp_bulanan', 'tb_spp_bulanan.id_spp_bulanan = tb_tagihan_bulanan.id_spp_bulanan', 'left');
        $this->db->where('tb_santri.nama', $nama);
        if (isset($kode)) {
            $this->db->where('tb_santri.kode', $kode);
        }
        $bulanan = $this->db->get('tb_tagihan_bulanan');
        // $id = $bulanan->row()->id_santri;
        if ($bulanan->num_rows() >= 1) {
            // $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
            // redirect('home');
        // } else {
            // return $bulanan;
            // $id = $this->db->get('tb_tagihan')->where()row()->id_santri;
            redirect('home/detail_bulanan/'. $bulanan->row()->id_santri);
        }

        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_tahunan.id_santri', 'left');
        $this->db->join('tb_spp_tahunan', 'tb_spp_tahunan.id_spp_tahunan = tb_tagihan_tahunan.id_spp_tahunan', 'left');
        $this->db->where('tb_santri.nama', $nama);
        if (isset($kode)) {
            $this->db->where('tb_santri.kode', $kode);
        }
        $tahunan = $this->db->get('tb_tagihan_tahunan');
        // $id = $tahunan->row()->id_santri;
        if ($tahunan->num_rows() >= 1) {
            // $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
            // redirect('home');
        // } else {
            // return $tahunan;
            // $id = $this->db->get('tb_tagihan')->where()row()->id_santri;
            redirect('home/detail_tahunan/'. $tahunan->row()->id_santri);
        }
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan.id_santri', 'left');
        $this->db->join('tb_spp', 'tb_spp.id_spp = tb_tagihan.id_spp', 'left');
        $this->db->where('tb_santri.nama', $nama);
        if (isset($kode)) {
            $this->db->where('tb_santri.kode', $kode);
        }
        $query = $this->db->get('tb_tagihan');
        // $id = $query->row()->id_santri;
        if ($query->num_rows() < 1) {
            $this->session->set_flashdata('error', 'Data Tidak Ditemukan');
            redirect('home');
        } else {
            // return $query;
            // $id = $this->db->get('tb_tagihan')->where()row()->id_santri;
            redirect('home/detail/'. $query->row()->id_santri);
        }
    }
    public function detail($id_santri, $limit, $start)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan.id_santri', 'left');
        $this->db->join('tb_spp', 'tb_spp.id_spp = tb_tagihan.id_spp', 'left');
        $this->db->where('tb_santri.id_santri', $id_santri);
        return $this->db->get('tb_tagihan', $limit, $start);
    }


    public function detail_bulanan($id_santri)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_bulanan.id_santri', 'left');
        $this->db->join('tb_spp_bulanan', 'tb_spp_bulanan.id_spp_bulanan = tb_tagihan_bulanan.id_spp_bulanan', 'left');
        $this->db->where('tb_santri.id_santri', $id_santri);
        return $this->db->get('tb_tagihan_bulanan');
    }
    public function detail_tahunan($id_santri)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_tahunan.id_santri', 'left');
        $this->db->join('tb_spp_tahunan', 'tb_spp_tahunan.id_spp_tahunan = tb_tagihan_tahunan.id_spp_tahunan', 'left');
        $this->db->where('tb_santri.id_santri', $id_santri);
        return $this->db->get('tb_tagihan_tahunan');
    }
    public function getAllNum($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan')->num_rows();
    }
    public function getAllNum_bulanan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_bulanan')->num_rows();
    }
    public function getAllNum_tahunan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_tahunan')->num_rows();
    }
}
