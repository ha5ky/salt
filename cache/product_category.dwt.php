<?php /* Smarty version 2.6.26, created on 2018-09-04 09:16:00
         compiled from product_category.dwt */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'product_category.dwt', 23, false),)), $this); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="<?php echo $this->_tpl_vars['keywords']; ?>
" />
<meta name="description" content="<?php echo $this->_tpl_vars['description']; ?>
" />
<title><?php echo $this->_tpl_vars['page_title']; ?>
</title>
<link href="http://www.salt.com/theme/default/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://www.salt.com/theme/default/images/jquery.min.js"></script>
<script type="text/javascript" src="http://www.salt.com/theme/default/images/global.js"></script>
</head>
<body>
<div id="wrapper"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <div class="wrap mb">
  <div id="pageLeft"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/product_tree.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  <div id="pageIn"> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/ur_here.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
   <div id="productList"> 
    <?php $_from = $this->_tpl_vars['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['product_list']['iteration']++;
?> 
    <dl<?php if ($this->_foreach['product_list']['iteration'] % 2 == 0): ?> class="noMargin"<?php endif; ?>>
     <dt><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['product']['thumb']; ?>
" alt="<?php echo $this->_tpl_vars['product']['name']; ?>
" /></a></dt>
     <dd>
      <p class="name"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
" title="<?php echo $this->_tpl_vars['product']['name']; ?>
"><?php echo $this->_tpl_vars['product']['name']; ?>
</a></p>
      <p class="brief"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, "...") : smarty_modifier_truncate($_tmp, 50, "...")); ?>
</p>
      <p class="price"><?php echo $this->_tpl_vars['lang']['price']; ?>
：<?php echo $this->_tpl_vars['product']['price']; ?>
</p>
     </dd>
    </dl>
    <?php endforeach; endif; unset($_from); ?>
    <div class="clear"></div>
   </div>
   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
  <div class="clear"></div>
 </div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/online_service.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "inc/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
</body>
</html>