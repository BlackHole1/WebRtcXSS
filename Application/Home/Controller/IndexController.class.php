<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	public function index(){
		$project = M("project");
		$projectInfo = $project->order('create_time DESC')->select();
		for($i = 0;$i < count($projectInfo);$i++){
			switch ($projectInfo[$i]['stage']) {
				case '0':
					$projectInfo[$i]['stage'] = "未被触发";
					break;
				case '1':
					$projectInfo[$i]['stage'] = "获取到内网IP信息";
					break;
				case '2':
					$projectInfo[$i]['stage'] = "检测到内网中开启了80端口的IP";
					break;
				case '3':
					$projectInfo[$i]['stage'] = "已确认内网存活主机的CMS信息";
					break;
				case '4':
					$projectInfo[$i]['stage'] = "已检测到内网主机中的漏洞真实存在";
					break;
				default:
					$projectInfo[$i]['stage'] = "未被触发";
					break;
			}
		}
		$this->assign('projects',$projectInfo);
		$this->display();
	}
}