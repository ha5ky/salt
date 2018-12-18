<?php /* Smarty version 2.6.26, created on 2018-09-11 14:08:03
         compiled from inc/recommend_product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'inc/recommend_product.tpl', 9, false),)), $this); ?>
<?php if ($this->_tpl_vars['recommend_product']): ?>
<div class="incBox">
 <h3><a href="<?php echo $this->_tpl_vars['url']['product']; ?>
" class="more"><?php echo $this->_tpl_vars['lang']['product_more']; ?>
 ></a><?php echo $this->_tpl_vars['lang']['product_news']; ?>
</h3>
 <div class="productList"> 
  <?php $_from = $this->_tpl_vars['recommend_product']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_product'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_product']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['recommend_product']['iteration']++;
?>
  <dl>
   <dd<?php if ($this->_foreach['recommend_product']['iteration'] % 2 == 0): ?> class="clearBorder"<?php endif; ?>>
   <p class="img"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><img src="<?php echo $this->_tpl_vars['product']['thumb']; ?>
" width="<?php echo $this->_tpl_vars['site']['thumb_width']; ?>
" height="<?php echo $this->_tpl_vars['site']['thumb_height']; ?>
" /></a></p>
   <p class="name"><a href="<?php echo $this->_tpl_vars['product']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, ".") : smarty_modifier_truncate($_tmp, 10, ".")); ?>
</a></p>
   <p class="price"><?php echo $this->_tpl_vars['product']['price']; ?>
</p>
   </dd>
  </dl>
  <?php endforeach; endif; unset($_from); ?> 
 </div >
</div>
<?php endif; ?>