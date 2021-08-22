  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <section class="content"> 
    <!-- For Messages -->
    <?php //$this->load->view('admin/includes/_messages.php') ?>
    <div class="card">
      <div class="card-header">
        <div class="d-inline-block col-md-6">
          <h3 class="card-title"><i class="fa fa-list"></i>&nbsp; 
          Login History</h3>
        </div>
               <div class="d-inline-block col-md-3">
                 <select name="user_type" id="user_type">
                   <option value="">--usertpes--</option>
                 </select>
        </div>
       
      </div>
    </div>
    <div class="card">
      <div class="result card-body table-responsive">
       <table id="na_datatable" class="table table-bordered table-striped" width="100%">
          <thead>
            <tr>
              <th>#</th>      
              <th>Username</th>
              <th>Email</th>
              <th>Usertype</th>
              <th></th>
             
            </tr>
          </thead>
         
        </table>
      </div> 
    </div>
  </section>   

  <!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>

$(document).ready(function(){
    load_json();
});

$(document).on('change','#date_login', function(e){
    $("#na_datatable").dataTable().fnDestroy();
    load_json();
    e.preventDefault();
});


function load_json(){
    var login_date = $('#date_login').val();

  var table = $('#na_datatable').DataTable( {
    "processing": true,
    "serverSide": false,
    "ajax":{
            "type": "GET",
            "url": "<?=base_url('permission_json')?>"
          },
    "responsive": true, "lengthChange": false, "autoWidth": false,
  });
}
  </script>