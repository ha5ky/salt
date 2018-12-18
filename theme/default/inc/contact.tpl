<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	body, html,#allmap {width: 100%;height: 100%;overflow: hidden;margin:0;font-family:"微软雅黑";}
</style>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=dfxUkuCR1p5MSaKle2ifE4Dj7PShEQLv"></script>
<div class="contact">
 <h2>{$lang.contact}</h2>
 <ul>
  <li>{$lang.contact_tel}：{$site.tel}</li>
  <li>{$lang.contact_fax}：{$site.fax}</li>
  <li>{$lang.contact_email}：{$site.email}</li>
 </ul>
 <div id="allmap"></div>
</div>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");    // 创建Map实例
	map.centerAndZoom(new BMap.Point(116.404, 39.915), 11);  // 初始化地图,设置中心点坐标和地图级别
	//添加地图类型控件
	map.addControl(new BMap.MapTypeControl({
		mapTypes:[
            BMAP_NORMAL_MAP,
            BMAP_HYBRID_MAP
        ]}));	  
	map.setCurrentCity("北京");          // 设置地图显示的城市 此项是必须设置的
	map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
</script>
