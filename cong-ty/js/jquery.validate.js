(function(a) {
    a.extend(a.fn, {validate: function(b) {
            if (!this.length) {
                b && b.debug && window.console && console.warn("nothing selected, can't validate, returning nothing");
                return
            }
            var c = a.data(this[0], "validator");
            if (c) {
                return c
            }
            c = new a.validator(b, this[0]);
            a.data(this[0], "validator", c);
            if (c.settings.onsubmit) {
                this.find("input, button").filter(".cancel").click(function() {
                    c.cancelSubmit = true
                });
                if (c.settings.submitHandler) {
                    this.find("input, button").filter(":submit").click(function() {
                        c.submitButton = this
                    })
                }
                this.submit(function(d) {
                    if (c.settings.debug) {
                        d.preventDefault()
                    }
                    function e() {
                        if (c.settings.submitHandler) {
                            if (c.submitButton) {
                                var f = a("<input type='hidden'/>").attr("name", c.submitButton.name).val(c.submitButton.value).appendTo(c.currentForm)
                            }
                            c.settings.submitHandler.call(c, c.currentForm);
                            if (c.submitButton) {
                                f.remove()
                            }
                            return false
                        }
                        return true
                    }
                    if (c.cancelSubmit) {
                        c.cancelSubmit = false;
                        return e()
                    }
                    if (c.form()) {
                        if (c.pendingRequest) {
                            c.formSubmitted = true;
                            return false
                        }
                        return e()
                    } else {
                        c.focusInvalid();
                        return false
                    }
                })
            }
            return c
        }, valid: function() {
            if (a(this[0]).is("form")) {
                return this.validate().form()
            } else {
                var c = true;
                var b = a(this[0].form).validate();
                this.each(function() {
                    c &= b.element(this)
                });
                return c
            }
        }, removeAttrs: function(d) {
            var b = {}, c = this;
            a.each(d.split(/\s/), function(e, f) {
                b[f] = c.attr(f);
                c.removeAttr(f)
            });
            return b
        }, rules: function(e, b) {
            var g = this[0];
            if (e) {
                var d = a.data(g.form, "validator").settings;
                var i = d.rules;
                var j = a.validator.staticRules(g);
                switch (e) {
                    case"add":
                        a.extend(j, a.validator.normalizeRule(b));
                        i[g.name] = j;
                        if (b.messages) {
                            d.messages[g.name] = a.extend(d.messages[g.name], b.messages)
                        }
                        break;
                    case"remove":
                        if (!b) {
                            delete i[g.name];
                            return j
                        }
                        var h = {};
                        a.each(b.split(/\s/), function(k, l) {
                            h[l] = j[l];
                            delete j[l]
                        });
                        return h
                    }
            }
            var f = a.validator.normalizeRules(a.extend({}, a.validator.metadataRules(g), a.validator.classRules(g), a.validator.attributeRules(g), a.validator.staticRules(g)), g);
            if (f.required) {
                var c = f.required;
                delete f.required;
                f = a.extend({required: c}, f)
            }
            return f
        }});
    a.extend(a.expr[":"], {blank: function(b) {
            return !a.trim("" + b.value)
        }, filled: function(b) {
            return !!a.trim("" + b.value)
        }, unchecked: function(b) {
            return !b.checked
        }});
    a.validator = function(b, c) {
        this.settings = a.extend(true, {}, a.validator.defaults, b);
        this.currentForm = c;
        this.init()
    };
    a.validator.format = function(b, c) {
        if (arguments.length == 1) {
            return function() {
                var d = a.makeArray(arguments);
                d.unshift(b);
                return a.validator.format.apply(this, d)
            }
        }
        if (arguments.length > 2 && c.constructor != Array) {
            c = a.makeArray(arguments).slice(1)
        }
        if (c.constructor != Array) {
            c = [c]
        }
        a.each(c, function(d, e) {
            b = b.replace(new RegExp("\\{" + d + "\\}", "g"), e)
        });
        return b
    };
    a.extend(a.validator, {defaults: {messages: {}, groups: {}, rules: {}, errorClass: "error", validClass: "valid", errorElement: "label", focusInvalid: true, errorContainer: a([]), errorLabelContainer: a([]), onsubmit: true, ignore: [], ignoreTitle: false, onfocusin: function(c) {
                if (c.type == "text" && c.defaultValue && c.className.indexOf("grayColor") >= 0 && c.value == c.defaultValue) {
                    a(c).removeClass("grayColor");
                    c.value = ""
                }
                if (c.tagName.toLowerCase() == "textarea" && c.className.indexOf("grayColor") >= 0) {
                    var b = a(c).attr("_tip");
                    var d = new RegExp("^\\s(" + b + ")\\s*$");
                    if (b == c.innerHTML.replace(d, "$1")) {
                        a(c).removeClass("grayColor");
                        c.innerHTML = ""
                    }
                }
                this.lastActive = c;
                if (this.settings.focusCleanup && !this.blockFocusCleanup) {
                    this.settings.unhighlight && this.settings.unhighlight.call(this, c, this.settings.errorClass, this.settings.validClass);
                    this.errorsFor(c).hide()
                }
            }, onfocusout: function(b) {
                this.element(b)
            }, onkeyup: function(b) {
                if (b.name in this.submitted || b == this.lastElement) {
                    this.element(b)
                }
            }, onclick: function(b) {
                if (b.name in this.submitted) {
                    this.element(b)
                } else {
                    if (b.parentNode.name in this.submitted) {
                        this.element(b.parentNode)
                    }
                }
            }, highlight: function(d, b, c) {
                a(d).addClass(b).removeClass(c)
            }, unhighlight: function(d, b, c) {
                a(d).removeClass(b).addClass(c)
            }}, setDefaults: function(b) {
            a.extend(a.validator.defaults, b)
        }, messages: {required: "This field is required.", remote: "Please fix this field.", email: "Please enter a valid email address.", url: "Please enter a valid URL.", date: "Please enter a valid date.", dateISO: "Please enter a valid date (ISO).", number: "Please enter a valid number.", digits: "Please enter only digits.", creditcard: "Please enter a valid credit card number.", equalTo: "Please enter the same value again.", accept: "Please enter a value with a valid extension.", maxlength: a.validator.format("Please enter no more than {0} characters."), minlength: a.validator.format("Please enter at least {0} characters."), rangelength: a.validator.format("Please enter a value between {0} and {1} characters long."), range: a.validator.format("Please enter a value between {0} and {1}."), max: a.validator.format("Please enter a value less than or equal to {0}."), min: a.validator.format("Please enter a value greater than or equal to {0}.")}, autoCreateRanges: false, prototype: {init: function() {
                this.labelContainer = a(this.settings.errorLabelContainer);
                this.errorContext = this.labelContainer.length && this.labelContainer || a(this.currentForm);
                this.containers = a(this.settings.errorContainer).add(this.settings.errorLabelContainer);
                this.submitted = {};
                this.valueCache = {};
                this.pendingRequest = 0;
                this.pending = {};
                this.invalid = {};
                this.reset();
                var c = (this.groups = {});
                a.each(this.settings.groups, function(i, j) {
                    a.each(j.split(/\s/), function(l, k) {
                        c[k] = i
                    })
                });
                var h = this.settings.rules;
                a.each(h, function(j, m) {
                    h[j] = a.validator.normalizeRule(m);
                    var l = a("#" + j), k = l[0];
                    if (!l.attr("_nonumber")) {
                        if (k && k.type.toLowerCase() === "textarea") {
                            var i = 500;
                            if (parseInt(l.attr("maxlength")) > 0) {
                                i = l.attr("maxlength")
                            }
                            var n = "<div style='color:#777'><span id='" + j + "_count'>" + b(k.value) + "</span>/<span>" + i + "</span><div>";
                            l.after(n);
                            f(j, j + "_count")
                        }
                    }
                });
                function b(m) {
                    m = m || "";
                    m = a.trim(m);
                    var l = 0;
                    var k = navigator.userAgent;
                    for (var j = 0; j < m.length; j++) {
                        if ((k.indexOf("MSIE 6") > 0 || k.indexOf("MSIE 7") > 0 || k.indexOf("MSIE 8") > 0) && m.charCodeAt(j) == 13) {
                            l++
                        }
                    }
                    return m.length - l
                }
                function g(l) {
                    l = l || "";
                    var k = 0;
                    for (var j = 0; j < l.length; j++) {
                        if (l.charCodeAt(j) > 127 || l.charCodeAt(j) == 94) {
                            k += 2
                        } else {
                            k++
                        }
                    }
                    return k
                }
                function f(k, j) {
                    var i = a("#" + k)[0], l = a("#" + j)[0];
                    i.onkeyup = function(m) {
                        d(i, m, l)
                    };
                    i.onkeydown = function(m) {
                        d(i, m, l)
                    };
                    i.onkeypress = function(m) {
                        d(i, m, l)
                    }
                }
                function d(i, j, k) {
                    j = j || window.event;
                    a(k).html(b(i.value))
                }
                function e(k) {
                    var j = a.data(this[0].form, "validator"), i = "on" + k.type.replace(/^validate/, "");
                    j.settings[i] && j.settings[i].call(j, this[0])
                }
                a(this.currentForm).validateDelegate(":text, :password, :file, select, textarea", "focusin focusout keyup", e).validateDelegate(":radio, :checkbox, select, option", "click", e);
                if (this.settings.invalidHandler) {
                    a(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler)
                }
            }, form: function() {
                a(this.currentForm).find(":text").each(function() {
                    if (this.value == this.defaultValue && this.className.indexOf("grayColor") >= 0) {
                        this.value = ""
                    }
                });
                a(this.currentForm).find("textarea").each(function() {
                    var b = a(this).attr("_tip");
                    var c = new RegExp("^\\s(" + b + ")\\s*$");
                    if (b == this.innerHTML.replace(c, "$1")) {
                        this.innerHTML = ""
                    }
                });
                this.checkForm();
                a.extend(this.submitted, this.errorMap);
                this.invalid = a.extend({}, this.errorMap);
                if (!this.valid()) {
                    a(this.currentForm).triggerHandler("invalid-form", [this])
                }
                this.showErrors();
                return this.valid()
            }, checkForm: function() {
                this.prepareForm();
                for (var b = 0, c = (this.currentElements = this.elements()); c[b]; b++) {
                    this.check(c[b], true)
                }
                return this.valid()
            }, element: function(c) {
                c = this.clean(c);
                this.lastElement = c;
                this.prepareElement(c);
                this.currentElements = a(c);
                var b = this.check(c);
                if (b) {
                    delete this.invalid[c.name]
                } else {
                    this.invalid[c.name] = true
                }
                if (!this.numberOfInvalids()) {
                    this.toHide = this.toHide.add(this.containers)
                }
                this.showErrors();
                return b
            }, showErrors: function(c) {
                if (c) {
                    a.extend(this.errorMap, c);
                    this.errorList = [];
                    for (var b in c) {
                        this.errorList.push({message: c[b], element: this.findByName(b)[0]})
                    }
                    this.successList = a.grep(this.successList, function(d) {
                        return !(d.name in c)
                    })
                }
                this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
            }, resetForm: function() {
                if (a.fn.resetForm) {
                    a(this.currentForm).resetForm()
                }
                this.submitted = {};
                this.prepareForm();
                this.hideErrors();
                this.elements().removeClass(this.settings.errorClass)
            }, numberOfInvalids: function() {
                return this.objectLength(this.invalid)
            }, objectLength: function(d) {
                var c = 0;
                for (var b in d) {
                    c++
                }
                return c
            }, hideErrors: function() {
                this.addWrapper(this.toHide).hide()
            }, valid: function() {
                return this.size() == 0
            }, size: function() {
                return this.errorList.length
            }, focusInvalid: function() {
                if (this.settings.focusInvalid) {
                    try {
                        a(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
                    } catch (b) {
                    }
                }
            }, findLastActive: function() {
                var b = this.lastActive;
                return b && a.grep(this.errorList, function(c) {
                    return c.element.name == b.name
                }).length == 1 && b
            }, elements: function() {
                var c = this, b = {};
                return a([]).add(this.currentForm.elements).filter(":input").not(":submit, :reset, :image, [disabled]").not(this.settings.ignore).filter(function() {
                    !this.name && c.settings.debug && window.console && console.error("%o has no name assigned", this);
                    if (this.name in b || !c.objectLength(a(this).rules())) {
                        return false
                    }
                    b[this.name] = true;
                    return true
                })
            }, clean: function(b) {
                return a(b)[0]
            }, errors: function() {
                return a(this.settings.errorElement + "." + this.settings.errorClass, this.errorContext)
            }, reset: function() {
                this.successList = [];
                this.errorList = [];
                this.errorMap = {};
                this.toShow = a([]);
                this.toHide = a([]);
                this.currentElements = a([])
            }, prepareForm: function() {
                this.reset();
                this.toHide = this.errors().add(this.containers)
            }, prepareElement: function(b) {
                this.reset();
                this.toHide = this.errorsFor(b)
            }, toDBC: function(d) {
                var f = "12288,65281,65283,65285,65286,65287,65288,65289,65290,65291,65292,65293,65294,65295,65306,65307,65308,65309,65310,65311,65312,65339,65340,65341,65342,65343,65344,65371,65372,65373,65374,";
                var e = d;
                var b = "";
                for (var c = 0; c < e.length; c++) {
                    if (e.charCodeAt(c) == 12288) {
                        b += String.fromCharCode(e.charCodeAt(c) - 12256);
                        continue
                    }
                    if (f.indexOf("," + e.charCodeAt(c) + ",") > 0) {
                        b += String.fromCharCode(e.charCodeAt(c) - 65248)
                    } else {
                        b += String.fromCharCode(e.charCodeAt(c))
                    }
                }
                d = b;
                return d
            }, check: function(b, g) {
                b = this.clean(b);
                if (g) {
                    if (b.type == "text" || b.type == "textarea") {
                        var h = a("input[name='" + b.name + "']");
                        if (h.length > 1) {
                            for (var d = 0; d < h.length; d++) {
                                h[d].value = this.toDBC(h[d].value)
                            }
                        } else {
                            b.value = this.toDBC(b.value)
                        }
                    }
                }
                if (this.checkable(b)) {
                    b = this.findByName(b.name)[0]
                }
                var k = a(b).rules();
                var l = false;
                for (method in k) {
                    var j = {method: method, parameters: k[method]};
                    try {
                        var m = a.validator.methods[method].call(this, b.value.replace(/\r/g, ""), b, j.parameters);
                        if (m == "dependency-mismatch") {
                            l = true;
                            continue
                        }
                        l = false;
                        if (m == "pending") {
                            this.toHide = this.toHide.not(this.errorsFor(b));
                            return
                        }
                        if (!m) {
                            this.formatAndAdd(b, j);
                            return false
                        }
                    } catch (f) {
                        this.settings.debug && window.console && console.log("exception occured when checking element " + b.id + ", check the '" + j.method + "' method", f);
                        throw f
                    }
                }
                if (l) {
                    return
                }
                if (this.objectLength(k)) {
                    this.successList.push(b)
                }
                return true
            }, customMetaMessage: function(b, d) {
                if (!a.metadata) {
                    return
                }
                var c = this.settings.meta ? a(b).metadata()[this.settings.meta] : a(b).metadata();
                return c && c.messages && c.messages[d]
            }, customMessage: function(c, d) {
                var b = this.settings.messages[c];
                return b && (b.constructor == String ? b : b[d])
            }, findDefined: function() {
                for (var b = 0; b < arguments.length; b++) {
                    if (arguments[b] !== undefined) {
                        return arguments[b]
                    }
                }
                return undefined
            }, defaultMessage: function(b, c) {
                return this.findDefined(this.customMessage(b.name, c), this.customMetaMessage(b, c), !this.settings.ignoreTitle && b.title || undefined, a.validator.messages[c], "<strong>Warning: No message defined for " + b.name + "</strong>")
            }, formatAndAdd: function(c, e) {
                var d = this.defaultMessage(c, e.method), b = /\$?\{(\d+)\}/g;
                if (typeof d == "function") {
                    d = d.call(this, e.parameters, c)
                } else {
                    if (b.test(d)) {
                        d = jQuery.format(d.replace(b, "{$1}"), e.parameters)
                    }
                }
                this.errorList.push({message: d, element: c});
                this.errorMap[c.name] = d;
                this.submitted[c.name] = d
            }, addWrapper: function(b) {
                if (this.settings.wrapper) {
                    b = b.add(b.parent(this.settings.wrapper))
                }
                return b
            }, defaultShowErrors: function() {
                for (var c = 0; this.errorList[c]; c++) {
                    var b = this.errorList[c];
                    this.settings.highlight && this.settings.highlight.call(this, b.element, this.settings.errorClass, this.settings.validClass);
                    this.showLabel(b.element, b.message)
                }
                if (this.errorList.length) {
                    this.toShow = this.toShow.add(this.containers)
                }
                if (this.settings.success) {
                    for (var c = 0; this.successList[c]; c++) {
                        this.showLabel(this.successList[c])
                    }
                }
                if (this.settings.unhighlight) {
                    for (var c = 0, d = this.validElements(); d[c]; c++) {
                        this.settings.unhighlight.call(this, d[c], this.settings.errorClass, this.settings.validClass)
                    }
                }
                this.toHide = this.toHide.not(this.toShow);
                this.hideErrors();
                this.addWrapper(this.toShow).show()
            }, validElements: function() {
                return this.currentElements.not(this.invalidElements())
            }, invalidElements: function() {
                return a(this.errorList).map(function() {
                    return this.element
                })
            }, showLabel: function(c, d) {
                var b = this.errorsFor(c);
                if (b.length) {
                    b.removeClass().addClass(this.settings.errorClass);
                    b.attr("generated") && b.html(d)
                } else {
                    b = a("<" + this.settings.errorElement + "/>").attr({"for": this.idOrName(c), generated: true}).addClass(this.settings.errorClass).html(d || "");
                    if (this.settings.wrapper) {
                        b = b.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()
                    }
                    if (!this.labelContainer.append(b).length) {
                        if (navigator.userAgent.indexOf("MSIE 6.0") > 0) {
                            var e = this;
                            setTimeout(function() {
                                var f;
                                if (c.type == "checkbox") {
                                    f = a(c).closest("tr").next("tr").children("div[class='onError']")
                                } else {
                                    f = a(c).closest("td").children("div[class='onError']")
                                }
                                if (f.length <= 0) {
                                    e.settings.errorPlacement ? e.settings.errorPlacement(b, a(c)) : b.insertAfter(c)
                                }
                                if (f.length > 0) {
                                    var h = 0;
                                    for (var g = 0; g < f.length; g++) {
                                        if (c.id == f[g].htmlfor) {
                                            break
                                        }
                                        h++
                                    }
                                    if (h == f.length && c.style.display != "none" && c._specail == "1") {
                                        e.settings.errorPlacement ? e.settings.errorPlacement(b, a(c)) : b.insertAfter(c)
                                    }
                                }
                            }, 20)
                        } else {
                            this.settings.errorPlacement ? this.settings.errorPlacement(b, a(c)) : b.insertAfter(c)
                        }
                    }
                }
                if (!d && this.settings.success) {
                    b.text("");
                    typeof this.settings.success == "string" ? b.addClass(this.settings.success) : this.settings.success(b)
                }
                this.toShow = this.toShow.add(b)
            }, errorsFor: function(c) {
                var b = this.idOrName(c);
                return this.errors().filter(function() {
                    return a(this).attr("for") == b
                })
            }, idOrName: function(b) {
                return this.groups[b.name] || (this.checkable(b) ? b.name : b.id || b.name)
            }, checkable: function(b) {
                return/radio|checkbox/i.test(b.type)
            }, findByName: function(b) {
                var c = this.currentForm;
                return a(document.getElementsByName(b)).map(function(d, e) {
                    return e.form == c && e.name == b && e || null
                })
            }, getLength: function(c, b) {
                switch (b.nodeName.toLowerCase()) {
                    case"select":
                        return a("option:selected", b).length;
                    case"input":
                        if (this.checkable(b)) {
                            return this.findByName(b.name).filter(":checked").length
                        }
                }
                return c.length
            }, depend: function(c, b) {
                return this.dependTypes[typeof c] ? this.dependTypes[typeof c](c, b) : true
            }, dependTypes: {"boolean": function(c, b) {
                    return c
                }, string: function(c, b) {
                    return !!a(c, b.form).length
                }, "function": function(c, b) {
                    return c(b)
                }}, optional: function(b) {
                return !a.validator.methods.required.call(this, a.trim(b.value), b) && "dependency-mismatch"
            }, startRequest: function(b) {
                if (!this.pending[b.name]) {
                    this.pendingRequest++;
                    this.pending[b.name] = true
                }
            }, stopRequest: function(b, c) {
                this.pendingRequest--;
                if (this.pendingRequest < 0) {
                    this.pendingRequest = 0
                }
                delete this.pending[b.name];
                if (c && this.pendingRequest == 0 && this.formSubmitted && this.form()) {
                    a(this.currentForm).submit();
                    this.formSubmitted = false
                } else {
                    if (!c && this.pendingRequest == 0 && this.formSubmitted) {
                        a(this.currentForm).triggerHandler("invalid-form", [this]);
                        this.formSubmitted = false
                    }
                }
            }, previousValue: function(b) {
                return a.data(b, "previousValue") || a.data(b, "previousValue", {old: null, valid: true, message: this.defaultMessage(b, "remote")})
            }}, classRuleSettings: {required: {required: true}, email: {email: true}, url: {url: true}, date: {date: true}, dateISO: {dateISO: true}, dateDE: {dateDE: true}, number: {number: true}, numberDE: {numberDE: true}, digits: {digits: true}, creditcard: {creditcard: true}}, addClassRules: function(b, c) {
            b.constructor == String ? this.classRuleSettings[b] = c : a.extend(this.classRuleSettings, b)
        }, classRules: function(c) {
            var d = {};
            var b = a(c).attr("class");
            b && a.each(b.split(" "), function() {
                if (this in a.validator.classRuleSettings) {
                    a.extend(d, a.validator.classRuleSettings[this])
                }
            });
            return d
        }, attributeRules: function(c) {
            var e = {};
            var b = a(c);
            for (method in a.validator.methods) {
                var d = b.attr(method);
                if (d) {
                    e[method] = d
                }
            }
            if (e.maxlength && /-1|2147483647|524288/.test(e.maxlength)) {
                delete e.maxlength
            }
            return e
        }, metadataRules: function(b) {
            if (!a.metadata) {
                return{}
            }
            var c = a.data(b.form, "validator").settings.meta;
            return c ? a(b).metadata()[c] : a(b).metadata()
        }, staticRules: function(c) {
            var d = {};
            var b = a.data(c.form, "validator");
            if (b.settings.rules) {
                d = a.validator.normalizeRule(b.settings.rules[c.name]) || {}
            }
            return d
        }, normalizeRules: function(c, b) {
            a.each(c, function(f, e) {
                if (e === false) {
                    delete c[f];
                    return
                }
                if (e.param || e.depends) {
                    var d = true;
                    switch (typeof e.depends) {
                        case"string":
                            d = !!a(e.depends, b.form).length;
                            break;
                        case"function":
                            d = e.depends.call(b, b);
                            break
                    }
                    if (d) {
                        c[f] = e.param !== undefined ? e.param : true
                    } else {
                        delete c[f]
                    }
                }
            });
            a.each(c, function(d, e) {
                c[d] = a.isFunction(e) ? e(b) : e
            });
            a.each(["minlength", "maxlength", "min", "max"], function() {
                if (c[this]) {
                    c[this] = Number(c[this])
                }
            });
            a.each(["rangelength", "range"], function() {
                if (c[this]) {
                    c[this] = [Number(c[this][0]), Number(c[this][1])]
                }
            });
            if (a.validator.autoCreateRanges) {
                if (c.min && c.max) {
                    c.range = [c.min, c.max];
                    delete c.min;
                    delete c.max
                }
                if (c.minlength && c.maxlength) {
                    c.rangelength = [c.minlength, c.maxlength];
                    delete c.minlength;
                    delete c.maxlength
                }
            }
            if (c.messages) {
                delete c.messages
            }
            return c
        }, normalizeRule: function(c) {
            if (typeof c == "string") {
                var b = {};
                a.each(c.split(/\s/), function() {
                    b[this] = true
                });
                c = b
            }
            return c
        }, addMethod: function(b, d, c) {
            a.validator.methods[b] = d;
            a.validator.messages[b] = c != undefined ? c : a.validator.messages[b];
            if (d.length < 3) {
                a.validator.addClassRules(b, a.validator.normalizeRule(b))
            }
        }, methods: {required: function(c, b, e) {
                if (!this.depend(e, b)) {
                    return"dependency-mismatch"
                }
                switch (b.nodeName.toLowerCase()) {
                    case"select":
                        var d = a(b).val();
                        return d && d.length > 0;
                    case"input":
                        if (this.checkable(b)) {
                            return this.getLength(c, b) > 0
                        }
                    default:
                        return a.trim(c).length > 0
                    }
            }, remote: function(f, c, h) {
                if (this.optional(c)) {
                    return"dependency-mismatch"
                }
                var d = this.previousValue(c);
                if (!this.settings.messages[c.name]) {
                    this.settings.messages[c.name] = {}
                }
                d.originalMessage = this.settings.messages[c.name].remote;
                this.settings.messages[c.name].remote = d.message;
                h = typeof h == "string" && {url: h} || h;
                if (d.old !== f) {
                    d.old = f;
                    var b = this;
                    this.startRequest(c);
                    var e = {};
                    e[c.name] = f;
                    if (c._exVal) {
                        for (var g in c._exVal) {
                            e[g] = c._exVal[g]
                        }
                    }
                    a.ajax(a.extend(true, {url: h, mode: "abort", port: "validate" + c.name, dataType: "json", data: e, success: function(j) {
                            b.settings.messages[c.name].remote = d.originalMessage;
                            var l = j === true;
                            if (l) {
                                var i = b.formSubmitted;
                                b.prepareElement(c);
                                b.formSubmitted = i;
                                b.successList.push(c);
                                b.showErrors()
                            } else {
                                var m = {};
                                var k = (d.message = j || b.defaultMessage(c, "remote"));
                                m[c.name] = a.isFunction(k) ? k(f) : k;
                                b.showErrors(m)
                            }
                            d.valid = l;
                            b.stopRequest(c, l)
                        }}, h));
                    return"pending"
                } else {
                    if (this.pending[c.name]) {
                        return"pending"
                    }
                }
                return d.valid
            }, minlength: function(c, b, d) {
                return this.optional(b) || this.getLength(a.trim(c), b) >= d
            }, maxlength: function(c, b, d) {
                return this.optional(b) || this.getLength(a.trim(c), b) <= d
            }, rangelength: function(d, b, e) {
                var c = this.getLength(a.trim(d), b);
                return this.optional(b) || (c >= e[0] && c <= e[1])
            }, min: function(c, b, d) {
                return this.optional(b) || c >= d
            }, max: function(c, b, d) {
                return this.optional(b) || c <= d
            }, range: function(c, b, d) {
                return this.optional(b) || (c >= d[0] && c <= d[1])
            }, email: function(c, b) {
                return this.optional(b) || /^([a-zA-Z0-9_-])*([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]+)+)$/i.test(c)
            }, emails: function(e, d) {
                e = e.replace(/\n/g, "");
                e = e.replace(/ /g, "");
                var b = e.split(";");
                for (var c = 0; c < b.length; c++) {
                    if (c == b.length - 1) {
                        if (b[c].replace(/( +)$/g, "").replace(/^( +)/g, "") == "") {
                            return this.optional(d) || true
                        }
                    }
                    if (!/^([a-zA-Z0-9_-])*([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]+)+)$/i.test(b[c])) {
                        return this.optional(d) || false
                    }
                }
                return this.optional(d) || true
            }, emailslimit: function(d, c) {
                d = d.replace(/\n/g, "");
                d = d.replace(/ /g, "");
                var b = d.split(";");
                return this.optional(c) || b.length <= 21
            }, url: function(c, b) {
                return this.optional(b) || /^((https?|ftp):\/\/)?((((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?)?$/i.test(c)
            }, date: function(c, b) {
                return this.optional(b) || !/Invalid|NaN/.test(new Date(c))
            }, dateISO: function(c, b) {
                return this.optional(b) || /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(c)
            }, number: function(c, b) {
                return this.optional(b) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(c)
            }, digits: function(c, b) {
                return this.optional(b) || /^\d+$/.test(c)
            }, creditcard: function(f, c) {
                if (this.optional(c)) {
                    return"dependency-mismatch"
                }
                if (/[^0-9-]+/.test(f)) {
                    return false
                }
                var g = 0, e = 0, b = false;
                f = f.replace(/\D/g, "");
                for (var h = f.length - 1; h >= 0; h--) {
                    var d = f.charAt(h);
                    var e = parseInt(d, 10);
                    if (b) {
                        if ((e *= 2) > 9) {
                            e -= 9
                        }
                    }
                    g += e;
                    b = !b
                }
                return(g % 10) == 0
            }, accept: function(c, b, d) {
                d = typeof d == "string" ? d.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(b) || c.match(new RegExp(".(" + d + ")$", "i"))
            }, equalTo: function(c, b, e) {
                var d = a(e).unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
                    a(b).valid()
                });
                return c == d.val()
            }}});
    a.format = a.validator.format
})(jQuery);
(function(c) {
    var b = c.ajax;
    var a = {};
    c.ajax = function(e) {
        e = c.extend(e, c.extend({}, c.ajaxSettings, e));
        var d = e.port;
        if (e.mode == "abort") {
            if (a[d]) {
                a[d].abort()
            }
            return(a[d] = b.apply(this, arguments))
        }
        return b.apply(this, arguments)
    }
})(jQuery);
(function(a) {
    if (!jQuery.event.special.focusin && !jQuery.event.special.focusout && document.addEventListener) {
        a.each({focus: "focusin", blur: "focusout"}, function(c, b) {
            a.event.special[b] = {setup: function() {
                    this.addEventListener(c, d, true)
                }, teardown: function() {
                    this.removeEventListener(c, d, true)
                }, handler: function(f) {
                    arguments[0] = a.event.fix(f);
                    arguments[0].type = b;
                    return a.event.handle.apply(this, arguments)
                }};
            function d(f) {
                f = a.event.fix(f);
                f.type = b;
                return a.event.handle.call(this, f)
            }}
        )
    }
    a.extend(a.fn, {validateDelegate: function(d, c, b) {
            return this.bind(c, function(e) {
                var f = a(e.target);
                if (f.is(d)) {
                    return b.apply(f, arguments)
                }
            })
        }})
})(jQuery);
$.validator.addMethod("notEqualTo", function(b, a, d) {
    var c = $(d).unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
        $(a).valid()
    });
    return b != c.val()
});
$.validator.addMethod("loginname", function(b, a, c) {
    return this.optional(a) || /^[a-zA-Z0-9\.]+$/.test(b)
});
$.validator.addMethod("logUserName", function(b, a, c) {
    return this.optional(a) || /^[a-zA-Z0-9\.]+$/.test(b) || /^([a-zA-Z0-9_-])+([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]+)+)$/i.test(b)
});
$.validator.addMethod("phone", function(b, a, c) {
    return this.optional(a) || /^[0-9a-zA-Z\-]+$/.test(b)
});
$.validator.addMethod("notOnlyDigit", function(b, a, c) {
    return this.optional(a) || !/^[\d]+$/.test(b)
});
$.validator.addMethod("zip", function(b, a, c) {
    return this.optional(a) || /^[0-9A-Za-z.-]+$/.test(b)
});
$.validator.addMethod("nohtml", function(b, a, c) {
    return this.optional(a) || !/<([\w\?]+)\s*[\s\S]*\/?>(?:<\/\1>)?/.test(b)
});
$.validator.addMethod("nohtml1", function(b, a, c) {
    return this.optional(a) || !/<\/(\w+)\s*[\s\S]*\/?>/.test(b)
});
$.validator.addMethod("phoneNo", function(b, a, c) {
    return this.optional(a) || /^[0-9a-zA-Z]+$/.test(b)
});
$.validator.addMethod("orginName", function(b, a, c) {
    return this.optional(a) || /^[A-Za-z,'\ ]+$/.test(b)
});
$.validator.addMethod("bd", function(b, a, c) {
    return this.optional(a) || !/[，。？：；‘’！“”—……、（）【】《》]+/.test(b)
});
$.validator.addMethod("cname", function(b, a, c) {
    return this.optional(a) || /^[a-zA-Z0-9,-. ]+$/.test(b)
});
$.validator.addMethod("normalWord", function(e, d, g) {
    var c = /[\uFE30-\uFFA0\u4e00-\u9fa5]+/;
    var a = /[　！＃％＆＇（）＊＋，－．／：；＜＝＞？＠［＼］＾＿｀｛｜｝～]/;
    if ($.trim(e)) {
        for (var b = 0; b < e.length; b++) {
            var f = e.substring(b, b + 1);
            if (a.test(f)) {
                continue
            }
            if (c.test(f)) {
                return false
            }
        }
    }
    return true
});
$.validator.addMethod("normalWord1", function(e, d, g) {
    var c = /[\uFE30-\uFFA0\u4e00-\u9fa5]+/;
    var a = /[　！＃％＆＇（）＊＋，－．／：；＜＝＞？＠［＼］＾＿｀｛｜｝～。《》‘“”、]/;
    if ($.trim(e)) {
        for (var b = 0; b < e.length; b++) {
            var f = e.substring(b, b + 1);
            if (a.test(f)) {
                return false
            }
            if (c.test(f)) {
                return false
            }
        }
    }
    return true
});
$.validator.addMethod("outofdate", function(b, a, d) {
    var e = new Date() - new Date(b);
    return this.optional(a) || (e > 0 && e < 3600 * 24 * 1000) || new Date(b) - new Date() > 0
});
$.validator.addMethod("bigerdate", function(b, a, d) {
    var e = new Date() - new Date(b);
    return this.optional(a) || (e > 0 && e < 3600 * 24 * 1000) || new Date(b) - new Date() > 0
});
$.validator.addMethod("english", function(b, a, c) {
    return this.optional(a) || /^[\'A-Za-z\,\s ]+$/.test(b)
});
$.validator.addMethod("english2", function(b, a, c) {
    return this.optional(a) || /^[\',A-Za-z\s ]+$/.test(b)
});
$.validator.addMethod("address", function(b, a, c) {
    return this.optional(a) || /^[0-9A-Za-z\.\,\-\'\(\)\s]+$/.test(b)
});
$.validator.addMethod("numwithdot", function(b, a, c) {
    return this.optional(a) || /^[\d\.\,]+$/.test(b)
});
$.validator.addMethod("skype", function(b, a, c) {
    return this.optional(a) || /^[0-9A-Za-z\.\_\-]+$/.test(b)
});
$.validator.addMethod("modelNo", function(b, a, c) {
    return this.optional(a) || /^[0-9A-Za-z]+$/.test(b)
});
$.validator.addMethod("telNo", function(b, a, c) {
    return this.optional(a) || /^[a-zA-Z0-9]+-[a-zA-Z0-9]+$/.test(b) || /^[a-zA-Z0-9]+$/.test(b)
});
$.validator.addMethod("datebigger", function(c, b, d) {
    var a = new Date().Format("yyyy/MM/dd");
    return this.optional(b) || a <= c
});
$.validator.addMethod("dup", function(m, e, c) {
    var a = /^\d+$/;
    var b = /^[a-zA-Z]+$/;
    if (a.test(m)) {
        var g = m.split(""), h = 1;
        for (var f = 1; f < g.length; f++) {
            if (g[f] - g[f - 1] == 1) {
                h++
            }
        }
        if (h == g.length) {
            return false
        }
    }
    if (b.test(m)) {
        var l = m.split(""), k = 1;
        for (var d = 1; d < l.length; d++) {
            if (l[d].charCodeAt(0) - l[d - 1].charCodeAt(0) == 1) {
                k++
            }
        }
        if (k == l.length) {
            return false
        }
    }
    return this.optional(e) || !/^((([\.a-zA-Z0-9])\3{5,19}))$/.test(m)
});
$.validator.addMethod("greaterThan", function(b, a, d) {
    var c = $(d).unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
        $(a).valid()
    });
    return this.optional(a) || new Date(b) - new Date(c.val()) >= 0
});
$.validator.addMethod("compareDate", function(d, b, f) {
    var a = $(f).val();
    var e = new Date(a);
    var c = new Date(d);
    return this.optional(b) || e < c
});
$.validator.setDefaults({errorClass: "onError", errorElement: "div", highlight: function(a) {
        $(a).closest("div.item").addClass("wrongBg")
    }, unhighlight: function(a) {
        $(a).closest("div.item").removeClass("wrongBg")
    }, onfocusout: function(a) {
        if ($(a).attr("name") == "approvalDate" || $(a).attr("name") == "userableDate" || $(a).attr("name") == "tradBeginDate" || $(a).attr("name") == "tradEndDate" || $(a).attr("name") == "dtShowQ" || $(a).attr("name") == "dtShowZ") {
            setTimeout(function() {
                try {
                    this.element(a)
                } catch (b) {
                }
            }, 1000)
        } else {
            this.element(a)
        }
    }});
$(function() {
    var a = navigator.userAgent;
    if (a.indexOf("MSIE") > 0 && a.indexOf("MSIE 9.0") <= 0) {
        $(document.forms).find(":text").blur()
    }
});