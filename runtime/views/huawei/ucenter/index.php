<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="UTF-8">
	<title><?php echo $this->_siteConfig->name;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link type="image/x-icon" href="<?php echo IUrl::creatUrl("")."favicon.ico";?>" rel="icon">
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/jquery/jquery-1.12.4.min.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/form/form.js"></script>
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/autovalidate/validate.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/autovalidate/style.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/artDialog.js?v=4.8"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artdialog/plugins/iframeTools.js"></script><link rel="stylesheet" type="text/css" href="/runtime/_systemjs/artdialog/skins/aero.css" />
	<script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate.js"></script><script type="text/javascript" charset="UTF-8" src="/runtime/_systemjs/artTemplate/artTemplate-plugin.js"></script>
	<!--[if IE]><script src="<?php echo $this->getWebViewPath()."javascript/html5.js";?>"></script><![endif]-->
	<script src='<?php echo $this->getWebViewPath()."javascript/site.js";?>'></script>
	<link rel="stylesheet" href="<?php echo $this->getWebSkinPath()."style/style.css";?>">
  <script type='text/javascript' src='<?php echo IUrl::creatUrl("")."public/javascript/public.js";?>'></script>
</head>
<body>

<!-- 顶部工具栏 -->
<div class="header_top">
	<div class="web">
		<div class="welcome">
			欢迎您来到 <?php echo $this->_siteConfig->name;?>！
		</div>
		<ul class="top_tool">
			<li><a href="<?php echo IUrl::creatUrl("ucenter/index");?>">个人中心</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/simple/seller");?>">申请开店</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/seller/index");?>">商家管理</a></li>
			<li><a href="<?php echo IUrl::creatUrl("/site/help_list");?>">使用帮助</a></li>
		</ul>
	</div>
</div>
<!-- 顶部工具栏 -->
<header class="header">
	<!-- logo与搜索 -->
	<div class="body_wrapper">
		<div class="web">
			<!-- logo -->
			<div class="logo_layer">
				<a title="<?php echo $this->_siteConfig->name;?>" href="<?php echo IUrl::creatUrl("");?>" class="logo">
					<img src="<?php if($this->_siteConfig->logo){?><?php echo IUrl::creatUrl("")."".$this->_siteConfig->logo."";?><?php }else{?><?php echo $this->getWebSkinPath()."image/logo.png";?><?php }?>">
				</a>
			</div>
			<!-- 注册与登录 -->
			<div class="body_toolbar">
				<?php if($this->user){?>
					<div class="body_toolbar_btn userinfo">
						<a href="<?php echo IUrl::creatUrl("/ucenter/index");?>"><?php echo isset($this->user['username'])?$this->user['username']:"";?></a>
						<i></i>
					</div>
					<div class="body_toolbar_layer">
						<div class="toolbar_layer_info">
							<a class="info_photo" href="<?php echo IUrl::creatUrl("/ucenter/index");?>">
								<img id="user_ico_img" src="<?php echo IUrl::creatUrl("".$this->user['head_ico']."");?>" onerror="this.src='<?php echo $this->getWebSkinPath()."image/user_ico.gif";?>'">
							</a>
							<div>
								<a href="<?php echo IUrl::creatUrl("/ucenter/index");?>"><?php echo isset($this->user['username'])?$this->user['username']:"";?> <i class="fa fa-user-md"></i></a>
								<span><?php echo ISafe::get('last_login');?></span>
							</div>
						</div>
						<div class="myorder">
							<dl class="clearfix">
								<dt>
									<span class="fl">我的订单</span>
									<a class="fr" href="<?php echo IUrl::creatUrl("/ucenter/index");?>">更多&gt;</a>
								</dt>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/integral");?>">我的积分</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/account_log");?>">账户余额</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/evaluation");?>">待评价</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/refunds");?>">退换货</a></dd>
								<dd><a href="<?php echo IUrl::creatUrl("/ucenter/consult");?>">商品咨询</a></dd>
							</dl>
						</div>
						<div class="myshop"><a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的商城</a></div>
						<div class="logout"><a href="<?php echo IUrl::creatUrl("/simple/logout");?>">退出登录</a></div>
					</div>
				<?php }else{?>
					<div class="body_toolbar_btn login_reg">
						<a href="<?php echo IUrl::creatUrl("/simple/login");?>">登录</a>
						<em> | </em>
						<a class="reg" href="<?php echo IUrl::creatUrl("/simple/reg");?>">注册</a>
					</div>
				<?php }?>
			</div>
			<!-- 注册与登录 -->
			<!--购物车模板 开始-->
			<div class="header_cart" name="mycart">
				<a href="<?php echo IUrl::creatUrl("/simple/cart");?>" class="go_cart">
					<i class="fa fa-shopping-cart"></i>
					<em class="sign_total" name="mycart_count"]>0</em>
				</a>
				<div class="cart_simple" id="div_mycart"></div>
			</div>
			<script type='text/html' id='cartTemplete'>
			<div class='cart_panel'>
				<%if(goodsCount){%>
					<!-- 购物车物品列表 -->
					<ul class='cart_list'>
						<%for(var item in goodsData){%>
						<%var data = goodsData[item]%>
						<li id="site_cart_dd_<%=item%>">
							<em><%=(window().parseInt(item)+1)%></em>
							<a target="_blank" href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>">
								<img src="<%=webroot(data['img'])%>">
							</a>
							<a class="shop_name" target="_blank" href="<?php echo IUrl::creatUrl("/site/products/id/<%=data['goods_id']%>");?>"><%=data['name']%></a>
							<!-- <p class="shop_class"></p> -->
							<div class="shop_price"><p>￥ <%=data['sell_price']%> <span>x <%=data['count']%></span></p></div>
							<i class="fa fa-remove" onclick="removeCart('<%=data['id']%>','<%=data['type']%>');$('#site_cart_dd_<%=item%>').hide('slow');"></i>
						</li>
						<%}%>
					</ul>
					<!-- 购物车物品列表 -->
					<!-- 购物车物品统计 -->
					<div class="cart_total">
						<p>
							共<span name="mycart_count"><%=goodsCount%></span>件
							总额：<em name="mycart_sum">￥<%=goodsSum%></em>
						</p>
						<a href="<?php echo IUrl::creatUrl("simple/cart");?>">结算</a>
					</div>
					<!-- 购物车物品统计 -->
				<%}else{%>
					<!-- 购物车无内容 -->
					<div class='cart_no'>购物车空空如也~</div>
				<%}%>
			</div>
			</script>
			<!--购物车模板 结束-->
			<!-- 搜索框 -->
			<div class="search_box">
					<!-- 搜索内容 -->
				<form method='get' action='<?php echo IUrl::creatUrl("/");?>'>
					<input type='hidden' name='controller' value='site'>
					<input type='hidden' name='action' value='search_list'>
					<div class="search">
						<input type="text" name='word' class="search_keyword" autocomplete="off" style="color: rgb(204, 204, 204);">
						<button class="search_submit" type="submit">
							<i class="fa fa-search"></i>
						</button>
					</div>
				</form>
				<!-- 热门搜索 -->
				<div class="search_hotwords">
					<?php foreach($items=Api::run('getKeywordList',2) as $key => $item){?>
					<?php $tmpWord = urlencode($item['word']);?>
					<a href="<?php echo IUrl::creatUrl("/site/search_list/word/".$tmpWord."");?>"><?php echo isset($item['word'])?$item['word']:"";?></a>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
	<!-- logo与搜索 -->

	<!-- 导航栏 -->
	<div class="nav_bar">
		<div class="user_center">
		<div class="web">
			<!-- 分类列表 -->
			<div class="category_list">
				<!-- 全部商品 -->
				<a class="all_goods_sort" href="" target="_blank">
					<h3 class="all">全部商品</h3>
				</a>
				<!-- 全部商品 -->
				<!-- 分类列表-详情 -->
				<ul class="cat_list none">
					<?php foreach($items=Api::run('getCategoryListTop') as $key => $first){?>
					<li>
						<!-- 分类列表-导航模块 -->
						<div class="cat_nav">
							<h3><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>"><?php echo isset($first['name'])?$first['name']:"";?></a></h3>
							<?php foreach($items=Api::run('getCategoryByParentid',array('#parent_id#',$first['id']), 3) as $key => $second){?>
							<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a>
							<?php }?>
							<i class="fa fa-angle-right"></i>
						</div>
						<!-- 分类列表-导航模块 -->
						<!-- 分类列表-导航内容模块 -->
						<div class="cat_more">
							<h3>
								<a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$first['id']."");?>">
									<span><?php echo isset($first['name'])?$first['name']:"";?></span>
									<i class="fa fa-angle-right"></i>
								</a>
							</h3>
							<ul class="cat_nav_list">
								<?php foreach($items=Api::run('getCategoryByParentid',array('#parent_id#',$first['id']), 6) as $key => $second){?>
								<li><a href="<?php echo IUrl::creatUrl("/site/pro_list/cat/".$second['id']."");?>"><?php echo isset($second['name'])?$second['name']:"";?></a></li>
								<?php }?>
							</ul>
							<ul class="cat_content_list">
								<?php foreach($items=Api::run('getCategoryExtendList',array('#categroy_id#',$first['id']),4) as $key => $item){?>
								<li>
									<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>" target="_blank" title="<?php echo isset($item['name'])?$item['name']:"";?>">
										<img class="img-lazyload" src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/118/h/118");?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>">
										<h3><?php echo isset($item['name'])?$item['name']:"";?></h3>
										<p class="price">￥ <?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
									</a>
								</li>
								<?php }?>
							</ul>
						</div>
						<!-- 分类列表-导航内容模块 -->
					</li>
					<?php }?>
				</ul>
				<!-- 分类列表-详情 -->
			</div>
			<!-- 分类列表 -->
			<!-- 导航索引 -->
			<div class="nav_index">
				<ul class="nav">
					<li class="user_nav_index"><a href="<?php echo IUrl::creatUrl("/site/index");?>"><span>首 页</span></a></li>
					<?php foreach($items=Api::run('getGuideList') as $key => $item){?>
					<li class="user_nav_index"><a href="<?php echo IUrl::creatUrl("".$item['link']."");?>"><span><?php echo isset($item['name'])?$item['name']:"";?></span></a></li>
					<?php }?>
				</ul>
			</div>
		</div>
		</div>
	</div>
</header>

<!-- 个人中心内容 -->
<div class="center_content">
	<section class="breadcrumb">
		<span></span> <a href="<?php echo IUrl::creatUrl("");?>">首页</a> \ <a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的账户</a>
	</section>


	<section class="web">
		<div class="ucenter_content_bar">
			<section class="ucenter_main">
				
<?php if($msgNum>0){?>
<div class="prompt">
	<strong>温馨提示：</strong> 您有<span class="red"><?php echo isset($msgNum)?$msgNum:"";?></span> 条站内未读短信息，<a href="<?php echo IUrl::creatUrl("/ucenter/message");?>">现在去看看</a>
</div>
<?php }?>

<!-- <header class="uc_head_red">
	<time>上一次登录时间：<?php echo ISafe::get('last_login');?></time>
	<h3>您好，<?php echo isset($this->user['username'])?$this->user['username']:"";?> 欢迎回来!</h3>
</header> -->

<section class="uc_info">
	<?php $user_ico = $this->user['head_ico']?>
	<div class="user_ico">
		<img id="user_ico_img" onclick="select_ico()" src="<?php echo IUrl::creatUrl("".$user_ico."");?>" onerror="this.src='<?php echo $this->getWebSkinPath()."image/user_ico.gif";?>'">
		<!-- <span onclick="select_ico()">修改头像</span> -->
	</div>
	<div class="user_info">
		<h2><?php echo isset($this->user['username'])?$this->user['username']:"";?>，欢迎您</h2>
		<h3>会员等级：<?php echo isset($user['group_name'])?$user['group_name']:"";?></h3>
		<!-- <ul class="user_baseinfo">
			<li>总积分：<a href="<?php echo IUrl::creatUrl("/ucenter/integral");?>"><strong><?php echo isset($user['point'])?$user['point']:"";?></strong> 分</a></li>
			<li>交易总数量：<a href="<?php echo IUrl::creatUrl("/ucenter/order");?>"><strong><?php echo isset($statistics['num'])?$statistics['num']:"";?></strong> 笔</a></li>
			<li>总消费额：<strong>￥<?php echo isset($statistics['amount'])?$statistics['amount']:"";?></strong></li>
		</ul>
		<ul class="user_stat">
			<li>奖金钱包：
				<strong>￥<span id="bonus"><?php echo isset($user['bonus'])?$user['bonus']:"";?></span>
				<button id="btn_zhuan">转存</button>
				<input type="" name="">
				<button>分投</button>
			    </strong>
			</li>
			<li>代金券：<strong><?php echo isset($propData['prop_num'])?$propData['prop_num']:"";?></strong> 张</li>
			<li>经验值：<strong><?php echo isset($user['exp'])?$user['exp']:"";?></strong></li>
		</ul>
		<ul class="user_stat">
			<li>消费钱包：<strong>￥<span id="consumption"><?php echo isset($user['consumption'])?$user['consumption']:"";?></span></strong></strong></li>
			<li>待付款订单：(<strong><?php echo statistics::countUserWaitPay($this->user['user_id']);?></strong>)</li>
			<li>待确认收货：(<strong><a href="<?php echo IUrl::creatUrl("/ucenter/order");?>"><?php echo statistics::countUserWaitCommit($this->user['user_id']);?></a></strong>)</li>
		</ul>
		<ul class="user_stat">
			<li>提现钱包（余额）：<strong>￥<span id="balance"><?php echo isset($user['balance'])?$user['balance']:"";?></span></strong></li>
		</ul> -->
	</div>
</section>
<style type="text/css">
	.uc_money{
		width: 100%;
		height:200px;
	}
	.uc_qianbao{
		height: 50%;

	}
	.uc_qianbao ul li{
		padding: 10px;
		float: left;
	}
	.uc_qianbao ul{
		margin: 20px;
		float: left;
	}
	.li_zhuan{
		padding: 0px!important;
	}
	.li_zhuan button{
		border:none;
		border-radius: 5px;
		background:red;
		padding: 5px!important;
		color: #FFFFFF;
	}
	
	.li_fent{
		padding:0px 10px!important;
	}
	.li_fent button{
		border:none;
		border-radius: 5px;
		background:red;
		padding: 5px!important;
		color: #FFFFFF;
	}
	.wrapper {
		width: 350px;
		margin: auto;
	}

	.wrapper p a {
		color: #757575;
		text-decoration: none;
	}

	.wrapper .load-bar {
		width: 100%;
		height: 20px;
		border-radius: 30px;
		background-color: #D9D9D9;
		position: relative;
		box-shadow: 0 1px 0 rgba(255, 255, 255, 0.8), inset 0 2px 3px rgba(0, 0, 0, 0.2);
	}

	.wrapper .load-bar-inner {
		height: 99%;
		width: 0%;
		border-radius: inherit;
		position: relative;
		background-color: red;
		animation: loader 10s linear 1;
		animation-fill-mode: forwards;
	}

	.wrapper #counter {
		position: absolute;
		padding: 8px 12px;
		border-radius: 0.4em;
		box-shadow: inset 0 1px 0 rgba(255, 255, 255, 1), 0 2px 4px 1px rgba(0, 0, 0, 0.2), 0 1px 3px 1px rgba(0, 0, 0, 0.1);
		left: -25px;
		top: -35px;
		font-size: 12px;
		font-weight: bold;
		width: 130px;
		animation: counter 10s linear 1;
		animation-fill-mode: forwards;
	}

	.wrapper #counter:after {
		content: "";
		position: absolute;
		width: 8px;
		height: 8px;
		background-color: #E7E6E3;
		transform: rotate(45deg);
		left: 15%;
		margin-left: -4px;
		bottom: -4px;
		box-shadow: 3px 3px 4px rgba(0, 0, 0, 0.2), 1px 1px 1px 1px rgba(0, 0, 0, 0.1);
		border-radius: 0 0 3px 0;
	}

	.wrapper h1 {
		font-size: 28px;
		padding: 20px 0 8px 0;
	}

	.wrapper p {
		font-size: 13px;
	}

	@keyframes loader {
		from {
			width: 0%;
		}
		to {
			width: 100%;
		}
	}

	@keyframes counter {
		from {
			left: -25px;
		}
		to {
			left: 323px;
		}
	}

	.load-bar-inner {
		height: 99%;
		width: 0%;
		border-radius: inherit;
		position: relative;
		background: #c2d7ac;
		animation: loader 5s linear 1;
		animation-fill-mode: forwards;
	}
	.wrapper-cont{
		margin: 20px auto;
		width: 38%;
		display: flex;
		justify-content: space-between;
	}
</style>
<header class="uc_head mt30">
	<h3>我的钱包</h3>
</header>
<section class="uc_money">
	<div class="uc_qianbao">
		<ul>
			<li>消费钱包：<strong>￥<span id="consumption"><?php echo isset($user['consumption'])?$user['consumption']:"";?></span></strong></strong></li>
			<li>奖金钱包：<strong>￥<span id="bonus"><?php echo isset($user['bonus'])?$user['bonus']:"";?></span></strong></li>
			<li>提现钱包（余额）：<strong>￥<span id="balance"><?php echo isset($user['balance'])?$user['balance']:"";?></span></strong></li>
			<li class="li_zhuan"><button id="btn_zhuan">转存</button></li>
			<li class="li_fent">
				<!-- <input type="" name=""> -->
				<button class="fent">分投</button>
			</li>
		</ul>
	</div>
	<div class="uc_zongchi">
		<div class="wrapper">
	      	<div class="load-bar">
	        	<div class="load-bar-inner" data-loading="0"><span id="counter"></span> </div>
	      	</div>
	    </div>
	    <div class="wrapper-cont">
	    	<div>积分奖池</div>
	    	<div>总的积分：10000</div>
	    </div>
	    
	</div>

</section>
<header class="uc_head mt30">
	<h3>我的订单</h3>
	<a href="<?php echo IUrl::creatUrl("/ucenter/order");?>" class="more">更多 ></a>
</header>
<section class="uc_table">
	<table>
		<thead>
			<tr>
				<th>订单编号</th><th>下单日期</th><th>收货人</th><th>支付方式</th><th>总金额</th><th>订单状态</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($items=Api::run('getOrderListByUserid',array('#user_id#',$user['user_id'])) as $key => $item){?>
		<tr>
			<td><a href="<?php echo IUrl::creatUrl("/ucenter/order_detail/id/".$item['id']."");?>"><?php echo isset($item['order_no'])?$item['order_no']:"";?></a></td>
			<td><?php echo isset($item['create_time'])?$item['create_time']:"";?></td>
			<td><?php echo isset($item['accept_name'])?$item['accept_name']:"";?></td>
			<td><?php echo isset($this->payments[$item['pay_type']]['name'])?$this->payments[$item['pay_type']]['name']:"";?></td>
			<td>￥<?php echo ($item['order_amount']);?></td>
			<td>
				<?php $orderStatus = Order_Class::getOrderStatus($item)?>
				<b class="<?php if($orderStatus >= 6){?>green<?php }else{?>orange<?php }?>"><?php echo Order_Class::orderStatusText($orderStatus);?></b>
			</td>
		</tr>
		<?php }?>
		</tbody>
	</table>
</section>


<script>

	$(function() {

        var interval = setInterval(increment, 100);
        var current = 0;

        function increment() {
          current++;
          $('#counter').html('已经完成'+current + '%积分');
          if(current == 50) {
            clearInterval(interval);
            $('#counter').css("animation-play-state","paused")
            $('.load-bar-inner').css("animation-play-state","paused")
          }else{
            
          }

        }

      });
//选择头像
function select_ico(){
	<?php $callback = urlencode(IUrl::creatUrl('/ucenter/user_ico_upload'))?>
	art.dialog.open('<?php echo IUrl::creatUrl("/block/photo_upload?callback=".$callback."");?>',
	{
		'id':'user_ico',
		'title':'设置头像',
		'ok':function(iframeWin, topWin)
		{
			iframeWin.document.forms[0].submit();
			return false;
		}
	});
}

//头像上传回调函数
function callback_user_ico(content){
	var content = eval(content);
	if(content.isError == true){
		alert(content.message);
	}else{
		$('#user_ico_img').prop('src',content.data);
	}
	art.dialog({id:'user_ico'}).close();
}

// 个人中心转存
$(function(){
	$('#btn_zhuan').click(function(){
		var jiangjin = $('#bonus').html();
		// 判断奖金是否为0
		if (jiangjin <= 0) {
			alert('没有奖金');return;
		}
		// 获取当前用户ID
		var user_id = "<?php echo isset($user['user_id'])?$user['user_id']:"";?>";

		// 通过Ajax传值进行转存修改
		$.get('<?php echo IUrl::creatUrl("/ucenter/savebonus");?>',{jin:jiangjin,user_id:user_id},function(result){
			if (result.code == 10001) {
				alert(result.message);return false;
			}
			if (result.code == 10002) {
				alert(result.message);return false;
			}
			if (result.code == 200) {
				alert(result.message);
			}
			$('#bonus').html(result.data.bonus);
			$('#consumption').html(result.data.consumption);
			$('#balance').html(result.data.balance);
		},'JSON');
		$(this).attr('disabled',false);
	})

})

</script>

			</section>
			<!-- 个人中心内容-功能栏 -->
			<aside class="ucenter_bar">
				<!-- 我的商城 -->
				<div class="ucenter_bar_wapper">
					<a href="<?php echo IUrl::creatUrl("/ucenter/index");?>">我的商城</a>
				</div>
				<!-- 我的商城 -->
				<!-- 功能栏 -->
				<?php $index=0;?>
				<?php foreach($items=menuUcenter::init() as $key => $item){?>
				<?php $index++;?>
				<nav class="user_bar">
					<h3><?php echo isset($key)?$key:"";?></h3>
					<ul>
						<?php foreach($items=$item as $moreKey => $moreValue){?>
						<li><a title="<?php echo isset($moreValue)?$moreValue:"";?>" href="<?php echo IUrl::creatUrl("".$moreKey."");?>"><?php echo isset($moreValue)?$moreValue:"";?></a></li>
						<?php }?>
					</ul>
				</nav>
				<?php }?>
				<!-- 功能栏 -->
			</aside>
			<!-- 个人中心内容-功能栏 -->
		</div>
		<section class="ucenter_goods">
			<h3>也许你会对下列商品感兴趣</h3>
			<ul>
				<?php foreach($items=Api::run('getGoodsByCommendgoods',8) as $key => $item){?>
				<li>
					<a href="<?php echo IUrl::creatUrl("/site/products/id/".$item['id']."");?>">
						<img src="<?php echo IUrl::creatUrl("/pic/thumb/img/".$item['img']."/w/170/h/170");?>" alt="<?php echo isset($item['name'])?$item['name']:"";?>">
						<p class="pro_title"><?php echo isset($item['name'])?$item['name']:"";?></p>
						<p class="pro_price">￥<?php echo isset($item['sell_price'])?$item['sell_price']:"";?></p>
					</a>
				</li>
				<?php }?>
			</ul>
		</section>
	</section>
</div>
<!-- 个人中心内容 -->

<footer class="foot">
	<section class="service">
		<ul>
			<li class="item1">
				<i class="fa fa-star"></i>
				<strong>正品优选</strong>
			</li>
			<li class="item2">
				<i class="fa fa-globe"></i>
				<strong>上市公司</strong>
			</li>
			<li class="item3">
				<i class="fa fa-inbox"></i>
				<strong>300家连锁门店</strong>
			</li>
			<li class="item4">
				<i class="fa fa-map-marker"></i>
				<strong>上百家维修网点 全国联保</strong>
			</li>
		</ul>
	</section>
	<section class="help">
		<div class="prompt_link">
			<?php $catIco = array('help-new','help-delivery','help-pay','help-user','help-service')?>
			<?php foreach($items=Api::run('getHelpCategoryFoot') as $key => $helpCat){?>
			<dl class="help_<?php echo $key+1;?>">
				<dt>
					<p class="line"></p>
					<p class="title"><a href="<?php echo IUrl::creatUrl("/site/help_list/id/".$helpCat['id']."");?>"><?php echo isset($helpCat['name'])?$helpCat['name']:"";?></a></p>
				</dt>
				<?php foreach($items=Api::run('getHelpListByCatidAll',array('#cat_id#',$helpCat['id'])) as $key => $item){?>
				<dd><a href="<?php echo IUrl::creatUrl("/site/help/id/".$item['id']."");?>"><?php echo isset($item['name'])?$item['name']:"";?></a></dd>
				<?php }?>
			</dl>
			<?php }?>
		</div>
		<div class="contact">
			<p class="line"></p>
			<em>400-888-8888</em>
			<span>24小时在线客服(仅收市话费)</span>
			<a href="#"><i class="fa fa-comments"></i> 在线客服</a>
		</div>
	</section>
	<section class="copy">
		<?php echo IFilter::stripSlash($this->_siteConfig->site_footer_code);?>
	</section>
</footer>



<script>
//DOM加载完毕后运行
$(function(){
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
	var localUrl = "<?php echo IUrl::getUri();?>";
	$('a[href^="'+localUrl+'"]').parent().addClass('current');
});

</script>
</body>
</html>
