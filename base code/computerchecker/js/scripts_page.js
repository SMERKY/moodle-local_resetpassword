
$(document).ready(function(){
	checkBrowser();
	var latestJavaVersion = checkOS();
	var flash = checkPlugin('Flash', 'flash',10);
	var java = checkPlugin('Java', 'java', latestJavaVersion);
	var display = false;
	
	if(flash == false){
		display = true;
		$("#flashlink").show();
	}
	if(java == false){
		display = true;
		$("#javalink").show();
	}
	if(display == true){
		$("#pluginlink").show();
		$("#check-failed-wrapper").show();
	}
});

function capitaliseFirstLetter(string){
    return string.charAt(0).toUpperCase() + string.slice(1);
}


function checkPlugin(a,c,b){
	if(PluginDetect.isMinVersion(a)>=0){
		if(PluginDetect.getVersion(a)){
			$("#"+c+"_ver").text(PluginDetect.getVersion(a).replace(/,/g,"."))
		}
		if(b&&PluginDetect.isMinVersion(a,b)<0){
			$("#"+c+"_inst").text("Outdated").addClass("fail").siblings(".link").fadeIn("slow");
			return false;
		}else{
			$("#"+c+"_inst").text("Yes").addClass("success");
			return true;		
		}
	}else{
		$("#"+c+"_inst").text("No").addClass("fail").siblings(".link").fadeIn("slow");
		return false;
	}
}

function checkOS(){
	if($.os.name=="mac"){
		latestJavaVersion="10.6.11";
	}else{
		latestJavaVersion="1.7.0_25";
	}
}

function checkBrowser(){
	testBrowser();
	if($.browser.name == 'msie'){
		$("#browse").html('<img src="pix/ie.png" class="img-icon">Internet Explorer');
	}else{
		$("#browse").html('<img src="pix/'+$.browser.name+'.png" class="img-icon">'+capitaliseFirstLetter($.browser.name));
		//$("#browse").html('<img src="pix/safari.png" class="img-icon">Internet Explorer');
	}
	$("#browseversion").text($.browser.version);
	if(($.browser.name!="msie"&&$.browser.name!="firefox"&&$.browser.name!="safari"&&$.browser.name!="chrome")||($.browser.name=="msie"&&$.browser.versionNumber<8)||($.browser.name=="firefox"&&$.browser.versionNumber<17)||($.browser.name=="safari"&&$.browser.versionNumber<5)||($.browser.name=="chrome"&&$.browser.versionNumber<17)){
		$("#browselink").show();
		$("#browsesupported").html("No<br />Please download and install one of the following supported browsers.").addClass("fail");
	}else{
		$("#browsesupported").text("Yes").addClass("success");
	}
}

function testBrowser(){
	$.browserTest=function(a,z){
		var u='unknown',x='X',m=function(r,h){
			for(var i=0;i<h.length;i=i+1){
				r=r.replace(h[i][0],h[i][1]);
			}
			return r;
		},c=function(i,a,b,c){
			var r={
				name:m((a.exec(i)||[u,u])[1],b)
			};
			r[r.name]=true;
			r.version=(c.exec(i)||[x,x,x,x])[3];
			if(r.name.match(/safari/)&&r.version>400){
				r.version='2.0';
			}
			if(r.name==='presto'){
				r.version=($.browser.version>9.27)?'futhark':'linear_b';
			}
			r.versionNumber=parseFloat(r.version,10)||0;
			r.versionX=(r.version!==x)?(r.version+'').substr(0,1):x;r.className=r.name+r.versionX;
			return r;
		};
		a=(a.match(/Opera|Navigator|Minefield|KHTML|Chrome/)?m(a,[[/(Firefox|MSIE|KHTML,\slike\sGecko|Konqueror)/,''],['Chrome Safari','Chrome'],['KHTML','Konqueror'],['Minefield','Firefox'],['Navigator','Netscape']]):a).toLowerCase();
		$.browser=$.extend((!z)?$.browser:{},c(a,/(camino|chrome|firefox|netscape|konqueror|lynx|msie|opera|safari)/,[],/(camino|chrome|firefox|netscape|netscape6|opera|version|konqueror|lynx|msie|safari)(\/|\s)([a-z0-9\.\+]*?)(\;|dev|rel|\s|$)/));
		$.layout=c(a,/(gecko|konqueror|msie|opera|webkit)/,[['konqueror','khtml'],['msie','trident'],['opera','presto']],/(applewebkit|rv|konqueror|msie)(\:|\/|\s)([a-z0-9\.]*?)(\;|\)|\s)/);
		$.os={
			name:(/(win|mac|linux|sunos|solaris|iphone)/.exec(navigator.platform.toLowerCase())||[u])[0].replace('sunos','solaris')
		};
	
		if(!z){
			$('html').addClass([$.os.name,$.browser.name,$.browser.className,$.layout.name,$.layout.className].join(' '));
		}
	};	
	$.browserTest(navigator.userAgent);
}