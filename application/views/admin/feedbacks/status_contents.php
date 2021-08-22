<?php 
foreach($css_files as $file): ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Feedback Status List</h3>
             
            </div>
            <!-- /.card-header -->
            <div class="card-body">
		<?php echo $output; ?>
        </div>
          </div>
        </div>
    </div>
</div>
</section>


<?php foreach($js_files as $file): ?>
        <script src="<?php echo $file; ?>"></script>
    <?php endforeach; ?>
	
