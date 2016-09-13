
<div class="span780-heading"></div>
<div class="span780-content">
    <div class="showhall-box-blank" id="rbox-comProfile">
        <div class="title">
            <h4 class="titleH">{gioithieucty}</h4>
        </div>
        <div class="content ly-clearFix">
            <h5>{ttct}</h5>
            <div class="content ly-clearFix">
                <div class="description">
                    <?php echo $row_cty['GioiThieu_'.$lang]; ?>
                </div>

                <div class="images js-sliders" style="display:none;">
                    <div id="picHide" style="left: 0px; top: 75px;"><ul class="ui-nav-hor">
                            <li style="display: none;">
                                <div class="md-hnvalign">
                                    <div class="md-hnvalign-mid">
                                        <div class="md-hnvalign-mid-inner">
                                            <img src="/userFiles/vo/MBB/20000001-1MBB3.jpg" id="_img_0" alt="qqqq" title="qqqq">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            
                        </ul></div>
                    <ul id="sliderNum"><li class=""></li><li class=""></li><li class="visited"></li></ul></div>
            </div>
            
            <?php if($row_cty['SanPhamChinh_'.$lang]!='') {?>
                <h5>{spchinh}</h5>
                <div><?php echo $row_cty['SanPhamChinh_'.$lang]; ?>  </div>
            <?php } ?>
                
            <h5>{danhmucnghanhnghe}</h5>
            <div> </div>
            




        </div>
    </div>
    <input type="hidden" id="hidevalue" name="hidevalue" value="pt6gvrgcj7ugl"/>

    <?php include"blocks/form-lienhe.php"; ?>
   


    <!--<div class="HotPrdCon-box">
        <div class="title">
            <h4 class="titleH"> Hot Products </h4>
        </div>
        <div class="content image-scroll-visible">
            <ul class="ui-nav-hor" id="">
                <li class="size100146">
                    <div class="thumbnails10075">
                        <div class="md-hnvalign">
                            <div class="md-hnvalign-mid">
                                <div class="md-hnvalign-mid-inner">
                                    <a href="http://www.ttnet.net/ttnet/gotoprd/GC974/999/0/05841303030383530303.htm" title="Bead" alt="Bead">
                                        
                                        <img src="http://origin-images.ttnet.net/pi/eprv/10/00/85/00/NP110008500-20b.jpg" title="Bead" alt="Bead"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="http://www.ttnet.net/ttnet/gotoprd/GC974/999/0/05841303030383530303.htm" title="Bead" alt="Bead">
                        <span> Bead </span>
                    </a>
                </li>                
            </ul>
        </div>-->
    </div>



</div>

