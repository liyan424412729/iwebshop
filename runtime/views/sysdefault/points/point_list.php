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
	<div class="position"><span>积分</span><span>></span><span>积分管理</span><span>></span><span>积分列表</span></div>
	<div class="operating">
		<a href="javascript:;"><button class="operating_btn" type="button" onclick="window.location='<?php echo IUrl::creatUrl("/points/point_add");?>'"><span class="addition">添加积分</span></button></a>
		<!-- <a href="javascript:;"><button class="operating_btn" type="button" title="批量设置" alt="批量设置" name="_goodsCategoryButton"><span class="remove">批量设置</span></button></a> -->
		<?php plugin::trigger('goodsCategoryWidget',array("name" => "parent_id","callback" => "setCat"))?>
	</div>
</div>

<form action="<?php echo IUrl::creatUrl("/goods/category_sort");?>" method="post" name="category_list">
<div class="content">
	<table id="list_table" class="list_table">
		<colgroup>
			<col width="120px" />
			<col width="120px" />
			<col width="150px" />
			<col width="150px" />
			<col width="120px" />
			<col width="120px" />
			<col width="120px" />
		</colgroup>

		<thead>
			<tr>
				<th>期数</th>
				<th>目标积分</th>
				<th>开始时间</th>
				<th>结束时间</th>
				<th>状态</th>
				<th>是否完成</th>
				<th>操作</th>
			</tr>
		</thead>
		<?php foreach($items=$this->pointHandle->find() as $key => $item){?>
				<tr>
					<!-- <td><input name="id[]" type="checkbox" value="<?php echo isset($item['sum_id'])?$item['sum_id']:"";?>" /></td> -->
					<td><?php echo isset($item['sum_num'])?$item['sum_num']:"";?></td>
					<td><?php echo isset($item['sum_point'])?$item['sum_point']:"";?></td>
					<td><?php echo isset($item['start_time'])?$item['start_time']:"";?></td>
					<td>
						<?php if($item['end_time'] == '0000-00-00 00:00:00'){?>
						未结束
						<?php }else{?>
						<?php echo isset($item['end_time'])?$item['end_time']:"";?>
						<?php }?>
					</td>
					<td>
						<?php if($item['sum_status'] == 0){?>
						未开始
						<?php }elseif($item['sum_status'] == 1){?>
						正在进行中
						<?php }else{$tiem['sum_status'] == 2?>
						已结束
						<?php }?>
					</td>
					<td>已完成</td>
					<td>
						<a href="">【查看】</a>&nbsp;||&nbsp;
						<a href="">【删除】</a>
					</td>
				</tr>
		<?php }?>
	</table>
</div>
</form>

<script language="javascript">
//折叠展示
function displayData(_self)
{
	if(_self.alt == "关闭")
	{
		jqshow($(_self).parent().parent().attr('id'), 'hide');
		$(_self).attr("src", "<?php echo $this->getWebSkinPath()."images/admin/open.gif";?>");
		_self.alt = '打开';
	}
	else
	{
		jqshow($(_self).parent().parent().attr('id'), 'show');
		$(_self).attr("src", "<?php echo $this->getWebSkinPath()."images/admin/close.gif";?>");
		_self.alt = '关闭';
	}
}

function jqshow(id,isshow) {
	var obj = $("#list_table tr[parent='"+id+"']");
	if (obj.length>0)
	{
		obj.each(function(i) {
			jqshow($(this).attr('id'), isshow);
		});
		if (isshow=='hide')
		{
			obj.hide();
		}
		else
		{
			obj.show();
		}
	}
}
//排序
function toSort(id)
{
	if(id!='')
	{
		var va = $('#s'+id).val();
		var part = /^\d+$/i;
		if(va!='' && va!=undefined && part.test(va))
		{
			$.get("<?php echo IUrl::creatUrl("/goods/category_sort");?>",{'id':id,'sort':va}, function(data)
			{
				if(data=='1')
				{
					tips('修改成功');
				}
			});
		}
	}
}
//设置分类
function setCat(catData)
{
	var parent_id = catData[0]['id'];
	var cat_id    = [];
	$('[name="cat_id[]"]:checked').each(function(i){
		cat_id.push($(this).val());
	});

	if(cat_id && cat_id.length == 0)
	{
		alert("请选择分类");
		return;
	}

	$.getJSON("<?php echo IUrl::creatUrl("/goods/categoryAjax");?>",{"id":cat_id,"parent_id":parent_id},function(json)
	{
		if(json.result == 'success')
		{
			window.location.reload();
		}
		else
		{
			alert('更新失败，当前分类不能设置到其子分类下');
		}
	});
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
