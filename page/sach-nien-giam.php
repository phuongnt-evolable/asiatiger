<?php
    session_start();
   $url = $_SERVER['REQUEST_URI'];   
    $_SESSION["url"]=$url;
?>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/page-styles.css">

	
	<style type="text/css">
	
		#flipbook-1 {
			margin-top: 20px;
			margin-bottom: 0px;
			margin-left: 0px;
			margin-right: 0px;
			
			width: 712px; 
			height: 510px; 
		}
		
		#flipbook-1 div.fb-page div.page-content {
			margin: 10px 0px; 
		}
		
		#flipbook-1 .turn-page {
			width: 356px;		
			height: 510px;
			background: #ECECEC;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
							box-shadow: inset -1px 0px 1px 0px #BFBFBF; 
			
		}
		
		#flipbook-1 .last .turn-page,
		#flipbook-1 .even .turn-page {
			border-radius: 0px;
			border-top-left-radius: 10px;
			border-bottom-left-radius: 10px;	
							box-shadow: inset 1px 0px 1px 0px #BFBFBF;
		}
		
		#flipbook-1 .fpage .turn-page {
			border-radius: 0px;
			border-top-left-radius: 10px;
			border-bottom-left-radius: 10px;
							box-shadow: inset 1px 0px 1px 0px  #BFBFBF;
		}
		
		#flipbook-1 .last .fpage .turn-page,
		#flipbook-1 .even .fpage .turn-page {
			border-radius: 0px;
			border-top-right-radius: 10px;
			border-bottom-right-radius: 10px;
							box-shadow: inset -1px 0px 1px 0px #BFBFBF;
		}
		
		#flipbook-container-1 div.page-content div.container img.bg-img {
			margin-top: 0px;
			margin-left: 0px;
		}
		
		#flipbook-container-1 div.page-content.first div.container img.bg-img {
			margin-top: 10px;
		}
	
		#flipbook-container-1 div.page-content.even div.container img.bg-img {
			left: 0px;
		}
		
		#flipbook-container-1 div.page-content.last div.container img.bg-img {
			left: 10px;
			margin-top: 10px;
		}
	
		#flipbook-1 div.page-transition.last div.page-content,
		#flipbook-1 div.page-transition.even div.page-content,
		#flipbook-1 div.turn-page-wrapper.odd div.page-content {
			margin-left: 0px;
			margin-right: 10px; 
		}
	
		#flipbook-1 div.turn-page-wrapper.first div.page-content {
			margin-right: 10px;
			margin-left: 0px; 
		}
	
		#flipbook-1 div.page-transition.first div.page-content,
		#flipbook-1 div.page-transition.odd div.page-content,
		#flipbook-1 div.turn-page-wrapper.even div.page-content,
		#flipbook-1 div.turn-page-wrapper.last div.page-content {
			margin-left: 10px;
		}
		
		#flipbook-1 div.fb-page-edge-shadow-left,
		#flipbook-1 div.fb-page-edge-shadow-right,
		#flipbook-1 div.fb-inside-shadow-left,
		#flipbook-1 div.fb-inside-shadow-right {
			top: 10px;
			height: 490px;
		}
		
		#flipbook-1 div.fb-page-edge-shadow-left {
			left: 10px;
		}
		
		#flipbook-1 div.fb-page-edge-shadow-right {
			right: 10px;
		}
		
		/* Zoom */
					
		#flipbook-container-1 div.zoomed-shadow {
			opacity: 0.2;
		}
		
		#flipbook-container-1 div.zoomed {
			border: 10px solid #ECECEC;
			border-radius: 10px;
							box-shadow: 0px 0px 0px 1px #D0D0D0;	
				
		}	
		
		/* Show All Pages */
		#flipbook-container-1 div.show-all div.show-all-thumb {
			margin-bottom: 12px;
			height: 180px;
			width: 125px;
			border: 1px solid #878787;
		}
		
		#flipbook-container-1 div.show-all div.show-all-thumb.odd {
			margin-right: 10px;
			border-left: none;
		}
		
		#flipbook-container-1 div.show-all div.show-all-thumb.odd img.bg-img {
			padding-left: 250px;
		}
		
		#flipbook-container-1 div.show-all div.show-all-thumb.odd.first img.bg-img {
			padding-left: 0px;
		}
		
		#flipbook-container-1 div.show-all div.show-all-thumb.even {
			border-right: none;
		}
		
		#flipbook-container-1 div.show-all div.show-all-thumb.last-thumb {
			margin-right: 0px;
		}
		
		#flipbook-container-1 div.show-all {
			background: #F6F6F6;
			border-radius: 10px;
							border: 1px solid #D6D6D6;
		}
		
		#flipbook-container-1 div.show-all div.content {
			top: 10px;
			left: 10px;
		}
	
		
		/* Inner Pages Shadows */
				
					#flipbook-1 div.fb-page-edge-shadow-left,
			#flipbook-1 div.fb-page-edge-shadow-right {
				display: none;
			}
				
	</style>

	<!-- Scripts -->
	<script type="text/javascript" src="js/swfobject2.js"></script>
	
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/turn.js"></script>
	<script type="text/javascript" src="js/flipbook.js"></script>
	<script type="text/javascript" src="js/jquery.doubletap.js"></script>
	

	
<div class="container">
<div id="flipbook-container-1" class="flipbook-container">
	
	<!-- Flip book -->
	<div id="flipbook-1" class="flipbook">
		<!-- Start Flip Book Pages -->
		
		<!-- Cover -->
		<div class="fb-page">
			<div class="page-content">
				<div class="container">
					<img src="img/pages/1.jpg" class="bg-img" />
					<img src="img/pages/1-large.jpg" class="bg-img zoom-large"/>
				</div>
			</div>
		</div>
		
		<!-- Pages 2 & 3 Table of Content 
		<div class="fb-page double">
			<div class="page-content">
				<div class="container">
					<div style="padding-top: 5%;" class="preview-content toc right">
						<h2 class="enlarge">Table of content</h2>
						<p class="enlarge">Use HTML & build you own table of content</p>
						<ul class="toc enlarge">
							<li><a href="#3"></a><span class="number">03</span><span class="text">Table of content</span></a></li>
							<li><a href="#5"><span class="number">04</span><span class="text">Best way for content presentation</span></a></li>
							<li><a href="#7"><span class="number">06</span><span class="text">All platforms supported</span></a></li>
							<li><a href="#8"><span class="number">08</span><span class="text">Great responsive design</span></a></li>
							<li><a href="#11"><span class="number">10</span><span class="text">Easy configuration</span></a></li>
							<li><a href="#13"><span class="number">12</span><span class="text">Amazing features</span></a></li>
							<li><a href="#15"><span class="number">14</span><span class="text">All media in one book</span></a></li>
						</ul>
					</div>
					<img src="img/pages/02-03.jpg" class="bg-img"/>
					<img src="img/pages/02-03-zoomed.jpg" class="bg-img zoom-large"/>
				</div>
			</div>
		</div>
		-->
		
		<!-- Pages 6 & 7 Device Support -->
		<div class="fb-page double">
			<div class="page-content">
				<div class="container">
					<img src="img/pages/2.jpg" class="bg-img"/>
					<img src="img/pages/2-large.jpg" class="bg-img zoom-large"/>	
				</div>	
			</div>
		</div>
		
		

		
	
		
		
		<!-- Back Cover -->
		<div class="fb-page">
			<div class="page-content">
				<div class="container">
					<img src="img/pages/12.jpg" class="bg-img"/>
					<img src="img/pages/12-large.jpg" class="bg-img zoom-large"/>
				</div>
			</div>
		</div>
		
		<!-- end Flip Book Pages -->
		
	</div> <!-- end Flip Book -->
	
	<!-- Flip Book Navigation -->
	<div id="fb-nav-1" class="fb-nav mobile stacked">
		<ul>
			<li class="toc left">Table Of Content</li>
			<li class="zoom center">Zoom</li>
			<li class="slideshow center">Slide Show</li>
			<li class="show-all right">Show All Pages</li>
		</ul>
				
	</div> <!-- end FLip Book Nav -->
</div> <!-- end Flip Book Container -->
</div>
