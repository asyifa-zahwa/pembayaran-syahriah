<?php

class M_spp extends CI_Model
{
    public function get($limit, $start)
    {
        $key = $this->input->get('key');
        if ($key != '' && strlen($key) > 2) {
            $this->db->like('id_spp', $key);
            $this->db->or_like('jumlah', $key);
            $this->db->or_like('ket', $key);
        }
        // $this->db->order_by('status', 'ASC');
        return $this->db->get('tb_spp', $limit, $start);
    }
    public function getAllNum()
    {
        return $this->db->get('tb_spp')->num_rows();
    }

    public function input($data)
    {
        $this->db->insert('tb_spp', $data);
    }
    public function update($id_spp, $data)
    {
        $this->db->where('id_spp', $id_spp);
        $this->db->update('tb_spp', $data);
    }
    public function delete($id_spp)
    {
        $this->db->where('id_spp', $id_spp);
        $this->db->delete('tb_spp');
    }
    public function detail($id_spp)
    {
        $this->db->where('id_spp', $id_spp);
        return $this->db->get('tb_spp')->row();
    }

    //spp bulanan
    public function get_bulanan($limit, $start)
    {
        $key = $this->input->get('key');
        if ($key != '' && strlen($key) > 2) {
            $this->db->like('id_spp_bulanan', $key);
            $this->db->or_like('jumlah', $key);
            $this->db->or_like('ket', $key);
        }
        // $this->db->order_by('status', 'ASC');
        return $this->db->get('tb_spp_bulanan', $limit, $start);
    }
    public function getAllNum_bulanan()
    {
        return $this->db->get('tb_spp_bulanan')->num_rows();
    }

    public function input_bulanan($data)
    {
        $this->db->insert('tb_spp_bulanan', $data);
    }
    public function update_bulanan($id_spp_bulanan, $data)
    {
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        $this->db->update('tb_spp_bulanan', $data);
    }
    public function delete_bulanan($id_spp_bulanan)
    {
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        $this->db->delete('tb_spp_bulanan');
    }
    public function detail_bulanan($id_spp_bulanan)
    {
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        return $this->db->get('tb_spp_bulanan')->row();
    }

    //spp tahunan
    public function get_tahunan($limit, $start)
    {
        $key = $this->input->get('key');
        if ($key != '' && strlen($key) > 2) {
            $this->db->like('id_spp_tahunan', $key);
            $this->db->or_like('jumlah', $key);
            $this->db->or_like('ket', $key);
        }
        // $this->db->order_by('status', 'ASC');
        return $this->db->get('tb_spp_tahunan', $limit, $start);
    }
    public function getAllNum_tahunan()
    {
        return $this->db->get('tb_spp_tahunan')->num_rows();
    }

    public function input_tahunan($data)
    {
        $this->db->insert('tb_spp_tahunan', $data);
    }
    public function update_tahunan($id_spp_tahunan, $data)
    {
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        $this->db->update('tb_spp_tahunan', $data);
    }
    public function delete_tahunan($id_spp_tahunan)
    {
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        $this->db->delete('tb_spp_tahunan');
    }
    public function detail_tahunan($id_spp_tahunan)
    {
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        return $this->db->get('tb_spp_tahunan')->row();
    }
}
