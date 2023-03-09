<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BlotterModel extends CI_Model {

	public function __contruct(){
        $this->load->database();
    }

    public function getBlotter(){
        $this->db->order_by('created_at','DESC');
        $query = $this->db->get('blotter');
        return $query->result_array();
    }

    public function getBlotter_info($data){
        $query = $this->db->get_where('blotter', array('case_no' => $data));
        return $query->row();
    }
    public function getComplainants($case_no){
        $query = $this->db->get_where('complainants',  array('case_no' => $case_no));
        return $query->result_array();
    }

    public function getSummon($case_no){
        $query = $this->db->get_where('summon', array('case_no' => $case_no));
        return $query->result_array();
    }
    public function getSummonDetails($id){
        $query = $this->db->get_where('summon', array('id' => $id));
        return $query->row();
    }

    public function getSettlement($case_no){
        $query = $this->db->get_where('settled', array('case_no' => $case_no));
        return $query->row();
    }

    public function activeBlotter(){
        $this->db->where('status', 'Active');
        return $this->db->count_all_results('blotter');
    }
    public function settledBlotter(){
        $this->db->where('status', 'Settled');
        return $this->db->count_all_results('blotter');
        
    }
    public function scheduledBlotter(){
        $this->db->where('status', 'Scheduled');
        return $this->db->count_all_results('blotter');
    }
    public function dismissedBlotter(){
        $this->db->where('status', 'Dismissed');
        return $this->db->count_all_results('blotter');
    }
    public function endorsedBlotter(){
        $this->db->where('status', 'Endorsed');
        return $this->db->count_all_results('blotter');
    }

    public function save($data){
        $this->db->insert('blotter',$data);
        return $this->db->affected_rows();
    }

    public function save_settled($data){
        $this->db->insert('settled',$data);
        return $this->db->affected_rows();
    }

    public function save_complainants($data){
        $this->db->insert_batch('complainants',$data);
        return $this->db->affected_rows();
    }

    public function save_summon($data){
        $this->db->insert('summon',$data);
        return $this->db->affected_rows();
    }

    public function update($data,$case_no){
        $this->db->update('blotter' ,$data, "case_no='$case_no'");
        return $this->db->affected_rows();
    }

    public function update_complainants($data,$case_no){
        $this->db->update_batch('complainants' ,$data, "case_no");
        return $this->db->affected_rows();
    }

    public function update_summon($data,$id){
        $this->db->update('summon' ,$data, "id='$id'");
        return $this->db->affected_rows();
    }

    public function update_settle($data,$case_no){
        $this->db->update('settled' ,$data, "case_no='$case_no'");
        return $this->db->affected_rows();
    }

    public function delete($id){
        $this->db->where('case_no', $id);
        $this->db->delete('blotter');
        return $this->db->affected_rows();
    }
    public function delete_summon($id){
        $this->db->where('id', $id);
        $this->db->delete('summon');
        return $this->db->affected_rows();
    }
}
?>