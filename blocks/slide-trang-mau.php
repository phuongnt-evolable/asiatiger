<script type="text/javascript" src="js/jssor.js"></script>
    <script type="text/javascript" src="js/jssor.slider.js"></script>
    <script>

        jQuery(document).ready(function ($) {

            

            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 300,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 80,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                $SlideHeight: 200,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 3, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 3,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 0,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 2,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 2,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0),

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $JssorBulletNavigator$: 0,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ChanceToShow: 0,
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $SpacingY: 5,                                   //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 2                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                }
            };
            var jssor_slider1 = new $JssorSlider$("slider1_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    var sliderWidth = parentWidth;

                    //keep the slider width no more than 200
                    sliderWidth = Math.min(sliderWidth, 160);

                    jssor_slider1.$ScaleWidth(sliderWidth);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- sliderh style begin -->
    <style>
        /* jssor slider bullet navigator skin 03 css */
        /*
        .jssorb03 div           (normal)
        .jssorb03 div:hover     (normal mouseover)
        .jssorb03 .av           (active)
        .jssorb03 .av:hover     (active mouseover)
        .jssorb03 .dn           (mousedown)
        */
        
        .jssorb03 div { background-position: -5px -4px; }
        .jssorb03 div:hover, .jssorb03 .av:hover { background-position: -35px -4px; }
        .jssorb03 .av { background-position: -65px -4px; }
        .jssorb03 .dn, .jssorb03 .dn:hover { background-position: -95px -4px; }
    </style>
    
    
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 160px; height: 605px; overflow: hidden; ">
    <!-- Slides Container -->
    <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 160px; height: 605px;
         overflow: hidden;">
        <?php 
                $category_id=1;
                $hinh=$modelHome->getImageByCate($category_id,1,20);
                $i=0;
                foreach ($hinh as $val => $row_hinh){
                    $i++;
            ?>
        <div>
            <div id="sliderh<?php echo $i; ?>_container" style="position: relative; top: 0px; left: 0px; width: 160px;
                 height: 200px;">

                <!-- Slides Container -->
                <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 160px; height: 200px;
                     overflow: hidden;">
                    <div><a target="_blank" class="
                        <?php if($row_hinh['Href']=='') echo 'fancybox';
                               
                        ?>"  href="
                        <?php if($row_hinh['Href']==''){ echo $row_hinh['Url'];}
                                else {echo $row_hinh['Href'];}
                                ?>" title="<?php echo $row_hinh['TenCT']; ?>"><img width="130px" u="image" src="<?php echo $row_hinh['Url']; ?>" /></a></div>

                </div>
                <!-- Bullet Navigator Skin Begin -->
                <!-- bullet navigator container -->
                
                <!-- Bullet Navigator Skin End -->
            </div>
        </div>
            <?php } ?>
        
    </div>
    <!-- Bullet Navigator Skin Begin -->
    <!-- jssor slider bullet navigator skin 02 -->
    <style>
        /*
        .jssorb02 div           (normal)
        .jssorb02 div:hover     (normal mouseover)
        .jssorb02 .av           (active)
        .jssorb02 .av:hover     (active mouseover)
        .jssorb02 .dn           (mousedown)
        */
        .jssorb02 div, .jssorb02 div:hover, .jssorb02 .av
        
        .jssorb02 div { background-position: -5px -5px; }
        .jssorb02 div:hover, .jssorb02 .av:hover { background-position: -35px -5px; }
        .jssorb02 .av { background-position: -65px -5px; }
        .jssorb02 .dn, .jssorb02 .dn:hover { background-position: -95px -5px; }
    </style>
    <!-- bullet navigator container -->
    <div u="navigator" class="jssorb02" style="position: absolute; bottom: 8px; left: 6px;">
        <!-- bullet navigator item prototype -->
        <div u="prototype" style="POSITION: absolute; WIDTH: 21px; HEIGHT: 21px; text-align:center; line-height:21px; color:White; font-size:12px;"><NumberTemplate></NumberTemplate></div>
    </div>
    <!-- Bullet Navigator Skin End -->
    
</div>