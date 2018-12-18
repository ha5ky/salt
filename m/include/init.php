<?php

if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}

// 显示除了E_NOTICE(提示)和E_WARNING(警告)外的所有错误
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

// 关闭 set_magic_quotes_runtime
@set_magic_quotes_runtime(0);

// 调整时区
if (PHP_VERSION >= '5.1')
    date_default_timezone_set('PRC');

// 移动版标记
define('IS_MOBILE', true);

// 判断传输协议
$http = ((!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) || (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')) ? 'https://' : 'http://';

// 定义DouPHP基础常量
$m_path = str_replace('/', '', strrchr(str_replace('/include/init.php', '', str_replace('\\', '/', __FILE__)), '/'));
$m_url = dirname($http . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']) . "/";
define('M_URL', !defined('ROUTE') ? $m_url : str_replace('include/', '', $m_url)); // 区分route.php作为入口的情况来分别赋值
define('ROOT_PATH', str_replace($m_path . '/include/init.php', '', str_replace('\\', '/', __FILE__)));
define('ROOT_URL', preg_replace('/\/'.$m_path.'\/*$/', '/', str_replace($http . $m_path, $http . 'www', M_URL)));

if (!file_exists(ROOT_PATH . "data/system.dou")) {
    header("Location: " . ROOT_URL . "install/index.php\n");
    exit();
}

// 载入DouPHP核心文件
require_once (ROOT_PATH . 'data/config.php'); // 伪静态下config.php会在route.php中第一次被调用
require (ROOT_PATH . 'include/smarty/Smarty.class.php');
require (ROOT_PATH . 'include/mysql.class.php');
require (ROOT_PATH . 'include/common.class.php');
require (ROOT_PATH . M_PATH . '/include/action.class.php');
require (ROOT_PATH . 'include/check.class.php');
require (ROOT_PATH . 'include/firewall.class.php');

// 实例化DouPHP核心类
$dou = new Action($dbhost, $dbuser, $dbpass, $dbname, $prefix, DOU_CHARSET);
$check = new Check();
$firewall = new Firewall();

// 定义系统标识
define('DOU_SHELL', $dou->get_one("SELECT value FROM " . $dou->table('config') . " WHERE name = 'hash_code'"));
define('DOU_ID', 'mobile_' . substr(md5(DOU_SHELL . 'mobile'), 0, 5));

// 读取站点信息
$_CFG = $dou->get_config();

if (!defined('EXIT_INIT')) {
    // 设置页面缓存和编码
    header('Cache-control: private');
    header('Content-type: text/html; charset=' . DOU_CHARSET);
    
    // 判断是否关闭手机版
    if ($_CFG['mobile_closed'])
        $dou->dou_header(ROOT_URL);
    
    // 豆壳防火墙
    $firewall->dou_firewall();
    
    // SMARTY配置
    $smarty = new smarty();
    $smarty->config_dir = ROOT_PATH . 'include/smarty/Config_File.class.php'; // 目录变量
    $smarty->template_dir = ROOT_PATH . M_PATH . '/theme/' . $_CFG['mobile_theme']; // 模板存放目录
    $smarty->compile_dir = ROOT_PATH . 'cache/' . M_PATH; // 编译目录
    $smarty->left_delimiter = '{'; // 左定界符
    $smarty->right_delimiter = '}'; // 右定界符
                                    
    // 如果编译和缓存目录不存在则建立
    if (!file_exists($smarty->compile_dir))
        mkdir($smarty->compile_dir, 0777);
        
    // 系统模块
    $_MODULE = $dou->dou_module();
    
    // 载入语言文件
    foreach ((array) $_MODULE['lang'] as $lang_file) {
        require ($lang_file); // 载入系统语言文件
    }
    $_LANG['copyright'] = preg_replace('/d%/Ums', $_CFG['site_name'], $_LANG['copyright']);

    // 载入模块文件
    foreach ((array) $_MODULE['init'] as $init_file) {
        require ($init_file);
    }

    // 如果存在自定义类则载入
    if (file_exists($other_class_file = ROOT_PATH . 'include/other.class.php')) {
          require ($other_class_file);
          $other = new Other();
    }

    // 判断是否关闭站点
    if ($_CFG['site_closed']) {
        // 设置页面编码
        header('Content-type: text/html; charset=' . DOU_CHARSET);
        
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><div style=\"margin: 200px; text-align: center; font-size: 14px\"><p>" . $_LANG['site_closed'] . "</p><p></p></div>";
        exit();
    }
    
    // 通用信息调用
    $smarty->assign("lang", $_LANG);
    $smarty->assign("site", $_CFG);
    $_URL = $dou->dou_url();
    $_URL['catalog'] = $dou->rewrite_url('catalog');
    $smarty->assign("url", $_URL); // 模块URL
    $smarty->assign("open", $_OPEN = $_MODULE['open']); // 模块开启状态
    $_DISPLAY = unserialize($_CFG['mobile_display']); // 显示设置
    $_DEFINED = unserialize($_CFG['defined']); // 自定义属性
    
    // Smarty 过滤器
    function remove_html_comments($source, & $smarty) {
        global $_CFG;
        $theme_path = M_URL . 'theme';
        $source = preg_replace('/\"\.*\/images\//Ums', '"images/', $source);
        $source = preg_replace('/\"images\//Ums', "\"theme/$_CFG[mobile_theme]/images/", $source);
        $source = preg_replace('/link href\=\"([A-Za-z0-9_-]+)\.css/Ums', "link href=\"theme/$_CFG[mobile_theme]/$1.css", $source);
        $source = preg_replace('/theme\//Ums', "$theme_path/", $source);
        $source = preg_replace('/^<meta\shttp-equiv=["|\']Content-Type["|\']\scontent=["|\']text\/html;\scharset=(?:.*?)["|\'][^>]*?>\r?\n?/i', '', $source);
        return $source = preg_replace('/<!--.*{(.*)}.*-->/U', '{$1}', $source);
    }
    $smarty->register_prefilter('remove_html_comments');
}

// 开启缓冲区
ob_start();
?>