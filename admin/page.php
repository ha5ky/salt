<?php

define('IN_DOUCO', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_rec($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 图片上传
include_once (ROOT_PATH . 'include/file.class.php');
$file = new File('images/page/'); // 实例化类文件(文件上传路径，结尾加斜杠)

$smarty->assign('rec', $rec);
$smarty->assign('cur', 'page');

/**
 * +----------------------------------------------------------
 * 单页面列表
 * +----------------------------------------------------------
 */
if ($rec == 'default') {
    $smarty->assign('ur_here', $_LANG['page_list']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_add'],
            'href' => 'page.php?rec=add' 
    ));
    
    // 赋值给模板
    $smarty->assign('page_list', $dou->get_page_nolevel());
    
    $smarty->display('page.htm');
} 

/**
 * +----------------------------------------------------------
 * 单页面添加
 * +----------------------------------------------------------
 */
elseif ($rec == 'add') {
    $smarty->assign('ur_here', $_LANG['page_add']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_list'],
            'href' => 'page.php' 
    ));
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    
    // 赋值给模板
    $smarty->assign('form_action', 'insert');
    $smarty->assign('item_id', $dou->auto_id('page'));
    $smarty->assign('page_list', $dou->get_page_nolevel());
    
    $smarty->display('page.htm');
} 

elseif ($rec == 'insert') {
    if (empty($_POST['page_name']))
        $dou->dou_msg($_LANG['page_name'] . $_LANG['is_empty']);
    
    if (!$check->is_unique_id($_POST['unique_id']))
        $dou->dou_msg($_LANG['unique_id_wrong']);

    if ($dou->value_exist('page', 'unique_id', $_POST['unique_id']))
        $dou->dou_msg($_LANG['unique_id_existed']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    
    $sql = "INSERT INTO " . $dou->table('page') . " (id, unique_id, parent_id, page_name, content ,keywords, description)" . " VALUES (NULL, '$_POST[unique_id]', '$_POST[parent_id]', '$_POST[page_name]', '$_POST[content]', '$_POST[keywords]', '$_POST[description]')";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['page_add'] . ': ' . $_POST[page_name]);
    $dou->dou_msg($_LANG['page_add_succes'], 'page.php');
} 

/**
 * +----------------------------------------------------------
 * 单页面编辑
 * +----------------------------------------------------------
 */
elseif ($rec == 'edit') {
    $smarty->assign('ur_here', $_LANG['page_edit']);
    $smarty->assign('action_link', array (
            'text' => $_LANG['page_list'],
            'href' => 'page.php' 
    ));
    
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : '';
    
    $query = $dou->select($dou->table('page'), '*', '`id` = \'' . $id . '\'');
    $page = $dou->fetch_array($query);
    
    // CSRF防御令牌生成
    $smarty->assign('token', $firewall->get_token());
    
    // 赋值给模板
    $smarty->assign('form_action', 'update');
    $smarty->assign('page_list', $dou->get_page_nolevel(0, 0, $id));
    $smarty->assign('item_id', $id);
    $smarty->assign('page', $page);
    
    $smarty->display('page.htm');
} 

elseif ($rec == 'update') {
    // 验证并获取合法的ID
    $id = $check->is_number($_POST['id']) ? $_POST['id'] : '';
    
    if (empty($_POST['page_name']))
        $dou->dou_msg($_LANG['page_name'] . $_LANG['is_empty']);
    
    if (!$check->is_unique_id($_POST['unique_id']))
        $dou->dou_msg($_LANG['unique_id_wrong']);

    if ($dou->value_exist('page', 'unique_id', $_POST['unique_id'], "AND id != '$id'"))
        $dou->dou_msg($_LANG['unique_id_existed']);
        
    // CSRF防御令牌验证
    $firewall->check_token($_POST['token']);
    
    $sql = "UPDATE " . $dou->table('page') . " SET unique_id = '$_POST[unique_id]', parent_id = '$_POST[parent_id]', page_name = '$_POST[page_name]', content = '$_POST[content]', keywords = '$_POST[keywords]', description = '$_POST[description]' WHERE id = '$id'";
    $dou->query($sql);
    
    $dou->create_admin_log($_LANG['page_edit'] . ': ' . $_POST['page_name']);
    $dou->dou_msg($_LANG['page_edit_succes'], 'page.php', '', '3');
} 

/**
 * +----------------------------------------------------------
 * 文件盒子
 * +----------------------------------------------------------
 */
elseif ($rec == 'filebox') {
    // 验证并获取合法的REQUEST
    $id = $check->is_number($_REQUEST['item_id']) ? $_REQUEST['item_id'] : '';
    $type = $check->is_letter($_REQUEST['type']) ? $_REQUEST['type'] : '';
    
    // 文件上传盒子
    $custom_filename = $id . '_' . $type . '_' . $dou->create_rand_string('number', 6, time());
    $image = $file->box('page', $id, $type . '_file', $type, $custom_filename);
    $file_url = $dou->dou_file($image);
    $img = '<img src="' . $file_url. '" data-file="' . $image . '" />';
    
    echo $img;
}

/**
 * +----------------------------------------------------------
 * 单页面删除
 * +----------------------------------------------------------
 */
elseif ($rec == 'del') {
    // 验证并获取合法的ID
    $id = $check->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $dou->dou_msg($_LANG['illegal'], 'page.php');
    
    $page_name = $dou->get_one("SELECT page_name FROM " . $dou->table('page') . " WHERE id = '$id'");
    $is_parent = $dou->get_one("SELECT id FROM " . $dou->table('page') . " WHERE parent_id = '$id'");
    
    if ($id == '1') {
        $dou->dou_msg($_LANG['page_del_wrong'], 'page.php', '', '3');
    } elseif ($is_parent) {
        $_LANG['page_del_is_parent'] = preg_replace('/d%/Ums', $page_name, $_LANG['page_del_is_parent']);
        $dou->dou_msg($_LANG['page_del_is_parent'], 'page.php', '', '3');
    } else {
        if (isset($_POST['confirm']) ? $_POST['confirm'] : '') {
            $dou->create_admin_log($_LANG['page_del'] . ': ' . $page_name);
            $dou->delete($dou->table('page'), "id = '$id'", 'page.php');
        } else {
            $_LANG['del_check'] = preg_replace('/d%/Ums', $page_name, $_LANG['del_check']);
            $dou->dou_msg($_LANG['del_check'], 'page.php', '', '30', "page.php?rec=del&id=$id");
        }
    }
}

?>