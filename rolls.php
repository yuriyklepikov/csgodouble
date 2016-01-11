<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rolls - CSGODouble</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/old-buttons.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

	<link href="css/mine.css?v=5" rel="stylesheet">
	<!-- <link href="css/dark.css" rel="stylesheet"> -->

	<link rel="shortcut icon" href="favicon.ico">

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootbox.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.js"></script>
	<script src="js/tinysort.js"></script>
	<script src="js/expanding.js"></script>
	<style>

	</style>
	<script>
		var SETTINGS = ["confirm","sounds","dongers"];
		function inlineAlert(x,y){
			$("#inlineAlert").removeClass("alert-success alert-danger alert-warning hidden");
			if(x=="success"){
				$("#inlineAlert").addClass("alert-success").html("<i class='fa fa-check'></i><b> "+y+"</b>");
			}else if(x=="error"){
				$("#inlineAlert").addClass("alert-danger").html("<i class='fa fa-exclamation-triangle'></i> "+y);
			}else if(x=="cross"){
				$("#inlineAlert").addClass("alert-danger").html("<i class='fa fa-times'></i> "+y);
			}else{
				$("#inlineAlert").addClass("alert-warning").html("<b>"+y+" <i class='fa fa-spinner fa-spin'></i></b>");
			}
		}
		function resizeFooter(){
			var f = $('.footer').outerHeight(true);
			var w = $(window).outerHeight(true);
			$('body').css('margin-bottom',f);
		}
		$(window).resize(function(){
			resizeFooter();
		});
		if (!String.prototype.format) {
			String.prototype.format = function() {
				var args = arguments;
				return this.replace(/{(\d+)}/g, function(match, number) {
					return typeof args[number] != 'undefined'
						? args[number]
						: match
						;
				});
			};
		}
		function setCookie(key,value){
			var exp = new Date();
			exp.setTime(exp.getTime()+(365*24*60*60*1000));
			document.cookie = key+"="+value+"; expires="+exp.toUTCString();
		}
		function getCookie(key){
			var patt = new RegExp(key+"=([^;]*)");
			var matches = patt.exec(document.cookie);
			if(matches){
				return matches[1];
			}
			return "";
		}
		function formatNum(x){
			if(Math.abs(x)>=10000){
				return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
			}
			return x;
		}
		$(document).ready(function(){
			resizeFooter();
			for(var i=0;i<SETTINGS.length;i++){
				var v = getCookie("settings_"+SETTINGS[i]);
				if(v=="true"){
					$("#settings_"+SETTINGS[i]).prop("checked",true);
				}else if(v=="false"){
					$("#settings_"+SETTINGS[i]).prop("checked",false);
				}
			}
		});
	</script>
	<style>

	</style>
	<script type="text/javascript">


	</script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSGODouble" height="34" style="margin-top:8px;margin-bottom:8px;margin-right:5px" src="img/just.png"></a> -->
			<a class="navbar-brand" href="./">CSGODouble.com</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="" style="margin-left:5px"><a href="./">Home</a></li>
				<li class=""><a href="deposit.php">Deposit</a></li>
				<li class=""><a href="withdraw.php">Withdraw</a></li>
				<li class=""><a href="rolls.php">Provably Fair</a></li>
				<li class=""><a href="affiliates.php">Affiliates</a></li>
				<li><a href="#" data-toggle="modal" data-target="#promoModal">Free Coins</a></li>
				<li class=""><a href="support.php">Support</a></li>

				<li class=""><a target="_blank" href="https://www.facebook.com/csgodoubledotcom"><i class="fa fa-facebook"></i></a></li>
				<li class=""><a target="_blank" href="https://twitter.com/csgodouble"><i class="fa fa-twitter"></i></a></li>
				<li class=""><a target="_blank" href="http://steamcommunity.com/groups/csgodoubledotcom"><i class="fa fa-steam"></i></a></li>

			</ul>
			<ul class="nav navbar-nav navbar-right">
				<a href='?login'><img style="margin-top:3px;" src='img/green.png'></a>
			</ul>
		</div>
	</div>
</nav>
<div class="modal fade" id="settingsModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Change Your Settings</b></h4>
			</div>
			<div class="modal-body">
				<form>

					<div class="checkbox">
						<label>
							<input type="checkbox" id="settings_confirm" checked>
							<strong>Confirm all bets over 10,000 coins</strong>
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" id="settings_sounds" checked>
							<strong>Enable sounds</strong>
						</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" id="settings_dongers">
							<strong>Display in $ amounts</strong>
						</label>
					</div>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="saveSettings()">Save Changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="promoModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Redeem Promo Code</b></h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">Promo Code</label>
					<input type='text' class='form-control' id='promocode' value=''>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="redeem()">Redeem</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="chatRules">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Chat Rules</b></h4>
			</div>
			<div class="modal-body" style="font-size:24px">
				<ol>
					<li>No Spamming</li>
					<li>No Begging for Coins</li>
					<li>No Posting Promo Codes</li>
					<li>No Promo Codes in Profile Name</li>
					<li style='color:red'>No Selling/Advertising "Predictions"</li>
				</ol>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-block" data-dismiss="modal">Got it</button>
			</div>
		</div>
	</div>
</div>
<script>
	function saveSettings(){
		for(var i=0;i<SETTINGS.length;i++){
			setCookie("settings_"+SETTINGS[i],$("#settings_"+SETTINGS[i]).is(":checked"));
		}
		$("#settingsModal").modal("hide");
		if($("#settings_dongers").is(":checked")){
			$("#balance").html("please reload");
		}else{
			$("#balance").html("please reload");
		}
	}
	function redeem(){
		var code = $("#promocode").val();
		$.ajax({
			url:"/scripts/_redeem.php?code="+code,
			success:function(data){
				try{
					data = JSON.parse(data);
					if(data.success){
						bootbox.alert("Success! You've received "+data.credits+" credits.");
					}else{
						bootbox.alert(data.error);
					}
				}catch(err){
					bootbox.alert("Javascript error: "+err);
				}
			},
			error:function(err){
				bootbox.alert("AJAX error: "+err);
			}
		});
	}
</script>		<div class="container">


	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b>Provably Fair <i class="fa fa-lock"></i></b></h3>
		</div>
		<div class="panel-body">




			<p>
				All rolls on CSGODouble are generated using a provably fair system. This means the operators cannot manipulate the outcome of any roll.
				Each roll is generated in part using the results of the
				<a href="http://www.lotteryusa.com/lottery/NY/NYtake5_f10.html" target="_blank">New York Lottery's Take 5</a> game.
				Players may replicate any past roll using the below code:
			</p>

				                    <pre>$server_seed = "39b7d32fcb743c244c569a56d6de4dc27577d6277d6cf155bdcba6d05befcb34";
$lotto = "0422262831";
$round_id = "1";
$hash = hash("sha256",$server_seed."-".$lotto."-".$round_id);
$roll = hexdec(substr($hash,0,8)) % 15;
echo "Round $round_id = $roll";</pre>

			<p>
				You can execute PHP code straight from your web browser with tools like <a href="http://www.phptester.net/" target="_blank">PHP Tester</a>.
				Simply copy-paste the code into the window and replace the server_seed, lotto, and round_id values for your own.
				Execute the code to verify the roll.
			</p>

			<p>For more information about provably fair <a href="faq.php">visit our FAQ page</a> or feel free to <a href="contact.php">contact us.</a></p>

		</div>
	</div>

	<table class='table table-bordered table-striped'><thead><tr><th>Date</th><th>Server Seed</th><th>Lottery</th><th>Rolls</th></tr></thead><tbody><tr><td>2016-01-11</td><td><b class='text-danger'><i class='fa fa-lock fa-fw'></i> SERVER SEED IN USE</b></td><td>1126283135</td><td><a href='?date=2016-01-11'>138351-138950</a></td></tr><tr><td>2016-01-10</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 774276dd3484551d0d26e1021285d8e219f7561bda8159346aeaf5cf473764e2</b></td><td>1023272938</td><td><a href='?date=2016-01-10'>137036-138350</a></td></tr><tr><td>2016-01-09</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 199dc677bb2de80a637878e1ce976c0df5d35aecf360448af7eded942f1ac923</b></td><td>0231323438</td><td><a href='?date=2016-01-09'>135716-137035</a></td></tr><tr><td>2016-01-08</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> ef4d7e033b046b379ea99853dfd6756c14f76d14d03e502fa997e661f5ce3700</b></td><td>1114293234</td><td><a href='?date=2016-01-08'>134192-135715</a></td></tr><tr><td>2016-01-07</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 5c05a74abf07a13c689763bb1c1713860a26150f1da176a2a99249d6ea906bf7</b></td><td>0203131725</td><td><a href='?date=2016-01-07'>132771-134191</a></td></tr><tr><td>2016-01-06</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> a41cdaef50721acd91d19f4fd8d258a28f1bf77ca99974df8443a903b53c8881</b></td><td>0103041931</td><td><a href='?date=2016-01-06'>131231-132770</a></td></tr><tr><td>2016-01-05</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> eff9c9daeafd850e41f14f9a40edad8de54992e966af600b8e79f1eb6628bf83</b></td><td>0207103839</td><td><a href='?date=2016-01-05'>129633-131230</a></td></tr><tr><td>2016-01-04</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 9b71eb47d6450c8fdcba5270b29bf9f2a9d538c4f4fe1eac3e25986f3ff1858c</b></td><td>0910132224</td><td><a href='?date=2016-01-04'>128498-129632</a></td></tr><tr><td>2016-01-03</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e8d81a758c065899b7400a5c041888ce975541c11ff4f00808d545dd4e22336b</b></td><td>0203152231</td><td><a href='?date=2016-01-03'>126909-128497</a></td></tr><tr><td>2016-01-02</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 11a4939e2d3e5c38aa282bac6861a3259e59ae054a0cae5ebc8d8f721a88a3a3</b></td><td>0104091032</td><td><a href='?date=2016-01-02'>125283-126908</a></td></tr><tr><td>2016-01-01</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 31566c8c9b1bba996f491c6102619687b668a0236f75745857371038c4c3f196</b></td><td>0209253738</td><td><a href='?date=2016-01-01'>123642-125282</a></td></tr><tr><td>2015-12-31</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 62ba283a064dda0ca0b616600ca0453cfff3e243b8caa6faf11ecca9c423b54d</b></td><td>0305111427</td><td><a href='?date=2015-12-31'>121986-123641</a></td></tr><tr><td>2015-12-30</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 69aedfb94e2abc59e01c3b346e58a0da0ffc1a0efc93d0a3427270095e1e7cdd</b></td><td>1016171938</td><td><a href='?date=2015-12-30'>120794-121985</a></td></tr><tr><td>2015-12-29</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 04b0b302d772ad3d9f9bd0dccb35bcf4c193b75d2087c43154796c49e33eadc3</b></td><td>1718242732</td><td><a href='?date=2015-12-29'>118978-120793</a></td></tr><tr><td>2015-12-28</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> f8886c304cf67647f8f57d4ef0cdf80567f7f59bac44b7c51b2efd89bf057b47</b></td><td>0209101327</td><td><a href='?date=2015-12-28'>117021-118977</a></td></tr><tr><td>2015-12-27</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> ae8f36533c0088b8298fbc62ce7e0f6ea5fbdc5b6b313fb5dca6417c0185101b</b></td><td>0829303439</td><td><a href='?date=2015-12-27'>114997-117020</a></td></tr><tr><td>2015-12-26</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 6bf965e24293f757051c90e8dc6ffe6611f49dec135e0bae0310e40798a65142</b></td><td>0913141733</td><td><a href='?date=2015-12-26'>112940-114996</a></td></tr><tr><td>2015-12-25</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 683cb41aa2ae16066c7ca90c2d7acbbbef8bf2fecee815b785bfb470aa77bf3b</b></td><td>0917212230</td><td><a href='?date=2015-12-25'>110928-112939</a></td></tr><tr><td>2015-12-24</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> ed23e6676a0dea00dc841e958bb8ab009aea11dffbec11141d84352da6a351ae</b></td><td>2829333639</td><td><a href='?date=2015-12-24'>108853-110927</a></td></tr><tr><td>2015-12-23</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> a4e98413f28ece064a31df8c213b209caf6a138c90c0f63dbae7e51bbcfb34bb</b></td><td>0609113539</td><td><a href='?date=2015-12-23'>106787-108852</a></td></tr><tr><td>2015-12-22</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 8188228cfe4e7e430cdaf92133c2614e2d411c1ba6d1d0e93176bf011b6389f3</b></td><td>0408163539</td><td><a href='?date=2015-12-22'>104719-106786</a></td></tr><tr><td>2015-12-21</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> b19fce2b0abda83c0b5c8719f3c69b7e94f6f45de0f9c6add918bb11aa87f1a3</b></td><td>0809151733</td><td><a href='?date=2015-12-21'>102671-104718</a></td></tr><tr><td>2015-12-20</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 3829bd13c850d435b3977e40e997c502ff930f510386b35d0dcec94d3db35919</b></td><td>0206071632</td><td><a href='?date=2015-12-20'>100671-102670</a></td></tr><tr><td>2015-12-19</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> f925a74f4d44b944df6efe2f930d57275b81336bb43f9bf1146d09f84521ac31</b></td><td>1315253435</td><td><a href='?date=2015-12-19'>98638-100670</a></td></tr><tr><td>2015-12-18</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 7345487cf5ce81d9e6905c6e132e80f9e3040f598507868dc66398499613db46</b></td><td>0314232733</td><td><a href='?date=2015-12-18'>96569-98637</a></td></tr><tr><td>2015-12-17</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 5bbadd7b6dad1cc47e32d2b1f0920fd1ea678503c860d17a82a7c2dea893ab42</b></td><td>1416212229</td><td><a href='?date=2015-12-17'>94476-96568</a></td></tr><tr><td>2015-12-16</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> b8a2404f33a5c2cc8cecded6b994c9867f4c50a4790b6525c35e158beeabeab6</b></td><td>0811203236</td><td><a href='?date=2015-12-16'>92367-94475</a></td></tr><tr><td>2015-12-15</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> c340711d70bf379e86bbe596640fc64b25d45334ddd1d50262a3dfce32d56d44</b></td><td>1014213138</td><td><a href='?date=2015-12-15'>90258-92366</a></td></tr><tr><td>2015-12-14</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> d9da5dc11f7a8fea37dcd00fc537668e0f00e8fc453afadee636d1de0d2c9def</b></td><td>1420232637</td><td><a href='?date=2015-12-14'>88200-90257</a></td></tr><tr><td>2015-12-13</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 0b6aa47caa47092bc15e934d39a4d223e514147025e21ec2aca6ca4a03f879bd</b></td><td>0509232534</td><td><a href='?date=2015-12-13'>86100-88199</a></td></tr><tr><td>2015-12-12</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 5a57ee33e73339a7b426d8be0ca06dd8ed4c9bccc1589c79d0f2d3cf97a533f7</b></td><td>0117223036</td><td><a href='?date=2015-12-12'>84002-86099</a></td></tr><tr><td>2015-12-11</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 79208b189ad5a328d5e1bc3c605bb081645e1e3c90de1da1fb77e6df22dc611b</b></td><td>0306172234</td><td><a href='?date=2015-12-11'>81877-84001</a></td></tr><tr><td>2015-12-10</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e064be8a75d8d285aabbec342a36b5df8d1ea6e2c4a9c9a247c2802b25f9275f</b></td><td>1215262931</td><td><a href='?date=2015-12-10'>79762-81876</a></td></tr><tr><td>2015-12-09</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 86864953323af7b14ed286b79e53fbb19120ec8054a26c1d4a19a41b3ac3100b</b></td><td>0708092232</td><td><a href='?date=2015-12-09'>77658-79761</a></td></tr><tr><td>2015-12-08</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 6a8d2f900afd69e36256d5a4cce93d540e46806b7c5351b177ab8fd3efdd46bb</b></td><td>1222273437</td><td><a href='?date=2015-12-08'>75593-77657</a></td></tr><tr><td>2015-12-07</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> fbe25c0142998762f0c7aee411683bcae0cc04737c6697c22cfa9502a5ecbb81</b></td><td>0405122632</td><td><a href='?date=2015-12-07'>73857-75592</a></td></tr><tr><td>2015-12-06</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> de9a8e702965deb485454c859f0ded0569700213c8bed5377198dccbb516bc01</b></td><td>1331323336</td><td><a href='?date=2015-12-06'>71946-73856</a></td></tr><tr><td>2015-12-05</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 2d5b90b84ef253c6fce5bc463987d04c8d9f0a834eadbdd3cb2cfc8b75559a2d</b></td><td>0910232634</td><td><a href='?date=2015-12-05'>70260-71945</a></td></tr><tr><td>2015-12-04</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 0a65ca74542d0b7cbe6e1f0fd7f9ec3e489afdf3e8a6f9c5d6d02dbb7373d4ca</b></td><td>0115253639</td><td><a href='?date=2015-12-04'>68286-70259</a></td></tr><tr><td>2015-12-03</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 317bc89dafe48d900c100b5666368b2373a1516c0c80e42ed331930973e63596</b></td><td>1314172530</td><td><a href='?date=2015-12-03'>66213-68285</a></td></tr><tr><td>2015-12-02</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> b4fda210a733db4d377f68b6b8110760ba5e0d94c1c32484baec8f0f1a247287</b></td><td>0618333738</td><td><a href='?date=2015-12-02'>64327-66212</a></td></tr><tr><td>2015-12-01</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e76bb7d4955c67bec454fc26dd3094475a448bc2897ccb00d1d8ecf5a7e21cf8</b></td><td>1419353637</td><td><a href='?date=2015-12-01'>62620-64326</a></td></tr><tr><td>2015-11-30</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 30a463b56ad931f325bb77f6e7035787c1102dc0a3a02375f17837651409dbcb</b></td><td>0322242634</td><td><a href='?date=2015-11-30'>60669-62619</a></td></tr><tr><td>2015-11-29</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 69c98c45fdc3c6fe3dc380e3aab3c7aaf17ae099beb570defb28107fcdc6c66b</b></td><td>0512222329</td><td><a href='?date=2015-11-29'>58666-60668</a></td></tr><tr><td>2015-11-28</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 6aceb97ce11ba1a5c0af95730c067ca7e94d5bbb00e687cec0c9be35b5b06998</b></td><td>0914243337</td><td><a href='?date=2015-11-28'>56296-58665</a></td></tr><tr><td>2015-11-27</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 9e3cf939e277e9fed07a22b8607241d1f5245fe812e06b4bf51240dd832f79f5</b></td><td>1012131522</td><td><a href='?date=2015-11-27'>53907-56295</a></td></tr><tr><td>2015-11-26</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> d73b8f07e651023fed6681296998e4111f5f4273b6b8b317b6c5c023034a0ab1</b></td><td>0510111935</td><td><a href='?date=2015-11-26'>51430-53906</a></td></tr><tr><td>2015-11-25</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 76286b09ae4940a0fda890d7a79b96e62fad1d7be394161ae3e75805ee7d1c47</b></td><td>0104093133</td><td><a href='?date=2015-11-25'>49108-51429</a></td></tr><tr><td>2015-11-24</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 6e1369411f1e46bfa4b9efe88868c40c2576dbb59dc1634cdc50e7e3cc9cbfa7</b></td><td>0510242638</td><td><a href='?date=2015-11-24'>46427-49107</a></td></tr><tr><td>2015-11-23</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 8eb763b7cf70b6e141327600835468dd4974478fc4f8f7080ba4b24da4f24be1</b></td><td>1416283137</td><td><a href='?date=2015-11-23'>44334-46426</a></td></tr><tr><td>2015-11-22</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 32cd68da8f20309ef23a7b572f336c70d5b3e4a227aef689d886075ba8303bf0</b></td><td>1719272832</td><td><a href='?date=2015-11-22'>42508-44333</a></td></tr><tr><td>2015-11-21</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 4f5299d6e15e530e63bb8f81c6860f6ff00d1cfab3112d59ebf3cc122a6cb94d</b></td><td>1718222629</td><td><a href='?date=2015-11-21'>40170-42507</a></td></tr><tr><td>2015-11-20</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 4a6bf2645540500a8e97a52ad2dc1e4aaef3db0252ad58bd546511a3564ad74b</b></td><td>0711171932</td><td><a href='?date=2015-11-20'>37656-40169</a></td></tr><tr><td>2015-11-19</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 03d54c570125e19b78f3c4911eefb3fc165d110f250bd9b3856bb0cf187ba653</b></td><td>0717313539</td><td><a href='?date=2015-11-19'>35035-37655</a></td></tr><tr><td>2015-11-18</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> ca1c5349d267e6ade7dd4d6ce120bb2be2fd7e5676aa063cf5bae13ecc350214</b></td><td>1420212836</td><td><a href='?date=2015-11-18'>34475-35034</a></td></tr><tr><td>2015-11-17</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 81aca4208f922c3e3b89044a3483c9bf43353cd205d8bf79e7cee21a5885ba12</b></td><td>0512132022</td><td><a href='?date=2015-11-17'>34318-34474</a></td></tr><tr><td>2015-11-16</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> b639afbd9b221f92781c9f3b77f063d2f08484dc88b435408b625af464689c4d</b></td><td>0414192438</td><td><a href='?date=2015-11-16'>33868-34317</a></td></tr><tr><td>2015-11-15</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 69bb85545e0bff86b0bba69b9316558ee35891c14d09ba9b51239e0f4afd3721</b></td><td>0314172434</td><td><a href='?date=2015-11-15'>33592-33867</a></td></tr><tr><td>2015-11-14</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e05c3a40c84f7ad5bd00d98595e0053e9edbd89ace2e91691fca31a769b8bc9f</b></td><td>0319222427</td><td><a href='?date=2015-11-14'>33385-33591</a></td></tr><tr><td>2015-11-13</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> d5a42e3bd7e68651aae4de9347abc9f57bc55946fdffb21fc540b15b7a5bab2a</b></td><td>0308102126</td><td><a href='?date=2015-11-13'>32158-33384</a></td></tr><tr><td>2015-11-12</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> c146c0303211c277c3c4c60b1738087aea818e214b2cc7c985955e8a478db9b8</b></td><td>0527283234</td><td><a href='?date=2015-11-12'>31169-32157</a></td></tr><tr><td>2015-11-11</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 73bbb6b24cfe5cd95b647c4b4b79a70c5abdc65f1af2ddd6a78a3d5db6092dfb</b></td><td>0811172738</td><td><a href='?date=2015-11-11'>30102-31168</a></td></tr><tr><td>2015-11-10</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 49f4076836be8b18ed267df33381092a8ffd4c4b27dfe6526ee38a24d160bb38</b></td><td>1027333738</td><td><a href='?date=2015-11-10'>28893-30101</a></td></tr><tr><td>2015-11-09</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 81df1e5ce51cd697bcb3c0f0a0b718bb6dfbaf390d876640970c6e5817f21ae8</b></td><td>0107293437</td><td><a href='?date=2015-11-09'>27565-28892</a></td></tr><tr><td>2015-11-08</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 9b33da2ba81b0a4c345bb8cde6063bb6e68707c18374189a9bed8217d8a29595</b></td><td>1828293236</td><td><a href='?date=2015-11-08'>26800-27564</a></td></tr><tr><td>2015-11-07</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> c1f27cc8b7bdf079e1de316a2db6d11a96be45642abd753c570919d3750ea134</b></td><td>0813141620</td><td><a href='?date=2015-11-07'>25948-26799</a></td></tr><tr><td>2015-11-06</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 40096a1706e6396b8e1cad09684e5e6d6c8a0d7e6a750e76e7cb80465d4316bf</b></td><td>0611233139</td><td><a href='?date=2015-11-06'>24489-25947</a></td></tr><tr><td>2015-11-05</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 9e4674f678b0139b147ed21383dee3eb6c904941807305aa470a8f89dbaa1160</b></td><td>0102223436</td><td><a href='?date=2015-11-05'>23069-24488</a></td></tr><tr><td>2015-11-04</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e61643e0388f3ffa63a56d4d49106f4bb710e6739681ab077913e0a0a730b73e</b></td><td>0214172123</td><td><a href='?date=2015-11-04'>22528-23068</a></td></tr><tr><td>2015-11-03</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> bf5df8bfe87c0a837437983139a6a393bc8dade17771df619b14301d1b51342c</b></td><td>0215161924</td><td><a href='?date=2015-11-03'>21388-22527</a></td></tr><tr><td>2015-11-02</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> aa680ec22fdd3b9db792f4c07ed00e7facef3ac782f3469ba605467b827f1abe</b></td><td>1121222731</td><td><a href='?date=2015-11-02'>19222-21387</a></td></tr><tr><td>2015-11-01</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 625e0423e4672289a67504cc8c76d3a0c2693c735fd6b437ea926b8abc95dc8c</b></td><td>0307091014</td><td><a href='?date=2015-11-01'>16241-19221</a></td></tr><tr><td>2015-10-31</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 09daa4ac148ef03a3da5b8f1880295ffd5320da6172f2258f39225e6393aa620</b></td><td>0312192027</td><td><a href='?date=2015-10-31'>13372-16240</a></td></tr><tr><td>2015-10-30</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 4d19c66c0c2bc3761e679b1c9c8cfc425380f651f0d6fd87b93c2567b61b62c8</b></td><td>0810253339</td><td><a href='?date=2015-10-30'>10789-13371</a></td></tr><tr><td>2015-10-29</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> e476cf1790f0adbf26a0253d2ae6af8e8aa4a75cc964d94f8196530346981683</b></td><td>0609192835</td><td><a href='?date=2015-10-29'>8632-10788</a></td></tr><tr><td>2015-10-28</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 692134ccaabe96c3e8374963aa8cddec1735b37dd0c56f2ce90f214fa2d6adda</b></td><td>0511122234</td><td><a href='?date=2015-10-28'>6474-8631</a></td></tr><tr><td>2015-10-27</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 790128cccf5deac37d44a5685363ee8ea8b6bead294eeb56d4a6793447392a8e</b></td><td>0607223236</td><td><a href='?date=2015-10-27'>4316-6473</a></td></tr><tr><td>2015-10-26</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> fe3cb73a173ce2fd2de9d86f9b8d2f874d6d2af931b1904699e092af657710b9</b></td><td>0406081834</td><td><a href='?date=2015-10-26'>2159-4315</a></td></tr><tr><td>2015-10-25</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> 39b7d32fcb743c244c569a56d6de4dc27577d6277d6cf155bdcba6d05befcb34</b></td><td>0422262831</td><td><a href='?date=2015-10-25'>1-2158</a></td></tr><tr><td>2015-10-24</td><td><b class='text-success'><i class='fa fa-check-circle fa-fw'></i> ffcd7aa5c5d6241352123abba40119a436386f63d48d8292f56dc0323d63d652</b></td><td>0102133238</td><td><a href='?date=2015-10-24'></a></td></tr></tbody></table>		</div>
<footer class="well footer">
	<div class="">
		<div class="pull-left" style="overflow:hidden">
			<a href="https://www.facebook.com/csgodoubledotcom" target="_blank"><img class="rounded" src="img/social/facebook_icon.png"></a>
			<a href="https://twitter.com/csgodouble" target="_blank"><img class="rounded" src="img/social/twitter_icon.png"></a>
			<!-- <a href="#" target="_blank"><img class="rounded" src="img/social/youtube icon.png"></a> -->
			<!-- <a href="#" target="_blank"><img class="rounded" src="img/social/reddit icon.png"></a> -->
			<!-- <a href="#" target="_blank"><img class="rounded" src="img/social/twitch icon.png"></a> -->
			<a href="http://steamcommunity.com/groups/csgodoubledotcom" target="_blank"><img class="rounded" src="img/social/steam_icon.png"></a>
		</div>
		<div class="pull-right" style="overflow:hidden;">
			<!-- Prices provided by <a href="http://csgo.steamanalyst.com/" target="_blank">SteamAnalyst</a> -->
			<a href="http://csgo.steamanalyst.com/" target="_blank"><img class="" src="img/social/sa.gif"></a>
		</div>
		<ul class="list-inline" style="display:inline-block;margin-top:10px">
			<li>Copyright &copy; 2016, CSGODouble.com - All rights reserved.</li>
			<li><a href="tos.php">Terms of Service</a></li>
			<li><a href="faq.php">FAQ</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="http://steampowered.com" target="_target">Powered by Steam</a></li>
		</ul>
	</div>
</footer>
</body>
</html>