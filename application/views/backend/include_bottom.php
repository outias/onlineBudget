  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  
  <!-- Vendor JS Files -->
  <script src="<?=base_url('assets/assets/vendor/apexcharts/apexcharts.min.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/chart.js/chart.umd.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/echarts/echarts.min.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/quill/quill.min.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/simple-datatables/simple-datatables.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/tinymce/tinymce.min.js')?>"></script>
  <script src="<?=base_url('assets/assets/vendor/php-email-form/validate.js')?>"></script>
  <script src="<?=base_url('assets/assets/js/main.js')?>"></script>

  <script src=<?php echo base_url("assets/summernote/summernote.min.js")?>></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<script type="text/javascript">
      function showWarningToast(title,message){
            Swal.fire({
					icon: 'warning',
					title: title,
					text: message,
					showConfirmButton: true,
					timer: 5000
				});
      }
      
      function showSuccessToast(title,message){
            Swal.fire({
					icon: 'success',
					title: title,
					text: message,
					showConfirmButton: false,
					timer: 6000
				});
      }
      
      function showErrorToast(title,message){
            Swal.fire({
					icon: 'error',
					title: title,
					text: message,
					showConfirmButton: true,
					timer: 10000
				});
      }

      function disableBtn(btn,access){

            if(access){
                $('#'+btn).prop("disabled", true);
                // add spinner to button
                $('#'+btn).html(
                    `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`
                );
            }else{
                $('#'+btn).prop("disabled", false);
                // add spinner to button
                $('#'+btn).html("Save")
            }

     }

     function removeSpecialCharacter(text){
        var sanitizedValue = text.replace(/[!@#$%^&*()\-_=+\[\]{}|\\;:'",.<>\/?]/g, "");
        return sanitizedValue
     }

    function showFlashMessage(message) {
		var flashMessage = document.getElementById('flash-message');
		var messageElement = flashMessage.querySelector('.flashmessage');
		
		messageElement.innerText = message;
		flashMessage.style.display = 'block';

		var secondsLeft = 10;
		var countdown = setInterval(function() {
		secondsLeft--;

		if (secondsLeft >= 0) {
			messageElement.innerText = message + ' (' + secondsLeft + 's)';
		} else {
			clearInterval(countdown);
			flashMessage.style.display = 'none';
		}
		}, 1000);
	}

	$(document).ready(function($) {
        //  $('select:not(.normal)').each(function () {
        //     $(this).select2({
        //         dropdownParent: $(this).parent(),
        //         width : '100%'
        //     });
        // });
       
        $(".select2").select2();


            $('.datatable').DataTable({
                "order": [[ 0, "Desc" ]],
                scrollY:500,
                ordering: true,
                scrollCollapse: true,
                paging:         true,
                dom: 'Bflrtip',
                buttons: [
                    {
                        extend: 'copy',
                        text: 'Copy'
                    },
                    'excel',
                    'pdf',
                    'csv'
                ]
            })
        });
</script>

