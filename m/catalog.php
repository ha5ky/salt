<?php

define('IN_DOUCO', true);

require (dirname(__FILE__) . '/include/init.php');

// rec操作项的初始化
$rec = $check->is_letter($_REQUEST['rec']) ? $_REQUEST['rec'] : 'default';

// 赋值给模板-meta和title信息
$smarty->assign('page_title', $dou->page_title('catalog'));
$smarty->assign('keywords', $_LANG['catalog']);
$smarty->assign('description', $_LANG['catalog']);

// 赋值给模板-导航栏
$smarty->assign('nav_list', $dou->get_nav_mobile());

// 赋值给模板-数据
$smarty->assign('catalog', get_catalog());
$smarty->assign('head', $dou->head($_LANG['catalog']));

$smarty->display('catalog.dwt');

/**
 * +----------------------------------------------------------
 * 获取整站目录数据
 * +----------------------------------------------------------
 */
function get_catalog() {
    // 单页面列表
    foreach ($GLOBALS['dou']->get_page_nolevel() as $row) {
        $catalog[] = array (
                "name" => $row['page_name'],
                "mark" => '-' . $row['mark'],
                "url" => $row['url'] 
        );
    }

    // 栏目模块
    foreach ($GLOBALS['_MODULE']['column'] as $module_id) {
        $catalog[] = array (
                "name" => $GLOBALS['_LANG'][$module_id . '_category'],
                "url" => $GLOBALS['dou']->rewrite_url($module_id . '_category') 
        );
        foreach ($GLOBALS['dou']->get_category_nolevel($module_id . '_category') as $row) {
            $catalog[] = array (
                    "name" => $row['cat_name'],
                    "mark" => '-' . $row['mark'],
                    "url" => $row['url'] 
            );
        }
    }

    // 简单模块
    foreach ($GLOBALS['_MODULE']['single'] as $module_id) {
        // 不显示的模块
        $no_show = 'plugin|mobile|link|fragment';
        if (!in_array($module_id, explode('|', $no_show))) {
            $catalog[] = array (
                    "name" => $GLOBALS['_LANG'][$module_id],
                    "url" => $GLOBALS['dou']->rewrite_url($module_id) 
            );
        }
    }
    
    return $catalog;
}

?>