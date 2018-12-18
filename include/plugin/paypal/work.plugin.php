<?php
/**
 * DouPHP
 * --------------------------------------------------------------------------------------------------
 * 版权所有 2013-2018 漳州豆壳网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.douco.com
 * --------------------------------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在遵守授权协议前提下对程序代码进行修改和使用；不允许对程序代码以任何形式任何目的的再发布。
 * 授权协议：http://www.douco.com/license.html
 * --------------------------------------------------------------------------------------------------
 * Author: DouCo
 * Release Date: 2015-06-10
 */
if (!defined('IN_DOUCO')) {
    die('Hacking attempt');
}
class Plugin {
    var $plugin_id = 'paypal'; // 插件唯一ID

    /**
     * +----------------------------------------------------------
     * 构造函数
     * $order_sn 订单编号
     * $order_amount 订单金额
     * +----------------------------------------------------------
     */
    function Plugin($order_sn = '', $order_amount = '') {
        $this->order_sn = $order_sn;
        $this->order_amount = $order_amount;
    }

    /**
     * +----------------------------------------------------------
     * 建立请求
     * +----------------------------------------------------------
     * $session_cart session储存的商品信息
     * +----------------------------------------------------------
     */
    function work() {
        $plugin = $GLOBALS['dou']->get_plugin($this->plugin_id); // 获取插件信息
        
        $seller_email = $plugin['config']['seller_email'];
        $item_name = 'Order Sn : ' . $this->order_sn . ' (' . $GLOBALS['_CFG']['site_name'] . ')';
        $currency_code = $plugin['config']['currency_code'];
        $order_sn = $this->order_sn;
        $order_amount = $this->order_amount;
        $notify_url = ROOT_URL . 'include/plugin/' . $this->plugin_id . '/notify_url.php';
        $return_url = $GLOBALS['_URL']['order_list'];
        $cancel_return = ROOT_URL;

        $html_text  = 
            "<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_blank'>" .
            "<input type='hidden' name='cmd' value='_xclick'>" .
            "<input type='hidden' name='business' value='$seller_email'>" .               // 商家PayPal账户email地址
            "<input type='hidden' name='item_name' value='$item_name'>" .                 // 商品描述
            "<input type='hidden' name='currency_code' value='$currency_code'>" .         // 货币单位
            "<input type='hidden' name='amount' value='$order_amount'>" .                 // 商品金额或订单总价
            "<input type='hidden' name='invoice' value='$order_sn'>" .                    // 跟踪订单号（不显示给客户）
            "<input type='hidden' name='charset' value='utf-8'>" .                        // 字符集
            "<input type='hidden' name='no_shipping' value='1'>" .                        // 不要求客户提供收货地址
            "<input type='hidden' name='notify_url' value='$notify_url'>" .               // 支付成功后异步订单状态操作页面
            "<input type='hidden' name='cancel_return' value='$cancel_return'>" .         // 客户取消付款后返回地址
            "<input type='hidden' name='return' value='$return_url'>" .                   // 客户完成付款后将返回的地址
            "<input type='submit' class='btnPayment' value='立即付款'>" .
            "</form>";

        return $html_text;
    }

}
?>