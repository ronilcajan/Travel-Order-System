<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BusinessModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function business(){
        $query = $this->db->get('permit');
        return $query->result_array();
    }

    public function save($data){
        $this->db->insert('permit',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('permit' ,$data, "id='$id'");
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('permit');
        return $this->db->affected_rows();
    }

    public function getBusiness($id){
        $this->db->where('id', $id);
        $query = $this->db->get('permit');
        return $query->row();
    }

}
?>