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
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		if (in_array('..', $path, true) || in_array('.', $path, true)) {
			throw new ForbiddenException();
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
	public function listing($id=0) {
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
	}

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
			// Added by priyanka 10/04/2018
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

		// for save in dv
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
					//added this on date 09/14/2020 for remove the name issue like “O’Neill” they get this as a result “O039Neill”.
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


	//#NG051 changes for windows unicode char start here 
    public function utf8_fopen_read($fileName) {
      
		$fc=file_get_contents($fileName);
		$unwanted_array = array(
		   "ъ" => "-", "ь" => "-", "Ъ" => "-", "Ь" => "-",
		   "А" => "A", "Ă" => "A", "Ǎ" => "A", "Ą" => "A", "À" => "A", "Ã" => "A", "Á" => "A", "Æ" => "A", "Â" => "A", "Å" => "A", "Ǻ" => "A", "Ā" => "A", "א" => "A",
		   "Б" => "B", "ב" => "B", "Þ" => "B",
		   "Ĉ" => "C", "Ć" => "C", "Ç" => "C", "Ц" => "C", "צ" => "C", "Ċ" => "C", "Č" => "C", "©" => "C", "ץ" => "C",
		   "Д" => "D", "Ď" => "D", "Đ" => "D", "ד" => "D", "Ð" => "D",
		   "È" => "E", "Ę" => "E", "É" => "E", "Ë" => "E", "Ê" => "E", "Е" => "E", "Ē" => "E", "Ė" => "E", "Ě" => "E", "Ĕ" => "E", "Є" => "E", "Ə" => "E", "ע" => "E",
		   "Ф" => "F", "Ƒ" => "F",
		   "Ğ" => "G", "Ġ" => "G", "Ģ" => "G", "Ĝ" => "G", "Г" => "G", "ג" => "G", "Ґ" => "G",
		   "ח" => "H", "Ħ" => "H", "Х" => "H", "Ĥ" => "H", "ה" => "H",
		   "I" => "I", "Ï" => "I", "Î" => "I", "Í" => "I", "Ì" => "I", "Į" => "I", "Ĭ" => "I", "I" => "I", "И" => "I", "Ĩ" => "I", "Ǐ" => "I", "י" => "I", "Ї" => "I", "Ī" => "I", "І" => "I",
		   "Й" => "J", "Ĵ" => "J",
		   "ĸ" => "K", "כ" => "K", "Ķ" => "K", "К" => "K", "ך" => "K",
		   "Ł" => "L", "Ŀ" => "L", "Л" => "L", "Ļ" => "L", "Ĺ" => "L", "Ľ" => "L", "ל" => "L",
		   "מ" => "M", "М" => "M", "ם" => "M",
		   "Ñ" => "N", "Ń" => "N", "Н" => "N", "Ņ" => "N", "ן" => "N", "Ŋ" => "N", "נ" => "N", "ŉ" => "N", "Ň" => "N",
		   "Ø" => "O", "Ó" => "O", "Ò" => "O", "Ô" => "O", "Õ" => "O", "О" => "O", "Ő" => "O", "Ŏ" => "O", "Ō" => "O", "Ǿ" => "O", "Ǒ" => "O", "Ơ" => "O",
		   "פ" => "P", "ף" => "P", "П" => "P",
		   "ק" => "Q",
		   "Ŕ" => "R", "Ř" => "R", "Ŗ" => "R", "ר" => "R", "Р" => "R", "®" => "R",
		   "Ş" => "S", "Ś" => "S", "Ș" => "S", "Š" => "S", "С" => "S", "Ŝ" => "S", "ס" => "S",
		   "Т" => "T", "Ț" => "T", "ט" => "T", "Ŧ" => "T", "ת" => "T", "Ť" => "T", "Ţ" => "T",
		   "Ù" => "U", "Û" => "U", "Ú" => "U", "Ū" => "U", "У" => "U", "Ũ" => "U", "Ư" => "U", "Ǔ" => "U", "Ų" => "U", "Ŭ" => "U", "Ů" => "U", "Ű" => "U", "Ǖ" => "U", "Ǜ" => "U", "Ǚ" => "U", "Ǘ" => "U",
		   "В" => "V", "ו" => "V",
		   "Ý" => "Y", "Ы" => "Y", "Ŷ" => "Y", "Ÿ" => "Y",
		   "Ź" => "Z", "Ž" => "Z", "Ż" => "Z", "З" => "Z", "ז" => "Z",
		   "а" => "a", "ă" => "a", "ǎ" => "a", "ą" => "a", "à" => "a", "ã" => "a", "á" => "a", "æ" => "a", "â" => "a", "å" => "a", "ǻ" => "a", "ā" => "a", "א" => "a",
		   "б" => "b", "ב" => "b", "þ" => "b",
		   "ĉ" => "c", "ć" => "c", "ç" => "c", "ц" => "c", "צ" => "c", "ċ" => "c", "č" => "c", "©" => "c", "ץ" => "c",
		   "Ч" => "ch", "ч" => "ch",
		   "д" => "d", "ď" => "d", "đ" => "d", "ד" => "d", "ð" => "d",
		   "è" => "e", "ę" => "e", "é" => "e", "ë" => "e", "ê" => "e", "е" => "e", "ē" => "e", "ė" => "e", "ě" => "e", "ĕ" => "e", "є" => "e", "ə" => "e", "ע" => "e",
		   "ф" => "f", "ƒ" => "f",
		   "ğ" => "g", "ġ" => "g", "ģ" => "g", "ĝ" => "g", "г" => "g", "ג" => "g", "ґ" => "g",
		   "ח" => "h", "ħ" => "h", "х" => "h", "ĥ" => "h", "ה" => "h",
		   "i" => "i", "ï" => "i", "î" => "i", "í" => "i", "ì" => "i", "į" => "i", "ĭ" => "i", "ı" => "i", "и" => "i", "ĩ" => "i", "ǐ" => "i", "י" => "i", "ї" => "i", "ī" => "i", "і" => "i",
		   "й" => "j", "Й" => "j", "Ĵ" => "j", "ĵ" => "j",
		   "ĸ" => "k", "כ" => "k", "ķ" => "k", "к" => "k", "ך" => "k",
		   "ł" => "l", "ŀ" => "l", "л" => "l", "ļ" => "l", "ĺ" => "l", "ľ" => "l", "ל" => "l",
		   "מ" => "m", "м" => "m", "ם" => "m",
		   "ñ" => "n", "ń" => "n", "н" => "n", "ņ" => "n", "ן" => "n", "ŋ" => "n", "נ" => "n", "ŉ" => "n", "ň" => "n",
		   "ø" => "o", "ó" => "o", "ò" => "o", "ô" => "o", "õ" => "o", "о" => "o", "ő" => "o", "ŏ" => "o", "ō" => "o", "ǿ" => "o", "ǒ" => "o", "ơ" => "o",
		   "פ" => "p", "ף" => "p", "п" => "p",
		   "ק" => "q",
		   "ŕ" => "r", "ř" => "r", "ŗ" => "r", "ר" => "r", "р" => "r", "®" => "r",
		   "ş" => "s", "ś" => "s", "ș" => "s", "š" => "s", "с" => "s", "ŝ" => "s", "ס" => "s",
		   "т" => "t", "ț" => "t", "ט" => "t", "ŧ" => "t", "ת" => "t", "ť" => "t", "ţ" => "t",
		   "ù" => "u", "û" => "u", "ú" => "u", "ū" => "u", "у" => "u", "ũ" => "u", "ư" => "u", "ǔ" => "u", "ų" => "u", "ŭ" => "u", "ů" => "u", "ű" => "u", "ǖ" => "u", "ǜ" => "u", "ǚ" => "u", "ǘ" => "u",
		   "в" => "v", "ו" => "v",
		   "ý" => "y", "ы" => "y", "ŷ" => "y", "ÿ" => "y",
		   "ź" => "z", "ž" => "z", "ż" => "z", "з" => "z", "ז" => "z", "ſ" => "z",
		   "™" => "tm",
		   "Ä" => "ae", "Ǽ" => "ae", "ä" => "ae", "æ" => "ae", "ǽ" => "ae",
		   "ĳ" => "ij", "Ĳ" => "ij",
		   "я" => "ja", "Я" => "ja",
		   "Э" => "je", "э" => "je",
		   "ё" => "jo", "Ё" => "jo",
		   "ю" => "ju", "Ю" => "ju",
		   "œ" => "oe", "Œ" => "oe", "ö" => "oe", "Ö" => "oe",
		   "щ" => "sch", "Щ" => "sch",
		   "ш" => "sh", "Ш" => "sh",
		   "ß" => "ss",
		   "Ü" => "ue",
		   "Ж" => "zh", "ж" => "zh",
	   ); // by pp

	   $unwanted_array1 = array('’'=>"'",'‘'=>"'",'�'=>"'", '”'=>'"', '“'=>'"');
	   // // üäöÖßàáâãùúûÙÚÛÜòóôèéêëÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕØåæçìíîïðñõ'øýÿ"€ // Copy 
	   // // üäöÖßàáâãùúûÙÚÛÜòóôèéêë”()ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÑÒÓÔÕ’Øåæçìíîïðñõøý'ÿ"€  // Window
	   $fc = strtr($fc, $unwanted_array);// by pp
	   $fc = strtr($fc, $unwanted_array1);// by pp
	   // $fc = str_replace(['\’','�','\‘',""], "\'", $fc);
	   // $fc = str_replace(['\“','\”'], '\"', $fc);
	   // // $fc = iconv('ISO-8859-15', 'UTF-8//TRANSLIT', $fc); 
	   $fc = iconv('windows-1250', 'utf-8', file_get_contents($fileName));
	   $fc =iconv("UTF-8", "ASCII//TRANSLIT", $fc);
	   //$fc = iconv('ISO-8859-1', 'UTF-8', $fc);old comment
	   
	   if (strlen($fc)==0){
		  
		   $fc=file_get_contents($fileName);
		   $fc = mb_convert_encoding($fc,  'HTML-ENTITIES', 'ISO-8859-1'); // it works but table save another format
		   // $fc = str_replace(['“','”'], '"', $fc);
		   // $fc = str_replace(["ÃŒ&#129;"], "Ì", $fc);
		   // $fc = str_replace(["&#146;","&#129;"], "'", $fc);
					  
		   // $fc = mb_convert_encoding($fc,  'HTML-ENTITIES', 'ISO-8859-1'); // it works but table save
		   // $fc = mb_convert_encoding($fc,  'ISO-8859-1','utf-8'); // it works but table save converted form
		   // $fc = iconv('ISO-8859-1', 'utf-8',$fc);
		   // $fc =iconv("UTF-8", "ASCII//TRANSLIT", $fc);
		   // $fc = htmlspecialchars_decode(utf8_decode(htmlentities($fc, ENT_COMPAT, 'utf-8', true)));
		   // $fc = mb_convert_encoding($fc,  'ISO-8859-1', 'HTML-ENTITIES'); // it works but table save 
		   // $fc = strtr($fc, $unwanted_array);// by pp
		   // $fc =  mb_convert_encoding($fc, 'ISO-8859-1', mb_detect_encoding($fc, 'ISO-8859-1', true));
		   // $fc = htmlentities($fc);
		   $fc = iconv('ISO-8859-1', 'utf-8//IGNORE', $fc);
		   // $fc = preg_replace('’', "'", $fc);
		   //$fc = str_replace("’","'", $fc);
		   
		   // $fc=utf8_encode ($fc);
	   }
	   // echo phpinfo();
	 
	   // echo "<pre>";
	   // print_r($fc);
	   // echo strlen($fc);exit;
	  
	  
	   $handle=fopen("php://memory", "rw");
	   fwrite($handle, $fc);
	   fseek($handle, 0);
	   return $handle;
	   
   }

}