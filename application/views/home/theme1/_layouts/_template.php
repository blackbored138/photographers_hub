<!DOCTYPE html>
<html lang="en">

<head>

	<title><?= $client_details->website_name ?> | Template</title>
	<!-- meta -->
	<?php echo @$_meta; ?>

	<!-- css -->
	<?php echo @$_css; ?>




	<!--srart theme style -->
</head>

<body>
	<!-- preloader Start -->
	<?php echo @$_preloader; ?>

    
  <div id="back-top">
    <a title="Go to Top" href="#"> <i class="fas fa-level-up-alt"></i></a>
  </div>


	<!-- nav -->
	<?php echo @$_nav; ?>


	<!-- header -->
	<?php echo @$_header; ?>

	<!-- content -->
	<?php echo @$_content; ?>
	<!-- headerContent -->
	<!-- mainContent -->


	<!-- footer -->
	<?php echo @$_footer; ?>

	<!-- js -->
	<?php echo @$_js; ?>

</body>

</html>