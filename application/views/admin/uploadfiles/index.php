  <!-- DataTables -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <!-- DataTables  & Plugins -->
<script src="<?=base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

    <section class="content">

<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Projects</h3>

    <a href="<?= base_url() ?>add_file_upload">Add Files</a>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
        <i class="fas fa-minus"></i>
      </button>
   
    </div>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped projects" id="na_datatable">
        <thead>
            <tr>
                <th> # </th>
                <th> Project Name </th>
                <th> Team Members </th>
                <th> Project Progress </th>
                <th> Status </th>
                <th> Actions </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    #
                </td>
                <td>
                    <a>
                        AdminLTE v3
                    </a>
                    <br/>
                    <small>
                        Created 01.01.2019
                    </small>
                </td>
                <td>
                    files
                </td>
                <td class="project_progress">
                    <div class="progress progress-sm">
                        <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: 57%">
                        </div>
                    </div>
                    <small>
                        57% Complete
                    </small>
                </td>
                <td class="project-state">
                    <span class="badge badge-success">Success</span>
                </td>
                <td class="project-actions text-right">
                   
                    <div class="btn-group btn-group-sm">
                    <a class="btn btn-primary btn-sm" href="<?= base_url() ?>file_details">
                        <i class="fas fa-folder">
                        </i>
                        Files
                    </a>
                        <a href="<?= base_url() ?>view_uploaded_images" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i>Delete</a>
                      </div>
                </td>
            </tr>
            
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>


<script>
     var table = $('#na_datatable').DataTable( {
   
    "responsive": true, "lengthChange": false, "autoWidth": false,
  });

</script>