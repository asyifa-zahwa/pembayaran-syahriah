<?php

class M_tagihan extends CI_Model
{
    public function get($limit, $start)
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan', $limit, $start);
    }
    public function getExcel()
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan');
    }
    public function getExcel_bulanan()
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan_bulanan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan_bulanan');
    }
    public function getExcel_tahunan()
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan_tahunan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan_tahunan');
    }
    public function getAllNum($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan')->num_rows();
    }

    public function input($data)
    {
        $this->db->insert('tb_tagihan', $data);
    }
    public function update($id_tagihan, $data)
    {
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tb_tagihan', $data);
    }
    public function update_spp($id_spp, $data)
    {
        $this->db->where('id_spp', $id_spp);
        $this->db->update('tb_tagihan', $data);
    }
    public function delete($id_tagihan)
    {
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->delete('tb_tagihan');
    }
    public function delete_spp($id_spp)
    {
        $this->db->where('id_spp', $id_spp);
        $this->db->delete('tb_tagihan');
    }
    public function delete_santri($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->delete('tb_tagihan');
    }

    public function detail($id_santri, $limit, $start)
    {
        $this->db->join('tb_spp', 'tb_spp.id_spp = tb_tagihan.id_spp', 'left');
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan', $limit, $start);
    }
    public function detail_spp($id_spp)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan.id_santri', 'left');
        $this->db->where('id_spp', $id_spp);
        return $this->db->get('tb_tagihan');
    }

    public function detail_bayar($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan', $limit, $start);
    }
    public function bayar($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->order_by('status_code', 'asc');
        $this->db->order_by('transaction_time', 'asc');
        return $this->db->get('tb_bayar');
    }

    //bulanan

    public function get_bulanan($limit, $start)
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan_bulanan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan_bulanan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan_bulanan', $limit, $start);
    }
    public function getAllNum_bulanan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_bulanan')->num_rows();
    }

    public function input_bulanan($data)
    {
        $this->db->insert('tb_tagihan_bulanan', $data);
    }
    public function update_bulanan($id_tagihan_bulanan, $data)
    {
        $this->db->where('id_tagihan_bulanan', $id_tagihan_bulanan);
        $this->db->update('tb_tagihan_bulanan', $data);
    }
    public function update_spp_bulanan($id_spp_bulanan, $data)
    {
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        $this->db->update('tb_tagihan_bulanan', $data);
    }
    public function delete_bulanan($id_tagihan_bulanan)
    {
        $this->db->where('id_tagihan_bulanan', $id_tagihan_bulanan);
        $this->db->delete('tb_tagihan_bulanan');
    }
    public function delete_spp_bulanan($id_spp_bulanan)
    {
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        $this->db->delete('tb_tagihan_bulanan');
    }
    public function delete_santri_bulanan($id_santri_bulanan)
    {
        $this->db->where('id_santri_bulanan', $id_santri_bulanan);
        $this->db->delete('tb_tagihan_bulanan');
    }

    public function detail_bulanan($id_santri, $limit, $start)
    {
        $this->db->join('tb_spp_bulanan', 'tb_spp_bulanan.id_spp_bulanan = tb_tagihan_bulanan.id_spp_bulanan', 'left');
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_bulanan', $limit, $start);
    }
    public function detail_spp_bulanan($id_spp_bulanan)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_bulanan.id_santri', 'left');
        $this->db->where('id_spp_bulanan', $id_spp_bulanan);
        return $this->db->get('tb_tagihan_bulanan');
    }

    public function detail_bayar_bulanan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_bulanan', $limit, $start);
    }
    public function bayar_bulanan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->order_by('status_code', 'asc');
        $this->db->order_by('transaction_time', 'asc');
        return $this->db->get('tb_bayar_bulanan');
    }

    //tahunan
    public function get_tahunan($limit, $start)
    {
        // $key = $this->input->get('key');
        // if ($key != '' && strlen($key) > 2) {
        //     $this->db->like('id_tagihan_tahunan', $key);
        //     $this->db->or_like('jumlah', $key);
        //     $this->db->or_like('ket', $key);
        // }
        $this->db->select('*, sum(tagihan_tahunan) as jumtung');
        $this->db->group_by('id_santri');
        $this->db->order_by('jumtung', 'desc');
        return $this->db->get('tb_tagihan_tahunan', $limit, $start);
    }
    public function getAllNum_tahunan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_tahunan')->num_rows();
    }

    public function input_tahunan($data)
    {
        $this->db->insert('tb_tagihan_tahunan', $data);
    }
    public function update_tahunan($id_tagihan_tahunan, $data)
    {
        $this->db->where('id_tagihan_tahunan', $id_tagihan_tahunan);
        $this->db->update('tb_tagihan_tahunan', $data);
    }
    public function update_spp_tahunan($id_spp_tahunan, $data)
    {
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        $this->db->update('tb_tagihan_tahunan', $data);
    }
    public function delete_tahunan($id_tagihan_tahunan)
    {
        $this->db->where('id_tagihan_tahunan', $id_tagihan_tahunan);
        $this->db->delete('tb_tagihan_tahunan');
    }
    public function delete_spp_tahunan($id_spp_tahunan)
    {
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        $this->db->delete('tb_tagihan_tahunan');
    }
    public function delete_santri_tahunan($id_santri_tahunan)
    {
        $this->db->where('id_santri_tahunan', $id_santri_tahunan);
        $this->db->delete('tb_tagihan_tahunan');
    }

    public function detail_tahunan($id_santri, $limit, $start)
    {
        $this->db->join('tb_spp_tahunan', 'tb_spp_tahunan.id_spp_tahunan = tb_tagihan_tahunan.id_spp_tahunan', 'left');
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_tahunan', $limit, $start);
    }
    public function detail_spp_tahunan($id_spp_tahunan)
    {
        $this->db->join('tb_santri', 'tb_santri.id_santri = tb_tagihan_tahunan.id_santri', 'left');
        $this->db->where('id_spp_tahunan', $id_spp_tahunan);
        return $this->db->get('tb_tagihan_tahunan');
    }

    public function detail_bayar_tahunan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        return $this->db->get('tb_tagihan_tahunan', $limit, $start);
    }
    public function bayar_tahunan($id_santri)
    {
        $this->db->where('id_santri', $id_santri);
        $this->db->order_by('status_code', 'asc');
        $this->db->order_by('transaction_time', 'asc');
        return $this->db->get('tb_bayar_tahunan');
    }
}
