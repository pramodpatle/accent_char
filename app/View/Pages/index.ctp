
<?php header("Content-Type: application/xml; charset=ISO-8859-1"); ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
<div>
    <input id="teste1" type="text" value=""  style="width:20%;max-width: 200px;height:10px;position:500px 300px" > <!-- First name text-->
	 <input id="testeid1" type="text" value="" style="width:20%;max-width:  200px;height:10px;"> <!--First name id -->
	<input id="teste2" type="text" value="" style="width:20%;max-width:  200px;height:10px;"> <!-- last name text -->
	<input id="testeid2" type="text" value="" style="width:20%;max-width:  200px;height:10px;"> <!-- last name id --> 
							<table id="example" class="display table">
								<thead>
								<tr><th>id</th><th>First Name</th><th>Last Name</th><th>Team Name</th><th>Action</th></tr>
								</thead>
								<tbody>
								<?php foreach($dtls as $key => $value) {?>
									<tr><td ><?php echo $value['bdmembers']['id']; ?></td>
									<td id="fname" onclick="moveNumbers(this.cellIndex, this.textContent.trim(),<?php echo $value['bdmembers']['id']; ?>)"><span><?php echo $value['bdmembers']['firstname']; ?></span></td>
									<td id="lname" onclick="moveNumbers(this.cellIndex, this.textContent.trim(),<?php echo $value['bdmembers']['id']; ?>)"><span><?php echo $value['bdmembers']['lastname']; ?></span></td>
									<td></td>
									<td></td></tr>
								<?php } ?>
								</tbody>
							</table>
</div>
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
									<td></td><td><a href="<?php echo Router::url('/', true); ?>Pages/edit/<?php echo $value['bdmembers']['id']; ?>">Edit </a> | <a href="<?php echo Router::url('/', true); ?>Pages/delete/<?php echo $value['bdmembers']['id']; ?>"> Delete </a></td></tr>
								<?php } ?>
								</tbody>
							</table>
				    <?php echo $this->Form->end();?>
</div>


<!-- for simple Data table -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
 <script type="text/javascript" charset="ISO-8859-1" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>


 <!-- for Export -->
<link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.dataTables.min.css">
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jszip.min.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/pdfmake.min.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/vfs_fonts.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.html5.min.js"></script>
<script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.print.min.js"></script>

<script type="text/javascript"> 
var editor; // use a global for the submit and return data rendering in the examples
$(document).ready( function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [[ 0, "desc" ]]
        });
   
} );

//click and to get text from 
var nid = 0;
function moveNumbers(index, number,id){
     document.getElementById("teste" + index).value  = number;
	 $('#teste'+ index).val(number);
	 $('#testeid'+ index).val(id);
	nid=id;
	 $('#teste'+ index).css({"background-color": "yellow"});
} 


$('#example').on('click', 'span', function() {
        var $e = $(this).parent();
		// alert($e.attr('id'));
		//===First Name =========
		if($e.attr('id') === 'fname') {
            var val = $(this).html(); // old text value
			// alert(nid);
            $e.html('<input type="text" name="fname" id="'+nid+'" value="'+val+'" />');
            var $newE = $e.find('input');
            $newE.focus();
        }else if($e.attr('id') === 'lname') {
            var val = $(this).html(); // old text value
			// alert(nid);
            $e.html('<input type="text" name="lname" id="'+nid+'" value="'+val+'" />');
            var $newE = $e.find('input');
            $newE.focus();
        }

		//===Common =========
        $newE.on('blur', function() {
			
			if($(this).val()==''){
				$(this).parent().html('<span>'+val+'</span>');
				alert('Blank value can not be set!');
			}else{
				//update code
				val=$(this).val(); // new text value 
				$(this).parent().html('<span>'+$(this).val()+'</span>');
				// alert('Name='+$newE.attr("name")+' '+'ID=' + $newE.attr("id") + ' '+ 'Value='+ val);
				var id = $newE.attr("id");
				// var JSONObject= {"value":val, "id":id};
             	// var jsonData = JSON.stringify( JSONObject );
				//Begin Ajax Code
					// var urlString =	"<?php echo Router::url('/', true); ?>Pages/ajaxquery?action=update_" + $newE.attr('name') + "&id="+ $newE.attr("id") +"&value="+ encodeURIComponent(val) +"&random=" + Math.random();
					// $.ajaxSettings.mimeType="*/*; charset=ISO-8859-1";// set you charset
					var urlString =
					"<?php echo Router::url('/', true); ?>Pages/ajaxquery?action=update_" + $newE.attr('name') ;
					$.ajax({
						// type: "GET",
						url: urlString,
						type: "POST",
                 		dataType: "json",                  
                 		data:{id:id,value:val},
						contentType: "application/x-www-form-urlencoded;charset=iso-8859-1",
						success: function(responseText) {
							alert(responseText);
							// alert(responseText);
							// if (responseText >= 1) {
							// 	$('#msg').html("Firstname, lastname and teamname is mandatory for all players.");
							// } 
						}
					}); 
				//End Ajax Code
			}
			nid=0;
        });
		
    });

</script>