<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSGODouble</title>
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
		.navbar{
			margin-bottom: 0px;
		}
		.progress-bar{
			transition:         none !important;
			-webkit-transition: none !important;
			-moz-transition:    none !important;
			-o-transition:      none !important;
		}
		#case{
			border:1px solid transparent;
			border-radius: 4px;
			max-width: 1125px;
			height: 75px;
			background-image: url("img/cases.png");
			background-repeat: no-repeat;
			background-position: 0px 0px;
			position: relative;
			margin:0px auto;
		}
	</style>
	<script type="text/javascript" src="js/new.js?v=1452520878"></script>	</head>
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
</script>			<ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none">
	<li><a tabindex="-1" href="#" data-act="0">Username</a></li>
	<li><a tabindex="-1" href="#" data-act="1">Mute player</a></li>
	<li><a tabindex="-1" href="#" data-act="2">Kick player</a></li>
	<li><a tabindex="-1" href="#" data-act="3">Send coins</a></li>
	<li><a tabindex="-1" href="#" data-act="4">Ignore</a></li>
</ul>
<div id="sidebar">
	<div style="cursor:pointer">
		<div style="position:relative" class="side-icon noselect" data-tab="1">
			<i class="fa fa-commenting fa-lg"></i>
			<span style="position:absolute;bottom:3px;right:3px" class="label label-danger" id="newMsg"></span>
		</div>
		<!-- <div class="side-icon noselect" data-tab="2"><i class="fa fa-users fa-lg"></i></div> -->
		<!-- <div class="side-icon noselect" data-tab="3"><i class="fa fa-cog fa-lg"></i></div> -->
	</div>
</div>
<div id="pullout" class="hidden">
	<div id="tab1" class="tab-group hidden" style="height:100%">
		<div style="margin:5px">
			<select class="form-control" id="lang">
				<option value="1">Main Room</option>
				<option value="2">Room 2</option>
				<option value="3">Room 3</option>
				<option value="4">Room 4</option>
			</select>
		</div>
		<div class="divchat" id="chatArea"></div>
		<form id="chatForm">
			<div style="margin:5px">
				<div class="form-group" style="margin-bottom:5px">
					<input type="text" class="form-control" placeholder="Type here to chat..." id="chatMessage" maxlength="200" autocomplete="off">
				</div>

				<div class="pull-left">
					<strong>Users Online: <span id="isonline">0</span></strong>
				</div>

				<div class="checkbox pull-right" style="margin:0px">
					<label class="noselect">
						<input type="checkbox" id="scroll">
						<strong>Pause chat</strong>
					</label>
				</div>

				<br>

				<div class="pull-left">
					<a href="#" data-toggle="modal" data-target="#chatRules">Chat Rules</a>
				</div>

			</div>

		</form>

	</div>
	<div id="tab2" class="tab-group hidden">
	</div>
	<div id="tab3" class="tab-group hidden">
	</div>





</div>
<div id="mainpage" style="padding-left:15px;padding-right:15px;position:relative;margin-left:50px">

	<div class="alert alert-warning text-center" style="margin-bottom:5px;margin-top:5px"><button type="button" class="close" data-dismiss="alert">&times;</button><b><i class='fa fa-exclamation-triangle'></i> Placed a bet on roll #138351 (~12:00 AM EST)? Read what happened <a target='_blank' href='http://steamcommunity.com/groups/csgodoubledotcom/discussions/0/458605613408544687/'>here</a>.</b></div>
	<div class="progress text-center" style="height:50px;margin-bottom:5px;margin-top:5px">
		<span  id="banner"></span>
		<div class="progress-bar progress-bar-danger" id="counter"></div>
	</div>


	<div id="case" style="margin-bottom:5px"><div id="pointer"></div></div>
	<div class="well text-center" style="padding:5px;margin-bottom:5px"><div id="past"></div></div>
	<div class="well" style="margin-bottom:5px;padding-bottom:0px;padding-top:10px">


		<p>
			<span style="font-size:18px;font-weight:bold">Balance: <span id="balance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="getbal"></i></span>
		</p>

		<div class="form-group">
			<div class="btn-group">
				<button type="button" class="btn btn-default betshort" data-action="clear">Clear</button>
				<button type="button" class="btn btn-default betshort" data-action="last">Last</button>
				<button type="button" class="btn btn-default betshort" data-action="1">+1</button>
				<button type="button" class="btn btn-default betshort" data-action="10">+10</button>
				<button type="button" class="btn btn-default betshort" data-action="100">+100</button>
				<button type="button" class="btn btn-default betshort" data-action="1000">+1000</button>
				<button type="button" class="btn btn-default betshort" data-action="half"> 1/2 </button>
				<button type="button" class="btn btn-default betshort" data-action="double">  x2  </button>
				<button type="button" class="btn btn-default betshort" data-action="max">Max</button>
			</div>
		</div>
		<div class="form-group">
			<input type="text" class="form-control input-lg" placeholder="Bet amount..." id="betAmount">
		</div>
	</div>
	<div class="row text-center">
		<div class="col-xs-4" style="padding-right:0px">
			<div class="panel panel-default bet-panel" id="panel1-7">
				<div class="panel-heading">
					<button class="btn btn-danger btn-lg  btn-block betButton" data-lower="1" data-upper="7">1 to 7</button>
				</div>
				<div class="panel-body" style="padding:0px">
					<div class="my-row">
						<div class="mytotal">0</div>
					</div>
					<div class="total-row">
						<div class="pull-left">Total bet</div>
						<div class="pull-right total">0</div>
					</div>
					<ul class="list-group betlist"></ul>
				</div>
			</div>
		</div>

		<div class="col-xs-4">
			<div class="panel panel-default bet-panel" id="panel0-0">
				<div class="panel-heading">
					<button class="btn btn-success btn-lg  btn-block betButton" data-lower="0" data-upper="0">0</button>
				</div>
				<div class="panel-body" style="padding:0px">
					<div class="my-row">
						<div class="mytotal">0</div>
					</div>
					<div class="total-row">
						<div class="pull-left">Total bet</div>
						<div class="pull-right total">0</div>
					</div>
					<ul class="list-group betlist"></ul>
				</div>
			</div>
		</div>
		<div class="col-xs-4" style="padding-left:0px">
			<div class="panel panel-default bet-panel" id="panel8-14">
				<div class="panel-heading">
					<button class="btn btn-inverse btn-lg  btn-block betButton" data-lower="8" data-upper="14">8 to 14</button>
				</div>
				<div class="panel-body" style="padding:0px">
					<div class="my-row">
						<div class="mytotal">0</div>
					</div>
					<div class="total-row">
						<div class="pull-left">Total bet</div>
						<div class="pull-right total">0</div>
					</div>
					<ul class="list-group betlist"></ul>
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
</footer>		<script type="text/javascript">
	//<![CDATA[
	(function() {
		var _analytics_scr = document.createElement('script');
		_analytics_scr.type = 'text/javascript'; _analytics_scr.async = true; _analytics_scr.src = '/_Incapsula_Resource?SWJIYLWA=2977d8d74f63d7f8fedbea018b7a1d05&ns=1';
		var _analytics_elem = document.getElementsByTagName('script')[0]; _analytics_elem.parentNode.insertBefore(_analytics_scr, _analytics_elem);
	})();
	// ]]>
</script></body>
</html>
