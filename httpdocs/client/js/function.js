//検索エリアの表示・非表示の切り替え
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


//チェックボックスを一括でON/OFFにする
var count;
	function BoxChecked(check){
		for(count = 0; count < document.form1.r1.length; count++){
		document.form1.r1[count].checked = check;
			}
	}


//チェックボックス背景色を一括で変更する
function allClrON(){
	var element = document.getElementById("approach"); 
	var childs = element.childNodes;
	childs[0].backgroundColor = '#2CA610';
}



//タブ切り替え
$(function() {
	$("#tab li").click(function() {
		var num = $("#tab li").index(this);
		$(".content_wrap").addClass('disnon');
		$(".content_wrap").eq(num).removeClass('disnon');
		$("#tab li").removeClass('select');
		$(this).addClass('select')
	});
});