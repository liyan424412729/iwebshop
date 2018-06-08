<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."css/admin.css";?>" />
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<script type='text/javascript' src="<?php echo $this->getWebViewPath()."javascript/admin.js";?>"></script>
</head>
<body style="width:700px;min-height:340px;overflow-y:hidden;">
<div class="pop_win">
<form action="<?php echo IUrl::creatUrl("/message/start_marketing_sms");?>" method="post">
	<input type='hidden' name='toUser' value='' />
	<table class="form_table">
		<col width="75px" />
		<col />
		<tbody>
			<tr>
				<td class="t_r">收信人：</td>
				<td>
					<button onclick='searchUser();' class="btn" type="button"><span>筛选条件</span></button>
					<label id='queryString'>默认为所有用户</label>
				</td>
			</tr>
			<tr>
				<td valign="top" class="t_r">短信内容：</td>
				<td><textarea class="normal" name="content" style="width:580px; min-height:270px;" empty pattern="required"></textarea><label>&nbsp;</label></td>
			</tr>
		</tbody>
	</table>
</form>
</div>
<script type='text/javascript'>

//筛选用户
function searchUser()
{
	art.dialog.open('<?php echo IUrl::creatUrl("/member/search_user");?>',{
		'id':'userCondition',
		'title':'选择用户',
		'ok':function(iframeWin, topWin)
		{
			var iframeObj = $(iframeWin.document);
	    	iframeObj.find('form').submit();
	    	return false;
		}
	});
}
</script>
</body>
</html>