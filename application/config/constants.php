<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('EMPTY_STR','');

define('LTV0001','Tài khoản hoặc mật khẩu không chính xác');
define('LTV0055','Tài khoản không được phép truy cập');
define('LTV0002','Đăng ký hoặc cập nhật dữ liệu thành công');
define('LTV0003','Có lỗi xảy ra.Vui lòng thử lại sau');
define('LTV0004','Không tồn tại tài khoản này trong hệ thống');
define('LTV0005','Đã gởi lại mật khẩu vào e-mail.Vui lòng kiểm tra');
define('LTV0007','Xóa thành công');
define('LTV0008','Bạn chắc chắn xóa?');
define('LTV00098','Bạn muốn thoát?');
define('LTV00087','Cập nhật trạng thái thành công');
define('LTV00081','Chưa có dòng nào được chọn');
define('LTV00085','Không thể xóa');
define('LTV00089','Đã phục hồi thành công');
define('LTV00076','Đã đăng ký tập tin thành công');
define('LTV00022','Đã trả lời thành công');
define('LTV00051','Hủy thành công');

/** Template */
define('BACKEND_TPL','admin/admin_layout');
define('LOGIN_TPL','admin/login_layout');
define('FRONTEND_TPL','users/user_layout');
/** End template */

define('URL_ADMIN_PROFILE','admin/users/profile');
define('URL_ADMIN_LOGIN','admin/users/login');
define('URL_ADMIN_LOGOUT','admin/users/logout');
define('URL_ADMIN_FORGOTPASSWORD','admin/users/forgotPassword');
define('URL_ADMIN_CATEGORY','admin/categories');
define('URL_ADMIN_BRAND','admin/brands');
define('URL_ADMIN_USER','admin/users');
define('URL_ADMIN_CHANGE_PASSWORD','admin/users/changePassword');
define('URL_ADMIN_PRODUCT','admin/products');
define('URL_ADMIN_ROLE','admin/roles');
define('URL_ADMIN_ORDER','admin/orders');
define('URL_ADMIN_MODULE','admin/modules');
define('URL_ADMIN_TITLES','admin/titles');
define('URL_ADMIN_NEWS','admin/news');
define('URL_ADMIN_ORDERS','admin/orders');
define('URL_ADMIN_DENY','admin/access/deny');
define('URL_ADMIN_INDEX','admin/');
define('URL_ADMIN_IMPORT','admin/import');
define('URL_ADMIN_SETTING','admin/webinfo');
define('URL_ADMIN_CONTACTS','admin/contacts');
define('URL_ADMIN_MENUS','admin/menus');
define('URL_FILE_MANAGER','admin/files/manager');
define('URL_ADMIN_SLIDES','admin/slides');
define('URL_ADMIN_ADVS','admin/advs');

define('LOGIN_MODE_01','account');
define('LOGIN_MODE_02','facebook');
define('LOGIN_MODE_03','google');
define('LOGIN_MODE_04','twitter');
define('LOGIN_MODE_05','yahoo');

define('NO_IMG_URL','upload/no_images.png');

define('SUPPORT',1);
define('ADMIN',2);
define('MEMBER',3);

define('UPLOAD_PATH','upload/');
define('UPLOAD_BRANDS_PATH','upload/brands/');
define('UPLOAD_PRODUCTS_PATH','upload/products/');
define('UPLOAD_NEWS_PATH','upload/news/');
define('UPLOAD_ICO_PATH','upload/ico/');
define('UPLOAD_LOGO_PATH','upload/logo/');
define('UPLOAD_USER_PATH','upload/users/');

define('MODE_ADD','add');
define('MODE_EDIT','edit');
define('MODE_FILE_MANAGER','manager');
define('MODE_DELETE','delete');
define('MODE_DESTROY','destroy');
define('MODE_LOGIN','login');
define('MODE_FORGOT_PASSWORD','forgotPassword');
define('MODE_CHANGE_PASSWORD','changePassword');
define('MODE_PROFILE','profile');
define('MODE_LOGOUT','logout');
define('MODE_DENY','deny');
define('MODE_PAGING','pages');
define('MODE_INIT','init');
define('MODE_CREATE_FOLDER','create_folder');
define('MODE_RENAME_FOLDER','rename_folder');
define('MODE_REMOVE_FOLDER','remove_folder');
define('MODE_REMOVE_FILE','remove_file');
define('MODE_UPLOAD_FILE','upload_file');
define('MODE_SEARCH','search');
define('MODE_CHANGE_STATUS','changeStatus');
define('MODE_TRASH','trash');
define('MODE_CSV','csv');
define('MODE_PDF','pdf');
define('MODE_IMPORT','import');
define('MODE_REFRESH','refresh');
define('MODE_DISABLE','disable');
define('MODE_ENABLE','enable');
define('MODE_PRINT','print');
define('MODE_SETTING','webinfo');
define('MODE_CNT','count');
define('MODE_CONFIRM','confirm');
define('MODE_REPLY','reply');
define('MODE_SENT','sent');
define('MODE_DELETE_DB','destroy');

define('MODE_HOMEPAGE','home_page');

define('ALLOWED_IMG_TYPES','jpg|png|jpeg|gif|ico');
define('ALLOWED_IMPORT_TYPES','xls|xlsx|csv');

define('MAX_UPLOAD_FILE_SIZE','500');

define('ICON','|---');

define('ORDER_ID_1','Chưa xác nhận');
define('ORDER_ID_2','Đã xác nhận');
define('ORDER_ID_3','Đang giao hàng');
define('ORDER_ID_4','Đã giao hàng');
define('ORDER_ID_5','Đã hủy');

define('ORDER_STEP_1','Chưa xác nhận');
define('ORDER_STEP_2','Đã xác nhận');
define('ORDER_STEP_3','Đang giao hàng');
define('ORDER_STEP_4','Đã giao hàng');
define('ORDER_STEP_5','Đã hủy');