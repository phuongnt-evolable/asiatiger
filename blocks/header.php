<div class="ui-header-dynamic ui-header-biz-home ui-header-rwd">
    <!--TMS:1283323-->
    <style>
        .mm-sc-new-header {}
        /* code here */
        .skin-default .mm-sc-new-header {
            color: #333333;
        }

    </style>

    <div class="skin-default" data-name="mm-sc-new-header" data-skin="default" data-guid="1409720357634" id="guid-1409720357634" data-version="51" data-type="3"><div class="module" data-spm="a271qf"><div class="mm-sc-new-header">

                <!--[if lte IE 8]>   
                <script>document.createElement('header');document.createElement('footer');</script>
                <![endif]-->  

                <header id="header2012" class="ui-header util-clearfix  ui-header-full  ui-header-mod-beacon" data-banner-src="" data-banner-link="" data-banner-store="mm-banner-wc-10161747" data-banner-color="#fecbca">
                    <div class="ui-header-beacon-wrapper">
                        <div class="ui-beacon notranslate ui-beacon-loc-internal util-clearfix">
                            <?php
                                if(!isset($_SESSION["idUser"])){
                            ?>
                            <div class="ui-beacon-user1" style="padding-left: 900px;float: left;color: #333;word-wrap: normal;word-break: normal;line-height: 11px;margin-right: 5px;margin-top: -10px;margin-bottom: 10px;">
                                <a  href="http://asiatiger.org/dang-nhap.html">{dangnhap}</a> | <a href="http://asiatiger.org/dang-ky.html">{dangky}</a>
                            </div>
                            <?php } else {?>
                            <div class="ui-beacon-user1" style="padding-left: 850px;float: left;color: #333;word-wrap: normal;word-break: normal;line-height: 11px;margin-right: 5px; margin-top: -20px;">
                                <ul class="ui-beacon-main ui-beacon-nav" data-widget-cid="widget-1" style="visibility: visible; left: 0px; position: relative; top: 0px;">
                               
                                    <li class="ui-beacon-item ui-beacon-drop ui-beacon-for-buyer">
                                        <a class="ui-beacon-item-link" rel="nofollow" href="javascript:;">Hi ! <strong><?php echo $_SESSION["Username"]; ?></strong> <i class="ui-beacon-hollow-arrow"><em></em><b></b></i></a>
                                        <ul class="ui-beacon-subs">

                                            <li class="ui-beacon-sub">
                                                <a rel="nofollow" href="http://asiatiger.org/khach-hang/">{thaydoithongtin}</a>
                                            </li>   
                                            <li class="ui-beacon-sub">
                                                <a rel="nofollow" href="http://asiatiger.org/khach-hang/them-san-pham.html">{themsp}</a>
                                            </li>
                                            <li class="ui-beacon-sub">
                                                <a rel="nofollow" href="http://asiatiger.org/khach-hang/thoat.php">{thoat}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                           <?php }?>
                            <div class="ui-beacon-user1" style="margin-left: 1050px;float: left;color: #333;word-wrap: normal;word-break: normal;line-height: 11px;margin-right: 5px;margin-top: -30px;margin-bottom: 10px;">
                                <ul class="ui-beacon-main ui-beacon-nav" data-widget-cid="widget-1" style="visibility: visible; left: 0px; position: relative; top: 0px;">
                               
                                <li class="ui-beacon-item ui-beacon-drop ui-beacon-for-buyer">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="javascript:;">Language<i class="ui-beacon-hollow-arrow"><em></em><b></b></i></a>
                                    <ul class="ui-beacon-subs">
                                        
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" class="change_language" data-value="cn" href="javascript:;">中 文</a>
                                        </li>   
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" class="change_language"  data-value="vi"  href="javascript:;">Việt Nam</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" class="change_language"  data-value="en" href="javascript:;">English</a>
                                        </li>
                                        
                                    </ul>
                                </li>
                            </ul>
                            </div>
                            <span class="ui-beacon-nav-toggle">
                                <span class="bar"></span><span class="bar"></span><span class="bar"></span>
                            </span>
                            <span class="ui-beacon-user-toggle">
                                <a href="#"><i class="ui-beacon-person-icon"></i></a>
                            </span>
                            <div class="ui-beacon-user1" style="padding-left: 500px;float: left;color: #333;word-wrap: normal;word-break: normal;line-height: 11px;margin-right: 5px;margin-bottom: 10px;">
                                <a style="margin-right:10px;"  href="http://asiatiger.org">{trangchu}</a> 
								<a style="margin-right:10px;"  href="http://asiatiger.org/thong-tin-mua-ban.html">{tintucmuaban}</a> 
								<a style="margin-right:10px;"  href="http://asiatiger.org/dang-ky-quang-cao.html">{dkquangcao}</a> 
								<a style="margin-right:10px;"  href="http://asiatiger.org/gioi-thieu.html">{gioithieuvinhsang}</a> 
								<a style="margin-right:10px;"  href="http://asiatiger.org/tuyen-dung.html">{tuyendung}</a> 
								<a style="margin-right:10px;"  href="http://asiatiger.org/lien-he.html">{lienhe}</a> 
								
                            </div>
                            <?php /*<ul class="ui-beacon-main ui-beacon-nav" data-widget-cid="widget-1" style="visibility: visible;  position: relative; top: 0px;">
                               
                               <!-- <li class="ui-beacon-item ui-beacon-drop ui-beacon-for-buyer">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="javascript:;">{danhchonguoimua}<i class="ui-beacon-hollow-arrow"><em></em><b></b></i></a>
                                    <ul class="ui-beacon-subs">
                                        <li class="ui-beacon-sub-split" style="margin-top:0; padding-top:0; border-top:none;">
                                            Source Products &amp; Suppliers
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">By Category</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="">Get Quotations</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">Wholesale Checkout</a>
                                        </li>
                                        <li class="ui-beacon-sub-split">
                                            Trade Services
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#r">AliPrimeBuyer</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">Escrow Service</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">e-Credit Line</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">Inspection Service</a>
                                        </li>
                                        <li class="ui-beacon-sub-split">
                                            Community
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#intelligence?tracelog=beacon_ti_140704">Trade Intelligence</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#forum?tracelog=beacon_df_140704">Discussion Forums</a>
                                        </li>
                                        <li class="ui-beacon-sub">
                                            <a rel="nofollow" href="#">Trade Answers</a>
                                        </li>
                                    </ul>
                                </li>-->
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org">{trangchu}</a>
                                </li>
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org/thong-tin-mua-ban.html">{tintucmuaban}</a>
                                </li>
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org/dang-ky-quang-cao.html">{dkquangcao}</a>
                                </li>
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org/gioi-thieu.html">{gioithieuvinhsang}</a>
                                </li>
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org/tuyen-dung.html">{tuyendung}</a>
                                </li>
                                <li class="ui-beacon-sa ui-beacon-item">
                                    <a class="ui-beacon-item-link" rel="nofollow" href="http://asiatiger.org/lien-he.html">{lienhe}</a>
                                </li>
                                
                                <li class="ui-beacon-translate ui-beacon-item">
                                </li>
                                
                                
                            </ul>*/?>
                        </div>
                    </div>
                    <div class="ui-header-main-wrapper">
                        <div class="ui-header-main util-clearfix">
                            
                            <div class="ui-header-logan" style="float: left;height: 38px;top: -50px;left:70;width: 210px;position: absolute;">
                                <a title="Home" href="#"><img width="80px"  src="img/tiger-logo.png"></a>
                            </div>
                            <div class="ui-header-logan" style="float: left;height: 38px;width: 210px;position: absolute;">
                                <a title="Home" href="#"><img width="200px"  src="img/logan.png"></a>
                            </div>
                            <div class="ui-header-logo1" style="height: 38px;top: -40px;width: 210px;position: absolute;margin-left: 220px; float: left;">
                                <a title="Home" href="#"><img style="    margin-top: 20px;" width="250px"  src="img/asiatigercn.jpg"></a>
                            </div>
                            <div class="ui-header-extend">
                            </div>
                            <div class="ui-header-anchor">
                            </div>
                            <div class="ui-header-lan"></div>
                            <div class="ui-header-categories">
                                <h3>
                                    <a href="#Products">Categories<i class="ui-header-hollow-arrow"><em></em><b></b></i></a>
                                </h3>
                            </div>
                            

                            <div class="ui-searchbar  ui-searchbar-size-middle ui-header-searchbar " style="display: none;">
                                <div class="ui-searchbar-body">
                                    <form method="get" action="#trade/search">
                                        <input type="hidden" name="fsb" value="y">
                                        <input class="ui-searchbar-field-type" type="hidden" name="IndexArea" value="product_en">
                                        <input class="ui-searchbar-field-category" type="hidden" name="CatId" value="">
                                        <div class="ui-searchbar-type"></div>
                                        <div class="ui-searchbar-main">
                                            <input type="text" class="ui-searchbar-keyword" name="SearchText" autocomplete="off" x-webkit-speech="x-webkit-speech" x-webkit-grammar="builtin:translate" lang="en">
                                        </div>
                                        <input type="submit" class="ui-searchbar-submit" value="Search">
                                        <span class="ui-searchbar-advanced"><a class="ui-searchbar-advanced-link" href="javascript:;">Advanced Search</a></span>
                                    </form>
                                </div>
                            </div
                        </div>
                    </div>
                </header>

				<script type="text/javascript">	
                                    $(function(){	
                                        $('a.change_language').click(function(){
                                            var lang = $(this).attr('data-value');
                                            $.ajax({url: "ajax/language.php",type: "POST",async: true,	data: {'lang' : lang,},	success: function(data){ 
                                                    window.location.reload();
                                                }
                                            });	
                                        });	
                                    });		
                                </script>
               <script>					
                    seajs.use(['$', 'gdata', 'http://style.aliunicorn.com/js/6v/biz/common/header/??header-v4-sc.js?t=61b33c73_401043c2c1'], function(jq, gdata, header) {
                        var config = jq.extend((gdata.get('sc-header-config') || {}), {
                            containerId: '#header2012'
                        });
                        header.run(config);
                    });					
                </script>

            </div>
        </div></div>

    
</div>