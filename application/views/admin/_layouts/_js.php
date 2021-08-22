
<!-- jQuery UI 1.11.4 -->
<script src="<?=base_url() ?>assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- overlayScrollbars -->
<script src="<?=base_url() ?>assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url() ?>assets/admin/dist/js/adminlte.js"></script>
<script src="<?=base_url() ?>assets/admin/notifyjs/dist/notify.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
<script src="<?php echo base_url(); ?>assets/admin/plugins/sweetalert2/sweetalert2.min.js"></script>


<script>

$(document).ready( function() {
  //init_buttons();
  });
/*
  function init_buttons() {
    var btns = document.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++)
      btns[i].classList.add("load-btn");
  }

  $(document).on('click', '.load-btn', function() {
    this.innerHTML = (this.localName == 'input') ? 'Loading ...' : 'Loading...' + '<i class="fas fa-fan fa-spin"></i>';
    this.style.opacity = "0.7";
    return true;
  });*/

  $(document).on('click', '.add-btn', function() {
    this.innerHTML = (this.localName == 'input') ? 'Wait ...' : 'Wait...' + '<i class="fas fa-fan fa-spin"></i>';
    this.style.opacity = "0.7";
    return true;
  });


  function loading_btn(this_elem = ''){
    var xhr_loader = document.querySelectorAll('.loader-xhr');  
    if(xhr_loader.length > 0)
      xhr_loader[0].remove();
    else
      this_elem.append('<i class="fas fa-fan fa-spin loader-xhr"></i>');
    

  }

  </script>

  
<script>
  function toastSuccess(status,message){
     var Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000
     });	
  
     Toast.fire({
         icon: status,
         title: message
       })
  }
  
 </script>
