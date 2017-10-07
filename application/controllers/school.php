<?php  
defined('BASEPATH') OR exit('No direct script access allowed');  
class School extends CI_Controller 
{  
	public function index(){  
		$this->load->model("school_model");  
		$data["fetch_data"] = $this->school_model->fetch_data();  
		$this->load->view("school_view", $data);
	}  
	public function form_validation()  
	{   
		$this->load->library('form_validation');  
		$this->form_validation->set_rules("user", "Name", 'required|alpha');  
		$this->form_validation->set_rules("mail", "Mail", 'required|valid_email');  
		if($this->form_validation->run())  
		{
			$this->load->model("school_model");
				$countFieldsName = count($this->input->post("school"));
				$insert_school_all = '';
					for ($x=0; $x<$countFieldsName; $x++)
					{
        				$var = $this->input->post("school")[$x];
						$insert_school_all .= $var . '<br>';
					}
			$data = array(  
				"user" => $this->input->post("user"),  
				"mail" => $this->input->post("mail"),
				"school" => $insert_school_all
			);  
			if($this->input->post("update"))  
			{  
					$this->school_model->update_data($data, $this->input->post("hidden_id"));  
					redirect(base_url() . "index.php/school/updated");  
			}  
			if($this->input->post("insert"))  
			{  
					$this->school_model->insert_data($data);  
					redirect(base_url() . "index.php/school/inserted");  
			}  
		}  
		else  
		{ 
			$this->index();  
		}  
	}
	public function inserted()  
	{  
		$this->index();  
	}  
	public function delete_data()
	{  
		$id = $this->uri->segment(3);  
		$this->load->model("school_model");  
		$this->school_model->delete_data($id);  
		redirect(base_url() . "index.php/school/deleted");  
	}  
	public function deleted()  
	{  
		$this->index();  
	}  
	public function update_data()
	{  
		$user_id = $this->uri->segment(3);  
		$this->load->model("school_model");  
		$data["user_data"] = $this->school_model->fetch_single_data($user_id);  
		$data["fetch_data"] = $this->school_model->fetch_data();  
		$this->load->view("school_view", $data);  
	}  
	public function updated()  
	{  
		$this->index();  
	} 
	public function filter()
	{
		$this->load->model('school_model');
    	$this->school_model->getData('school_model');
    	$selectValue=$this->input->post('selectvalue');
    	$data = $this->school_model->getData($selectValue);
		$dataID = $data;
		foreach ($dataID as $key)
		$items[] = (int)$key->{'id'};
		echo json_encode($items);
	} 
}  
