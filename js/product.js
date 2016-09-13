var globalImgServer = "localhost:8080/alibaba/";
location.protocol === "https:" && (globalImgServer = "https://ipaystyle.alibaba.com");
define("js/6v/biz/aisn/ghome/hp/hp.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/easing/easing.js?t=a130a051_131619e7f", "js/6v/lib/gallery/hammer/hammer.js?t=423639a5_0", "js/6v/lib/arale/switchable/carousel.js?t=9838a4a_af4aca40a", "js/6v/lib/icbu/rwd/rwd.js?t=6f285f80_f24a65a7", "js/6v/biz/common/utm-model/utm-model.js?t=424bae6_42dbffc8", "js/6v/lib/icbu/scroll-trigger/scroll-trigger.js?t=72d7c918_49de30ebd", "js/6v/biz/aisn/ghome/load/load.js?t=a1ebd395_42dbffc8"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/switchable/carousel.js?t=9838a4a_af4aca40a"), i = require("js/6v/lib/icbu/rwd/rwd.js?t=6f285f80_f24a65a7"), s = require("js/6v/biz/common/utm-model/utm-model.js?t=424bae6_42dbffc8"), o = require("js/6v/lib/icbu/scroll-trigger/scroll-trigger.js?t=72d7c918_49de30ebd"), u = require("js/6v/biz/aisn/ghome/load/load.js?t=a1ebd395_42dbffc8"), a = function() {
        var e = i.getRwd();
        return e == "l" || e == "m" ? 5 : 4
    };
    t.exports = function(e) {
        c(e)
    };
    var f = !1, l = function(e) {
        f || (f = !0, h(e))
    }, c = function(e) {
        o.add({element: "#m-hp", distance: 0, onRouse: function() {
                l(e)
            }, oneoff: !0}), u.load(function() {
            l(e)
        })
    }, h = function(e) {
        var t = e.find("[data-role=content]"), o = t.find("li").eq(0).clone(), u = (new s({sceneId: "3090"})).done(function(s) {
            if (!s.length)
                return;
            var f = "", l, c;
            for (l = 0, c = s.length; l < c; l++)
                f += '<li style="width:' + 100 / c + '%;">' + p(o, s[l], l + 1) + "</li>";
            t.html(f), t.delegate("[data-id]", "click", function(e) {
                var t = n(e.currentTarget), r = t.attr("data-id"), i = t.attr("data-area");
                u.clickStat({id: r, area: i})
            });
            var h = (new r({element: e, effect: "scrollx", rwd: !0, isTouch: n("html").hasClass("is-touch"), viewSize: [100], circular: !1, step: a(), disabledBtnClass: "disabled", classPrefix: "", easing: "easeBoth", hasTriggers: !1})).render();
            u.exposeStat(0), h.on("switched", function(e) {
                u.exposeStat(e)
            }), h.content.css("width", 100 / h.get("step") * h.get("panels").length + "%"), i.onBreakpoint(function() {
                h.set("step", a()).switchTo(0), h.content.css("width", 100 / h.get("step") * h.get("panels").length + "%")
            })
        }).fail(function() {
        }).always(function() {
        })
    }, p = function(e, t, n) {
        var r = "?tracelog=hp_hproduct" + n;
        return e.clone().find("[data-role=product]").attr({href: (t.productUrl || "") + r, title: t.subject || ""}).end().find("[data-role=img]").attr({"data-id": t.id, "data-image-src": "", src: t.defaultImagePath || ""}).end().find("[data-role=subject]").attr({"data-id": t.id}).html(t.subject || "").end().html()
    }
});