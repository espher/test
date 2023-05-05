<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gender extends CI_Controller {
  private $errorName;
  private $errorDesc;

  public function __construct() {
    parent::__construct();
    $this->load->model('Gender_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('putextends');
    $this->errorName = 'El nombre del genero es necesario';
    $this->errorDesc = 'La descripcion del genero es necesario';
  }
  
  public function index() {
    $genders = $this->Gender_model->get_all();
    if ($genders) {
        $response = [
            'status' => true,
            'message' => 'List of genders',
            'data' => $genders
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'No genders found',
            'data' => []
        ];
    }

    echo json_encode($response);
    return;
  }
  
  public function show($id) {
    $gender = $this->Gender_model->get_by_id($id);
    if ($gender) {
        $response = [
            'status' => true,
            'message' => 'gender found',
            'data' => $gender
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'gender not found',
            'data' => null
        ];
    }

    echo json_encode($response);
    return;
  }

  public function create() {
    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('description', 'description', 'required',array('required' => $this->errorDesc));

    if ($this->form_validation->run() == FALSE) {
      $response = array(
         'status' => 'error',
         'message' => validation_errors()
      );
      echo json_encode($response);
      return;
    }

    $data = array(
        'name' => $this->input->post('name'),
        'description' => $this->input->post('description'),
    );
    
    $result = $this->Gender_model->create($data);
    
    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'gender created successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error creating gender.'
        );
    }
    
    echo json_encode($response);
    return;
  }

  public function update($id) {
    $set_data = array(
        'name' => $this->putextends->PUT('name'),
        'description' => $this->putextends->PUT('description')
    );
    
    $this->form_validation->set_data($set_data);
    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('description', 'description', 'required',array('required' => $this->errorDesc));

    if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
            echo json_encode($response);
            return;
    }

    $data = array(
        'name' => $this->putextends->PUT('name'),
        'description' => $this->putextends->PUT('description'),
    );

    $result = $this->Gender_model->update($id, $data);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'gender updated successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating gender.'
        );
    }
    
    echo json_encode($response);
    return;
  }
    
  public function delete($id) {
    $result = $this->Gender_model->delete($id);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'gender deleted successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting gender.'
        );
    }
    
    echo json_encode($response);
    return;
  }
  

  
}