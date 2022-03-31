<table id="example" style="width:100%">
        <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
            </tr>
            <tr>
                <td>Garrett</td>
                <td>Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>8422</td>
                <td>g.winters@datatables.net</td>
            </tr>
            <tr>
                <td>Ashton</td>
                <td>Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>1562</td>
                <td>a.cox@datatables.net</td>
            </tr>
            
        </tbody>
    </table>
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