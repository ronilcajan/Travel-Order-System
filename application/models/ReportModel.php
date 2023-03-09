<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReportModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function residents($state, $id)
    {
        $this->db->select('*,residents.id as id');
        $id = urldecode($id);
        if ($state == 'purok') {
            $this->db->join('other_details', 'other_details.resident_id=residents.id');
            $this->db->where('purok', $id);
        } elseif ($state == 'precinct') {
            $this->db->join('other_details', 'other_details.resident_id=residents.id');
            $this->db->where('other_details.precinct', $id);
        } elseif ($state == 'household') {
            $this->db->join('resident_house', 'resident_house.resident_id=residents.id');
            $this->db->where('resident_house.house_number', $id);
        } else {
            $this->db->join('other_details', 'other_details.resident_id=residents.id');
            $this->db->where('occupation', $id);
        }
        $query = $this->db->get('residents');
        return $query->result();
    }
    public function occupation()
    {
        $this->db->select('DISTINCT(occupation)');
        $this->db->where('occupation is NOT NULL', NULL, FALSE);
        $this->db->where('occupation !=', '');
        $query = $this->db->get('residents');
        return $query->result();
    }
}
