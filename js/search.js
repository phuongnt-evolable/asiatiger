var globalImgServer = "http://style.alibaba.com";
location.protocol === "https:" && (globalImgServer = "https://ipaystyle.alibaba.com");
define("js/6v/biz/common/searchbar/_dev/src/v4/data.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = r.extend({attrs: {aisnServer: "http://www.alibaba.com"}, run: function(e) {
            var t = this;
            return t.initAttrs(e), t.dataBase = {}, t.currentType = "products", t.plainData = {staticSuggestType: "recentKeywords"}, t.defaultData = [{action: t.get("aisnServer") + "/trade/search", name: "Products", typeValue: "product_en", statis: "p", recentUrl: "http://www.alibaba.com/products/{@}.html"}, {action: t.get("aisnServer") + "/trade/search", name: "Suppliers", typeValue: "company_en", statis: "c", recentUrl: "http://www.alibaba.com/corporations/{@}.html"}, {action: "http://sourcing.alibaba.com/rfq_search_list.htm", name: "Buyers", typeValue: "offer_en", statis: "b", recentUrl: "http://sourcing.alibaba.com/rfq_search_list.htm?SearchText={@}"}], t.plainData = n.extend(t.plainData, t.attrs), t.registerTypeData(t._availableData()), t
        }, _key4Data: function(e) {
            var t = this, n = t.dataBase[t.currentType];
            return n[e] || (n = t.plainData), n
        }, _availableData: function() {
            var e = null, t = {}, r = !0, i = this, s = "", o = i.get("data");
            return o && n.isArray(o) && o.forEach(function(t, r) {
                if (n.type(t) === "string" && i.defaultData.some(function(e) {
                    return t === e.name
                })) {
                    var s = i.defaultData.filter(function(e) {
                        return t === e.name
                    });
                    s && e === null && (e = []), s && e.push(s[0])
                } else
                    n.type(t) === "object" && (e === null && (e = []), e.push(t))
            }), e !== null && (r = !1), e = e || i.defaultData, e.forEach(function(e, n) {
                var r = e.name.toLowerCase();
                n === 0 && (s = r), i.addType(r), t[r] = e
            }), i.get("currentType") ? i.currentType = i.get("currentType") : r || (i.currentType = s), t
        }, getType: function() {
            return this.currentType
        }, setType: function(e) {
            this.dataBase[e] && (this.currentType = e)
        }, addType: function(e) {
            this.dataBase[e] = {}
        }, registerTypeData: function(e) {
            var t = arguments, r = null, i = this, s = Object.keys(e);
            s.forEach(function(t) {
                i.dataBase[t] && (i.dataBase[t] = n.extend(i.dataBase[t], e[t]))
            })
        }, getData: function() {
            return this.dataBase
        }, getCurrent: function(e) {
            return this._key4Data(e)[e]
        }});
    t.exports = i
});
define("js/6v/biz/common/searchbar/_dev/src/v4/cem.js", ["js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"], function(require, e, t) {
    function o(e) {
        return Object.prototype.toString.call(e) === "[object Boolean]"
    }
    function u(e) {
        var t = Array.prototype.slice, n = t.call(arguments, 1);
        return n.length === 0 && n.push(0), Array.prototype.slice.apply(e, n)
    }
    var n = require("js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225"), r = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), i, s = {};
    i = function(e) {
        var t = new n;
        return r.extend(t, {namespace: e || "", domainType: e ? "named" : "unamed", _trigger: t.trigger, _ranCE: {}, trigger: function(e, t) {
                var n = !0, r = u(arguments), i = {target: this, type: e};
                return r.splice(1, 0, i), n = this._trigger.apply(this, r), this._ranCE[e] = [i, t], n
            }, _instant: function(e, t, n) {
                var r = this._ranCE[e], i = !1;
                return r && (r[0].data = n, t.apply(r[0].target, r), i = !0), i
            }, subscribe: function(e, t, n, r) {
                o(u(arguments).pop()) && (r = n, n = undefined), this.on(e, t, n), (r === undefined || r) && this._instant(e, t, n)
            }, _once: function(e, t, n) {
                var r = function(r, i) {
                    t.apply(this, arguments), this.off(e, t, n)
                };
                this.on(e, t, n)
            }, subscribeOnce: function(e, t, n, r) {
                var i = !1;
                if (r === undefined || r)
                    i = this._instant(e, t, n);
                i || this._once(e, t, n)
            }}), t
    };
    var a = new i;
    r.extend(a, {domain: function(e) {
            var t;
            return e ? t = s[e] || (s[e] = new i(e)) : t = new i, t
        }, domainType: "global"}), t.exports = a
});
define("js/6v/biz/common/searchbar/_dev/src/v4/utils.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = n.browser.msie && n.browser.version == "6.0" || !1, i = {isIE6: r, redirect: function(e) {
            var t = document.createElement("a");
            "click"in t ? setTimeout(function() {
                t.href = e, t.style.display = "none", document.body.appendChild(t), t.click()
            }, 10) : window.location = e
        }, xmlEncode: function(e) {
            return e = n.trim(e), e = e.replace(/&/g, "&amp;"), e = e.replace(/</g, "&lt;"), e = e.replace(/>/g, "&gt;"), e = e.replace(/\'/g, "&#39;"), e = e.replace(/\"/g, "&quot;"), e
        }, xmlDecode: function(e) {
            return e = n.trim(e), e = e.replace(/&amp;/g, "&"), e = e.replace(/&lt;/g, "<"), e = e.replace(/&gt;/g, ">"), e = e.replace(/&apos;|&#39;/g, "'"), e = e.replace(/&quot;/g, '"'), e
        }, cleanHtml: function(e) {
            var t = e.replace(/<\/?[^>]*>/g, "");
            return t
        }, htmlToText: function(e) {
            var t = n("<span></span>");
            return t.html(e), t.text()
        }};
    t.exports = i
});
define("js/6v/biz/common/searchbar/_dev/src/v4/advanced.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), i = require("js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5"), s = i.extend({attrs: {buttonElm: ".ui-searchbar-advanced-link", uiClass: "ui-searchbar-mod-advanced", url: "http://www.alibaba.com/trade/advancesearch"}, initialize: function(e, t) {
            s.superclass.initialize.call(this, e), this.searchbar = t
        }, render: function() {
            return s.superclass.render.call(this), this.run(), this
        }, run: function() {
            var e = this, t = e.searchbar.keywordElm, n = e.searchbar.getElement(e.get("buttonElm")), i = [];
            if (n.length === 0)
                return;
            e.searchbar.getContainer().addClass(e.get("uiClass")), n.click(function(n) {
                n.preventDefault(), i.push("advancedSearchText=" + encodeURIComponent(t.val()).replace(/%20/g, "+")), r.redirect(e.get("url") + "?" + i.join("&"))
            })
        }});
    t.exports = s
});
define("js/6v/biz/common/searchbar/_dev/src/v4/form.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = require("js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481"), s = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), o = r.extend({CHANGE_VALUE: "formChangeValue", SUBMIT: "formSubmit", CLICK_BUTTON_SUBMIT: "formClickButtonSubmit", BEFORE_SUBMIT: "formBeforeSubmit", CATEGORY_REMOVE: "formCategoryRemove", TYPE_ITEM_SELECTED: "searchTypeChangeValue", attrs: {keywordElm: null, typeElm: null, cateIdElm: null, formElm: null, searbarElm: null, placeholder: "", keyword: "", category: "", validateItems: [{rule: "require", message: "Please input a search term."}, {rule: "^.{0,50}$", message: "Please input a search term less than 50 characters."}, {rule: "^[\x00-\x80]*$", message: "Sorry, the information you filled in is not in English.\nPlease input the information in English instead."}]}, run: function(e, t, r) {
            return this.initAttrs(e), this.data = t, this.cem = r, this.formElm = n(this.get("formElm")), this.keywordElm = n(this.get("keywordElm")), this.rtl = this.get("searbarElm").css("direction") === "rtl", this._setDefaultValue(), this._bindEvent(), this.setFormAction(t.getCurrent("action")), this.setPlaceholderValue(this.get("placeholder")), this.initCategory(), this
        }, _setDefaultValue: function() {
            this.get("keyword") && this.keywordElm.val(s.xmlDecode(this.get("keyword")));
            if (!this.keywordElm.val())
                try {
                    if (window.opener) {
                        var e = n(window.opener.document).find("ui-searchbar-keyword").val();
                        this.keywordElm.val(s.xmlDecode(e))
                    }
                } catch (t) {
                }
        }, _bindEvent: function() {
            var e = this, t = n.browser.msie, r = function() {
                n(e.get("typeElm")).val(e.data.getCurrent("typeValue"));
                var r = e.data.getCurrent("action");
                r && e.formElm.attr("action", r), t && (e.keywordElm[0].focus(), e.keywordElm[0].blur())
            };
            e.cem.subscribe(e.TYPE_ITEM_SELECTED, r.bind(this)), r(), e.cem.subscribe(e.CHANGE_VALUE, function(e, t) {
            }), e.cem.subscribe(e.SUBMIT, function(t, n) {
                e._onSubmit() && (e.isClickButton && e.cem.trigger(e.CLICK_BUTTON_SUBMIT), e.formElm[0].submit()), e.isClickButton = !1
            }), e.formElm.submit(function(t) {
                t.preventDefault(), e.cem.trigger(e.SUBMIT)
            }), this.formElm.find("[type=submit]").on("click", function(t) {
                if (t.clientX > 0 || t.clientY > 0)
                    e.isClickButton = !0
            }), e.keywordElm.on("focus", function() {
                e.get("searbarElm").addClass("ui-searchbar-hightlight")
            }).on("blur", function() {
                e.get("searbarElm").removeClass("ui-searchbar-hightlight")
            })
        }, _verifyKeyword: function(e) {
            var t = this.get("validateItems");
            if (t)
                for (var n = 0, r = t.length; n < r; n++) {
                    var i = t[n];
                    if (i.rule === "require") {
                        if ("" === e)
                            return alert(i.massage || i.message), !1
                    } else if (!(new RegExp(i.rule)).test(e))
                        return alert(i.massage || i.message), !1
                }
            return!0
        }, _onSubmit: function() {
            var e = this, t = n.trim(e.keywordElm.val());
            return this._verifyKeyword(t) ? (this.trigger(e.BEFORE_SUBMIT), e.cem.trigger(e.BEFORE_SUBMIT, {keyword: t})) : (e.keywordElm[0].focus(), !1)
        }, setPlaceholderValue: function(e) {
            var t = this;
            try {
                t.keywordElm.attr("placeholder", e)
            } catch (n) {
            }
            i(t.keywordElm)
        }, setKeywordFieldName: function(e) {
            this.keywordElm.prop("name", e)
        }, setValidateItems: function(e) {
            this.set("validateItems", e)
        }, initCategory: function() {
            function s() {
                t.remove(), i.css(this.rtl ? "padding-right" : "padding-left", 0), e.cem.trigger(e.CATEGORY_REMOVE)
            }
            var e = this;
            if (!e.get("category"))
                return;
            var t = n("<div></div>").addClass("ui-searchbar-category").html(e.get("category")), r = n('<i class="ui-searchbar-category-colse"></i>'), i = e.keywordElm.parent();
            r.appendTo(t), t.insertBefore(e.keywordElm), i.css(this.rtl ? "padding-right" : "padding-left", t.outerWidth()), e.keywordElm.on("keydown", function(t) {
                t.keyCode === 8 && e.keywordElm.val() == "" && s()
            }), r.on("click", function(e) {
                s()
            })
        }, _getField: function(e) {
            return this.formElm.find("input[type=hidden][name=" + e + "]")
        }, addField: function(e, t, r) {
            if (!this.formElm)
                return;
            var i = this._getField(e);
            return i.length > 0 ? i.val(t) : (i = n('<input type="hidden"/>').val(t).prop("name", e), r && i.prop("id", r), i.appendTo(this.formElm)), i
        }, removeField: function(e) {
            if (!this.formElm)
                return;
            var t = this._getField(e);
            t.length > 0 && t.remove()
        }, setFormAction: function(e) {
            if (!this.formElm)
                return;
            this.formElm.attr("action", e)
        }});
    t.exports = o
});
define("js/6v/biz/common/searchbar/_dev/src/v4/history.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148"], function(require, e, t) {
    function d(e, t, r, s, o, u) {
        var a = new Date;
        a.setTime(a.getTime() + 5184e6), this.expires = r ? r : a, this.domain = s ? s : null, this.path = o ? o : "/", this.secure = u ? u : !1, this.name = e ? e : null, this.groups = t && n.isArray(t) ? t : [], this.__tree = {}, this.changed = !1, this.buildString = function(e) {
            return null != e && e.length > 0 ? e.join(l) : null
        }, this.parseFromString = function(e) {
            if (null == e || "" == e)
                return this;
            var t = e.split(l);
            this.removeAll();
            for (var n = 0; n < t.length; n++)
                if (null != t[n] && "" != t[n]) {
                    var r = new v;
                    r.parseFromString(t[n]), this.add(r)
                }
            return this
        }, this.toString = function() {
            return this.buildString(this.groups)
        }, this.size = function() {
            return this.groups.length
        }, this.arrange = function() {
            var e = [], t = {};
            for (var n = 0; n < this.size(); n++)
                null != this.groups[n] && (e[e.length] = this.groups[n], t[this.groups[n].name] = this.groups[n]);
            this.removeAll(), this.groups = e, this.__tree = t
        }, this.__clearTree = function() {
            this.__tree = {}
        }, this.__addToTree = function(e) {
            null != e && (this.__tree[e.name] = e)
        }, this.__removeFromTree = function(e) {
            null != e && delete this.__tree[e.name]
        }, this.removeAll = function() {
            this.groups = [], this.__clearTree()
        }, this.get = function(e) {
            return this.__tree[e] ? this.__tree[e] : null
        }, this.add = function(e) {
            if (null == e)
                return;
            for (var t = 0; t < this.size(); t++)
                e.name.toLowerCase() == this.groups[t].name.toLowerCase() && this.remove(e.name);
            return e.parent = this, this.groups[this.size()] = e, this.__addToTree(e), this
        }, this.remove = function(e) {
            if (null == e || "" == e)
                return;
            for (var t = 0; t < this.size(); t++)
                e.toLowerCase() == this.groups[t].name.toLowerCase() && (this.__removeFromTree(this.groups[t]), this.groups[t] = null);
            return this.arrange(), this
        }, this.save = function() {
            this.changed = !0, i.set(this.name, this.toString(), {expires: this.expires, domain: this.domain, path: this.path, secure: this.secure})
        }, this.clear = function() {
            i.clear(this.name)
        };
        if (this.name != null && n.type(t) == "string")
            this.parseFromString(t);
        else if (this.name != null && n.isArray(t))
            for (var f = 0; f < this.size(); f++)
                null != this.groups[f] && (this.__addToTree(this.groups[f]), this.groups[f].parent = this)
    }
    function v(e, t) {
        this.name = e ? e : null, this.items = t && n.isArray(t) ? t : [], this.__tree = {}, this.max = 20, this.parent = null, this.buildString = function(e) {
            var t = this.name ? this.name : NO_SET_STR;
            return null != e && e.length > 0 ? t + c + e.join(h) : t
        }, this.parseFromString = function(e) {
            if (null == e || "" == e)
                return this;
            var t = e.indexOf(c);
            if (t > -1) {
                this.name = e.substring(0, t);
                var n = e.substring(t + c.length);
                if (null != n && n != "") {
                    this.removeAll();
                    var r = n.split(h);
                    for (var i = 0; i < r.length; i++)
                        if (null != r[i] && "" != r[i]) {
                            var s = new m;
                            s.parseFromString(r[i]), this.add(s)
                        }
                }
            } else
                this.name = e;
            return this
        }, this.toString = function() {
            return this.buildString(this.items)
        }, this.getReverse = function() {
            var e = [];
            return this.size() > 0 ? this.items.slice(0, this.items.length).reverse() : e
        }, this.setMax = function(e) {
            this.max = e, this.arrange()
        }, this.size = function() {
            return this.items.length
        }, this.arrange = function() {
            var e = [], t = {};
            for (var n = 0; n < this.size(); n++)
                null != this.items[n] && (e[e.length] = this.items[n]);
            e.length > this.max && (e = e.slice(e.length - this.max, e.length));
            for (var n = 0; n < e.length; n++)
                t[e.key] = e[n];
            this.removeAll(), this.items = e, this.__tree = t
        }, this.__clearTree = function() {
            this.__tree = {}
        }, this.__addToTree = function(e) {
            null != e && (this.__tree[e.key] = e)
        }, this.__removeFromTree = function(e) {
            null != e && delete this.__tree[e.key]
        }, this.removeAll = function() {
            this.items = [], this.__clearTree()
        }, this.get = function(e) {
            return this.__tree[e] ? this.__tree[e] : null
        }, this.add = function(e) {
            if (null == e)
                return;
            for (var t = 0; t < this.size(); t++)
                e.key.toLowerCase() == this.items[t].key.toLowerCase() && this.remove(e.key);
            return e.parent = this, this.items[this.size()] = e, this.__addToTree(e), this
        }, this.remove = function(e) {
            if (null == e || "" == e)
                return;
            for (var t = 0; t < this.size(); t++)
                e.toLowerCase() == this.items[t].key.toLowerCase() && (this.__removeFromTree(this.items[t]), this.items[t] = null);
            return this.arrange(), this
        }, this.save = function() {
            null != this.parent && (this.arrange(), this.parent.save())
        };
        if (this.name != null && n.type(t) == "string")
            this.parseFromString(this.name + c + t);
        else if (this.name != null && n.isArray(t))
            for (var r = 0; r < this.size(); r++)
                null != this.items[r] && (this.__addToTree(this.items[r]), this.items[r].parent = this)
    }
    function m(e, t) {
        this.key = e ? e : null, this.attributes = t && n.isArray(t) ? t : [], this.max = 20, this.parent = null, this.buildString = function(e) {
            var t = this.key ? this.key : NO_SET_STR;
            return null != e && e.length > 0 ? t + p + e.join(p) : t
        }, this.parseFromString = function(e) {
            if (null == e || "" == e)
                return this;
            var t = e.split(p);
            return t.length > 0 && (this.key = t[0], this.attributes = t.slice(1, t.length)), this
        }, this.setMax = function(e) {
            this.max = e, this.arrange()
        }, this.size = function() {
            return this.attributes.length
        }, this.toString = function() {
            return this.buildString(this.attributes)
        }, this.getReverse = function() {
            var e = [];
            return this.size() > 0 ? this.attributes.slice(0, this.attributes.length).reverse() : e
        }, this.reverseString = function() {
            return this.buildString(this.getReverse())
        }, this.arrange = function() {
            var e = [];
            for (var t = 0; t < this.size(); t++)
                null != this.attributes[t] && (e[e.length] = this.attributes[t]);
            e.length > this.max ? this.attributes = e.slice(e.length - this.max, e.length) : this.attributes = e
        }, this.removeAll = function() {
            this.attributes = []
        }, this.get = function(e) {
            return e < this.size() ? this.attributes[e] : null
        }, this.add = function(e) {
            if (null == e || "" == e)
                return;
            return this.remove(e), this.attributes[this.size()] = e, this.arrange(), this
        }, this.remove = function(e) {
            if (null == e || "" == e)
                return;
            for (var t = 0; t < this.size(); t++)
                e.toLowerCase() == this.attributes[t].toLowerCase() && (this.attributes[t] = null);
            return this.arrange(), this
        }, this.contains = function(e) {
            for (var t = 0; t < this.size(); t++)
                if (e.toLowerCase() == this.attributes[t].toLowerCase())
                    return!0
        }, this.save = function() {
            null != this.parent && (this.arrange(), this.parent.save())
        }, this.key != null && n.type(t) == "string" && this.parseFromString(this.key + p + t)
    }
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = require("js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148"), s = {}, o = "alibaba.com", u = "history", a = "keywords", f = 5, l = "\n\n", c = "^\n", h = "$\n", p = "\t", g = r.extend({initialize: function() {
            this.cookieCache = []
        }, setup: function() {
        }, _addOrUpdateItem: function(e, t, r, i) {
            if (null == r || "" == r)
                return;
            var s = this.getGroup(e), o = s.get(t), u = !1;
            n.isArray(r) ? (o = new m(t, r), u = !0) : (o = null == o ? new m(t) : o, o.add(r), u = !0), s.add(o), e == a ? o.setMax(i) : s.setMax(i), u && s.save()
        }, _getTable: function() {
            var e = u, t = o, n = this.cookieCache[e];
            if (null == n || n.changed) {
                n = new d(e);
                var r = i.get(e);
                null != r && r != "" && n.parseFromString(r), t && (n.domain = t), this.cookieCache[e] = n
            }
            return n
        }, getGroup: function(e) {
            var t = this._getTable(), n = t.get(e);
            return null == n && (n = new v(e), t.add(n), n.parent = t), n
        }, logKeyword: function(e) {
            this._addOrUpdateItem(a, a, e, f)
        }}), y = new g;
    t.exports = {getHistoryGroup: y.getGroup.bind(y), logKeywordsHistory: y.logKeyword.bind(y)}
});
define("js/6v/biz/common/searchbar/_dev/src/v4/recent-keywords.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148", "js/6v/biz/common/searchbar/_dev/src/v4/history.js?t=5e5657a6_521faca65", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa"), i = require("js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5"), s = require("js/6v/biz/common/searchbar/_dev/src/v4/history.js?t=5e5657a6_521faca65"), o = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), u = "keywords", a = "recendKeywordsSelected", f = ".ui-searchbar-static-content", l = ".ui-searchbar-static-title", c = i.extend({attrs: {template: '<div class="ui-searchbar-keyword-panel ui-searchbar-static" style="display:none;"><strong class="ui-searchbar-static-title">Popular Searches:</strong><div class="ui-searchbar-static-content"></div></div>'}, initialize: function(e, t) {
            c.superclass.initialize.call(this, e), this.searchbar = t
        }, render: function() {
            return c.superclass.render.call(this), this.run(), this
        }, run: function() {
            var e = this, t = this.searchbar;
            e.searchbarElm = t.getContainer(), e.keywordElm = t.keywordElm, e.contentElm = e.$(f), e.titleElm = e.$(l);
            if (e.hasKeyword())
                e.element.addClass("ui-searchbar-recent"), e.titleElm.html("Your Recent Searches:"), e._resetContent();
            else {
                var n = t.get("popularKeywords"), r = [];
                n.length > 0 && n.forEach(function(t) {
                    r.push('<a ref="nofollow" href="javascript:void(0);" data-keyword="' + e._encodeKeyword(t) + '">' + o.cleanHtml(t) + "</a>")
                }), e.contentElm.html(r.join(", "))
            }
            e.renderUI(), e.searchbar.cem.on("formCategoryRemove", function() {
                e._setPosition()
            })
        }, renderUI: function() {
            this._showRecentKeywords()
        }, logKeywords: function() {
            s.logKeywordsHistory(n.trim(this.keywordElm.attr("value")))
        }, hasKeyword: function() {
            var e = s.getHistoryGroup(u);
            return e && e.size() > 0
        }, _resetContent: function() {
            var e = this, t = e._getRecentKeywordsHtml();
            e.contentElm.html(t)
        }, _showRecentKeywords: function() {
            function i(n) {
                e.keywordElm.val() === "" ? t.set("disabled", !1) : t.set("disabled", !0)
            }
            var e = this, t = e.popup = new r({trigger: e.keywordElm, triggerType: "hover", element: e.element});
            e._setPosition(), e.hackIE6(e.popup), e.keywordElm.on("click", i).on("keyup", i).on("keydown", function(e) {
                t.hide()
            }), e.contentElm.click(function(t) {
                var r = n(t.target), i = r.data("keyword");
                i && (e.searchbar.cem.trigger(a, {keyword: i}), setTimeout(function() {
                    o.redirect(e.searchbar.searchbarData.getCurrent("recentUrl").replace("{@}", i))
                }, 100))
            })
        }, _setPosition: function() {
            var e = this, t = e.keywordElm.parent(), n = t.height(), r = -parseInt(t.css("padding-left"), 10) - 11;
            e.popup.set("align", {baseXY: [r, n]})
        }, _getRecentKeywordsHtml: function() {
            var e = null, t = null, n = [], r = null, i = this;
            return r = s.getHistoryGroup(u), r && r.size() > 0 && (e = r.get(u), e && e.size() > 0 && (t = e.getReverse(), t.forEach(function(e) {
                n.push('<a ref="nofollow" href="javascript:void(0);" data-keyword="' + i._encodeKeyword(e) + '">' + o.cleanHtml(e) + "</a>")
            }))), n.join(", ")
        }, _encode: function(e) {
            if (e == null)
                return"";
            var t = escape(e);
            return e.indexOf("+") != -1 && (t = t.replace(/\+/g, "%2B")), e.indexOf("/") != -1 && (t = t.replace(/\//g, "%2F")), t
        }, _encodeKeyword: function(e) {
            return e == null ? "" : (e = e.replace(/^\s*|\s*$/g, ""), e = e.replace(/\s+/g, "_"), e = this._encode(e), this._encode(e))
        }, hackIE6: function(e) {
            if (!o.isIE6)
                return;
            var t = keywordEl.parent(), r = e.get("align");
            r.baseXY[0] = -16, e.set("align", r), e.set("width", t.width() - 1), n(window).resize(function() {
                e.set("width", t.width() - 1)
            })
        }});
    t.exports = c
});
define("js/6v/biz/common/searchbar/_dev/src/v4/speech.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0");
    t.exports = {run: function(e) {
            function r() {
                var e = document.createElement("input"), t = "onwebkitspeechchange"in e || "speech"in e;
                return t
            }
            var t = n(e.keywordId);
            r() && t.length > 0 && (t[0].onwebkitspeechchange = function() {
                var e = "http://stat.alibaba.com/ued/post.html", t = {tracelog: "speak_now"};
                dmtrack.clickstat(e, t)
            })
        }}
});
define("js/6v/biz/common/searchbar/_dev/src/v4/suggest-dynamic.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b"), i = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), s = require("js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148"), o;
    o = r.extend({DATA_BACK: "suggestDynamicDataBack", ITEM_SELECTED: "suggestDynamicItemSelect", INDEX_CHANGE: "suggestDynamicIndexChange", attrs: {selectFirst: !1, searchTypeFieldElm: "", searchCategoryFieldElm: "", autoSuggestionCateId: "", delay: 1, parentNode: n(document.body), template: '<div class="ui-searchbar-keyword-panel {{classPrefix}}"><ul class="{{classPrefix}}-ctn" data-role="items">{{#each items}}<li data-role="item" class="{{../classPrefix}}-item" data-value="{{matchKey}}">{{{highlightItem ../classPrefix matchKey}}}{{#if catName}}&nbsp;<span class="search-category">in {{{catName}}}</span>{{/if}}</li>{{/each}}</ul></div>', url: {value: "", setter: function(e) {
                    return e ? e : "http://connectkeyword.alibaba.com/lenoIframeJson.htm?iframe_delete=true&varname=intelSearchData&keyword={{query}}&searchType={{searchType}}&cateId={{cateId}}&cookieId={{cookieId}}"
                }}, dataSource: function(e, t) {
                var r = this, i = r.ac.get("url"), s, o = {query: e ? encodeURIComponent(e) : "", searchType: n(r.ac.get("searchTypeFieldElm")).val() || "product_en", cateId: r.ac.get("autoSuggestionCateId") || "", cookieId: r.ac.beaconCookieId};
                i = i.replace(new RegExp("{{(.*?)}}", "g"), function(e, t) {
                    return o[t]
                });
                var u = "callback_" + this.id++;
                r.callbacks.push(u), /^(https?:\/\/)/.test(i) ? s = {dataType: "jsonp"} : s = {dataType: "json"}, n.ajax(i, s).success(function(e) {
                    n.inArray(u, r.callbacks) > -1 && (delete r.callbacks[u], t(e))
                }).error(function() {
                    n.inArray(u, r.callbacks) > -1 && (delete r.callbacks[u], t({}))
                })
            }, classPrefix: "ui-searchbar-dynamic", regexpString: function(e) {
                return e.replace(new RegExp("\\\\", "g"), "\\\\").replace(new RegExp("\\*", "g"), "\\*").replace(new RegExp("\\(", "g"), "\\(").replace(new RegExp("\\)", "g"), "\\)").replace(new RegExp("\\*", "g"), "\\*").replace(new RegExp("\\[", "g"), "\\[").replace(new RegExp("\\+", "g"), "\\+").replace(new RegExp("\\/", "g"), "\\/")
            }, filter: function(e, t) {
                var r = [], i = t.length, s = new RegExp("^" + this.get("regexpString")(t)), o = window.intelSearchData, u = this, a = -1, f = [], l = function(e) {
                    var t = n("<span></span>");
                    return t.html(e), t.text()
                };
                return u.set("hasPersonal", !1), n.each(o, function(e, s) {
                    var o = {}, f;
                    a++, o.matchKey = l(s.keywords);
                    var c = -1, h = n.trim(t);
                    if (i > 0) {
                        f = [];
                        while (o.matchKey.indexOf(h, c + 1) > - 1)
                            c = o.matchKey.indexOf(h, c + 1), f.push([c, c + h.length])
                    }
                    o.highlightIndex = f, o.isPersonal = s.personal, o.suggestIndex = a, r.push(o), s.cat && n.each(s.cat, function(e, t) {
                        for (var n in t)
                            a++, t.personal > 0 && u.set("hasPersonal", !0), r.push({catId: n, matchKey: l(s.keywords), catName: t[n], highlightIndex: f, isPersonal: s.personal, suggestIndex: a})
                    }), s.personal > 0 && u.set("hasPersonal", !0)
                }), n.each(r, function(e, t) {
                    (t.catId || t.isPersonal === "1") && f.push({key: t.matchKey, catId: t.catId || "", isPersonal: t.isPersonal})
                }), u.trigger(u.DATA_BACK, {exposure: f}), r
            }}, initialize: function(e, t) {
            var n = this;
            n.searchbar = t, o.superclass.initialize.call(n, e), n.rtl = t.getContainer().css("direction") === "rtl", n.setPosition(), n._hackIE6(), n._bindEvent()
        }, setPosition: function() {
            var e = this, t = n(e.get("parentNode")), r = t.height(), i = -parseInt(t.css("padding-left"), 10), s = e.get("align");
            s.baseXY = [e.rtl ? i - 1 : i - 11, r]
        }, setup: function() {
            o.superclass.setup.call(this), this.beaconCookieId = s.get("ali_beacon_id"), this.dataSource.ac = this
        }, _step: function(e) {
            var t = this.get("selectedIndex");
            e === -1 ? t > -1 ? this.set("selectedIndex", t - 1) : this.set("selectedIndex", this.items.length - 1) : e === 1 && (t < this.items.length - 1 ? this.set("selectedIndex", t + 1) : this.set("selectedIndex", -1)), this.setInputValueTimely()
        }, setInputValue: function(e) {
            this.set("currentInputValue", this.getCurrentKeyword()), o.superclass.setInputValue.call(this, e)
        }, _hackIE6: function() {
            if (!i.isIE6)
                return;
            var e = this, t = n(e.get("parentNode")), r = e.get("align");
            r.baseXY[0] = -16, e.set("align", r), e.set("width", t.width() - 1), n(window).resize(function() {
                e.set("width", t.width() - 1)
            })
        }, _bindEvent: function() {
            var e = this, t = e.searchbar.cem;
            e.on("itemSelect", function(n) {
                t.trigger(e.ITEM_SELECTED, {suggestKeyword: n.matchKey, suggestIndex: n.suggestIndex, isSuggest: !0, keyword: e.getKeyword(), isPersonal: n.isPersonal, categoryId: n.catId})
            }), e.on("itemSelect", function(e) {
                setTimeout(function() {
                    t.trigger("formSubmit")
                }, 100)
            }), e.on("indexChange", function(n, r) {
                t.trigger(e.INDEX_CHANGE, {currentIndex: n, lastIndex: r})
            }), e.on(e.DATA_BACK, function(n) {
                t.trigger(e.DATA_BACK, {keyword: e.getCurrentKeyword(), exposureData: n.exposure})
            }), e.searchbar.cem.on("formCategoryRemove", function() {
                e.setPosition()
            })
        }, setInputValueTimely: function() {
            var e = this.currentItem, t = this.get("selectedIndex"), n = this.get("data")[t], r = this.get("trigger");
            if (t === -1) {
                r.val(this.get("inputValue"));
                var i = this.get("classPrefix") + "-item-hover";
                this.currentItem && this.currentItem.removeClass(i)
            } else
                r.val(n.matchKey)
        }, getHasPersonal: function() {
            return this.get("hasPersonal") ? 1 : 0
        }, getKeyword: function() {
            return this.get("currentInputValue")
        }, getCurrentKeyword: function() {
            return n.trim(n(this.get("trigger")).val())
        }}), t.exports = o
});
define("js/6v/biz/common/searchbar/_dev/src/v4/statistics.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8", "js/6v/lib/icbu/gdata/gdata.js?t=66132cea_d3949ad8", "js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), s = require("js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a"), o = window, u = {suggestDynamic: null, form: null, typeSelect: null};
    t.exports = r.extend({run: function(e, t, r) {
            this.config = n.extend(e || {}, u), this.data = t, this.cem = r, this.isFirstChange = !0, this._bindEvent()
        }, _bindEvent: function() {
            var e = this, t = e.cem;
            t.subscribe("suggestDynamicItemSelect", function(t, n) {
                e._suggestDynamicItemSelected(n)
            }), t.subscribe("suggestDynamicDataBack", function(t, n) {
                e._suggestDynamicDataCallback(n)
            }), t.subscribe("formClickButtonSubmit", function(t, n) {
                e._formClickSubmit()
            }), t.subscribe("searchTypeChangeValue", function(t, n) {
                e._typeSelected()
            }), t.subscribe("formBeforeSubmit", function(t, n) {
                e._formSubmit(n.keyword)
            }), t.subscribe("recendKeywordsSelected", function(t, n) {
                e._recendSelected(n.keyword)
            })
        }, _createReport: function(e, t, r) {
            var i = {type: this.data.getCurrent("statis") || "p"};
            t = n.extend(i, t);
            var s = [];
            Object.keys(t).forEach(function(e) {
                s.push(e + "=" + t[e])
            }), this._dotstat(e, s.join("|"), r)
        }, _suggestDynamicReport: function(e, t) {
            t && t.isSuggest && this._createReport(e, {key: t.keyword, keyword: t.suggestKeyword, index: t.suggestIndex, cid: t.categoryId, personal: t.isPersonal})
        }, _suggestDynamicDataCallback: function(e) {
            var t = e.exposureData, r = {key: e.keyword, keyword: "", cid: "", personal: ""};
            if (t.length > 0) {
                var i = {k: [], c: [], p: []};
                n.each(t, function(e, t) {
                    i.k.push(t.key), i.c.push(t.catId), i.p.push(t.isPersonal)
                }), r.keyword = i.k.join("^"), r.cid = i.c.join("^"), r.personal = i.p.join("^")
            }
            this._createReport(4104, r)
        }, _suggestDynamicItemSelected: function(e) {
            this._suggestDynamicReport(4105, e)
        }, _typeSelected: function() {
            if (this.isFirstChange) {
                this.isFirstChange = !1;
                return
            }
            var e = this.data.getCurrent("name");
            e && this._dotstat(4103, "type=" + e.toLowerCase())
        }, _formSubmit: function(e) {
            this._createReport(4101, {key: e}, !0)
        }, _formClickSubmit: function() {
            this._dotstat(4102, null, !0)
        }, _recendSelected: function(e) {
            this._createReport(4106, {key: e})
        }, _dotstat: function(e, t, n) {
            n === undefined && (n = !1);
            if (!window.dmtrack)
                return;
            t ? s.dotstat(e, {ext: "v=4|" + t, cache: n}) : s.dotstat(e, {ext: "v=4", cache: n})
        }})
});
define("js/6v/biz/common/searchbar/_dev/src/v4/type-select.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5"), i = require("js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8"), s = require("js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa"), o = r.extend({ITEM_SELECTED: "searchTypeChangeValue", attrs: {template: '<div><div class="ui-searchbar-type-value"><span class="ui-searchbar-type-display">&nbsp;</span><span class="ui-searchbar-hollow-arrow"><em></em><b></b></span></div><ul class="ui-searchbar-type-options" style="display:none;"></ul></div>', dropdownElm: ".ui-searchbar-type-options", displayElm: ".ui-searchbar-type-display", uiClass: "ui-searchbar-mod-type"}, initialize: function(e, t) {
            o.superclass.initialize.call(this, e), this.searchbar = t
        }, render: function() {
            return o.superclass.render.call(this), this.run(), this
        }, run: function() {
            var e = this, t = e.searchbar;
            this.disabled = !0;
            if (e.element.length === 0)
                return;
            e.data = t.searchbarData, e.cem = t.cem, e.dropdownElm = e.$(e.get("dropdownElm")), e.displayElm = e.$(e.get("displayElm")), e.disabled = !1, t && (t.getContainer().addClass(this.get("uiClass")), e.rtl = t.getContainer().css("direction") === "rtl");
            var r = function() {
                var n = e.rtl ? "margin-right" : "margin-left";
                t.keywordElm.parent().css(n, e.element.width() + 13)
            };
            e.cem.on(e.ITEM_SELECTED, function(e, t) {
                r()
            });
            var i = -1;
            return n(window).on("resize", function() {
                clearTimeout(i), i = setTimeout(function() {
                    r()
                }, 10)
            }), e.renderUI(), e._initDropdown(), e.syncUI(), e
        }, syncUI: function(e) {
            if (this.disabled)
                return;
            e && this.data.setType(e), this.displayElm.html(this.data.getCurrent("name"));
            var t = this.data.getCurrent("typeValue") || "";
            return this.cem.trigger(this.ITEM_SELECTED, {type: t, element: this.element}), this
        }, renderUI: function() {
            var e = this.data.getData(), t = [], n;
            for (n in e)
                t.push('<li class="ui-searchbar-type-option"><a href="javascript:void(0)" data-value="' + n + '" rel="nofollow">' + e[n].name + "</a></li>");
            return this.dropdownElm.html(t.join("")), this
        }, _initDropdown: function() {
            var e = this, t = n(e.get("searchbarElm")), r = new s({trigger: e.element, triggerType: "click", element: e.dropdownElm});
            r.before("show", function() {
                r.set("align", {baseXY: [0, e.element.height() + 2]}), e.dropdownElm.css("min-width", e.element.width() + 2)
            }), r.after("show", function() {
                e.rtl ? e.dropdownElm.css({left: "auto", right: -3}) : e.dropdownElm.css({left: -3, right: "auto"})
            }), e.searchbar.keywordElm.on("mouseover", function(e) {
                r.hide()
            }), e.dropdownElm.click(function(t) {
                var i = n(t.target), s = i.data("value");
                s || (s = i.parents("a").data("value")), s && (e.syncUI(s), e.trigger(e.ITEM_SELECTED, {type: s})), r.hide(), t.stopPropagation()
            })
        }});
    t.exports = o
});
define("js/6v/biz/common/searchbar/_dev/src/searchbar-v4-sc.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/header-module-base.js?t=40a811fd_4cec66192", "js/6v/biz/common/searchbar/_dev/src/v4/data.js?t=ae34e9e4_42ecace20", "js/6v/biz/common/searchbar/_dev/src/v4/cem.js?t=32e38585_1053e809e", "js/6v/biz/common/searchbar/_dev/src/v4/utils.js?t=79c2569c_42dbffc8", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/biz/common/searchbar/_dev/src/v4/advanced.js?t=c233566d_6e9963ddf", "js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481", "js/6v/biz/common/searchbar/_dev/src/v4/form.js?t=87f95dba_64179740f", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148", "js/6v/biz/common/searchbar/_dev/src/v4/history.js?t=5e5657a6_521faca65", "js/6v/biz/common/searchbar/_dev/src/v4/recent-keywords.js?t=9cd5c7c0_c92242309", "js/6v/biz/common/searchbar/_dev/src/v4/speech.js?t=2fa6c150_42dbffc8", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b", "js/6v/biz/common/searchbar/_dev/src/v4/suggest-dynamic.js?t=d9444c19_f3cb30034", "js/6v/lib/icbu/gdata/gdata.js?t=66132cea_d3949ad8", "js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a", "js/6v/biz/common/searchbar/_dev/src/v4/statistics.js?t=605c23a4_6213c626e", "js/6v/biz/common/searchbar/_dev/src/v4/type-select.js?t=6c256310_b409dcf1e"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/header-module-base.js?t=40a811fd_4cec66192"), i = require("js/6v/biz/common/searchbar/_dev/src/v4/data.js?t=ae34e9e4_42ecace20"), s = require("js/6v/biz/common/searchbar/_dev/src/v4/cem.js?t=32e38585_1053e809e"), o = require("js/6v/biz/common/searchbar/_dev/src/v4/advanced.js?t=c233566d_6e9963ddf"), u = require("js/6v/biz/common/searchbar/_dev/src/v4/form.js?t=87f95dba_64179740f"), a = require("js/6v/biz/common/searchbar/_dev/src/v4/recent-keywords.js?t=9cd5c7c0_c92242309"), f = require("js/6v/biz/common/searchbar/_dev/src/v4/speech.js?t=2fa6c150_42dbffc8"), l = require("js/6v/biz/common/searchbar/_dev/src/v4/suggest-dynamic.js?t=d9444c19_f3cb30034"), c = require("js/6v/biz/common/searchbar/_dev/src/v4/statistics.js?t=605c23a4_6213c626e"), h = require("js/6v/biz/common/searchbar/_dev/src/v4/type-select.js?t=6c256310_b409dcf1e"), p = ".ui-searchbar-field-type", d = ".ui-searchbar-field-category", v = r.extend({initialize: function(e) {
            n(e.containerId).hasClass("ui-searchbar-size-large") && e.mods.indexOf("static") === -1 && e.mods.push("static"), v.superclass.initialize.call(this, e)
        }, attrs: {data: null, currentType: "", currentKeyword: "", currentCategory: "", autoSuggestionCateId: "", autoSuggestionUrl: "", placeholder: "What are you looking for...", staticSuggestType: "recentKeywords", aisnServer: "http://www.alibaba.com", containerId: "#mod-searchbar", popularKeywords: ["electric scooter", "digital photo frame", "air conditioner", "three wheel motorcycle", "batteries", "car dvd", "concrete mixer", "baby car seat"], mods: ["type", "static", "dynamic"], controllers: {type: function(e) {
                    (new h({searchbarElm: e.getContainer(), parentNode: e.getElement(".ui-searchbar-type")}, e)).render()
                }, "static": function(e) {
                    var t = e.getContainer();
                    if (t.hasClass("ui-searchbar-size-large") || t.hasClass("ui-searchbar-size-middle")) {
                        var n = (new a({parentNode: e.keywordElm.parent()}, e)).render();
                        e.form.on(e.form.BEFORE_SUBMIT, n.logKeywords.bind(n))
                    }
                }, dynamic: function(e) {
                    (new l({trigger: e.keywordElm, searchbarElm: e.getContainer(), searchTypeFieldElm: e.getElement(p), autoSuggestionCateId: e.get("autoSuggestionCateId"), parentNode: e.keywordElm.parent(), url: e.get("autoSuggestionUrl") || null}, e)).render().on("itemSelect", function(t) {
                        t.catId && e.getElement(d).val(t.catId)
                    })
                }, advanced: function(e) {
                    (new o({}, e)).render()
                }}}, run: function() {
            return this.cem = s.domain(this.get("containerId").selector), this.element = this.getContainer(), this.formElm = this.getElement("form"), this.keywordElm = this.getElement(".ui-searchbar-keyword"), this.formElm.length === 0 && this.disable(), this.get("categoryId") && this.getElement(d).val(this.get("categoryId")), v.superclass.run.call(this), this
        }, _mergeAttrs: function() {
            var e = this.get("aisnServer"), t = e.length;
            "/" === e[t - 1] && this.set("aisnServer", e.substr(0, t - 1))
        }, runData: function() {
            var e = this;
            e.searchbarData = (new i).run({currentType: e.get("currentType"), data: e.get("data"), aisnServer: e.get("aisnServer")})
        }, runForm: function() {
            var e = this;
            e.form = (new u).run({keywordElm: e.keywordElm, typeElm: e.getElement(p), formElm: e.formElm, searbarElm: e.element, placeholder: this.get("placeholder"), keyword: this.get("currentKeyword"), category: this.get("currentCategory"), validateItems: this.get("validateItems")}, e.searchbarData, e.cem)
        }, runStat: function() {
            (new c).run({}, this.searchbarData, this.cem)
        }, enable: function() {
            this.get("headerElm") && this.get("headerElm").addClass("ui-header-mod-searchbar"), this.element.show(), this._mergeAttrs(), this.runData(), this.runForm(), this.runStat(), v.superclass.enable.call(this)
        }, getOperation: function() {
            var e = this.form;
            return e ? {addField: e.addField.bind(e), removeField: e.removeField.bind(e), setFormAction: e.setFormAction.bind(e), setPlaceholder: e.setPlaceholderValue.bind(e), setKeywordFieldName: e.setKeywordFieldName.bind(e), setValidateItems: e.setValidateItems.bind(e), cem: this.cem} : {}
        }});
    return v
});
define("js/6v/biz/common/searchbar/searchbar-v4-sc.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/header-module-base.js?t=40a811fd_4cec66192", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b", "js/6v/lib/icbu/gdata/gdata.js?t=66132cea_d3949ad8", "js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a"], function(require, e, t) {
    t.exports = require("js/6v/biz/common/searchbar/_dev/src/searchbar-v4-sc.js?t=6de4122c_191ede5075")
});