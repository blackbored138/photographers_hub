<link rel="stylesheet" href="<?= base_url() ?>assets/admin/croppie/croppie.css" />
<script src="<?= base_url() ?>assets/admin/croppie/croppie.js"></script>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
              <div id="upload-demo"></div>
              <img class="profile-user-img img-fluid img-circle" id="profile_image" src="<?= base_url().'uploads/users/profile_images/'. ss('user_photo') ?>" alt="User profile picture">
            </div>
            <?php echo form_open(base_url('profile_image_store'), 'class="form-horizontal" id="profile-page" enctype="multipart/form-data"') ?>
            <?php echo form_close(); ?>

            <p class="text-muted text-center"><?= ss('user_name') ?></p>

            <input type="file" name="upload" class="form-control" id="upload" accept="image/*">

            <h3 class="profile-username text-center">
              <a class="btn btn-sm btn-default" id="upload-profile-image">Upload <i class="fas fa-upload btn-outline-primary"></i><a>
                  <a class="btn btn-sm btn-danger" id="remove-profile-image">Clear <i class="fa fa-times"></i></a>
            </h3>


            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Login IP</b> <a class="float-right"><?= $this->input->ip_address() ?></a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right"><?= ss('user_email') ?></a>
              </li>
              <li class="list-group-item">
                <b>Mobile</b> <a class="float-right"><?= ss('user_mobile') ?></a>
              </li>
            </ul>

          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->


      </div>
      <!-- /.col -->
      <div class="col-md-9">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#user_details" data-toggle="tab">User details</a></li>
              <li class="nav-item"><a class="nav-link" href="#login_history" data-toggle="tab">Login History</a></li>
              <li class="nav-item"><a class="nav-link" href="#change_password" data-toggle="tab">Password</a></li>
              <li class="nav-item"><a class="nav-link" href="#users" data-toggle="tab">Users</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="user_details">

                <?php $this->load->view('messages/_auth.php') ?>

                <?php echo form_open(base_url('update_profile'), 'class="form-horizontal" id="user-details-form" enctype="multipart/form-data"') ?>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" name="user_name" value="<?= ss('user_name') ?>" class="form-control" id="inputName" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" name="user_email" value="<?= ss('user_email') ?>" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Mobile</label>
                  <div class="col-sm-10">
                    <input type="text" name="user_mobile" value="<?= ss('user_mobile') ?>" class="form-control" id="inputName2" placeholder="Mobile">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="user_password" class="form-control" id="inputName2" placeholder="Password">
                  </div>
                </div>


                <?php echo form_close(); ?>

                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger change-user-details">Submit</button>
                  </div>
                </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="login_history">
                <!-- The timeline -->
                <div class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <div class="time-label">
                    <span class="bg-danger">
                      10 Feb. 2014
                    </span>
                    <a href="<?= base_url() ?>list_logs" class="btn btn-sm btn-secondary float-right">See history <i class="far fa-clock bg-gray"></i>
                    </a>

                  </div>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <div class="log_histories">
                    <i class="fas fa-envelope bg-primary"></i>
                    <div class="timeline-item">

                      <span class="time"><i class="far fa-clock"></i><a class="login_time"></a></span>
                      <h3 class="timeline-header"><a class="login_os"></a> through <span class="login_device"> </span> by <span class="login_browser"> </span> from <span class="login_ip"></h3>
                    </div>
                  </div>

                  <!-- END timeline item -->

                  <div>
                    <i class="far fa-clock bg-gray"></i>

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="change_password">
                <?php $this->load->view('messages/_auth.php') ?>

                <?php echo form_open(base_url('change_password'), 'class="form-horizontal" id="user-password-form" enctype="multipart/form-data"') ?>

                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="old_password" class="form-control" id="inputName" placeholder="Old Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">New Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="new_password" class="form-control" id="inputEmail" placeholder="New Password">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Retype Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="retyped_password" class="form-control" id="inputName2" placeholder="Retype Password">
                  </div>
                </div>

                <?php echo form_close(); ?>


                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-outline btn-primary change-password">Change Password</button>
                  </div>
                </div>

              </div>


              <div class="tab-pane" id="users">
                <!-- Post -->
                <div class="post clearfix">
                  <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                    <span class="username">
                      <a href="#">Sarah Ross</a>
                      <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                    </span>
                    <span class="description">Sent you a message - 3 days ago</span>
                  </div>
                  <!-- /.user-block -->



                </div>

              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>

<script>
  getloginHistory();
  var user_details_url = '<?= base_url('update_profile'); ?>';
  var login_history_url = '<?= base_url('login_history'); ?>';
  var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
  var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';


  $(document).on('click', '.change-user-details', function() {
    changeUserdetails($(this));
  });

  function changeUserdetails(this_elem) {
    loading_btn(this_elem);
    var formData = new FormData($("#user-details-form")[0]);

    var userdetails_xhr = $.ajax({
      url: '<?= base_url('update_profile'); ?>',
      data: formData,
      type: 'POST',
      contentType: false,
      processData: false
    })

    userdetails_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      toastSuccess(out.status, out.msg);
      loading_btn();
    });

    userdetails_xhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');
      loading_btn();
    });
  }


  $(document).on('click', '.change-password', function() {
    changePassworddetails($(this));
  });

  function changePassworddetails(this_elem) {
    loading_btn(this_elem);
    var formData = new FormData($("#user-password-form")[0]);

    var userpswrd_xhr = $.ajax({
      url: '<?= base_url('change_password'); ?>',
      data: formData,
      type: 'POST',
      contentType: false,
      processData: false
    })

    userpswrd_xhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      toastSuccess(out.status, out.msg);
      loading_btn();
    });

    userpswrd_xhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');
      loading_btn();
    });
  }


  function getloginHistory() {
    var logxhr = $.post('<?= base_url('login_history'); ?>', {
      '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
    })

    logxhr.done(function(data) {
      var out = jQuery.parseJSON(data);
      appendlogHistory(out.logs, out.length);
    });

    logxhr.fail(function() {
      toastSuccess('error', 'Page has expired, try later !');

    });

  }



  function appendlogHistory(logs, length) {
    for (i = 0; i < length - 1; i++) {
      var elem = document.querySelector('.log_histories');
      var clone = elem.cloneNode(true);
      elem.after(clone);
    }

    var login_browser = document.getElementsByClassName("login_browser");
    var login_os = document.getElementsByClassName("login_os");
    var login_device = document.getElementsByClassName("login_device");
    var login_ip = document.getElementsByClassName("login_ip");
    var login_time = document.getElementsByClassName("login_time");

    for (i = 0; i < length; i++) {
      login_browser[i].innerHTML = logs[i].login_browser;
      login_os[i].innerHTML = logs[i].login_os;
      login_device[i].innerHTML = logs[i].login_device;
      login_ip[i].innerHTML = logs[i].login_ip;
      login_time[i].innerHTML = logs[i].time;

    }

  }
</script>


<script>
  //1920 * 902
  $('#upload').on('change', function() {

    $('#profile_image').hide();
    $('#upload-demo').croppie('destroy');
    $uploadCrop = $('#upload-demo').croppie({
      enableExif: true,
      boundary: {
        width: 130,
        height: 130
      },
      viewport: {
        width: 128,
        height: 128,
        type: 'circle'
      }
    });

    var reader = new FileReader();
    reader.onload = function(e) {
      $uploadCrop.croppie('bind', {
        url: e.target.result
      }).then(function() {
        $('.upload-result').show();
        console.log('jQuery bind complete');
        $('#upload-profile-image-form').val(e.target.result);
        $('#upload_status_msg').html('Click on Upload to save');
        $('#upload_status_msg').css('color', '#28a745');

      });

    }
    reader.readAsDataURL(this.files[0]);

  });



  $('#remove-profile-image').click(function(event) {
    $('#upload-demo').croppie('destroy');
    $('#profile_image').show();
    $('#profile-page')[0].reset();
    $('#upload_status_msg').html('Profile Photo removed');
    $('#upload_status_msg').css('color', '#dc3545');


  });

  $('#upload-profile-image').click(function(event) {
    var this_btn_elem = $($(('#upload-profile-image')));
    loading_btn(this_btn_elem);


    if (typeof $uploadCrop == 'undefined') {
      $('#upload-profile-image').show();
      $('#upload_status_msg').html('Please select an image');
      $('#upload_status_msg').css('color', '#dc3545');
      loading_btn();
      return;
    }
    $uploadCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'

    }).then(function(response) {
      var formData = new FormData($("#profile-page")[0]);
      formData.append('photo', response);

      var profilepic_xhr = $.ajax({
        url: 'profile_image_store',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false
      })

      profilepic_xhr.done(function(data) {
        loading_btn();

        var out = jQuery.parseJSON(data);
        toastSuccess(out.status, out.msg);
        $('#profile-page')[0].reset();
        $('#upload-demo').croppie('destroy');
        $('#upload-profile-image').show();
        $('#profile_image').show();
        $('#profile_image').attr('src', response);
      });

      profilepic_xhr.fail(function() {
        toastSuccess('error', 'Page has expired, try later !');
        loading_btn();

      });
    });
  });
</script>