<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Position extends CI_Controller
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
        $data['position'] = $this->positionModel->getPosition();
        $data['title'] = 'Positions Management';
        $this->admin->load('admin', 'position/position', $data);
    }

    public function save_position()
    {
        $this->form_validation->set_rules('position', 'Position Name', 'required|trim|is_unique[position.position]');
        $this->form_validation->set_rules('order', 'Order', 'required|trim');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('errors', validation_errors());
        } else {

            $data = array(
                'position' => $this->input->post('position'),
                'pos_order' => $this->input->post('order')
            );

            $insert = $this->positionModel->save($data);

            if ($insert) {
                $log = array(
                    'activity' => 'Position created',
                    'action' => 'Create',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);
                $this->session->set_flashdata('message', 'Position has been save!');
            } else {
                $this->session->set_flashdata('errors', 'Position not save!');
            }
        }

        redirect("admin/position", 'refresh');
    }

    public function update_position()
    {
        $id = $this->input->post('id');
        $this->form_validation->set_rules('position', 'Position Name', 'required|trim');
        $this->form_validation->set_rules('order', 'Order', 'required|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('errors', validation_errors());
        } else {

            $data = array(
                'position' => $this->input->post('position'),
                'pos_order' => $this->input->post('order')
            );

            $update = $this->positionModel->update($data, $id);

            if ($update) {
                $log = array(
                    'activity' => 'Position updated',
                    'action' => 'Update',
                    'username' => $this->session->username,
                );
                $this->settingsModel->insert_activity($log);

                $this->session->set_flashdata('message', 'Position has been updated!');
            } else {
                $this->session->set_flashdata('errors', 'No changes has been made!');
            }
        }

        redirect("admin/position", 'refresh');
    }

    public function delete($id)
    {
        $delete = $this->positionModel->delete($id);
        if ($delete) {
            $log = array(
                'activity' => 'Position deleted',
                'action' => 'Delete',
                'username' => $this->session->username,
            );
            $this->settingsModel->insert_activity($log);
            $this->session->set_flashdata('errors', 'Position has been deleted!');
        } else {
            $this->session->set_flashdata('errors', 'Something went wrong!');
        }
        redirect('admin/position', 'refresh');
    }
}
