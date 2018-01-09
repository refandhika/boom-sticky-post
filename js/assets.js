jQuery(document).ready(function($){
	if($(".sticky-post").length!=0){
		var stickypost = Math.round($(".sticky-post").offset().top) + 500;
		var spf = true;
		if(pagedata.stickyid!=null){
			var stickyid = parseInt(pagedata.stickyid);
		};
		$(window).scroll(function(){
			if($(window).scrollTop() > stickypost && spf) {
				var title = 'Sticky Post : ' + pagedata.title;
				var url = pagedata.permalink;
				url = url.replace('https://www.boombastis.com','');
				
				history.pushState(null,title,url);

				if(typeof ga === "function"){
					ga('set', 'page', url);
					ga('set', 'title', title);
					ga('send', 'pageview');
				}

				/* Append additional scripts */
				var s = document.createElement('script');
				s.append(pagedata.addscript);
				document.head.appendChild(s);
				
				spf = false;
			};
		});
	};
});