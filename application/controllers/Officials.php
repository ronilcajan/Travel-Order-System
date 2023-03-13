<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Officials extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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
        $data['officials'] = $this->officialsModel->getOfficials();
        $data['pos'] = $this->positionModel->getPosition();

        $data['title'] = 'Barangay Officials';
        $this->admin->load('admin', 'official/officials', $data);
    }

    public function save_official()
    {
        $config['upload_path'] = 'assets/uploads/avatar/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim|is_unique[officials.name]');
        $this->form_validation->set_rules('chair', 'Chairmanship', 'required|trim');
        $this->form_validation->set_rules('position', 'Position', 'required|trim');
        $this->form_validation->set_rules('start', 'Term Start', 'required|trim');
        $this->form_validation->set_rules('end', 'Term End', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'chairmanship' => $this->input->post('chair'),
                'position' => $this->input->post('position'),
                'termstart' => $this->input->post('start'),
                'termend' => $this->input->post('end'),
                'status' => $this->input->post('status')
            );

            if ($this->upload->do_upload('off_avatar')) {

                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/avatar/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/avatar/' . $file['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data['avatar'] = $file['file_name'];
            } 

            $insert = $this->officialsModel->save($data);

            if ($insert) {
                $log = array(
                    'activity' => 'Barangay official created',
                    'action' => 'Create',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $this->session->set_flashdata('message', 'Official has been save!');
            } else {
                $this->session->set_flashdata('errors', 'Official not save!');
            }
        }

        redirect("officials", 'refresh');
    }

    public function update_official()
    {
        $config['upload_path'] = 'assets/uploads/avatar/';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        $id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('chair', 'Chairmanship', 'required|trim');
        $this->form_validation->set_rules('position', 'Position', 'required|trim');
        $this->form_validation->set_rules('start', 'Term Start', 'required|trim');
        $this->form_validation->set_rules('end', 'Term End', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
        } else {

            $data = array(
                'name' => $this->input->post('name'),
                'chairmanship' => $this->input->post('chair'),
                'position' => $this->input->post('position'),
                'termstart' => $this->input->post('start'),
                'termend' => $this->input->post('end'),
                'status' => $this->input->post('status')
            );

            if ($this->upload->do_upload('off_avatar')) {

                $file = $this->upload->data();
                //Resize and Compress Image
                $config['image_library'] = 'gd2';
                $config['source_image'] = 'assets/uploads/avatar/' . $file['file_name'];
                $config['create_thumb'] = FALSE;
                $config['maintain_ratio'] = TRUE;
                $config['quality'] = '60%';
                $config['new_image'] = 'assets/uploads/avatar/' . $file['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

                $data['avatar'] = $file['file_name'];
            } 

            $update = $this->officialsModel->update($data, $id);

            if ($update) {
                $log = array(
                    'activity' => 'Barangay official updated',
                    'action' => 'Update',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $this->session->set_flashdata('message', 'Official has been updated!');
            } else {
                $this->session->set_flashdata('errors', 'No changes has been made!');
            }
        }

        redirect("officials", 'refresh');
    }

    public function show_official()
    {
        $validator = array('success' => false, 'msg' => array());
        $this->form_validation->set_rules('id', 'Official ID', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $validator['success'] = false;
            $validator['msg'] = validation_errors();
        } else {
            $id = $this->input->post('id');
            $check = $this->input->post('check');
            if ($check == 0) {
                $data = array(
                    'name_show' => 1,
                );
            } else {
                $data = array(
                    'name_show' => 0,
                );
            }

            $update = $this->officialsModel->update($data, $id);

            if ($update) {
                $log = array(
                    'activity' => 'Barangay official updated',
                    'action' => 'Update',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $validator['success'] = true;
                $validator['msg'] = 'Official has been updated!';
            } else {
                $validator['msg'] = 'Official has not updated!';
            }
        }

        echo json_encode($validator);
    }

    public function delete($id)
    {
        $delete = $this->officialsModel->delete($id);
        if ($delete) {
            $log = array(
                'activity' => 'Barangay official deleted',
                'action' => 'Delete',
                'username' => $this->session->username,
            );
            $this->settingsModel->insert_activity($log);
            $this->session->set_flashdata('errors', 'Official has been deleted!');
        } else {
            $this->session->set_flashdata('errors', 'Something went wrong!');
        }
        redirect('officials', 'refresh');
    }
}