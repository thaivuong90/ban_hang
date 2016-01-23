<?php

/**
 * Admin
 *
 * Class xá»­ lÃ½ admin
 */
require_once(APPPATH . 'controllers/common.php');

class Admin extends Common {

	public $model = '';
	/**
	 * __construct
	 */
	public function __construct() {
		parent::__construct();

		if ($this->my_login->checkLogin($this->arrCommon, URL_ADMIN_LOGIN)) {
			$this->access();
		}
	}

	/**
	 * access
	 */
	private function access() {
		$arrAccess      = array();
		$arrAcceptAcess = array(
		base_url().URL_ADMIN_LOGOUT,
		base_url().URL_ADMIN_DENY,
		base_url().'admin/test',
		base_url().'admin',
		base_url().'admin/',
		);
		$this->arrCommon = array_merge($this->arrCommon, $this->roles_model->getAccessUrl($this->arrCommon['role_id']));
		$checkUrl  = base_url().$this->uri->segment(1).'/'.$this->uri->segment(2);
		if($this->uri->segment(3) != '' && !is_numeric($this->uri->segment(3))) {
			$checkUrl = $checkUrl.'/'.$this->uri->segment(3);
		}
		if(in_array($checkUrl,$arrAcceptAcess) || in_array($checkUrl,$this->arrCommon['url_access'])) {

			// Left menu
			$this->leftMenu();
			return;
		}
		show_404();
	}

	/**
	 * showTopButton
	 */
	private function showTopButton() {

		$this->arrCommon['addFlg'] 			= false;
		$this->arrCommon['saveFlg'] 		= false;
		$this->arrCommon['trashFlg'] 		= false;
		$this->arrCommon['visibleFlg'] 		= false;
		$this->arrCommon['hiddenFlg'] 		= false;
		$this->arrCommon['deleteFlg'] 		= false;
		$this->arrCommon['printOrderFlg'] 	= false;
		$this->arrCommon['refreshFlg']	 	= false;
		$this->arrCommon['destroyOrderFlg']	= false;
		$this->arrCommon['replyFlg']		= false;
		$this->arrCommon['sendFlg']			= false;
		$this->arrCommon['sentFlg']			= false;
		$this->arrCommon['backFlg']			= false;
		$this->arrCommon['deleteDbFlg']		= false;
		$root_url = isset($this->arrCommon['backUrl']) ? $this->arrCommon['backUrl'] : '';
		
		// Show init button
		if($this->arrCommon['mode'] == MODE_INIT || $this->arrCommon['mode'] == MODE_SEARCH) {
			if(in_array($root_url.'/'.MODE_ADD,$this->arrCommon['url_access'])) {
				$this->arrCommon['addFlg'] 		    = true;
			}
			if(in_array($root_url.'/'.MODE_TRASH,$this->arrCommon['url_access'])) {
				// Show trash button
				$this->arrCommon['trashFlg'] 		    = true;
			}
			if((in_array($root_url.'/'.MODE_ENABLE,$this->arrCommon['url_access']) ||
			in_array($root_url.'/'.MODE_DISABLE,$this->arrCommon['url_access']))) {
				// Show visible/hidden button
				$this->arrCommon['visibleFlg'] 		= true;
				$this->arrCommon['hiddenFlg'] 		= true;
			}
			if(in_array($root_url.'/'.MODE_DELETE,$this->arrCommon['url_access'])) {
				// Show trash button
				$this->arrCommon['deleteFlg'] 		    = true;
			}
				
			if(in_array($root_url.'/'.MODE_CHANGE_STATUS,$this->arrCommon['url_access'])) {
				// Show destroy order button
				$this->arrCommon['destroyOrderFlg'] 		    = true;
			}

			if(in_array($root_url.'/'.MODE_SENT,$this->arrCommon['url_access'])) {
				// Show destroy order button
				$this->arrCommon['sentFlg'] 		    = true;
			}
		}

		// Show refresh button
		if($this->arrCommon['mode'] == MODE_TRASH) {
			$this->arrCommon['refreshFlg']	 	= true;
			$this->arrCommon['backFlg']	 		= true;
			$this->arrCommon['deleteDbFlg']		= true;
		}

		// Show save button
		if( $this->arrCommon['mode'] == MODE_ADD 	 		||
		$this->arrCommon['mode'] == MODE_EDIT 	 		||
		$this->arrCommon['mode'] == MODE_PROFILE 		||
		$this->arrCommon['mode'] == MODE_SETTING 		||
		$this->arrCommon['mode'] == MODE_CHANGE_PASSWORD ) {

			if($this->arrCommon['table'] != 'contacts') {
				$this->arrCommon['saveFlg'] = true;
			} else {
				$this->arrCommon['replyFlg'] = true;
			}

			if( $this->arrCommon['mode'] == MODE_ADD 	 		||
			$this->arrCommon['mode'] == MODE_EDIT) {
				$this->arrCommon['backFlg'] = true;
			}
			
			// Show button print
			if(in_array($root_url.'/'.MODE_PRINT,$this->arrCommon['url_access'])) {
				// Show trash button
				$this->arrCommon['printOrderFlg'] 		    = true;
			}
		}

		// Show save button
		if( $this->arrCommon['mode'] == MODE_REPLY) {
			$this->arrCommon['sendFlg'] = true;
			$this->arrCommon['backFlg'] = true;
		}
	}

	/**
	 * leftMenu
	 */
	private function leftMenu() {
		$leftMenu = '';
		createLeftMenu($leftMenu);
		$this->arrCommon['left_menu'] = $leftMenu;
	}

	/**
	 * index
	 */
	public function index() {
		$this->showTopButton();
		$this->arrCommon['dashboard'] = $this->common_model->getInfoDashboard();
		$this->loadPage();
	}

	/**
	 * categories
	 *
	 * Quáº£n lÃ½ danh má»¥c SP
	 */
	public function categories($action = '', $id = '') {
		$this->action($action,$id);
	}

	/**
	 * categories
	 *
	 * Quáº£n lÃ½ danh má»¥c SP
	 */
	public function brands($action = '', $id = 0) {

		$this->action($action,$id);
	}

	/**
	 * slides
	 *
	 * Quáº£n lÃ½ danh má»¥c SP
	 */
	public function slides($action = '', $id = 0) {

		$this->action($action,$id);
	}

	/**
	 * slides
	 *
	 * Quáº£n lÃ½ danh má»¥c SP
	 */
	public function advs($action = '', $id = 0) {

		$this->action($action,$id);
	}

	/**
	 * products
	 *
	 * Quáº£n lÃ½ sáº£n pháº©m
	 */
	public function products($action = '', $id = '') {
		$this->action($action, $id);
	}

	/**
	 * users
	 *
	 * Quáº£n lÃ½ tÃ i khoáº£n
	 */
	public function users($action = '', $id = '') {
		$this->action($action, $id);
	}

	/**
	 * titles
	 *
	 * Quáº£n lÃ½ chá»§ Ä‘á»�
	 */
	public function titles($action = '', $id = '') {
		$this->action($action, $id);
	}

	/**
	 * roles
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function roles($action = '', $id = '') {
		$this->action($action,$id);
	}

	/**
	 * orders
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function orders($action = '', $id = '') {
		$this->action($action,$id);
	}

	/**
	 * modules
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function modules($action = '', $id = '') {

		$this->action($action, $id);
	}

	/**
	 * menus
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function menus($action = '', $id = '') {

		$this->action($action, $id);
	}

	/**
	 * settings
	 *
	 * @param $action
	 * @param $id
	 */
	public function webinfo($action = '', $id = '') {
		$system_id = getSettingInfo('system_id');
		$this->arrCommon['mode']	  = MODE_SETTING;
		$this->showTopButton();
		if(count($this->arrCommon['settings']) == 0) {
			$this->arrCommon['settings']['system_id'] = $system_id;
			$this->arrCommon['settings']['webtitle'] = '';
			$this->arrCommon['settings']['keywords'] = '';
			$this->arrCommon['settings']['desc'] = '';
			$this->arrCommon['settings']['protocol'] = '';
			$this->arrCommon['settings']['port'] = '';
			$this->arrCommon['settings']['host'] = '';
			$this->arrCommon['settings']['mailuser'] = '';
			$this->arrCommon['settings']['mailpassword'] = '';
			$this->arrCommon['settings']['starttls'] = '';
			$this->arrCommon['settings']['mailtype'] = '';
			$this->arrCommon['settings']['baseurl'] = '';
		} else {
			$system_id = $this->arrCommon['settings']['system_id'];
		}
			
		if($this->input->post() && $this->setValidate($this->arrCommon)) {
			$arrForm = $this->input->post();
			$arrInput= array();
			foreach($arrForm as $key=>$vl) {
				if(strpos($key, 'rules') == 0) {
					$arrInput['data'][$key] = $vl;
				}
			}

			if($this->settings_model->getInsertUpdate($arrInput)) {
				$this->setMessage(LTV0002, 'success');
				redirect(current_url());
			}
		}
		$this->loadPage();
	}

	/**
	 * news
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function news($action = '', $id = '') {

		$this->action($action, $id);
	}

	/**
	 * files
	 */
	public function files($action = '', $id = '') {
		$this->action($action, $id);
	}

	/**
	 * contacts
	 *
	 * @param type $action
	 * @param type $id
	 */
	public function contacts($action = '', $id = '') {

		$this->action($action, $id);
	}

	/**
	 * import
	 */
	private function import() {
		$this->arrCommon['mode'] = MODE_IMPORT;
		if($this->input->post()) {
			$model  = $this->arrCommon['table'] . '_model';
			$data   = array();
			$header = array();
			if($this->uploadFiles()) {

				$file = './'.$this->arrCommon['upload_path'].'/'.$this->arrCommon['upload_file_name'];
				//read file from path
				$objPHPExcel = PHPExcel_IOFactory::load($file);
				//get only the Cell Collection
				$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
				//extract to a PHP readable array format
				foreach ($cell_collection as $cell) {
					$column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
					$row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
					$data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
					//header will/should be in row 1 only. of course this can be modified to suit your need.
					if ($row == 1) {
						$header[$row][$column] = $data_value;
					} else {
						$data[$row][$header[1][$column]] = $data_value;
					}
				}
				if($this->$model->import($data)) {
					$this->setMessage(LTV00076, 'success');
					redirect($this->arrCommon['backUrl']);
				}
			}
		}
	}

	/**
	 * csv
	 */
	private function csv() {
		//activate worksheet number 1
		$this->my_excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->my_excel->getActiveSheet()->setTitle('test worksheet');
		//set cell A1 content with some text
		$this->my_excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
		//change the font size
		$this->my_excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
		//make the font become bold
		$this->my_excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->my_excel->getActiveSheet()->mergeCells('A1:D1');
		//set aligment to center for that merged cell (A1 to D1)
		$this->my_excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$filename='just_some_random_name.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (Excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->my_excel, 'Excel5');
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	/**
	 * init
	 */
	private function init() {
		
		$model      = $this->arrCommon['table'] . '_model';
		$this->destroySession('search_conditions');
		$arrConditions = array();
		$arrConditions['current_role_id'] = $this->arrCommon['role_id'];

		// Search data đã xóa
		if($this->arrCommon['mode'] == MODE_TRASH) {
			$arrConditions['delete_flg'] = 1;
		} else {
			$arrConditions['delete_flg'] = 0;
		}

		// Search các liên lạc của users
		if($this->arrCommon['table'] == 'contacts') {
			$arrConditions['type'] = 0;
		}

		// Search các liên lạc đã gửi
		if($this->arrCommon['mode'] == MODE_SENT) {
			$arrConditions['type'] = 1;
		}

		// Hiển thị icon thùng rác rỗng hoặc đầy
		$trash_cnt = $this->$model->search(array('delete_flg' => 1));
		if(count($trash_cnt) > 0) {
			$this->arrCommon['trash_class'] = 'icon_trash';
		} else {
			$this->arrCommon['trash_class'] = 'icon_trash_empty';
		}

		// Search data có phân trang
		$start = $this->uri->segment(3) && is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		if($start > 0) {
			$start = ($start - 1) * $this->arrCommon['rowPerPage'];
		}
		$this->arrCommon['totalRows']   = $this->$model->search($arrConditions, 'count');
		$arrConditions['start']         = $start;
		$arrConditions['end']           = $this->arrCommon['rowPerPage'];

		$this->arrCommon['data']        = $this->$model->search($arrConditions);
		$this->arrCommon['page_links']  = $this->my_paging->createPagination($this->arrCommon['totalRows'], $this->arrCommon['rowPerPage'], 3);

	
	}

	/**
	 * doSearch
	 */
	private function search() {

		$model      = $this->arrCommon['table'] . '_model';

		$arrConditions = array();
		$arrConditions['current_role_id'] = $this->arrCommon['role_id'];

		// Khi click button Search
		if ($this->input->post()) {
			if($this->input->post('search_id') != '') {
				$arrConditions['id']        = safe_data('search_id');
			}
			if($this->input->post('search_name') != '') {
				$arrConditions['name']        = replaceUnicode(safe_data('search_name'));
			}
			if($this->input->post('datefrom') != '') {
				$arrConditions['datefrom']        = safe_data('datefrom');
			}
			if($this->input->post('dateto') != '') {
				$arrConditions['dateto']        = safe_data('dateto');
			}
			if($this->input->post('publishfrom') != '') {
				$arrConditions['publishfrom']        = safe_data('publishfrom');
			}
			if($this->input->post('publishto') != '') {
				$arrConditions['publishto']        = safe_data('publishto');
			}
			if($this->input->post('search_id') != '') {
				$arrConditions['id']        = safe_data('search_id');
			}
			if($this->input->post('category_id') != '') {
				$arrConditions['category_id']        = safe_data('category_id');
			}
			if($this->input->post('parent') != '') {
				$arrConditions['parent']        = safe_data('parent');
			}
			if($this->input->post('brand_id') != '') {
				$arrConditions['brand_id']        = safe_data('brand_id');
			}
			if($this->input->post('search_status') != '') {
				$arrConditions['status']        = safe_data('search_status');
			}
			if($this->input->post('search_username') != '') {
				$arrConditions['username']        = safe_data('search_username');
			}
			if($this->input->post('role_id') != '') {
				$arrConditions['role_id']        = safe_data('role_id');
			}
			if($this->input->post('search_email') != '') {
				$arrConditions['email']        = safe_data('search_email');
			}
			if($this->input->post('search_author') != '') {
				$arrConditions['author']        = safe_data('search_author');
			}

			$this->session->set_userdata('search_conditions',$arrConditions);
		} else if($this->session->userdata('search_conditions')) {
			$arrConditions = $this->session->userdata('search_conditions');
		}

		// Hiển thị icon thùng rác rỗng hoặc đầy
		$trash_cnt = $this->$model->search(array('delete_flg' => 1));
		if(count($trash_cnt) > 0) {
			$this->arrCommon['trash_class'] = 'icon_trash';
		} else {
			$this->arrCommon['trash_class'] = 'icon_trash_empty';
		}

		// Search data có phân trang
		$start = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
		if($start > 0) {
			$start = ($start - 1) * $this->arrCommon['rowPerPage'];
		}
		
		$this->arrCommon['totalRows']   = $this->$model->search($arrConditions, 'count');
		$arrConditions['start']         = $start;
		$arrConditions['end']           = $this->arrCommon['rowPerPage'];
		$this->arrCommon['data']        = $this->$model->search($arrConditions);
		$this->arrCommon['page_links']  = $this->my_paging->createPagination($this->arrCommon['totalRows'], $this->arrCommon['rowPerPage'], 4, MODE_SEARCH);

	}

	/**
	 * action
	 */
	private function action($action = '',$id = '') {
		// Get model name
		$model = $this->uri->segment(2).'_model';

		// Get current action
		$this->arrCommon['mode'] = $action != '' ? $action : MODE_INIT;
		if(is_numeric($action)) {
			$this->arrCommon['mode'] = MODE_INIT;
		}
		$this->setSelectData();
		// Phan dinh mode
		switch ($this->arrCommon['mode']) {
			case MODE_DELETE_DB:
				$this->deleteDB();
				break;
			case MODE_FILE_MANAGER:
				$this->fileManager($id);
				break;
			case MODE_SEARCH:
				$this->search();
				break;
				
			case MODE_INIT:
			case MODE_TRASH:
			case MODE_SENT:
				$this->init();
				break;

			case MODE_ENABLE:
				$this->changeStatus();
				break;
			case MODE_DISABLE:
				$this->changeStatus(0);
				break;

			case MODE_REFRESH:
				$this->updateDeleteFlg();
				break;

			case MODE_DELETE:
				$this->updateDeleteFlg(1);
				break;

			case MODE_IMPORT:
				$this->import();
				break;

			case MODE_ADD:
			case MODE_EDIT:
			case MODE_CONFIRM:
				$this->confirm($id);
				break;

			case MODE_CSV:
				$this->csv();
				break;

			case MODE_PDF:
				break;

			case MODE_PRINT:
				$this->printOrder();
				break;

			case MODE_LOGIN:
				$this->logIn();
				break;
			case MODE_LOGOUT:
				$this->logOut();
				break;
			case MODE_FORGOT_PASSWORD:
				$this->forgotPassword();
				break;
			case MODE_CHANGE_PASSWORD:
				$this->changePassword();
				break;

			case MODE_PROFILE:
				$this->profile();
				break;

			case MODE_REPLY:
				$this->reply($id);
				break;
					
		}
		$this->showTopButton();
		$this->loadPage();
	}

	/**
	 * reply
	 * Trả lời thư
	 */
	private function reply($id) {
		$this->arrCommon['form_data'] = $this->contacts_model->getOne(array('id' => $id));
		if($this->input->post() && $this->setValidate($this->arrCommon)) {
			$arrForm = $this->input->post();
			foreach($arrForm as $key=>$vl) {
				if(strpos($key, 'rules') == 0) {
					$arrInput['data'][$key] = $vl;
				}
			}
			if($this->contacts_model->getInsertUpdate($arrInput)) {
				$arrSendMail = array(
							'to'		=>	$arrInput['data']['email'],
							'subject'	=>	'Reply to: '.$arrInput['data']['email'],
							'content'	=>	$arrInput['data']['content'],
				);
				$this->my_sendmail->sendMail($arrSendMail);
				$this->setMessage(LTV00022, 'success');
				redirect($this->arrCommon['backUrl']);
			}
		}
	}

	/**
	 * printOrder
	 * In đơn hàng
	 */
	private function printOrder() {
		$this->arrCommon['form_data'] = $this->orders_model->search(array('id' => $id),'detail');
		$day = date('d', strtotime('-8 hour', strtotime(date('Y-m-d H:i:s'))));
		$month = date('m', strtotime('-8 hour', strtotime(date('Y-m-d H:i:s'))));
		$year = date('Y', strtotime('-8 hour', strtotime(date('Y-m-d H:i:s'))));
		$this->arrCommon['form_data'][0]['print_date'] = 'Ngày '.$day.' tháng '.$month.' năm '.$year;
	}

	/**
	 * deleteDB
	 * Xóa trong database
	 */
	private function deleteDB() {
		$checked = safe_data('checkAll');
		if($this->common_model->deleteDb($this->arrCommon['table'],$checked)) {
			$this->setMessage(LTV00051, 'success');
			redirect($this->arrCommon['backUrl'].'/'.MODE_TRASH);
		}
	}
	/**
	 * confirm
	 * Xử lý add/edit record
	 */
	private function confirm($id = '') {
		$model = $this->uri->segment(2).'_model';
		if ($this->arrCommon['mode'] == MODE_EDIT && is_numeric($id)) {

			$arrWheres = array(
                        'id' => $id,
			);
			$this->arrCommon['form_data'] = $this->$model->search($arrWheres,'detail');

		} else {
			$this->arrCommon['form_data'] = array(
                        'id'        =>  '',
                        'name'      =>  '',
                        'status'    =>  1,
                        'price'     =>  0,
                        'discount'  =>  0,
                        'desc'      =>  '',
                        'brand_id'  =>  '',
                        'url'       =>  '',
                        'is_group'  =>  0,
                        'publish_at'=>  cnvStringToDate(getCurrentDt(),'dd-mm-yyyy'),
                        'address'   =>  '',
                        'phone'     =>  '',
                        'email'     =>  '',
                        'username'  =>  '',
                        'role_id'   =>  '',
                        'content'   =>  '',
                        'is_published' => 0,
						'author'	=>	'',
						'content'	=>  '',
						'order_by'	=>	-1,
						'file_url'	=>	base_url(NO_IMG_URL),
						'file_id'	=>	"",
						'logo_id'	=>	"",
						'ico_id'	=>	"",
						'start_at'	=>	cnvStringToDate(getCurrentDt(),'dd-mm-yyyy'),
						'finish_at'	=>	cnvStringToDate(getCurrentDt(),'dd-mm-yyyy'),
						'other_file_url'	=>	"",
						'files_id'	=>	"",
						'meta_title'=>  "",
						'meta_keywords' => "",
						'meta_desc' => ""
						);
		}
		$this->setSelectData();
		// Submit form
		if ($this->input->post() && $this->setValidate($this->arrCommon)) {
			$arrForm = $this->input->post();
			// On form
			$arrNotSubmit = array(
                        'datefrom','dateto','search','search_id','confpass','count','removeList','removeDb'
            );
                        $arrInput = array();
                        foreach($arrForm as $key=>$vl) {
                        	if(strpos($key, 'rules') == 0 && !in_array($key,$arrNotSubmit)) {

                        		switch($key) {
                        			case 'publish_at':
                        				$arrInput['data'][$key] = cnvDateToString($vl);
                        				break;
                        			case 'modules':
                        				$arrInput['data']['modules'] = $vl;
                        				break;
                        			default:
                        				$arrInput['data'][$key] = $vl;
                        				break;
                        		}
                        	}

                        	if(!isset($arrForm['status'])) {
                        		$arrInput['data']['status'] = 0;
                        	}
                        }
                        if($this->$model->getInsertUpdate($arrInput)) {
                        	$this->setMessage(LTV0002, 'success');
                        }
                        redirect(current_url());
		}
	}

	/**
	 * fileManager
	 * Quản lý tập tin và thư mục
	 * @param int $typeWindow (phán định là cửa sổ con hay trang riêng biệt)
	 */
	private function fileManager($typeWindow) {
		$this->arrCommon['dialog'] = $typeWindow;
		$arrConditions = array(
					'delete_flg'	=>	0,
					'status'		=>	1,
					'system_id'		=>	$this->arrCommon['settings']['system_id'],
		);
		if($this->input->post()) {
			$mode = safe_data('mode');
			$arrConditions['path'] 		= $this->arrCommon['path'] = $path = safe_data('path');
			if($this->uri->segment(4) == "ico") {
				$this->arrCommon['myPreview']  = "ico_preview";
			} elseif($this->uri->segment(4) == "logo") {
				$this->arrCommon['myPreview']  = "logo_preview";
			} else {
				$this->arrCommon['myPreview']  = "preview";
				}
				
			$folderName = replaceUnicode(str_replace(' ', '_', safe_data('new_folder_name')));
			
			if($mode == MODE_INIT) {
				$folders = $this->files_model->getFolders($arrConditions);
				$this->arrCommon['folders']    = $folders;
			} else if($mode == MODE_CREATE_FOLDER) {
				$arrInput['data'] = array(
							'name'			=>	$folderName,
							'system_id'		=>	$this->arrCommon['settings']['system_id'],
							'parent_path'	=>	$path,
				);
				if(!is_dir($path.$folderName)) {
					if(mkdir('./'.$path.$folderName,777,true)) {
						if($this->files_model->getCreateFolder($arrInput)) {

							$folders = $this->files_model->getFolders($arrConditions);
							$this->arrCommon['folders']    = $folders;
						}
					}
				}

			} else if($mode == MODE_RENAME_FOLDER) {
				$oldName 	= safe_data('old_folder_name');
				$arrInput['data'] = array(
							'name'			=>	$folderName
				);
				$arrInput['wheres'] = array(
							'name'			=>	$oldName,
							'parent_path'	=>	$path
				);
				if($this->files_model->getRenameFolder($arrInput)) {
					if(is_dir($path.$oldName)) {
						if(rename('./'.$path.$oldName,'./'.$path.$folderName)) {
							$folders = $this->files_model->getFolders($arrConditions);
							$this->arrCommon['folders']    = $folders;
						}
					}

				}
			} else if($mode == MODE_REMOVE_FOLDER) {
				$id 		= safe_data('new_folder_name');
				$folderName = safe_data('old_folder_name');
				$arrInput['wheres'] = array(
							'id'	=>	$id,
							'path'	=>	$path.$folderName.'/'
							);
							if($this->files_model->getRemoveFolder($arrInput)) {
								if(is_dir($path.$folderName)) {
									$this->deleteDirectory($path.$folderName);
									$folders = $this->files_model->getFolders($arrConditions);
									$this->arrCommon['folders']    = $folders;
								}
							}
			} else if($mode == MODE_REMOVE_FILE) {
				$id 		= safe_data('new_folder_name');
				$arrInput['wheres'] = array(
							'id'	=>	$id
				);
				if($this->files_model->getRemoveFile($arrInput)) {
					$folders = $this->files_model->getFolders($arrConditions);
					$this->arrCommon['folders']    = $folders;
				}
			} else if($mode == MODE_UPLOAD_FILE) {
				$arrFiles = $_FILES['file'];
				$length    = count($arrFiles['name']);
				$arrErrorUpload = array();
				for($i = 0; $i < $length; $i++) {
					$arrUpload = array();
					$_FILES['file']['name']		=	$arrFiles['name'][$i];
					$_FILES['file']['type']		=	$arrFiles['type'][$i];
					$_FILES['file']['tmp_name']	=	$arrFiles['tmp_name'][$i];
					$_FILES['file']['size']		=	$arrFiles['size'][$i];
					$result = $this->uploadFiles($path,180);
					if($result['errorUpload'] != '') {
						$arrErrorUpload[] = array(
									'file'	=>	$arrFiles['name'][$i],
									'error' =>  $result['errorUpload']
						);
					}
				}
				if(count($arrErrorUpload) > 0) {
					$this->arrCommon['errorUpload'] = $arrErrorUpload;
				}
				if(is_dir($path)) {
					$folders = $this->files_model->getFolders($arrConditions);
					$this->arrCommon['folders']    = $folders;
				}
			}
			$this->arrCommon['root'] = $root = safe_data('root');
			if($root == $path) {
				$this->arrCommon['style'] = 'display:none;';
			} else {
				$this->arrCommon['style'] = 'display:block;';
			}

			$folders = $this->files_model->getFolders($arrConditions);
			$this->arrCommon['folders']    = $folders;

		} else {
			if($typeWindow != '') {
				$arrConditions['path'] 		= $this->arrCommon['root'] = $this->arrCommon['path'] = UPLOAD_PATH.'system_'.$this->arrCommon['settings']['system_id'].'/'.$typeWindow.'/';
			} else {
				$arrConditions['path'] 		= $this->arrCommon['root'] = $this->arrCommon['path'] = UPLOAD_PATH.'system_'.$this->arrCommon['settings']['system_id'].'/';
			}
			$folders = $this->files_model->getFolders($arrConditions);
			$this->arrCommon['folders']    = $folders;
			$this->arrCommon['style'] 	   = 'display:none;';
			
			// Setting preview control
			if($this->uri->segment(4) == "ico") {
				$this->arrCommon['myPreview']  = "ico_preview";
			} elseif($this->uri->segment(4) == "logo") {
				$this->arrCommon['myPreview']  = "logo_preview";
			} else {
				$this->arrCommon['myPreview']  = "preview";
			}
			
			// Create folder and add to DB
			if(!file_exists('./'.$arrConditions['path'])) {
				mkdir('./'.$arrConditions['path']);
				$arrInput['data'] = array(
							'name'			=>	$this->uri->segment(4),
							'system_id'		=>	$this->arrCommon['settings']['system_id'],
							'parent_path'	=>	UPLOAD_PATH.'system_'.$this->arrCommon['settings']['system_id'].'/',
				);
				$this->files_model->getCreateFolder($arrInput);
			}

		}
	}

	/**
	 * changeStatus
	 * @param int $status
	 */
	private function changeStatus($status = 1) {
		if ($this->input->post()) {
			$checked = $this->input->post('checkAll');
			if(count($checked) > 0) {
				if($this->common_model->updateStatus($this->arrCommon['table'], $checked, $status)) {
					$this->setMessage(LTV00087, 'success');
				}
			} else {
				$this->setMessage(LTV00081, 'success');
			}
		}
		redirect($this->arrCommon['backUrl']);
	}

	/**
	 * updateDeleteFlg
	 * @param int $delete_flg
	 */
	private function updateDeleteFlg($delete_flg = 0) {
		if ($this->input->post()) {
			$checked = safe_data('checkAll');
			if(count($checked) > 0) {
				if($this->common_model->updateDeleteFlg($this->arrCommon['table'],$checked, $delete_flg)) {
					$this->setMessage(LTV0007, 'success');
				}
			} else {
				$this->setMessage(LTV00081, 'error');
			}
			redirect($this->arrCommon['backUrl']);
		}
	}

	/**
	 * changePassword
	 * Đổi mật khẩu
	 */
	private function changePassword() {
		$this->arrCommon['mode'] = MODE_CHANGE_PASSWORD;
		// Update user info
		if ($this->input->post() && $this->setValidate($this->arrCommon)) {

			$password = safe_data('password');
			$arrData = array(
                        'data' => array(
                            'id' => $this->arrCommon['user_id'],
                            'password' => md5($password),
			)
			);

			if ($this->users_model->getInsertUpdate($arrData)) {

				$this->setMessage(LTV0002, 'success');
				redirect(current_url());
			}
		}
	}

	/**
	 * forgotPassword
	 * Quên mật khẩu
	 */
	private function forgotPassword() {
		$this->arrCommon['mode'] = MODE_FORGOT_PASSWORD;
		if ($this->input->post() && $this->setValidate($this->arrCommon)) {

			$newPassword = random_string();
			$arrInput = array(
                        'data' => array(
                            'password' => md5($newPassword)
			),
                        'wheres' => array(
                            'email'    => safe_data('email'),
                            'username' => safe_data('username')
			)
			);
			if ($this->users_model->changePassword($arrInput)) {

				// Send mail
				$arrSendMail = array(
                            'to' => htmlspecialchars($this->input->post('email')),
                            'subject' => 'Testing',
                            'content' => 'New password: ' . $newPassword
				);
				if ($this->my_sendmail->sendMail($arrSendMail)) {
					$this->setMessage(LTV0002, 'success');
				}
			} else {

				$$this->setMessage(LTV0003, 'error');
			}
		}

	}

	/**
	 * profile
	 * Thông tin cá nhân
	 */
	private function profile() {
		$this->arrCommon['mode'] = MODE_PROFILE;
		$arrWheres = array(
                    'id' 			=> $this->arrCommon['user_id'],
                    'delete_flg' 	=> 0,
                    'status' 		=> 1
		);
		$this->arrCommon['form_data'] = $this->users_model->search($arrWheres,'detail');

		// Update user info
		if ($this->input->post() && $this->setValidate($this->arrCommon)) {

			$arrData = array(
	                        'data' => array(
	                            'id'     	=> $this->arrCommon['user_id'],
	                            'name'      => safe_data('realname'),
	                            'address' 	=> safe_data('address'),
	                            'email' 	=> safe_data('email'),
	                            'phone' 	=> safe_data('phone'),
								'file_id'	=> safe_data('file_id')
			)
			);

			if ($this->users_model->getInsertUpdate($arrData)) {

				$this->setMessage(LTV0002, 'success');
				redirect(current_url());
			}
		}
	}

	/**
	 * logIn
	 * Đăng nhập
	 */
	private function logIn() {
		$this->arrCommon['mode'] = MODE_LOGIN;
		$this->session->unset_userdata('realname');
		$this->session->unset_userdata('user_id');
		delete_cookie('realname');
		delete_cookie('user_id');

		$this->arrCommon['errLogin'] = '';
		if ($this->input->post() && $this->setValidate($this->arrCommon)) {
			$arrInput = array(
                        'username' => safe_data('username'),
                        'password' => md5(safe_data('password')),
                        'remember' => $this->input->post('remember')
			);
			$this->my_login->login($this->arrCommon, $arrInput, URL_ADMIN_PRODUCT, LOGIN_MODE_01);
		}
	}

	/**
	 * logOut
	 */
	private function logOut() {

		$this->arrCommon['mode'] = MODE_LOGOUT;
		$this->destroySession('realname');
		$this->destroySession('user_id');
		delete_cookie('realname');
		delete_cookie('user_id');

		redirect(URL_ADMIN_LOGIN);

	}

	private function deleteDirectory($dirPath) {
		if (is_dir($dirPath)) {
			$objects = scandir($dirPath);
			foreach ($objects as $object) {
				if ($object != "." && $object !="..") {
					if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
						$this->deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
					} else {
						unlink($dirPath . DIRECTORY_SEPARATOR . $object);
					}
				}
			}
			reset($objects);
			rmdir($dirPath);
		}
	}

	/**
	 * destroySession
	 * @param string $sessionName
	 */
	private function destroySession($sessionName) {
		$this->session->unset_userdata($sessionName);
	}
	
	public function test() {
		echo get_cookie('vuong');
	}

}

?>
