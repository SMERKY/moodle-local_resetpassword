var latestJavaVersion;


function runCookieCheck(root){
	var html = '<div id="computerchecker"><a href="'+root+'/local/computerchecker/view.php"><span>YOUR COMPUTER IS NOT READY!</span></a></div>';
	console.log('Computer Checker ----- Reading Cookie');
	if(readCookie('computerchecker') != 'PASS'){
		console.log('Computer Checker ----- Result - FAIL');
		$('#page').prepend(html);
	}else{
		console.log('Computer Checker ----- Result - PASS');
	}
}

function runComputerCheck(root){
	var html = '<div id="computerchecker"><a href="'+root+'/local/computerchecker/view.php"><span>YOUR COMPUTER IS NOT READY!</span></a></div>';
	if(!document.cookie.search(/(^|;)computerchecker=/) > -1){
		console.log('Computer Checker ----- Checking Computer Requirements');
		var pass = loadInitialCheck();
		var result = '';
		if(pass == false){
			result = 'PASS';
		}else{
			result = 'FAIL';
			$('#page').prepend(html);
		}
		console.log('Computer Checker ----- Result - ' + result);
		console.log('Computer Checker ----- Setting Cookie');
		document.cookie = "computerchecker" + '=' + result;
	}
}

function readCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	}
	return null;
}

function loadInitialCheck(){
	//check versions
	
	var browser = checkBrowser();
	checkOS();
	var flash = checkPlugin('Flash', 'flash', 10);
	var javaplugin = checkPlugin('Java', 'java', latestJavaVersion);
	var displayError = false;
	
	console.log('Computer Checker ----- Test - Browser(' + browser + ') Flash(' + flash + ') Java(' + javaplugin + ')');

	if(!flash || !javaplugin || !browser){
		displayError = true;
	}
	
	return displayError;
}

function checkPlugin(a,c,b){
	if(PluginDetect.isMinVersion(a)>=0){
		if(PluginDetect.getVersion(a)){
		}
		if(b&&PluginDetect.isMinVersion(a,b)<0){
			return false;
		}else{
			return true;		
		}
	}else{
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
	if(($.browser.name!="msie"&&$.browser.name!="firefox"&&$.browser.name!="safari"&&$.browser.name!="chrome")||($.browser.name=="msie"&&$.browser.versionNumber<8)||($.browser.name=="firefox"&&$.browser.versionNumber<17)||($.browser.name=="safari"&&$.browser.versionNumber<5)||($.browser.name=="chrome"&&$.browser.versionNumber<17)){
		return false;
	}else{
		return true;
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
		$.os={name:(/(win|mac|linux|sunos|solaris|iphone)/.exec(navigator.platform.toLowerCase())||[u])[0].replace('sunos','solaris')};
	
		if(!z){
			$('html').addClass([$.os.name,$.browser.name,$.browser.className,$.layout.name,$.layout.className].join(' '));
		}
	};
	$.browserTest(navigator.userAgent);
}