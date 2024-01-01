
  
    <section class="section">
      <div class="row">
        <div class="col-lg-7">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Contact Details</h5>

              <!-- Multi Columns Form -->
              <form id="form"class="row g-3" onsubmit="save(event)">
               
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email<span style="color:red;">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required value="<?=$contact['email']?>">
                </div>
                 <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Phone number<span style="color:red;">*</span></label>
                  <input type="tel" class="form-control" id="phone" name="phone" required value="<?=$contact['phone']?>">
                </div>
                
                <div class="col-12">
                  <label for="inputAddress5" class="form-label">Address<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="address" name="address" required value="<?=$contact['address']?>">
                </div>
                <div class="col-12">
                  <label for="inputAddress2" class="form-label">Address 2</label>
                  <input type="text" class="form-control" id="address2"  name="address2" value="<?=$contact['address2']?>">
                </div>
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Country<span style="color:red;">*</span></label>
                  
               
                <select id="country" name="country" class="form-control" required >

                      <?php $country=$this->home_model->country();
                        if($contact['country'] != null){
                      ?>
                            <option value="<?=$contact['country']?>"><?=$this->Global_model->get_table_column_name('country','id',$contact['country'],'name') ?></option>

                      <?php } ?>


                      <option value="">Select</option>
                               <?php foreach($country as $co){ ?>

                            <option value="<?=$co['id']?>"><?=$co['name']?></option>

                            <?php } ?>

                  </select>
                  </div>
                
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">City<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="city" name="city" value="<?=$contact['city']?>">
                </div>
              
               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="submitBtn">Save Contacts</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>
          
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Social Media <Link:import></Link:import></h5>

              <!-- Multi Columns Form -->
              <form id="form3"class="row g-3" onsubmit="save3(event)">
               
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Whatsapp<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="whatsapp" name="whatsapp" required value="<?=$contact['whatsapp']?>">
                </div>
                 <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Instagram<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="instagram" name="instagram" required value="<?=$contact['instagram']?>">
                </div>
                
              
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Linkedin</label>
                  <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?=$contact['linkedin']?>">
                </div>
                
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Facebook</label>
                  <input type="text" class="form-control" id="facebook" name="facebook" value="<?=$contact['facebook']?>">
                </div>
                
                <div class="col-md-6">
                  <label for="inputCity" class="form-label">Youtube</label>
                  <input type="text" class="form-control" id="youtube" name="youtube" value="<?=$contact['youtube']?>">
                </div>
              
               
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="submitBtn3">Save Social Media</button>
                </div>
              </form><!-- End Multi Columns Form -->

            </div>
          </div>

        </div>


        <div class="col-lg-5">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">System Settings </h5>

              <!-- No Labels Form -->
              <form id="form2" class="row g-3" onsubmit="save2(event)">
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">System Name<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="system_name" name="system_name" required value="<?=$system['system_name']?>">
                </div>
                
                <div class="col-md-12">
                  <label for="inputName5" class="form-label">System UserName<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" id="system_username" name="system_username" required value="<?=$system['system_username']?>">
                </div>
                
                <br>
                <br>
                <br>
                <div class="col-md-12 text-center">
                  <label for="inputName5" class="form-label">System Logo<span style="color:red;">*</span></label>
                  <br>
                  
                  <img id="selected_image" src="<?=base_url($system['system_logo'])?>" alt="" width="100px" height="100px"  />

                  <br>
                  <br>
                  <input type="file" class="form-control" id="system_logo" name="system_logo" accept="image/*"  required onchange="loadFile(event)">
			
                </div>
                
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="submitBtn2">Save Settings</button>
                </div>
              </form><!-- End No Labels Form -->

            </div>
          </div>

          
        </div>
      </div>
    </section>


    <script>


var loadFile = function(event) {
            var selected_image = document.getElementById('selected_image');
            selected_image.src = URL.createObjectURL(event.target.files[0]);
            selected_image.onload = function() {
                  URL.revokeObjectURL(selected_image.src) // free memory
            }
      };
    function save(e){
        e.preventDefault();
        disableBtn("submitBtn",true);

        var form=document.getElementById('form');
        var formData = new FormData(form);
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/saveContact') ?>",
            data:formData,
            dataType:'json',
            processData:false,
            contentType: false,
            cache: false,
            success: function(data) {     
                if (data.status == 1){
                    showSuccessToast("Process finished",data.message);
                    
                }
                else{
                    showWarningToast("Warning",data.message);

                }

                disableBtn("submitBtn",false);
            }

        });
    }
    
    function save2(e){
        e.preventDefault();
        disableBtn("submitBtn2",true);

        var form=document.getElementById('form2');
        var formData = new FormData(form);
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/saveSystem') ?>",
            data:formData,
            dataType:'json',
            processData:false,
            contentType: false,
            cache: false,
            success: function(data) {     
                if (data.status == 1){
                    showSuccessToast("Process finished",data.message);
                    
                }
                else{
                    showWarningToast("Warning",data.message);

                }

                disableBtn("submitBtn2",false);
            }

        });
    }
    
    function save3(e){
        e.preventDefault();
        disableBtn("submitBtn3",true);

        var form=document.getElementById('form3');
        var formData = new FormData(form);
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('admin/saveSocialMedia') ?>",
            data:formData,
            dataType:'json',
            processData:false,
            contentType: false,
            cache: false,
            success: function(data) {     
                if (data.status == 1){
                    showSuccessToast("Process finished",data.message);
                    
                }
                else{
                    showWarningToast("Warning",data.message);

                }

                disableBtn("submitBtn3",false);
            }

        });
    }

  </script>
