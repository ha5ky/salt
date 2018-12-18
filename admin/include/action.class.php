<?php

if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}
class Action extends Manager {
    /**
     * +----------------------------------------------------------
     * 初始化工作空间
     * +----------------------------------------------------------
     */
    function dou_workspace() {
        $menu_list = $this->get_menu_list();
        $workspace['menu_column'] = $menu_list['column'];
        $workspace['menu_single'] = $menu_list['single'];
        $workspace['menu_simple'] = $this->get_menu_page();
        
        // 可更新数量
        $number = unserialize($GLOBALS['_CFG']['update_number']);
        $number['system'] = $number['update'] + $number['patch'];
        
        $GLOBALS['smarty']->assign('unum', $number);
        
        // 计算工作空间高度
        if ($GLOBALS['_MODULE']['all']) {
            $height = (count($menu_list['single']) * 43) + (count($menu_list['column']) * 86) + 280;
        } else {
            $record_count = mysql_num_rows($this->query("SELECT * FROM " . $this->table('page')));
            $height = $record_count * 43 + 280;
        }
        $height = $height < 550 ? 550 : $height;
        $workspace['height'] = 'height:auto!important;height:'.$height.'px;min-height:'.$height.'px;';
        
        return $workspace;
    }
    
    /**
     * +----------------------------------------------------------
     * 本地站点信息，在线安装时使用
     * +----------------------------------------------------------
     * $type 类型
     * +----------------------------------------------------------
     */
    function dou_localsite($type = '') {
        if ($type) {
            $update_date = unserialize($GLOBALS['_CFG']['update_date']);
            $localsite = $update_date[$type];
        } else {
            $localsite = unserialize($GLOBALS['_CFG']['update_date']);
        }
        
        $cloud_account = unserialize($GLOBALS['_CFG']['cloud_account']);
        $localsite['cloud_account'] = array('user' => $cloud_account['user'], 'password' => $cloud_account['password']);
        $localsite['url'] = ROOT_URL;
        return urlencode(serialize($localsite));
    }
    
    /**
     * +----------------------------------------------------------
     * 获取导航菜单
     * +----------------------------------------------------------
     * $type 导航类型
     * $parent_id 默认获取一级导航
     * $level 无限极分类层次
     * $current_id 当前页面栏目ID
     * $mark 无限极分类标记
     * +----------------------------------------------------------
     */
    function get_nav_admin($type = 'middle', $parent_id = 0, $level = 0, $current_id = '', &$nav = array(), $mark = '-') {
        $data = $this->fetch_array_all($this->table('nav'), 'sort ASC');
        foreach ((array) $data as $value) {
            if ($value['parent_id'] == $parent_id && $value['type'] == $type && $value['id'] != $current_id) {
                if ($value['module'] != 'nav') {
                    $value['guide'] = $this->rewrite_url($value['module'], $value['guide'], $type);
                }
                
                $value['mark'] = str_repeat($mark, $level);
                $nav[] = $value;
                $this->get_nav_admin($type, $value['id'], $level + 1, $current_id, $nav);
            }
        }
        return $nav;
    }
    
    /**
     * +----------------------------------------------------------
     * 生成模块后台菜单
     * +----------------------------------------------------------
     */
    function get_menu_list() {
        foreach ((array) $GLOBALS['_MODULE']['column'] as $value) {
            $menu_list['column'][] = array (
                    'name_category' => $value . '_category',
                    'lang_category' => $GLOBALS['_LANG'][$value . '_category'],
                    'name' => $value,
                    'lang' => $GLOBALS['_LANG'][$value]
            );
        }

        foreach ((array) $GLOBALS['_MODULE']['single'] as $value) {
            $menu_list['single'][] = array (
                    'name' => $value,
                    'lang' => $GLOBALS['_LANG'][$value]
            );
        }
        
        return $menu_list;
    }

    /**
     * +----------------------------------------------------------
     * 获取有层次的栏目分类，有几层分类就创建几维数组
     * +----------------------------------------------------------
     * $parent_id 默认获取一级导航
     * $current_id 当前页面栏目ID
     * +----------------------------------------------------------
     */
    function get_menu_page($parent_id = 0, $current_id = '') {
        $menu_page = array ();
        $query = $this->query("SELECT id, unique_id, parent_id, page_name FROM " . $this->table('page') . " ORDER BY id ASC");
        while ($row = $this->fetch_assoc($query)) {
            $data[] = $row;
        }
        foreach ((array) $data as $value) {
            // $parent_id将在嵌套函数中随之变化
            if ($value['parent_id'] == $parent_id) {
                $value['cur'] = $value['id'] == $current_id ? true : false;
                
                foreach ($data as $child) {
                    // 筛选下级导航
                    if ($child['parent_id'] == $value['id']) {
                        // 嵌套函数获取子分类
                        $value['child'] = $this->get_menu_page($value['id'], $current_id);
                        break;
                    }
                }
                $menu_page[] = $value;
            }
        }
        
        return $menu_page;
    }

    /**
     * +----------------------------------------------------------
     * 获取整站目录数据
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $id 当前正在编辑的导航栏目ID
     * +----------------------------------------------------------
     */
    function get_catalog($module = '', $id = '') {
        // 单页面列表
        foreach ((array) $this->get_page_nolevel() as $row) {
            $catalog[] = array (
                    "name" => $row['page_name'],
                    "module" => 'page',
                    "guide" => $row['id'],
                    "cur" => ($module == 'page' && $id == $row['id']) ? true : false,
                    "mark" => '-' . $row['mark'] 
            );
        }
        
        // 栏目模块
        foreach ((array) $GLOBALS['_MODULE']['column'] as $module_id) {
            $catalog[] = array (
                    "name" => $GLOBALS['_LANG']['nav_' . $module_id],
                    "module" => $module_id . '_category',
                    "cur" => ($module == $module_id . '_category' && $id == 0) ? true : false,
                    "guide" => 0 
            );
            foreach ($this->get_category_nolevel($module_id . '_category') as $row) {
                $catalog[] = array (
                        "name" => $row['cat_name'],
                        "module" => $module_id . '_category',
                        "guide" => $row['cat_id'],
                        "cur" => ($module == $module_id . '_category' && $id == $row['cat_id']) ? true : false,
                        "mark" => '-' . $row['mark'] 
                );
            }
        }

        // 简单模块
        foreach ((array) $GLOBALS['_MODULE']['single'] as $module_id) {
            $no_show = 'plugin'; // 不显示的模块
            if (!in_array($module_id, explode('|', $no_show))) {
                $catalog[] = array (
                        "name" => $GLOBALS['_LANG'][$module_id],
                        "module" => $module_id,
                        "cur" => ($module == $module_id && $id == 0) ? true : false,
                        "guide" => 0
                );
            }
        }

        // 其它模块
        $catalog[] = array (
                "name" => $GLOBALS['_LANG']['mobile'],
                "module" => 'mobile',
                "cur" => ($module == 'mobile' && $id == 0) ? true : false,
                "guide" => 0 
        );
        
        return $catalog;
    }
 
    /**
     * +----------------------------------------------------------
     * 获取首页显示项目
     * +----------------------------------------------------------
     * $module 模块名称
     * $field 名称字段
     * +----------------------------------------------------------
     */
    function get_sort($module, $field = 'name') {
        $display = $GLOBALS['_DISPLAY']['home_' . $module];
     
        // 是否显示面板
        $sort['handle'] = $_SESSION['if_sort'];
     
        // 项目列表
        $limit = $display ? ' LIMIT ' . $display : '';
        $sql = "SELECT id, " . $field . ", image FROM " . $this->table($module) . " WHERE sort > 0 ORDER BY sort DESC" . $limit;
        $query = $this->query($sql);
        while ($row = $this->fetch_array($query)) {
            $image = ROOT_URL . $row['image'];
            $sort['list'][] = array (
                    "id" => $row['id'],
                    "$field" => $row[$field],
                    "image" => $image
            );
        }
        
        // 首页显示文章数量限制框
        for($i = 1; $i <= $display; $i++) {
            $sort['bg'] .= "<li><em></em></li>";
        }
     
        return $sort;
    }
    
    /**
     * +----------------------------------------------------------
     * 批量移动分类
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $checkbox 要批量处理的ID合集
     * $new_cate_id 要移动到哪个分类
     * +----------------------------------------------------------
     */
    function category_move($module, $checkbox, $new_cate_id) {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        // 移动分类操作
        $this->query("UPDATE " . $this->table($module) . " SET cat_id = '$new_cate_id' WHERE id " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['category_move_batch'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['category_move_batch_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 批量删除
     * +----------------------------------------------------------
     * $module 模块名称及数据表名
     * $checkbox 要批量处理的ID合集
     * $field_filter 筛选条件
     * $field_image 文件域
     * +----------------------------------------------------------
     */
    function del_all($module, $checkbox, $field_filter, $field_image = '') {
        $sql_in = $this->create_sql_in($_POST['checkbox']);
        
        // 删除相应图片
        if ($field_image) {
            $sql = "SELECT " . $field_image . " FROM " . $this->table($module) . " WHERE " . $field_filter . " " . $sql_in;
            $query = $this->query($sql);
            while ($row = $this->fetch_array($query)) {
                $this->del_file($row[$field_image]);
            }
        }
        
        // 从数据库中删除所选内容
        $this->query("DELETE FROM " . $this->table($module) . " WHERE " . $field_filter . " " . $sql_in);
        
        $this->create_admin_log($GLOBALS['_LANG']['del_all'] . ': ' . strtoupper($module) . ' ' . addslashes($sql_in));
        $this->dou_msg($GLOBALS['_LANG']['del_succes'], $module . '.php');
    }
    
    /**
     * +----------------------------------------------------------
     * 删除文件
     * +----------------------------------------------------------
     * $number 文件编号
     * +----------------------------------------------------------
     */
    function del_file($number) {
        $file = $this->get_row('file', 'file, thumb_size', "number = '$number'");
     
        // 删除主文件
        @unlink(ROOT_PATH . $file['file']);
     
        // 删除缩略图
        if ($file['thumb_size']) {
            $no_ext = explode(".", $file['file']);
            $image_thumb = $no_ext[0] . '_thumb' . '.' . $no_ext[1];
            @unlink(ROOT_PATH . $image_thumb);
        }
     
        $this->delete($this->table('file'), "number = '$number'");
    }
    
    /**
     * +----------------------------------------------------------
     * 获取当前目录子文件夹
     * +----------------------------------------------------------
     * $dir 要检索的目录
     * +----------------------------------------------------------
     */
    function get_subdirs($dir) {
        $subdirs = array();
        if (!$handle  = @opendir($dir)) return $subdirs;
        
        while ($file = @readdir($handle )) {
            if ($file == '.' || $file == '..') continue; // 排除掉当前目录和上一个目录
            $subdirs[] = $file;
        }
        return $subdirs;
    }
    
    /**
     * +----------------------------------------------------------
     * 清除缓存及已编译模板
     * +----------------------------------------------------------
     * $dir 要删除的目录
     * +----------------------------------------------------------
     */
    function dou_clear_cache($dir) {
        $dir = realpath($dir);
        if (!$dir || !@is_dir($dir))
            return 0;
        $handle = @opendir($dir);
        if ($dir[strlen($dir) - 1] != DIRECTORY_SEPARATOR)
            $dir .= DIRECTORY_SEPARATOR;
        while ($file = @readdir($handle)) {
            if ($file != '.' && $file != '..') {
                if (@is_dir($dir . $file) && !is_link($dir . $file))
                    $this->dou_clear_cache($dir . $file);
                else
                    @unlink($dir . $file);
            }
        }
        closedir($handle);
    }
    
    /**
     * +----------------------------------------------------------
     * 删除目录及目录下所有子目录和文件
     * +----------------------------------------------------------
     * $dir 要删除的目录
     * $sub_dir 只删除子目录
     * +----------------------------------------------------------
     */
    function del_dir($dir, $sub_dir = false) {
        if ($handle = @opendir($dir)) {
           // 删除目录下子目录和文件
           while (false !== ($item = @readdir($handle))) {  
               if ($item != '.' && $item != '..') {  
                   if (is_dir( "$dir/$item")) {  
                       $this->del_dir("$dir/$item");  
                   } else {  
                       @unlink("$dir/$item");  
                   }  
               }  
           }  
           closedir($handle);
           
           // 删除目录本身
           if (!$sub_dir) @rmdir($dir);  
        } 
    }
 
    /**
     * 判断 文件/目录 是否可写
     */
    function check_writeable($file) {
        if (file_exists($file)) {
            if (is_dir($file)) {
                $dir = $file;
                if ($fp = @fopen("$dir/test.txt", 'w')) {
                    @fclose($fp);
                    @unlink("$dir/test.txt");
                    $writeable = 1;
                } else {
                    $writeable = 0;
                }
            } else {
                if ($fp = @fopen($file, 'a+')) {
                    @fclose($fp);
                    $writeable = 1;
                } else {
                    $writeable = 0;
                }
            }
        } else {
            $writeable = 2;
        }
        
        return $writeable;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取去除路径和扩展名的文件名
     * +----------------------------------------------------------
     * $file 图片地址
     * +----------------------------------------------------------
     */
    function get_file_name($file) {
        $basename = basename($file);
        return $file_name = substr($basename, 0, strrpos($basename, '.'));
    }
 
    /**
     * +----------------------------------------------------------
     * 获取根据时间排序的文件列表信息
     * +----------------------------------------------------------
     * $files 文件列表
     * $ext 文件后缀
     * +----------------------------------------------------------
     */
    function get_filelist_by_time($files, $ext) {
        if (is_array($files) && count($files)) {
            $prepre = '';
            $info = $infos = array ();
            foreach ($files as $id => $file) {
                if (strpos(basename($file), $ext)) {
                    $filename = $info['filename'] = basename($file);
                    if (filesize($file) < 1048576) {
                        $info['filesize'] = round(filesize($file) / 1024, 2) . "K";
                    } else {
                        $info['filesize'] = round(filesize($file) / (1024 * 1024), 2) . "M";
                    }
                    $info['maketime'] = date('Y-m-d H:i:s', filemtime($file));

                    if (preg_match('/_([0-9])+\$ext$/', $filename, $match)) {
                        $info['number'] = $match[1];
                    } else {
                        $info['number'] = '';
                    }
                    $prepre = $info['pre'];
                    $infos[] = $info;
                }
            }

            $flag = array();
            foreach($infos as $v) {
                $flag[] = $v['maketime'];
            }  
            array_multisort($flag, SORT_DESC, $infos);

            return $infos;
        }
    }
 
    /**
     * +----------------------------------------------------------
     * 获取首尾的文件信息
     * +----------------------------------------------------------
     * $files 文件列表
     * $ext 文件后缀
     * +----------------------------------------------------------
     */
    function get_first_end_file($files, $ext) {
        $infos = $this->get_filelist_by_time($files, $ext);

        if (is_array($infos)) {
            $backup['new'] = current($infos);
            $backup['old'] = end($infos);
            $over_day = floor((time() - strtotime($backup['new']['maketime']))/(3600*24)); // 单位天
        }
        
        if (!isset($over_day)) {
            $backup['msg'] = $GLOBALS['_LANG']['backup_action_cue_never'];
            $backup['light'] = true;
        } elseif ($over_day == 0) {
            $backup['msg'] = $GLOBALS['_LANG']['backup_action_cue_today'];
        } elseif ($over_day > 30) {
            $backup['msg'] = $GLOBALS['_LANG']['backup_action_cue_overday_a'] . $over_day . $GLOBALS['_LANG']['backup_action_cue_overday_b'];
            $backup['light'] = true;
        } else {
            $backup['msg'] = $over_day . $GLOBALS['_LANG']['backup_action_cue_day'];
        }
        
        return $backup;
    }
    
    /**
     * +----------------------------------------------------------
     * 获取模板信息
     * +----------------------------------------------------------
     * $unique_id 模板ID
     * $is_mobile 是否是手机版
     * +----------------------------------------------------------
     */
    function get_theme_info($unique_id, $is_mobile = false) {
        $theme_url = $is_mobile ? M_PATH.'/theme/' : 'theme/';
        $content = file(ROOT_PATH . $theme_url . $unique_id . '/style.css');
        foreach ((array) $content as $line) {
            if (strpos($line, '/*') !== false) continue;
            if (strpos($line, '*/') !== false) break;
            
            $line = preg_replace('/:/', '#', $line, 1); // 使用'#'作为分隔符，避免把网址中的':'也给分割了
            $arr = explode('#', trim($line));
            $key = str_replace(' ', '_', strtolower($arr[0]));
            $info[$key] = trim($arr[1]);
        }
        $info['unique_id'] = $unique_id;
        $info['image'] = ROOT_URL . $theme_url . $unique_id . '/images/screenshot.png';
        
        return $info;
    }

    /**
     * +----------------------------------------------------------
     * 给URL自动上http://
     * +----------------------------------------------------------
     * $url 网址
     * +----------------------------------------------------------
     */
    function auto_http($url) {
        if (strpos($url, 'http://') !== false || strpos($url, 'https://') !== false) {
            $url = trim($url);
        } else {
            $url = 'http://' . trim($url);
        }
        return $url;
    }
    
    /**
     * +----------------------------------------------------------
     * 版本升级提示
     * +----------------------------------------------------------
     */
    function dou_api() {
        global $_CFG;
        global $sys_info;
        
        $apiget = "ver=$_CFG[douphp_version]&update=$sys_info[update]&patch=$sys_info[patch]&lang=$_CFG[language]&php_ver=$sys_info[php_ver]&mysql_ver=$sys_info[mysql_ver]&os=$sys_info[os]&web_server=$sys_info[web_server]&charset=$sys_info[charset]&template=$_CFG[site_theme]&url=" . ROOT_URL;
        return "http://api.douco.com/update.php" . '?' . $apiget;
    }
    
    /**
     * +----------------------------------------------------------
     * 创建IN查询如"IN('1','2')";
     * +----------------------------------------------------------
     * $arr 要处理成IN查询的数组
     * +----------------------------------------------------------
     */
    function create_sql_in($arr) {
        foreach ((array) $arr as $list) {
            $sql_in .= $sql_in ? ",'$list'" : "'$list'";
        }
        return "IN ($sql_in)";
    }
    
    /**
     * +----------------------------------------------------------
     * 后台通用信息提示
     * +----------------------------------------------------------
     * $text 提示的内容
     * $url 提示后要跳转的网址
     * $out 管理员登录操作时的提示页面
     * $time 多久时间跳转
     * $check 删除确认按钮的链接
     * +----------------------------------------------------------
     */
    function dou_msg($text, $url = '', $out = '', $time = 3, $check = '') {
        if (!$text) {
            $text = $GLOBALS['_LANG']['dou_msg_success'];
        }
        
        $GLOBALS['smarty']->assign('ur_here', $GLOBALS['_LANG']['dou_msg']);
        $GLOBALS['smarty']->assign('text', $text);
        $GLOBALS['smarty']->assign('url', $url);
        $GLOBALS['smarty']->assign('out', $out);
        $GLOBALS['smarty']->assign('time', $time);
        $GLOBALS['smarty']->assign('check', $check);
        
        // 根据跳转时间生成跳转提示
        $cue = preg_replace('/d%/Ums', $time, $GLOBALS['_LANG']['dou_msg_cue']);
        $GLOBALS['smarty']->assign('cue', $cue);
        
        $GLOBALS['smarty']->display('dou_msg.htm');
        exit();
    }
 
    /**
     * +----------------------------------------------------------
     * 排序盒子
     * +----------------------------------------------------------
     * $module 模块名
     * $act 操作项
     * $id 项目ID
     * +----------------------------------------------------------
     */
    function sort_box($module, $act, $id = '') {
        if ($act == 'handle') { // 打开筛选功能
            $_SESSION['if_sort'] = $_SESSION['if_sort'] ? false : true;
        } else {
            // 验证并获取合法的ID
            $id = $GLOBALS['check']->is_number($_REQUEST['id']) ? $_REQUEST['id'] : $this->dou_msg($GLOBALS['_LANG']['illegal'], $module . '.php');
            if ($act == 'set') { // 设为首页显示文章
                $max_sort = $this->get_one("SELECT sort FROM " . $this->table($module) . " ORDER BY sort DESC");
                $new_sort = $max_sort + 1;
                $this->query("UPDATE " . $this->table($module) . " SET sort = '$new_sort' WHERE id = '$id'");
            } elseif ($act == 'cancel') { // 取消首页显示文章
                $this->query("UPDATE " . $this->table($module) . " SET sort = '' WHERE id = '$id'");
            }
        } 
    }
}

?>