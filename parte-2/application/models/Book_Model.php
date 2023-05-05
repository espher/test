<?php
class Book_Model extends CI_Model {
    private $means;
    public function __construct()
    {
        $this->means = 'books';
    }


    public function get_all() {
        $this->db->select('
                            authors.name as author_name,
                            genders.name as gender_name,
                            books.id, books.author_id, books.gender_id, books.name, books.publication_year, books.description
                        ');    
        $this->db->from($this->means);
        $this->db->join('genders', 'books.gender_id = genders.id');
        $this->db->join('authors', 'books.author_id = authors.id');
        $query = $this->db->get();
        return $query->result();
    }
  
    public function get_by_id($id) {
        $this->db->select('
                            authors.name as author_name,
                            genders.name as gender_name,
                            books.id, books.author_id, books.gender_id, books.name, books.publication_year, books.description
                        ');    
        $this->db->from($this->means);
        $this->db->join('genders', 'gender_id = genders.id');
        $this->db->join('authors', 'author_id = authors.id');
        $this->db->where(array('books.id' => $id));
        $query = $this->db->get();
        return $query->row();
    }
    
    public function create($data) {
        
        $author = $this->db->get_where('authors', array('id' => $data['author_id']));
        $gender = $this->db->get_where('genders', array('id' => $data['gender_id']));
        
        if( $author->row() && $gender->row() ){
            $this->db->insert($this->means, $data);
            return $this->db->insert_id();
        }
        return 'error';
    }
    
    public function update($id, $data) {
        //$this->db->where('id', $id);

        $author = $this->db->get_where('authors', array('id' => $data['author_id']));
        $gender = $this->db->get_where('genders', array('id' => $data['gender_id']));

        if( $author->row() && $gender->row() ){
            $this->db->where('id', $id);
            $this->db->update($this->means, $data);
            return $this->db->affected_rows();
        }
        return 'error';
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->means);
        return $this->db->affected_rows();
    }
  
}