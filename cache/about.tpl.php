<?php /* Smarty version 2.6.26, created on 2018-09-04 09:15:54
         compiled from inc/about.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'inc/about.tpl', 3, false),)), $this); ?>
<div class="about">
 <h1><?php echo $this->_tpl_vars['site']['site_name']; ?>
</h1>
 <div class="desc"><?php echo ((is_array($_tmp=$this->_tpl_vars['index']['about_content'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 180, "...") : smarty_modifier_truncate($_tmp, 180, "...")); ?>
</div>
 <a href="<?php echo $this->_tpl_vars['index']['about_link']; ?>
" class="more"><?php echo $this->_tpl_vars['lang']['about_link']; ?>
</a>
</div>