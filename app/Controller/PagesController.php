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
	public function index($id=0) {

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


		$this->loadModel('bdmembers');
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

}