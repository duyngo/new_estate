var npl=window.npl||{};npl.lib={init:function(){var e=this;e.setOrientation(),$(function(){e.setDevice()}),$.ua.isLtIE9},setDevice:function(){var e=$.ua.isIE6?"msie6":$.ua.isIE7?"msie7":$.ua.isIE8?"msie8":$.ua.isIE9?"msie9":$.ua.isIE10?"msie10":$.ua.isIE11?"msie11":$.ua.isChrome?"chrome":$.ua.isSafari?"safari":$.ua.isFirefox?"firefox":"",n=$.ua.isLtIE9?"ltie9":$.ua.isLtIE10?"ltie10":$.ua.isLtIE11?"ltie11":"",i=$.ua.isIE?"msie":"",t=$.ua.isWindows?"ExWin":$.ua.isMacintosh?"ExMac":$.ua.isIOS?"ios":"",a=$.ua.isTouchDevice?"tablet":"",o=$.ua.isIPhone?"ExIphone":$.ua.isIPad?"ExIpad":$.ua.isIPhone4?"ExIphone4":$.ua.isIPad3?"ExIpad3":$.ua.isAndroid?"ExAndroid":"";e+i+n+t+o!==""&&$("html").eq(0).addClass(e+" "+i+" "+n+" "+a+" "+t+" "+o+" ")},setOrientation:function(){var e=0===window.orientation?"portrait":"landscape",n=$("html").eq(0).addClass(e);$(window).portrait(function(){n.removeClass("landscape").addClass("portrait")}).landscape(function(){n.removeClass("portrait").addClass("landscape")})}},npl.lib.init();var TopGallery={conf:{Elem:"#FnTOP01TopVisual",ElemItem1:"#FnTOP01TopVisual span",ElemItem2:"#FnTOP01TopVisual .MdTOP01MainTtl",ElemItem3:"#FnTOP01TopVisual p",ElemItem4:"#FnTOP01TopVisual a",currentIndex:0,totalCount:0,intervalTime:5e3},init:function(){var e=this,n=e.conf;$(n.Elem1).ready(function(i){n.totalCount=$(n.ElemItem1).length,e.interval(n,e)})},interval:function(e,n){var i;setTimeout(function(){i=e.currentIndex,e.currentIndex==e.totalCount-1?e.currentIndex=0:e.currentIndex=e.currentIndex+1,n.animation(e,n,i,e.currentIndex)},e.intervalTime)},animation:function(e,n,i,t){$(e.ElemItem2).eq(i).css({display:"none"}),$(e.ElemItem3).eq(i).css({display:"none"}),$(e.ElemItem4).eq(i).css({display:"none"}),$(e.ElemItem1).eq(i).animate({opacity:"0"},500,function(){$(e.ElemItem1).eq(i).removeClass("ExActive")}),$(e.ElemItem1).eq(t).animate({opacity:"1"},500,function(){$(e.ElemItem1).eq(t).addClass("ExActive"),$(e.ElemItem2).eq(t).css({display:"block"}),$(e.ElemItem3).eq(t).css({display:"block"}),$(e.ElemItem4).eq(t).css({display:"block"}),n.interval(e,n)})}},Header={conf:{Elem:"#FnLyHead",ElemWrap:"#FnLyHeadWrap",AnimTime:"1.0s",OpenFlag:!1},init:function(e){var n=this,i=n.conf;switch(e){case"showHeader":n.showHeader(i,n),i.OpenFlag=!0;break;case"hideHeader":n.hideHeader(i,n),i.OpenFlag=!1}},showHeader:function(e,n){n.animation(e,n,"show")},hideHeader:function(e,n){n.animation(e,n,"hide")},animation:function(e,n,i){var t;"show"===i?t=0:(t=-75,$("#FnGHD05SearchBox").hide()),$(e.Elem).css({top:t,"transition-duration":e.AnimTime,"-webkit-transition-duration":e.AnimTime,"-moz-transition-duration":e.AnimTime,"-o-transition-duration":e.AnimTime}),$(e.Elem).bind("oTransitionEnd mozTransitionEnd webkitTransitionEnd transitionend",function(){})}},EventListener={conf:{headSearchTrigger:"#FnGHD02Search",headSearchTriggerTop:"#FnGHD02SearchTop",headSearchBox:"#FnGHD05SearchBox",headSearchBoxTop:"#FnGHD05SearchBoxTop",howtoTrigger:"#FnCMN02List02 li",howtoBox:"#FnCMN02MenuBox",howtoArrow:"#FnCMN02Arrow01",floorMapTrigger:"#FnDTL06List01 li",topVisualImg:"#FnTOP01TopVisual img",contactSubmit:"#FnCNT04Btn01",topVisualImgWidth:2e3,searchBoxOpen:!1},init:function(){var e=this,n=e.conf;e.load(n,e),e.click(n,e),e.hover(n,e),e.scroll(n,e)},load:function(e,n){$win=$(window),$win.on("load",function(n){$(e.topVisualImg).width($win.width>e.topVisualImgWidth?$win.innerWidth:e.topVisualImgWidth),setTimeout(function(){$("#FnTOP03Loading").fadeOut(500,function(e){$("#FnTOP03Loading").remove()})},300)})},resize:function(e,n){$win=$(window),$win.on("resize",function(n){$(e.topVisualImg).width($win.width>e.topVisualImgWidth?$win.innerWidth:e.topVisualImgWidth)})},hover:function(e,n){$(document).on("mouseenter",e.headSearchTrigger,function(n){e.searchBoxOpen||($(e.headSearchTrigger).addClass("ExBoxOpen"),$(e.headSearchBox).css({display:"block"}),e.searchBoxOpen=!0)}),$(document).on("mouseleave",e.headSearchTrigger,function(n){e.searchBoxOpen&&($(e.headSearchTrigger).removeClass("ExBoxOpen"),$(e.headSearchBox).css({display:"none"}),e.searchBoxOpen=!1)}),$(document).on("mouseenter",e.headSearchTriggerTop,function(n){e.searchBoxOpen||($(e.headSearchTriggerTop).addClass("ExBoxOpen"),$(e.headSearchBoxTop).css({display:"block"}),e.searchBoxOpen=!0)}),$(document).on("mouseleave",e.headSearchTriggerTop,function(n){e.searchBoxOpen&&($(e.headSearchTriggerTop).removeClass("ExBoxOpen"),$(e.headSearchBoxTop).css({display:"none"}),e.searchBoxOpen=!1)})},click:function(e,n){$(e.howtoTrigger).on("click",function(n){var i=$(e.howtoTrigger).index(this),t=0;$(e.howtoTrigger).each(function(n){t!=i&&$(this).children(e.howtoBox).addClass("ExHide"),t++});var a=$(this).children(e.howtoBox);a.toggleClass("ExHide")}),$(e.floorMapTrigger).on("click",function(n){var i=$(e.floorMapTrigger).index(this);$(e.floorMapTrigger).eq(i).hasClass("ExActive")||($(e.floorMapTrigger).removeClass("ExActive"),$(e.floorMapTrigger).eq(i).addClass("ExActive"),$(".MdDTL06Content").addClass("ExHide"),$("#FnContent"+i).removeClass("ExHide"))}),$(e.contactSubmit).on("click",function(e){$("#FnContactForm").submit()})},scroll:function(e,n){var i=$(window),t=$("body"),a=0;if(t.hasClass("ExDetail")||t.hasClass("ExContactTop"))var o=$("#FnSideWrap"),s=$("#FnSide"),r=$("#FnContents"),c=s.offset().top,l=o.offset().top,d=r.offset().top;i.on("scroll",function(e){if(t.hasClass("ExTop")&&(a=$(this).scrollTop(),a>500?Header.conf.OpenFlag||Header.init("showHeader"):Header.conf.OpenFlag&&Header.init("hideHeader")),t.hasClass("ExDetail")||t.hasClass("ExContactTop")){l="static"===o.css("position")?c+o.position().top:l;var n=o.outerHeight(!0),s=r.outerHeight(),m=i.scrollTop();m+n>d+s?o.css({position:"absolute",top:s-n-15}):m>=l?o.css({position:"fixed",top:10}):o.css("position","static")}})}},Slick={conf:{ElemParent:"#FnDTL01Slick",AnimeTarget:"#FnDTL01SlickList",Elem:"#FnDTL01SlickList div",ElemNavi:"#FnDTL01SlickNavi div",ElemCaption:"#FnDTL01Caption p",ElemPrev:"#FnDTL01Prev",ElemNext:"#FnDTL01Next",AnimeDist:0,AnimTime:"1.0s",ElemWidth:570,ElemSpace:94,currentIndex:0,totalCount:0},init:function(){var e=this,n=e.conf;n.ElemDist=n.ElemWidth+n.ElemSpace,$(n.ElemParent).ready(function(e){n.totalCount=$(n.Elem).length,$(n.AnimeTarget).width((n.ElemWidth+n.ElemSpace)*n.totalCount)}),$(n.ElemPrev).on("click",function(i){i.stopPropagation(),0!=n.currentIndex&&(e.animation(n,e,n.currentIndex,n.currentIndex-1),e.activeThumb(n,e,n.currentIndex-1),n.currentIndex=n.currentIndex-1)}),$(n.ElemNext).on("click",function(i){i.stopPropagation(),n.currentIndex!=n.totalCount&&(e.animation(n,e,n.currentIndex,n.currentIndex+1),e.activeThumb(n,e,n.currentIndex+1),n.currentIndex=n.currentIndex+1)}),$(n.ElemNavi).on("click",function(i){i.stopPropagation();var t=$(n.ElemNavi).index(this);e.animation(n,e,n.currentIndex,t),e.activeThumb(n,e,t),n.currentIndex=t})},activeThumb:function(e,n,i){console.log(i),0==i?$(e.ElemPrev).addClass("ExHide"):i==e.totalCount-1?$(e.ElemNext).addClass("ExHide"):($(e.ElemPrev).removeClass("ExHide"),$(e.ElemNext).removeClass("ExHide")),$(e.ElemNavi).removeClass("ExActive"),$(e.ElemNavi).eq(i).addClass("ExActive"),$(e.ElemCaption).addClass("ExHide"),$(e.ElemCaption).eq(i).removeClass("ExHide")},animation:function(e,n,i,t){i!=t&&(e.transForm=-1*e.ElemDist*t,$(e.AnimeTarget).css({marginLeft:e.transForm+"px","transition-duration":e.AnimTime}))}},nplMain={conf:{aboutOpenFlag:!0,Elem:"#FnLyHead"},init:function(){var e=this;e.conf;$(function(){$("body").hasClass("ExTop")&&TopGallery.init(),EventListener.init(),Slick.init()})}};nplMain.init();