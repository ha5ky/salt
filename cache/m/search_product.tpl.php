<?php /* Smarty version 2.6.26, created on 2018-09-11 14:08:03
         compiled from inc/search_product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'inc/search_product.tpl', 3, false),)), $this); ?>
<div class="searchBox">
 <form name="search" method="get" action="<?php echo $this->_tpl_vars['site']['m_url']; ?>
">
  <input name="s" type="text" class="keyword" autocomplete="off" maxlength="128" value="<?php if ($this->_tpl_vars['keyword']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['keyword'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php else: ?><?php echo $this->_tpl_vars['lang']['search_product']; ?>
<?php endif; ?>" onclick="formClick(this,'<?php echo $this->_tpl_vars['lang']['search_product']; ?>
')">
  <input type="submit" class="btnSearch" value="<?php echo $this->_tpl_vars['lang']['btn_submit']; ?>
">
 </form>
</div>