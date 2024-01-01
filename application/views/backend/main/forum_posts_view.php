<?php
$session_id=$this->session->userdata('session_id');
$userSession=$this->home_model->users($session_id);

?>
<div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover "  cellspacing="0" width="100%" id="example">
                      <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Topic</th>
                              <th>Question</th>

                              <?php if($userSession['role']==1){ ?> 
                              <th>Status</th>
                              <th>Action</th>
                              <?php } ?>
                          </tr>
                      </thead>
                      <tbody>

                      <?php $n=1; 
                      $forum=$this->home_model->forum("All","All","All"); // all 
                      foreach($forum as $docu){ ?>
                          <tr>
                              <td><?=$n?></td>
                              <td>
                                <?=$this->Global_model->get_table_column_name('forum_category','id',$docu['topic'],'name');?>
                                </td>
                              <td>
                              <a href="<?=site_url('home/forum_questions_details/'.md5($docu['id']))?>" style="cursor:pointer;" target="_blank" >  
                              <?=substr($docu['question'],0,25)."..."?> </a>
                            </td>

                            <?php if($userSession['role']==1){ ?> 
                              <td>
                                <?php if($docu['status'] ==1){?>
                                    <span style="color:black;background-color:yellow;padding:5px;">Pending</span>
                                <?php }if($docu['status'] ==2){?>
                                    <span style="color:white;background-color:red;padding:5px;">Rejected</span>
                                <?php }if($docu['status'] ==3){?>
                                    <span style="color:white;background-color:green;padding:5px;">Approved</span>
                                <?php }?>
                              </td>

                              <td>
                                    <button class="btn btn-primary" onclick="changeForumPostStatus('<?=$docu['id']?>',3)">Approve</button> 
                                    <button class="btn btn-danger" onclick="changeForumPostStatus('<?=$docu['id']?>',2)">Reject</button>
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