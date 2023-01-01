<?php

class M_santri extends CI_Model
{
    public function get($limit, $start)
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('tb_santri', $limit, $start);
    }
    public function getSpp()
    {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('tb_santri');
    }
    public function getAllNum()
    {
        return $this->db->get('tb_santri')->num_rows();
    }

    public function input($data)
    {
        $kode = $this->input->post('kode');
        if (isset($kode)) {
            $this->db->where('tb_santri.kode', $kode);
        }
        $query = $this->db->get('tb_santri');
        if ($query->num_rows() == 1) {
            $this->session->set_flashdata('error', 'NIS Sudah Ada');
            redirect('santri');
        }
        $this->db->insert('tb_santri', $data);
    }
    public function update($id_santri, $data)
    {
        // $kode = $this->input->post('kode');
        // if (isset($kode)) {
        //     $this->db->where('tb_santri.kode', $kode);
        // }
        // $query = $this->db->get('tb_santri');
        // if ($query->num_rows() == 1) {
        //     $this->session->set_flashdata('error', 'NIS Sudah Ada');
        //     redirect('santri');
        // }
        $this->db->where('id_santri', $id_santri);
        $this->db->update('tb_santri', $data);
    }
    public function delete($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->delete('tb_santri');
    }
    public function delete_bayar($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->delete('tb_bayar');
    }
    public function detail($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_santri')->row();
    }
    public function detail2($id_santri)
    {
        $this->db->where_not_in('id_santri', $id_santri);
        return $this->db->get('tb_santri');
    }
    public function title($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_santri');
    }

}
