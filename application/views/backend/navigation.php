 <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link <?php if($page_name!="dashboard"){?>collapsed <?php }?>" href="<?=site_url('admin')?>">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li>
  

  
    <!-- For admin only -->
    <li class="nav-heading">Resources & Documents</li>

    <?php if($userSession['role']==1){ ?> 
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="resources_category"){?>collapsed <?php }?> " href="<?=site_url('admin/resources_category')?>">
        <i class="bi bi-folder2"></i>
          <span>Category</span>
        </a>
      </li>
      
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="resources_sub_category"){?>collapsed <?php }?> " href="<?=site_url('admin/resources_sub_category')?>">
        <i class="bi bi-folder2"></i>
          <span>Sub-Category</span>
        </a>
      </li>

      <?php } ?>
      
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="resources"){?>collapsed <?php }?> " href="<?=site_url('admin/resources')?>">
        <i class="bi bi-file-text"></i>
          <span>Resources</span>
        </a>
      </li>
      
    <li class="nav-heading">News & Updates</li>

    <?php if($userSession['role']==1){ ?> 
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="news_category"){?>collapsed <?php }?> " href="<?=site_url('admin/news_category')?>">
        <i class="bi bi-newspaper"></i>
          <span>News Category</span>
        </a>
      </li>
      <?php } ?>
      
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="news"){?>collapsed <?php }?> " href="<?=site_url('admin/news')?>">
        <i class="bi bi-journal"></i>
          <span>News</span>
        </a>
      </li>
      
    <li class="nav-heading">Forum</li>

    <?php if($userSession['role']==1){ ?> 
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="forum_category"){?>collapsed <?php }?> " href="<?=site_url('admin/forum_category')?>">
        <i class="bi bi-newspaper"></i>
          <span>Topics</span>
        </a>
      </li>
      <?php  } ?>
      
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="forum_posts"){?>collapsed <?php }?> " href="<?=site_url('admin/forum_posts')?>">
        <i class="bi bi-newspaper"></i>
          <span>Posts</span>
        </a>
      </li>
      
      
    <li class="nav-heading">FAQ</li>

    <?php if($userSession['role']==1){ ?> 
      <li class="nav-item " >
          <a class="nav-link <?php if($page_name!="faq_category"){?>collapsed <?php }?> " href="<?=site_url('admin/faq_category')?>">
          <i class="bi bi-question-square"></i>
            <span>FAQ Category</span>
          </a>
      </li>

      <?php } ?>
      
      <li class="nav-item " >
          <a class="nav-link <?php if($page_name!="faq"){?>collapsed <?php }?> " href="<?=site_url('admin/faq')?>">
          <i class="bi bi-question-square"></i>
            <span>FAQ</span>
          </a>
      </li>
    
    
    <?php if($userSession['role']==1){ ?> 
      <li class="nav-item " >
          <a class="nav-link <?php if($page_name!="vaq"){?>collapsed <?php }?> " href="<?=site_url('admin/vaq')?>">
          <i class="bi bi-question-square"></i>
            <span>VAQ</span>
          </a>
      </li>
    <?php } ?> 
    

      
      <li class="nav-heading">Settings & Configuration</li>

      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="profile"){?>collapsed <?php }?> " href="<?=site_url('admin/profile')?>">
        <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>
      
   


  <?php if($userSession['role']==1){ ?> 
      
      <li class="nav-item " >
        <a class="nav-link <?php if($page_name!="settings"){?>collapsed <?php }?> " href="<?=site_url('admin/settings')?>">
        <i class="bi bi-gear"></i>
          <span>Settings</span>
        </a>
      </li>
      
     
  <?php } ?>

  
</ul>

</aside><!-- End Sidebar-->