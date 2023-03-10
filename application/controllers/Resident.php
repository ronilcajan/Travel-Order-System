<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . '../vendor/autoload.php');

class Resident extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        include APPPATH . 'third_party/phpqrcode/qrlib.php';

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        }
        if ($this->ion_auth->in_group('kiosk')) {
            // redirect them to the login page
            show_error('You are restricted to view this page.');
        }
    }

    public function index()
    {
        $data['title'] = 'Barangay Residents';
        $this->admin->load('admin', 'resident/residents', $data);
    }

    public function search_age()
    {
        $data['title'] = 'Barangay Residents';
        $this->admin->load('admin', 'resident/search_age', $data);
    }

    public function create_resident()
    {
        $data['purok'] = $this->purokModel->getPurok();
        $data['precinct'] = $this->precinctModel->getPrecinct();
        $data['houses'] = $this->dashboardModel->getHouses();
        $data['occupation'] = $this->occupationModel->getOccupation();
        $data['title'] = 'Create Residents';
        $this->admin->load('admin', 'resident/create_resident', $data);
    }

    public function sk_residents()
    {
        $data['title'] = 'SK Residents Information';
        $this->admin->load('admin', 'resident/sk', $data);
    }

    public function search_page()
    {
        $code = '';
        if (isset($_GET['qr_code'])) {
            $code = $_GET['qr_code'];
        }
        if ($code != '') {
            $data['res'] = $this->residentModel->search($code);
        }
        $data['title'] = 'Search by QR Code';
        $this->admin->load('admin', 'resident/search_resident', $data);
    }

    public function edit_resident($id)
    {
        $data['res'] = $this->residentModel->getProfile($id);
        $data['purok'] = $this->purokModel->getPurok();
        $data['precinct'] = $this->precinctModel->getPrecinct();
        $data['relation'] = $this->residentModel->getRelation($id);
        $data['occupation'] = $this->occupationModel->getOccupation();
        $data['title'] = 'Edit Residents';
        $this->admin->load('admin', 'resident/edit_resident', $data);
    }

    public function save_resident()
    {

        $validator = array('success' => false, 'msg' => array());
        $config['upload_path'] = 'assets/uploads/resident_profile/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->form_validation->set_rules('fname', 'Firstname', 'required');
        $this->form_validation->set_rules('lname', 'Lastname', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {

            $validator['success'] = false;
            $validator['msg'] = validation_errors();
        } else {
            $data = array(
                'national_id' => $this->input->post('national'),
                'citizenship' => $this->input->post('citizenship'),
                'firstname' => $this->input->post('fname'),
                'middlename' => $this->input->post('mname'),
                'lastname' => $this->input->post('lname'),
                'suffix' => $this->input->post('suffix'),
                'alias' => $this->input->post('alias'),
                'birthplace' => $this->input->post('bplace'),
                'birthdate' => $this->input->post('bdate'),
                'civilstatus' => $this->input->post('cstatus'),
                'gender' => $this->input->post('gender'),
                'purok' => $this->input->post('purok'),
                'voterstatus' => $this->input->post('vstatus'),
                'phone' => $this->input->post('number'),
                'email' => $this->input->post('email'),
                'occupation' => $this->input->post('occupation'),
                'employer_name' => $this->input->post('employer'),
                'pwd' => $this->input->post('pwd'),
                'address' => $this->input->post('address'),
                'qrcode' => strtoupper($this->generate_QRCODE()),
            );
            if (!empty($this->input->post('profileimg'))) {

                $data['picture'] = $this->input->post('profileimg');
            }
            if($this->upload->do_upload('editimg')){
                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/resident_profile/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/resident_profile/' . $file['file_name'];

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data['picture'] = $file['file_name'];
            }

            $insert_id = $this->residentModel->save($data);

            if ($insert_id) {

                $other_data = array(
                    'resident_id' => $insert_id,
                    'sss' => $this->input->post('sss'),
                    'tin' => $this->input->post('tin'),
                    'precinct' => $this->input->post('precinct'),
                    'gsis' => $this->input->post('gsis'),
                    'pagibig' => $this->input->post('pagibig'),
                    'philhealth' => $this->input->post('philhealth'),
                    'blood' => $this->input->post('blood'),
                );

                $house_info = array(
                    'resident_id' => $insert_id,
                    'house_number' => $this->input->post('house_no'),
                    'relation' => $this->input->post('relation'),
                );

                $data = array(
                    'resident_id ' => $insert_id,
                    'status' => 'Negative',
                );

                $this->residentModel->updateCovid($data, $insert_id);

                $this->residentModel->save_details($other_data);
                $this->residentModel->save_house_details($house_info);
                $log = array(
                    'activity' => 'Resident created',
                    'action' => 'Create',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);

                $validator['success'] = true;
                $validator['msg'] = 'Resident successfully added!';
            } else {
                $validator['success'] = false;
                $validator['msg'] = 'Something went wrong. Please contact the administrator.';
            }
        }

        echo json_encode($validator);
    }

    public function saveHouse()
    {
        $validator = array('success' => false, 'msg' => array());
        $this->form_validation->set_rules('number', 'House Number', 'required|is_unique[house_number.number]');
        if ($this->form_validation->run() == FALSE) {

            $validator['success'] = false;
            $validator['msg'] = validation_errors();
        } else {
            $data = array(
                'number' => $this->input->post('number'),
                'info' => $this->input->post('info')
            );

            $insert = $this->residentModel->saveHouse($data);

            if ($insert) {
                $log = array(
                    'activity' => 'Household created',
                    'action' => 'Create',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $validator['success'] = true;
                $validator['msg'] = 'House number successfully added!';
            } else {
                $validator['success'] = false;
                $validator['msg'] = 'Something went wrong. Please contact the administrator';
            }
        }

        echo json_encode($validator);
    }

    public function search_house()
    {
        $search = $_GET['searchTerm'];
        $result = $this->residentModel->getHouseNumber($search);
        $json = [];
        foreach ($result as $row) {
            $json[] = ['id' => $row['number'], 'text' => $row['number']];
        }

        echo json_encode($json);
    }

    public function update_resident()
    {
        $validator = array('success' => false, 'msg' => array());
        $config['upload_path'] = 'assets/uploads/resident_profile/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->form_validation->set_rules('fname', 'Firstname', 'required');
        $this->form_validation->set_rules('lname', 'Lastname', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if ($this->form_validation->run() == FALSE) {

            $validator['success'] = false;
            $validator['msg'] = validation_errors();
        } else {

            $id = $this->input->post('res_id');
            $data = array(
                'national_id' => $this->input->post('national'),
                'citizenship' => $this->input->post('citizenship'),
                'firstname' => $this->input->post('fname'),
                'middlename' => $this->input->post('mname'),
                'lastname' => $this->input->post('lname'),
                'suffix' => $this->input->post('suffix'),
                'alias' => $this->input->post('alias'),
                'birthplace' => $this->input->post('bplace'),
                'birthdate' => $this->input->post('bdate'),
                'civilstatus' => $this->input->post('cstatus'),
                'gender' => $this->input->post('gender'),
                'purok' => $this->input->post('purok'),
                'voterstatus' => $this->input->post('vstatus'),
                'phone' => $this->input->post('number'),
                'email' => $this->input->post('email'),
                'occupation' => $this->input->post('occupation'),
                'employer_name' => $this->input->post('employer'),
                'pwd' => $this->input->post('pwd'),
                'address' => $this->input->post('address'),
                'qrcode' => strtoupper($this->generate_QRCODE()),
            );
            if (!empty($this->input->post('profileimg'))) {

                $data['picture'] = $this->input->post('profileimg');
            }
            if($this->upload->do_upload('editimg')){
                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/resident_profile/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/resident_profile/' . $file['file_name'];

                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                $data['picture'] = $file['file_name'];
            }

            $this->residentModel->update($data, $id);
            

            $other_data = array(
                'sss' => $this->input->post('sss'),
                'tin' => $this->input->post('tin'),
                'precinct' => $this->input->post('precinct'),
                'gsis' => $this->input->post('gsis'),
                'pagibig' => $this->input->post('pagibig'),
                'philhealth' => $this->input->post('philhealth'),
                'blood' => $this->input->post('blood'),
            );

            $house_info = array(
                'resident_id' => $id,
                'house_number' => $this->input->post('house_no'),
                'relation' => $this->input->post('relation'),
            );

            $this->residentModel->update_details($other_data, $id);
            $this->residentModel->update_house_details($house_info, $id);

            $log = array(
                'activity' => 'Resident updated',
                'action' => 'Update',
                'username' => $this->session->username,
            );
            $this->settingsModel->insert_activity($log);

            $validator['success'] = true;
            $validator['msg'] = 'Resident has been updated!';
        }

        echo json_encode($validator);
    }

    public function covidUpdate()
    {
        $id = $this->input->post('res_id');
        $data = array(
            'resident_id ' => $this->input->post('res_id'),
            'status' => $this->input->post('status'),
            'date_vaccinated' => $this->input->post('date'),
            'vaccinator_name' => $this->input->post('vac_name'),
            'manufacturer' => $this->input->post('manufacturer'),
            'batch_no' => $this->input->post('batch'),
            'lot_no' => $this->input->post('lot_no'),
            'date_vaccinated_1' => $this->input->post('date1'),
            'vaccinator_name_1' => $this->input->post('vac_name1'),
            'manufacturer_1' => $this->input->post('manufacturer1'),
            'batch_no_1' => $this->input->post('batch1'),
            'lot_no_1' => $this->input->post('lot_no1'),
            'remarks' => $this->input->post('remarks')
        );

        $update = $this->residentModel->updateCovid($data, $id);

        if ($update) {
            $log = array(
                'activity' => 'Covid status updated',
                'action' => 'Update',
                'username' => $this->session->username,
            );
            $this->settingsModel->insert_activity($log);
            $this->session->set_flashdata('message', 'COVID Status has been updated!');
        } else {
            $this->session->set_flashdata('errors', 'No changes has been made!');
        }

        redirect('admin/covidstatus', 'refresh');
    }

    public function delete($id)
    {
        $delete = $this->residentModel->delete($id);
        if ($delete) {
            $log = array(
                'activity' => 'Resident deleted',
                'action' => 'Delete',
                'username' => $this->session->username,
            );
            $this->settingsModel->insert_activity($log);
            $this->session->set_flashdata('errors', 'Resident has been deleted!');
        } else {
            $this->session->set_flashdata('errors', 'Something went wrong!');
        }
        redirect('resident', 'refresh');
    }

    public function exportCSV()
    {
        $log = array(
            'activity' => 'Resident exported',
            'action' => 'Exported File',
            'username' => $this->session->username,
        );
        $this->settingsModel->insert_activity($log);

        $this->load->dbutil();

        $query = $this->db->query("SELECT residents.id as id,national_id,citizenship,firstname,middlename,lastname,suffix,alias,birthplace,birthdate,civilstatus,gender,purok,voterstatus,phone,email,occupation,employer_name,pwd,house_number,`address`,relation,resident_type,blocklisted,remarks,sss,tin,precinct,gsis,pagibig,philhealth,blood FROM residents JOIN other_details ON residents.id=other_details.resident_id JOIN resident_house ON residents.id=resident_house.resident_id");

        $csv = $this->dbutil->csv_from_result($query);

        $this->load->helper('download');
        force_download(date('F-d-h:i:s') . '-residents.csv', $csv);

        exit;
    }

    public function brgy_cert()
    {

        $data['resident'] = $this->residentModel->getResident();
        $data['title'] = 'Barangay Certificates';
        $this->admin->load('admin', 'resident/brgy_cert', $data);
    }

    public function generate_profile($id)
    {
        $data['captain'] = $this->officialsModel->getCaptain();
        $data['res'] = $this->residentModel->getProfile($id);
        $data['info'] = $this->settingsModel->brgy_info();
        $data['code'] = $this->generate_uuid();
        $data['qrCode'] = $this->qrCode($id);
        $data['house'] = $this->residentModel->getHouse($id);
        $data['title'] = 'Resident Profile';
        $this->admin->load('admin', 'resident/generate_profile', $data);
    }

    public function generate_id($id)
    {
        $data['resident'] = $this->residentModel->getProfile($id);
        $data['info'] = $this->settingsModel->brgy_info();
        $data['blood'] =  $this->residentModel->getOthers($id);
        $data['relation'] = $this->residentModel->getRelation($id);
        $data['capt'] = $this->officialsModel->getCaptain();
        $data['house'] = $this->residentModel->getHouse($id);
        $data['title'] = 'Resident Barangay ID';
        $data['qrCode'] = $this->qrCode($id);
        $this->admin->load('admin', 'resident/generate_id', $data);
    }

    public function generate_brgy_cert($id, $req = '')
    {
        $data['resident'] = $this->residentModel->getProfile($id);
        $data['info'] = $this->settingsModel->brgy_info();
        $data['kagawad'] = $this->officialsModel->getkagawadOfficial();
        $data['selected_off'] = $this->officialsModel->getselectedOfficial();
        $data['captain'] = $this->officialsModel->getCaptain();
        $data['name'] = ucwords($data['resident']->firstname . ' ' . $data['resident']->middlename . ' ' . $data['resident']->lastname);
        $data['aid'] = $this->officialsModel->getAid();
        $data['house'] = $this->residentModel->getHouse($id);

        $data['purpose'] = $this->requestModel->getThisReq($req);
        $data['title'] = 'Barangay Clearance';
        $this->certificate_layout->load('certificate', 'resident/generate_brgy_cert', $data);
    }

    public function generate_indi_cert($id)
    {
        $data['resident'] = $this->residentModel->getProfile($id);
        $data['info'] = $this->settingsModel->brgy_info();
        $data['kagawad'] = $this->officialsModel->getkagawadOfficial();
        $data['selected_off'] = $this->officialsModel->getselectedOfficial();
        $data['captain'] = $this->officialsModel->getCaptain();
        $data['name'] = ucwords($data['resident']->firstname . ' ' . $data['resident']->middlename . ' ' . $data['resident']->lastname);
        $data['aid'] = $this->officialsModel->getAid();
        $data['house'] = $this->residentModel->getHouse($id);
        $data['title'] = 'Certificate of Indigency';
        $this->certificate_layout->load('certificate', 'resident/generate_indi_cert', $data);
    }

    public function generate_resi_cert($id)
    {
        $data['resident'] = $this->residentModel->getProfile($id);
        $data['info'] = $this->settingsModel->brgy_info();
        $data['kagawad'] = $this->officialsModel->getkagawadOfficial();
        $data['selected_off'] = $this->officialsModel->getselectedOfficial();
        $data['captain'] = $this->officialsModel->getCaptain();
        $data['name'] = ucwords($data['resident']->firstname . ' ' . $data['resident']->middlename . ' ' . $data['resident']->lastname);
        $data['aid'] = $this->officialsModel->getAid();
        $data['house'] = $this->residentModel->getHouse($id);
        $data['title'] = 'Certificate of Residency';
        $this->certificate_layout->load('certificate', 'resident/generate_resi_cert', $data);
    }

    public function importCSV()
    {
        $config = array(
            'upload_path' => "./assets/uploads/CSV/",
            'allowed_types' => "csv",
            'encrypt_name' => TRUE,
        );
        $this->load->library('upload', $config);
        $this->form_validation->set_rules('import_file', 'CSV File', 'required');

        if (!$this->upload->do_upload('import_file')) {

            $this->session->set_flashdata('errors',  $this->upload->display_errors());
        } else {
            $file = $this->upload->data();

            // Reading file
            $data = fopen("./assets/uploads/CSV/" . $file['file_name'], "r");
            $i = 0;

            $importRes = array();

            if ($data) {
                // Initialize $importData_arr Array
                while (($filedata = fgetcsv($data, 1000, ",")) !== FALSE) {

                    // Skip first row & check number of fields
                    if ($i > 0) {

                        // Key names are the insert table field names - name, email, city, and status
                        $importRes[$i]['nat_id'] = $filedata[0];
                        $importRes[$i]['citizenship'] = $filedata[1];
                        $importRes[$i]['fname'] = $filedata[2];
                        $importRes[$i]['mname'] = $filedata[3];
                        $importRes[$i]['lname'] = $filedata[4];
                        $importRes[$i]['suffix'] = $filedata[5];
                        $importRes[$i]['alias'] = $filedata[6];
                        $importRes[$i]['bplace'] = $filedata[7];
                        $importRes[$i]['bdate'] = $filedata[8];
                        $importRes[$i]['cstatus'] = $filedata[9];
                        $importRes[$i]['gender'] = $filedata[10];
                        $importRes[$i]['purok'] = $filedata[11];
                        $importRes[$i]['vstatus'] = $filedata[12];
                        $importRes[$i]['phone'] = $filedata[13];
                        $importRes[$i]['email'] = $filedata[14];
                        $importRes[$i]['occupation'] = $filedata[15];
                        $importRes[$i]['employer_name'] = $filedata[16];
                        $importRes[$i]['pwd'] = $filedata[17];
                        $importRes[$i]['house_number'] = $filedata[18];
                        $importRes[$i]['address'] = $filedata[19];
                        $importRes[$i]['family'] = $filedata[20];
                        $importRes[$i]['sss_no'] = $filedata[21];
                        $importRes[$i]['tin_no'] = $filedata[22];
                        $importRes[$i]['gsis_no'] = $filedata[23];
                        $importRes[$i]['pagibig_no'] = $filedata[24];
                        $importRes[$i]['philhealth_no'] = $filedata[25];
                        $importRes[$i]['blood'] = $filedata[26];
                        $importRes[$i]['precinct'] = $filedata[27];
                    }
                    $i++;
                }

                fclose($data);

                // Insert data
                $count = 0;
                foreach ($importRes as $data) {

                    $house = array(
                        'number' => $data['house_number'],
                    );

                    $res = array(
                        'national_id' => $data['nat_id'],
                        'citizenship' => $data['citizenship'],
                        'firstname' => $data['fname'],
                        'middlename' => $data['mname'],
                        'lastname' => $data['lname'],
                        'suffix' => $data['suffix'],
                        'alias' => $data['alias'],
                        'birthplace' => $data['bplace'],
                        'birthdate' => $data['bdate'],
                        'civilstatus' => $data['cstatus'],
                        'gender' => $data['gender'],
                        'purok' => $data['purok'],
                        'voterstatus' => $data['vstatus'],
                        'phone' => $data['phone'],
                        'email' => $data['email'],
                        'occupation' => $data['occupation'],
                        'employer_name' => $data['employer_name'],
                        'pwd' => $data['pwd'],
                        'address' => $data['address'],
                        'qrcode' => strtoupper($this->generate_QRCODE()),
                    );

                    $this->residentModel->saveHouse($house);

                    $insert_id = $this->residentModel->save($res);

                    $other_data = array(
                        'resident_id' => $insert_id,
                        'sss' => $data['sss_no'],
                        'tin' => $data['tin_no'],
                        'precinct' => $data['precinct'],
                        'gsis' => $data['gsis_no'],
                        'pagibig' => $data['pagibig_no'],
                        'philhealth' => $data['philhealth_no'],
                        'blood' => $data['blood'],
                    );



                    $house_info = array(
                        'resident_id' => $insert_id,
                        'house_number' => $data['house_number'],
                        'relation' => $data['family'],
                    );

                    $data = array(
                        'resident_id ' => $insert_id,
                        'status' => 'Negative',
                    );

                    $this->residentModel->updateCovid($data, $insert_id);


                    $this->residentModel->save_details($other_data);
                    $this->residentModel->save_house_details($house_info);
                    $count++;
                }
                $log = array(
                    'activity' => 'Resident file imported',
                    'action' => 'Import File',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $this->session->set_flashdata('message', 'File Imported Successfully!');
            } else {
                $this->session->set_flashdata('message', 'Unable to open the file! Please contact support');
            }
        }

        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }
    public function getpopulation()
    {
        $list = $this->populationTableModel->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $res) {
            $no++;
            $row = array();
            if (preg_match('/data:image/i', $res->picture)) {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                <img width='30' height='30' class='img-circle' alt='user' 
                src='" . $res->picture . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            } elseif (!empty($res->picture)) {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                    <img width='30' height='30' class='img-circle' alt='user' 
                    src='" . site_url() . 'assets/uploads/resident_profile/' . $res->picture . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            } else {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                    <img width='30' height='30' class='img-circle' alt='user' 
                    src='" . site_url('assets/img/person.png') . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            }
            $row[] = date('M. d, Y', strtotime($res->birthdate));
            $row[] = floor((time() - strtotime($res->birthdate)) / 31556926);
            $row[] = $res->civilstatus;
            $row[] = $res->gender;
            $row[] = $res->pwd;
            $row[] = $res->voterstatus;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->populationTableModel->count_all(),
            "recordsFiltered" => $this->populationTableModel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getresidents()
    {
        $from =  $this->input->post('from');
        $to =  $this->input->post('to');

        $list = $this->residentTableModel->get_datatables($from, $to);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $res) {
            $no++;
            $row = array();
            if (preg_match('/data:image/i', $res->picture ?? ''?? '')) {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                <img width='30' height='30' class='img-circle' alt='user' 
                src='" . $res->picture . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            } elseif (!empty($res->picture)) {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                    <img width='30' height='30' class='img-circle' alt='user' 
                    src='" . site_url() . 'assets/uploads/resident_profile/' . $res->picture . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            } else {
                $row[] = "<a href='" . site_url('admin/generate_profile/') . $res->id . "'>
                    <img width='30' height='30' class='img-circle' alt='user' 
                    src='" . site_url('assets/img/person.png') . "'/></a> "
                    . ucwords($res->lastname . " " . $res->suffix . ", " . $res->firstname . " " . $res->middlename);
            }
            $row[] = $res->national_id;
            $row[] = $res->alias;
            $row[] = date('M. d, Y', strtotime($res->birthdate));
            $row[] = floor((time() - strtotime($res->birthdate)) / 31556926);
            $row[] = $res->civilstatus;
            $row[] = $res->gender;
            $row[] = $res->purok;
            $row[] = $res->blocklisted == "No" ? '<span class="label label-success">' . $res->blocklisted . '</span>' : '<span class="label label-danger">' . $res->blocklisted . '</span>';
            $row[] = $res->resident_type == "Alive" ? '<span class="label label-success">Alive</span>' : '<span class="label label-danger">Deceased</span>';
            $row[] = $res->pwd;

            if ($this->ion_auth->is_admin() || $this->ion_auth->in_group(3)) {
                $row[] = "<a type='button' data-remarks='" . $res->id . "' href='" . site_url("admin/edit_resident/") . $res->id . "' onclick='editOfficial(this)' data-toggle='tooltip' data-original-title='Edit Resident'> <i class='fa fa-pencil text-inverse m-r-10'></i> </a>
                        <a type='button' href='" . site_url('admin/generate_profile/') . $res->id . "' data-toggle='tooltip' data-original-title='View Profile'> <i class='fa fa-user text-info m-r-10'></i> </a>
                        <a type='button' href='" . site_url('admin/generate_id/') . $res->id . "' data-toggle='tooltip' data-original-title='Generate ID'> <i class='fa fa-file-photo-o text-inverse m-r-10'></i> </a>
                        <a type='button' href='" . site_url('resident/delete/') . $res->id . "' onclick='return confirm(&quot;Are you sure you want to delete this resident?&quot);' data-toggle='tooltip' data-original-title='Remove'> <i class='fa fa-times text-danger m-r-10'></i> </a>";
            } else {
                $row[] = "<a type='button' data-remarks='" . $res->id . "' href='" . site_url("admin/edit_resident/") . $res->id . "' onclick='editOfficial(this)' data-toggle='tooltip' data-original-title='Edit Resident'> <i class='fa fa-pencil text-inverse m-r-10'></i> </a>
                <a type='button' href='" . site_url('admin/generate_profile/') . $res->id . "' data-toggle='tooltip' data-original-title='View Profile'> <i class='fa fa-user text-info m-r-10'></i> </a>
                <a type='button' href='" . site_url('admin/generate_id/') . $res->id . "' data-toggle='tooltip' data-original-title='Generate ID'> <i class='fa fa-file-photo-o text-inverse m-r-10'></i> </a>";
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->residentTableModel->count_all($from, $to),
            "recordsFiltered" => $this->residentTableModel->count_filtered($from, $to),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function qrCode($id)
    {
        $query = $this->db->query("SELECT * FROM id_settings WHERE id=1");
        $img = $query->row();

        $sql = $this->db->query("SELECT qrcode FROM residents WHERE id=$id");
        $qrcode = $sql->row();

        $imgname = "assets/uploads/qr/qr.png";
        $data = $qrcode->qrcode;
        $logo = 'assets/uploads/' . $img->back;
        $sdir = explode("/", $_SERVER['REQUEST_URI']);
        $dir = str_replace($sdir[count($sdir) - 1], "", $_SERVER['REQUEST_URI']);

        QRcode::png($data, $imgname, QR_ECLEVEL_H, 2);

        $QR = imagecreatefrompng($imgname);
        if ($logo !== FALSE) {
            $logopng = imagecreatefrompng($logo);
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logopng);
            $logo_height = imagesy($logopng);

            list($newwidth, $newheight) = getimagesize($logo);
            $out = imagecreatetruecolor($QR_width, $QR_width);
            imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
            imagecopyresampled($out, $logopng, intval($QR_width / 2.36), intval($QR_height / 2.36), 0, 0, intval($QR_width / 6), intval($QR_height / 6), $newwidth, $newheight);
        }
        imagepng($out, $imgname);
        imagedestroy($out);

        // === Change image color
        $im = imagecreatefrompng($imgname);
        $r = 44;
        $g = 62;
        $b = 80;
        for ($x = 0; $x < imagesx($im); ++$x) {
            for ($y = 0; $y < imagesy($im); ++$y) {
                $index     = imagecolorat($im, $x, $y);
                $c       = imagecolorsforindex($im, $index);
                if (($c['red'] < 100) && ($c['green'] < 100) && ($c['blue'] < 100)) { // dark colors
                    // here we use the new color, but the original alpha channel
                    $colorB = imagecolorallocatealpha($im, 0x12, 0x2E, 0x31, $c['alpha']);
                    imagesetpixel($im, $x, $y, $colorB);
                }
            }
        }
        // imagepng($im, $imgname);
        // imagedestroy($im);

        // === Convert Image to base64
        $type = pathinfo($imgname, PATHINFO_EXTENSION);
        $data = file_get_contents($imgname);
        $imgbase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $imgbase64;
    }
    public function barCode($id)
    {
        $codeText = $this->generate_uuid();
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        echo $generator->getBarcode($codeText, $generator::TYPE_CODE_128);
    }
    function generate_uuid()
    {
        return sprintf(
            '%04x%04x-%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0C2f) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0x2Aff),
            mt_rand(0, 0xffD3),
            mt_rand(0, 0xff4B)
        );
    }
    function generate_QRCODE($length = 120)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}