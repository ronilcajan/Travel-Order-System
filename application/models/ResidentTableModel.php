<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ResidentTableModel extends CI_Model
{

    var $table = 'residents';
    var $column_order = array(null, 'firstname', 'middlename', 'lastname', 'national_id', 'alias', 'birthdate', 'civilstatus', 'gender', 'voterstatus', 'resident_type', 'pwd'); //set column field database for datatable orderable
    var $column_search = array('lastname', 'firstname', 'middlename', 'national_id', 'alias', 'birthdate', 'civilstatus', 'gender', 'voterstatus', 'resident_type', 'pwd'); //set column field database for datatable searchable 
    var $order = array('id' => 'asc'); // default order 

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    private function _get_datatables_query($from = '', $to = '')
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
        if (isset($_POST['order'])) // here order processing
        {
            if (!empty($from) && !empty($to) !== false) {
                $this->db->where('timestampdiff(year, birthdate, CURRENT_DATE()) BETWEEN "' . $from . '" and "' . $to . '"');
            }

            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {

            if (!empty($from) && !empty($to) !== false) {
                $this->db->where('timestampdiff(year, birthdate, CURRENT_DATE()) BETWEEN "' . $from . '" and "' . $to . '"');
            }

            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($from = '', $to = '')
    {
        $this->_get_datatables_query($from, $to);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($from = '', $to = '')
    {
        $this->_get_datatables_query($from, $to);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($from = '', $to = '')
    {
        $this->db->from($this->table);

        if (!empty($from) && !empty($to) !== false) {
            $this->db->where('timestampdiff(year, birthdate, CURRENT_DATE()) BETWEEN "' . $from . '" and "' . $to . '"');
        }


        return $this->db->count_all_results();
    }
}