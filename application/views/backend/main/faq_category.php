
  
    <section class="section">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body" style="padding: 3%;">
                <div id="dataView"></div>
            </div>
          </div>
        </div>


        <div class="col-lg-4">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Category  </h5>

              <!-- No Labels Form -->
              <form id="form2" class="row g-3" onsubmit="save2(event)">
                <input type="hidden" class="form-control" id="hidden_id" name="hidden_id"  >
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Name<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" required >
                </div>
                
               
                
                <div class="text-center">
                  
                  <button  class="btn btn-danger" id="resetButton" onclick="clear_input()">Reset</button>
                  <button type="submit" class="btn btn-primary" id="submitBtn2">Save Category</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>

          
        </div>
      </div>
    </section>


<script>

    $(document).ready(function () {
      faq_category_view()
    });

    function clear_input(){
       document.getElementById('form2').reset();
       $("#hidden_id").val("")
       $("#submitBtn2").html("Save Category")
       faq_category_view()
    }
  
    function save2(e){
        e.preventDefault();
        disableBtn("submitBtn2",true);

        var form=document.getElementById('form2');
        var formData = new FormData(form);
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/saveFaqCategory') ?>",
            data:formData,
            dataType:'json',
            processData:false,
            contentType: false,
            cache: false,
            success: function(data) {     
                if (data.status == 1){
                    showSuccessToast("Process finished",data.message);
                    clear_input()
                }
                else{
                    showWarningToast("Warning",data.message);

                }

                disableBtn("submitBtn2",false);
            }

        });
    }
    
    function faq_category_view(id){

        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/faq_category_view') ?>",
            data:{id:id},
            success: function(data) {     
                $("#dataView").html(data)
            }

        });
    }
    
    function editFaqCategory(id){

      document.getElementById('form2').reset();
       $("#hidden_id").val("")
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/editFaqCategory') ?>",
            data:{id:id},
            dataType:'json',
            success: function(data) {     
              $("#hidden_id").val(id)
              $("#name").val(data.name)

              $("#submitBtn2").html("Update Category")
            }

        });
    }
    
    function deleteFaqCategory(id){

      var conf=confirm("Are you sure you want to delete FAQ category ?")
      if(!conf){
        return
      }

      jQuery.ajax({
          type: "POST",
          url: "<?= site_url('admin/deleteFaqCategory') ?>",
          data:{id:id},
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
