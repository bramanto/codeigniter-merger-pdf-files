<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Merger PDF Files</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" media="screen">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/custom.min.css')?>">
	</head>
<body>
	
	<?php $this->load->view('partials/v_navbar');?>
	

	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h3>Single Upload PDF</h3>
				<?php
				if($this->session->flashdata('error')){
					echo '<div class="alert alert-dismissible alert-error">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Sorry!</strong> Please check file again.
						</div>';
				}

				?>
				<?php echo form_open_multipart('data/upload');?>
  					<fieldset>
						<div class="form-group">
							<label for="attachment1">Attachment 1</label>
							<?php echo form_upload(array('id' => 'attachment1', 'name' => 'pdf_file[]', 'class' => 'form-control', 'accept' => 'application/pdf', 'onChange' => 'validatePDF(this)'));?>
						</div>
						<div class="form-group">
							<label for="attachment2">Attachment 2</label>
							<?php echo form_upload(array('id' => 'attachment2', 'name' => 'pdf_file[]', 'class' => 'form-control', 'accept' => 'application/pdf', 'onChange' => 'validatePDF(this)'));?>
						</div>
						<div class="form-group">
							<label for="attachment3">Attachment 3</label>
							<?php echo form_upload(array('id' => 'attachment3', 'name' => 'pdf_file[]', 'class' => 'form-control', 'accept' => 'application/pdf', 'onChange' => 'validatePDF(this)'));?>
						</div>
						<div class="form-group">
							<label for="attachment4">Attachment 4</label>
							<?php echo form_upload(array('id' => 'attachment4', 'name' => 'pdf_file[]', 'class' => 'form-control', 'accept' => 'application/pdf', 'onChange' => 'validatePDF(this)'));?>
						</div>
						<div class="form-group">
							<label for="attachment5">Attachment 5</label>
							<?php echo form_upload(array('id' => 'attachment5', 'name' => 'pdf_file[]', 'class' => 'form-control', 'accept' => 'application/pdf', 'onChange' => 'validatePDF(this)'));?>
						</div>
						<div class="form-group">
							<?php echo form_button(array('type' => 'submit', 'class' => 'btn btn-primary', 'content' => ' Upload File', 'name' => 'submit'));?>
						</div>
  					</fieldset>
  				<?php echo form_close();?>
			</div>
			<div class="col-md-6">
				<?php
				if($this->session->flashdata('success')){
					echo '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Well done!</strong> You successfully uploaded.
						</div>';
				}

				if($this->session->userdata('pdf_file')){
					$pdf_file = $this->session->userdata('pdf_file');
					echo '<embed src="'.base_url('assets/uploads/' . $pdf_file).'" width="100%" height="600px" />';
				}
				?>
					
			</div>
		</div>
	</div>
	

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