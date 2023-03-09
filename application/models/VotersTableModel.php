<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VotersTableModel extends CI_Model
{

    var $table = 'residents';
    var $column_order = array(null, 'firstname', 'middlename', 'lastname', 'civilstatus', 'gender', 'voterstatus', 'pwd'); //set column field database for datatable orderable
    var $column_search = array('firstname', 'middlename', 'lastname', 'civilstatus', 'gender', 'voterstatus', 'pwd'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($state)
    {
        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {


                if ($i === 0) // first loop
                {

                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.

                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $this->db->join('other_details ', 'residents.id=other_details.resident_id');

        if (isset($_POST['order'])) // here order processing
        {
            if ($state == 'voters') {
                $this->db->where('voterstatus', 'Yes');
            } elseif ($state == 'senior') {
                $this->db->where('year(NOW())-YEAR(birthdate) >=', 60);
            } elseif ($state == 'pwd') {
                $this->db->where('pwd', 'Yes');
            } elseif ($state == 'sk') {
                $this->db->where('year(NOW())-YEAR(birthdate) >=', 15);
                $this->db->where('year(NOW())-YEAR(birthdate) <=', 21);
            } else {
                $this->db->where('voterstatus', 'No');
            }

            $this->db->where('resident_type', 'Alive');
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            if ($state == 'voters') {
                $this->db->where('voterstatus', 'Yes');
            } elseif ($state == 'senior') {
                $this->db->where('year(NOW())-YEAR(birthdate) >=', 60);
            } elseif ($state == 'sk') {
                $this->db->where('year(NOW())-YEAR(birthdate) >=', 15);
                $this->db->where('year(NOW())-YEAR(birthdate) <=', 21);
            } elseif ($state == 'pwd') {
                $this->db->where('pwd', 'Yes');
            } else {
                $this->db->where('voterstatus', 'No');
            }
            $this->db->where('resident_type', 'Alive');
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($state)
    {
        $this->_get_datatables_query($state);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($state)
    {
        $this->_get_datatables_query($state);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($state)
    {

        $this->db->from($this->table);

        if ($state == 'voters') {
            $this->db->where('voterstatus', 'Yes');
        } elseif ($state == 'senior') {
            $this->db->where('year(NOW())-YEAR(birthdate) >=', 60);
        } elseif ($state == 'sk') {
            $this->db->where('year(NOW())-YEAR(birthdate) >=', 15);
            $this->db->where('year(NOW())-YEAR(birthdate) <=', 21);
        } elseif ($state == 'pwd') {
            $this->db->where('pwd', 'Yes');
        } else {
            $this->db->where('voterstatus', 'No');
        }
        $this->db->where('resident_type', 'Alive');
        return $this->db->count_all_results();
    }
}
