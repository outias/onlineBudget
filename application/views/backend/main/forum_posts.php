
  
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body" style="padding: 3%;">
                <div id="dataView"></div>
            </div>
          </div>
        </div>


      </div>
    </section>


<script>

    $(document).ready(function () {
      forum_posts_view()
    });

    function clear_input(){
       forum_posts_view()
    }
  
    function forum_posts_view(id){

        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/forum_posts_view') ?>",
            data:{id:id},
            success: function(data) {     
                $("#dataView").html(data)
            }

        });
    }
    
   
    
    function changeForumPostStatus(id,status){

      if(status == 2){
        var conf=confirm("Are you sure you want to reject forum post ?")
      }else{
        var conf=confirm("Are you sure you want to approve forum post ?")
      }
      
      if(!conf){
        return
      }

      jQuery.ajax({
          type: "POST",
          url: "<?= site_url('admin/changeForumPostStatus') ?>",
          data:{id:id,status:status},
          dataType:'json',
          
          success: function(data) {     
              if (data.status == 1){
                  showSuccessToast("Process finished",data.message);
                  clear_input()
              }
              else{
                  showWarningToast("Warning",data.message);

              }
          }

      });
    }
  </script>
