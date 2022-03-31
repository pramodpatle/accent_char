<?php header('Content-Type: text/html; charset=utf-8'); ?>
<style>

</style>


<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
	<?php echo $this->Form->create('Downloadfile',array('method'=>'post','class'=>'downform'));?>
		Export CSV Template :	
        <input type="submit" name="downloadfile" value="Export"><br><br>
	<?php echo $this->Form->end();?>

	<?php echo $this->Form->create('Downloadfile1',array('method'=>'post','class'=>'downform'));?>
		Export CSV Data :	
        <input type="submit" name="downloadfile1" value="Download Data"><br><br>
	<?php echo $this->Form->end();?>


	<?php echo $this->Form->create('Importroster',array('enctype'=>'multipart/form-data','method'=>'post'));?>
	Import Roster Filename :<input id="importfiles" type="file"  name="importfiles" ><input  type="submit" name="importfile" value="Import">
	<br><br>
	<?php echo $this->Form->end();?>
<hr>		
  			<?php echo $this->Form->create('accentchars',array('enctype'=>'multipart/form-data','method'=>'post','name'=>'accentcharsForm','id'=>'accentcharsForm'));?>
    		<h2>Accent Characters</h2>
                <input type="hidden" value="266" name="b_id">
						First Name *: 
							<?php if($editdtls){ ?>
								<input type="text" name="fname" id="fname"  style="width:20%;max-width: 500px;" value="<?php if ($editdtls[0]['bdmembers']['firstname']==''){echo "";}else{echo $editdtls[0]['bdmembers']['firstname'];} ?>" minlength="5">
							<?php }else { ?>
								<input type="text" name="fname" id="fname" style="width:20%;max-width: 500px;" value="" minlength="5">
							<?php }?>
								<br>
								<br>
						Last Name *:
							<?php if($editdtls){ ?>
								<input type="text" name="lname" id="lname" class="form-control" style="width:20%;max-width: 500px;" value="<?php if ($editdtls[0]['bdmembers']['lastname']==''){echo "";}else{echo $editdtls[0]['bdmembers']['lastname'];} ?>"  minlength="5">
							<?php }else { ?>
								<input type="text" name="lname" id="lname" class="form-control" style="width:20%;max-width: 500px;" value=""  minlength="5">
							<?php } ?>
								<br>
									
							<input type="submit" value="submit" name="submit">
							<br><br>
<hr>
<br>
							<table border="1">
								<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Team Name</th><th>Action</th></tr>
								<?php foreach($dtls as $key => $value) {?>
									<tr><td><?php echo $value['bdmembers']['id']; ?></td><td><?php echo $value['bdmembers']['firstname']; ?></td><td><?php echo $value['bdmembers']['lastname']; ?></td><td></td><td><a href="<?php echo Router::url('/', true); ?>Pages/edit/<?php echo $value['bdmembers']['id']; ?>">Edit </a> | <a href="<?php echo Router::url('/', true); ?>Pages/delete/<?php echo $value['bdmembers']['id']; ?>"> Delete </a></td></tr>
								<?php } ?>
							</table>
							<hr>
							<!-- <h2>Data Table</h2>
							<table id="example">
								<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Team Name</th><th>Action</th></tr>
								<?php foreach($dtls as $key => $value) {?>
									<tr><td><?php echo $value['bdmembers']['id']; ?></td><td><?php echo $value['bdmembers']['firstname']; ?></td><td><?php echo $value['bdmembers']['lastname']; ?></td><td></td><td><a href="<?php echo Router::url('/', true); ?>Pages/edit/<?php echo $value['bdmembers']['id']; ?>">Edit </a> | <a href="<?php echo Router::url('/', true); ?>Pages/delete/<?php echo $value['bdmembers']['id']; ?>"> Delete </a></td></tr>
								<?php } ?>
							</table> -->
							
	

				    <?php echo $this->Form->end();?>
</div>


<script type="text/javascript"> 
	$(document).ready(function() {
		var table = $('#example').dataTable( {
			colReorder: true,
			responsive: true
		} );
	} );
</script>

<!-- for simple Data table -->
<link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.dataTables.js"></script>

<!-- for date range picker -->
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/moment.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/daterangepicker.css" />
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/daterangepicker.min.js"></script>

<!-- for Export -->
<link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/vfs_fonts.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.print.min.js"></script>