!(function(i) {
    i.Logger = function() {
    };
    i.Logger.level = 4;
    i.Logger.setLevel = function(a) {
        i.Logger.level = a
    };
    var h = false;
    var g = ["error", "warn", "info", "debug", "log"];
    var f = {};
    i.extend(i.Logger.prototype, {level: i.Logger.level, setEnableLevel: function(a) {
            if (a > 4 || a < 0) {
                this.error(["wrong level setting. level should be 0-4, the int type,you set ", a, ", so stupided."].join(""))
            }
            this.level = parseInt(a)
        }, setErrorUri: function(a) {
            i.Logger.errorUri = a
        }, enabled: function(a) {
            if (a > i.Logger.level) {
                return false
            }
            return true
        }, name: function() {
            return this._name
        }, log: function() {
            this._log(4, arguments)
        }, debug: function() {
            this._log(3, arguments)
        }, info: function() {
            this._log(2, arguments)
        }, warn: function() {
            this._log(1, arguments)
        }, error: function() {
            this._log(0, arguments)
        }, _handler: function(q, p, c, e) {
            var r = g[q];
            var b = [[r + "|"].join(" | ")].concat(c);
            if (self.console && !f.msie) {
                if (console.log.apply) {
                    console[r].apply(console, b)
                } else {
                    console[console[r] ? r : "log"](b)
                }
            } else {
                if (f.msie) {
                    if (/debug=true/i.test(location.search)) {
                        !h && this._prepare();
                        var o = i("#DEBUG ol");
                        var a;
                        switch (r) {
                            case"log":
                                a = "#FFFFFF";
                                break;
                            case"debug":
                                a = "#C0C0C0";
                                break;
                            case"info":
                                a = "#EBF5FF";
                                break;
                            case"warn":
                                a = "#FFFFC8";
                                break;
                            case"error":
                                a = "#FE6947";
                                break;
                            default:
                                a = "#FFFFFF";
                                break
                        }
                        i('<li style="background-color:' + a + ';">').text("" + b).appendTo(o)
                    }
                }
            }
            if (!DEBUG_MOD && i.Logger.errorUri) {
                if (q == 0 || q == 1) {
                    var s = "";
                    if (e) {
                        s = "&module=" + e;
                        b = c
                    }
                    (new Image()).src = i.Logger.errorUri + this._getBrowserInfo() + this._getErrorUrl() + "&level=3&msg=" + encodeURIComponent(b) + s
                }
            }
        }, _log: function(a, b) {
            if (this.enabled(a)) {
                var e = b[0];
                var c = b[1];
                this._handler(a, this.name(), e, c)
            }
        }, parseBrowser: function() {
            var a = navigator.userAgent.toLowerCase();
            f = i.browser ? i.browser : {version: (a.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, "0"])[1], safari: /webkit/.test(a), opera: /opera/.test(a), msie: /msie/.test(a) && !/opera/.test(a), mozilla: /mozilla/.test(a) && !/(compatible|webkit)/.test(a)}
        }, _getBrowserInfo: function() {
            var b = "&browser=";
            var a = "";
            i.each(f, function(e, c) {
                if (e != "version") {
                    a = a + e + " "
                } else {
                    a = a + c
                }
            });
            return b + encodeURIComponent(a)
        }, _getErrorUrl: function() {
            var b = "&erroruri=";
            var a = window.location.href;
            return b + encodeURIComponent(a)
        }, _prepare: function() {
            i("#DEBUG").remove();
            i(document.body).append('<div id="DEBUG" style="margin-top:10px;padding:8px;border:dashed 1px #FF7300;background-color:#EEE;color:#000;"><ol></ol></div>');
            h = true
        }, end: 0});
    var j = {};
    i.getLogger = function(a) {
        if (!j[a]) {
            j[a] = new i.Logger(a);
            j[a]._name = a
        }
        return j[a]
    };
    i.logger = i.getLogger("jEngine");
    if (DEBUG_MOD) {
        i.logger.setEnableLevel(4)
    } else {
        i.logger.setEnableLevel(2)
    }
    i.logger.parseBrowser()
})(jQuery);
!(function(e) {
    function c(f, a, b) {
        return this.init(f, a, b)
    }
    e.extend(c.prototype, {init: function(f, a, b) {
            this.core = f;
            this.moduleId = a;
            this.options = b != null ? b : {}
        }});
    jEngine.Core.Sandbox = c
})(jQuery);
!(function(e) {
    function c(a) {
        this.channels = {};
        this.dataTable = {};
        if (a) {
            this.installTo(a)
        }
    }
    e.extend(c.prototype, {on: function(n, m, q) {
            if (!n) {
                return
            }
            var r, a, b, o, i, p;
            if (q == null) {
                q = this
            }
            if (this.channels[n] == null) {
                this.channels[n] = []
            }
            b = this;
            if (n instanceof Array) {
                p = [];
                for (o = 0, i = n.length; o < i; o++) {
                    r = n[o];
                    p.push(this.on(r, m, q))
                }
                return p
            } else {
                a = {context: q, callback: m};
                return{attach: function() {
                        b.channels[n].push(a);
                        return this
                    }, detach: function() {
                        c._rm(b, n, a.callback);
                        return this
                    }}.attach()
            }
        }, off: function(b, f) {
            var a;
            switch (typeof b) {
                case"string":
                    if (typeof f === "function") {
                        c._rm(this, b, f)
                    }
                    if (typeof f === "undefined") {
                        c._rm(this, b)
                    }
                    break;
                case"function":
                    for (a in this.channels) {
                        c._rm(this, a, b)
                    }
                    break;
                case"undefined":
                    for (a in this.channels) {
                        c._rm(this, a)
                    }
                    break;
                case"object":
                    for (a in this.channels) {
                        c._rm(this, a, null, b)
                    }
            }
            return this
        }, notify: function(o, q, b) {
            var t, s, a, i, p, k, r;
            if (this.channels[o] != null) {
                r = this.channels[o];
                for (p = 0, k = r.length; p < k; p++) {
                    a = r[p];
                    if (b !== true && typeof q === "object") {
                        if (q instanceof Array) {
                            t = (function() {
                                var h, g, f;
                                f = [];
                                for (h = 0, g = q.length; h < g; h++) {
                                    i = q[h];
                                    f.push(i)
                                }
                                return f
                            })()
                        } else {
                            t = {};
                            for (s in q) {
                                i = q[s];
                                t[s] = i
                            }
                        }
                        a.callback.apply(a.context, [t, o])
                    } else {
                        a.callback.apply(a.context, [q, o])
                    }
                }
            }
            return this
        }, get: function(b) {
            var a = null;
            if (typeof (b) === "string") {
                a = this.dataTable[b]
            }
            return a
        }, set: function(b, a) {
            if (typeof (b) === "string") {
                this.dataTable[b] = a
            }
        }, installTo: function(a) {
            if (typeof a === "object") {
                a.on = this.on;
                a.off = this.off;
                a.notify = this.notify;
                a.get = this.get;
                a.set = this.set;
                a.dataTable = this.dataTable;
                a.channels = this.channels
            }
            return this
        }});
    c._rm = function(a, b, i, j) {
        var h;
        return a.channels[b] = (function() {
            var g, m, f, n;
            f = a.channels[b];
            n = [];
            for (g = 0, m = f.length; g < m; g++) {
                h = f[g];
                if ((i != null ? h.callback !== i : j != null ? h.context !== j : h.context !== a)) {
                    n.push(h)
                }
            }
            return n
        })()
    };
    jEngine.Core.Mediator = c
})(jQuery);
!(function(m) {
    var l, k = {threshold: 250, end: 0};
    var q = false;
    var n = m(window);
    var p = 0;
    var r = [];
    var j = {};
    function o(a) {
        l = a;
        l.on("jEngine.lazyLoad", function(b) {
            o._handleManualEvent(b)
        });
        return o
    }
    m.extend(o, {register: function(f, t, c, a) {
            var g = m.extend(true, {}, k, c);
            if (f) {
                var i = m(f);
                if (!i || i.length == 0 || !t) {
                    return false
                }
                var u = this;
                if (t === "exposure") {
                    this._handleExposureEvent(i, g, a)
                } else {
                    var h = null;
                    var e = function(s) {
                        var v = this;
                        h = setTimeout(function() {
                            u._getModule(v, g, a, t);
                            i.unbind(t, e);
                            if (t == "mouseover") {
                                i.unbind("mouseout", b)
                            }
                        }, 50)
                    };
                    i.bind(t, e);
                    var b = function() {
                        clearTimeout(h)
                    };
                    if (t == "mouseover") {
                        i.bind("mouseout", b)
                    }
                }
            } else {
                if (t === "manual") {
                    j[g.key] = [g, a]
                }
            }
            return true
        }, _handleExposureEvent: function(b, e, a) {
            var c = this._pushToArray(b, e, a);
            this._uniqueMerge(r, c);
            if (!q) {
                p = this._getViewportHeight();
                this._bindExposureEvent()
            }
            this._loadModules()
        }, _handleManualEvent: function(a) {
            if (a.moduleId) {
                var b = j[a.moduleId];
                if (b) {
                    this._getModule(null, b[0], b[1]);
                    delete j[a.moduleId]
                }
            }
        }, _pushToArray: function(a, c, f) {
            var e = [];
            if (!a.length) {
                return e
            }
            for (var b = 0; b < a.length; b++) {
                e.push([a[b], c, f])
            }
            return e
        }, _uniqueMerge: function(e, b) {
            for (var f = 0; f < b.length; f++) {
                for (var a = 0, c = e.length; a < c; a++) {
                    if (b[f] === e[a]) {
                        b.splice(f, 1);
                        break
                    }
                }
            }
            m.merge(e, b)
        }, _bindExposureEvent: function() {
            if (q) {
                return
            }
            var a = this;
            n.bind("scroll.lazymodule", function(b) {
                a._exposureCall(a._loadModules, a)
            });
            n.bind("resize.lazymodule", function(b) {
                p = a._getViewportHeight();
                a._exposureCall(a._loadModules, a)
            });
            q = true
        }, _removeEvent: function() {
            if (!q) {
                return
            }
            n.unbind("scroll.lazymodule");
            n.unbind("resize.lazymodule");
            q = false
        }, _exposureCall: function(a, b) {
            clearTimeout(a.tId);
            a.tId = setTimeout(function() {
                a.call(b)
            }, 100)
        }, _loadModules: function() {
            this._filter(r, this._runCallback, this);
            if (r.length === 0) {
                this._removeEvent()
            }
        }, _filter: function(e, f, a) {
            var h;
            for (var b = 0; b < e.length; ) {
                h = e[b];
                if (m.isArray(h) && this._checkPosition(h)) {
                    e.splice(b, 1);
                    f.call(a, h);
                    if (!h[1].keep) {
                        var i = h[1].key;
                        for (var c = 0; c < e.length; ) {
                            var g = e[c];
                            if (i === g[1].key) {
                                e.splice(c, 1)
                            } else {
                                c++
                            }
                        }
                    }
                } else {
                    b++
                }
            }
        }, _runCallback: function(e) {
            var a, b, c;
            a = e[0];
            c = e[1];
            b = e[2];
            this._getModule(a, c, b)
        }, _getModule: function(h, e, a, f) {
            var c = this;
            var b = e.module;
            if (b) {
                var g = b.moduleId;
                m.add(g, {js: b.js, css: b.css});
                if (a) {
                    m.use(g, function() {
                        a(h);
                        if (f) {
                            c._dispatchEvent(h, f)
                        }
                    })
                } else {
                    m.use(g)
                }
            } else {
                if (a) {
                    a(h)
                }
            }
        }, _getViewportHeight: function() {
            return n.height()
        }, _checkPosition: function(a) {
            var c = false;
            var e = a[1].threshold ? a[1].threshold : k.threshold;
            var f = m(document).scrollTop();
            var g = f + p + e;
            var b = (m(a).css("display") !== "none") ? m(a).offset().top : Number.POSITIVE_INFINITY;
            if (b <= g) {
                c = true
            }
            return c
        }, _dispatchEvent: function(a, e) {
            try {
                if (document.createEvent) {
                    var c = document.createEvent("MouseEvents");
                    c.initEvent(e, true, false);
                    a.dispatchEvent(c)
                } else {
                    if (document.createEventObject) {
                        a.fireEvent("on" + e)
                    }
                }
                return true
            } catch (b) {
                return false
            }
        }, end: 0});
    jEngine.Core.LazyModule = o
})(jQuery);
!(function(f) {
    var e = {dataField: "data-mod-config", docField: "data-doc-config", combineField: "combine-mod-config", scriptField: "script-mod-config", AllReadyEvent: "jEngine.ready", end: 0};
    function g(a) {
        this.init(a)
    }
    f.extend(g.prototype, {init: function(a) {
            this.config = f.extend(true, {}, e, a);
            this.moduleData = {};
            this.mediator = new jEngine.Core.Mediator();
            this.lazyModule = new jEngine.Core.LazyModule(this.mediator)
        }, register: function(a, b, c) {
            if (c == null) {
                c = {}
            }
            try {
                if (!this._addModule(a, b, c)) {
                    return false
                }
                if (c.init) {
                    return this.start(a)
                }
                return true
            } catch (h) {
                if (!DEBUG_MOD) {
                    f.logger.error("could not register " + a + " because: " + h.message, a)
                } else {
                    throw h
                }
                return false
            }
        }, lazyRegister: function(q, o, m, r, p) {
            if (p == null) {
                p = {}
            }
            try {
                var p = this._getModuleCombine(q, p);
                var c = false;
                if (p.init === false) {
                    c = this.lazyModule.register(m, r, p)
                } else {
                    var a = this;
                    var n = null;
                    if (p.callback) {
                        if (o) {
                            n = function() {
                                if (a._lazyStart(q, o)) {
                                    p.callback()
                                }
                            }
                        } else {
                            n = p.callback
                        }
                    } else {
                        n = function() {
                            a._lazyStart(q, o)
                        }
                    }
                    c = this.lazyModule.register(m, r, p, n)
                }
                return c
            } catch (b) {
                if (!DEBUG_MOD) {
                    f.logger.error("could not lazyregister " + q + " because: " + b.message, q)
                } else {
                    throw b
                }
                return false
            }
        }, unregister: function(a) {
            if (this.moduleData[a] != null) {
                delete this.moduleData[a];
                return true
            } else {
                return false
            }
        }, start: function(b) {
            try {
                if (this.moduleData[b] == null) {
                    throw new Error("module " + b + " does not exist")
                }
                var a = f.now();
                var c = this.moduleData[b].options;
                if (c == null) {
                    c = {}
                }
                var j = this._createInstance(b, c);
                if (j.running === true) {
                    return
                }
                if (typeof j.init !== "function") {
                    throw new Error("module " + b + " do not have an init function")
                }
                j.init(j.options);
                j.running = true;
                this.moduleData[b].instance = j;
                if (typeof c.callback === "function") {
                    c.callback()
                }
                f.logger.info(b + " init finished, cost:" + +(f.now() - a) + " ms", b);
                return true
            } catch (i) {
                if (!DEBUG_MOD) {
                    f.logger.error(b + " init Error: " + i.message, b)
                } else {
                    throw i
                }
                return false
            }
        }, startAll: function() {
            var a, b;
            b = [];
            for (a in this.moduleData) {
                if (this.moduleData.hasOwnProperty(a)) {
                    b.push(this.start(a))
                }
            }
            this.mediator.notify(this.config.AllReadyEvent);
            return b
        }, stop: function(a) {
            var b = this.moduleData[a];
            if (b.instance) {
                if (f.isFunction(b.instance.destroy)) {
                    b.instance.destroy()
                }
                b.instance.running = false;
                b.instance = null;
                return true
            } else {
                return false
            }
        }, stopAll: function() {
            var a, b;
            b = [];
            for (a in this.moduleData) {
                if (this.moduleData.hasOwnProperty(a)) {
                    b.push(this.stop(a))
                }
            }
            return b
        }, restart: function(a) {
            if (this.stop(a)) {
                return this.start(a)
            }
            return false
        }, _addModule: function(a, b, c) {
            if (typeof a !== "string") {
                throw new Error("moudule ID has to be a string")
            }
            var h = b;
            if (typeof b === "string") {
                b = this._parseFunction(b)
            }
            if (typeof b !== "function") {
                if (c.ignore) {
                    return false
                } else {
                    throw new Error("creator " + h + " has to be a constructor function")
                }
            }
            if (typeof c !== "object") {
                throw new Error("option parameter has to be an object")
            }
            if (this.moduleData[a] != null) {
                throw new Error("module was already registered")
            }
            this.moduleData[a] = {creator: b, options: c};
            return true
        }, _createInstance: function(c, k) {
            var l = this.moduleData[c];
            if (l.instance != null) {
                return l.instance
            }
            var a = new jEngine.Core.Sandbox(jEngine.Core.AppEntity, c, k);
            this.mediator.installTo(a);
            var k = this._getModuleConfig(c, k, a);
            var n = new l.creator(a), m, b;
            n.options = k;
            if (!DEBUG_MOD) {
                for (m in n) {
                    b = n[m];
                    if (typeof b == "function") {
                        n[m] = function(i, h) {
                            return function() {
                                try {
                                    return h.apply(this, arguments)
                                } catch (j) {
                                    f.logger.error(c + " throw error: " + i + "()-> " + j.message, c)
                                }
                            }
                        }(m, b)
                    }
                }
            }
            return n
        }, _lazyStart: function(a, b) {
            if (this.moduleData[a] == null) {
                if (this.register(a, b, {ignore: true})) {
                    return this.start(a)
                }
            }
            return false
        }, _getModuleConfig: function(w, v, b) {
            var t = "#" + w;
            var s = f(t);
            if (s.length > 0) {
                var q = s.attr(this.config.dataField);
                if (q && q.trim()) {
                    v.data = f.parseJSON(q)
                }
                var u = s.attr(this.config.scriptField);
                if (u && u.trim()) {
                    var r = f.parseJSON(u);
                    var c = f("#" + r.script);
                    if (c.length > 0) {
                        if (r.replace) {
                            s.replaceWith(c.html())
                        } else {
                            s.html(c.html())
                        }
                    }
                }
                v.id = w;
                v.dom = s
            }
            if (!this.docDetect) {
                try {
                    var a = f("#doc");
                    if (a.length > 0) {
                        var q = a.attr(this.config.docField);
                        if (q && q.trim()) {
                            q = q.replace(/\\'/g, "'");
                            v.global = f.parseJSON(q);
                            b.set(this.config.docField, v.global)
                        }
                    }
                } catch (p) {
                }
                this.docDetect = true
            } else {
                v.global = b.get(this.config.docField)
            }
            return v
        }, _getModuleCombine: function(c, j) {
            if (typeof (j.module) !== "undefined") {
                var b = "#" + c;
                var i = f(b);
                if (i.length > 0) {
                    var a = i.attr(this.config.combineField);
                    if (a && a.trim()) {
                        j.module = j.module[a]
                    }
                }
                j.module.moduleId = c
            }
            j.key = c;
            return j
        }, _parseFunction: function(b) {
            var i = b.split("."), j = i.length, a = window;
            for (var c = (f.isWindow(i[0]) ? 1 : 0); c < j; c++) {
                if (f.isFunction(a[i[c]]) || f.isPlainObject(a[i[c]])) {
                    a = a[i[c]]
                } else {
                    return null
                }
            }
            if (f.isFunction(a)) {
                return a
            }
            return null
        }, end: 0});
    AppCore = jEngine.Core.AppEntity = new g()
})(jQuery);
(("ui" in jQuery) && ("_defined" in jQuery.ui)) || (function(g, i) {
    g.extend(g.ui, {_defined: true, keyCode: {DOWN: 40, ENTER: 13, ESCAPE: 27, LEFT: 37, NUMPAD_ENTER: 108, RIGHT: 39, SHIFT: 16, TAB: 9, UP: 38}});
    function h(a) {
        return a && a.constructor === Number ? a + "px" : a
    }
    g.fn.extend({_focus: g.fn.focus, focus: function(b, a) {
            return typeof b === "number" ? this.each(function() {
                var c = this;
                setTimeout(function() {
                    g(c).focus();
                    if (a) {
                        a.call(c)
                    }
                }, b)
            }) : this._focus.apply(this, arguments)
        }, scrollParent: function() {
            var a;
            if ((g.browser.msie && (/(static|relative)/).test(this.css("position"))) || (/absolute/).test(this.css("position"))) {
                a = this.parents().filter(function() {
                    return(/(relative|absolute|fixed)/).test(g.curCSS(this, "position", 1)) && (/(auto|scroll)/).test(g.curCSS(this, "overflow", 1) + g.curCSS(this, "overflow-y", 1) + g.curCSS(this, "overflow-x", 1))
                }).eq(0)
            } else {
                a = this.parents().filter(function() {
                    return(/(auto|scroll)/).test(g.curCSS(this, "overflow", 1) + g.curCSS(this, "overflow-y", 1) + g.curCSS(this, "overflow-x", 1))
                }).eq(0)
            }
            return(/fixed/).test(this.css("position")) || !a.length ? g(document) : a
        }, zIndex: function(a) {
            if (a !== i) {
                return this.css("zIndex", a)
            }
            if (this.length) {
                var c = g(this[0]), e, b;
                while (c.length && c[0] !== document) {
                    e = c.css("position");
                    if (e === "absolute" || e === "relative" || e === "fixed") {
                        b = parseInt(c.css("zIndex"), 10);
                        if (!isNaN(b) && b !== 0) {
                            return b
                        }
                    }
                    c = c.parent()
                }
            }
            return 0
        }, disableSelection: function() {
            return this.bind((g.support.selectstart ? "selectstart" : "mousedown") + ".ui-disableSelection", function(a) {
                a.preventDefault()
            })
        }, enableSelection: function() {
            return this.unbind(".ui-disableSelection")
        }, bgiframe: function(b) {
            if (g.util.ua.ie6) {
                if (b === "close") {
                    return this.each(function() {
                        g(this).children("iframe.bgiframe").remove()
                    })
                } else {
                    b = g.extend({top: "auto", left: "auto", width: "auto", height: "auto", zIndex: -1, opacity: 0, src: "about:blank"}, b);
                    var a = ['<iframe class="bgiframe"frameborder="0"tabindex="-1"src="', b.src, '"style="display:block;position:absolute;z-index:', b.zIndex, ";", b.opacity ? "" : "filter:Alpha(Opacity='0');", "top:", (b.top == "auto" ? "expression(((parseInt(this.parentNode.currentStyle.borderTopWidth)||0)*-1)+'px')" : h(b.top)), ";left:", (b.left == "auto" ? "expression(((parseInt(this.parentNode.currentStyle.borderLeftWidth)||0)*-1)+'px')" : h(b.left)), ";width:", (b.width == "auto" ? "expression(this.parentNode.offsetWidth+'px')" : h(b.width)), ";height:", (b.height == "auto" ? "expression(this.parentNode.offsetHeight+'px')" : h(b.height)), ';"/>'].join("");
                    return this.each(function() {
                        var c = g(this);
                        if (c.children("iframe.bgiframe").length === 0) {
                            this.insertBefore(document.createElement(a), this.firstChild)
                        }
                    })
                }
            } else {
                if (b === "close") {
                    return this.each(function() {
                        g(this).children("div.bgiframe").remove()
                    })
                } else {
                    b = g.extend({position: "fixed", top: 0, left: 0, width: "100%", height: "100%", zIndex: -1, backgroundColor: "#FFF", opacity: 0}, b);
                    if (b.force) {
                        return this.each(function() {
                            var c = g(this);
                            if (c.children("div.bgiframe").length === 0) {
                                c.prepend(g("<div>", {"class": "bgiframe", css: b}))
                            }
                        })
                    }
                }
                return this
            }
        }});
    function j(e, m) {
        var a = e.nodeName.toLowerCase();
        if ("area" === a) {
            var b = e.parentNode, c = b.name, l;
            if (!e.href || !c || b.nodeName.toLowerCase() !== "map") {
                return false
            }
            l = g("img[usemap=#" + c + "]")[0];
            return !!l && f(l)
        }
        return(/input|select|textarea|button|object/.test(a) ? !e.disabled : "a" == a ? e.href || m : m) && f(e)
    }
    function f(a) {
        return !g(a).parents().andSelf().filter(function() {
            return g.curCSS(this, "visibility") === "hidden" || g.expr.filters.hidden(this)
        }).length
    }
    g.extend(g.expr[":"], {data: function(a, b, c) {
            return !!g.data(a, c[3])
        }, focusable: function(a) {
            return j(a, !isNaN(g.attr(a, "tabindex")))
        }, tabbable: function(a) {
            var c = g.attr(a, "tabindex"), b = isNaN(c);
            return(b || c >= 0) && j(a, !b)
        }});
    g(function() {
        var b = document.body, a = b.appendChild(a = document.createElement("div"));
        g.extend(a.style, {minHeight: "100px", height: "auto", padding: 0, borderWidth: 0});
        g.support.minHeight = a.offsetHeight === 100;
        g.support.selectstart = "onselectstart" in a;
        b.removeChild(a).style.display = "none"
    });
    g.extend(g.ui, {plugin: {add: function(e, c, a) {
                var b = g.ui[e].prototype;
                for (var l in a) {
                    b.plugins[l] = b.plugins[l] || [];
                    b.plugins[l].push([c, a[l]])
                }
            }, call: function(l, c, e) {
                var a = l.plugins[c];
                if (!a || !l.element[0].parentNode) {
                    return
                }
                for (var b = 0; b < a.length; b++) {
                    if (l.options[a[b][0]]) {
                        a[b][1].apply(l.element, e)
                    }
                }
            }}, isOverAxis: function(b, c, a) {
            return(b > c) && (b < (c + a))
        }, isOver: function(a, l, b, c, m, e) {
            return g.ui.isOverAxis(a, b, m) && g.ui.isOverAxis(l, c, e)
        }});
    g.add("ui-core")
})(jQuery);
("widget" in jQuery) || (function(f, g) {
    var h = Array.prototype.slice;
    var e = f.cleanData;
    f.cleanData = function(c) {
        for (var b = 0, a; (a = c[b]) != null; b++) {
            f(a).triggerHandler("remove")
        }
        e(c)
    };
    f.widget = function(l, c, m) {
        var k = l.split(".")[0], a;
        l = l.split(".")[1];
        a = k + "-" + l;
        if (!m) {
            m = c;
            c = f.Widget
        }
        f.expr[":"][a] = function(i) {
            return !!f.data(i, l)
        };
        f[k] = f[k] || {};
        f[k][l] = function(j, i) {
            if (arguments.length) {
                this._createWidget(j, i)
            }
        };
        var b = new c();
        b.options = f.extend(true, {}, b.options);
        f[k][l].prototype = f.extend(true, b, {namespace: k, widgetName: l, widgetEventPrefix: f[k][l].prototype.widgetEventPrefix || l, widgetBaseClass: a}, m);
        f.widget.bridge(l, f[k][l])
    };
    f.widget.bridge = function(a, b) {
        f.fn[a] = function(k) {
            var m = typeof k === "string", l = Array.prototype.slice.call(arguments, 1), c = this;
            k = !m && l.length ? f.extend.apply(null, [true, k].concat(l)) : k;
            if (m && k.charAt(0) === "_") {
                return c
            }
            if (m) {
                this.each(function() {
                    var j = f.data(this, a), i = j && f.isFunction(j[k]) ? j[k].apply(j, l) : j;
                    if (i !== j && i !== g) {
                        c = i;
                        return false
                    }
                })
            } else {
                this.each(function() {
                    var i = f.data(this, a);
                    if (i) {
                        i.option(k || {})._init()
                    } else {
                        f.data(this, a, new b(k, this))
                    }
                })
            }
            return c
        }
    };
    f.Widget = function(b, a) {
        if (arguments.length) {
            this._createWidget(b, a)
        }
    };
    f.Widget.prototype = {widgetName: "widget", widgetEventPrefix: "", options: {disabled: false}, _createWidget: function(b, a) {
            f.data(a, this.widgetName, this);
            this.element = f(a);
            this.options = f.extend(true, {}, this.options, this._getCreateOptions(), b);
            var c = this;
            this.element.bind("remove." + this.widgetName, function() {
                c.destroy()
            });
            if (this.options.classPrefix) {
                this.widgetBaseClass = this.options.classPrefix + "-" + this.widgetName
            }
            this._create();
            this._trigger("create");
            this._init()
        }, _getCreateOptions: function() {
            return f.metadata && f.metadata.get(this.element[0])[this.widgetName]
        }, _create: f.noop, _init: f.noop, destroy: function() {
            this._destroy();
            this.element.unbind("." + this.widgetName).removeData(this.widgetName);
            this.widget().unbind("." + this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass + "-disabled ui-state-disabled")
        }, _destroy: f.noop, widget: function() {
            return this.element
        }, option: function(b, a) {
            var c = b;
            if (arguments.length === 0) {
                return f.extend({}, this.options)
            }
            if (typeof b === "string") {
                if (a === g) {
                    return this.options[b]
                }
                c = {};
                c[b] = a
            }
            this._setOptions(c);
            return this
        }, _setOptions: function(a) {
            var b = this;
            f.each(a, function(i, c) {
                b._setOption(i, c)
            });
            return this
        }, _setOption: function(b, a) {
            this.options[b] = a;
            if (b === "disabled") {
                this.widget()[a ? "addClass" : "removeClass"](this.widgetBaseClass + "-disabled ui-state-disabled").attr("aria-disabled", a)
            }
            return this
        }, enable: function() {
            return this._setOption("disabled", false)
        }, disable: function() {
            return this._setOption("disabled", true)
        }, _trigger: function(l, i, c) {
            var a = this.options[l];
            i = f.Event(i);
            i.type = (l === this.widgetEventPrefix ? l : this.widgetEventPrefix + l).toLowerCase();
            c = c || {};
            if (i.originalEvent) {
                for (var m = f.event.props.length, b; m; ) {
                    b = f.event.props[--m];
                    i[b] = i.originalEvent[b]
                }
            }
            this.element.trigger(i, c);
            return !(f.isFunction(a) && a.call(this.element[0], i, c) === false || i.isDefaultPrevented())
        }};
    f.add("ui-core")
})(jQuery);
("flash" in jQuery.fn) || (function(w, x, r) {
    var y = "object", e = "function", A = w.util.ua.ie, v, C, z = {};
    function s(a, b) {
        var c = (a[0] || 0) - (b[0] || 0);
        return c > 0 || (!c && a.length > 0 && s(a.slice(1), b.slice(1)))
    }
    function B(a) {
        if (typeof a !== y) {
            return a
        }
        var f = [], b = "";
        for (var c in a) {
            if (typeof a[c] === y) {
                b = B(a[c])
            } else {
                b = [c, (v) ? encodeURI(a[c]) : a[c]].join("=")
            }
            f.push(b)
        }
        return f.join("&")
    }
    function q(a) {
        var c = [];
        for (var b in a) {
            if (a[b]) {
                c.push([b, '="', a[b], '"'].join(""))
            }
        }
        return c.join(" ")
    }
    function t(a) {
        var c = [];
        for (var b in a) {
            c.push(['<param name="', b, '" value="', B(a[b]), '" />'].join(""))
        }
        return c.join("")
    }
    try {
        C = r.description || (function() {
            return(new r("ShockwaveFlash.ShockwaveFlash")).GetVariable("$version")
        }())
    } catch (u) {
        C = "Unavailable"
    }
    var D = C.match(/\d+/g) || [0];
    x.flash = {available: D[0] > 0, activeX: r && !r.name, version: {original: C, array: D, string: D.join("."), major: parseInt(D[0], 10) || 0, minor: parseInt(D[1], 10) || 0, release: parseInt(D[2], 10) || 0}, hasVersion: function(b) {
            var a = (/string|number/.test(typeof b)) ? b.toString().split(".") : (/object/.test(typeof b)) ? [b.major, b.minor] : b || [0, 0];
            return s(D, a)
        }, encodeParams: true, expressInstall: "expressInstall.swf", expressInstallIsActive: false, _create: function(g, c) {
            var f = this;
            if (!c.swf || f.expressInstallIsActive || (!f.available && !c.hasVersionFail)) {
                return false
            }
            if (!f.hasVersion(c.hasVersion || 1)) {
                f.expressInstallIsActive = true;
                if (typeof c.hasVersionFail === e) {
                    if (!c.hasVersionFail.apply(c)) {
                        return false
                    }
                }
                c = {swf: c.expressInstall || f.expressInstall, height: 137, width: 214, flashvars: {MMredirectURL: location.href, MMplayerType: (f.activeX) ? "ActiveX" : "PlugIn", MMdoctitle: document.title.slice(0, 47) + " - Flash Player Installation"}}
            }
            attrs = {id: "ui-flash-object" + w.guid++, width: c.width || 320, height: c.height || 180, style: c.style || ""};
            if (A) {
                attrs.classid = "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000";
                c.movie = c.swf
            } else {
                attrs.data = c.swf;
                attrs.type = "application/x-shockwave-flash"
            }
            v = typeof c.useEncode !== "undefined" ? c.useEncode : f.encodeParams;
            c.wmode = c.wmode || "opaque";
            delete c.hasVersion;
            delete c.hasVersionFail;
            delete c.height;
            delete c.swf;
            delete c.useEncode;
            delete c.width;
            var b = ["<object ", q(attrs), ">", t(c), "</object>"].join("");
            if (A) {
                var a = document.createElement("div");
                g.html(a);
                a.outerHTML = b
            } else {
                g.html(b)
            }
            return g.children().get(0)
        }, regist: function(c, a) {
            var b = z[c];
            if (!b) {
                z[c] = a;
                return true
            }
            return false
        }, triggerHandler: function(a) {
            w("#" + a.swfid).triggerHandler(a.type, a)
        }};
    w.widget("ui.flash", {options: {module: false}, _create: function() {
            var g = this, c = g.element, a = g.options, b, f = true;
            if (!c[0].id) {
                g._generateId()
            }
            if (a.module && z.hasOwnProperty(a.module)) {
                f = z[a.module].call(g)
            }
            c.addClass("ui-flash");
            if (f) {
                g.obj = x.flash._create(c, g._getFlashConfigs());
                if (!g.obj) {
                    g.destroy()
                }
            }
        }, _destroy: function() {
            var b = this, a = b.element;
            if (b.isGenerateId) {
                a.removeAttr("id");
                delete b.isGenerateId
            }
            delete b.obj;
            a.unbind(".flash").removeClass("ui-flash").empty()
        }, _generateId: function() {
            this.isGenerateId = true;
            this.element[0].id = "ui-flash" + w.guid
        }, getFlash: function() {
            return this.obj
        }, callMethod: function() {
            function c(h) {
                return encodeURIComponent(h)
            }
            var f = w.makeArray(arguments), a = f.shift(), b = this.obj;
            w.each(f, function(h, i) {
                f[h] = c(i)
            });
            var g = b[a].apply(b, f);
            return decodeURIComponent(g)
        }, _getFlashConfigs: function() {
            var a = w.extend(true, {}, this.options);
            delete a.disabled;
            delete a.module;
            return a
        }});
    w.add("ui-flash")
}(jQuery, jQuery.util, navigator.plugins["Shockwave Flash"] || window.ActiveXObject));
("alitalk" in FE.util) || (function($, Util) {
    jQuery.add("webww-package", {js: ["http://style.c.aliimg.com/sys/js/webww/package.js"], ver: "1.0"});
    var ie = function getInternetExplorerVersion() {
        var rv = -1;
        if (navigator.appName == "Microsoft Internet Explorer") {
            var ua = navigator.userAgent;
            var re = new RegExp("MSIE ([0-9]{1,}[.0-9]{0,})");
            if (re.exec(ua) != null) {
                rv = parseFloat(RegExp.$1)
            }
        } else {
            if (navigator.appName == "Netscape") {
                var ua = navigator.userAgent;
                var re = new RegExp("Trident/.*rv:([0-9]{1,}[.0-9]{0,})");
                if (re.exec(ua) != null) {
                    rv = parseFloat(RegExp.$1)
                }
            }
        }
        return rv
    }() !== -1, $extendIf = $.extendIf, isMac = function() {
        return(navigator.platform.indexOf("Mac") > -1)
    }, defaults = {cls: {base: "alitalk", on: "alitalk-on", off: "alitalk-off", mb: "alitalk-mb"}, attr: "alitalk", siteID: "cnalichn", remote: true, plugin: false, prop: function() {
            var data = $(this).data("alitalk");
            if (typeof (data) == "undefined" || typeof (data.offerid) == "undefined") {
                return""
            }
            return"&gid=" + data.offerid
        }, fenliu: 1, getAlitalk: function(id, options) {
            var lazyLoad = options.lazyLoad;
            var data = $(this).data("alitalk");
            var offerid = "";
            if (typeof (data) == "undefined") {
                offerid = "undefined"
            } else {
                offerid = data.offerid
            }
            if (lazyLoad) {
                jQuery.use("webww-package", function() {
                    if (!(FE.sys && FE.sys.webww && FE.sys.webww.main && FE.sys.webww.main.chatTo(id))) {
                        $(document).bind("webww_load_complete", function() {
                            FE.sys.webww.main.chatTo(id, true, offerid)
                        })
                    } else {
                        FE.sys.webww.main.chatTo(id, true, offerid)
                    }
                })
            } else {
                if (!(FE.sys && FE.sys.webww && FE.sys.webww.main && FE.sys.webww.main.chatTo(id))) {
                    window.open("http://webww.1688.com/message/my_chat.htm?towimmid=" + id + "&offerid=" + offerid, "_blank")
                }
            }
        }, onRemote: function(data) {
            var element = $(this);
            switch (data.online) {
                case 0:
                case 2:
                case 6:
                default:
                    element.html("\u7ed9\u6211\u7559\u8a00").attr("title", "\u6211\u4e0d\u5728\u7f51\u4e0a\uff0c\u7ed9\u6211\u7559\u4e2a\u6d88\u606f\u5427");
                    break;
                case 1:
                    element.html("\u548c\u6211\u8054\u7cfb").attr("title", "\u6211\u6b63\u5728\u7f51\u4e0a\uff0c\u9a6c\u4e0a\u548c\u6211\u6d3d\u8c08");
                    break;
                case 4:
                case 5:
                    element.html("\u7ed9\u6211\u77ed\u4fe1").attr("title", "\u6211\u624b\u673a\u5728\u7ebf\uff0c\u9a6c\u4e0a\u548c\u6211\u6d3d\u8c08");
                    break
                }
        }}, version = 0, checkInstalled = function() {
        if (ie) {
            var vers = {"aliimx.wangwangx": 6, "Ali_Check.InfoCheck": 5};
            for (var p in vers) {
                try {
                    new ActiveXObject(p);
                    version = vers[p];
                    if (Util.alitalk) {
                        Util.alitalk.isInstalled = true;
                        Util.alitalk.version = version
                    }
                    return
                } catch (e) {
                }
            }
        }
        if (isMac() || $.browser.mozilla || $.browser.webkit) {
            var self = this;
            if (navigator.mimeTypes["application/ww-plugin"]) {
                var plugin = $("<embed>", {type: "application/ww-plugin", css: {visibility: "hidden", overflow: "hidden", display: "block", position: "absolute", top: 0, left: 0, width: 1, height: 1}});
                plugin.appendTo(document.body);
                if (isMac() || (plugin[0].NPWWVersion && numberify(plugin[0].NPWWVersion()) >= 1.003) || (plugin[0].isInstalled && plugin[0].isInstalled(1))) {
                    version = 6;
                    if (Util.alitalk) {
                        Util.alitalk.isInstalled = true;
                        Util.alitalk.version = version
                    }
                }
                self.plugin = plugin
            }
        }
    };
    $(function() {
        checkInstalled()
    });
    function success(obj, elements, options) {
        if (obj.success) {
            var arr = obj.data;
            elements.each(function(i) {
                var element = $(this), data = element.data("alitalk");
                if (data) {
                    data.online = arr[i];
                    element.addClass(data.cls.base);
                    switch (data.online) {
                        case 0:
                        case 2:
                        case 6:
                        default:
                            element.addClass(data.cls.off);
                            break;
                        case 1:
                            element.addClass(data.cls.on);
                            break;
                        case 4:
                        case 5:
                            element.addClass(data.cls.mb);
                            break
                    }
                    if (data.onRemote) {
                        data.onRemote.call(element[0], data)
                    }
                }
            })
        }
        if (options.onSuccess) {
            options.onSuccess()
        }
    }
    function invokeWW(cmd) {
        var flag = 1;
        if (ie) {
            try {
                (new ActiveXObject("aliimx.wangwangx")).ExecCmd(cmd);
                flag = 0
            } catch (e) {
            }
        } else {
            try {
                var mimetype = navigator.mimeTypes["application/ww-plugin"];
                if (mimetype) {
                    var plugin = this.plugin;
                    plugin.appendTo(document.body);
                    plugin[0].SendCommand(cmd, 1);
                    flag = 0
                }
            } catch (e) {
            }
        }
        if (flag == 1) {
            var ifr = $("<iframe>").css("display", "none").attr("src", cmd).appendTo("body");
            setTimeout(function() {
                ifr.remove()
            }, 200)
        }
    }
    function onClickHandler(event) {
        var element = $(this), data, feedback, prop, info_id;
        if (event) {
            event.preventDefault();
            data = element.data("alitalk")
        } else {
            data = this
        }
        if (!data.remote) {
            data.online = 1
        }
        if (data.online === null) {
            return
        }
        prop = data.prop;
        if (typeof prop === "function") {
            prop = prop.call(this);
            var match = prop.match(/info_id=([^#]+)/);
            if (match && match.length === 2) {
                info_id = match[1]
            }
        }
        if (isMac()) {
            feedback = ""
        } else {
            feedback = "&url2=http://dmtracking.1688.com/others/feedbackfromalitalk.html?online=" + data.online + "#info_id=" + (data.info_id || info_id || "") + "#type=" + (data.type || "") + "#module_ver=3#refer=" + encodeURI(document.URL).replace(/&/g, "$")
        }
        var loginid = encodeURIComponent(data.id);
        if (version === 0) {
            checkInstalled()
        }
        switch (version) {
            case 0:
            default:
                data.getAlitalk.call(this, data.id, data);
                break;
            case 5:
                invokeWW("Alitalk:Send" + (data.online === 4 ? "Sms" : "IM") + "?" + data.id + "&siteid=" + data.siteID + "&status=" + data.online + feedback + prop);
                break;
            case 6:
                if (data.online === 4) {
                    invokeWW("aliim:smssendmsg?touid=" + data.siteID + loginid + feedback + prop)
                } else {
                    invokeWW("aliim:sendmsg?touid=" + data.siteID + loginid + "&siteid=" + data.siteID + "&fenliu=" + data.fenliu + "&status=" + data.online + feedback + prop)
                }
                break
        }
        if (data.onClickEnd) {
            data.onClickEnd.call(this, event)
        }
    }
    function login(id) {
        var src;
        var loginid = encodeURIComponent(id);
        if (version === 0) {
            checkInstalled()
        }
        if (version === 5) {
            src = "alitalk:"
        } else {
            src = "aliim:login?uid=" + (loginid || "")
        }
        invokeWW(src)
    }
    function numberify(s) {
        var c = 0;
        return parseFloat(s.replace(/\./g, function() {
            return(c++ === 0) ? "." : ""
        }))
    }
    function alitalk(elements, options) {
        if ($.isPlainObject(elements)) {
            options = elements;
            options.online = options.online || 1;
            $extendIf(options, defaults);
            onClickHandler.call(options)
        } else {
            options = options || {};
            $extendIf(options, defaults);
            elements = $(elements).filter(function() {
                return !$.data(this, options.attr)
            });
            if (elements.length) {
                var ids = [];
                elements.each(function(i, elem) {
                    elem = $(elem);
                    var data = $extendIf(eval("(" + (elem.attr(options.attr) || elem.attr("data-" + options.attr) || "{}") + ")"), options);
                    elem.data("alitalk", data);
                    ids.push(data.siteID + data.id)
                }).bind("click", onClickHandler);
                if (ids.length && options.remote) {
                    $.ajax("http://amos.im.alisoft.com/mullidstatus.aw", {dataType: "jsonp", data: "uids=" + ids.join(";"), success: function(o) {
                            success(o, elements, options)
                        }})
                }
            }
        }
    }
    function tribeChat(elements) {
        if (elements.length) {
            elements.bind("click", onTribeChatClickHandler)
        }
    }
    function onTribeChatClickHandler(event) {
        var element = $(this), data;
        if (event) {
            event.preventDefault();
            data = element.data("alitalk");
            data = eval("(" + data + ")")
        } else {
            data = this
        }
        var uid = "";
        if (data.uid) {
            uid = encodeURIComponent(data.uid)
        }
        if (uid != "" && uid.indexOf("cnalichn") < 0 && uid.indexOf("cntaobao") < 0 && uid.indexOf("enaliint") < 0) {
            uid = "cnalichn" + uid
        }
        if (version === 0) {
            checkInstalled()
        }
        switch (version) {
            case 0:
            default:
                alert("\u5c0a\u656c\u7684\u7528\u6237\uff0c\u60a8\u9700\u8981\u5b89\u88c5\u963f\u91cc\u65fa\u65fa\u540e\u624d\u80fd\u53c2\u4e0e\u7fa4\u804a\u5929\uff0c\u70b9\u51fb\u786e\u8ba4\u540e\u5c06\u8fdb\u5165\u963f\u91cc\u65fa\u65fa\u4e0b\u8f7d\u9875\u9762\u3002");
                window.location.href = "http://wangwang.1688.com";
                break;
            case 5:
            case 6:
                invokeWW("aliim:tribejoin?tribeid=" + (data.tribeid || "") + "&uid=" + uid);
                break
        }
        if (data.onClickEnd) {
            data.onClickEnd.call(this, event)
        }
    }
    Util.alitalk = alitalk;
    Util.alitalk.version = version;
    Util.alitalk.isInstalled = !!version;
    Util.alitalk.login = login;
    Util.alitalk.tribeChat = tribeChat;
    $.add("web-alitalk")
})(jQuery, FE.util);
("position" in jQuery.ui) || (function(k, j) {
    k.ui = k.ui || {};
    var m = /left|center|right/, l = /top|center|bottom/, i = "center", h = k.fn.position, n = k.fn.offset;
    k.fn.position = function(f) {
        if (!f || !f.of) {
            return h.apply(this, arguments)
        }
        f = k.extend({}, f);
        var a = k(f.of), b = a[0], p = (f.collision || "flip").split(" "), q = f.offset ? f.offset.split(" ") : [0, 0], c, g, e;
        if (b.nodeType === 9) {
            c = a.width();
            g = a.height();
            e = {top: 0, left: 0}
        } else {
            if (b.setTimeout) {
                c = a.width();
                g = a.height();
                e = {top: a.scrollTop(), left: a.scrollLeft()}
            } else {
                if (b.preventDefault) {
                    f.at = "left top";
                    c = g = 0;
                    e = {top: f.of.pageY, left: f.of.pageX}
                } else {
                    c = a.outerWidth();
                    g = a.outerHeight();
                    e = a.offset()
                }
            }
        }
        k.each(["my", "at"], function() {
            var o = (f[this] || "").split(" ");
            if (o.length === 1) {
                o = m.test(o[0]) ? o.concat([i]) : l.test(o[0]) ? [i].concat(o) : [i, i]
            }
            o[0] = m.test(o[0]) ? o[0] : i;
            o[1] = l.test(o[1]) ? o[1] : i;
            f[this] = o
        });
        if (p.length === 1) {
            p[1] = p[0]
        }
        q[0] = parseInt(q[0], 10) || 0;
        if (q.length === 1) {
            q[1] = q[0]
        }
        q[1] = parseInt(q[1], 10) || 0;
        if (f.at[0] === "right") {
            e.left += c
        } else {
            if (f.at[0] === i) {
                e.left += c / 2
            }
        }
        if (f.at[1] === "bottom") {
            e.top += g
        } else {
            if (f.at[1] === i) {
                e.top += g / 2
            }
        }
        e.left += q[0];
        e.top += q[1];
        return this.each(function() {
            var F = k(this), D = F.outerWidth(), o = F.outerHeight(), E = parseInt(k.curCSS(this, "marginLeft", true)) || 0, y = parseInt(k.curCSS(this, "marginTop", true)) || 0, B = D + E + (parseInt(k.curCSS(this, "marginRight", true)) || 0), A = o + y + (parseInt(k.curCSS(this, "marginBottom", true)) || 0), C = k.extend({}, e), z;
            if (f.my[0] === "right") {
                C.left -= D
            } else {
                if (f.my[0] === i) {
                    C.left -= D / 2
                }
            }
            if (f.my[1] === "bottom") {
                C.top -= o
            } else {
                if (f.my[1] === i) {
                    C.top -= o / 2
                }
            }
            C.left = Math.round(C.left);
            C.top = Math.round(C.top);
            z = {left: C.left - E, top: C.top - y};
            k.each(["left", "top"], function(r, s) {
                if (k.ui.position[p[r]]) {
                    k.ui.position[p[r]][s](C, {targetWidth: c, targetHeight: g, elemWidth: D, elemHeight: o, collisionPosition: z, collisionWidth: B, collisionHeight: A, offset: q, my: f.my, at: f.at})
                }
            });
            if (f.shim && k.fn.bgiframe) {
                F.bgiframe()
            }
            F.offset(C)
        })
    };
    k.ui.position = {fit: {left: function(e, c) {
                var a = k(window), b = c.collisionPosition.left + c.collisionWidth - a.width() - a.scrollLeft();
                e.left = b > 0 ? e.left - b : Math.max(e.left - c.collisionPosition.left, e.left)
            }, top: function(e, c) {
                var a = k(window), b = c.collisionPosition.top + c.collisionHeight - a.height() - a.scrollTop();
                e.top = b > 0 ? e.top - b : Math.max(e.top - c.collisionPosition.top, e.top)
            }}, flip: {left: function(f, c) {
                if (c.at[0] === i) {
                    return
                }
                var a = k(window), b = c.collisionPosition.left + c.collisionWidth - a.width() - a.scrollLeft(), g = c.my[0] === "left" ? -c.elemWidth : c.my[0] === "right" ? c.elemWidth : 0, e = c.at[0] === "left" ? c.targetWidth : -c.targetWidth, o = -2 * c.offset[0];
                f.left += c.collisionPosition.left < 0 ? g + e + o : b > 0 ? g + e + o : 0
            }, top: function(f, c) {
                if (c.at[1] === i) {
                    return
                }
                var a = k(window), b = c.collisionPosition.top + c.collisionHeight - a.height() - a.scrollTop(), g = c.my[1] === "top" ? -c.elemHeight : c.my[1] === "bottom" ? c.elemHeight : 0, e = c.at[1] === "top" ? c.targetHeight : -c.targetHeight, o = -2 * c.offset[1];
                f.top += c.collisionPosition.top < 0 ? g + e + o : b > 0 ? g + e + o : 0
            }}};
    k.add("ui-position")
}(jQuery));
("menu" in jQuery.fn) || (function(b) {
    b.widget("ui.menu", {_create: function() {
            var a = this;
            this.element.addClass("ui-menu").attr({role: "listbox"}).click(function(e) {
                if (!b(e.target).closest(".ui-menu-item").length) {
                    return
                }
                e.preventDefault();
                a.select(e)
            });
            this.refresh()
        }, refresh: function() {
            var e = this;
            var a = this.element.children("li:not(.ui-menu-item)").addClass("ui-menu-item").attr("role", "menuitem");
            a.mouseenter(function(c) {
                e.activate(c, b(this))
            }).mouseleave(function() {
                e.deactivate()
            })
        }, activate: function(h, i) {
            this.deactivate();
            if (this.hasScroll()) {
                var g = i.offset().top - this.element.offset().top, a = this.element.scrollTop(), j = this.element.height();
                if (g < 0) {
                    this.element.scrollTop(a + g)
                } else {
                    if (g >= j) {
                        this.element.scrollTop(a + g - j + i.height())
                    }
                }
            }
            this.active = i.addClass("ui-state-hover");
            this._trigger("focus", h, {item: i})
        }, deactivate: function() {
            if (!this.active) {
                return
            }
            this.active.removeClass("ui-state-hover");
            this._trigger("blur");
            this.active = null
        }, next: function(a) {
            this.move("next", ".ui-menu-item:first", a)
        }, previous: function(a) {
            this.move("prev", ".ui-menu-item:last", a)
        }, first: function() {
            return this.active && !this.active.prevAll(".ui-menu-item").length
        }, last: function() {
            return this.active && !this.active.nextAll(".ui-menu-item").length
        }, move: function(f, g, h) {
            if (!this.active) {
                this.activate(h, this.element.children(g));
                return
            }
            var a = this.active[f + "All"](".ui-menu-item").eq(0);
            if (a.length) {
                this.activate(h, a)
            } else {
                this.activate(h, this.element.children(g))
            }
        }, nextPage: function(g) {
            if (this.hasScroll()) {
                if (!this.active || this.last()) {
                    this.activate(g, this.element.children(".ui-menu-item:first"));
                    return
                }
                var f = this.active.offset().top, h = this.element.height(), a = this.element.children(".ui-menu-item").filter(function() {
                    var c = b(this).offset().top - f - h + b(this).height();
                    return c < 10 && c > -10
                });
                if (!a.length) {
                    a = this.element.children(".ui-menu-item:last")
                }
                this.activate(g, a)
            } else {
                this.activate(g, this.element.children(".ui-menu-item").filter(!this.active || this.last() ? ":first" : ":last"))
            }
        }, previousPage: function(f) {
            if (this.hasScroll()) {
                if (!this.active || this.first()) {
                    this.activate(f, this.element.children(".ui-menu-item:last"));
                    return
                }
                var e = this.active.offset().top, a = this.element.height();
                result = this.element.children(".ui-menu-item").filter(function() {
                    var c = b(this).offset().top - e + a - b(this).height();
                    return c < 10 && c > -10
                });
                if (!result.length) {
                    result = this.element.children(".ui-menu-item:first")
                }
                this.activate(f, result)
            } else {
                this.activate(f, this.element.children(".ui-menu-item").filter(!this.active || this.first() ? ":last" : ":first"))
            }
        }, hasScroll: function() {
            return this.element.height() < this.element.prop("scrollHeight")
        }, select: function(a) {
            this._trigger("selected", a, {item: this.active})
        }});
    b.add("ui-menu")
}(jQuery));
("autocomplete" in jQuery.ui) || (function(f, e) {
    var g = 0;
    f.widget("ui.autocomplete", {options: {appendTo: "body", autoFocus: false, delay: 300, minLength: 1, position: {my: "left top", at: "left bottom", collision: "none"}, source: null}, pending: 0, _create: function() {
            var c = this, a = this.element[0].ownerDocument, b;
            this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off").attr({role: "textbox", "aria-autocomplete1": "list", "aria-haspopup": "true"}).bind("keydown.autocomplete", function(j) {
                b = false;
                var i = f.ui.keyCode;
                switch (j.keyCode) {
                    case i.ENTER:
                    case i.NUMPAD_ENTER:
                        if (c.menu.active) {
                            b = true;
                            j.preventDefault()
                        }
                        break
                    }
            }).bind("keyup.autocomplete", function(j) {
                if (c.options.disabled || c.element.prop("readonly")) {
                    return
                }
                b = false;
                var i = f.ui.keyCode;
                switch (j.keyCode) {
                    case i.PAGE_UP:
                        c._move("previousPage", j);
                        break;
                    case i.PAGE_DOWN:
                        c._move("nextPage", j);
                        break;
                    case i.UP:
                        c._move("previous", j);
                        j.preventDefault();
                        break;
                    case i.DOWN:
                        c._move("next", j);
                        j.preventDefault();
                        break;
                    case i.ENTER:
                    case i.NUMPAD_ENTER:
                        if (c.menu.active) {
                            b = true;
                            j.preventDefault()
                        }
                    case i.TAB:
                        if (!c.menu.active) {
                            return
                        }
                        c.menu.select(j);
                        break;
                    case i.ESCAPE:
                        c.element.val(c.term);
                        c.close(j);
                        break;
                    default:
                        clearTimeout(c.searching);
                        c.searching = setTimeout(function() {
                            if (c.term != c.element.val()) {
                                c.selectedItem = null;
                                c.search(null, j)
                            }
                        }, c.options.delay);
                        break
                    }
            }).bind("keypress.autocomplete", function(h) {
                if (b) {
                    b = false;
                    h.preventDefault()
                }
            }).bind("focus.autocomplete", function(h) {
                if (c.options.disabled) {
                    return
                }
                c.selectedItem = null;
                c.previous = c.element.val()
            }).bind("blur.autocomplete", function(h) {
                if (c.options.disabled) {
                    return
                }
                clearTimeout(c.searching);
                c.closing = setTimeout(function() {
                    c.close(h);
                    c._change(h)
                }, 150)
            });
            this._initSource();
            this.response = function() {
                return c._response.apply(c, arguments)
            };
            this.menu = f("<ul></ul>").addClass("ui-autocomplete").appendTo(f(this.options.appendTo || "body", a)[0]).mousedown(function(j) {
                var i = c.menu.element[0];
                if (!f(j.target).closest(".ui-menu-item").length) {
                    setTimeout(function() {
                        f(document).one("mousedown", function(h) {
                            if (h.target !== c.element[0] && h.target !== i && !f.contains(i, h.target)) {
                                c.close()
                            }
                        })
                    }, 1)
                }
                setTimeout(function() {
                    clearTimeout(c.closing)
                }, 13)
            }).menu({focus: function(k, j) {
                    var l = j.item.data("item.autocomplete");
                    if (false !== c._trigger("focus", k, {item: l})) {
                        if (/^key/.test(k.originalEvent.type)) {
                            c.element.val(l.value)
                        }
                    }
                }, selected: function(l, k) {
                    var m = k.item.data("item.autocomplete"), n = c.previous;
                    c.deleteClosing = setTimeout(function() {
                        c.close(l)
                    }, 50);
                    if (false !== c._trigger("select", l, {item: m})) {
                        c.element.val(m.value)
                    }
                    if (c.element[0] !== a.activeElement) {
                        c.element[0].focus();
                        c.previous = n;
                        setTimeout(function() {
                            c.previous = n;
                            c.selectedItem = m
                        }, 1)
                    }
                    c.term = c.element.val();
                    c.selectedItem = m
                }, blur: function(j, i) {
                    if (c.menu.element.is(":visible") && (c.element.val() !== c.term)) {
                        c.element.val(c.term)
                    }
                }}).zIndex(this.element.zIndex() + 1).css({top: 0, left: 0}).hide().data("menu");
            if (f.fn.bgiframe) {
                this.menu.element.bgiframe()
            }
        }, destroy: function() {
            this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete").removeAttr("role").removeAttr("aria-autocomplete1").removeAttr("aria-haspopup");
            this.menu.element.remove();
            f.Widget.prototype.destroy.call(this)
        }, _setOption: function(b, a) {
            f.Widget.prototype._setOption.apply(this, arguments);
            if (b === "source") {
                this._initSource()
            }
            if (b === "appendTo") {
                this.menu.element.appendTo(f(a || "body", this.element[0].ownerDocument)[0])
            }
            if (b === "disabled" && a && this.xhr) {
                this.xhr.abort()
            }
        }, _initSource: function() {
            var c = this, a, b;
            if (f.isArray(this.options.source)) {
                a = this.options.source;
                this.source = function(i, j) {
                    j(f.ui.autocomplete.filter(a, i.term))
                }
            } else {
                if (typeof this.options.source === "string") {
                    b = this.options.source;
                    this.source = function(i, j) {
                        if (c.xhr) {
                            c.xhr.abort()
                        }
                        c.xhr = f.ajax({url: b, data: i, dataType: "json", autocompleteRequest: ++g, success: function(h, k) {
                                if (this.autocompleteRequest === g) {
                                    j(h)
                                }
                            }, error: function() {
                                if (this.autocompleteRequest === g) {
                                    j([])
                                }
                            }})
                    }
                } else {
                    this.source = this.options.source
                }
            }
        }, search: function(a, b) {
            a = a != null ? a : this.element.val();
            this.term = this.element.val();
            if (a.length < this.options.minLength) {
                return this.close(b)
            }
            clearTimeout(this.closing);
            if (this._trigger("search", b) === false) {
                return
            }
            return this._search(a)
        }, _search: function(a) {
            this.pending++;
            this.element.addClass("ui-autocomplete-loading");
            this.source({term: a}, this.response)
        }, _response: function(a) {
            if (!this.options.disabled && a && a.length) {
                a = this._normalize(a);
                this._suggest(a);
                this._trigger("open", e, {menu: this.menu})
            } else {
                this.close()
            }
            this.pending--;
            if (!this.pending) {
                this.element.removeClass("ui-autocomplete-loading")
            }
        }, close: function(a) {
            clearTimeout(this.closing);
            if (this.menu.element.is(":visible")) {
                this.menu.element.hide();
                this.menu.deactivate();
                this._trigger("close", a)
            }
        }, _change: function(a) {
            if (this.previous !== this.element.val()) {
                this._trigger("change", a, {item: this.selectedItem})
            }
        }, _normalize: function(a) {
            if (a.length && a[0].label && a[0].value) {
                return a
            }
            return f.map(a, function(b) {
                if (typeof b === "string") {
                    return{label: b, value: b}
                }
                return f.extend({label: b.label || b.value, value: b.value || b.label}, b)
            })
        }, _suggest: function(b) {
            var a = this.menu.element.empty().zIndex(this.element.zIndex() + 1);
            this._renderMenu(a, b);
            this.menu.deactivate();
            this.menu.refresh();
            a.show();
            this._resizeMenu();
            a.position(f.extend({of: this.element}, this.options.position));
            if (this.options.autoFocus) {
                this.menu.next(new f.Event("mouseover"))
            }
        }, _resizeMenu: function() {
            var a = this.menu.element;
            a.outerWidth(Math.max(a.width("").outerWidth(), this.element.outerWidth()))
        }, _renderMenu: function(a, b) {
            var c = this;
            f.each(b, function(j, i) {
                c._renderItem(a, i)
            })
        }, _renderItem: function(b, a) {
            return f("<li></li>").data("item.autocomplete", a).append(f("<a></a>").text(a.label)).appendTo(b)
        }, _move: function(a, b) {
            if (!this.menu.element.is(":visible")) {
                this.search(null, b);
                return
            }
            if (this.menu.first() && /^previous/.test(a) || this.menu.last() && /^next/.test(a)) {
                this.element.val(this.term);
                this.menu.deactivate();
                return
            }
            this.menu[a](b)
        }, widget: function() {
            return this.menu.element
        }});
    f.extend(f.ui.autocomplete, {escapeRegex: function(a) {
            return a.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")
        }, filter: function(a, c) {
            var b = new RegExp(f.ui.autocomplete.escapeRegex(c), "i");
            return f.grep(a, function(h) {
                return b.test(h.label || h.value || h)
            })
        }});
    f.add("ui-autocomplete")
}(jQuery));
("storage" in jQuery.ui.flash) || (function(f, h) {
    var e = f.util, g = function() {
        if (e.flash.hasVersion(9)) {
            var b = this, c = b.element[0].id, a = b.options, i = "http://img.china.alibaba.com/swfapp/swfstore/swfstore.swf";
            a = b.options = f.extend(true, {width: 1, height: 1, swf: i, allowScriptAccess: "always", flashvars: {swfid: c, startDelay: 500, local_path: "/", allowedDomain: location.hostname, eventHandler: "jQuery.util.flash.triggerHandler"}}, a);
            f.extend(b, {getEngine: function() {
                    var j = this;
                    return{setItem: function(m, l) {
                            return j.callMethod("setItem", m, l)
                        }, getItem: function(k) {
                            return j.callMethod("getValueOf", k)
                        }, removeItem: function(k) {
                            return j.callMethod("removeItem", k)
                        }, clear: function() {
                            return j.callMethod("clear")
                        }, getLength: function() {
                            return j.callMethod("getLength")
                        }, key: function(k) {
                            return j.callMethod("getNameAt", k)
                        }}
                }});
            return true
        }
        return false
    };
    e.flash.regist("storage", g);
    f.add("ui-flash-storage")
})(jQuery);
("swfstorage" in jQuery.util) || (function(r) {
    var p = [], o, m = false, t = (function() {
        var a = [];
        if (!r.support.JSON) {
            a.push("util-json")
        }
        a.push("ui-flash-storage");
        o = "swfStoreTemp";
        return a
    })();
    r.extend(r.util, {swfstorage: r.extend({setItem: function(a, e) {
                try {
                    var c = o.setItem(a, e)
                } catch (b) {
                    this.trigger("error", {exception: b})
                }
                return c
            }, getItem: function(a) {
                return o.getItem(a)
            }, setJson: function(b, a) {
                return this.setItem(b, encodeURIComponent(JSON.stringify(a)))
            }, getJson: function(a) {
                return JSON.parse(decodeURIComponent(this.getItem(a)))
            }, removeItem: function(a) {
                return o.removeItem(a)
            }, clear: function() {
                return o.clear()
            }, getLength: function() {
                return o.getLength()
            }, key: function(a) {
                return o.key(a)
            }, ready: function(a) {
                if (m) {
                    a()
                } else {
                    p.push(a)
                }
            }}, r.EventTarget)});
    function q() {
        if (!m) {
            l(function() {
                if (o === "swfStoreTemp") {
                    r(function() {
                        k();
                        r("#swf-storage-fla").bind("contentReady.flash", function() {
                            o = r(this).flash("getEngine");
                            s()
                        }).bind("error.flash", function(b, a) {
                            r.util.swfstorage.trigger("error", a)
                        }).bind("securityError.flash", function(b, a) {
                            r.util.swfstorage.trigger("securityError", a)
                        })
                    })
                } else {
                    s()
                }
            })
        }
    }
    function s() {
        m = true;
        for (var a = 0, b = p.length; a < b; a++) {
            p[a]()
        }
    }
    function l(c) {
        if (n()) {
            c();
            return
        }
        for (var a = 0, b = t.length; a < b; a++) {
            (function(e) {
                r.use(t[e], function() {
                    t[e] = true;
                    if (n()) {
                        c()
                    }
                })
            })(a)
        }
    }
    function k() {
        r('<div id="swf-storage-fla">').appendTo("body").css({position: "absolute", left: "0px", top: "0px", width: "1px", height: "1px"}).flash({module: "storage"})
    }
    function n() {
        if (t.length === 0) {
            return true
        } else {
            for (var a = 0, b = t.length; a < b; a++) {
                if (t[a] !== true) {
                    return false
                }
            }
            return true
        }
    }
    q();
    r.add("util-swfstorage")
})(jQuery);
("Suggestion" in FE.ui) || (function(f, i) {
    var g = {festivalclass: "festival", url: "http://s.1688.com/promotion/offer_search.htm"}, j = function(Q, ac) {
        var ak = {}, c, af = [], a = 0, S = {objKeyItems: ak, historyItems: af}, K = 150, ah = 30, W;
        var aa = f.util.flash && f.util.flash.available;
        var O = false, e = 0, P = false, ab = 10, U = 2, ae = K * 2, R = "http://suggest.1688.com/bin/suggest";
        var M = function(l, k) {
            W = f.util.swfstorage;
            if (!W || !aa) {
                return false
            }
            W.ready(function() {
                var n = W.getJson("historyKeys"), m = parseInt(W.getJson("historyModify")), o = parseInt(W.getJson("historyKeyCounts"));
                if (n) {
                    T(n, m, o)
                }
                if (l) {
                    l = l.replace(/[<|>|&|\"|\']/g, "");
                    X(l)
                }
                k()
            });
            return true
        }, Y = function() {
            W = f.util.swfstorage;
            if (!W || !aa) {
                return
            }
            var m = parseInt(W.getJson("historyModify"));
            if (m === e) {
                return
            } else {
                var k = W.getJson("historyKeys"), l = parseInt(W.getJson("historyKeyCounts"));
                if (k) {
                    T(k, m, l)
                }
            }
        }, X = function(k) {
            if (a < K) {
                if (af.length >= ae) {
                    Z(false)
                }
                L(k)
            } else {
                Z(true);
                L(k)
            }
        }, T = function(k, m, l) {
            S = k;
            a = l;
            e = m;
            ak = k.objKeyItems;
            af = k.historyItems
        }, N = function() {
            if (P) {
                W.setJson("historyModify", new Date().getTime());
                W.setJson("historyKeys", S);
                W.setJson("historyKeyCounts", a);
                P = false
            }
        }, ag = function() {
            af = [];
            ak = {};
            a = 0;
            e = 0;
            S = {objKeyItems: ak, historyItems: af};
            P = true;
            setTimeout(N, 0)
        }, L = function(k) {
            if (!ak[k]) {
                f.ajax({url: R, dataType: "script", data: f.paramSpecial({type: "pinyin", q: k}), success: function() {
                        var m = window._suggest_result_, l = m.result;
                        if (!l) {
                            return
                        }
                        var n = l[0], o = {key: k, value: n};
                        V(o)
                    }})
            } else {
                ai(k)
            }
        }, ad = function() {
            W.removeItem("historyModify");
            W.removeItem("historyKeys");
            W.removeItem("historyKeyCounts")
        }, ai = function(k) {
            var l = ak[k], m;
            if (l === af.length) {
                return
            } else {
                l -= 1
            }
            m = af[l];
            af[l] = "";
            af.push(m);
            ak[k] = af.length;
            P = true;
            setTimeout(N, 0)
        }, V = function(k) {
            if (!ak[k.key]) {
                af.push(k);
                ak[k.key] = af.length;
                P = true;
                a++;
                N();
                setTimeout(function() {
                    if (O) {
                        Y();
                        O = false
                    }
                }, 0)
            }
        }, b = function(k) {
            var l = parseInt(ak[k]) - 1;
            af[l] = "";
            delete ak[k];
            a--;
            P = true;
            N()
        }, Z = function(r) {
            var p = af.length, l = [], q = {}, m, o, n = 0;
            if (r) {
                for (var k = 0; k < p; k++) {
                    o = af[k];
                    m = o.key;
                    if (m) {
                        if (n < ah) {
                            n++
                        } else {
                            l.push(o);
                            q[m] = l.length
                        }
                    }
                }
            } else {
                for (var k = 0; k < p; k++) {
                    o = af[k];
                    m = o.key;
                    if (m) {
                        l.push(o);
                        q[m] = l.length
                    }
                }
            }
            a = l.length;
            O = true;
            af = l;
            ak = q;
            P = true;
            S = {objKeyItems: q, historyItems: l}
        };
        var aj = M(Q, ac);
        if (!aj) {
            return aj
        }
        return{query: function(n) {
                Y();
                var l = af.length, k = [], o = l - 1, m = {}, p, q;
                if (!n) {
                    if (l > ab) {
                        q = ab
                    } else {
                        q = l
                    }
                    for (o = l - 1; o >= 0; o--) {
                        p = af[o];
                        if (p.key) {
                            m[p.key] = true;
                            k.push(p);
                            if (k.length === q) {
                                break
                            }
                        }
                    }
                } else {
                    for (o = l - 1; o >= 0; o--) {
                        p = af[o];
                        if (p && (p.key.indexOf(n) === 0 || p.value.indexOf(n) === 0)) {
                            m[p.key] = true;
                            k.push(p);
                            if (k.length === U) {
                                break
                            }
                        }
                    }
                }
                return{queryKeys: k, queryObj: m}
            }, removeItem: b, getHistoryItems: function() {
                return af
            }, clearHistory: ad, saveToLocalStorage: function() {
                N()
            }}
    };
    function h(b, a) {
        var c = this;
        c.element = f(b).eq(0);
        if (!c.element.length) {
            return
        }
        c.options = f.extend(false, {}, a, {suggestTracelogShow: "sale_search_suggest_show", suggestTracelogSubmit: "sale_top_suggest_submit", suggestTracelogType: "sale_search"});
        c._init()
    }
    h.prototype = {_init: function() {
            var B = this, x, b = false, A = B.options, z = B.element, c, C = f("#search_category"), a = 0, y = [], o = [], u = function(r) {
                var k = [], n = x.query(r), l = n.queryKeys, q = n.queryObj, p = l.length;
                for (var m = 0; m < p; m++) {
                    k.push({label: l[m].key, clickValue: l[m].key + "history", value: l[m].key, history: true})
                }
                return{queryObj: q, historyItems: k}
            }, v = function(q, r, m) {
                if (!r) {
                    q = {}
                }
                if (b) {
                    var k = u(r), p = k.queryObj, l = k.historyItems
                }
                var n = f.map(q, function(F) {
                    var s = F[0].replace(/_/g, "<em>").replace(/%/g, "</em>"), E = F[0].replace(/[_%]/g, "").trim(), t = !!F[2] ? (F[1] + F[2]) : F[1];
                    if (b) {
                        if (!p[E]) {
                            return{label: s, desc: t, value: E, index: m++, clickValue: E}
                        }
                    } else {
                        return{label: s, desc: t, value: E, index: m++, clickValue: E}
                    }
                });
                if (b) {
                    n = l.concat(n)
                }
                y = q;
                o = n;
                return n
            }, w = function(n) {
                var k = u(false), q = k.queryObj, p = k.historyItems;
                clearTimeout(c.searching);
                c.term = "";
                c.selectedItem = null;
                o = p;
                var m = "";
                for (var l = 0; l < p.length; l++) {
                    m = m + "_" + p[l].clickValue
                }
                B.showResultWords = m;
                c.response(p)
            };
            if (A.history) {
                var e = function() {
                    b = true;
                    z.bind("mousedown.auto", function(k) {
                        if (c.menu.element.is(":visible")) {
                            return
                        }
                        if (typeof c.term !== "undefined" && c.term != c.element.val()) {
                            c.selectedItem = null;
                            c.search(null, k)
                        } else {
                            var l = f.trim(z.val());
                            if (!l) {
                                w(l)
                            } else {
                                c.response(o)
                            }
                        }
                    });
                    z.bind("keyup.auto", function(k) {
                        var l = f.trim(z.val());
                        if (!l) {
                            w(l)
                        }
                    })
                };
                x = j(f.trim(z.val()), e)
            }
            z.autocomplete({source: function(k, l) {
                    B.ajax && B.ajax.abort();
                    B.ajax = f.ajax({url: A.url || "http://suggest.1688.com/bin/suggest", dataType: "script", data: f.paramSpecial({type: A.type, industryFlag: A.industryFlag || "", q: k.term}), success: function() {
                            var s = window._suggest_result_, m = s.result || {}, r = 0, t, F = s.category, q = s.festival;
                            if (s.pCity) {
                                t = s.pCity[0][1] + s.pCity[0][2];
                                m.splice(0, 0, s.pCity[0])
                            }
                            var p = v(m, f.trim(k.term), r);
                            var n = "";
                            for (var r = 0; r < p.length; r++) {
                                n = n + "_" + p[r].clickValue
                            }
                            if (C.length && F) {
                                f.each(F, function(D, G) {
                                    G.category = true;
                                    G.label = G.query;
                                    p.unshift(G);
                                    n = "_" + G.id + n
                                })
                            }
                            if (q) {
                                f.each(q, function(D, G) {
                                    G.festival = true;
                                    G.label = G.query;
                                    p.unshift(G);
                                    n = "_" + G.id + n
                                })
                            }
                            B.showResultWords = k.term + n;
                            if (B.options.hasDacu && typeof B.options.suggestionDacu !== "undefined") {
                                var E = B.options.suggestionDacu;
                                E.hasDacu = true;
                                p.push(E)
                            }
                            a = 0;
                            l(p)
                        }})
                }, select: function(q, n) {
                    var t = f(q.target), l, p, s = 0;
                    if (n.item.hasDacu) {
                        var D = f("<form method='get' target='_blank'></form>").appendTo("body");
                        D.attr("action", n.item.linkHref);
                        D.append("<input type='hidden' value='" + n.item.tracelog + "' name='tracelog'/>");
                        D.submit();
                        return true
                    }
                    if (t.hasClass("suggest-delete")) {
                        q.stopPropagation();
                        l = t.data("key");
                        x.removeItem(l);
                        clearTimeout(c.searching);
                        clearTimeout(c.deleteClosing);
                        B.stopKeyFocus = true;
                        p = v(y, f.trim(z.val()), s);
                        c.response(p);
                        return false
                    }
                    if (C.length && n.item.category) {
                        C.val(n.item.id)
                    } else {
                        C.val("")
                    }
                    if (n.item.festival) {
                        var k = n.item, m = g.url, r = k.id;
                        var D = f("<form method='get'></form>").appendTo("body");
                        D.attr("action", m);
                        D.append("<input type='hidden' value='" + r + "' name='tab'/>");
                        D.append("<input type='hidden' value='" + k.label + "' name='keywords'/>");
                        B.aliclick(B, "sale_top_" + r);
                        D.submit();
                        return true
                    }
                    if (B.options.suggestTracelogSubmit) {
                        B._suggestClick("submit", n, q)
                    }
                    B.stopKeyFocus = true;
                    z.val(n.item.value);
                    A.onSelected && A.onSelected.call(B, q, n)
                }, open: function(l, k) {
                    k.menu.element.width(z.width() + A.widthfix);
                    B.exposureClick(B.options.suggestTracelogShow + "_" + B.showResultWords)
                }, minLength: 1, appendTo: A.appendTo, position: A.position});
            c = z.data("autocomplete");
            c._renderItem = function(l, k) {
                return f("<li>").data("item.autocomplete", k).html(function() {
                    if (k.hasDacu) {
                        return'<div class="suggestion-dacu321" href="' + k.linkHref + '"><img src="' + k.linkImg + '" class="dacu321img"/><span class="dacu321text">' + k.textDes + "</span></div>"
                    }
                    if (k.history) {
                        return'<span class="suggest-key suggest-history-key">' + k.label + '</span><span class="suggest-delete" data-key="' + k.label + '">\u5220\u9664</span>'
                    } else {
                        if (C.length && k.category) {
                            return'<span class="suggest-key" index="1" categoryid="' + k.id + '"><em>' + k.query + '</em></span><span class="suggest-category">\u5728<em>' + k.name + "</em>\u5206\u7c7b\u4e0b\u641c\u7d22</span>"
                        } else {
                            a++;
                            if (k.festival) {
                                var n = g.festivalclass, p = k.name, m = k.id;
                                return'<div class="' + n + '"><span class="suggest-key" index="1"><em>' + k.query + '</em></span><span class="suggest-category">\u5728<em>' + p + "</em>\u4e0b\u641c\u7d22&gt;&gt;</span></div>"
                            }
                            if (/^\d+$/.test(k.desc)) {
                                if (A.hideNumber) {
                                    return'<span class="suggest-key" index="' + a + '">' + k.label + "</span>"
                                } else {
                                    return'<span class="suggest-key" index="' + a + '">' + k.label + '</span><span class="suggest-result">\u7ea6' + k.desc + "\u6761\u7ed3\u679c</span>"
                                }
                            } else {
                                if (!k.desc) {
                                    return'<span class="suggest-key" index="' + a + '">' + k.label + "</span>"
                                } else {
                                    return'<span class="suggest-key" index="' + a + '">' + k.label + '</span><span class="suggest-city">\u5728<em>' + k.desc + "</em>\u91cc\u627e</span>"
                                }
                            }
                        }
                    }
                }).appendTo(l)
            };
            c.menu.element.addClass("web-suggestion")
        }, setOptions: function(a) {
            f.extend(this.options, a);
            return this
        }, enable: function() {
            this.element.autocomplete("enable")
        }, disable: function() {
            this.element.autocomplete("disable")
        }, _suggestClick: function(a, c, e) {
            try {
                switch (a) {
                    case"submit":
                        var k = this.options.suggestTracelogType + "_suggest_" + encodeURIComponent(this.element.val()) + "_" + encodeURIComponent(c.item.clickValue) + "_";
                        if (c.item.category) {
                            k = k + c.item.id + "_"
                        }
                        k += this.options.suggestTracelogSubmit;
                        return this.aliclick(this, k);
                        break;
                    case"show":
                        break;
                    default:
                        break
                    }
            } catch (b) {
            }
        }, aliclick: function(a, b) {
            if (typeof window.dmtrack != "undefined") {
                dmtrack.clickstat("http://stat.1688.com/search/queryreport.html", ("?searchtrace=" + b))
            } else {
                if (document.images) {
                    (new Image()).src = "http://stat.1688.com/search/queryreport.html?searchtrace=" + b + "&time=" + (+new Date)
                }
            }
            return true
        }, exposureClick: function(a) {
            if (typeof window.dmtrack != "undefined") {
                dmtrack.clickstat("http://stat.1688.com/sectionexp.html", ("?sectionexp=" + a))
            } else {
                (new Image).src = "http://stat.1688.com/sectionexp.html?sectionexp=" + a + "&time=" + (+new Date)
            }
        }};
    i.Suggestion = h;
    f.add("web-suggestion")
})(jQuery, FE.ui);
if (!FE.sys.Alibar) {
    jQuery.namespace("FE.sys.Alibar");
    (function(R, L, P) {
        var y, S, H = false, Q = R.util, K = R.noop, I = FE.util, O = R.util.ua.ie6;
        var D = {urlInit: function() {
                R("li.account-signout>a", y).attr("href", (G("style.loginchinahttp.url") || "http://login.1688.com") + "/member/signout.htm");
                R("li.account-signin>a", y).attr("href", (G("style.loginchina.url") || "https://login.1688.com") + "/member/signin.htm?Done=" + encodeURIComponent(location.href))
            }, loginfoInit: function() {
                function a() {
                    var e = R("span.account-id", y), l = "http://me.1688.com/", c;
                    R("li.account-msg, li.account-signin, li.account-signup, li.account-signout", y).addClass("fd-hide");
                    g();
                    j({source: ["b2b", "taobao"]}).always(function() {
                        if (I.IsLogin()) {
                            R("li.account-msg, li.account-signout", y).removeClass("fd-hide");
                            c = R("<a>", {href: l, html: k(I.LoginId()), target: "_blank", title: I.LoginId()});
                            if (R("li.vipInfoBox", y).length) {
                                c.addClass("nav-arrow")
                            }
                            e.html(c);
                            window.aliclick && c.mousedown(b);
                            i(function() {
                                f(m)
                            });
                            R.ajax("http://work.1688.com/home/unReadMsgCount.htm", {dataType: "jsonp", success: function(p) {
                                    var q = R("li.account-msg", y), o = q.children(), n;
                                    o.children().remove();
                                    if (p.success && p.count > 0) {
                                        n = R("<span>", {html: p.count > 99 ? "99+" : p.count});
                                        o.append(n);
                                        o.attr("title", "\u4f60\u6709\u65b0\u6d88\u606f");
                                        window.aliclick && n.mousedown(function() {
                                            aliclick(this, "?tracelog=cn_alibar_msg")
                                        })
                                    } else {
                                        o.attr("title", "\u67e5\u770b\u4f60\u7684\u6d88\u606f")
                                    }
                                }})
                        } else {
                            R("li.account-signin, li.account-signup", y).removeClass("fd-hide");
                            if (I.LastLoginId()) {
                                c = R("<a>", {href: l, html: k(I.LastLoginId()), target: "_blank", title: I.LastLoginId()}).mousedown(b);
                                e.html(c);
                                window.aliclick && c.mousedown(b)
                            } else {
                                e.html("\u6b22\u8fce\u6765\u5230\u963f\u91cc\u5df4\u5df4");
                                R("li.account-msg span", y).remove()
                            }
                        }
                    });
                    function k(o) {
                        var n = "";
                        if (o.length <= 8) {
                            return o
                        } else {
                            if (escape(o).indexOf("%u") !== -1) {
                                n = o.substring(0, 7) + "..."
                            } else {
                                n = o.length > 10 ? o.substring(0, 9) + "..." : o
                            }
                            return n
                        }
                    }
                    function i(n) {
                        if (B()) {
                            return
                        }
                        R.use("util-cookie", function() {
                            var q = R.util.cookie("_is_show_loginId_change_block_");
                            var o = I.getLastMemberId();
                            var p = function(r) {
                                r = r || R.util.cookie("_is_show_loginId_change_block_");
                                if (r.substring(o.length + 1) === "true") {
                                    A()
                                } else {
                                    n()
                                }
                            };
                            if (q && new RegExp(o).test(q)) {
                                p(q)
                            } else {
                                R.ajax({url: "http://member.1688.com/member/ajax/b2b_remove.do?mid=" + o, dataType: "jsonp", success: function(r) {
                                        if (r.success) {
                                            p()
                                        } else {
                                            n()
                                        }
                                    }, error: function() {
                                        n()
                                    }})
                            }
                        })
                    }
                    function f(o) {
                        if (B()) {
                            return
                        }
                        var n = I.LoginId();
                        if (new RegExp("^b2b-").test(n)) {
                            E(n);
                            return
                        }
                        R.use("util-cookie", function() {
                            var q = R.util.cookie("_show_force_unbind_div_");
                            var r = I.getLastMemberId();
                            var p = function() {
                                var s = R.util.cookie("_show_force_unbind_div_"), t = R.util.cookie("_show_sys_unbind_div_"), u = R.util.cookie("_show_user_unbind_div_");
                                if (s && s.substring(r.length + 1) === "true") {
                                    F()
                                } else {
                                    if (t && t.substring(r.length + 1) === "true") {
                                        V()
                                    } else {
                                        if (u && u.substring(r.length + 1) === "true") {
                                            M()
                                        } else {
                                            o()
                                        }
                                    }
                                }
                            };
                            if (q && new RegExp("^" + r).test(q)) {
                                p()
                            } else {
                                R.ajax({url: "http://member.1688.com/member/ajax/udb_bind_notify.do?memberId=" + r, dataType: "jsonp", success: function(s) {
                                        if (s.success) {
                                            p()
                                        } else {
                                            o()
                                        }
                                    }, error: function() {
                                        o()
                                    }})
                            }
                        })
                    }
                    function m() {
                        R.use("util-cookie", function() {
                            var r = R.util.cookie("__rn_refer_login_id__");
                            var o = I.getLastMemberId();
                            var s = R.util.cookie("__cn_logon_id__");
                            var q = R.util.cookie("__rn_alert__");
                            var n = R.util.cookie("__rn_second_alert__");
                            var p = "http://member.1688.com/member/rename/rename_cookie_sync.do?memberId=" + o;
                            if (!r || r !== s) {
                                R.ajax(p, {dataType: "jsonp", success: function(t) {
                                        if (t.success) {
                                            q = R.util.cookie("__rn_alert__");
                                            n = R.util.cookie("__rn_second_alert__");
                                            if (n && n === "true") {
                                                C()
                                            } else {
                                                if (q && q === "true") {
                                                    h()
                                                } else {
                                                    J();
                                                    N()
                                                }
                                            }
                                        } else {
                                            J();
                                            N()
                                        }
                                    }, error: function() {
                                    }})
                            } else {
                                if (n && n === "true") {
                                    C()
                                } else {
                                    if (q && q === "true") {
                                        h()
                                    }
                                }
                            }
                        })
                    }
                    function j(n) {
                        if ("updateLoginInfo" in I) {
                            return I.updateLoginInfo(n)
                        } else {
                            var o = new R.Deferred;
                            o.resolve();
                            return o
                        }
                    }
                    function b() {
                        aliclick(this, "?tracelog=cn_alibar_id")
                    }
                    function h() {
                        var o = "http://member.1688.com/member/prename/pre_name.htm?req_from=alibar";
                        var n = ('<div class="tips-content"><div class="tip-text add"><p style="color:#444;">\u4e3a\u4e86\u8ba9\u5ba2\u6237\u5feb\u901f\u8bb0\u4f4f\u60a8\uff0c\u60a8\u9700\u8981\uff1a</p><div class="modify_nick_btn"><a href="' + o + '">\u7acb\u5373\u4fee\u6539\u7528\u6237\u540d</a></div></div><div class="tips-close"></div></div><div class="tips-top"></div>');
                        S.html(n);
                        z(false)
                    }
                    function g() {
                        R("a.modify-nick", y).remove()
                    }}
                a();
                L.refresh = a
            }, dropdownInit: function() {
                R("li.extra", y).mouseenter(function() {
                    O && R(this).addClass("nav-hover");
                    R(this).prev().addClass("nav-hover-prev")
                }).mouseleave(function() {
                    O && R(this).removeClass("nav-hover");
                    R(this).prev().removeClass("nav-hover-prev")
                })
            }, vipInfoInit: function() {
                var b = R("li.vipInfoBox", y);
                var i = null;
                var g = null;
                var a = '<p class="reLoginRemind">\u60a8\u7684\u767b\u5f55\u72b6\u6001\u5df2\u5931\u6548,<a href="http://login.1688.com/member/signin.htm" target="_self">\u8bf7\u91cd\u65b0\u767b\u5f55</a></p>';
                var k = '<p class="subAccountRemind">\u60a8\u597d\uff01\u60a8\u5f53\u524d\u767b\u9646\u4e86\u4f1a\u5458\u5b50\u8d26\u53f7  <a href="http://login.1688.com/member/signout.htm" target="_self">\u9000\u51fa</a></p>';
                if (!b.length) {
                    return
                }
                var e = 0;
                b.mouseenter(function() {
                    i = R(this);
                    if (!I.IsLogin() || e) {
                        return
                    }
                    U();
                    f();
                    R.ajax({url: "http://vip.1688.com/club/club_info_json.do", dataType: "jsonp", success: function(l) {
                            if (l.success !== true) {
                                if (l.data.errorMsg === "NOT_LOGIN") {
                                    h();
                                    R("li.vipInfoBox div.nav-content", y).html(a);
                                    e = 1
                                } else {
                                    if (l.data.errorMsg === "SUB_ACCOUNT") {
                                        h();
                                        R("li.vipInfoBox div.nav-content", y).html(k);
                                        e = 1
                                    }
                                }
                                return
                            }
                            j(l.data);
                            h();
                            e = 1
                        }, error: function() {
                        }})
                });
                if (I.IsLogin()) {
                    b.hover(function() {
                        R(".modify_nick", y).addClass("fd-hide");
                        if (g) {
                            clearTimeout(g);
                            g = null
                        }
                        setTimeout(function() {
                            i.addClass("infoHover")
                        }, 100)
                    }, function() {
                        g = setTimeout(function() {
                            i.removeClass("infoHover");
                            g = null
                        }, 400)
                    })
                }
                function j(l) {
                    var o = I.getLastMemberId();
                    o = o ? o : "";
                    var n = '<div class="levelWrapper fd-clr">                                    <div class="memberPhoto">                                        <a href="http://me.1688.com" target="_blank">                                            <img src="<%= this.userImg %>" alt="" onerror="<%= this.error %>"/>                                        </a>                                    </div>                                    <div class="level">                                        <p class="account">                                            <a class="accountManage" href="http://work.1688.com/home/page/index.htm#app=accountmanagement&menu=&channel=" target="_blank">\u8d26\u53f7\u7ba1\u7406</a>                                            <span class="sep">|</span>                                            <a class="signout" href="http://login.1688.com/member/signout.htm" data-trace="cn_alibar_quit" title="\u9000\u51fa">\u9000\u51fa</a>                                        </p>                                        <% if( typeof $data.saleRate !== "undefined" && typeof $data.buyRate === "undefined") { %>                                            <p class="supplyLevel fd-clr">                                                    <span class="title">\u4f9b\u5e94\u7b49\u7ea7:</span>                                                    <a class="levelImg" data-trace="alibar_supplier_rank" href="<%= $data.saleRate.targetUrl %>" target="_blank" title="<%= $data.saleRate.tips %>">                                                        <img src="<%= $data.saleRate.logoUrl %>" alt=""/>                                                    </a>                                            </p>                                        <% } %>                                        <% if( typeof $data.saleRate === "undefined" && typeof $data.buyRate !== "undefined") { %>                                            <p class="purchaseLevel fd-clr">                                                <span class="title">\u91c7\u8d2d\u7b49\u7ea7:</span>                                                <a class="levelImg" data-trace="alibar_buyers_rank" href="<%= $data.buyRate.targetUrl %>" target="_blank" title="<%= $data.buyRate.tips %>">                                                    <img src="<%= $data.buyRate.logoUrl %>" alt=""/>                                                </a>                                            </p>                                        <% } %>                                        <% if( typeof $data.saleRate !== "undefined" && typeof $data.buyRate !== "undefined") { %>                                            <p class="supplyLevel fd-clr">                                                    <span class="title">\u4f9b\u5e94\u7b49\u7ea7:</span>                                                    <a class="levelImg" data-trace="alibar_supplier_rank" href="<%= $data.saleRate.targetUrl %>" target="_blank" title="<%= $data.saleRate.tips %>">                                                        <img src="<%= $data.saleRate.logoUrl %>" alt=""/>                                                    </a>                                            </p>                                            <p class="purchaseLevel fd-clr">                                                <span class="title">\u91c7\u8d2d\u7b49\u7ea7:</span>                                                <a class="levelImg" data-trace="alibar_buyers_rank" href="<%= $data.buyRate.targetUrl %>" target="_blank" title="<%= $data.buyRate.tips %>">                                                    <img src="<%= $data.buyRate.logoUrl %>" alt=""/>                                                </a>                                            </p>                                        <% } %>                                        <% if( typeof $data.saleRate !== "undefined" && typeof $data.buyRate === "undefined") { %>                                            <p style="padding-top:3px;"><a style="color:#336699;" class="" data-trace="alibar_vip_club" href="http://vip.1688.com" target="_blank">\u53bb\u4f1a\u5458\u4ff1\u4e50\u90e8\u901b\u901b</a></p>                                        <% } %>                                        <% if( typeof $data.saleRate === "undefined" && typeof $data.buyRate !== "undefined") { %>                                            <p style="padding-top:3px;"><a style="color:#336699;" class="" data-trace="alibar_vip_qy" href="http://vip.1688.com/club/shop_right.htm" target="_blank">\u67e5\u770b\u6211\u7684\u4f1a\u5458\u6743\u76ca</a></p>                                        <% } %>                                        <% if( typeof $data.saleRate !== "undefined" && typeof $data.buyRate !== "undefined") { %>                                            <p style="padding-top:3px;"><a style="color:#336699;" class="" data-trace="alibar_vip_qy" href="http://vip.1688.com/club/shop_right.htm" target="_blank">\u67e5\u770b\u6211\u7684\u4f1a\u5458\u6743\u76ca</a></p>                                        <% } %>                                        <% if( typeof $data.saleRate === "undefined" && typeof $data.buyRate === "undefined") { %>                                            <p><a class="vipClub" data-trace="alibar_vip_club" href="http://vip.1688.com" target="_blank">\u53bb\u4f1a\u5458\u4ff1\u4e50\u90e8\u901b\u901b</a></p>                                            <p><a class="newComer" data-trace="alibar_vip_noviciate" href="http://114.1688.com/newbie/index.htm" target="_blank">\u65b0\u624b\u5e2e\u52a9\u4e2d\u5fc3</a></p>                                        <% } %>                                    </div>                                </div>                                <% if( $data.medals.length ) { %>                                    <div class="medalWrapper fd-clr">                                        <% for ( var i = 0; i < $data.medals.length; i++ ) { %>                                            <a class="medal" href="<%= $data.medals[i].targetUrl %>" data-trace="alibar_medal_rank" title="<%= $data.medals[i].tips %>">                                                <img src="<%= $data.medals[i].logoUrl %>" alt=""/>                                            </a>                                        <% } %>                                    </div>                                <% } %>';
                    var m = c(o);
                    var p = {userImg: m, error: "this.src='http://img.china.alibaba.com/cms/upload/2012/137/253/352731_936034060.png';this.onerror=null;"};
                    R.use("web-sweet", function() {
                        var r;
                        var q = R("li.vipInfoBox div.nav-content", y);
                        r = FE.util.sweet(n).applyData(l, p);
                        q.html(r)
                    })
                }
                function c(p) {
                    var q = p.substring(0, 1), m = p.substring(1, 2), n = p.substring(2, 3), l = p.substring(3, 4);
                    var o = q + "/" + m + "/" + n + "/" + l + "/";
                    return"http://img.china.alibaba.com/club/upload/pic/user/" + o + p + "_s.jpeg"
                }
                function f() {
                    var l = R("div.nav-content", b);
                    l.addClass("alibar-loading");
                    l.css("height", 60)
                }
                function h() {
                    var l = R("div.nav-content", b);
                    l.removeClass("alibar-loading");
                    l.css("height", "auto")
                }}
            , purchaselistInit: function() {
                var o = R("li.topnav-purchaselist", y);
                if (!o.length) {
                    return
                }
                var n = R("div.nav-title", o), f = R("em", n), c = R("div.nav-content", o), a = c.children(".product-list"), b = c.children(".purchase-info"), e = R("p", a);
                o.mouseenter(function() {
                    window.aliclick && aliclick(this, "?tracelog=cn_alibar_purchaselist_hover");
                    g()
                });
                a.on("click", "a.delete", function(p) {
                    p.preventDefault();
                    var r = R(this).closest("dl"), q = r.data("item"), s = "offer";
                    R.ajax({url: (G("style.luna.url") || "http://order.1688.com") + "/order/purchase/ajax/delete_from_purchase_list_no_csrf_auth.jsx", dataType: "script", cache: false, data: {returnType: "jsonp", batchDel: [s, q.goodsID, q.specId].join()}, success: function() {
                            if (window.delFromPurchaseListResult && delFromPurchaseListResult.success) {
                                H = false;
                                g();
                                R(document).triggerHandler("delitem.alibar");
                                window.delFromPurchaseListResult = P
                            }
                        }, error: function() {
                            H = false;
                            g()
                        }})
                });
                function g() {
                    if (H) {
                        return
                    }
                    i();
                    R.ajax({url: (G("style.luna.url") || "http://order.1688.com") + "/order/purchase/ajax/quick_purchase_list.jsx", dataType: "jsonp", success: function(p) {
                            if (p.success !== true) {
                                return
                            }
                            h();
                            a.children("h3, dl").remove();
                            b.children("p").remove();
                            var q = p.totalKind || p.sumOfKind;
                            f.text(q);
                            l(q);
                            if (q) {
                                k(p.data);
                                j(p)
                            }
                            if (p.totalKind && a.find("dl").length) {
                                a.prepend("<h3>\u6700\u8fd1\u52a0\u5165\u7684\u8d27\u54c1\uff1a</h3>")
                            }
                            H = true
                        }, error: function() {
                            h()
                        }})
                }
                function m() {
                    R.ajax({url: (G("style.luna.url") || "http://order.1688.com") + "/order/purchase/ajax/quick_purchase_list_count.jsx", dataType: "jsonp", success: function(p) {
                            if (p.success !== true) {
                                return
                            }
                            var q = p.sumOfKind;
                            f.text(q);
                            l(q);
                            H = false
                        }})
                }
                function l(p) {
                    if (p) {
                        o.addClass("topnav-purchaselist-stock")
                    } else {
                        o.removeClass("topnav-purchaselist-stock")
                    }
                }
                function k(p) {
                    R.each(p, function(t, r) {
                        if (t > 4) {
                            return false
                        }
                        var x = "";
                        var q;
                        if (r.specInfos && r.specInfos.length) {
                            q = [];
                            R.each(r.specInfos, function(Y, X) {
                                q.push('<span title="');
                                q.push(X.specName);
                                q.push("\uff1a");
                                q.push(X.specValue);
                                q.push('" class="specItem');
                                if (Y === r.specInfos.length - 1) {
                                    q.push(" lastItem")
                                }
                                q.push('">');
                                q.push(X.specName);
                                q.push("\uff1a");
                                q.push(X.specValue);
                                q.push("</span>")
                            });
                            x = ['<dd class="specInfos">', q.join(""), "</dd>"].join("")
                        }
                        var v = R("<dl>"), s = Q.escapeHTML(r.goodsName, true), u = ["<dt>", '<a title="', s, '" target="_blank" href="', r.imgLinkUrl, '" data-trace="cn_alibar_purchaselist_offerdetail"></a>', "</dt>", '<dd class="title">', '<a title="', s, '" target="_blank" href="', r.imgLinkUrl, '" data-trace="cn_alibar_purchaselist_offerdetail">', Q.escapeHTML(r.goodsName.cut(23, "...")), "</a>", "</dd>", x, '<dd class="price">', "&yen;<em>", r.goodsPrice, "</em>\u5143&nbsp;\u00d7&nbsp;<span>", r.goodsCount, "</span>", "</dd>", '<dd class="action"><a class="delete" title="\u5220\u9664" href="#">\u5220\u9664</a></dd>'], w = new Image();
                        R(w).one("load", function() {
                            if (this.width && this.height) {
                                var aa, ac;
                                ac = aa = 50;
                                if (this.width > aa || this.height > ac) {
                                    var ab = this.width / this.height, Z = ab >= aa / ac;
                                    w[Z ? "width" : "height"] = Z ? aa : ac;
                                    if (O) {
                                        w[Z ? "height" : "width"] = (Z ? aa : ac) * (Z ? 1 / ab : ab)
                                    }
                                }
                            }
                        });
                        w.alt = r.goodsName;
                        w.src = r.imgUrl;
                        v.html(u.join("")).data("item", r);
                        a.append(v.html(u.join("")).data("item", r));
                        R(">dt>a", v).append(w)
                    })
                }
                function j(p) {
                    var q = R("<p>"), r = [];
                    if (p.remainKind) {
                        r = ['\u8fdb\u8d27\u5355\u8fd8\u5269\u4f59\u8d27\u54c1\uff1a<span class="orange">', p.remainKind, "</span>\u79cd\uff08", p.remainCount, "\u4ef6\uff09"]
                    } else {
                        if (p.sumOfKind) {
                            r = ["\u5171\u8ba1<span>", p.sumOfKind, "</span>\u79cd\u8d27\u54c1\uff08", p.sumOfAcount, "\u4ef6\uff09<br/>\u8d27\u54c1\u5408\u8ba1\uff1a<em>", p.sumOfPrice.toFixed(2), "</em>\u5143"]
                        }
                    }
                    b.prepend(q.html(r.join("")))
                }
                function i() {
                    a.addClass("alibar-loading");
                    var p = 0;
                    if (a.children("dl").length) {
                        p = a.height()
                    } else {
                        p = 60
                    }
                    a.css("height", p);
                    e.addClass("fd-hide")
                }
                function h() {
                    a.removeClass("alibar-loading");
                    a.css("height", "auto");
                    e.removeClass("fd-hide")
                }
                m();
                L.purchaselistRefresh = m
            }, favoriteInit: function() {
                var a = R("li.topnav-favorite", y);
                a.one("mouseenter", function() {
                    R.ajax({url: "http://purchase.1688.com/favorites/json/query_favorite_dynamic.jsx?type=all", dataType: "jsonp", success: function(b) {
                            if (b.success !== true) {
                                return
                            }
                            var c = b.data;
                            if (c.offerTag) {
                                R(".favorite-offer", a).addClass("news")
                            } else {
                                R(".favorite-offer", a).removeClass("news")
                            }
                            if (c.shopTag) {
                                R(".favorite-seller", a).addClass("news")
                            } else {
                                R(".favorite-seller", a).removeClass("news")
                            }
                        }})
                })
            }, tpInit: function() {
                R("li.topnav-tp", y).one("mouseenter", function() {
                    var a = this;
                    R.use("web-alitalk-shunt", function() {
                        FE.util.alitalk.shunt(R("a.order-online", a), {attr: "alitalk-shunt", ruleId: "ALITALK_INCALL_ROLE_CTP01"})
                    })
                })
            }, traceInit: function() {
                window.aliclick && R("#alibar-v4").on("mousedown", "a[data-trace]", function() {
                    aliclick(this, "?tracelog=" + R(this).data("trace"))
                })
            }, sessionKeeper: function() {
                R(window).one("load", function() {
                    R.getScript("http://style.c.aliimg.com/sys/js/session-keeper/session-keeper.js")
                })
            }};
        function A() {
            var a = "b2b_has_removed_tip";
            R.use("util-cookie", function() {
                if (R.util.subCookie(a) === "false") {
                    return
                }
                var e = R.util.cookie("_old_loginId_"), c = R.util.cookie("_current_loginId");
                var b = ["1688\u4e0e\u6dd8\u5b9d\u7f51\u4ea4\u6613\u5e02\u573a\u73b0\u5df2\u6253\u901a\uff0c\u5f53\u524d\u60a8\u7684\u8d26\u6237\u540d\u5df2\u7531\u539f\u6765\u7684 ", e, " \u66f4\u65b0\u4e3a ", c, " \uff0c\u65b9\u4fbf\u60a8\u66f4\u597d\u7684\u8bb0\u5fc6\u548c\u7ba1\u7406\u60a8\u7684\u8d26\u6237\u3002", '<a class="i-know" href="#i-know">\u6211\u77e5\u9053\u4e86</a>'].join("");
                R(".tip-text", S).html(b);
                R(".tip-text .i-know", S).on("click", function(f) {
                    f.preventDefault();
                    R.util.subCookie(a, "false");
                    U();
                    window.aliclick && aliclick(this, "?tracelog=Alibar_yundong_AssociateAccount_noremind")
                });
                z(false)
            })
        }
        function F() {
            var a = "b2b_force_unbind_tip";
            R.use("util-cookie", function() {
                if (R.util.subCookie(a) === "false") {
                    return
                }
                var b = R.util.cookie("_old_bind_1688_loginId_");
                var c = ["1688\u4e0e\u6dd8\u5b9d\u7f51\u73b0\u5df2\u6253\u901a\uff0c\u5f53\u524d\u6b63\u5728\u4f7f\u7528\u6dd8\u5b9d\u8d26\u6237\u767b\u5f55\u3002\u539f\u7ed1\u5b9a\u76841688\u8d26\u6237\uff1a", b, ' \u5df2\u89e3\u7ed1\uff0c\u4ea4\u6613\u3001\u4ea7\u54c1\u4fe1\u606f\u5747\u4f1a\u4fdd\u7559\u5728\u8be5\u8d26\u6237\u4e0b\uff0c\u60a8\u53ef\u4ee5\u9009\u62e9\u4f7f\u75281688\u8d26\u6237\u767b\u5f55\u67e5\u770b\u3002<a target="_blank" href="http://114.1688.com/km/detail/13666654.html?tracelog=kf_2012_budian_n_xsyyfcht">\u67e5\u770b\u8be6\u60c5&gt;</a>', '<a class="i-know" href="#i-know">\u4e0d\u518d\u63d0\u9192</a>'].join("");
                R(".tip-text", S).html(c);
                R(".tip-text .i-know", S).on("click", function(e) {
                    e.preventDefault();
                    R.util.subCookie(a, "false");
                    U();
                    window.aliclick && aliclick(this, "?tracelog=Alibar_yundong_AssociateAccount_noremind")
                });
                z(false)
            })
        }
        function V() {
            var a = "b2b_sys_unbind_tip";
            R.use("util-cookie", function() {
                if (R.util.subCookie(a) === "false") {
                    return
                }
                var b = ["1688\u4e0e\u6dd8\u5b9d\u7f51\u4ea4\u6613\u5e02\u573a\u73b0\u5df2\u6253\u901a\uff0c\u60a8\u53ef\u53d6\u6d88\u4e0e\u6dd8\u5b9d\u8d26\u53f7\u7ed1\u5b9a\u76841688\u8d26\u53f7\uff0c\u76f4\u63a5\u4f7f\u7528\u6dd8\u5b9d\u8d26\u53f7\u767b\u5f55\u4e0e\u5356\u5bb6\u3001\u4e70\u5bb6\u6c9f\u901a\u53ca\u4ea4\u6613\u7ba1\u7406\u3002", '<a target="_blank" href="http://member.1688.com/member/unbind/confirm_unbind_for_auto.htm">\u7acb\u5373\u89e3\u7ed1&gt;</a>', '<a class="i-know" href="#i-know">\u4e0d\u518d\u63d0\u9192</a>'].join("");
                R(".tip-text", S).html(b);
                R(".tip-text .i-know", S).on("click", function(c) {
                    c.preventDefault();
                    R.util.subCookie(a, "false");
                    U();
                    window.aliclick && aliclick(this, "?tracelog=Alibar_yundong_AssociateAccount_noremind")
                });
                z(false)
            })
        }
        function M() {
            var a = "b2b_user_unbind_tip";
            R.use("util-cookie", function() {
                if (R.util.subCookie(a) === "false") {
                    return
                }
                var b = ["1688\u4e0e\u6dd8\u5b9d\u7f51\u4ea4\u6613\u5e02\u573a\u73b0\u5df2\u6253\u901a\uff0c\u60a8\u53ef\u53d6\u6d88\u4e0e\u6dd8\u5b9d\u8d26\u53f7\u7ed1\u5b9a\u76841688\u8d26\u53f7\uff0c\u76f4\u63a5\u4f7f\u7528\u6dd8\u5b9d\u8d26\u53f7\u767b\u5f55\u4e0e\u5356\u5bb6\u3001\u4e70\u5bb6\u6c9f\u901a\u53ca\u4ea4\u6613\u7ba1\u7406\u3002", '<a target="_blank" href="http://member.1688.com/member/unbind/guide_unbind_for_manual.htm">\u7acb\u5373\u89e3\u7ed1&gt;</a>', '<a class="i-know" href="#i-know">\u4e0d\u518d\u63d0\u9192</a>'].join("");
                R(".tip-text", S).html(b);
                R(".tip-text .i-know", S).on("click", function(c) {
                    c.preventDefault();
                    R.util.subCookie(a, "false");
                    U();
                    window.aliclick && aliclick(this, "?tracelog=Alibar_yundong_AssociateAccount_noremind")
                });
                z(false)
            })
        }
        function E(b) {
            if (B()) {
                return
            }
            var a = "b2b_remove_tips";
            R.use("util-cookie", function() {
                if (R.util.subCookie(a) === "false") {
                    return
                }
                var e = b.substring(4);
                var c = ["1688.com\u4e0e\u6dd8\u5b9d\u7f51\u4ea4\u6613\u5e02\u573a\u73b0\u5df2\u6253\u901a\uff0c\u53ef\u4f7f\u7528\u6dd8\u5b9d\u8d26\u6237\u76f4\u63a5\u767b\u5f55\uff0c8\u67081\u65e5\u8d77\u767b\u5f55\u540d\uff1a ", b, " \u5c06\u5931\u6548\uff0c\u60a8\u53ef\u76f4\u63a5\u4f7f\u7528 ", e, " \u767b\u5f551688.com\uff0c\u5bc6\u7801\u53ca\u8d26\u6237\u4e0b\u7684\u4fe1\u606f\u5747\u4fdd\u6301\u4e0d\u53d8\u3002", '<a class="i-know" href="#i-know">\u6211\u77e5\u9053\u4e86</a>'].join("");
                R(".tip-text", S).html(c);
                R(".tip-text .i-know", S).on("click", function(f) {
                    f.preventDefault();
                    R.util.subCookie(a, "false");
                    U();
                    window.aliclick && aliclick(this, "?tracelog=Alibar_yundong_AssociateAccount_noremind")
                });
                z(false)
            })
        }
        function J() {
            var a = "show_inter_tips";
            if (B()) {
                return
            }
            if (R.util.subCookie(a) != "false") {
                z(true);
                R.use("util-cookie", function() {
                    R(".tips-close", S).on("click", function() {
                        R.util.subCookie(a, "false")
                    })
                })
            }
        }
        function N() {
            if (B()) {
                return
            }
            R(window).on("userSwitchedToTB", function(b, a) {
                R(".tip-text", S).html(R.util.substitute('<p>\u60a8\u6b63\u5728\u4f7f\u7528 <em>\u6dd8\u5b9d\u5e10\u53f7 {nick}</em> \u8bbf\u95ee\u963f\u91cc\u5df4\u5df4\u4e2d\u56fd\u7ad9\uff0c\u60a8\u53ef\u4ee5\u201c<a href="http://login.1688.com/member/logout.htm">\u9000\u51fa</a>\u201d\u540e\u91cd\u65b0\u767b\u5f55\u5176\u4ed6\u963f\u91cc\u5df4\u5df4\u5e10\u53f7\u3002\u7f51\u5e97\u8fdb\u8d27\u53ef\u4ee5\u6765\u201c<a href="http://tao.1688.com/?tracelog=hipage_home_alibar" target="_blank">\u6dd8\u8d27\u6e90</a>\u201d\u901b\u901b\u54e6~<a class="i-know" href="#i-know">\u6211\u77e5\u9053\u4e86</a></p>', a));
                z(true)
            });
            S.on("click", "a.i-know", function(a) {
                a.preventDefault();
                U()
            });
            R(window).one("load", function() {
                R.getScript("http://style.c.aliimg.com/sys/js/common/user-switching-notify.js")
            })
        }
        function C() {
            var c = "http://member.1688.com/member/prename/second_pre_name.htm?req_from=2nd_prename", b = "http://work.1688.com/home/page/index.htm#app=accountmanagement&menu=&channel=", a = '\u60a8\u73b0\u5728\u6709\u4fee\u6539\u767b\u5f55\u540d\u7684\u673a\u4f1a\uff0c\u60a8\u53ef\u4ee5\uff1a<a href="' + c + '" target="_blank">\u7acb\u5373\u4fee\u6539</a>\u6216\u4e4b\u540e\u5728<a href="' + b + '" target="_blank">\u6211\u7684\u963f\u91cc-\u8d26\u53f7\u7ba1\u7406</a>\u4e2d\u4fee\u6539';
            R(".tip-text", S).html(a);
            z(false)
        }
        function G(a) {
            return FE.test && FE.test[a]
        }
        function B() {
            var a = /d.1688.com|d.1688.com/g;
            if (a.test(document.location.host)) {
                return true
            }
            return false
        }
        function z(b, a) {
            if (a) {
                R(".tip-text", S).html(a)
            }
            S.show().offset(T());
            if (b) {
                S.delay(10000).fadeOut(100)
            }
            R(".tips-close", S).on("click", function(c) {
                c.preventDefault();
                U()
            });
            R(window).resize(function() {
                setTimeout(function() {
                    S.offset(T())
                }, 25)
            })
        }
        function T() {
            var a = R(".account-id", y).offset();
            var b = y;
            return{left: a.left - 5, top: b.offset().top + b.height()}
        }
        function U() {
            S.hide()
        }
        L.refresh = L.refresh || K;
        L.purchaselistRefresh = L.purchaselistRefresh || K;
        L.showTip = z;
        L.hideTip = U;
        R(function() {
            y = y || R("#alibar-v4");
            S = R(".alibar-tips", y);
            if (y.length) {
                for (var a in D) {
                    D[a]()
                }
            }
        })
    })(jQuery, FE.sys.Alibar)
}
("sweet" in FE.util) || (function(r, l) {
    var s = "__sub_foreach_", p = "__index_", t = "__index_tmp_", m = "__var_tmp_", q = "__len_", n = "__buf__.push(";
    var o = function(f) {
        f = f.replace(/[\n\r]/g, "\\n");
        if (!this.applyData) {
            return new o(f)
        }
        var h = new RegExp("(.*?)" + o.startDelimiter + "(.*?)" + o.endDelimiter, "g"), c = /foreach[\s\xa0]*\([\s\xa0]*(\S+?)[\s\xa0]*(?:as[\s\xa0]*(\S+?)){0,1}?[\s\xa0]*\)[\s\xa0]*\{/g, b, i, a, e = [], g = [];
        b = f.replace(h, function(j, v, w) {
            w = r.trim(w);
            if (v != "") {
                v = v.replace(/'/g, "\\'");
                g.push(n + "'" + v + "'");
                g.push(");");
                if (w.charAt(0) == ":") {
                    g[g.length - 1] = ")"
                }
            }
            if (w != "") {
                if (w.charAt(0) == "=") {
                    w = n + w.substr(1) + ");"
                } else {
                    if (!/[;\?\{\}:]/.test(w.charAt(w.length - 1))) {
                        w = w + ";"
                    }
                }
                g.push(w)
            }
            return""
        });
        if (b) {
            g.push(n + "'" + b + "');")
        }
        g = g.join("").replace(c, function(z, j, B) {
            var C = {type: "foreach", varName: j, definedVarName: B || false}, y = e.push(C) - 1, A = s + y + "_{";
            C.id = y;
            return A
        });
        for (i = 0, a = e.length; i < a; i++) {
            g = k(g, e[i])
        }
        g = ["var __buf__=[],$index=null;$util.print=function(str){__buf__.push(str);};with($data){", g, "} return __buf__.join('');"].join("");
        this.compiled = new Function("$data", "$util", g)
    };
    o.prototype.applyData = function(f, a) {
        var c = {};
        if (o.util) {
            var e = o.util;
            for (var b in e) {
                c[b] = e[b]
            }
        }
        return this.compiled.call(a || window, f, c)
    };
    function k(g, b) {
        var i = b.id, L = b.varName, c = b.definedVarName, O = p + i, K = t + i, M = m + i, F = q + i, G = [L, "[", O, "]"].join(""), H = new RegExp(s + i + "_{", "g"), j = new RegExp("{|}", "g"), f, P, I, J, a, h = 0, e, N;
        if (c) {
            e = ["var ", K, "=$index;if(typeof ", c, " !='undefined')var ", M, "=", c, ";else var ", c, "=null;for(var ", O, "=0,", F, "=", L, ".length;", O, "<", F, ";", O, "++){$index=", O, ";", c, "=", G, ";with(", c, "){"].join("");
            N = ["}}$index=", K, ";if(typeof ", M, "!='undefined')", c, "=", M, ";"].join("")
        } else {
            e = ["var ", K, "=$index;for(var ", O, "=0,", F, "=", L, ".length;", O, "<", F, ";", O, "++){$index=", O, ";with(", G, "){"].join("");
            N = "}}$index=" + K + ";"
        }
        f = H.exec(g);
        if (f) {
            J = f.index;
            a = H.lastIndex;
            I = g.substr(a);
            while ((P = j.exec(I))) {
                if (P == "{") {
                    h++
                } else {
                    if (h > 0) {
                        h--
                    } else {
                        I = I.substring(0, P.index) + N + I.substr(j.lastIndex);
                        break
                    }
                }
            }
            g = g.substring(0, J) + e + I
        }
        return g
    }
    o.startDelimiter = "<%";
    o.endDelimiter = "%>";
    o.util = {trim: r.trim, escape: r.util.escapeHTML};
    l.sweet = o;
    r.add("web-sweet")
})(jQuery, FE.util);
(function(a) {
    a.extend(a.util, {cookie: function(g, e, i) {
            if (e !== null && typeof e === "object") {
                i = e
            }
            i = i || {};
            var j, f = i.raw ? function(k) {
                return k
            } : escape, c = i.raw ? function(k) {
                return k
            } : unescape;
            if (arguments.length > 1 && (e === null || typeof e !== "object")) {
                i = jQuery.extend({}, i);
                if (e === null) {
                    i.expires = -1
                }
                if (typeof i.expires === "number") {
                    var b = i.expires, h = i.expires = new Date();
                    h.setDate(h.getDate() + b)
                }
                if (/\b1688\.com$/.test(window.location.hostname) && i && i.domain == "alibaba.com") {
                    i.domain = "1688.com"
                }
                return(document.cookie = [f(g), "=", i.raw ? String(e) : f(String(e)), i.expires ? "; expires=" + i.expires.toUTCString() : "", i.path ? "; path=" + i.path : "", i.domain ? "; domain=" + i.domain : "", i.secure ? "; secure" : ""].join(""))
            }
            return(j = new RegExp("(?:^|; )" + escape(g) + "=([^;]*)").exec(document.cookie)) ? c(j[1]) : null
        }});
    a.add("util-cookie")
})(jQuery);
jQuery.namespace("Searchweb", "Searchweb.Test", "Searchweb.Widget", "Searchweb.Business", "Searchweb.Utility", "Searchweb.Config");
!(function($) {
    $.extend(Searchweb.Utility, {aliclick: function(u, param) {
            if (typeof window.dmtrack != "undefined") {
                setTimeout(function() {
                    dmtrack.clickstat("http://stat.1688.com/search/queryreport.html", param)
                }, 10)
            } else {
                if (document.images) {
                    (new Image()).src = "http://stat.1688.com/search/queryreport.html" + param + "&time=" + (+new Date)
                }
            }
            return true
        }, p4pClick: function(url, type) {
            var d = new Date;
            if (document.images && (!arguments[1] || arguments[1] && $.browser.msie)) {
                (new Image).src = url + "&j=1&time=" + d.getTime()
            }
            return true
        }, statAdClick: function(u, param) {
            if (typeof window.dmtrack != "undefined") {
                dmtrack.clickstat("http://stat.1688.com/ad.html", param)
            } else {
                if (document.images) {
                    (new Image()).src = "http://stat.1688.com/ad.html" + param + "&time=" + (+new Date)
                }
            }
            return true
        }, exposureClick: function(sectionexp) {
            if (typeof window.dmtrack != "undefined") {
                dmtrack.clickstat("http://stat.1688.com/sectionexp.html", ("?sectionexp=" + sectionexp))
            } else {
                if (document.images) {
                    (new Image).src = "http://stat.1688.com/sectionexp.html?sectionexp=" + sectionexp + "&time=" + (+new Date)
                }
            }
        }, searchTypeExpClick: function(param) {
            var searchType = "selloffer", searchPattern = "search", searchKey = "", iType = "sale";
            var categoryId = 0;
            if (typeof (iPageConfig) === "object" && typeof (iSearchPV) === "object") {
                searchType = iPageConfig.searchType ? iPageConfig.searchType : "saleoffer";
                categoryId = iPageConfig.categoryId;
                if ($.trim(iPageConfig.keywords) == "") {
                    searchPattern = "list"
                } else {
                    searchKey = iPageConfig.keywordsGbk
                }
                switch (searchType) {
                    case"saleoffer":
                        iType = "sale";
                        break;
                    case"company":
                        iType = "company";
                        break;
                    case"business":
                        iType = "bizlist";
                        break;
                    case"newbuyoffer":
                        iType = "buy";
                        break;
                    case"wiki":
                        iType = "alihelp";
                        break;
                    case"news":
                        iType = "info";
                        break;
                    default:
                        iType = "other";
                        break
                }
                var exposureStr = iType + "_" + searchPattern + "_" + "{pvkey}";
                if (searchKey) {
                    exposureStr += "_" + searchKey
                }
                if (categoryId > 0) {
                    exposureStr += "_" + categoryId
                }
                if (typeof (param) === "string" && $.trim(param) != "") {
                    this.exposureClick(exposureStr.replace(/\{pvkey\}/g, param))
                }
            }
        }, exposureClickKeyValue: function(keyvaluepair) {
            if (typeof window.dmtrack != "undefined") {
                dmtrack.clickstat("http://stat.1688.com/sectionexp.html", ("?" + keyvaluepair))
            } else {
                if (document.images) {
                    (new Image).src = "http://stat.1688.com/sectionexp.html?" + keyvaluepair + "&time=" + (+new Date)
                }
            }
        }, traceEnquiryClick: function(o) {
            var fromId = "", params = [];
            fromId = FE.util.LastLoginId();
            if (fromId != "") {
                params.push("?fromId=" + fromId);
                params.push("toId=" + (o.toId || ""));
                params.push("offerId=" + (o.offerId || ""));
                params.push("source=" + (o.source || 1));
                params.push("cna=" + (this.getCookie("cna") || ""));
                var offerUrl = "";
                if (o.offerId && o.offerId != "") {
                    offerUrl = "http://detail.1688.com/buyer/offerdetail/" + o.offerId + ".html"
                }
                params.push("sourceUrl=" + offerUrl);
                if (typeof window.dmtrack != "undefined") {
                    dmtrack.clickstat("http://interface.xp.1688.com/eq/enquiry/traceEnquiry.json", params.join("&"))
                } else {
                    d = new Date();
                    if (document.images) {
                        (new Image()).src = "http://interface.xp.1688.com/eq/enquiry/traceEnquiry.json" + params.join("&") + "&time=" + d.getTime()
                    }
                }
                return true
            }
        }, getCookie: function(name) {
            var value = document.cookie.match("(?:^|;)\\s*" + name + "=([^;]*)");
            return value ? unescape(value[1]) : ""
        }, addCookie: function(name, v, domainName) {
            var expDate = new Date, sevenDay = 604800000;
            expDate = new Date(expDate.getTime() + sevenDay);
            document.cookie = name + ("=" + escape(v) + ";expires=" + expDate.toGMTString() + ";path=/;" + "domain=" + domainName)
        }, getFDCookie: function(name) {
            var alicnweb = this.getCookie("alicnweb");
            var reg = new RegExp("(^|)" + name + "=([^|]*)", "i");
            if (reg.test(alicnweb)) {
                return unescape(RegExp.$2.replace(/\+/g, " "))
            }
            return""
        }, setFDCookie: function(name, v) {
            var alicnweb = this.getCookie("alicnweb");
            var index0 = alicnweb.indexOf(name);
            if (index0 == -1) {
                alicnweb += (name + "=" + v + "|");
                this.addCookie("alicnweb", alicnweb, ".s.1688.com")
            } else {
                var index1 = alicnweb.indexOf("|", index0);
                var str0 = alicnweb.substring(0, index0);
                var str1 = alicnweb.substring(index1);
                alicnweb = str0 + name + "=" + v + str1;
                this.addCookie("alicnweb", alicnweb, ".s.1688.com")
            }
        }, getSWCookie: function(name) {
            var alisw = this.getCookie("alisw");
            var reg = new RegExp("(^|)" + name + "=([^|]*)", "i");
            if (reg.test(alisw)) {
                return unescape(RegExp.$2.replace(/\+/g, " "))
            }
            return""
        }, setSWCookie: function(name, v) {
            var alisw = this.getCookie("alisw");
            var index0 = alisw.indexOf(name);
            if (index0 == -1) {
                alisw += (name + "=" + v + "|");
                this.addCookie("alisw", alisw, "s.1688.com")
            } else {
                var index1 = alisw.indexOf("|", index0);
                var str0 = alisw.substring(0, index0);
                var str1 = alisw.substring(index1);
                alisw = str0 + name + "=" + v + str1;
                this.addCookie("alisw", alisw, "s.1688.com")
            }
        }, getMemberId: function() {
            var name = "last_mid";
            var value = document.cookie.match("(?:^|;)\\s*" + name + "=([^;]*)");
            return value ? decodeURIComponent(value[1]) : ""
        }, getSearchPageId: function() {
            return typeof window.dmtrack_pageid == "undefined" ? -1 : dmtrack_pageid
        }, getJsonView: function(url, o) {
            $.ajax(url, {data: o.data, dataType: "jsonp", success: function(data) {
                    if (data.error !== "0") {
                        return
                    } else {
                        o.success(data.result)
                    }
                }, error: function() {
                    o.error()
                }})
        }, getJsonView2: function(url, o) {
            $.ajax(url, {data: o.data, dataType: "jsonp", success: function(data) {
                    if (data.error !== "0") {
                        return
                    } else {
                        o.success(data.result)
                    }
                }, error: function() {
                    o.error()
                }})
        }, getRPCJsonp: function(url, o) {
            $.ajax(url, {data: o.data, dataType: "jsonp", success: function(data) {
                    if (data.hasError) {
                        return
                    } else {
                        o.success(data.content)
                    }
                }, error: function() {
                    o.error()
                }})
        }, renderHTML: function(template, data, node) {
            $.use("web-sweet", function() {
                var html = FE.util.sweet(template).applyData(data);
                node.html(html)
            })
        }, uniqueMerge: function(des, a) {
            for (var i = 0; i < a.length; i++) {
                for (var j = 0, len = des.length; j < len; j++) {
                    if (a[i] === des[j]) {
                        des.splice(j, 1);
                        break
                    }
                }
            }
        }, parseAttrJson: function(dom, attr) {
            var json = null;
            var domNode = $(dom);
            if (domNode.length > 0) {
                var data = domNode.attr(attr);
                if (data && data.trim()) {
                    json = $.parseJSON(data)
                }
            }
            return json
        }, parseJS: function(div) {
            if (!div) {
                return
            }
            if (typeof (div) == "string") {
                var elem = document.createElement("div");
                elem.innerHTML = div;
                div = elem
            }
            var remoteJSPages = {};
            var scripts = div.getElementsByTagName("script");
            div = null;
            for (var i = 0; i < scripts.length; i++) {
                if (scripts[i].src.length > 0 && !remoteJSPages[scripts[i].src]) {
                    var doc = document.createElement("script");
                    doc.type = scripts[i].type;
                    doc.src = scripts[i].src;
                    document.getElementsByTagName("head")[0].appendChild(doc);
                    remoteJSPages[scripts[i].src] = 1;
                    doc = null
                } else {
                    window.eval(scripts[i].innerHTML)
                }
            }
        }, isSupport: function(callback, feature) {
            if (typeof (callback) !== "function") {
                return
            }
            feature = feature || "lossy";
            var img = new Image();
            img.onload = function() {
                var result = (img.width > 0) && (img.height > 0);
                callback(result, feature)
            };
            img.onerror = function() {
                callback(false, feature)
            };
            var kTestImages = {lossy: "UklGRiIAAABXRUJQVlA4IBYAAAAwAQCdASoBAAEADsD+JaQAA3AAAAAA", lossless: "UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==", alpha: "UklGRkoAAABXRUJQVlA4WAoAAAAQAAAAAAAAAAAAQUxQSAwAAAARBxAR/Q9ERP8DAABWUDggGAAAABQBAJ0BKgEAAQAAAP4AAA3AAP7mtQAAAA==", animation: "UklGRlIAAABXRUJQVlA4WAoAAAASAAAAAAAAAAAAQU5JTQYAAAD/////AABBTk1GJgAAAAAAAAAAAAAAAAAAAGQAAABWUDhMDQAAAC8AAAAQBxAREYiI/gcA"};
            img.src = "data:image/webp;base64," + kTestImages[feature]
        }, isSupportAll: function(callback, features) {
            if (typeof (callback) !== "function") {
                return
            }
            var i = 0;
            var self = this;
            var features = features || ["lossy", "lossless", "alpha", "animation"];
            var cb = function(flag, feature) {
                if (flag) {
                    if (++i == features.length) {
                        callback(true);
                        return
                    }
                    self.isSupport(cb, features[i])
                } else {
                    callback(false);
                    return
                }
            };
            this.isSupport(cb, features[0])
        }, end: 0});
    window.aliclick = Searchweb.Utility.aliclick
})(jQuery);
!(function(a) {
    var e, b = {graveId: "aissaSimpleTipsBox", boxId: "aissaSimpleTips", local: 1, arrow: 9, width: 64, dLeft: 0, dTop: 0, isAnim: true, isHold: true, tipsHold: true, keep: 200, isOnloadShow: false, onloadHold: 5000, txt: "Message", overflowChange: true, eListener: "mouseover", type: "small", noClose: false, els: null, end: 0};
    function c(f, g) {
        e = g;
        this.init(f);
        return c
    }
    a.extend(c.prototype, {init: function(f) {
            var g = this, h = a.extend(false, {}, b, f);
            grave = null, box = null, doms = null, tmp = null, els = h.els;
            g.config = h;
            if (g.sto != null) {
                clearTimeout(g.sto)
            }
            g.sto = null;
            g.a = 0;
            if (els instanceof Array) {
                doms = els;
                tmp = doms[0]
            } else {
                if (typeof els == "string") {
                    doms = a("#" + els);
                    tmp = doms;
                    if (!doms.length) {
                        a("." + els).each(function(i, j) {
                            if (j.css("display") != "none") {
                                tmp = j;
                                return false
                            }
                        })
                    }
                }
            }
            if (!doms.length) {
                return
            }
            grave = a("<div></div>");
            grave.attr("id", h.graveId);
            a("#" + h.container).append(grave);
            g.grave = grave;
            box = a("<div></div>");
            box.attr("id", h.boxId);
            g.box = box;
            switch (h.type) {
                case"hot":
                    g.tipHot();
                    break;
                case"new":
                    g.tipNew();
                    break;
                case"small":
                    g.tipSmall();
                    break;
                case"big":
                    g.tipBig();
                    break
            }
            g.boxWidth = box.outerWidth() + (g.a >= 5 && g.a <= 8 ? 7 : 0);
            g.boxHeight = box.outerHeight() + (g.a >= 1 && g.a <= 4 ? 7 : 0);
            if (!h.noClose) {
                a(g.close).bind("click", function(i) {
                    a(g.box).css("display", "none");
                    i.preventDefault();
                    i.stopPropagation()
                })
            }
            if (h.eListener == "mouseover") {
                doms.bind(h.eListener, function(i) {
                    g.showTips(doms)
                });
                doms.bind("mouseout", function(i) {
                    g.hiddenTips()
                });
                if (h.tipsHold) {
                    box.bind("mouseover", function(i) {
                        g.isTipsHold()
                    });
                    box.bind("mouseout", function(i) {
                        g.hiddenTips()
                    })
                }
            }
            g.onloadShow(tmp);
            a(window).bind("resize", function(i) {
            })
        }, tipHot: function() {
            var f = this;
            f.box.addClass("tip-hot-box");
            f.grave.append(f.box)
        }, tipNew: function() {
            var f = this;
            f.box.addClass("tip-new-box");
            f.grave.append(f.box)
        }, tipSmall: function() {
            var j = null, g = this, i = null, h = [], f = null;
            g.box.addClass("tips-box");
            if (g.config.width) {
                g.box.css("width", g.config.width)
            }
            h.push('<div class="tip-small-content">');
            h.push(g.config.txt);
            h.push("</div>");
            g.box.html(h.join(""));
            if (!g.config.noClose) {
                j = a("<i></i>");
                j.addClass("tip-small-close");
                g.close = j;
                g.box.append(j)
            }
            if (g.config.arrow != 0) {
                i = a("<div></div>");
                g.getArrowNumber(g.config.local);
                i.addClass("arrow-" + g.a);
                h = [];
                h.push('<div class="arr-0"></div><div class="arr-1"></div><div class="arr-2"></div><div class="arr-3"></div><div class="arr-4"></div>');
                i.html(h.join(""));
                g.box.append(i);
                g.arrow = i
            }
            g.grave.append(g.box)
        }, tipBig: function() {
            var j = null, g = this, i = null, h = [], f = null;
            g.box.addClass("tips-box");
            if (g.config.width) {
                g.box.css("width", g.config.width)
            }
            h.push('<div class="tip-big-content">');
            h.push(g.config.txt);
            h.push("</div>");
            g.box.html(h.join(""));
            bubble = a("<span></span>");
            bubble.addClass("tip-big-bubble");
            g.bubble = bubble;
            g.box.append(bubble);
            if (!g.config.noClose) {
                j = a("<span></span>");
                j.addClass("tip-big-close");
                g.close = j;
                g.box.append(j)
            }
            if (g.config.arrow != 0) {
                i = a("<div></div>");
                g.getArrowNumber(g.config.local);
                i.addClass("arrow-" + g.a);
                h = [];
                h.push('<div class="arr-0"></div><div class="arr-1"></div><div class="arr-2"></div><div class="arr-3"></div><div class="arr-4"></div>');
                i.html(h.join(""));
                g.box.append(i);
                g.arrow = i
            }
            g.grave.appendChild(g.box)
        }, getArrowNumber: function(g) {
            var f = this;
            f.a = f.config.arrow;
            if (f.config.arrow != 9) {
                return
            }
            switch (g) {
                case 1:
                    f.a = 3;
                    break;
                case 2:
                    f.a = 4;
                    break;
                case 3:
                    f.a = 1;
                    break;
                case 4:
                    f.a = 2;
                    break;
                case 5:
                    f.a = 7;
                    break;
                case 6:
                    f.a = 8;
                    break;
                case 7:
                    f.a = 5;
                    break;
                case 8:
                    f.a = 6;
                    break
                }
        }, onloadShow: function(g) {
            var f = this;
            f.box.css("display", "none");
            if (f.config.isOnloadShow) {
                f.showTips(g);
                if (f.config.isHold) {
                    f.holdTips(f.config.onloadHold)
                }
            }
        }, resizeShow: function(h) {
            var g = this, f = 0;
            g.isTipsHold();
            f = self.config.local;
            g.setXY(h, f);
            if (self.config.overflowChange && g.type == "small") {
                f = g.inversionIt(h, f)
            }
            if (g.animSto != null) {
                clearTimeout(g.animSto)
            }
            g.animSto = null;
            g.box.css("left", g.x + "px");
            g.box.css("top", g.y + "px");
            if (self.config.isAnim) {
                g.count = 0;
                g.animTips(g.x, g.y, f)
            }
        }, showTips: function(j) {
            var h = this, g = 0, i = a("#" + h.config.container), f = i.offset();
            h.isTipsHold();
            h.wx = f.left;
            h.wy = f.top;
            h.box.css("display", "none");
            g = h.config.local;
            h.setXY(j, g);
            if (h.config.overflowChange && h.type == "small") {
                g = h.inversionIt(j, g)
            }
            if (h.animSto != null) {
                clearTimeout(h.animSto)
            }
            h.animSto = null;
            h.box.css("left", h.x + "px");
            h.box.css("top", h.y + "px");
            h.box.css("display", "block");
            if (h.config.isAnim) {
                h.count = 0;
                h.animTips(h.x, h.y, g)
            }
        }, inversionIt: function(g, q) {
            var x = this, u = 0, m = 0, i = 0, v = 0, k = 0, j = 0, p = 0, f = 0, o = 0, r = 0, n = null, s = g.outerWidth(), l = g.outerHeight();
            n = document.documentElement;
            u = n.clientWidth;
            m = n.clientHeight;
            i = a(document).scrollLeft();
            v = a(document).scrollTop();
            j = v > x.y ? 1 : (v + m < x.y + l + x.boxHeight ? 2 : 0);
            k = i > x.x ? 6 : (i + u < x.x + s + x.boxWidth ? 3 : 0);
            p = x.eX - i;
            f = i + u - x.eX - s;
            o = x.eY - v;
            r = v + m - x.eY - l;
            if (x.config.local > 0 && x.config.local < 5) {
                if (j == 1 && r > o) {
                    q = x.config.local == 1 ? 3 : (x.config.local == 2 ? 4 : q)
                } else {
                    if (j == 2 && o > r) {
                        q = x.config.local == 3 ? 1 : (x.config.local == 4 ? 2 : q)
                    }
                }
            } else {
                if (x.config.local > 4 && x.config.local < 9) {
                    if (k == 6 && f > p) {
                        q = x.config.local == 5 ? 7 : (x.config.local == 6 ? 8 : q)
                    } else {
                        if (k == 3 && p > f) {
                            q = x.config.local == 7 ? 5 : (x.config.local == 8 ? 6 : q)
                        }
                    }
                }
            }
            x.getArrowNumber(q);
            if (x.config.arrow != 0) {
                x.arrow.className = "arrow-" + x.a
            }
            x.ieBug();
            x.setXY(g, q);
            return q
        }, ieBug: function() {
            var f = this;
            if (f.config.arrow != 0) {
                var g = a.browser.msie;
                if (g && (f.a == 3 || f.a == 4)) {
                    f.arrow.css("top", (f.box.outerHeight() - 1))
                } else {
                    if (g == 6 && (f.a == 1 || f.a == 2)) {
                        f.arrow.css("top", "-4px")
                    }
                }
            }
        }, setXY: function(g, l) {
            var o = this, f = 0, p = 0, m = 0, k = 0, n = g.outerWidth(), j = g.outerHeight();
            var i = g.offset();
            o.eY = p = i.top;
            o.eX = f = i.left;
            switch (l) {
                case 1:
                    m = f;
                    k = p - o.boxHeight - 2;
                    break;
                case 2:
                    m = f + n - o.boxWidth;
                    k = p - o.boxHeight - 2;
                    break;
                case 3:
                    m = f;
                    k = p + j + 7;
                    break;
                case 4:
                    m = f + n - o.boxWidth;
                    k = p + j + 7;
                    break;
                case 5:
                    m = f - o.boxWidth - 2;
                    k = p;
                    break;
                case 6:
                    m = f - o.boxWidth - 2;
                    k = p + j - o.boxHeight;
                    break;
                case 7:
                    m = f + n + 7;
                    k = p;
                    break;
                case 8:
                    m = f + n + 7;
                    k = p + j - o.boxHeight;
                    break
            }
            m -= o.config.dLeft;
            k -= o.config.dTop;
            o.x = m - o.wx;
            o.y = k - o.wy
        }, animTips: function(f, i, h) {
            var g = this;
            g.animSto = setTimeout(function() {
                switch (h) {
                    case 1:
                    case 2:
                        i += g.count < 4 ? -1 : 1;
                        g.box.css("top", i + "px");
                        break;
                    case 3:
                    case 4:
                        i += g.count < 4 ? 1 : -1;
                        g.box.css("top", i + "px");
                        break;
                    case 5:
                    case 6:
                        f += g.count < 4 ? -1 : 1;
                        g.box.css("left", f + "px");
                        break;
                    case 7:
                    case 8:
                        f += g.count < 4 ? 1 : -1;
                        g.box.css("left", f + "px");
                        break
                }
                g.count++;
                if (g.count >= 8) {
                    return
                }
                g.animTips(f, i, h)
            }, 7)
        }, hiddenTips: function() {
            var f = this;
            if (f.config.isHold) {
                f.holdTips()
            } else {
                f.box.css("display", "none")
            }
        }, isTipsHold: function() {
            var f = this;
            if (f.sto != null) {
                clearTimeout(f.sto)
            }
            f.sto = null
        }, holdTips: function(f) {
            var g = this;
            if (g.sto != null) {
                clearTimeout(g.sto)
            }
            g.sto = null;
            g.sto = setTimeout(function() {
                g.box.css("display", "none")
            }, f)
        }, end: 0});
    Searchweb.Widget.SimpleTips = c
})(jQuery);
(function(a) {
    a.fn.mask = function(c, b) {
        a(this).each(function() {
            if (b !== undefined && b > 0) {
                var e = a(this);
                e.data("_mask_timeout", setTimeout(function() {
                    a.maskElement(e, c)
                }, b))
            } else {
                a.maskElement(a(this), c)
            }
        })
    };
    a.fn.unmask = function() {
        a(this).each(function() {
            a.unmaskElement(a(this))
        })
    };
    a.fn.isMasked = function() {
        return this.hasClass("masked")
    };
    a.maskElement = function(e, c) {
        if (e.data("_mask_timeout") !== undefined) {
            clearTimeout(e.data("_mask_timeout"));
            e.removeData("_mask_timeout")
        }
        if (e.isMasked()) {
            a.unmaskElement(e)
        }
        if (e.css("position") == "static") {
            e.addClass("masked-relative")
        }
        e.addClass("masked");
        var f = a('<div class="loadmask"></div>');
        if (navigator.userAgent.toLowerCase().indexOf("msie") > -1) {
            f.height(e.height() + parseInt(e.css("padding-top")) + parseInt(e.css("padding-bottom")));
            f.width(e.width() + parseInt(e.css("padding-left")) + parseInt(e.css("padding-right")))
        }
        if (navigator.userAgent.toLowerCase().indexOf("msie 6") > -1) {
            e.find("select").addClass("masked-hidden")
        }
        e.append(f);
        if (c !== undefined) {
            var b = a('<div class="loadmask-msg" style="display:none;"></div>');
            b.append("<div>" + c + "</div>");
            e.append(b);
            b.css("top", "40px");
            b.css("left", Math.round(e.width() / 2 - (b.width() - parseInt(b.css("padding-left")) - parseInt(b.css("padding-right"))) / 2) + "px");
            b.show()
        }
    };
    a.unmaskElement = function(b) {
        if (b.data("_mask_timeout") !== undefined) {
            clearTimeout(b.data("_mask_timeout"));
            b.removeData("_mask_timeout")
        }
        b.find(".loadmask-msg,.loadmask").remove();
        b.removeClass("masked");
        b.removeClass("masked-relative");
        b.find("select").removeClass("masked-hidden")
    }
})(jQuery);
!(function(c) {
    var b = Searchweb.Utility, e = {"offset": [3, 5], "triggerElement": "", "rootId": "", "width": 100, "arrowPosition": "topLeftArrow", "renderTime": 300, "loadingState": true, "offsetTime": 100, end: 0};
    function a(f) {
        this.init(f)
    }
    c.extend(a.prototype, {init: function(f) {
            this.config = c.extend(true, {}, e, f);
            this.isPop = false;
            this.popLayerClass = "div.sw-ui-overflowLayer";
            this._bindEvent()
        }, _bindEvent: function() {
            this._createLayerAndBindEvent()
        }, _createWrap: function() {
            var l = c("div.sw-ui-overflowLayer");
            if (l.length > 0) {
                return l
            }
            var l = c('<div class="sw-ui-overflowLayer"><div class="' + this.config.arrowPosition + '"><div class="top"></div><div class="bottom"></div></div><div class="sw-ui-overflowLayer-body"></div></div>').appendTo("body"), q = this, g = c('<div class="sw-ui-overflowLayer-loading"><img src="http://img.china.alibaba.com/cms/upload/search/searchweb/common/loading.gif" /></div>').css({height: "40px", textAlign: "center", paddingTop: "20px"});
            if (q.config.loadingState) {
                g.appendTo(l)
            }
            var h = q.config, m = h.content;
            if (m) {
                c(m).appendTo(".sw-ui-overflowLayer-body", l);
                var n = l.find("a");
                if (h.offerp4p) {
                    var p = q.hoverEl, k = {"offer-id": p.attr("offer-id"), "cindex": p.attr("cindex"), "offer-stat": p.attr("offer-stat")};
                    n.attr(k)
                }
                if (h.appendLinkDiv) {
                    n.attr("href", q.hoverEl.attr("floaturl"))
                }
                if (h.trace) {
                    var p = q.hoverEl, j = p.attr("offer-stat"), i = "floatLayer_" + j;
                    b.exposureClick(i);
                    n.bind("click", function(r) {
                        b.aliclick(this, "?floatLayer=" + i)
                    })
                }
                if (h.arrowLeft) {
                    l.find("div.top").css("left", h.arrowLeft + "px").end().find("div.bottom").css("left", h.arrowLeft + "px")
                }
            }
            var f = q.config.borderClass;
            if (f) {
                l.addClass(f)
            }
            var o = q.config.callBack;
            if (o) {
                o()
            }
            c(q.popLayerClass).bind({mouseenter: function() {
                    q.isPop = true
                }, mouseleave: function() {
                    q.isPop = false;
                    if (c(this)) {
                        c(this).remove()
                    }
                }});
            return l
        }, _createLayerAndBindEvent: function() {
            var g = this;
            var f = g.config.rootId || "body";
            c(f).on("mouseenter", g.config.triggerElement, function() {
                var i = c(this), h = i.offset();
                g.hoverEl = i;
                g.timer = setTimeout(function() {
                    if (g.config.direction == "up" && g.config.borderClass == "yellowBorder") {
                        g.layer = g._createWrap().css({top: h.top - g.config.offset[1], left: h.left + g.config.offset[0], width: g.config.width, border: "1px solid #ffcc7f"})
                    } else {
                        g.layer = g._createWrap().css({top: h.top + g.config.offset[1], left: h.left + g.config.offset[0], width: g.config.width})
                    }
                    g.isPop = true
                }, g.config.renderTime)
            });
            c(f).on("mouseleave", g.config.triggerElement, function() {
                var h = c(this);
                g.isPop = false;
                clearTimeout(g.timer);
                if (g.layer) {
                    g.layer.delay(100).promise().then(function() {
                        if (!g.isPop) {
                            g.layer.remove()
                        }
                    })
                }
            })
        }, renderDataToLayer: function(h) {
            var f = this, g = f.config;
            setTimeout(function() {
                if (c("div.sw-ui-overflowLayer-loading").length) {
                    c("div.sw-ui-overflowLayer-loading").remove()
                }
                if (c("div.sw-ui-overflowLayer-body").length) {
                    c("div.sw-ui-overflowLayer-body").html(h)
                }
            }, g.renderTime + g.offsetTime)
        }, end: 0});
    Searchweb.Widget.OverflowLayer = a
})(jQuery);
/*!
 * jQuery BBQ: Back Button & Query Library - v1.2.1 - 2/17/2010
 * http://benalman.com/projects/jquery-bbq-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($, q) {
    var j, n = Array.prototype.slice, s = decodeURIComponent, a = $.param, c, m, w, b = $.bbq = $.bbq || {}, r, v, k, f = $.event.special, e = "hashchange", B = "querystring", E = "fragment", z = "elemUrlAttr", h = "location", l = "href", u = "src", y = /^.*\?|#.*$/g, x = /^.*\#/, i, D = {};
    function F(G) {
        return typeof G === "string"
    }
    function C(H) {
        var G = n.call(arguments, 1);
        return function() {
            return H.apply(this, G.concat(n.call(arguments)))
        }
    }
    function o(G) {
        return G.replace(/^[^#]*#?(.*)$/, "$1")
    }
    function p(G) {
        return G.replace(/(?:^[^?#]*\?([^#]*).*$)?.*/, "$1")
    }
    function g(I, N, G, J, H) {
        var P, M, L, O, K;
        if (J !== j) {
            L = G.match(I ? /^([^#]*)\#?(.*)$/ : /^([^#?]*)\??([^#]*)(#?.*)/);
            K = L[3] || "";
            if (H === 2 && F(J)) {
                M = J.replace(I ? x : y, "")
            } else {
                O = m(L[2]);
                J = F(J) ? m[I ? E : B](J) : J;
                M = H === 2 ? J : H === 1 ? $.extend({}, J, O) : $.extend({}, O, J);
                M = a(M);
                if (I) {
                    M = M.replace(i, s)
                }
            }
            P = L[1] + (I ? "#" : M || !L[1] ? "?" : "") + M + K
        } else {
            P = N(G !== j ? G : q[h][l])
        }
        return P
    }
    a[B] = C(g, 0, p);
    a[E] = c = C(g, 1, o);
    c.noEscape = function(H) {
        H = H || "";
        var G = $.map(H.split(""), encodeURIComponent);
        i = new RegExp(G.join("|"), "g")
    };
    c.noEscape(",/");
    $.deparam = m = function(J, G) {
        var I = {}, H = {"true": !0, "false": !1, "null": null};
        $.each(J.replace(/\+/g, " ").split("&"), function(M, R) {
            var L = R.split("="), Q = s(L[0]), K, P = I, N = 0, S = Q.split("]["), O = S.length - 1;
            if (/\[/.test(S[0]) && /\]$/.test(S[O])) {
                S[O] = S[O].replace(/\]$/, "");
                S = S.shift().split("[").concat(S);
                O = S.length - 1
            } else {
                O = 0
            }
            if (L.length === 2) {
                K = s(L[1]);
                if (G) {
                    K = K && !isNaN(K) ? +K : K === "undefined" ? j : H[K] !== j ? H[K] : K
                }
                if (O) {
                    for (; N <= O; N++) {
                        Q = S[N] === "" ? P.length : S[N];
                        P = P[Q] = N < O ? P[Q] || (S[N + 1] && isNaN(S[N + 1]) ? {} : []) : K
                    }
                } else {
                    if ($.isArray(I[Q])) {
                        I[Q].push(K)
                    } else {
                        if (I[Q] !== j) {
                            I[Q] = [I[Q], K]
                        } else {
                            I[Q] = K
                        }
                    }
                }
            } else {
                if (Q) {
                    I[Q] = G ? j : ""
                }
            }
        });
        return I
    };
    function A(I, G, H) {
        if (G === j || typeof G === "boolean") {
            H = G;
            G = a[I ? E : B]()
        } else {
            G = F(G) ? G.replace(I ? x : y, "") : G
        }
        return m(G, H)
    }
    m[B] = C(A, 0);
    m[E] = w = C(A, 1);
    $[z] || ($[z] = function(G) {
        return $.extend(D, G)
    })({a: l, base: l, iframe: u, img: u, input: u, form: "action", link: l, script: u});
    k = $[z];
    function t(J, H, I, G) {
        if (!F(I) && typeof I !== "object") {
            G = I;
            I = H;
            H = j
        }
        return this.each(function() {
            var M = $(this), K = H || k()[(this.nodeName || "").toLowerCase()] || "", L = K && M.attr(K) || "";
            M.attr(K, a[J](L, I, G))
        })
    }
    $.fn[B] = C(t, B);
    $.fn[E] = C(t, E);
    b.pushState = r = function(J, G) {
        if (F(J) && /^#/.test(J) && G === j) {
            G = 2
        }
        var I = J !== j, H = c(q[h][l], I ? J : {}, I ? G : 2);
        q[h][l] = H + (/#/.test(H) ? "" : "#")
    };
    b.getState = v = function(G, H) {
        return G === j || typeof G === "boolean" ? w(G) : w(H)[G]
    };
    b.removeState = function(G) {
        var H = {};
        if (G !== j) {
            H = v();
            $.each($.isArray(G) ? G : arguments, function(J, I) {
                delete H[I]
            })
        }
        r(H, 2)
    };
    f[e] = $.extend(f[e], {add: function(G) {
            var I;
            function H(K) {
                var J = K[E] = c();
                K.getState = function(L, M) {
                    return L === j || typeof L === "boolean" ? m(J, L) : m(J, M)[L]
                };
                I.apply(this, arguments)
            }
            if ($.isFunction(G)) {
                I = G;
                return H
            } else {
                I = G.handler;
                G.handler = H
            }
        }})
})(jQuery, this);
/*!
 * jQuery hashchange event - v1.2 - 2/11/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($, j, b) {
    var k, l = $.event.special, c = "location", e = "hashchange", m = "href", g = $.browser, h = document.documentMode, i = g.msie && (h === b || h < 8), f = "on" + e in j && !i;
    function a(n) {
        n = n || j[c][m];
        return n.replace(/^[^#]*#?(.*)$/, "$1")
    }
    $[e + "Delay"] = 100;
    l[e] = $.extend(l[e], {setup: function() {
            if (f) {
                return false
            }
            $(k.start)
        }, teardown: function() {
            if (f) {
                return false
            }
            $(k.stop)
        }});
    k = (function() {
        var n = {}, s, o, p, r;
        function q() {
            p = r = function(t) {
                return t
            };
            if (i) {
                o = $('<iframe src="javascript:0"/>').hide().insertAfter("body")[0].contentWindow;
                r = function() {
                    return a(o.document[c][m])
                };
                p = function(v, t) {
                    if (v !== t) {
                        var u = o.document;
                        u.open().close();
                        u[c].hash = "#" + v
                    }
                };
                p(a())
            }
        }
        n.start = function() {
            if (s) {
                return
            }
            var u = a();
            p || q();
            (function t() {
                var w = a(), v = r(u);
                if (w !== u) {
                    p(u = w, v);
                    $(j).trigger(e)
                } else {
                    if (v !== u) {
                        j[c][m] = j[c][m].replace(/#.*/, "") + "#" + v
                    }
                }
                s = setTimeout(t, $[e + "Delay"])
            })()
        };
        n.stop = function() {
            if (!o) {
                s && clearTimeout(s);
                s = 0
            }
        };
        return n
    })()
})(jQuery, this);
!(function(c) {
    var f, e = {hashEvent: "hashChanged", end: 0}, a;
    function b(g) {
        f = g;
        return b
    }
    c.extend(b, {init: function(g) {
            a = this;
            a.config = c.extend(false, {}, g, e);
            this.hashMap = {};
            this.ignoreHash = [];
            this.hashChangeListener()
        }, register: function(l, k, j) {
            if (!l || typeof (l) !== "string") {
                return false
            }
            var g = [];
            if (typeof (l) === "string") {
                g.push(l)
            } else {
                if (c.isArray(l)) {
                    g = l
                }
            }
            var m = c.deparam.fragment();
            for (var h = 0; h < g.length; h++) {
                var n = g[h];
                this.hashMap[n] = {};
                this.hashMap[n].url = m[n] ? m[n] : "";
                if (typeof (k) === "function") {
                    f.on(a.hashEvent + n, k, j)
                }
            }
            return true
        }, pushState: function(g, j) {
            if (!g) {
                return false
            }
            this.ignoreHash = {};
            if (c.isArray(j)) {
                for (var h = 0; h < j.length; h++) {
                    var k = j[h];
                    this.ignoreHash[k] = true
                }
            }
            c.bbq.pushState(g);
            return true
        }, getState: function(g) {
            return c.bbq.getState(g) || ""
        }, removeState: function(g) {
            c.bbq.removeState(g)
        }, hashChangeListener: function() {
            c(window).bind("hashchange", function(j) {
                for (var h in a.hashMap) {
                    var g = c.bbq.getState(h) || "";
                    if (a.hashMap[h].url === g) {
                        continue
                    }
                    a.hashMap[h].url = g;
                    if (a.ignoreHash[h]) {
                        continue
                    }
                    var i = {"val": g};
                    f.notify(a.hashEvent + h, i)
                }
                a.ignoreHash = {}
            })
        }, end: 0});
    Searchweb.Widget.History = b;
    AppCore.register("sw_widget_History", Searchweb.Widget.History)
})(jQuery);
!(function(c) {
    var e, b = Searchweb.Utility;
    function a(f) {
        e = f;
        return a
    }
    c.extend(a, {init: function(f) {
            try {
                this.exposureStorageTrace()
            } catch (g) {
            }
        }, exposureStorageTrace: function() {
            var g = c.trim(window.name);
            if (g && g.indexOf("|%") !== -1) {
                var f = g.split("|%"), h = f[0];
                g = f[1];
                this.sendByImg(g);
                this.clearWindowName(h)
            }
        }, clearWindowName: function(f) {
            window.name = f
        }, sendByImg: function(g) {
            var f = new Image(), h = "_img_" + Math.random();
            window[h] = f;
            f.onload = f.onerror = f.onabort = function() {
                window[h] = null
            };
            f.src = g
        }, end: 0});
    Searchweb.Business.ExposureStorageTrace = a;
    AppCore.register("sw_mod_ExposureSNStorageTrace", Searchweb.Business.ExposureStorageTrace)
})(jQuery);
(function(i, h) {
    if (typeof jQuery !== "function") {
        return
    }
    var j = jQuery, f = function(a) {
        if (i.dmtrack) {
            dmtrack.clickstat("http://stat.1688.com/tracelog/click.html", "?tracelog=" + a)
        }
    }, g = function() {
        var c, e, b, a, k = document.body;
        if (j("div.iepush-banner", k).length) {
            return
        }
        c = ['<div class="iepush-banner">', '<div class="iepush-b1">', '<div class="iepush-b2">', '<div class="iepush-content">', '<div class="iepush-text">', '<div class="iepush-text-inner">�������������ҳ��졢��ȫ������Ͱ��Ƽ���ʹ��<strong>���°汾��IE</strong></div>', "</div>", "</div>", '<a class="iepush-cls" href="#" target="_self" hidefocus title="�ر�"></a>', "</div>", "</div>", "</div>"];
        j(k).prepend(c.join(""));
        e = j("div.iepush-banner", k);
        b = j("div.iepush-text", e);
        f("t_upgradeie_show");
        if (typeof i.TUpgradeieShow == "string") {
            f(i.TUpgradeieShow)
        }
        j("a.iepush-cls", e).click(function(l) {
            l.preventDefault();
            b.remove();
            e.slideUp(400, function() {
                e.remove()
            });
            i.clearTimeout(a)
        }).mousedown(function(l) {
            f("t_upgradeie_cls");
            if (typeof i.TUpgradeieCls == "string") {
                f(i.TUpgradeieCls)
            }
        });
        j("div.iepush-content", e).click(function(l) {
            FE.util.goTo("http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie", "_blank");
            e.remove();
            i.clearTimeout(a)
        }).mousedown(function(l) {
            f("t_upgradeie");
            if (typeof i.TUpgradeie == "string") {
                f(i.TUpgradeie)
            }
        });
        a = i.setTimeout(function() {
            b.remove();
            e.slideUp(400, function() {
                e.remove()
            });
            i.clearTimeout(a)
        }, 20000)
    };
    j(function(a) {
        var e = parseInt(a.browser.version), b = navigator.userAgent, c = /Windows\sNT\s6\.[01];/g.test(b);
        if (i.TUpgradeForXP === true && c) {
            return
        }
        if (e === 7) {
            if (b.indexOf("Trident/6") > -1) {
                e = 10
            } else {
                if (b.indexOf("Trident/5") > -1) {
                    e = 9
                } else {
                    if (b.indexOf("Trident/4") > -1) {
                        e = 8
                    }
                }
            }
        }
        if (a.browser.msie && (e < 8 || (e < 9 && c))) {
            a.use("util-storage", function() {
                var l = "t_upgradeie_show", m = a.util.storage;
                m.ready(function() {
                    var k = a.now(), n = parseInt(m.getItem(l));
                    if (isNaN(n) || (k - n) > 24 * 60 * 60 * 1000) {
                        g();
                        m.setItem(l, k)
                    }
                })
            })
        }
    })
})(window, undefined);
!(function(d) {
    var f, b, a = Searchweb.Utility, e = {end: 0};
    function c(g) {
        f = g;
        return c
    }
    d.extend(c, {init: function(g) {
            this.config = d.extend(false, {}, e, g);
            b = this.config.global ? this.config.global : window.iPageConfig;
            this.ctr();
            this.exposure();
            this.pvCompanySectionexp();
            var h = this;
            f.on(Searchweb.Config.Events.OfferAsyncOffer, this.ctr, this);
            f.on(Searchweb.Config.Events.OfferAsyncPage, this.exposure, this)
        }, getSearchPageId: function() {
            return typeof window.dmtrack_pageid == "undefined" ? -1 : dmtrack_pageid
        }, pvCompanySectionexp: function() {
            if (b.searchType === "company") {
                this.sendByImg("http://stat.1688.com/sectionexp.html?sectionexp=company_search_click_test_show&st_page_id=" + this.getSearchPageId() + "&from=pvCom&t=" + (new Date()).getTime())
            }
        }, sendByImg: function(h) {
            var g = new Image(), i = "_img_" + Math.random();
            window[i] = g;
            g.onload = g.onerror = g.onabort = function() {
                window[i] = null
            };
            g.src = h
        }, exposure: function() {
            var g = "selloffer", m = "search", l = "", j = "sale";
            var k = 0;
            if (typeof (b) === "object" && typeof (iSearchPV) === "object") {
                g = b.searchType ? b.searchType : "saleoffer";
                k = b.categoryId;
                if (d.trim(b.keywords) == "") {
                    m = "list"
                } else {
                    l = b.keywordsGbk
                }
                switch (g) {
                    case"saleoffer":
                        j = "sale";
                        break;
                    case"company":
                        j = "company";
                        break;
                    case"business":
                        j = "bizlist";
                        break;
                    case"newbuyoffer":
                        j = "buy";
                        break;
                    case"wiki":
                        j = "alihelp";
                        break;
                    case"news":
                        j = "info";
                        break;
                    case"order":
                        j = "order";
                        break;
                    default:
                        j = "other";
                        break
                }
                var o = j + "_" + m + "_" + "{pvkey}";
                if (l) {
                    o += "_" + l
                }
                if (k > 0) {
                    o += "_" + k
                }
                var n = iSearchPV.iSubject;
                for (var h = 0; h < n.length; h++) {
                    if (typeof (n[h]) === "string" && d.trim(n[h]) != "") {
                        a.exposureClick(o.replace(/\{pvkey\}/g, n[h]))
                    }
                }
            }
        }, ctr: function() {
            if (typeof window.coaseParam !== "object") {
                return
            }
            window.coaseParam.page_id = a.getSearchPageId();
            window.coaseParam.refer = escape(window.location.href);
            var k = "http://ctr.1688.com/ctr.html?ctr_type={ctr_type}&page_area={page_area}&page_id={page_id}&category_id={category_id}&object_type={object_type}&object_ids={object_ids}&keyword={keyword}&page_size={page_size}&page_no={page_no}&refer={refer}", g = "offer";
            if (window.coaseParam.fnType == "company") {
                g = "company"
            }
            if (window.coaseParam.object_ids && window.coaseParam.object_ids != "") {
                var l = d.extend(true, {}, {"object_type": g, "ctr_type": "2", "page_area": "1", "object_ids": window.coaseParam.object_ids}, window.coaseParam);
                var j = d.util.substitute(k, l);
                h(j)
            }
            if (window.coaseParam.gold_ad_ids && window.coaseParam.gold_ad_ids != "") {
                var i = d.extend(true, {}, {"page_area": 3, "object_ids": window.coaseParam.gold_ad_ids, "ctr_type": 2, "object_type": "company", "page_size": "", "page_no": ""}, window.coaseParam);
                var j = d.util.substitute(k, i);
                h(j)
            }
            window.coaseParam = undefined;
            function h(m) {
                var n = new Date().getTime();
                if (document.images) {
                    (new Image()).src = m + "&time=" + n
                }
            }}
        , end: 0});
    Searchweb.Business.SearchPV = c;
    AppCore.register("sw_mod_searchpv", Searchweb.Business.SearchPV)
})(jQuery);
!(function(a) {
    Searchweb.Config.Events = {CallMeInit: "callme/callMeForExternal", BigRender: "bigrender/enableDom", OfferAsyncOffer: "offerAsync/offerload", OfferAsyncPage: "offerAsync/pagechange", RightP4P: "rightp4p/loadsuccess", end: 0};
    a.logger.setErrorUri("http://monitor.c.aliimg.com/page/logError?appkey=07a7f186d7982c1186c0521157b5cd26")
})(jQuery);
!(function(c) {
    var f, a, b = Searchweb.Utility, d = {end: 0};
    function e(g) {
        f = g;
        return e
    }
    c.extend(e, {init: function(g) {
            this.config = c.extend(false, {}, d, g);
            a = this.config.global ? this.config.global : window.iPageConfig;
            this.p4pSpan();
            this.delegateAliclickEvent();
            this.delegateP4PclickEvent();
            this.unpremitImgUrl();
            this.searchButtonClick();
            this.biaowangExposureEvent();
            this.clickTest();
            f.on(Searchweb.Config.Events.OfferAsyncPage, this.biaowangExposureEvent, this)
        }, p4pSpan: function() {
            var g;
            c("#sw_mod_searchlist").on("mousedown", "a[p4pspan=1]", function() {
                g = +new Date
            });
            c("#sw_mod_searchlist").on("mouseup", "a[p4pspan=1]", function() {
                this.href = this.href.replace(/&span=\d*/, "") + "&span=" + (+new Date - g)
            })
        }, delegateAliclickEvent: function() {
            c(document.body).on("mousedown", "[searchtrace]", function() {
                var h = c(this).attr("searchtrace");
                var g = "?searchtrace=" + h;
                b.aliclick(this, g)
            })
        }, delegateP4PclickEvent: function() {
            c(document.body).on("mousedown", "[offer-p4p]", function() {
                var k = c(this);
                var j = k.attr("offer-p4p");
                var i = k.attr("lc");
                var m = k.attr("offer-id");
                var h = c("#" + m).attr("p4p");
                var l = new Date();
                if (i !== "7") {
                    var g = k.attr("href");
                    (new Image).src = h + "&j=1" + "&lc=" + i + "&ver=42" + "&st_page_id=" + Searchweb.Utility.getSearchPageId() + "&url=" + g + "&t=" + l.getTime()
                } else {
                    (new Image).src = h + "&j=1" + "&lc=" + i + "&ver=42" + "&st_page_id=" + Searchweb.Utility.getSearchPageId() + "&t=" + l.getTime()
                }
            })
        }, unpremitImgUrl: function() {
            document.oncontextmenu = function() {
                function g(j) {
                    var i = j || window.event;
                    if (!i) {
                        var k = g.caller;
                        while (k) {
                            i = k.arguments[0];
                            if (i && Event == i.constructor) {
                                break
                            }
                            k = k.caller
                        }
                    }
                    return i
                }
                var h = g().target || g().srcElement;
                if (h.src) {
                    return false
                }
            }
        }, searchButtonClick: function() {
            if (a.buttonClick == "top" || a.buttonClick == "down") {
                var g = "?searchtrace=sale_" + a.buttonClick + "_user_" + a.keywordsGbk;
                b.aliclick(this, g)
            }
        }, biaowangExposureEvent: function() {
            if (typeof (biaowangExposure) != "undefined" && a.beginPage == "1") {
                b.statAdClick(this, biaowangExposure.param)
            }
        }, clickTest: function() {
            if (a.searchType !== "saleoffer") {
                return
            }
            var h = c("#sw_mod_interest");
            if (h.length === 0) {
                return
            }
            var g = c("a.sw-mod-interest-test", h);
            g.on("mousedown", function(k) {
                k.preventDefault();
                var j = c(this);
                var i = j.attr("swtrace");
                var m = j.attr("cvalue");
                var l = "?searchtrace=sale_relative_" + m + "&rule_id=962&st_page_id=" + b.getSearchPageId();
                if (typeof window.dmtrack != "undefined") {
                    setTimeout(function() {
                        dmtrack.clickstat("http://stat.china.alibaba.com/search/queryreport.html", l)
                    }, 10)
                } else {
                    if (document.images) {
                        (new Image()).src = "http://stat.china.alibaba.com/search/queryreport.html" + l + "&t=" + (+new Date)
                    }
                }
            });
            g.on("click", function(k) {
                k.preventDefault();
                var j = c(this);
                var i = j.attr("href");
                setTimeout(function() {
                    window.location.href = i
                }, 50)
            })
        }, end: 0});
    Searchweb.Business.GlobalFunction = e;
    AppCore.register("sw_mod_global", Searchweb.Business.GlobalFunction)
})(jQuery);
!(function(b) {
    var e, a, c = {end: 0};
    function d(f) {
        e = f;
        return d
    }
    b.extend(d, {init: function(f) {
            a = this;
            a.config = b.extend(false, {}, c, f);
            iPageConfig = this.config.global ? this.config.global : window.iPageConfig;
            if (iPageConfig.searchType === "saleoffer" || iPageConfig.searchType === "buyer" || iPageConfig.searchType === "newbuyoffer") {
                a._resize()
            }
            a._isWidth()
        }, _isWidth: function() {
            if (parseInt(window.screen.width, 10) > 1200) {
                Searchweb.Utility.setSWCookie("swIs1200", "1")
            } else {
                Searchweb.Utility.setSWCookie("swIs1200", "0")
            }
        }, _resize: function() {
            b(window).resize(function() {
                var h, g, f = window.innerWidth || document.documentElement.clientWidth;
                if (jQuery.browser.msie) {
                    f = f + 21
                }
                document.body.style.width = "";
                var i = (document.body.className && document.body.className.indexOf("sw-list-") != -1);
                if (f >= 1400) {
                    h = 2
                } else {
                    if (f >= 1280 || i) {
                        h = 1
                    } else {
                        h = 0
                    }
                }
                switch (h) {
                    case 2:
                        g = "s-layout-1390";
                        break;
                    case 1:
                        g = "s-layout-1190";
                        break;
                    case 0:
                        g = "s-layout-990";
                        break;
                    default:
                        g = "s-layout-990";
                        break
                }
                var j = document.body.className;
                j = j.replace(/s-layout-990/, "").replace(/s-layout-1190/, "").replace(/s-layout-1390/, "");
                g = j + " " + g;
                document.body.className = g
            })
        }, end: 0});
    Searchweb.Business.CheckScreenSize = d;
    AppCore.register("sw_mod_checkScreenSize", Searchweb.Business.CheckScreenSize)
})(jQuery);
!(function(c) {
    var e, d = {"topWordModuleDom": "a.sw-mod-topWord-trigger", "tipDom": "div.sw-mod-topWord", end: 0}, a;
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            a = this;
            a.root = c("#header");
            a.trigger = c(d.topWordModuleDom, a.root);
            if (!a.trigger.length) {
                return
            }
            a._bindEvent()
        }, _bindEvent: function() {
            var f = a.trigger.offset(), h = f.left - 270, g = f.top + 13;
            var i = c(d.tipDom, a.root);
            c("body").append(i);
            i.css("left", h);
            i.css("top", g);
            a.trigger.hover(function(j) {
                i.css("display", "block");
                j.stopPropagation()
            }, function(j) {
                j.stopPropagation();
                i.css("display", "none")
            }).click(function(j) {
                j.preventDefault();
                return false
            });
            i.hover(function(j) {
                i.css("display", "block");
                j.stopPropagation()
            }, function(j) {
                i.css("display", "none");
                j.stopPropagation()
            })
        }, end: 0});
    Searchweb.Business.TopWordModule = b;
    AppCore.register("sw_mod_top_word", "Searchweb.Business.TopWordModule")
})(jQuery);
define("search/mod/list/cml/searchbar/common/suggestion-amd", ["jquery", "lofty/alicn/suggestion/2.0/suggestion"], function(e, d) {
    var c = {keywordsContainer: "#s_search_form", suggestionType: "offer"};
    var i, h, f, g, a = false;
    var b = {init: function() {
            i = e(c.keywordsContainer);
            h = e("input[name=keywords]", c.keywordsContainer);
            $submit = e("button[type=submit]", c.keywordsContainer);
            f = e("#swSugesstionActiveLink");
            g = null;
            var k = false;
            if (f.length === 0) {
                f = e("#swSuggestionActiveLink")
            }
            if (f.length > 0) {
                g = {"href": f.attr("linkurl"), "img": f.attr("linkImg"), "text": f.attr("linktext"), "tracelog": f.attr("tracelogStr")};
                k = true
            }
            var l = "";
            var j = new d({mod: l, type: c.suggestionType, target: h, bottomBanner: g, history: true, suggestionDacu: {"linkHref": f.attr("linkurl"), "linkImg": f.attr("linkImg"), "textDes": f.attr("linktext"), "tracelog": f.attr("tracelogStr")}, hasDacu: k, dTop: -3, dLeft: 6, widthFix: 6, suggestTracelogType: "sale_search", suggestTracelogShow: "sale_search_suggest_show", suggestTracelogSubmit: "sale_top_suggest_submit", onSelected: function() {
                    window.fromSuggestion = true;
                    $submit.click()
                }});
            e(".web-suggestion").addClass("web-suggestion-wider")
        }};
    return b
});
!(function(d) {
    var g, b, c = Searchweb.Utility, e = {searchFormId: "#s_search_form", end: 0}, a;
    function f(h) {
        g = h;
        return f
    }
    d.extend(f, {init: function(h) {
            a = this;
            a.config = d.extend(false, {}, e, h);
            a.checkNull = false;
            b = this.config.global ? this.config.global : window.iPageConfig;
            this.categoryChangeInit();
            this.searchTabChangeSubmit();
            this.searchTraceOnsubmit();
            this.addPlaceholder();
            this.formsubmit()
        }, formsubmit: function() {
            d(a.config.searchFormId).submit(function(j) {
                var i = d(this), h = i.find('input[name="_source"]');
                if (window.fromSuggestion) {
                    if (h.length === 0) {
                        i.append('<input type="hidden" name="_source" value="sug" />')
                    }
                    window.fromSuggestion = false
                } else {
                    h.remove()
                }
            })
        }, categoryChangeInit: function() {
            if (d("#searchbar-category").length == 0) {
                return
            }
            var l = d("#searchbar-category"), k = l.find("a"), j = d(k[0]), i = d(k[1]), o = {}, n, m = d("#searchbar-category-newicon"), h = d("#searchbar-category-tips");
            l.find(".searchbar-category-list").bind("mouseenter", function() {
                clearTimeout(n);
                l.addClass("hover")
            });
            l.find(".searchbar-category-list").bind("mouseleave", function() {
                n = setTimeout(function() {
                    l.removeClass("hover")
                }, 0)
            });
            d(a.config.searchFormId + " input").each(function(q, p) {
                o[p.name] = p
            });
            i.bind("click", function(r) {
                r.preventDefault();
                l.removeClass("hover");
                var p = j.html(), q = j.attr("onmousedown");
                j.html(i.html());
                i.html(p);
                j.attr("onmousedown", i.attr("onmousedown"));
                i.attr("onmousedown", q);
                if (p != "������Ŀ") {
                    if (o.categoryId) {
                        o.categoryId.value = ""
                    }
                    if (o.earseDirect) {
                        o.earseDirect.value = "true"
                    }
                } else {
                    if (o.categoryId) {
                        o.categoryId.value = l.attr("categoryid")
                    }
                }
            });
            d("#q").bind("focus", function() {
                if (o.categoryId.value) {
                    var p = unescape(c.getCookie("alicnweb"));
                    if (!p || !/[\|^]categorytips=closed[\|$]/.test(p)) {
                        h.show()
                    }
                }
            });
            d("#searchbar-category-closetips").bind("click", function() {
                h.hide();
                var p = unescape(c.getCookie("alicnweb"));
                if (!p || !/(\|^)categorytips=closed(\|$)/.test(p)) {
                    c.addCookie("alicnweb", p + "categorytips=closed|", ".1688.com")
                }
            })
        }, searchTabChangeSubmit: function() {
            if (d("#s_searchtabList").length == 0) {
                return
            }
            var h = this;
            var i = d("li a", "#s_searchtabList");
            i.bind("click", function(n) {
                if (b.keywords == "") {
                    return
                }
                n.preventDefault();
                if (d("#searchbar-category")) {
                    var m = d("input[name=categoryId]", h.config.searchFormId);
                    m.val("")
                }
                var l = d(h.config.searchFormId);
                var j = d(this).attr("action");
                l.attr("action", j);
                var k = d(this).parents("li:first").attr("data-type");
                h.checkNullInput(k);
                l.submit()
            });
            i.bind("focus", function(j) {
                this.blur()
            })
        }, searchTraceOnsubmit: function() {
            var h = this;
            var i = d(this.config.searchFormId);
            i.bind("submit", function(k) {
                if (!h.hasCheckNull) {
                    h.checkNullInput()
                }
                h.checkInputScaleBuying(k);
                h.disableInput();
                if (b.searchType == "news") {
                    var j = d("input", "#select-option");
                    if (j[0].checked == true) {
                        c.aliclick(this, "?searchtrace=info_top_allinfo")
                    } else {
                        if (j[1].checked == true) {
                            c.aliclick(this, "?searchtrace=info_top_picinfo")
                        }
                    }
                }
            })
        }, disableInput: function() {
            var h = this;
            d("input[type=hidden]", h.config.searchFormId).each(function(j, i) {
                if (d(i).val() === "") {
                    d(i).attr("disabled", "disabled")
                }
            })
        }, checkInputScaleBuying: function(k) {
            if (a.searchType == "selloffer" || a.searchType == "saleoffer") {
                var j = d("#q"), l = j.attr("placeholder"), h = j.val();
                if (!l) {
                    return
                }
                if (d.trim(h) == "" || h == l) {
                    k.preventDefault();
                    var i = document.createElement("a");
                    i.target = "_blank";
                    i.href = j.attr("linkurl");
                    if (j.attr("point")) {
                        c.aliclick(this, "?searchtrace=" + j.attr("point"))
                    }
                    document.body.appendChild(i);
                    i.click();
                    document.body.removeChild(i)
                }
            }
        }, addPlaceholder: function() {
            var i = d("#q"), k = i.attr("placeholder");
            if (!k) {
                return
            }
            this.addExposureClick(i);
            if (i.length > 0 && !("placeholder" in document.createElement("input"))) {
                var j = i.attr("id");
                if (!j) {
                    j = "placeholder_" + new Date().getTime();
                    i.attr("id", j)
                }
                var h = document.createElement("label");
                h.htmlFor = j;
                h.className = "label-placeholder";
                h.style.left = i.position().left + "px";
                i.before(h);
                i.bind("focus", function() {
                    h.innerHTML = ""
                });
                i.bind("blur", function() {
                    if (i.val() == "") {
                        h.innerHTML = k
                    }
                });
                if (i.val() == "") {
                    h.innerHTML = k
                }
            }
        }, addExposureClick: function(h) {
            if (h.val() == "" && h.attr("foodtag") == "true") {
                c.exposureClick("bitchina_searchbar")
            }
            h.bind("blur", function() {
                if (this.value === "" && h.attr("foodtag") == "true") {
                    c.exposureClick("bitchina_searchbar")
                }
            })
        }, checkNullInput: function(h) {
            var k = d("input[name=categoryId]", a.config.searchFormId), i = "";
            if (k.length) {
                i = k.val()
            }
            if (d.trim(d("#q").val()) == "" && i == "") {
                if (!h) {
                    h = b.searchType
                }
                var j = "";
                a.searchType = h;
                if (h == "selloffer" || h == "saleoffer") {
                    j = "http://page.1688.com/buy/index.html"
                } else {
                    if (h == "company") {
                        j = "http://page.1688.com/cp/cp1.html"
                    } else {
                        if (h == "newbuyoffer" || h == "buyoffer") {
                            j = "http://page.1688.com/cp/cp8.html"
                        } else {
                            if (h == "news") {
                                j = "http://info.1688.com/"
                            } else {
                                if (h == "wiki") {
                                    j = "http://baike.1688.com/"
                                } else {
                                    if (h == "forum") {
                                        j = "http://club.1688.com/"
                                    } else {
                                        if (h == "blog") {
                                            j = "http://blog.1688.com/"
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                d(a.config.searchFormId).attr("action", j);
                a.hasCheckNull = true
            }
        }, end: 0});
    Searchweb.Business.Header = f;
    AppCore.register("sw_mod_header", Searchweb.Business.Header)
})(jQuery);
!(function(c) {
    var e, d = {end: 0, eventParentElemId: "#sw_mod_navigatebar"}, a;
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            if (c("#staticCatArea").length == 0) {
                return
            }
            this.config = c.extend(false, {}, d, f);
            this.eventElem = c(this.config.eventParentElemId);
            a = this;
            this.addHoverFunction()
        }, addHoverFunction: function() {
            var f = this.eventElem;
            f.on("mouseenter", "#staticCatArea", function(g) {
                c("div.sw-mod-staticCatoryArea", f).removeClass("fd-hide");
                Searchweb.Utility.exposureClick("Baihuo_cat")
            });
            f.on("mouseleave", null, function(g) {
                c("div.sw-mod-staticCatoryArea", f).addClass("fd-hide")
            })
        }, end: 0});
    Searchweb.Business.NavigateBar = b;
    AppCore.register("sw_mod_navigateBar", Searchweb.Business.NavigateBar)
})(jQuery);
!(function(d) {
    var f, a, b = Searchweb.Utility, e = {triggerId: "#catogoryTipDiv", triggerClass: ".catogoryTipDiv-close", end: 0};
    function c(g) {
        f = g;
        return c
    }
    d.extend(c, {init: function(g) {
            a = this;
            this.config = d.extend(false, {}, e, g);
            a.triggers = d(a.config.triggerId);
            if (a.triggers.length == 0) {
                return
            }
            if (b.getCookie("catogoryTipClosed") == "") {
                a.triggers.show()
            }
            a._bindEvent(a.config.triggerClass)
        }, _bindEvent: function(g) {
            a.triggers.delegate(g, "click", function(h) {
                h.stopPropagation();
                h.preventDefault();
                a.triggers.hide();
                b.addCookie("catogoryTipClosed", "true", ".s.1688.com")
            })
        }, end: 0});
    Searchweb.Business.CatogoryTip = c;
    AppCore.register("sw_mod_catogoryTip", Searchweb.Business.CatogoryTip)
})(jQuery);
!(function($) {
    var Sandbox, iPageConfig, configs = {}, self;
    function NavAttrStorageTrace(sb) {
        Sandbox = sb;
        return NavAttrStorageTrace
    }
    $.extend(NavAttrStorageTrace, {init: function(cfg) {
            self = this;
            this.config = $.extend(false, {}, configs, cfg);
            iPageConfig = self.config.global ? self.config.global : window.iPageConfig;
            self.sn = $("#sw_mod_navigatebar");
            if (!self.sn.length || iPageConfig.searchType != "saleoffer") {
                return
            }
            this._bindEvents()
        }, getSearchPageId: function() {
            return typeof window.dmtrack_pageid == "undefined" ? -1 : dmtrack_pageid
        }, _bindEvents: function() {
            self.sn.on("mousedown", "a.sm-navigatebar-selAttr-link", function() {
                try {
                    var pageId = self.getSearchPageId(), windowUrl = "http://stat.1688.com/search/queryreport.html?searchtrace=cancelfeat&sn_type=cancelfeat&rule_id=126&st_page_id=" + pageId + "&t=" + (new Date()).getTime() + "&from=windowName";
                    window.name = window.name + "|%" + windowUrl
                } catch (ex) {
                    var isIE =
                            /*@cc_on!@*/
                            false, searchtrace = "exception_" + isIE, windowUrl = "http://stat.1688.com/search/queryreport.html?searchtrace=" + searchtrace + "&rule_id=126&st_page_id=" + self.getSearchPageId() + "&sn_type=cancelfeat&sn_id=00002&t=" + (new Date()).getTime();
                    window.name = window.name + "|%" + windowUrl
                }
            })
        }, end: 0});
    Searchweb.Business.NavAttrStorageTrace = NavAttrStorageTrace;
    AppCore.register("sw_mod_navAttrStorageTrace", Searchweb.Business.NavAttrStorageTrace)
})(jQuery);
!(function(e) {
    var g, c = Searchweb.Utility, b, f = {"commonSnRootId": "#sw_mod_sn", "commonSnMoreRootId": "#sw_mod_sn_moreKey", "snMoreKey": "#sw_mod_sn_moreKey", "url": "http://open.s.1688.com/openservice/.htm?serviceIds=cbu.searchweb.offer.featureyinpin.normal&outfmt=jsonp&_output_charset=gbk", end: 0}, a;
    function d(h) {
        g = h;
        return d
    }
    e.extend(d, {init: function(h) {
            a = this;
            this.config = e.extend(false, {}, f, h);
            b = a.config.global ? a.config.global : window.iPageConfig;
            this._bindEvents()
        }, _bindEvents: function() {
            if (!e(this.config.commonSnRootId).length) {
                return
            }
            this._showmoreBtn();
            this._bindSnMoreKey();
            this._bottomMoreBtn();
            this._search();
            this._select();
            this._moreSelect()
        }, _showmoreBtn: function() {
            e(".sw-mod-sn-list-body .sw-mod-sn-showmorebtn", this.config.commonSnRootId).bind("click", function(n) {
                n.preventDefault();
                var q = null;
                var l = e(this).parents(".sw-mod-sn-list-body:first");
                l.toggleClass("sn-morelist");
                if (e(this).html() === "���") {
                    e(this).html("����");
                    if (e(this).attr("moreclk")) {
                        c.aliclick(this, "?searchtrace=" + e(this).attr("moreclk"))
                    }
                    q = e(".sw-mod-sn-search", e(this).parent());
                    if (q.length !== 0) {
                        q.css("display", "block")
                    }
                } else {
                    l.removeClass("sw-mod-sn-list-selected");
                    e(this).html("���");
                    if (e(this).attr("lessclk")) {
                        c.aliclick(this, "?searchtrace=" + e(this).attr("lessclk"))
                    }
                    q = e(".sw-mod-sn-search", e(this).parent());
                    if (q.length !== 0) {
                        var m = e(".sw-mod-sn-search-input", q);
                        var i = m.attr("targetIndex");
                        if (i) {
                            var p = a.targets[i];
                            p.target.val(p.targetPlaceHolder);
                            p.target.addClass("sw-mod-sn-search-input-default");
                            p.targetDes.css("display", "none");
                            for (var k = 0, h = p.targetLiNode.length; k < h; k++) {
                                p.targetLiNode[k].css("display", "")
                            }
                        }
                        q.css("display", "none")
                    }
                }
            })
        }, _bindSnMoreKey: function() {
            if (!e(this.config.snMoreKey).length) {
                return
            }
            var h = e(".sw-mod-sn-moreKey-selectBox", a.snMoreKey);
            var i;
            h.bind("mouseenter", function() {
                var j = e(this);
                i = setTimeout(function() {
                    j.addClass("sw-mod-sn-moreKey-selectBox-hover")
                }, 300)
            });
            h.bind("mouseleave", function() {
                if (i) {
                    clearTimeout(i);
                    var j = e(this);
                    j.removeClass("sw-mod-sn-moreKey-selectBox-hover")
                }
            })
        }, _bottomMoreBtn: function() {
            e("#sw_mod_sn_bottommore").bind("click", function(h) {
                h.preventDefault();
                e(".sw-mod-sn-list-body", a.config.commonSnRootId).toggleClass("sn-attrmorelist");
                e(".sw-mod-sn-multicate", a.config.commonSnRootId).toggleClass("sn-attrmorelist");
                e(this).toggleClass("hide-more");
                if (e(this).html() === "��ʾ���") {
                    e(this).html("������ʾ")
                } else {
                    e(this).html("��ʾ���")
                }
            });
            e("#sm-foldedSN-btnLink").bind("click", function(h) {
                h.preventDefault();
                e(a.config.commonSnRootId).toggleClass("fd-hide");
                e(this).toggleClass("sm-foldedSN-display")
            })
        }, _search: function() {
            a.root = e(a.config.commonSnRootId);
            a.triggers = e(".sw-mod-sn-search-input", a.root);
            if (a.triggers.length === 0) {
                return
            }
            a.targets = [];
            a.targetIndex = 0;
            a.triggers.bind("focus", function(l) {
                var m = {};
                a.targets[a.targetIndex] = m;
                m.target = e(this);
                m.targetPlaceHolder = m.target.attr("placehold");
                if (m.target.val() === m.targetPlaceHolder) {
                    m.target.val("");
                    m.target.removeClass("sw-mod-sn-search-input-default")
                }
                if (m.target.attr("targetIndex")) {
                    return
                }
                m.target.attr("targetIndex", a.targetIndex++);
                m.targetDes = m.target.next();
                m.targetLi = e("ul li", m.target.parents(".sw-mod-sn-list-body:first"));
                m.targetLiNode = [];
                m.targetLiIds = [];
                m.targetLiIdsMap = [];
                for (var k = 0, j = m.targetLi.length; k < j; k++) {
                    var h = e(m.targetLi[k]);
                    var n = h.attr("clickunionid");
                    m.targetLiNode.push(h);
                    m.targetLiIds.push(n);
                    m.targetLiIdsMap[n] = h
                }
            });
            a.triggers.bind("blur", function(h) {
                var i = a._getTarget(this);
                if (i.target.val() === "") {
                    i.target.val(i.targetPlaceHolder);
                    i.target.addClass("sw-mod-sn-search-input-default")
                }
            });
            a.triggers.bind("keyup", function(h) {
                var i = a._getTarget(this);
                a._fetchdata(i)
            })
        }, _getTarget: function(j) {
            var i = e(j);
            var h = i.attr("targetIndex");
            return a.targets[h]
        }, _fetchdata: function(h) {
            var j = {}, i = {};
            i.featureIds = h.targetLiIds.join(";");
            i.word = h.target.val();
            i["_input_charset"] = "utf-8";
            j.data = i;
            j.success = function(k) {
                a._renderView(k, h)
            };
            j.error = function() {
                return
            };
            e.ajax(a.config.url, {data: j.data, dataType: "jsonp", success: function(k) {
                    if (!e.isEmptyObject(k["cbu.searchweb.offer.featureyinpin.normal"].dataSet)) {
                        j.success(k["cbu.searchweb.offer.featureyinpin.normal"].dataSet)
                    } else {
                    }
                }, error: function() {
                    j.error()
                }})
        }, _renderView: function(k, l) {
            for (var m = 0, h = l.targetLiNode.length; m < h; m++) {
                l.targetLiNode[m].css("display", "none")
            }
            if (k.length !== 0) {
                l.targetDes.css("display", "none");
                for (var n = 0, h = k.length; n < h; n++) {
                    l.targetLiIdsMap[k[n]].css("display", "block")
                }
            } else {
                l.targetDes.css("display", "block")
            }
        }, _select: function() {
            e(".sw-mod-sn-list-body .sw-mod-sn-list-select", this.config.commonSnRootId).bind("click", function(j) {
                j.preventDefault();
                var i = e(this);
                var h = i.parents(".sw-mod-sn-list-body:first");
                h.addClass("sn-morelist");
                h.addClass("sw-mod-sn-list-selected");
                var l = e(".sw-mod-sn-showmorebtn", h);
                if (l.html() === "���") {
                    l.html("����")
                } else {
                    var k = e(".sw-mod-sn-search", h);
                    if (k.length !== 0) {
                        k.css("display", "none")
                    }
                }
            });
            e(".sw-mod-sn-list-body .sw-mod-sn-list-btn-submit", this.config.commonSnRootId).bind("click", function(m) {
                m.preventDefault();
                var n = e(this);
                var i = n.parents(".sw-mod-sn-list-body:first");
                var k = e(".sw-mod-sn-list-checkbox", i);
                var p = [];
                k.each(function(r, s) {
                    if (e(s).prop("checked")) {
                        p.push(e(s).attr("catid"))
                    }
                });
                var l = e(".sw-mod-sn-check-lists", a.config.commonSnRootId);
                var h = l.attr("url");
                var q = l.attr("feature");
                var j = l.attr("ctype");
                if (q !== "") {
                    var h = h + "&feature=" + q;
                    if (p.length > 0) {
                        h = h + ";" + p.join(",")
                    }
                } else {
                    if (p.length > 0) {
                        h = h + "&feature=" + p.join(",")
                    }
                }
                var o = "rule_id=946" + "&sn_type=" + j + "&sn_id=" + b.categoryId + "_" + p.join(",");
                c.aliclick(this, "?" + o);
                window.location.href = h
            });
            e(".sw-mod-sn-list-body .sw-mod-sn-list-btn-cancel", this.config.commonSnRootId).bind("click", function(j) {
                j.preventDefault();
                var i = e(this);
                var h = i.parents(".sw-mod-sn-list-body:first");
                h.toggleClass("sn-morelist");
                h.toggleClass("sw-mod-sn-list-selected");
                var k = e(".sw-mod-sn-showmorebtn", h);
                if (k.html() === "���") {
                    k.html("����")
                } else {
                    k.html("���")
                }
            })
        }, _moreSelect: function() {
            e(".sw-mod-sn-moreKey-select", this.config.commonSnMoreRootId).bind("click", function(j) {
                j.preventDefault();
                var i = e(this);
                var h = i.parents(".sw-mod-sn-moreKey-selectBox-bd:first");
                h.addClass("sw-mod-sn-moreKey-selected")
            });
            e(".sw-mod-sn-moreKey-btn-submit", this.config.commonSnRootId).bind("click", function(m) {
                m.preventDefault();
                m.stopPropagation();
                var n = e(this);
                var i = n.parents(".sw-mod-sn-moreKey-selectBox-bd:first");
                var k = e(".sw-mod-sn-moreKey-checkbox", i);
                var p = [];
                k.each(function(r, s) {
                    if (e(s).prop("checked")) {
                        p.push(e(s).attr("catid"))
                    }
                });
                var l = e(".sw-mod-sn-check-lists", a.config.commonSnRootId);
                var h = l.attr("url");
                var q = l.attr("feature");
                var j = l.attr("ctype");
                if (q !== "") {
                    var h = h + "&feature=" + q;
                    if (p.length > 0) {
                        h = h + ";" + p.join(",")
                    }
                } else {
                    if (p.length > 0) {
                        h = h + "&feature=" + p.join(",")
                    }
                }
                var o = "rule_id=946" + "&sn_type=" + j + "&sn_id=" + b.categoryId + "_" + p.join(",");
                c.aliclick(this, "?" + o);
                window.location.href = h
            });
            e(".sw-mod-sn-moreKey-btn-cancel", this.config.commonSnMoreRootId).bind("click", function(j) {
                j.preventDefault();
                j.stopPropagation();
                var i = e(this);
                var h = i.parents(".sw-mod-sn-moreKey-selectBox-bd:first");
                h.toggleClass("sw-mod-sn-moreKey-selected")
            })
        }, end: 0});
    Searchweb.Business.Category = d;
    AppCore.register("sw_mod_sn", Searchweb.Business.Category)
})(jQuery);
!(function(c) {
    var e, b = Searchweb.Utility, d = {"formid": "frmFiltSearch", end: 0};
    function a(f) {
        e = f;
        return a
    }
    c.extend(a, {init: function(f) {
            this.config = c.extend(false, {}, d, f);
            this.iPageConfig = this.config.global ? this.config.global : window.iPageConfig;
            this.form = c("#" + this.config.formid);
            this.init_filter_area()
        }, init_filter_area: function() {
            var f = this, j = c("#" + this.config.id + " .sm-filter-Area-Selected"), g = this.form.find("input[name=province]"), k = this.form.find("input[name=city]"), h = "", l = "";
            districtTrace = "";
            var i = new Searchweb.Widget.Area({id: f.config.id, value: j.html(), prov: g.val(), city: k.val(), onchange: function() {
                    g.val(this.prov);
                    k.val(this.city);
                    if (this.city) {
                        h = "c"
                    }
                    if (this.prov) {
                        l = "p"
                    }
                    if (this.district) {
                        districtTrace = "d"
                    }
                    if (f.iPageConfig.searchType == "company") {
                        var m = this.city ? this.city : this.prov;
                        b.aliclick(this, "?filt_type=area&filt_value=" + m + "&rule_id=1607")
                    } else {
                        b.aliclick(this, "?searchtrace=sale_filt_area_" + (l + h + districtTrace) + "&rule_id=932");
                        b.aliclick(this, "?filt_type=area&filt_linkage=linkage&filt_value=" + (l + h + districtTrace) + "&rule_id=933")
                    }
                    c("#J_submitBtn").click()
                }})
        }, end: 0});
    Searchweb.Business.FilterArea = a;
    AppCore.lazyRegister("sw_mod_filter_area", "Searchweb.Business.FilterArea", "#sw_mod_filter_area", "mouseover", {module: {css: ["http://style.c.aliimg.com/app/search/css/list/cml/filtbar/common/area.css"], js: ["http://style.c.aliimg.com/app/search/js/list/cml/filtbar/common/area.js"]}})
})(jQuery);
!(function(d) {
    var f, b = Searchweb.Utility, a, e = {offerFilter: {id: "#filter_bottom", scrollClass: "filter-bottom-scroll"}, sharedFeaturesFilter: {id: "#sw-mod-shardFeatures", scrollClass: "shardFeatures-scroll"}, end: 0};
    function c(g) {
        f = g;
        return c
    }
    d.extend(c, {init: function(g) {
            a = this;
            this.config = d.extend(false, {}, e, g);
            this.filterScrollEvent()
        }, filterScrollEvent: function() {
            var k = a.config.sharedFeaturesFilter;
            var h = d("#sw_mod_filter");
            var j = d(k.id);
            if (!j.length) {
                k = a.config.offerFilter;
                j = d(k.id);
                if (!j.length) {
                    return
                }
            }
            var l = false;
            if (d.browser.msie) {
                if (parseInt(d.browser.version, 10) <= 6) {
                    l = true
                }
            }
            if (!l) {
                function i() {
                    var m = d(document).scrollTop(), n = parseInt(h.offset().top);
                    return n <= m
                }
                function g() {
                    if (i()) {
                        if (j.css("position") != "fixed") {
                            j.addClass(k.scrollClass)
                        }
                    } else {
                        j.removeClass(k.scrollClass)
                    }
                }
                d(window).bind("scroll", g);
                d(window).bind("resize", g)
            } else {
                return
            }
        }, end: 0});
    Searchweb.Business.FilterScroll = c;
    AppCore.register("sw_mod_filter_scroll", Searchweb.Business.FilterScroll)
})(jQuery);
!(function(c) {
    var e, d = {id: "#distanceSelect", distanceSelectDom: "#distanceSelect", rootId: "#content", parentId: ".sm-filter-distanceSelet", formId: "#frmFiltSearch", url: "http://service.map.1688.com/map/hollywood/product/handleJsonp.htm?prodid=822&ip=", end: 0}, a;
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            if (c(d.parentId).length == 0) {
                return
            }
            this.config = c.extend(false, {}, d, f);
            iPageConfig = this.config.global ? this.config.global : window.iPageConfig;
            var g = c(this.config.id);
            a = this;
            a.location = g.attr("location");
            a.form = c("#frmFiltSearch");
            if (iPageConfig.clientIp == "" || iPageConfig.clientIp == "127.0.0.1") {
                a.failure = 1;
                a._getIPFailure(g)
            } else {
                a.disSelLayer = new Searchweb.Widget.OverflowLayer({"offset": [-180, 30], "triggerElement": d.distanceSelectDom, "rootId": d.rootId, "width": 250, "renderTime": 0, "loadingState": false, "arrowPosition": "topRightArrow"});
                g.on("mouseenter", null, a._sendURL)
            }
        }, _sendURL: function() {
            var f = d.url + iPageConfig.clientIp, g = c(a.config.id);
            c.ajax(f, {dataType: "jsonp", success: function(h) {
                    if (typeof h.data.address == "undefined" || typeof h.data.latitude == "undefined" || typeof h.data.longitude == "undefined") {
                        a.failure = 2;
                        a._getIPFailure(g)
                    } else {
                        if (a.location) {
                            a.address = a.location
                        } else {
                            a.address = h.data.address
                        }
                        a.latitude = h.data.latitude;
                        a.longitude = h.data.longitude;
                        a._getIPSuccess(g)
                    }
                    g.off("mouseenter", null, a._sendURL)
                }, error: function() {
                    a._getIPFailure(g)
                }})
        }, _getIPFailure: function(h) {
            h.attr("class", "sw-mod-distanceSelect");
            var f = this, g = '<div class="sw-mod-distanceSelect-tip" trace="disfeedback"><p class="sm-distanceSelect-tip-text sm-distanceSelect-tip-address">�Բ��𣬻�ȡ��ĳ���ʧ��</p><p class="sm-distanceSelect-tip-text"><a target="_blank" href="http://club.china.alibaba.com/forum/thread/add.html?forum_id=100753&tracelog=search_ssbj">������������Ǹ��Ʋ�Ʒ��</a></p></div>';
            if (f.failure == 1) {
                f.disSelLayer = new Searchweb.Widget.OverflowLayer({"offset": [-100, 25], "triggerElement": f.config.id, "rootId": f.config.rootId, "width": 250, "loadingState": false, "arrowPosition": "topRightArrow2"})
            }
            f.disSelLayer.renderDataToLayer(g);
            h.on("mouseenter", null, function(i) {
                f.disSelLayer.renderDataToLayer(g)
            })
        }, _getIPSuccess: function(h) {
            var g = this, f = h.attr("initialClass");
            if (f == "") {
                h.attr("class", "sw-mod-distanceSelect-IP");
                f = "sw-mod-distanceSelect-IP"
            }
            g.templateData = '<div class="sw-mod-distanceSelect-tip" trace="disfeedback"><p class="sm-distanceSelect-tip-text sm-distanceSelect-tip-address">��ǰ���ڳ���</p><p class="sm-distanceSelect-tip-text">' + g.address + '&nbsp;<input type="button" value="���" class="sm-distanceSelct-Btn" id="sm-distanceSelct-Btn"/></p><p class="sm-distanceSelect-tip-text fd-hide"><input type="text" value="" class="sm-distanceSelct-Input" id="sm-distanceSelct-Input"/></p></div>';
            g.form = c(g.config.formId);
            var i = g._getDistance(f);
            g._renderView(g, i);
            g._bindIPEvent(h, f)
        }, _inputAddressSubmit: function(g) {
            if (g.which == "13") {
                var f = c.trim(c("#sm-distanceSelct-Input").val());
                if (f != "") {
                    a.form.find("input[name=location]").val(f);
                    a.form.find("input[type=hidden]").each(function(i, h) {
                        var j = c(this);
                        if (j.val() === "") {
                            j.attr("disabled", "disabled")
                        }
                    });
                    a.form.submit()
                }
            }
        }, _bindIPEvent: function(h, f) {
            var g = this;
            h.on("mouseenter", "a", function(k) {
                var j = c(this), i = j.attr("index"), l = j.attr("dis");
                h.attr("class", "sw-mod-distanceSelect-IPdis" + i);
                g._renderView(g, l)
            });
            h.on("mouseleave", null, function(i) {
                h.attr("class", f);
                var j = g._getDistance(f);
                g._renderView(g, j);
                setTimeout(function() {
                    c("#sm-distanceSelct-Btn").bind("click", function(l) {
                        var k = c(this).parent();
                        k.next("p.sm-distanceSelect-tip-text").removeClass("fd-hide").end().hide()
                    });
                    c("#sm-distanceSelct-Input").bind("keydown", g._inputAddressSubmit)
                }, 130)
            });
            h.on("click", "a", function(l) {
                var i = c(this), j = i.attr("dis"), k = g.form.find("input[name=longi]"), n = g.form.find("input[name=lati]"), m = g.form.find("input[name=dis]");
                k.val(g.longitude);
                n.val(g.latitude);
                m.val(j);
                c("#J_submitBtn").click()
            })
        }, _getDistance: function(f) {
            var g = 0;
            switch (f) {
                case"sw-mod-distanceSelect-IPdis1":
                    g = 50;
                    break;
                case"sw-mod-distanceSelect-IPdis2":
                    g = 100;
                    break;
                case"sw-mod-distanceSelect-IPdis3":
                    g = 200;
                    break;
                case"sw-mod-distanceSelect-IPdis4":
                    g = 300;
                    break;
                case"sw-mod-distanceSelect-IPdis5":
                case"sw-mod-distanceSelect-IP":
                    g = "unlimited"
            }
            return g
        }, _renderView: function(f, h) {
            var g = "";
            if (h == "unlimited") {
                g = '<div class="sw-mod-distanceSelct-tipDis"><p class="sm-distanceSelct-tipDis-text sm-distance-unlimitedDis">����<br/>����</p></div>'
            } else {
                g = '<div class="sw-mod-distanceSelct-tipDis"><p class="sm-distanceSelct-tipDis-text"><span class="sm-distanceSelct-tipDisFont">' + h + '����</span></p><p class="sm-distanceSelct-tipDis-text">���ڲ�Ʒ</p></div>'
            }
            g += f.templateData;
            f.disSelLayer.renderDataToLayer(g)
        }, end: 0});
    Searchweb.Business.DistanceSelect = b;
    AppCore.register("sw_mod_distanceSelect", "Searchweb.Business.DistanceSelect")
})(jQuery);
!(function(c) {
    var e, b = Searchweb.Utility, d = {"formid": "#frmFiltSearch", "submit": "#J_submitBtn", end: 0};
    function a(f) {
        e = f;
        return a
    }
    c.extend(a, {init: function(f) {
            this.config = c.extend(false, {}, d, f);
            this.filter = c("#" + this.config.id);
            this.filter.addClass("sm-mod-currentType");
            this.form = c(this.config.formid);
            this.inputFilter()
        }, inputFilter: function() {
            this.init_filter_select();
            this.init_checkbox();
            this.init_sort();
            this.disableEmptyInput();
            this.configCheckbox()
        }, init_filter_select: function() {
            var h = ["#filter_biztype", "#filter_employeesCount", "#filter_annualRevenue"];
            for (var k = 0, g = h.length; k < g; k++) {
                var f = h[k];
                this.filter.find(f).bind("mouseover", function(i) {
                    i.preventDefault();
                    i.stopPropagation();
                    c(this).find(".sw-ui-selectItems").show()
                });
                this.filter.find(f).bind("mouseout", function(i) {
                    i.preventDefault();
                    i.stopPropagation();
                    c(this).find(".sw-ui-selectItems").hide()
                })
            }
            var j = this;
            this.filter.find("ul.sw-ui-selectItems li a").bind("click", function(o) {
                o.preventDefault();
                var l = c(this).parents("ul:first");
                var i = c(this).parents("li:first");
                var n = c(l).attr("_frmfield");
                l.hide();
                var m = c(this).attr("val");
                j.form.find("input[name=" + n + "]").val(m);
                if (n === "biztype" && j.form.find("input[name=" + n + "]").val() === "1") {
                    j.form.find("input[name=sortType]").val("manufacture")
                }
                c(j.config.submit).click()
            })
        }, configCheckbox: function() {
            var f = this;
            c("#sw_mod_filter").on("click", ".sm-filter-check-box-config input", function() {
                var m = c(this).attr("_frmfield"), l = c(this).attr("union") === "true" ? true : false, h = c("#sw_mod_filter .sm-filter-check-box-config input:checked"), k = "";
                for (var j = 0, g = h.length; j < g; j++) {
                    if (j !== 0) {
                        k += (c(h[j]).attr("union") === "true" ? "|" : ",")
                    }
                    k += c(h[j]).attr("_frmvalue")
                }
                f.form.find("input[name=" + m + "]").val(k);
                c(f.config.submit).click()
            })
        }, init_checkbox: function() {
            var h = ["#J_ckbWangWang", "#filter_ckbtrueLocation", "#filter_ckbSurence"];
            var f = this;
            for (var g = 0; g < h.length; g++) {
                var j = h[g];
                f.filter.find(j).bind("click", function() {
                    var k = c(this).attr("_frmfield");
                    var i = c(this).attr("val");
                    f.form.find("input[name=" + k + "]").val(this.checked ? i : "");
                    c(f.config.submit).click()
                })
            }
        }, init_sort: function() {
            var h = ["#filter_popSort", "#filter_cxtSort"];
            var f = this;
            for (var g = 0; g < h.length; g++) {
                var j = h[g];
                f.filter.find(j).bind("click", function(m) {
                    m.preventDefault();
                    var l = c(this).attr("_frmfield");
                    var k = c(this).attr("val");
                    var n = c(this).attr("disval");
                    var i = c(this).attr("checked");
                    f.form.find("input[name=" + l + "]").val(i === "checked" ? n : k);
                    if (f.form.find("input[name=biztype]").val() === "1") {
                        f.form.find("input[name=biztype]").val("0")
                    }
                    c(f.config.submit).click()
                })
            }
        }, disableEmptyInput: function() {
            var f = this;
            c(f.config.submit).bind("click", function() {
                f.disableInput()
            })
        }, disableInput: function() {
            c("input[type=hidden]", this.config.formid).each(function(g, f) {
                if (c(f).val() === "") {
                    c(f).attr("disabled", "disabled")
                }
            })
        }, end: 0});
    Searchweb.Business.Filter = a;
    AppCore.register("sw_mod_filter", Searchweb.Business.Filter)
})(jQuery);
(function() {
    var b = window.ZHUQUEX;
    if (b === undefined) {
        b = {cfg_def: {v: 1, noTRU: false, service: "cmweb", ie: "utf-8"}, pageId: "", cfg: "", guid: 0, init: function(q, i) {
                var l = ['<iframe frameborder="0" border="0" scrolling="no" width="'], s = this.genGuid(), a, p = (location.hostname == document.domain) ? "" : "document.domain=&#34;" + document.domain + "&#34;;", o = "<!DOCTYPE html PUBLIC \\'-//W3C//DTD XHTML 1.0 Transitional//EN\\' \\'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\\'><html><head><meta http-equiv=&#34;Content-Type&#34; content=&#34;text/html; charset=utf-8&#34; /></head><body onload=\\'try{" + p + "window.parent.ZHUQUEX.func_" + s + "(window,document);}catch(e){};\\'></body></html>";
                if (!this.pageId) {
                    this.pageId = window.dmtrack_pageid ? window.dmtrack_pageid : ""
                }
                q.pageid = this.pageId;
                for (var m in this.cfg_def) {
                    if (q[m] === undefined) {
                        q[m] = this.cfg_def[m]
                    }
                }
                l.push(q.width, '" height="', q.height, '" id="', s, '" src="javascript:var d=window.document;d.open();d.write(\'', o, "');d.close();\"", "></iframe>");
                this["func_" + s] = function(e, c) {
                    var d = this.getRequestURL(q);
                    this.initIframe(s, e, c, d, q.width, q.height)
                };
                if (!q.container) {
                    document.write(l.join(""))
                } else {
                    if (q.container.constructor === String) {
                        a = document.getElementById(q.container)
                    } else {
                        a = q.container
                    }
                    a.innerHTML = l.join("")
                }
                if (/Firefox/.test(navigator.userAgent)) {
                    var r = document.getElementById(s);
                    r.contentWindow.location.replace(r.src)
                }
                this.cfg = q
            }, initIframe: function(d, a, i, l, k, j) {
                a.render = this.proxy(this.runIframe, a);
                a.iframeID = d;
                a.iframeWidth = k;
                a.iframeHeight = j;
                this.addScript(i, l)
            }, proxy: function(e, f) {
                var a = function() {
                    return e.apply(f, arguments)
                };
                a.guid = e.guid = e.guid || a.guid || this.guid++;
                return a
            }, extend: function() {
                var a, s, u, t, m, o = arguments[0] || {}, q = 1, r = arguments.length, i = false, p = this;
                if (typeof o === "boolean") {
                    i = o;
                    o = arguments[1] || {};
                    q = 2
                }
                if (r === q) {
                    o = this;
                    --q
                }
                for (; q < r; q++) {
                    if ((a = arguments[q]) != null) {
                        for (s in a) {
                            u = o[s];
                            t = a[s];
                            if (o === t) {
                                continue
                            }
                            if (i && t && (typeof t === "object")) {
                                m = u || {};
                                o[s] = ZQ.extend(i, m, t)
                            } else {
                                if (t !== undefined) {
                                    o[s] = t
                                }
                            }
                        }
                    }
                }
                return o
            }, runIframe: function(a) {
                if (!a) {
                    return
                }
                if (!this.ZQ) {
                    this.ZQ = this.parent.ZHUQUEX
                }
                if (ZQ._debug) {
                    this.adData = this.parent.DATA
                } else {
                    this.adData = a
                }
                if (this.ZQ.cfg.customeData) {
                    this.adData = this.ZQ.extend(true, this.adData, this.ZQ.cfg.customeData)
                }
                if (this.ZQ.cfg.afterInit) {
                    this.ZQ.cfg.afterInit.call(this.ZQ, this.adData)
                }
                this.ZQ.addScript(this.document, this.adData.render)
            }, addScript: function(d, f) {
                var a = d.createElement("script");
                d.getElementsByTagName("head")[0].appendChild(a);
                a.type = "text/javascript";
                a.charset = "utf-8";
                a.src = f
            }, resize: function(h, e, a) {
                try {
                    var j = h.document.getElementById(e);
                    if (a.width !== undefined) {
                        j.style.width = a.width + "px"
                    }
                    if (a.height !== undefined) {
                        j.style.height = a.height + "px"
                    }
                } catch (i) {
                }
            }, getRequestURL: function(p) {
                var q = "", a = document.referrer, m = "", e, t, s, r, u = navigator.userAgent.indexOf("MSIE") !== -1;
                if (!p.noTRU) {
                    try {
                        q = window.top.location.href;
                        if (window.top == window.self) {
                            m = document.title
                        } else {
                            m = window.parent.document.title
                        }
                    } catch (o) {
                    }
                    if (q) {
                        p.url = q;
                        p.refer = a;
                        p.pt = m
                    }
                }
                e = this.encodeUrl(p);
                if (!p.noTRU) {
                    if (u) {
                        r = 2048
                    } else {
                        r = 4096
                    }
                    s = e.length - r;
                    while (s > 0) {
                        if (p.pt) {
                            p.pt = p.pt.substr(0, parseInt(p.pt.length - s / 30))
                        } else {
                            if (p.refer) {
                                p.refer = p.refer.substr(0, p.refer.length - s)
                            } else {
                                if (p.url) {
                                    p.url = p.url.substr(0, p.url.length - s)
                                }
                            }
                        }
                        e = this.encodeUrl(p);
                        s = e.length - r
                    }
                }
                return e
            }, encodeUrl: function(j) {
                var a = {cmweb: "http://cmweb.ilike.1688.com/cmweb", discover: "http://discover.china.alibaba.com", map: "http://service.map.1688.com/map"}, g = [], h = "";
                for (var i in j) {
                    switch (i) {
                        case"container":
                        case"type":
                        case"width":
                        case"height":
                        case"noTRU":
                        case"service":
                            continue;
                        default:
                            n = i
                    }
                    g.push(n + "=" + encodeURIComponent(j[i]))
                }
                return a[j.service] + "/hollywood/product/handleJsonp.htm?" + g.join("&")
            }, genGuid: function() {
                var a = "zq_cnt_" + this.guid;
                this.guid++;
                return a
            }};
        window.ZHUQUEX = b;
        if (!window.ZQX) {
            window.ZQX = b
        }
        if (!window.ZQ) {
            window.ZQ = b
        }
    }
})();
!(function(c) {
    var a = {end: 0};
    function b(f, e) {
        this.init(f, e)
    }
    function d(g) {
        var f = "";
        for (var e = g.length; e--; ) {
            f += c.parseJSON(c(g[e]).attr("alitalk").replace(/'/g, '"')).id + ";"
        }
        return f
    }
    c.extend(b.prototype, {init: function(f, e) {
            this.config = c.extend(false, {}, a, e);
            this.iPageConfig = this.config.global ? this.config.global : window.iPageConfig;
            this.triggers = c("a[alitalk]", f);
            if (this.triggers.length == 0) {
                return
            }
            this._bindEvent(this.triggers)
        }, _bindEvent: function(g) {
            var e = this;
            var h = "cnalichn";
            if (this.iPageConfig && this.iPageConfig.alitalkSiteId) {
                h = this.iPageConfig.alitalkSiteId
            }
            var f = d(g);
            c.ajax({url: "http://amos.alicdn.com/muliuserstatus.aw", dataType: "jsonp", data: {beginnum: 0, uids: f, site: h || "cnalichn", charset: "utf-8"}, timeout: 30000, success: function(p) {
                    if (!p.success) {
                        return
                    }
                    var k = p.data.reverse();
                    for (var o = 0, j = g.length; o < j; o++) {
                        var m = c(g[o]), q = (m.hasClass("sw-ui-icon-ww-off-s") || m.hasClass("sw-ui-icon-ww-online-s") || m.hasClass("sw-ui-icon-ww-phone-s")) ? "-s" : "", l = {on: "sw-ui-icon-ww-online" + q, off: "sw-ui-icon-ww-off" + q, mb: "sw-ui-icon-ww-phone" + q};
                        switch (k[o]) {
                            case 0:
                            case 2:
                            case 6:
                                m.removeClass(l.on + " " + l.mb).addClass(l.off).attr("title", "\u5bf9\u65b9\u79bb\u7ebf\uff0c\u8bf7\u70b9\u51fb\u7559\u8a00").data("alitalk.online", 0);
                                break;
                            case 4:
                            case 5:
                                m.removeClass(l.on + " " + l.off).addClass(l.mb).attr("title", "\u8be5\u7528\u6237\u4e3a\u624b\u673a\u5728\u7ebf\uff0c\u70b9\u6b64\u9ed8\u8ba4\u53d1\u9001\u79bb\u7ebf\u6d88\u606f\uff0c\u4e5f\u53ef\u9009\u62e9\u7ed9\u5bf9\u65b9\u53d1\u9001\u77ed\u4fe1\u54a8\u8be2\u4ea7\u54c1\uff0c\u4ea4\u6d41\u6d3d\u8c08").data("alitalk.online", 1);
                                break;
                            case 1:
                                m.removeClass(l.mb + " " + l.off).addClass(l.on).attr("title", "\u70b9\u6b64\u53ef\u76f4\u63a5\u4e0e\u5bf9\u65b9\u5728\u7ebf\u54a8\u8be2\u4ea7\u54c1\u3001\u4ea4\u6d41\u6d3d\u8c08\u3002\u8fd8\u652f\u6301\u8bed\u97f3\u89c6\u9891\u548c\u591a\u65b9\u5546\u52a1\u6d3d\u8c08").data("alitalk.online", 1);
                                break
                            }
                    }
                }});
            FE.util.alitalk(g, {remote: false, prop: function() {
                    var E = c(this).data("alitalk");
                    var t = c(this).data("alitalk.online");
                    var v = E.id;
                    var o = E.type.toLowerCase();
                    var D = E.memberLevel || "";
                    var i = E.infoId;
                    var q = E.pos;
                    var u = E.p4pKeywords;
                    var s = v;
                    var j = i;
                    var y = 1;
                    var B = new Date();
                    if (document.images) {
                        (new Image()).src = "http://page.1688.com/others/offeralitalkclick.htm?online=" + t + "&type=" + o + "list&member=" + D + "&time=" + B.getTime()
                    }
                    var r = Searchweb.Utility.getMemberId();
                    if (r != "") {
                        var C = [];
                        C.push("?fromId=" + r);
                        C.push("toId=" + s);
                        C.push("offerId=" + j);
                        C.push("source=" + y);
                        C.push("cna=" + (Searchweb.Utility.getCookie("cna") || ""));
                        var w = "";
                        if (j && j != "") {
                            w = "http://detail.1688.com/buyer/offerdetail/" + j + ".html"
                        }
                        C.push("sourceUrl=" + w);
                        if (typeof window.dmtrack != "undefined") {
                            dmtrack.clickstat("http://interface.xp.1688.com/eq/enquiry/traceEnquiry.json", C.join("&"))
                        } else {
                            if (document.images) {
                                (new Image()).src = "http://interface.xp.1688.com/eq/enquiry/traceEnquiry.json" + C.join("&") + "&time=" + B.getTime()
                            }
                        }
                    }
                    var x = "http://stat.1688.com/feedback/click.html?";
                    if (e.iPageConfig.searchType == "saleoffer") {
                        var k = "searchsell"
                    }
                    if (e.iPageConfig.searchType == "company") {
                        var k = "companylist"
                    }
                    var l = "";
                    try {
                        l = document.cookie.match(/track_cookie[^;]*cosite=(\w+)/)[1];
                        if (!l) {
                            l = ""
                        }
                    } catch (A) {
                    }
                    x = x + "type=alitalk&sourcetype=" + k + "&memberLevel=" + D + "&toid=" + s + "&fromsite=" + l;
                    if (document.images) {
                        (new Image()).src = x + "&time=" + B.getTime()
                    }
                    var z = "";
                    var p = "&url1=http://amis1.sh1.china.alibaba.com/potentialContact.dll?";
                    if (i && i.length > 0) {
                        z += "&gid=" + i + p + "offerId=" + i
                    }
                    z += "&info_id=" + i;
                    if (q && q != "") {
                        var m = "p4p_offerid=" + i + "#p4p_pageid=" + Searchweb.Utility.getSearchPageId() + "#p4p_keywords=" + escape(u) + "#p4p_pos=" + q + "#p4p_pid=819010_1008";
                        z += m
                    }
                    return z
                }})
        }, _delayBindEvent: function(e, f) {
            var g = c("a[alitalk]", e);
            Searchweb.Utility.uniqueMerge(g, f);
            if (g.length == 0) {
                return
            }
            this._bindEvent(g)
        }, end: 0});
    Searchweb.Business.Alitalk = b
})(jQuery);
!(function(e) {
    var g, b, a = Searchweb.Utility, c = false, f = {end: 0};
    function d(h) {
        g = h;
        return d
    }
    e.extend(d, {init: function(h) {
            b = this;
            this.config = e.extend(false, {}, f, h);
            a.isSupportAll(function(i) {
                if (i) {
                    c = true
                } else {
                    c = false
                }
            }, ["lossy", "lossless"]);
            this.registerEvent("#sw_mod_searchlist");
            g.on([Searchweb.Config.Events.BigRender, Searchweb.Config.Events.OfferAsyncOffer], function(i) {
                b.registerEvent("#sw_mod_searchlist")
            })
        }, registerEvent: function(h) {
            AppCore.lazyRegister("sw-mod-imagelazyload", null, e(h + " img[data-lazyload-src]"), "exposure", {keep: true, threshold: 200, callback: function(i) {
                    src = e(i).attr("data-lazyload-src");
                    if (src) {
                        if (c) {
                            src = src + "_.webp"
                        }
                        e(i).attr("src", src);
                        e(i).removeAttr("data-lazyload-src")
                    }
                }})
        }, end: 0});
    Searchweb.Business.imageLazyLoad = d;
    AppCore.register("sw_mod_imageLazyLoad", Searchweb.Business.imageLazyLoad)
})(jQuery);
!(function(c) {
    var e, a, d = {end: 0};
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            a = this;
            a.config = c.extend(false, {}, d, f);
            a.root = c("#sw_mod_searchlist");
            if (a.root.length > 0) {
                var h = new Searchweb.Business.Alitalk(a.root, f);
                var g = c("a[alitalk]", a.root);
                e.on([Searchweb.Config.Events.BigRender, Searchweb.Config.Events.OfferAsyncOffer], function(i) {
                    h._delayBindEvent(a.root, g);
                    g = c("a[alitalk]", a.root)
                })
            }
        }, end: 0});
    Searchweb.Business.MaindataAlitalk = b;
    AppCore.register("sw_mod_maindataAlitalk", Searchweb.Business.MaindataAlitalk)
})(jQuery);
!(function(d) {
    var f = {"offset": [3, 5], "triggerElement": "", "rootId": "", "width": 100, "arrowPosition": "topLeftArrow", "renderTime": 300, "loadingState": true, "offsetTime": 100, end: 0};
    function c(h) {
        this.init(h)
    }
    d.extend(c.prototype, {init: function(h) {
            this.config = d.extend(true, {}, f, h);
            this.isPop = false;
            this.popLayerClass = "div.sm-offerResult-shopflowLayer";
            this._bindEvent()
        }, _bindEvent: function() {
            this._createLayerAndBindEvent()
        }, _createWrap: function() {
            var j = d("div.sm-offerResult-shopflowLayer");
            if (j.length > 0) {
                return j
            }
            var j = d('<div class="sm-offerResult-shopflowLayer"><div class="sm-offerResult-shopflowLayerLine"></div><div class="sw-ui-overflowLayer-body"></div></div>').appendTo("body"), h = this, m = d('<div class="sw-ui-overflowLayer-loading"><img src="http://img.china.alibaba.com/cms/upload/search/searchweb/common/loading.gif" /></div>').css({height: "40px", textAlign: "center", paddingTop: "20px"});
            if (h.config.loadingState) {
                m.appendTo(j)
            }
            var k = h.config.content;
            if (k) {
                d(k).appendTo(".sw-ui-overflowLayer-body", j)
            }
            var i = h.config.borderClass;
            if (i) {
                j.addClass(i)
            }
            var l = h.config.callBack;
            if (l) {
                l()
            }
            d(h.popLayerClass).bind({mouseenter: function() {
                    h.isPop = true;
                    b.trigger.addClass("sm-offerResult-totalShopHover")
                }, mouseleave: function() {
                    h.isPop = false;
                    if (d(this)) {
                        d(this).remove();
                        b.trigger.removeClass("sm-offerResult-totalShopHover")
                    }
                }});
            return j
        }, _createLayerAndBindEvent: function() {
            var i = this;
            var h = i.config.rootId || "body";
            d(h).on("mouseenter", i.config.triggerElement, function() {
                var k = d(this), j = k.offset();
                i.timer = setTimeout(function() {
                    if (i.config.direction == "up" && i.config.borderClass == "yellowBorder") {
                        i.layer = i._createWrap().css({top: j.top - i.config.offset[1], left: j.left + i.config.offset[0], width: i.config.width, border: "1px solid #ffcc7f"})
                    } else {
                        i.layer = i._createWrap().css({top: j.top + i.config.offset[1], left: j.left + i.config.offset[0], width: i.config.width})
                    }
                    i.isPop = true
                }, i.config.renderTime)
            });
            d(h).on("mouseleave", i.config.triggerElement, function() {
                var j = d(this);
                i.isPop = false;
                clearTimeout(i.timer);
                if (i.layer) {
                    i.layer.delay(100).promise().then(function() {
                        if (!i.isPop) {
                            i.layer.remove()
                        }
                    })
                }
            })
        }, renderDataToLayer: function(j) {
            var h = this, i = h.config;
            setTimeout(function() {
                if (d("div.sw-ui-overflowLayer-loading").length) {
                    d("div.sw-ui-overflowLayer-loading").remove()
                }
                if (d("div.sw-ui-overflowLayer-body").length) {
                    d("div.sw-ui-overflowLayer-body").html(j)
                }
            }, i.renderTime + i.offsetTime)
        }, end: 0});
    Searchweb.Widget.ShopFlowLayer = c;
    var g, a, e = {url: "http://open.s.1688.com/openservice/.htm?serviceIds=cbu.searchweb.company.enterprise.normal&outfmt=jsonp&_output_charset=gbk", rootId: "#sw_mod_searchlist", triggerClassname: ".sm-offerResult-totalShop", end: 0};
    function b(h) {
        g = h;
        return b
    }
    d.extend(b, {init: function(h) {
            a = this;
            a.config = d.extend(false, {}, e, h);
            a.root = d(a.config.rootId);
            a.triggers = d(a.config.triggerClassname, a.root);
            a.iPageConfig = a.config.global ? a.config.global : window.iPageConfig;
            if (a.triggers.length !== 0) {
                a.hotShopPreviewLayer = new Searchweb.Widget.ShopFlowLayer({"offset": [0, 22], "triggerElement": a.config.triggerClassname, "rootId": a.config.rootId, "arrowPosition": "topRightArrow", "width": 525, renderTime: 150, offsetTime: 0, end: 0});
                a._bindEvent(a.config.triggerClassname)
            }
        }, _bindEvent: function(h) {
            d(a.config.rootId).delegate(h, "mouseenter", function() {
                var i = d(this);
                a.target = this;
                a.trigger = i;
                a.trigger.addClass("sm-offerResult-totalShopHover");
                a._fetchdata.call(i)
            });
            d(a.config.rootId).delegate(h, "mouseleave", function() {
                var i = d(this);
                a.trigger = i;
                a.trigger.removeClass("sm-offerResult-totalShopHover")
            })
        }, _fetchdata: function() {
            var k = this;
            var j = {}, i = {};
            var h = k.attr("enterpriseid");
            var l = k.attr("companyname");
            a.offerId = k.attr("offer-id");
            i.enterpriseId = h;
            if (!a.trace) {
                a.trace = a._node("span", null, {"class": "fd-hide", "offer-id": a.offerId, "offerid": "", "end": 0});
                d("#" + a.offerId).append(a.trace)
            }
            j.data = i;
            j.success = function(m) {
                a._renderView(m)
            };
            j.error = function() {
            };
            d.ajax(a.config.url, {data: j.data, dataType: "jsonp", success: function(m) {
                    if (!d.isEmptyObject(m["cbu.searchweb.company.enterprise.normal"].dataSet)) {
                        j.success(m["cbu.searchweb.company.enterprise.normal"].dataSet)
                    } else {
                        a.hotShopPreviewLayer.renderDataToLayer("���޸��������Ϣ��")
                    }
                }, error: function() {
                    j.error()
                }})
        }, _renderView: function(i) {
            if (i.members.length === 0) {
                return
            }
            var h = '<div id="sm_offerresult_moreShopBox" class="sm-offerresult-moreShopBox"><table><tr><th class="sm-offerresult-moreShopBoxHdName">����</th><th class="sm-offerresult-moreShopBoxHdTrade">����꽻�ױ���</th><th class="sm-offerresult-moreShopBoxHdArea">���е���</th><th class="sm-offerresult-moreShopBoxHdSale">��Ӫ��Ʒ</th></tr><% for ( var i = 0,len=$data.members.length; i < len; i++ ) { %><% if(i == len-1){ %><tr class="sm-offerresult-moreShopLast" ><% }else{%><tr><% }%><td><p><a offer-id="' + a.offerId + '" offer-p4p="winport" target="_blank" offer-stat="winport" href="<% =$data.members[i].nameUrl %>"><% =$data.members[i].shopName %></a></p></td><td><p><% =$data.members[i].bookedCount %></p></td><td><p><% =$data.members[i].area %></p></td><td class="nowrapTd"><p><a offer-id="' + a.offerId + '" offer-p4p="wpproduct" target="_blank" offer-stat="wpproduct" href="<% =$data.members[i].productUrl %>"><% =$data.members[i].product %></a></p></td></tr><% } %></table><% if( $data.showMore==true){ %><div class="sm-offerresult-moreShopLink"><a offer-id="' + a.offerId + '" offer-p4p="wpmore" target="_blank" href="<% =$data.showMoreUrl %>" offer-stat="wpmore">�������</a></div><% } %></div>';
            d.use("web-sweet", function() {
                var j = FE.util.sweet(h).applyData(i);
                a.hotShopPreviewLayer.renderDataToLayer(j);
                setTimeout(function() {
                    a._traceLogHover(a.target);
                    var k = d("#sm_offerresult_moreShopBox a");
                    k.bind("click", function(p) {
                        var o = d(this);
                        var m = o.attr("offer-stat");
                        d(a.trace).attr("offer-stat", m);
                        if (d.browser.msie) {
                            a.trace.click()
                        } else {
                            if (typeof document.createEvent !== "undefined") {
                                var l = document.createEvent("MouseEvents");
                                l.initEvent("click", true, true);
                                a.trace.dispatchEvent(l)
                            }
                        }
                    })
                }, 1000)
            })
        }, _traceLogHover: function(i) {
            if (d.browser.msie) {
                i.click()
            } else {
                if (typeof document.createEvent !== "undefined") {
                    var h = document.createEvent("MouseEvents");
                    h.initEvent("click", true, true);
                    i.dispatchEvent(h)
                }
            }
        }, _node: function(o, m, h) {
            var l = document.createElement(o);
            if (h !== null) {
                for (var k in h) {
                    if (k == "end") {
                        break
                    }
                    if (k == "class") {
                        l.className = h[k]
                    } else {
                        l.setAttribute(k, h[k])
                    }
                }
            }
            if (m !== null) {
                for (var j = 0; j < m.length; j++) {
                    l.appendChild(m[j])
                }
            }
            return l
        }, end: 0});
    Searchweb.Business.HotShop = b;
    AppCore.lazyRegister("sw_mod_hotShop", "Searchweb.Business.HotShop", "#sw_mod_searchlist", "mouseover")
})(jQuery);
!(function(b) {
    var e, d = {end: 0, eventParentElemId: "#sw_mod_searchlist"}, a;
    function c(f) {
        e = f;
        return c
    }
    b.extend(c, {init: function(f) {
            this.config = b.extend(false, {}, d, f);
            this.eventElem = b(this.config.eventParentElemId);
            a = this;
            a._initShower()
        }, _initShower: function() {
            b(a.config.eventParentElemId).on("mouseenter", "div.sm-offerResult-photos", a._showMoreLink);
            b(a.config.eventParentElemId).on("mouseleave", "div.sm-offerResult-photos", a._hideMoreLink);
            b(a.config.eventParentElemId).on("mouseenter", "div.sm-offerResult-photoBox", a._newVerOfferEnterCallBack);
            b(a.config.eventParentElemId).on("mouseleave", "div.sm-offerResult-photoBox", a.__newVerOfferOutCallBack)
        }, _newVerOfferEnterCallBack: function(g) {
            var f = b(this);
            a._setFloatAreaHeight(f);
            f.find("div.sm-offer-floatArea").show().next("div.sm-offer-floatAreaText").show().next("div.sm-offer-saleCount").show()
        }, _showMoreLink: function(f) {
            b(this).find("div.sm-offer-moreProLinkDiv").show()
        }, _hideMoreLink: function(f) {
            b(this).find("div.sm-offer-moreProLinkDiv").hide()
        }, _setFloatAreaHeight: function(f) {
            if (f.find("div.sm-offer-floatArea").data("setHeight") == true) {
                return
            } else {
                var g = f.find("div.sm-offer-floatAreaText").height() + 5;
                f.find("div.sm-offer-floatArea").height(g).data("setHeight", true)
            }
        }, __newVerOfferOutCallBack: function(f) {
            b(this).find("div.sm-offer-floatArea").hide().next("div.sm-offer-floatAreaText").hide().next("div.sm-offer-saleCount").hide()
        }, end: 0});
    Searchweb.Business.FloatDivShower = c;
    AppCore.register("sw_mod_floatDivShower", "Searchweb.Business.FloatDivShower")
})(jQuery);
!(function(b) {
    var e, a, c = {url: "http://tpview.1688.com/tp_combine_info.htm?combine=logo;period&logo.type=small_search&memberIds=", rootId: "#sw_mod_searchlist", triggerClassname: ".sw-ui-icon-cxt16x16", targetClassname: ".sm-offerResult-totalShop", end: 0};
    function d(f) {
        e = f;
        return d
    }
    b.extend(d, {init: function(h) {
            a = this;
            a.config = b.extend(false, {}, c, h);
            a.iPageConfig = a.config.global ? a.config.global : window.iPageConfig;
            a.root = b(a.config.rootId);
            a.triggers = b(a.config.triggerClassname, a.root);
            a.targets = b(a.config.targetClassname, a.root);
            if (a.targets.length === 0) {
                return
            }
            var g, j, l;
            a.memberIds = [];
            a.offerIds = [];
            for (var k = 0, f = a.targets.length; k < f; k++) {
                l = b(a.targets[k]);
                g = l.attr("memberid");
                j = l.attr("offer-id");
                a.memberIds.push(g);
                a.offerIds.push(j)
            }
            a._fetchdata()
        }, _fetchdata: function() {
            var g = {}, f = {};
            g.data = f;
            g.success = function(h) {
                a._renderView(h)
            };
            g.error = function() {
            };
            b.ajax(a.config.url + a.memberIds.join(";"), {data: g.data, dataType: "jsonp", success: function(h) {
                    g.success(h)
                }, error: function() {
                    g.error()
                }})
        }, _renderView: function(l) {
            var k = null, m = null, j, h = null;
            for (var g = 0, f = a.memberIds.length; g < f; g++) {
                k = l[a.memberIds[g]];
                m = k.period;
                j = m.year;
                h = b("#" + a.offerIds[g] + " " + a.config.triggerClassname + " em");
                h.text(j)
            }
        }, end: 0});
    Searchweb.Business.HotShopYears = d;
    AppCore.register("sw_mod_hotShopYears", Searchweb.Business.HotShopYears)
})(jQuery);
!(function(c) {
    var e, d = {"requestUrl": "http://service.s.1688.com/company/rpc/get/medal.jsonp", "id": "sw_mod_xunjiadan", "rootId": "#sw_mod_searchlist", "triggerClassname": "a.sw-ui-icon-xjd", end: 0}, b;
    function a(f) {
        e = f;
        return a
    }
    c.extend(a, {init: function(f) {
            b = this;
            b.config = c.extend(true, {}, d, f);
            b.iPageConfig = b.config.global ? b.config.global : window.iPageConfig;
            c(b.config.rootId).delegate(b.config.triggerClassname, "click", b.showDialog)
        }, showDialog: function(g) {
            g.preventDefault();
            if (c("#" + b.config.id).length == 0) {
                var f = '<div id="' + b.config.id + '" class="sw-ui-block"> <div class="wrap"> <div class="title fd-clr"> <h3>����ѯ�۵�</h3> <a tabindex="9000" class="close" href="#"></a> </div> <div class="box"> </div> </div> </div>';
                c(document.body).append(f);
                c(".close", "#" + b.config.id).click(function(h) {
                    h.preventDefault();
                    c("#" + b.config.id).dialog("close");
                    c("#" + b.config.id).hide()
                })
            }
            c.use("ui-dialog", function() {
                c("#" + b.config.id).dialog({draggable: false, shim: true, modal: false, center: true, open: function() {
                    }})
            });
            b.updateIframe(this)
        }, updateIframe: function(i) {
            var g = "";
            if (b.iPageConfig.searchType == "saleoffer") {
                g = "offer_search"
            } else {
                if (b.iPageConfig.searchType == "company") {
                    g = "company_search"
                }
            }
            var f = "";
            if (c(i).attr("memberid")) {
                f = "&supplierVaccountId=" + c(i).attr("memberid")
            }
            c(".box", "#" + b.config.id).empty();
            var h = '<iframe scrolling="no" width="100%" height="566" frameborder="0"src="http://go.1688.com/buyoffer/post_offer.htm?formType=simple&sourceType=' + g + f + '"></iframe>';
            c(".box", "#" + b.config.id).append(h)
        }, end: 0});
    Searchweb.Business.Inquiry = a;
    AppCore.lazyRegister("sw_mod_inquiry", "Searchweb.Business.Inquiry", "#sw_mod_searchlist", "mouseover")
})(jQuery);
!(function(c) {
    var e, a, d = {url: "http://s.1688.com/rpc/CompanyOvInfoService.html?", rootId: "#sw_mod_searchlist", triggerClassname: ".sw-ui-icon-trueLocation", end: 0};
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            a = this;
            a.config = c.extend(false, {}, d, f);
            a.root = c(a.config.rootId);
            a.triggers = c(a.config.triggerClassname, a.root);
            a.iPageConfig = a.config.global ? a.config.global : window.iPageConfig;
            if (a.triggers.length !== 0) {
                a.previewLayer = new Searchweb.Widget.OverflowLayer({"offset": [0, 23], "triggerElement": a.config.triggerClassname, "rootId": a.config.rootId, "width": 280, renderTime: 150, offsetTime: 0, end: 0});
                a._bindEvent(a.config.triggerClassname)
            }
        }, _bindEvent: function(f) {
            c(a.config.rootId).delegate(f, "mouseover", function() {
                var g = c(this);
                a._fetchdata(g)
            })
        }, _fetchdata: function(i) {
            var h = {}, g = {};
            var f = i.attr("memberId");
            a.offerId = i.attr("offer-id");
            a.href = i.attr("href");
            if (!a.trace) {
                a.trace = a._node("span", null, {"class": "fd-hide", "offer-id": a.offerId, "offerid": "", "offer-stat": "shidirenzhengpic", "end": 0});
                c("#" + a.offerId).append(a.trace)
            }
            h.data = g;
            h.success = function(j) {
                a._renderView(j)
            };
            h.error = function() {
            };
            Searchweb.Utility.getRPCJsonp(a.config.url + "memberId=" + f, h)
        }, _renderView: function(g) {
            if (g.length === 0) {
                return
            }
            var f = '<div id="sm_offerresult_trueLocationBox" class="sm-offerresult-trueLocationBox"><ul class="fd-clr"><% for ( var i = 0,len=$data.data.length; i < len; i++ ) { %><li><div class="sm-offerresult-trueLocationPhoto sw-ui-photo64"><a offer-id="' + a.offerId + '" offer-p4p="sdpspic" class="sw-ui-photo64-box" href="<% =$data.data[i].href %>" target="_blank"><img src="<% =$data.data[i].img %>"></a></div><div offer-id="' + a.offerId + '" offer-p4p="sdpspic" class="sm-offerresult-trueLocationTitle"><a href="<% =$data.data[i].href %>" target="_blank"><% =$data.data[i].title %></a></div></li><% } %></ul><div class="sm-offerresult-trueLocationTotal"><a offer-id="' + a.offerId + '" offer-p4p="sdpspic" href="' + a.href + '" target="_blank">�鿴ȫ����Ƭ</a></div></div>';
            c.use("web-sweet", function() {
                var h = FE.util.sweet(f).applyData(g);
                a.previewLayer.renderDataToLayer(h);
                setTimeout(function() {
                    var i = c("#sm_offerresult_trueLocationBox a");
                    i.bind("click", function(k) {
                        if (c.browser.msie) {
                            a.trace.click()
                        } else {
                            if (typeof document.createEvent !== "undefined") {
                                var j = document.createEvent("MouseEvents");
                                j.initEvent("click", true, true);
                                a.trace.dispatchEvent(j)
                            }
                        }
                    })
                }, 1000)
            })
        }, _node: function(l, k, f) {
            var j = document.createElement(l);
            if (f !== null) {
                for (var h in f) {
                    if (h == "end") {
                        break
                    }
                    if (h == "class") {
                        j.className = f[h]
                    } else {
                        j.setAttribute(h, f[h])
                    }
                }
            }
            if (k !== null) {
                for (var g = 0; g < k.length; g++) {
                    j.appendChild(k[g])
                }
            }
            return j
        }, end: 0});
    Searchweb.Business.TrueLocation = b;
    AppCore.lazyRegister("sw_mod_trueLocation", "Searchweb.Business.TrueLocation", "#sw_mod_searchlist", "mouseover")
})(jQuery);
!(function(c) {
    var e, a, d = {rootId: "#sw_mod_searchlist", triggerClassname: ".sm-offerResult-mapaddress", end: 0, url: "http://service.map.1688.com/map/hollywood/product/handleJsonp.htm?prodid=822&ip="};
    function b(f) {
        e = f;
        return b
    }
    c.extend(b, {init: function(f) {
            a = this;
            a.config = c.extend(false, {}, d, f);
            iPageConfig = this.config.global ? this.config.global : window.iPageConfig;
            a.root = c(a.config.rootId);
            var g = a.config.triggerClassname;
            a.triggers = c(g, a.root);
            if (a.triggers.length == 0 || iPageConfig.clientIp == "" || iPageConfig.clientIp == "127.0.0.1") {
                return
            }
            a.companyDisMapLayer = new Searchweb.Widget.OverflowLayer({"offset": [-14, 18], "triggerElement": g, "rootId": a.config.rootId, "width": 640, "content": "<div class='sm-offerResult-mapLayerHd'>��ͼ</div><div id='hw_div'></div>", "loadingState": false, renderTime: 250, offsetTime: 0, end: 0});
            a._bindEvent(g)
        }, _bindEvent: function(f) {
            c(a.config.rootId).delegate(f, "mouseenter", function() {
                var h = c(this);
                if (!a.latitude) {
                    var g = a.config.url + iPageConfig.clientIp;
                    c.ajax(g, {dataType: "jsonp", success: function(i) {
                            if (typeof i.data.latitude == "undefined" || typeof i.data.longitude == "undefined") {
                                return
                            } else {
                                a.latitude = i.data.latitude;
                                a.longitude = i.data.longitude;
                                a._fetchdata.call(h)
                            }
                        }})
                } else {
                    a._fetchdata.call(h)
                }
            })
        }, _scroll: function(g) {
            var f = g.closest("li.sm-offerResult");
            c("html,body").animate({"scrollTop": f.offset().top}, 1000)
        }, _tracelog: function() {
        }, _fetchdata: function() {
            var h = this, f = h.attr("memberid"), g = h.attr("companyaddress");
            lat = a.latitude, lon = a.longitude, customLatlon = lat + "," + lon;
            setTimeout(function() {
                ZQX.init({prodid: 899, container: "hw_div", width: 620, height: 398, customLatlon: customLatlon, memberIds: f, address: g, service: "map", appfrom: "searchweb|http://stat.china.alibaba.com/search/queryreport.html?click_item=mapbubble&rule_id=72"});
                a._scroll(h)
            }, 300)
        }, _searchtraceClick: function() {
        }, _searchtraceExpose: function() {
        }, end: 0});
    Searchweb.Business.PreviewCompanyDisMap = b;
    AppCore.lazyRegister("sm-offerResult-mapaddress", "Searchweb.Business.PreviewCompanyDisMap", "#sw_mod_searchlist", "mouseover")
})(jQuery);
!(function(c) {
    var f, b, a = Searchweb.Utility, e = {end: 0};
    function d(g) {
        f = g;
        return d
    }
    c.extend(d, {init: function(g) {
            this.config = c.extend(false, {}, e, g);
            b = this.config.global ? this.config.global : window.iPageConfig;
            this.ctr();
            var h = this
        }, ctr: function() {
            if (typeof window.companyCoaseParam !== "object") {
                return
            }
            window.companyCoaseParam.page_id = a.getSearchPageId();
            window.companyCoaseParam.refer = escape(window.location.href);
            var k = "http://ctr.1688.com/ctr.html?ctr_type={ctr_type}&page_area={page_area}&page_id={page_id}&category_id={category_id}&object_type={object_type}&object_ids={object_ids}&keyword={keyword}&page_size={page_size}&page_no={page_no}&refer={refer}", g = "offer";
            if (window.companyCoaseParam.fnType == "companyoffer") {
                g = "offer"
            }
            if (window.companyCoaseParam.object_ids && window.companyCoaseParam.object_ids != "") {
                var l = c.extend(true, {}, {"object_type": g, "ctr_type": "2", "page_area": "3", "object_ids": window.companyCoaseParam.object_ids}, window.companyCoaseParam);
                var j = c.util.substitute(k, l);
                h(j)
            }
            if (window.companyCoaseParam.gold_ad_ids && window.companyCoaseParam.gold_ad_ids != "") {
                var i = c.extend(true, {}, {"page_area": 3, "object_ids": window.companyCoaseParam.gold_ad_ids, "ctr_type": 2, "object_type": "company", "page_size": "", "page_no": ""}, window.companyCoaseParam);
                var j = c.util.substitute(k, i);
                h(j)
            }
            function h(m) {
                var o = new Date().getTime();
                if (document.images) {
                    (new Image()).src = m + "&time=" + o
                }
            }}
        , end: 0});
    Searchweb.Business.companyOfferSearchPV = d;
    AppCore.register("sw_mod_companyOfferSearchPV", Searchweb.Business.companyOfferSearchPV)
})(jQuery);
!(function(b) {
    var e, d = {"rootId": "#sw_mod_pagination_content", "formId": "#sw_mod_pagination_form", "submitId": "#jumpto"}, a;
    function c(f) {
        e = f;
        return c
    }
    b.extend(c, {init: function(f) {
            a = this;
            this.config = b.extend(false, {}, d, f);
            a.submit = b(a.config.submitId);
            a.form = b(a.config.formId);
            a.root = b(a.config.rootId);
            a._pageSelectInit();
            a._bindEvent()
        }, _pageSelectInit: function() {
            if (a.submit.length == 0) {
                return
            }
            var i = /^[1-9]+\d*$/, h = "", g = null;
            g = a.submit.attr("data-max");
            function f() {
                if (this.value) {
                    if (i.test(this.value)) {
                        if (g && parseInt(this.value) > g) {
                            this.value = h
                        }
                        h = this.value
                    } else {
                        this.value = h
                    }
                } else {
                    h = ""
                }
            }
            this.config.dom.on("keyup", a.config.submitId, f);
            this.config.dom.on("blur", a.config.submitId, f)
        }, _bindEvent: function() {
            a.root.delegate("div.page-bottom a", "click", function(f) {
                f.preventDefault();
                a.submit.val((b(this).attr("beginPage")));
                a.form.submit()
            });
            a.form.submit(function() {
                b(this).attr("action", a._buildActionUrl(b(this).attr("action"), a.submit.val()));
                a.submit.attr("disabled", "disabled")
            })
        }, _buildActionUrl: function(f, g) {
            if (f.indexOf("?") == -1) {
                return f + "?" + "beginPage=" + g
            } else {
                return f + "&" + "beginPage=" + g
            }
        }, end: 0});
    Searchweb.Business.Pagination = c;
    AppCore.register("sw_mod_pagination", Searchweb.Business.Pagination)
})(jQuery);