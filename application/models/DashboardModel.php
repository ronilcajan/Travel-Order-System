<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DashboardModel extends CI_Model
{

    public function __contruct()
    {
        $this->load->database();
    }

    public function getPopulation()
    {
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getMale()
    {
        $this->db->where('gender', 'Male');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getFemale()
    {
        $this->db->where('gender', 'Female');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getTotalPopulation()
    {
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->num_rows();
    }
    public function getTotalMale()
    {
        $this->db->where('gender', 'Male');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->num_rows();
    }
    public function getTotalFemale()
    {
        $this->db->where('gender', 'Female');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->num_rows();
    }
    public function getVoters()
    {
        $this->db->where('voterstatus', 'Yes');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getnonVoters()
    {
        $this->db->where('voterstatus', 'No');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getPWD()
    {
        $this->db->where('pwd', 'Yes');
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getSenior()
    {
        $this->db->where('year(NOW())-YEAR(birthdate) >=', 60);
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }
    public function getSK()
    {
        $this->db->where('year(NOW())-YEAR(birthdate) >=', 15);
        $this->db->where('year(NOW())-YEAR(birthdate) <=', 21);
        $this->db->where('resident_type', 'Alive');
        return $this->db->get('residents')->result_array();
    }

    public function getBlotter()
    {
        return $this->db->count_all_results('blotter');
    }
    public function getRevenue()
    {
        $this->db->select_sum('amount');
        $this->db->where('DATE(created_at)', date('Y-m-d'));
        $query = $this->db->get('payments');
        return $query->result()[0]->amount;
    }

    public function getPermit()
    {
        return $this->db->count_all_results('permit');
    }
    public function getHouses()
    {
        $this->db->select('*, COUNT(resident_house.house_number) as members');
        $this->db->join('house_number ', 'resident_house.house_number=house_number.number', 'RIGHT');
        $this->db->group_by('resident_house.house_number');
        return $this->db->get('resident_house')->result_array();
    }

    public function getHouseInfo($num)
    {
        $this->db->from('resident_house');
        $this->db->join('residents', 'residents.id = resident_house.resident_id');
        $this->db->where('resident_house.house_number', $num);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_household($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('house_number');
        return $this->db->affected_rows();
    }

    public function update_relation($data, $id)
    {
        $this->db->update('resident_house', $data, "resident_id=" . $id);
        return $this->db->affected_rows();
    }

    public function update_household($data, $id)
    {
        $this->db->update('house_number', $data, "id=" . $id);
        return $this->db->affected_rows();
    }

    public function getBarangayRevenue($from, $to)
    {
        $this->db->select('
            CASE WHEN WEEKDAY(created_at)=0 THEN sum(amount) ELSE 0 END as mon,
            CASE WHEN WEEKDAY(created_at)=1 THEN sum(amount) ELSE 0 END as tue,
            CASE WHEN WEEKDAY(created_at)=2 THEN sum(amount) ELSE 0 END as wed,
            CASE WHEN WEEKDAY(created_at)=3 THEN sum(amount) ELSE 0 END as thu,
            CASE WHEN WEEKDAY(created_at)=4 THEN sum(amount) ELSE 0 END as fri
        ');
        $this->db->like('details', 'Barangay');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->group_by('created_at');
        $query = $this->db->get('payments');
        return $query->result_array();
    }

    public function getIndigencyRevenue($from, $to)
    {
        $this->db->select('
            CASE WHEN WEEKDAY(created_at)=0 THEN sum(amount) ELSE 0 END as mon,
            CASE WHEN WEEKDAY(created_at)=1 THEN sum(amount) ELSE 0 END as tue,
            CASE WHEN WEEKDAY(created_at)=2 THEN sum(amount) ELSE 0 END as wed,
            CASE WHEN WEEKDAY(created_at)=3 THEN sum(amount) ELSE 0 END as thu,
            CASE WHEN WEEKDAY(created_at)=4 THEN sum(amount) ELSE 0 END as fri
        ');
        $this->db->like('details', 'Indigency');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->group_by('created_at');
        $query = $this->db->get('payments');
        return $query->result_array();
    }
    public function getResidencyRevenue($from, $to)
    {
        $this->db->select('
            CASE WHEN WEEKDAY(created_at)=0 THEN sum(amount) ELSE 0 END as mon,
            CASE WHEN WEEKDAY(created_at)=1 THEN sum(amount) ELSE 0 END as tue,
            CASE WHEN WEEKDAY(created_at)=2 THEN sum(amount) ELSE 0 END as wed,
            CASE WHEN WEEKDAY(created_at)=3 THEN sum(amount) ELSE 0 END as thu,
            CASE WHEN WEEKDAY(created_at)=4 THEN sum(amount) ELSE 0 END as fri
        ');
        $this->db->like('details', 'Residency');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->group_by('created_at');
        $query = $this->db->get('payments');
        return $query->result_array();
    }
    public function getBusinessRevenue($from, $to)
    {
        $this->db->select('
            CASE WHEN WEEKDAY(created_at)=0 THEN sum(amount) ELSE 0 END as mon,
            CASE WHEN WEEKDAY(created_at)=1 THEN sum(amount) ELSE 0 END as tue,
            CASE WHEN WEEKDAY(created_at)=2 THEN sum(amount) ELSE 0 END as wed,
            CASE WHEN WEEKDAY(created_at)=3 THEN sum(amount) ELSE 0 END as thu,
            CASE WHEN WEEKDAY(created_at)=4 THEN sum(amount) ELSE 0 END as fri
        ');
        $this->db->like('details', 'Business');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->group_by('created_at');
        $query = $this->db->get('payments');
        return $query->result_array();
    }
    public function getOthersRevenue($from, $to)
    {
        $this->db->select('
            CASE WHEN WEEKDAY(created_at)=0 THEN sum(amount) ELSE 0 END as mon,
            CASE WHEN WEEKDAY(created_at)=1 THEN sum(amount) ELSE 0 END as tue,
            CASE WHEN WEEKDAY(created_at)=2 THEN sum(amount) ELSE 0 END as wed,
            CASE WHEN WEEKDAY(created_at)=3 THEN sum(amount) ELSE 0 END as thu,
            CASE WHEN WEEKDAY(created_at)=4 THEN sum(amount) ELSE 0 END as fri
        ');
        $this->db->not_like('details', 'Barangay');
        $this->db->not_like('details', 'Indigency');
        $this->db->not_like('details', 'Residency');
        $this->db->not_like('details', 'Business');
        $this->db->where('created_at >=', $from);
        $this->db->where('created_at <=', $to);
        $this->db->group_by('created_at');
        $query = $this->db->get('payments');
        return $query->result_array();
    }

    public function getCovidStatus()
    {
        $query = $this->db->query('
            SELECT 
            CASE WHEN status="Negative" THEN 1 ELSE 0 END as nega, 
            CASE WHEN status="Positive" THEN 1 ELSE 0 END as posi, 
            CASE WHEN status="Fully Vaccinated" THEN 1 ELSE 0 END as fully, 
            CASE WHEN status="1st Vaccine" THEN 1 ELSE 0 END as dose1,
            CASE WHEN status="Fully Vaccinated - Positive" THEN 1 ELSE 0 END as fullyP, 
            CASE WHEN status="1st Vaccine - Positive" THEN 1 ELSE 0 END as dose1P 
            FROM `covid_status`;');
        return $query->result_array();
    }

    public function getResCovid()
    {
        $this->db->from('residents');
        $this->db->join('covid_status', 'covid_status.resident_id = residents.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getNegaCovid()
    {
        $this->db->where('status', 'Negative');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }
    public function getPosiCovid()
    {
        $this->db->where('status', 'Positive');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }
    public function getFullyCovid()
    {
        $this->db->where('status', 'Fully Vaccinated');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }
    public function getVacCovid()
    {
        $this->db->where('status', '1st Vaccine');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }
    public function getFullPCovid()
    {
        $this->db->where('status', 'Fully Vaccinated - Positive');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }
    public function getVacPCovid()
    {
        $this->db->where('status', '1st Vaccine - Positive');
        $query = $this->db->get('covid_status');
        return $query->result_array();
    }

    public function getCovidDeaths()
    {
        $this->db->where('resident_type', 'Deceased');
        $this->db->like('remarks', 'Covid');
        $query = $this->db->get('residents');
        return $query->num_rows();
    }
}
