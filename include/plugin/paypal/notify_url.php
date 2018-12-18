<?php
/* *
 * 功能：paypal服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究paypal接口使用，只是提供一个参考。


 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见paypal_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，paypal会在24小时内按一定的时间策略重发通知
 */
define('IN_DOUCO', true);

require ('../../init.php');

// 引入和实例化订单功能
include_once (ROOT_PATH . 'include/order.class.php');
$dou_order = new Order();

// 实例化插件
require_once("work.plugin.php");
$plugin = new Plugin();

// 获取订单信息
$order_sn = intval($_POST['invoice']);
$query = $dou->select($dou->table('order'), '*', "order_sn = '$order_sn' AND user_id = '$_USER[user_id]'");
$order = $dou->fetch_array($query);

if ($order) { // 如果订单存在则执行以下操作
    if($order['status'] != 0) {
        exit;
    }
   
    // 拼装验证信息  
    $req = 'cmd=_notify-validate';  
    foreach ($_POST as $k=>$v) {
        $v = urlencode(stripslashes($v));
        $req .= "&{$k}={$v}";
    }
   
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,'https://www.paypal.com/cgi-bin/webscr');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$req);
    $output = curl_exec($ch);
    curl_close($ch);
    echo $output;  
   
    if ($output) { // 如果这次的请求是Paypal的服务器发送到我方服务器的则继续验证，否则退出
        if (strcmp($output, 'VERIFIED') == 0) { // 有效订单
            // 验证支付状态
            if ($_POST['payment_status'] != 'Completed' && $_POST['payment_status'] != 'Pending') {
                exit;
            }
   
            // 验证收款人账号是否正确  
            if ($_POST['receiver_email'] != $plugin['config']['seller_email']) {
                exit;
            }
   
            // 验证价格是否正确  
            if($_POST['mc_gross'] != $order['order_amount']) {
                exit;
            }
   
            // 验证货币类型  
            if ($plugin['config']['currency_code'] != $_POST['mc_currency']) {
                exit;
            }
            
            // 设置订单为付款完成
            $dou_order->change_status($order_sn, 1);
        } elseif (strcmp($output,'INVALID') === 0) { // 无效订单
            echo 'fail';
        }  
    }  
} else {
    echo 'fail';
}
?>