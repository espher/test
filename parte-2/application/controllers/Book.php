<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends CI_Controller {
  private $errorAuthor;
  private $errorGender;
  private $errorName;
  private $errorDesc;
  private $errorYear;

  public function __construct() {
    parent::__construct();
    $this->load->model('Book_model');
    $this->load->helper('url_helper');
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('putextends');

    $this->errorAuthor = 'El author del libro es necesario';
    $this->errorGender = 'El genero del libro es necesario';

    $this->errorName = 'El nombre del libro es necesario';
    $this->errorYear = 'El ano del libro es necesario';
    $this->errorDesc = 'La descripcion del libro es necesario';
  }
  
  public function index() {
    $books = $this->Book_model->get_all();
    if ($books) {
        $response = [
            'status' => true,
            'message' => 'List of books',
            'data' => $books
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'No books found',
            'data' => []
        ];
    }

    echo json_encode($response);
    return;
  }
  
  public function show($id) {
    $book = $this->Book_model->get_by_id($id);
    if ($book) {
        $response = [
            'status' => true,
            'message' => 'book found',
            'data' => $book
        ];
    } else {
        $response = [
            'status' => false,
            'message' => 'book not found',
            'data' => null
        ];
    }

    echo json_encode($response);
    return;
  }

  public function create() {
    $this->form_validation->set_rules('author_id', 'author_id', 'required',array('required' => $this->errorAuthor));
    $this->form_validation->set_rules('gender_id', 'gender_id', 'required',array('required' => $this->errorGender));

    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('description', 'description', 'required',array('required' => $this->errorDesc));
    $this->form_validation->set_rules('publication_year', 'publication_year', 'required',array('required' => $this->errorYear));

    if ($this->form_validation->run() == FALSE) {
      $response = array(
         'status' => 'error',
         'message' => validation_errors()
      );
      echo json_encode($response);
      return;
    }

    $data = array(
        'author_id' => $this->input->post('author_id'),
        'gender_id' => $this->input->post('gender_id'),

        'name' => $this->input->post('name'),
        'description' => $this->input->post('description'),
        'publication_year' => $this->input->post('publication_year'),
    );
    
    $result = $this->Book_model->create($data);
    
    if ($result == 'error') {
        $response = array(
            'status' => 'error',
            'message' => 'Gender or author dosn\'t exist .'
        );
    } elseif ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'book created successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error creating book.'
        );
    }
    
    echo json_encode($response);
    return;
  }

  public function update($id) {
    $set_data = array(
        'author_id' => $this->putextends->PUT('author_id'),
        'gender_id' => $this->putextends->PUT('gender_id'),
        'publication_year' => $this->putextends->PUT('publication_year'),
        'name' => $this->putextends->PUT('name'),
        'description' => $this->putextends->PUT('description')
    );
    
    $this->form_validation->set_data($set_data);
    
    $this->form_validation->set_rules('author_id', 'author_id', 'required',array('required' => $this->errorAuthor));
    $this->form_validation->set_rules('gender_id', 'gender_id', 'required',array('required' => $this->errorGender));

    $this->form_validation->set_rules('name', 'name', 'required',array('required' => $this->errorName));
    $this->form_validation->set_rules('description', 'description', 'required',array('required' => $this->errorDesc));
    $this->form_validation->set_rules('publication_year', 'publication_year', 'required',array('required' => $this->errorYear));

    if ($this->form_validation->run() == FALSE) {
            $response = array(
                'status' => 'error',
                'message' => validation_errors()
            );
            echo json_encode($response);
            return;
    }

    $data = array(
        'author_id' => $this->putextends->PUT('author_id'),
        'gender_id' => $this->putextends->PUT('gender_id'),

        'name' => $this->putextends->PUT('name'),
        'description' => $this->putextends->PUT('description'),
        'publication_year' => $this->putextends->PUT('publication_year'),
    );

    $result = $this->Book_model->update($id, $data);

    if ($result == 'error') {
        $response = array(
            'status' => 'error',
            'message' => 'Gender or author dosn\'t exist .'
        );
    } elseif ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'book created successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error creating book.'
        );
    }
    
    echo json_encode($response);
    return;
  }
    
  public function delete($id) {
    $result = $this->Book_model->delete($id);

    if ($result) {
        $response = array(
            'status' => 'success',
            'message' => 'book deleted successfully.'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting book.'
        );
    }
    
    echo json_encode($response);
    return;
  }
  

  
}