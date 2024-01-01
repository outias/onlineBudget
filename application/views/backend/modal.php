<style>
	.modal_dialog, .modal_content {
  height: 100%;
}

.modal_body {
  max-height: calc(100% - 120px);;
  overflow-y: scroll;
}
</style>
<div class="modal fade" id="attachment_modal" tabindex="-1">
      <div class="modal-dialog modal-lg">
            <div class="modal-content">
                  <div class="modal-header">
                        <h5 class="modal-title">New News | Updates</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="pdf_viewer">

                  </div>
			<div class="modal-footer">
				
				<button type="button" class="btn btn-secondary "  onclick="dismis_modal()" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
<!-- ATTACHMENT MODAL -->

<script>
      function pdf_viewer(src){
            $("#pdf_viewer").html('<iframe src="'+src+'" style="width:100%; height:100%;" frameborder="0"></iframe>');
            $("#attachment_modal").show();
      }
      
      function dismis_modal(){
            $("#attachment_modal").hide();
      }

       
</script>