<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller {
  private $errorName;
  private $errorLast;

  public function __construct() {
    parent::__construct();
    $this->load->model('Author_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('putextends');
    $this->errorName = 'El nombre del autor es necesario';
    $this->errorLast = 'El nombre del autor es necesario';
  }
  
  public function index() {
    $authors = $this->Author_model->get_all();
    if ($authors) {
        $response = [
            'status' => true,
            'message' => 'List of authors',
            'data' => $authors
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'No authors found',
            'data' => []
        ];
    }

    echo json_encode($response);
    return;
  }
  
  public function show($id) {
    $author = $this->Author_model->get_by_id($id);
    if ($author) {
        $response = [
            'status' => true,
            'message' => 'Author found',
            'data' => $author
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'Author not found',
            'data' => null
        ];
    }

    echo json_encode($response);
    return;
  }

  public function create() {
    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('last_name', 'last_name', 'required',array('required' => $this->errorLast));

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
        'last_name' => $this->input->post('last_name'),
        'description' => $this->input->post('description'),
    );
    
    $result = $this->Author_model->create($data);
    
    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'Author created successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error creating author.'
        );
    }
    
    echo json_encode($response);
    return;
  }

  public function update($id) {
    $set_data = array(
        'name' => $this->putextends->PUT('name'),
        'last_name' => $this->putextends->PUT('last_name')
    );
    
    $this->form_validation->set_data($set_data);
    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('last_name', 'last_name', 'required',array('required' => $this->errorLast));

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
        'last_name' => $this->putextends->PUT('last_name'),
        'description' => $this->putextends->PUT('description'),
    );

    $result = $this->Author_model->update($id, $data);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'Author updated successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating author.'
        );
    }
    
    echo json_encode($response);
    return;
  }
    
  public function delete($id) {
    $result = $this->Author_model->delete($id);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'Author deleted successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting author.'
        );
    }
    
    echo json_encode($response);
    return;
  }
  

  
}