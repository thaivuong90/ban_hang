<?php

/**
 * Common_controller
 *
 * Lop controller co ban cho toan bo project
 */
class Common extends CI_Controller {

	public $arrCommon = array();

	/**
	 * __construct
	 *
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();

		$this->load->model(
		array(
                    'common_model',
                    'modules_model',
                    'brands_model',
                    'products_model',
                    'categories_model',
                    'users_model',
                    'roles_model',
                    'files_model',
                    'titles_model',
                    'news_model',
                    'orders_model',
                	'settings_model',
					'contacts_model',
					'menus_model',
					'slides_model',
					'slides_model',
					'advs_model'
					)
					);
					$this->load->helper(
					array(
		                    'string',
		                    'common',
		                    'security',
		                    'file',
							'cookie'
		                    )
		                    );
		                    $this->load->library(
		                    array(
		                    'session',
		                    'form_validation',
		                    'MY_login',
		                    'MY_sendmail',
		                    'MY_paging',
		                    'MY_uploader',
		                    'MY_excel'
		                    )
		                    );
		                    $this->setCommon($this->arrCommon);
	}

	/**
	 * loadPage
	 *
	 * Xử lý hiển thị layout
	 *
	 */
	public function loadPage() {

		switch ($this->arrCommon['mode']) {

			// Back-end
			case MODE_FILE_MANAGER:
				if($this->arrCommon['dialog'] != '') {
					$this->load->view('admin/form/' . $this->arrCommon['table'] . '_form_view', $this->arrCommon);
				} else {
					$this->arrCommon['layout'] = 'admin/form/' . $this->arrCommon['table'] . '_form_view';
					$this->load->view(BACKEND_TPL, $this->arrCommon);
				}
				break;
			case MODE_ADD:
			case MODE_EDIT:
				$this->arrCommon['layout'] = 'admin/form/' . $this->arrCommon['table'] . '_form_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_INIT:
			case MODE_TRASH:
			case MODE_SEARCH:
			case MODE_SENT:
				$this->arrCommon['layout'] = 'admin/list/' . $this->arrCommon['table'] . '_list_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_FORGOT_PASSWORD:
				$this->arrCommon['layout'] = 'admin/form/forgot_password_form_view';
				$this->load->view(LOGIN_TPL, $this->arrCommon);
				break;
			case MODE_LOGIN:
				$this->arrCommon['layout'] = 'admin/form/login_form_view';
				$this->load->view(LOGIN_TPL, $this->arrCommon);
				break;
			case MODE_PROFILE:
				$this->arrCommon['layout'] = 'admin/form/profile_form_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_CHANGE_PASSWORD:
				$this->arrCommon['layout'] = 'admin/form/change_password_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_IMPORT:
				$this->arrCommon['layout'] = 'admin/list/import_list_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_PRINT:
				$this->load->view('admin/form/order_print_view',$this->arrCommon);
				break;
			case MODE_SETTING:
				$this->arrCommon['layout'] = 'admin/form/webinfo_form_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
			case MODE_REPLY:
				$this->arrCommon['layout'] = 'admin/form/contacts_form_view';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
				// Front-end
			case MODE_HOMEPAGE:
				$this->arrCommon['pages'] = 'users/pages/index';
				$this->load->view(FRONTEND_TPL, $this->arrCommon);
				break;


			default:
				$this->arrCommon['layout'] = 'admin/index';
				$this->load->view(BACKEND_TPL, $this->arrCommon);
				break;
		}
	}

	/**
	 * setCommon
	 *
	 * Xử lý set các giá trị chung
	 */
	public function setCommon() {
		if($this->uri->segment(1) == 'admin') {
			$this->setBackEnd();
		} else {
			$this->setFrontEnd();
		}
	}

	/**
	 * setBackEnd
	 * Set data common cho phía back-end
	 */
	private function setBackEnd() {
		// Box header
		if ($this->uri->segment(3) != '' && !is_numeric($this->uri->segment(3))) {
			$uri = $this->uri->segment(1) . '/' . $this->uri->segment(2) . '/' . $this->uri->segment(3);
		} else {
			$uri = $this->uri->segment(1) . '/' . $this->uri->segment(2);
		}
		switch ($uri) {

			// Category
			case URL_ADMIN_CATEGORY:
			case URL_ADMIN_CATEGORY . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý danh mục sản phẩm';
				break;
			case URL_ADMIN_CATEGORY . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký danh mục';
				break;
			case URL_ADMIN_CATEGORY . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa danh mục';
				break;


			case URL_ADMIN_CATEGORY . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Danh mục đã xóa';
				break;
					
				// Settings
			case URL_ADMIN_SETTING:
				$this->arrCommon['boxHeader'] = 'Thong tin website';
				break;

				// Files
			case URL_FILE_MANAGER:
				$this->arrCommon['boxHeader'] = 'Tập tin & hình ảnh';
				break;

				// Settings
			case URL_ADMIN_MENUS:
			case URL_ADMIN_MENUS . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý menu';
				break;
				// Menus
			case URL_ADMIN_MENUS . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký menu';
				break;
			case URL_ADMIN_MENUS . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa menu';
				break;
			case URL_ADMIN_MENUS . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Menu đã xóa';
				break;

				// Slides
			case URL_ADMIN_SLIDES:
			case URL_ADMIN_SLIDES . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý slide';
				break;
			case URL_ADMIN_SLIDES . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký slide';
				break;
			case URL_ADMIN_SLIDES . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa slide';
				break;
			case URL_ADMIN_SLIDES . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Slide đã xóa';
				break;

				// Advs
			case URL_ADMIN_ADVS:
			case URL_ADMIN_ADVS . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý quảng cáo';
				break;
			case URL_ADMIN_ADVS . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký quảng cáo';
				break;
			case URL_ADMIN_ADVS . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa quảng cáo';
				break;
			case URL_ADMIN_ADVS . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Quảng cáo đã xóa';
				break;


				// Brand
			case URL_ADMIN_BRAND:
			case URL_ADMIN_BRAND . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý nhà cung cấp';
				break;
			case URL_ADMIN_BRAND . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký nhà cung cấp';
				break;
			case URL_ADMIN_BRAND . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa nhà cung cấp';
				break;
			case URL_ADMIN_BRAND . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Nhà cung cấp đã xóa';
				break;
			case URL_ADMIN_BRAND . '/' . MODE_IMPORT:
				$this->arrCommon['boxHeader'] = 'Tải tập tin';
				break;

				// News
			case URL_ADMIN_NEWS:
			case URL_ADMIN_NEWS . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý bài viết';
				break;
			case URL_ADMIN_NEWS . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký bài viết';
				break;
			case URL_ADMIN_NEWS . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa bài viết';
				break;
			case URL_ADMIN_NEWS . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Bài viết đã xóa';
				break;

				// Contacts
			case URL_ADMIN_CONTACTS:
			case URL_ADMIN_CONTACTS . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý hộp thư';
				break;
			case URL_ADMIN_CONTACTS . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Xem thư';
				break;
			case URL_ADMIN_CONTACTS . '/' . MODE_REPLY:
				$this->arrCommon['boxHeader'] = 'Trả lời';
				break;
			case URL_ADMIN_CONTACTS . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Liên lạc đã xóa';
				break;
			case URL_ADMIN_CONTACTS . '/' . MODE_SENT:
				$this->arrCommon['boxHeader'] = 'Liên lạc đã gửi';
				break;


				// Products
			case URL_ADMIN_PRODUCT:
			case URL_ADMIN_PRODUCT . '/' . MODE_SEARCH:
			case URL_ADMIN_PRODUCT . '/delete':
				$this->arrCommon['boxHeader'] = 'Quản lý sản phẩm';
				break;
			case URL_ADMIN_PRODUCT . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký sản phẩm';
				break;
			case URL_ADMIN_PRODUCT . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa sản phẩm';
				break;
			case URL_ADMIN_PRODUCT . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Sản phẩm đã xóa';
				break;

				// Orders
			case URL_ADMIN_ORDERS:
			case URL_ADMIN_ORDERS . '/' . MODE_SEARCH:
				$this->arrCommon['boxHeader'] = 'Quản lý đơn hàng';
				break;
			case URL_ADMIN_ORDERS . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Theo dõi đơn hàng';
				break;

				// Roles
			case URL_ADMIN_ROLE:
			case URL_ADMIN_ROLE . '/' . MODE_SEARCH:
			case URL_ADMIN_ROLE . '/delete':
				$this->arrCommon['boxHeader'] = 'Quản lý quyền hạn';
				break;
			case URL_ADMIN_ROLE . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký quyền hạn';
				break;
			case URL_ADMIN_ROLE . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa quyền hạn';
				break;
			case URL_ADMIN_ROLE . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Quyền hạn đã xóa';
				break;

				// Roles
			case URL_ADMIN_MODULE:
			case URL_ADMIN_MODULE . '/' . MODE_SEARCH:
			case URL_ADMIN_MODULE . '/pages':
			case URL_ADMIN_MODULE . '/delete':
				$this->arrCommon['boxHeader'] = 'Quản lý chức năng';
				break;
			case URL_ADMIN_MODULE . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký chức năng';
				break;
			case URL_ADMIN_MODULE . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa chức năng';
				break;
			case URL_ADMIN_MODULE . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Chức năng đã xóa';
				break;

				// titles
			case URL_ADMIN_TITLES:
			case URL_ADMIN_TITLES . '/' . MODE_SEARCH:
			case URL_ADMIN_TITLES . '/delete':
				$this->arrCommon['boxHeader'] = 'Quản lý chủ đề';
				break;
			case URL_ADMIN_TITLES . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký chủ đề';
				break;
			case URL_ADMIN_TITLES . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa chủ đề';
				break;
			case URL_ADMIN_TITLES . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Chủ đề đã xóa';
				break;


				// User
			case URL_ADMIN_USER:
			case URL_ADMIN_USER . '/' . MODE_SEARCH:
			case URL_ADMIN_USER . '/delete':
				$this->arrCommon['boxHeader'] = 'Quản lý tài khoản';
				break;
			case URL_ADMIN_USER . '/profile':
				$this->arrCommon['boxHeader'] = 'Thông tin cá nhân';
				break;
			case URL_ADMIN_USER . '/' . MODE_ADD:
				$this->arrCommon['boxHeader'] = 'Đăng ký tài khoản';
				break;
			case URL_ADMIN_USER . '/' . MODE_EDIT:
				$this->arrCommon['boxHeader'] = 'Chỉnh sửa tài khoản';
				break;
			case URL_ADMIN_USER . '/changePassword':
				$this->arrCommon['boxHeader'] = 'Đổi mật khẩu';
				break;

			case URL_ADMIN_INDEX:
				$this->arrCommon['boxHeader'] = 'Thông tin cần quan tâm';
				break;
			case URL_ADMIN_USER . '/' . MODE_TRASH:
				$this->arrCommon['boxHeader'] = 'Tài khoản đã xóa';
				break;


		}

		// Set back url
		$this->arrCommon['backUrl'] = base_url($this->uri->segment(1) . '/' . $this->uri->segment(2));

		$this->arrCommon['rowPerPage'] = 10;
		$this->arrCommon['submitUrl']  = current_url();
		$this->arrCommon['table'] 	   = $this->uri->segment(2);
		$this->arrCommon['root'] 	   = '';
		$this->arrCommon['path'] 	   = '';
		$this->arrCommon['style'] 	   = 'display:block';
		$this->arrCommon['myPreview']  = 'display:block';

		// No login url
		$this->arrCommon['noLogin'] = array(
		URL_ADMIN_LOGIN,
		URL_ADMIN_LOGOUT,
            'admin/test'
            );
            $this->arrCommon['settings'] = $this->settings_model->getOne();
            $this->arrCommon['left_menu'] = '';
            $this->arrCommon['mode']      = '';
            $this->config->set_item('base_url',$this->arrCommon['settings']['baseurl']) ;
	}

	/**
	 * setFrontEnd
	 * Set data common cho phía Front-end
	 */
	private function setFrontEnd() {

		// Get top-menu
		$arrWheres = array(
			'delete_flg'	=>	0,
			'status'		=>	1,
			'start'			=>	0,
			'end'			=>	100
		);
		$this->arrCommon['top_nav'] = $this->menus_model->search($arrWheres);

		// Get category
		$arrCategoryWheres = array(
			'delete_flg'	=>	0,
			'status'		=>	1
		);
		$htmlCategory = '';
		createLeftMenu($htmlCategory, $arrCategoryWheres,false,'categories_model');
		$this->arrCommon['categories'] = $htmlCategory;

		// Get category
		$arrBrandsWheres = array(
			'delete_flg'	=>	0,
			'status'		=>	1,
			'start'			=>	0,
			'end'			=>	100
		);
		$this->arrCommon['brands'] = $this->brands_model->search($arrWheres);
		
		// Get settings
		$this->arrCommon['settings'] = $this->settings_model->getOne();
	}

	/**
	 * setMessage
	 *
	 * @param type $msgId
	 * @param type $msgType
	 */
	public function setMessage($msgId, $msgType) {
		// if success set is post back false
		$this->session->set_flashdata('msgType', $msgType);
		$this->session->set_flashdata('content', $msgId);
	}

	/**
	 * setValidate
	 *
	 * Validate form trước khi submit
	 *
	 * @param type $arrOutput
	 * @return boolean
	 */
	function setValidate(&$arrOutput = array()) {

		$arrRules = array(
			'name'				=>	'required|callback_check_exist[name]',
			'meta_title'		=>	'required',
			'parent'			=>	'required',
			'title_id'			=>	'required',
			'category_id'		=>	'required',
			'brand_id'			=>	'required',
			'role_id'			=>	'required',
			'email'				=>	'required|valid_email',
			'username'			=>	'required',
			'url'				=>	'required',
			'categories[]'		=>	'required',
			'modules[]'			=>	'required',
			'content'			=>	'required|min_length[10]',
			'oldpassword'		=>	'required|min_length[6]|max_length[30]',
			'password'			=>	'required|min_length[6]|max_length[30]',
			'confpass'			=>	'required|min_length[6]|max_length[30]',
			'webtitle'			=>	'required',
			'baseurl'			=>	'required',
			'protocol'			=>	'required',
			'port'				=>	'required',
			'host'				=>	'required',
			'mailuser'			=>	'required',
			'mailpassword'		=>	'required',
			'mailtype'			=>	'required',
		);

		if ($this->input->post()) {
			$arrForm = $this->input->post();
				
			// Validate select multipe
			if($arrOutput['table'] == 'brands') {
				$arrForm['categories[]'] = '';
			}
			if($arrOutput['table'] == 'roles') {
				$arrForm['modules[]'] = '';
			}
				
			foreach ($arrForm as $key => $vl) {
				if(isset($arrRules[$key])) {
					$this->form_validation->set_rules($key, '', $arrRules[$key]);
				}
			}

			$this->form_validation->set_message('required', 'Vui lòng nhập hoặc chọn 1 giá trị');
			$this->form_validation->set_message('matches', 'Dữ liệu nhập không khớp với mật khẩu');
			$this->form_validation->set_message('is_unique', 'Vui lòng nhập');
			$this->form_validation->set_message('min_length', '%s tối thiểu %s kí tự');
			$this->form_validation->set_message('max_length', '%s tối đa %s kí tự');
			$this->form_validation->set_message('greater_than[8]', 'Giá trị nhập vào phải lớn hơn 8');
			$this->form_validation->set_message('less_than[20]', 'Giá trị nhập vào phải nhỏ hơn 20');
			$this->form_validation->set_message('alpha', 'Chỉ được phép nhập kí tự');
			$this->form_validation->set_message('alpha_numeric', 'Chỉ được phép nhập kí tự và số');
			$this->form_validation->set_message('numeric', 'Chỉ được phép nhập số');
			$this->form_validation->set_message('integer', 'Chỉ được phép nhập số nguyên');
			$this->form_validation->set_message('decimal', 'Chỉ được phép nhập số thực');
			$this->form_validation->set_message('is_natural', 'Chỉ được phép nhập kí tự số bình thường');
			$this->form_validation->set_message('is_natural_no_zero', 'Không được nhập kí tự 0');
			$this->form_validation->set_message('valid_email', 'E-mail không hợp lệ');
			$this->form_validation->set_message('valid_emails', 'Tồn tại e-mail không hợp lệ trong danh sách');
			$this->form_validation->set_message('valid_ip', 'Địa chỉ IP không hợp lệ');
			$this->form_validation->set_message('valid_ip', 'Dữ liệu có chứa kí tự không phải là Base24');
			$this->form_validation->set_message('check_exist', 'Dữ liệu đã được đăng ký');
			$this->form_validation->set_message('check_select', 'Vui lòng chọn 1 giá trị');


			if (!$this->form_validation->run()) {
				return false;
			}
			return true;
		}
	}

	/**
	 * check_exist
	 *
	 * Kiểm tra tồn tại giá trị trong DB
	 *
	 * @param type $str
	 * @return boolean
	 */
	function check_exist($str = '', $field = '') {

		$table = $this->uri->segment(2);
		$id = $this->input->post('id');

		$this->db->where($field, $str);
		$output = $this->db->get($table)->row_array();

		if (count($output) > 0) {

			if ($id == $output['id']) {
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	protected function doAction($action = '', $table) {

		switch ($action) {
			case 'search':
				if ($this->input->post()) {

					$keyword = safe_data($this->input->post('keyword'));
					$arrInput = array(
                        'url' => base_url(URL_ADMIN_BRAND . '/' . MODE_SEARCH),
                        'table' => $this->table,
                        'segment' => 3,
                        'conditions' => array(
                            'wheres' => array(
                                'name' => $keyword,
                                'encode' => friendlyUrl($keyword),
                                'create_at' => cnvDateToString($keyword)
					),
                            'limit' => $this->rowPerPage,
                            'order_by' => array('create_at' => 'DESC')
					)
					);
					$this->my_paging->createPagination($this->arrCommon, $arrInput, 'search');
					$this->loadPage('admin/list/' . $this->table . '_list_view');
				} else {
					redirect(URL_ADMIN_BRAND);
				}
				break;
			case 'add':
			case 'edit':

				// Get detail data
				$this->arrCommon['category'] = array();
				if (is_numeric($id) && $action == 'edit') {

					$arrConditions = array(
                        'wheres' => array('brand_id' => $id)
					);

					$this->arrCommon[$this->table] = $this->common_model->getOne($this->table, array('id' => $id));
					$this->arrCommon['category'] = $this->common_model->getAll('brand_category', $arrConditions);
				} else {

					$this->arrCommon[$this->table] = array(
                        'name' => '',
                        'cate_id' => 0,
                        'status' => 1,
                        'desc' => '',
                        'id' => ''
                        );
				}

				// Submit form
				if ($this->input->post() && $this->setValidate($this->arrCommon)) {

					// Array data for insert
					$arrInput[0] = array(
                        'name' => safe_data($this->input->post('name')),
                        'encode' => friendlyUrl($this->input->post('name')),
                        'status' => $this->input->post('status') != '' ? safe_data($this->input->post('status')) : '0',
                        'desc' => $this->input->post('desc'),
                        'create_by' => $this->arrCommon['user_id'],
                        'update_by' => $this->arrCommon['user_id']
					);
					$arrWheres = array(
                        'id' => $this->input->post('id'),
					);

					$arrCategory = $this->input->post('category');

					if (($action == 'add' && $this->common_model->insert($this->table, $arrInput))
					|| ($action == 'edit' && $this->common_model->update($this->table, $arrWheres, $arrInput))) {

						// If has file upload input
						if (isset($_FILES['file']) && $_FILES['file']['name'] != '') {

							// Upload file
							$arrConfig = array(
                                'upload_path' => 'upload/' . $this->table . '/',
                                'resize_path' => 'upload/' . $this->table . '/thumb/',
                                'allowed_types' => 'jpg|png|jpeg|gif',
                                'max_size' => '150',
                                'resize_width' => '90',
                                'resize_height' => '90',
                                'max_width' => '1000',
                                'max_height' => '1000',
                                'filename' => getCurrentDt() . '_' . $_FILES['file']['name'],
                                'overwrite' => true,
							);

							$arrResult = $this->my_uploader->uploadFile($arrConfig, true);
							if ($arrResult['uploadCode'] == 1) {

								// Insert to DB
								$arrFileData[0] = array(
                                    'path' => isset($arrConfig['upload_path']) ? $arrConfig['upload_path'] : '',
                                    'filename' => isset($arrConfig['filename']) ? $arrConfig['filename'] : '',
                                    'size' => isset($_FILES['file']['size']) ? $_FILES['file']['size'] : '',
                                    'table_id' => 'brands',
                                    'owner_id' => getMaxValue('id', $this->table),
                                    'path_thumb' => isset($arrConfig['resize_path']) ? $arrConfig['resize_path'] : '',
                                    'file_thumb' => isset($arrResult['thumbnail']) ? $arrResult['thumbnail'] : ''
                                    );

                                    if ($action == 'edit') {
                                    	$arrFileData[0]['owner_id'] = $id;
                                    }

                                    $arrFileWheres = array(
                                    'owner_id' => $id,
                                    'table_id' => $this->table
                                    );

                                    if (($action == 'add' && $this->common_model->insert('files', $arrFileData))
                                    || ($action == 'edit' && $this->common_model->update('files', $arrFileWheres, $arrFileData))) {
                                    	// Show messages
                                    	$this->setMessage(LTV0002, 'success');
                                    	redirect(URL_ADMIN_BRAND);
                                    }
							} else {

								$this->setMessage($arrResult['errorUpload'], 'error');
							}
						}

						// Show messages
						$this->setMessage(LTV0002, 'success');
						redirect(URL_ADMIN_BRAND);
					}
				}

				$this->loadPage('admin/form/' . $this->table . '_form_view');
				break;

			case 'delete':

				$arrWheres = array();
				$arrFileWheres = array();

				$arrCheck = $this->input->post('checkAll');
				if (is_numeric($id)) {
					$arrCheck[] = $id;
				}

				for ($i = 0; $i < count($arrCheck); $i++) {

					$arrWheres[$i] = array(
                        'id' => $arrCheck[$i]
					);

					$arrFileWheres[$i] = array(
                        'owner_id' => $arrCheck[$i],
                        'table_id' => $this->table
					);
				}

				// Delete files
				if ($this->common_model->delete($this->table, $arrWheres)) {

					$this->setMessage(LTV0007, 'success');
					redirect(URL_ADMIN_BRAND);
				}

			default:
				$arrInput = array(
                    'url' => base_url('admin/' . $this->table . '/'),
                    'table' => $this->table,
                    'segment' => 3,
                    'conditions' => array(
                        'limit' => $this->rowPerPage,
                        'wheres' => array(),
                        'order_by' => array('create_at' => 'DESC')
				)
				);
				$this->my_paging->createPagination($this->arrCommon, $arrInput);
				$this->loadPage('admin/list/' . $this->table . '_list_view');
				break;
		}
	}

	/**
	 * setSelectData
	 * @param type $table
	 */
	public function setSelectData() {

		$arrConditions = array(
            'delete_flg' => 0,
            'status' => 1
		);
		$arrOutput     = array();
		$this->arrCommon['parents'] = array();
		$this->arrCommon['brand_id'] = array();
		$this->arrCommon['category_id'] = array();
		$this->arrCommon['list_roles'] = array();
		$this->arrCommon['modules'] = array();
		$this->arrCommon['title_id'] = array();
		switch ($this->arrCommon['table']) {
			case 'brands':

				createMultiLevel($arrOutput, $arrConditions, 'categories_model');
				$this->arrCommon['categories'][''] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['categories'][$output['id']] = $output['name'];
				}

				$arrMenus = $this->brands_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}

				break;
			case 'categories':
				createMultiLevel($arrOutput, $arrConditions, 'categories_model');
				$this->arrCommon['parents'][0] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['parents'][$output['id']] = $output['name'];
				}

				$arrMenus = $this->categories_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}

				break;

			case 'products':
				$this->arrCommon['categories'] = '';
				createMultiLevel($arrOutput, $arrConditions, 'categories_model');
				$this->arrCommon['category_id'][''] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['category_id'][$output['id']] = $output['name'];
				}
				$brands = $this->brands_model->search($arrConditions);
				$this->arrCommon['brand_id'][''] = '---';
				foreach($brands as $output) {
					$this->arrCommon['brand_id'][$output['id']] = $output['name'];
				}

				$arrMenus = $this->products_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}
				break;

			case 'users':
				$roles = $this->roles_model->search($arrConditions);
				$this->arrCommon['list_roles'][''] = '---';
				foreach($roles as $output) {
					$this->arrCommon['list_roles'][$output['id']] = $output['name'];
				}
				break;

			case 'modules':

				createMultiLevel($arrOutput, $arrConditions, 'modules_model');
				$this->arrCommon['parents'][0] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['parents'][$output['id']] = $output['name'];
				}

				$arrMenus = $this->modules_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}
				break;

			case 'roles':
				unset($arrConditions['wheres']['status']);
				createMultiLevel($arrOutput, $arrConditions, 'modules_model');
				$this->arrCommon['modules'][0] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['modules'][$output['id']] = $output['name'];
				}
				break;
			case 'titles':
				createMultiLevel($arrOutput, $arrConditions, 'titles_model');
				$this->arrCommon['parents'][''] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['parents'][$output['id']] = $output['name'];
				}

				if(isset($this->arrCommon['form_data']['parent'])) {
					$arrConditions['parent'] = $this->arrCommon['form_data']['parent'];
				} else {
					$arrConditions['parent'] = 0;
				}

				$arrMenus = $this->titles_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}
				break;

			case 'news':
				createMultiLevel($arrOutput, $arrConditions, 'titles_model');
				$this->arrCommon['title_id'][0] = '---';
				foreach($arrOutput as $output) {
					$this->arrCommon['title_id'][$output['id']] = $output['name'];
				}

				$arrMenus = $this->news_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}
				break;
			case 'menus':
				$arrMenus = $this->menus_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrMenus as $menu) {
					$this->arrCommon['orderBy'][$menu['order_by']] = $menu['name'];
				}
				break;

			case 'slides':
				$arrSlides = $this->slides_model->search($arrConditions);
				$this->arrCommon['orderBy'][0] = '--- Tự sắp xếp ---';
				foreach($arrSlides as $slide) {
					$this->arrCommon['orderBy'][$slide['order_by']] = $slide['name'];
				}
				break;
		}
	}

	/**
	 * uploadFiles
	 *
	 * @param type $action
	 * @param type $id
	 * @return boolean
	 */
	public function uploadFiles($path = '',$resize_width = '90') {
			
		if ((isset($_FILES['file']) && $_FILES['file']['name'] != '')) {
				
			$ico_id = $this->input->post('myPreview');
			
			$filename   = getCurrentDt() . '_' . random_string().'_'. removeHttpUrl(base_url()).'.'.pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
			$arrFile    = explode('.', $filename);
			$size       = $_FILES['file']['size'];
			$arrFileData = array(
                'data' => array(
                    'path'          => $path,
                    'filename'      => $filename,
                    'size'          => $size,
			)
			);

			// Upload file
			$arrConfig = array(
                'upload_path'   => $path,
                'resize_path'   => $path.'thumb',
                'allowed_types' => ALLOWED_IMG_TYPES,
                'max_size'      => '150',
                'resize_width'  => $resize_width,
                'max_width'     => '1000',
                'max_height'    => '1000',
                'filename'      => $filename,
                'overwrite'     => true,
			);
			
			if($ico_id == 'ico_preview') {
				$arrFileData['data']['filename'] = $arrFile[0].'.ico';
				$arrConfig['ico_file']   = $arrFile[0].'.ico';
			}
			$arrResult = $this->my_uploader->uploadFile($arrConfig, true);

			if ($arrResult['uploadCode'] == 1) {
				if ($this->files_model->getInsertUpdate($arrFileData)) {
					return true;
				}
			} else {
				return $arrResult;
			}

			return false;
		}
	}

}

?>
