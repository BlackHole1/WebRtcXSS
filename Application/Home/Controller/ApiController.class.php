<?php
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    public function survivalIp(){
        header('Access-Control-Allow-Origin: *');
        if(I('post.survivalip')  == "" || I('post.onlystring')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $survivalIp = M("survivaliplist");
        $survivalIpData['outside_ip']  = I('server.REMOTE_ADDR');
        $survivalIpData['survival_ip'] = I('post.survivalip');
        $survivalIpData['onlystring'] = I('post.onlystring');
        $survivalIpData['create_time'] = date('Y-m-d H:i:s');
        $survivalIp->data($survivalIpData)->add();
    }
    public function survivalPortIp(){
        header('Access-Control-Allow-Origin: *');
        /*
        * 把客户端检测到的存活IP加入到数据库中
        */
        if(I('post.iplist')  == "" || I('post.onlystring')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $ipDateList = M('ipdatalist');
        $ipData['survival_ip'] = I('post.iplist');
        $ipData['onlystring'] = I('post.onlystring');
        $ipData['create_time'] = date('Y-m-d H:i:s');
        $ipDateList->data($ipData)->add();
        /*
        * 获取数据库中的cms路径，发送给客户端
        */
        $cmsPath  = M('cmspath');
        $pathInfo = $cmsPath->getField('cms,path');
        $this->ajaxReturn(array(
            "typeMsg" => "success",
            "path"    => $pathInfo,
        ));
    }
    public function _empty(){
        echo "<img src='http://i0.hdslb.com/video/bc/bc69ca9fd833973bdd5628e9e18b2008.jpg'>";
    }
    public function survivalCmsIp(){
        header('Access-Control-Allow-Origin: *');
        /*
        * 把客户端检测到存在CMS的IP加入到数据库中
        */
        if(I('post.existenceCmsIp')  == "" || I('post.existenceCmsInfo') == "" || I('post.onlystring') == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $existenceCmsIp               = I('post.existenceCmsIp');
        $existenceCmsInfo             = I('post.existenceCmsInfo');
        $onlyString                   = I('post.onlystring');
        $existencecmsip               = M('existencecmsip');
        $existenceData['inner_ip']    = $existenceCmsIp;
        $existenceData['cms']         = $existenceCmsInfo;
        $existenceData['onlystring'] = $onlyString;
        $existenceData['create_time'] = date('Y-m-d H:i:s');
        $existencecmsip->data($existenceData)->add();
        /*
        * 获取数据库中的cms漏洞详情，发送给客户端
        */
        $cmsvul  = M('cmsvul');
        $vulInfo = base64_decode($cmsvul->where('cms="'.$existenceCmsInfo.'"')->getField("vulinfo"));
        echo "http://".$existenceCmsIp.$vulInfo;
    }
    public function existenceVul(){
        header('Access-Control-Allow-Origin: *');
        if(I('post.cms')  == "" || I('post.vulip')  == "" || I('post.onlystring')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $existenceVul = M("existencevul");
        $existenceVulData['cms'] = I('post.cms');
        $existenceVulData['vulip'] = I('post.vulip');
        $existenceVulData['onlystring'] = I('post.onlystring');
        $existenceVulData['create_time'] = date('Y-m-d H:i:s');
        $existenceVul->data($existenceVulData)->add();
    }
    public function stage(){
        header('Access-Control-Allow-Origin: *');
        if(I('get.updata','','int')  == "" || I('get.onlystring')  == ""){
            $this->ajaxReturn(array(
                "typeMsg" => "error",
            ));
        }
        $project = M('project');
        $porjectData['stage'] = I('get.updata','','int');
        $project->where('onlystring="'.I('get.onlystring').'"')->save($porjectData);
    }
}