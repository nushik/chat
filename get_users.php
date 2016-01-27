<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Get_users extends CI_Model{
	 public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
		
	public function users($num,$offset){
		 //$this->db->limit(1, 0);
		 $a =(int)$offset;
		$query = $this->db->get('user',$num,$a);
		$array = $query->result_array();
		return $array;
		 
		
	}
	
}
?>
