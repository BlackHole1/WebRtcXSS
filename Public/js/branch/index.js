$(document).ready(function(){
	function more_article(){
		var page = 1;
		$(".more-article button").click(function(){
			page++;
			$.getJSON('/Api/artclesList/page/' + page,function(json){
				if(json.length == 0){
					$(".more-article button").text("没有文章了").attr("disabled","false");
					return false;
				}else if(json.length < 20){
					$(".more-article button").text("没有文章了").attr("disabled","false");
				}
				for(var i = 0;i < json.length;i++){
					$(".article-list").append('<div class="article">\
					<div class="header-info">\
						<div class="title">\
							<a href="#" title="' + json[i].title + '">' + json[i].title + '</a>\
						</div>\
						<div class="author">\
							<ul>\
								<li>\
									<span class="glyphicon glyphicon-user"></span>\
									<a href="" title="' + json[i].author + '">' + json[i].author + '</a>\
								</li>\
								<li>\
									<span class="glyphicon glyphicon-th-list"></span>\
									<a href="" title="' + json[i].category + '">' + json[i].category + '</a>\
								</li>\
								<li>\
									<span class="glyphicon glyphicon-time"></span>\
									<span>' + json[i].time + '</span>\
								</li>\
								<li>\
									<span class="glyphicon glyphicon-eye-open"></span>\
									<span>' + json[i].look + '</span>\
								</li>\
								<li>\
									<span class="glyphicon glyphicon-comment"></span>\
									<span>' + json[i].comments + '</span>\
								</li>\
							</ul>\
						</div>\
					</div>\
					<div class="clear"></div> \
					<div class="body">\
						' + json[i].body + '\
					</div>\
					<hr />\
				</div>');
				}
			});
			$(this).text('加载更多文章');
		})
	}
	more_article()
});