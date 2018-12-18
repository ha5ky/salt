-- DouPHP v1.x SQL Dump Program
-- http://www.salt.com/
-- 
-- DATE : 2018-09-04 10:57:47
-- MYSQL SERVER VERSION : 5.5.53
-- PHP VERSION : 5.6.27
-- DouPHP VERSION : v1.5 Beta3 20180831

DROP TABLE IF EXISTS `salt_admin`;
CREATE TABLE `salt_admin` (
  `user_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(60) NOT NULL DEFAULT '',
  `email` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `action_list` text NOT NULL,
  `add_time` int(11) NOT NULL DEFAULT '0',
  `last_login` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO salt_admin VALUES('1','admin','','e10adc3949ba59abbe56e057f20f883e','ALL','1535790910','1536022314','127.0.0.1');

DROP TABLE IF EXISTS `salt_admin_log`;
CREATE TABLE `salt_admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `action` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `create_time` (`create_time`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

INSERT INTO salt_admin_log VALUES('1','1381887740','1','系统设置: 编辑成功','127.0.0.1');
INSERT INTO salt_admin_log VALUES('2','1381887745','1','编辑导航: 公司简介','127.0.0.1');
INSERT INTO salt_admin_log VALUES('3','1381887749','1','编辑幻灯: 广告图片01','127.0.0.1');
INSERT INTO salt_admin_log VALUES('4','1381887753','1','编辑单页面: 联系我们','127.0.0.1');
INSERT INTO salt_admin_log VALUES('5','1381887756','1','编辑商品分类: 电子数码','127.0.0.1');
INSERT INTO salt_admin_log VALUES('6','1381887759','1','编辑文章分类: 公司动态','127.0.0.1');
INSERT INTO salt_admin_log VALUES('7','1381887775','1','编辑单页面: 企业荣誉','127.0.0.1');
INSERT INTO salt_admin_log VALUES('8','1381887778','1','编辑单页面: 公司简介','127.0.0.1');
INSERT INTO salt_admin_log VALUES('9','1381887781','1','编辑单页面: 营销网络','127.0.0.1');
INSERT INTO salt_admin_log VALUES('10','1535790931','1','管理员登录: 登录成功！','127.0.0.1');
INSERT INTO salt_admin_log VALUES('11','1535790991','1','编辑幻灯: 广告图片01','127.0.0.1');
INSERT INTO salt_admin_log VALUES('12','1535791025','1','编辑幻灯: 广告图片01','127.0.0.1');
INSERT INTO salt_admin_log VALUES('13','1535791054','1','添加幻灯: 5','127.0.0.1');
INSERT INTO salt_admin_log VALUES('14','1535791065','1','删除幻灯: 广告图片01','127.0.0.1');
INSERT INTO salt_admin_log VALUES('15','1535791192','1','系统设置: 编辑成功','127.0.0.1');
INSERT INTO salt_admin_log VALUES('16','1535791538','1','编辑单页面: 公司简介','127.0.0.1');
INSERT INTO salt_admin_log VALUES('17','1535791603','1','编辑单页面: 联系我们','127.0.0.1');
INSERT INTO salt_admin_log VALUES('18','1535953718','1','管理员登录: 登录成功！','127.0.0.1');
INSERT INTO salt_admin_log VALUES('19','1535956283','1','编辑商品: 日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('20','1535956363','1','编辑商品分类: 盐类','127.0.0.1');
INSERT INTO salt_admin_log VALUES('21','1535956411','1','编辑商品分类: 盐类','127.0.0.1');
INSERT INTO salt_admin_log VALUES('22','1535956442','1','编辑商品分类: 母婴用品','127.0.0.1');
INSERT INTO salt_admin_log VALUES('23','1536022314','1','管理员登录: 登录成功！','127.0.0.1');
INSERT INTO salt_admin_log VALUES('24','1536022378','1','编辑商品分类: 盐类','127.0.0.1');
INSERT INTO salt_admin_log VALUES('25','1536022416','1','编辑商品分类: 盐类','127.0.0.1');
INSERT INTO salt_admin_log VALUES('26','1536022439','1','编辑商品分类: 盐类','127.0.0.1');
INSERT INTO salt_admin_log VALUES('27','1536022886','1','编辑商品: 日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('28','1536023029','1','编辑商品: 粉碎盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('29','1536023105','1','编辑商品: 粉洗盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('30','1536023133','1','编辑商品: 氯化钠','127.0.0.1');
INSERT INTO salt_admin_log VALUES('31','1536023164','1','编辑商品: 日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('32','1536023210','1','编辑商品: 加工盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('33','1536023254','1','编辑商品: 加碘日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('34','1536023297','1','编辑商品: 加碘日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('35','1536023325','1','编辑商品: 颗粒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('36','1536023353','1','编辑商品: 加碘日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('37','1536023402','1','编辑商品: 加碘日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('38','1536023462','1','编辑商品: 样品','127.0.0.1');
INSERT INTO salt_admin_log VALUES('39','1536023721','1','编辑商品: 粉碎盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('40','1536023785','1','编辑商品: 粉碎盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('41','1536023815','1','编辑商品: 加工盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('42','1536023947','1','编辑商品: 加工盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('43','1536024034','1','删除商品: 加工盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('44','1536024054','1','批量删除: PRODUCT IN (&#039;10&#039;,&#039;9&#039;,&#039;8&#039;,&#039;7&#039;,&#039;6&#039;,&#039;5&#039;,&#039;4&#039;,&#039;3&#039;,&#039;2&#039;,&#039;1&#039;)','127.0.0.1');
INSERT INTO salt_admin_log VALUES('45','1536024079','1','添加商品: 加工盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('46','1536024124','1','添加商品: 加碘日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('47','1536024148','1','添加商品: 盐颗粒','127.0.0.1');
INSERT INTO salt_admin_log VALUES('48','1536024185','1','添加商品: 样品','127.0.0.1');
INSERT INTO salt_admin_log VALUES('49','1536024205','1','添加商品: 日晒盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('50','1536024229','1','添加商品: 水洗盐','127.0.0.1');
INSERT INTO salt_admin_log VALUES('51','1536024273','1','删除幻灯: 广告图片02','127.0.0.1');
INSERT INTO salt_admin_log VALUES('52','1536024279','1','删除幻灯: 广告图片03','127.0.0.1');
INSERT INTO salt_admin_log VALUES('53','1536024285','1','删除幻灯: 广告图片04','127.0.0.1');
INSERT INTO salt_admin_log VALUES('54','1536024308','1','添加幻灯: 6','127.0.0.1');
INSERT INTO salt_admin_log VALUES('55','1536024319','1','编辑幻灯: 5','127.0.0.1');
INSERT INTO salt_admin_log VALUES('56','1536024331','1','添加幻灯: 7','127.0.0.1');
INSERT INTO salt_admin_log VALUES('57','1536024348','1','添加幻灯: 8','127.0.0.1');
INSERT INTO salt_admin_log VALUES('58','1536024958','1','系统设置: 编辑成功','127.0.0.1');

DROP TABLE IF EXISTS `salt_article`;
CREATE TABLE `salt_article` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `title` varchar(150) NOT NULL DEFAULT '',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `click` smallint(6) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(50) DEFAULT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  `add_time` varchar(50) DEFAULT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO salt_article VALUES('1','1','DouPHP后台登录不了','','后台登录不了，主要问题集中在，输入正确的验证码后仍然提示验证码不对，这个问题造成的原因是输入的验证码无法传送给后台程序，造成这个问题多数是由于服务器不支持session或者cookie造成，所以这个时候您就需要与空间商取得联系，让他们开启session和cookie功能，如果是自己的服务器，则需自己查阅相关技术文档解决此问题。 <br />','','0','','','1372261194','0');
INSERT INTO salt_article VALUES('2','1','使用DouBAK将您的网站转移至另一个服务器','','1.下载程序并解压。<br />\r\n2.将doubak目录上传至站点根目录。<br />\r\n3.运行http://www.domain.com/doubak(domain表示你的域名)，点击\"立即备份\"将数据库备份。<br />\r\n4，将站点文件下载并修改\"data/config.php\"改成新服务器的数据库信息。<br />\r\n5，最后上传所有站点文件至新的服务器，运行http://www.domain.com/doubak点击\"恢复数据库\"即可。','','0','','','1372261407','0');
INSERT INTO salt_article VALUES('3','1','新安装或者升级后都是乱码','','造成乱码问题一般是由于上传PHP文件时，FTP没有开启二进制上传模式造成的，解决方法是使用二进制重新上传一次。<br />\r\n<br />\r\n几种常见的FTP软件的二进制设置说明：<br />\r\n<br />\r\n1、FlashFXP：<br />\r\n打开 FlashFXP：在工具栏中，选项 =&gt; 参数（也可以直接按F6键），在弹出来的窗口中，选择“传输(T)”卡，在传输模式中选择“二进制”。<br />\r\n<br />\r\n2、LeapFTP：<br />\r\n打开 LeapFTP： 在 Options（选项）菜单中选择 Parameters（参数设置），选择其中的（ASCII 扩展名），出现列表后，选中其中的“*.PHP”，点右边的（删除），再点右边的（确定）即可。如果“*.PHP”项目不存在的话，可直接使用，不需另行设置。<br />\r\n<br />\r\n3、CuteFTP：<br />\r\n打开 CuteFTP： 进入软件后按 ALT+F7 进入 Global Options（全局选项），传输 =&gt; 传输方式 =&gt;&nbsp;<br />\r\n<br />\r\n二进制<br />\r\n4、filezilla<br />\r\n打开 filezilla： 在工具栏中，传输 =&gt; 传送类型 =&gt; 选择“二进制”<br />\r\n<br />\r\n注意：二进制是binary 不是ASCII！！<br />\r\n<br />','','0','','','1372261508','0');
INSERT INTO salt_article VALUES('4','1','开启伪静态后提示500错误','','如果您开启伪静态后网站无法打开，提示500错误，一般是由于服务器本身不支持伪静态造成，需要联系空间商重启服务器并开启伪静态功能<br />','','0','','','1372261551','0');
INSERT INTO salt_article VALUES('5','1','网站建设要素之如何制定一份网站策划方案','','要建立一个网站，需要从网站定位，到设计、网站结构、内容准备、内外链的建设等等，是一个复杂繁琐的过程，需要准备一份网站的策划方案。本文将简要描述，从网站的定位到最终的网站建成，整个过程。<br />\r\n<br />\r\n一、网站的定位<br />\r\n<br />\r\n分析：给网站定位，策划一个网站，这是第一步，只有给网站定位好了，才能按照定位的关键词展开。如何给网站定位，如何选择网站的核心关键词。选择核心关键词，需要考虑的因素有：搜索量大、有一定的商业价值、竞争度相对较低。<br />\r\n<br />\r\n这里有个小建议，一般建站前，肯定清楚网站属于哪一个类别，然后根据这个类别的核心关键词，通过百度蜂巢系统，将相关关键词拉出，再根据需要考虑的因素，选择最合适的关键词<br />\r\n<br />\r\n二、确定网站三要素<br />\r\n<br />\r\n分析：建站的三要素，指的是程序、域名和空间，在确定了网站的核心关键词以后，可以由关键词确定网站名称，然后再根据网站名称，选择域名；根据网站主题，选择程序；关于空间，最好是正规空间商提供的服务器，稳定、安全，虽然价格可能比较贵。<br />\r\n<br />\r\n在建立网站需要哪些条件一文中，有详细介绍网站三要素的内容，感兴趣的童鞋可以看看。<br />\r\n<br />\r\n三、确定网站关键词<br />\r\n<br />\r\n分析：这里所说的关键词，是根据已经定位好的核心关键词，再总结所有长尾词的特点，确定一批转化率较高的长尾词，可以作为网站的目录等，分布在首页中<br />\r\n<br />\r\n四、确定网站标题标签<br />\r\n<br />\r\n分析：在网站的定位时，已经确定了网站的关键词，然后再根据网站的关键词，填写网站标题、关键词标签、描述标签。这些都是网站优化的基础，需要注意的是，尽量将内容写的自然，关键词千万不要堆积。标题中，包括三个关键词即可<br />\r\n<br />\r\n五、完善网站布局<br />\r\n<br />\r\n分析：根据前面确定的关键词、长尾词体系，完善网站的子目录及首页的布局，包括核心关键词、近义词、同义词等，增加关键词的密度。下一章，Q猪将从分析robin的广场舞的首页，讲一下网站如何布局。<br />\r\n<br />\r\n六、构建网站结构<br />\r\n<br />\r\n分析：网站的结构尽量以扁平树形结构，具体可以看下，如何制作合理的网站结构。在构建网站结构的同时，注意URL的简单、规范。<br />\r\n<br />\r\n七、编辑网站内容<br />\r\n<br />\r\n分析：网站的内容，尽量以原创和质量较高的微原创为主，注意网站内链的建设，可以建立一份长尾词记录单，记录每一篇文章优化的关键词。<br />\r\n<br />\r\n在编辑文章内容时，注意关键词的四处一词，标题，关键词标签、描述，正文，还有网站其他页面关于帖子的锚文本。<br />\r\n<br />\r\n如果网站的内容编辑，积累到一定程度以后，可以将网站的URL提交给搜索引擎即可。然后就是外链的建设，还有网站内容的，逐步增加。<br />','','1','网站策划','','1372261651','0');
INSERT INTO salt_article VALUES('6','1','如何新增语言文件','','第一步 在 “languages”目录下建立如 “zh_tw” 然后将拷贝 zh_cn 下的 web.lang.php 到这个目录下<br />\r\n<br />\r\n第二步 登陆DouPHP后台，在 “系统设置” -&gt; “系统语言” 选择您刚才添加的语言<br />\r\n<br />\r\n提示：由于国内使用即使是英文版的网站后台也是中文的，所以暂不开放后台语言的切换<br />\r\n<br />','','12','','','1372261775','0');
INSERT INTO salt_article VALUES('7','2','如何修改手机版地址','','1，打开“data/config.php”找到 define(\'M_PATH\',\'m\') 将 m 改为新的后台目录名称<br />\r\n2，找到根目录下“m”目录改为新的后台目录名称<br />\r\n<br />','','2','','','1372261909','0');
INSERT INTO salt_article VALUES('8','2','图片无法上传或者缩略图无法生成','','1，根目录下images和data目录无写入权限（注：包括其下子目录）<br />\r\n2，服务器没有开启文件上传功能<br />\r\n<br />\r\n造成缩略图无法生成主要原因：服务器没有开启GD库功能<br />\r\n<br />','','0','','','1372261997','0');
INSERT INTO salt_article VALUES('9','2','如何建立一个新的DouPHP模板','','第一步 打开 “theme”目录 ，将“default”目录复制一份，更名为您打算制作的模板名称（可包含英文或数字），然后打开您的模板，了解下模板目录结构<br />\r\n<br />\r\n第二步 登陆DouPHP后台，在 “系统设置” -&gt; “站点模板” 选择您刚才添加的模板<br />\r\n<br />','','11','','','1372262040','0');
INSERT INTO salt_article VALUES('10','1','如何添加自定义字段','','以商品为例，如果要给商品加上自定义字段，首先找到“系统设置”-&gt;[自定义]然后填入如“颜色,尺寸,型号”中间以英文逗号隔开，然后在商品编辑页面会看到相应的自定义字段，输入对应的值即可<br />','','109','','','1372262079','0');

DROP TABLE IF EXISTS `salt_article_category`;
CREATE TABLE `salt_article_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO salt_article_category VALUES('1','company','公司动态','公司动态','公司的最新新闻在此发布','0','10');
INSERT INTO salt_article_category VALUES('2','industry','行业新闻','行业新闻','最新行业资讯','0','20');

DROP TABLE IF EXISTS `salt_config`;
CREATE TABLE `salt_config` (
  `name` varchar(80) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT '',
  `box` varchar(255) NOT NULL DEFAULT '',
  `tab` varchar(10) NOT NULL DEFAULT 'main',
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO salt_config VALUES('site_name','营口洪亿盐业','text','','main','1');
INSERT INTO salt_config VALUES('site_title','营口洪亿盐业','text','','main','2');
INSERT INTO salt_config VALUES('site_keywords','营口洪亿盐业','text','','main','3');
INSERT INTO salt_config VALUES('site_description','营口洪亿盐业','text','','main','4');
INSERT INTO salt_config VALUES('site_logo','logo.png','file','','main','5');
INSERT INTO salt_config VALUES('site_address','营口洪亿盐业','text','','main','6');
INSERT INTO salt_config VALUES('site_closed','0','radio','','main','7');
INSERT INTO salt_config VALUES('icp','','text','','main','8');
INSERT INTO salt_config VALUES('tel','18841715669','text','','main','9');
INSERT INTO salt_config VALUES('fax','','text','','main','10');
INSERT INTO salt_config VALUES('qq','','text','','main','11');
INSERT INTO salt_config VALUES('email','','text','','main','12');
INSERT INTO salt_config VALUES('language','zh_cn','select','','main','13');
INSERT INTO salt_config VALUES('rewrite','0','radio','','main','14');
INSERT INTO salt_config VALUES('sitemap','1','radio','','main','15');
INSERT INTO salt_config VALUES('captcha','1','radio','','main','16');
INSERT INTO salt_config VALUES('guestbook_check_chinese','1','radio','','main','17');
INSERT INTO salt_config VALUES('code','','textarea','','main','18');
INSERT INTO salt_config VALUES('thumb_width','135','text','','display','1');
INSERT INTO salt_config VALUES('thumb_height','135','text','','display','2');
INSERT INTO salt_config VALUES('price_decimal','2','text','','display','3');
INSERT INTO salt_config VALUES('display','a:4:{s:7:\"article\";s:2:\"10\";s:12:\"home_article\";s:1:\"5\";s:7:\"product\";s:2:\"10\";s:12:\"home_product\";s:1:\"4\";}','array','','display','4');
INSERT INTO salt_config VALUES('defined','a:2:{s:7:\"article\";s:0:\"\";s:7:\"product\";s:0:\"\";}','array','','defined','1');
INSERT INTO salt_config VALUES('mail_service','0','radio','','mail','1');
INSERT INTO salt_config VALUES('mail_host','smtp.domain.com','text','','mail','2');
INSERT INTO salt_config VALUES('mail_port','25','text','','mail','3');
INSERT INTO salt_config VALUES('mail_ssl','0','radio','','mail','4');
INSERT INTO salt_config VALUES('mail_username','','text','','mail','5');
INSERT INTO salt_config VALUES('mail_password','','text','','mail','6');
INSERT INTO salt_config VALUES('mobile_name','hy','text','','mobile','1');
INSERT INTO salt_config VALUES('mobile_title','触屏版','text','','mobile','2');
INSERT INTO salt_config VALUES('mobile_keywords','触屏版','text','','mobile','3');
INSERT INTO salt_config VALUES('mobile_description','触屏版','text','','mobile','4');
INSERT INTO salt_config VALUES('mobile_logo','','file','','mobile','5');
INSERT INTO salt_config VALUES('mobile_closed','0','radio','','mobile','6');
INSERT INTO salt_config VALUES('mobile_display','a:4:{s:7:\"article\";i:10;s:12:\"home_article\";i:5;s:7:\"product\";i:10;s:12:\"home_product\";i:4;}','array','','mobile','7');
INSERT INTO salt_config VALUES('site_theme','default','hidden','','','100');
INSERT INTO salt_config VALUES('mobile_theme','default','hidden','','','101');
INSERT INTO salt_config VALUES('build_date','1535790910','hidden','','','102');
INSERT INTO salt_config VALUES('update_number','a:6:{s:6:\"update\";s:1:\"0\";s:5:\"patch\";s:1:\"0\";s:6:\"module\";s:1:\"0\";s:6:\"plugin\";s:1:\"0\";s:5:\"theme\";s:1:\"0\";s:6:\"mobile\";N;}','hidden','','','103');
INSERT INTO salt_config VALUES('update_date','a:2:{s:6:\"system\";a:2:{s:6:\"update\";i:20180831;s:5:\"patch\";i:20180831;}s:6:\"module\";a:2:{s:7:\"article\";i:20180831;s:7:\"product\";i:20180831;}}','hidden','','','104');
INSERT INTO salt_config VALUES('cloud_account','','hidden','','','105');
INSERT INTO salt_config VALUES('hash_code','c0cc55df308e3a12e8b79a9c02665668','hidden','','','106');
INSERT INTO salt_config VALUES('douphp_version','v1.5 Beta3 20180831','hidden','','','107');

DROP TABLE IF EXISTS `salt_file`;
CREATE TABLE `salt_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL DEFAULT '',
  `file` varchar(255) NOT NULL DEFAULT '',
  `module` varchar(20) NOT NULL DEFAULT '',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(20) NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `thumb_size` int(10) unsigned NOT NULL DEFAULT '0',
  `action_time` int(10) unsigned NOT NULL DEFAULT '0',
  `add_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO salt_file VALUES('31','nxa3xsa.file','images/product/21_1536024229874839.png','product','21','main','103372','10212','1536024229','1536024229');
INSERT INTO salt_file VALUES('30','hnqzmz5.file','images/product/20_1536024205978852.jpg','product','20','main','88790','7863','1536024205','1536024205');
INSERT INTO salt_file VALUES('29','27nf1g8.file','images/product/19_1536024185322539.jpg','product','19','main','94046','8478','1536024185','1536024185');
INSERT INTO salt_file VALUES('28','kz1njpi.file','images/product/18_1536024148649106.jpg','product','18','main','166771','11602','1536024148','1536024148');
INSERT INTO salt_file VALUES('26','nqul3nn.file','images/product/16_1536024079765142.jpg','product','16','main','171733','11292','1536024079','1536024079');
INSERT INTO salt_file VALUES('27','ylahzg2.file','images/product/17_1536024124715650.jpg','product','17','main','93341','8436','1536024124','1536024124');
INSERT INTO salt_file VALUES('12','1qzxyh7.file','images/product/12.png','product','12','main','99561','9365','1536023164','1372259573');
INSERT INTO salt_file VALUES('13','hnqjbgu.file','images/product/13.png','product','13','main','115443','9111','1536023133','1372259850');
INSERT INTO salt_file VALUES('14','pml6oh9.file','images/product/14.png','product','14','main','106593','11223','1536023105','1372260271');
INSERT INTO salt_file VALUES('15','enama46.file','images/product/15.png','product','15','main','122493','11925','1536023785','1372260483');
INSERT INTO salt_file VALUES('25','1kvilzd.file','images/product/10_content_1536023395829848.jpg','product','10','content','93341','0','1536023395','1536023395');
INSERT INTO salt_file VALUES('34','fjnwfew.file','data/slide/20180904vxjlbv.jpg','show','12','main','88790','0','1536024348','1536024348');
INSERT INTO salt_file VALUES('33','3h49bgm.file','data/slide/20180904oxrqjj.jpg','show','11','main','94046','0','1536024331','1536024331');
INSERT INTO salt_file VALUES('32','3s2eq53.file','data/slide/20180904mcjelc.png','show','10','main','122493','0','1536024308','1536024308');
INSERT INTO salt_file VALUES('20','ods99li.file','data/slide/m/20140921rqmzcp.jpg','show','5','main','89237','6353','1530249928','1530249928');
INSERT INTO salt_file VALUES('21','3bgcgri.file','data/slide/m/20140921kwoypm.jpg','show','6','main','113780','6353','1530249928','1530249928');
INSERT INTO salt_file VALUES('22','i9lo99y.file','data/slide/m/20140921ypmnew.jpg','show','7','main','46264','6353','1530249928','1530249928');
INSERT INTO salt_file VALUES('23','jljwmcv.file','data/slide/m/20140921demloy.jpg','show','8','main','115613','6353','1530249928','1530249928');
INSERT INTO salt_file VALUES('24','mxgkkkf.file','data/slide/20180901uedimh.png','show','9','main','106593','0','1536024319','1535791054');

DROP TABLE IF EXISTS `salt_nav`;
CREATE TABLE `salt_nav` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `guide` varchar(255) NOT NULL DEFAULT '0',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL,
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

INSERT INTO salt_nav VALUES('1','page','公司简介','1','0','middle','10');
INSERT INTO salt_nav VALUES('2','page','企业荣誉','2','1','middle','10');
INSERT INTO salt_nav VALUES('3','page','发展历程','3','1','middle','20');
INSERT INTO salt_nav VALUES('4','page','联系我们','4','1','middle','30');
INSERT INTO salt_nav VALUES('5','product_category','产品中心','0','0','middle','20');
INSERT INTO salt_nav VALUES('6','article_category','文章中心','0','0','middle','30');
INSERT INTO salt_nav VALUES('8','page','人才招聘','5','0','middle','60');
INSERT INTO salt_nav VALUES('9','page','联系我们','4','0','middle','70');
INSERT INTO salt_nav VALUES('10','product_category','电子数码','1','5','middle','10');
INSERT INTO salt_nav VALUES('11','product_category','家居百货','2','5','middle','20');
INSERT INTO salt_nav VALUES('12','product_category','母婴用品','3','5','middle','30');
INSERT INTO salt_nav VALUES('13','article_category','公司动态','1','6','middle','10');
INSERT INTO salt_nav VALUES('14','article_category','行业新闻','2','6','middle','20');
INSERT INTO salt_nav VALUES('15','page','企业荣誉','2','0','middle','50');
INSERT INTO salt_nav VALUES('17','page','公司简介','1','0','bottom','10');
INSERT INTO salt_nav VALUES('18','page','营销网络','6','0','bottom','20');
INSERT INTO salt_nav VALUES('19','page','企业荣誉','2','0','bottom','30');
INSERT INTO salt_nav VALUES('20','page','人才招聘','5','0','bottom','40');
INSERT INTO salt_nav VALUES('21','page','联系我们','4','0','bottom','50');
INSERT INTO salt_nav VALUES('22','product_category','智能手机','4','10','middle','1');
INSERT INTO salt_nav VALUES('23','product_category','平板电脑','5','10','middle','2');
INSERT INTO salt_nav VALUES('25','page','公司简介','1','0','mobile','10');
INSERT INTO salt_nav VALUES('26','product_category','产品中心','0','0','mobile','20');
INSERT INTO salt_nav VALUES('27','article_category','文章中心','0','0','mobile','30');
INSERT INTO salt_nav VALUES('28','page','企业荣誉','2','0','mobile','40');
INSERT INTO salt_nav VALUES('29','page','营销网络','6','0','mobile','50');
INSERT INTO salt_nav VALUES('30','page','人才招聘','5','0','mobile','60');
INSERT INTO salt_nav VALUES('31','page','联系我们','4','0','mobile','255');
INSERT INTO salt_nav VALUES('33','mobile','手机版','0','0','top','10');
INSERT INTO salt_nav VALUES('34','mobile','手机版','0','0','bottom','60');

DROP TABLE IF EXISTS `salt_page`;
CREATE TABLE `salt_page` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `page_name` varchar(150) NOT NULL DEFAULT '',
  `content` longtext NOT NULL,
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO salt_page VALUES('1','about','0','公司简介','<p><span style=\"color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; widows: 1; font-size: 18px;\">时光飞逝，转眼间我们送走了硕果累累的2017，迎来了充满希望、充满期待的2018，在这激动人心的时刻，洪亿盐业向多年来一直支持洪亿成长的朋友们，向一直拼在一线，长年为洪亿盐业奋斗的洪亿人，致以崇高的谢意，祝福您和家人新年快乐。<br />&nbsp; &nbsp; 2017年是丰收的一年；2017年也是成长的一年。这一年，洪亿盐业不断创新，为了能够生产出更加适应市场的产品，洪亿新增了脱水机；为了能够提升出货速度，洪亿引进了自动机改善了原始人工装卸造成的诸多问题；为了更加迎合市场的需求，洪亿完全根据客户朋友的需要，走以需订单的模式深受朋友们的认可和支持；正因为如此，洪亿盐业的业务量更是得到了突飞猛进地发展，在这里，洪亿人深表谢意。<br /></span><span style=\"color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; widows: 1; font-size: 24px;\"><span style=\"font-size: small;\">&nbsp; &nbsp;<span class=\"Apple-converted-space\">&nbsp;</span><span style=\"font-size: large;\">洪亿人关注着国家的命运，更关注着自己的命运。随着盐业政策的改革推进，盐业市场的蓝图是宏伟的，洪亿人从事的事业是伟大的。正因为这样，洪亿盐业明确了自己的核心价值观：爱国、敬业、诚信、和谐、谦逊、奋进，洪亿人正团结一心，众志成诚为此奋斗。</span></span></span></p>','公司简介','时光飞逝，转眼间我们送走了硕果累累的2017，迎来了充满希望、充满期待的2018，在这激动人心的时刻，洪亿盐业向多年来一直支持洪亿成长的朋友们，向一直拼在一线，长年为洪亿盐业奋斗的洪亿人，致以崇高的谢意，祝福您和家人新年快乐。\r\n    2017年是丰收的一年；2017年也是成长的一年。这一年，洪亿盐业不断创新，为了能够生产出更加适应市场的产品，洪亿新增了脱水机；为了能够提升出货速度，洪亿引进了自动机改善了原始人工装卸造成的诸多问题；为了更加迎合市场的需求，洪亿完全根据客户朋友的需要，走以需订单的模式深受');
INSERT INTO salt_page VALUES('2','honor','1','企业荣誉','企业荣誉','企业荣誉','企业荣誉');
INSERT INTO salt_page VALUES('3','history','1','发展历程','发展历程','发展历程','发展历程');
INSERT INTO salt_page VALUES('4','contact','1','联系我们','<p style=\"margin: 0px; color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; line-height: 25.2px; widows: 1;\">咨询电话：18841715669</p>\r\n<p style=\"margin: 0px; color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; line-height: 25.2px; widows: 1;\">咨询微信：</p>\r\n<p style=\"margin: 0px; color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; line-height: 25.2px; widows: 1;\">地　　址：辽宁省营口市老边区村委会一楼西侧</p>\r\n<p style=\"margin: 0px; color: #666666; font-family: 微软雅黑; font-variant-numeric: normal; font-variant-east-asian: normal; line-height: 25.2px; widows: 1;\">邮　　编：000000</p>','联系我们','联系我们');
INSERT INTO salt_page VALUES('5','job','0','人才招聘','人才招聘','人才招聘','人才招聘');
INSERT INTO salt_page VALUES('6','market','0','营销网络','营销网络','营销网络','营销网络');

DROP TABLE IF EXISTS `salt_product`;
CREATE TABLE `salt_product` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `cat_id` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(150) NOT NULL DEFAULT '',
  `price` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `add_time` varchar(50) DEFAULT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

INSERT INTO salt_product VALUES('16','2','加工盐','0.00','','','nqul3nn.file','','','1536024079','0');
INSERT INTO salt_product VALUES('17','3','加碘日晒盐','0.00','','','ylahzg2.file','','','1536024124','0');
INSERT INTO salt_product VALUES('18','4','盐颗粒','0.00','','','kz1njpi.file','','','1536024148','0');
INSERT INTO salt_product VALUES('19','5','样品','0.00','','','27nf1g8.file','','','1536024185','0');
INSERT INTO salt_product VALUES('20','4','日晒盐','0.00','','','hnqzmz5.file','','','1536024205','0');
INSERT INTO salt_product VALUES('21','4','水洗盐','0.00','','','nxa3xsa.file','','','1536024229','0');
INSERT INTO salt_product VALUES('12','3','日晒盐','0.00','','<p>帮宝适，美国宝洁公司著名婴儿卫生系列产品。是一种吸水性能良好、佩戴舒适的一次性纸尿裤诞生了。宝洁公司将它命名为&ldquo;帮宝适&rdquo;，并于1961年正式推向市场，迎接它的是无数欣喜若狂的妈妈和她们的宝宝。 在以后的三十八年中，&ldquo;帮宝适&rdquo;经由宝洁公司的多次改进，成为行销全球一百多个国家的世界第一婴儿纸尿裤品牌。1997年自帮宝适在中国面世以来，在目标消费者中的知名度已达到99%，成为市场上首屈一指的领导品牌。</p>','1qzxyh7.file','','','1372259573','0');
INSERT INTO salt_product VALUES('13','3','氯化钠','0.00','','','hnqjbgu.file','','','1372259850','2');
INSERT INTO salt_product VALUES('14','3','粉洗盐','0.00','','','pml6oh9.file','','','1372260271','0');
INSERT INTO salt_product VALUES('15','1','粉碎盐','0.00','','','enama46.file','','','1372260483','1');

DROP TABLE IF EXISTS `salt_product_category`;
CREATE TABLE `salt_product_category` (
  `cat_id` smallint(5) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(30) NOT NULL DEFAULT '',
  `cat_name` varchar(255) NOT NULL DEFAULT '',
  `keywords` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `parent_id` smallint(5) NOT NULL DEFAULT '0',
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO salt_product_category VALUES('1','salt','盐类','','','0','10');
INSERT INTO salt_product_category VALUES('2','salt1','盐类','','','1','20');
INSERT INTO salt_product_category VALUES('3','salt3','盐类','','','1','30');
INSERT INTO salt_product_category VALUES('4','1','盐类','','','1','50');
INSERT INTO salt_product_category VALUES('5','salt4','盐类','','','1','50');

DROP TABLE IF EXISTS `salt_show`;
CREATE TABLE `salt_show` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `show_name` varchar(60) NOT NULL DEFAULT '',
  `show_link` varchar(255) NOT NULL DEFAULT '',
  `show_img` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO salt_show VALUES('12','8','','fjnwfew.file','pc','50');
INSERT INTO salt_show VALUES('11','7','','3h49bgm.file','pc','50');
INSERT INTO salt_show VALUES('10','6','','3s2eq53.file','pc','50');
INSERT INTO salt_show VALUES('5','手机版广告图片01','http://m.douco.com','ods99li.file','mobile','10');
INSERT INTO salt_show VALUES('6','手机版广告图片02','http://m.douco.com','3bgcgri.file','mobile','20');
INSERT INTO salt_show VALUES('7','手机版广告图片03','http://m.douco.com','i9lo99y.file','mobile','30');
INSERT INTO salt_show VALUES('8','手机版广告图片04','http://m.douco.com','jljwmcv.file','mobile','40');
INSERT INTO salt_show VALUES('9','5','','mxgkkkf.file','pc','50');

