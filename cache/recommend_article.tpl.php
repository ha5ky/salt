<?php /* Smarty version 2.6.26, created on 2018-09-04 09:15:54
         compiled from inc/recommend_article.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'inc/recommend_article.tpl', 6, false),)), $this); ?>
<?php if ($this->_tpl_vars['recommend_article']): ?>
<div class="recArticle">
 <h3><em><?php echo $this->_tpl_vars['lang']['article_news']; ?>
</em><a href="<?php echo $this->_tpl_vars['url']['article']; ?>
" class="more"><?php echo $this->_tpl_vars['lang']['article_more']; ?>
</a></h3>
 <ul class="list">
  <?php $_from = $this->_tpl_vars['recommend_article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_article'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_article']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['article']):
        $this->_foreach['recommend_article']['iteration']++;
?>
  <li<?php if (($this->_foreach['recommend_article']['iteration'] == $this->_foreach['recommend_article']['total'])): ?> class="last"<?php endif; ?>><b><?php echo $this->_tpl_vars['article']['add_time_short']; ?>
</b><a href="<?php echo $this->_tpl_vars['article']['url']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['article']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 26, "...") : smarty_modifier_truncate($_tmp, 26, "...")); ?>
</a></li>
  <?php endforeach; endif; unset($_from); ?>
 </ul>
</div>
<?php endif; ?>