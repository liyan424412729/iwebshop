<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
<?php $type = IReq::get('type') == 'checkbox' ? 'checkbox' : 'radio'?>
<?php $dev = IClient::getDevice()?>
<?php $id = IFilter::act(IReq::get('id'))?>
<style>
.__cate {font-size: 12px;overflow-x: hidden;<?php if($dev=='pc'){?>width:516px; height:400px<?php }?>}
.__cate,.__cate * {padding: 0;margin: 0;list-style: none;}
.__cate .__cate_box {padding: 8px;overflow-y: scroll;}
.__cate .__cate_box h3 {height: 28px;line-height: 28px;text-indent: 15px;background: #F0AD4E;color: #fff;border: 1px solid #EEA236;border-radius: 5px;}
.__cate .__cate_box ul {overflow: hidden;}
.__cate .__cate_box ul.select {width: 150px;float: left;margin-right: 10px;}
.__cate .__cate_box ul:before {
	display: block;height: 32px;line-height: 32px;content: "顶级分类";text-align: center;
	border: 1px solid #357EBD;background: #428BCA;color: #fff;margin-top: 10px;border-radius: 5px;
}
.__cate .__cate_box ul + ul:before {content: "二级分类"}
.__cate .__cate_box ul + ul + ul.select {margin-right: 0;}
.__cate .__cate_box ul + ul + ul:before {content: "三级分类"}
.__cate .__cate_box ul + ul + ul + ul:before {content: "四级分类"}
.__cate .__cate_box ul + ul + ul + ul + ul:before {content: "五级分类"}
.__cate .__cate_box ul + ul + ul + ul + ul + ul:before {content: "六级分类"}
.__cate .__cate_box ul li {margin-top: 5px;}
.__cate .__cate_box ul li label {}
.__cate .__cate_box ul li label input {display: none;}
.__cate .__cate_box ul li label span {
	display: block;height: 28px;line-height: 28px;text-align: center;border: 1px solid #ddd;
	border-radius: 5px;
}
.__cate .__cate_box ul li label span:hover {
	background: #f0f0f0;cursor: pointer;
}
.__cate .__cate_box ul li label input:checked + span {color: #fff;border-color: #4CAE4C;background: #5CB85C;}
</style>
</head>
<body class="__cate">
	<div class="__cate_box">
		<h3>所属分类：</h3>
		<div id="categoryBox"></div>
		<!--分类列表-->
		<script id="categoryListTemplate" type="text/html">
		<ul <?php if($dev=='pc'){?> class="select"<?php }?> name="catRow">
			<%for(var item in templateData){%>
			<%item = templateData[item]%>
			<li onmouseover="showCategory(<%=item['id']%>,<%=level%>);"><label><input name="categoryVal" type="<?php echo isset($type)?$type:"";?>" value="<%=item['id']%>" onchange="selectCategory(this);" <%if( jQuery().inArray(item['id'],checkedCategory) != -1 ){%>checked="checked"<%}%> /> <span><%=item['name']%></span></label></li>
			<%}%>
		</ul>
		</script>
	</div>
</body>

<script type="text/javascript">
//分类层次数据结构
categoryParentData = art.dialog.data('<?php echo isset($id)?$id:"";?>categoryParentData');

//初始化被选中的分类ID
checkedCategory = art.dialog.data('<?php echo isset($id)?$id:"";?>categoryValue') ? art.dialog.data('<?php echo isset($id)?$id:"";?>categoryValue') : [];

$(function()
{
	//生成顶级分类信息
	var templateHtml = template.render('categoryListTemplate',{'templateData':categoryParentData[0],'level':0,'checkedCategory':checkedCategory});
	$('#categoryBox').append(templateHtml);
})

//显示分类数据信息
function showCategory(categoryId,level)
{
	$('[name="catRow"]:gt('+level+')').remove();
	var childCategory = categoryParentData[categoryId];
	if(childCategory)
	{
		var templateHtml = template.render('categoryListTemplate',{'templateData':childCategory,'level':level+1,'checkedCategory':checkedCategory});
		$('#categoryBox').append(templateHtml);
	}
}

//选择分类数据
function selectCategory(_self)
{
	var categoryId = $(_self).val();
	var valueIndex  = jQuery.inArray(categoryId,checkedCategory);

	if($(_self).prop('checked'))
	{
		(valueIndex == -1) ? checkedCategory.push(categoryId) : "";
	}
	else
	{
		(valueIndex == -1) ? "" : checkedCategory.splice(valueIndex,1);
	}
	//更新分类数据值
	<?php if($type == 'checkbox'){?>
	art.dialog.data('<?php echo isset($id)?$id:"";?>categoryValue',checkedCategory);
	<?php }else{?>
	var result = checkedCategory.pop();
	art.dialog.data('<?php echo isset($id)?$id:"";?>categoryValue',Array(result));
	<?php }?>
}
</script>
</html>
