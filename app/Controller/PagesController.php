<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public $name = 'Pages';
    
/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function index($id=0) {
		$this->loadModel('bdmembers');
		$org_id=101;
		$job_id=201;
		 // For download csv sheet structure
		 if ($this->request->data['downloadfile'] != "") {
            $filename = "importroster.csv";
            ob_clean();
            $csv_file = fopen('php://output', 'w');
            header("Content-Type: application/csv");
            header('Content-Disposition: attachment; filename="'. $filename .'"');
            /*live templete for roster. */
            $header_row = array("Team",
            "First Name",
            "Last Name",
            "Jersey Number",
            "Coach", 
            "Team Image Number",
            "Individual Image Number",
            "Alt 1",
            "Alt 2",
            "Alt 3",
            "Alt 4",
            "Alt 5",
            "Buddy Image Number",
            "Parent Name",
            "Address1",
            "Address2",
            "City",
            "State",
            "Zip Code",
            "Country",
            "Cell Phone",
            "Email",
            "Age",
            "Grade",
            "Coach Name",
            "Feet",
            "Inches",
            "Weight",
            "Position",
            "Favorite Pro",
            "Player Stat",
            "Products", 
            "Packages",
            "Additional Order",
            "Retouching",
            "Glasses Glare"
            );
            fputcsv($csv_file, $header_row, ',', '"');
            fclose($csv_file);
            die;
         }

		 if ($this->request->data['downloadfile1'] != "") {
			$dtls = $this->bdmembers->find('all', array(
				'conditions'=>array(
					'b_id'=>'266'
				),
				'order' => 'id DESC',
				'limit' => 1000
				)
			);
			

            $filename = "exportroster.csv";
            ob_clean();
            $csv_file = fopen('php://output', 'w');
            header("Content-Type: application/csv");
            header('Content-Disposition: attachment; filename="'. $filename .'"');
            /*live templete for roster. */
            $header_row = array("Team",
            "First Name",
            "Last Name"
            );
			fputcsv($csv_file, $header_row, ',', '"');
			foreach($dtls as $key => $value){
				$header_row = array("Team",$value['bdmembers']['firstname'],$value['bdmembers']['lastname']);
				fputcsv($csv_file, $header_row, ',', '"');
			}
            fclose($csv_file);
            die;
         }

		 // for import csv sheet data
		 if ($_FILES['importfiles']['name'] != "") {
			$this->set('filepathinfo', $_FILES['importfiles']['name']);
			$projectpath = Configure::read('projectpath');
			$projectdirpath = Configure::read('projectdirpath');
			$path = $_SERVER['DOCUMENT_ROOT'] . $projectpath . "app/webroot/importroster/";
			$uploadFilename = "import_".$id."_" .$org_id."_".$job_id."_".time().".csv";
			copy($_FILES['importfiles']['tmp_name'], $path . $uploadFilename);
			$duplitot = 0;
			$duplij = 1;
			$dupliarr = array();
			$pcodeArr = array();
			 /*$duplihandle = fopen($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle2 = fopen($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle3 = fopen($_FILES["importfiles"]["tmp_name"], "r");*/
			
			$duplihandle =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle2 =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			//$duplihandle2 =fopen($_FILES["importfiles"]["tmp_name"], "rw");
			$duplihandle3 =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			//#NG051 changes for windows unicode char start here changes for windows unicode char end here 
			$checkheader_row = array(
			"Team",
			"First Name",
			"Last Name",
			"Jersey Number",
			"Coach", 
			"Team Image Number",
			"Individual Image Number",
			"Alt 1",
			"Alt 2",
			"Alt 3",
			"Alt 4",
			"Alt 5",
			"Buddy Image Number",
			"Parent Name",
			"Address1",
			"Address2",
			"City",
			"State",
			"Zip Code",
			"Country",
			"Cell Phone",
			"Email",
			"Age",
			"Grade",
			"Coach Name",
			"Feet",
			"Inches",
			"Weight",
			"Position",
			"Favorite Pro",
			"Player Stat",
			"Products", 
			"Packages",
			"Additional Order",
			"Retouching",
			"Glasses Glare"
			);
			//echo "<pre>";print_r($checkheader_row);exit;
			$csvCell = array(
			"1" => "A",
			"2" => "B",
			"3" => "C",
			"4" => "D",
			"5" => "E",
			"6" => "F",
			"7" => "G",     
			"8" => "H",
			"9" => "I",
			"10" => "J",
			"11" => "K",
			"12" => "L",
			"13" => "M",
			"14" => "N",
			"15" => "O",
			"16" => "P",
			"17" => "Q",
			"18" => "R",
			"19" => "S",
			"20" => "T",
			"21" => "U",
			"22" => "V",
			"23" => "W",
			"24" => "X",
			"25" => "Y",
			"26" => "Z",
			"27" => "AA",
			"28" => "AB",
			"29" => "AC",
			"30" => "AD",
			"31" => "AE",
			"32" => "AF",
			"33" => "AG",
			"34" => "AH",
			"35" => "AI",
			"36" => "AJ");
			// GET state country array to validation 
			$myCsvArr =array();
			$r= 0; $c=0;
			while (($datau = fgetcsv($duplihandle3, 1000, ",")) !== FALSE) {
				if($r==0){
					$r++;
					continue;
				}
				$c=0;
				$myCsvArr[$r];
				foreach ($datau as $index=>$val) {
					//#NG051 changes for windows unicode char  
				   // $myCsvArr[$r][$c]= htmlentities($val, ENT_QUOTES);
					$myCsvArr[$r][$c]= $val;
					$c++;
				}
				$r++;
			}
			array_multisort(array_column($myCsvArr, 33), SORT_ASC, $myCsvArr);
			
			while (($valdationdata = fgetcsv($duplihandle2, 2000, ",")) ) {
					$numcols = count($valdationdata);
					$this->set('numcols', $numcols);
				
				$blankrowerror=0;
				$row++;
				$this->set('totnumrows', $row);
			}
		
			// duplicate row in sheet 
			fclose($duplihandle2);
		} //$_FILES['importfiles']['name'] ;

		// for save in db
		if ($_FILES['importfiles']['name'] != "") {
			// check duplicate team data end  
			$uploadFilename = "import_" . $id . "_" . $org_id . "_" . $job_id . "_" . time() . ".csv";
			copy($_FILES['importfiles']['tmp_name'], $path . $uploadFilename);
				$tot = 0;
				$j  =  0;
				$row = 0;
				$plyrCntItrtnArry = array();                   
				$handle = fopen($_FILES["importfiles"]["tmp_name"], "r");
				//#NG051 changes for windows unicode char 
				$handle2 = fopen($_FILES["importfiles"]["tmp_name"], "r");
				//$handle2 = $this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
				$myCsvArr =array(); 
				$r         = 0; 
				$c         = 0;
				while (($datau = fgetcsv($handle2, 1000, ",")) !== FALSE) {
					if($r==0){
						$r++;
						continue;
					}
					$c=0;
					$myCsvArr[$r];
					foreach ($datau as $index=>$val) {
						//#NG051 changes for windows unicode char 
						//$myCsvArr[$r][$c]= htmlentities($val, ENT_QUOTES);
						$myCsvArr[$r][$c]= $val;
						$c++;
					}
					$r++;
				}
				array_multisort(array_column($myCsvArr, 33), SORT_ASC, $myCsvArr);
				//$io = 1;
				$setorinalprocode= "";
				while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
					$data = $myCsvArr[$j];   
					/*echo"<br/>".$data[1];
					if($io >= 4){
						echo "<pre>d=".$io;
						print_r($data[1]); exit;
					}else{
						echo "<pre>s=".$io;
						print_r($data[1]);
					}*/
				
				   
					$sheetnum = count($data);
					for ($c=0; $c < $sheetnum; $c++) {
						$arr[$row][$c] = trim($valdationdata[$c]);
					}
					// Generate uid
					$uidArr = array(
						'A',
						'B',
						'C',
						'D',
						'E',
						'F',
						'G',
						'H',
						'I',
						'J',
						'K',
						'L',
						'M',
						'N',
						'O',
						'P',
						'Q',
						'R',
						'S',
						'T',
						'U',
						'V',
						'W',
						'X',
						'Y',
						'Z'
					);
				
					// $data[0] = html_entity_decode($data[0], ENT_QUOTES);
					 
					$data[0] = trim($data[0]);
					// Special Charater remove code
					//added this on date 09/14/2020 for remove the name issue like ???O???Neill??? they get this as a result ???O039Neill???.
					// $data[1] = html_entity_decode($data[1], ENT_QUOTES);
					// $data[2] = html_entity_decode($data[2], ENT_QUOTES);

					//$data[1] = preg_replace('/[^A-Za-z0-9\-\(\)\' ]/', '', $data[1]);
					//$data[2] = preg_replace('/[^A-Za-z0-9\-\(\)\' ]/', '', $data[2]);
					$data[31] = rtrim(trim($data[31]),',');
					$data[32] = rtrim(trim($data[32]),','); 
						$jobname = date('Y');               
						//Bdmember Table
						$this->bdmembers->create(array(
							'b_id'							=>'266',
							'firstname'						=>trim($data[1]),
							'lastname'						=>trim($data[2])
						));
						$this->bdmembers->save();
					$j++;
					$tot++;
					$lastclub = $org_id;
					$lastyear = $jobname;
					$row++;
					
				} //while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
			
			fclose($handle);
		}

		
			$editdtls = $this->bdmembers->find('all', array(
				'conditions'=>array(
					'b_id'=>'266',
					'id'	=>$id
				),
				'limit' => 1
				)
			);
			$this->set('editdtls',$editdtls);
			
		
		$dtls = $this->bdmembers->find('all', array(
			'conditions'=>array(
				'b_id'=>'266'
			),
			'order' => 'id DESC',
			'limit' => 1000
			)
		);
		$this->set('dtls',$dtls);
		//print_r($dtls);exit;
		if ($this->request->is('post')) {
			if ($this->request->data['fname'] == ''){
				echo "Blank fields";				
			}else{
				$this->bdmembers->create(array(
					'b_id'							=>$this->request->data['b_id'],
					'firstname'						=>$this->request->data['fname'],
					'lastname'						=>$this->request->data['lname']
				));
				$this->bdmembers->save();
			}
		}
		
	}
	public function delete($id=0) {
		$this->loadModel('bdmembers');
		$this->bdmembers->deleteAll(array('id' =>$id ), false);
		//$this->redirect(array("controller" => "Pages"));
		$this->redirect(array('action'=>'index'));
	}
	public function edit($id=0) {
		$this->redirect(array('action'=>'index/'.$id));
		//$this->redirect(array("controller" => "Pages",$id));

	}
	public function ajaxquery() {
		//header("Content-Type: application/xml; charset=ISO-8859-1"); 
		$this->loadModel('bdmembers');
		$unwanted_array = array('\???'=>"\'",'\???'=>"\'",'\???'=>'\"', '\???'=>'\"', '\???'=>'\'', '\?'=>'\'');
		
		switch ($_REQUEST['action']) {
			case "update_fname":
				$fname =$this->request->data['value'];
				$fname =base64_decode($fname);
				$fname = str_replace("???","'", $fname);		   
				$fname = str_replace("???","'", $fname);		   
				$fname = str_replace("???","'", $fname);	

				$id =trim($_POST['id']);
				$unwanted_array = array('\???'=>"\'",'\???'=>"\'",'\???'=>'\"', '\???'=>'\"', '\???'=>'\'', '\?'=>'\'');
				$fname = strtr($fname, $unwanted_array);
				//update
				if($lname !=''){
					$this->bdmembers->id=$id; 
					$this->bdmembers->set(array(
							'firstname'	=>$fname
					)); 							
					$this->bdmembers->save();
				}
				// $data['status'] = $fname;
				// echo json_encode($data);
				echo $fname . " Name Updated";
				exit;
                break;
			case "update_lname":
				

				$lname = $this->request->data['value'];
				// $lname = str_replace("???","???", $lname);		   
				//$lname = utf8_decode($lname);
				$lname = base64_decode($lname);
				
				$lname = str_replace("???","'", $lname);		   
				$lname = str_replace("???","'", $lname);		   
				$lname = str_replace("???","'", $lname);	

				$id =trim($_POST['id']);
				$unwanted_array = array('\???'=>"\'",'\???'=>"\'",'\???'=>'\"', '\???'=>'\"', '\???'=>'\'', '\?'=>'\'');
				$lname = strtr($lname, $unwanted_array);
				//update
				if($lname !=''){
					$this->bdmembers->id=$id; 
					$this->bdmembers->set(array(
							'lastname'	=>$lname
					)); 							
					$this->bdmembers->save();
				}
				// $data['status'] = $lname;
				// echo json_encode($data);
				echo $lname . " Name Updated";
				exit;
				break;
			case "crudfetch":
				$this->loadModel('bdmembers');
				$id =$_REQUEST['nid'];;
				$editdtls = $this->bdmembers->find('all', array(
					'conditions'=>array(
						'b_id'=>'266',
						'id'	=>$id
					),
					'limit' => 1
					)
				);
				
				$dbeditdtls[0]=strtr($editdtls[0]['bdmembers']['firstname'], $unwanted_array);
				$dbeditdtls[1]=strtr($editdtls[0]['bdmembers']['lastname'], $unwanted_array);
				$dbeditdtls1 = implode("~", $dbeditdtls);
				$dbeditdtls1 = base64_encode($dbeditdtls1);
				echo $dbeditdtls1;
				exit;
                break;
			case "test2":
				exit;
                break;
		}

	}

	
	function pp_str_replace($string) 
	{ 
    	$search = array(chr(145), 
                    chr(146), 
                    chr(147), 
                    chr(148), 
                    chr(151), 
                    chr(128)); 

    	$replace = array("'", 
                     "'", 
                     '"', 
                     '"', 
                     '-', 
                     '???'); 

    	return str_replace($search, $replace, $string); 
	} 
	
	public function crud($id=0) {
		$this->loadModel('bdmembers');
		$org_id=101;
		$job_id=201;

		$dtls = $this->bdmembers->find('all', array(
			'conditions'=>array(
				'b_id'=>'266'
			),
			'order' => 'id DESC',
			'limit' => 1000
			)
		);
		$this->set('dtls',$dtls);
		//print_r($dtls);exit;
		if ($this->request->is('post')) {
			if($this->request->data['id'] == ''){//save record
				if ($this->request->data['fname'] == '' || $this->request->data['lname'] == '' ){
					echo "Blank fields";				
				}else{
					
					$this->bdmembers->create(array(
						'b_id'							=>$this->request->data['b_id'],
						'firstname'						=> $this->pp_str_replace($this->request->data['fname']),
						'lastname'						=> $this->pp_str_replace($this->request->data['lname'])
					));
					$this->bdmembers->save();
				}
			}else{			//update record
				if ($this->request->data['fname'] == '' || $this->request->data['lname'] == '' ){
					echo "Blank fields"; 				
				}else{
					$this->bdmembers->id=$this->request->data['id']; 
					$this->bdmembers->set(array(
						'b_id'							=>$this->request->data['b_id'],
						'firstname'						=> $this->pp_str_replace($this->request->data['fname']),
						'lastname'						=> $this->pp_str_replace($this->request->data['lname'])
					));
					$this->bdmembers->save();
				}

			}
			$this->redirect(array('action'=>'crud'));
		}
		
		
	}
	public function cruddelete($id=0) {
		$this->loadModel('bdmembers');
		$this->bdmembers->deleteAll(array('id' =>$id ), false);
		//$this->redirect(array("controller" => "Pages"));
		$this->redirect(array('action'=>'crud'));
	}
	
	public function import($id=0) {
		$this->loadModel('bdmembers');
		$org_id=101;
		$job_id=201;
		$dtls = $this->bdmembers->find('all', array(
			'conditions'=>array(
				'b_id'=>'266'
			),
			'order' => 'id DESC',
			'limit' => 1000
			)
		);
		$this->set('dtls',$dtls);
		 // For download csv sheet structure
		 if ($this->request->data['downloadfile'] != "") {
            $filename = "importroster.csv";
            ob_clean();
            $csv_file = fopen('php://output', 'w');
            header("Content-Type: application/csv");
            header('Content-Disposition: attachment; filename="'. $filename .'"');
            /*live templete for roster. */
            $header_row = array("Team",
            "First Name",
            "Last Name",
            "Jersey Number",
            "Coach", 
            "Team Image Number",
            "Individual Image Number",
            "Alt 1",
            "Alt 2",
            "Alt 3",
            "Alt 4",
            "Alt 5",
            "Buddy Image Number",
            "Parent Name",
            "Address1",
            "Address2",
            "City",
            "State",
            "Zip Code",
            "Country",
            "Cell Phone",
            "Email",
            "Age",
            "Grade",
            "Coach Name",
            "Feet",
            "Inches",
            "Weight",
            "Position",
            "Favorite Pro",
            "Player Stat",
            "Products", 
            "Packages",
            "Additional Order",
            "Retouching",
            "Glasses Glare"
            );
            fputcsv($csv_file, $header_row, ',', '"');
            fclose($csv_file);
            die;
         }

		  // for import csv sheet data
		  if ($_FILES['importfiles']['name'] != "") {
			$this->set('filepathinfo', $_FILES['importfiles']['name']);
			$projectpath = Configure::read('projectpath');
			$projectdirpath = Configure::read('projectdirpath');
			// $newimageprocesspath = Configure::read('newimageprocesspath');
			$path = $_SERVER['DOCUMENT_ROOT'] . $projectpath . "app/webroot/importroster/";
			//  $path =  "//PHP11-PC/xampp/htdocs".$projectpath.'app/webroot/importroster/';
			$uploadFilename = "import_".$id."_" .$org_id."_".$job_id."_".time().".csv";
			copy($_FILES['importfiles']['tmp_name'], $path . $uploadFilename);
			$duplitot = 0;
			$duplij = 1;
			$dupliarr = array();
			$pcodeArr = array();
			 /*$duplihandle = fopen($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle2 = fopen($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle3 = fopen($_FILES["importfiles"]["tmp_name"], "r");*/
			//#NG051 changes for windows unicode char start here 
			$duplihandle =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			$duplihandle2 =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			//$duplihandle2 =fopen($_FILES["importfiles"]["tmp_name"], "rw");
			$duplihandle3 =$this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
			//#NG051 changes for windows unicode char start here changes for windows unicode char end here 
			$checkheader_row = array(
			"Team",
			"First Name",
			"Last Name",
			"Jersey Number",
			"Coach", 
			"Team Image Number",
			"Individual Image Number",
			"Alt 1",
			"Alt 2",
			"Alt 3",
			"Alt 4",
			"Alt 5",
			"Buddy Image Number",
			"Parent Name",
			"Address1",
			"Address2",
			"City",
			"State",
			"Zip Code",
			"Country",
			"Cell Phone",
			"Email",
			"Age",
			"Grade",
			"Coach Name",
			"Feet",
			"Inches",
			"Weight",
			"Position",
			"Favorite Pro",
			"Player Stat",
			"Products", 
			"Packages",
			"Additional Order",
			"Retouching",
			"Glasses Glare"
			);
			//echo "<pre>";print_r($checkheader_row);exit;
			$csvCell = array(
			"1" => "A",
			"2" => "B",
			"3" => "C",
			"4" => "D",
			"5" => "E",
			"6" => "F",
			"7" => "G",     
			"8" => "H",
			"9" => "I",
			"10" => "J",
			"11" => "K",
			"12" => "L",
			"13" => "M",
			"14" => "N",
			"15" => "O",
			"16" => "P",
			"17" => "Q",
			"18" => "R",
			"19" => "S",
			"20" => "T",
			"21" => "U",
			"22" => "V",
			"23" => "W",
			"24" => "X",
			"25" => "Y",
			"26" => "Z",
			"27" => "AA",
			"28" => "AB",
			"29" => "AC",
			"30" => "AD",
			"31" => "AE",
			"32" => "AF",
			"33" => "AG",
			"34" => "AH",
			"35" => "AI",
			"36" => "AJ");
			// GET state country array to validation 
			$myCsvArr =array();
			$r= 0; $c=0;
			while (($datau = fgetcsv($duplihandle3, 1000, ",")) !== FALSE) {
				if($r==0){
					$r++;
					continue;
				}
				$c=0;
				$myCsvArr[$r];
				foreach ($datau as $index=>$val) {
					//#NG051 changes for windows unicode char  
				   // $myCsvArr[$r][$c]= htmlentities($val, ENT_QUOTES);
					$myCsvArr[$r][$c]= $val;
					$c++;
				}
				$r++;
			}
			array_multisort(array_column($myCsvArr, 33), SORT_ASC, $myCsvArr);
			
			while (($valdationdata = fgetcsv($duplihandle2, 2000, ",")) ) {
					$numcols = count($valdationdata);
					$this->set('numcols', $numcols);
				
				$blankrowerror=0;
				$row++;
				$this->set('totnumrows', $row);
			}
		
			// duplicate row in sheet 
			fclose($duplihandle2);
		} //$_FILES['importfiles']['name'] ;

		// for save in db
		if ($_FILES['importfiles']['name'] != "") {
			// check duplicate team data end  
			$uploadFilename = "import_" . $id . "_" . $org_id . "_" . $job_id . "_" . time() . ".csv";
			copy($_FILES['importfiles']['tmp_name'], $path . $uploadFilename);
				$tot = 0;
				$j  =  0;
				$row = 0;
				$plyrCntItrtnArry = array();                   
				$handle = fopen($_FILES["importfiles"]["tmp_name"], "r");
				//#NG051 changes for windows unicode char 
				$handle2 = fopen($_FILES["importfiles"]["tmp_name"], "r");
				//$handle2 = $this->utf8_fopen_read($_FILES["importfiles"]["tmp_name"], "r");
				$myCsvArr =array(); 
				$r         = 0; 
				$c         = 0;
				while (($datau = fgetcsv($handle2, 1000, ",")) !== FALSE) {
					if($r==0){
						$r++;
						continue;
					}
					$c=0;
					$myCsvArr[$r];
					foreach ($datau as $index=>$val) {
						//#NG051 changes for windows unicode char 
						//$myCsvArr[$r][$c]= htmlentities($val, ENT_QUOTES);
						$myCsvArr[$r][$c]= $val;
						$c++;
					}
					$r++;
				}
				array_multisort(array_column($myCsvArr, 33), SORT_ASC, $myCsvArr);
				//$io = 1;
				$setorinalprocode= "";
				while (($data = fgetcsv($handle, 2000, ",")) !== FALSE) {
					$data = $myCsvArr[$j];   
					/*echo"<br/>".$data[1];
					if($io >= 4){
						echo "<pre>d=".$io;
						print_r($data[1]); exit;
					}else{
						echo "<pre>s=".$io;
						print_r($data[1]);
					}*/
				
				   
					$sheetnum = count($data);
					for ($c=0; $c < $sheetnum; $c++) {
						$arr[$row][$c] = trim($valdationdata[$c]);
					}
					// Generate uid
					$uidArr = array(
						'A',
						'B',
						'C',
						'D',
						'E',
						'F',
						'G',
						'H',
						'I',
						'J',
						'K',
						'L',
						'M',
						'N',
						'O',
						'P',
						'Q',
						'R',
						'S',
						'T',
						'U',
						'V',
						'W',
						'X',
						'Y',
						'Z'
					);
				
					// $data[0] = html_entity_decode($data[0], ENT_QUOTES);
					 
					$data[0] = trim($data[0]);
					// Special Charater remove code
					//added this on date 09/14/2020 for remove the name issue like ???O???Neill??? they get this as a result ???O039Neill???.
					// $data[1] = html_entity_decode($data[1], ENT_QUOTES);
					// $data[2] = html_entity_decode($data[2], ENT_QUOTES);

					//$data[1] = preg_replace('/[^A-Za-z0-9\-\(\)\' ]/', '', $data[1]);
					//$data[2] = preg_replace('/[^A-Za-z0-9\-\(\)\' ]/', '', $data[2]);
					$data[31] = rtrim(trim($data[31]),',');
					$data[32] = rtrim(trim($data[32]),','); 
						$jobname = date('Y');               
						//Bdmember Table
						$this->bdmembers->create(array(
							'b_id'							=>'266',
							'firstname'						=>trim($data[1]),
							'lastname'						=>trim($data[2])
						));
						$this->bdmembers->save();
					$j++;
					$tot++;
					$lastclub = $org_id;
					$lastyear = $jobname;
					$row++;
					
				} //while (($data = fgetcsv($handle, 1000, ",")) !== FALSE){
			
			fclose($handle);
			$this->redirect(array('action'=>'import'));
		}
	}

	public function export($id=0) {
		$this->loadModel('bdmembers');
		$org_id=101;
		$job_id=201;
		$dtls = $this->bdmembers->find('all', array(
			'conditions'=>array(
				'b_id'=>'266'
			),
			'order' => 'id DESC',
			'limit' => 1000
			)
		);
		$this->set('dtls',$dtls);
		if ($this->request->data['downloadfile1'] != "") {
			$dtls = $this->bdmembers->find('all', array(
				'conditions'=>array(
					'b_id'=>'266'
				),
				'order' => 'id DESC',
				'limit' => 1000
				)
			);
			

            $filename = "exportroster.csv";
            ob_clean();
            $csv_file = fopen('php://output', 'w');
            header("Content-Type: application/csv");
            header('Content-Disposition: attachment; filename="'. $filename .'"');
            /*live templete for roster. */
            $header_row = array("Team",
            "First Name",
            "Last Name"
            );
			fputcsv($csv_file, $header_row, ',', '"');
			foreach($dtls as $key => $value){
				$header_row = array("Team",$value['bdmembers']['firstname'],$value['bdmembers']['lastname']);
				fputcsv($csv_file, $header_row, ',', '"');
			}
            fclose($csv_file);
            die;
         }

	}

	
	//#NG051 changes for windows unicode char start here 
    public function utf8_fopen_read($fileName) {      
		$fc=file_get_contents($fileName);
		$unwanted_array = array(
		   "??" => "-", "??" => "-", "??" => "-", "??" => "-",
		   "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A", "??" => "A",
		   "??" => "B", "??" => "B", "??" => "B",
		   "??" => "C", "??" => "C", "??" => "C", "??" => "C", "??" => "C", "??" => "C", "??" => "C", "??" => "C", "??" => "C",
		   "??" => "D", "??" => "D", "??" => "D", "??" => "D", "??" => "D",
		   "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E", "??" => "E",
		   "??" => "F", "??" => "F",
		   "??" => "G", "??" => "G", "??" => "G", "??" => "G", "??" => "G", "??" => "G", "??" => "G",
		   "??" => "H", "??" => "H", "??" => "H", "??" => "H", "??" => "H",
		   "I" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "I" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I", "??" => "I",
		   "??" => "J", "??" => "J",
		   "??" => "K", "??" => "K", "??" => "K", "??" => "K", "??" => "K",
		   "??" => "L", "??" => "L", "??" => "L", "??" => "L", "??" => "L", "??" => "L", "??" => "L",
		   "??" => "M", "??" => "M", "??" => "M",
		   "??" => "N", "??" => "N", "??" => "N", "??" => "N", "??" => "N", "??" => "N", "??" => "N", "??" => "N", "??" => "N",
		   "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O", "??" => "O",
		   "??" => "P", "??" => "P", "??" => "P",
		   "??" => "Q",
		   "??" => "R", "??" => "R", "??" => "R", "??" => "R", "??" => "R", "??" => "R",
		   "??" => "S", "??" => "S", "??" => "S", "??" => "S", "??" => "S", "??" => "S", "??" => "S",
		   "??" => "T", "??" => "T", "??" => "T", "??" => "T", "??" => "T", "??" => "T", "??" => "T",
		   "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U", "??" => "U",
		   "??" => "V", "??" => "V",
		   "??" => "Y", "??" => "Y", "??" => "Y", "??" => "Y",
		   "??" => "Z", "??" => "Z", "??" => "Z", "??" => "Z", "??" => "Z",
		   "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a", "??" => "a",
		   "??" => "b", "??" => "b", "??" => "b",
		   "??" => "c", "??" => "c", "??" => "c", "??" => "c", "??" => "c", "??" => "c", "??" => "c", "??" => "c", "??" => "c",
		   "??" => "ch", "??" => "ch",
		   "??" => "d", "??" => "d", "??" => "d", "??" => "d", "??" => "d",
		   "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e", "??" => "e",
		   "??" => "f", "??" => "f",
		   "??" => "g", "??" => "g", "??" => "g", "??" => "g", "??" => "g", "??" => "g", "??" => "g",
		   "??" => "h", "??" => "h", "??" => "h", "??" => "h", "??" => "h",
		   "i" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i", "??" => "i",
		   "??" => "j", "??" => "j", "??" => "j", "??" => "j",
		   "??" => "k", "??" => "k", "??" => "k", "??" => "k", "??" => "k",
		   "??" => "l", "??" => "l", "??" => "l", "??" => "l", "??" => "l", "??" => "l", "??" => "l",
		   "??" => "m", "??" => "m", "??" => "m",
		   "??" => "n", "??" => "n", "??" => "n", "??" => "n", "??" => "n", "??" => "n", "??" => "n", "??" => "n", "??" => "n",
		   "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o", "??" => "o",
		   "??" => "p", "??" => "p", "??" => "p",
		   "??" => "q",
		   "??" => "r", "??" => "r", "??" => "r", "??" => "r", "??" => "r", "??" => "r",
		   "??" => "s", "??" => "s", "??" => "s", "??" => "s", "??" => "s", "??" => "s", "??" => "s",
		   "??" => "t", "??" => "t", "??" => "t", "??" => "t", "??" => "t", "??" => "t", "??" => "t",
		   "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u", "??" => "u",
		   "??" => "v", "??" => "v",
		   "??" => "y", "??" => "y", "??" => "y", "??" => "y",
		   "??" => "z", "??" => "z", "??" => "z", "??" => "z", "??" => "z", "??" => "z",
		   "???" => "tm",
		   "??" => "ae", "??" => "ae", "??" => "ae", "??" => "ae", "??" => "ae",
		   "??" => "ij", "??" => "ij",
		   "??" => "ja", "??" => "ja",
		   "??" => "je", "??" => "je",
		   "??" => "jo", "??" => "jo",
		   "??" => "ju", "??" => "ju",
		   "??" => "oe", "??" => "oe", "??" => "oe", "??" => "oe",
		   "??" => "sch", "??" => "sch",
		   "??" => "sh", "??" => "sh",
		   "??" => "ss",
		   "??" => "ue",
		   "??" => "zh", "??" => "zh",
	   ); 

	   $unwanted_array1 = array('???'=>"'",'???'=>"'",'???'=>"'", '???'=>'"', '???'=>'"');
	   $fc = strtr($fc, $unwanted_array);
	   $fc = strtr($fc, $unwanted_array1);
	   $fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName));
	   $fc =iconv("UTF-8", "ASCII//TRANSLIT", $fc);
	   if (strlen($fc)==0){  
		   $fc=file_get_contents($fileName);
		   $fc = mb_convert_encoding($fc,  'HTML-ENTITIES', 'ISO-8859-1'); // it works but table save another format
		   $fc = iconv('ISO-8859-1', 'utf-8//IGNORE', $fc);
	   }
	   $handle=fopen("php://memory", "rw");
	   fwrite($handle, $fc);
	   fseek($handle, 0);
	   return $handle;
	   
   }

}