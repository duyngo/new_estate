    $(function()  
    {  
            var targetImgs = $('img');
            targetImgs.each(function()  
            {  
                if(this.src.match('_off')) 
                {  
                    this.rollOverImg = new Image();  
                    this.rollOverImg.src = this.getAttribute("src").replace("_off", "_on");  
                    $(this.rollOverImg).css({position: 'absolute', opacity: 0});  
                    $(this).before(this.rollOverImg);  
      
                    //ここいらないのなら削除してください。  
                    $(this.rollOverImg).mousedown(function(){  
                        $(this).stop().animate({opacity: 0}, {duration: 0, queue: false});  
                    });  
      
                    $(this.rollOverImg).hover(function(){  
                        $(this).animate({opacity: 1}, {duration: 200, queue: false});  
                    },  
                    function(){  
                        $(this).animate({opacity: 0}, {duration: 200, queue: false});  
                    });  
      
                }  
            });  
    }); 

$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 400;// ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      var position = target.offset().top;
      // スムーススクロール
      $($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});

$(function() {
	var topBtn = $('#pagetop');	
	topBtn.hide();
	//スクロールが100に達したらボタン表示
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
	//スクロールしてトップ
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});