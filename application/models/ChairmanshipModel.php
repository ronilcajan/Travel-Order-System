<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChairmanshipModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getChairmanship(){
        $query = $this->db->get('chairmanship');
        return $query->result_array();
    }

    public function save($data){
        $this->db->insert('chairmanship',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('chairmanship',$data, "id=".$id);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('chairmanship');
        return $this->db->affected_rows();
    }
}
?>