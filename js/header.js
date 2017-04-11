var globalImgServer = "http://style.alibaba.com";
location.protocol === "https:" && (globalImgServer = "https://ipaystyle.alibaba.com");
define("js/6v/biz/common/header/_dev/src/base/base.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = r.extend({attrs: {containerId: "", mods: [], controllers: {}}, initialize: function(e) {
            return i.superclass.initialize.call(this, e), this.disabled = !0, this.mods = "ALL", this._modList = {}, this.containerEl = n(this.get("containerId")), this
        }, _getMods: function(e) {
            return e === "ALL" && (e = this._mods), this.mods = e, e
        }, getModList: function() {
            return this._modList
        }, run: function(e) {
            e && this.initAttrs(e), this._mods = this.get("mods");
            var t = this._getMods(this.get("mod") === null ? null : this.get("mod") || "ALL");
            return this.containerEl.length > 0 && t ? this.enable() : this.disable(), this
        }, getContainer: function() {
            return this.containerEl
        }, getElement: function(e) {
            return this.containerEl.find(e)
        }, _addModList: function(e) {
            var t, r, i;
            if (n.isArray(e))
                for (r = 0, i = e.length; r < i; r++)
                    t = e[r], this._addMod(t)
        }, _addMod: function(e) {
            var t = this._modList[e], n;
            t || (n = this.get("controllers")[e], n && (t = n(this)), t && (this._modList[e] = t))
        }, enable: function() {
            this.disabled = !1, this._addModList(this.mods)
        }, disable: function() {
            this.disabled = !0, this.mods = this._mods, this._modList = {}, this.containerEl.length > 0 && this.containerEl.hide()
        }, getOperation: function() {
            return{}
        }});
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/base.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = r.extend({attrs: {modElm: "", uiClass: ""}, initialize: function(e, t) {
            i.superclass.initialize.call(this, e), this.disabled = !0, this._mod = n(this.get("modElm")), this._uiClass = this.get("uiClass"), t && (this._container = t.getContainer())
        }, run: function() {
            return this._mod.length > 0 && this.enable(), this
        }, getContainer: function() {
            return this._mod
        }, enable: function() {
            this.disabled = !1, this._container.addClass(this._uiClass)
        }, disable: function() {
            this.disabled = !0, this._container.removeClass(this._uiClass)
        }, html: function(e) {
            return this.disabled || this._mod.html(e), this
        }});
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/en-us.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "From AliSourcePro", "biz-header-ml-english-title": "english", "biz-header-rfq-estimated": 'Estimated Order Value: <span class="ui-header-rfq-quotes">US ${0}</span>', "biz-header-rfq-negotiating": "{0} was negotiating a Buying Request.", "biz-header-rfq-quotation": "Get Quotations", "biz-header-rfq-quotes": "{0} received {1} quotes.", "biz-header-rfq-tip": "Save 40% off your time to get quotes.", "biz-header-seconds-ago": "{0} seconds ago", "biz-header-short-title": "en"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/ar-sa.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": 'Ù…Ù† "AliSourcePro "', "biz-header-ml-english-title": "arabic", "biz-header-rfq-estimated": "Ù‚ÙŠÙ…Ø© Ø§Ù„Ø·Ù„Ø¨ Ø§Ù„Ù…ÙÙ‚ÙŽØ¯ÙŽØ±Ù‡: {0} Ø¯ÙˆÙ„Ø§Ø±Ø§Ù‹ Ø£Ù…Ø±ÙŠÙƒÙŠØ§Ù‹", "biz-header-rfq-negotiating": "ÙƒØ§Ù† {0} ÙŠØªÙØ§ÙˆØ¶ Ø¹Ù„Ù‰ Ø·Ù„Ø¨ Ø´Ø±Ø§Ø¡", "biz-header-rfq-quotation": "Ø§Ø­ØµÙ„ Ø¹Ù„Ù‰ Ø§Ù‚ØªØ¨Ø§Ø³Ø§Øª", "biz-header-rfq-quotes": "Ù„Ù‚Ø¯ ØªØ³Ù„Ù… {0} Ø¹Ø¯Ø¯ {1} Ø¹Ø·Ø§Ø¡Ø§Øª", "biz-header-rfq-tip": "ÙˆÙØ± 40% Ù…Ù† ÙˆÙ‚ØªÙƒ Ù„Ù„Ø­ØµÙˆÙ„ Ø¹Ù„Ù‰ Ø¹Ø·Ø§Ø¡Ø§Øª.", "biz-header-seconds-ago": "Ù…Ù†Ø° {0} Ø«Ø§Ù†ÙŠØ©", "biz-header-short-title": "ar"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/de-de.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "Von AliSourcePro", "biz-header-ml-english-title": "german", "biz-header-rfq-estimated": 'GeschÃ¤tzter Auftragswert: <span class="ui-header-rfq-quotes">US $ {0}</span>', "biz-header-rfq-negotiating": "{0} hat eine Kaufanfrage verhandelt.", "biz-header-rfq-quotation": "Angebote Ansehen", "biz-header-rfq-quotes": "hat {0} {1} Angebote erhalten.", "biz-header-rfq-tip": "Sparen Sie 40 % Zeit beim Einholen von Angeboten.", "biz-header-seconds-ago": "Vor {0} Sekunden", "biz-header-short-title": "de"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/es-es.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "De AliSourcePro", "biz-header-ml-english-title": "spanish", "biz-header-rfq-estimated": 'Valor estimado del pedido:<span class="ui-header-rfq-quotes">{0} US $</span>', "biz-header-rfq-negotiating": "{0}negociÃ³ una Solicitud de compra.", "biz-header-rfq-quotation": "Obtener ofertas", "biz-header-rfq-quotes": "{0} recibiÃ³ {1} presupuestos.", "biz-header-rfq-tip": "Reduce en un 40% el tiempo que empleas en obtener presupuestos.", "biz-header-seconds-ago": "Hace {0} segundos", "biz-header-short-title": "es"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/fr-fr.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "De la part d'AliSourcePro", "biz-header-ml-english-title": "french", "biz-header-rfq-estimated": 'Estimation de la valeur de commande : <span class="ui-header-rfq-quotes">US $ {0}</span>', "biz-header-rfq-negotiating": "{0} nÃ©gociait une Demande d'achat.", "biz-header-rfq-quotation": "Obtenez des devis", "biz-header-rfq-quotes": "{0} a reÃ§u {1} devis.", "biz-header-rfq-tip": "Ã‰conomisez 40% de votre temps pour obtenir des devis.", "biz-header-seconds-ago": "Il ya {0} secondes", "biz-header-short-title": "fr"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/it-it.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "Da AliSourcePro", "biz-header-ml-english-title": "italian", "biz-header-rfq-estimated": 'Valuta Stimata per l\'Ordine <span class="ui-header-rfq-quotes">USA $ {0}</span>', "biz-header-rfq-negotiating": "{0} stava trattando una Richiesta d'Acquisto", "biz-header-rfq-quotation": "Ottieni Preventivi", "biz-header-rfq-quotes": "{0} ha ricevuto {`} preventivi.", "biz-header-rfq-tip": "Risparmia il 40% del tempo per ottenere dei preventivi.", "biz-header-seconds-ago": "{0} secondi fa", "biz-header-short-title": "it"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/ja-jp.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "AliSourceProã‚ˆã‚Š", "biz-header-ml-english-title": "japanese", "biz-header-rfq-estimated": 'æ¦‚ç®—æ³¨æ–‡é‡‘é¡:<span class="ui-header-rfq-quotes">{0} ç±³ãƒ‰ãƒ«</span>', "biz-header-rfq-negotiating": "{0} ã¯è³¼è²·è¦æ±‚ã‚’äº¤æ¸‰ä¸­", "biz-header-rfq-quotation": "è¦‹ç©å–å¾—", "biz-header-rfq-quotes": "{0}ã¯{1}è¦‹ç©ã‚Šã‚’å—ã‘å–ã‚Šã¾ã—ãŸã€‚", "biz-header-rfq-tip": "è¦‹ç©ã‚Šå–å¾—æ™‚é–“ã‚’40%çŸ­ç¸®ã—ã¾ã™ã€‚", "biz-header-seconds-ago": "{0}ç§’ (åˆ†/æ™‚é–“/æ—¥) å‰", "biz-header-short-title": "ja"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/ko-kr.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "AliSourceProë¡œë¶€í„°", "biz-header-ml-english-title": "korean", "biz-header-rfq-estimated": 'êµ¬ë§¤ ê²¬ì ê°€: <span class="ui-header-rfq-quotes">{0} ë¯¸ ë‹¬ëŸ¬</span>', "biz-header-rfq-negotiating": "{0}ëŠ” êµ¬ë§¤ ìš”ì²­ í˜‘ìƒ ì¤‘", "biz-header-rfq-quotation": "ê²¬ì  ë°›ê¸°", "biz-header-rfq-quotes": "{0} ë‹˜ê»˜ì„œ {1} ê²¬ì ì„ ë°›ìœ¼ì…¨ìŠµë‹ˆë‹¤.", "biz-header-rfq-tip": "ê²¬ì ì„ í†µí•´ ì‹œê°„ì„ 40% ì •ë„ ì ˆì•½í•´ë³´ì„¸ìš”.", "biz-header-seconds-ago": "{0}ì´ˆ(ë¶„/ì‹œê°„/ì¼) ì „ì—", "biz-header-short-title": "ko"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/nl-nl.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "van AliSourcePro", "biz-header-ml-english-title": "dutch", "biz-header-rfq-estimated": 'Geschatte Bestel Waarde: <span class = "ui-header-rfq-quotes"> US $ {0} </ span>', "biz-header-rfq-negotiating": "{0} is te onderhandelen over een Buying Request.", "biz-header-rfq-quotation": "krijg Offertes", "biz-header-rfq-quotes": "{0} ontvangen {1} citeert.", "biz-header-rfq-tip": "Bespaar 40% van je tijd om offertes te krijgen.", "biz-header-seconds-ago": "{0} seconden geleden", "biz-header-short-title": "nl"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/pt-pt.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "De AliSourcePro", "biz-header-ml-english-title": "portuguese", "biz-header-rfq-estimated": 'Valor estimado do pedido: <span class="ui-header-rfq-quotes">US $ {0}</span>', "biz-header-rfq-negotiating": "{0} estava negociando uma Pedido de CotaÃ§Ã£o.", "biz-header-rfq-quotation": "Solicitar CotaÃ§Ãµes", "biz-header-rfq-quotes": "{0} recebeu {1} cotaÃ§Ãµes.", "biz-header-rfq-tip": "Economize atÃ© 40% do seu tempo para conseguir cotaÃ§Ãµes.", "biz-header-seconds-ago": "{0} segundos atrÃ¡s", "biz-header-short-title": "pt"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/ru-ru.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "Ð¡ AliSourcePro", "biz-header-ml-english-title": "russian", "biz-header-rfq-estimated": 'ÐžÑ†ÐµÐ½Ð¾Ñ‡Ð½Ð°Ñ Ð¡Ñ‚Ð¾Ð¸Ð¼Ð¾ÑÑ‚ÑŒ Ð—Ð°ÐºÐ°Ð·Ð°: <span class="ui-header-rfq-quotes">{0} Ð´Ð¾Ð»Ð»Ð°Ñ€Ð¾Ð² Ð¡Ð¨Ð</span>', "biz-header-rfq-negotiating": "{0} Ð²ÐµÐ» Ð¿ÐµÑ€ÐµÐ³Ð¾Ð²Ð¾Ñ€Ñ‹ Ð¿Ð¾ Ð—Ð°Ð¿Ñ€Ð¾ÑÑƒ Ð¾ ÐŸÐ¾ÐºÑƒÐ¿ÐºÐµ.", "biz-header-rfq-quotation": "ÐŸÐ¾Ð»ÑƒÑ‡Ð¸Ñ‚ÑŒ Ñ€Ð°ÑÑ†ÐµÐ½ÐºÐ¸", "biz-header-rfq-quotes": "{0} Ð¿Ð¾Ð»ÑƒÑ‡Ð¸Ð» {1} Ñ†ÐµÐ½Ð¾Ð²Ñ‹Ñ… Ð¿Ñ€ÐµÐ´Ð»Ð¾Ð¶ÐµÐ½Ð¸Ð¹.", "biz-header-rfq-tip": "Ð¡ÑÐºÐ¾Ð½Ð¾Ð¼ÑŒÑ‚Ðµ Ð´Ð¾ 40% Ð²Ñ€ÐµÐ¼ÐµÐ½Ð¸ Ð½Ð° Ð¿Ð¾Ð»ÑƒÑ‡ÐµÐ½Ð¸Ðµ Ñ€Ð°ÑÑ†ÐµÐ½Ð¾Ðº.", "biz-header-seconds-ago": "{0} ÑÐµÐº. Ð½Ð°Ð·Ð°Ð´", "biz-header-short-title": "ru"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/th-th.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "à¸ˆà¸²à¸ AliSourcePro", "biz-header-ml-english-title": "thai", "biz-header-rfq-estimated": 'à¸¡à¸¹à¸¥à¸„à¹ˆà¸²à¸„à¸³à¸ªà¸±à¹ˆà¸‡à¸‹à¸·à¹‰à¸­à¹‚à¸”à¸¢à¸›à¸£à¸°à¸¡à¸²à¸“: <span class="ui-header-rfq-quotes">US $ {0}</span>', "biz-header-rfq-negotiating": "{0} à¸à¸³à¸¥à¸±à¸‡à¹€à¸ˆà¸£à¸ˆà¸²à¹ƒà¸šà¹€à¸ªà¸™à¸­à¸‚à¸­à¸‹à¸·à¹‰à¸­", "biz-header-rfq-quotation": "à¸‚à¸­à¹ƒà¸šà¹€à¸ªà¸™à¸­à¸£à¸²à¸„à¸²", "biz-header-rfq-quotes": "{0} à¹„à¸”à¹‰à¸£à¸±à¸šà¸£à¸²à¸„à¸²à¸ªà¸´à¸™à¸„à¹‰à¸² {1}", "biz-header-rfq-tip": "à¸›à¸£à¸°à¸«à¸¢à¸±à¸”à¹€à¸§à¸¥à¸² 40% à¹ƒà¸™à¸à¸²à¸£à¸‚à¸­à¸£à¸±à¸šà¸£à¸²à¸„à¸²à¸ªà¸´à¸™à¸„à¹‰à¸²", "biz-header-seconds-ago": "2 à¸§à¸´à¸™à¸²à¸—à¸µ  à¸—à¸µà¹ˆà¸œà¹ˆà¸²à¸™à¸¡à¸²", "biz-header-short-title": "th"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/tr-tr.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "AliSourcePro'dan", "biz-header-ml-english-title": "turkish", "biz-header-rfq-estimated": 'Tahmini SipariÅŸ DeÄŸeri: <span class="ui-header-rfq-quotes">ABD ${0}</span>', "biz-header-rfq-negotiating": "{0}AlÄ±m Ä°steÄŸi mÃ¼zakere edildi.", "biz-header-rfq-quotation": "FiyatlarÄ± Al", "biz-header-rfq-quotes": "{0} aldÄ± {1} fiyatlar.", "biz-header-rfq-tip": "FiyatlarÄ± edinmek iÃ§in zamanÄ±nÄ±zÄ±n %40Ä±nÄ± kurtarÄ±n.", "biz-header-seconds-ago": "{0} saniye Ã¶nce", "biz-header-short-title": "tr"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/vi-vn.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "TrÃ­ch tá»« AliSourcePro", "biz-header-ml-english-title": "vietnamese", "biz-header-rfq-estimated": 'GiÃ¡ trá»‹ ÄÆ¡n hÃ ng Æ¯á»›c tÃ­nh: <span class="ui-header-rfq-quotes">US $ {0}</span>', "biz-header-rfq-negotiating": "{0} Ä‘ang thÆ°Æ¡ng lÆ°á»£ng má»™t YÃªu cáº§u Mua hÃ ng.", "biz-header-rfq-quotation": "Nháº­n bÃ¡o giÃ¡", "biz-header-rfq-quotes": "{0} Ä‘Ã£ nháº­n Ä‘Æ°á»£c {1} bÃ¡o giÃ¡", "biz-header-rfq-tip": "GiÃºp báº¡n tiáº¿t kiá»‡m tá»›i 40% thá»i gian láº¥y bÃ¡o giÃ¡.", "biz-header-seconds-ago": "LÃºc 2 giÃ¢y trÆ°á»›c", "biz-header-short-title": "vi"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/zh-cn.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "From AliSourcePro", "biz-header-ml-english-title": "china", "biz-header-rfq-estimated": 'Estimated Order Value: <span class="ui-header-rfq-quotes">US ${0}</span>', "biz-header-rfq-negotiating": "{0} was negotiating a Buying Request.", "biz-header-rfq-quotation": "Get Quotations", "biz-header-rfq-quotes": "{0} received {1} quotes.", "biz-header-rfq-tip": "Save 40% off your time to get quotes.", "biz-header-seconds-ago": "{0} seconds ago", "biz-header-short-title": "cn"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/zh-tw.js", ["js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"], function(require, e, t) {
    var n = require("js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c"), r = {app: {}, common: {"biz-header-form-rfq": "From AliSourcePro", "biz-header-ml-english-title": "taiwan", "biz-header-rfq-estimated": 'Estimated Order Value: <span class="ui-header-rfq-quotes">US ${0}</span>', "biz-header-rfq-negotiating": "{0} was negotiating a Buying Request.", "biz-header-rfq-quotation": "Get Quotations", "biz-header-rfq-quotes": "{0} received {1} quotes.", "biz-header-rfq-tip": "Save 40% off your time to get quotes.", "biz-header-seconds-ago": "{0} seconds ago", "biz-header-short-title": "tw"}, commonAppName: "sourcing-common"}, i = n(r);
    t.exports = i
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/action.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c", "js/6v/biz/common/header/_dev/src/sundry/v4/i18n/en-us.js?t=9cd36b37_19adb9c7d"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20"), i = require("js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1"), s = require("js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa"), o = "./i18n/{locale}", u = require(o) || require("js/6v/biz/common/header/_dev/src/sundry/v4/i18n/en-us.js?t=9cd36b37_19adb9c7d"), a = i.create({RGQ_URL: "http://sourcing.alibaba.com/rfq/ajax/SearchBarDataAjax.do", MAX_ITEMS_NUM: 3, ITEM_INTERVAL: 3e3, DATA_INTERVAL: 18e4, DATA_TIMEOUT: 7e3, initialize: function(e) {
            this.mod = e, this.data = [], this.index = 0, this.interval = null, this.timestamp = null, this.isFirst = !0
        }, isTimeout: function() {
            return(new Date).getTime() - this.timestamp >= this.DATA_INTERVAL
        }, load: function(e) {
            var t = this, r = t.mod.find("#ui-header-rfq-loading");
            n.ajax({url: t.RGQ_URL, dataType: "jsonp", jsonp: "callback", crossDomain: !0, timeout: t.DATA_TIMEOUT, beforeSend: function() {
                    t.isFirst && r.show()
                }, success: function(n) {
                    r.hide(), t.timestamp = (new Date).getTime(), t.index = 0, n != null && n.length > 0 ? (t.data = n, e(!0)) : e(!1)
                }, error: function() {
                    r.hide(), t.timestamp = (new Date).getTime(), e(!1)
                }})
        }, getItemHTML: function(e) {
            var t = e.t, n = e.n, r, i;
            return t == 0 ? (r = parseInt(3 * Math.random() + 1, 10), i = '<li style="white-space:nowrap;overflow:hidden;"><div class="ui-header-rfq-list-gmv-column0">' + u.getCommon("biz-header-seconds-ago", r) + "</div>", i += '<div class="ui-header-rfq-list-gmv-column1">', i += u.getCommon("biz-header-rfq-negotiating", '<span class="ui-header-rfq-name">' + e.n + "****** </span>"), i += "<div>", i += u.getCommon("biz-header-rfq-estimated", e.g), i += "</div>", i += "</li>") : t == 1 && (r = parseInt(9 * Math.random() + 1, 10), i = '<li style="white-space:nowrap;overflow:hidden;">', i += '<div class="ui-header-rfq-list-quotes-column0">' + u.getCommon("biz-header-seconds-ago", r) + "</div>", i += '<div class="ui-header-rfq-list-quotes-column1">', i += u.getCommon("biz-header-rfq-quotes", '<span class="ui-header-rfq-name">' + e.n + "****** </span>", '<span class="ui-header-rfq-quotes">' + e.q + "</span>"), i += "</div>", i += "</li>"), i
        }, addItem: function() {
            var e = this, t = this.mod.find("#header-rfq-list"), n;
            e.index >= e.data.length && (e.index = 0), n = e.data[e.index++], t.append(e.getItemHTML(n))
        }, clearItems: function() {
            var e = this.mod.find("#header-rfq-list");
            e.empty()
        }, dynamicRender: function() {
            var e = this;
            e.clearItems();
            for (var t = 0; t < e.MAX_ITEMS_NUM; t++)
                e.addItem()
        }, staticRender: function() {
            var e = "", t = this.mod.find("#header-rfq-list");
            e += '<li><div class="ui-header-rfq-list-quotes-column1"><i class="ui-header-rfq-li-icon"></i>1 Request, 10 Quotes</div></li>', e += '<li><div class="ui-header-rfq-list-quotes-column1"><i class="ui-header-rfq-li-icon"></i>Verified Suppliers</div></li>', e += '<li><div class="ui-header-rfq-list-quotes-column1"><i class="ui-header-rfq-li-icon"></i>Comparison to Transaction</div></li>', t.empty(), t.append(e)
        }, animate: function() {
            var e = this;
            e.interval && (clearInterval(e.interval), e.interval = null), e.interval = setInterval(function() {
                e.mod.find("#header-rfq-list").find("li:eq(0)").animate({marginLeft: 360}, 1e3, function() {
                    e.addItem()
                }).slideUp(1e3, function() {
                    n(this).remove()
                })
            }, e.ITEM_INTERVAL + 2e3)
        }, startup: function() {
            var e = this;
            e.isTimeout() ? e.load(function(t) {
                t ? (e.dynamicRender(), e.animate()) : e.isFirst ? e.staticRender() : e.data.length > 0 && e.animate(), e.isFirst = !1
            }) : e.data.length > 0 && e.animate()
        }, shutdown: function() {
            var e = this;
            e.interval && (clearInterval(e.interval), e.interval = null)
        }}), f = r.extend({attrs: {modElm: null, uiClass: "ui-header-mod-action"}, run: function() {
            return f.superclass.run.call(this), this._mod.css("visibility", "visible"), this.rtl = this.getContainer().css("direction") === "rtl", this._rfqPopup(), this._rfqKeyword(), this
        }, _rfqPopup: function() {
            var e = this._mod.find(".ui-header-action-rfq"), t = this._mod.find(".ui-header-rfq-popup"), n = "ui-header-action-rfq-hover";
            if (e.length > 0 && t.length > 0) {
                var r = this.rtl ? 0 : e.outerWidth() - t.outerWidth(), i = e.outerHeight() - 1, o = new a(this._mod);
                this._mod.find(".ui-header-rfq-text").html(u.getCommon("biz-header-rfq-tip"));
                var f = t.find(".ui-header-rfq-button");
                u.getCommon("biz-header-ml-english-title") !== "english" && (f.html(u.getCommon("biz-header-rfq-quotation")).prop("href", "http://us.sourcing.alibaba.com/rfq/request/post_buy_request.htm?language=" + u.getCommon("biz-header-ml-english-title") + "&tracelog=" + u.getCommon("biz-header-short-title") + "-searchbar-button-popup"), f.siblings("a").prop("href", "http://sourcing." + u.getCommon("biz-header-ml-english-title") + ".alibaba.com/?tracelog=header_action_popup_pro")), (new s({trigger: e, element: t, align: {baseXY: [r, i]}})).after("show", function() {
                    o.startup(), e.addClass(n), dmtrack.dotstat(6130)
                }).after("hide", function() {
                    o.shutdown(), e.removeClass(n)
                })
            }
        }, _rfqKeyword: function() {
            var e = this._container.find(".ui-searchbar-keyword"), t = e.prop("name");
            if (e.length > 0) {
                var r = this._mod.find("A");
                r.on("mousedown", function() {
                    var r = n.trim(e.val());
                    if (r) {
                        var i = n(this).prop("href").replace(new RegExp("[?&]" + t + "(.*?)$"), "");
                        i && i.indexOf("?") > -1 ? n(this).prop("href", i + "&" + t + "=" + r) : n(this).prop("href", i + "?" + t + "=" + r)
                    }
                })
            }
        }, href: function(e) {
            return this.disabled || this._mod.children("a").attr("href", e), this
        }, buttonText: function(e) {
            return this.disabled || this._mod.children("a").html(e), this
        }});
    t.exports = f
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/extend.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20");
    t.exports = r.extend({attrs: {modElm: null, uiClass: "ui-header-mod-extend"}})
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/anchor.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20");
    t.exports = r.extend({attrs: {modElm: null, uiClass: "ui-header-mod-anchor"}})
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/language.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/lib/arale/overlay/mask.js?t=fc06462d_9bf424288", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/dialog/dialog.js?t=d4985192_d20dbf99b", "js/6v/lib/icbu/dialog/dialog.js?t=eb1bcc2f_fffe8e348", "js/6v/biz/common/switch-language/switch-language.js?t=f11e9419_12d40d5bb6"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20"), i = require("js/6v/biz/common/switch-language/switch-language.js?t=f11e9419_12d40d5bb6");
    Language = r.extend({attrs: {modElm: null, uiClass: "ui-header-mod-language"}, initialize: function(e, t) {
            Language.superclass.initialize.call(this, e, t), this.sundry = t
        }, run: function() {
            Language.superclass.run.call(this), (!this.sundry.get("language") || n.isEmptyObject(this.sundry.get("language"))) && this.disable();
            if (this.disabled)
                return this;
            var e = [];
            e.push('<a href="javascript:;" class="ui-header-lan-display">'), e.push('    <span class="ui-header-lan-display-text"></span><i class="ui-header-hollow-arrow"><em></em><b></b></i>'), e.push("</a>"), e.push('<div class="ui-header-lan-list">'), e.push('    <ul class="ui-header-lan-list-ui"></ul>'), e.push("</div>"), this._mod.html(e.join(""));
            var t = {trigger: this._mod.find(".ui-header-lan-display"), element: this._mod.find(".ui-header-lan-list"), listEl: this._mod.find(".ui-header-lan-list-ui"), currentEl: this._mod.find(".ui-header-lan-display-text")}, r = n.extend({}, t, this.sundry.get("language"));
            return i.init(r), this
        }}), t.exports = Language
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/categories.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/biz/common/nav/nav.js?t=d540e860_78618aa92"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20"), i = require("js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa"), s = require("js/6v/biz/common/nav/nav.js?t=d540e860_78618aa92"), o = require("js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635"), u = r.extend({attrs: {modElm: null, uiClass: "ui-header-mod-categories", template: '<nav class="ui-nav ui-nav-v4 ui-nav-popup  ui-header-nav">\r\n\t<h3>{{subject}}<i class="ui-nav-arrow"></i></h3>\r\n\t<ul class="ui-nav-list">\r\n\t{{#each list}}\r\n\t\t{{#if type}}\r\n\t\t\t<li class="ui-nav-more">\r\n\t\t\t\t<a href="{{url}}">{{text}}</a>\r\n\t\t\t</li>\r\n\t\t{{else}}\r\n\t\t\t<li class="ui-nav-item">\r\n\t\t\t\t<a class="ui-nav-link" href="{{url}}">{{text}}<i class="ui-nav-item-arrow"><em></em><b></b></i></a>\r\n\t\t\t\t<div class="ui-nav-pop">\r\n\t\t\t\t\t<ul class="ui-nav-pop-list">\r\n\t\t\t\t\t\t<li class="ui-nav-pop-item">\r\n\t\t\t\t\t\t\t<dl>\r\n\t\t\t\t\t\t\t\t{{#each subs}}\r\n\t\t\t\t\t\t\t\t\t{{#if type}}\r\n\t\t\t\t\t\t\t\t\t\t<dd class="more"><a rel="nofollow" href="{{url}}">{{text}}</a></dd>\r\n\t\t\t\t\t\t\t\t\t{{else}}\r\n\t\t\t\t\t\t\t\t\t\t<dd><a rel="nofollow" href="{{url}}">{{text}}</a></dd>\r\n\t\t\t\t\t\t\t\t\t{{/if}}\r\n\t\t\t\t\t\t\t\t{{/each}}\r\n\t\t\t\t\t\t\t</dl>\r\n\t\t\t\t\t\t</li>\r\n\t\t\t\t\t</ul>\r\n\t\t\t\t</div>\r\n\t\t\t</li>\r\n\t\t{{/if}}\r\n\t{{/each}}\r\n\t</ul>\r\n</nav>'}, enable: function() {
            u.superclass.enable.call(this), this._mod.show()
        }, run: function() {
            u.superclass.run.call(this);
            var e = this, t = e._mod;
            return t.find("a").on("click", function(e) {
                e.preventDefault()
            }).one("mouseover", function(r) {
                e._initCategory(function() {
                    e.popup.after("show", function() {
                        t.addClass("over"), this.element.addClass("over")
                    }).after("hide", function() {
                        t.removeClass("over"), this.element.removeClass("over")
                    }).show()
                }), n(window).on("resize", function() {
                    e.popup && e.popup.hide()
                })
            }).show().css("visibility", "visible"), this
        }, _initCategory: function(e) {
            var t = this, r = {trigger: t._mod, triggerType: "over", align: {baseXY: [0, 0]}};
            if (t.get("containerElm").length > 0) {
                var u = t.get("containerElm");
                t.popup = new i(n.extend(r, {element: u})), u.addClass("ui-nav-v4"), new s({element: u, offsetTop: -1, offsetBottom: 0}), e()
            } else
                t.get("ajaxUrl") && n.ajax({url: t.get("ajaxUrl"), dataType: "jsonp", success: function(u) {
                        var a = i.extend({Implements: o});
                        t.popup = new a(n.extend(r, {model: u, template: t.get("template")})), new s({element: t.popup.element, offsetTop: -1, offsetBottom: 0}), e()
                    }})
        }});
    t.exports = u
});
define("js/6v/biz/common/header/_dev/src/sundry/v4/banner.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/gallery/store/store.js?t=66ea0bf6_0"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/lib/arale/base/base.js?t=6d858051_37e694e07"), i = require("js/6v/lib/gallery/store/store.js?t=66ea0bf6_0"), s = r.extend({run: function() {
            var e = this, t = e.get("headerElm"), r = t.attr("data-banner-src"), s = t.attr("data-banner-link"), o = t.attr("data-banner-store"), u = t.attr("data-banner-color");
            if (i.get(o) !== "close" && r && s && o && u) {
                var a = n("<img />");
                a.on("load", function() {
                    var e = n('<div class="ui-header-banner"><div class="ui-header-banner-inner"><a class="ui-header-banner-close" href="javascript:;"></a></div></div>');
                    e.insertBefore(t), e.css({"background-image": "url(" + r + ")", "background-color": u});
                    var a = function(t) {
                        t ? (i.set(o, "big"), e.removeClass("ui-header-banner-small"), e.addClass("ui-header-banner-big")) : (e.removeClass("ui-header-banner-big"), e.addClass("ui-header-banner-small"))
                    }, f = -1;
                    e.on("click", function() {
                        clearTimeout(f), i.set(o, "small"), location.href = s
                    }), e.find(".ui-header-banner-close").on("click", function(t) {
                        i.set(o, "close"), t.stopPropagation(), e.remove()
                    }), setTimeout(function() {
                        var e = i.get(o);
                        e === "small" ? a(!1) : (a(!0), n("body").one("click", function() {
                            a(!1)
                        })), f = setTimeout(function() {
                            a(!1)
                        }, 6e4)
                    }, 10)
                }), a.prop("src", r)
            }
        }});
    t.exports = s
});
define("js/6v/biz/common/header/_dev/src/sundry/sundry-v4-sc.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/base/base.js?t=9ffb9372_42ecace20", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c", "js/6v/biz/common/header/_dev/src/sundry/v4/i18n/en-us.js?t=9cd36b37_19adb9c7d", "js/6v/biz/common/header/_dev/src/sundry/v4/action.js?t=bf0655ba_14982b9283", "js/6v/biz/common/header/_dev/src/sundry/v4/extend.js?t=cef2049c_4454b6e5c", "js/6v/biz/common/header/_dev/src/sundry/v4/anchor.js?t=b99b33fd_4454b6e5c", "js/6v/lib/arale/overlay/mask.js?t=fc06462d_9bf424288", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/dialog/dialog.js?t=d4985192_d20dbf99b", "js/6v/lib/icbu/dialog/dialog.js?t=eb1bcc2f_fffe8e348", "js/6v/biz/common/switch-language/switch-language.js?t=f11e9419_12d40d5bb6", "js/6v/biz/common/header/_dev/src/sundry/v4/language.js?t=a8105492_13dbac900b", "js/6v/biz/common/nav/nav.js?t=d540e860_78618aa92", "js/6v/biz/common/header/_dev/src/sundry/v4/categories.js?t=d3fca55f_d5eead47a", "js/6v/lib/gallery/store/store.js?t=66ea0bf6_0", "js/6v/biz/common/header/_dev/src/sundry/v4/banner.js?t=5e01fe1a_495b4da16"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/base/base.js?t=9ffb9372_42ecace20"), i = require("js/6v/biz/common/header/_dev/src/sundry/v4/action.js?t=bf0655ba_14982b9283"), s = require("js/6v/biz/common/header/_dev/src/sundry/v4/extend.js?t=cef2049c_4454b6e5c"), o = require("js/6v/biz/common/header/_dev/src/sundry/v4/anchor.js?t=b99b33fd_4454b6e5c"), u = require("js/6v/biz/common/header/_dev/src/sundry/v4/language.js?t=a8105492_13dbac900b"), a = require("js/6v/biz/common/header/_dev/src/sundry/v4/categories.js?t=d3fca55f_d5eead47a"), f = require("js/6v/biz/common/header/_dev/src/sundry/v4/banner.js?t=5e01fe1a_495b4da16"), l = r.extend({attrs: {containerId: "#header2012", mods: ["anchor", "action", "extend"], controllers: {action: function(e) {
                    var t = (new i({modElm: e.getElement(".ui-header-action")}, e)).run();
                    if (!t.disabled)
                        return t
                }, extend: function(e) {
                    var t = (new s({modElm: e.getElement(".ui-header-extend")}, e)).run();
                    if (!t.disabled)
                        return t
                }, anchor: function(e) {
                    var t = (new o({modElm: e.getElement(".ui-header-anchor")}, e)).run();
                    if (!t.disabled)
                        return t
                }, language: function(e) {
                    var t = (new u({modElm: e.getElement(".ui-header-lan")}, e)).run();
                    if (!t.disabled)
                        return t
                }, categories: function(e) {
                    var t = (new a({modElm: e.getElement(".ui-header-categories"), containerElm: n(e.get("categoryContainerId")), ajaxUrl: e.get("categoryAjaxUrl")}, e)).run();
                    if (!t.disabled)
                        return t
                }}}, run: function() {
            return this.element = this.getContainer(), l.superclass.run.call(this), (new f({headerElm: this.element})).run(), this
        }, getOperation: function() {
            return this.getModList()
        }});
    return l
});
define("js/6v/biz/common/header/_dev/src/header-v4-sc.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/biz/common/header/_dev/src/base/base.js?t=9ffb9372_42ecace20", "js/6v/biz/common/header/_dev/src/sundry/v4/base.js?t=1680a03c_42ecace20", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c", "js/6v/biz/common/header/_dev/src/sundry/v4/i18n/en-us.js?t=9cd36b37_19adb9c7d", "js/6v/biz/common/header/_dev/src/sundry/v4/action.js?t=bf0655ba_14982b9283", "js/6v/biz/common/header/_dev/src/sundry/v4/extend.js?t=cef2049c_4454b6e5c", "js/6v/biz/common/header/_dev/src/sundry/v4/anchor.js?t=b99b33fd_4454b6e5c", "js/6v/lib/arale/overlay/mask.js?t=fc06462d_9bf424288", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/dialog/dialog.js?t=d4985192_d20dbf99b", "js/6v/lib/icbu/dialog/dialog.js?t=eb1bcc2f_fffe8e348", "js/6v/biz/common/switch-language/switch-language.js?t=f11e9419_12d40d5bb6", "js/6v/biz/common/header/_dev/src/sundry/v4/language.js?t=a8105492_13dbac900b", "js/6v/biz/common/nav/nav.js?t=d540e860_78618aa92", "js/6v/biz/common/header/_dev/src/sundry/v4/categories.js?t=d3fca55f_d5eead47a", "js/6v/lib/gallery/store/store.js?t=66ea0bf6_0", "js/6v/biz/common/header/_dev/src/sundry/v4/banner.js?t=5e01fe1a_495b4da16", "js/6v/biz/common/header/_dev/src/sundry/sundry-v4-sc.js?t=92aec55b_242a4e2803", "js/6v/biz/common/header/header-module-base.js?t=40a811fd_4cec66192", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148", "js/6v/biz/common/cookie-info/cookie-info.js?t=d81524d_5b39aefe8", "js/6v/lib/icbu/gdata/gdata.js?t=66132cea_d3949ad8", "js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a", "js/6v/biz/common/beacon/beacon-v4-sc.js?t=5f85c34f_1b82d9ed47", "js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481", "js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b", "js/6v/biz/common/searchbar/searchbar-v4-sc.js?t=6cc4ab4b_198cc262a1"], function(require, e, t) {
    var n = require("js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0"), r = require("js/6v/biz/common/header/_dev/src/sundry/sundry-v4-sc.js?t=92aec55b_242a4e2803"), i = require("js/6v/biz/common/beacon/beacon-v4-sc.js?t=5f85c34f_1b82d9ed47"), s = require("js/6v/biz/common/searchbar/searchbar-v4-sc.js?t=6cc4ab4b_198cc262a1");
    t.exports = {run: function(e) {
            var t = n.extend({containerId: "#new-header", remoteConfig: null, mod: {}, beacon: {}, searchbar: {}, sundry: {}}, e), o = this, u = function() {
                var e = (new r(o.merge(t, "sundry"))).run(), u = (new i(o.merge(t, "beacon"))).run(), a = (new s(o.merge(t, "searchbar"))).run();
                return o.containerElm = n(t.containerId), o.rwd(t), n.type(t.initComplete) === "function" && t.initComplete.call(o, u.getOperation(), e.getOperation(), a.getOperation()), o.containerElm.find(".ui-header-action-rfq").mouseenter(function() {
                    dmtrack.dotstat(6168)
                }), {sundry: e, beacon: u, searchbar: a}
            };
            if (t.remoteConfig)
                try {
                    n.ajax({type: "get", async: !1, url: t.remoteConfig, dataType: "jsonp", jsonpCallback: "headerConfigRemote", success: function(e) {
                            e.mod.searchbar.push("type"), t = n.extend(t, e || {});
                            var r = u();
                            r.sundry.element.find(".ui-header-categories").hide()
                        }})
                } catch (a) {
                }
            else
                u()
        }, rwd: function(e) {
            if (n.browser.msie && n.browser.version < 9 && n(e.containerId).parents(".ui-header-rwd").length > 0) {
                var t = -1, r = n(window), i = n("html"), s = function() {
                    var e = i.width();
                    if (e === 0)
                        return;
                    i.addClass("ie-desc-l"), e < 1200 ? i.addClass("ie-desc-m") : i.removeClass("ie-desc-m"), e < 990 ? i.addClass("ie-desc-s") : i.removeClass("ie-desc-s"), e < 720 ? i.addClass("ie-desc-xs") : i.removeClass("ie-desc-xs")
                };
                r.on("resize", function() {
                    clearTimeout(t), t = setTimeout(function() {
                        s()
                    }, 10)
                }), s()
            }
        }, merge: function(e, t) {
            var r = e.mod, i = n.extend({}, e, {mod: r[t] === undefined ? "ALL" : r[t]}, e[t]);
            return t === "sundry" ? i.containerId = n(e.containerId) : (i.headerElm = n(e.containerId), i.containerId = n(e.containerId).find(".ui-" + t)), i
        }}
});
define("js/6v/biz/common/header/header-v4-sc.js", ["js/6v/lib/gallery/jquery/jquery.js?t=42dbffc8_0", "js/6v/lib/arale/class/class.js?t=46d5b2b6_b55a82c1", "js/6v/lib/arale/events/events.js?t=a19fdeb1_20c2a225", "js/6v/lib/arale/base/base.js?t=6d858051_37e694e07", "js/6v/lib/arale/position/position.js?t=74a5306e_9f5599e7", "js/6v/lib/arale/iframe-shim/iframe-shim.js?t=a1bd6b12_1ba0f5442", "js/6v/lib/arale/widget/widget.js?t=b3ba6d9e_5bc1979a5", "js/6v/lib/arale/overlay/overlay.js?t=835c813c_94f70b08c", "js/6v/lib/arale/popup/popup.js?t=85ab1bd8_a41305caa", "js/6v/biz/common/mcms/mcms.js?t=9dcdad51_fd0def2c", "js/6v/lib/arale/overlay/mask.js?t=fc06462d_9bf424288", "js/6v/lib/gallery/handlebars/handlebars.js?t=c8d33d58_0", "js/6v/lib/arale/templatable/templatable.js?t=398b1ce2_11f95a635", "js/6v/lib/arale/dialog/dialog.js?t=d4985192_d20dbf99b", "js/6v/lib/icbu/dialog/dialog.js?t=eb1bcc2f_fffe8e348", "js/6v/biz/common/switch-language/switch-language.js?t=f11e9419_12d40d5bb6", "js/6v/biz/common/nav/nav.js?t=d540e860_78618aa92", "js/6v/lib/gallery/store/store.js?t=66ea0bf6_0", "js/6v/biz/common/header/header-module-base.js?t=40a811fd_4cec66192", "js/6v/lib/arale/cookie/cookie.js?t=c3767afd_2fb98148", "js/6v/biz/common/cookie-info/cookie-info.js?t=d81524d_5b39aefe8", "js/6v/lib/icbu/gdata/gdata.js?t=66132cea_d3949ad8", "js/6v/biz/common/domdot/domdot.js?t=3f0775f0_17c83c78a", "js/6v/biz/common/beacon/beacon-v4-sc.js?t=5f85c34f_1b82d9ed47", "js/6v/lib/arale/placeholder/placeholder.js?t=e0d97a9a_faeed481", "js/6v/lib/arale/autocomplete/autocomplete.js?t=fcb15b28_cd30f522b", "js/6v/biz/common/searchbar/searchbar-v4-sc.js?t=6cc4ab4b_198cc262a1"], function(require, e, t) {
    t.exports = require("js/6v/biz/common/header/_dev/src/header-v4-sc.js?t=d0ad7b64_3f3f96475d")
});