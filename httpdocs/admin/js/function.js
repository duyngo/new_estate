//�����G���A�̕\���E��\���̐؂�ւ�
$(function() {
	$('div.toggle_search').show();
		$('p.trigger_search').click(function() {
			var $this = $(this);
				if ($this.hasClass('active_search')) {
					$this.removeClass('active_search');
				}else {
					$this.addClass('active_search');
			}
		$this.next('.toggle_search').slideToggle('slow');
	});
});


//�`�F�b�N�{�b�N�X���ꊇ��ON/OFF�ɂ���
var count;
	function BoxChecked(check){
		for(count = 0; count < document.form1.r1.length; count++){
		document.form1.r1[count].checked = check;
			}
	}


//�`�F�b�N�{�b�N�X�w�i�F���ꊇ�ŕύX����
function allClrON(){
	var element = document.getElementById("approach"); 
	var childs = element.childNodes;
	childs[0].backgroundColor = '#2CA610';
}



//�^�u�؂�ւ�
$(function() {
	$("#tab li").click(function() {
		var num = $("#tab li").index(this);
		$(".content_wrap").addClass('disnon');
		$(".content_wrap").eq(num).removeClass('disnon');
		$("#tab li").removeClass('select');
		$(this).addClass('select')
	});
});