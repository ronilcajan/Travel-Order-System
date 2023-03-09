<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PurokModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getPurok(){
        $query = $this->db->get('purok');
        return $query->result_array();
    }

    public function save($data){
        $this->db->insert('purok',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('purok',$data, "id=".$id);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('purok');
        return $this->db->affected_rows();
    }
}
?>