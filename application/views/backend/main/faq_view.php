<?php
$session_id=$this->session->userdata('session_id');
$userSession=$this->home_model->users($session_id);

?>
<div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover "  cellspacing="0" width="100%" id="example">
                      <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Category</th>
                              <th>Question</th>

                              <?php if($userSession['role']==1){ ?> 
                              <th>Action</th>
                              <?php } ?>
                          </tr>
                      </thead>
                      <tbody>

                      <?php $n=1; 
                      $data=$this->home_model->faq();
                      foreach($data as $mau){ ?>
                          <tr>
                              <td><?=$n?></td>
                              <td>
                                
                              <?=$this->Global_model->get_table_column_name('faq_category','id',$mau['category_id'],'name') ?></td>
                              <td>
                              <a href="<?=base_url('home/faq/'.$mau['category_id'])?>" >
                                        <?=$mau['question']?>
                                </a>
                            </td>
                              
                              <?php if($userSession['role']==1){ ?> 
                              <td>

                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                         
                                    

                                          <button type="button" title="Edit Action"  onclick="editFaq('<?=$mau['id']?>')" class="btn btn-outline-primary">
                                          <i class="fa fa-edit text-success"></i></button>

                                          <button type="button" title="Delete Action" onclick="deleteFaq(<?=$mau['id']?>)" class="btn btn-outline-danger ">
                                          <i class="fa fa-trash text-danger"></i></button>

                                    </div>

                                    </td>
                                    <?php } ?>
                          </tr>
                          <?php $n++;} ?>
                      </tbody>
                  </table>
              </div>

<script>
      $(document).ready(function () {
            $('#example').DataTable();
      });
</script>