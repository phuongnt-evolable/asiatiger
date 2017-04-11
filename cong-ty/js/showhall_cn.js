$(function() {
    $("#inquryform").validate({rules: {subject: {required: true, rangelength: [1, 200]}, message: {required: true}}, messages: {subject: {required: "請輸入標題", rangelength: "Please do not more than 200 bytes.", nohtml: "Please do not enter code.", normalWord: "Please enter Subject in English only."}, message: {required: "請輸入內容", rangelength: "Please enter Message in 20 to 3000 bytes.", nohtml: "Please do not enter code.", normalWord: "Please enter Subject in English only."}}});
    $("#searchForm").validate({rules: {searchWord: {normalWord1: true}}, messages: {searchWord: {normalWord1: "Please enter search word in English only."}}, errorPlacement: function(a, b) {
            if (b.attr("name") == "searchWord") {
                $(b).parent().after(a)
            }
        }});
    $(".js-showmoreCat").click(function() {
        $("#moreCat").toggle("fast", function() {
            $(".js-showmoreCat").toggleClass("ly-none")
        })
    });
    $("#cantoggle_1").mouseover(function() {
        $(this).css("cursor", "pointer")
    }).click(function() {
        $("#treeleft_1").toggle();
        if ($("#treeleft_1").css("display") == "none") {
            $("#cantoggle_1>.fold").css("background-position", "-534px 0")
        } else {
            $("#cantoggle_1>.fold").css("background-position", "-534px -30px")
        }
    });
    $("#cantoggle_2").mouseover(function() {
        $(this).css("cursor", "pointer")
    }).click(function() {
        $("#treeleft_2").toggle();
        if ($("#treeleft_2").css("display") == "none") {
            $("#cantoggle_2>.fold").css("background-position", "-534px 0")
        } else {
            $("#cantoggle_2>.fold").css("background-position", "-534px -30px")
        }
    })
});
$(function() {
    String.prototype.replaceAll = function(c, b) {
        return this.replace(new RegExp(c, "gm"), b)
    };
    $("#searchprod").click(function() {
        var c = $("#index_txt");
        var b = c.val();
        if (b == "" || /^\s*$/.test(b)) {
            alert("Please enter keywords!");
            return false
        } else {
            if (!/^[a-zA-Z0-9\s.,&=+-_\)\(\*\^%\$#@!~`\|\'\"\;:<>]+$/.test(b)) {
                alert("Please:\n. Input the information in English or try different keywords.\n . Access to tw.ttnet.net or cn.ttnet.net (for Chinese version).");
                return false
            } else {
                b = encodeURIComponent(b);
                window.open("/search/products?find=" + b)
            }
        }
    });
    var a = $("#treeleft_hide").val();
    treeleft_hide(a);
    $("img[id^='_img_']").each(function() {
        DrawImage(this, 200, 150)
    })
});
$(function() {
    if ($("#treeleft_1").css("display") == "none") {
        $("#cantoggle_1>.fold").css("background-position", "-534px 0")
    } else {
        $("#cantoggle_1>.fold").css("background-position", "-534px -30px")
    }
    if ($("#treeleft_2").css("display") == "none") {
        $("#cantoggle_2>.fold").css("background-position", "-534px 0")
    } else {
        $("#cantoggle_2>.fold").css("background-position", "-534px -30px")
    }
});
function menu_show(a) {
    if (a != -1) {
        $("#dem_" + a).addClass("no")
    }
}
function menus_hide(b) {
    if (b != "") {
        b = b.split(",");
        for (var a = 0; a < b.length; a++) {
            $("#dem_" + b[a]).parent().hide()
        }
    }
}
function treeleft_hide(b) {
    if (b != undefined && b != "") {
        b = b.split(",");
        for (var a = 0; a < b.length; a++) {
            $("#treeleft_" + b[a]).hide()
        }
    }
}
function showProdAlert() {
    alert("The products will be posted later.")
}
function postNewProd() {
    window.location.href = "/en/products/addIndex"
}
function cantact() {
    $("#inquryform").submit()
}
function send_friend(a, b) {
    var c = $("#isregist").val();
    b = b.replace("&quot;", '"').replace("&acute;", "'");
    url = "/view/showroom/favindex?supplyId=" + a + "&comname=" + escape(b);
    window.open(url, "send_friend", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,scrolling=no,width=580,height=250,resizable=0")
}
function add_bookmark(a, b) {
    b = b.replace("&quot;", '"').replace("&acute;", "'");
    url = "/view/showroom/emailindex?comId=" + a + "&comname=" + escape(b);
    window.open(url, "LoveSuppliers", "toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=no,scrolling=no,width=520,height=587,resizable=0")
}
function zoomimg(a) {
    window.open(a, "", "width=700,height=650,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no,top=150,left=500")
}
function showvideo(a) {
    window.open(a, "", "width=660,height=580,toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no,top=150,left=500")
}
function contact(a, b) {
    window.open("/inquiry/contact?type=" + a + "&recId=" + b)
}
function submitt(b, c) {
    var a = $("#" + c);
    a.attr("action", b);
    a.submit()
}
function showMess(a) {
    if (a == 0) {
        if (confirm('You do not upload any information; please go to "Data Editing" to add Online Catalog.')) {
            window.open("/dataedit/online")
        }
    }
    if (a == 1) {
        if (confirm('You do not upload any information; please go to "Data Editing" to add products.')) {
            window.open("/en/products/addIndex")
        }
    } else {
        if (a == 2) {
            if (confirm('You do not upload any information; please go to "Data Editing" to add tradeleads.')) {
                window.open("/en/com/trade/showAdd")
            }
        } else {
            if (a == 3) {
                if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                    window.open("/en/branch/view")
                }
            } else {
                if (a == 4) {
                    if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                        window.open("/en/factory/view")
                    }
                } else {
                    if (a == 5) {
                        if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                            window.open("/en/oem/view")
                        }
                    } else {
                        if (a == 6) {
                            if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                window.open("/en/management/view")
                            }
                        } else {
                            if (a == 7) {
                                if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                    window.open("/en/managingobjective/view")
                                }
                            } else {
                                if (a == 8) {
                                    if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                        window.open("/en/rd/view")
                                    }
                                } else {
                                    if (a == 9) {
                                        if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                            window.open("/en/qc/view")
                                        }
                                    } else {
                                        if (a == 10) {
                                            if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                                window.open("/en/certification/view")
                                            }
                                        } else {
                                            if (a == 11) {
                                                if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                                    window.open("/en/service/view")
                                                }
                                            } else {
                                                if (a == 12) {
                                                    if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                                        window.open("/en/tradeservice/show")
                                                    }
                                                } else {
                                                    if (a == 13) {
                                                        if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it. ")) {
                                                            window.open("/en/tradeshow/show")
                                                        }
                                                    } else {
                                                        if (a == 14) {
                                                            window.alert("1、Sorry, you are not the member of trade magazines. Contact us forfurther information.\n2、Trade magazines are your best partners inbusiness fields. I would like to know more…")
                                                        } else {
                                                            if (a == 15) {
                                                                if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it.")) {
                                                                    window.open("/en/rs/init")
                                                                }
                                                            } else {
                                                                if (a == 16) {
                                                                    if (confirm("You do not release any information on ttnet.net; please go to “Data Editing” to add it.")) {
                                                                        window.open("/en/dataediting/infos/show_vs")
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
$(function() {
    $(".js-sliders").jcSlider()
});