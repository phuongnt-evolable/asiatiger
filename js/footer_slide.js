jQuery(function($) {
		var open = false;
		$('#footerSlideButton_vi').click(function () {
			if(open === false) {
				$('#footerSlideContent').animate({ height: '435px' });
				$(this).css('backgroundPosition', 'bottom left');
				open = true;
			} else {
				$('#footerSlideContent').animate({ height: '0px' });
				$(this).css('backgroundPosition', 'top left');
				open = false;
			}
		});
                $('#footerSlideButton_en').click(function () {
			if(open === false) {
				$('#footerSlideContent').animate({ height: '435px' });
				$(this).css('backgroundPosition', 'bottom left');
				open = true;
			} else {
				$('#footerSlideContent').animate({ height: '0px' });
				$(this).css('backgroundPosition', 'top left');
				open = false;
			}
		});
                $('#footerSlideButton_cn').click(function () {
			if(open === false) {
				$('#footerSlideContent').animate({ height: '435px' });
				$(this).css('backgroundPosition', 'bottom left');
				open = true;
			} else {
				$('#footerSlideContent').animate({ height: '0px' });
				$(this).css('backgroundPosition', 'top left');
				open = false;
			}
		});
	});