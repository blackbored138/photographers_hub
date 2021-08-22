<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?=base_url() ?>assets/admin/dist/css/adminstyle.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <?php $this->load->view('messages/_auth.php') ?>

      <?php echo form_open(base_url('save_registration'), 'class="login-form" id="register-form" autocomplete="off" '); ?>
        
        <div class="row">
        <div class="input-group mb-3 col-md-4">
          <input type="text" class="form-control" name="full_name" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3 col-md-4">
          <input type="email" class="form-control" name="user_email" id="user_email"  placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>       
        
        <div class="input-group mb-3 col-md-4">
          <input type="text" class="form-control" name="user_mobile"  id="user_mobile" onkeypress="javascript:return isNumber(event)" placeholder="Mobile">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>       
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_site_name" id="user_site_name" placeholder="Site name user">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control" name="user_password" id="user_password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="user_retyped_password" id="user_retyped_password" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

<div class="row">
<div class="col-md-6">
        <div class="input-group mb-3 change-captcha">
             <?php echo $captchaimage; ?>
        </div>

        <center><i id="loader" class="fa fa-gear fa-spin" style="font-size:24px; color: #007bff; display: none;"></i></center>
          <h6 style="font-size: 0.8rem;">Click on the image to change captcha</h6>
</div>

        <div class="input-group mb-3 col-md-6">
          <input type="text" class="form-control" name="user_captcha" placeholder="Captcha">
      
        </div> 

</div>

        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-12">
          <button type="submit" id="register" class="btn btn-primary btn-block">Register &nbsp; <i class="fas fa-sign-in-alt"></i></button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

      
      <a href="<?=base_url('login') ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?=base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
<script src="<?=base_url() ?>assets/admin/notifyjs/dist/notify.js"></script>


<script>
  var captcha_url = '<?php echo base_url('change_captcha'); ?>';
  var register_verify_url = '<?php echo base_url('validate_registration'); ?>';
  var save_registration_url = '<?php echo base_url('save_registration'); ?>';
  var login_url = '<?php echo base_url('login'); ?>';

 
  $("#register").click(function( e ) {
    e.preventDefault();

    if(!isEmail($('#user_email').val())){
      $("#register").notify(
           "Enter a valid email", 
            { className: 'error',position:"top" }
      );
      refresh_captcha();
      return false;
    }


    var posting = $.post(register_verify_url,  
       $('#register-form').serialize()
    );
    posting.done(function( data ) {
      var out = jQuery.parseJSON(data);

      if(out.status == 500){
        $("#register").notify(
            out.msg, 
            { className: 'error',position:"top" }
        );
        refresh_captcha();
        return false;
      } 
      
      if(out.status == 200){
        $("#register").notify(
            out.msg, 
            { className: 'success',position:"top" }
        );
        refresh_captcha();
        $('#register-form').submit();
        return true;
      }
        //$('#loader').hide();
  }); 

  
  posting.fail(function() {
    $("#register").notify(
            "Something went wrong!", 
            { className: 'error',position:"top" }
);
return false;

  })    
});


$(document).on("click", ".change-captcha", function(e) {
  
  refresh_captcha();
  e.preventDefault();
});


function refresh_captcha(){
  $('.change-captcha').html('');
  $('#loader').show();

  var fetching = $.get( captcha_url);
    fetching.done(function( data ) {
        $('#loader').hide();
        $('.change-captcha').html(data);

  });

  fetching.fail(function() {
    alert( "error" );
  })    
}




function isEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
      }else{
      return true;
      }
  }

  function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    } 

</script>

</body>
</html>
