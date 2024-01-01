<!DOCTYPE html>
<html lang="en">

<?php include 'head.php'?>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-1">
                <a href="<?=site_url('/') ?>" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?=$system['system_name']?></span>
                </a>
                
                
              </div><!-- End Logo -->
             

              <div class="card mb-3">

                <div class="card-body">

                  <div class="card-title  text-center">
                    <h5 class="text-center ">Login </h5>
                    <img class="text-center  " src="<?= base_url($system['system_logo'])?>" width="50px" alt="Icon">
                  </div>

                  <form id="form" class="row g-3 needs-validation"  onsubmit="save(event)">

                  <div class="col-12">
                      <label for="username" class="form-label">Username | Email Address<span style="color:red;">*</span></label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="username" required>
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password <span style="color:red;">*</span></label>
                      <div class="input-group has-validation">
                        <input type="password" name="password" class="form-control" id="password" required>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>


                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="submitBtn">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="<?=site_url('login/signup')?>">Create an account</a></p>
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

    // Check if there are stored credentials and populate the form
    document.addEventListener('DOMContentLoaded', function () {
      const storedUsername = localStorage.getItem('rememberedUsername');
      const storedPassword = localStorage.getItem('rememberedPassword');
      const rememberCheckbox = document.getElementById('rememberMe');
      const usernameInput = document.getElementById('username');
      const passwordInput = document.getElementById('password');

      if (rememberCheckbox && storedUsername && storedPassword) {
        rememberCheckbox.checked = true;
        usernameInput.value = storedUsername;
        passwordInput.value = storedPassword;
      }
    });

    function save(e){
        e.preventDefault();

         // Check if the "Remember Me" checkbox is checked
        const rememberCheckbox = document.getElementById('rememberMe');
        const usernameInput = document.getElementById('username');
        const passwordInput = document.getElementById('password');

        if (rememberCheckbox && rememberCheckbox.checked) {
          // If checked, store the username and password in local storage
          localStorage.setItem('rememberedUsername', usernameInput.value);
          localStorage.setItem('rememberedPassword', passwordInput.value);
        } else {
          // If not checked, remove stored credentials
          localStorage.removeItem('rememberedUsername');
          localStorage.removeItem('rememberedPassword');
        }


        var form=document.getElementById('form');
        var formData = new FormData(form);
        jQuery.ajax({
            type: "POST",
            url: "<?= site_url('login/verifyUser') ?>",
            data:formData,
            dataType:'json',
            processData:false,
            contentType: false,
            cache: false,
            success: function(data) {     
                if (data.status == 1){
                    showSuccessToast("Process finished",data.message);

                    setTimeout(() => {
                      
                      const redirectURL = "<?=base_url('admin')?>";
                      window.location.href = redirectURL;
                    }, 1000);
                    
                }
                else{
                    showWarningToast("Warning",data.message);

                }
            }

        });
    }

  </script>

</body>

</html>