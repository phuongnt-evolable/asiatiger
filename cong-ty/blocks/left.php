
<form action="tim-kiem/" name="searchForm" method="GET" id="searchForm">
    <div class="showhall-box-blue">
        <div class="title">
            <h4 class="titleH">{search}</h4>
        </div>
        <div class="content">
            <input type="text" class="input-text" name="SearchText" value="" maxlength=200/>
            <input type="hidden"  name="cty_id" value="<?php echo $congty_id; ?>" maxlength=200/>
            <input type="submit" class="btn-search"/>            
        </div>
    </div>
</form>
<div class="showhall-box-blue" id="box-prdCate">
    <div class="title" id="cantoggle_1">
        <h3 class="titleH fold"><a style="margin-top: 9px;position: absolute;margin-left: 5px;">{dssanpham} <i>(<?php echo $soluong; ?>)</i></a></h3>
    </div>
    <div class="content" id="treeleft_1">
        <ul>
            <?php
           
                if (!empty($arr_product)) { // kiem tra xem co san pham nao hay ko ?
                    $arrCate[]='';
                    foreach ($arr_product as $product) {
                        //echo $product['product_name']."<br />"; // muon lap cai gi thi tuy em							
                        $cate_id = $product['category_id'];
                        $arrCate[$cate_id] ++;
                    }
                    foreach ($arrCate as $cate_id => $so_sanpham) {
                    $cate = $modelCate->getDetailCate($cate_id);
                    $row_cate = mysql_fetch_assoc($cate);
                    ?>
                    <li>
                        <a   href="dmsp/<?php echo $row_cate['cate_alias'] . '-' . $row_cate['cate_id'] . '/' . $row_cty['ten_khong_dau'] . '-' . $row_cty['congty_id'] . '.html'; ?>"><?php echo $row_cate['cate_name_' . $lang] . ' (' . ($so_sanpham) . ')' ?></a>
            </li>   					<?php }  } // foreach ?>
           
        </ul>
        <!--<ul id="moreCat" style="display:none;">
            <li>
                <a   href="/show_html.jsp/garden-hose-nozzles/SS/listprd/Y/cono/pt6gvrgcj7ugl/itno/CB105999/dtno/011/ik/16/type1/A">Women's Bags/n.e.s. (1)  </a>
            </li>
            <li>
                <a   href="/show_html.jsp/garden-hose-nozzles/SS/listprd/Y/cono/pt6gvrgcj7ugl/itno/FA255010/dtno/011/ik/17/type1/A">Semi-precious Stones (1)  </a>
            </li>
            <li>
                <a   href="/show_html.jsp/garden-hose-nozzles/SS/listprd/Y/cono/pt6gvrgcj7ugl/itno/FA250010/dtno/011/ik/18/type1/A">Gemstone Jewelry (1)  </a>
            </li>
            <li>
                <a   href="/show_html.jsp/garden-hose-nozzles/SS/listprd/Y/cono/pt6gvrgcj7ugl/itno/FA350030/dtno/011/ik/19/type1/A">Jewelry Beads (1)  </a>
            </li>
        </ul>
        <a href="javascript:void(0);" class="js-showmoreCat">{xemtatca}</a>
        <a href="javascript:void(0);" class="js-showmoreCat ly-none">{xemtatca}</a>-->

    </div>
</div>
<div class="showhall-box-blue" id="box-contactInfo">
    <div class="title">
        <h4 class="titleH">{ttct}</h4>
    </div>
    <div class="content">
        <ul class="address">
            <li><span><strong>{diachi}:</strong></span> <?php echo $row_cty['DiaChi_' . $lang]; ?></li>
            <li>
                <span><strong>{nguoilienhe}:</strong></span>
<?php echo $row_cty['NguoiLienHe']; ?>
            </li>
            <?php
              if($row_cty['ShopVip']==1){  
                  if($row_cty['Skype']!=''){
            ?>
            <li>
                <span style="float: left;"><strong>Skype:</strong></span>
                <span style="float: left;margin-left: 10px;min-width: 100px;"><a title="Talk with me via Skype " href="skype:<?php echo $row_cty['Skype']; ?>?chat"><img alt="Talk with me via Skype" src="http://mystatus.skype.com/smallclassic/<?php echo $row_cty['Skype']; ?>"></a></span>                
            </li>
                  <?php } if($row_cty['QQ']!=''){ ?>
            <li>
                <span style="float: left;"><strong>QQ:</strong></span>
                              
                <span style="float: left;margin-left: 10px;min-width: 100px;"><a target="_blank" style="color:#000000; font-size:10px; font-style: normal; text-decoration:none; line-height:25px;" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $row_cty['QQ']; ?>&site=qq&menu=yes"  rel="imgtip[4]"><img style="margin-left:20px;" src="../../img/icon_qq.png" /> </a></span>
            </li>
                  <?php  } } ?>
            <li style="clear: both;"><span><strong>{dienthoai}:</strong></span> <?php echo $row_cty['DienThoai']; ?></li>
            <li><span><strong>{fax}:</strong></span> <?php echo $row_cty['Fax']; ?></li>                
        </ul>
    </div>
</div>



