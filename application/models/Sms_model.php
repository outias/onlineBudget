<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sms_model extends CI_Model {

      function __construct(){
            parent::__construct();
          
            
      }

      function sendMailConfiguration($data){

		try{
			$session_id = $this -> session -> userdata('session_id');

			$username=$this->db->get_where('email_password',['archive'=>0,'default'=>1])->row()->email;

			$password=$this->db->get_where('email_password',['archive'=>0,'default'=>1])->row()->password;



			$mail_config['smtp_host'] = 'smtp.gmail.com';
			$mail_config['smtp_port'] = '465';
			$mail_config['smtp_user'] = $username;
			$mail_config['_smtp_auth'] = TRUE;
			$mail_config['smtp_pass'] = $password;
			$mail_config['smtp_crypto'] = 'ssl';
			$mail_config['protocol'] = 'smtps';
			$mail_config['mailtype'] = 'html';
			//$mail_config['send_multipart'] = FALSE;
			$mail_config['charset'] = 'utf-8';
			$mail_config['wordwrap'] = TRUE;

			$this->email->initialize($mail_config);
			$this->email->set_newline("\r\n");
			$this->load->library('email', $mail_config);
			$this->email->set_newline("\r\n");
			$this->email->from($data['from']); // change it to yours
			$this->email->to($data['to']);// change it to yours
			$this->email->subject($data['subject']);
			$this->email->message($data['message']);
			
			// Attach a file (if needed)
			if (!empty($data['attachment'])) {
			$this->email->attach($data['attachment']);
			}
				
			if($this->email->send()){
				return true;
			}
			else{
				return $this->email->print_debugger();
			}

		}catch(Exception $e){
			$output=['status'=>2,'message'=>$e->getMessage()];
			return json_encode($output);

		}

	}

}