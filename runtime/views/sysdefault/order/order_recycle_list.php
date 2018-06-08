<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>后台管理</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/admin.js";?>"></script>
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
</head>
<body>
	<div class="container">
		<div id="header">
			<div class="logo">
				<a href="<?php echo IUrl::creatUrl("/system/default");?>"><img src="<?php echo $this->getWebSkinPath()."images/admin/logo.png";?>" width="303" height="43" /></a>
			</div>
			<div id="menu">
				<ul name="topMenu">
					<?php $menuData=menu::init($this->admin['role_id']);?>
					<?php foreach($items=menu::getTopMenu($menuData) as $key => $item){?>
					<li>
						<a hidefocus="true" href="<?php echo IUrl::creatUrl("".$item."");?>"><?php echo isset($key)?$key:"";?></a>
					</li>
					<?php }?>
				</ul>
			</div>
			<p><a href="<?php echo IUrl::creatUrl("/systemadmin/logout");?>">退出管理</a> <a href="<?php echo IUrl::creatUrl("/system/admin_repwd");?>">修改密码</a> <a href="<?php echo IUrl::creatUrl("/system/default");?>">后台首页</a> <a href="<?php echo IUrl::creatUrl("");?>" target='_blank'>商城首页</a> <span>您好 <label class='bold'><?php echo isset($this->admin['admin_name'])?$this->admin['admin_name']:"";?></label>，当前身份 <label class='bold'><?php echo isset($this->admin['admin_role_name'])?$this->admin['admin_role_name']:"";?></label></span></p>
		</div>
		<div id="info_bar">
			<label class="navindex"><a href="<?php echo IUrl::creatUrl("/system/navigation");?>">快速导航管理</a></label>
			<span class="nav_sec">
			<?php $query = new IQuery("quick_naviga");$query->where = "admin_id = {$this->admin['admin_id']} and is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
			<a href="<?php echo isset($item['url'])?$item['url']:"";?>" class="selected"><?php echo isset($item['naviga_name'])?$item['naviga_name']:"";?></a>
			<?php }?>
			</span>
		</div>

		<div id="admin_left">
			<ul class="submenu">
				<?php $leftMenu=menu::get($menuData,IWeb::$app->getController()->getId().'/'.IWeb::$app->getController()->getAction()->getId())?>
				<?php foreach($items=current($leftMenu) as $key => $item){?>
				<li>
					<span><?php echo isset($key)?$key:"";?></span>
					<ul name="leftMenu">
						<?php foreach($items=$item as $leftKey => $leftValue){?>
						<li><a href="javascript:void(0);" onclick="<?php if(stripos($leftKey,'/') === 0){?>window.location.href='<?php echo IUrl::creatUrl("".$leftKey."");?>'<?php }else{?><?php echo isset($leftKey)?$leftKey:"";?><?php }?>"><?php echo isset($leftValue)?$leftValue:"";?></a></li>
						<?php }?>
					</ul>
				</li>
				<?php }?>
			</ul>
			<div id="copyright"></div>
		</div>

		<div id="admin_right">
			<div class="headbar">
	<div class="position">订单<span>></span><span>订单管理</span><span>></span><span>订单回收站</span></div>
	<div class="operating">
		<a href="javascript:;"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/order/order_list");?>'"><span class="import">返回列表</span></button></a>
		<a href="javascript:void(0)" onclick="selectAll('id[]')"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="recycle_del()"><button class="operating_btn" type="button"><span class="delete">彻底删除</span></button></a>
		<a href="javascript:void(0)" onclick="recycle_restore()"><button class="operating_btn"><span class="recover">还原</span></button></a>
	</div>
</div>
<form name="orderForm" action="" method="post">
<div class="content">
	<table class="list_table">
		<colgroup>
			<col width="30px" />
			<col width="160px" />
			<col width="70px" />
			<col width="75px" />
			<col width="75px" />
			<col width="75px" />
			<col width="85px" />
			<col width="70px" />
			<col width="115px" />
			<col width="90px" />
		</colgroup>

		<thead>
			<tr>
				<th>选择</th>
				<th>订单号</th>
				<th>收货人</th>
				<th>支付状态</th>
				<th>发货状态</th>
				<th>配送方式</th>
				<th>支付方式</th>
				<th>用户名</th>
				<th>下单时间</th>
				<th>操作</th>
			</tr>
		</thead>

		<tbody>
			<?php $page= (isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
			<?php $query = new IQuery("order as o");$query->join = "left join delivery as d on o.distribution = d.id left join payment as p on o.pay_type = p.id left join user as u on u.id = o.user_id";$query->fields = "o.id as oid,d.name as dname,p.name as pname,o.order_no,o.accept_name,o.pay_status,o.distribution_status,u.username,o.create_time,o.status";$query->where = "if_del = 1";$query->page = "$page";$items = $query->find(); foreach($items as $key => $item){?>
			<tr>
				<td><input name="id[]" type="checkbox" value="<?php echo isset($item['oid'])?$item['oid']:"";?>" /></td>
				<td><?php echo isset($item['order_no'])?$item['order_no']:"";?></td>
				<td><?php echo isset($item['accept_name'])?$item['accept_name']:"";?></td>
				<td><?php echo Order_Class::getOrderPayStatusText($item);?></td>
				<td><?php echo Order_Class::getOrderDistributionStatusText($item);?></td>
				<td><?php echo isset($item['dname'])?$item['dname']:"";?></td>
				<td><?php echo isset($item['pname'])?$item['pname']:"";?></td>
				<td><?php echo $item['username']=='' ? '游客' : $item['username'];?></td>
				<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
				<td>
					<?php if($item['status']<3){?>
					<a href="<?php echo IUrl::creatUrl("/order/order_edit/id/".$item['oid']."");?>"><img class="operator" src="<?php echo $this->getWebSkinPath()."images/admin/icon_edit.gif";?>" title="编辑"/></a>
					<?php }?>
					<a href="javascript:void(0)" onclick="delModel({link:'<?php echo IUrl::creatUrl("/order/order_recycle_del/id/".$item['oid']."");?>'})"><img class="operator" src="<?php echo $this->getWebSkinPath()."images/admin/icon_del.gif";?>" alt="删除" /></a>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php echo $query->getPageBar();?>
</form>

<script type="text/javascript">
	function recycle_restore()
	{
		$("form[name='orderForm']").attr('action','<?php echo IUrl::creatUrl("/order/order_recycle_restore");?>');
		confirm('确定要还原所选中的信息吗？','formSubmit(\'orderForm\')');
	}
	function recycle_del()
	{
		$("form[name='orderForm']").attr('action','<?php echo IUrl::creatUrl("/order/order_recycle_del");?>');
		confirm('确定要彻底删除所选中的信息吗？','formSubmit(\'orderForm\')');
	}
</script>

		</div>
	</div>

	<script type='text/javascript'>
	//隔行换色
	$(".list_table tr:nth-child(even)").addClass('even');
	$(".list_table tr").hover(
		function () {
			$(this).addClass("sel");
		},
		function () {
			$(this).removeClass("sel");
		}
	);

	//按钮高亮
	var topItem  = "<?php echo key($leftMenu);?>";
	$("ul[name='topMenu']>li:contains('"+topItem+"')").addClass("selected");

	var leftItem = "<?php echo IUrl::getUri();?>";
	$("ul[name='leftMenu']>li a[href^='"+leftItem+"']").parent().addClass("selected");
	</script>
</body>
</html>
