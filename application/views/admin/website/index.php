  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- DataTables  & Plugins -->
<script src="<?=base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>


<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
<div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Website Details</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            
            <?php $this->load->view('messages/_auth.php') ?>

            <?php echo form_open($form_url, 'class="form-horizontal" enctype="multipart/form-data"' )?> 

            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Website Name</label>
                <input type="text" value="<?= (empty($website_detail))?'':$website_detail->website_name; ?>" id="inputName" name="website_name" placeholder="Website name" class="form-control rounded-0">
              </div>
             
              <div class="form-group">
                <label for="inputName">Website Url</label>
                <input type="text" value="<?= (empty($website_detail))?'':$website_detail->website_url; ?>" id="inputName" name="website_url" placeholder="Website url" class="form-control rounded-0">
              </div>
             
              <div class="form-group">
                <label for="inputName">Website Theme</label>
                <select name="website_theme" class="custom-select rounded-0">
                  <?php foreach($website_theme as $themes): ?>
                    <option <?= (!empty($website_detail) && ($themes->theme_id == $website_detail->website_theme) )?'selected':''; ?> value="<?= magicfunction($themes->theme_id,'e') ?>"><?= $themes->theme_name ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
             

              <div class="form-group">
                    <label for="exampleInputFile">Website Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="website_logo" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-danger">Remove</button>
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="exampleInputFile">Website Favicon</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="website_favicon" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <button class="btn btn-sm btn-danger">Remove</button>
                      </div>
                    </div>
                  </div>

            </div>      
            
            <div class="card-footer">
              <?php if(!empty($website_detail)): ?>
              <input type="hidden" name="website_id" value="<?= magicfunction($website_detail->client_id,'e')  ?>">
              <?php endif; ?>
                  <button type="submit" class="btn btn-primary"><?= (empty($website_detail)) ? 'Add Details' :'Update Details'; ?></button>
                </div>
                <?php echo form_close(); ?>

            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
      </div>
    </section>
