<section class="content">
<?php echo form_open(base_url('save_zip_file'), 'class="form-horizontal" id="file-upload-form" enctype="multipart/form-data"') ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">File Details</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>


                <div class="card-body">
                    <div class="form-group">
                        <label for="inputName">Zip Title</label>
                        <input type="text" id="zip_title" name="zip_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Zip Description</label>
                        <textarea id="zip_description" name="zip_description" class="form-control" rows="4"></textarea>
                    </div>



                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-md-6">
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">File Upload</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="inputClientCompany">Zip File</label>
                        <input type="file" id="zip_file" name="zip_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">Zip Size</label>
                        <input type="text" id="zip_size" name="zip_size" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="inputSpentBudget">Progress</label>
                            <div class="progress progress-sm">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                  </div>
                            </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>


    </div>
    <?php echo form_close(); ?>

    <div class="row">
        <div class="col-12">
            <a href="#" class="btn btn-secondary">Cancel</a>
            <a class="btn btn-success float-right upload-zip">Upload File</a>
        </div>
    </div>
</section>

<script>


$(document).on('click','.upload-zip', function(e){
    e.preventDefault();
    var formData = new FormData($("#file-upload-form")[0]);

    $.ajax({
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete + '%');
                        $(".progress-bar").html(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            type: 'POST',
            url: '<?= base_url() ?>save_zip_file',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $(".progress-bar").width('0%');
            },
            error:function(){
                toastSuccess('error', 'Page has expired, try later !');
            },
            success: function(resp){
                var out = jQuery.parseJSON(resp);
                toastSuccess(out.status, out.msg);
            }
        });
});
    // File type validation
    $(document).on('change','#zip_file', function(){
        var allowedTypes = ['application/x-zip-compressed'];
        var file = this.files[0];
        var fileType = file.type;
        var fileSize = (file.size / 1024 ) / 1024;
        fileSize =  Math.ceil(fileSize);
        fileSize = fileSize + ' MB';

        if(!allowedTypes.includes(fileType)){
            toastSuccess('error', 'Please upload a zip file !');
            $("#fileInput").val('');
            return false;
        }else{
            $("#zip_size").val(fileSize);
            toastSuccess('success', 'File type is a valid type !');
            return true;
        }
    });
</script>