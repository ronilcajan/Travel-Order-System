<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CalendarModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function get_events($start, $end)
    {
        return $this->db->where("start >=", $start)->where("end <=", $end)->get("calendar_events");
    }

    public function add_event($data)
    {
        $this->db->insert("calendar_events", $data);
    }

    public function get_event($id)
    {
        return $this->db->where("ID", $id)->get("calendar_events");
    }

    public function update_event($id, $data)
    {
        $this->db->where("ID", $id)->update("calendar_events", $data);
    }

    public function delete_event($id)
    {
        $this->db->where("ID", $id)->delete("calendar_events");
    }
}
