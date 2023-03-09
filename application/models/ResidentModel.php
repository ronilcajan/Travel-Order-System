<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResidentModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function getResident()
    {
        $query = $this->db->get('residents');
        return $query->result();
    }

    public function getHouse($id)
    {
        $this->db->where('resident_id ', $id);
        $query = $this->db->get('resident_house');
        return $query->row();
    }

    public function search($id)
    {
        $this->db->join('covid_status', 'covid_status.resident_id=residents.id');
        $this->db->where('id', $id);
        $query = $this->db->get('residents');
        return $query->result();
    }

    public function searchRes($data)
    {
        if (isset($data['id'])) {
            $this->db->where($data);
        } else {
            $this->db->like($data);
        }

        $query = $this->db->get('residents');
        return $query->result();
    }

    public function getHouseNumber($data)
    {
        $this->db->like('number', $data);
        $query = $this->db->get('house_number');
        return $query->result_array();
    }

    public function getOthers($id)
    {
        $this->db->where('resident_id', $id);
        $query = $this->db->get('other_details');
        return $query->row();
    }

    public function getRelation($id)
    {
        $this->db->where('resident_id', $id);
        $query = $this->db->get('resident_house');
        return $query->row();
    }

    public function save($data)
    {
        $this->db->insert('residents', $data);
        return $this->db->insert_id();
    }

    public function saveHouse($data)
    {
        $this->db->insert('house_number', $data);
        return $this->db->affected_rows();
    }

    public function save_house_details($data)
    {
        $this->db->insert('resident_house', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('residents', $data, "id=" . $id);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('residents');
        return $this->db->affected_rows();
    }

    public function save_details($data)
    {
        $this->db->insert('other_details', $data);
        return $this->db->affected_rows();
    }

    public function update_details($data, $id)
    {
        $this->db->update('other_details', $data, "resident_id=" . $id);
        return $this->db->affected_rows();
    }

    public function update_house_details($data, $id)
    {

        $this->db->where('resident_id', $id);
        $query = $this->db->get('resident_house');

        if ($query->row()) {
            $this->db->update('resident_house', $data, "resident_id=" . $id);
        } else {
            $this->db->insert('resident_house', $data);
        }

        return $this->db->affected_rows();
    }

    public function updateCovid($data, $id)
    {

        $this->db->where('resident_id', $id);
        $query = $this->db->get('covid_status');

        if ($query->row()) {
            $this->db->update('covid_status', $data, "resident_id=" . $id);
        } else {
            $this->db->insert('covid_status', $data);
        }

        return $this->db->affected_rows();
    }

    public function getProfile($id)
    {
        $this->db->from('other_details');
        $this->db->join('residents', 'other_details.resident_id = residents.id');
        $this->db->where('residents.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
