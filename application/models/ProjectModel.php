<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProjectModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function budget()
    {
        $query = $this->db->get('budget');
        return $query->result();
    }
    public function getBudget($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('budget');
        return $query->row();
    }
    public function getProject($id)
    {
        $this->db->where('budget_id', $id);
        $query = $this->db->get('projects');
        return $query->result();
    }

    public function save($data)
    {
        $this->db->insert('budget', $data);
        return $this->db->affected_rows();
    }
    public function save_project($data)
    {
        $this->db->insert('projects', $data);
        return $this->db->affected_rows();
    }

    public function update($data, $id)
    {
        $this->db->update('budget', $data, "id=" . $id);
        return $this->db->affected_rows();
    }
    public function update_project($data, $id)
    {
        $this->db->update('projects', $data, "id=" . $id);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('budget');
        return $this->db->affected_rows();
    }
    public function delete_project($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('projects');
        return $this->db->affected_rows();
    }
}
