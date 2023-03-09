<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentsModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function getPayments()
    {
        $this->db->order_by('created_at', 'DESC');
        $query = $this->db->get('payments');
        return $query->result_array();
    }

    public function getDailyTrans()
    {
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $query = $this->db->get('payments');
        return $query->result_array();
    }

    public function save($data)
    {
        $this->db->insert('payments', $data);
        return $this->db->affected_rows();
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('payments');
        return $this->db->affected_rows();
    }
    public function deleteAll($data)
    {
        $this->db->where('id', $data);
        $this->db->delete('payments');
        return $this->db->affected_rows();
    }
}
