<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Withdraw - CSGODouble</title>
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
		.reject{
			opacity:0.5;
		}
		.reject .price{
			background-color: #d21 !important;
			left: 0px !important;
		}
	</style>
	<script type="text/javascript">
		var DEPOSIT = false;
	</script>
	<script type="text/javascript" src="js/offers.js?v=40"></script>
</head>
<body style="padding-bottom:25%">
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
</script>		<ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none">
	<li><a tabindex="-1" href="#" data-act="0">Inspect in Game...</a></li>
</ul>
<div class="modal fade" id="confirmModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<div class="close" data-dismiss="modal">&times;</div>
				<h4 class="modal-title"><b>Confirm Withdraw</b></h4>
			</div>
			<div class="modal-body">
				<label>Trade URL - <a href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank">find my trade url</a></label>
				<input type="text" class="form-control steam-input" id="tradeurl" value="">
				<div class="checkbox">
					<label>
						<input type="checkbox" id="remember" > Remember trade URL
					</label>
				</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
				<button class="btn btn-success" id="offerButton" onclick="offer()">Confirm</button>
			</div>
		</div>
	</div>
</div>
<div class="text-center">
	<div style="display:inline-block">

		<div class="alert alert-danger text-center">
			<b><i class="fa fa-exclamation-triangle"></i> Please do not attempt to modify the trade offer sent by our bots - doing so will be counted as an accept.</b>
		</div>
		<div id="inlineAlert" class="alert" style="font-weight:bold"></div>

		<div class="panel panel-default text-left"  id="offerPanel" style="display:none">
			<div class="panel-heading">
				<h3 class="panel-title"><b>Incoming trade offer <i class="fa fa-download"></i></b></h3>
			</div>
			<div class="panel-body">
				<span id="offerContent" style="line-height:34px"></span>
				<div class="pull-right"><button class="btn btn-success" id="confirmButton" data-tid="0">Complete</button></div>
				<div><b style="color:red">You must click "Check Status" at least once in order to trigger mobile confirmation before opening the trade.</b></div>
			</div>
			<br>

		</div>

		<div class="panel panel-default text-left fw-6">
			<div class="panel-heading">
				<h3 class="panel-title"><b>Bank : <span id="left_number">0</span> items</b></h3>
			</div>
			<div class="panel-body">

				<div class="btn-group" id="botFilter" style="margin-bottom:10px">
					<label class="btn btn-default active" data-bot="0">All</label>
					<label class="btn btn-default" data-bot="1">Bot 1</label>
					<label class="btn btn-default" data-bot="2">Bot 2</label>
					<label class="btn btn-default" data-bot="3">Bot 3</label>
					<label class="btn btn-default" data-bot="4">Bot 4</label>
					<label class="btn btn-default" data-bot="5">Bot 5</label>
					<label class="btn btn-default" data-bot="6">Bot 6</label>
					<label class="btn btn-default" data-bot="7">Bot 7</label>
					<label class="btn btn-default" data-bot="8">Bot 8</label>
					<label class="btn btn-default" data-bot="9">Bot 9</label>
					<label class="btn btn-default" data-bot="10">Bot 10</label>
					<label class="btn btn-default" data-bot="11">Bot 11</label>
					<label class="btn btn-default" data-bot="12">Bot 12</label>
					<label class="btn btn-default" data-bot="13">Bot 13</label>
					<label class="btn btn-default" data-bot="14">Bot 14</label>
					<label class="btn btn-default" data-bot="15">Bot 15</label>
					<label class="btn btn-default" data-bot="16">Bot 16</label>
					<label class="btn btn-default" data-bot="17">Bot 17</label>
					<label class="btn btn-default" data-bot="18">Bot 18</label>
					<label class="btn btn-default" data-bot="19">Bot 19</label>
				</div>

				<div style="margin-bottom:10px">
					<div style="display:inline-block;float:right">
						<form class="form-inline">
							<select class="form-control" id="orderBy">
								<option value="0">Default</option>
								<option value="1">Price Descending</option>
								<option value="2">Price Ascending</option>
								<option value="3">Name A-Z</option>
							</select>
						</form>
					</div>
					<div style="overflow:hidden;padding-right:2px">
						<input type="text" class="form-control" id="filter" placeholder="Search..." style="width:100%">
					</div>
				</div>
				<div id="left" class="slot-group noselect">
					<span class="reals"></span>
							<span class="bricks">
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
							</span>
				</div>
			</div>
		</div>
		<div class="panel panel-default text-left fw-4" style="vertical-align:top">
			<div class="panel-heading">
				<h3 class="panel-title"><b>Withdraws</b></h3>
			</div>
			<div class="panel-body">
				<button class="btn btn-danger btn-lg" style="width:100%"  onclick="showConfirm()" id="showConfirmButton">Withdraw Items<div style="font-size:12px"><span id="sum">0</span> credits | Available: <span id="avail">0</span></div></button>
				<div id="right" class="slot-group noselect">
					<span class="reals"></span>
							<span class="bricks">
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
								<div class='placeholder'></div>
							</span>
				</div>
			</div>
		</div>
	</div>
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