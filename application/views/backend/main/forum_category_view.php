<div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover "  cellspacing="0" width="100%" id="example">
                      <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Name</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>

                      <?php $n=1; 
                      $data=$this->home_model->forum_category();
                      foreach($data as $mau){ ?>
                          <tr>
                              <td><?=$n?></td>
                              <td><?=$mau['name']?></td>

                              <td>
                                    <button class="btn btn-primary" onclick="editForumCategory('<?=$mau['id']?>')">Edit</button> 
                                    <button class="btn btn-danger" onclick="deleteForumCategory('<?=$mau['id']?>')">Delete</button>
                              </td>
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