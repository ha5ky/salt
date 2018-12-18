<?php /* Smarty version 2.6.26, created on 2018-09-04 09:16:18
         compiled from filebox.htm */ ?>
<form action="<?php echo $this->_tpl_vars['cur']; ?>
.php?rec=filebox" id="contentForm" enctype="multipart/form-data" style="display:none">
 <input id="contentField" type="file" name="content_file">
 <input type="hidden" name="type" value="content"> <!-- 文件类型 -->
 <input type="hidden" name="item_id" value="<?php echo $this->_tpl_vars['item_id']; ?>
">
</form>