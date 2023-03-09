<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ServicesModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function services()
    {
        $query = $this->db->get('services');
        return $query->result_array();
    }
    public function getActiveservices()
    {
        $this->db->where('status', 'Active');
        $query = $this->db->get('services');
        return $query->result_array();
    }

    public function getservice($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('services');
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('services', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('services', $data, "id=" . $id);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('services');
        return $this->db->affected_rows();
    }
}
