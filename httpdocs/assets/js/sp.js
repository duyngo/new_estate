$(function() {
  $(".main-gallery").flickity();
});

$(document).ready(function() {
  $(".drawer").drawer();
});

$(function() {
  $(".tabs a").on('click', function(e) {
    e.preventDefault();
    var target = $(this).attr('href');
    if (! $(target).length) return false;
    $('.tab', $(this).closest('.tabs')).removeClass('active');
    $(this).closest('.tab').addClass('active');
    $('.panel', $(target).closest('.panels')).removeClass('active');
    $(target).addClass('active');
  });
});

$(function() {
  $("#acMenu #icn").on("click", function() {
    $(this).next().slideToggle();
  });
});

$(function() {
  $(window).scroll(
    function() {
      var now = $(window).scrollTop();
      var under = $("body").height() - (now + $(window).height());
      if(now > 800 && under > 280) {
        $("#mdDTL01CallIcn").fadeIn("fast");
      }else {
        $("#mdDTL01CallIcn").fadeOut("fast");
      }
    }
  );
});

$(function() {
  $(window).scroll(
    function() {
      var now = $(window).scrollTop();
      var under = $("body").height() - (now + $(window).height());
      var str = $(".mdSAC03IconBox").css("height");
      var height = parseInt(str);
      console.log(height);
      if(height < 100) {
        console.log("small");
        if(now > 500 && under > 500) {
          $(".mdSAC04EnquiryBox").fadeIn("fast");
        }else {
          $(".mdSAC04EnquiryBox").fadeOut("fast");
        }
      } else {
        console.log("big");
        $(".mdSAC04EnquiryBox").css("display", "none");
      }
    }
  );
});
