<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

      function __construct(){
            parent::__construct();
          
            
      }

      public function home(){
            return true;
      }

      public function verifyUsernameStatus($username){
            return $this->db->where(['archive'=> 0,'status'=>0])
            ->group_start()
                  ->where('username', $username)
                  ->or_where('email', $username)  // Assuming $username can be either a username or email
            ->group_end()
            ->get('users')->num_rows();
      }
      
      public function verifyUsername($username){
            return $this->db->where(['archive'=> 0,'status'=>1])
            ->group_start()
                  ->where('username', $username)
                  ->or_where('email', $username)  // Assuming $username can be either a username or email
            ->group_end()
            ->get('users')->num_rows();
      }
      
      public function checkUsername($username){
            return $checkUsername = $this->db->get_where('users', ['username' => $username, 'archive' => 0])->num_rows();
      }
      
      public function checkEmail($email){
            return     $checkEmail = $this->db->get_where('users', ['email' => $email, 'archive' => 0])->num_rows();

      }
      public function system(){
            return    $this->db->get_where('system',['archive'=>0])->row_array();

      }
      
      public function contact(){
            return   $contact = $this->db->get_where('contact',['archive'=>0])->row_array();

      }
      
      public function users($id){
            return   $users = $this->db->get_where('users',['archive'=>0,'id'=>$id])->row_array();
      }
      
      public function getServices(){
            return   $users = $this->db->get_where('service',['archive'=>0])->result_array();
      }
      
      public function getServicesItem($id){
            return   $this->db->get_where('service_item',['service_id'=>$id])->result_array();
      }
      
      public function getServicesSubItem($id){
            return   $this->db->get_where('service_sub_item',['service_item_id'=>$id])->result_array();
      }
      
      public function resources_category(){
            return   $users = $this->db->order_by('id','desc')->get_where('resources_category',['archive'=>0])->result_array();
      }
      
  
      
      public function getResourcesCategory($access){

            if($access=="for_hr"){
                  return   $users = $this->db->order_by('id','desc')->get_where('resources_category',['archive'=>0,'for_hr'=>1])->result_array();
            }
            else if($access=="for_executive"){
                  return   $users = $this->db->order_by('id','desc')->get_where('resources_category',['archive'=>0,'for_executive'=>1])->result_array();
            }
      }
      
      public function editResourcesCategory($id){
            return   $users = $this->db->get_where('resources_category',['id'=>$id])->row_array();
      }
      
      public function resources_sub_category(){
            return   $users = $this->db->order_by('id','desc')->get_where('resources_sub_category',['archive'=>0])->result_array();
      }
      
      public function editResourcesSubCategory($id){
            return   $users = $this->db->get_where('resources_sub_category',['id'=>$id])->row_array();
      }
      
      public function forum($access, $category, $status) {
            $this->db->order_by('id', 'desc');
            $this->db->where('archive', 0);
        
            if ($access == "for_hr") {
                $this->db->where('for_hr', 1);

            }else if ($access == "for_executive") {
                $this->db->where('for_executive', 1);

            }else{

            }
        
            if ($status != "All") {
                $this->db->where('status', $status);
            }
        
            if ($category != "All") {
                $this->db->where('topic', $category);
            }
        
            $query = $this->db->get('forum'); 
        
            return $query->result_array();
      }
        
      
      public function forum_recent(){
            date_default_timezone_set("Africa/Nairobi");
		$today=date('Y-m-d');

            return   $users = $this->db->order_by('id','desc')->get_where('forum',['archive'=>0,'Date(created_on)'=>$today ])->result_array();
      }
      
      public function forum_questions_my_thread(){
            $session_id=$this->session->userdata('session_id');

            return  $this->db->order_by('id','desc')->get_where('forum',['archive'=>0,'created_by'=>$session_id])->result_array();
      }
      
      public function forum_questions_details($id){

            return  $this->db->order_by('id','desc')->get_where('forum',['archive'=>0,'md5(id)'=>$id])->row_array();
      }
      
      public function forum_category(){
            return  $this->db->order_by('id','desc')->get_where('forum_category',['archive'=>0])->result_array();
      }
      
      public function total_forum(){
            return  $this->db->order_by('id','desc')->get_where('forum',['archive'=>0])->num_rows();
      }
      
      public function total_news(){
            return  $this->db->order_by('id','desc')->get_where('news',['archive'=>0])->num_rows();
      }
      
      public function total_users(){
            return  $this->db->order_by('id','desc')->get_where('users',['archive'=>0,'status'=>1])->num_rows();
      }
      
      public function total_resources(){
            return  $this->db->order_by('id','desc')->get_where('resources',['archive'=>0])->num_rows();
      }
      
      public function forum_answer(){
            return   $this->db->get_where('forum_answer',['archive'=>0])->result_array();
      }
      
      public function getForumAnswer($id){
            return   $this->db->get_where('forum_answer',['md5(forum_id)'=>$id,'archive'=>0])->result_array();
      }
      
      public function editForumCategory($id){
            return   $users = $this->db->get_where('forum_category',['id'=>$id])->row_array();
      }
      
      public function news_category(){
            return   $users = $this->db->order_by('id','desc')->get_where('news_category',['archive'=>0])->result_array();
      }
      
      public function editNewsCategory($id){
            return   $users = $this->db->get_where('news_category',['id'=>$id])->row_array();
      }
      
      
      public function editFaq($id){
            return   $users = $this->db->get_where('faq',['id'=>$id])->row_array();
      }
      
      public function editFaqCategory($id){
            return   $users = $this->db->get_where('faq_category',['id'=>$id])->row_array();
      }
      
      public function resources(){
            return  $this->db->order_by('id','desc')->get_where('resources',['archive'=>0])->result_array();
      }
      
      public function getCategoryResources($category_id,$sub_category){
            return  $this->db->order_by('id','desc')->get_where('resources',['archive'=>0,'md5(category_id)'=>$category_id,'md5(sub_category_id)'=>$sub_category])->result_array();
      }
      
      public function getSubCategoryResources($category_id){
            return  $this->db->select('resources_sub_category.*')->order_by('resources_sub_category.id','asc')->group_by('resources_sub_category.id')
            ->join('resources','resources.sub_category_id=resources_sub_category.id')
            ->get_where('resources_sub_category',['resources.archive'=>0,'md5(resources.category_id)'=>$category_id])->result_array();
      }
      
      public function getCategoryFaq($category_id){
            return  $this->db->order_by('id','desc')->get_where('faq',['archive'=>0,'category_id'=>$category_id])->result_array();
      }
      
      public function getResourcesDetails($id){
            return  $this->db->order_by('id','desc')->get_where('resources',['archive'=>0,'md5(id)'=>$id])->row_array();
      }
      
      public function resources_attachment($id){
            return  $this->db->order_by('id','desc')->get_where('resources_attachment',['archive'=>0,'resources_id'=>$id])->result_array();
      }
      
      public function faq(){
            return  $this->db->order_by('id','desc')->get_where('faq',['archive'=>0])->result_array();
      }
      
      public function faq_category(){
            return  $this->db->order_by('id','desc')->get_where('faq_category',['archive'=>0])->result_array();
      }
      
      public function editResources($id){
            return   $users = $this->db->get_where('resources',['id'=>$id])->row_array();
      }
      
      public function news(){
            return  $this->db->order_by('id','desc')->get_where('news',['archive'=>0])->result_array();
      }
      
      public function subscription_plan(){
            return  $this->db->order_by('id','desc')->get_where('subscription_plan',['archive'=>0])->result_array();
      }
      
      public function subscription_plan_row($id){
            return  $this->db->order_by('id','desc')->get_where('subscription_plan',['archive'=>0,'id'=>$id])->row_array();
      }

      public function getPaginatedNews($limit, $offset){
            $this->db->limit($limit, $offset);
            $this->db->where('archive', 0);
            return $this->db->get('news')->result_array();
      }
      
      public function getNewsCategory($category_id){
            return  $this->db->order_by('id','desc')->get_where('news',['archive'=>0,'category_id'=>$category_id])->result_array();
      }
      
      public function news_details($id){
            return  $this->db->order_by('id','desc')->get_where('news',['archive'=>0,'md5(id)'=>$id])->row_array();
      }
      
      public function news_tags($id){
            return   $this->db->get_where('news_tags',['news_id'=>$id,'archive'=>0])->result_array();
      }
      
      public function news_tags_only(){
            return   $this->db->order_by('id','desc')->group_by('name')->get_where('news_tags',['archive'=>0])->result_array();
      }
      
      public function news_image($id){
            return   $this->db->get_where('news_image',['news_id'=>$id,'archive'=>0])->result_array();
      }
      
      
      
      public function editNews($id){
            return   $users = $this->db->get_where('news',['id'=>$id])->row_array();
      }
      
      public function getServicesDetails($id){
            return   $users = $this->db->get_where('service',['archive'=>0,'id'=>$id])->row_array();
      }
      
      public function verifyUser($username,$password){
            return $this->db
            ->where('archive', 0)
            ->where('password', md5($password))
            ->group_start()
                  ->where('username', $username)
                  ->or_where('email', $username)  // Assuming $username can be either a username or email
            ->group_end()
            ->get('users');
      }

      function calculateElapsedTime($startDateTime){
            date_default_timezone_set("Africa/Nairobi");
            $endDateTime=date('Y-m-d H:i:s');

            
            $startTimestamp = strtotime($startDateTime);
            $endTimestamp = strtotime($endDateTime);

            $elapsedSeconds = $endTimestamp - $startTimestamp;

           

            if ($elapsedSeconds < 60) {
                  return "$elapsedSeconds second" . ($elapsedSeconds > 1 ? 's' : '');
            } elseif ($elapsedSeconds < 3600) {
                  $elapsedMinutes = floor($elapsedSeconds / 60);
                  $remainingSeconds = $elapsedSeconds % 60;
                  return "$elapsedMinutes minute" . ($elapsedMinutes > 1 ? 's' : '') . " and $remainingSeconds second" . ($remainingSeconds > 1 ? 's' : '');
            } elseif ($elapsedSeconds < 86400) {
                  $elapsedHours = floor($elapsedSeconds / 3600);
                  $remainingMinutes = floor(($elapsedSeconds % 3600) / 60);
                  return "$elapsedHours hour" . ($elapsedHours > 1 ? 's' : '') . " and $remainingMinutes minute" . ($remainingMinutes > 1 ? 's' : '');
            } else {
                  $elapsedDays = floor($elapsedSeconds / 86400);
                  $remainingHours = floor(($elapsedSeconds % 86400) / 3600);

                  if ($elapsedDays > 30) {
                        $elapsedMonths = floor($elapsedDays / 30);
                        $remainingDays = $elapsedDays % 30;

                        return "$elapsedMonths month" . ($elapsedMonths > 1 ? 's' : '') . " and $remainingDays day" . ($remainingDays > 1 ? 's' : '');
                  } elseif ($elapsedDays > 365) {
                        $elapsedYears = floor($elapsedDays / 365);
                        $remainingDays = $elapsedDays % 365;

                        return "$elapsedYears year" . ($elapsedYears > 1 ? 's' : '') . " and $remainingDays day" . ($remainingDays > 1 ? 's' : '');
                  }

                  return "$elapsedDays day" . ($elapsedDays > 1 ? 's' : '') . " and $remainingHours hour" . ($remainingHours > 1 ? 's' : '');
            }
      }

      public function chat_options(){
            return   $this->db->get_where('chat',['archive'=>0])->result_array();
      }
      
      public function country(){
            return   $this->db->get_where('country',['archive'=>0])->result_array();
      }


      public function searchText($type,$typeFor,$searchText){
            $searchText=trim($searchText);
            
            if($type=="resources"){
                  if($typeFor=="for_hr"){
                        return $this->db
                        ->where('archive', 0)
                        ->where('for_hr', 1)
                        ->group_start()
                              ->or_like('name', $searchText)  
                        ->group_end()
                        ->get('resources')
                        ->result_array();
			}else if($typeFor=="for_executive"){
                        return $this->db
                        ->where('archive', 0)
                        ->where('for_executive', 1)
                        ->group_start()
                              ->or_like('name', $searchText)  
                        ->group_end()
                        ->get('resources')
                        ->result_array(); 
			}
                  
            }
            
            if($type=="faq"){
                  return $this->db
                        ->where('archive', 0)
                        ->group_start()
                              ->or_like('question', $searchText)  
                        ->group_end()
                        ->get('faq')
                        ->result_array();
            }
            
      }

     
      public function checkSubscription($plan_id){
            $session_id=$this->session->userdata('session_id');
            if($session_id == null){
                  return redirect('login');
            }

            $subscription= $this->db->get_where('subscription',['user_id'=>$session_id,'archive'=>0,'status'=>"Active",'plan_id'=>$plan_id])->row_array();

            if($subscription==null){
                  return redirect('home/unsubscribe');
            }

            return $subscription;
      }
      
      public function checkSubscriptionOnly(){
            $session_id=$this->session->userdata('session_id');
            if($session_id == null){
                  return redirect('login');
            }

            $subscription= $this->db->get_where('subscription',['user_id'=>$session_id,'archive'=>0,'status'=>"Active",])->row_array();

            if($subscription==null){
                  return redirect('home/unsubscribe');
            }

            return $subscription;
      }
}