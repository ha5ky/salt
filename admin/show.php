<?php

define('IN_DOUCO', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 图片上传
include_once (ROOT_PATH . 'include/file.class.php');
$file = new File('data/slide/'); // 实例化类文件(文件上传路径，结尾加斜杠)
                                                        
// 赋值给模板
$smarty->assign('rec', $rec);
$smarty->assign('cur', 'show');
$smarty->assign('ur_here', $_LANG['show']);
$smarty->assign('show_list', $dou->get_show_list());

/**
 * +----------------------------------------------------------
 * 幻灯列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    $smarty->display('show.htm');
} 

/**
 * +----------------------------------------------------------
 * 幻灯添加处理
 * +----------------------------------------------------------
 */
elseif ($rec == 'insert') {
    // 验证幻灯名称
    if (empty($_POST['show_name'])) $dou->dou_msg($_LANG['show_name'] . $_LANG['is_empty']);
        
    // 文件上传盒子
    if ($_FILES['show_img']['name'] != "") {
        $custom_filename = $dou->create_rand_string('letter', 6, date('Ymd'));
        $show_img = $file->box('show', $dou->auto_id('show'), 'show_img', 'main', $custom_filename);
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    
    $sql = "INSERT INTO " . $dou->table('show') . " (id, show_name, show_link, show_img, type, sort)" . " VALUES (NULL, '$_POST[show_name]', '$_POST[show_link]', '$show_img', 'pc', '$_POST[sort]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['show_add'] . ': ' . $_POST[show_name]);
    $dou->dou_msg($_LANG['show_add_succes'], 'show.php');
} 

/**
 * +----------------------------------------------------------
 * 幻灯编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('show'), '*', '`id` = \'' . $id . '\'');
    $show = $dou->fetch_array($query);
    
    // 格式化数据
    $show['show_img'] = $dou->dou_file($show['show_img']);
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    
    // 赋值给模板
    $smarty->assign('id', $id);
    $smarty->assign('show', $show);
    
    $smarty->display('show.htm');
} 

elseif ($rec == 'update') {
    // 验证并获取合法的ID
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';
    
    // 验证幻灯名称
    if (empty($_POST['show_name'])) $dou->dou_msg($_LANG['show_name'] . $_LANG['is_empty']);
        
    // 文件上传盒子
    if ($_FILES['show_img']['name'] != "") {
        $file_name = $dou->get_file_name($dou->get_one("SELECT show_img FROM " . $dou->table('show') . " WHERE id = '$id'"));
        $custom_filename = $file_name ? $file_name : $dou->create_rand_string('letter', 6, date('Ymd'));
        $show_img = $file->box('show', $id, 'show_img', 'main', $custom_filename);
        $show_img = ", show_img = '" . $show_img . "'";
    }
    
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    
    $sql = "update " . $dou->table('show') . " SET show_name='$_POST[show_name]'" . $show_img . " ,show_link = '$_POST[show_link]', sort = '$_POST[sort]' WHERE id = '$id'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['show_edit'] . ': ' . $_POST[show_name]);
    $dou->dou_msg($_LANG['show_edit_succes'], 'show.php');
}

/**
 * +----------------------------------------------------------
 * 幻灯删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'show.php');
    
    $show_name = $dou->get_one("SELECT show_name FROM " . $dou->table('show') . " WHERE id = '$id'");
    
    if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
        // 删除相应图片
        $show_img = $dou->get_one("SELECT show_img FROM " . $dou->table('show') . " WHERE id = '$id'");
        $dou->del_file($show_img);
        
        $dou->create_admin_log($_LANG['show_del'] . ': ' . $show_name);
        $dou->delete($dou->table('show'), "id = '$id'", 'show.php');
    } else {
        $_LANG['del_check'] = preg_replace('/d%/Ums', $show_name, $_LANG['del_check']);
        $dou->dou_msg($_LANG['del_check'], 'show.php', '', '30', "show.php?rec=del&id=$id");
    }
}

?>