<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/toggle.css">

  <section class="content"> 
    <!-- For Messages -->
    <?php //$this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block col-md-6">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; 
          Module Allocation</h3>
        </div>
            
      </div>
    </div>
    <div class="card">
      <div class="result card-body table-responsive">
     
      <table class="table table-hover" id="datatable">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col">Module</th>
                        <th scope="col">Access</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      
                    <?php foreach($menusList as $menuLists):  ?>
                        <tr>

                      <td><?= $menuLists->module_name ?></td>
                      
                      <?php 
                      $module_id = magicfunction($menuLists->module_id,'e');
                      $menusAccess = $this->M_permissions->list_modules_access($module_id,$user_id);

                      $toggle_status = '';
                      if(!empty($menusAccess))
                        $toggle_status = ($menusAccess->status == 1) ? 'checked': '';
                      ?>
                      <td>
                        <label class="switch">
                            <input class="check-box-status" data-action="add" data-id="<?= magicfunction($menuLists->module_id,'e') ?>" type="checkbox" <?=$toggle_status ?>>
                            <span class="slider round"></span>
                          </label>
                     </td>
                   
                    
                     

                        </tr>

                        <?php endforeach; ?>
                    </tbody>
                  </table>

                  <input type="hidden" value="<?=$user_id ?>" id="user_id">
      </div> 
    </div>
  </section>   

<script>
   $('.check-box-status').on('change', function(){
       var this_option = $($(this));
        var module_id = $(this).attr('data-id');
        var user_id = $('#user_id').val();
        var status = (this.checked) ? '1' : '0';
        var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
          csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
          
          var access_xhr = $.post('<?= base_url('change_module_permission'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
      module_id: module_id,user_id: user_id,status: status
    })

    access_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      $(this_option).notify(
        out.msg, {
          className: out.status,
          position: "bottom"
        }
      );
    });

    access_xhr.fail(function() {
      alert("there seems to be some problem");
    });
  
    });
  </script>