function DrawImage(d,a,c){if(d===undefined||d===null){return}var b=new Image();b.src=d.src;b.onload=function(f){if(b.width/b.height>=a/c){if(b.width>a){d.width=a;d.height=(b.height*a)/b.width}else{d.width=b.width;d.height=b.height}}else{if(b.height>c){d.height=c;d.width=(b.width*c)/b.height}else{d.width=b.width;d.height=b.height}}$(d).show()};b.src=d.src;$(d).show()}function isIE6(){if(navigator.userAgent.toLowerCase().indexOf("msie 6.0")>0){return true}return false};