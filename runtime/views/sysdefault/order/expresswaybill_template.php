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
	<?php $seller_id = IFilter::act(IReq::get('seller_id'),'int')?>
<?php $query = new IQuery("expresswaybill");$query->where = "is_close = 0";$query->fields = "id,name";$printType = $query->find();?>
<div class="container">
	<form action='<?php echo IUrl::creatUrl("/order/expresswaybill_print");?>' method='post' id='express_print'>
		<input type='hidden' name='order_id' id='order_id' value='' />
		<input type='hidden' name='express_id' id='express_id' value='' />
		<input type='hidden' name='seller_id' value='<?php echo isset($seller_id)?$seller_id:"";?>' />

		<?php foreach($items=$this->orderInfo as $key => $orderRow){?>
		<table class="table" width="100%" cellspacing="0" cellpadding="0" border="1" style='margin-top:15px'>
			<caption class="f30 bold">快递单打印</caption>
			<colgroup>
				<col width="300px" />
				<col />
			</colgroup>

			<tr>
				<td>收货人姓名</td><td align='left'><?php echo isset($orderRow['accept_name'])?$orderRow['accept_name']:"";?></td>
			</tr>
			<tr>
				<td>收货地址</td><td align='left'><?php echo isset($orderRow['province_str'])?$orderRow['province_str']:"";?> &nbsp; <?php echo isset($orderRow['city_str'])?$orderRow['city_str']:"";?> &nbsp; <?php echo isset($orderRow['area_str'])?$orderRow['area_str']:"";?> &nbsp; <?php echo isset($orderRow['address'])?$orderRow['address']:"";?></td>
			</tr>
			<tr>
				<td>联系手机</td><td align='left'><?php echo isset($orderRow['mobile'])?$orderRow['mobile']:"";?></td>
			</tr>
			<tr>
				<td>联系电话</td><td align='left'><?php echo isset($orderRow['telphone'])?$orderRow['telphone']:"";?></td>
			</tr>
			<tr>
				<td>邮编</td><td align='left'><?php echo isset($orderRow['postcode'])?$orderRow['postcode']:"";?></td>
			</tr>
			<tr>
				<td>订单附言</td><td align='left'><?php echo isset($orderRow['postscript'])?$orderRow['postscript']:"";?></td>
			</tr>
			<tr>
				<td></td>
				<td align='left'>
					<?php if($printType){?>
					<?php foreach($items=$printType as $key => $printRow){?>
					<input type='submit' value='<?php echo isset($printRow['name'])?$printRow['name']:"";?>' onclick='$("#express_id").val("<?php echo isset($printRow['id'])?$printRow['id']:"";?>");$("#order_id").val("<?php echo isset($orderRow['id'])?$orderRow['id']:"";?>");' /> &nbsp;&nbsp;
					<?php }?>
					<?php }else{?>
					当前还没有快递单模板<a href='<?php echo IUrl::creatUrl("/order/expresswaybill_edit");?>'>点击新建</a>
					<?php }?>
				</td>
		</table>
		<?php }?>
	</form>
</div>
</body>

</html>