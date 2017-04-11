<!-- quick -->
<ul id="quick">
        <li>
                <a href="#" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Products" /></span><span>{danhmuc}</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'danhmuc_list'; ?>">{qldanhmuc}</a></li>
                        <li><a href="<?php echo BASE_URL.'danhmuccha_add'; ?>">{themdanhmuccha}</a></li>
                        <li><a href="<?php echo BASE_URL.'danhmuc_add'; ?>">{themdanhmuccon}</a></li>
                </ul>
        </li>
        <li>
                <a href="" title="Events"><span class="icon"><img src="resources/images/icons/calendar.png" alt="Events" /></span><span>{sanpham}</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'product_list'; ?>">{dssanpham}</a></li>
                        <li class="last"><a href="<?php echo BASE_URL.'product_add'; ?>">{themsp}</a></li>
                </ul>
        </li>
        
        <li>
                <a href="" title="Events"><span class="icon"><img src="resources/images/icons/calendar.png" alt="Events" /></span><span>{cty}</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'congty_list'; ?>">{dscty}</a></li>
                        <?php /*<li><a href="<?php echo BASE_URL.'congty_list_chua_nghanh'; ?>">Danh sách công ty chưa nghành</a></li>*/?>
                        <li><a href="<?php echo BASE_URL.'congty_add'; ?>">{themcty}</a></li>
                </ul>
        </li> 
        <li>
                <a href="#" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Products" /></span><span>{tintuc}</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'baiviet_list'; ?>">{dsbaiviet}</a></li>
                        <li class="last"><a href="<?php echo BASE_URL.'baiviet_add'; ?>">{thembaiviet}</a></li>
                </ul>
        </li>
        <li>
                <a href="#" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Products" /></span><span>Quốc gia</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'quocgia_list'; ?>">Danh sách quốc gia</a></li>
                        <li class="last"><a href="<?php echo BASE_URL.'quocgia_add'; ?>">Thêm quốc gia</a></li>
                </ul>
        </li>
        <?php /*<li>
                <a href="#" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Products" /></span><span>{duandalam}</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'duan_list'; ?>">{dsduan}</a></li>
                        <li class="last"><a href="<?php echo BASE_URL.'duan_add'; ?>">{themduan}</a></li>
                </ul>
        </li> */?>
        <li>
                <a href="" title="Links"><span class="icon"><img src="resources/images/icons/page_white_copy.png" alt="Blocks" /></span><span>Blocks</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'block_list'; ?>">Quản lý blocks</a></li>
                </ul>
        </li>
        <li>
                <a href="" title="Events"><span class="icon"><img src="resources/images/icons/calendar.png" alt="Events" /></span><span>Trang màu</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=6">Danh sách hình slide trang chủ</a></li>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=1">Danh sách trang màu</a></li>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=2">Danh sách website liên kết</a></li>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=3">Danh sách trang QC Right Home</a></li>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=4">Danh sách trang QC Center Home</a></li>
                        <li><a href="<?php echo BASE_URL.'image_list'; ?>&category_id=5">Danh sách trang QC Left Home</a></li>
                        <li class="last"><a href="<?php echo BASE_URL.'image_add'; ?>">Thêm hình</a></li>
                </ul>
        </li>
        
        <li>
                <a href="<?php echo BASE_URL.'khachhang_list'; ?>" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Menu" /></span><span>Khách hàng</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'khachhang_list'; ?>">Danh sách khách hàng</a></li>
                        
                </ul>
        </li>
        <li>
                <a href="#" title="Products"><span class="icon"><img src="resources/images/icons/application_double.png" alt="Menu" /></span><span>Xuất file excel</span></a>
                <ul>
                        <li><a href="<?php echo BASE_URL.'excel_congty_list'; ?>">Danh sách công ty</a></li>

                </ul>
        </li>
        
</ul>
