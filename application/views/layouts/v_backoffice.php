<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<title>Merger PDF Files</title>

		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" media="screen">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css')?>">
	</head>
<body>
	
	<?php $this->load->view('partials/v_navbar');?>

	<?php $this->load->view('contents/' . $contents);?>
	

	<script src="<?php echo base_url('assets/vendors/jquery/dist/jquery.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/popper.js/dist/umd/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/vendors/bootstrap/dist/js/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/custom.js');?>"></script>
    <script>
    	var formOK = false;

		function validatePDF(objFileControl){
			var file = objFileControl.value;
			var len = file.length;
			var ext = file.slice(len - 4, len);

			if(ext.toUpperCase() == ".PDF"){
				formOK = true;
			}
			else{
				formOK = false;
				alert("Only PDF files allowed.");
				$(objFileControl).val(null);
			}
		}
    </script>
</body>
</html>