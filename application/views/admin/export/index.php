  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- Content Wrapper. Contains page content -->
    <section class="content">
        <div class="card">
            <div class="card-body">

                <div class="card-header">

                    <div class="d-inline-block float-right">
                        <a href="<?= base_url('admin/export/dbexport'); ?>" title="Download Full Database Zip" class="btn btn-success float-right"><i class="fa fa-download"></i> &nbsp; Download Database</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped ">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Tables</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                $color_flag = 'danger';
                                foreach ($tables as $table) :
                                    $flag = rand(0, 2000) % 6;
                                    switch ($flag) {
                                        case 1:
                                            $color_flag = 'success';
                                            break;
                                        case 2:
                                            $color_flag = 'primary';
                                            break;
                                        case 3:
                                            $color_flag = 'danger';
                                            break;
                                        case 4:
                                            $color_flag = 'info';
                                            break;
                                        case 5:
                                            $color_flag = 'warning';
                                            break;
                                        default:
                                            $color_flag = 'danger';
                                            break;
                                    }
                                ?>
                                    <tr>
                                        <td><?= ++$i; ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a title="Download Table Zip" href="<?= base_url('admin/export/tbexport/') . $table; ?>" class="btn btn-<?= $color_flag ?> btn-sm"><?= $table .'.zip' ?></a>
                                                <a title="Download Table Zip" href="<?= base_url('admin/export/tbexport/') . $table; ?>" class="btn btn-<?= $color_flag ?> btn-sm">

                                                    <i class="fa fa-download"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>

    </section>

</div>
</section>
</div>

<script>
    $("#export").addClass('active');
</script>


  <!-- DataTables  & Plugins -->
  <script src="<?= base_url() ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>

<script>
    $(function() {
        $("#example1").DataTable();
    });
</script>