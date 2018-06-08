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
			<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/my97date/wdatepicker.js"></script>
<div class="headbar">
	<div class="position"><span>统计</span><span>></span><span>商户数据统计</span><span>></span><span>货款结算列表</span></div>
	<div class="operating">
		<div class="search f_l">
			<form name="searchBill" action="<?php echo IUrl::creatUrl("/");?>" method="get">
				<input type='hidden' name='controller' value='market' />
				<input type='hidden' name='action' value='bill_list' />

				<span>
					申请时间
					<input type="text" name='search[apply_time>=]' value='' class="Wdate" pattern='date' onFocus="WdatePicker()" empty title='选择起始时间' /> 到
					<input type="text" name='search[apply_time<=]' value='' class="Wdate" pattern='date' onFocus="WdatePicker()" empty title='选择终止时间' />
				</span>

				<select class="auto" name="search[is_pay=]">
					<option value="" selected="selected">结算状态</option>
					<option value="0">未结算</option>
					<option value="1">已结算</option>
				</select>

				<button class="btn" type="button" onclick="submitForm('bill_list');"><span class="sch">搜 索</span></button>
				<button class="btn" type="button" onclick="submitForm('sellerReport');"><span class="add">报表CSV</span></button>
			</form>
		</div>
	</div>
</div>

<div class="content">
	<table class="list_table">
		<colgroup>
			<col width="180px" />
			<col width="100px" />
			<col width="155px" />
			<col width="80px" />
			<col width="155px" />
			<col width="155px" />
			<col width="100px" />
		</colgroup>

		<thead>
			<tr>
				<th>订单的结算起止</th>
				<th>申请商户</th>
				<th>申请时间</th>
				<th>结算状态</th>
				<th>结算时间</th>
				<th>管理员回复</th>
				<th>操作</th>
			</tr>
		</thead>

		<tbody>
			<?php $where = util::search(IReq::get('search'));?>
			<?php $page= (isset($_GET['page'])&&(intval($_GET['page'])>0))?intval($_GET['page']):1;?>
			<?php $query = new IQuery("bill as b");$query->join = "left join seller as s on s.id = b.seller_id left join admin as a on b.admin_id = a.id";$query->where = "$where";$query->page = "$page";$query->fields = "b.*,s.seller_name,a.admin_name";$items = $query->find(); foreach($items as $key => $item){?>
			<tr>
				<td><?php echo isset($item['start_time'])?$item['start_time']:"";?> ~ <?php echo isset($item['end_time'])?$item['end_time']:"";?></td>
				<td><?php echo isset($item['seller_name'])?$item['seller_name']:"";?></td>
				<td><?php echo isset($item['apply_time'])?$item['apply_time']:"";?></td>
				<td>
					<?php if($item['is_pay'] == 1){?>
					<label class="green">已结算</label>
					<?php }else{?>
					<label class="orange">未结算</label>
					<?php }?>
				</td>
				<td><?php echo isset($item['pay_time'])?$item['pay_time']:"";?></td>
				<td>
					<?php if($item['pay_content']){?>
						<?php echo isset($item['admin_name'])?$item['admin_name']:"";?>：<?php echo isset($item['pay_content'])?$item['pay_content']:"";?>
					<?php }?>
				</td>
				<td>
					<a href="<?php echo IUrl::creatUrl("/market/bill_edit/id/".$item['id']."");?>">
						<img class="operator" title="回复" alt="回复" src="<?php echo $this->getWebSkinPath()."images/admin/icon_check.gif";?>" />
					</a>

					<?php if($item['is_pay'] == 0){?>
					<a href="javascript:delModel({link:'<?php echo IUrl::creatUrl("/market/bill_del/id/".$item['id']."");?>'})">
						<img class="operator" src="<?php echo $this->getWebSkinPath()."images/admin/icon_del.gif";?>" title="删除" />
					</a>
					<?php }?>
				</td>
			</tr>
			<?php }?>
		</tbody>
	</table>
</div>
<?php echo $query->getPageBar();?>

<script type="text/javascript">
//表单回填
var searchData = <?php echo JSON::encode(IReq::get('search'));?>;
for(var index in searchData)
{
	$('[name="search['+index+']"]').val(searchData[index]);
}

//修改表单提交内容
function submitForm(action)
{
	$('[name="action"]').val(action);
	formSubmit("searchBill");
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
