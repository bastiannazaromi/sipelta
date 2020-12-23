<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Universal extends CI_Model
{
    
    public function getOne($where, $tabel)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }

        $data = $this->db->get($tabel)->row();
        return (count((array)$data) > 0) ? $data : false;
    }

    public function getMulti($where, $tabel)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $data = $this->db->get($tabel)->result();
        return (count((array)$data) > 0) ? $data : false;
    }

    public function update($data, $where, $tabel)
    {
        $this->db->where($where);
        $update = $this->db->update($tabel, $data);
        return ($update) ? true : false;
    }

    public function insert($data, $tabel)
    {
        return ($this->db->insert($tabel, $data)) ? true : false;
    }

    public function delete($where, $tabel)
    {
        return ($this->db->where($where)->delete($tabel)) ? true : false;
    }
    public function getOrderBy($where, $tabel, $order, $urutan, $limit)
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        if (!empty($urutan)) {
            $this->db->order_by($order, $urutan);
        }
        $this->db->order_by($order);
        if (!empty($limit)) {
            $this->db->limit($limit);
        }

        $data = $this->db->get($tabel)->result();
        return (count((array)$data) > 0) ? $data : false;
    }
    public function insert_batch($data, $tabel)
    {
        $this->db->trans_start();
        $this->db->insert_batch($tabel, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return false;
        }
        else
        {
            $this->db->trans_commit();
            return true;
        }
    }

    public function getJmlSoalPG($where)
    {
        $this->db->select('COUNT(bank_soal.id) as jumlah_pilgan, prodi.nama');
        $this->db->from('bank_soal');
        $this->db->join('prodi', 'prodi.kd_prodi = bank_soal.kd_prodi', 'inner');
        $this->db->where($where);
        $this->db->group_by('bank_soal.kd_prodi');
        $this->db->order_by('prodi.nama', 'ASC');

        $data = $this->db->get()->result();
        return (count((array)$data) > 0) ? $data : false;
    }
}