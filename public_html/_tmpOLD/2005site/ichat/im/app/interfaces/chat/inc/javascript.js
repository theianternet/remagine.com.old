var currentCol = 1;
var chats = Array();

function siteWidth() {
	var site = document.getElementById("site");
	if (site) {
		return site.offsetWidth;
	} else {
		return 320;
	}
}

function siteHeight() {
	var site = document.getElementById("site");
	if (site) {
		return site.offsetWidth;
	} else {
		return 350;
	}
}


function slide(direction, multiplier, time, destinationCol) {
	if (destinationCol != undefined) {
		if (destinationCol == currentCol) {
			return false;
		} else if (destinationCol > 0) {
			if (destinationCol > currentCol) {
				direction = "right";
				var delta = Math.abs(destinationCol - currentCol);
			} else if (destinationCol < currentCol) {
				direction = "left";
				var delta = Math.abs(destinationCol - currentCol);
			}
		}
	}
	if (time == undefined || time < 0) {
		time = .4;
	}
	var site = document.getElementById("site");
	var wide = document.getElementById("wide");
	var col = document.getElementById("col"+ currentCol);
	var marginLeft = pxToInt(wide.style.marginLeft);
	var targetMarginLeft = marginLeft;
	var top = pxToInt(col.style.top)
	var targetTop = top;
	var width = siteWidth();
	var height = siteHeight();
	if (multiplier != 1 && multiplier > 1) {
		multiplier = 1 + (((1 - multiplier) * 3) * -1);
	}
	if (multiplier < 0) {
		multiplier = 0;
	}
	if (direction == "left" && currentCol > 1) {
		if (destinationCol != undefined) {
			targetMarginLeft += (width * delta);
			currentCol = destinationCol;
		} else {
			targetMarginLeft += width;
			currentCol -= 1;
		}
	} else if (direction == "right" && currentCol <= (chats.length)) {
		if (destinationCol != undefined) {
			targetMarginLeft -= (width * delta);
			currentCol = destinationCol;
		} else {
			targetMarginLeft -= width;
			currentCol += 1;
		}
	} else if (direction == "up") {
		targetTop -= height * multiplier;
	} else if (direction == "down") {
		targetTop += height * multiplier;
	}
	if (targetMarginLeft != marginLeft) {
		var anim = new YAHOO.util.Anim('wide', { marginLeft: {to: targetMarginLeft} }, time, YAHOO.util.Easing.easeOut);
		anim.animate();
	} else if (targetTop != top) {
		var ease = YAHOO.util.Easing.easeOutStrong;
		if (targetTop > 0) {
			targetTop = 0;
			ease = YAHOO.util.Easing.bounceOut;
		} else if (targetTop < ((col.offsetHeight - site.offsetHeight) * -1)) {
			targetTop = (col.offsetHeight - site.offsetHeight) * -1;
			ease = YAHOO.util.Easing.bounceOut;
		}
		var anim = new YAHOO.util.Anim('col'+ currentCol, { top: {to: targetTop} }, .7, ease);
		anim.animate();
	}
	if (currentCol > 1) {
		var typing = document.getElementById("typing");
		if (typing.style.display != "block") {
			typing.style.opacity = 0;
			typing.style.display = 'block';
			var anim = new YAHOO.util.Anim('typing', { opacity: {to: 1} }, .2, YAHOO.util.Easing.easeOut);
			anim.animate();
			anim.onComplete.subscribe(function () {
				typing.style.display = 'block';
			}, this, true);
		}
		for (i = 0; i < chats.length; i++) {
			tab = document.getElementById("tab"+ (i + 2));
			if (tab) {
				tab.className = "";
			}
		}
		document.getElementById("tab"+ currentCol).className = "on";
		var logoff = document.getElementById("logoff");
		if (logoff) {
			if (logoff.style.display != "none") {
				var anim = new YAHOO.util.Anim('logoff', { marginBottom: {to: -62} }, .2, YAHOO.util.Easing.easeOut);
				anim.animate();
				anim.onComplete.subscribe(function () {
					logoff.style.display = 'none';
				}, this, true);
			}
		}
		var goBack = document.getElementById("goBack");
		if (goBack) {
			if (goBack.style.display != "block") {
				goBack.style.opacity = 0;
				goBack.style.display = 'block';
				goBack.style.marginBottom = '0px';
				var anim = new YAHOO.util.Anim('goBack', { opacity: {to: 1} }, .5, YAHOO.util.Easing.easeIn);
				anim.animate();
			}
		}
		var xChat = document.getElementById("xChat");
		if (xChat) {
			xChat.style.opacity = 0;
			xChat.style.display = 'block';
			var anim = new YAHOO.util.Anim('xChat', { opacity: {to: 1} }, .5, YAHOO.util.Easing.easeIn);
			anim.animate();
		}
	} else {
		var typing = document.getElementById("typing");
		if (typing.style.display != "none") {
			typing.style.opacity = 1;
			typing.style.display = 'block';
			var anim = new YAHOO.util.Anim('typing', { opacity: {to: 0} }, .2, YAHOO.util.Easing.easeOut);
			anim.animate();
			anim.onComplete.subscribe(function () {
				typing.style.display = "none";
			}, this, true);
			var tab;
			for (i = 0; i < chats.length; i++) {
				tab = document.getElementById("tab"+ (i + 2));
				if (tab) {
					tab.className = "";
				}
			}
		}
		var logoff = document.getElementById("logoff");
		if (logoff) {
			if (logoff.style.display != "block") {
				logoff.style.opacity = 0;
				logoff.style.display = 'block';
				logoff.style.marginBottom = '0px';
				var anim = new YAHOO.util.Anim('logoff', { opacity: {to: 1} }, .5, YAHOO.util.Easing.easeIn);
				anim.animate();
			}
		}
		var goBack = document.getElementById("goBack");
		if (goBack) {
			if (goBack.style.display != "none") {
				var anim = new YAHOO.util.Anim('goBack', { marginBottom: {to: -62} }, .2, YAHOO.util.Easing.easeOut);
				anim.animate();
				anim.onComplete.subscribe(function () {
					goBack.style.display = 'none';
				}, this, true);
			}
		}
		var xChat = document.getElementById("xChat");
		if (xChat) {
			if (xChat.style.display == "block") {
				xChat.style.opacity = 1;
				var anim = new YAHOO.util.Anim('xChat', { opacity: {to: 0} }, .1, YAHOO.util.Easing.easeIn);
				anim.animate();
				anim.onComplete.subscribe(function () {
					xChat.style.display = 'none';
				}, this, true);
			}
		}
	}
}

function addChat(username, li) {
	if (gestureTrack == true) {
		return false;
	}
	if (li != undefined) {
		li.parentNode.className = "on";
		window.setTimeout("document.getElementById('"+ li.parentNode.id +"').className = '';", 600);
	}
	var chat = document.getElementById("chat-"+ username);
	var wide = document.getElementById("wide");
	var tabs = document.getElementById("tabs");
	if (chat) {
		var destinationCol = Math.floor(chat.parentNode.id.replace(/col/,""));
		slide("right", 1, -1, destinationCol);
		// already exists, zoom to it
	} else {
		var html;
		chats.push(username);
		html = '<div class="col" id="col'+ (chats.length + 1) +'"><div id="chat-'+ username +'" class="history"><div class="systemMessage"><br>chatting with '+ username +'</div></div></div>';
		wide.innerHTML += html;
		html = '<div id="tab'+ (chats.length + 1) +'" onClick="addChat(\''+ username +'\');"><img src="img/square-'+ (chats.length + 1) +'.gif" width="34" height="50" border="0" /><img src="img/dot.png" width="18" height="18" border="0" class="dot" /></div>';
		tabs.innerHTML = html + tabs.innerHTML;
		slide("right", 1, -1, (chats.length + 1));
	}
}

function pxToInt(str) {
	return Math.floor(str.replace(/px/g, ""));
}

function mouseX(e) {
	var IE = document.all?true:false
	var temp = 0;
	if (IE) {
		temp = event.clientX + document.body.scrollLeft;
	} else {
		temp = e.pageX;
	}  
	if (temp < 0) {
		temp = 0;
	}
	return temp;
}

function mouseY(e) {
	var IE = document.all?true:false
	var temp = 0;
	if (IE) {
		temp = event.clientY + document.body.scrollTop;
	} else {
		temp = e.pageY;
	}  
	if (temp < 0) {
		temp = 0;
	}
	return temp;
}

var gestureTrack = false;
var gestureStartTime = 0;
var gestureEndTime = 0;
var gestureMouseStartX = 0;
var gestureMouseStartY = 0;
var gestureMouseEndX = 0;
var gestureMouseEndY = 0;
var gestureThreshold = 30;
var gestureColStartY = 0;
function gestureMouseDown(e) {
	var date = new Date();
	var col = document.getElementById("col"+ currentCol);
	gestureStartTime = date.getTime();
	gestureMouseStartX = mouseX(e);
	gestureMouseStartY = mouseY(e);
	gestureColStartY = pxToInt(col.style.top);
	document.onmousemove = gestureMouseMove;
}
function gestureMouseMove(e) {
	var site = document.getElementById("site");
	var col = document.getElementById("col"+ currentCol);
	if (col) {
		var diff = mouseY(e) - (gestureMouseStartY);
		var scroll = document.getElementById("scroll");
		if (Math.abs(diff) >= 3 && scroll) {
			gestureTrack = true;
			var target = gestureColStartY + diff;
			if (target > 20) {
				target = 20;
			} else if (target < (((col.offsetHeight - site.offsetHeight) * -1)) - 20) {
				target = ((col.offsetHeight - site.offsetHeight) * -1) - 20;
			}
			col.style.top = target +"px";
			scroll.style.height = (siteHeight() / (col.offsetHeight / site.offsetHeight)) +"px";
			scroll.style.display = "block";
			var scrollTarget = ((1 / (col.offsetHeight / site.offsetHeight)) * pxToInt(col.style.top) * -1);
			if (scrollTarget < 0) {
				scrollTarget = 0;
			}
			scroll.style.top = scrollTarget +"px";
		}
	}
}
function gestureMouseUp(e) {
	document.onmousemove = null;
	var scroll = document.getElementById("scroll");
	if (scroll) {
		scroll.style.display = "none";
	}
	if (gestureTrack == false) {
		//slide("up", 2);
	}
	window.setTimeout("gestureTrack = false;", 500);
	gestureMouseEndX = mouseX(e);
	gestureMouseEndY = mouseY(e);
	var date = new Date();
	gestureEndTime = date.getTime();
	var diffX = gestureMouseEndX - gestureMouseStartX;
	var diffY = gestureMouseEndY - gestureMouseStartY;
	var diffTime = gestureEndTime - gestureStartTime;
	var multiplier = 1;
	if (Math.abs(diffX) > gestureThreshold || Math.abs(diffY) > gestureThreshold) {
		if (Math.abs(diffY) > Math.abs(diffX)) {
			multiplier = Math.abs(diffY / diffTime);
			if (diffY > 0) {
				slide("down", multiplier);
			} else {
				slide("up", multiplier);
			}
		} else {
			if (diffX > 0) {
				slide("left");
			} else {
				slide("right");
			}
		}
	}
}
document.onmousedown = gestureMouseDown;
document.onmouseup = gestureMouseUp;

var col1Selected;
var hasZoomedUp = false;
/*
function loadCol2(o, topic) {
	if (gestureTrack == false) {
		if (col1Selected != undefined) {
			col1Selected.className = "";
		}
		if (o != undefined) {
			o.className = "on";
		}
		col1Selected = o;

		if (topic != "" && topic != undefined) {
			var url = "/digg/query.php?url="+ escape("http://services.digg.com/stories/topic/"+ topic +"/popular?count=30");
			var handleStoriesSuccess = function(o){
				if(o.responseText !== undefined){
					var col2 = document.getElementById("col2");
					col2.innerHTML = o.responseText;
					col2.style.top = "0px";
					createCookie("topic", topic, 1);
					window.parent.document.lastURL = url;
					if (hasZoomedUp == false) {
						slide("right", 1, .01);
						window.setTimeout("zoomUp();", 1);
					} else {
						slide("right");
					}
				}
			}
			var handleStoriesFailure = function (o) {
				alert("Error loading stories.");
			}
			YAHOO.util.Connect.asyncRequest("GET", url, {success:handleStoriesSuccess, failure:handleStoriesFailure} );
		}
	}
	return false;
}
*/

var col2Selected;
/*
function loadCol3(o, url) {
	if (gestureTrack == false) {
		if (col2Selected != undefined) {
			col2Selected.className = "story";
		}
		if (o != undefined) {
			o.className = "story on";
		}
		col2Selected = o;
		slide("right");
		window.setTimeout(function () { window.location = url; }, 400);
	}
	return false;
}
*/

function zoomUp() {
	hasZoomedUp = true;
	var anim = new YAHOO.util.Anim('wide', { marginTop: {to: 0} }, .4, YAHOO.util.Easing.easeOut);
	anim.animate();
}

function fadeInSheet() {
	var sheet = document.getElementById('sheet');
	sheet.style.opacity = 0;
	sheet.style.display = 'block';
	var anim = new YAHOO.util.Anim('sheet', { opacity: {to: .8} }, .3, YAHOO.util.Easing.easeOut);
	anim.animate();
}

function killCurrentChat() {
	alert("killCurrentChat");
}

function submitText() {
	var typingText = document.getElementById("typing-text");
	if (typingText && chats.length > 0) {
		myChat.send(chats[currentCol-2], typingText);
	}
}


