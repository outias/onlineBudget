
<section class="section">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">
            <div class="card-body" style="padding: 3%;">
                <div id="dataView"></div>
            </div>
          </div>
        </div>

        <?php if($userSession['role']==1){ ?> 
        <div class="col-lg-4">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Questions  </h5>

              <!-- No Labels Form -->
              <form id="form2" class="row g-3" onsubmit="save2(event)">
                <input type="hidden" class="form-control" id="hidden_id" name="hidden_id"  >
                

                <div class="col-md-12">
                  <label  class="form-label">Category<span style="color:red;">*</span></label>
                    <select class="form-control" id="category_id" name="category_id" required >
                      <option>Select </option>

                      <?php
                        $faq_category=$this->home_model->faq_category();
                        foreach($faq_category as $mau){ ?>
                          <option value="<?=$mau['id']?>"><?=$mau['name'] ?> </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Question<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="question" name="question" required >
                </div>
                
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">Answer<span style="color:red;">*</span></label>
                    <div class="quill-editor-default" id="answer">
                    </div>
                   
                </div>
                
               
                
                <div class="text-center">
                <br>
                    <br> <br>
                    <br> <br>
                    <br>
                  <button  class="btn btn-danger" id="resetButton" onclick="clear_input()">Reset</button>
                  <button type="submit" class="btn btn-primary" id="submitBtn2">Save </button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>

          
        </div>

        <?php } ?>
      </div>
</section>


<script>

    $(document).ready(function () {
      faq_view();
      
    });

    function clear_input(){
       document.getElementById('form2').reset();
       $("#hidden_id").val("")
       $("#answer").html("")
       $("#submitBtn2").html("Save ")
       faq_view();
    }
  
    function save2(e){
        e.preventDefault();
        disableBtn("submitBtn2",true);

        var answer=document.getElementById('answer').innerHTML;

        var form=document.getElementById('form2');
        var formData = new FormData(form);
        formData.append('answer',answer);

        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/saveFaq') ?>",
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
    
    function faq_view(id){

        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/faq_view') ?>",
            data:{id:id},
            success: function(data) {     
                $("#dataView").html(data)
            }

        });
    }
    
    function editFaq(id){

      
      document.getElementById('form2').reset();
       $("#hidden_id").val("")
       $("#answer").html("")
      

        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/editFaq') ?>",
            data:{id:id},
            dataType:'json',
            success: function(data) {     
              $("#hidden_id").val(id)
              $("#category_id").val(data.category_id).change()
              $("#question").val(data.question)
              $('#answer').html(data.answer);

              $("#submitBtn2").html("Update ")
            }

        });
    }
    
    function deleteFaq(id){

      var conf=confirm("Are you sure you want to delete a question ?")
      if(!conf){
        return
      }

      jQuery.ajax({
          type: "POST",
          url: "<?= site_url('admin/deleteFaq') ?>",
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
