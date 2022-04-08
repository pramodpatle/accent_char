
<?php header("Content-Type: application/xml; charset=ISO-8859-1"); ?>

<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
	
	<h2>Export Accent Characters data in csv</h2>
	<?php echo $this->Form->create('Downloadfile1',array('method'=>'post','class'=>'downform'));?>
		Export CSV Data :	
        <input type="submit" name="downloadfile1" value="Download Data"><br><br>
	<?php echo $this->Form->end();?>

<hr>		
  			
	<table >
		<thead>
		<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Team Name</th><th>Action</th></tr>
		</thead>
		<tbody>
		<?php foreach($dtls as $key => $value) {?>
			<tr><td ><?php echo $value['bdmembers']['id']; ?></td>
			<td><?php echo $value['bdmembers']['firstname']; ?></td>
			<td><?php echo $value['bdmembers']['lastname']; ?></td>
			<td></td><td></td></tr>
		<?php } ?>
		</tbody>
	</table>
</div>

