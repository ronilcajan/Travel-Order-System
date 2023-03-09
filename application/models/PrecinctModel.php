<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrecinctModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getPrecinct(){
        $query = $this->db->get('precinct');
        return $query->result_array();
    }

    public function save($data){
        $this->db->insert('precinct',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('precinct',$data, "id=".$id);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('precinct');
        return $this->db->affected_rows();
    }
}
?>