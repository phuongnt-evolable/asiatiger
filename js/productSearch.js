$("#products").click(function() {
    $("#suppliers").removeClass("now");
    $("#tradeleads").removeClass("now");
    $("#products").addClass("now")
});
$("#suppliers").click(function() {
    $("#suppliers").addClass("now");
    $("#products").removeClass("now");
    $("#tradeleads").removeClass("now")
});
$("#tradeleads").click(function() {
    $("#tradeleads").addClass("now");
    $("#products").removeClass("now");
    $("#suppliers").removeClass("now")
});
$("a[name='pageSize1']").click(function() {
    if ($(this).attr("class") == "disabled") {
        return
    } else {
        $("#pageSize").val(20)
    }
    $("#hidesearch").submit()
});
$("a[name='pageSize2']").click(function() {
    if ($(this).attr("class") == "disabled") {
        return
    } else {
        $("#pageSize").val(30)
    }
    $("#hidesearch").submit()
});
$("a[name='pageSize3']").click(function() {
    if ($(this).attr("class") == "disabled") {
        return
    } else {
        $("#pageSize").val(40)
    }
    $("#hidesearch").submit()
});
$("#showCompare").click(function() {
    $("#pshowProduct").hide();
    $("#productDiv").hide();
    $("#compareDiv").show();
    $("#narrow").attr("class", "la mar1");
    $("div.category").hide();
    $("#pBackToProduct").show();
    $("#prodRoad").hide();
    $("#comRoad").show()
});
$("#backToProduct").click(function() {
    $("#compareDiv").hide();
    $("#productDiv").show();
    $("#pshowProduct").show();
    $("#narrow").attr("class", "mn mar1");
    $("div.category").show();
    $("#pBackToProduct").hide();
    $("#comRoad").hide();
    $("#prodRoad").show();
    window.location.hash = "top";
    return false
});
function showMoreCompany() {
    $("tr[name='moreCompanyTr']").show();
    $("a[name='showFewerCompany']").show();
    $("a[name='showMoreCompany']").hide();
    $("span.spa[name='showComNum']").text(maxCompany);
    return false
}
function showFewerCompany() {
    $("tr[name='moreCompanyTr']").hide();
    $("a[name='showMoreCompany']").show();
    $("a[name='showFewerCompany']").hide();
    $("span.spa[name='showComNum']").text(20);
    return false
}
$("#cat_condition a").click(function() {
    var a = $("#catCode_hidden").val();
    if (a.length == 8) {
        a = a.substring(0, 5);
        $("#catCode_hidden").val(a)
    } else {
        if (a.length == 5) {
            a = a.substring(0, 2);
            $("#catCode_hidden").val(a)
        } else {
            $("#catCode_hidden").val("")
        }
    }
    $("#hidesearch").submit()
});
$("#city_condition a").click(function() {
    $("#location_facet_hidden").val("");
    $("#hidesearch").submit()
});
$(":button[name=productContact]").click(function() {
    if ($("#searchProductTable :checkbox:checked").length == 0) {
        alert("please select a product at least!")
    } else {
        var a = $("input:checkbox[name='recIds']:checked").length;
        if (a > 20) {
            alert("You have reached the maximum 20 limit of choosing suppliers");
            return false
        }
        $("#productContactUs").click()
    }
});
$("span[name='searchCondition']").hover(function() {
    $(this).removeClass("sp")
}, function() {
    $(this).addClass("sp")
});
$(":button[name='companyContact']").click(function() {
    if ($("#compareCompany :checkbox:checked[name='recIds']").length == 0) {
        alert("please select a supplier at least!")
    } else {
        $("#companyContactUs").click()
    }
});
$("#searchProductTable :checkbox[name='recIds']").click(function() {
    if (this.checked) {
        var b = $("#searchProductTable :checkbox[name='recIds']:checked").size();
        var a = $("#searchProductTable :checkbox[name='recIds']").size();
        if (b > 20) {
            $(this).removeAttr("checked");
            alert("You have reached the maximum 20 limit of choosing products")
        } else {
            if (b == 20 || b == a) {
                $(":checkbox[name='pickProductAll']").attr("checked", "checked")
            }
        }
    } else {
        if (!this.checked) {
            $(":checkbox[name='pickProductAll']").removeAttr("checked")
        }
    }
});
$("#compareCompany :checkbox[name='recIds']").click(function() {
    compareCheckBox(this)
});
function compareCheckBox(c) {
    if (c.checked) {
        var b = $("#compareCompany :checkbox[name='recIds']:checked").size();
        var a = $("#compareCompany :checkbox[name='recIds']").size();
        if (b > 20) {
            $(c).removeAttr("checked");
            alert("You have reached the maximum 20 limit of choosing suppliers")
        } else {
            if (b == 20 || b == a) {
                $(":checkbox[name='pickCompanyAll']").attr("checked", "checked")
            }
        }
    } else {
        if (!c.checked) {
            $(":checkbox[name='pickCompanyAll']").removeAttr("checked")
        }
    }
}
function showMore(a) {
    $("#more_" + a).show();
    $("#" + a + "Less").show();
    $("#" + a + "More").hide()
}
function hideMore(a) {
    $("#more_" + a).hide();
    $("#" + a + "More").show();
    $("#" + a + "Less").hide();
    window.location.hash = "top"
}
$("#cat_code_more").click(function() {
    $("#more_cat_code").show();
    $("#cat_code_more").hide();
    $("#cat_code_less").show()
});
$("input:checkbox[name='pickProductAll']").click(function() {
    var a = $("input:checkbox[name='pickProductAll']");
    if (this.checked) {
        $("#searchProductTable input:checkbox[name=recIds]:lt(20)").attr("checked", "checked");
        a.attr("checked", "checked")
    } else {
        $("#searchProductTable input:checkbox").removeAttr("checked");
        a.removeAttr("checked")
    }
});
$("input:checkbox[name='pickCompanyAll']").click(function() {
    var a = $("input:checkbox[name='pickCompanyAll']");
    if (this.checked) {
        $("#compareCompany input:checkbox[name=recIds]:lt(20)").attr("checked", "checked");
        a.attr("checked", "checked")
    } else {
        $("#compareCompany input:checkbox").removeAttr("checked");
        a.removeAttr("checked")
    }
});
$("td :button.con").click(function() {
    contact("PROD", $(this).attr("hiddenvalue"))
});
$("p a.addInqAlr").click(function() {
    addToInquiry($(this).attr("hiddenvalue"), "0");
    return false
});
$("input:button[name='productCart']").click(function() {
    var a = $("input:checkbox[name='recIds']:checked").length;
    if (a > 20) {
        alert("You have reached the maximum 20 limit of choosing suppliers");
        return false
    }
    addCart("searchProductTable")
});
$("input:button[name='companyCart']").click(function() {
    addCart("compareCompany")
});
var map;
var trs;
var checkBoxs = new Array();
var comNameOrder = -1;
var yearOrder = -1;
var standCert = 1;
function isIE6() {
    var d = false;
    var a = {};
    var b = navigator.userAgent.toLowerCase();
    var c;
    (c = b.match(/msie ([\d.]+)/)) ? a.ie = c[1] : 0;
    if (a.ie && a.ie == "6.0") {
        d = true
    }
    return d
}
function initMap() {
    if (isIE6()) {
        var g = $("#compareCompany tr:gt(0) :checkbox:checked");
        checkBoxs = new Array();
        if (g.size() > 0) {
            g.each(function() {
                checkBoxs[checkBoxs.length] = $(this).attr("value")
            })
        }
    }
    if (map == null) {
        map = new Array();
        trs = $("#compareCompany tr:gt(0)");
        var h = $("#compareCompany tr:gt(0)");
        for (var b = 0; b < h.length; b++) {
            var d = $(h[b]).children();
            var f = $(d[1]).find("a").text();
            var c = $(d[3]).text();
            var e = 0;
            if ($(d[6]).find("span").length > 0) {
                e = 1
            }
            var a = {companyName: f, year: c, standCertFlag: e, index: b};
            map[b] = a
        }
    }
}
function recoverSelectedCheckBox() {
    if (isIE6()) {
        if (checkBoxs && checkBoxs.length > 0) {
            var a = $("#compareCompany tr:gt(0) :checkbox");
            $.each(a, function(b) {
                for (var c = 0; c < checkBoxs.length; c++) {
                    if ($(this).attr("value") == checkBoxs[c]) {
                        $(this).attr("checked", "checked");
                        break
                    }
                }
            })
        }
    }
    $("#compareCompany tr:gt(0) :checkbox").each(function() {
        $(this).bind("click", function() {
            compareCheckBox(this)
        })
    })
}
$("#orderBySupplierName").click(function() {
    comNameOrder = comNameOrder * (-1);
    initMap();
    var a = map.sort(function(f, e) {
        var d;
        if (f.companyName < e.companyName) {
            d = -1
        } else {
            if (f.companyName > e.companyName) {
                d = 1
            } else {
                d = 0
            }
        }
        return d * comNameOrder
    });
    $("#orderByYear span").attr("id", "oldDown");
    $("#orderByCert span").attr("id", "oldDown");
    if (comNameOrder == 1) {
        $("#orderBySupplierName span").attr("id", "down")
    } else {
        $("#orderBySupplierName span").attr("id", "up")
    }
    var c = $("#compareCompany");
    trs.remove();
    for (var b = 0; b < a.length; b++) {
        c.append(trs[a[b].index])
    }
    recoverSelectedCheckBox()
});
$("#orderByYear").click(function() {
    yearOrder = yearOrder * (-1);
    initMap();
    var a = map.sort(function(f, e) {
        var d;
        if (f.year < e.year) {
            d = -1
        } else {
            if (f.year > e.year) {
                d = 1
            } else {
                d = 0
            }
        }
        return d * yearOrder
    });
    $("#orderBySupplierName span").attr("id", "oldDown");
    $("#orderByCert span").attr("id", "oldDown");
    if (yearOrder == 1) {
        $("#orderByYear span").attr("id", "down")
    } else {
        $("#orderByYear span").attr("id", "up")
    }
    var c = $("#compareCompany");
    trs.remove();
    for (var b = 0; b < a.length; b++) {
        c.append(trs[a[b].index])
    }
    recoverSelectedCheckBox()
});
$("#orderByCert").click(function() {
    standCert = standCert * (-1);
    initMap();
    var a = map.sort(function(f, e) {
        var d;
        if (f.standCertFlag < e.standCertFlag) {
            d = -1
        } else {
            if (f.standCertFlag > e.standCertFlag) {
                d = 1
            } else {
                d = 0
            }
        }
        return d * standCert
    });
    $("#orderBySupplierName span").attr("id", "oldDown");
    $("#orderByYear span").attr("id", "oldDown");
    if (standCert == 1) {
        $("#orderByCert span").attr("id", "down")
    } else {
        $("#orderByCert span").attr("id", "up")
    }
    var c = $("#compareCompany");
    trs.remove();
    for (var b = 0; b < a.length; b++) {
        c.append(trs[a[b].index])
    }
    recoverSelectedCheckBox()
});
$("#narrow").click(function() {
    if ($(this).attr("class") == "mn mar1") {
        $(this).attr("class", "la mar1");
        $("div.category").hide()
    } else {
        if ($(this).attr("class") == "la mar1") {
            $(this).attr("class", "mn mar1");
            $("div.category").show()
        }
    }
});
function checkSearchWord() {
    if ($("#searchWord").val() == "") {
        alert("please enter search word!");
        return false
    }
    return true
}
function checkBottomSearch() {
    if ($("#bottomSearch").val() == "") {
        alert("please enter search word!");
        return false
    }
    return true
}
function addCart(b) {
    var h = "0";
    if (b == "compareCompany") {
        h = "2"
    }
    var g = $("#" + b + " :checkbox:checked[name=recIds]");
    var f = g.length, e = $(this);
    if (f <= 0) {
        alert("please at least select one item.");
        return false
    } else {
        var j = location.hostname;
        var c = "http://" + j + "/inquirycart/add";
        var a = [];
        for (var d = 0; d < f; d++) {
            a.push(g[d].value)
        }
        $.ajax({url: c + ".json?type=" + h + "&recIds=" + a, dateType: "html", success: function(i) {
                alert("Put In Inquiry Cart Success!");
                setInquiryShowFlag(true);
                if (h == "0") {
                    location.reload()
                } else {
                    updateInquiryCartCount()
                }
            }})
    }
}
function setInquiryShowFlag(a) {
    inquiryShowFlag = a
}
$(".js-preview .photo100").hover(function() {
    var f = $(this);
    if (f.find("img").attr("src") == "/images/no-140.gif") {
        return
    }
    var g = f.attr("data-np4url");
    var j = f.find("a");
    var b = j.attr("href");
    var e = j.attr("title");
    var d = f.offset();
    var i = d.left + 150;
    var c = d.top;
    var l = $(".js-preview-viewBox");
    l.show().css({left: i, top: c});
    var k = l.find("img");
    k.attr("src", "");
    k.attr("src", g);
    k.attr("title", e);
    k.attr("alt", e);
    l.find(".inner a").attr("href", b);
    var h = l.find("div.previewPrdName a");
    h.attr("href", b);
    h.text(e)
}, function() {
    $(".js-preview-viewBox").hide()
});
$(".js-preview-viewBox").mouseover(function() {
    $(".js-preview-viewBox").show()
});
$(".js-preview-viewBox").mouseout(function() {
    $(".js-preview-viewBox").hide()
});