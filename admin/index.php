<?php

define('IN_DOUCO', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 赋值给模板
$smarty->assign('rec', $rec);

/**
 * +----------------------------------------------------------
 * 系统信息
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    // 获取服务器和DouPHP系统信息
    $sys_info['os'] = PHP_OS;
    $sys_info['ip'] = $_SERVER['SERVER_ADDR'];
    $sys_info['web_server'] = $_SERVER['SERVER_SOFTWARE'];
    $sys_info['php_ver'] = PHP_VERSION;
    $sys_info['mysql_ver'] = $dou->version();
    $sys_info['zlib'] = function_exists('gzclose') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['safe_mode'] = (boolean) ini_get('safe_mode') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['timezone'] = function_exists("date_default_timezone_get") ? date_default_timezone_get() : $_LANG['no_timezone'];
    $sys_info['socket'] = function_exists('fsockopen') ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['gd'] = extension_loaded("gd") ? $_LANG['yes'] : $_LANG['no'];
    $sys_info['charset'] = strtoupper(DOU_CHARSET);
    $sys_info['build_date'] = date("Y-m-d", $_CFG['build_date']);
    $update_date = unserialize($_CFG['update_date']);
    $sys_info['update'] = $update_date['system']['update'];
    $sys_info['patch'] = $update_date['system']['patch'];
    $sys_info['logo'] = ROOT_URL . 'theme/' . $_CFG['site_theme'] . '/images/' . $_CFG['site_logo'];
    $sys_info['max_filesize'] = ini_get('upload_max_filesize');
    $sys_info['num_page'] = $dou->num_rows($dou->query("SELECT * FROM " . $dou->table('page')));
    $sys_info['num_product'] = $dou->num_rows($dou->query("SELECT * FROM " . $dou->table('product')));
    $sys_info['num_article'] = $dou->num_rows($dou->query("SELECT * FROM " . $dou->table('article')));
    
    // 提示应该被删除的目录未被删除
    if ($dou->dir_status(ROOT_PATH . 'install') != 'no_exist') $warning[] = $_LANG['warning_install_exists'];
    if ($dou->dir_status(ROOT_PATH . 'upgrade') != 'no_exist') $warning[] = $_LANG['warning_upgrade_exists'];
    if ($extend == 'on') $warning[] = $_LANG['warning_extend_exists'];
    
    // 写入目录监测信息
    $sys_info['folder_exists'] = $warning;
 
    // 如果不是超级管理员就只显示当前管理员的日志
    if ($_USER['action_list'] != 'ALL')
        $filter_user_id = $_SESSION[DOU_ID]['user_id'];
     
    // 检索备份文件
    $sqlfiles = glob(ROOT_PATH . 'data/backup/*.sql');
    
    // 赋值给模板
    $smarty->assign('dou_api', $dou->dou_api());
    $smarty->assign('cur', 'index');
    $smarty->assign('page_list', $dou->get_page_nolevel());
    $smarty->assign('sys_info', $sys_info);
    $smarty->assign("log_list", $dou->get_admin_log($filter_user_id, 4));
    $smarty->assign('backup', $dou->get_first_end_file($sqlfiles, '.sql'));
    $smarty->assign('localsite', $dou->dou_localsite());
    
    $smarty->display('index.htm');
} 

/**
 * +----------------------------------------------------------
 * 清除缓存及已编译模板
 * +----------------------------------------------------------
 */
elseif ($rec == 'clear_cache') {
    $dou->dou_clear_cache(ROOT_PATH . 'cache');
    $dou->dou_msg($_LANG['clear_cache_success']);
}

/**
 * +----------------------------------------------------------
 * 目录权限检测
 * +----------------------------------------------------------
 */
elseif ($rec == 'directory_check') {
    $smarty->assign('ur_here', $_LANG['tool_directory_check']);
    
    /* 检查目录 */
    $check_dirs = array (
            'cache',
            'cache/admin',
            'cache/m',
            'data',
            'data/slide',
            'data/backup',
            'images/article',
            'images/product',
            'images/upload' 
    );
    
    foreach ($check_dirs as $dir) {
        $full_dir = ROOT_PATH . $dir;
        
        // 如果目录不存在则建立
        if (!file_exists($full_dir))
            mkdir($full_dir, 0777);
        
        $check_writeable = $dou->check_writeable($full_dir);
        if ($check_writeable == '1') {
            $if_write = "<b class='write'>" . $_LANG['write'] . "</b>";
        } elseif ($check_writeable == '0') {
            $if_write = "<b class='noWrite'>" . $_LANG['no_write'] . "</b>";
            $no_write = true;
        } elseif ($check_writeable == '2') {
            $if_write = "<b class='noWrite'>" . $_LANG['not_exist'] . "</b>";
            $no_write = true;
        }
        
        $writeable[] = array (
                "dir" => $dir,
                "if_write" => $if_write 
        );
    }
    
    // 赋值给模板
    $smarty->assign('writeable', $writeable);
    
    $smarty->display('index.htm');
}

?>