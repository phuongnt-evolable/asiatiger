$(function(){$("#back-top").click(function(){var a=setInterval(function(){$(window).scrollTop($(window).scrollTop()/1.1);if($(window).scrollTop()<1){clearInterval(a)}},8);return false});$(window).scroll(function(){var a=$(window).scrollTop();if(a>200){$("#back-top").fadeIn(200)}else{$("#back-top").fadeOut(200)}})});