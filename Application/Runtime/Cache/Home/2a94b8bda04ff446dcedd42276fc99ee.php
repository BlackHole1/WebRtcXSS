<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>WebrtcXss</title>
	<link rel="stylesheet" type="text/css" href="/Public/css/library/bootstrap/bootstrap.css" /><link rel="stylesheet" type="text/css" href="/Public/css/library/sweetalert.css" /><link rel="stylesheet" type="text/css" href="/Public/css/library/iconfont.css" /><link rel="stylesheet" type="text/css" href="/Public/css/base/base.css" />
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebrtcXss</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/">首页</a></li>
        <li><a href="#addProject">添加项目</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">XSS自动化入侵内网反馈平台</a></li>
        <li><a href="http://weibo.com/comelove/">Black-Hole</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
<?php if(count($projects) > 0): ?><table class="table table-hover">
		<thead>
			<tr>
				<th>项目</th>
				<th>名称</th>
				<th>备注</th>
				<th>现阶段</th>
				<th>时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php if(is_array($projects)): $i = 0; $__LIST__ = $projects;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
				<th scope="row"></th>
				<td  data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo ($vo["name"]); ?></td>
				<td  data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo ($vo["note"]); ?></td>
				<td  data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo ($vo["stage"]); ?></td>
				<td  data-toggle="modal" data-target=".bs-example-modal-lg"><?php echo ($vo["create_time"]); ?></td>
				<td><a href="#delProject" data-id="<?php echo ($vo["id"]); ?>">删除</a></td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		</tbody>
	</table>
<?php else: ?>
	<div class="jumbotron">
		<h1>Don't Have Projects</h1>
		<p>点击下面的按钮建立起自己第一个项目吧</p>
		<p><a class="btn btn-primary btn-lg" href="#addProject" role="button">Fuck Me</a></p>
	</div><?php endif; ?>
</div>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">漏洞详情</h4>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
			</div>
		</div>
	</div>
</div>

</body>
<script type="text/javascript" src="/Public/js/library/jquery.js"></script><script type="text/javascript" src="/Public/js/library/bootstrap.js"></script><script type="text/javascript" src="/Public/js/library/sweetalert.js"></script><script type="text/javascript" src="/Public/js/base/base.js"></script>
</html>