<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="renderer" content="webkit">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title><?php echo C('web_title');?></title>
	<meta name="Keywords" content="<?php echo C('web_keywords');?>">
	<meta name="Description" content="<?php echo C('web_description');?>">
	<meta name="author" content="qijianke.com">
	<meta name="coprright" content="qijianke.com">
	<link rel="shortcut icon" href="favicon.ico"/>
	<link rel="stylesheet" href="/Public/Home/css/movesay.css"/>
	<link rel="stylesheet" href="/Public/Home/css/style.css"/>
	<link rel="stylesheet" href="/Public/Home/css/font-awesome.min.css"/>
	<script type="text/javascript" src="/Public/Home/js/jquery.min.js"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery.flot.js"></script>
	<script type="text/javascript" src="/Public/Home/js/jquery.cookies.2.2.0.js"></script>
	<script type="text/javascript" src="/Public/Home/js/translate.js"></script>
	<script type="text/javascript" src="/Public/layer/layer.js"></script>
</head>
<body>
<div class="header bg_w" id="trade_aa_header">
	<div class="hearder_top">
		<div class="autobox po_re zin100" id="header">
			<div class="welcome"><?php echo C('top_name');?></div>
			<div class="right orange" id="login">
				<?php if(($_SESSION['userId']) > "0"): ?><dl class="mywallet">
						<dt id="user-finance">
						<div class="mywallet_name clear">
							<a href="/finance/"><?php echo (session('userName')); ?></a><i></i>
						</div>
						<div class="mywallet_list" style="display: none;">
							<div class="clear">
								<ul class="balance_list">
									<h4><?php echo L('public.keyongyue');?></h4>
									<li>
										<a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong><?php echo L('public.renminbi');?>：</strong><span><?php echo ($userCoin_top['cny']*1); ?></span></a>
									</li>
								</ul>
								<ul class="freeze_list">
									<h4><?php echo L('public.weituodongjie');?></h4>
									<li>
										<a href="javascript:void(0)"><em style="margin-top: 5px;" class="deal_list_pic_cny"></em><strong><?php echo L('public.renminbi');?>：</strong><span><?php echo ($userCoin_top['cnyd']*1); ?></span></a>
									</li>
								</ul>
							</div>
							<div class="mywallet_btn_box">
								<a href="/finance/mycz.html"><?php echo L('public.chongzhi');?></a><a href="/finance/mytx.html"><?php echo L('public.tixian');?></a><a href="/finance/myzr.html"><?php echo L('public.zhuanru');?></a><a href="/finance/myzc.html"><?php echo L('public.zhuanchu');?></a><a href="/finance/mywt.html"><?php echo L('public.weituoguanli');?></a><a href="/finance/mycj.html"><?php echo L('public.chengjiaochaxun');?></a>
							</div>
						</div>
						</dt>
						
						<dd>
							ID：<span><?php echo (session('userId')); ?></span>
						</dd>
						<dd>
							<a href="<?php echo U('Login/loginout');?>"><?php echo L('public.tuichu');?></a>
						</dd>
					</dl>
					<?php else: ?> <!-- 登陆前 -->
					<div class="orange">
						<span class="zhuce"><a class="orange" href="<?php echo U('Login/register');?>"><?php echo L('public.zhuce');?></a></span> |
						<a href="javascript:;" class="orange" onclick="loginpop();"><?php echo L('public.denglu');?></a>
					</div><?php endif; ?>
			</div>
			<div class="right">
				<select id="select_lang" style="background-color: #F6F6F6;">
					<option <?php if((LANG_SET) == "zh-cn"): ?>selected<?php endif; ?> value="zh-cn">中文</option>
					<option <?php if((LANG_SET) == "en-us"): ?>selected<?php endif; ?> value="en-us">English</option>
				</select>
			</div>
			<div class="nav  nav_po_1" id="menu_nav">
				<ul>
					<li style=" text-align: right; margin-right: 20px;">
						<a href="/" id="index_box"><?php echo L('public.shouye');?></a>
					</li>
					<li>
						<a id="trade_box" href="<?php echo U('Trade/index');?>"><span><?php echo L('public.jiaoyizhongxin');?></span>
							<img src="/Public/Home/images/down.png"></a>
						<div class="deal_list " style="display: none;    top: 36px;">
							<dl id="menu_list_json"></dl>
							<div class="sj"></div>
							<div class="nocontent"></div>
						</div>
					</li>

					<?php if(is_array($daohang)): $i = 0; $__LIST__ = $daohang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
							<a id="<?php echo ($vo['name']); ?>_box" href="/<?php echo ($vo['url']); ?>"><?php echo (get_lang_text($vo['title'],$vo['title_en'])); ?></a>
						</li><?php endforeach; endif; else: echo "" ;endif; ?>

				</ul>
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>
	<div class="autobox clear" id="trade_clear">
		<div class="logo">
			<a href="/"><img src="/Upload/public/<?php echo ($C['web_logo']); ?>" alt=""/></a>
		</div>

		<!-- 头部QQ客服
		<div class="phone right">
			<span class="iphone" style=""></span><a href="http://wpa.qq.com/msgrd?V=3&amp;uin=<?php echo C('contact_qq')[0];?>&amp;Site=QQ客服&amp;Menu=yes" target="_blank" class="qqkefu"></a>
		</div>
		-->

	</div>
</div>
<script>
	var LANG_SET = '<?php echo (LANG_SET); ?>';
	
	$.getJSON("/Ajax/getJsonMenu?t=" + Math.random(), function (data) {
		if (data) {
			var list = '';
			for (var i in data) {
				list += '<dd><a href="/Trade/index/market/' + data[i]['name'] + '"><img src="/Upload/coin/' + data[i]['img'] + '" style="width: 18px; margin-right: 5px;">' + data[i]['title'] + '</a></dd>';
			}
			$("#menu_list_json").html(list);
		}
	});
	$('#trade_box').hover(function () {
		$('.deal_list').show()
	}, function () {
		$('.deal_list').hide()
	});
	$('.deal_list').hover(function () {
		$('.deal_list').show()
	}, function () {
		$('.deal_list').hide()
	});
	$('#user-finance').hover(function () {
		$('.mywallet_list').show();
	}, function () {
		$('.mywallet_list').hide()
	});
	$('#select_lang').change(function(){
		var self = $(this);
		if(self.val() == 'zh-cn'){
			window.location = '?l=zh-cn';
		}else{
			window.location = '?l=en-us';
		}
	});
</script>
<!--头部结束-->                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             <!--焦点图-->
<div class="index_pic_wrap po_re">
    <div id="myCarousel" class="my-carousel">
        <!--<div class="my-carousel-indicators">-->
        <ol class="my-carousel-indicators">
            <?php if(is_array($indexAdver)): $i = 0; $__LIST__ = $indexAdver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li data-target="#myCarousel" data-slide-to="<?php echo ($i); ?>"
                <?php if(($i) == "1"): ?>class="active"<?php endif; ?>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ol>
        <div class="my-carousel-inner">
            <?php if(is_array($indexAdver)): $i = 0; $__LIST__ = $indexAdver;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item hand <?php if(($i) == "1"): ?>active<?php endif; ?>" onclick="window.open('<?php echo ($vo['url']); ?>')" style="background-image: url(/Upload/ad/<?php echo ($vo["img"]); ?>);"></div><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div>
    <div class="login_wrap">
        <div class="login_box">
            <div class="login_bg" style="height:355px;"></div>
            <!-- 未登录状态 -->
            <?php if(($_SESSION['userId']) > "0"): ?><div id="login-bar" class="login_box_2" style="padding-left:24px;">
                    <h2><?php echo L('index.huanyingdenglu');?>&nbsp;<?php echo C('web_name');?>&nbsp;<?php echo L('index.jiaoyipingtai');?></h2>
                    <dl>
                        <!--
                        <dt><?php echo L('index.ninzhengzaishiyongdezhanghaowei');?>:</dt>
                        <dd>
                            <a href="/finance" class="user-email"><?php echo (session('userName')); ?></a>
                        </dd>
                        -->
                        <dd>
                            <?php echo L('index.ninzhengzaishiyongdezhanghaowei');?>:
                             <a href="/finance" class="user-email"><?php echo (session('userName')); ?></a>
                        </dd>
                        
                        <dd>
                            ID：
                            <span class="user-id"><?php echo (session('userId')); ?></span>
                        </dd>
                        <dd>
                            <?php echo L('index.zongzichan');?>：
                            <span class="user-finance" id="user_finance">loading...</span>
                        </dd>
                        
                        <!--三个份额-->
                        <dd>
                            <?php echo L('index.kejiaoyie');?>：
                            <span class="user-finance" id="user_finance"><?php echo ($trade); ?></span>
                        </dd>
                        
                        <dd>
                            <?php echo L('index.keshangchangxiaofeie');?>:
                            <span class="user-finance" id="user_finance"><?php echo ($market); ?></span>
                        </dd>
                        
                        <dd>
                            <?php echo L('index.pingtaijijinzonge');?>:
                            <span class="user-finance" id="user_finance"><?php echo ($user_coin_found_total); ?></span>
                        </dd>
                        
                        
                    </dl>
                    <div class="login_box_2_btn">
                        <a href="/finance/mycz.html"><?php echo L('index.chongzhi');?></a>
                        <a href="/finance/mytx.html"><?php echo L('index.tixian');?></a>
                        <a href="/finance/mywt.html" class="w82"><?php echo L('index.weituoguanli');?></a>
                    </div>
                    <div class="gotocenter">
                        <a href="/finance/index.html" class="center"><?php echo L('index.qucaiwuzhongxin');?></a>
                    </div>
                    <div class="service_qq"></div>
                </div>
                <?php else: ?>
                <form id="form-login-i">
                    <div class="login_box_1">
                        <div class="login_title"><?php echo L('index.denglu');?></div>
                        <div class="login_text zin90">
                            <input type="text" id='index_username' value="" placeholder="<?php echo L('index.qingshuruzhanghao');?>"/>

                            <div id="email-err-i" class="prompt" style="display: none"></div>
                        </div>
                        <div class="login_text zin80">
                            <input type="password" id="index_password" value="" placeholder="<?php echo L('index.qingshurudenglumima');?>"/>

                            <div id="pw-err-i" class="prompt" style="display: none"></div>
                        </div>
                        <?php if(($C['login_verify']) == "1"): ?><div class="login_text zin70" id="ga-box-i">
                                <img id="codeImg reloadverifyindex" src="<?php echo U('Verify/code');?>" width="120" height="38" onclick="this.src=this.src+'?t='+Math.random()" style="margin-top: 1px; cursor: pointer;" title="换一张">
                                <input type="text" class="code" id="index_verify" name="code" placeholder="<?php echo L('index.qingshuruyanzhengma');?>" style="width: 106px; float: left;">
                            </div><?php endif; ?>
                        <div class="login_button">
                            <input type="button" value="<?php echo L('index.denglu');?>" onclick="upLoginIndex();"/>
                        </div>
                        <div class="login-footer">
                            <!--<a href="/"> <img src="/Public/Home/images/qq2.png">QQ<?php echo L('index.denglu');?></a> -->
      <span> <a href="<?php echo U('Login/register');?>"><?php echo L('index.mianfeizhuce');?></a> ｜ <a href="<?php echo U('Login/findpwd');?>"><?php echo L('index.wangjimima');?></a>
      </span>
                        </div>
                    </div>
                </form><?php endif; ?>
        </div>
    </div>
</div>
<div class="zhanwei"></div>
<div class="price_today">
    <div class="autobox">
        <ul class="price_today_ull">
            <li data-sort="0" style="cursor: default;"><?php echo L('index.jiaoyishichang');?></li>
            <li class="click-sort" data-sort="1" data-flaglist="0" data-toggle="0"><?php echo L('index.zuixinchengjiaojia');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="2" data-flaglist="0" data-toggle="0"><?php echo L('index.maiyijia');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="3" data-flaglist="0" data-toggle="0"><?php echo L('index.maiyijia18');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="6" data-flaglist="0" data-toggle="0"><?php echo L('index.chengjiaoliang');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="4" data-flaglist="0" data-toggle="0"><?php echo L('index.chengjiaoe');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li class="click-sort" data-sort="7" data-flaglist="0" data-toggle="0"><?php echo L('index.rizhangdie');?>
                <i class="cagret cagret-down"></i>
                <i class="cagret cagret-up"></i>
            </li>
            <li data-sort="0"><?php echo L('index.jiagequshi3ri');?></li>
            <li data-sort="0" style="width: 150px; text-align: center; text-indent: -1em;"><?php echo L('index.caozuo');?></li>
        </ul>
    </div>
</div>
<style type="text/css">
.safety_tipss{
        width: 1200px;
    padding-bottom: 20px;
    text-align: center;
    color: #333;
    font-family: Microsoft YaHei;
    margin-top: 10px;
    margin-right: auto;
    margin-left: auto;
    margin-bottom: 50px;
}
.safety_tipss_ul li {
    float: left;
    width: 200px;
    text-align: center;
}  
.safety_tipss h3 {
    line-height: 34px;
    font-size: 24px;
    margin-bottom: 50px;
}

.w142{
	width:160px;
}
</style>
<ul class="price_today_ul" id="price_today_ul"></ul>
<div class="safety_tipss" style=" background:#FFF;margin-top:50px;margin-bottom:50px">
<div style="width: 1200px; margin: 0 auto; margin-bottom: 10px;"></div>
<h3 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;font-size: 24px;color:#5A5A5A;text-align:center"><?php echo L('index.zhuanyedeanquanbaozhang');?></h3>
<div class="autobox">
<ul class="safety_tipss_ul clear">
<li><img src="/Public/Home/images/index_imges/1.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.xitongkekao');?></h4>
 
</li>
<li><img src="/Public/Home/images/index_imges/2.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.zijinanquan');?></h4>
 
</li>
<li><img src="/Public/Home/images/index_imges/3.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.fangbiankuaijie');?></h4>
 
</li>
<li><img src="/Public/Home/images/index_imges/4.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.fuwuzhuangye');?></h4>
 
</li>
<li><img src="/Public/Home/images/index_imges/5.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.jinyingtuandui');?></h4>
 
</li>
<li><img src="/Public/Home/images/index_imges/6.png" alt="" width="70" height="70">
<h4 style="font: 12px/1.5 Microsoft Yahei,tahoma,arial,宋体,sans-serif;color:#5A5A5A;font-size: 20px;"><?php echo L('index.shipanjiaoyi');?></h4>
 
</li>
</ul>
</div>
</div>
<div class="news_box">
    <div class="autobox">
       
        <div class="news_s">
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[0]['id']); ?>"><?php echo (get_lang_text($indexArticleType[0]['title'],$indexArticleType[0]['title_en'])); ?></a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <?php if(is_array($indexArticle[0])): $i = 0; $__LIST__ = $indexArticle[0];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a class="news_clua" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"><?php echo ($vo['title']); ?> </a>
                                <a class="news_clda" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"> [ <?php echo (date("y-m-d",$vo['addtime'])); ?> ] </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[0]['id']); ?>"> <?php echo L('index.gengduo');?>&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti news_ctin"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[1]['id']); ?>"><?php echo (get_lang_text($indexArticleType[1]['title'],$indexArticleType[1]['title_en'])); ?></a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <?php if(is_array($indexArticle[1])): $i = 0; $__LIST__ = $indexArticle[1];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a class="news_clua" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"><?php echo ($vo['title']); ?> </a>
                                <a class="news_clda" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"> [ <?php echo (date("y-m-d",$vo['addtime'])); ?> ] </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[1]['id']); ?>"> <?php echo L('index.gengduo');?>&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="news_sc">
                <div class="news_ct">
                    <div class="news_cti news_ctic"></div>
                    <div class="news_cts">
                        <a target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[2]['id']); ?>"><?php echo (get_lang_text($indexArticleType[2]['title'],$indexArticleType[2]['title_en'])); ?></a>
                    </div>
                </div>
                <div class="news_cl">
                    <ul class="news_clu">
                        <?php if(is_array($indexArticle[2])): $i = 0; $__LIST__ = $indexArticle[2];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <a class="news_clua" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"><?php echo ($vo['title']); ?> </a>
                                <a class="news_clda" target="_blank" href="<?php echo U('Article/detail','id='.$vo['id']);?>"> [ <?php echo (date("y-m-d",$vo['addtime'])); ?> ] </a>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        <li>
                            <a class="news_clda" target="_blank" href="/Article/index/id/<?php echo ($indexArticleType[2]['id']); ?>"> <?php echo L('index.gengduo');?>&gt;&gt; </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="coin_type" value="cny_btc"/>
<input type="hidden" name="amount" value="1000000"/>



<?php if(($C['index_lejimum']) == "1"): ?><div class="index_box_2 slogan">
    <div class="slogan_title"><?php echo L('index.xuanze'); echo C('web_title');?>,<?php echo L('index.anquankexinlai');?></div>
    <div class="slogan_tis"><?php echo L('index.leijijiaoyie');?><span id="yi" style="display: none;margin-left: 5px;" class="yiyi1"></span>
        <sapn style="display: none;" class="yiyi2"> <?php echo L('index.yi');?></sapn>
        <span id="wan"></span> <?php echo L('index.wan');?>
    </div>
    <div id="cumulative"></div>
</div>
<script src="/Public/Home/js/index_change.js"></script><?php endif; ?>


<!--<?php echo L('index.youqinglianjie');?>-->
<div class="link" style="    padding-top: 0px;">
    <div class="linkbox">
        <h4>
            <a target="_blank" href="/about/partner.html"><?php echo L('index.youqinglianjie');?></a>
        </h4>
        <ul>
            <?php if(is_array($indexLink)): $i = 0; $__LIST__ = $indexLink;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li style="margin-left: 0px;">
                    <a target="_blank" href="<?php echo ($vo['url']); ?>"><?php echo ($vo['title']); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
<script>
    //轮播图
    var $allItems = $('.my-carousel .my-carousel-inner .item');
    var $allIndicators = $('.my-carousel .my-carousel-indicators li');
    var currentIndex = 0;
    var currentItem = null;
    var nextItem = null;
    var time;


    $(".my-carousel").hover(function () {
        time = window.clearInterval(time)
    }, function () {
        time = setInterval(function () {
                    currentItem = $allItems.filter('.active');
                    if (currentIndex + 1 === $allItems.length) {
                        nextItem = $allItems.eq(0);
                        currentIndex = 0;
                    } else {
                        nextItem = $allItems.eq(currentIndex + 1);
                        currentIndex += 1;
                    }
                    nextItem.addClass('active').fadeIn(500);
                    $allIndicators.removeClass('active').eq(currentIndex).addClass('active');
                    currentItem.removeClass('active').fadeOut(1000);
                },
                5000);
    }).trigger("mouseleave");

    $(".my-carousel-indicators li").click(function () {
        var nextIndex = parseInt($(this).attr('data-slide-to'));
        if (nextIndex == currentIndex) return false;
        currentIndex = nextIndex;
        currentItem = $allItems.filter('.active');
        currentItem.removeClass('active').fadeOut(1000);
        $allItems.eq(currentIndex).addClass('active').fadeIn(500);
        $allIndicators.removeClass('active').eq(currentIndex).addClass('active');
    });


    $('.price_today_ull > .click-sort').each(function () {
        $(this).click(function () {
            click_sortList(this);
        })
    })

    function allcoin_callback(priceTmp) {
        for (var i in priceTmp) {
            var c = priceTmp[i][8];
            if (typeof (trends[c]) != 'undefined' && typeof (trends[c]['data']) != 'undefined' && trends[c]['data'].length > 0) {
                $.plot($("#" + c + "_plot"), [
                    {
                        shadowSize: 0,
                        data: trends[c]['data']
                    }
                ], {
                    grid: {borderWidth: 0},
                    xaxis: {
                        mode: "time",
                        ticks: false
                    },
                    yaxis: {
                        tickDecimals: 0,
                        ticks: false
                    },
                    colors: ['#f99f83']
                });
            }
        }
    }

    function click_sortList(sortdata) {
        var a = $(sortdata).attr('data-toggle');
        var b = $(sortdata).attr('data-sort');
        $(".price_today_ull > li").find('.cagret-up').css('border-bottom-color', '#848484');
        $(".price_today_ull > li").find('.cagret-down').css('border-top-color', '#848484');
        $(".price_today_ull > li").attr('data-flaglist', 0).attr('data-toggle', 0);
        $(".price_today_ull > li").css('color', '');
        $(sortdata).css('color', '#ff7950');

        if (a == 0) {
            priceTmp = priceTmp.sort(sortcoinList('dec', b));
            $(sortdata).find('.cagret-down').css('border-top-color', '#ff7950');
            $(sortdata).find('.cagret-up').css('border-bottom-color', '#848484');
            $(sortdata).attr('data-flaglist', 1).attr('data-toggle', 1)
        }
        else if (a == 1) {
            $(sortdata).attr('data-toggle', 0).attr('data-flaglist', 2);
            ;
            $(sortdata).find('.cagret-up').css('border-bottom-color', '#ff7950');
            $(sortdata).find('.cagret-down').css('border-top-color', '#848484');
            priceTmp = priceTmp.sort(sortcoinList('asc', b));
        }
        renderPage(priceTmp);
        change_line_bg('price_today_ul', 'li');
        allcoin_callback(priceTmp);
    }

    function trends() {
        $.getJSON('/Ajax/trends?t=' + rd(), function (d) {
            trends = d;
            allcoin();
        });
    }

    function allcoin(cb) {
        $.get('/Ajax/allcoin?t=' + rd(), cb ? cb : function (d) {
            ALLCOIN = d;
            var t = 0;
            var img = '';
            priceTmp = [];
            //把json转换为二维数组 进行渲染
            for (var x in d) {
                if (typeof(trends[x]) != 'undefined' && parseFloat(trends[x]['yprice']) > 0) {
                    rise1 = (((parseFloat(d[x][4]) + parseFloat(d[x][5])) / 2 - parseFloat(trends[x]['yprice'])) * 100) / parseFloat(trends[x]['yprice']);
                    rise1 = rise1.toFixed(2);
                } else {
                    rise1 = 0;
                }
                img = d[x].pop();
                d[x].push(rise1);
                d[x].push(x);
                d[x].push(img);
                priceTmp.push(d[x]);
            }
            //二次排序
            $('.price_today_ull > .click-sort').each(function () {
                var listId = $(this).attr('data-sort');
                if ($(this).attr('data-flaglist') == 1 && $(this).attr('data-sort') !== 0) {
                    priceTmp = priceTmp.sort(sortcoinList('dec', listId))
                } else if ($(this).attr('data-flaglist') == 2 && $(this).attr('data-sort') !== 0) {
                    priceTmp = priceTmp.sort(sortcoinList('asc', listId))
                }
            });
            renderPage(priceTmp);
            allcoin_callback(priceTmp);
            change_line_bg('price_today_ul', 'li');
            t = setTimeout('allcoin()', 5000);

        }, 'json');
    }

    function rd() {
        return Math.random()
    }
    //渲染函数
    function renderPage(ary) {
        var html = '';
        for (var i in ary) {
            var coinfinance = 0;
            if (typeof FINANCE == 'object') coinfinance = parseFloat(FINANCE.data[ary[i][8] + '_balance']);
            html += '<li><dl class="autobox clear"><dt><a href="/trade/index/market/' + ary[i][8] + '/">' +
                    '<img src="/Upload/coin/' + ary[i][9] + '" style="vertical-align: middle;margin-right: 5px;width: 19px; */height: 19px;height: 19px;">' + ary[i][0] + '</a></dt><dd class="orange" style="text-indent: 0.5em;">$' + ary[i][1] + '</dd><dd style="text-indent: 1.2rem;">$' + ary[i][2] + '</dd><dd style="text-indent: 1.5rem;">$' + ary[i][3] + '</dd><dd class="w142" style="    text-indent: 1.5rem;">' + formatCount(ary[i][6]) + '</dd><dd class="w142" style="    text-indent: 1.5rem;">' + formatCount(ary[i][4]) + '</dd><dd class="w142 ' + (ary[i][7] >= 0 ? 'red' : 'green') + '" style="    text-indent: 1.5rem;color:red">' + (parseFloat(ary[i][7]) < 0 ? '' : '+') + ((parseFloat(ary[i][7]) < 0.01 && parseFloat(ary[i][7]) > -0.01) ? "0.00" : ary[i][7]) + '%</dd><dd id="' + ary[i][8] + '_plot"  style="width:150px;height:35px;"></dd><dd class="w102" style="width:150px;text-align: center;text-indent: -1.5em;"><input type="button" value="<?php echo L('index.qujiaoyi');?>" onclick="top.location=\'/trade/index/market/' + ary[i][8] + '/\'" /></dd></dl></li>'
        }
        $('#price_today_ul').html(html);
    }
    //保留2位小鼠
    function formatCount(count) {
        var countokuu = (count / 100000000).toFixed(3)
        var countwan = (count / 10000).toFixed(3)
        if (count > 100000000)
            return countokuu.substring(0, countokuu.lastIndexOf('.') + 3) + '<?php echo L('index.yi');?>'
        if (count > 10000)
            return countwan.substring(0, countwan.lastIndexOf('.') + 3) + '<?php echo L('index.wan');?>'
        else
            return count
    }
    //移入行变色
    function change_line_bg(id, tag, nobg) {
        var oCoin_list = $('#' + id);
        var oC_li = oCoin_list.find(tag);
        var oInp = oCoin_list.find('input');
        var oldCol = null;
        var newCol = null;
        if (!nobg) {
            for (var i = 0; i < oC_li.length; i++) {
                oC_li.eq(i).css('background-color', i % 2 ? '#fff' : '#f8f8f8');
                oInp.mouseover(function () {
                    this.style.color = '#fff';
                    this.style.backgroundColor = '#e55600';
                });
                oInp.mouseout(function () {
                    this.style.color = '#e55600';
                    this.style.background = 'none';
                });
            }
        }
        oCoin_list.find(tag).hover(function () {
            oldCol = $(this).css('backgroundColor');
            $(this).css('background-color', '#f9f2dd');
        }, function () {
            $(this).css('background-color', oldCol);
        })
    }

    //排序函数
    function sortcoinList(order, sortBy) {
        var ordAlpah = (order == 'asc') ? '>' : '<';
        var sortFun = new Function('a', 'b', 'return parseFloat(a[' + sortBy + '])' + ordAlpah + 'parseFloat(b[' + sortBy + '])? 1:-1');
        return sortFun;
    }


    trends();


    var cookieValue = $.cookies.get('cookie_username');
    if (cookieValue != '' && cookieValue != null) {
        $("#index_username").val(cookieValue);
    }
    function upLoginIndex() {
        var username = $("#index_username").val();
        var password = $("#index_password").val();
        var verify = $("#index_verify").val();
        if (username == "" || username == null) {
            layer.tips('请输入用户名', '#index_username', {tips: 3});
            return false;
        }
        if (password == "" || password == null) {
            layer.tips('<?php echo L('index.qingshurudenglumima');?>', '#index_password', {tips: 3});
            return false;
        }

        $.post("<?php echo U('Login/submit');?>", {
            username: username,
            password: password,
            verify:verify,
        }, function (data) {
            if (data.status == 1) {
                $.cookies.set('cookie_username', username);
                layer.msg(data.info, {icon: 1});
                window.location = '/Finance';
            } else {
                //刷新验证码
                $(".reloadverifyindex").click();
                layer.msg(data.info, {icon: 2});
                if (data.url) {
                    window.location = data.url;
                }
            }
        }, "json");
    }
</script>
<script>
    //菜单高亮
    $('#index_box').addClass('active');
</script>
<div class="footer_con" style="margin: 0px auto;width: 1180px;">
    <div class="autobox clear" style="padding: 0px 20px;">
        <p style="width: 1165px;">
            <span><?php echo L('index.fengxianjinggao');?>：</span>
            <?php echo C('web_waring');?>
        </p>
    </div>
</div>
<style>
	.footer{
		clear:both;
	}

	.footer .main{
		height:240px;
	}

	#footer a{
		color:#FFF;
		margin:0px 0px;
	}

	.footer .bottom{
		height:80px;
		background:#2C2C2C;
	}

	.footer .main .list{
		float:left;
		margin-top:40px;
		width: 185px;
		padding: 0px 5px;
	}

	.footer .main .list label{
		margin-top:10px;
		display:block;
		font-weight:bold;
		color:#FFF;
		font-size:16px;
		text-align: left;
		padding-left: 45px;
	}

	.footer .main .list ul{
		margin:10px 0px 0px;
		padding:0px;
	}

	.footer .main .list li{
		display:block;
		height:30px;
		line-height:30px;
		color:#CCC;
		text-align:center;
		list-style:none;
		text-align: left;
		padding-left: 45px;
	}

	.footer .main .list li a{
		display:block;
		width:100%;
		height:100%;
		color:#CCC;
		font-size:14px;
	}

	.footer .about_me{
		float:left;
		margin-top:40px;
		width:280px;
		height:150px;
		border-right:1px #606060 solid;
		padding-right:50px;
	}

	.footer .wx{
		margin-top:50px;
		height:55px;
	}

	.footer .wx a{
		position:relative;
		margin:0 14px;
		cursor:pointer;
	}

	.footer .wx a img{

		left:-69px;

		transition:300ms;
		-webkit-transition:300ms;
		-ms-transition:300ms;
		-o-transition:300ms;
		-moz-transition:300ms;
	}

	.footer .wx a:hover img{
		display:block;
		top:-180px;
	}

	.footer .footer_wx_icon{
		float:left;

		border-radius:55px;
		-webkit-border-radius:55px;
		-ms-border-radius:55px;
		-o-border-radius:55px;
		-moz-border-radius:55px;

		transition:300ms;
		-webkit-transition:300ms;
		-ms-transition:300ms;
		-o-transition:300ms;
		-moz-transition:300ms;
	}

	.footer .footer_wx_icon:hover{

	}

	.footer .footer_sn_icon{
		float:left;
		width:55px;
		height:55px;

		background-color:#34353A;

		border-radius:55px;
		-webkit-border-radius:55px;
		-ms-border-radius:55px;
		-o-border-radius:55px;
		-moz-border-radius:55px;

		transition:300ms;
		-webkit-transition:300ms;
		-ms-transition:300ms;
		-o-transition:300ms;
		-moz-transition:300ms;
	}

	.footer .footer_sn_icon:hover{

		background-color:#F00;
	}

	.footer .footer_qq_icon{
		float:left;
		width:55px;
		height:55px;

		background-color:#34353A;

		border-radius:55px;
		-webkit-border-radius:55px;
		-ms-border-radius:55px;
		-o-border-radius:55px;
		-moz-border-radius:55px;

		transition:300ms;
		-webkit-transition:300ms;
		-ms-transition:300ms;
		-o-transition:300ms;
		-moz-transition:300ms;
	}

	.footer .footer_qq_icon:hover{

		background-color:#F00;
	}

	.footer .about_me h4{
		margin:10px 0px 0px 44px;
		color:#FFF;
		font-size:14px;
		font-weight:normal;
	}

	.footer .about_me .about_me_text{
		margin-top:20px;
		margin-left:44px;
		font-size:14px;
		color:#CCC;
	}

	.footer .contact_us{
		float:left;
		margin-top:50px;
		padding-left:57px;
		border-left:1px #606060 solid;
		height:150px;
		color:#CCC;
		font-size:14px;
	}

	.footer .contact_us_text1{
		margin-top:6px;
		font-size:28px;
		color:#FFF;
	}

	.footer .contact_us_text2{
		margin-top:5px;
		font-size:12px;
	}

	.footer .contact_us_text3 span{
		float:left;
		line-height:31px;
	}

	.footer .contact_us_text3{
		margin-top:18px;
		display:block;
		color:#CCC;
	}

	.footer .contact_us_text3 i{
		display:block;
		float:left;
		margin-left:10px;
		width:32px;
		height:30px;
		cursor:pointer;
		border:1px #CCC solid;

		border-radius:16px;
		-webkit-border-radius:16px;
		-ms-border-radius:16px;
		-o-border-radius:16px;
		-moz-border-radius:16px;

		transition:300ms;
		-webkit-transition:300ms;
		-ms-transition:300ms;
		-o-transition:300ms;
		-moz-transition:300ms;

	}

	.footer .contact_us_text3 i:hover{
		border:1px #DB0015 solid;
		background-color:#DB0015;
	}

	.footer .bottom .text{
		float:left;
		margin-top:34px;
		color:#999;
		font-size:14px;
	}

	.footer .bottom .g{
		float:right;
		margin-right:10px;
	}

	.footer .bottom .g a{
		float:left;
		margin-left:20px;
		margin-top:24px;
		width:100px;
		height:36px;
	}
</style>
<footer id="footer" class="footer" style="padding: 0px 0px 20px 0px;">
	<section class="main">
		<div class="about_me">
			<div class="wx">
				<a href="javascript:" class="footer_wx_icon"><img src="/Upload/public/<?php echo ($C['footer_logo']); ?>"></a>
			</div>
		</div>
		<div class="layout_center">
			<?php if(is_array($footerArticleType)): $i = 0; $__LIST__ = $footerArticleType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list"><label><?php echo (get_lang_text($vo['title'],$vo['title_en'])); ?></label>
					<ul>
						<?php if(is_array($footerArticle[$vo['name']])): $i = 0; $__LIST__ = $footerArticle[$vo['name']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/index',array('id'=>$vvo['id']));?>" style="overflow: hidden;"><?php echo ($vvo['title']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						<li><a href="<?php echo U('Article/index',array('id'=>$vo['id']));?>" style="overflow: hidden;    text-align: left;"><?php echo L('public.gengduo');?></a></li>
					</ul>
				</div><?php endforeach; endif; else: echo "" ;endif; ?>





			<div class="contact_us">
				<div class="contact_us_text0" style="text-align: left;"><?php echo L('public.mianfeizixun');?> :</div>
				<div class="contact_us_text1" style="text-align: left;margin-top: 10px;margin-bottom: 12px;"><?php echo C('contact_moble');?></div>
				<div class="contact_us_text2" style="text-align: left;margin-bottom: 5px;"><?php echo L('public.gongzuoshijian');?></div>
				<?php $_result=C('contact_qqun');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="#" class="contact_us_text3"><span><?php echo L('public.huiyuanqunhao');?> :<?php echo ($i); echo L('public.qun');?>：<?php echo ($v); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
	</section>
</footer>
<div class="footer_bottom">
	<div class="autobox" style="height: 40px;margin-top: 5px;">
		<span style="display: inline-block;color:#A6A9AB;">CopyRight© 2013-2016 <?php echo ($C['web_name']); echo L('public.jiaoyipingtai');?> All Rights Reserved &nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" target="_blank"><?php echo ($C['web_icp']); ?></a><span style="display: inline-block; color:#A6A9AB"></span></span>
		<span style="float: right;">
			<a href="http://www.gov.cn/" target="_blank" class="margin10" style="margin-left:5px;"> <img src="/Upload/footer/footer_1.png">
			</a>
			<a href="http://www.szfw.org/" target="_blank" class="margin10" style="margin-left:5px;"> <img src="/Upload/footer/footer_2.png">
			</a>
			<a href="http://www.miibeian.gov.cn/" target="_blank" class="margin10" style="margin-left:5px;"><img src="/Upload/footer/footer_3.png">
			</a>
			<a href="http://www.cyberpolice.cn/" target="_blank" class="margin10" style="margin-left:5px;"><img src="/Upload/footer/footer_4.png">
			</a>
		</span>
	</div>
	<!-- 原安全验证位置 -->
</div>

<!--客服qq-->

<div id="all_mask" class="all_mask" style="height: 0px; display: none;"></div>
<div class="all_mask_loginbox" style="top: 313px; display: none;">
	<div class="login_title pl20"><?php echo L('public.denglu');?></div>
	<form id="form-login" class="mask_wrap login-fb">
		<div class="login_text zin90">
			<div class="mask_wrap_title"><?php echo L('public.zhanghao');?>：</div>
			<input id="login_username" name="username" type="text" placeholder="<?php echo L('public.shuruhuiyuanming');?>">
		</div>
		<div class="login_text zin80">
			<div class="mask_wrap_title"><?php echo L('public.mima');?>：</div>
			<input id="login_password" name="password" type="password" placeholder="<?php echo L('public.shurudenglumima');?>">
		</div>
		<?php if(($C['login_verify']) == "1"): ?><div class="login_text zin70" id="ga-box-i">
				<img id="codeImg reloadverifyindex" src="<?php echo U('Verify/code');?>" width="120" height="38" onclick="this.src=this.src+'?t='+Math.random()" style="margin-top: 1px; cursor: pointer;" title="<?php echo L('public.huanyizhang');?>">
				<input type="text" class="code" id="login_verify" name="code" placeholder="<?php echo L('public.shuruyanzhengma');?>" style="width: 106px; float: left;">
			</div><?php endif; ?>
		<div class="login_button">
			<input type="button" value="<?php echo L('public.denglu');?>" onclick="upLogin();">
		</div>
		<div class="login-footer wwxwwx" style="border-bottom-left-radius: 3px; border-bottom-right-radius: 3px;">
			<!--<a target="_blank" href="/"><img src="/Public/Home/images/qq2.png" style="vertical-align: text-bottom; padding-right: 5px;">zzQQ<?php echo L('public.denglu');?></a>-->

			<span style="color: #CCC; float: right; margin-right: 25px;">
			<a style="font-size: 12px;" href="<?php echo U('Login/register');?>"><?php echo L('public.mianfeizhuce');?></a>｜<a href="<?php echo U('Login/findpwd');?>" style="font-size: 12px;"><?php echo L('public.wangjimima');?></a></span>
		</div>
	</form>
	<div class="mask_wrap_close" onclick="wrapClose()"></div>
</div>
<script type="text/javascript" src="/Public/Home/js/jquery.cookies.2.2.0.js"></script>
<script>
	$('input').focus(function () {
		var t = $(this);
		if (t.attr('type') == 'text' || t.attr('type') == 'password')
			t.css({'box-shadow': '0px 0px 3px #1583fb', 'border': '1px solid #1583fb', 'color': '#333'});
		if (t.val() == t.attr('placeholder'))
			t.val('');
	});
	$('input').blur(function () {
		var t = $(this);
		if (t.attr('type') == 'text' || t.attr('type') == 'password')
			t.css({'box-shadow': 'none', 'border': '1px solid #e1e1e1', 'color': '#333'});
		if (t.attr('type') != 'password' && !t.val())
			t.val(t.attr('placeholder'));
	});


	function NumToStr(num) {
		if (!num) return num;
		num = Math.round(num * 100000000) / 100000000;
		num = num.toFixed(8);
		var min = 0.0001;
		var times = 0;
		var arr;
		if (num <= min) {
			times = 0;
			while (num <= min) {
				num *= 10;
				times++;
				if (times > 100) break;
			}
			num = num + '';
			arr = num.split(".");
			for (var i = 0; i < times; i++) {
				arr['1'] = '0' + arr['1'];
			}
			return arr[0] + '.' + arr['1'] + '';
		}
		return num.toFixed(8) + ' ';
	}


	function loginpop() {
		$('.all_mask').css({'height': $(document).height()});
		$('.all_mask').show();
		$('.all_mask_loginbox').show();
		$(".reloadverify").click();
	}

	var is_login = <?php echo (session('userId')); ?>
	;

	if (window.location.hash == '#login') {
		if (!is_login) {
			loginpop();
		}
	}

	if (is_login) {
		$.getJSON("/Ajax/allfinance?t=" + Math.random(), function (data) {

			$('#user_finance').html(data);
		});
	}


	function wrapClose() {
		$('.all_mask').hide();
		$('.all_mask_loginbox').hide();
	}

	var cookieValue = $.cookies.get('cookie_username');
	if (cookieValue != '' && cookieValue != null) {
		$("#login_username").val(cookieValue);
	}

	function upLogin() {
		var username = $("#login_username").val();
		var password = $("#login_password").val();
		var verify = $("#login_verify").val();
		if (username == "" || username == null) {
			layer.tips('<?php echo L('public.shuyonghuming');?>', '#login_username', {tips: 3});
			return false;
		}
		if (password == "" || password == null) {
			layer.tips('<?php echo L('public.shurudenglumima');?>', '#login_password', {tips: 3});
			return false;
		}

		$.post("<?php echo U('Login/submit');?>", {
			username: username,
			password: password,
			verify: verify,
		}, function (data) {
			if (data.status == 1) {
				$.cookies.set('cookie_username', username);
				layer.msg(data.info, {icon: 1});
				window.location = '/Finance';
			} else {
				//刷新验证码
				$(".reloadverifyindex").click();
				layer.msg(data.info, {icon: 2});
				if (data.url) {
					window.location = data.url;
				}
			}
		}, "json");
	}
</script></body></html>