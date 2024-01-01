<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index(){
		if($this->session->userdata('session_id') != null) redirect(site_url('admin'),'refresh');

		$page_data['page_name']="login";
		$page_data['page_title']="SIGN IN";
		$this->load->view('backend/login',$page_data);
	}
	
	public function signup(){
		if($this->session->userdata('session_id') != null) redirect(site_url('admin'),'refresh');

		$page_data['page_name']="signup";
		$page_data['page_title']="SIGN IN";
		$this->load->view('backend/signup',$page_data);
	}

	public function verifyUser(){

		try{
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			
			## verify username exist
			$check = $this->home_model->verifyUsernameStatus($username);
			if($check > 0){
				$output=['status'=>2,'message'=>"You can't login, your account is inactive, Please contact support for account recovery"];
				
				die( json_encode($output));
			}
			
			## verify username exist
			$check = $this->home_model->verifyUsername($username);
			if($check == 0){
				$output=['status'=>2,'message'=>"Username or email doesn't exist"];
				
				die( json_encode($output));
			}
			
			$user = $this->home_model->verifyUser($username,$password);
			if($user->num_rows() == 0){
				$output=['status'=>2,'message'=>"Wrong username or password"];
				die( json_encode($output));
			}

			
			$user=$user->row();
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			$_SESSION['session_id'] = $user->id;
			$_SESSION['session_first_name'] = $user->first_name;
			$_SESSION['session_last_name'] = $user->last_name;
			$_SESSION['session_gender'] = $user->gender;
			$_SESSION['session_phone'] = $user->phone;
			$_SESSION['session_email'] = $user->email;
			$_SESSION['session_occupation'] = $user->session_occupation;
			$_SESSION['session_role'] = $user->role;

			$output=['status'=>1,'message'=>"User Login successfull"];
			echo json_encode($output);

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}
		

	}
	
	public function register(){

		try{
			$today=date('Y-m-d H:i:s');
			$expireTime = date('Y-m-d h:i:s', strtotime($today . ' +30 minutes'));


			$username=$this->input->post('username');
			$password=$this->input->post('password');
			$email=$this->input->post('email');
			$gender=$this->input->post('gender');
			$first_name=$this->input->post('first_name');
			$last_name=$this->input->post('last_name');
			$phone=$this->input->post('phone');

			 // Generate a unique verification token
			 $verificationToken = md5(uniqid());
			
			## verify username exist
			// $checkUsername = $this->home_model->checkUsername($username);
			// if($checkUsername > 0){
			// 	$output=['status'=>2,'message'=>"Username already exists. Please choose another username."];
			// 	die( json_encode($output));
			// }
			
			// $checkEmail = $this->home_model->checkEmail($email);
			// if($checkEmail > 0){
			// 	$output=['status'=>2,'message'=>"Email already exists. Please choose another email."];
			// 	die( json_encode($output));
			// }
			

			$data = [
				'username' => $username,
				'password' => md5($password), 
				'email' => $email,
				'gender' => $gender,
				'first_name' => $first_name,
				'last_name' => $last_name,
				'phone' => $phone,
				'created_on' => $today,
			];
			$this->db->insert('users', $data);
			$inserted_id=$this->db->insert_id();
			
			if($inserted_id){

				#### send email
				$from=$this->Global_model->get_table_column_name('email_password','default',1,'email');

				$verificationLink = site_url("login/verifyEmail/{$verificationToken}");
				$page_data['link'] = $verificationLink;
				$page_data['expireTime'] = $expireTime;
		
				$subject = "Account Confirmation";
				$message = $this->load->view('backend/emailVerifyTemplate', $page_data,true);
		
				
				$sms['to']=$email;
				$sms['from']=$from;
				$sms['subject']=$subject;
				$sms['message']=$message;
				$result=$this->Sms_model->sendMailConfiguration($sms);
				

				#### return response 
				$output=['status'=>1,'message'=>"Your Account Has Been Successfully Created, You will receive email to complete registration. "];
				echo json_encode($output);
			}else{
				$output=['status'=>2,'message'=>"Failed to register user. Please try again. "];
				echo json_encode($output);
			}
			

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			echo json_encode($output);

		}
		

	}

	

	public function verifyEmail($token) {
		// Retrieve user by verification token
		$user = $this->db->get_where('users', ['verification_token' => $token])->row();

	  
		if($user){
			if ( strtotime($user->verification_expires_at) > time() ) {
				// Update user status or perform any other necessary actions
				// ...
		    
				// Clear verification token and expiration time
				$this->db->where('id', $user->id)->update('users', ['verification_token' => null, 'verification_expires_at' => null,'status'=>1]);
		    
				$this->load->view('backend/emailVerifyComplete');
			} else {
				$page_data['token']=$token;
				$this->load->view('backend/emailVerificationError',$page_data);
			}
		}else{
			return redirect('errors/page_missing');
		}
		
	}

	public function resendVerificationToken($token) {
		// Retrieve user by verification token
		$user = $this->db->get_where('users', ['verification_token' => $token])->row();
	  
		if ($user) {
		    // Update expiration time
		    $today = date('Y-m-d H:i:s');
		    $expireTime = date('Y-m-d h:i:s', strtotime($today . ' +30 minutes'));
	  
		    $verificationToken = md5(uniqid());
	  
		    // Update user data in the database
		    $this->db->where('id', $user->id)->update('users', [
			  'verification_token' => $verificationToken,
			  'verification_expires_at' => $expireTime,
		    ]);
	  
		    // Resend verification email
		    $verificationLink = site_url("login/verifyEmail/{$verificationToken}");
		    $page_data['link'] = $verificationLink;
		    $page_data['expireTime'] = $expireTime;
	  
		    $subject = "Account Confirmation";
		    $message = $this->load->view('backend/emailVerifyTemplate', $page_data, true);
	  
		    $from=$this->Global_model->get_table_column_name('email_password','default',1,'email');
		    $sms['to'] = $user->email;
		    $sms['from'] = $from; 
		    $sms['subject'] = $subject;
		    $sms['message'] = $message;
		    $result = $this->Sms_model->sendMailConfiguration($sms);
	  
		    if ($result === true) {
			  // Email sent successfully
			  echo "Verification email resent successfully.";
		    } else {
			  // Handle the error
			  echo "Error: " . $result;
		    }
		} else {
		    echo "Invalid verification token.";
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('home','refresh'); 
	}
	
}
