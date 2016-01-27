<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends MX_Controller {
 public function __construct()
        {
                parent::__construct();
				 $user_id = $this->session->userdata('user_id');
			  if(!$user_id){
			   $this->log_out();
        }
		$this->load->library('pagination');
		$this->load->helper('url');
		$this->load->model('get_users');
		}
	public function index()
	{
		
		$user_id = $this->input->get('id');
		//echo $user_id;
		$data = array(
		'id'=>$user_id
		);
		$this->load->model('get_name');
		$user = $this->get_name->name($data);
		
		$config['base_url'] = base_url().'users/users/index?id='."$user_id";
			$config['total_rows'] =$this->db->get('user')->num_rows();
			$config['per_page'] = 1; 
			$config['display_pages'] = true;
			$this->pagination->initialize($config); 
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$users = $this->get_users->users($config['per_page'],$page);
		$arr = array(
		'us'=>$user,
		'users'=>$users
		);
		$this->load->view('second_view',$arr);
		 

			
		
		
		
		  


	}
	function log_out(){
			$id = $this->session->userdata('user_id');
			$arr = array(
			'id'=>$id,
			'checked'=>'outline',
			);
			$this->load->model('check_online');
			$this->check_online->check($arr);
		  $this->session->sess_destroy(); 
		  redirect('/');
	}
	function change(){
		$name = $_POST['name'];
		$surname = $_POST['surname'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$id =  $_POST['id'];
		$array = array(
		'name'=>$name,
		'surname'=>$surname, 
		'login'=>$login, 
		'password'=>$password,
		'id'=>$id		
		);
		$this->load->model('edit');
		$a = $this->edit->change($array);
	}
	function del(){
		$id =  $_POST['id'];
		$arr = array(
		'id'=>$id
		);
		$this->load->model('edit');
		$a = $this->edit->del($arr);
	} 	
}
