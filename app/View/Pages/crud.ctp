
<?php header("Content-Type: application/xml; charset=ISO-8859-1"); ?>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.min.js"></script>

<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10">
	
			<?php echo $this->Form->create('accentchars',array('enctype'=>'multipart/form-data','method'=>'post','name'=>'accentcharsForm','id'=>'accentcharsForm'));?>
    		<h2>Crud Operations of Accent Characters</h2>
                <input type="hidden" value="266" name="b_id">
				<input type="hidden" value="" id="id" name="id">
						First Name *: 
							
								<input type="text" name="fname" id="fname" style="width:20%;max-width: 500px;" value="" minlength="5">
								<br>
						Last Name *:
								<input type="text" name="lname" id="lname" class="form-control" style="width:20%;max-width: 500px;" value=""  minlength="5">
							
								<br>
									
							<input type="submit" value="Save" name="submit" id="submit">
							<input type="reset" value="reset" name="reset" onclick="buttonchange()">
							<hr>
							<div>
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
									
									<td><span style="cursor:pointer;color:dark-green;text-decoration:underline;" id='edit' onClick="fetchDetails(<?php echo $value['bdmembers']['id']; ?>)">Edit </span> | <a href="<?php echo Router::url('/', true); ?>Pages/cruddelete/<?php echo $value['bdmembers']['id']; ?>"> Delete </a></td></tr>
								<?php } ?>
								</tbody>
							</table>
				    <?php echo $this->Form->end();?>
</div>


<!-- for simple Data table -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
<!-- <link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/datatables.min.css"> -->
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
 <!-- <script type="text/javascript" charset="ISO-8859-1" src="<?php echo Router :: url('/', true);?>servicehelpcredit/datatables.min.js"></script> -->


 <!-- for Export -->
<link rel="stylesheet" type="text/css" href="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.dataTables.min.css">
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.html5.min.js"></script>
<script type="text/javascript" src="<?php echo Router :: url('/', true);?>servicehelpcredit/buttons.print.min.js"></script>

<script type="text/javascript"> 
// $.ajaxSettings.mimeType="*/*; charset=ISO-8859-1";// set you charset
function buttonchange(){
	$('#submit').val('Save');
}
function fetchDetails(nid){
	if(nid==""){
		alert("ID not selected");
	}else{
		$('#id').val(nid);
		$('#submit').val('Update');
		//Begin Ajax Code
			var urlString =
			"<?php echo Router::url('/', true); ?>Pages/ajaxquery?action=crudfetch&nid="+ nid +"&random=" +
			Math.random();
			$.ajax({
				type: "GET",
				url: urlString,
				async: false,
				// contentType:"application/x-www-form-urlencoded;charset=ISO-8859-1",
				success: function(responseText) {
					if(responseText!=''){
						// alert(responseText);
						var resp=atob(responseText); // decode encoded from php 
						// alert(resp);
						var res = resp.split("~");
						$('#fname').val(res[0]);
						$('#lname').val(res[1]);
					}
				}
			});
		//End Ajax Code

	}
   
   }
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
    //  document.getElementById("teste" + index).value  = number;
	//  $('#teste'+ index).val(number);
	//  $('#testeid'+ index).val(id);
	nid=id;
	//  $('#teste'+ index).css({"background-color": "yellow"});
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
			//alert($newE);
            $newE.focus();
        }else if($e.attr('id') === 'lname') {
            var val = $(this).html(); // old text value
			// alert(nid);
            $e.html('<input type="text" name="lname" id="'+nid+'" value="'+val+'" />');
            var $newE = $e.find('input');
			//alert($newE);
            $newE.focus();
        }

		//===Common =========
        $newE.on('blur', function() {
			
			if($(this).val()==''){
				$(this).parent().html('<span>'+val+'</span>');
				alert('Blank value can not be set!');
			}else{
				//update code
				val=btoa($(this).val()); // new text value  encode in base 64
				$(this).parent().html('<span>'+$(this).val()+'</span>');
				alert('Name='+$newE.attr("name")+' '+'ID=' + $newE.attr("id") + ' '+ 'Value='+ val);
				var id = $newE.attr("id");
				//Begin Ajax Code
					// var urlString =	"<?php echo Router::url('/', true); ?>Pages/ajaxquery?action=update_" + $newE.attr('name') + "&id="+ $newE.attr("id") +"&value="+ encodeURIComponent(val) +"&random=" + Math.random();
					var urlString =
					"<?php echo Router::url('/', true); ?>Pages/ajaxquery?action=update_" + $newE.attr('name') ;
					$.ajax({
						// type: "GET",
						url: urlString,
						type: "POST",
                 		data:{id:id,value:val},
						// contentType: "application/x-www-form-urlencoded;charset=iso-8859-1",
						success: function(responseText) {
							alert('Selected Text Updated');
						}
					}); 
				//End Ajax Code
			}
			nid=0;
        });
		
    });







var Base64 = {

// private property
_keyStr : "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",

// public method for encoding
encode : function (input) {
  var output = "";
  var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
  var i = 0;

  input = Base64._utf8_encode(input);

  while (i < input.length) {

	chr1 = input.charCodeAt(i++);
	chr2 = input.charCodeAt(i++);
	chr3 = input.charCodeAt(i++);

	enc1 = chr1 >> 2;
	enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
	enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
	enc4 = chr3 & 63;

	if (isNaN(chr2)) {
	  enc3 = enc4 = 64;
	} else if (isNaN(chr3)) {
	  enc4 = 64;
	}

	output = output +
	this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
	this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

  }

  return output;
},

// public method for decoding
decode : function (input) {
  var output = "";
  var chr1, chr2, chr3;
  var enc1, enc2, enc3, enc4;
  var i = 0;

  input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

  while (i < input.length) {

	enc1 = this._keyStr.indexOf(input.charAt(i++));
	enc2 = this._keyStr.indexOf(input.charAt(i++));
	enc3 = this._keyStr.indexOf(input.charAt(i++));
	enc4 = this._keyStr.indexOf(input.charAt(i++));

	chr1 = (enc1 << 2) | (enc2 >> 4);
	chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
	chr3 = ((enc3 & 3) << 6) | enc4;

	output = output + String.fromCharCode(chr1);

	if (enc3 != 64) {
	  output = output + String.fromCharCode(chr2);
	}
	if (enc4 != 64) {
	  output = output + String.fromCharCode(chr3);
	}

  }

  output = Base64._utf8_decode(output);

  return output;

},

// private method for UTF-8 encoding
_utf8_encode : function (string) {
  string = string.replace(/\r\n/g,"\n");
  var utftext = "";

  for (var n = 0; n < string.length; n++) {

	var c = string.charCodeAt(n);

	if (c < 128) {
	  utftext += String.fromCharCode(c);
	}
	else if((c > 127) && (c < 2048)) {
	  utftext += String.fromCharCode((c >> 6) | 192);
	  utftext += String.fromCharCode((c & 63) | 128);
	}
	else {
	  utftext += String.fromCharCode((c >> 12) | 224);
	  utftext += String.fromCharCode(((c >> 6) & 63) | 128);
	  utftext += String.fromCharCode((c & 63) | 128);
	}

  }

  return utftext;
},

// private method for UTF-8 decoding
_utf8_decode : function (utftext) {
  var string = "";
  var i = 0;
  var c = c1 = c2 = 0;

  while ( i < utftext.length ) {

	c = utftext.charCodeAt(i);

	if (c < 128) {
	  string += String.fromCharCode(c);
	  i++;
	}
	else if((c > 191) && (c < 224)) {
	  c2 = utftext.charCodeAt(i+1);
	  string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
	  i += 2;
	}
	else {
	  c2 = utftext.charCodeAt(i+1);
	  c3 = utftext.charCodeAt(i+2);
	  string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
	  i += 3;
	}

  }

  return string;
}

}

</script>