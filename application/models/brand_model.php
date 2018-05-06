<?php 
	
	class brand_model extends CI_Model {

	    /**
	     * Default constructor
	     */
	    public function __construct() {
	    	parent::__construct();
	    }

	    // show all data in brand
	    public function showAllBrand(){
	    $this->db->select('idbrand, brand, count("skeleton_model.idmodel") AS "ModelCount" ');
	    $this->db->join('model','model.brandid = brand.idbrand', 'left');
	     $this->db->group_by('skeleton_brand.brand');
	     $query = $this->db->get('brand');

	      if($query->num_rows() > 0){
	       return $query->result();
	      }else{
	       return false;
	      }
	     }

	     // use for create brand
	    public function create_brand($data)
	        {
	         $this->db->insert('brand', $data);
	         return $insert_id = $this->db->insert_id();
	        }

	        // use to delete
	        function deleteBrand($id){
	        	$this->db->where('idbrand', $id);
	        	$this->db->delete('brand');
	        }

	        // show edit brand
	        public function showEditBrand($id){
	        	$this->db->where('idbrand', $id);
	        	$query = $this->db->get('brand');
	        	if($query->num_rows() > 0){
	        		return $query->result();
	        	}else{
	        		return false;
	        	}
	        }

	        // use for update
	        public function updateBrand($idbrand, $brand)
	        {
	        	$data = array(
	        		'idbrand' => $idbrand,
	        		'brand'  => $brand
	        	);
	        	$this->db->where('idbrand',$idbrand);
	        	return $this->db->replace('brand', $data);
	        	
	        }


	}
 ?>
