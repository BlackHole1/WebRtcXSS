$("a[href='"+location.pathname+"']").parent().addClass('active');
$("tbody tr").map(function(index) {
	$(this).find("th").text(index+1)
})
$("a[href='#addProject']").click(function(){
	swal({
		title: "添加新的项目",
		text: '请在下面输入地址与密码<br><input type="text" class="form-control alert-input" placeholder="项目名称"><input type="text" class="form-control alert-input" placeholder="项目备注">',
		html: true,
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText:"添加",
		cancelButtonText:"取消",
		showLoaderOnConfirm: true, 
	},
	function(){
    	var name = $(".alert-input:first").val();
    	var note = $(".alert-input:eq(1)").val();
		if (name === ""){
			swal.showInputError("项目名称为空！");
			return false;
		}
		$.ajax({
			url: '/RootApi/addProject',
			type: 'post',
			dataType: 'json',
			data: {name: name,note:note},
		})
		.done(function(json) {
			console.log(json.msgText,json)
			swal({
				title: json.typeMsg,
				text: json.msgText,
				confirmButtonText:"确认",
			},
			function(isConfirm){
				if(isConfirm){
					window.location.reload();
				}
			})
		})
	})
});
$("a[href='#delProject']").click(function(){
	var projectId = $(this).attr('data-id');
	swal({
		title: "Delete?",
		text: '确认要删除此项目么？',
		showCancelButton: true,
		closeOnConfirm: false,
		confirmButtonText:"添加",
		cancelButtonText:"取消",
		showLoaderOnConfirm: true, 
	},
	function(){
		$.ajax({
			url: '/RootApi/delProjectId',
			type: 'post',
			dataType: 'json',
			data: {id: projectId},
		})
		.done(function(json) {
			swal({
				title: json.typeMsg,
				text: json.projectInfo,
				confirmButtonText:"确认",
			},
			function(isConfirm){
				if(isConfirm){
					window.location.reload();
				}
			})
		})
	})
})
$("tbody tr td:not(:last)").click(function(){
var valId = $(this).parent().find("td:last a").attr("data-id");
	$.getJSON('/RootApi/findProject/id/' + valId,function(json){
		if(json.typeMsg == "success"){
			$(".modal-body").html('\
				<p>\
					<span class="iconfont">&#xe603;</span>\
					<b><span>项目名称：</span></b>\
					<i>'+json.projectInfo.name+'</i>\
				</p>\
				<p>\
					<span class="iconfont">&#xe608;</span>\
					<b><span>项目备注：</span></b>\
					<i>'+json.projectInfo.note+'</i>\
				</p>\
				<p>\
					<span class="iconfont">&#xe60c;</span>\
					<b><span>项目hash：</span></b>\
					<i>'+json.projectInfo.onlystring+'</i>\
				</p>\
				<p>\
					<span class="iconfont">&#xe607;</span>\
					<b><span>项目状态：</span></b>\
					<i>'+json.projectInfo.stagestring+'</i>\
				</p>\
				<p>\
					<span class="iconfont">&#xe601;</span>\
					<b><span>项目JavaScript文件地址：</span></b>\
					<i><a href="'+json.projectInfo.jsfile+'" target="_blank">'+json.projectInfo.jsfile+'</a></i>\
				</p>\
				<p>\
					<span class="iconfont">&#xe600;</span>\
					<b><span>项目创建时间：</span></b>\
					<i>'+json.projectInfo.time+'</i>\
				</p>\
			');
			switch(json.projectInfo.stage){
				case '0':
					break;
				case '1':
					$(".modal-body").append('\
						<p>\
							<span class="iconfont">&#xe604;</span>\
							<b><span>内网IP：</span></b>\
							<i>'+json.projectInfo.survivalip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe60b;</span>\
							<b><span>外网IP：</span></b>\
							<i>'+json.projectInfo.outsideip+'</i>\
						</p>\
					');
					break;
				case '2':
					$(".modal-body").append('\
						<p>\
							<span class="iconfont">&#xe606;</span>\
							<b><span>内网IP：</span></b>\
							<i>'+json.projectInfo.survivalip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe60b;</span>\
							<b><span>外网IP：</span></b>\
							<i>'+json.projectInfo.outsideip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe604;</span>\
							<b><span>外网开放80端口IP：</span></b>\
							<i>'+json.projectInfo.survivalportip+'</i>\
						</p>\
					');
					break;
				case '3':
					$(".modal-body").append('\
						<p>\
							<span class="iconfont">&#xe606;</span>\
							<b><span>内网IP：</span></b>\
							<i>'+json.projectInfo.survivalip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe60b;</span>\
							<b><span>外网IP：</span></b>\
							<i>'+json.projectInfo.outsideip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe604;</span>\
							<b><span>内网开放80端口IP：</span></b>\
							<i>'+json.projectInfo.survivalportip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe609;</span>\
							<b><span>内网具有CMS的IP：</span></b>\
							<i>'+json.projectInfo.cmsip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe602;</span>\
							<b><span>内网IP的CMS类型：</span></b>\
							<i>'+json.projectInfo.cms+'</i>\
						</p>\
					');
					break;
				case '4':
					$(".modal-body").append('\
						<p>\
							<span class="iconfont">&#xe606;</span>\
							<b><span>内网IP：</span></b>\
							<i>'+json.projectInfo.survivalip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe60b;</span>\
							<b><span>外网IP：</span></b>\
							<i>'+json.projectInfo.outsideip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe604;</span>\
							<b><span>内网开放80端口IP：</span></b>\
							<i>'+json.projectInfo.survivalportip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe609;</span>\
							<b><span>内网具有CMS的IP：</span></b>\
							<i>'+json.projectInfo.cmsip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe602;</span>\
							<b><span>内网IP的CMS类型：</span></b>\
							<i>'+json.projectInfo.cms+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe605;</span>\
							<b><span>发现漏洞的IP：</span></b>\
							<i>'+json.projectInfo.vulip+'</i>\
						</p>\
						<p>\
							<span class="iconfont">&#xe60a;</span>\
							<b><span>漏洞IP所属的CMS：</span></b>\
							<i>'+json.projectInfo.vulcms+'</i>\
						</p>\
					');
					break;
			}
		}
	});
})