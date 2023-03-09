<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OccupationModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function getOccupation()
    {
        $query = $this->db->get('occupation');
        return $query->result();
    }

    public function save($data)
    {
        $this->db->insert('occupation', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('occupation', $data, "id=" . $id);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('occupation');
        return $this->db->affected_rows();
    }
}
