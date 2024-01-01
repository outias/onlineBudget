<!DOCTYPE html>
<html lang="en">
<body>
<?php include 'head.php'?>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="<?=site_url('/') ?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?=$system['system_name']?></span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="card-title  text-center">
                  <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    
                    <img class="text-center  " src="<?= base_url($system['system_logo'])?>" width="50px" alt="Icon">
                    <p class="text-center small">To Join your have to enter your personal details to create account </p>
                    <p class="text-end small"><span style="color:red;">*</span> required </p>
                  </div>

                  <form id="form" class="row g-3 needs-validation"  onsubmit="save(event)">

                    <div class="col-6">
                      <label for="first_name" class="form-label">First Name <span style="color:red;">*</span></label>
                      <input type="text" name="first_name" class="form-control" id="first_name" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-6">
                      <label for="last_name" class="form-label">Last Name</label>
                      <input type="text" name="last_name" class="form-control" id="last_name" >
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-md-6">
                      <label for="gender" class="form-label ">Gender <span style="color:red;">*</span></label>
                      <select id="gender" name="gender" class="form-control select2" required >
                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Male">Female</option>
                      </select>
                      <div class="invalid-feedback">Please select your gender</div>
                    </div>

                    <div class="col-md-6">
                      <label for="phone" class="form-label">Phone Number <span style="color:red;">*</span></label>
                      <input type="tel" name="phone" class="form-control" id="phone" required>
                      <div class="invalid-feedback">Please enter a your phone number!</div>
                    </div>
                    
                    <div class="col-12">
                      <label for="email" class="form-label">Email<span style="color:red;">*</span></label>
                      <input type="email" name="email" class="form-control" id="email" required >
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-6">
                      <label for="username" class="form-label">Username <span style="color:red;">*</span></label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-6">
                      <label for="password" class="form-label">Password <span style="color:red;">*</span></label>
                      <div class="input-group has-validation">
                        <input type="password" name="password" class="form-control" id="password" required>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="terms" >
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" id="submitBtn" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="<?=site_url('login')?>">Log in</a></p>
                    </div>
                  </form>

                </div>
              </div>


            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <?php include 'include_bottom.php'?>

  <script>


function save(e){
    e.preventDefault();

    var requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(function(field) {
        if (!field.value.trim()) {
            showWarningToast("Warning",field.getAttribute('name') + ' is required.');
            return;
        }
    });

    var terms = $("#terms").prop("checked");
    if(!terms){
      showWarningToast("Warning","Before submission, You have to agree to our terms and condition");
      return
    }

    disableBtn("submitBtn",true);
    var form=document.getElementById('form');
    var formData = new FormData(form);
    jQuery.ajax({
        type: "POST",
        url: "<?= site_url('login/register') ?>",
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
            $("#submitBtn").val("Create account")
        }

    });
}

</script>

</body>

</html>