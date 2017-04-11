/**
 * Sexy Alert Box - for mootools 1.2 - jQUery 1.3
 * @name sexyalertbox.v1.2.js
 * @author Eduardo D. Sada - http://www.coders.me/web-js-html/javascript/sexy-alert-box
 * @version 1.2
 * @date 07-Feb-2009
 * @copyright (c) 2009 Eduardo D. Sada (www.coders.me)
 * @license MIT - http://es.wikipedia.org/wiki/Licencia_MIT
 * @example http://www.coders.me/ejemplos/sexy-alert-box/
 * @based in <PBBAcpBox> (Pokemon_JOJO, <http://www.mibhouse.org/pokemon_jojo>)
 * @thanks to Pokemon_JOJO!
 * @features:
 * * Chain Implemented (Cola de mensajes)
 * * More styles (info, error, alert, prompt, confirm)
 * * ESC would close the window
 * * Focus on a default button
 */


jQuery.bind = function(c, d) {
    var e = Array.prototype.slice.call(arguments, 2);
    return function() {
        var b = [this].concat(e, $.makeArray(arguments));
        return d.apply(c, b)
    }
};
jQuery.fn.delay = function(b, c) {
    return this.each(function() {
        setTimeout(c, b)
    })
};
jQuery.fn.extend({$chain: [], chain: function(b) {
        this.$chain.push(b);
        return this
    }, callChain: function(b) {
        return(this.$chain.length) ? this.$chain.pop().apply(b, arguments) : false
    }, clearChain: function() {
        this.$chain.empty();
        return this
    }});
(function(a) {
    Sexy = {getOptions: function() {
            return{name: 'SexyAlertBox', zIndex: 65555, onReturn: false, onReturnFunction: function(b) {
                }, BoxStyles: {'width': 500}, OverlayStyles: {'backgroundColor': '#000', 'opacity': 0.7}, showDuration: 200, closeDuration: 100, moveDuration: 500, onCloseComplete: a.bind(this, function() {
                    this.options.onReturnFunction(this.options.onReturn)
                })}
        }, initialize: function(d) {
            this.i = 0;
            this.options = a.extend(this.getOptions(), d);
            a('body').append('<div id="BoxOverlay"></div><div id="' + this.options.name + '-Box"><div id="' + this.options.name + '-InBox"><div id="' + this.options.name + '-BoxContent"><div id="' + this.options.name + '-BoxContenedor"></div></div></div></div>');
            this.Content = a('#' + this.options.name + '-BoxContenedor');
            this.Contenedor = a('#' + this.options.name + '-BoxContent');
            this.InBox = a('#' + this.options.name + '-InBox');
            this.Box = a('#' + this.options.name + '-Box');
            a('#BoxOverlay').css({position: 'absolute', top: 0, left: 0, opacity: this.options.OverlayStyles.opacity, backgroundColor: this.options.OverlayStyles.backgroundColor, 'z-index': this.options.zIndex, height: a(document).height(), width: a(document).width()}).hide();
            this.Box.css({display: 'none', position: 'absolute', top: 0, left: 0, 'z-index': this.options.zIndex + 2, width: this.options.BoxStyles.width + 'px'});
            this.preloadImages();
            a(window).bind('resize', a.bind(this, function() {
                if (this.options.display == 1) {
                    a('#BoxOverlay').css({height: 0, width: 0});
                    a('#BoxOverlay').css({height: a(document).height(), width: a(document).width()});
                    this.replaceBox()
                }
            }));
            this.Box.bind('keydown', a.bind(this, function(b, c) {
                if (c.keyCode == 27) {
                    this.options.onReturn = false;
                    this.display(0)
                }
            }));
            a(window).bind('scroll', a.bind(this, function() {
                this.replaceBox()
            }))
        }, replaceBox: function() {
            if (this.options.display == 1) {
                this.Box.stop();
                this.Box.animate({left: ((a(document).width() - this.options.BoxStyles.width) / 2), top: (a(document).scrollTop() + (a(window).height() - this.Box.outerHeight()) / 2)}, {duration: this.options.moveDuration, easing: 'easeOutBack'});
                a(this).delay(this.options.moveDuration, a.bind(this, function() {
                    a('#BoxAlertBtnOk').focus();
                    a('#BoxPromptInput').focus();
                    a('#BoxConfirmBtnOk').focus()
                }))
            }
        }, display: function(b) {
            if (this.options.display == 0 && b != 0 || b == 1) {
                if (!a.support.maxHeight) {
                    a('embed, object, select').css({'visibility': 'hidden'})
                }
                this.togFlashObjects('hidden');
                this.options.display = 1;
                a('#BoxOverlay').stop();
                a('#BoxOverlay').fadeIn(this.options.showDuration, a.bind(this, function() {
                    this.Box.css({display: 'block', left: ((a(document).width() - this.options.BoxStyles.width) / 2)});
                    this.replaceBox()
                }))
            } else {
                this.Box.css({display: 'none', top: 0});
                this.options.display = 0;
                a(this).delay(500, a.bind(this, this.queue));
                a(this.Content).empty();
                this.Content.removeClass();
                if (this.i == 1) {
                    a('#BoxOverlay').stop();
                    a('#BoxOverlay').fadeOut(this.options.closeDuration, a.bind(this, function() {
                        a('#BoxOverlay').hide();
                        if (!a.support.maxHeight) {
                            a('embed, object, select').css({'visibility': 'visible'})
                        }
                        this.togFlashObjects('visible');
                        this.options.onCloseComplete.call()
                    }))
                }
            }
        }, messageBox: function(c, d, e, f) {
            a(this).chain(function() {
                e = a.extend({'textBoxBtnOk': 'OK', 'textBoxBtnCancel': 'Cancelar', 'textBoxInputPrompt': null, 'password': false, 'onComplete': function(b) {
                    }}, e || {});
                this.options.onReturnFunction = e.onComplete;
                this.Content.append('<div id="' + this.options.name + '-Buttons"></div>');
                if (c == 'alert' || c == 'info' || c == 'error') {
                    a('#' + this.options.name + '-Buttons').append('<input id="BoxAlertBtnOk" type="submit" />');
                    a('#BoxAlertBtnOk').val(e.textBoxBtnOk).css({'width': 70});
                    a('#BoxAlertBtnOk').bind('click', a.bind(this, function() {
                        this.options.onReturn = true;
                        this.display(0)
                    }));
                    if (c == 'alert') {
                        clase = 'BoxAlert'
                    } else if (c == 'error') {
                        clase = 'BoxError'
                    } else if (c == 'info') {
                        clase = 'BoxInfo'
                    }
                    this.Content.addClass(clase).prepend(d);
                    this.display(1)
                } else if (c == 'confirm') {
                    a('#' + this.options.name + '-Buttons').append('<input id="BoxConfirmBtnOk" type="submit" /> <input id="BoxConfirmBtnCancel" type="submit" />');
                    a('#BoxConfirmBtnOk').val(e.textBoxBtnOk).css({'width': 70});
                    a('#BoxConfirmBtnCancel').val(e.textBoxBtnCancel).css({'width': 70});
                    a('#BoxConfirmBtnOk').bind('click', a.bind(this, function() {
                        this.options.onReturn = true;
                        this.display(0)
                    }));
                    a('#BoxConfirmBtnCancel').bind('click', a.bind(this, function() {
                        this.options.onReturn = false;
                        this.display(0)
                    }));
                    this.Content.addClass('BoxConfirm').prepend(d);
                    this.display(1)
                } else if (c == 'prompt') {
                    a('#' + this.options.name + '-Buttons').append('<input id="BoxPromptBtnOk" type="submit" /> <input id="BoxPromptBtnCancel" type="submit" />');
                    a('#BoxPromptBtnOk').val(e.textBoxBtnOk).css({'width': 70});
                    a('#BoxPromptBtnCancel').val(e.textBoxBtnCancel).css({'width': 70});
                    c = e.password ? 'password' : 'text';
                    this.Content.prepend('<input id="BoxPromptInput" type="' + c + '" />');
                    a('#BoxPromptInput').val(e.input);
                    a('#BoxPromptInput').css({'width': 250});
                    a('#BoxPromptBtnOk').bind('click', a.bind(this, function() {
                        this.options.onReturn = a('#BoxPromptInput').val();
                        this.display(0)
                    }));
                    a('#BoxPromptBtnCancel').bind('click', a.bind(this, function() {
                        this.options.onReturn = false;
                        this.display(0)
                    }));
                    this.Content.addClass('BoxPrompt').prepend(d + '<br />');
                    this.display(1)
                } else {
                    this.options.onReturn = false;
                    this.display(0)
                }
            });
            this.i++;
            if (this.i == 1) {
                a(this).callChain(this)
            }
        }, queue: function() {
            this.i--;
            a(this).callChain(this)
        }, chk: function(b) {
            return!!(b || b === 0)
        }, togFlashObjects: function(b) {
            var c = new Array("embed", "iframe", "object");
            for (y = 0; y < c.length; y++) {
                var d = document.getElementsByTagName(c[y]);
                for (i = 0; i < d.length; i++) {
                    d[i].style.visibility = b
                }
            }
        }, preloadImages: function() {
            var b = new Array(2);
            b[0] = new Image();
            b[1] = new Image();
            b[2] = new Image();
            b[0].src = this.Box.css('background-image').replace(new RegExp("url\\('?([^']*)'?\\)", 'gi'), "$1");
            b[1].src = this.InBox.css('background-image').replace(new RegExp("url\\('?([^']*)'?\\)", 'gi'), "$1");
            b[2].src = this.Contenedor.css('background-image').replace(new RegExp("url\\('?([^']*)'?\\)", 'gi'), "$1")
        }, alert: function(b, c) {
            this.messageBox('alert', b, c)
        }, info: function(b, c) {
            this.messageBox('info', b, c)
        }, error: function(b, c) {
            this.messageBox('error', b, c)
        }, confirm: function(b, c) {
            this.messageBox('confirm', b, c)
        }, prompt: function(b, c, d) {
            this.messageBox('prompt', b, d, c)
        }}
})(jQuery);