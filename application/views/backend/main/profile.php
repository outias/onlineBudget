<section class="section profile">
      <div class="row">
      <div class="col-xl-4">

            <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?=base_url($users['image'])?>" alt="Profile" class="rounded-circle">

            <h4><?=$users['first_name']." ".$users['last_name']?></h4>
           
            <h6><?=$users['occupation']?></h6>
            <div class="social-links mt-2">
                  <a href="<?=$users['twitter']?>" class="twitter"><i class="bi bi-twitter"></i></a>
                  <a href="<?=$users['facebook']?>" class="facebook"><i class="bi bi-facebook"></i></a>
                  <a href="<?=$users['instagram']?>" class="instagram"><i class="bi bi-instagram"></i></a>
                  <a href="<?=$users['linkedin']?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
                  <a href="<?=$users['whatsapp']?>" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
            </div>
            </div>
            </div>

      </div>

      <div class="col-xl-8">

            <div class="card">
            <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

                  <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                  </li>

                  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                  </li>

                  <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                  </li> -->

                  <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                  </li>

            </ul>
            <div class="tab-content pt-2">

                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic"><?=$users['about']?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?=$users['first_name']." ".$users['last_name']?></div>
                  </div>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8"><?=$users['company']?></div>
                  </div>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Occupation</div>
                  <div class="col-lg-9 col-md-8"><?=$users['occupation']?></div>
                  </div>

                 

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8"><?=$users['address']?></div>
                  </div>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?=$users['phone']?></div>
                  </div>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?=$users['email']?></div>
                  </div>

                  </div>

                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="form" class="row g-3 needs-validation" onsubmit="save(event)" enctype="multipart/form-data">
                  <input name="hidden_id" type="hidden" class="form-control" id="hidden_id" value="<?=md5($users['id'])?>" required>

                        <div class="row mb-3">
                              <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                              <div class="col-md-8 col-lg-9">
                              <img src="<?=base_url($users['image'])?>" alt="Profile" class="rounded-circle" id="selected_image">

                                    <div class="pt-2">
                                          <input type="file" class="form-control" id="image" name="image"  onchange="loadFile(event)" accept="image/*">
                                    </div>
                              </div>
                        </div>

                  

                  <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="first_name" type="text" class="form-control" id="first_name" value="<?=$users['first_name']?>" required>
                        </div>
                  </div>
                  
                  <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="last_name" type="text" class="form-control" id="last_name" value="<?=$users['last_name']?>" required>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                        <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px"><?=$users['about']?></textarea>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value="<?=$users['company']?>">
                        </div>
                  </div>
                  
                  <div class="row mb-3">
                        <label for="company" class="col-md-4 col-lg-3 col-form-label">Gender</label>
                        <div class="col-md-8 col-lg-9">
                              <select id="gender" name="gender" class="form-control" required >
                                    <option value="<?=$users['gender']?>"><?=$users['gender']?></option>

                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Male">Female</option>
                        </select>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Occupation</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="occupation" type="text" class="form-control" id="occupation" value="<?=$users['occupation']?>" >
                        </div>
                  </div>

                  

                  <div class="row mb-3">
                        <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" class="form-control" id="address" value="<?=$users['address']?>" >
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?=$users['phone']?>" required>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                              <select id="country" name="country" class="form-control" required >

                              <?php $country=$this->home_model->country();
                                if($users['country'] != null){
                              ?>
                                    <option value="<?=$users['country']?>"><?=$this->Global_model->get_table_column_name('country','id',$users['country'],'name') ?></option>

                              <?php } ?>


                              <option value="">Select</option>
                               <?php foreach($country as $co){
                              ?>

                                    <option value="<?=$co['id']?>"><?=$co['name']?></option>

                                    <?php } ?>

                        </select>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="twitter" value="<?=$users['twitter']?>">
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="facebook" value="<?=$users['facebook']?>">
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="instagram" value="<?=$users['instagram']?>">
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="linkedin" value="<?=$users['linkedin']?>">
                        </div>
                  </div>
                  
                  <div class="row mb-3">
                        <label for="whatsapp" class="col-md-4 col-lg-3 col-form-label">Whatsapp Profile</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="whatsapp" type="text" class="form-control" id="whatsapp" value="<?=$users['whatsapp']?>">
                        </div>
                  </div>

                  <div class="text-center">
                        <button type="submit" id="submitBtn" class="btn btn-primary">Update Profile</button>
                  </div>
                  </form><!-- End Profile Edit Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form id="form3" class="row g-3 needs-validation" onsubmit="save3(event)" enctype="multipart/form-data">
                  <input name="hidden_id3" type="hidden" class="form-control" id="hidden_id3" value="<?=md5($users['id'])?>" required>

                  <div class="row mb-3">
                        <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                        <div class="col-md-8 col-lg-9">
                              <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_news_subscribe" name="is_news_subscribe" <?php if($users['is_news_subscribe']==1){ echo 'checked'; } ?>>
                                    <label class="form-check-label" for="changesMade">
                                          Subscribe for News Letter
                                    </label>
                              </div>
                             
                        </div>
                  </div>

                  <div class="text-center">
                        <button type="submit" id="submitBtn3" class="btn btn-primary">Save Settings</button>
                  </div>
                  </form><!-- End settings Form -->

                  </div>

                  <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form id="form2" class="row g-3 needs-validation" onsubmit="save2(event)" enctype="multipart/form-data">
                  <input name="hidden_id2" type="hidden" class="form-control" id="hidden_id2" value="<?=md5($users['id'])?>" required>

                  <div class="row mb-3">
                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="password" required>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newpassword" required>
                        </div>
                  </div>

                  <div class="row mb-3">
                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                        <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                        </div>
                  </div>

                  <div class="text-center">
                        <button type="submit" id="submitBtn2" class="btn btn-primary">Change Password</button>
                  </div>
                  </form><!-- End Change Password Form -->

                  </div>

            </div><!-- End Bordered Tabs -->

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
                  url: "<?= site_url('admin/updateProfile') ?>",
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
                  $("#submitBtn").html("Post ")
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
                  url: "<?= site_url('admin/changePassword') ?>",
                  data:formData,
                  dataType:'json',
                  processData:false,
                  contentType: false,
                  cache: false,
                  success: function(data) {     
                        if (data.status == 1){
                              showSuccessToast("Process finished",data.message);
                              document.getElementById('form2').reset();
                        }
                        else{
                              showWarningToast("Warning",data.message);

                        }

                        disableBtn("submitBtn2",false);
                        $("#submitBtn2").html("Update Password")
                  }

            });
      }
      
      function save3(e){
            e.preventDefault();
            disableBtn("submitBtn3",true);

            var hidden_id3=document.getElementById('hidden_id3').value;
            var is_news_subscribe=document.getElementById('is_news_subscribe').checked;

            if(is_news_subscribe==true){
                  is_news_subscribe=1;
            }else{
                  is_news_subscribe=0;
            }

            var formData = new FormData();
            formData.append('hidden_id3',hidden_id3)
            formData.append('is_news_subscribe',is_news_subscribe)

            jQuery.ajax({
                  type: "POST",
                  url: "<?= site_url('admin/updateUserSettings') ?>",
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
                        $("#submitBtn3").html("Save Settings")
                  }

            });
      }
</script>