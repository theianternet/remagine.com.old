var focusChatHandler;

function print_r(input, _indent)
{
if(typeof(_indent) == 'string') {
var indent = _indent + ' ';
var paren_indent = _indent + ' ';
} else {
var indent = ' ';
var paren_indent = '';
}
switch(typeof(input)) {
case 'boolean':
var output = (input ? 'true' : 'false') + "\n";
break;
case 'object':
if ( input===null ) {
var output = "null\n";
break;
}
var output = ((input.reverse) ? 'Array' : 'Object') + " (\n";
for(var i in input) {
output += indent + "[" + i + "] => " + print_r(input[i], indent);
}
output += paren_indent + ")\n";
break;
case 'number':
case 'string':
default:
var output = "" + input + "\n";
}
return output;
}


function FocusChat(name) {

	if (name == "" || !name) {
		alert("You must specify a name as the first parameter.  It must match the name of the variable that references the instance.");
	}

	this.name = name;

	this.createRequestObject = function () {
		var request_;
		var browser = navigator.appName;
		if(browser == "Microsoft Internet Explorer"){
			request_ = new ActiveXObject("Microsoft.XMLHTTP");
		}else{
			request_ = new XMLHttpRequest();
		}
		return request_;
	}

	//this.http = this.createRequestObject();
	//alert("** "+ this.http);

	this.setRefreshInterval = function (interv) {
		//document.getElementById('interval').innerHTML = "refresh interval: "+ (interv / 1000) +" seconds";
		this.interval = interv;
	}

	this.updateChat = function () {
		window.clearTimeout(this.goTimeout);
		this.http = YAHOO.util.Connect.asyncRequest("GET", 'chat.php?callbackObject='+ this.name +'&history=true&last='+ (this.usedIdTimes[this.usedIdTimes.length-1] - this.buffer), {success:this.handleSuccess, failure:this.handleFailure});
		focusChatHandler = this;
		if (this.time() - this.lastTime > this.intervalIncreaseDelay) {
			var newInterval = this.interval + this.intervalIncreaseRate;
			if (newInterval > this.intervalLimit) {
				newInterval = this.intervalLimit;
			}
			this.setRefreshInterval(newInterval);
			this.lastTime = this.time();
		}
		this.goTimeout = window.setTimeout(this.name +".updateChat()", this.interval);
	}

	this.time = function () {
		now = new Date();
		return Math.round(now.getTime() / 1000);
	}

	this.handleInfo = function (o) {
		alert("handling info "+ this.http.responseText);
	}

	this.handleSuccess = function (o) {
		if (o.responseXML) {
			var items = o.responseXML.getElementsByTagName("chat");
			ref = eval(items.item(0).attributes[0].value);
			if (true) {
				if (o.responseText != "") {
					ref.processXML(o.responseXML);
				} else {
					//alert("There was no data returned.");
					return false;
				}
				if (chats.length > 0) {
					var obj;
					for (i = 0; i < chats.length; i++) {
						obj = document.getElementById("chat-"+ chats[i]);
						if (obj) {
							ref.doScroll(obj);
						}
					}
				}
			} else {
			   alert("There was a problem retrieving the XML data:\n" + o.statusText);
			}
		} else {
		   alert("responseXML problem:\n" + o.statusText +"\nresponseXML = "+ o.responseXML +"\nresponseXML = "+ o.responseText);
		}
	}

	this.handleFailure = function (o){
		//alert("Error loading results.");
	}

	this.doScroll = function (obj) {
		//obj.scrollTop = obj.scrollHeight;
		//alert(obj.parentNode.offsetHeight +" - "+ obj.parentNode.innerHeight);
		var amount = siteHeight() - obj.parentNode.offsetHeight;
		if (amount < 0 && gestureTrack != true) {
			obj.parentNode.style.top = amount +"px";
		}
	}

	this.send = function (to, field) {
		var i = 0;
		t = field.value
		field.value = "";
		t = t.replace(/</g,'&lt;');
		t = t.replace(/>/g,'&gt;');
		obj = document.getElementById('chat-'+ to);
		var str;
		if (obj) {
			str = '<div class="userRight">'+ currentUsername +'</div>';
			str += '<table cellspacing="0" cellpadding="0" border="0" class="bubbleRight"><tr><td class="topLeft"></td><td class="center" rowspan="2"><div class="bottom"></div>';
			str += 	'<div class="message">'+ t +'</div>';
			str += '</td><td class="topRight"></td></tr><tr><td class="left" height="100%"><div class="bottomLeft"></div></td><td class="right" height="100%"><div class="bottomRight"></div></td></tr></table>';
			obj.innerHTML = obj.innerHTML.replace(/<br><br><br><br>/,"");
			obj.innerHTML += str +"<div style='clear:both;'></div><br><br><br><br>";
			this.doScroll(obj);
		}
		window.clearTimeout(this.goTimeout);
		this.hasScrolled = false;
		while (this.http.readyState < 4) {
			window.setTimeout(this.name +".send('"+ t.replace(/\'/g,"\\\\'") +"');",500);
			return true;
		}
		this.doSend(to, t);
		this.setRefreshInterval(this.intervalDefault);
		this.lastTime = this.time();
		this.goTimeout = window.setTimeout(this.name +".updateChat()", this.interval);
		field.focus();
	}

	this.doSend = function (to, t) {
		//this.http.abort();
		//this.http.open('get', 'index.php?history=true&t='+ t +'&last='+ (this.usedIdTimes[this.usedIdTimes.length-1] - this.buffer));
		//this.http.onreadystatechange = myChat.handleInfo;
		//this.http.send(null);
		//alert('chat.php?callbackObject='+ this.name +'&history=true&toUsername='+ to +'&t='+ t +'&last='+ (this.usedIdTimes[this.usedIdTimes.length-1] - this.buffer));
		this.http = YAHOO.util.Connect.asyncRequest("GET", 'chat.php?callbackObject='+ this.name +'&history=true&toUsername='+ to +'&t='+ t +'&last='+ (this.usedIdTimes[this.usedIdTimes.length-1] - this.buffer), {success:this.handleSuccess, failure:this.handleFailure});
		focusChatHandler = this;
	}

	this.startAlert = function () {
		document.getElementById("chat-alert").style.visibility = "visible";
		this.originalTitle = document.title;
		this.alertTitle = "New chat message!";
		this.toggleTitle();
	}

	this.toggleTitle = function () {
		return false;
		if (this.alertTitle != document.originalTitle && document.originalTitle != "") {
			if (document.title == this.alertTitle) {
				document.title = this.originalTitle;
			} else {
				document.title = this.alertTitle;
			}
			this.titleTimeout = window.setTimeout(this.name +".toggleTitle();", 1000);
		}
	}

	this.stopAlert = function () {
		document.getElementById("chat-alert").style.visibility = "hidden";
		document.title = this.originalTitle;
		this.originalTitle = "";
		window.clearTimeout(this.titleTimeout);
	}

	this.processXML = function (xml) {
		var history;
		var user;
		var items = xml.getElementsByTagName("message");
		var str = "";
		var str2 = "";
		for (var i = 0; i < items.length; i++) {
			if (this.js_in_array(this.getElementTextNS("", "id", items[i], 0),this.usedIds) == false) {
				str += this.getElementTextNS("", "t", items[i], 0);
				this.usedIds.push(this.getElementTextNS("", "id", items[i], 0));
				this.usedIdTimes.push(this.getElementTextNS("", "time", items[i], 0));
				this.lastTime = this.time();
				this.setRefreshInterval(this.intervalDefault);
				if (str.length > 0) {
					user = this.getElementTextNS("", "name", items[i], 0);
					history = document.getElementById("chat-"+ user);
					if (!history) {
						addChat(user);
						history = document.getElementById("chat-"+ user);
					}
					if (history) {
						history.innerHTML = history.innerHTML.replace(/<br><br><br><br>/,"");
						str2 = '<div class="userLeft">'+ user +'</div>';
						str2 += '<table cellspacing="0" cellpadding="0" border="0" class="bubbleLeft"><tr><td class="topLeft"></td><td class="center" rowspan="2"><div class="bottom"></div>';
						str2 += 	'<div class="message">'+ str +'</div>';
						str2 += '</td><td class="topRight"></td></tr><tr><td class="left" height="100%"><div class="bottomLeft"></div></td><td class="right" height="100%"><div class="bottomRight"></div></td></tr></table>';
						history.innerHTML += str2 +"<br><br><br><br>";
						str = "";
						this.doScroll(history);
						var thisCol = Math.floor(history.parentNode.id.replace(/col/,""));
						if (thisCol != currentCol) {
							var thisTab = document.getElementById("tab"+ thisCol);
							if (thisTab) {
								thisTab.className = "new";
							}
						}
					}
				}
			}
		}
		var buddyArray = xml.getElementsByTagName("buddy");
		var buddyStr = "";
		for (var i = 0; i < buddyArray.length; i++) {
			buddyStr = "";
			var username = this.getElementTextNS("", "username", buddyArray[i], 0);
			var type = this.getElementTextNS("", "type", buddyArray[i], 0);
			var t = this.getElementTextNS("", "t", buddyArray[i], 0);
			if (username.substr(0,1) != "+") {
				var buddy = document.getElementById("buddy-"+ username);
				var buddies = document.getElementById("buddies");
				if (buddy) {
					if (type == "2") {
						buddy.parentNode.removeChild(buddy);
					} else if (type == "1") {
						// its already in the list, but update the status
						buddy.parentNode.removeChild(buddy);
						buddyStr += "<li id='buddy-"+ username +"' sort='"+ username +"'";
						if (t == "away") {
							buddyStr += " class='away'";
						}
						buddyStr += "><div class='story' onClick=\"addChat('"+ username +"',this);\">"+ username +"</div></li>";
						buddies.innerHTML += buddyStr;
					}
				} else {
					if (type == "2") {
						// its not in the list, so do nothing
					} else if (type == "1") {
						buddyStr += "<li id='buddy-"+ username +"' sort='"+ username +"'";
						if (t == "away") {
							buddyStr += " class='away'";
						}
						buddyStr += "><div class='story' onClick=\"addChat('"+ username +"',this);\">"+ username +"</div></li>";
						buddies.innerHTML += buddyStr;
					}
				}
			}
			this.setRefreshInterval(this.intervalDefault);
		}
		//temp = document.getElementById("mTemp");
		//if (temp) {
			//temp.parentNode.removeChild(temp);
		//}
		//if (str.length > 0) {
			//history.innerHTML += str;
		//}
		//document.getElementById('sendButton').disabled = false;
	}

	this.getElementTextNS = function (prefix, local, parentElem, index) {
	    var result = "";
	    if (prefix && isIE) {
	        // IE/Windows way of handling namespaces
	        result = parentElem.getElementsByTagName(prefix + ":" + local)[index];
	    } else {
	        // the namespace versions of this method 
	        // (getElementsByTagNameNS()) operate
	        // differently in Safari and Mozilla, but both
	        // return value with just local name, provided 
	        // there aren't conflicts with non-namespace element
	        // names
	        result = parentElem.getElementsByTagName(local)[index];
	    }
	    if (result) {
	        // get text, accounting for possible
	        // whitespace (carriage return) text nodes 
	        if (result.childNodes.length > 1) {
				return result.childNodes[1].nodeValue;
	        } else {
				return result.firstChild.nodeValue;
	        }
	    } else {
	        return "n/a";
	    }
	}

	this.js_in_array = function (the_needle, the_haystack){
		var the_hay = the_haystack.toString();
		if(the_hay == ''){
			return false;
		}
		var the_pattern = new RegExp(the_needle, 'g');
		var matched = the_pattern.test(the_haystack);
		return matched;
	}

	this.goTimeout = false;
	this.hasScrolled = false;
	this.usedIds = new Array();
	this.usedIdTimes = new Array();
	this.buffer = 5; // buffer of chat messages to load, in seconds
	this.username = "Me";
	this.intervalDefault = 2000; // 2 seconds default between refreshes
	this.interval = this.intervalDefault;
	this.intervalIncreaseDelay = 10; // start increasing interval after 5 seconds of inactivity
	this.intervalIncreaseRate = 500; // increase interval by half a second each time
	this.intervalLimit = 30000; // maximum 30 seconds between refreshes
	this.lastTime = this.time();
	this.usedIdTimes[0] = this.lastTime - (60 * 60 * 12);
	this.titleTimeout = null;

}
