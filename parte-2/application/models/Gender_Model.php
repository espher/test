<?php
class Gender_Model extends CI_Model {
    private $means;
    public function __construct()
    {
        $this->means = 'genders';
    }

    public function get_all() {
        $query = $this->db->get($this->means);
        return $query->result();
    }
  
    public function get_by_id($id) {
        $query = $this->db->get_where($this->means, array('id' => $id));
        return $query->row();
    }
    
    public function create($data) {
        $this->db->insert($this->means, $data);
        return $this->db->insert_id();
    }
    
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->means, $data);
        return $this->db->affected_rows();
    }
    
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->means);
        return $this->db->affected_rows();
    }
  
}