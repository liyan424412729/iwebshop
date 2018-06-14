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

<body style="width:700px;height:320px;overflow-y:hidden;">
	<div class="pop_win">
		<ul class="red_box">
			<li>1、如果未设置任何商品分类，则表示保持商品原有分类不变</li>
		</ul>
		<form action='<?php echo IUrl::creatUrl("/goods/goods_setting_save");?>' method='post'>
			<input type="hidden" name="goods_id" value="<?php echo isset($goods_id)?$goods_id:"";?>" />
			<input type="hidden" name="seller_id" value="<?php echo isset($seller_id)?$seller_id:"";?>" />
			<table class="form_table" width="90%" cellspacing="0" cellpadding="0" border="0">
				<colgroup>
					<col width="130px" />
					<col />
				</colgroup>

				<tbody>
					<tr>
						<td>商品分类：</td>
						<td>
							<div id="__categoryBox" style="margin-bottom:8px"></div>
							<button class="btn" type="button" name="_goodsCategoryButton"><span class="add">设置分类</span></button>
							<?php plugin::trigger('goodsCategoryWidget',array("type" => "checkbox","name" => "category[]"))?>
						</td>
					</tr>
                    <?php if(!$seller_id){?>
					<tr>
						<td>所属商户：</td>
						<td>
							<select class="auto" name="sellerid">
								<option value="-1" selected="selected">保持不变 </option>
                                <option value="0">商城平台自营 </option>
								<?php $query = new IQuery("seller");$query->where = "is_del = 0";$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['true_name'])?$item['true_name']:"";?>-<?php echo isset($item['seller_name'])?$item['seller_name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
                    <?php }?>
                    <tr>
						<td>市场价格：</td>
						<td>
                            <input type="radio" value="1" name="market_price_type" id="market_price_type_1" checked="checked" /><label for="market_price_type_1">增加</label>
                            <input type="radio" value="2" name="market_price_type" id="market_price_type_2" /><label for="market_price_type_2">减少</label>
                            <input type="text" class="tiny" name="market_price" pattern="float" empty value="" />
							<label>市场价格增加N元或减少N元</label>
						</td>
					</tr>
					<tr>
						<td>销售价格：</td>
						<td>
                            <input type="radio" value="1" name="sell_price_type" id="sell_price_type_1" checked="checked" /><label for="sell_price_type_1">增加</label>
                            <input type="radio" value="2" name="sell_price_type" id="sell_price_type_2" /><label for="sell_price_type_2">减少</label>
                            <input type="text" class="tiny" name="sell_price" pattern="float" value="" empty />
							<label>销售价格增加N元或减少N元</label>
						</td>
					</tr>
					<tr>
						<td>成本价格：</td>
						<td>
                            <input type="radio" value="1" name="cost_price_type" id="cost_price_type_1" checked="checked" /><label for="cost_price_type_1">增加</label>
                            <input type="radio" value="2" name="cost_price_type" id="cost_price_type_2" /><label for="cost_price_type_2">减少</label>
                            <input type="text" class="tiny" name="cost_price" pattern="float" value="" empty />
							<label>成本价格增加N元或减少N元</label>
						</td>
					</tr>
					<tr>
						<td>库存：</td>
						<td>
                            <input type="radio" value="1" name="store_nums_type" checked="checked" id="store_nums_type_1" /><label for="store_nums_type_1">增加</label>
                            <input type="radio" value="2" name="store_nums_type" id="store_nums_type_2" /><label for="store_nums_type_2">减少</label>
                            <input type="text" class="tiny" name="store_nums" pattern="int" value="" empty />
							<label>库存增加N或减少N</label>
						</td>
					</tr>
					<?php if($seller_id == 0){?>
					<tr>
						<td>积分：</td>
						<td>
                            <input type="radio" value="1" name="point_type" id="point_type_1" checked="checked" /><label for="point_type_1">增加</label>
                            <input type="radio" value="2" name="point_type" id="point_type_2" /><label for="point_type_2">减少</label>
                            <input type="text" class="tiny" name="point" pattern="int" value="" empty />
							<label>积分增加N或减少N</label>
						</td>
					</tr>
					<tr>
						<td>经验：</td>
						<td>
                            <input type="radio" value="1" name="exp_type" id="exp_type_1" checked="checked" /><label for="exp_type_1">增加</label>
                            <input type="radio" value="2" name="exp_type" id="exp_type_2" /><label for="exp_type_2">减少</label>
                            <input type="text" class="tiny" name="exp" pattern="int" value="" empty />
							<label>经验增加N或减少N</label>
						</td>
					</tr>
					<?php }?>
					<tr>
						<td>商品品牌：</td>
						<td>
							<select class="auto" name="brand_id">
                                <option value="-1" selected="selected">保持不变 </option>
								<?php $query = new IQuery("brand");$items = $query->find(); foreach($items as $key => $item){?>
								<option value="<?php echo isset($item['id'])?$item['id']:"";?>"><?php echo isset($item['name'])?$item['name']:"";?></option>
								<?php }?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</body>
</html>