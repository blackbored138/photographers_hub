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
              <h3 class="card-title">Users List</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-10">
              <table class="table" id="th_datatable">
                <thead>
                  <tr>
                    <th>ID#</th>
                    <th>Username</th>
                    <th>Client</th>
                  
                    <th></th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>Functional-requirements.docx</td>
                    <td>49.8005 kb</td>
                    <td>49.8005 kb</td>
                    <td>49.8005 kb</td>
                    <td>49.8005 kb</td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" title="View User" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" title="Add Permissions" class="btn btn-warning"><i class="fas fa-cogs"></i></a>
                      </div>
                    </td>
                 
                   
                 

                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          </div>
        </div>
      </div>
    </section>

    <script>
  $(function () {
    $("#th_datatable").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    });
  });
  </script>