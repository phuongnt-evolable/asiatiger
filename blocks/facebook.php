<style>
#facebook_div{
width:300px;
height: 271px;
overflow: hidden;}
#facebook_left{
z-index: 100;
border: 5px solid #3B5998;
background-color: #fff;
width: 300px;
height: 271px;
position: fixed;
right: -313px;
border-radius:5px 5px 5px 5px;
}
#facebook_left img {position: absolute;top: 5px;right: 300px;}
#facebook_left div .fb-like-box {border:0px solid #3c95d9;overflow: hidden;position: static;height: 310px;right:-2px;top:-3px;}
</style>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> 
<script>
    $(document).ready(function () {
    $("#facebook_left").hover(function () {
    $(this).stop(true, false).animate({ right: 0 }, 500);
    },
    function () {
    $("#facebook_left").stop(true, false).animate({ right: -313 }, 500);
    });
    });
</script>
<div id="facebook_left" style="top: 18%;">
    <div id="facebook_div">
        <img src="http://4.bp.blogspot.com/-KIK2Qh-F8Q0/UeJ_OFYRPJI/AAAAAAAAWVA/LwF7gYU1R3M/s1600/box-like-facebook-share123.vn.png" alt="facebook like" />
        <div class="fb-like-box" data-href="https://www.facebook.com/pages/Asiatiger/1409085289394533?ref=hl" data-width="350″ data-height="400″ data-show-faces="true" data-stream="false" data-header="true"></div>
    </div>
</div>