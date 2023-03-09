<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function login($data){

        $query = $this->db->get_where('users', $data);
        $result = $query->result_array();

        if(count($result) >0){
            return $result[0];
        }else{
            return null;
        }
    }

    public function getUsers(){
        $this->db->where_not_in('username', $this->session->username);
        $query = $this->db->get('users');
        return $query->result_array();
    }

    public function save($data){
        $this->db->insert('users',$data);
        return $this->db->affected_rows();
    }

    public function update($data, $id){
        $this->db->update('users', $data , 'id='.$id);
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');
        return $this->db->affected_rows();
    }
}
?>