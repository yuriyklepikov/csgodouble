<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Support - CSGODouble</title>
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
		textarea{
			margin-bottom: 5px;
		}
		.panel-body .alert:last-child{
			margin-bottom: 0px;
		}
		.bubble{
			margin-bottom: 5px !important;
		}

	</style>
	<script type="text/javascript">
		var reload = true;
		$(document).ready(function(){
			$(".support_button").on("click",function(){
				var tid = $(this).data("x");
				var title = $("#ticketTitle").val();
				var cat = $("#ticketCat").val();
				var body = $("#text"+tid).val();
				var close = $("#check"+tid).is(":checked")?1:0;
				var flag = $("#flag"+tid).is(":checked")?1:0;
				var lmao = $("#lmao"+tid).is(":checked")?1:0;
				var conf = "Are you sure you wish to submit this reply?";
				if(tid==0){
					if(title.length==0){
						bootbox.alert("Title cannot be left blank.");
						return;
					}else if(cat==0){
						bootbox.alert("Department cannot be left blank.");
						return;
					}else if(body.length==0){
						bootbox.alert("Description cannot be left blank.");
						return;
					}
					conf = "Are you sure you wish to submit this ticket?<br><br><b style='color:red'>WARNING: Misuse of this system will result in a 1 week ban.</b>";
				}
				bootbox.confirm(conf,function(result){
					if(result){
						$.ajax({
							url:"scripts/_support.php",
							type:"POST",
							data:{"tid":tid,"title":title,"reply":body,"close":close,"cat":cat,"flag":flag,"lmao":lmao},
							success:function(data){
								try{
									data = JSON.parse(data);
									if(data.success){
										bootbox.alert(data.msg,function(){
											if(reload){
												location.reload();
											}
										});
									}else{
										bootbox.alert(data.error);
									}
								}catch(err){
									bootbox.alert("Javascript error: "+err);
								}
							},
							error:function(err){
								bootbox.alert("AJAX error: "+err.statusText);
							}
						});
					}
				});
				return false;
			});
		});
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
</script>		<div class="container" style="margin-bottom:20%">
	<div class='alert alert-warning'>You have <a href='?open'>0 open tickets</a> and <a href='?closed'>0 completed tickets</a>.</div>

	<div class="panel panel-info">
		<div class="panel-heading"><h4>How do I send coins to people?</h4></div>
		<div class="panel-body">
			<p>To send coins use the chat command "/send [steam64id] [amount]".</p>

			<p>For example, to send 500 coins to steam64id 76561198210260209 you'd type "/send 76561198210260209 500".</p>

			<p>Alternatively right click the person's avatar in chat and select "Send coins".</p>

			<p>To find your steam64id you can use sites like <a target="_blank" href="https://steamid.io/lookup">steamid.io</a></p>

		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><h4>How do I get more coins? Can I have free coins?</h4></div>
		<div class="panel-body">
			<p>Coins are obtained by depositing CS:GO skins. If you've used up the free 500 coins you'll need to make a deposit to get more.</p>

			<b>DO NOT contact support asking for coins.</b>
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><h4>How do I generate a referral code?</h4></div>
		<div class="panel-body">
			<p>To generate your own referral code please visit the affiliates page located <a target="_blank" href="affiliates.php">here</a>.</p>
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><h4>I accepted the trade offer but never got coins!?</h4></div>
		<div class="panel-body">
			After accepting the trade offer you must click the green <b>"Get Coins"</b> button to receive coins.
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><h4>Trade is not available but the bot took my coins!?</h4></div>
		<div class="panel-body">
			If your withdraw request is canceled, declined, or the items become "no longer available" simply hit the green <b>"Complete"</b> or <b>"Refund Coins"</b> button
			and the bots will automatically refund all coins. If you accidentally sent a counter offer and failed to receive a refund submit a ticket below.
		</div>
	</div>
	<div class="panel panel-info">
		<div class="panel-heading"><h4>"There was an error sending your trade offer. Please try again later. (XX)"</h4></div>
		<div class="panel-body">
			<p>These errors come from Steam and typically indicate an issue with the player, not the bots. They may also be caused by Steam servers being down.</p>

			<p>Ensure your account is able to trade and the item you're trading is not trade banned.</p>

			<p>If you're receiving (26) when attempting to deposit this typically indicates your inventory is out of date. Hit "force reload" to refresh your inventory and try again.</p>

			<p>If you're receiving (15) when attempting to deposit this may indicate the bot you were matched with has a full inventory - try again and you should be matched with a new bot.</p>
		</div>
	</div>
	<a class="btn btn-danger btn-lg btn-block" href="?new">Still need help? Submit a support ticket.</a>

</div>
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