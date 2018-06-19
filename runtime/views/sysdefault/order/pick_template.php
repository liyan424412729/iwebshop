<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>单据打印</title>
<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
<link rel="shortcut icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" />
<style media="print" type="text/css">.noprint{display:none}</style>
<style media="screen,print" type="text/css">
body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,textarea,p,blockquote,th,td,button{padding:0;margin:0;font-size:100%;}
body{font-size:14px;text-align:center}
table{border-collapse:collapse;}
.container{width:90%;margin:20px auto}
.v_m{vertical-align: middle}
.ml_20{margin-left:20px;}
.m_10{ margin-bottom:10px;}
.f14{font-size:14px;}
.f18{font-size:18px;}
.f30{font-size:30px;}
.bold{font-weight:bold}
.gray{color:#979797}
.orange{color:#f76f10;}
table.table.topBorder{border-top:2px solid #b0b0b0;}
.btn_print{width:112px;height:31px;margin:20px auto;border:0;}
</style>
</head>

<body>
	<div class="container">
	<table class="m_10" width="100%" cellspacing="0" cellpadding="0" border="0">
		<colgroup>
			<col width="30%" />
			<col width="30%" />
			<col />
		</colgroup>

		<tr>
			<td align="left">
				<p>
					订单号:<?php echo isset($order_no)?$order_no:"";?><br />
					日期:<?php echo date('Y-m-d',strtotime($create_time));?>
				</p>
			</td>
			<td class="f18"><?php if(isset($set['name'])){?><?php echo isset($set['name'])?$set['name']:"";?><?php }?>配货清单</td>
			<td valign="bottom" align="right"><p>客户:<?php echo isset($accept_name)?$accept_name:"";?><span class="ml_20">电话:<?php echo isset($mobile)?$mobile:"";?></span></p></td>
		</tr>
	</table>

	<table class="table" width="100%" cellspacing="0" cellpadding="0" border="1">
		<colgroup>
			<col width="400px" />
			<col width="160px" />
			<col width="120px" />
			<col width="100px" />
			<col width="120px" />
		</colgroup>

		<tbody>
			<tr class="f14">
				<th>商品名称</th>
				<th>商品货号</th>
				<th>单价</th>
				<th>数量</th>
				<th>小计</th>
			</tr>
			<?php $query = new IQuery("order_goods");$query->where = "order_id = $id and is_send !=  2";$items = $query->find(); foreach($items as $key => $item){?>
			<?php $goodsRow = JSON::decode($item['goods_array'])?>
			<tr>
				<td align="left">
					<label>
						<?php echo isset($goodsRow['name'])?$goodsRow['name']:"";?> &nbsp;
						<span class="gray"><?php echo isset($goodsRow['value'])?$goodsRow['value']:"";?></span>
						<?php $query = new IQuery("brand as b");$query->join = "left join goods as go on go.brand_id = b.id";$query->fields = "b.name";$query->where = "go.id = $item[goods_id]";$items = $query->find(); foreach($items as $key => $brand){?>
						【<?php echo isset($brand['name'])?$brand['name']:"";?>】
						<?php }?>
					</label>
				</td>
				<td><?php echo isset($goodsRow['goodsno'])?$goodsRow['goodsno']:"";?></td>
				<td>￥<?php echo isset($item['goods_price'])?$item['goods_price']:"";?></td>
				<td><?php echo isset($item['goods_nums'])?$item['goods_nums']:"";?></td>
				<td>￥<?php echo $item['goods_price'] * $item['goods_nums'];?></td>
			</tr>
			<?php }?>
		</tbody>
	</table>

	<table class="table" width="100%" cellspacing="0" cellpadding="0" border="0">
		<colgroup>
			<col width="60%" />
			<col />
		</colgroup>

		<tr>
			<td align="left">订单附言：<?php echo isset($postscript)?$postscript:"";?></td>
			<td align="left">配送：<?php $query = new IQuery("delivery");$query->where = "id = $distribution";$items = $query->find(); foreach($items as $key => $item){?><?php echo isset($item['name'])?$item['name']:"";?><?php }?></td>
		</tr>
		<tr>
			<td align="left">地址：<?php echo isset($address)?$address:"";?></td>
			<td align="left">收货人：<?php echo isset($accept_name)?$accept_name:"";?></td>
		</tr>
		<tr>
			<td align="left">手机：<?php echo isset($mobile)?$mobile:"";?></td>
			<td align="left">电话：<?php echo isset($telphone)?$telphone:"";?></td>
		</tr>
		<tr>
			<td align="left">订单备注：<?php echo isset($note)?$note:"";?></td>
		</tr>
	</table>

	<table class="table topBorder" width="100%" cellspacing="0" cellpadding="0" border="0">
		<tr><td class="f18" align="left"><b>签字：</b></td></tr>
	</table>

	<input type="submit" class="btn_print noprint" onclick="window.print();" value="打印" />
</div>
</body>

</html>