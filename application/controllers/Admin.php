<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
            parent::__construct();
            $this->load->database();

            if($this->session->userdata('session_id') == null) redirect(site_url('login'),'refresh');
      }

	public function index(){
		$page_data['page_name']="dashboard";
		$page_data['page_title']="Dashboard";


		$this->load->view('backend/index',$page_data);
	}
	
	public function settings(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="settings";
		$page_data['page_title']="SETTINGS";
		$this->load->view('backend/index',$page_data);
	}
	

	public function saveContact() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			// Define all post fields
			$email = $this->input->post('email');
			$phone = $this->input->post('phone');
			$address = $this->input->post('address');
			$address2 = $this->input->post('address2');
			$country = $this->input->post('country');
			$city = $this->input->post('city');
	
			// Get post data
			$data = array(
				'email' => $email,
				'phone' => $phone,
				'address' => $address,
				'address2' => $address2,
				'country' => $country,
				'city' => $city
			);
	
			// Check if data already exists
			$contact = $this->home_model->contact();
	
			if ($contact) {
				// Data exists, update it
				$this->db->update('contact', $data,['archive'=>0]);
				$message = 'Contact updated successfully.';
			} else {
				// Data doesn't exist, save it
				$this->db->insert('contact',$data);
				$message = 'Contact saved successfully.';

			}
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
	
	
	public function saveSocialMedia() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			// Define all post fields
			$whatsapp = $this->input->post('whatsapp');
			$facebook = $this->input->post('facebook');
			$instagram = $this->input->post('instagram');
			$linkedin = $this->input->post('linkedin');
			$youtube = $this->input->post('youtube');
	
			// Get post data
			$data = array(
				'whatsapp' => $whatsapp,
				'facebook' => $facebook,
				'instagram' => $instagram,
				'linkedin' => $linkedin,
				'youtube' => $youtube,
			);
	
			// Check if data already exists
			$contact = $this->home_model->contact();
	
			if ($contact) {
				// Data exists, update it
				$this->db->update('contact', $data,['archive'=>0]);
				$message = 'Contact updated successfully.';
			} else {
				// Data doesn't exist, save it
				$this->db->insert('contact',$data);
				$message = 'Contact saved successfully.';

			}
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
	
	public function saveSystem() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		try{
			// Define all post fields
			$system_name = $this->input->post('system_name');
			$system_username = $this->input->post('system_username');

			if(!empty($_FILES['system_logo']["name"])){
                    
                        $path = 'uploads/settings/'; // upload directory
                    
                        $img = $_FILES['system_logo']['name'];
                        $tmp = $_FILES['system_logo']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        // can upload same image using rand function
                        $final_image = rand(1000,1000000).$img;
                        $path = $path.strtolower($final_image); 
                        move_uploaded_file($tmp,$path); 

				$data = array(
					'system_name' => $system_name,
					'system_username' => $system_username,
					'system_logo' => $path
				);
		
				// Check if data already exists
				$system = $this->home_model->system();
		
				if ($system) {
					// Data exists, update it
					$this->db->update('system', $data,['archive'=>0]);
					$message = 'System Settings updated successfully.';
				} else {
					// Data doesn't exist, save it
					$this->db->insert('system',$data);
					$message = 'System Settings saved successfully.';
	
				}
                        
                  }
	
			
			
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function resources_category(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="resources_category";
		$page_data['page_title']="RESOURCES CATEGORY";
		$this->load->view('backend/index',$page_data);
	}
	
	public function resources_category_view(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="resources_category_view";
		$page_data['page_title']="RESOURCES CATEGORY";
		$this->load->view('backend/main/resources_category_view',$page_data);
	}
	
	public function saveResourcesCategory() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$for_hr= $this->input->post('for_hr') ?? 0;
			$for_executive = $this->input->post('for_executive') ?? 0;
			$hidden_id = $this->input->post('hidden_id');


			## save attachment
			$path=$this->Global_model->get_table_column_name('resources_category','id',$hidden_id,'cover');
			if(!empty($_FILES['cover']["name"])){
                    
                        $path = 'uploads/resources/'; // upload directory
                    
                        $img = $_FILES['cover']['name'];
                        $tmp = $_FILES['cover']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        // can upload same image using rand function
                        $final_image = rand(1000,1000000).$img;
                        $path = $path.strtolower($final_image); 
                        move_uploaded_file($tmp,$path); 
                        
                  }

			if($hidden_id == ""):
				$data = array(
					'name' => $name,
					'description' => $description,
					'cover' => $path,
					'for_hr' => $for_hr,
					'for_executive' => $for_executive,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('resources_category',$data);
				$message = 'Resources category saved successfully.';

			else :
				$data = array(
					'name' => $name,
					'description' => $description,
					'cover' => $path,
					'for_hr' => $for_hr,
					'for_executive' => $for_executive,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('resources_category', $data,$condition);
				$message = 'Resources category updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editResourcesCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editResourcesCategory($id);

		echo json_encode($data);
	}
	
	public function deleteResourcesCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('resources_category',$data,$condition);

		$output=['status'=>1,'message'=>"Resources category deleted successful"];
		echo json_encode($output);
	}
	
	public function resources_sub_category(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="resources_sub_category";
		$page_data['page_title']="RESOURCES SUB CATEGORY";
		$this->load->view('backend/index',$page_data);
	}
	
	public function resources_sub_category_view(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="resources_sub_category_view";
		$page_data['page_title']="RESOURCES SUB CATEGORY";
		$this->load->view('backend/main/resources_sub_category_view',$page_data);
	}
	
	public function saveResourcesSubCategory() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$name = $this->input->post('name');
			$short_description = $this->input->post('short_description');
			$hidden_id = $this->input->post('hidden_id');


			if($hidden_id == ""):
				$data = array(
					'name' => $name,
					'short_description' => $short_description,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('resources_sub_category',$data);
				$message = 'Resources sub category saved successfully.';

			else :
				$data = array(
					'name' => $name,
					'short_description' => $short_description,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('resources_sub_category', $data,$condition);
				$message = 'Resources sub category updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editResourcesSubCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editResourcesSubCategory($id);

		echo json_encode($data);
	}
	
	public function deleteResourcesSubCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('resources_sub_category',$data,$condition);

		$output=['status'=>1,'message'=>"Resources sub category deleted successful"];
		echo json_encode($output);
	}
	
	
	
	public function resources(){ 
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();
 
		$page_data['page_name']="resources";
		$page_data['page_title']="RESOURCES";
		$this->load->view('backend/index',$page_data);
	}
	
	public function resources_view(){
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();
 
		$page_data['page_name']="resources_view";
		$page_data['page_title']="RESOURCES";
		$this->load->view('backend/main/resources_view',$page_data);
	}
	
	public function saveResources() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$name = $this->input->post('name');
			$category_id = $this->input->post('category_id');
			$sub_category_id = $this->input->post('sub_category_id');
			$hidden_id = $this->input->post('hidden_id');
			$for_hr= $this->input->post('for_hr') ?? 0;
			$for_executive = $this->input->post('for_executive') ?? 0;
			$short_description = $this->input->post('short_description');
			$description = $this->input->post('description');

			$hidden_item_id = $this->input->post('hidden_item_id[]');
			$attachment = $this->input->post('attachment[]');


			## save attachment
			$path=$this->Global_model->get_table_column_name('resources','id',$hidden_id,'cover');
			if(!empty($_FILES['cover']["name"])){
                    
                        $path = 'uploads/resources/'; // upload directory
                    
                        $img = $_FILES['cover']['name'];
                        $tmp = $_FILES['cover']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        // can upload same image using rand function
                        $final_image = rand(1000,1000000).$img;
                        $path = $path.strtolower($final_image); 
                        move_uploaded_file($tmp,$path); 
                        
                  }


			if($hidden_id == ""):
				$data = array(
					'category_id' => $category_id,
					'sub_category_id' => $sub_category_id,
					'name' => $name,
					'cover' => $path,
					'for_hr' => $for_hr,
					'for_executive' => $for_executive,
					'short_description' => $short_description,
					'description' => $description,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('resources',$data);
				$resources_id=$this->db->insert_id();


				## add more images
				$attachment = $_FILES['attachment'];
				$total_files = count($attachment['name']);

				for ($n = 0; $n < $total_files; $n++) {
					if (!empty($attachment['name'][$n])) {
						$path = 'uploads/resources/'; // upload directory

						$img = $attachment['name'][$n];
						$tmp = $attachment['tmp_name'][$n];
						$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
						// can upload the same image using rand function
						$final_image = rand(1000, 1000000) . $img;
						$path = $path . strtolower($final_image);
						move_uploaded_file($tmp, $path);


						$data2['resources_id']=$resources_id;
						$data2['attachment']=$path;

						$data2['created_by']= $session_id;
						$data2['created_on']=$today;

						$this->Global_model->insert_data('resources_attachment',$data2);
						
					}
					
				}

				
				$message = 'Resources saved successfully.';

			else :
				## delete old path
				$old_path=$this->Global_model->get_table_column_name('resources','id',$hidden_id,'attachment');


				$data = array(
					'category_id' => $category_id,
					'sub_category_id' => $sub_category_id,
					'name' => $name,
					'cover' => $path,
					'for_hr' => $for_hr,
					'for_executive' => $for_executive,
					'short_description' => $short_description,
					'description' => $description,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('resources', $data,$condition);
				$message = 'Resources updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editResources(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editResources($id);

		echo json_encode($data);
	}
	
	public function deleteResources(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('resources',$data,$condition);

		$output=['status'=>1,'message'=>"Resources deleted successful"];
		echo json_encode($output);
	}
	
	public function faq(){ 
 
		$page_data['page_name']="faq";
		$page_data['page_title']="FREQUENCE ASKED QUESTION";
		$this->load->view('backend/index',$page_data);
	}
	
	public function faq_view(){ 
 
		$page_data['page_name']="faq_view";
		$page_data['page_title']="FREQUENCE ASKED QUESTION";
		$this->load->view('backend/main/faq_view',$page_data);
	}
	
	public function saveFaq() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$category_id = $this->input->post('category_id');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer');
			$hidden_id = $this->input->post('hidden_id');


			if($hidden_id == ""):
				$data = array(
					'category_id' => $category_id,
					'question' => $question,
					'answer' => $answer,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('faq',$data);
				$message = 'question saved successfully.';

			else :
				$data = array(
					'category_id' => $category_id,
					'question' => $question,
					'answer' => $answer,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('faq', $data,$condition);
				$message = 'question updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editFaq(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editFaq($id);

		echo json_encode($data);
	}
	
	public function deleteFaq(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('faq',$data,$condition);

		$output=['status'=>1,'message'=>"Question deleted successful"];
		echo json_encode($output);
	}

	public function faq_category(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="faq_category";
		$page_data['page_title']="FAQ Category";
		$this->load->view('backend/index',$page_data);
	}
	
	public function faq_category_view(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="faq_category_view";
		$page_data['page_title']="FAQ Category";
		$this->load->view('backend/main/faq_category_view',$page_data);
	}
	
	public function saveFaqCategory() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$name = $this->input->post('name');
			$hidden_id = $this->input->post('hidden_id');


			if($hidden_id == ""):
				$data = array(
					'name' => $name,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('faq_category',$data);
				$message = 'FAQ category saved successfully.';

			else :
				$data = array(
					'name' => $name,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('faq_category', $data,$condition);
				$message = 'FAQ category updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editFaqCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editFaqCategory($id);

		echo json_encode($data);
	}
	
	public function deleteFaqCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('faq_category',$data,$condition);

		$output=['status'=>1,'message'=>"FAQ category deleted successful"];
		echo json_encode($output);
	}
	


	## profile

	public function profile(){ ## for admin only
		$session_id=$this->session->userdata('session_id');
		
		$page_data['users']=$this->home_model->users($session_id);
		$page_data['page_name']="profile";
		$page_data['page_title']="USER PROFILE";
		$this->load->view('backend/index',$page_data);
	}
	
	
	
	public function updateProfile() {

		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$gender=$this->input->post('gender');
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$phone=$this->input->post('phone');
			$address=$this->input->post('address');
			$country=$this->input->post('country');
			$twitter = $this->input->post('twitter');
			$whatsapp = $this->input->post('whatsapp');
			$facebook = $this->input->post('facebook');
			$instagram = $this->input->post('instagram');
			$linkedin = $this->input->post('linkedin');
			$about = $this->input->post('about');
			$company = $this->input->post('company');
			$occupation = $this->input->post('occupation');
			$hidden_id = $this->input->post('hidden_id');

			## save image
			$path=$this->Global_model->get_table_column_name('users','md5(id)',$hidden_id,'image');
			if(!empty($_FILES['image']["name"])){
                    
                        $path = 'uploads/profile/'; // upload directory
                    
                        $img = $_FILES['image']['name'];
                        $tmp = $_FILES['image']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        // can upload same image using rand function
                        $final_image = rand(1000,1000000).$img;
                        $path = $path.strtolower($final_image); 
                        move_uploaded_file($tmp,$path); 
                  }


			if($hidden_id != ""):
				
				$data = [
					'image' => $path,
					'occupation' => $occupation,
					'company' => $company,
					'about' => $about,
					'gender' => $gender,
					'first_name' => $first_name,
					'last_name' => $last_name,
					'phone' => $phone,
					'twitter' => $twitter,
					'address' => $address,
					'country' => $country,
					'instagram' => $instagram,
					'whatsapp' => $whatsapp,
					'linkedin' => $linkedin,
					'facebook' => $facebook,
				];

				$condition = array(
					'md5(id)' => $hidden_id,
				);

				$this->db->update('users', $data,$condition);
				$message = 'Profile updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
	
	public function changePassword() {

		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$renewpassword=$this->input->post('renewpassword');
			$newpassword=$this->input->post('newpassword');
			$password=$this->input->post('password');
			$hidden_id=$this->input->post('hidden_id2');

			if($newpassword != $renewpassword){
				$output=['status'=>2,'message'=>"New Password not match with repeated password"];
			     die( json_encode($output));
			}
			
			$checkPassword=$this->db->get_where('users',['md5(id)'=>$hidden_id,'password'=>md5($password),'archive'=>0])->num_rows();
			if($checkPassword ==0){
				$output=['status'=>2,'message'=>"Your current password is wrong"];
			     die( json_encode($output));
			}


			if($hidden_id != ""):
				
				$data = [
					'password' => md5($newpassword)
				];

				$condition = array(
					'md5(id)' => $hidden_id,
				);

				$this->db->update('users', $data,$condition);
				$message = 'Password changed successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
	
	public function updateUserSettings() {

		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$is_news_subscribe=$this->input->post('is_news_subscribe');
			$hidden_id=$this->input->post('hidden_id3');
			

			if($hidden_id != ""):
				
				$data = [
					'is_news_subscribe' => $is_news_subscribe
				];

				$condition = array(
					'md5(id)' => $hidden_id,
				);

				$this->db->update('users', $data,$condition);
				$message = 'User settings updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	## news and update
	public function news_category(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="news_category";
		$page_data['page_title']="NEWS CATEGORY";
		$this->load->view('backend/index',$page_data);
	}
	
	public function news_category_view(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="news_category_view";
		$page_data['page_title']="NEWS CATEGORY";
		$this->load->view('backend/main/news_category_view',$page_data);
	}
	
	public function saveNewsCategory() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$title = $this->input->post('title');
			$category_id = $this->input->post('category_id');
			$description = $this->input->post('description');
			$hidden_id = $this->input->post('hidden_id');


			if($hidden_id == ""):
				$data = array(
					'name' => $name,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('news_category',$data);
				$message = 'News category saved successfully.';

			else :
				$data = array(
					'name' => $name,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('news_category', $data,$condition);
				$message = 'News category updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editNewsCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editNewsCategory($id);

		echo json_encode($data);
	}
	
	public function deleteNewsCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('news_category',$data,$condition);

		$output=['status'=>1,'message'=>"News category deleted successful"];
		echo json_encode($output);
	}
	
	public function news(){ 
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();

		$page_data['page_name']="news";
		$page_data['page_title']="NEWS";
		$this->load->view('backend/index',$page_data);
	}
	
	public function news_view(){
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();
 
		$page_data['page_name']="news_view";
		$page_data['page_title']="NEWS";
		$this->load->view('backend/main/news_view',$page_data);
	}
	
	public function saveNews() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		try{

			$this->db->trans_start();
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$title = $this->input->post('title');
			$category_id = $this->input->post('category_id');
			$short_description = $this->input->post('short_description') ;
			$description = $this->input->post('description') ;
			$hidden_id = $this->input->post('hidden_id');

			$hidden_item_id = $this->input->post('hidden_item_id[]');
			$attachment = $this->input->post('attachment[]');
			$tags = $this->input->post('tags[]');

			## save cover
			$path="";
			if(!empty($_FILES['cover']["name"])){
                    
                        $path = 'uploads/news/'; // upload directory
                    
                        $img = $_FILES['cover']['name'];
                        $tmp = $_FILES['cover']['tmp_name'];
                        $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
                        // can upload same image using rand function
                        $final_image = rand(1000,1000000).$img;
                        $path = $path.strtolower($final_image); 
                        move_uploaded_file($tmp,$path); 
                        
                  }


			if($hidden_id == ""):

				## add news
				$data = array(
					'category_id' => $category_id,
					'title' => $title,
					'short_description' => $short_description,
					'description' => $description,
					'cover' => $path,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$news_id=$this->Global_model->insert_data('news',$data);

				## add more tags
				$total_tags=count($tags);
				$n=0;
				for($n; $n<=$total_tags; $n++){
					if($tags[$n] != ""){
						$data3['news_id']=$news_id;
						$data3['name']=$tags[$n];

						$data3['created_by']= $session_id;
						$data3['created_on']=$today;

						$this->Global_model->insert_data('news_tags',$data3);
					}
				}


				## add more images
				$attachment = $_FILES['attachment'];
				$total_files = count($attachment['name']);

				for ($n = 0; $n < $total_files; $n++) {
					if (!empty($attachment['name'][$n])) {
						$path = 'uploads/news/'; // upload directory

						$img = $attachment['name'][$n];
						$tmp = $attachment['tmp_name'][$n];
						$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
						// can upload the same image using rand function
						$final_image = rand(1000, 1000000) . $img;
						$path = $path . strtolower($final_image);
						move_uploaded_file($tmp, $path);


						$data2['news_id']=$news_id;
						$data2['image']=$path;

						$data2['created_by']= $session_id;
						$data2['created_on']=$today;

						$this->Global_model->insert_data('news_image',$data2);
						
					}
					
				}


				$message = 'News saved successfully.';

			else :
				## delete old path
				$old_path=$this->Global_model->get_table_column_name('news','id',$hidden_id,'attachment');


				$data = array(
					'category_id' => $category_id,
					'title' => $title,
					'description' => $description,
					'cover' => $path,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('news', $data,$condition);
				$message = 'News updated successfully.';

			endif;
			
			$this->db->trans_complete();
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$this->db->rollback();
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}

	public function editNews(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editNews($id);

		echo json_encode($data);
	}
	
	public function deleteNews(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('news',$data,$condition);

		$output=['status'=>1,'message'=>"News deleted successful"];
		echo json_encode($output);
	}

	public function forum_category(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="forum_category";
		$page_data['page_title']="FORUM TOPICS";
		$this->load->view('backend/index',$page_data);
	}
	
	public function forum_category_view(){ ## for admin only
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');
 
		$page_data['page_name']="forum_category_view";
		$page_data['page_title']="FORUM TOPICS";
		$this->load->view('backend/main/forum_category_view',$page_data);
	}
	
	
	public function saveForumCategory() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');


		try{
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$name = $this->input->post('name');
			$hidden_id = $this->input->post('hidden_id');


			if($hidden_id == ""):
				$data = array(
					'name' => $name,

					'created_on'=>$today,
					'created_by'=>$session_id
				);

				$this->db->insert('forum_category',$data);
				$message = 'Forum category saved successfully.';

			else :
				$data = array(
					'name' => $name,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('forum_category', $data,$condition);
				$message = 'Forum category updated successfully.';

			endif;
			
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
	
	
	
	

	public function editForumCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=$this->home_model->editForumCategory($id);

		echo json_encode($data);
	}
	
	public function deleteForumCategory(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');

		$data=array(
			'archive'=>1,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('forum_category',$data,$condition);

		$output=['status'=>1,'message'=>"Forum category deleted successful"];
		echo json_encode($output);
	}
	
	public function forum_posts(){ 
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();
 
		$page_data['page_name']="forum_posts";
		$page_data['page_title']="FORUM POSTS";
		$this->load->view('backend/index',$page_data);
	}
	
	public function forum_posts_view(){ 
		## check subscription
		$checkSubscriptionOnly=$this->home_model->checkSubscriptionOnly();
 
		$page_data['page_name']="forum_posts_view";
		$page_data['page_title']="FORUM POST";
		$this->load->view('backend/main/forum_posts_view',$page_data);
	}

	public function changeForumPostStatus(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$id=$this->input->post('id');
		$status=$this->input->post('status');

		$data=array(
			'status'=>$status,
		);
		
		$condition=array(
			'id'=>$id,
		);

		$this->Global_model->update('forum',$data,$condition);

		$output=['status'=>1,'message'=>"Forum updated successful"];
		echo json_encode($output);
	}

	public function vaq(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$page_data['page_name']="vaq";
		$page_data['page_title']="VIRTUAL ASSISTANCE QUESTION";
		$this->load->view('backend/index',$page_data);
	}
	
	public function vaq_view(){
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		$page_data['page_name']="vaq_view";
		$page_data['page_title']="VIRTUAL ASSISTANCE QUESTION";
		$this->load->view('backend/main/vaq_view',$page_data);
	}
	
	public function saveVaq() {
		if($this->session->userdata('session_role') != 1) redirect(site_url('admin'),'refresh');

		try{

			$this->db->trans_start();
			date_default_timezone_set("Africa/Nairobi");
			$today=date('Y-m-d h:i:s');
			$session_id=$this->session->userdata('session_id');
			
			$chooseOption = $this->input->post('chooseOption');
			$parent_id = $this->input->post('parent_id');
			$question = $this->input->post('question');
			$answer = $this->input->post('answer') ;
			$top_option = $this->input->post('top_option') ;
			$option = $this->input->post('optionArray[]');
			$option_answer = $this->input->post('optionAnswerArray[]');

			if($answer ==""){
				$answer=null;
			}
			
			if($parent_id ==""){
				$parent_id=null;
			}
			
			if($question ==""){
				$question=null;
			}



			if($hidden_id == ""):

				## add news
				if($chooseOption=="new"){
					$data = array(
						'question' => $question,
						'parent_id' => $parent_id,
						'option' => $top_option,
						'answer' => $answer,

						'created_on'=>$today,
						'created_by'=>$session_id
					);
					$parent_id=$this->Global_model->insert_data('chat',$data);
				}else{
					$this->db->update('chat',['question'=>$question],['id'=>$parent_id]);
				}

				## add more option
				$n=0;
				foreach ($option as $mau => $index) {
					
					if($option_answer[$n] ==""){
						$option_answer[$n]=null;
					}

					if($option[$n] != ""){
						$data3 = array(
							'parent_id' => $parent_id,
							'option' => $option[$n],
							'answer' => $option_answer[$n],
		
							'created_on'=>$today,
							'created_by'=>$session_id
						);

						$this->Global_model->insert_data('chat',$data3);
					}

					$n=$n+1;
				}


				$message = 'VAQ saved successfully.';

			else :
				

				$data = array(
					'category_id' => $category_id,
					'title' => $title,
					'description' => $description,
					'cover' => $path,
				);

				$condition = array(
					'id' => $hidden_id,
				);

				$this->db->update('news', $data,$condition);
				$message = 'VAQ updated successfully.';

			endif;
			
			$this->db->trans_complete();
			$output=['status'=>1,'message'=>$message];
			echo json_encode($output);

		}catch(Exception $e){
			$this->db->rollback();
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}

	}
}
