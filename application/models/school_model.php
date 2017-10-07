<?php  
class School_model extends CI_Model  
{  
    function insert_data($data)  
    {  
        $this->db->insert("school_user", $data);  
    }  
    function fetch_data()  
    {   
        $this->db->select("*");  
        $this->db->from("school_user");  
        $query = $this->db->get();  
        return $query;  
    }  
    function delete_data($id){  
        $this->db->where("id", $id);  
        $this->db->delete("school_user");
        $this->db->query( "ALTER TABLE school_user DROP id");
        $this->db->query( "ALTER TABLE school_user ADD  id INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id), AUTO_INCREMENT=1");
    }  
    function fetch_single_data($id)  
    {  
        $this->db->where("id", $id);  
        $query = $this->db->get("school_user");  
        return $query; 
    }  
    function update_data($data, $id)  
    {  
        $this->db->where("id", $id);  
        $this->db->update("school_user", $data); 
    }  
    public function getData($selectValue)
    {
        $this->db->select('*');
        $this->db->like('school',$selectValue);
        $query = $this->db->get("school_user");
        return $query->result();
    }
}  