<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Global_model extends CI_Model {

    function __construct() {
        parent::__construct();

    }

    function insert_data($table_name,$data){
        $this->db->insert($table_name,$data);
        return $this->db->insert_id() ;
    }

    function update($table_name, $data, $condtion){
        $update=$this->db->update($table_name,$data,$condtion);
        if($update){
            return 1;
        }
        
    }

    function delete($table_name,$condtion){
        $delete=$this->db->update($table_name,array('archive'=>'1'),$condtion);
        if($delete){
            return 1;
        }
        
    }

    function get_statuses(){
        return $this->db->get_where('statuses', array('archive'=>0))->result_array();
    }
   
    function get_table_column_name($table_name,$unique_id_column,$unique_id,$column){
        return $this->db->get_where($table_name, array('archive'=>0,$unique_id_column=>$unique_id))->row()->$column;
    }
   
    function get_user_name($member_id){
        return $this->db->get_where('ke_users', array('archive'=>0,'id'=>$member_id))->row()->names;
    }

    function get_user_email($member_id){
        return $this->db->get_where('ke_users', array('archive'=>0,'id'=>$member_id))->row()->username;
    }

    function generate_unique_id($table_name){
        $length=12; //no maximum

        srand((float)microtime() * 1000000);
        
        $number='';
        for($i=0;$i<$length;$i++) {
          $number .= rand(0,9);
          $check_existnce=$this->db->get_where($table_name,array('unique_id'=>$number))->num_rows();
          if($check_existnce >0){
              $length=20;
              $logs=array(
                  'table_name'=>$table_name,
                  'unique_id'=>$number,
                  'times'=>$i,
              );
              $this->insert_data('unique_id_repeated_logs',$logs);
          }
        }
        return $number;
        
    }

}