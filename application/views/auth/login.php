<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="<?= base_url() ?>assets/auth/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <style>
    body {
      padding-top: 60px;
    }

    .img-fluid {
      max-width: 100%;
    }

    .control-label {
      font-weight: bold;
    }

    .form-control:active {
      border: 0.1px solid #000;
    }

    .form-control {
      color: #000;
      font-weight: bold;
    }
  </style>



  <script type="text/javascript" src="<?= base_url() ?>assets/auth/js/jquery.min.js"></script>


</head>

<body>
  <div class="container">


    <div id="login" class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">

      <div class="row">
        <?php $this->load->view('messages/_auth.php') ?>
      </div>

    <h4 class="text-center">Login to start your session</h4>
      <?php echo form_open(base_url('save_login'), 'class="form-horizontal" autocomplete="off" '); ?>
      <div class="form-group">
        <!-- <div class="col-xs-12 col-sm-3">
          <label for="username" class="control-label">Username</label>
        </div> -->
        <div class="col-xs-12 col-sm-12">
          <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Username">
        </div>
      </div>
      <div class="form-group">
        <!-- <div class="col-xs-12 col-sm-3">
          <label for="password" class="control-label">Password</label>
        </div> -->
        <div class="col-xs-12 col-sm-12">
          <input type="password" name="user_password" id="user_password" class="form-control" placeholder="Password">
        </div>
      </div>

      <div class="form-group">

        <div class="col-xs-12 col-sm-12 change-captcha">
          <?php echo $captchaimage; ?>
        </div>

        <center><i id="loader" class="fa fa-gear fa-spin" style="font-size:24px; color: #007bff; display: none;"></i></center>
        <h6 style="font-size: 0.8rem;">Click on the image to change captcha</h6>
      </div>

      <div class="form-group">
        <!-- <div class="col-xs-12 col-sm-3">
          <label for="captcha" class="control-label">Captcha</label>
        </div> -->
        <div class="col-xs-12 col-sm-12">
          <input type="text" name="user_captcha" id="user_captcha" class="form-control" placeholder="Captcha">
        </div>
      </div>

      <input type="hidden" name="device_type" id="device_type">
      <input type="hidden" name="device_os" id="device_os">
      <input type="hidden" name="device_browser" id="device_browser">

      <button type="submit" name="btn_login" style="font-weight: bold;" class="btn btn-block btn-success">Login</button>

      <?php echo form_close(); ?>
      <div class="text-right">
        <small><a href="#" class="text-muted">
            I forgot my password </a></small>
      </div>

      <p id="device_info_test"></p>
      <p id="device_info_console"></p>
    </div>
  </div>

</body>

</html>

<script>
  init_buttons();

  function init_buttons() {
    var btns = document.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++)
      btns[i].classList.add("load-btn");
  }

  $(document).on('click', '.load-btn', function() {
    this.innerHTML = (this.localName == 'input') ? 'Loading ...' : 'Loading...' + '<i class="fas fa-fan fa-spin"></i>';
    this.style.opacity = "0.7";
    return true;
  });


  var url = '<?php echo base_url('change_captcha'); ?>';

  $(document).on("click", ".change-captcha", function(e) {
    $('.change-captcha').html('');
    $('#loader').show();

    var fetching = $.get(url, {
      s: 'term'
    });

    fetching.done(function(data) {
      $('#loader').hide();
      $('.change-captcha').html(data);

    });
    e.preventDefault();
  });
</script>

<script>
  get_device_info();
  var device_info = "No info found";
  var device_type = "Unknown Device";
  var device_os = "Unknown OS";
  var device_browser = "Unknown Browser";

  function get_device_info() {
    var con = navigator.userAgent;
    //$('#device_info_console').html(con);
    device_type = getDeviceType();
    device_os = getDeviceOS();
    device_browser = getDeviceBrowser();

    $('#device_type').val(device_type);
    $('#device_os').val(device_os);
    $('#device_browser').val(device_browser);

    //device_info = device_os + ' through ' + device_type + ' from ' + device_browser;
    //$('#device_info_test').html(device_info);
    return device_info;
  }

  function getDeviceType() {
    const ua = navigator.userAgent;
    if (/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i.test(ua)) {
      device_type = "Tablet";
    }
    if (/Mobile|iP(hone|od)|Android|BlackBerry|IEMobile|Kindle|Silk-Accelerated|(hpw|web)OS|Opera M(obi|ini)/.test(ua)) {
      device_type = "Mobile";
    }
    device_type = "Desktop";

    return device_type;
  }

  function getDeviceOS() {
    if (navigator.userAgent.indexOf("Win") != -1) device_os =
      "Windows OS";
    if (navigator.userAgent.indexOf("Mac") != -1) device_os =
      "Macintosh";
    if (navigator.userAgent.indexOf("Linux") != -1) device_os =
      "Linux OS";
    if (navigator.userAgent.indexOf("Android") != -1) device_os =
      "Android OS";
    if (navigator.userAgent.indexOf("like Mac") != -1) device_os =
      "iOS";
    return device_os;
  }

  function getDeviceBrowser() {
    if ((navigator.userAgent.indexOf("Opera") || navigator.userAgent.indexOf('OPR')) != -1) {
      device_browser = 'Opera browser';
    } else if (navigator.userAgent.indexOf("Chrome") != -1) {
      device_browser = 'Chrome browser';
    } else if (navigator.userAgent.indexOf("Safari") != -1) {
      device_browser = 'Safari browser';
    } else if (navigator.userAgent.indexOf("Firefox") != -1) {
      device_browser = 'Firefox browser';
    } else if ((navigator.userAgent.indexOf("MSIE") != -1) || (!!document.documentMode == true)) //IF IE > 10
    {
      device_browser = 'IE browser';
    } else {
      device_browser = 'Unknown browser';
    }
    return device_browser;
  }
</script>