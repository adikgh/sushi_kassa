<? 

   require 'db.php';
   require 'fun.php';
   require 'product.php';
   require 't.php';
   // require 'smsc_api.php';
   require 'var.php';

   class core {
      public static $user_id = false;
      public static $user_r = false;
      public static $user_data = array();

      public function __construct() {
         new db; new t; new fun; new product;
         $time = 3600 * 24 * 365;
         // ini_set('session.gc_maxlifetime', $time);
         // ini_set('session.cookie_lifetime', $time);
         session_set_cookie_params($time);
         session_start();
         date_default_timezone_set('Asia/Aqtau');
         $this->authorize();
      }

      private function authorize() {
         $user_id = false;
         $user_pc = false;

         if (isset($_COOKIE['upi']) && isset($_COOKIE['upc'])) {
            $user_id = $_COOKIE['upi'];
            $user_pc = $_COOKIE['upc'];
         }
         if ($user_id && $user_pc) {
            $user = db::query("SELECT * FROM user WHERE id = '$user_id'");
            if (mysqli_num_rows($user)) {
               $user_data = mysqli_fetch_assoc($user);
               if ($user_pc == $user_data['code'] && $user_data['right']) {
                  self::$user_id = $user_id;
                  self::$user_data = $user_data;
               } else $this->user_unset();
            } else $this->user_unset();
         }
      }
   
      public function user_unset() {
         self::$user_id = false;
         self::$user_data = array();
         setcookie('upi', '', time(), '/');
         setcookie('upc', '', time(), '/');
      }

   }


   // data
   $core = new core;
   $user = core::$user_data;
   $user_id = @$user['id'];
   $user_right = fun::user_staffw($user_id);



 // setting
 $site = mysqli_fetch_array(db::query("select * from `site` where id = 1"));
 $ver = 1.030953;

 // 
 $site_set = [
    'menu' => true,
    'search' => true,
    // 'swiper' => false,
    // 'plyr' => false,
    // 'aos' => false,
 ];
 $scss = ['norm', 'main'];
 $sjs = ['norm', 'main'];
 $css = [];
 $js = [];
 $code = rand(1000, 9999);



 // lang
 $lang = 'ru';
 if (isset($_GET['lang'])) if ($_GET['lang'] == 'kz' || $_GET['lang'] == 'ru') $_SESSION['lang'] = $_GET['lang'];
 if (isset($_SESSION['lang'])) $lang = $_SESSION['lang'];

 // lang
 $branch = 1; if (@$user_right['branch_id']) $branch = $user_right['branch_id'];
 if (@$user_right['positions_id'] != 4) {
    if (isset($_GET['branch'])) if ($_GET['branch'] == 1 || $_GET['branch'] == 2) $_SESSION['branch'] = $_GET['branch'];
    if (isset($_SESSION['branch'])) $branch = $_SESSION['branch'];
 }

 $view_pr = null;
 if (isset($_GET['view_pr'])) $_SESSION['view_pr'] = $_GET['view_pr'];
 if (isset($_SESSION['view_pr']) && $_SESSION['view_pr'] == 'list') $view_pr = 2; else $view_pr = null;


 // date - time
 $date = date("Y-m-d", time());
 $time = date("H:i:s", time());
 $datetime = date('Y-m-d H:i:s', time());

//  if ($time > "00:00:00" && $time < "06:00:00") {
//    $start_cdate = date('Y-m-d 06:00:00', strtotime("$date -1 day"));
//    $end_cdate = date("Y-m-d 06:00:00", strtotime("$start_cdate +1 day"));
//  } else {
//    $start_cdate = date('Y-m-d 06:00:00');
//    $end_cdate = date("Y-m-d 06:00:00", strtotime("$start_cdate +1 day"));
//  }


 $start_cdate = date('Y-m-d 06:00:00', strtotime("$date -1 day"));
 $end_cdate = date("Y-m-d 06:00:00", strtotime("$start_cdate +1 day"));
 

 // url
 $url = $url_full = $_SERVER['REQUEST_URI'];
 $url = explode('?', $url);
 $url = $url[0];


 // 
 $token = "1581082911:AAEKW20w_-5V0Wx9tzhyThV2pjCgZtCjyc8";
 // $chat_id = "-1002461390168";










