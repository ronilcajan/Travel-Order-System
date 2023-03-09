<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SettingsModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function save_brgy_info($data)
    {
        $this->db->update('barangay_info', $data, "id = 1");
        return $this->db->affected_rows();
    }

    public function updateInfo($data)
    {
        $this->db->update('system_info', $data, "id = 1");
        return $this->db->affected_rows();
    }

    public function updateCertSetting($data)
    {
        $this->db->update('cert_settings', $data, "id = 1");
        return $this->db->affected_rows();
    }

    public function updateID($data)
    {
        $this->db->update('id_settings', $data, "id = 1");
        return $this->db->affected_rows();
    }

    public function send($data)
    {
        $this->db->insert('support', $data);
        return $this->db->affected_rows();
    }

    public function getSupport()
    {
        $query = $this->db->get('support');
        return $query->result_array();
    }

    public function attempts()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('login_attempts');
        return $query->result();
    }

    public function logs()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('logs');
        return $query->result();
    }

    public function getbrgy_Info()
    {
        $query = $this->db->get('barangay_info');
        return $query->row();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('support');
        return $this->db->affected_rows();
    }

    public function brgy_info()
    {
        $query = $this->db->query("SELECT * FROM barangay_info WHERE id=1");
        return $query->row();
    }

    public function getInfo()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('system_info');
        return $query->row();
    }

    public function insert_activity($data)
    {
        $this->db->insert('logs', $data);
        return $this->db->affected_rows();
    }
}
