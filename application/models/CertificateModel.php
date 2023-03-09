<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CertificateModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getCerts(){
        $query = $this->db->get('certificates');
        return $query->result_array();
    }

    public function getCertinfo($id){
        $query = $this->db->get_where('certificates', array('id' => $id));
        return $query->row();
    }

    public function save($data){
        $this->db->insert('certificates',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$id){
        $this->db->update('certificates',$data, "id=".$id);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('certificates');
        return $this->db->affected_rows();
    }
}
?>