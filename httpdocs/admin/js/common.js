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
      
                    //��������Ȃ��̂Ȃ�폜���Ă��������B  
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
   // #�Ŏn�܂�A���J�[���N���b�N�����ꍇ�ɏ���
   $('a[href^=#]').click(function() {
      // �X�N���[���̑��x
      var speed = 400;// �~���b
      // �A���J�[�̒l�擾
      var href= $(this).attr("href");
      // �ړ�����擾
      var target = $(href == "#" || href == "" ? 'html' : href);
      // �ړ���𐔒l�Ŏ擾
      var position = target.offset().top;
      // �X���[�X�X�N���[��
      $($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});

$(function() {
	var topBtn = $('#pagetop');	
	topBtn.hide();
	//�X�N���[����100�ɒB������{�^���\��
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			topBtn.fadeIn();
		} else {
			topBtn.fadeOut();
		}
	});
	//�X�N���[�����ăg�b�v
    topBtn.click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 500);
		return false;
    });
});