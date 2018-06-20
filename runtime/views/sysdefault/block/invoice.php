<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>修改收货地址</title>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
	<script type='text/javascript' src="<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.valid-msg,.invalid-msg,.form-group label{display:none;line-height:0px}
		.__tax * {padding: 0;margin: 0;list-style: none;}
		.__tax .__tax_alert li {position: relative;margin: 20px 0;height: 40px;}
		.__tax .__tax_alert li span {
			position: absolute;height: 10px;line-height: 10px;background: #fff;top: -7px;padding: 0 10px;left: 5px;
			color: #999;font-size: 12px;z-index: 1;
		}
		.__tax .__tax_alert li .__text,.__tax .__tax_alert li select {
			display: block;width: 100%;height: 16px;line-height: 16px;border-radius: 0;padding: 10px 0;border: none;
			background: #fff;text-indent: 10px;outline: 1px solid #ddd;
		}
		.__tax .__tax_alert li select {
			float: left;height: 36px;line-height: 36px;margin: 0 0 0 5%;padding: 0;
		}
		.__tax .__tax_alert li select:nth-of-type(1){margin-left: 0 !important;}
	</style>
</head>

<body class="__tax">
	<form action="<?php echo IUrl::creatUrl("/block/invoice_add");?>" method="post" name="invoiceForm" class="form-horizontal">
	<input type="hidden" name="id" />
	<section class="__tax_alert">
		<ul>
			<li>
				<span>单位名称</span>
				<input class="__text" type="text" name="company_name" pattern="required" alt="名称不能为空" />
			</li>
			<li>
				<span>纳税人识别码</span>
				<input class="__text" type="text" name="taxcode" pattern="required" alt="识别码不能为空" />
			</li>
			<li>
				<span>注册地址</span>
				<input class="__text" name='address' type="text" />
			</li>
			<li>
				<span>注册电话</span>
				<input class="__text" type="text" pattern='phone' name='telphone' empty alt='格式不正确' />
			</li>
			<li>
				<span>开户银行</span>
				<input class="__text" name='bankname' type="text" />
			</li>
			<li>
				<span>银行账户</span>
				<input class="__text" name='bankno' type="text" />
			</li>
			<li>
				<span>发票类型</span>
				<select name="type" pattern="required">
					<option value="1">普通发票</option>
					<option value="2">增值税专用发票</option>
				</select>
			</li>
		</ul>
	</section>

</body>
<script type='text/javascript'>
jQuery(function()
{
	<?php if($this->invoiceRow){?>
		var formObj = new Form('invoiceForm');
		formObj.init(<?php echo JSON::encode($this->invoiceRow);?>);
	<?php }?>
})
</script>
</html>
