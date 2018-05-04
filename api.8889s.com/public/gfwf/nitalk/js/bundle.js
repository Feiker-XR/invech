!
function(t) {
    function e(s) {
        if (i[s]) return i[s].exports;
        var n = i[s] = {
            exports: {},
            id: s,
            loaded: !1

        };
        return t[s].call(n.exports, n, n.exports, e),
        n.loaded = !0,
        n.exports

    }
    var i = {};
    return e.m = t,
    e.c = i,
    e.p = "",
    e(0)

} ([function(t, e, i) {
    t.exports = i(6)

},
function(t, e) {
    t.exports = function() {
        var t = [];
        return t.toString = function() {
            for (var t = [], e = 0; e < this.length; e++) {
                var i = this[e];
                i[2] ? t.push("@media " + i[2] + "{" + i[1] + "}") : t.push(i[1])

            }
            return t.join("")

        },
        t.i = function(e, i) {
            "string" == typeof e && (e = [
            [null, e, ""]
            ]);
            for (var s = {},
            n = 0; n < this.length; n++) {
                var a = this[n][0];
                "number" == typeof a && (s[a] = !0)

            }
            for (n = 0; n < e.length; n++) {
                var o = e[n];
                "number" == typeof o[0] && s[o[0]] || (i && !o[2] ? o[2] = i: i && (o[2] = "(" + o[2] + ") and (" + i + ")"), t.push(o))

            }

        },
        t

    }

},
function(t, e, i) {
    function s(t, e) {
        for (var i = 0; i < t.length; i++) {
            var s = t[i],
            n = u[s.id];
            if (n) {
                n.refs++;
                for (var a = 0; a < n.parts.length; a++) n.parts[a](s.parts[a]);
                for (; a < s.parts.length; a++) n.parts.push(r(s.parts[a], e))

            } else {
                for (var o = [], a = 0; a < s.parts.length; a++) o.push(r(s.parts[a], e));
                u[s.id] = {
                    id: s.id,
                    refs: 1,
                    parts: o

                }

            }

        }

    }
    function n(t) {
        for (var e = [], i = {},
        s = 0; s < t.length; s++) {
            var n = t[s],
            a = n[0],
            o = n[1],
            r = n[2],
            l = n[3],
            c = {
                css: o,
                media: r,
                sourceMap: l

            };
            i[a] ? i[a].parts.push(c) : e.push(i[a] = {
                id: a,
                parts: [c]

            })

        }
        return e

    }
    function a() {
        var t = document.createElement("style"),
        e = f();
        return t.type = "text/css",
        e.appendChild(t),
        t

    }
    function o() {
        var t = document.createElement("link"),
        e = f();
        return t.rel = "stylesheet",
        e.appendChild(t),
        t

    }
    function r(t, e) {
        var i,
        s,
        n;
        if (e.singleton) {
            var r = m++;
            i = g || (g = a()),
            s = l.bind(null, i, r, !1),
            n = l.bind(null, i, r, !0)

        } else t.sourceMap && "function" == typeof URL && "function" == typeof URL.createObjectURL && "function" == typeof URL.revokeObjectURL && "function" == typeof Blob && "function" == typeof btoa ? (i = o(), s = h.bind(null, i), n = function() {
            i.parentNode.removeChild(i),
            i.href && URL.revokeObjectURL(i.href)

        }) : (i = a(), s = c.bind(null, i), n = function() {
            i.parentNode.removeChild(i)

        });
        return s(t),
        function(e) {
            if (e) {
                if (e.css === t.css && e.media === t.media && e.sourceMap === t.sourceMap) return;
                s(t = e)

            } else n()

        }

    }
    function l(t, e, i, s) {
        var n = i ? "": s.css;
        if (t.styleSheet) t.styleSheet.cssText = _(e, n);
        else {
            var a = document.createTextNode(n),
            o = t.childNodes;
            o[e] && t.removeChild(o[e]),
            o.length ? t.insertBefore(a, o[e]) : t.appendChild(a)

        }

    }
    function c(t, e) {
        var i = e.css,
        s = e.media;
        e.sourceMap;
        if (s && t.setAttribute("media", s), t.styleSheet) t.styleSheet.cssText = i;
        else {
            for (; t.firstChild;) t.removeChild(t.firstChild);
            t.appendChild(document.createTextNode(i))

        }

    }
    function h(t, e) {
        var i = e.css,
        s = (e.media, e.sourceMap);
        s && (i += "\n/*# sourceMappingURL=data:application/json;base64," + btoa(unescape(encodeURIComponent(JSON.stringify(s)))) + " */");
        var n = new Blob([i], {
            type: "text/css"

        }),
        a = t.href;
        t.href = URL.createObjectURL(n),
        a && URL.revokeObjectURL(a)

    }
    var u = {},
    d = function(t) {
        var e;
        return function() {
            return "undefined" == typeof e && (e = t.apply(this, arguments)),
            e

        }

    },
    p = d(function() {
        return /msie [6-9]\b/.test(window.navigator.userAgent.toLowerCase())

    }),
    f = d(function() {
        return document.head || document.getElementsByTagName("head")[0]

    }),
    g = null,
    m = 0;
    t.exports = function(t, e) {
        e = e || {},
        "undefined" == typeof e.singleton && (e.singleton = p());
        var i = n(t);
        return s(i, e),
        function(t) {
            for (var a = [], o = 0; o < i.length; o++) {
                var r = i[o],
                l = u[r.id];
                l.refs--,
                a.push(l)

            }
            if (t) {
                var c = n(t);
                s(c, e)

            }
            for (var o = 0; o < a.length; o++) {
                var l = a[o];
                if (0 === l.refs) {
                    for (var h = 0; h < l.parts.length; h++) l.parts[h]();
                    delete u[l.id]

                }

            }

        }

    };
    var _ = function() {
        var t = [];
        return function(e, i) {
            return t[e] = i,
            t.filter(Boolean).join("\n")

        }

    } ()

},
function(t, e, i) {
    (function(e) {
        "use strict";
        (function() {
            function e() {}
            e.img_path = "emoji/",
            e.sheet_path = "sheet_64.png",
            e.use_css_imgs = !1,
            e.colons_mode = !1,
            e.text_mode = !1,
            e.include_title = !1,
            e.allow_native = !0,
            e.use_sheet = !1,
            e.inits = {},
            e.map = {},
            e.replace_emoticons = function(t) {
                return e.init_emoticons(),
                t.replace(e.rx_emoticons, 
                function(t, i, s) {
                    var n = e.map.emoticons[s];
                    return n ? i + e.replacement(n, s) : t

                })

            },
            e.replace_emoticons_with_colons = function(t) {
                return e.init_emoticons(),
                t.replace(e.rx_emoticons, 
                function(t, i, s) {
                    var n = e.data[e.map.emoticons[s]][3][0];
                    return n ? i + ":" + n + ":": t

                })

            },
            e.replace_colons = function(t) {
                return e.init_colons(),
                t.replace(e.rx_colons, 
                function(t) {
                    var i = t.substr(1, t.length - 2),
                    s = e.map.colons[i];
                    return s ? e.replacement(s, i, ":") : t

                })

            },
            e.replace_unified = function(t) {
                return e.init_unified(),
                t.replace(e.rx_unified, 
                function(t) {
                    var i = e.map.unified[t];
                    return i ? e.replacement(i) : t

                })

            },
            e.replacement = function(t, i, s) {
                if (s = s || "", e.colons_mode) return ":" + e.data[t][3][0] + ":";
                var n = i ? s + i + s: e.data[t][6] || s + e.data[t][3][0] + s;
                if (e.text_mode) return n;
                if (e.init_env(), "unified" == e.replace_mode && e.allow_native && e.data[t][0][0]) return e.data[t][0][0];
                if ("softbank" == e.replace_mode && e.allow_native && e.data[t][1]) return e.data[t][1];
                if ("google" == e.replace_mode && e.allow_native && e.data[t][2]) return e.data[t][2];
                var a = e.data[t][7] || e.img_path + t + ".png",
                o = e.include_title ? ' title="' + (i || e.data[t][3][0]) + '"': "",
                r = e.include_text ? s + (i || e.data[t][3][0]) + s: "";
                if (e.supports_css) {
                    var l = e.data[t][4],
                    c = e.data[t][5];
                    if (e.use_sheet && null != l && null != c) {
                        var h = 100 / (e.sheet_size - 1),
                        u = "background: url(" + e.sheet_path + ");background-position:" + h * l + "% " + h * c + "%;background-size:" + e.sheet_size + "00%";
                        return '<span class="emoji-outer emoji-sizer"><span class="emoji-inner" style="' + u + '"' + o + ">" + r + "</span></span>"

                    }
                    return e.use_css_imgs ? '<span class="emoji emoji-' + t + '"' + o + ">" + r + "</span>": '<span class="emoji emoji-sizer" style="background-image:url(' + a + ')"' + o + ">" + r + "</span>"

                }
                return '<img src="' + a + '" class="emoji" ' + o + "/>"

            },
            e.init_emoticons = function() {
                if (!e.inits.emoticons) {
                    e.init_colons(),
                    e.inits.emoticons = 1;
                    var t = [];
                    e.map.emoticons = {};
                    for (var i in e.emoticons_data) {
                        var s = i.replace(/\&/g, "&amp;").replace(/\</g, "&lt;").replace(/\>/g, "&gt;");
                        e.map.colons[e.emoticons_data[i]] && (e.map.emoticons[s] = e.map.colons[e.emoticons_data[i]], t.push(e.escape_rx(s)))

                    }
                    e.rx_emoticons = new RegExp("(^|\\s)(" + t.join("|") + ")(?=$|[\\s|\\?\\.,!])", "g")

                }

            },
            e.init_colons = function() {
                if (!e.inits.colons) {
                    e.inits.colons = 1,
                    e.rx_colons = new RegExp(":[^\\s:]+:", "g"),
                    e.map.colons = {};
                    for (var t in e.data) for (var i = 0; i < e.data[t][3].length; i++) e.map.colons[e.data[t][3][i]] = t

                }

            },
            e.init_unified = function() {
                if (!e.inits.unified) {
                    e.inits.unified = 1;
                    var t = [];
                    e.map.unified = {};
                    for (var i in e.data) for (var s = 0; s < e.data[i][0].length; s++) t.push(e.data[i][0][s]),
                    e.map.unified[e.data[i][0][s]] = i;
                    e.rx_unified = new RegExp("(" + t.join("|") + ")", "g")

                }

            },
            e.init_env = function() {
                if (!e.inits.env) {
                    e.inits.env = 1,
                    e.replace_mode = "img",
                    e.supports_css = !1;
                    var t = navigator.userAgent;
                    if (window.getComputedStyle) {
                        var i = window.getComputedStyle(document.body);
                        (i["background-size"] || i.backgroundSize) && (e.supports_css = !0)

                    }
                    if (t.match(/(iPhone|iPod|iPad|iPhone\s+Simulator)/i)) {
                        if (t.match(/OS\s+[12345]/i)) return void(e.replace_mode = "softbank");
                        if (t.match(/OS\s+[6789]/i)) return void(e.replace_mode = "unified")

                    }
                    return t.match(/Mac OS X 10[._ ](?:[789]|1\d)/i) && !t.match(/Chrome/i) ? void(e.replace_mode = "unified") : t.match(/Windows NT 6.[1-9]/i) && !t.match(/Chrome/i) ? void(e.replace_mode = "unified") : void(e.supports_css && (e.replace_mode = "css"))

                }

            },
            e.escape_rx = function(t) {
                return t.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&")

            },
            e.sheet_size = 30,
            e.data = {
                "00a9": [
                ["©"], "", "󾬩", ["copyright"], 0, 0],
                "00ae": [
                ["®"], "", "󾬭", ["registered"], 0, 1],
                "203c": [
                ["‼️", "‼"], "", "󾬆", ["bangbang"], 0, 2],
                2049: [
                ["⁉️", "⁉"], "", "󾬅", ["interrobang"], 0, 3],
                2122: [
                ["™"], "", "󾬪", ["tm"], 0, 4],
                2139: [
                ["ℹ️", "ℹ"], "", "󾭇", ["information_source"], 0, 5],
                2194: [
                ["↔️", "↔"], "", "󾫶", ["left_right_arrow"], 0, 6],
                2195: [
                ["↕️", "↕"], "", "󾫷", ["arrow_up_down"], 0, 7],
                2196: [
                ["↖️", "↖"], "", "󾫲", ["arrow_upper_left"], 0, 8],
                2197: [
                ["↗️", "↗"], "", "󾫰", ["arrow_upper_right"], 0, 9],
                2198: [
                ["↘️", "↘"], "", "󾫱", ["arrow_lower_right"], 0, 10],
                2199: [
                ["↙️", "↙"], "", "󾫳", ["arrow_lower_left"], 0, 11],
                "21a9": [
                ["↩️", "↩"], "", "󾮃", ["leftwards_arrow_with_hook"], 0, 12],
                "21aa": [
                ["↪️", "↪"], "", "󾮈", ["arrow_right_hook"], 0, 13],
                "231a": [
                ["⌚️", "⌚"], "", "󾀝", ["watch"], 0, 14],
                "231b": [
                ["⌛️", "⌛"], "", "󾀜", ["hourglass"], 0, 15],
                "23e9": [
                ["⏩"], "", "󾫾", ["fast_forward"], 0, 16],
                "23ea": [
                ["⏪"], "", "󾫿", ["rewind"], 0, 17],
                "23eb": [
                ["⏫"], "", "󾬃", ["arrow_double_up"], 0, 18],
                "23ec": [
                ["⏬"], "", "󾬂", ["arrow_double_down"], 0, 19],
                "23f0": [
                ["⏰"], "", "󾀪", ["alarm_clock"], 0, 20],
                "23f3": [
                ["⏳"], "", "󾀛", ["hourglass_flowing_sand"], 0, 21],
                "24c2": [
                ["Ⓜ️", "Ⓜ"], "", "󾟡", ["m"], 0, 22],
                "25aa": [
                ["▪️", "▪"], "", "󾭮", ["black_small_square"], 0, 23],
                "25ab": [
                ["▫️", "▫"], "", "󾭭", ["white_small_square"], 0, 24],
                "25b6": [
                ["▶️", "▶"], "", "󾫼", ["arrow_forward"], 0, 25],
                "25c0": [
                ["◀️", "◀"], "", "󾫽", ["arrow_backward"], 0, 26],
                "25fb": [
                ["◻️", "◻"], "", "󾭱", ["white_medium_square"], 0, 27],
                "25fc": [
                ["◼️", "◼"], "", "󾭲", ["black_medium_square"], 0, 28],
                "25fd": [
                ["◽️", "◽"], "", "󾭯", ["white_medium_small_square"], 0, 29],
                "25fe": [
                ["◾️", "◾"], "", "󾭰", ["black_medium_small_square"], 1, 0],
                2600: [
                ["☀️", "☀"], "", "󾀀", ["sunny"], 1, 1],
                2601: [
                ["☁️", "☁"], "", "󾀁", ["cloud"], 1, 2],
                "260e": [
                ["☎️", "☎"], "", "󾔣", ["phone", "telephone"], 1, 3],
                2611: [
                ["☑️", "☑"], "", "󾮋", ["ballot_box_with_check"], 1, 4],
                2614: [
                ["☔️", "☔"], "", "󾀂", ["umbrella"], 1, 5],
                2615: [
                ["☕️", "☕"], "", "󾦁", ["coffee"], 1, 6],
                "261d": [
                ["☝️", "☝"], "", "󾮘", ["point_up"], 1, 7],
                "263a": [
                ["☺️", "☺"], "", "󾌶", ["relaxed"], 1, 8],
                2648: [
                ["♈️", "♈"], "", "󾀫", ["aries"], 1, 9],
                2649: [
                ["♉️", "♉"], "", "󾀬", ["taurus"], 1, 10],
                "264a": [
                ["♊️", "♊"], "", "󾀭", ["gemini"], 1, 11],
                "264b": [
                ["♋️", "♋"], "", "󾀮", ["cancer"], 1, 12],
                "264c": [
                ["♌️", "♌"], "", "󾀯", ["leo"], 1, 13],
                "264d": [
                ["♍️", "♍"], "", "󾀰", ["virgo"], 1, 14],
                "264e": [
                ["♎️", "♎"], "", "󾀱", ["libra"], 1, 15],
                "264f": [
                ["♏️", "♏"], "", "󾀲", ["scorpius"], 1, 16],
                2650: [
                ["♐️", "♐"], "", "󾀳", ["sagittarius"], 1, 17],
                2651: [
                ["♑️", "♑"], "", "󾀴", ["capricorn"], 1, 18],
                2652: [
                ["♒️", "♒"], "", "󾀵", ["aquarius"], 1, 19],
                2653: [
                ["♓️", "♓"], "", "󾀶", ["pisces"], 1, 20],
                2660: [
                ["♠️", "♠"], "", "󾬛", ["spades"], 1, 21],
                2663: [
                ["♣️", "♣"], "", "󾬝", ["clubs"], 1, 22],
                2665: [
                ["♥️", "♥"], "", "󾬚", ["hearts"], 1, 23],
                2666: [
                ["♦️", "♦"], "", "󾬜", ["diamonds"], 1, 24],
                2668: [
                ["♨️", "♨"], "", "󾟺", ["hotsprings"], 1, 25],
                "267b": [
                ["♻️", "♻"], "", "󾬬", ["recycle"], 1, 26],
                "267f": [
                ["♿️", "♿"], "", "󾬠", ["wheelchair"], 1, 27],
                2693: [
                ["⚓️", "⚓"], "", "󾓁", ["anchor"], 1, 28],
                "26a0": [
                ["⚠️", "⚠"], "", "󾬣", ["warning"], 1, 29],
                "26a1": [
                ["⚡️", "⚡"], "", "󾀄", ["zap"], 2, 0],
                "26aa": [
                ["⚪️", "⚪"], "", "󾭥", ["white_circle"], 2, 1],
                "26ab": [
                ["⚫️", "⚫"], "", "󾭦", ["black_circle"], 2, 2],
                "26bd": [
                ["⚽️", "⚽"], "", "󾟔", ["soccer"], 2, 3],
                "26be": [
                ["⚾️", "⚾"], "", "󾟑", ["baseball"], 2, 4],
                "26c4": [
                ["⛄️", "⛄"], "", "󾀃", ["snowman"], 2, 5],
                "26c5": [
                ["⛅️", "⛅"], "", "󾀏", ["partly_sunny"], 2, 6],
                "26ce": [
                ["⛎"], "", "󾀷", ["ophiuchus"], 2, 7],
                "26d4": [
                ["⛔️", "⛔"], "", "󾬦", ["no_entry"], 2, 8],
                "26ea": [
                ["⛪️", "⛪"], "", "󾒻", ["church"], 2, 9],
                "26f2": [
                ["⛲️", "⛲"], "", "󾒼", ["fountain"], 2, 10],
                "26f3": [
                ["⛳️", "⛳"], "", "󾟒", ["golf"], 2, 11],
                "26f5": [
                ["⛵️", "⛵"], "", "󾟪", ["boat", "sailboat"], 2, 12],
                "26fa": [
                ["⛺️", "⛺"], "", "󾟻", ["tent"], 2, 13],
                "26fd": [
                ["⛽️", "⛽"], "", "󾟵", ["fuelpump"], 2, 14],
                2702: [
                ["✂️", "✂"], "", "󾔾", ["scissors"], 2, 15],
                2705: [
                ["✅"], "", "󾭊", ["white_check_mark"], 2, 16],
                2708: [
                ["✈️", "✈"], "", "󾟩", ["airplane"], 2, 17],
                2709: [
                ["✉️", "✉"], "", "󾔩", ["email", "envelope"], 2, 18],
                "270a": [
                ["✊"], "", "󾮓", ["fist"], 2, 19],
                "270b": [
                ["✋"], "", "󾮕", ["hand", "raised_hand"], 2, 20],
                "270c": [
                ["✌️", "✌"], "", "󾮔", ["v"], 2, 21],
                "270f": [
                ["✏️", "✏"], "", "󾔹", ["pencil2"], 2, 22],
                2712: [
                ["✒️", "✒"], "", "󾔶", ["black_nib"], 2, 23],
                2714: [
                ["✔️", "✔"], "", "󾭉", ["heavy_check_mark"], 2, 24],
                2716: [
                ["✖️", "✖"], "", "󾭓", ["heavy_multiplication_x"], 2, 25],
                2728: [
                ["✨"], "", "󾭠", ["sparkles"], 2, 26],
                2733: [
                ["✳️", "✳"], "", "󾭢", ["eight_spoked_asterisk"], 2, 27],
                2734: [
                ["✴️", "✴"], "", "󾭡", ["eight_pointed_black_star"], 2, 28],
                2744: [
                ["❄️", "❄"], "", "󾀎", ["snowflake"], 2, 29],
                2747: [
                ["❇️", "❇"], "", "󾭷", ["sparkle"], 3, 0],
                "274c": [
                ["❌"], "", "󾭅", ["x"], 3, 1],
                "274e": [
                ["❎"], "", "󾭆", ["negative_squared_cross_mark"], 3, 2],
                2753: [
                ["❓"], "", "󾬉", ["question"], 3, 3],
                2754: [
                ["❔"], "", "󾬊", ["grey_question"], 3, 4],
                2755: [
                ["❕"], "", "󾬋", ["grey_exclamation"], 3, 5],
                2757: [
                ["❗️", "❗"], "", "󾬄", ["exclamation", "heavy_exclamation_mark"], 3, 6],
                2764: [
                ["❤️", "❤"], "", "󾬌", ["heart"], 3, 7, "<3"],
                2795: [
                ["➕"], "", "󾭑", ["heavy_plus_sign"], 3, 8],
                2796: [
                ["➖"], "", "󾭒", ["heavy_minus_sign"], 3, 9],
                2797: [
                ["➗"], "", "󾭔", ["heavy_division_sign"], 3, 10],
                "27a1": [
                ["➡️", "➡"], "", "󾫺", ["arrow_right"], 3, 11],
                "27b0": [
                ["➰"], "", "󾬈", ["curly_loop"], 3, 12],
                "27bf": [
                ["➿"], "", "󾠫", ["loop"], 3, 13],
                2934: [
                ["⤴️", "⤴"], "", "󾫴", ["arrow_heading_up"], 3, 14],
                2935: [
                ["⤵️", "⤵"], "", "󾫵", ["arrow_heading_down"], 3, 15],
                "2b05": [
                ["⬅️", "⬅"], "", "󾫻", ["arrow_left"], 3, 16],
                "2b06": [
                ["⬆️", "⬆"], "", "󾫸", ["arrow_up"], 3, 17],
                "2b07": [
                ["⬇️", "⬇"], "", "󾫹", ["arrow_down"], 3, 18],
                "2b1b": [
                ["⬛️", "⬛"], "", "󾭬", ["black_large_square"], 3, 19],
                "2b1c": [
                ["⬜️", "⬜"], "", "󾭫", ["white_large_square"], 3, 20],
                "2b50": [
                ["⭐️", "⭐"], "", "󾭨", ["star"], 3, 21],
                "2b55": [
                ["⭕️", "⭕"], "", "󾭄", ["o"], 3, 22],
                3030: [
                ["〰"], "", "󾬇", ["wavy_dash"], 3, 23],
                "303d": [
                ["〽️", "〽"], "", "󾠛", ["part_alternation_mark"], 3, 24],
                3297: [
                ["㊗️", "㊗"], "", "󾭃", ["congratulations"], 3, 25],
                3299: [
                ["㊙️", "㊙"], "", "󾬫", ["secret"], 3, 26],
                "1f004": [
                ["🀄️", "🀄"], "", "󾠋", ["mahjong"], 3, 27],
                "1f0cf": [
                ["🃏"], "", "󾠒", ["black_joker"], 3, 28],
                "1f170": [
                ["🅰"], "", "󾔋", ["a"], 3, 29],
                "1f171": [
                ["🅱"], "", "󾔌", ["b"], 4, 0],
                "1f17e": [
                ["🅾"], "", "󾔎", ["o2"], 4, 1],
                "1f17f": [
                ["🅿️", "🅿"], "", "󾟶", ["parking"], 4, 2],
                "1f18e": [
                ["🆎"], "", "󾔍", ["ab"], 4, 3],
                "1f191": [
                ["🆑"], "", "󾮄", ["cl"], 4, 4],
                "1f192": [
                ["🆒"], "", "󾬸", ["cool"], 4, 5],
                "1f193": [
                ["🆓"], "", "󾬡", ["free"], 4, 6],
                "1f194": [
                ["🆔"], "", "󾮁", ["id"], 4, 7],
                "1f195": [
                ["🆕"], "", "󾬶", ["new"], 4, 8],
                "1f196": [
                ["🆖"], "", "󾬨", ["ng"], 4, 9],
                "1f197": [
                ["🆗"], "", "󾬧", ["ok"], 4, 10],
                "1f198": [
                ["🆘"], "", "󾭏", ["sos"], 4, 11],
                "1f199": [
                ["🆙"], "", "󾬷", ["up"], 4, 12],
                "1f19a": [
                ["🆚"], "", "󾬲", ["vs"], 4, 13],
                "1f201": [
                ["🈁"], "", "󾬤", ["koko"], 4, 14],
                "1f202": [
                ["🈂"], "", "󾬿", ["sa"], 4, 15],
                "1f21a": [
                ["🈚️", "🈚"], "", "󾬺", ["u7121"], 4, 16],
                "1f22f": [
                ["🈯️", "🈯"], "", "󾭀", ["u6307"], 4, 17],
                "1f232": [
                ["🈲"], "", "󾬮", ["u7981"], 4, 18],
                "1f233": [
                ["🈳"], "", "󾬯", ["u7a7a"], 4, 19],
                "1f234": [
                ["🈴"], "", "󾬰", ["u5408"], 4, 20],
                "1f235": [
                ["🈵"], "", "󾬱", ["u6e80"], 4, 21],
                "1f236": [
                ["🈶"], "", "󾬹", ["u6709"], 4, 22],
                "1f237": [
                ["🈷"], "", "󾬻", ["u6708"], 4, 23],
                "1f238": [
                ["🈸"], "", "󾬼", ["u7533"], 4, 24],
                "1f239": [
                ["🈹"], "", "󾬾", ["u5272"], 4, 25],
                "1f23a": [
                ["🈺"], "", "󾭁", ["u55b6"], 4, 26],
                "1f250": [
                ["🉐"], "", "󾬽", ["ideograph_advantage"], 4, 27],
                "1f251": [
                ["🉑"], "", "󾭐", ["accept"], 4, 28],
                "1f300": [
                ["🌀"], "", "󾀅", ["cyclone"], 4, 29],
                "1f301": [
                ["🌁"], "", "󾀆", ["foggy"], 5, 0],
                "1f302": [
                ["🌂"], "", "󾀇", ["closed_umbrella"], 5, 1],
                "1f303": [
                ["🌃"], "", "󾀈", ["night_with_stars"], 5, 2],
                "1f304": [
                ["🌄"], "", "󾀉", ["sunrise_over_mountains"], 5, 3],
                "1f305": [
                ["🌅"], "", "󾀊", ["sunrise"], 5, 4],
                "1f306": [
                ["🌆"], "", "󾀋", ["city_sunset"], 5, 5],
                "1f307": [
                ["🌇"], "", "󾀌", ["city_sunrise"], 5, 6],
                "1f308": [
                ["🌈"], "", "󾀍", ["rainbow"], 5, 7],
                "1f309": [
                ["🌉"], "", "󾀐", ["bridge_at_night"], 5, 8],
                "1f30a": [
                ["🌊"], "", "󾀸", ["ocean"], 5, 9],
                "1f30b": [
                ["🌋"], "", "󾀺", ["volcano"], 5, 10],
                "1f30c": [
                ["🌌"], "", "󾀻", ["milky_way"], 5, 11],
                "1f30d": [
                ["🌍"], "", "", ["earth_africa"], 5, 12],
                "1f30e": [
                ["🌎"], "", "", ["earth_americas"], 5, 13],
                "1f30f": [
                ["🌏"], "", "󾀹", ["earth_asia"], 5, 14],
                "1f310": [
                ["🌐"], "", "", ["globe_with_meridians"], 5, 15],
                "1f311": [
                ["🌑"], "", "󾀑", ["new_moon"], 5, 16],
                "1f312": [
                ["🌒"], "", "", ["waxing_crescent_moon"], 5, 17],
                "1f313": [
                ["🌓"], "", "󾀓", ["first_quarter_moon"], 5, 18],
                "1f314": [
                ["🌔"], "", "󾀒", ["moon", "waxing_gibbous_moon"], 5, 19],
                "1f315": [
                ["🌕"], "", "󾀕", ["full_moon"], 5, 20],
                "1f316": [
                ["🌖"], "", "", ["waning_gibbous_moon"], 5, 21],
                "1f317": [
                ["🌗"], "", "", ["last_quarter_moon"], 5, 22],
                "1f318": [
                ["🌘"], "", "", ["waning_crescent_moon"], 5, 23],
                "1f319": [
                ["🌙"], "", "󾀔", ["crescent_moon"], 5, 24],
                "1f31a": [
                ["🌚"], "", "", ["new_moon_with_face"], 5, 25],
                "1f31b": [
                ["🌛"], "", "󾀖", ["first_quarter_moon_with_face"], 5, 26],
                "1f31c": [
                ["🌜"], "", "", ["last_quarter_moon_with_face"], 5, 27],
                "1f31d": [
                ["🌝"], "", "", ["full_moon_with_face"], 5, 28],
                "1f31e": [
                ["🌞"], "", "", ["sun_with_face"], 5, 29],
                "1f31f": [
                ["🌟"], "", "󾭩", ["star2"], 6, 0],
                "1f320": [
                ["🌠"], "", "󾭪", ["stars"], 6, 1],
                "1f330": [
                ["🌰"], "", "󾁌", ["chestnut"], 6, 2],
                "1f331": [
                ["🌱"], "", "󾀾", ["seedling"], 6, 3],
                "1f332": [
                ["🌲"], "", "", ["evergreen_tree"], 6, 4],
                "1f333": [
                ["🌳"], "", "", ["deciduous_tree"], 6, 5],
                "1f334": [
                ["🌴"], "", "󾁇", ["palm_tree"], 6, 6],
                "1f335": [
                ["🌵"], "", "󾁈", ["cactus"], 6, 7],
                "1f337": [
                ["🌷"], "", "󾀽", ["tulip"], 6, 8],
                "1f338": [
                ["🌸"], "", "󾁀", ["cherry_blossom"], 6, 9],
                "1f339": [
                ["🌹"], "", "󾁁", ["rose"], 6, 10],
                "1f33a": [
                ["🌺"], "", "󾁅", ["hibiscus"], 6, 11],
                "1f33b": [
                ["🌻"], "", "󾁆", ["sunflower"], 6, 12],
                "1f33c": [
                ["🌼"], "", "󾁍", ["blossom"], 6, 13],
                "1f33d": [
                ["🌽"], "", "󾁊", ["corn"], 6, 14],
                "1f33e": [
                ["🌾"], "", "󾁉", ["ear_of_rice"], 6, 15],
                "1f33f": [
                ["🌿"], "", "󾁎", ["herb"], 6, 16],
                "1f340": [
                ["🍀"], "", "󾀼", ["four_leaf_clover"], 6, 17],
                "1f341": [
                ["🍁"], "", "󾀿", ["maple_leaf"], 6, 18],
                "1f342": [
                ["🍂"], "", "󾁂", ["fallen_leaf"], 6, 19],
                "1f343": [
                ["🍃"], "", "󾁃", ["leaves"], 6, 20],
                "1f344": [
                ["🍄"], "", "󾁋", ["mushroom"], 6, 21],
                "1f345": [
                ["🍅"], "", "󾁕", ["tomato"], 6, 22],
                "1f346": [
                ["🍆"], "", "󾁖", ["eggplant"], 6, 23],
                "1f347": [
                ["🍇"], "", "󾁙", ["grapes"], 6, 24],
                "1f348": [
                ["🍈"], "", "󾁗", ["melon"], 6, 25],
                "1f349": [
                ["🍉"], "", "󾁔", ["watermelon"], 6, 26],
                "1f34a": [
                ["🍊"], "", "󾁒", ["tangerine"], 6, 27],
                "1f34b": [
                ["🍋"], "", "", ["lemon"], 6, 28],
                "1f34c": [
                ["🍌"], "", "󾁐", ["banana"], 6, 29],
                "1f34d": [
                ["🍍"], "", "󾁘", ["pineapple"], 7, 0],
                "1f34e": [
                ["🍎"], "", "󾁑", ["apple"], 7, 1],
                "1f34f": [
                ["🍏"], "", "󾁛", ["green_apple"], 7, 2],
                "1f350": [
                ["🍐"], "", "", ["pear"], 7, 3],
                "1f351": [
                ["🍑"], "", "󾁚", ["peach"], 7, 4],
                "1f352": [
                ["🍒"], "", "󾁏", ["cherries"], 7, 5],
                "1f353": [
                ["🍓"], "", "󾁓", ["strawberry"], 7, 6],
                "1f354": [
                ["🍔"], "", "󾥠", ["hamburger"], 7, 7],
                "1f355": [
                ["🍕"], "", "󾥵", ["pizza"], 7, 8],
                "1f356": [
                ["🍖"], "", "󾥲", ["meat_on_bone"], 7, 9],
                "1f357": [
                ["🍗"], "", "󾥶", ["poultry_leg"], 7, 10],
                "1f358": [
                ["🍘"], "", "󾥩", ["rice_cracker"], 7, 11],
                "1f359": [
                ["🍙"], "", "󾥡", ["rice_ball"], 7, 12],
                "1f35a": [
                ["🍚"], "", "󾥪", ["rice"], 7, 13],
                "1f35b": [
                ["🍛"], "", "󾥬", ["curry"], 7, 14],
                "1f35c": [
                ["🍜"], "", "󾥣", ["ramen"], 7, 15],
                "1f35d": [
                ["🍝"], "", "󾥫", ["spaghetti"], 7, 16],
                "1f35e": [
                ["🍞"], "", "󾥤", ["bread"], 7, 17],
                "1f35f": [
                ["🍟"], "", "󾥧", ["fries"], 7, 18],
                "1f360": [
                ["🍠"], "", "󾥴", ["sweet_potato"], 7, 19],
                "1f361": [
                ["🍡"], "", "󾥨", ["dango"], 7, 20],
                "1f362": [
                ["🍢"], "", "󾥭", ["oden"], 7, 21],
                "1f363": [
                ["🍣"], "", "󾥮", ["sushi"], 7, 22],
                "1f364": [
                ["🍤"], "", "󾥿", ["fried_shrimp"], 7, 23],
                "1f365": [
                ["🍥"], "", "󾥳", ["fish_cake"], 7, 24],
                "1f366": [
                ["🍦"], "", "󾥦", ["icecream"], 7, 25],
                "1f367": [
                ["🍧"], "", "󾥱", ["shaved_ice"], 7, 26],
                "1f368": [
                ["🍨"], "", "󾥷", ["ice_cream"], 7, 27],
                "1f369": [
                ["🍩"], "", "󾥸", ["doughnut"], 7, 28],
                "1f36a": [
                ["🍪"], "", "󾥹", ["cookie"], 7, 29],
                "1f36b": [
                ["🍫"], "", "󾥺", ["chocolate_bar"], 8, 0],
                "1f36c": [
                ["🍬"], "", "󾥻", ["candy"], 8, 1],
                "1f36d": [
                ["🍭"], "", "󾥼", ["lollipop"], 8, 2],
                "1f36e": [
                ["🍮"], "", "󾥽", ["custard"], 8, 3],
                "1f36f": [
                ["🍯"], "", "󾥾", ["honey_pot"], 8, 4],
                "1f370": [
                ["🍰"], "", "󾥢", ["cake"], 8, 5],
                "1f371": [
                ["🍱"], "", "󾥯", ["bento"], 8, 6],
                "1f372": [
                ["🍲"], "", "󾥰", ["stew"], 8, 7],
                "1f373": [
                ["🍳"], "", "󾥥", ["egg"], 8, 8],
                "1f374": [
                ["🍴"], "", "󾦀", ["fork_and_knife"], 8, 9],
                "1f375": [
                ["🍵"], "", "󾦄", ["tea"], 8, 10],
                "1f376": [
                ["🍶"], "", "󾦅", ["sake"], 8, 11],
                "1f377": [
                ["🍷"], "", "󾦆", ["wine_glass"], 8, 12],
                "1f378": [
                ["🍸"], "", "󾦂", ["cocktail"], 8, 13],
                "1f379": [
                ["🍹"], "", "󾦈", ["tropical_drink"], 8, 14],
                "1f37a": [
                ["🍺"], "", "󾦃", ["beer"], 8, 15],
                "1f37b": [
                ["🍻"], "", "󾦇", ["beers"], 8, 16],
                "1f37c": [
                ["🍼"], "", "", ["baby_bottle"], 8, 17],
                "1f380": [
                ["🎀"], "", "󾔏", ["ribbon"], 8, 18],
                "1f381": [
                ["🎁"], "", "󾔐", ["gift"], 8, 19],
                "1f382": [
                ["🎂"], "", "󾔑", ["birthday"], 8, 20],
                "1f383": [
                ["🎃"], "", "󾔟", ["jack_o_lantern"], 8, 21],
                "1f384": [
                ["🎄"], "", "󾔒", ["christmas_tree"], 8, 22],
                "1f385": [
                ["🎅"], "", "󾔓", ["santa"], 8, 23],
                "1f386": [
                ["🎆"], "", "󾔕", ["fireworks"], 8, 24],
                "1f387": [
                ["🎇"], "", "󾔝", ["sparkler"], 8, 25],
                "1f388": [
                ["🎈"], "", "󾔖", ["balloon"], 8, 26],
                "1f389": [
                ["🎉"], "", "󾔗", ["tada"], 8, 27],
                "1f38a": [
                ["🎊"], "", "󾔠", ["confetti_ball"], 8, 28],
                "1f38b": [
                ["🎋"], "", "󾔡", ["tanabata_tree"], 8, 29],
                "1f38c": [
                ["🎌"], "", "󾔔", ["crossed_flags"], 9, 0],
                "1f38d": [
                ["🎍"], "", "󾔘", ["bamboo"], 9, 1],
                "1f38e": [
                ["🎎"], "", "󾔙", ["dolls"], 9, 2],
                "1f38f": [
                ["🎏"], "", "󾔜", ["flags"], 9, 3],
                "1f390": [
                ["🎐"], "", "󾔞", ["wind_chime"], 9, 4],
                "1f391": [
                ["🎑"], "", "󾀗", ["rice_scene"], 9, 5],
                "1f392": [
                ["🎒"], "", "󾔛", ["school_satchel"], 9, 6],
                "1f393": [
                ["🎓"], "", "󾔚", ["mortar_board"], 9, 7],
                "1f3a0": [
                ["🎠"], "", "󾟼", ["carousel_horse"], 9, 8],
                "1f3a1": [
                ["🎡"], "", "󾟽", ["ferris_wheel"], 9, 9],
                "1f3a2": [
                ["🎢"], "", "󾟾", ["roller_coaster"], 9, 10],
                "1f3a3": [
                ["🎣"], "", "󾟿", ["fishing_pole_and_fish"], 9, 11],
                "1f3a4": [
                ["🎤"], "", "󾠀", ["microphone"], 9, 12],
                "1f3a5": [
                ["🎥"], "", "󾠁", ["movie_camera"], 9, 13],
                "1f3a6": [
                ["🎦"], "", "󾠂", ["cinema"], 9, 14],
                "1f3a7": [
                ["🎧"], "", "󾠃", ["headphones"], 9, 15],
                "1f3a8": [
                ["🎨"], "", "󾠄", ["art"], 9, 16],
                "1f3a9": [
                ["🎩"], "", "󾠅", ["tophat"], 9, 17],
                "1f3aa": [
                ["🎪"], "", "󾠆", ["circus_tent"], 9, 18],
                "1f3ab": [
                ["🎫"], "", "󾠇", ["ticket"], 9, 19],
                "1f3ac": [
                ["🎬"], "", "󾠈", ["clapper"], 9, 20],
                "1f3ad": [
                ["🎭"], "", "󾠉", ["performing_arts"], 9, 21],
                "1f3ae": [
                ["🎮"], "", "󾠊", ["video_game"], 9, 22],
                "1f3af": [
                ["🎯"], "", "󾠌", ["dart"], 9, 23],
                "1f3b0": [
                ["🎰"], "", "󾠍", ["slot_machine"], 9, 24],
                "1f3b1": [
                ["🎱"], "", "󾠎", ["8ball"], 9, 25],
                "1f3b2": [
                ["🎲"], "", "󾠏", ["game_die"], 9, 26],
                "1f3b3": [
                ["🎳"], "", "󾠐", ["bowling"], 9, 27],
                "1f3b4": [
                ["🎴"], "", "󾠑", ["flower_playing_cards"], 9, 28],
                "1f3b5": [
                ["🎵"], "", "󾠓", ["musical_note"], 9, 29],
                "1f3b6": [
                ["🎶"], "", "󾠔", ["notes"], 10, 0],
                "1f3b7": [
                ["🎷"], "", "󾠕", ["saxophone"], 10, 1],
                "1f3b8": [
                ["🎸"], "", "󾠖", ["guitar"], 10, 2],
                "1f3b9": [
                ["🎹"], "", "󾠗", ["musical_keyboard"], 10, 3],
                "1f3ba": [
                ["🎺"], "", "󾠘", ["trumpet"], 10, 4],
                "1f3bb": [
                ["🎻"], "", "󾠙", ["violin"], 10, 5],
                "1f3bc": [
                ["🎼"], "", "󾠚", ["musical_score"], 10, 6],
                "1f3bd": [
                ["🎽"], "", "󾟐", ["running_shirt_with_sash"], 10, 7],
                "1f3be": [
                ["🎾"], "", "󾟓", ["tennis"], 10, 8],
                "1f3bf": [
                ["🎿"], "", "󾟕", ["ski"], 10, 9],
                "1f3c0": [
                ["🏀"], "", "󾟖", ["basketball"], 10, 10],
                "1f3c1": [
                ["🏁"], "", "󾟗", ["checkered_flag"], 10, 11],
                "1f3c2": [
                ["🏂"], "", "󾟘", ["snowboarder"], 10, 12],
                "1f3c3": [
                ["🏃"], "", "󾟙", ["runner", "running"], 10, 13],
                "1f3c4": [
                ["🏄"], "", "󾟚", ["surfer"], 10, 14],
                "1f3c6": [
                ["🏆"], "", "󾟛", ["trophy"], 10, 15],
                "1f3c7": [
                ["🏇"], "", "", ["horse_racing"], 10, 16],
                "1f3c8": [
                ["🏈"], "", "󾟝", ["football"], 10, 17],
                "1f3c9": [
                ["🏉"], "", "", ["rugby_football"], 10, 18],
                "1f3ca": [
                ["🏊"], "", "󾟞", ["swimmer"], 10, 19],
                "1f3e0": [
                ["🏠"], "", "󾒰", ["house"], 10, 20],
                "1f3e1": [
                ["🏡"], "", "󾒱", ["house_with_garden"], 10, 21],
                "1f3e2": [
                ["🏢"], "", "󾒲", ["office"], 10, 22],
                "1f3e3": [
                ["🏣"], "", "󾒳", ["post_office"], 10, 23],
                "1f3e4": [
                ["🏤"], "", "", ["european_post_office"], 10, 24],
                "1f3e5": [
                ["🏥"], "", "󾒴", ["hospital"], 10, 25],
                "1f3e6": [
                ["🏦"], "", "󾒵", ["bank"], 10, 26],
                "1f3e7": [
                ["🏧"], "", "󾒶", ["atm"], 10, 27],
                "1f3e8": [
                ["🏨"], "", "󾒷", ["hotel"], 10, 28],
                "1f3e9": [
                ["🏩"], "", "󾒸", ["love_hotel"], 10, 29],
                "1f3ea": [
                ["🏪"], "", "󾒹", ["convenience_store"], 11, 0],
                "1f3eb": [
                ["🏫"], "", "󾒺", ["school"], 11, 1],
                "1f3ec": [
                ["🏬"], "", "󾒽", ["department_store"], 11, 2],
                "1f3ed": [
                ["🏭"], "", "󾓀", ["factory"], 11, 3],
                "1f3ee": [
                ["🏮"], "", "󾓂", ["izakaya_lantern", "lantern"], 11, 4],
                "1f3ef": [
                ["🏯"], "", "󾒾", ["japanese_castle"], 11, 5],
                "1f3f0": [
                ["🏰"], "", "󾒿", ["european_castle"], 11, 6],
                "1f400": [
                ["🐀"], "", "", ["rat"], 11, 7],
                "1f401": [
                ["🐁"], "", "", ["mouse2"], 11, 8],
                "1f402": [
                ["🐂"], "", "", ["ox"], 11, 9],
                "1f403": [
                ["🐃"], "", "", ["water_buffalo"], 11, 10],
                "1f404": [
                ["🐄"], "", "", ["cow2"], 11, 11],
                "1f405": [
                ["🐅"], "", "", ["tiger2"], 11, 12],
                "1f406": [
                ["🐆"], "", "", ["leopard"], 11, 13],
                "1f407": [
                ["🐇"], "", "", ["rabbit2"], 11, 14],
                "1f408": [
                ["🐈"], "", "", ["cat2"], 11, 15],
                "1f409": [
                ["🐉"], "", "", ["dragon"], 11, 16],
                "1f40a": [
                ["🐊"], "", "", ["crocodile"], 11, 17],
                "1f40b": [
                ["🐋"], "", "", ["whale2"], 11, 18],
                "1f40c": [
                ["🐌"], "", "󾆹", ["snail"], 11, 19],
                "1f40d": [
                ["🐍"], "", "󾇓", ["snake"], 11, 20],
                "1f40e": [
                ["🐎"], "", "󾟜", ["racehorse"], 11, 21],
                "1f40f": [
                ["🐏"], "", "", ["ram"], 11, 22],
                "1f410": [
                ["🐐"], "", "", ["goat"], 11, 23],
                "1f411": [
                ["🐑"], "", "󾇏", ["sheep"], 11, 24],
                "1f412": [
                ["🐒"], "", "󾇎", ["monkey"], 11, 25],
                "1f413": [
                ["🐓"], "", "", ["rooster"], 11, 26],
                "1f414": [
                ["🐔"], "", "󾇔", ["chicken"], 11, 27],
                "1f415": [
                ["🐕"], "", "", ["dog2"], 11, 28],
                "1f416": [
                ["🐖"], "", "", ["pig2"], 11, 29],
                "1f417": [
                ["🐗"], "", "󾇕", ["boar"], 12, 0],
                "1f418": [
                ["🐘"], "", "󾇌", ["elephant"], 12, 1],
                "1f419": [
                ["🐙"], "", "󾇅", ["octopus"], 12, 2],
                "1f41a": [
                ["🐚"], "", "󾇆", ["shell"], 12, 3],
                "1f41b": [
                ["🐛"], "", "󾇋", ["bug"], 12, 4],
                "1f41c": [
                ["🐜"], "", "󾇚", ["ant"], 12, 5],
                "1f41d": [
                ["🐝"], "", "󾇡", ["bee", "honeybee"], 12, 6],
                "1f41e": [
                ["🐞"], "", "󾇢", ["beetle"], 12, 7],
                "1f41f": [
                ["🐟"], "", "󾆽", ["fish"], 12, 8],
                "1f420": [
                ["🐠"], "", "󾇉", ["tropical_fish"], 12, 9],
                "1f421": [
                ["🐡"], "", "󾇙", ["blowfish"], 12, 10],
                "1f422": [
                ["🐢"], "", "󾇜", ["turtle"], 12, 11],
                "1f423": [
                ["🐣"], "", "󾇝", ["hatching_chick"], 12, 12],
                "1f424": [
                ["🐤"], "", "󾆺", ["baby_chick"], 12, 13],
                "1f425": [
                ["🐥"], "", "󾆻", ["hatched_chick"], 12, 14],
                "1f426": [
                ["🐦"], "", "󾇈", ["bird"], 12, 15],
                "1f427": [
                ["🐧"], "", "󾆼", ["penguin"], 12, 16],
                "1f428": [
                ["🐨"], "", "󾇍", ["koala"], 12, 17],
                "1f429": [
                ["🐩"], "", "󾇘", ["poodle"], 12, 18],
                "1f42a": [
                ["🐪"], "", "", ["dromedary_camel"], 12, 19],
                "1f42b": [
                ["🐫"], "", "󾇖", ["camel"], 12, 20],
                "1f42c": [
                ["🐬"], "", "󾇇", ["dolphin", "flipper"], 12, 21],
                "1f42d": [
                ["🐭"], "", "󾇂", ["mouse"], 12, 22],
                "1f42e": [
                ["🐮"], "", "󾇑", ["cow"], 12, 23],
                "1f42f": [
                ["🐯"], "", "󾇀", ["tiger"], 12, 24],
                "1f430": [
                ["🐰"], "", "󾇒", ["rabbit"], 12, 25],
                "1f431": [
                ["🐱"], "", "󾆸", ["cat"], 12, 26],
                "1f432": [
                ["🐲"], "", "󾇞", ["dragon_face"], 12, 27],
                "1f433": [
                ["🐳"], "", "󾇃", ["whale"], 12, 28],
                "1f434": [
                ["🐴"], "", "󾆾", ["horse"], 12, 29],
                "1f435": [
                ["🐵"], "", "󾇄", ["monkey_face"], 13, 0],
                "1f436": [
                ["🐶"], "", "󾆷", ["dog"], 13, 1],
                "1f437": [
                ["🐷"], "", "󾆿", ["pig"], 13, 2],
                "1f438": [
                ["🐸"], "", "󾇗", ["frog"], 13, 3],
                "1f439": [
                ["🐹"], "", "󾇊", ["hamster"], 13, 4],
                "1f43a": [
                ["🐺"], "", "󾇐", ["wolf"], 13, 5],
                "1f43b": [
                ["🐻"], "", "󾇁", ["bear"], 13, 6],
                "1f43c": [
                ["🐼"], "", "󾇟", ["panda_face"], 13, 7],
                "1f43d": [
                ["🐽"], "", "󾇠", ["pig_nose"], 13, 8],
                "1f43e": [
                ["🐾"], "", "󾇛", ["feet", "paw_prints"], 13, 9],
                "1f440": [
                ["👀"], "", "󾆐", ["eyes"], 13, 10],
                "1f442": [
                ["👂"], "", "󾆑", ["ear"], 13, 11],
                "1f443": [
                ["👃"], "", "󾆒", ["nose"], 13, 12],
                "1f444": [
                ["👄"], "", "󾆓", ["lips"], 13, 13],
                "1f445": [
                ["👅"], "", "󾆔", ["tongue"], 13, 14],
                "1f446": [
                ["👆"], "", "󾮙", ["point_up_2"], 13, 15],
                "1f447": [
                ["👇"], "", "󾮚", ["point_down"], 13, 16],
                "1f448": [
                ["👈"], "", "󾮛", ["point_left"], 13, 17],
                "1f449": [
                ["👉"], "", "󾮜", ["point_right"], 13, 18],
                "1f44a": [
                ["👊"], "", "󾮖", ["facepunch", "punch"], 13, 19],
                "1f44b": [
                ["👋"], "", "󾮝", ["wave"], 13, 20],
                "1f44c": [
                ["👌"], "", "󾮟", ["ok_hand"], 13, 21],
                "1f44d": [
                ["👍"], "", "󾮗", ["+1", "thumbsup"], 13, 22],
                "1f44e": [
                ["👎"], "", "󾮠", ["-1", "thumbsdown"], 13, 23],
                "1f44f": [
                ["👏"], "", "󾮞", ["clap"], 13, 24],
                "1f450": [
                ["👐"], "", "󾮡", ["open_hands"], 13, 25],
                "1f451": [
                ["👑"], "", "󾓑", ["crown"], 13, 26],
                "1f452": [
                ["👒"], "", "󾓔", ["womans_hat"], 13, 27],
                "1f453": [
                ["👓"], "", "󾓎", ["eyeglasses"], 13, 28],
                "1f454": [
                ["👔"], "", "󾓓", ["necktie"], 13, 29],
                "1f455": [
                ["👕"], "", "󾓏", ["shirt", "tshirt"], 14, 0],
                "1f456": [
                ["👖"], "", "󾓐", ["jeans"], 14, 1],
                "1f457": [
                ["👗"], "", "󾓕", ["dress"], 14, 2],
                "1f458": [
                ["👘"], "", "󾓙", ["kimono"], 14, 3],
                "1f459": [
                ["👙"], "", "󾓚", ["bikini"], 14, 4],
                "1f45a": [
                ["👚"], "", "󾓛", ["womans_clothes"], 14, 5],
                "1f45b": [
                ["👛"], "", "󾓜", ["purse"], 14, 6],
                "1f45c": [
                ["👜"], "", "󾓰", ["handbag"], 14, 7],
                "1f45d": [
                ["👝"], "", "󾓱", ["pouch"], 14, 8],
                "1f45e": [
                ["👞"], "", "󾓌", ["mans_shoe", "shoe"], 14, 9],
                "1f45f": [
                ["👟"], "", "󾓍", ["athletic_shoe"], 14, 10],
                "1f460": [
                ["👠"], "", "󾓖", ["high_heel"], 14, 11],
                "1f461": [
                ["👡"], "", "󾓗", ["sandal"], 14, 12],
                "1f462": [
                ["👢"], "", "󾓘", ["boot"], 14, 13],
                "1f463": [
                ["👣"], "", "󾕓", ["footprints"], 14, 14],
                "1f464": [
                ["👤"], "", "󾆚", ["bust_in_silhouette"], 14, 15],
                "1f465": [
                ["👥"], "", "", ["busts_in_silhouette"], 14, 16],
                "1f466": [
                ["👦"], "", "󾆛", ["boy"], 14, 17],
                "1f467": [
                ["👧"], "", "󾆜", ["girl"], 14, 18],
                "1f468": [
                ["👨"], "", "󾆝", ["man"], 14, 19],
                "1f469": [
                ["👩"], "", "󾆞", ["woman"], 14, 20],
                "1f46a": [
                ["👪"], "", "󾆟", ["family"], 14, 21],
                "1f46b": [
                ["👫"], "", "󾆠", ["couple"], 14, 22],
                "1f46c": [
                ["👬"], "", "", ["two_men_holding_hands"], 14, 23],
                "1f46d": [
                ["👭"], "", "", ["two_women_holding_hands"], 14, 24],
                "1f46e": [
                ["👮"], "", "󾆡", ["cop"], 14, 25],
                "1f46f": [
                ["👯"], "", "󾆢", ["dancers"], 14, 26],
                "1f470": [
                ["👰"], "", "󾆣", ["bride_with_veil"], 14, 27],
                "1f471": [
                ["👱"], "", "󾆤", ["person_with_blond_hair"], 14, 28],
                "1f472": [
                ["👲"], "", "󾆥", ["man_with_gua_pi_mao"], 14, 29],
                "1f473": [
                ["👳"], "", "󾆦", ["man_with_turban"], 15, 0],
                "1f474": [
                ["👴"], "", "󾆧", ["older_man"], 15, 1],
                "1f475": [
                ["👵"], "", "󾆨", ["older_woman"], 15, 2],
                "1f476": [
                ["👶"], "", "󾆩", ["baby"], 15, 3],
                "1f477": [
                ["👷"], "", "󾆪", ["construction_worker"], 15, 4],
                "1f478": [
                ["👸"], "", "󾆫", ["princess"], 15, 5],
                "1f479": [
                ["👹"], "", "󾆬", ["japanese_ogre"], 15, 6],
                "1f47a": [
                ["👺"], "", "󾆭", ["japanese_goblin"], 15, 7],
                "1f47b": [
                ["👻"], "", "󾆮", ["ghost"], 15, 8],
                "1f47c": [
                ["👼"], "", "󾆯", ["angel"], 15, 9],
                "1f47d": [
                ["👽"], "", "󾆰", ["alien"], 15, 10],
                "1f47e": [
                ["👾"], "", "󾆱", ["space_invader"], 15, 11],
                "1f47f": [
                ["👿"], "", "󾆲", ["imp"], 15, 12],
                "1f480": [
                ["💀"], "", "󾆳", ["skull"], 15, 13],
                "1f481": [
                ["💁"], "", "󾆴", ["information_desk_person"], 15, 14],
                "1f482": [
                ["💂"], "", "󾆵", ["guardsman"], 15, 15],
                "1f483": [
                ["💃"], "", "󾆶", ["dancer"], 15, 16],
                "1f484": [
                ["💄"], "", "󾆕", ["lipstick"], 15, 17],
                "1f485": [
                ["💅"], "", "󾆖", ["nail_care"], 15, 18],
                "1f486": [
                ["💆"], "", "󾆗", ["massage"], 15, 19],
                "1f487": [
                ["💇"], "", "󾆘", ["haircut"], 15, 20],
                "1f488": [
                ["💈"], "", "󾆙", ["barber"], 15, 21],
                "1f489": [
                ["💉"], "", "󾔉", ["syringe"], 15, 22],
                "1f48a": [
                ["💊"], "", "󾔊", ["pill"], 15, 23],
                "1f48b": [
                ["💋"], "", "󾠣", ["kiss"], 15, 24],
                "1f48c": [
                ["💌"], "", "󾠤", ["love_letter"], 15, 25],
                "1f48d": [
                ["💍"], "", "󾠥", ["ring"], 15, 26],
                "1f48e": [
                ["💎"], "", "󾠦", ["gem"], 15, 27],
                "1f48f": [
                ["💏"], "", "󾠧", ["couplekiss"], 15, 28],
                "1f490": [
                ["💐"], "", "󾠨", ["bouquet"], 15, 29],
                "1f491": [
                ["💑"], "", "󾠩", ["couple_with_heart"], 16, 0],
                "1f492": [
                ["💒"], "", "󾠪", ["wedding"], 16, 1],
                "1f493": [
                ["💓"], "", "󾬍", ["heartbeat"], 16, 2],
                "1f494": [
                ["💔"], "", "󾬎", ["broken_heart"], 16, 3, "</3"],
                "1f495": [
                ["💕"], "", "󾬏", ["two_hearts"], 16, 4],
                "1f496": [
                ["💖"], "", "󾬐", ["sparkling_heart"], 16, 5],
                "1f497": [
                ["💗"], "", "󾬑", ["heartpulse"], 16, 6],
                "1f498": [
                ["💘"], "", "󾬒", ["cupid"], 16, 7],
                "1f499": [
                ["💙"], "", "󾬓", ["blue_heart"], 16, 8, "<3"],
                "1f49a": [
                ["💚"], "", "󾬔", ["green_heart"], 16, 9, "<3"],
                "1f49b": [
                ["💛"], "", "󾬕", ["yellow_heart"], 16, 10, "<3"],
                "1f49c": [
                ["💜"], "", "󾬖", ["purple_heart"], 16, 11, "<3"],
                "1f49d": [
                ["💝"], "", "󾬗", ["gift_heart"], 16, 12],
                "1f49e": [
                ["💞"], "", "󾬘", ["revolving_hearts"], 16, 13],
                "1f49f": [
                ["💟"], "", "󾬙", ["heart_decoration"], 16, 14],
                "1f4a0": [
                ["💠"], "", "󾭕", ["diamond_shape_with_a_dot_inside"], 16, 15],
                "1f4a1": [
                ["💡"], "", "󾭖", ["bulb"], 16, 16],
                "1f4a2": [
                ["💢"], "", "󾭗", ["anger"], 16, 17],
                "1f4a3": [
                ["💣"], "", "󾭘", ["bomb"], 16, 18],
                "1f4a4": [
                ["💤"], "", "󾭙", ["zzz"], 16, 19],
                "1f4a5": [
                ["💥"], "", "󾭚", ["boom", "collision"], 16, 20],
                "1f4a6": [
                ["💦"], "", "󾭛", ["sweat_drops"], 16, 21],
                "1f4a7": [
                ["💧"], "", "󾭜", ["droplet"], 16, 22],
                "1f4a8": [
                ["💨"], "", "󾭝", ["dash"], 16, 23],
                "1f4a9": [
                ["💩"], "", "󾓴", ["hankey", "poop", "shit"], 16, 24],
                "1f4aa": [
                ["💪"], "", "󾭞", ["muscle"], 16, 25],
                "1f4ab": [
                ["💫"], "", "󾭟", ["dizzy"], 16, 26],
                "1f4ac": [
                ["💬"], "", "󾔲", ["speech_balloon"], 16, 27],
                "1f4ad": [
                ["💭"], "", "", ["thought_balloon"], 16, 28],
                "1f4ae": [
                ["💮"], "", "󾭺", ["white_flower"], 16, 29],
                "1f4af": [
                ["💯"], "", "󾭻", ["100"], 17, 0],
                "1f4b0": [
                ["💰"], "", "󾓝", ["moneybag"], 17, 1],
                "1f4b1": [
                ["💱"], "", "󾓞", ["currency_exchange"], 17, 2],
                "1f4b2": [
                ["💲"], "", "󾓠", ["heavy_dollar_sign"], 17, 3],
                "1f4b3": [
                ["💳"], "", "󾓡", ["credit_card"], 17, 4],
                "1f4b4": [
                ["💴"], "", "󾓢", ["yen"], 17, 5],
                "1f4b5": [
                ["💵"], "", "󾓣", ["dollar"], 17, 6],
                "1f4b6": [
                ["💶"], "", "", ["euro"], 17, 7],
                "1f4b7": [
                ["💷"], "", "", ["pound"], 17, 8],
                "1f4b8": [
                ["💸"], "", "󾓤", ["money_with_wings"], 17, 9],
                "1f4b9": [
                ["💹"], "", "󾓟", ["chart"], 17, 10],
                "1f4ba": [
                ["💺"], "", "󾔷", ["seat"], 17, 11],
                "1f4bb": [
                ["💻"], "", "󾔸", ["computer"], 17, 12],
                "1f4bc": [
                ["💼"], "", "󾔻", ["briefcase"], 17, 13],
                "1f4bd": [
                ["💽"], "", "󾔼", ["minidisc"], 17, 14],
                "1f4be": [
                ["💾"], "", "󾔽", ["floppy_disk"], 17, 15],
                "1f4bf": [
                ["💿"], "", "󾠝", ["cd"], 17, 16],
                "1f4c0": [
                ["📀"], "", "󾠞", ["dvd"], 17, 17],
                "1f4c1": [
                ["📁"], "", "󾕃", ["file_folder"], 17, 18],
                "1f4c2": [
                ["📂"], "", "󾕄", ["open_file_folder"], 17, 19],
                "1f4c3": [
                ["📃"], "", "󾕀", ["page_with_curl"], 17, 20],
                "1f4c4": [
                ["📄"], "", "󾕁", ["page_facing_up"], 17, 21],
                "1f4c5": [
                ["📅"], "", "󾕂", ["date"], 17, 22],
                "1f4c6": [
                ["📆"], "", "󾕉", ["calendar"], 17, 23],
                "1f4c7": [
                ["📇"], "", "󾕍", ["card_index"], 17, 24],
                "1f4c8": [
                ["📈"], "", "󾕋", ["chart_with_upwards_trend"], 17, 25],
                "1f4c9": [
                ["📉"], "", "󾕌", ["chart_with_downwards_trend"], 17, 26],
                "1f4ca": [
                ["📊"], "", "󾕊", ["bar_chart"], 17, 27],
                "1f4cb": [
                ["📋"], "", "󾕈", ["clipboard"], 17, 28],
                "1f4cc": [
                ["📌"], "", "󾕎", ["pushpin"], 17, 29],
                "1f4cd": [
                ["📍"], "", "󾔿", ["round_pushpin"], 18, 0],
                "1f4ce": [
                ["📎"], "", "󾔺", ["paperclip"], 18, 1],
                "1f4cf": [
                ["📏"], "", "󾕐", ["straight_ruler"], 18, 2],
                "1f4d0": [
                ["📐"], "", "󾕑", ["triangular_ruler"], 18, 3],
                "1f4d1": [
                ["📑"], "", "󾕒", ["bookmark_tabs"], 18, 4],
                "1f4d2": [
                ["📒"], "", "󾕏", ["ledger"], 18, 5],
                "1f4d3": [
                ["📓"], "", "󾕅", ["notebook"], 18, 6],
                "1f4d4": [
                ["📔"], "", "󾕇", ["notebook_with_decorative_cover"], 18, 7],
                "1f4d5": [
                ["📕"], "", "󾔂", ["closed_book"], 18, 8],
                "1f4d6": [
                ["📖"], "", "󾕆", ["book", "open_book"], 18, 9],
                "1f4d7": [
                ["📗"], "", "󾓿", ["green_book"], 18, 10],
                "1f4d8": [
                ["📘"], "", "󾔀", ["blue_book"], 18, 11],
                "1f4d9": [
                ["📙"], "", "󾔁", ["orange_book"], 18, 12],
                "1f4da": [
                ["📚"], "", "󾔃", ["books"], 18, 13],
                "1f4db": [
                ["📛"], "", "󾔄", ["name_badge"], 18, 14],
                "1f4dc": [
                ["📜"], "", "󾓽", ["scroll"], 18, 15],
                "1f4dd": [
                ["📝"], "", "󾔧", ["memo", "pencil"], 18, 16],
                "1f4de": [
                ["📞"], "", "󾔤", ["telephone_receiver"], 18, 17],
                "1f4df": [
                ["📟"], "", "󾔢", ["pager"], 18, 18],
                "1f4e0": [
                ["📠"], "", "󾔨", ["fax"], 18, 19],
                "1f4e1": [
                ["📡"], "", "󾔱", ["satellite"], 18, 20],
                "1f4e2": [
                ["📢"], "", "󾔯", ["loudspeaker"], 18, 21],
                "1f4e3": [
                ["📣"], "", "󾔰", ["mega"], 18, 22],
                "1f4e4": [
                ["📤"], "", "󾔳", ["outbox_tray"], 18, 23],
                "1f4e5": [
                ["📥"], "", "󾔴", ["inbox_tray"], 18, 24],
                "1f4e6": [
                ["📦"], "", "󾔵", ["package"], 18, 25],
                "1f4e7": [
                ["📧"], "", "󾮒", ["e-mail"], 18, 26],
                "1f4e8": [
                ["📨"], "", "󾔪", ["incoming_envelope"], 18, 27],
                "1f4e9": [
                ["📩"], "", "󾔫", ["envelope_with_arrow"], 18, 28],
                "1f4ea": [
                ["📪"], "", "󾔬", ["mailbox_closed"], 18, 29],
                "1f4eb": [
                ["📫"], "", "󾔭", ["mailbox"], 19, 0],
                "1f4ec": [
                ["📬"], "", "", ["mailbox_with_mail"], 19, 1],
                "1f4ed": [
                ["📭"], "", "", ["mailbox_with_no_mail"], 19, 2],
                "1f4ee": [
                ["📮"], "", "󾔮", ["postbox"], 19, 3],
                "1f4ef": [
                ["📯"], "", "", ["postal_horn"], 19, 4],
                "1f4f0": [
                ["📰"], "", "󾠢", ["newspaper"], 19, 5],
                "1f4f1": [
                ["📱"], "", "󾔥", ["iphone"], 19, 6],
                "1f4f2": [
                ["📲"], "", "󾔦", ["calling"], 19, 7],
                "1f4f3": [
                ["📳"], "", "󾠹", ["vibration_mode"], 19, 8],
                "1f4f4": [
                ["📴"], "", "󾠺", ["mobile_phone_off"], 19, 9],
                "1f4f5": [
                ["📵"], "", "", ["no_mobile_phones"], 19, 10],
                "1f4f6": [
                ["📶"], "", "󾠸", ["signal_strength"], 19, 11],
                "1f4f7": [
                ["📷"], "", "󾓯", ["camera"], 19, 12],
                "1f4f9": [
                ["📹"], "", "󾓹", ["video_camera"], 19, 13],
                "1f4fa": [
                ["📺"], "", "󾠜", ["tv"], 19, 14],
                "1f4fb": [
                ["📻"], "", "󾠟", ["radio"], 19, 15],
                "1f4fc": [
                ["📼"], "", "󾠠", ["vhs"], 19, 16],
                "1f500": [
                ["🔀"], "", "", ["twisted_rightwards_arrows"], 19, 17],
                "1f501": [
                ["🔁"], "", "", ["repeat"], 19, 18],
                "1f502": [
                ["🔂"], "", "", ["repeat_one"], 19, 19],
                "1f503": [
                ["🔃"], "", "󾮑", ["arrows_clockwise"], 19, 20],
                "1f504": [
                ["🔄"], "", "", ["arrows_counterclockwise"], 19, 21],
                "1f505": [
                ["🔅"], "", "", ["low_brightness"], 19, 22],
                "1f506": [
                ["🔆"], "", "", ["high_brightness"], 19, 23],
                "1f507": [
                ["🔇"], "", "", ["mute"], 19, 24],
                "1f508": [
                ["🔈"], "", "", ["speaker"], 19, 25],
                "1f509": [
                ["🔉"], "", "", ["sound"], 19, 26],
                "1f50a": [
                ["🔊"], "", "󾠡", ["loud_sound"], 19, 27],
                "1f50b": [
                ["🔋"], "", "󾓼", ["battery"], 19, 28],
                "1f50c": [
                ["🔌"], "", "󾓾", ["electric_plug"], 19, 29],
                "1f50d": [
                ["🔍"], "", "󾮅", ["mag"], 20, 0],
                "1f50e": [
                ["🔎"], "", "󾮍", ["mag_right"], 20, 1],
                "1f50f": [
                ["🔏"], "", "󾮐", ["lock_with_ink_pen"], 20, 2],
                "1f510": [
                ["🔐"], "", "󾮊", ["closed_lock_with_key"], 20, 3],
                "1f511": [
                ["🔑"], "", "󾮂", ["key"], 20, 4],
                "1f512": [
                ["🔒"], "", "󾮆", ["lock"], 20, 5],
                "1f513": [
                ["🔓"], "", "󾮇", ["unlock"], 20, 6],
                "1f514": [
                ["🔔"], "", "󾓲", ["bell"], 20, 7],
                "1f515": [
                ["🔕"], "", "", ["no_bell"], 20, 8],
                "1f516": [
                ["🔖"], "", "󾮏", ["bookmark"], 20, 9],
                "1f517": [
                ["🔗"], "", "󾭋", ["link"], 20, 10],
                "1f518": [
                ["🔘"], "", "󾮌", ["radio_button"], 20, 11],
                "1f519": [
                ["🔙"], "", "󾮎", ["back"], 20, 12],
                "1f51a": [
                ["🔚"], "", "󾀚", ["end"], 20, 13],
                "1f51b": [
                ["🔛"], "", "󾀙", ["on"], 20, 14],
                "1f51c": [
                ["🔜"], "", "󾀘", ["soon"], 20, 15],
                "1f51d": [
                ["🔝"], "", "󾭂", ["top"], 20, 16],
                "1f51e": [
                ["🔞"], "", "󾬥", ["underage"], 20, 17],
                "1f51f": [
                ["🔟"], "", "󾠻", ["keycap_ten"], 20, 18],
                "1f520": [
                ["🔠"], "", "󾭼", ["capital_abcd"], 20, 19],
                "1f521": [
                ["🔡"], "", "󾭽", ["abcd"], 20, 20],
                "1f522": [
                ["🔢"], "", "󾭾", ["1234"], 20, 21],
                "1f523": [
                ["🔣"], "", "󾭿", ["symbols"], 20, 22],
                "1f524": [
                ["🔤"], "", "󾮀", ["abc"], 20, 23],
                "1f525": [
                ["🔥"], "", "󾓶", ["fire"], 20, 24],
                "1f526": [
                ["🔦"], "", "󾓻", ["flashlight"], 20, 25],
                "1f527": [
                ["🔧"], "", "󾓉", ["wrench"], 20, 26],
                "1f528": [
                ["🔨"], "", "󾓊", ["hammer"], 20, 27],
                "1f529": [
                ["🔩"], "", "󾓋", ["nut_and_bolt"], 20, 28],
                "1f52a": [
                ["🔪"], "", "󾓺", ["hocho", "knife"], 20, 29],
                "1f52b": [
                ["🔫"], "", "󾓵", ["gun"], 21, 0],
                "1f52c": [
                ["🔬"], "", "", ["microscope"], 21, 1],
                "1f52d": [
                ["🔭"], "", "", ["telescope"], 21, 2],
                "1f52e": [
                ["🔮"], "", "󾓷", ["crystal_ball"], 21, 3],
                "1f52f": [
                ["🔯"], "", "󾓸", ["six_pointed_star"], 21, 4],
                "1f530": [
                ["🔰"], "", "󾁄", ["beginner"], 21, 5],
                "1f531": [
                ["🔱"], "", "󾓒", ["trident"], 21, 6],
                "1f532": [
                ["🔲"], "", "󾭤", ["black_square_button"], 21, 7],
                "1f533": [
                ["🔳"], "", "󾭧", ["white_square_button"], 21, 8],
                "1f534": [
                ["🔴"], "", "󾭣", ["red_circle"], 21, 9],
                "1f535": [
                ["🔵"], "", "󾭤", ["large_blue_circle"], 21, 10],
                "1f536": [
                ["🔶"], "", "󾭳", ["large_orange_diamond"], 21, 11],
                "1f537": [
                ["🔷"], "", "󾭴", ["large_blue_diamond"], 21, 12],
                "1f538": [
                ["🔸"], "", "󾭵", ["small_orange_diamond"], 21, 13],
                "1f539": [
                ["🔹"], "", "󾭶", ["small_blue_diamond"], 21, 14],
                "1f53a": [
                ["🔺"], "", "󾭸", ["small_red_triangle"], 21, 15],
                "1f53b": [
                ["🔻"], "", "󾭹", ["small_red_triangle_down"], 21, 16],
                "1f53c": [
                ["🔼"], "", "󾬁", ["arrow_up_small"], 21, 17],
                "1f53d": [
                ["🔽"], "", "󾬀", ["arrow_down_small"], 21, 18],
                "1f550": [
                ["🕐"], "", "󾀞", ["clock1"], 21, 19],
                "1f551": [
                ["🕑"], "", "󾀟", ["clock2"], 21, 20],
                "1f552": [
                ["🕒"], "", "󾀠", ["clock3"], 21, 21],
                "1f553": [
                ["🕓"], "", "󾀡", ["clock4"], 21, 22],
                "1f554": [
                ["🕔"], "", "󾀢", ["clock5"], 21, 23],
                "1f555": [
                ["🕕"], "", "󾀣", ["clock6"], 21, 24],
                "1f556": [
                ["🕖"], "", "󾀤", ["clock7"], 21, 25],
                "1f557": [
                ["🕗"], "", "󾀥", ["clock8"], 21, 26],
                "1f558": [
                ["🕘"], "", "󾀦", ["clock9"], 21, 27],
                "1f559": [
                ["🕙"], "", "󾀧", ["clock10"], 21, 28],
                "1f55a": [
                ["🕚"], "", "󾀨", ["clock11"], 21, 29],
                "1f55b": [
                ["🕛"], "", "󾀩", ["clock12"], 22, 0],
                "1f55c": [
                ["🕜"], "", "", ["clock130"], 22, 1],
                "1f55d": [
                ["🕝"], "", "", ["clock230"], 22, 2],
                "1f55e": [
                ["🕞"], "", "", ["clock330"], 22, 3],
                "1f55f": [
                ["🕟"], "", "", ["clock430"], 22, 4],
                "1f560": [
                ["🕠"], "", "", ["clock530"], 22, 5],
                "1f561": [
                ["🕡"], "", "", ["clock630"], 22, 6],
                "1f562": [
                ["🕢"], "", "", ["clock730"], 22, 7],
                "1f563": [
                ["🕣"], "", "", ["clock830"], 22, 8],
                "1f564": [
                ["🕤"], "", "", ["clock930"], 22, 9],
                "1f565": [
                ["🕥"], "", "", ["clock1030"], 22, 10],
                "1f566": [
                ["🕦"], "", "", ["clock1130"], 22, 11],
                "1f567": [
                ["🕧"], "", "", ["clock1230"], 22, 12],
                "1f5fb": [
                ["🗻"], "", "󾓃", ["mount_fuji"], 22, 13],
                "1f5fc": [
                ["🗼"], "", "󾓄", ["tokyo_tower"], 22, 14],
                "1f5fd": [
                ["🗽"], "", "󾓆", ["statue_of_liberty"], 22, 15],
                "1f5fe": [
                ["🗾"], "", "󾓇", ["japan"], 22, 16],
                "1f5ff": [
                ["🗿"], "", "󾓈", ["moyai"], 22, 17],
                "1f600": [
                ["😀"], "", "", ["grinning"], 22, 18, ":D"],
                "1f601": [
                ["😁"], "", "󾌳", ["grin"], 22, 19],
                "1f602": [
                ["😂"], "", "󾌴", ["joy"], 22, 20],
                "1f603": [
                ["😃"], "", "󾌰", ["smiley"], 22, 21, ":)"],
                "1f604": [
                ["😄"], "", "󾌸", ["smile"], 22, 22, ":)"],
                "1f605": [
                ["😅"], "", "󾌱", ["sweat_smile"], 22, 23],
                "1f606": [
                ["😆"], "", "󾌲", ["laughing", "satisfied"], 22, 24],
                "1f607": [
                ["😇"], "", "", ["innocent"], 22, 25],
                "1f608": [
                ["😈"], "", "", ["smiling_imp"], 22, 26],
                "1f609": [
                ["😉"], "", "󾍇", ["wink"], 22, 27, ";)"],
                "1f60a": [
                ["😊"], "", "󾌵", ["blush"], 22, 28],
                "1f60b": [
                ["😋"], "", "󾌫", ["yum"], 22, 29],
                "1f60c": [
                ["😌"], "", "󾌾", ["relieved"], 23, 0],
                "1f60d": [
                ["😍"], "", "󾌧", ["heart_eyes"], 23, 1],
                "1f60e": [
                ["😎"], "", "", ["sunglasses"], 23, 2],
                "1f60f": [
                ["😏"], "", "󾍃", ["smirk"], 23, 3],
                "1f610": [
                ["😐"], "", "", ["neutral_face"], 23, 4],
                "1f611": [
                ["😑"], "", "", ["expressionless"], 23, 5],
                "1f612": [
                ["😒"], "", "󾌦", ["unamused"], 23, 6],
                "1f613": [
                ["😓"], "", "󾍄", ["sweat"], 23, 7],
                "1f614": [
                ["😔"], "", "󾍀", ["pensive"], 23, 8],
                "1f615": [
                ["😕"], "", "", ["confused"], 23, 9],
                "1f616": [
                ["😖"], "", "󾌿", ["confounded"], 23, 10],
                "1f617": [
                ["😗"], "", "", ["kissing"], 23, 11],
                "1f618": [
                ["😘"], "", "󾌬", ["kissing_heart"], 23, 12],
                "1f619": [
                ["😙"], "", "", ["kissing_smiling_eyes"], 23, 13],
                "1f61a": [
                ["😚"], "", "󾌭", ["kissing_closed_eyes"], 23, 14],
                "1f61b": [
                ["😛"], "", "", ["stuck_out_tongue"], 23, 15, ":p"],
                "1f61c": [
                ["😜"], "", "󾌩", ["stuck_out_tongue_winking_eye"], 23, 16, ";p"],
                "1f61d": [
                ["😝"], "", "󾌪", ["stuck_out_tongue_closed_eyes"], 23, 17],
                "1f61e": [
                ["😞"], "", "󾌣", ["disappointed"], 23, 18, ":("],
                "1f61f": [
                ["😟"], "", "", ["worried"], 23, 19],
                "1f620": [
                ["😠"], "", "󾌠", ["angry"], 23, 20],
                "1f621": [
                ["😡"], "", "󾌽", ["rage"], 23, 21],
                "1f622": [
                ["😢"], "", "󾌹", ["cry"], 23, 22, ":'("],
                "1f623": [
                ["😣"], "", "󾌼", ["persevere"], 23, 23],
                "1f624": [
                ["😤"], "", "󾌨", ["triumph"], 23, 24],
                "1f625": [
                ["😥"], "", "󾍅", ["disappointed_relieved"], 23, 25],
                "1f626": [
                ["😦"], "", "", ["frowning"], 23, 26],
                "1f627": [
                ["😧"], "", "", ["anguished"], 23, 27],
                "1f628": [
                ["😨"], "", "󾌻", ["fearful"], 23, 28],
                "1f629": [
                ["😩"], "", "󾌡", ["weary"], 23, 29],
                "1f62a": [
                ["😪"], "", "󾍂", ["sleepy"], 24, 0],
                "1f62b": [
                ["😫"], "", "󾍆", ["tired_face"], 24, 1],
                "1f62c": [
                ["😬"], "", "", ["grimacing"], 24, 2],
                "1f62d": [
                ["😭"], "", "󾌺", ["sob"], 24, 3, ":'("],
                "1f62e": [
                ["😮"], "", "", ["open_mouth"], 24, 4],
                "1f62f": [
                ["😯"], "", "", ["hushed"], 24, 5],
                "1f630": [
                ["😰"], "", "󾌥", ["cold_sweat"], 24, 6],
                "1f631": [
                ["😱"], "", "󾍁", ["scream"], 24, 7],
                "1f632": [
                ["😲"], "", "󾌢", ["astonished"], 24, 8],
                "1f633": [
                ["😳"], "", "󾌯", ["flushed"], 24, 9],
                "1f634": [
                ["😴"], "", "", ["sleeping"], 24, 10],
                "1f635": [
                ["😵"], "", "󾌤", ["dizzy_face"], 24, 11],
                "1f636": [
                ["😶"], "", "", ["no_mouth"], 24, 12],
                "1f637": [
                ["😷"], "", "󾌮", ["mask"], 24, 13],
                "1f638": [
                ["😸"], "", "󾍉", ["smile_cat"], 24, 14],
                "1f639": [
                ["😹"], "", "󾍊", ["joy_cat"], 24, 15],
                "1f63a": [
                ["😺"], "", "󾍈", ["smiley_cat"], 24, 16],
                "1f63b": [
                ["😻"], "", "󾍌", ["heart_eyes_cat"], 24, 17],
                "1f63c": [
                ["😼"], "", "󾍏", ["smirk_cat"], 24, 18],
                "1f63d": [
                ["😽"], "", "󾍋", ["kissing_cat"], 24, 19],
                "1f63e": [
                ["😾"], "", "󾍎", ["pouting_cat"], 24, 20],
                "1f63f": [
                ["😿"], "", "󾍍", ["crying_cat_face"], 24, 21],
                "1f640": [
                ["🙀"], "", "󾍐", ["scream_cat"], 24, 22],
                "1f645": [
                ["🙅"], "", "󾍑", ["no_good"], 24, 23],
                "1f646": [
                ["🙆"], "", "󾍒", ["ok_woman"], 24, 24],
                "1f647": [
                ["🙇"], "", "󾍓", ["bow"], 24, 25],
                "1f648": [
                ["🙈"], "", "󾍔", ["see_no_evil"], 24, 26],
                "1f649": [
                ["🙉"], "", "󾍖", ["hear_no_evil"], 24, 27],
                "1f64a": [
                ["🙊"], "", "󾍕", ["speak_no_evil"], 24, 28],
                "1f64b": [
                ["🙋"], "", "󾍗", ["raising_hand"], 24, 29],
                "1f64c": [
                ["🙌"], "", "󾍘", ["raised_hands"], 25, 0],
                "1f64d": [
                ["🙍"], "", "󾍙", ["person_frowning"], 25, 1],
                "1f64e": [
                ["🙎"], "", "󾍚", ["person_with_pouting_face"], 25, 2],
                "1f64f": [
                ["🙏"], "", "󾍛", ["pray"], 25, 3],
                "1f680": [
                ["🚀"], "", "󾟭", ["rocket"], 25, 4],
                "1f681": [
                ["🚁"], "", "", ["helicopter"], 25, 5],
                "1f682": [
                ["🚂"], "", "", ["steam_locomotive"], 25, 6],
                "1f683": [
                ["🚃"], "", "󾟟", ["railway_car"], 25, 7],
                "1f684": [
                ["🚄"], "", "󾟢", ["bullettrain_side"], 25, 8],
                "1f685": [
                ["🚅"], "", "󾟣", ["bullettrain_front"], 25, 9],
                "1f686": [
                ["🚆"], "", "", ["train2"], 25, 10],
                "1f687": [
                ["🚇"], "", "󾟠", ["metro"], 25, 11],
                "1f688": [
                ["🚈"], "", "", ["light_rail"], 25, 12],
                "1f689": [
                ["🚉"], "", "󾟬", ["station"], 25, 13],
                "1f68a": [
                ["🚊"], "", "", ["tram"], 25, 14],
                "1f68b": [
                ["🚋"], "", "", ["train"], 25, 15],
                "1f68c": [
                ["🚌"], "", "󾟦", ["bus"], 25, 16],
                "1f68d": [
                ["🚍"], "", "", ["oncoming_bus"], 25, 17],
                "1f68e": [
                ["🚎"], "", "", ["trolleybus"], 25, 18],
                "1f68f": [
                ["🚏"], "", "󾟧", ["busstop"], 25, 19],
                "1f690": [
                ["🚐"], "", "", ["minibus"], 25, 20],
                "1f691": [
                ["🚑"], "", "󾟳", ["ambulance"], 25, 21],
                "1f692": [
                ["🚒"], "", "󾟲", ["fire_engine"], 25, 22],
                "1f693": [
                ["🚓"], "", "󾟴", ["police_car"], 25, 23],
                "1f694": [
                ["🚔"], "", "", ["oncoming_police_car"], 25, 24],
                "1f695": [
                ["🚕"], "", "󾟯", ["taxi"], 25, 25],
                "1f696": [
                ["🚖"], "", "", ["oncoming_taxi"], 25, 26],
                "1f697": [
                ["🚗"], "", "󾟤", ["car", "red_car"], 25, 27],
                "1f698": [
                ["🚘"], "", "", ["oncoming_automobile"], 25, 28],
                "1f699": [
                ["🚙"], "", "󾟥", ["blue_car"], 25, 29],
                "1f69a": [
                ["🚚"], "", "󾟱", ["truck"], 26, 0],
                "1f69b": [
                ["🚛"], "", "", ["articulated_lorry"], 26, 1],
                "1f69c": [
                ["🚜"], "", "", ["tractor"], 26, 2],
                "1f69d": [
                ["🚝"], "", "", ["monorail"], 26, 3],
                "1f69e": [
                ["🚞"], "", "", ["mountain_railway"], 26, 4],
                "1f69f": [
                ["🚟"], "", "", ["suspension_railway"], 26, 5],
                "1f6a0": [
                ["🚠"], "", "", ["mountain_cableway"], 26, 6],
                "1f6a1": [
                ["🚡"], "", "", ["aerial_tramway"], 26, 7],
                "1f6a2": [
                ["🚢"], "", "󾟨", ["ship"], 26, 8],
                "1f6a3": [
                ["🚣"], "", "", ["rowboat"], 26, 9],
                "1f6a4": [
                ["🚤"], "", "󾟮", ["speedboat"], 26, 10],
                "1f6a5": [
                ["🚥"], "", "󾟷", ["traffic_light"], 26, 11],
                "1f6a6": [
                ["🚦"], "", "", ["vertical_traffic_light"], 26, 12],
                "1f6a7": [
                ["🚧"], "", "󾟸", ["construction"], 26, 13],
                "1f6a8": [
                ["🚨"], "", "󾟹", ["rotating_light"], 26, 14],
                "1f6a9": [
                ["🚩"], "", "󾬢", ["triangular_flag_on_post"], 26, 15],
                "1f6aa": [
                ["🚪"], "", "󾓳", ["door"], 26, 16],
                "1f6ab": [
                ["🚫"], "", "󾭈", ["no_entry_sign"], 26, 17],
                "1f6ac": [
                ["🚬"], "", "󾬞", ["smoking"], 26, 18],
                "1f6ad": [
                ["🚭"], "", "󾬟", ["no_smoking"], 26, 19],
                "1f6ae": [
                ["🚮"], "", "", ["put_litter_in_its_place"], 26, 20],
                "1f6af": [
                ["🚯"], "", "", ["do_not_litter"], 26, 21],
                "1f6b0": [
                ["🚰"], "", "", ["potable_water"], 26, 22],
                "1f6b1": [
                ["🚱"], "", "", ["non-potable_water"], 26, 23],
                "1f6b2": [
                ["🚲"], "", "󾟫", ["bike"], 26, 24],
                "1f6b3": [
                ["🚳"], "", "", ["no_bicycles"], 26, 25],
                "1f6b4": [
                ["🚴"], "", "", ["bicyclist"], 26, 26],
                "1f6b5": [
                ["🚵"], "", "", ["mountain_bicyclist"], 26, 27],
                "1f6b6": [
                ["🚶"], "", "󾟰", ["walking"], 26, 28],
                "1f6b7": [
                ["🚷"], "", "", ["no_pedestrians"], 26, 29],
                "1f6b8": [
                ["🚸"], "", "", ["children_crossing"], 27, 0],
                "1f6b9": [
                ["🚹"], "", "󾬳", ["mens"], 27, 1],
                "1f6ba": [
                ["🚺"], "", "󾬴", ["womens"], 27, 2],
                "1f6bb": [
                ["🚻"], "", "󾔆", ["restroom"], 27, 3],
                "1f6bc": [
                ["🚼"], "", "󾬵", ["baby_symbol"], 27, 4],
                "1f6bd": [
                ["🚽"], "", "󾔇", ["toilet"], 27, 5],
                "1f6be": [
                ["🚾"], "", "󾔈", ["wc"], 27, 6],
                "1f6bf": [
                ["🚿"], "", "", ["shower"], 27, 7],
                "1f6c0": [
                ["🛀"], "", "󾔅", ["bath"], 27, 8],
                "1f6c1": [
                ["🛁"], "", "", ["bathtub"], 27, 9],
                "1f6c2": [
                ["🛂"], "", "", ["passport_control"], 27, 10],
                "1f6c3": [
                ["🛃"], "", "", ["customs"], 27, 11],
                "1f6c4": [
                ["🛄"], "", "", ["baggage_claim"], 27, 12],
                "1f6c5": [
                ["🛅"], "", "", ["left_luggage"], 27, 13],
                "0023-20e3": [
                ["#️⃣", "#⃣"], "", "󾠬", ["hash"], 27, 14],
                "0030-20e3": [
                ["0️⃣", "0⃣"], "", "󾠷", ["zero"], 27, 15],
                "0031-20e3": [
                ["1️⃣", "1⃣"], "", "󾠮", ["one"], 27, 16],
                "0032-20e3": [
                ["2️⃣", "2⃣"], "", "󾠯", ["two"], 27, 17],
                "0033-20e3": [
                ["3️⃣", "3⃣"], "", "󾠰", ["three"], 27, 18],
                "0034-20e3": [
                ["4️⃣", "4⃣"], "", "󾠱", ["four"], 27, 19],
                "0035-20e3": [
                ["5️⃣", "5⃣"], "", "󾠲", ["five"], 27, 20],
                "0036-20e3": [
                ["6️⃣", "6⃣"], "", "󾠳", ["six"], 27, 21],
                "0037-20e3": [
                ["7️⃣", "7⃣"], "", "󾠴", ["seven"], 27, 22],
                "0038-20e3": [
                ["8️⃣", "8⃣"], "", "󾠵", ["eight"], 27, 23],
                "0039-20e3": [
                ["9️⃣", "9⃣"], "", "󾠶", ["nine"], 27, 24],
                "1f1e8-1f1f3": [
                ["🇨🇳"], "", "󾓭", ["cn"], 27, 25],
                "1f1e9-1f1ea": [
                ["🇩🇪"], "", "󾓨", ["de"], 27, 26],
                "1f1ea-1f1f8": [
                ["🇪🇸"], "", "󾓫", ["es"], 27, 27],
                "1f1eb-1f1f7": [
                ["🇫🇷"], "", "󾓧", ["fr"], 27, 28],
                "1f1ec-1f1e7": [
                ["🇬🇧"], "", "󾓪", ["gb", "uk"], 27, 29],
                "1f1ee-1f1f9": [
                ["🇮🇹"], "", "󾓩", ["it"], 28, 0],
                "1f1ef-1f1f5": [
                ["🇯🇵"], "", "󾓥", ["jp"], 28, 1],
                "1f1f0-1f1f7": [
                ["🇰🇷"], "", "󾓮", ["kr"], 28, 2],
                "1f1f7-1f1fa": [
                ["🇷🇺"], "", "󾓬", ["ru"], 28, 3],
                "1f1fa-1f1f8": [
                ["🇺🇸"], "", "󾓦", ["us"], 28, 4]

            },
            e.emoticons_data = {
                "<3": "heart",
                "</3": "broken_heart",
                ":)": "blush",
                "(:": "blush",
                ":-)": "blush",
                "C:": "smile",
                "c:": "smile",
                ":D": "smile",
                ":-D": "smile",
                ";)": "wink",
                ";-)": "wink",
                "):": "disappointed",
                ":(": "disappointed",
                ":-(": "disappointed",
                ":'(": "cry",
                "=)": "smiley",
                "=-)": "smiley",
                ":*": "kiss",
                ":-*": "kiss",
                ":>": "laughing",
                ":->": "laughing",
                "8)": "sunglasses",
                ":\\\\": "confused",
                ":-\\\\": "confused",
                ":/": "confused",
                ":-/": "confused",
                ":|": "neutral_face",
                ":-|": "neutral_face",
                ":o": "open_mouth",
                ":-o": "open_mouth",
                ">:(": "angry",
                ">:-(": "angry",
                ":p": "stuck_out_tongue",
                ":-p": "stuck_out_tongue",
                ":P": "stuck_out_tongue",
                ":-P": "stuck_out_tongue",
                ":b": "stuck_out_tongue",
                ":-b": "stuck_out_tongue",
                ";p": "stuck_out_tongue_winking_eye",
                ";-p": "stuck_out_tongue_winking_eye",
                ";b": "stuck_out_tongue_winking_eye",
                ";-b": "stuck_out_tongue_winking_eye",
                ";P": "stuck_out_tongue_winking_eye",
                ";-P": "stuck_out_tongue_winking_eye",
                ":o)": "monkey_face",
                "D:": "anguished"

            },
            t.exports = e

        }).call(function() {
            return this || ("undefined" != typeof window ? window: e)

        } ())

    }).call(e, 
    function() {
        return this

    } ())

},
function(t, e) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0

    });
    var i = {
        domain: "domain.ltd",
        server_type: "socket.io",
        server: "jquery-chat.herokuapp.com",
        port: "80",
        debug: !0,
        auto_login: !1,
        sound_active: !0,
        login_popup: !0,
        tools_disabled: !1,
        tools: {
            icon: "ui-icon-wrench"

        },
        options_disabled: !1,
        options: {
            icon: "ui-icon-triangle-1-n"

        },
        bar: {
            default_expand: !0,
            icon_expand: "ui-icon-arrowthickstop-1-e",
            icon_collapse: "ui-icon-arrowthickstop-1-w"

        },
        theme_default: "smoothness",
        themes: [{
            name: "black-tie"

        },
        {
            name: "blitzer"

        },
        {
            name: "cupertino"

        },
        {
            name: "dark-hive"

        },
        {
            name: "dot-luv"

        },
        {
            name: "eggplant"

        },
        {
            name: "excite-bike"

        },
        {
            name: "flick"

        },
        {
            name: "hot-sneaks"

        },
        {
            name: "humanity"

        },
        {
            name: "le-frog"

        },
        {
            name: "mint-choc"

        },
        {
            name: "overcast"

        },
        {
            name: "pepper-grinder"

        },
        {
            name: "redmond"

        },
        {
            name: "south-street"

        },
        {
            name: "start"

        },
        {
            name: "sunny"

        },
        {
            name: "swanky-purse"

        },
        {
            name: "trontastic"

        },
        {
            name: "ui-darkness"

        },
        {
            name: "ui-lightness"

        },
        {
            name: "vader"

        }],
        lang_default: "en",
        lang: [{
            text: "Spanish",
            i18n: "es"

        },
        {
            text: "English",
            i18n: "en"

        }],
        shortcuts: [{
            text: "Home",
            href: "https://github.com/lovelle/jquery-chat/",
            icon: "ui-icon-home",
            target: "_blank"

        },
        {
            text: "Mail",
            href: "https://gmail.com/",
            icon: "ui-icon-mail-closed",
            target: "_blank"

        },
        {
            text: "Search",
            href: "https://google.com/",
            icon: "ui-icon-search",
            target: "_blank"

        }]

    };
    e["default"] = i,
    t.exports = e["default"]

},
function(t, e) {
    "use strict";
    Object.defineProperty(e, "__esModule", {
        value: !0

    });
    var i = {
        chat: "聊天",
        tools: "Tools",
        expand: "Expand",
        collapse: "Collapse",
        options: "Options",
        loading: "Loading...",
        connected: "在线",
        disconnected: "已离线",
        login: "Login",
        name: "Name",
        email: "Email",
        me: "Me",
        and: "and",
        users: "Users",
        custom_message: "Custom message...",
        online: "在线",
        busy: "繁忙",
        offline: "Invisible",
        minimize: "Minimize",
        close: "Close",
        cancel: "Cancel",
        info: "Info",
        choose_stat: "Select an status",
        close_session: "Close session",
        open_session: "Login",
        char_max: "characters max",
        is_writing: "is typing",
        alert: "Alert!",
        user_is: "This user is",
        theme: "Theme",
        lang: "Language",
        search: "搜索",
        rm_search: "Remove search",
        main: "Main",
        sounds: "Sounds",
        enabled: "Enabled",
        disabled: "Disabled",
        please_wait: "Please wait",
        no_users: "There are no users connected",
        user_not_found: "Sorry, user not found",
        seconds: "seconds",
        reconnection: "Reconnection in",
        try_it: "Try it now",
        length_of: "Length of",
        must_be_between: "must be between",
        failed: "Can not connect. Check your connection.",
        all_fields_required: "All form fields are required",
        validate_username: "Username may consist of a-z, 0-9, underscores, begin with a letter."

    };
    e["default"] = i,
    t.exports = e["default"]

},
function(t, e, i) {
    "use strict";
    var s = i(10);
    i(12),
    i(4),
    i(5),
    i(8),
    i(9),
    i(19),
    i(20),
    i(18),
    i(22),
    i(21),
    window.nitalk = s.nitalk,
    window.configtalk = s.configtalk,
    window.inittalk = s.inittalk

},
function(t, e, i) {
    "use strict";

    function s(t) {
        return t && t.__esModule ? t: {
            "default": t

        }

    }
    function n() {
        h["default"].init_env(),
        h["default"].img_set = "apple",
        h["default"].replace_mode = "img",
        h["default"].supports_css = !1,
        h["default"].img_path = r.emojiUrl

    }
    function a(t) {
        return t.replace(/<img.*?(?:>|\/>)/gi, 
        function(t, e, i, s) {
            return $(t).attr("data-emoji")

        })

    }
    function o(t) {
        $.ajax({
            url: r.emojiConfigUrl,
            method: "GET",
            datatype: "json",
            success: function(e) {
                n();
                var i = "";
                try {
                    e = JSON.parse(e)

                } catch(s) {}
                e.forEach(function(t, e, s) {
                    var n = h["default"].replace_unified(t.emoji),
                    a = $("<div></div>").append($('<a href="#" class="face-item" style="display: inline-block;"></a>').append($(n).attr("data-emoji", t.emoji))).html();
                    i += a

                }),
                r.$faceContainer.html(i),
                $(".face-item", r.$faceContainer).on("click", 
                function(t) {
                    var e = $(t.target).clone();
                    p.append(e),
                    p.focus()

                }),
                t()

            }

        })

    }
    Object.defineProperty(e, "__esModule", {
        value: !0

    });
    var r,
    l,
    c = i(3),
    h = s(c),
    u = {
        emojiUrl: "./gemoji/images/emoji/unicode/",
        emojiConfigUrl: "./emoji.json",
        $sendBtn: "",
        $faceContainer: "",
        sendContentCallback: function() {}

    },
    d = '<div contentEditable="true" class="editor"></div>',
    p = $(d);
    $.fn.nitalEditor = function(t) {
        function e(t) {
            l = t;
            var e = l.find($(".editor"));
            0 == e.length ? (p = $(d), l.append(p)) : p = e

        }
        if ("object" != typeof t) throw new Error("Options must be a object!");
        r = $.extend(u, t);
        var i = $(this);
        return o(function() {
            $(r.$sendBtn).on("click", 
            function(t) {
                var e = a(p.html());
                r.sendContentCallback(e)

            })

        }),
        e(i),
        {
            changeActiveEditContent: function(t) {
                e(t)

            }

        }

    },
    e["default"] = a,
    t.exports = e["default"]

},
function(t, e) {
    /*! jQuery UI - v1.10.4 - 2014-04-20
	 * http://jqueryui.com
	 * Includes: jquery.ui.core.js, jquery.ui.widget.js, jquery.ui.mouse.js, jquery.ui.position.js, jquery.ui.draggable.js, jquery.ui.droppable.js, jquery.ui.resizable.js, jquery.ui.selectable.js, jquery.ui.sortable.js, jquery.ui.accordion.js, jquery.ui.autocomplete.js, jquery.ui.button.js, jquery.ui.datepicker.js, jquery.ui.dialog.js, jquery.ui.menu.js, jquery.ui.progressbar.js, jquery.ui.slider.js, jquery.ui.spinner.js, jquery.ui.tabs.js, jquery.ui.tooltip.js, jquery.ui.effect.js, jquery.ui.effect-blind.js, jquery.ui.effect-bounce.js, jquery.ui.effect-clip.js, jquery.ui.effect-drop.js, jquery.ui.effect-explode.js, jquery.ui.effect-fade.js, jquery.ui.effect-fold.js, jquery.ui.effect-highlight.js, jquery.ui.effect-pulsate.js, jquery.ui.effect-scale.js, jquery.ui.effect-shake.js, jquery.ui.effect-slide.js, jquery.ui.effect-transfer.js
	 * Copyright 2014 jQuery Foundation and other contributors; Licensed MIT */
    "use strict";
    ! 
    function(t, e) {
        function i(e, i) {
            var n,
            a,
            o,
            r = e.nodeName.toLowerCase();
            return "area" === r ? (n = e.parentNode, a = n.name, e.href && a && "map" === n.nodeName.toLowerCase() ? (o = t("img[usemap=#" + a + "]")[0], !!o && s(o)) : !1) : (/input|select|textarea|button|object/.test(r) ? !e.disabled: "a" === r ? e.href || i: i) && s(e)

        }
        function s(e) {
            return t.expr.filters.visible(e) && !t(e).parents().addBack().filter(function() {
                return "hidden" === t.css(this, "visibility")

            }).length

        }
        var n = 0,
        a = /^ui-id-\d+$/;
        t.ui = t.ui || {},
        t.extend(t.ui, {
            version: "1.10.4",
            keyCode: {
                BACKSPACE: 8,
                COMMA: 188,
                DELETE: 46,
                DOWN: 40,
                END: 35,
                ENTER: 13,
                ESCAPE: 27,
                HOME: 36,
                LEFT: 37,
                NUMPAD_ADD: 107,
                NUMPAD_DECIMAL: 110,
                NUMPAD_DIVIDE: 111,
                NUMPAD_ENTER: 108,
                NUMPAD_MULTIPLY: 106,
                NUMPAD_SUBTRACT: 109,
                PAGE_DOWN: 34,
                PAGE_UP: 33,
                PERIOD: 190,
                RIGHT: 39,
                SPACE: 32,
                TAB: 9,
                UP: 38

            }

        }),
        t.fn.extend({
            focus: function(e) {
                return function(i, s) {
                    return "number" == typeof i ? this.each(function() {
                        var e = this;
                        setTimeout(function() {
                            t(e).focus(),
                            s && s.call(e)

                        },
                        i)

                    }) : e.apply(this, arguments)

                }

            } (t.fn.focus),
            scrollParent: function() {
                var e;
                return e = t.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function() {
                    return /(relative|absolute|fixed)/.test(t.css(this, "position")) && /(auto|scroll)/.test(t.css(this, "overflow") + t.css(this, "overflow-y") + t.css(this, "overflow-x"))

                }).eq(0) : this.parents().filter(function() {
                    return /(auto|scroll)/.test(t.css(this, "overflow") + t.css(this, "overflow-y") + t.css(this, "overflow-x"))

                }).eq(0),
                /fixed/.test(this.css("position")) || !e.length ? t(document) : e

            },
            zIndex: function(i) {
                if (i !== e) return this.css("zIndex", i);
                if (this.length) for (var s, n, a = t(this[0]); a.length && a[0] !== document;) {
                    if (s = a.css("position"), ("absolute" === s || "relative" === s || "fixed" === s) && (n = parseInt(a.css("zIndex"), 10), !isNaN(n) && 0 !== n)) return n;
                    a = a.parent()

                }
                return 0

            },
            uniqueId: function() {
                return this.each(function() {
                    this.id || (this.id = "ui-id-" + ++n)

                })

            },
            removeUniqueId: function() {
                return this.each(function() {
                    a.test(this.id) && t(this).removeAttr("id")

                })

            }

        }),
        t.extend(t.expr[":"], {
            data: t.expr.createPseudo ? t.expr.createPseudo(function(e) {
                return function(i) {
                    return !! t.data(i, e)

                }

            }) : function(e, i, s) {
                return !! t.data(e, s[3])

            },
            focusable: function(e) {
                return i(e, !isNaN(t.attr(e, "tabindex")))

            },
            tabbable: function(e) {
                var s = t.attr(e, "tabindex"),
                n = isNaN(s);
                return (n || s >= 0) && i(e, !n)

            }

        }),
        t("<a>").outerWidth(1).jquery || t.each(["Width", "Height"], 
        function(i, s) {
            function n(e, i, s, n) {
                return t.each(a, 
                function() {
                    i -= parseFloat(t.css(e, "padding" + this)) || 0,
                    s && (i -= parseFloat(t.css(e, "border" + this + "Width")) || 0),
                    n && (i -= parseFloat(t.css(e, "margin" + this)) || 0)

                }),
                i

            }
            var a = "Width" === s ? ["Left", "Right"] : ["Top", "Bottom"],
            o = s.toLowerCase(),
            r = {
                innerWidth: t.fn.innerWidth,
                innerHeight: t.fn.innerHeight,
                outerWidth: t.fn.outerWidth,
                outerHeight: t.fn.outerHeight

            };
            t.fn["inner" + s] = function(i) {
                return i === e ? r["inner" + s].call(this) : this.each(function() {
                    t(this).css(o, n(this, i) + "px")

                })

            },
            t.fn["outer" + s] = function(e, i) {
                return "number" != typeof e ? r["outer" + s].call(this, e) : this.each(function() {
                    t(this).css(o, n(this, e, !0, i) + "px")

                })

            }

        }),
        t.fn.addBack || (t.fn.addBack = function(t) {
            return this.add(null == t ? this.prevObject: this.prevObject.filter(t))

        }),
        t("<a>").data("a-b", "a").removeData("a-b").data("a-b") && (t.fn.removeData = function(e) {
            return function(i) {
                return arguments.length ? e.call(this, t.camelCase(i)) : e.call(this)

            }

        } (t.fn.removeData)),
        t.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),
        t.support.selectstart = "onselectstart" in document.createElement("div"),
        t.fn.extend({
            disableSelection: function() {
                return this.bind((t.support.selectstart ? "selectstart": "mousedown") + ".ui-disableSelection", 
                function(t) {
                    t.preventDefault()

                })

            },
            enableSelection: function() {
                return this.unbind(".ui-disableSelection")

            }

        }),
        t.extend(t.ui, {
            plugin: {
                add: function(e, i, s) {
                    var n,
                    a = t.ui[e].prototype;
                    for (n in s) a.plugins[n] = a.plugins[n] || [],
                    a.plugins[n].push([i, s[n]])

                },
                call: function(t, e, i) {
                    var s,
                    n = t.plugins[e];
                    if (n && t.element[0].parentNode && 11 !== t.element[0].parentNode.nodeType) for (s = 0; n.length > s; s++) t.options[n[s][0]] && n[s][1].apply(t.element, i)

                }

            },
            hasScroll: function(e, i) {
                if ("hidden" === t(e).css("overflow")) return ! 1;
                var s = i && "left" === i ? "scrollLeft": "scrollTop",
                n = !1;
                return e[s] > 0 ? !0: (e[s] = 1, n = e[s] > 0, e[s] = 0, n)

            }

        })

    } (jQuery),
    function(t, e) {
        var i = 0,
        s = Array.prototype.slice,
        n = t.cleanData;
        t.cleanData = function(e) {
            for (var i, s = 0; null != (i = e[s]); s++) try {
                t(i).triggerHandler("remove")

            } catch(a) {}
            n(e)

        },
        t.widget = function(i, s, n) {
            var a,
            o,
            r,
            l,
            c = {},
            h = i.split(".")[0];
            i = i.split(".")[1],
            a = h + "-" + i,
            n || (n = s, s = t.Widget),
            t.expr[":"][a.toLowerCase()] = function(e) {
                return !! t.data(e, a)

            },
            t[h] = t[h] || {},
            o = t[h][i],
            r = t[h][i] = function(t, i) {
                return this._createWidget ? (arguments.length && this._createWidget(t, i), e) : new r(t, i)

            },
            t.extend(r, o, {
                version: n.version,
                _proto: t.extend({},
                n),
                _childConstructors: []

            }),
            l = new s,
            l.options = t.widget.extend({},
            l.options),
            t.each(n, 
            function(i, n) {
                return t.isFunction(n) ? (c[i] = function() {
                    var t = function() {
                        return s.prototype[i].apply(this, arguments)

                    },
                    e = function(t) {
                        return s.prototype[i].apply(this, t)

                    };
                    return function() {
                        var i,
                        s = this._super,
                        a = this._superApply;
                        return this._super = t,
                        this._superApply = e,
                        i = n.apply(this, arguments),
                        this._super = s,
                        this._superApply = a,
                        i

                    }

                } (), e) : (c[i] = n, e)

            }),
            r.prototype = t.widget.extend(l, {
                widgetEventPrefix: o ? l.widgetEventPrefix || i: i

            },
            c, {
                constructor: r,
                namespace: h,
                widgetName: i,
                widgetFullName: a

            }),
            o ? (t.each(o._childConstructors, 
            function(e, i) {
                var s = i.prototype;
                t.widget(s.namespace + "." + s.widgetName, r, i._proto)

            }), delete o._childConstructors) : s._childConstructors.push(r),
            t.widget.bridge(i, r)

        },
        t.widget.extend = function(i) {
            for (var n, a, o = s.call(arguments, 1), r = 0, l = o.length; l > r; r++) for (n in o[r]) a = o[r][n],
            o[r].hasOwnProperty(n) && a !== e && (i[n] = t.isPlainObject(a) ? t.isPlainObject(i[n]) ? t.widget.extend({},
            i[n], a) : t.widget.extend({},
            a) : a);
            return i

        },
        t.widget.bridge = function(i, n) {
            var a = n.prototype.widgetFullName || i;
            t.fn[i] = function(o) {
                var r = "string" == typeof o,
                l = s.call(arguments, 1),
                c = this;
                return o = !r && l.length ? t.widget.extend.apply(null, [o].concat(l)) : o,
                r ? this.each(function() {
                    var s,
                    n = t.data(this, a);
                    return n ? t.isFunction(n[o]) && "_" !== o.charAt(0) ? (s = n[o].apply(n, l), s !== n && s !== e ? (c = s && s.jquery ? c.pushStack(s.get()) : s, !1) : e) : t.error("no such method '" + o + "' for " + i + " widget instance") : t.error("cannot call methods on " + i + " prior to initialization; attempted to call method '" + o + "'")

                }) : this.each(function() {
                    var e = t.data(this, a);
                    e ? e.option(o || {})._init() : t.data(this, a, new n(o, this))

                }),
                c

            }

        },
        t.Widget = function() {},
        t.Widget._childConstructors = [],
        t.Widget.prototype = {
            widgetName: "widget",
            widgetEventPrefix: "",
            defaultElement: "<div>",
            options: {
                disabled: !1,
                create: null

            },
            _createWidget: function(e, s) {
                s = t(s || this.defaultElement || this)[0],
                this.element = t(s),
                this.uuid = i++,
                this.eventNamespace = "." + this.widgetName + this.uuid,
                this.options = t.widget.extend({},
                this.options, this._getCreateOptions(), e),
                this.bindings = t(),
                this.hoverable = t(),
                this.focusable = t(),
                s !== this && (t.data(s, this.widgetFullName, this), this._on(!0, this.element, {
                    remove: function(t) {
                        t.target === s && this.destroy()

                    }

                }), this.document = t(s.style ? s.ownerDocument: s.document || s), this.window = t(this.document[0].defaultView || this.document[0].parentWindow)),
                this._create(),
                this._trigger("create", null, this._getCreateEventData()),
                this._init()

            },
            _getCreateOptions: t.noop,
            _getCreateEventData: t.noop,
            _create: t.noop,
            _init: t.noop,
            destroy: function() {
                this._destroy(),
                this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(t.camelCase(this.widgetFullName)),
                this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"),
                this.bindings.unbind(this.eventNamespace),
                this.hoverable.removeClass("ui-state-hover"),
                this.focusable.removeClass("ui-state-focus")

            },
            _destroy: t.noop,
            widget: function() {
                return this.element

            },
            option: function(i, s) {
                var n,
                a,
                o,
                r = i;
                if (0 === arguments.length) return t.widget.extend({},
                this.options);
                if ("string" == typeof i) if (r = {},
                n = i.split("."), i = n.shift(), n.length) {
                    for (a = r[i] = t.widget.extend({},
                    this.options[i]), o = 0; n.length - 1 > o; o++) a[n[o]] = a[n[o]] || {},
                    a = a[n[o]];
                    if (i = n.pop(), 1 === arguments.length) return a[i] === e ? null: a[i];
                    a[i] = s

                } else {
                    if (1 === arguments.length) return this.options[i] === e ? null: this.options[i];
                    r[i] = s

                }
                return this._setOptions(r),
                this

            },
            _setOptions: function(t) {
                var e;
                for (e in t) this._setOption(e, t[e]);
                return this

            },
            _setOption: function(t, e) {
                return this.options[t] = e,
                "disabled" === t && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!e).attr("aria-disabled", e), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")),
                this

            },
            enable: function() {
                return this._setOption("disabled", !1)

            },
            disable: function() {
                return this._setOption("disabled", !0)

            },
            _on: function(i, s, n) {
                var a,
                o = this;
                "boolean" != typeof i && (n = s, s = i, i = !1),
                n ? (s = a = t(s), this.bindings = this.bindings.add(s)) : (n = s, s = this.element, a = this.widget()),
                t.each(n, 
                function(n, r) {
                    function l() {
                        return i || o.options.disabled !== !0 && !t(this).hasClass("ui-state-disabled") ? ("string" == typeof r ? o[r] : r).apply(o, arguments) : e

                    }
                    "string" != typeof r && (l.guid = r.guid = r.guid || l.guid || t.guid++);
                    var c = n.match(/^(\w+)\s*(.*)$/),
                    h = c[1] + o.eventNamespace,
                    u = c[2];
                    u ? a.delegate(u, h, l) : s.bind(h, l)

                })

            },
            _off: function(t, e) {
                e = (e || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace,
                t.unbind(e).undelegate(e)

            },
            _delay: function(t, e) {
                function i() {
                    return ("string" == typeof t ? s[t] : t).apply(s, arguments)

                }
                var s = this;
                return setTimeout(i, e || 0)

            },
            _hoverable: function(e) {
                this.hoverable = this.hoverable.add(e),
                this._on(e, {
                    mouseenter: function(e) {
                        t(e.currentTarget).addClass("ui-state-hover")

                    },
                    mouseleave: function(e) {
                        t(e.currentTarget).removeClass("ui-state-hover")

                    }

                })

            },
            _focusable: function(e) {
                this.focusable = this.focusable.add(e),
                this._on(e, {
                    focusin: function(e) {
                        t(e.currentTarget).addClass("ui-state-focus")

                    },
                    focusout: function(e) {
                        t(e.currentTarget).removeClass("ui-state-focus")

                    }

                })

            },
            _trigger: function(e, i, s) {
                var n,
                a,
                o = this.options[e];
                if (s = s || {},
                i = t.Event(i), i.type = (e === this.widgetEventPrefix ? e: this.widgetEventPrefix + e).toLowerCase(), i.target = this.element[0], a = i.originalEvent) for (n in a) n in i || (i[n] = a[n]);
                return this.element.trigger(i, s),
                !(t.isFunction(o) && o.apply(this.element[0], [i].concat(s)) === !1 || i.isDefaultPrevented())

            }

        },
        t.each({
            show: "fadeIn",
            hide: "fadeOut"

        },
        function(e, i) {
            t.Widget.prototype["_" + e] = function(s, n, a) {
                "string" == typeof n && (n = {
                    effect: n

                });
                var o,
                r = n ? n === !0 || "number" == typeof n ? i: n.effect || i: e;
                n = n || {},
                "number" == typeof n && (n = {
                    duration: n

                }),
                o = !t.isEmptyObject(n),
                n.complete = a,
                n.delay && s.delay(n.delay),
                o && t.effects && t.effects.effect[r] ? s[e](n) : r !== e && s[r] ? s[r](n.duration, n.easing, a) : s.queue(function(i) {
                    t(this)[e](),
                    a && a.call(s[0]),
                    i()

                })

            }

        })

    } (jQuery),
    function(t) {
        var e = !1;
        t(document).mouseup(function() {
            e = !1

        }),
        t.widget("ui.mouse", {
            version: "1.10.4",
            options: {
                cancel: "input,textarea,button,select,option",
                distance: 1,
                delay: 0

            },
            _mouseInit: function() {
                var e = this;
                this.element.bind("mousedown." + this.widgetName, 
                function(t) {
                    return e._mouseDown(t)

                }).bind("click." + this.widgetName, 
                function(i) {
                    return ! 0 === t.data(i.target, e.widgetName + ".preventClickEvent") ? (t.removeData(i.target, e.widgetName + ".preventClickEvent"), i.stopImmediatePropagation(), !1) : void 0

                }),
                this.started = !1

            },
            _mouseDestroy: function() {
                this.element.unbind("." + this.widgetName),
                this._mouseMoveDelegate && t(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate)

            },
            _mouseDown: function(i) {
                if (!e) {
                    this._mouseStarted && this._mouseUp(i),
                    this._mouseDownEvent = i;
                    var s = this,
                    n = 1 === i.which,
                    a = "string" == typeof this.options.cancel && i.target.nodeName ? t(i.target).closest(this.options.cancel).length: !1;
                    return n && !a && this._mouseCapture(i) ? (this.mouseDelayMet = !this.options.delay, this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function() {
                        s.mouseDelayMet = !0

                    },
                    this.options.delay)), this._mouseDistanceMet(i) && this._mouseDelayMet(i) && (this._mouseStarted = this._mouseStart(i) !== !1, !this._mouseStarted) ? (i.preventDefault(), !0) : (!0 === t.data(i.target, this.widgetName + ".preventClickEvent") && t.removeData(i.target, this.widgetName + ".preventClickEvent"), this._mouseMoveDelegate = function(t) {
                        return s._mouseMove(t)

                    },
                    this._mouseUpDelegate = function(t) {
                        return s._mouseUp(t)

                    },
                    t(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate), i.preventDefault(), e = !0, !0)) : !0

                }

            },
            _mouseMove: function(e) {
                return t.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button ? this._mouseUp(e) : this._mouseStarted ? (this._mouseDrag(e), e.preventDefault()) : (this._mouseDistanceMet(e) && this._mouseDelayMet(e) && (this._mouseStarted = this._mouseStart(this._mouseDownEvent, e) !== !1, this._mouseStarted ? this._mouseDrag(e) : this._mouseUp(e)), !this._mouseStarted)

            },
            _mouseUp: function(e) {
                return t(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate),
                this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && t.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)),
                !1

            },
            _mouseDistanceMet: function(t) {
                return Math.max(Math.abs(this._mouseDownEvent.pageX - t.pageX), Math.abs(this._mouseDownEvent.pageY - t.pageY)) >= this.options.distance

            },
            _mouseDelayMet: function() {
                return this.mouseDelayMet

            },
            _mouseStart: function() {},
            _mouseDrag: function() {},
            _mouseStop: function() {},
            _mouseCapture: function() {
                return ! 0

            }

        })

    } (jQuery),
    function(t, e) {
        function i(t, e, i) {
            return [parseFloat(t[0]) * (p.test(t[0]) ? e / 100: 1), parseFloat(t[1]) * (p.test(t[1]) ? i / 100: 1)]

        }
        function s(e, i) {
            return parseInt(t.css(e, i), 10) || 0

        }
        function n(e) {
            var i = e[0];
            return 9 === i.nodeType ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: 0,
                    left: 0

                }

            }: t.isWindow(i) ? {
                width: e.width(),
                height: e.height(),
                offset: {
                    top: e.scrollTop(),
                    left: e.scrollLeft()

                }

            }: i.preventDefault ? {
                width: 0,
                height: 0,
                offset: {
                    top: i.pageY,
                    left: i.pageX

                }

            }: {
                width: e.outerWidth(),
                height: e.outerHeight(),
                offset: e.offset()

            }

        }
        t.ui = t.ui || {};
        var a,
        o = Math.max,
        r = Math.abs,
        l = Math.round,
        c = /left|center|right/,
        h = /top|center|bottom/,
        u = /[\+\-]\d+(\.[\d]+)?%?/,
        d = /^\w+/,
        p = /%$/,
        f = t.fn.position;
        t.position = {
            scrollbarWidth: function() {
                if (a !== e) return a;
                var i,
                s,
                n = t("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),
                o = n.children()[0];
                return t("body").append(n),
                i = o.offsetWidth,
                n.css("overflow", "scroll"),
                s = o.offsetWidth,
                i === s && (s = n[0].clientWidth),
                n.remove(),
                a = i - s

            },
            getScrollInfo: function(e) {
                var i = e.isWindow || e.isDocument ? "": e.element.css("overflow-x"),
                s = e.isWindow || e.isDocument ? "": e.element.css("overflow-y"),
                n = "scroll" === i || "auto" === i && e.width < e.element[0].scrollWidth,
                a = "scroll" === s || "auto" === s && e.height < e.element[0].scrollHeight;
                return {
                    width: a ? t.position.scrollbarWidth() : 0,
                    height: n ? t.position.scrollbarWidth() : 0

                }

            },
            getWithinInfo: function(e) {
                var i = t(e || window),
                s = t.isWindow(i[0]),
                n = !!i[0] && 9 === i[0].nodeType;
                return {
                    element: i,
                    isWindow: s,
                    isDocument: n,
                    offset: i.offset() || {
                        left: 0,
                        top: 0

                    },
                    scrollLeft: i.scrollLeft(),
                    scrollTop: i.scrollTop(),
                    width: s ? i.width() : i.outerWidth(),
                    height: s ? i.height() : i.outerHeight()

                }

            }

        },
        t.fn.position = function(e) {
            if (!e || !e.of) return f.apply(this, arguments);
            e = t.extend({},
            e);
            var a,
            p,
            g,
            m,
            _,
            b,
            v = t(e.of),
            y = t.position.getWithinInfo(e.within),
            w = t.position.getScrollInfo(y),
            k = (e.collision || "flip").split(" "),
            x = {};
            return b = n(v),
            v[0].preventDefault && (e.at = "left top"),
            p = b.width,
            g = b.height,
            m = b.offset,
            _ = t.extend({},
            m),
            t.each(["my", "at"], 
            function() {
                var t,
                i,
                s = (e[this] || "").split(" ");
                1 === s.length && (s = c.test(s[0]) ? s.concat(["center"]) : h.test(s[0]) ? ["center"].concat(s) : ["center", "center"]),
                s[0] = c.test(s[0]) ? s[0] : "center",
                s[1] = h.test(s[1]) ? s[1] : "center",
                t = u.exec(s[0]),
                i = u.exec(s[1]),
                x[this] = [t ? t[0] : 0, i ? i[0] : 0],
                e[this] = [d.exec(s[0])[0], d.exec(s[1])[0]]

            }),
            1 === k.length && (k[1] = k[0]),
            "right" === e.at[0] ? _.left += p: "center" === e.at[0] && (_.left += p / 2),
            "bottom" === e.at[1] ? _.top += g: "center" === e.at[1] && (_.top += g / 2),
            a = i(x.at, p, g),
            _.left += a[0],
            _.top += a[1],
            this.each(function() {
                var n,
                c,
                h = t(this),
                u = h.outerWidth(),
                d = h.outerHeight(),
                f = s(this, "marginLeft"),
                b = s(this, "marginTop"),
                D = u + f + s(this, "marginRight") + w.width,
                C = d + b + s(this, "marginBottom") + w.height,
                $ = t.extend({},
                _),
                I = i(x.my, h.outerWidth(), h.outerHeight());
                "right" === e.my[0] ? $.left -= u: "center" === e.my[0] && ($.left -= u / 2),
                "bottom" === e.my[1] ? $.top -= d: "center" === e.my[1] && ($.top -= d / 2),
                $.left += I[0],
                $.top += I[1],
                t.support.offsetFractions || ($.left = l($.left), $.top = l($.top)),
                n = {
                    marginLeft: f,
                    marginTop: b

                },
                t.each(["left", "top"], 
                function(i, s) {
                    t.ui.position[k[i]] && t.ui.position[k[i]][s]($, {
                        targetWidth: p,
                        targetHeight: g,
                        elemWidth: u,
                        elemHeight: d,
                        collisionPosition: n,
                        collisionWidth: D,
                        collisionHeight: C,
                        offset: [a[0] + I[0], a[1] + I[1]],
                        my: e.my,
                        at: e.at,
                        within: y,
                        elem: h

                    })

                }),
                e.using && (c = function(t) {
                    var i = m.left - $.left,
                    s = i + p - u,
                    n = m.top - $.top,
                    a = n + g - d,
                    l = {
                        target: {
                            element: v,
                            left: m.left,
                            top: m.top,
                            width: p,
                            height: g

                        },
                        element: {
                            element: h,
                            left: $.left,
                            top: $.top,
                            width: u,
                            height: d

                        },
                        horizontal: 0 > s ? "left": i > 0 ? "right": "center",
                        vertical: 0 > a ? "top": n > 0 ? "bottom": "middle"

                    };
                    u > p && p > r(i + s) && (l.horizontal = "center"),
                    d > g && g > r(n + a) && (l.vertical = "middle"),
                    l.important = o(r(i), r(s)) > o(r(n), r(a)) ? "horizontal": "vertical",
                    e.using.call(this, t, l)

                }),
                h.offset(t.extend($, {
                    using: c

                }))

            })

        },
        t.ui.position = {
            fit: {
                left: function(t, e) {
                    var i,
                    s = e.within,
                    n = s.isWindow ? s.scrollLeft: s.offset.left,
                    a = s.width,
                    r = t.left - e.collisionPosition.marginLeft,
                    l = n - r,
                    c = r + e.collisionWidth - a - n;
                    e.collisionWidth > a ? l > 0 && 0 >= c ? (i = t.left + l + e.collisionWidth - a - n, t.left += l - i) : t.left = c > 0 && 0 >= l ? n: l > c ? n + a - e.collisionWidth: n: l > 0 ? t.left += l: c > 0 ? t.left -= c: t.left = o(t.left - r, t.left)

                },
                top: function(t, e) {
                    var i,
                    s = e.within,
                    n = s.isWindow ? s.scrollTop: s.offset.top,
                    a = e.within.height,
                    r = t.top - e.collisionPosition.marginTop,
                    l = n - r,
                    c = r + e.collisionHeight - a - n;
                    e.collisionHeight > a ? l > 0 && 0 >= c ? (i = t.top + l + e.collisionHeight - a - n, t.top += l - i) : t.top = c > 0 && 0 >= l ? n: l > c ? n + a - e.collisionHeight: n: l > 0 ? t.top += l: c > 0 ? t.top -= c: t.top = o(t.top - r, t.top)

                }

            },
            flip: {
                left: function(t, e) {
                    var i,
                    s,
                    n = e.within,
                    a = n.offset.left + n.scrollLeft,
                    o = n.width,
                    l = n.isWindow ? n.scrollLeft: n.offset.left,
                    c = t.left - e.collisionPosition.marginLeft,
                    h = c - l,
                    u = c + e.collisionWidth - o - l,
                    d = "left" === e.my[0] ? -e.elemWidth: "right" === e.my[0] ? e.elemWidth: 0,
                    p = "left" === e.at[0] ? e.targetWidth: "right" === e.at[0] ? -e.targetWidth: 0,
                    f = -2 * e.offset[0];
                    0 > h ? (i = t.left + d + p + f + e.collisionWidth - o - a, (0 > i || r(h) > i) && (t.left += d + p + f)) : u > 0 && (s = t.left - e.collisionPosition.marginLeft + d + p + f - l, (s > 0 || u > r(s)) && (t.left += d + p + f))

                },
                top: function(t, e) {
                    var i,
                    s,
                    n = e.within,
                    a = n.offset.top + n.scrollTop,
                    o = n.height,
                    l = n.isWindow ? n.scrollTop: n.offset.top,
                    c = t.top - e.collisionPosition.marginTop,
                    h = c - l,
                    u = c + e.collisionHeight - o - l,
                    d = "top" === e.my[1],
                    p = d ? -e.elemHeight: "bottom" === e.my[1] ? e.elemHeight: 0,
                    f = "top" === e.at[1] ? e.targetHeight: "bottom" === e.at[1] ? -e.targetHeight: 0,
                    g = -2 * e.offset[1];
                    0 > h ? (s = t.top + p + f + g + e.collisionHeight - o - a, t.top + p + f + g > h && (0 > s || r(h) > s) && (t.top += p + f + g)) : u > 0 && (i = t.top - e.collisionPosition.marginTop + p + f + g - l, t.top + p + f + g > u && (i > 0 || u > r(i)) && (t.top += p + f + g))

                }

            },
            flipfit: {
                left: function() {
                    t.ui.position.flip.left.apply(this, arguments),
                    t.ui.position.fit.left.apply(this, arguments)

                },
                top: function() {
                    t.ui.position.flip.top.apply(this, arguments),
                    t.ui.position.fit.top.apply(this, arguments)

                }

            }

        },
        function() {
            var e,
            i,
            s,
            n,
            a,
            o = document.getElementsByTagName("body")[0],
            r = document.createElement("div");
            e = document.createElement(o ? "div": "body"),
            s = {
                visibility: "hidden",
                width: 0,
                height: 0,
                border: 0,
                margin: 0,
                background: "none"

            },
            o && t.extend(s, {
                position: "absolute",
                left: "-1000px",
                top: "-1000px"

            });
            for (a in s) e.style[a] = s[a];
            e.appendChild(r),
            i = o || document.documentElement,
            i.insertBefore(e, i.firstChild),
            r.style.cssText = "position: absolute; left: 10.7432222px;",
            n = t(r).offset().left,
            t.support.offsetFractions = n > 10 && 11 > n,
            e.innerHTML = "",
            i.removeChild(e)

        } ()

    } (jQuery),
    function(t) {
        t.widget("ui.draggable", t.ui.mouse, {
            version: "1.10.4",
            widgetEventPrefix: "drag",
            options: {
                addClasses: !0,
                appendTo: "parent",
                axis: !1,
                connectToSortable: !1,
                containment: !1,
                cursor: "auto",
                cursorAt: !1,
                grid: !1,
                handle: !1,
                helper: "original",
                iframeFix: !1,
                opacity: !1,
                refreshPositions: !1,
                revert: !1,
                revertDuration: 500,
                scope: "default",
                scroll: !0,
                scrollSensitivity: 20,
                scrollSpeed: 20,
                snap: !1,
                snapMode: "both",
                snapTolerance: 20,
                stack: !1,
                zIndex: !1,
                drag: null,
                start: null,
                stop: null

            },
            _create: function() {
                "original" !== this.options.helper || /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"),
                this.options.addClasses && this.element.addClass("ui-draggable"),
                this.options.disabled && this.element.addClass("ui-draggable-disabled"),
                this._mouseInit()

            },
            _destroy: function() {
                this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),
                this._mouseDestroy()

            },
            _mouseCapture: function(e) {
                var i = this.options;
                return this.helper || i.disabled || t(e.target).closest(".ui-resizable-handle").length > 0 ? !1: (this.handle = this._getHandle(e), this.handle ? (t(i.iframeFix === !0 ? "iframe": i.iframeFix).each(function() {
                    t("<div class='ui-draggable-iframeFix' style='background: #fff;'></div>").css({
                        width: this.offsetWidth + "px",
                        height: this.offsetHeight + "px",
                        position: "absolute",
                        opacity: "0.001",
                        zIndex: 1e3

                    }).css(t(this).offset()).appendTo("body")

                }), !0) : !1)

            },
            _mouseStart: function(e) {
                var i = this.options;
                return this.helper = this._createHelper(e),
                this.helper.addClass("ui-draggable-dragging"),
                this._cacheHelperProportions(),
                t.ui.ddmanager && (t.ui.ddmanager.current = this),
                this._cacheMargins(),
                this.cssPosition = this.helper.css("position"),
                this.scrollParent = this.helper.scrollParent(),
                this.offsetParent = this.helper.offsetParent(),
                this.offsetParentCssPosition = this.offsetParent.css("position"),
                this.offset = this.positionAbs = this.element.offset(),
                this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left

                },
                this.offset.scroll = !1,
                t.extend(this.offset, {
                    click: {
                        left: e.pageX - this.offset.left,
                        top: e.pageY - this.offset.top

                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()

                }),
                this.originalPosition = this.position = this._generatePosition(e),
                this.originalPageX = e.pageX,
                this.originalPageY = e.pageY,
                i.cursorAt && this._adjustOffsetFromHelper(i.cursorAt),
                this._setContainment(),
                this._trigger("start", e) === !1 ? (this._clear(), !1) : (this._cacheHelperProportions(), t.ui.ddmanager && !i.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e), this._mouseDrag(e, !0), t.ui.ddmanager && t.ui.ddmanager.dragStart(this, e), !0)

            },
            _mouseDrag: function(e, i) {
                if ("fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()), this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), !i) {
                    var s = this._uiHash();
                    if (this._trigger("drag", e, s) === !1) return this._mouseUp({}),
                    !1;
                    this.position = s.position

                }
                return this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"),
                this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"),
                t.ui.ddmanager && t.ui.ddmanager.drag(this, e),
                !1

            },
            _mouseStop: function(e) {
                var i = this,
                s = !1;
                return t.ui.ddmanager && !this.options.dropBehaviour && (s = t.ui.ddmanager.drop(this, e)),
                this.dropped && (s = this.dropped, this.dropped = !1),
                "original" !== this.options.helper || t.contains(this.element[0].ownerDocument, this.element[0]) ? ("invalid" === this.options.revert && !s || "valid" === this.options.revert && s || this.options.revert === !0 || t.isFunction(this.options.revert) && this.options.revert.call(this.element, s) ? t(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), 
                function() {
                    i._trigger("stop", e) !== !1 && i._clear()

                }) : this._trigger("stop", e) !== !1 && this._clear(), !1) : !1

            },
            _mouseUp: function(e) {
                return t("div.ui-draggable-iframeFix").each(function() {
                    this.parentNode.removeChild(this)

                }),
                t.ui.ddmanager && t.ui.ddmanager.dragStop(this, e),
                t.ui.mouse.prototype._mouseUp.call(this, e)

            },
            cancel: function() {
                return this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(),
                this

            },
            _getHandle: function(e) {
                return this.options.handle ? !!t(e.target).closest(this.element.find(this.options.handle)).length: !0

            },
            _createHelper: function(e) {
                var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e])) : "clone" === i.helper ? this.element.clone().removeAttr("id") : this.element;
                return s.parents("body").length || s.appendTo("parent" === i.appendTo ? this.element[0].parentNode: i.appendTo),
                s[0] === this.element[0] || /(fixed|absolute)/.test(s.css("position")) || s.css("position", "absolute"),
                s

            },
            _adjustOffsetFromHelper: function(e) {
                "string" == typeof e && (e = e.split(" ")),
                t.isArray(e) && (e = {
                    left: +e[0],
                    top: +e[1] || 0

                }),
                "left" in e && (this.offset.click.left = e.left + this.margins.left),
                "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left),
                "top" in e && (this.offset.click.top = e.top + this.margins.top),
                "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)

            },
            _getParentOffset: function() {
                var e = this.offsetParent.offset();
                return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()),
                (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                    top: 0,
                    left: 0

                }),
                {
                    top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                    left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)

                }

            },
            _getRelativeOffset: function() {
                if ("relative" === this.cssPosition) {
                    var t = this.element.position();
                    return {
                        top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                        left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()

                    }

                }
                return {
                    top: 0,
                    left: 0

                }

            },
            _cacheMargins: function() {
                this.margins = {
                    left: parseInt(this.element.css("marginLeft"), 10) || 0,
                    top: parseInt(this.element.css("marginTop"), 10) || 0,
                    right: parseInt(this.element.css("marginRight"), 10) || 0,
                    bottom: parseInt(this.element.css("marginBottom"), 10) || 0

                }

            },
            _cacheHelperProportions: function() {
                this.helperProportions = {
                    width: this.helper.outerWidth(),
                    height: this.helper.outerHeight()

                }

            },
            _setContainment: function() {
                var e,
                i,
                s,
                n = this.options;
                return n.containment ? "window" === n.containment ? void(this.containment = [t(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, t(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, t(window).scrollLeft() + t(window).width() - this.helperProportions.width - this.margins.left, t(window).scrollTop() + (t(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : "document" === n.containment ? void(this.containment = [0, 0, t(document).width() - this.helperProportions.width - this.margins.left, (t(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]) : n.containment.constructor === Array ? void(this.containment = n.containment) : ("parent" === n.containment && (n.containment = this.helper[0].parentNode), i = t(n.containment), s = i[0], void(s && (e = "hidden" !== i.css("overflow"), this.containment = [(parseInt(i.css("borderLeftWidth"), 10) || 0) + (parseInt(i.css("paddingLeft"), 10) || 0), (parseInt(i.css("borderTopWidth"), 10) || 0) + (parseInt(i.css("paddingTop"), 10) || 0), (e ? Math.max(s.scrollWidth, s.offsetWidth) : s.offsetWidth) - (parseInt(i.css("borderRightWidth"), 10) || 0) - (parseInt(i.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(s.scrollHeight, s.offsetHeight) : s.offsetHeight) - (parseInt(i.css("borderBottomWidth"), 10) || 0) - (parseInt(i.css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top - this.margins.bottom], this.relative_container = i))) : void(this.containment = null)

            },
            _convertPositionTo: function(e, i) {
                i || (i = this.position);
                var s = "absolute" === e ? 1: -1,
                n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent: this.offsetParent;
                return this.offset.scroll || (this.offset.scroll = {
                    top: n.scrollTop(),
                    left: n.scrollLeft()

                }),
                {
                    top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top) * s,
                    left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * s

                }

            },
            _generatePosition: function(e) {
                var i,
                s,
                n,
                a,
                o = this.options,
                r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent: this.offsetParent,
                l = e.pageX,
                c = e.pageY;
                return this.offset.scroll || (this.offset.scroll = {
                    top: r.scrollTop(),
                    left: r.scrollLeft()

                }),
                this.originalPosition && (this.containment && (this.relative_container ? (s = this.relative_container.offset(), i = [this.containment[0] + s.left, this.containment[1] + s.top, this.containment[2] + s.left, this.containment[3] + s.top]) : i = this.containment, e.pageX - this.offset.click.left < i[0] && (l = i[0] + this.offset.click.left), e.pageY - this.offset.click.top < i[1] && (c = i[1] + this.offset.click.top), e.pageX - this.offset.click.left > i[2] && (l = i[2] + this.offset.click.left), e.pageY - this.offset.click.top > i[3] && (c = i[3] + this.offset.click.top)), o.grid && (n = o.grid[1] ? this.originalPageY + Math.round((c - this.originalPageY) / o.grid[1]) * o.grid[1] : this.originalPageY, c = i ? n - this.offset.click.top >= i[1] || n - this.offset.click.top > i[3] ? n: n - this.offset.click.top >= i[1] ? n - o.grid[1] : n + o.grid[1] : n, a = o.grid[0] ? this.originalPageX + Math.round((l - this.originalPageX) / o.grid[0]) * o.grid[0] : this.originalPageX, l = i ? a - this.offset.click.left >= i[0] || a - this.offset.click.left > i[2] ? a: a - this.offset.click.left >= i[0] ? a - o.grid[0] : a + o.grid[0] : a)),
                {
                    top: c - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top),
                    left: l - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left)

                }

            },
            _clear: function() {
                this.helper.removeClass("ui-draggable-dragging"),
                this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(),
                this.helper = null,
                this.cancelHelperRemoval = !1

            },
            _trigger: function(e, i, s) {
                return s = s || this._uiHash(),
                t.ui.plugin.call(this, e, [i, s]),
                "drag" === e && (this.positionAbs = this._convertPositionTo("absolute")),
                t.Widget.prototype._trigger.call(this, e, i, s)

            },
            plugins: {},
            _uiHash: function() {
                return {
                    helper: this.helper,
                    position: this.position,
                    originalPosition: this.originalPosition,
                    offset: this.positionAbs

                }

            }

        }),
        t.ui.plugin.add("draggable", "connectToSortable", {
            start: function(e, i) {
                var s = t(this).data("ui-draggable"),
                n = s.options,
                a = t.extend({},
                i, {
                    item: s.element

                });
                s.sortables = [],
                t(n.connectToSortable).each(function() {
                    var i = t.data(this, "ui-sortable");
                    i && !i.options.disabled && (s.sortables.push({
                        instance: i,
                        shouldRevert: i.options.revert

                    }), i.refreshPositions(), i._trigger("activate", e, a))

                })

            },
            stop: function(e, i) {
                var s = t(this).data("ui-draggable"),
                n = t.extend({},
                i, {
                    item: s.element

                });
                t.each(s.sortables, 
                function() {
                    this.instance.isOver ? (this.instance.isOver = 0, s.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert), this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" === s.options.helper && this.instance.currentItem.css({
                        top: "auto",
                        left: "auto"

                    })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, n))

                })

            },
            drag: function(e, i) {
                var s = t(this).data("ui-draggable"),
                n = this;
                t.each(s.sortables, 
                function() {
                    var a = !1,
                    o = this;
                    this.instance.positionAbs = s.positionAbs,
                    this.instance.helperProportions = s.helperProportions,
                    this.instance.offset.click = s.offset.click,
                    this.instance._intersectsWith(this.instance.containerCache) && (a = !0, t.each(s.sortables, 
                    function() {
                        return this.instance.positionAbs = s.positionAbs,
                        this.instance.helperProportions = s.helperProportions,
                        this.instance.offset.click = s.offset.click,
                        this !== o && this.instance._intersectsWith(this.instance.containerCache) && t.contains(o.instance.element[0], this.instance.element[0]) && (a = !1),
                        a

                    })),
                    a ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = t(n).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper = this.instance.options.helper, this.instance.options.helper = function() {
                        return i.helper[0]

                    },
                    e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = s.offset.click.top, this.instance.offset.click.left = s.offset.click.left, this.instance.offset.parent.left -= s.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= s.offset.parent.top - this.instance.offset.parent.top, s._trigger("toSortable", e), s.dropped = this.instance.element, s.currentItem = s.element, this.instance.fromOutside = s), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(), s._trigger("fromSortable", e), s.dropped = !1)

                })

            }

        }),
        t.ui.plugin.add("draggable", "cursor", {
            start: function() {
                var e = t("body"),
                i = t(this).data("ui-draggable").options;
                e.css("cursor") && (i._cursor = e.css("cursor")),
                e.css("cursor", i.cursor)

            },
            stop: function() {
                var e = t(this).data("ui-draggable").options;
                e._cursor && t("body").css("cursor", e._cursor)

            }

        }),
        t.ui.plugin.add("draggable", "opacity", {
            start: function(e, i) {
                var s = t(i.helper),
                n = t(this).data("ui-draggable").options;
                s.css("opacity") && (n._opacity = s.css("opacity")),
                s.css("opacity", n.opacity)

            },
            stop: function(e, i) {
                var s = t(this).data("ui-draggable").options;
                s._opacity && t(i.helper).css("opacity", s._opacity)

            }

        }),
        t.ui.plugin.add("draggable", "scroll", {
            start: function() {
                var e = t(this).data("ui-draggable");
                e.scrollParent[0] !== document && "HTML" !== e.scrollParent[0].tagName && (e.overflowOffset = e.scrollParent.offset())

            },
            drag: function(e) {
                var i = t(this).data("ui-draggable"),
                s = i.options,
                n = !1;
                i.scrollParent[0] !== document && "HTML" !== i.scrollParent[0].tagName ? (s.axis && "x" === s.axis || (i.overflowOffset.top + i.scrollParent[0].offsetHeight - e.pageY < s.scrollSensitivity ? i.scrollParent[0].scrollTop = n = i.scrollParent[0].scrollTop + s.scrollSpeed: e.pageY - i.overflowOffset.top < s.scrollSensitivity && (i.scrollParent[0].scrollTop = n = i.scrollParent[0].scrollTop - s.scrollSpeed)), s.axis && "y" === s.axis || (i.overflowOffset.left + i.scrollParent[0].offsetWidth - e.pageX < s.scrollSensitivity ? i.scrollParent[0].scrollLeft = n = i.scrollParent[0].scrollLeft + s.scrollSpeed: e.pageX - i.overflowOffset.left < s.scrollSensitivity && (i.scrollParent[0].scrollLeft = n = i.scrollParent[0].scrollLeft - s.scrollSpeed))) : (s.axis && "x" === s.axis || (e.pageY - t(document).scrollTop() < s.scrollSensitivity ? n = t(document).scrollTop(t(document).scrollTop() - s.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < s.scrollSensitivity && (n = t(document).scrollTop(t(document).scrollTop() + s.scrollSpeed))), s.axis && "y" === s.axis || (e.pageX - t(document).scrollLeft() < s.scrollSensitivity ? n = t(document).scrollLeft(t(document).scrollLeft() - s.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < s.scrollSensitivity && (n = t(document).scrollLeft(t(document).scrollLeft() + s.scrollSpeed)))),
                n !== !1 && t.ui.ddmanager && !s.dropBehaviour && t.ui.ddmanager.prepareOffsets(i, e)

            }

        }),
        t.ui.plugin.add("draggable", "snap", {
            start: function() {
                var e = t(this).data("ui-draggable"),
                i = e.options;
                e.snapElements = [],
                t(i.snap.constructor !== String ? i.snap.items || ":data(ui-draggable)": i.snap).each(function() {
                    var i = t(this),
                    s = i.offset();
                    this !== e.element[0] && e.snapElements.push({
                        item: this,
                        width: i.outerWidth(),
                        height: i.outerHeight(),
                        top: s.top,
                        left: s.left

                    })

                })

            },
            drag: function(e, i) {
                var s,
                n,
                a,
                o,
                r,
                l,
                c,
                h,
                u,
                d,
                p = t(this).data("ui-draggable"),
                f = p.options,
                g = f.snapTolerance,
                m = i.offset.left,
                _ = m + p.helperProportions.width,
                b = i.offset.top,
                v = b + p.helperProportions.height;
                for (u = p.snapElements.length - 1; u >= 0; u--) r = p.snapElements[u].left,
                l = r + p.snapElements[u].width,
                c = p.snapElements[u].top,
                h = c + p.snapElements[u].height,
                r - g > _ || m > l + g || c - g > v || b > h + g || !t.contains(p.snapElements[u].item.ownerDocument, p.snapElements[u].item) ? (p.snapElements[u].snapping && p.options.snap.release && p.options.snap.release.call(p.element, e, t.extend(p._uiHash(), {
                    snapItem: p.snapElements[u].item

                })), p.snapElements[u].snapping = !1) : ("inner" !== f.snapMode && (s = g >= Math.abs(c - v), n = g >= Math.abs(h - b), a = g >= Math.abs(r - _), o = g >= Math.abs(l - m), s && (i.position.top = p._convertPositionTo("relative", {
                    top: c - p.helperProportions.height,
                    left: 0

                }).top - p.margins.top), n && (i.position.top = p._convertPositionTo("relative", {
                    top: h,
                    left: 0

                }).top - p.margins.top), a && (i.position.left = p._convertPositionTo("relative", {
                    top: 0,
                    left: r - p.helperProportions.width

                }).left - p.margins.left), o && (i.position.left = p._convertPositionTo("relative", {
                    top: 0,
                    left: l

                }).left - p.margins.left)), d = s || n || a || o, "outer" !== f.snapMode && (s = g >= Math.abs(c - b), n = g >= Math.abs(h - v), a = g >= Math.abs(r - m), o = g >= Math.abs(l - _), s && (i.position.top = p._convertPositionTo("relative", {
                    top: c,
                    left: 0

                }).top - p.margins.top), n && (i.position.top = p._convertPositionTo("relative", {
                    top: h - p.helperProportions.height,
                    left: 0

                }).top - p.margins.top), a && (i.position.left = p._convertPositionTo("relative", {
                    top: 0,
                    left: r

                }).left - p.margins.left), o && (i.position.left = p._convertPositionTo("relative", {
                    top: 0,
                    left: l - p.helperProportions.width

                }).left - p.margins.left)), !p.snapElements[u].snapping && (s || n || a || o || d) && p.options.snap.snap && p.options.snap.snap.call(p.element, e, t.extend(p._uiHash(), {
                    snapItem: p.snapElements[u].item

                })), p.snapElements[u].snapping = s || n || a || o || d)

            }

        }),
        t.ui.plugin.add("draggable", "stack", {
            start: function() {
                var e,
                i = this.data("ui-draggable").options,
                s = t.makeArray(t(i.stack)).sort(function(e, i) {
                    return (parseInt(t(e).css("zIndex"), 10) || 0) - (parseInt(t(i).css("zIndex"), 10) || 0)

                });
                s.length && (e = parseInt(t(s[0]).css("zIndex"), 10) || 0, t(s).each(function(i) {
                    t(this).css("zIndex", e + i)

                }), this.css("zIndex", e + s.length))

            }

        }),
        t.ui.plugin.add("draggable", "zIndex", {
            start: function(e, i) {
                var s = t(i.helper),
                n = t(this).data("ui-draggable").options;
                s.css("zIndex") && (n._zIndex = s.css("zIndex")),
                s.css("zIndex", n.zIndex)

            },
            stop: function(e, i) {
                var s = t(this).data("ui-draggable").options;
                s._zIndex && t(i.helper).css("zIndex", s._zIndex)

            }

        })

    } (jQuery),
    function(t) {
        function e(t, e, i) {
            return t > e && e + i > t

        }
        t.widget("ui.droppable", {
            version: "1.10.4",
            widgetEventPrefix: "drop",
            options: {
                accept: "*",
                activeClass: !1,
                addClasses: !0,
                greedy: !1,
                hoverClass: !1,
                scope: "default",
                tolerance: "intersect",
                activate: null,
                deactivate: null,
                drop: null,
                out: null,
                over: null

            },
            _create: function() {
                var e,
                i = this.options,
                s = i.accept;
                this.isover = !1,
                this.isout = !0,
                this.accept = t.isFunction(s) ? s: function(t) {
                    return t.is(s)

                },
                this.proportions = function() {
                    return arguments.length ? void(e = arguments[0]) : e ? e: e = {
                        width: this.element[0].offsetWidth,
                        height: this.element[0].offsetHeight

                    }

                },
                t.ui.ddmanager.droppables[i.scope] = t.ui.ddmanager.droppables[i.scope] || [],
                t.ui.ddmanager.droppables[i.scope].push(this),
                i.addClasses && this.element.addClass("ui-droppable")

            },
            _destroy: function() {
                for (var e = 0, i = t.ui.ddmanager.droppables[this.options.scope]; i.length > e; e++) i[e] === this && i.splice(e, 1);
                this.element.removeClass("ui-droppable ui-droppable-disabled")

            },
            _setOption: function(e, i) {
                "accept" === e && (this.accept = t.isFunction(i) ? i: function(t) {
                    return t.is(i)

                }),
                t.Widget.prototype._setOption.apply(this, arguments)

            },
            _activate: function(e) {
                var i = t.ui.ddmanager.current;
                this.options.activeClass && this.element.addClass(this.options.activeClass),
                i && this._trigger("activate", e, this.ui(i))

            },
            _deactivate: function(e) {
                var i = t.ui.ddmanager.current;
                this.options.activeClass && this.element.removeClass(this.options.activeClass),
                i && this._trigger("deactivate", e, this.ui(i))

            },
            _over: function(e) {
                var i = t.ui.ddmanager.current;
                i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass), this._trigger("over", e, this.ui(i)))

            },
            _out: function(e) {
                var i = t.ui.ddmanager.current;
                i && (i.currentItem || i.element)[0] !== this.element[0] && this.accept.call(this.element[0], i.currentItem || i.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", e, this.ui(i)))

            },
            _drop: function(e, i) {
                var s = i || t.ui.ddmanager.current,
                n = !1;
                return s && (s.currentItem || s.element)[0] !== this.element[0] ? (this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function() {
                    var e = t.data(this, "ui-droppable");
                    return e.options.greedy && !e.options.disabled && e.options.scope === s.options.scope && e.accept.call(e.element[0], s.currentItem || s.element) && t.ui.intersect(s, t.extend(e, {
                        offset: e.element.offset()

                    }), e.options.tolerance) ? (n = !0, !1) : void 0

                }), n ? !1: this.accept.call(this.element[0], s.currentItem || s.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e, this.ui(s)), this.element) : !1) : !1

            },
            ui: function(t) {
                return {
                    draggable: t.currentItem || t.element,
                    helper: t.helper,
                    position: t.position,
                    offset: t.positionAbs

                }

            }

        }),
        t.ui.intersect = function(t, i, s) {
            if (!i.offset) return ! 1;
            var n,
            a,
            o = (t.positionAbs || t.position.absolute).left,
            r = (t.positionAbs || t.position.absolute).top,
            l = o + t.helperProportions.width,
            c = r + t.helperProportions.height,
            h = i.offset.left,
            u = i.offset.top,
            d = h + i.proportions().width,
            p = u + i.proportions().height;
            switch (s) {
                case "fit":
                return o >= h && d >= l && r >= u && p >= c;
                case "intersect":
                return o + t.helperProportions.width / 2 > h && d > l - t.helperProportions.width / 2 && r + t.helperProportions.height / 2 > u && p > c - t.helperProportions.height / 2;
                case "pointer":
                return n = (t.positionAbs || t.position.absolute).left + (t.clickOffset || t.offset.click).left,
                a = (t.positionAbs || t.position.absolute).top + (t.clickOffset || t.offset.click).top,
                e(a, u, i.proportions().height) && e(n, h, i.proportions().width);
                case "touch":
                return (r >= u && p >= r || c >= u && p >= c || u > r && c > p) && (o >= h && d >= o || l >= h && d >= l || h > o && l > d);
                default:
                return ! 1

            }

        },
        t.ui.ddmanager = {
            current: null,
            droppables: {
                "default": []

            },
            prepareOffsets: function(e, i) {
                var s,
                n,
                a = t.ui.ddmanager.droppables[e.options.scope] || [],
                o = i ? i.type: null,
                r = (e.currentItem || e.element).find(":data(ui-droppable)").addBack();
                t: for (s = 0; a.length > s; s++) if (! (a[s].options.disabled || e && !a[s].accept.call(a[s].element[0], e.currentItem || e.element))) {
                    for (n = 0; r.length > n; n++) if (r[n] === a[s].element[0]) {
                        a[s].proportions().height = 0;
                        continue t

                    }
                    a[s].visible = "none" !== a[s].element.css("display"),
                    a[s].visible && ("mousedown" === o && a[s]._activate.call(a[s], i), a[s].offset = a[s].element.offset(), a[s].proportions({
                        width: a[s].element[0].offsetWidth,
                        height: a[s].element[0].offsetHeight

                    }))

                }

            },
            drop: function(e, i) {
                var s = !1;
                return t.each((t.ui.ddmanager.droppables[e.options.scope] || []).slice(), 
                function() {
                    this.options && (!this.options.disabled && this.visible && t.ui.intersect(e, this, this.options.tolerance) && (s = this._drop.call(this, i) || s), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this, i)))

                }),
                s

            },
            dragStart: function(e, i) {
                e.element.parentsUntil("body").bind("scroll.droppable", 
                function() {
                    e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)

                })

            },
            drag: function(e, i) {
                e.options.refreshPositions && t.ui.ddmanager.prepareOffsets(e, i),
                t.each(t.ui.ddmanager.droppables[e.options.scope] || [], 
                function() {
                    if (!this.options.disabled && !this.greedyChild && this.visible) {
                        var s,
                        n,
                        a,
                        o = t.ui.intersect(e, this, this.options.tolerance),
                        r = !o && this.isover ? "isout": o && !this.isover ? "isover": null;
                        r && (this.options.greedy && (n = this.options.scope, a = this.element.parents(":data(ui-droppable)").filter(function() {
                            return t.data(this, "ui-droppable").options.scope === n

                        }), a.length && (s = t.data(a[0], "ui-droppable"), s.greedyChild = "isover" === r)), s && "isover" === r && (s.isover = !1, s.isout = !0, s._out.call(s, i)), this[r] = !0, this["isout" === r ? "isover": "isout"] = !1, this["isover" === r ? "_over": "_out"].call(this, i), s && "isout" === r && (s.isout = !1, s.isover = !0, s._over.call(s, i)))

                    }

                })

            },
            dragStop: function(e, i) {
                e.element.parentsUntil("body").unbind("scroll.droppable"),
                e.options.refreshPositions || t.ui.ddmanager.prepareOffsets(e, i)

            }

        }

    } (jQuery),
    function(t) {
        function e(t) {
            return parseInt(t, 10) || 0

        }
        function i(t) {
            return ! isNaN(parseInt(t, 10))

        }
        t.widget("ui.resizable", t.ui.mouse, {
            version: "1.10.4",
            widgetEventPrefix: "resize",
            options: {
                alsoResize: !1,
                animate: !1,
                animateDuration: "slow",
                animateEasing: "swing",
                aspectRatio: !1,
                autoHide: !1,
                containment: !1,
                ghost: !1,
                grid: !1,
                handles: "e,s,se",
                helper: !1,
                maxHeight: null,
                maxWidth: null,
                minHeight: 10,
                minWidth: 10,
                zIndex: 90,
                resize: null,
                start: null,
                stop: null

            },
            _create: function() {
                var e,
                i,
                s,
                n,
                a,
                o = this,
                r = this.options;
                if (this.element.addClass("ui-resizable"), t.extend(this, {
                    _aspectRatio: !!r.aspectRatio,
                    aspectRatio: r.aspectRatio,
                    originalElement: this.element,
                    _proportionallyResizeElements: [],
                    _helper: r.helper || r.ghost || r.animate ? r.helper || "ui-resizable-helper": null

                }), this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(t("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({
                    position: this.element.css("position"),
                    width: this.element.outerWidth(),
                    height: this.element.outerHeight(),
                    top: this.element.css("top"),
                    left: this.element.css("left")

                })), this.element = this.element.parent().data("ui-resizable", this.element.data("ui-resizable")), this.elementIsWrapper = !0, this.element.css({
                    marginLeft: this.originalElement.css("marginLeft"),
                    marginTop: this.originalElement.css("marginTop"),
                    marginRight: this.originalElement.css("marginRight"),
                    marginBottom: this.originalElement.css("marginBottom")

                }), this.originalElement.css({
                    marginLeft: 0,
                    marginTop: 0,
                    marginRight: 0,
                    marginBottom: 0

                }), this.originalResizeStyle = this.originalElement.css("resize"), this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({
                    position: "static",
                    zoom: 1,
                    display: "block"

                })), this.originalElement.css({
                    margin: this.originalElement.css("margin")

                }), this._proportionallyResize()), this.handles = r.handles || (t(".ui-resizable-handle", this.element).length ? {
                    n: ".ui-resizable-n",
                    e: ".ui-resizable-e",
                    s: ".ui-resizable-s",
                    w: ".ui-resizable-w",
                    se: ".ui-resizable-se",
                    sw: ".ui-resizable-sw",
                    ne: ".ui-resizable-ne",
                    nw: ".ui-resizable-nw"

                }: "e,s,se"), this.handles.constructor === String) for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), e = this.handles.split(","), this.handles = {},
                i = 0; e.length > i; i++) s = t.trim(e[i]),
                a = "ui-resizable-" + s,
                n = t("<div class='ui-resizable-handle " + a + "'></div>"),
                n.css({
                    zIndex: r.zIndex

                }),
                "se" === s && n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),
                this.handles[s] = ".ui-resizable-" + s,
                this.element.append(n);
                this._renderAxis = function(e) {
                    var i,
                    s,
                    n,
                    a;
                    e = e || this.element;
                    for (i in this.handles) this.handles[i].constructor === String && (this.handles[i] = t(this.handles[i], this.element).show()),
                    this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (s = t(this.handles[i], this.element), a = /sw|ne|nw|se|n|s/.test(i) ? s.outerHeight() : s.outerWidth(), n = ["padding", /ne|nw|n/.test(i) ? "Top": /se|sw|s/.test(i) ? "Bottom": /^e$/.test(i) ? "Right": "Left"].join(""), e.css(n, a), this._proportionallyResize()),
                    t(this.handles[i]).length

                },
                this._renderAxis(this.element),
                this._handles = t(".ui-resizable-handle", this.element).disableSelection(),
                this._handles.mouseover(function() {
                    o.resizing || (this.className && (n = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), o.axis = n && n[1] ? n[1] : "se")

                }),
                r.autoHide && (this._handles.hide(), t(this.element).addClass("ui-resizable-autohide").mouseenter(function() {
                    r.disabled || (t(this).removeClass("ui-resizable-autohide"), o._handles.show())

                }).mouseleave(function() {
                    r.disabled || o.resizing || (t(this).addClass("ui-resizable-autohide"), o._handles.hide())

                })),
                this._mouseInit()

            },
            _destroy: function() {
                this._mouseDestroy();
                var e,
                i = function(e) {
                    t(e).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()

                };
                return this.elementIsWrapper && (i(this.element), e = this.element, this.originalElement.css({
                    position: e.css("position"),
                    width: e.outerWidth(),
                    height: e.outerHeight(),
                    top: e.css("top"),
                    left: e.css("left")

                }).insertAfter(e), e.remove()),
                this.originalElement.css("resize", this.originalResizeStyle),
                i(this.originalElement),
                this

            },
            _mouseCapture: function(e) {
                var i,
                s,
                n = !1;
                for (i in this.handles) s = t(this.handles[i])[0],
                (s === e.target || t.contains(s, e.target)) && (n = !0);
                return ! this.options.disabled && n

            },
            _mouseStart: function(i) {
                var s,
                n,
                a,
                o = this.options,
                r = this.element.position(),
                l = this.element;
                return this.resizing = !0,
                /absolute/.test(l.css("position")) ? l.css({
                    position: "absolute",
                    top: l.css("top"),
                    left: l.css("left")

                }) : l.is(".ui-draggable") && l.css({
                    position: "absolute",
                    top: r.top,
                    left: r.left

                }),
                this._renderProxy(),
                s = e(this.helper.css("left")),
                n = e(this.helper.css("top")),
                o.containment && (s += t(o.containment).scrollLeft() || 0, n += t(o.containment).scrollTop() || 0),
                this.offset = this.helper.offset(),
                this.position = {
                    left: s,
                    top: n

                },
                this.size = this._helper ? {
                    width: this.helper.width(),
                    height: this.helper.height()

                }: {
                    width: l.width(),
                    height: l.height()

                },
                this.originalSize = this._helper ? {
                    width: l.outerWidth(),
                    height: l.outerHeight()

                }: {
                    width: l.width(),
                    height: l.height()

                },
                this.originalPosition = {
                    left: s,
                    top: n

                },
                this.sizeDiff = {
                    width: l.outerWidth() - l.width(),
                    height: l.outerHeight() - l.height()

                },
                this.originalMousePosition = {
                    left: i.pageX,
                    top: i.pageY

                },
                this.aspectRatio = "number" == typeof o.aspectRatio ? o.aspectRatio: this.originalSize.width / this.originalSize.height || 1,
                a = t(".ui-resizable-" + this.axis).css("cursor"),
                t("body").css("cursor", "auto" === a ? this.axis + "-resize": a),
                l.addClass("ui-resizable-resizing"),
                this._propagate("start", i),
                !0

            },
            _mouseDrag: function(e) {
                var i,
                s = this.helper,
                n = {},
                a = this.originalMousePosition,
                o = this.axis,
                r = this.position.top,
                l = this.position.left,
                c = this.size.width,
                h = this.size.height,
                u = e.pageX - a.left || 0,
                d = e.pageY - a.top || 0,
                p = this._change[o];
                return p ? (i = p.apply(this, [e, u, d]), this._updateVirtualBoundaries(e.shiftKey), (this._aspectRatio || e.shiftKey) && (i = this._updateRatio(i, e)), i = this._respectSize(i, e), this._updateCache(i), this._propagate("resize", e), this.position.top !== r && (n.top = this.position.top + "px"), this.position.left !== l && (n.left = this.position.left + "px"), this.size.width !== c && (n.width = this.size.width + "px"), this.size.height !== h && (n.height = this.size.height + "px"), s.css(n), !this._helper && this._proportionallyResizeElements.length && this._proportionallyResize(), t.isEmptyObject(n) || this._trigger("resize", e, this.ui()), !1) : !1

            },
            _mouseStop: function(e) {
                this.resizing = !1;
                var i,
                s,
                n,
                a,
                o,
                r,
                l,
                c = this.options,
                h = this;
                return this._helper && (i = this._proportionallyResizeElements, s = i.length && /textarea/i.test(i[0].nodeName), n = s && t.ui.hasScroll(i[0], "left") ? 0: h.sizeDiff.height, a = s ? 0: h.sizeDiff.width, o = {
                    width: h.helper.width() - a,
                    height: h.helper.height() - n

                },
                r = parseInt(h.element.css("left"), 10) + (h.position.left - h.originalPosition.left) || null, l = parseInt(h.element.css("top"), 10) + (h.position.top - h.originalPosition.top) || null, c.animate || this.element.css(t.extend(o, {
                    top: l,
                    left: r

                })), h.helper.height(h.size.height), h.helper.width(h.size.width), this._helper && !c.animate && this._proportionallyResize()),
                t("body").css("cursor", "auto"),
                this.element.removeClass("ui-resizable-resizing"),
                this._propagate("stop", e),
                this._helper && this.helper.remove(),
                !1

            },
            _updateVirtualBoundaries: function(t) {
                var e,
                s,
                n,
                a,
                o,
                r = this.options;
                o = {
                    minWidth: i(r.minWidth) ? r.minWidth: 0,
                    maxWidth: i(r.maxWidth) ? r.maxWidth: 1 / 0,
                    minHeight: i(r.minHeight) ? r.minHeight: 0,
                    maxHeight: i(r.maxHeight) ? r.maxHeight: 1 / 0

                },
                (this._aspectRatio || t) && (e = o.minHeight * this.aspectRatio, n = o.minWidth / this.aspectRatio, s = o.maxHeight * this.aspectRatio, a = o.maxWidth / this.aspectRatio, e > o.minWidth && (o.minWidth = e), n > o.minHeight && (o.minHeight = n), o.maxWidth > s && (o.maxWidth = s), o.maxHeight > a && (o.maxHeight = a)),
                this._vBoundaries = o

            },
            _updateCache: function(t) {
                this.offset = this.helper.offset(),
                i(t.left) && (this.position.left = t.left),
                i(t.top) && (this.position.top = t.top),
                i(t.height) && (this.size.height = t.height),
                i(t.width) && (this.size.width = t.width)

            },
            _updateRatio: function(t) {
                var e = this.position,
                s = this.size,
                n = this.axis;
                return i(t.height) ? t.width = t.height * this.aspectRatio: i(t.width) && (t.height = t.width / this.aspectRatio),
                "sw" === n && (t.left = e.left + (s.width - t.width), t.top = null),
                "nw" === n && (t.top = e.top + (s.height - t.height), t.left = e.left + (s.width - t.width)),
                t

            },
            _respectSize: function(t) {
                var e = this._vBoundaries,
                s = this.axis,
                n = i(t.width) && e.maxWidth && e.maxWidth < t.width,
                a = i(t.height) && e.maxHeight && e.maxHeight < t.height,
                o = i(t.width) && e.minWidth && e.minWidth > t.width,
                r = i(t.height) && e.minHeight && e.minHeight > t.height,
                l = this.originalPosition.left + this.originalSize.width,
                c = this.position.top + this.size.height,
                h = /sw|nw|w/.test(s),
                u = /nw|ne|n/.test(s);
                return o && (t.width = e.minWidth),
                r && (t.height = e.minHeight),
                n && (t.width = e.maxWidth),
                a && (t.height = e.maxHeight),
                o && h && (t.left = l - e.minWidth),
                n && h && (t.left = l - e.maxWidth),
                r && u && (t.top = c - e.minHeight),
                a && u && (t.top = c - e.maxHeight),
                t.width || t.height || t.left || !t.top ? t.width || t.height || t.top || !t.left || (t.left = null) : t.top = null,
                t

            },
            _proportionallyResize: function() {
                if (this._proportionallyResizeElements.length) {
                    var t,
                    e,
                    i,
                    s,
                    n,
                    a = this.helper || this.element;
                    for (t = 0; this._proportionallyResizeElements.length > t; t++) {
                        if (n = this._proportionallyResizeElements[t], !this.borderDif) for (this.borderDif = [], i = [n.css("borderTopWidth"), n.css("borderRightWidth"), n.css("borderBottomWidth"), n.css("borderLeftWidth")], s = [n.css("paddingTop"), n.css("paddingRight"), n.css("paddingBottom"), n.css("paddingLeft")], e = 0; i.length > e; e++) this.borderDif[e] = (parseInt(i[e], 10) || 0) + (parseInt(s[e], 10) || 0);
                        n.css({
                            height: a.height() - this.borderDif[0] - this.borderDif[2] || 0,
                            width: a.width() - this.borderDif[1] - this.borderDif[3] || 0

                        })

                    }

                }

            },
            _renderProxy: function() {
                var e = this.element,
                i = this.options;
                this.elementOffset = e.offset(),
                this._helper ? (this.helper = this.helper || t("<div style='overflow:hidden;'></div>"), this.helper.addClass(this._helper).css({
                    width: this.element.outerWidth() - 1,
                    height: this.element.outerHeight() - 1,
                    position: "absolute",
                    left: this.elementOffset.left + "px",
                    top: this.elementOffset.top + "px",
                    zIndex: ++i.zIndex

                }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element

            },
            _change: {
                e: function(t, e) {
                    return {
                        width: this.originalSize.width + e

                    }

                },
                w: function(t, e) {
                    var i = this.originalSize,
                    s = this.originalPosition;
                    return {
                        left: s.left + e,
                        width: i.width - e

                    }

                },
                n: function s(t, e, i) {
                    var n = this.originalSize,
                    s = this.originalPosition;
                    return {
                        top: s.top + i,
                        height: n.height - i

                    }

                },
                s: function(t, e, i) {
                    return {
                        height: this.originalSize.height + i

                    }

                },
                se: function(e, i, s) {
                    return t.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [e, i, s]))

                },
                sw: function(e, i, s) {
                    return t.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [e, i, s]))

                },
                ne: function(e, i, s) {
                    return t.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [e, i, s]))

                },
                nw: function(e, i, s) {
                    return t.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [e, i, s]))

                }

            },
            _propagate: function(e, i) {
                t.ui.plugin.call(this, e, [i, this.ui()]),
                "resize" !== e && this._trigger(e, i, this.ui())

            },
            plugins: {},
            ui: function() {
                return {
                    originalElement: this.originalElement,
                    element: this.element,
                    helper: this.helper,
                    position: this.position,
                    size: this.size,
                    originalSize: this.originalSize,
                    originalPosition: this.originalPosition

                }

            }

        }),
        t.ui.plugin.add("resizable", "animate", {
            stop: function(e) {
                var i = t(this).data("ui-resizable"),
                s = i.options,
                n = i._proportionallyResizeElements,
                a = n.length && /textarea/i.test(n[0].nodeName),
                o = a && t.ui.hasScroll(n[0], "left") ? 0: i.sizeDiff.height,
                r = a ? 0: i.sizeDiff.width,
                l = {
                    width: i.size.width - r,
                    height: i.size.height - o

                },
                c = parseInt(i.element.css("left"), 10) + (i.position.left - i.originalPosition.left) || null,
                h = parseInt(i.element.css("top"), 10) + (i.position.top - i.originalPosition.top) || null;
                i.element.animate(t.extend(l, h && c ? {
                    top: h,
                    left: c

                }: {}), {
                    duration: s.animateDuration,
                    easing: s.animateEasing,
                    step: function() {
                        var s = {
                            width: parseInt(i.element.css("width"), 10),
                            height: parseInt(i.element.css("height"), 10),
                            top: parseInt(i.element.css("top"), 10),
                            left: parseInt(i.element.css("left"), 10)

                        };
                        n && n.length && t(n[0]).css({
                            width: s.width,
                            height: s.height

                        }),
                        i._updateCache(s),
                        i._propagate("resize", e)

                    }

                })

            }

        }),
        t.ui.plugin.add("resizable", "containment", {
            start: function() {
                var i,
                s,
                n,
                a,
                o,
                r,
                l,
                c = t(this).data("ui-resizable"),
                h = c.options,
                u = c.element,
                d = h.containment,
                p = d instanceof t ? d.get(0) : /parent/.test(d) ? u.parent().get(0) : d;
                p && (c.containerElement = t(p), /document/.test(d) || d === document ? (c.containerOffset = {
                    left: 0,
                    top: 0

                },
                c.containerPosition = {
                    left: 0,
                    top: 0

                },
                c.parentData = {
                    element: t(document),
                    left: 0,
                    top: 0,
                    width: t(document).width(),
                    height: t(document).height() || document.body.parentNode.scrollHeight

                }) : (i = t(p), s = [], t(["Top", "Right", "Left", "Bottom"]).each(function(t, n) {
                    s[t] = e(i.css("padding" + n))

                }), c.containerOffset = i.offset(), c.containerPosition = i.position(), c.containerSize = {
                    height: i.innerHeight() - s[3],
                    width: i.innerWidth() - s[1]

                },
                n = c.containerOffset, a = c.containerSize.height, o = c.containerSize.width, r = t.ui.hasScroll(p, "left") ? p.scrollWidth: o, l = t.ui.hasScroll(p) ? p.scrollHeight: a, c.parentData = {
                    element: p,
                    left: n.left,
                    top: n.top,
                    width: r,
                    height: l

                }))

            },
            resize: function(e) {
                var i,
                s,
                n,
                a,
                o = t(this).data("ui-resizable"),
                r = o.options,
                l = o.containerOffset,
                c = o.position,
                h = o._aspectRatio || e.shiftKey,
                u = {
                    top: 0,
                    left: 0

                },
                d = o.containerElement;
                d[0] !== document && /static/.test(d.css("position")) && (u = l),
                c.left < (o._helper ? l.left: 0) && (o.size.width = o.size.width + (o._helper ? o.position.left - l.left: o.position.left - u.left), h && (o.size.height = o.size.width / o.aspectRatio), o.position.left = r.helper ? l.left: 0),
                c.top < (o._helper ? l.top: 0) && (o.size.height = o.size.height + (o._helper ? o.position.top - l.top: o.position.top), h && (o.size.width = o.size.height * o.aspectRatio), o.position.top = o._helper ? l.top: 0),
                o.offset.left = o.parentData.left + o.position.left,
                o.offset.top = o.parentData.top + o.position.top,
                i = Math.abs((o._helper ? o.offset.left - u.left: o.offset.left - u.left) + o.sizeDiff.width),
                s = Math.abs((o._helper ? o.offset.top - u.top: o.offset.top - l.top) + o.sizeDiff.height),
                n = o.containerElement.get(0) === o.element.parent().get(0),
                a = /relative|absolute/.test(o.containerElement.css("position")),
                n && a && (i -= Math.abs(o.parentData.left)),
                i + o.size.width >= o.parentData.width && (o.size.width = o.parentData.width - i, h && (o.size.height = o.size.width / o.aspectRatio)),
                s + o.size.height >= o.parentData.height && (o.size.height = o.parentData.height - s, h && (o.size.width = o.size.height * o.aspectRatio))

            },
            stop: function() {
                var e = t(this).data("ui-resizable"),
                i = e.options,
                s = e.containerOffset,
                n = e.containerPosition,
                a = e.containerElement,
                o = t(e.helper),
                r = o.offset(),
                l = o.outerWidth() - e.sizeDiff.width,
                c = o.outerHeight() - e.sizeDiff.height;
                e._helper && !i.animate && /relative/.test(a.css("position")) && t(this).css({
                    left: r.left - n.left - s.left,
                    width: l,
                    height: c

                }),
                e._helper && !i.animate && /static/.test(a.css("position")) && t(this).css({
                    left: r.left - n.left - s.left,
                    width: l,
                    height: c

                })

            }

        }),
        t.ui.plugin.add("resizable", "alsoResize", {
            start: function() {
                var e = t(this).data("ui-resizable"),
                i = e.options,
                s = function(e) {
                    t(e).each(function() {
                        var e = t(this);
                        e.data("ui-resizable-alsoresize", {
                            width: parseInt(e.width(), 10),
                            height: parseInt(e.height(), 10),
                            left: parseInt(e.css("left"), 10),
                            top: parseInt(e.css("top"), 10)

                        })

                    })

                };
                "object" != typeof i.alsoResize || i.alsoResize.parentNode ? s(i.alsoResize) : i.alsoResize.length ? (i.alsoResize = i.alsoResize[0], s(i.alsoResize)) : t.each(i.alsoResize, 
                function(t) {
                    s(t)

                })

            },
            resize: function(e, i) {
                var s = t(this).data("ui-resizable"),
                n = s.options,
                a = s.originalSize,
                o = s.originalPosition,
                r = {
                    height: s.size.height - a.height || 0,
                    width: s.size.width - a.width || 0,
                    top: s.position.top - o.top || 0,
                    left: s.position.left - o.left || 0

                },
                l = function(e, s) {
                    t(e).each(function() {
                        var e = t(this),
                        n = t(this).data("ui-resizable-alsoresize"),
                        a = {},
                        o = s && s.length ? s: e.parents(i.originalElement[0]).length ? ["width", "height"] : ["width", "height", "top", "left"];
                        t.each(o, 
                        function(t, e) {
                            var i = (n[e] || 0) + (r[e] || 0);
                            i && i >= 0 && (a[e] = i || null)

                        }),
                        e.css(a)

                    })

                };
                "object" != typeof n.alsoResize || n.alsoResize.nodeType ? l(n.alsoResize) : t.each(n.alsoResize, 
                function(t, e) {
                    l(t, e)

                })

            },
            stop: function() {
                t(this).removeData("resizable-alsoresize")

            }

        }),
        t.ui.plugin.add("resizable", "ghost", {
            start: function() {
                var e = t(this).data("ui-resizable"),
                i = e.options,
                s = e.size;
                e.ghost = e.originalElement.clone(),
                e.ghost.css({
                    opacity: .25,
                    display: "block",
                    position: "relative",
                    height: s.height,
                    width: s.width,
                    margin: 0,
                    left: 0,
                    top: 0

                }).addClass("ui-resizable-ghost").addClass("string" == typeof i.ghost ? i.ghost: ""),
                e.ghost.appendTo(e.helper)

            },
            resize: function() {
                var e = t(this).data("ui-resizable");
                e.ghost && e.ghost.css({
                    position: "relative",
                    height: e.size.height,
                    width: e.size.width

                })

            },
            stop: function() {
                var e = t(this).data("ui-resizable");
                e.ghost && e.helper && e.helper.get(0).removeChild(e.ghost.get(0))

            }

        }),
        t.ui.plugin.add("resizable", "grid", {
            resize: function() {
                var e = t(this).data("ui-resizable"),
                i = e.options,
                s = e.size,
                n = e.originalSize,
                a = e.originalPosition,
                o = e.axis,
                r = "number" == typeof i.grid ? [i.grid, i.grid] : i.grid,
                l = r[0] || 1,
                c = r[1] || 1,
                h = Math.round((s.width - n.width) / l) * l,
                u = Math.round((s.height - n.height) / c) * c,
                d = n.width + h,
                p = n.height + u,
                f = i.maxWidth && d > i.maxWidth,
                g = i.maxHeight && p > i.maxHeight,
                m = i.minWidth && i.minWidth > d,
                _ = i.minHeight && i.minHeight > p;
                i.grid = r,
                m && (d += l),
                _ && (p += c),
                f && (d -= l),
                g && (p -= c),
                /^(se|s|e)$/.test(o) ? (e.size.width = d, e.size.height = p) : /^(ne)$/.test(o) ? (e.size.width = d, e.size.height = p, e.position.top = a.top - u) : /^(sw)$/.test(o) ? (e.size.width = d, e.size.height = p, e.position.left = a.left - h) : (p - c > 0 ? (e.size.height = p, e.position.top = a.top - u) : (e.size.height = c, e.position.top = a.top + n.height - c), d - l > 0 ? (e.size.width = d, e.position.left = a.left - h) : (e.size.width = l, e.position.left = a.left + n.width - l))

            }

        })

    } (jQuery),
    function(t) {
        t.widget("ui.selectable", t.ui.mouse, {
            version: "1.10.4",
            options: {
                appendTo: "body",
                autoRefresh: !0,
                distance: 0,
                filter: "*",
                tolerance: "touch",
                selected: null,
                selecting: null,
                start: null,
                stop: null,
                unselected: null,
                unselecting: null

            },
            _create: function() {
                var e,
                i = this;
                this.element.addClass("ui-selectable"),
                this.dragged = !1,
                this.refresh = function() {
                    e = t(i.options.filter, i.element[0]),
                    e.addClass("ui-selectee"),
                    e.each(function() {
                        var e = t(this),
                        i = e.offset();
                        t.data(this, "selectable-item", {
                            element: this,
                            $element: e,
                            left: i.left,
                            top: i.top,
                            right: i.left + e.outerWidth(),
                            bottom: i.top + e.outerHeight(),
                            startselected: !1,
                            selected: e.hasClass("ui-selected"),
                            selecting: e.hasClass("ui-selecting"),
                            unselecting: e.hasClass("ui-unselecting")

                        })

                    })

                },
                this.refresh(),
                this.selectees = e.addClass("ui-selectee"),
                this._mouseInit(),
                this.helper = t("<div class='ui-selectable-helper'></div>")

            },
            _destroy: function() {
                this.selectees.removeClass("ui-selectee").removeData("selectable-item"),
                this.element.removeClass("ui-selectable ui-selectable-disabled"),
                this._mouseDestroy()

            },
            _mouseStart: function(e) {
                var i = this,
                s = this.options;
                this.opos = [e.pageX, e.pageY],
                this.options.disabled || (this.selectees = t(s.filter, this.element[0]), this._trigger("start", e), t(s.appendTo).append(this.helper), this.helper.css({
                    left: e.pageX,
                    top: e.pageY,
                    width: 0,
                    height: 0

                }), s.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function() {
                    var s = t.data(this, "selectable-item");
                    s.startselected = !0,
                    e.metaKey || e.ctrlKey || (s.$element.removeClass("ui-selected"), s.selected = !1, s.$element.addClass("ui-unselecting"), s.unselecting = !0, i._trigger("unselecting", e, {
                        unselecting: s.element

                    }))

                }), t(e.target).parents().addBack().each(function() {
                    var s,
                    n = t.data(this, "selectable-item");
                    return n ? (s = !e.metaKey && !e.ctrlKey || !n.$element.hasClass("ui-selected"), n.$element.removeClass(s ? "ui-unselecting": "ui-selected").addClass(s ? "ui-selecting": "ui-unselecting"), n.unselecting = !s, n.selecting = s, n.selected = s, s ? i._trigger("selecting", e, {
                        selecting: n.element

                    }) : i._trigger("unselecting", e, {
                        unselecting: n.element

                    }), !1) : void 0

                }))

            },
            _mouseDrag: function(e) {
                if (this.dragged = !0, !this.options.disabled) {
                    var i,
                    s = this,
                    n = this.options,
                    a = this.opos[0],
                    o = this.opos[1],
                    r = e.pageX,
                    l = e.pageY;
                    return a > r && (i = r, r = a, a = i),
                    o > l && (i = l, l = o, o = i),
                    this.helper.css({
                        left: a,
                        top: o,
                        width: r - a,
                        height: l - o

                    }),
                    this.selectees.each(function() {
                        var i = t.data(this, "selectable-item"),
                        c = !1;
                        i && i.element !== s.element[0] && ("touch" === n.tolerance ? c = !(i.left > r || a > i.right || i.top > l || o > i.bottom) : "fit" === n.tolerance && (c = i.left > a && r > i.right && i.top > o && l > i.bottom), c ? (i.selected && (i.$element.removeClass("ui-selected"), i.selected = !1), i.unselecting && (i.$element.removeClass("ui-unselecting"), i.unselecting = !1), i.selecting || (i.$element.addClass("ui-selecting"), i.selecting = !0, s._trigger("selecting", e, {
                            selecting: i.element

                        }))) : (i.selecting && ((e.metaKey || e.ctrlKey) && i.startselected ? (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.$element.addClass("ui-selected"), i.selected = !0) : (i.$element.removeClass("ui-selecting"), i.selecting = !1, i.startselected && (i.$element.addClass("ui-unselecting"), i.unselecting = !0), s._trigger("unselecting", e, {
                            unselecting: i.element

                        }))), i.selected && (e.metaKey || e.ctrlKey || i.startselected || (i.$element.removeClass("ui-selected"), i.selected = !1, i.$element.addClass("ui-unselecting"), i.unselecting = !0, s._trigger("unselecting", e, {
                            unselecting: i.element

                        })))))

                    }),
                    !1

                }

            },
            _mouseStop: function(e) {
                var i = this;
                return this.dragged = !1,
                t(".ui-unselecting", this.element[0]).each(function() {
                    var s = t.data(this, "selectable-item");
                    s.$element.removeClass("ui-unselecting"),
                    s.unselecting = !1,
                    s.startselected = !1,
                    i._trigger("unselected", e, {
                        unselected: s.element

                    })

                }),
                t(".ui-selecting", this.element[0]).each(function() {
                    var s = t.data(this, "selectable-item");
                    s.$element.removeClass("ui-selecting").addClass("ui-selected"),
                    s.selecting = !1,
                    s.selected = !0,
                    s.startselected = !0,
                    i._trigger("selected", e, {
                        selected: s.element

                    })

                }),
                this._trigger("stop", e),
                this.helper.remove(),
                !1

            }

        })

    } (jQuery),
    function(t) {
        function e(t, e, i) {
            return t > e && e + i > t

        }
        function i(t) {
            return /left|right/.test(t.css("float")) || /inline|table-cell/.test(t.css("display"))

        }
        t.widget("ui.sortable", t.ui.mouse, {
            version: "1.10.4",
            widgetEventPrefix: "sort",
            ready: !1,
            options: {
                appendTo: "parent",
                axis: !1,
                connectWith: !1,
                containment: !1,
                cursor: "auto",
                cursorAt: !1,
                dropOnEmpty: !0,
                forcePlaceholderSize: !1,
                forceHelperSize: !1,
                grid: !1,
                handle: !1,
                helper: "original",
                items: "> *",
                opacity: !1,
                placeholder: !1,
                revert: !1,
                scroll: !0,
                scrollSensitivity: 20,
                scrollSpeed: 20,
                scope: "default",
                tolerance: "intersect",
                zIndex: 1e3,
                activate: null,
                beforeStop: null,
                change: null,
                deactivate: null,
                out: null,
                over: null,
                receive: null,
                remove: null,
                sort: null,
                start: null,
                stop: null,
                update: null

            },
            _create: function() {
                var t = this.options;
                this.containerCache = {},
                this.element.addClass("ui-sortable"),
                this.refresh(),
                this.floating = this.items.length ? "x" === t.axis || i(this.items[0].item) : !1,
                this.offset = this.element.offset(),
                this._mouseInit(),
                this.ready = !0

            },
            _destroy: function() {
                this.element.removeClass("ui-sortable ui-sortable-disabled"),
                this._mouseDestroy();
                for (var t = this.items.length - 1; t >= 0; t--) this.items[t].item.removeData(this.widgetName + "-item");
                return this

            },
            _setOption: function(e, i) {
                "disabled" === e ? (this.options[e] = i, this.widget().toggleClass("ui-sortable-disabled", !!i)) : t.Widget.prototype._setOption.apply(this, arguments)

            },
            _mouseCapture: function(e, i) {
                var s = null,
                n = !1,
                a = this;
                return this.reverting ? !1: this.options.disabled || "static" === this.options.type ? !1: (this._refreshItems(e), t(e.target).parents().each(function() {
                    return t.data(this, a.widgetName + "-item") === a ? (s = t(this), !1) : void 0

                }), t.data(e.target, a.widgetName + "-item") === a && (s = t(e.target)), s && (!this.options.handle || i || (t(this.options.handle, s).find("*").addBack().each(function() {
                    this === e.target && (n = !0)

                }), n)) ? (this.currentItem = s, this._removeCurrentsFromItems(), !0) : !1)

            },
            _mouseStart: function(e, i, s) {
                var n,
                a,
                o = this.options;
                if (this.currentContainer = this, this.refreshPositions(), this.helper = this._createHelper(e), this._cacheHelperProportions(), this._cacheMargins(), this.scrollParent = this.helper.scrollParent(), this.offset = this.currentItem.offset(), this.offset = {
                    top: this.offset.top - this.margins.top,
                    left: this.offset.left - this.margins.left

                },
                t.extend(this.offset, {
                    click: {
                        left: e.pageX - this.offset.left,
                        top: e.pageY - this.offset.top

                    },
                    parent: this._getParentOffset(),
                    relative: this._getRelativeOffset()

                }), this.helper.css("position", "absolute"), this.cssPosition = this.helper.css("position"), this.originalPosition = this._generatePosition(e), this.originalPageX = e.pageX, this.originalPageY = e.pageY, o.cursorAt && this._adjustOffsetFromHelper(o.cursorAt), this.domPosition = {
                    prev: this.currentItem.prev()[0],
                    parent: this.currentItem.parent()[0]

                },
                this.helper[0] !== this.currentItem[0] && this.currentItem.hide(), this._createPlaceholder(), o.containment && this._setContainment(), o.cursor && "auto" !== o.cursor && (a = this.document.find("body"), this.storedCursor = a.css("cursor"), a.css("cursor", o.cursor), this.storedStylesheet = t("<style>*{ cursor: " + o.cursor + " !important; }</style>").appendTo(a)), o.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")), this.helper.css("opacity", o.opacity)), o.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", o.zIndex)), this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()), this._trigger("start", e, this._uiHash()), this._preserveHelperProportions || this._cacheHelperProportions(), !s) for (n = this.containers.length - 1; n >= 0; n--) this.containers[n]._trigger("activate", e, this._uiHash(this));
                return t.ui.ddmanager && (t.ui.ddmanager.current = this),
                t.ui.ddmanager && !o.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e),
                this.dragging = !0,
                this.helper.addClass("ui-sortable-helper"),
                this._mouseDrag(e),
                !0

            },
            _mouseDrag: function(e) {
                var i,
                s,
                n,
                a,
                o = this.options,
                r = !1;
                for (this.position = this._generatePosition(e), this.positionAbs = this._convertPositionTo("absolute"), this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs), this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top + this.scrollParent[0].offsetHeight - e.pageY < o.scrollSensitivity ? this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop + o.scrollSpeed: e.pageY - this.overflowOffset.top < o.scrollSensitivity && (this.scrollParent[0].scrollTop = r = this.scrollParent[0].scrollTop - o.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - e.pageX < o.scrollSensitivity ? this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft + o.scrollSpeed: e.pageX - this.overflowOffset.left < o.scrollSensitivity && (this.scrollParent[0].scrollLeft = r = this.scrollParent[0].scrollLeft - o.scrollSpeed)) : (e.pageY - t(document).scrollTop() < o.scrollSensitivity ? r = t(document).scrollTop(t(document).scrollTop() - o.scrollSpeed) : t(window).height() - (e.pageY - t(document).scrollTop()) < o.scrollSensitivity && (r = t(document).scrollTop(t(document).scrollTop() + o.scrollSpeed)), e.pageX - t(document).scrollLeft() < o.scrollSensitivity ? r = t(document).scrollLeft(t(document).scrollLeft() - o.scrollSpeed) : t(window).width() - (e.pageX - t(document).scrollLeft()) < o.scrollSensitivity && (r = t(document).scrollLeft(t(document).scrollLeft() + o.scrollSpeed))), r !== !1 && t.ui.ddmanager && !o.dropBehaviour && t.ui.ddmanager.prepareOffsets(this, e)), this.positionAbs = this._convertPositionTo("absolute"), this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"), this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"), i = this.items.length - 1; i >= 0; i--) if (s = this.items[i], n = s.item[0], a = this._intersectsWithPointer(s), a && s.instance === this.currentContainer && n !== this.currentItem[0] && this.placeholder[1 === a ? "next": "prev"]()[0] !== n && !t.contains(this.placeholder[0], n) && ("semi-dynamic" === this.options.type ? !t.contains(this.element[0], n) : !0)) {
                    if (this.direction = 1 === a ? "down": "up", "pointer" !== this.options.tolerance && !this._intersectsWithSides(s)) break;
                    this._rearrange(e, s),
                    this._trigger("change", e, this._uiHash());
                    break

                }
                return this._contactContainers(e),
                t.ui.ddmanager && t.ui.ddmanager.drag(this, e),
                this._trigger("sort", e, this._uiHash()),
                this.lastPositionAbs = this.positionAbs,
                !1

            },
            _mouseStop: function(e, i) {
                if (e) {
                    if (t.ui.ddmanager && !this.options.dropBehaviour && t.ui.ddmanager.drop(this, e), this.options.revert) {
                        var s = this,
                        n = this.placeholder.offset(),
                        a = this.options.axis,
                        o = {};
                        a && "x" !== a || (o.left = n.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0: this.offsetParent[0].scrollLeft)),
                        a && "y" !== a || (o.top = n.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0: this.offsetParent[0].scrollTop)),
                        this.reverting = !0,
                        t(this.helper).animate(o, parseInt(this.options.revert, 10) || 500, 
                        function() {
                            s._clear(e)

                        })

                    } else this._clear(e, i);
                    return ! 1

                }

            },
            cancel: function() {
                if (this.dragging) {
                    this._mouseUp({
                        target: null

                    }),
                    "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show();
                    for (var e = this.containers.length - 1; e >= 0; e--) this.containers[e]._trigger("deactivate", null, this._uiHash(this)),
                    this.containers[e].containerCache.over && (this.containers[e]._trigger("out", null, this._uiHash(this)), this.containers[e].containerCache.over = 0)

                }
                return this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), t.extend(this, {
                    helper: null,
                    dragging: !1,
                    reverting: !1,
                    _noFinalSort: null

                }), this.domPosition.prev ? t(this.domPosition.prev).after(this.currentItem) : t(this.domPosition.parent).prepend(this.currentItem)),
                this

            },
            serialize: function(e) {
                var i = this._getItemsAsjQuery(e && e.connected),
                s = [];
                return e = e || {},
                t(i).each(function() {
                    var i = (t(e.item || this).attr(e.attribute || "id") || "").match(e.expression || /(.+)[\-=_](.+)/);
                    i && s.push((e.key || i[1] + "[]") + "=" + (e.key && e.expression ? i[1] : i[2]))

                }),
                !s.length && e.key && s.push(e.key + "="),
                s.join("&")

            },
            toArray: function(e) {
                var i = this._getItemsAsjQuery(e && e.connected),
                s = [];
                return e = e || {},
                i.each(function() {
                    s.push(t(e.item || this).attr(e.attribute || "id") || "")

                }),
                s

            },
            _intersectsWith: function(t) {
                var e = this.positionAbs.left,
                i = e + this.helperProportions.width,
                s = this.positionAbs.top,
                n = s + this.helperProportions.height,
                a = t.left,
                o = a + t.width,
                r = t.top,
                l = r + t.height,
                c = this.offset.click.top,
                h = this.offset.click.left,
                u = "x" === this.options.axis || s + c > r && l > s + c,
                d = "y" === this.options.axis || e + h > a && o > e + h,
                p = u && d;
                return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width": "height"] > t[this.floating ? "width": "height"] ? p: e + this.helperProportions.width / 2 > a && o > i - this.helperProportions.width / 2 && s + this.helperProportions.height / 2 > r && l > n - this.helperProportions.height / 2

            },
            _intersectsWithPointer: function(t) {
                var i = "x" === this.options.axis || e(this.positionAbs.top + this.offset.click.top, t.top, t.height),
                s = "y" === this.options.axis || e(this.positionAbs.left + this.offset.click.left, t.left, t.width),
                n = i && s,
                a = this._getDragVerticalDirection(),
                o = this._getDragHorizontalDirection();
                return n ? this.floating ? o && "right" === o || "down" === a ? 2: 1: a && ("down" === a ? 2: 1) : !1

            },
            _intersectsWithSides: function(t) {
                var i = e(this.positionAbs.top + this.offset.click.top, t.top + t.height / 2, t.height),
                s = e(this.positionAbs.left + this.offset.click.left, t.left + t.width / 2, t.width),
                n = this._getDragVerticalDirection(),
                a = this._getDragHorizontalDirection();
                return this.floating && a ? "right" === a && s || "left" === a && !s: n && ("down" === n && i || "up" === n && !i)

            },
            _getDragVerticalDirection: function() {
                var t = this.positionAbs.top - this.lastPositionAbs.top;
                return 0 !== t && (t > 0 ? "down": "up")

            },
            _getDragHorizontalDirection: function() {
                var t = this.positionAbs.left - this.lastPositionAbs.left;
                return 0 !== t && (t > 0 ? "right": "left")

            },
            refresh: function(t) {
                return this._refreshItems(t),
                this.refreshPositions(),
                this

            },
            _connectWith: function() {
                var t = this.options;
                return t.connectWith.constructor === String ? [t.connectWith] : t.connectWith

            },
            _getItemsAsjQuery: function(e) {
                function i() {
                    r.push(this)

                }
                var s,
                n,
                a,
                o,
                r = [],
                l = [],
                c = this._connectWith();
                if (c && e) for (s = c.length - 1; s >= 0; s--) for (a = t(c[s]), n = a.length - 1; n >= 0; n--) o = t.data(a[n], this.widgetFullName),
                o && o !== this && !o.options.disabled && l.push([t.isFunction(o.options.items) ? o.options.items.call(o.element) : t(o.options.items, o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), o]);
                for (l.push([t.isFunction(this.options.items) ? this.options.items.call(this.element, null, {
                    options: this.options,
                    item: this.currentItem

                }) : t(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]), s = l.length - 1; s >= 0; s--) l[s][0].each(i);
                return t(r)

            },
            _removeCurrentsFromItems: function() {
                var e = this.currentItem.find(":data(" + this.widgetName + "-item)");
                this.items = t.grep(this.items, 
                function(t) {
                    for (var i = 0; e.length > i; i++) if (e[i] === t.item[0]) return ! 1;
                    return ! 0

                })

            },
            _refreshItems: function(e) {
                this.items = [],
                this.containers = [this];
                var i,
                s,
                n,
                a,
                o,
                r,
                l,
                c,
                h = this.items,
                u = [
                [t.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, {
                    item: this.currentItem

                }) : t(this.options.items, this.element), this]
                ],
                d = this._connectWith();
                if (d && this.ready) for (i = d.length - 1; i >= 0; i--) for (n = t(d[i]), s = n.length - 1; s >= 0; s--) a = t.data(n[s], this.widgetFullName),
                a && a !== this && !a.options.disabled && (u.push([t.isFunction(a.options.items) ? a.options.items.call(a.element[0], e, {
                    item: this.currentItem

                }) : t(a.options.items, a.element), a]), this.containers.push(a));
                for (i = u.length - 1; i >= 0; i--) for (o = u[i][1], r = u[i][0], s = 0, c = r.length; c > s; s++) l = t(r[s]),
                l.data(this.widgetName + "-item", o),
                h.push({
                    item: l,
                    instance: o,
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0

                })

            },
            refreshPositions: function(e) {
                this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset());
                var i,
                s,
                n,
                a;
                for (i = this.items.length - 1; i >= 0; i--) s = this.items[i],
                s.instance !== this.currentContainer && this.currentContainer && s.item[0] !== this.currentItem[0] || (n = this.options.toleranceElement ? t(this.options.toleranceElement, s.item) : s.item, e || (s.width = n.outerWidth(), s.height = n.outerHeight()), a = n.offset(), s.left = a.left, s.top = a.top);
                if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
                else for (i = this.containers.length - 1; i >= 0; i--) a = this.containers[i].element.offset(),
                this.containers[i].containerCache.left = a.left,
                this.containers[i].containerCache.top = a.top,
                this.containers[i].containerCache.width = this.containers[i].element.outerWidth(),
                this.containers[i].containerCache.height = this.containers[i].element.outerHeight();
                return this

            },
            _createPlaceholder: function(e) {
                e = e || this;
                var i,
                s = e.options;
                s.placeholder && s.placeholder.constructor !== String || (i = s.placeholder, s.placeholder = {
                    element: function() {
                        var s = e.currentItem[0].nodeName.toLowerCase(),
                        n = t("<" + s + ">", e.document[0]).addClass(i || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper");
                        return "tr" === s ? e.currentItem.children().each(function() {
                            t("<td>&#160;</td>", e.document[0]).attr("colspan", t(this).attr("colspan") || 1).appendTo(n)

                        }) : "img" === s && n.attr("src", e.currentItem.attr("src")),
                        i || n.css("visibility", "hidden"),
                        n

                    },
                    update: function(t, n) {
                        (!i || s.forcePlaceholderSize) && (n.height() || n.height(e.currentItem.innerHeight() - parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), n.width() || n.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10)))

                    }

                }),
                e.placeholder = t(s.placeholder.element.call(e.element, e.currentItem)),
                e.currentItem.after(e.placeholder),
                s.placeholder.update(e, e.placeholder)

            },
            _contactContainers: function(s) {
                var n,
                a,
                o,
                r,
                l,
                c,
                h,
                u,
                d,
                p,
                f = null,
                g = null;
                for (n = this.containers.length - 1; n >= 0; n--) if (!t.contains(this.currentItem[0], this.containers[n].element[0])) if (this._intersectsWith(this.containers[n].containerCache)) {
                    if (f && t.contains(this.containers[n].element[0], f.element[0])) continue;
                    f = this.containers[n],
                    g = n

                } else this.containers[n].containerCache.over && (this.containers[n]._trigger("out", s, this._uiHash(this)), this.containers[n].containerCache.over = 0);
                if (f) if (1 === this.containers.length) this.containers[g].containerCache.over || (this.containers[g]._trigger("over", s, this._uiHash(this)), this.containers[g].containerCache.over = 1);
                else {
                    for (o = 1e4, r = null, p = f.floating || i(this.currentItem), l = p ? "left": "top", c = p ? "width": "height", h = this.positionAbs[l] + this.offset.click[l], a = this.items.length - 1; a >= 0; a--) t.contains(this.containers[g].element[0], this.items[a].item[0]) && this.items[a].item[0] !== this.currentItem[0] && (!p || e(this.positionAbs.top + this.offset.click.top, this.items[a].top, this.items[a].height)) && (u = this.items[a].item.offset()[l], d = !1, Math.abs(u - h) > Math.abs(u + this.items[a][c] - h) && (d = !0, u += this.items[a][c]), o > Math.abs(u - h) && (o = Math.abs(u - h), r = this.items[a], this.direction = d ? "up": "down"));
                    if (!r && !this.options.dropOnEmpty) return;
                    if (this.currentContainer === this.containers[g]) return;
                    r ? this._rearrange(s, r, null, !0) : this._rearrange(s, null, this.containers[g].element, !0),
                    this._trigger("change", s, this._uiHash()),
                    this.containers[g]._trigger("change", s, this._uiHash(this)),
                    this.currentContainer = this.containers[g],
                    this.options.placeholder.update(this.currentContainer, this.placeholder),
                    this.containers[g]._trigger("over", s, this._uiHash(this)),
                    this.containers[g].containerCache.over = 1

                }

            },
            _createHelper: function(e) {
                var i = this.options,
                s = t.isFunction(i.helper) ? t(i.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === i.helper ? this.currentItem.clone() : this.currentItem;
                return s.parents("body").length || t("parent" !== i.appendTo ? i.appendTo: this.currentItem[0].parentNode)[0].appendChild(s[0]),
                s[0] === this.currentItem[0] && (this._storedCSS = {
                    width: this.currentItem[0].style.width,
                    height: this.currentItem[0].style.height,
                    position: this.currentItem.css("position"),
                    top: this.currentItem.css("top"),
                    left: this.currentItem.css("left")

                }),
                (!s[0].style.width || i.forceHelperSize) && s.width(this.currentItem.width()),
                (!s[0].style.height || i.forceHelperSize) && s.height(this.currentItem.height()),
                s

            },
            _adjustOffsetFromHelper: function(e) {
                "string" == typeof e && (e = e.split(" ")),
                t.isArray(e) && (e = {
                    left: +e[0],
                    top: +e[1] || 0

                }),
                "left" in e && (this.offset.click.left = e.left + this.margins.left),
                "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left),
                "top" in e && (this.offset.click.top = e.top + this.margins.top),
                "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)

            },
            _getParentOffset: function() {
                this.offsetParent = this.helper.offsetParent();
                var e = this.offsetParent.offset();
                return "absolute" === this.cssPosition && this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()),
                (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && t.ui.ie) && (e = {
                    top: 0,
                    left: 0

                }),
                {
                    top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0),
                    left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0)

                }

            },
            _getRelativeOffset: function() {
                if ("relative" === this.cssPosition) {
                    var t = this.currentItem.position();
                    return {
                        top: t.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(),
                        left: t.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft()

                    }

                }
                return {
                    top: 0,
                    left: 0

                }

            },
            _cacheMargins: function() {
                this.margins = {
                    left: parseInt(this.currentItem.css("marginLeft"), 10) || 0,
                    top: parseInt(this.currentItem.css("marginTop"), 10) || 0

                }

            },
            _cacheHelperProportions: function() {
                this.helperProportions = {
                    width: this.helper.outerWidth(),
                    height: this.helper.outerHeight()

                }

            },
            _setContainment: function() {
                var e,
                i,
                s,
                n = this.options;
                "parent" === n.containment && (n.containment = this.helper[0].parentNode),
                ("document" === n.containment || "window" === n.containment) && (this.containment = [0 - this.offset.relative.left - this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, t("document" === n.containment ? document: window).width() - this.helperProportions.width - this.margins.left, (t("document" === n.containment ? document: window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]),
                /^(document|window|parent)$/.test(n.containment) || (e = t(n.containment)[0], i = t(n.containment).offset(), s = "hidden" !== t(e).css("overflow"), this.containment = [i.left + (parseInt(t(e).css("borderLeftWidth"), 10) || 0) + (parseInt(t(e).css("paddingLeft"), 10) || 0) - this.margins.left, i.top + (parseInt(t(e).css("borderTopWidth"), 10) || 0) + (parseInt(t(e).css("paddingTop"), 10) || 0) - this.margins.top, i.left + (s ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(t(e).css("borderLeftWidth"), 10) || 0) - (parseInt(t(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, i.top + (s ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(t(e).css("borderTopWidth"), 10) || 0) - (parseInt(t(e).css("paddingBottom"), 10) || 0) - this.helperProportions.height - this.margins.top])

            },
            _convertPositionTo: function(e, i) {
                i || (i = this.position);
                var s = "absolute" === e ? 1: -1,
                n = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent: this.offsetParent,
                a = /(html|body)/i.test(n[0].tagName);
                return {
                    top: i.top + this.offset.relative.top * s + this.offset.parent.top * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : a ? 0: n.scrollTop()) * s,
                    left: i.left + this.offset.relative.left * s + this.offset.parent.left * s - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : a ? 0: n.scrollLeft()) * s

                }

            },
            _generatePosition: function(e) {
                var i,
                s,
                n = this.options,
                a = e.pageX,
                o = e.pageY,
                r = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && t.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent: this.offsetParent,
                l = /(html|body)/i.test(r[0].tagName);
                return "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative = this._getRelativeOffset()),
                this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (a = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (o = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (a = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (o = this.containment[3] + this.offset.click.top)), n.grid && (i = this.originalPageY + Math.round((o - this.originalPageY) / n.grid[1]) * n.grid[1], o = this.containment ? i - this.offset.click.top >= this.containment[1] && i - this.offset.click.top <= this.containment[3] ? i: i - this.offset.click.top >= this.containment[1] ? i - n.grid[1] : i + n.grid[1] : i, s = this.originalPageX + Math.round((a - this.originalPageX) / n.grid[0]) * n.grid[0], a = this.containment ? s - this.offset.click.left >= this.containment[0] && s - this.offset.click.left <= this.containment[2] ? s: s - this.offset.click.left >= this.containment[0] ? s - n.grid[0] : s + n.grid[0] : s)),
                {
                    top: o - this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : l ? 0: r.scrollTop()),
                    left: a - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : l ? 0: r.scrollLeft())

                }

            },
            _rearrange: function(t, e, i, s) {
                i ? i[0].appendChild(this.placeholder[0]) : e.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? e.item[0] : e.item[0].nextSibling),
                this.counter = this.counter ? ++this.counter: 1;
                var n = this.counter;
                this._delay(function() {
                    n === this.counter && this.refreshPositions(!s)

                })

            },
            _clear: function(t, e) {
                function i(t, e, i) {
                    return function(s) {
                        i._trigger(t, s, e._uiHash(e))

                    }

                }
                this.reverting = !1;
                var s,
                n = [];
                if (!this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem), this._noFinalSort = null, this.helper[0] === this.currentItem[0]) {
                    for (s in this._storedCSS)("auto" === this._storedCSS[s] || "static" === this._storedCSS[s]) && (this._storedCSS[s] = "");
                    this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")

                } else this.currentItem.show();
                for (this.fromOutside && !e && n.push(function(t) {
                    this._trigger("receive", t, this._uiHash(this.fromOutside))

                }), !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || e || n.push(function(t) {
                    this._trigger("update", t, this._uiHash())

                }), this !== this.currentContainer && (e || (n.push(function(t) {
                    this._trigger("remove", t, this._uiHash())

                }), n.push(function(t) {
                    return function(e) {
                        t._trigger("receive", e, this._uiHash(this))

                    }

                }.call(this, this.currentContainer)), n.push(function(t) {
                    return function(e) {
                        t._trigger("update", e, this._uiHash(this))

                    }

                }.call(this, this.currentContainer)))), s = this.containers.length - 1; s >= 0; s--) e || n.push(i("deactivate", this, this.containers[s])),
                this.containers[s].containerCache.over && (n.push(i("out", this, this.containers[s])), this.containers[s].containerCache.over = 0);
                if (this.storedCursor && (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()), this._storedOpacity && this.helper.css("opacity", this._storedOpacity), this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "": this._storedZIndex), this.dragging = !1, this.cancelHelperRemoval) {
                    if (!e) {
                        for (this._trigger("beforeStop", t, this._uiHash()), s = 0; n.length > s; s++) n[s].call(this, t);
                        this._trigger("stop", t, this._uiHash())

                    }
                    return this.fromOutside = !1,
                    !1

                }
                if (e || this._trigger("beforeStop", t, this._uiHash()), this.placeholder[0].parentNode.removeChild(this.placeholder[0]), this.helper[0] !== this.currentItem[0] && this.helper.remove(), this.helper = null, !e) {
                    for (s = 0; n.length > s; s++) n[s].call(this, t);
                    this._trigger("stop", t, this._uiHash())

                }
                return this.fromOutside = !1,
                !0

            },
            _trigger: function() {
                t.Widget.prototype._trigger.apply(this, arguments) === !1 && this.cancel()

            },
            _uiHash: function(e) {
                var i = e || this;
                return {
                    helper: i.helper,
                    placeholder: i.placeholder || t([]),
                    position: i.position,
                    originalPosition: i.originalPosition,
                    offset: i.positionAbs,
                    item: i.currentItem,
                    sender: e ? e.element: null

                }

            }

        })

    } (jQuery),
    function(t) {
        var e = 0,
        i = {},
        s = {};
        i.height = i.paddingTop = i.paddingBottom = i.borderTopWidth = i.borderBottomWidth = "hide",
        s.height = s.paddingTop = s.paddingBottom = s.borderTopWidth = s.borderBottomWidth = "show",
        t.widget("ui.accordion", {
            version: "1.10.4",
            options: {
                active: 0,
                animate: {},
                collapsible: !1,
                event: "click",
                header: "> li > :first-child,> :not(li):even",
                heightStyle: "auto",
                icons: {
                    activeHeader: "ui-icon-triangle-1-s",
                    header: "ui-icon-triangle-1-e"

                },
                activate: null,
                beforeActivate: null

            },
            _create: function() {
                var e = this.options;
                this.prevShow = this.prevHide = t(),
                this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"),
                e.collapsible || e.active !== !1 && null != e.active || (e.active = 0),
                this._processPanels(),
                0 > e.active && (e.active += this.headers.length),
                this._refresh()

            },
            _getCreateEventData: function() {
                return {
                    header: this.active,
                    panel: this.active.length ? this.active.next() : t(),
                    content: this.active.length ? this.active.next() : t()

                }

            },
            _createIcons: function() {
                var e = this.options.icons;
                e && (t("<span>").addClass("ui-accordion-header-icon ui-icon " + e.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(e.header).addClass(e.activeHeader), this.headers.addClass("ui-accordion-icons"))

            },
            _destroyIcons: function() {
                this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()

            },
            _destroy: function() {
                var t;
                this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"),
                this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").each(function() {
                    / ^ui - accordion / .test(this.id) && this.removeAttribute("id")

                }),
                this._destroyIcons(),
                t = this.headers.next().css("display", "").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").each(function() {
                    / ^ui - accordion / .test(this.id) && this.removeAttribute("id")

                }),
                "content" !== this.options.heightStyle && t.css("height", "")

            },
            _setOption: function(t, e) {
                return "active" === t ? void this._activate(e) : ("event" === t && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(e)), this._super(t, e), "collapsible" !== t || e || this.options.active !== !1 || this._activate(0), "icons" === t && (this._destroyIcons(), e && this._createIcons()), void("disabled" === t && this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!e)))

            },
            _keydown: function(e) {
                if (!e.altKey && !e.ctrlKey) {
                    var i = t.ui.keyCode,
                    s = this.headers.length,
                    n = this.headers.index(e.target),
                    a = !1;
                    switch (e.keyCode) {
                        case i.RIGHT:
                    case i.DOWN:
                        a = this.headers[(n + 1) % s];
                        break;
                        case i.LEFT:
                    case i.UP:
                        a = this.headers[(n - 1 + s) % s];
                        break;
                        case i.SPACE:
                    case i.ENTER:
                        this._eventHandler(e);
                        break;
                        case i.HOME:
                        a = this.headers[0];
                        break;
                        case i.END:
                        a = this.headers[s - 1]

                    }
                    a && (t(e.target).attr("tabIndex", -1), t(a).attr("tabIndex", 0), a.focus(), e.preventDefault())

                }

            },
            _panelKeyDown: function(e) {
                e.keyCode === t.ui.keyCode.UP && e.ctrlKey && t(e.currentTarget).prev().focus()

            },
            refresh: function() {
                var e = this.options;
                this._processPanels(),
                e.active === !1 && e.collapsible === !0 || !this.headers.length ? (e.active = !1, this.active = t()) : e.active === !1 ? this._activate(0) : this.active.length && !t.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (e.active = !1, this.active = t()) : this._activate(Math.max(0, e.active - 1)) : e.active = this.headers.index(this.active),
                this._destroyIcons(),
                this._refresh()

            },
            _processPanels: function() {
                this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"),
                this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide()

            },
            _refresh: function() {
                var i,
                s = this.options,
                n = s.heightStyle,
                a = this.element.parent(),
                o = this.accordionId = "ui-accordion-" + (this.element.attr("id") || ++e);
                this.active = this._findActive(s.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"),
                this.active.next().addClass("ui-accordion-content-active").show(),
                this.headers.attr("role", "tab").each(function(e) {
                    var i = t(this),
                    s = i.attr("id"),
                    n = i.next(),
                    a = n.attr("id");
                    s || (s = o + "-header-" + e, i.attr("id", s)),
                    a || (a = o + "-panel-" + e, n.attr("id", a)),
                    i.attr("aria-controls", a),
                    n.attr("aria-labelledby", s)

                }).next().attr("role", "tabpanel"),
                this.headers.not(this.active).attr({
                    "aria-selected": "false",
                    "aria-expanded": "false",
                    tabIndex: -1

                }).next().attr({
                    "aria-hidden": "true"

                }).hide(),
                this.active.length ? this.active.attr({
                    "aria-selected": "true",
                    "aria-expanded": "true",
                    tabIndex: 0

                }).next().attr({
                    "aria-hidden": "false"

                }) : this.headers.eq(0).attr("tabIndex", 0),
                this._createIcons(),
                this._setupEvents(s.event),
                "fill" === n ? (i = a.height(), this.element.siblings(":visible").each(function() {
                    var e = t(this),
                    s = e.css("position");
                    "absolute" !== s && "fixed" !== s && (i -= e.outerHeight(!0))

                }), this.headers.each(function() {
                    i -= t(this).outerHeight(!0)

                }), this.headers.next().each(function() {
                    t(this).height(Math.max(0, i - t(this).innerHeight() + t(this).height()))

                }).css("overflow", "auto")) : "auto" === n && (i = 0, this.headers.next().each(function() {
                    i = Math.max(i, t(this).css("height", "").height())

                }).height(i))

            },
            _activate: function(e) {
                var i = this._findActive(e)[0];
                i !== this.active[0] && (i = i || this.active[0], this._eventHandler({
                    target: i,
                    currentTarget: i,
                    preventDefault: t.noop

                }))

            },
            _findActive: function(e) {
                return "number" == typeof e ? this.headers.eq(e) : t()

            },
            _setupEvents: function(e) {
                var i = {
                    keydown: "_keydown"

                };
                e && t.each(e.split(" "), 
                function(t, e) {
                    i[e] = "_eventHandler"

                }),
                this._off(this.headers.add(this.headers.next())),
                this._on(this.headers, i),
                this._on(this.headers.next(), {
                    keydown: "_panelKeyDown"

                }),
                this._hoverable(this.headers),
                this._focusable(this.headers)

            },
            _eventHandler: function(e) {
                var i = this.options,
                s = this.active,
                n = t(e.currentTarget),
                a = n[0] === s[0],
                o = a && i.collapsible,
                r = o ? t() : n.next(),
                l = s.next(),
                c = {
                    oldHeader: s,
                    oldPanel: l,
                    newHeader: o ? t() : n,
                    newPanel: r

                };
                e.preventDefault(),
                a && !i.collapsible || this._trigger("beforeActivate", e, c) === !1 || (i.active = o ? !1: this.headers.index(n), this.active = a ? t() : n, this._toggle(c), s.removeClass("ui-accordion-header-active ui-state-active"), i.icons && s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header), a || (n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"), i.icons && n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader), n.next().addClass("ui-accordion-content-active")))

            },
            _toggle: function(e) {
                var i = e.newPanel,
                s = this.prevShow.length ? this.prevShow: e.oldPanel;
                this.prevShow.add(this.prevHide).stop(!0, !0),
                this.prevShow = i,
                this.prevHide = s,
                this.options.animate ? this._animate(i, s, e) : (s.hide(), i.show(), this._toggleComplete(e)),
                s.attr({
                    "aria-hidden": "true"

                }),
                s.prev().attr("aria-selected", "false"),
                i.length && s.length ? s.prev().attr({
                    tabIndex: -1,
                    "aria-expanded": "false"

                }) : i.length && this.headers.filter(function() {
                    return 0 === t(this).attr("tabIndex")

                }).attr("tabIndex", -1),
                i.attr("aria-hidden", "false").prev().attr({
                    "aria-selected": "true",
                    tabIndex: 0,
                    "aria-expanded": "true"

                })

            },
            _animate: function(t, e, n) {
                var a,
                o,
                r,
                l = this,
                c = 0,
                h = t.length && (!e.length || t.index() < e.index()),
                u = this.options.animate || {},
                d = h && u.down || u,
                p = function() {
                    l._toggleComplete(n)

                };
                return "number" == typeof d && (r = d),
                "string" == typeof d && (o = d),
                o = o || d.easing || u.easing,
                r = r || d.duration || u.duration,
                e.length ? t.length ? (a = t.show().outerHeight(), e.animate(i, {
                    duration: r,
                    easing: o,
                    step: function(t, e) {
                        e.now = Math.round(t)

                    }

                }), void t.hide().animate(s, {
                    duration: r,
                    easing: o,
                    complete: p,
                    step: function(t, i) {
                        i.now = Math.round(t),
                        "height" !== i.prop ? c += i.now: "content" !== l.options.heightStyle && (i.now = Math.round(a - e.outerHeight() - c), c = 0)

                    }

                })) : e.animate(i, r, o, p) : t.animate(s, r, o, p)

            },
            _toggleComplete: function(t) {
                var e = t.oldPanel;
                e.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"),
                e.length && (e.parent()[0].className = e.parent()[0].className),
                this._trigger("activate", null, t)

            }

        })

    } (jQuery),
    function(t) {
        t.widget("ui.autocomplete", {
            version: "1.10.4",
            defaultElement: "<input>",
            options: {
                appendTo: null,
                autoFocus: !1,
                delay: 300,
                minLength: 1,
                position: {
                    my: "left top",
                    at: "left bottom",
                    collision: "none"

                },
                source: null,
                change: null,
                close: null,
                focus: null,
                open: null,
                response: null,
                search: null,
                select: null

            },
            requestIndex: 0,
            pending: 0,
            _create: function() {
                var e,
                i,
                s,
                n = this.element[0].nodeName.toLowerCase(),
                a = "textarea" === n,
                o = "input" === n;
                this.isMultiLine = a ? !0: o ? !1: this.element.prop("isContentEditable"),
                this.valueMethod = this.element[a || o ? "val": "text"],
                this.isNewMenu = !0,
                this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"),
                this._on(this.element, {
                    keydown: function(n) {
                        if (this.element.prop("readOnly")) return e = !0,
                        s = !0,
                        void(i = !0);
                        e = !1,
                        s = !1,
                        i = !1;
                        var a = t.ui.keyCode;
                        switch (n.keyCode) {
                            case a.PAGE_UP:
                            e = !0,
                            this._move("previousPage", n);
                            break;
                            case a.PAGE_DOWN:
                            e = !0,
                            this._move("nextPage", n);
                            break;
                            case a.UP:
                            e = !0,
                            this._keyEvent("previous", n);
                            break;
                            case a.DOWN:
                            e = !0,
                            this._keyEvent("next", n);
                            break;
                            case a.ENTER:
                        case a.NUMPAD_ENTER:
                            this.menu.active && (e = !0, n.preventDefault(), this.menu.select(n));
                            break;
                            case a.TAB:
                            this.menu.active && this.menu.select(n);
                            break;
                            case a.ESCAPE:
                            this.menu.element.is(":visible") && (this._value(this.term), this.close(n), n.preventDefault());
                            break;
                            default:
                            i = !0,
                            this._searchTimeout(n)

                        }

                    },
                    keypress: function(s) {
                        if (e) return e = !1,
                        void((!this.isMultiLine || this.menu.element.is(":visible")) && s.preventDefault());
                        if (!i) {
                            var n = t.ui.keyCode;
                            switch (s.keyCode) {
                                case n.PAGE_UP:
                                this._move("previousPage", s);
                                break;
                                case n.PAGE_DOWN:
                                this._move("nextPage", s);
                                break;
                                case n.UP:
                                this._keyEvent("previous", s);
                                break;
                                case n.DOWN:
                                this._keyEvent("next", s)

                            }

                        }

                    },
                    input: function(t) {
                        return s ? (s = !1, void t.preventDefault()) : void this._searchTimeout(t)

                    },
                    focus: function() {
                        this.selectedItem = null,
                        this.previous = this._value()

                    },
                    blur: function(t) {
                        return this.cancelBlur ? void delete this.cancelBlur: (clearTimeout(this.searching), this.close(t), void this._change(t))

                    }

                }),
                this._initSource(),
                this.menu = t("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({
                    role: null

                }).hide().data("ui-menu"),
                this._on(this.menu.element, {
                    mousedown: function(e) {
                        e.preventDefault(),
                        this.cancelBlur = !0,
                        this._delay(function() {
                            delete this.cancelBlur

                        });
                        var i = this.menu.element[0];
                        t(e.target).closest(".ui-menu-item").length || this._delay(function() {
                            var e = this;
                            this.document.one("mousedown", 
                            function(s) {
                                s.target === e.element[0] || s.target === i || t.contains(i, s.target) || e.close()

                            })

                        })

                    },
                    menufocus: function(e, i) {
                        if (this.isNewMenu && (this.isNewMenu = !1, e.originalEvent && /^mouse/.test(e.originalEvent.type))) return this.menu.blur(),
                        void this.document.one("mousemove", 
                        function() {
                            t(e.target).trigger(e.originalEvent)

                        });
                        var s = i.item.data("ui-autocomplete-item");
                        ! 1 !== this._trigger("focus", e, {
                            item: s

                        }) ? e.originalEvent && /^key/.test(e.originalEvent.type) && this._value(s.value) : this.liveRegion.text(s.value)

                    },
                    menuselect: function(t, e) {
                        var i = e.item.data("ui-autocomplete-item"),
                        s = this.previous;
                        this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = s, this._delay(function() {
                            this.previous = s,
                            this.selectedItem = i

                        })),
                        !1 !== this._trigger("select", t, {
                            item: i

                        }) && this._value(i.value),
                        this.term = this._value(),
                        this.close(t),
                        this.selectedItem = i

                    }

                }),
                this.liveRegion = t("<span>", {
                    role: "status",
                    "aria-live": "polite"

                }).addClass("ui-helper-hidden-accessible").insertBefore(this.element),
                this._on(this.window, {
                    beforeunload: function() {
                        this.element.removeAttr("autocomplete")

                    }

                })

            },
            _destroy: function() {
                clearTimeout(this.searching),
                this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"),
                this.menu.element.remove(),
                this.liveRegion.remove()

            },
            _setOption: function(t, e) {
                this._super(t, e),
                "source" === t && this._initSource(),
                "appendTo" === t && this.menu.element.appendTo(this._appendTo()),
                "disabled" === t && e && this.xhr && this.xhr.abort()

            },
            _appendTo: function() {
                var e = this.options.appendTo;
                return e && (e = e.jquery || e.nodeType ? t(e) : this.document.find(e).eq(0)),
                e || (e = this.element.closest(".ui-front")),
                e.length || (e = this.document[0].body),
                e

            },
            _initSource: function() {
                var e,
                i,
                s = this;
                t.isArray(this.options.source) ? (e = this.options.source, this.source = function(i, s) {
                    s(t.ui.autocomplete.filter(e, i.term))

                }) : "string" == typeof this.options.source ? (i = this.options.source, this.source = function(e, n) {
                    s.xhr && s.xhr.abort(),
                    s.xhr = t.ajax({
                        url: i,
                        data: e,
                        dataType: "json",
                        success: function(t) {
                            n(t)

                        },
                        error: function() {
                            n([])

                        }

                    })

                }) : this.source = this.options.source

            },
            _searchTimeout: function(t) {
                clearTimeout(this.searching),
                this.searching = this._delay(function() {
                    this.term !== this._value() && (this.selectedItem = null, this.search(null, t))

                },
                this.options.delay)

            },
            search: function(t, e) {
                return t = null != t ? t: this._value(),
                this.term = this._value(),
                t.length < this.options.minLength ? this.close(e) : this._trigger("search", e) !== !1 ? this._search(t) : void 0

            },
            _search: function(t) {
                this.pending++,
                this.element.addClass("ui-autocomplete-loading"),
                this.cancelSearch = !1,
                this.source({
                    term: t

                },
                this._response())

            },
            _response: function() {
                var e = ++this.requestIndex;
                return t.proxy(function(t) {
                    e === this.requestIndex && this.__response(t),
                    this.pending--,
                    this.pending || this.element.removeClass("ui-autocomplete-loading")

                },
                this)

            },
            __response: function(t) {
                t && (t = this._normalize(t)),
                this._trigger("response", null, {
                    content: t

                }),
                !this.options.disabled && t && t.length && !this.cancelSearch ? (this._suggest(t), this._trigger("open")) : this._close()

            },
            close: function(t) {
                this.cancelSearch = !0,
                this._close(t)

            },
            _close: function(t) {
                this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", t))

            },
            _change: function(t) {
                this.previous !== this._value() && this._trigger("change", t, {
                    item: this.selectedItem

                })

            },
            _normalize: function(e) {
                return e.length && e[0].label && e[0].value ? e: t.map(e, 
                function(e) {
                    return "string" == typeof e ? {
                        label: e,
                        value: e

                    }: t.extend({
                        label: e.label || e.value,
                        value: e.value || e.label

                    },
                    e)

                })

            },
            _suggest: function(e) {
                var i = this.menu.element.empty();
                this._renderMenu(i, e),
                this.isNewMenu = !0,
                this.menu.refresh(),
                i.show(),
                this._resizeMenu(),
                i.position(t.extend({
                    of: this.element

                },
                this.options.position)),
                this.options.autoFocus && this.menu.next()

            },
            _resizeMenu: function() {
                var t = this.menu.element;
                t.outerWidth(Math.max(t.width("").outerWidth() + 1, this.element.outerWidth()))

            },
            _renderMenu: function(e, i) {
                var s = this;
                t.each(i, 
                function(t, i) {
                    s._renderItemData(e, i)

                })

            },
            _renderItemData: function(t, e) {
                return this._renderItem(t, e).data("ui-autocomplete-item", e)

            },
            _renderItem: function(e, i) {
                return t("<li>").append(t("<a>").text(i.label)).appendTo(e)

            },
            _move: function(t, e) {
                return this.menu.element.is(":visible") ? this.menu.isFirstItem() && /^previous/.test(t) || this.menu.isLastItem() && /^next/.test(t) ? (this._value(this.term), void this.menu.blur()) : void this.menu[t](e) : void this.search(null, e)

            },
            widget: function() {
                return this.menu.element

            },
            _value: function() {
                return this.valueMethod.apply(this.element, arguments)

            },
            _keyEvent: function(t, e) {
                (!this.isMultiLine || this.menu.element.is(":visible")) && (this._move(t, e), e.preventDefault())

            }

        }),
        t.extend(t.ui.autocomplete, {
            escapeRegex: function(t) {
                return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")

            },
            filter: function(e, i) {
                var s = RegExp(t.ui.autocomplete.escapeRegex(i), "i");
                return t.grep(e, 
                function(t) {
                    return s.test(t.label || t.value || t)

                })

            }

        }),
        t.widget("ui.autocomplete", t.ui.autocomplete, {
            options: {
                messages: {
                    noResults: "No search results.",
                    results: function(t) {
                        return t + (t > 1 ? " results are": " result is") + " available, use up and down arrow keys to navigate."

                    }

                }

            },
            __response: function(t) {
                var e;
                this._superApply(arguments),
                this.options.disabled || this.cancelSearch || (e = t && t.length ? this.options.messages.results(t.length) : this.options.messages.noResults, this.liveRegion.text(e))

            }

        })

    } (jQuery),
    function(t) {
        var e,
        i = "ui-button ui-widget ui-state-default ui-corner-all",
        s = "ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",
        n = function() {
            var e = t(this);
            setTimeout(function() {
                e.find(":ui-button").button("refresh")

            },
            1)

        },
        a = function(e) {
            var i = e.name,
            s = e.form,
            n = t([]);
            return i && (i = i.replace(/'/g, "\\'"), n = s ? t(s).find("[name='" + i + "']") : t("[name='" + i + "']", e.ownerDocument).filter(function() {
                return ! this.form

            })),
            n

        };
        t.widget("ui.button", {
            version: "1.10.4",
            defaultElement: "<button>",
            options: {
                disabled: null,
                text: !0,
                label: null,
                icons: {
                    primary: null,
                    secondary: null

                }

            },
            _create: function() {
                this.element.closest("form").unbind("reset" + this.eventNamespace).bind("reset" + this.eventNamespace, n),
                "boolean" != typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled),
                this._determineButtonType(),
                this.hasTitle = !!this.buttonElement.attr("title");
                var s = this,
                o = this.options,
                r = "checkbox" === this.type || "radio" === this.type,
                l = r ? "": "ui-state-active";
                null === o.label && (o.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()),
                this._hoverable(this.buttonElement),
                this.buttonElement.addClass(i).attr("role", "button").bind("mouseenter" + this.eventNamespace, 
                function() {
                    o.disabled || this === e && t(this).addClass("ui-state-active")

                }).bind("mouseleave" + this.eventNamespace, 
                function() {
                    o.disabled || t(this).removeClass(l)

                }).bind("click" + this.eventNamespace, 
                function(t) {
                    o.disabled && (t.preventDefault(), t.stopImmediatePropagation())

                }),
                this._on({
                    focus: function() {
                        this.buttonElement.addClass("ui-state-focus")

                    },
                    blur: function() {
                        this.buttonElement.removeClass("ui-state-focus")

                    }

                }),
                r && this.element.bind("change" + this.eventNamespace, 
                function() {
                    s.refresh()

                }),
                "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, 
                function() {
                    return o.disabled ? !1: void 0

                }) : "radio" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, 
                function() {
                    if (o.disabled) return ! 1;
                    t(this).addClass("ui-state-active"),
                    s.buttonElement.attr("aria-pressed", "true");
                    var e = s.element[0];
                    a(e).not(e).map(function() {
                        return t(this).button("widget")[0]

                    }).removeClass("ui-state-active").attr("aria-pressed", "false")

                }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, 
                function() {
                    return o.disabled ? !1: (t(this).addClass("ui-state-active"), e = this, void s.document.one("mouseup", 
                    function() {
                        e = null

                    }))

                }).bind("mouseup" + this.eventNamespace, 
                function() {
                    return o.disabled ? !1: void t(this).removeClass("ui-state-active")

                }).bind("keydown" + this.eventNamespace, 
                function(e) {
                    return o.disabled ? !1: void((e.keyCode === t.ui.keyCode.SPACE || e.keyCode === t.ui.keyCode.ENTER) && t(this).addClass("ui-state-active"))

                }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, 
                function() {
                    t(this).removeClass("ui-state-active")

                }), this.buttonElement.is("a") && this.buttonElement.keyup(function(e) {
                    e.keyCode === t.ui.keyCode.SPACE && t(this).click()

                })),
                this._setOption("disabled", o.disabled),
                this._resetButton()

            },
            _determineButtonType: function() {
                var t,
                e,
                i;
                this.type = this.element.is("[type=checkbox]") ? "checkbox": this.element.is("[type=radio]") ? "radio": this.element.is("input") ? "input": "button",
                "checkbox" === this.type || "radio" === this.type ? (t = this.element.parents().last(), e = "label[for='" + this.element.attr("id") + "']", this.buttonElement = t.find(e), this.buttonElement.length || (t = t.length ? t.siblings() : this.element.siblings(), this.buttonElement = t.filter(e), this.buttonElement.length || (this.buttonElement = t.find(e))), this.element.addClass("ui-helper-hidden-accessible"), i = this.element.is(":checked"), i && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", i)) : this.buttonElement = this.element

            },
            widget: function() {
                return this.buttonElement

            },
            _destroy: function() {
                this.element.removeClass("ui-helper-hidden-accessible"),
                this.buttonElement.removeClass(i + " ui-state-active " + s).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()),
                this.hasTitle || this.buttonElement.removeAttr("title")

            },
            _setOption: function(t, e) {
                return this._super(t, e),
                "disabled" === t ? (this.element.prop("disabled", !!e), void(e && this.buttonElement.removeClass("ui-state-focus"))) : void this._resetButton()

            },
            refresh: function() {
                var e = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled");
                e !== this.options.disabled && this._setOption("disabled", e),
                "radio" === this.type ? a(this.element[0]).each(function() {
                    t(this).is(":checked") ? t(this).button("widget").addClass("ui-state-active").attr("aria-pressed", "true") : t(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")

                }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))

            },
            _resetButton: function() {
                if ("input" === this.type) return void(this.options.label && this.element.val(this.options.label));
                var e = this.buttonElement.removeClass(s),
                i = t("<span></span>", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(e.empty()).text(),
                n = this.options.icons,
                a = n.primary && n.secondary,
                o = [];
                n.primary || n.secondary ? (this.options.text && o.push("ui-button-text-icon" + (a ? "s": n.primary ? "-primary": "-secondary")), n.primary && e.prepend("<span class='ui-button-icon-primary ui-icon " + n.primary + "'></span>"), n.secondary && e.append("<span class='ui-button-icon-secondary ui-icon " + n.secondary + "'></span>"), this.options.text || (o.push(a ? "ui-button-icons-only": "ui-button-icon-only"), this.hasTitle || e.attr("title", t.trim(i)))) : o.push("ui-button-text-only"),
                e.addClass(o.join(" "))

            }

        }),
        t.widget("ui.buttonset", {
            version: "1.10.4",
            options: {
                items: "button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"

            },
            _create: function() {
                this.element.addClass("ui-buttonset")

            },
            _init: function() {
                this.refresh()

            },
            _setOption: function(t, e) {
                "disabled" === t && this.buttons.button("option", t, e),
                this._super(t, e)

            },
            refresh: function() {
                var e = "rtl" === this.element.css("direction");
                this.buttons = this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function() {
                    return t(this).button("widget")[0]

                }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(e ? "ui-corner-right": "ui-corner-left").end().filter(":last").addClass(e ? "ui-corner-left": "ui-corner-right").end().end()

            },
            _destroy: function() {
                this.element.removeClass("ui-buttonset"),
                this.buttons.map(function() {
                    return t(this).button("widget")[0]

                }).removeClass("ui-corner-left ui-corner-right").end().button("destroy")

            }

        })

    } (jQuery),
    function(t, e) {
        function i() {
            this._curInst = null,
            this._keyEvent = !1,
            this._disabledInputs = [],
            this._datepickerShowing = !1,
            this._inDialog = !1,
            this._mainDivId = "ui-datepicker-div",
            this._inlineClass = "ui-datepicker-inline",
            this._appendClass = "ui-datepicker-append",
            this._triggerClass = "ui-datepicker-trigger",
            this._dialogClass = "ui-datepicker-dialog",
            this._disableClass = "ui-datepicker-disabled",
            this._unselectableClass = "ui-datepicker-unselectable",
            this._currentClass = "ui-datepicker-current-day",
            this._dayOverClass = "ui-datepicker-days-cell-over",
            this.regional = [],
            this.regional[""] = {
                closeText: "Done",
                prevText: "Prev",
                nextText: "Next",
                currentText: "Today",
                monthNames: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                monthNamesShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                dayNames: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                dayNamesMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
                weekHeader: "Wk",
                dateFormat: "mm/dd/yy",
                firstDay: 0,
                isRTL: !1,
                showMonthAfterYear: !1,
                yearSuffix: ""

            },
            this._defaults = {
                showOn: "focus",
                showAnim: "fadeIn",
                showOptions: {},
                defaultDate: null,
                appendText: "",
                buttonText: "...",
                buttonImage: "",
                buttonImageOnly: !1,
                hideIfNoPrevNext: !1,
                navigationAsDateFormat: !1,
                gotoCurrent: !1,
                changeMonth: !1,
                changeYear: !1,
                yearRange: "c-10:c+10",
                showOtherMonths: !1,
                selectOtherMonths: !1,
                showWeek: !1,
                calculateWeek: this.iso8601Week,
                shortYearCutoff: "+10",
                minDate: null,
                maxDate: null,
                duration: "fast",
                beforeShowDay: null,
                beforeShow: null,
                onSelect: null,
                onChangeMonthYear: null,
                onClose: null,
                numberOfMonths: 1,
                showCurrentAtPos: 0,
                stepMonths: 1,
                stepBigMonths: 12,
                altField: "",
                altFormat: "",
                constrainInput: !0,
                showButtonPanel: !1,
                autoSize: !1,
                disabled: !1

            },
            t.extend(this._defaults, this.regional[""]),
            this.dpDiv = s(t("<div id='" + this._mainDivId + "' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))

        }
        function s(e) {
            var i = "button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";
            return e.delegate(i, "mouseout", 
            function() {
                t(this).removeClass("ui-state-hover"),
                -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).removeClass("ui-datepicker-prev-hover"),
                -1 !== this.className.indexOf("ui-datepicker-next") && t(this).removeClass("ui-datepicker-next-hover")

            }).delegate(i, "mouseover", 
            function() {
                t.datepicker._isDisabledDatepicker(a.inline ? e.parent()[0] : a.input[0]) || (t(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"), t(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && t(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && t(this).addClass("ui-datepicker-next-hover"))

            })

        }
        function n(e, i) {
            t.extend(e, i);
            for (var s in i) null == i[s] && (e[s] = i[s]);
            return e

        }
        t.extend(t.ui, {
            datepicker: {
                version: "1.10.4"

            }

        });
        var a,
        o = "datepicker";
        t.extend(i.prototype, {
            markerClassName: "hasDatepicker",
            maxRows: 4,
            _widgetDatepicker: function() {
                return this.dpDiv

            },
            setDefaults: function(t) {
                return n(this._defaults, t || {}),
                this

            },
            _attachDatepicker: function(e, i) {
                var s,
                n,
                a;
                s = e.nodeName.toLowerCase(),
                n = "div" === s || "span" === s,
                e.id || (this.uuid += 1, e.id = "dp" + this.uuid),
                a = this._newInst(t(e), n),
                a.settings = t.extend({},
                i || {}),
                "input" === s ? this._connectDatepicker(e, a) : n && this._inlineDatepicker(e, a)

            },
            _newInst: function(e, i) {
                var n = e[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1");
                return {
                    id: n,
                    input: e,
                    selectedDay: 0,
                    selectedMonth: 0,
                    selectedYear: 0,
                    drawMonth: 0,
                    drawYear: 0,
                    inline: i,
                    dpDiv: i ? s(t("<div class='" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")) : this.dpDiv

                }

            },
            _connectDatepicker: function(e, i) {
                var s = t(e);
                i.append = t([]),
                i.trigger = t([]),
                s.hasClass(this.markerClassName) || (this._attachments(s, i), s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(i), t.data(e, o, i), i.settings.disabled && this._disableDatepicker(e))

            },
            _attachments: function(e, i) {
                var s,
                n,
                a,
                o = this._get(i, "appendText"),
                r = this._get(i, "isRTL");
                i.append && i.append.remove(),
                o && (i.append = t("<span class='" + this._appendClass + "'>" + o + "</span>"), e[r ? "before": "after"](i.append)),
                e.unbind("focus", this._showDatepicker),
                i.trigger && i.trigger.remove(),
                s = this._get(i, "showOn"),
                ("focus" === s || "both" === s) && e.focus(this._showDatepicker),
                ("button" === s || "both" === s) && (n = this._get(i, "buttonText"), a = this._get(i, "buttonImage"), i.trigger = t(this._get(i, "buttonImageOnly") ? t("<img/>").addClass(this._triggerClass).attr({
                    src: a,
                    alt: n,
                    title: n

                }) : t("<button type='button'></button>").addClass(this._triggerClass).html(a ? t("<img/>").attr({
                    src: a,
                    alt: n,
                    title: n

                }) : n)), e[r ? "before": "after"](i.trigger), i.trigger.click(function() {
                    return t.datepicker._datepickerShowing && t.datepicker._lastInput === e[0] ? t.datepicker._hideDatepicker() : t.datepicker._datepickerShowing && t.datepicker._lastInput !== e[0] ? (t.datepicker._hideDatepicker(), t.datepicker._showDatepicker(e[0])) : t.datepicker._showDatepicker(e[0]),
                    !1

                }))

            },
            _autoSize: function(t) {
                if (this._get(t, "autoSize") && !t.inline) {
                    var e,
                    i,
                    s,
                    n,
                    a = new Date(2009, 11, 20),
                    o = this._get(t, "dateFormat");
                    o.match(/[DM]/) && (e = function(t) {
                        for (i = 0, s = 0, n = 0; t.length > n; n++) t[n].length > i && (i = t[n].length, s = n);
                        return s

                    },
                    a.setMonth(e(this._get(t, o.match(/MM/) ? "monthNames": "monthNamesShort"))), a.setDate(e(this._get(t, o.match(/DD/) ? "dayNames": "dayNamesShort")) + 20 - a.getDay())),
                    t.input.attr("size", this._formatDate(t, a).length)

                }

            },
            _inlineDatepicker: function(e, i) {
                var s = t(e);
                s.hasClass(this.markerClassName) || (s.addClass(this.markerClassName).append(i.dpDiv), t.data(e, o, i), this._setDate(i, this._getDefaultDate(i), !0), this._updateDatepicker(i), this._updateAlternate(i), i.settings.disabled && this._disableDatepicker(e), i.dpDiv.css("display", "block"))

            },
            _dialogDatepicker: function(e, i, s, a, r) {
                var l,
                c,
                h,
                u,
                d,
                p = this._dialogInst;
                return p || (this.uuid += 1, l = "dp" + this.uuid, this._dialogInput = t("<input type='text' id='" + l + "' style='position: absolute; top: -100px; width: 0px;'/>"), this._dialogInput.keydown(this._doKeyDown), t("body").append(this._dialogInput), p = this._dialogInst = this._newInst(this._dialogInput, !1), p.settings = {},
                t.data(this._dialogInput[0], o, p)),
                n(p.settings, a || {}),
                i = i && i.constructor === Date ? this._formatDate(p, i) : i,
                this._dialogInput.val(i),
                this._pos = r ? r.length ? r: [r.pageX, r.pageY] : null,
                this._pos || (c = document.documentElement.clientWidth, h = document.documentElement.clientHeight, u = document.documentElement.scrollLeft || document.body.scrollLeft, d = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [c / 2 - 100 + u, h / 2 - 150 + d]),
                this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"),
                p.settings.onSelect = s,
                this._inDialog = !0,
                this.dpDiv.addClass(this._dialogClass),
                this._showDatepicker(this._dialogInput[0]),
                t.blockUI && t.blockUI(this.dpDiv),
                t.data(this._dialogInput[0], o, p),
                this

            },
            _destroyDatepicker: function(e) {
                var i,
                s = t(e),
                n = t.data(e, o);
                s.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), t.removeData(e, o), "input" === i ? (n.append.remove(), n.trigger.remove(), s.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup", this._doKeyUp)) : ("div" === i || "span" === i) && s.removeClass(this.markerClassName).empty())

            },
            _enableDatepicker: function(e) {
                var i,
                s,
                n = t(e),
                a = t.data(e, o);
                n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !1, a.trigger.filter("button").each(function() {
                    this.disabled = !1

                }).end().filter("img").css({
                    opacity: "1.0",
                    cursor: ""

                })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().removeClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !1)), this._disabledInputs = t.map(this._disabledInputs, 
                function(t) {
                    return t === e ? null: t

                }))

            },
            _disableDatepicker: function(e) {
                var i,
                s,
                n = t(e),
                a = t.data(e, o);
                n.hasClass(this.markerClassName) && (i = e.nodeName.toLowerCase(), "input" === i ? (e.disabled = !0, a.trigger.filter("button").each(function() {
                    this.disabled = !0

                }).end().filter("img").css({
                    opacity: "0.5",
                    cursor: "default"

                })) : ("div" === i || "span" === i) && (s = n.children("." + this._inlineClass), s.children().addClass("ui-state-disabled"), s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled", !0)), this._disabledInputs = t.map(this._disabledInputs, 
                function(t) {
                    return t === e ? null: t

                }), this._disabledInputs[this._disabledInputs.length] = e)

            },
            _isDisabledDatepicker: function(t) {
                if (!t) return ! 1;
                for (var e = 0; this._disabledInputs.length > e; e++) if (this._disabledInputs[e] === t) return ! 0;
                return ! 1

            },
            _getInst: function(e) {
                try {
                    return t.data(e, o)

                } catch(i) {
                    throw "Missing instance data for this datepicker"

                }

            },
            _optionDatepicker: function(i, s, a) {
                var o,
                r,
                l,
                c,
                h = this._getInst(i);
                return 2 === arguments.length && "string" == typeof s ? "defaults" === s ? t.extend({},
                t.datepicker._defaults) : h ? "all" === s ? t.extend({},
                h.settings) : this._get(h, s) : null: (o = s || {},
                "string" == typeof s && (o = {},
                o[s] = a), h && (this._curInst === h && this._hideDatepicker(), r = this._getDateDatepicker(i, !0), l = this._getMinMaxDate(h, "min"), c = this._getMinMaxDate(h, "max"), n(h.settings, o), null !== l && o.dateFormat !== e && o.minDate === e && (h.settings.minDate = this._formatDate(h, l)), null !== c && o.dateFormat !== e && o.maxDate === e && (h.settings.maxDate = this._formatDate(h, c)), "disabled" in o && (o.disabled ? this._disableDatepicker(i) : this._enableDatepicker(i)), this._attachments(t(i), h), this._autoSize(h), this._setDate(h, r), this._updateAlternate(h), this._updateDatepicker(h)), e)

            },
            _changeDatepicker: function(t, e, i) {
                this._optionDatepicker(t, e, i)

            },
            _refreshDatepicker: function(t) {
                var e = this._getInst(t);
                e && this._updateDatepicker(e)

            },
            _setDateDatepicker: function(t, e) {
                var i = this._getInst(t);
                i && (this._setDate(i, e), this._updateDatepicker(i), this._updateAlternate(i))

            },
            _getDateDatepicker: function(t, e) {
                var i = this._getInst(t);
                return i && !i.inline && this._setDateFromField(i, e),
                i ? this._getDate(i) : null

            },
            _doKeyDown: function(e) {
                var i,
                s,
                n,
                a = t.datepicker._getInst(e.target),
                o = !0,
                r = a.dpDiv.is(".ui-datepicker-rtl");
                if (a._keyEvent = !0, t.datepicker._datepickerShowing) switch (e.keyCode) {
                    case 9:
                    t.datepicker._hideDatepicker(),
                    o = !1;
                    break;
                    case 13:
                    return n = t("td." + t.datepicker._dayOverClass + ":not(." + t.datepicker._currentClass + ")", a.dpDiv),
                    n[0] && t.datepicker._selectDay(e.target, a.selectedMonth, a.selectedYear, n[0]),
                    i = t.datepicker._get(a, "onSelect"),
                    i ? (s = t.datepicker._formatDate(a), i.apply(a.input ? a.input[0] : null, [s, a])) : t.datepicker._hideDatepicker(),
                    !1;
                    case 27:
                    t.datepicker._hideDatepicker();
                    break;
                    case 33:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(a, "stepBigMonths") : -t.datepicker._get(a, "stepMonths"), "M");
                    break;
                    case 34:
                    t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(a, "stepBigMonths") : +t.datepicker._get(a, "stepMonths"), "M");
                    break;
                    case 35:
                    (e.ctrlKey || e.metaKey) && t.datepicker._clearDate(e.target),
                    o = e.ctrlKey || e.metaKey;
                    break;
                    case 36:
                    (e.ctrlKey || e.metaKey) && t.datepicker._gotoToday(e.target),
                    o = e.ctrlKey || e.metaKey;
                    break;
                    case 37:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? 1: -1, "D"),
                    o = e.ctrlKey || e.metaKey,
                    e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? -t.datepicker._get(a, "stepBigMonths") : -t.datepicker._get(a, "stepMonths"), "M");
                    break;
                    case 38:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, -7, "D"),
                    o = e.ctrlKey || e.metaKey;
                    break;
                    case 39:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, r ? -1: 1, "D"),
                    o = e.ctrlKey || e.metaKey,
                    e.originalEvent.altKey && t.datepicker._adjustDate(e.target, e.ctrlKey ? +t.datepicker._get(a, "stepBigMonths") : +t.datepicker._get(a, "stepMonths"), "M");
                    break;
                    case 40:
                    (e.ctrlKey || e.metaKey) && t.datepicker._adjustDate(e.target, 7, "D"),
                    o = e.ctrlKey || e.metaKey;
                    break;
                    default:
                    o = !1

                } else 36 === e.keyCode && e.ctrlKey ? t.datepicker._showDatepicker(this) : o = !1;
                o && (e.preventDefault(), e.stopPropagation())

            },
            _doKeyPress: function(i) {
                var s,
                n,
                a = t.datepicker._getInst(i.target);
                return t.datepicker._get(a, "constrainInput") ? (s = t.datepicker._possibleChars(t.datepicker._get(a, "dateFormat")), n = String.fromCharCode(null == i.charCode ? i.keyCode: i.charCode), i.ctrlKey || i.metaKey || " " > n || !s || s.indexOf(n) > -1) : e

            },
            _doKeyUp: function(e) {
                var i,
                s = t.datepicker._getInst(e.target);
                if (s.input.val() !== s.lastVal) try {
                    i = t.datepicker.parseDate(t.datepicker._get(s, "dateFormat"), s.input ? s.input.val() : null, t.datepicker._getFormatConfig(s)),
                    i && (t.datepicker._setDateFromField(s), t.datepicker._updateAlternate(s), t.datepicker._updateDatepicker(s))

                } catch(n) {}
                return ! 0

            },
            _showDatepicker: function(e) {
                if (e = e.target || e, "input" !== e.nodeName.toLowerCase() && (e = t("input", e.parentNode)[0]), !t.datepicker._isDisabledDatepicker(e) && t.datepicker._lastInput !== e) {
                    var i,
                    s,
                    a,
                    o,
                    r,
                    l,
                    c;
                    i = t.datepicker._getInst(e),
                    t.datepicker._curInst && t.datepicker._curInst !== i && (t.datepicker._curInst.dpDiv.stop(!0, !0), i && t.datepicker._datepickerShowing && t.datepicker._hideDatepicker(t.datepicker._curInst.input[0])),
                    s = t.datepicker._get(i, "beforeShow"),
                    a = s ? s.apply(e, [e, i]) : {},
                    a !== !1 && (n(i.settings, a), i.lastVal = null, t.datepicker._lastInput = e, t.datepicker._setDateFromField(i), t.datepicker._inDialog && (e.value = ""), t.datepicker._pos || (t.datepicker._pos = t.datepicker._findPos(e), t.datepicker._pos[1] += e.offsetHeight), o = !1, t(e).parents().each(function() {
                        return o |= "fixed" === t(this).css("position"),
                        !o

                    }), r = {
                        left: t.datepicker._pos[0],
                        top: t.datepicker._pos[1]

                    },
                    t.datepicker._pos = null, i.dpDiv.empty(), i.dpDiv.css({
                        position: "absolute",
                        display: "block",
                        top: "-1000px"

                    }), t.datepicker._updateDatepicker(i), r = t.datepicker._checkOffset(i, r, o), i.dpDiv.css({
                        position: t.datepicker._inDialog && t.blockUI ? "static": o ? "fixed": "absolute",
                        display: "none",
                        left: r.left + "px",
                        top: r.top + "px"

                    }), i.inline || (l = t.datepicker._get(i, "showAnim"), c = t.datepicker._get(i, "duration"), i.dpDiv.zIndex(t(e).zIndex() + 1), t.datepicker._datepickerShowing = !0, t.effects && t.effects.effect[l] ? i.dpDiv.show(l, t.datepicker._get(i, "showOptions"), c) : i.dpDiv[l || "show"](l ? c: null), t.datepicker._shouldFocusInput(i) && i.input.focus(), t.datepicker._curInst = i))

                }

            },
            _updateDatepicker: function(e) {
                this.maxRows = 4,
                a = e,
                e.dpDiv.empty().append(this._generateHTML(e)),
                this._attachHandlers(e),
                e.dpDiv.find("." + this._dayOverClass + " a").mouseover();
                var i,
                s = this._getNumberOfMonths(e),
                n = s[1],
                o = 17;
                e.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),
                n > 1 && e.dpDiv.addClass("ui-datepicker-multi-" + n).css("width", o * n + "em"),
                e.dpDiv[(1 !== s[0] || 1 !== s[1] ? "add": "remove") + "Class"]("ui-datepicker-multi"),
                e.dpDiv[(this._get(e, "isRTL") ? "add": "remove") + "Class"]("ui-datepicker-rtl"),
                e === t.datepicker._curInst && t.datepicker._datepickerShowing && t.datepicker._shouldFocusInput(e) && e.input.focus(),
                e.yearshtml && (i = e.yearshtml, setTimeout(function() {
                    i === e.yearshtml && e.yearshtml && e.dpDiv.find("select.ui-datepicker-year:first").replaceWith(e.yearshtml),
                    i = e.yearshtml = null

                },
                0))

            },
            _shouldFocusInput: function(t) {
                return t.input && t.input.is(":visible") && !t.input.is(":disabled") && !t.input.is(":focus")

            },
            _checkOffset: function(e, i, s) {
                var n = e.dpDiv.outerWidth(),
                a = e.dpDiv.outerHeight(),
                o = e.input ? e.input.outerWidth() : 0,
                r = e.input ? e.input.outerHeight() : 0,
                l = document.documentElement.clientWidth + (s ? 0: t(document).scrollLeft()),
                c = document.documentElement.clientHeight + (s ? 0: t(document).scrollTop());
                return i.left -= this._get(e, "isRTL") ? n - o: 0,
                i.left -= s && i.left === e.input.offset().left ? t(document).scrollLeft() : 0,
                i.top -= s && i.top === e.input.offset().top + r ? t(document).scrollTop() : 0,
                i.left -= Math.min(i.left, i.left + n > l && l > n ? Math.abs(i.left + n - l) : 0),
                i.top -= Math.min(i.top, i.top + a > c && c > a ? Math.abs(a + r) : 0),
                i

            },
            _findPos: function(e) {
                for (var i, s = this._getInst(e), n = this._get(s, "isRTL"); e && ("hidden" === e.type || 1 !== e.nodeType || t.expr.filters.hidden(e));) e = e[n ? "previousSibling": "nextSibling"];
                return i = t(e).offset(),
                [i.left, i.top]

            },
            _hideDatepicker: function(e) {
                var i,
                s,
                n,
                a,
                r = this._curInst;
                ! r || e && r !== t.data(e, o) || this._datepickerShowing && (i = this._get(r, "showAnim"), s = this._get(r, "duration"), n = function() {
                    t.datepicker._tidyDialog(r)

                },
                t.effects && (t.effects.effect[i] || t.effects[i]) ? r.dpDiv.hide(i, t.datepicker._get(r, "showOptions"), s, n) : r.dpDiv["slideDown" === i ? "slideUp": "fadeIn" === i ? "fadeOut": "hide"](i ? s: null, n), i || n(), this._datepickerShowing = !1, a = this._get(r, "onClose"), a && a.apply(r.input ? r.input[0] : null, [r.input ? r.input.val() : "", r]), this._lastInput = null, this._inDialog && (this._dialogInput.css({
                    position: "absolute",
                    left: "0",
                    top: "-100px"

                }), t.blockUI && (t.unblockUI(), t("body").append(this.dpDiv))), this._inDialog = !1)

            },
            _tidyDialog: function(t) {
                t.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")

            },
            _checkExternalClick: function(e) {
                if (t.datepicker._curInst) {
                    var i = t(e.target),
                    s = t.datepicker._getInst(i[0]);
                    (i[0].id !== t.datepicker._mainDivId && 0 === i.parents("#" + t.datepicker._mainDivId).length && !i.hasClass(t.datepicker.markerClassName) && !i.closest("." + t.datepicker._triggerClass).length && t.datepicker._datepickerShowing && (!t.datepicker._inDialog || !t.blockUI) || i.hasClass(t.datepicker.markerClassName) && t.datepicker._curInst !== s) && t.datepicker._hideDatepicker();

                }

            },
            _adjustDate: function(e, i, s) {
                var n = t(e),
                a = this._getInst(n[0]);
                this._isDisabledDatepicker(n[0]) || (this._adjustInstDate(a, i + ("M" === s ? this._get(a, "showCurrentAtPos") : 0), s), this._updateDatepicker(a))

            },
            _gotoToday: function(e) {
                var i,
                s = t(e),
                n = this._getInst(s[0]);
                this._get(n, "gotoCurrent") && n.currentDay ? (n.selectedDay = n.currentDay, n.drawMonth = n.selectedMonth = n.currentMonth, n.drawYear = n.selectedYear = n.currentYear) : (i = new Date, n.selectedDay = i.getDate(), n.drawMonth = n.selectedMonth = i.getMonth(), n.drawYear = n.selectedYear = i.getFullYear()),
                this._notifyChange(n),
                this._adjustDate(s)

            },
            _selectMonthYear: function(e, i, s) {
                var n = t(e),
                a = this._getInst(n[0]);
                a["selected" + ("M" === s ? "Month": "Year")] = a["draw" + ("M" === s ? "Month": "Year")] = parseInt(i.options[i.selectedIndex].value, 10),
                this._notifyChange(a),
                this._adjustDate(n)

            },
            _selectDay: function(e, i, s, n) {
                var a,
                o = t(e);
                t(n).hasClass(this._unselectableClass) || this._isDisabledDatepicker(o[0]) || (a = this._getInst(o[0]), a.selectedDay = a.currentDay = t("a", n).html(), a.selectedMonth = a.currentMonth = i, a.selectedYear = a.currentYear = s, this._selectDate(e, this._formatDate(a, a.currentDay, a.currentMonth, a.currentYear)))

            },
            _clearDate: function(e) {
                var i = t(e);
                this._selectDate(i, "")

            },
            _selectDate: function(e, i) {
                var s,
                n = t(e),
                a = this._getInst(n[0]);
                i = null != i ? i: this._formatDate(a),
                a.input && a.input.val(i),
                this._updateAlternate(a),
                s = this._get(a, "onSelect"),
                s ? s.apply(a.input ? a.input[0] : null, [i, a]) : a.input && a.input.trigger("change"),
                a.inline ? this._updateDatepicker(a) : (this._hideDatepicker(), this._lastInput = a.input[0], "object" != typeof a.input[0] && a.input.focus(), this._lastInput = null)

            },
            _updateAlternate: function(e) {
                var i,
                s,
                n,
                a = this._get(e, "altField");
                a && (i = this._get(e, "altFormat") || this._get(e, "dateFormat"), s = this._getDate(e), n = this.formatDate(i, s, this._getFormatConfig(e)), t(a).each(function() {
                    t(this).val(n)

                }))

            },
            noWeekends: function(t) {
                var e = t.getDay();
                return [e > 0 && 6 > e, ""]

            },
            iso8601Week: function(t) {
                var e,
                i = new Date(t.getTime());
                return i.setDate(i.getDate() + 4 - (i.getDay() || 7)),
                e = i.getTime(),
                i.setMonth(0),
                i.setDate(1),
                Math.floor(Math.round((e - i) / 864e5) / 7) + 1

            },
            parseDate: function(i, s, n) {
                if (null == i || null == s) throw "Invalid arguments";
                if (s = "object" == typeof s ? "" + s: s + "", "" === s) return null;
                var a,
                o,
                r,
                l,
                c = 0,
                h = (n ? n.shortYearCutoff: null) || this._defaults.shortYearCutoff,
                u = "string" != typeof h ? h: (new Date).getFullYear() % 100 + parseInt(h, 10),
                d = (n ? n.dayNamesShort: null) || this._defaults.dayNamesShort,
                p = (n ? n.dayNames: null) || this._defaults.dayNames,
                f = (n ? n.monthNamesShort: null) || this._defaults.monthNamesShort,
                g = (n ? n.monthNames: null) || this._defaults.monthNames,
                m = -1,
                _ = -1,
                b = -1,
                v = -1,
                y = !1,
                w = function(t) {
                    var e = i.length > a + 1 && i.charAt(a + 1) === t;
                    return e && a++,
                    e

                },
                k = function(t) {
                    var e = w(t),
                    i = "@" === t ? 14: "!" === t ? 20: "y" === t && e ? 4: "o" === t ? 3: 2,
                    n = RegExp("^\\d{1," + i + "}"),
                    a = s.substring(c).match(n);
                    if (!a) throw "Missing number at position " + c;
                    return c += a[0].length,
                    parseInt(a[0], 10)

                },
                x = function(i, n, a) {
                    var o = -1,
                    r = t.map(w(i) ? a: n, 
                    function(t, e) {
                        return [[e, t]]

                    }).sort(function(t, e) {
                        return - (t[1].length - e[1].length)

                    });
                    if (t.each(r, 
                    function(t, i) {
                        var n = i[1];
                        return s.substr(c, n.length).toLowerCase() === n.toLowerCase() ? (o = i[0], c += n.length, !1) : e

                    }), -1 !== o) return o + 1;
                    throw "Unknown name at position " + c

                },
                D = function() {
                    if (s.charAt(c) !== i.charAt(a)) throw "Unexpected literal at position " + c;
                    c++

                };
                for (a = 0; i.length > a; a++) if (y)"'" !== i.charAt(a) || w("'") ? D() : y = !1;
                else switch (i.charAt(a)) {
                    case "d":
                    b = k("d");
                    break;
                    case "D":
                    x("D", d, p);
                    break;
                    case "o":
                    v = k("o");
                    break;
                    case "m":
                    _ = k("m");
                    break;
                    case "M":
                    _ = x("M", f, g);
                    break;
                    case "y":
                    m = k("y");
                    break;
                    case "@":
                    l = new Date(k("@")),
                    m = l.getFullYear(),
                    _ = l.getMonth() + 1,
                    b = l.getDate();
                    break;
                    case "!":
                    l = new Date((k("!") - this._ticksTo1970) / 1e4),
                    m = l.getFullYear(),
                    _ = l.getMonth() + 1,
                    b = l.getDate();
                    break;
                    case "'":
                    w("'") ? D() : y = !0;
                    break;
                    default:
                    D()

                }
                if (s.length > c && (r = s.substr(c), !/^\s+/.test(r))) throw "Extra/unparsed characters found in date: " + r;
                if ( - 1 === m ? m = (new Date).getFullYear() : 100 > m && (m += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (u >= m ? 0: -100)), v > -1) for (_ = 1, b = v; o = this._getDaysInMonth(m, _ - 1), !(o >= b);) _++,
                b -= o;
                if (l = this._daylightSavingAdjust(new Date(m, _ - 1, b)), l.getFullYear() !== m || l.getMonth() + 1 !== _ || l.getDate() !== b) throw "Invalid date";
                return l

            },
            ATOM: "yy-mm-dd",
            COOKIE: "D, dd M yy",
            ISO_8601: "yy-mm-dd",
            RFC_822: "D, d M y",
            RFC_850: "DD, dd-M-y",
            RFC_1036: "D, d M y",
            RFC_1123: "D, d M yy",
            RFC_2822: "D, d M yy",
            RSS: "D, d M y",
            TICKS: "!",
            TIMESTAMP: "@",
            W3C: "yy-mm-dd",
            _ticksTo1970: 864e9 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)),
            formatDate: function(t, e, i) {
                if (!e) return "";
                var s,
                n = (i ? i.dayNamesShort: null) || this._defaults.dayNamesShort,
                a = (i ? i.dayNames: null) || this._defaults.dayNames,
                o = (i ? i.monthNamesShort: null) || this._defaults.monthNamesShort,
                r = (i ? i.monthNames: null) || this._defaults.monthNames,
                l = function(e) {
                    var i = t.length > s + 1 && t.charAt(s + 1) === e;
                    return i && s++,
                    i

                },
                c = function(t, e, i) {
                    var s = "" + e;
                    if (l(t)) for (; i > s.length;) s = "0" + s;
                    return s

                },
                h = function(t, e, i, s) {
                    return l(t) ? s[e] : i[e]

                },
                u = "",
                d = !1;
                if (e) for (s = 0; t.length > s; s++) if (d)"'" !== t.charAt(s) || l("'") ? u += t.charAt(s) : d = !1;
                else switch (t.charAt(s)) {
                    case "d":
                    u += c("d", e.getDate(), 2);
                    break;
                    case "D":
                    u += h("D", e.getDay(), n, a);
                    break;
                    case "o":
                    u += c("o", Math.round((new Date(e.getFullYear(), e.getMonth(), e.getDate()).getTime() - new Date(e.getFullYear(), 0, 0).getTime()) / 864e5), 3);
                    break;
                    case "m":
                    u += c("m", e.getMonth() + 1, 2);
                    break;
                    case "M":
                    u += h("M", e.getMonth(), o, r);
                    break;
                    case "y":
                    u += l("y") ? e.getFullYear() : (10 > e.getYear() % 100 ? "0": "") + e.getYear() % 100;
                    break;
                    case "@":
                    u += e.getTime();
                    break;
                    case "!":
                    u += 1e4 * e.getTime() + this._ticksTo1970;
                    break;
                    case "'":
                    l("'") ? u += "'": d = !0;
                    break;
                    default:
                    u += t.charAt(s)

                }
                return u

            },
            _possibleChars: function(t) {
                var e,
                i = "",
                s = !1,
                n = function(i) {
                    var s = t.length > e + 1 && t.charAt(e + 1) === i;
                    return s && e++,
                    s

                };
                for (e = 0; t.length > e; e++) if (s)"'" !== t.charAt(e) || n("'") ? i += t.charAt(e) : s = !1;
                else switch (t.charAt(e)) {
                    case "d":
                case "m":
                case "y":
                case "@":
                    i += "0123456789";
                    break;
                    case "D":
                case "M":
                    return null;
                    case "'":
                    n("'") ? i += "'": s = !0;
                    break;
                    default:
                    i += t.charAt(e)

                }
                return i

            },
            _get: function(t, i) {
                return t.settings[i] !== e ? t.settings[i] : this._defaults[i]

            },
            _setDateFromField: function(t, e) {
                if (t.input.val() !== t.lastVal) {
                    var i = this._get(t, "dateFormat"),
                    s = t.lastVal = t.input ? t.input.val() : null,
                    n = this._getDefaultDate(t),
                    a = n,
                    o = this._getFormatConfig(t);
                    try {
                        a = this.parseDate(i, s, o) || n

                    } catch(r) {
                        s = e ? "": s

                    }
                    t.selectedDay = a.getDate(),
                    t.drawMonth = t.selectedMonth = a.getMonth(),
                    t.drawYear = t.selectedYear = a.getFullYear(),
                    t.currentDay = s ? a.getDate() : 0,
                    t.currentMonth = s ? a.getMonth() : 0,
                    t.currentYear = s ? a.getFullYear() : 0,
                    this._adjustInstDate(t)

                }

            },
            _getDefaultDate: function(t) {
                return this._restrictMinMax(t, this._determineDate(t, this._get(t, "defaultDate"), new Date))

            },
            _determineDate: function(e, i, s) {
                var n = function(t) {
                    var e = new Date;
                    return e.setDate(e.getDate() + t),
                    e

                },
                a = function r(i) {
                    try {
                        return t.datepicker.parseDate(t.datepicker._get(e, "dateFormat"), i, t.datepicker._getFormatConfig(e))

                    } catch(s) {}
                    for (var n = (i.toLowerCase().match(/^c/) ? t.datepicker._getDate(e) : null) || new Date, r = n.getFullYear(), a = n.getMonth(), o = n.getDate(), l = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, c = l.exec(i); c;) {
                        switch (c[2] || "d") {
                            case "d":
                        case "D":
                            o += parseInt(c[1], 10);
                            break;
                            case "w":
                        case "W":
                            o += 7 * parseInt(c[1], 10);
                            break;
                            case "m":
                        case "M":
                            a += parseInt(c[1], 10),
                            o = Math.min(o, t.datepicker._getDaysInMonth(r, a));
                            break;
                            case "y":
                        case "Y":
                            r += parseInt(c[1], 10),
                            o = Math.min(o, t.datepicker._getDaysInMonth(r, a))

                        }
                        c = l.exec(i)

                    }
                    return new Date(r, a, o)

                },
                o = null == i || "" === i ? s: "string" == typeof i ? a(i) : "number" == typeof i ? isNaN(i) ? s: n(i) : new Date(i.getTime());
                return o = o && "Invalid Date" == "" + o ? s: o,
                o && (o.setHours(0), o.setMinutes(0), o.setSeconds(0), o.setMilliseconds(0)),
                this._daylightSavingAdjust(o)

            },
            _daylightSavingAdjust: function(t) {
                return t ? (t.setHours(t.getHours() > 12 ? t.getHours() + 2: 0), t) : null

            },
            _setDate: function(t, e, i) {
                var s = !e,
                n = t.selectedMonth,
                a = t.selectedYear,
                o = this._restrictMinMax(t, this._determineDate(t, e, new Date));
                t.selectedDay = t.currentDay = o.getDate(),
                t.drawMonth = t.selectedMonth = t.currentMonth = o.getMonth(),
                t.drawYear = t.selectedYear = t.currentYear = o.getFullYear(),
                n === t.selectedMonth && a === t.selectedYear || i || this._notifyChange(t),
                this._adjustInstDate(t),
                t.input && t.input.val(s ? "": this._formatDate(t))

            },
            _getDate: function(t) {
                var e = !t.currentYear || t.input && "" === t.input.val() ? null: this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
                return e

            },
            _attachHandlers: function(e) {
                var i = this._get(e, "stepMonths"),
                s = "#" + e.id.replace(/\\\\/g, "\\");
                e.dpDiv.find("[data-handler]").map(function() {
                    var e = {
                        prev: function() {
                            t.datepicker._adjustDate(s, -i, "M")

                        },
                        next: function() {
                            t.datepicker._adjustDate(s, +i, "M")

                        },
                        hide: function() {
                            t.datepicker._hideDatepicker()

                        },
                        today: function() {
                            t.datepicker._gotoToday(s)

                        },
                        selectDay: function() {
                            return t.datepicker._selectDay(s, +this.getAttribute("data-month"), +this.getAttribute("data-year"), this),
                            !1

                        },
                        selectMonth: function() {
                            return t.datepicker._selectMonthYear(s, this, "M"),
                            !1

                        },
                        selectYear: function() {
                            return t.datepicker._selectMonthYear(s, this, "Y"),
                            !1

                        }

                    };
                    t(this).bind(this.getAttribute("data-event"), e[this.getAttribute("data-handler")])

                })

            },
            _generateHTML: function(t) {
                var e,
                i,
                s,
                n,
                a,
                o,
                r,
                l,
                c,
                h,
                u,
                d,
                p,
                f,
                g,
                m,
                _,
                b,
                v,
                y,
                w,
                k,
                x,
                D,
                C,
                $,
                I,
                P,
                T,
                M,
                z,
                j,
                S,
                A,
                F,
                H,
                E,
                N,
                O,
                W = new Date,
                R = this._daylightSavingAdjust(new Date(W.getFullYear(), W.getMonth(), W.getDate())),
                L = this._get(t, "isRTL"),
                Y = this._get(t, "showButtonPanel"),
                U = this._get(t, "hideIfNoPrevNext"),
                B = this._get(t, "navigationAsDateFormat"),
                J = this._getNumberOfMonths(t),
                q = this._get(t, "showCurrentAtPos"),
                Z = this._get(t, "stepMonths"),
                K = 1 !== J[0] || 1 !== J[1],
                V = this._daylightSavingAdjust(t.currentDay ? new Date(t.currentYear, t.currentMonth, t.currentDay) : new Date(9999, 9, 9)),
                G = this._getMinMaxDate(t, "min"),
                Q = this._getMinMaxDate(t, "max"),
                X = t.drawMonth - q,
                tt = t.drawYear;
                if (0 > X && (X += 12, tt--), Q) for (e = this._daylightSavingAdjust(new Date(Q.getFullYear(), Q.getMonth() - J[0] * J[1] + 1, Q.getDate())), e = G && G > e ? G: e; this._daylightSavingAdjust(new Date(tt, X, 1)) > e;) X--,
                0 > X && (X = 11, tt--);
                for (t.drawMonth = X, t.drawYear = tt, i = this._get(t, "prevText"), i = B ? this.formatDate(i, this._daylightSavingAdjust(new Date(tt, X - Z, 1)), this._getFormatConfig(t)) : i, s = this._canAdjustMonth(t, -1, tt, X) ? "<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (L ? "e": "w") + "'>" + i + "</span></a>": U ? "": "<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='" + i + "'><span class='ui-icon ui-icon-circle-triangle-" + (L ? "e": "w") + "'>" + i + "</span></a>", n = this._get(t, "nextText"), n = B ? this.formatDate(n, this._daylightSavingAdjust(new Date(tt, X + Z, 1)), this._getFormatConfig(t)) : n, a = this._canAdjustMonth(t, 1, tt, X) ? "<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (L ? "w": "e") + "'>" + n + "</span></a>": U ? "": "<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='" + n + "'><span class='ui-icon ui-icon-circle-triangle-" + (L ? "w": "e") + "'>" + n + "</span></a>", o = this._get(t, "currentText"), r = this._get(t, "gotoCurrent") && t.currentDay ? V: R, o = B ? this.formatDate(o, r, this._getFormatConfig(t)) : o, l = t.inline ? "": "<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>" + this._get(t, "closeText") + "</button>", c = Y ? "<div class='ui-datepicker-buttonpane ui-widget-content'>" + (L ? l: "") + (this._isInRange(t, r) ? "<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>" + o + "</button>": "") + (L ? "": l) + "</div>": "", h = parseInt(this._get(t, "firstDay"), 10), h = isNaN(h) ? 0: h, u = this._get(t, "showWeek"), d = this._get(t, "dayNames"), p = this._get(t, "dayNamesMin"), f = this._get(t, "monthNames"), g = this._get(t, "monthNamesShort"), m = this._get(t, "beforeShowDay"), _ = this._get(t, "showOtherMonths"), b = this._get(t, "selectOtherMonths"), v = this._getDefaultDate(t), y = "", k = 0; J[0] > k; k++) {
                    for (x = "", this.maxRows = 4, D = 0; J[1] > D; D++) {
                        if (C = this._daylightSavingAdjust(new Date(tt, X, t.selectedDay)), $ = " ui-corner-all", I = "", K) {
                            if (I += "<div class='ui-datepicker-group", J[1] > 1) switch (D) {
                                case 0:
                                I += " ui-datepicker-group-first",
                                $ = " ui-corner-" + (L ? "right": "left");
                                break;
                                case J[1] - 1: 
                                I += " ui-datepicker-group-last",
                                $ = " ui-corner-" + (L ? "left": "right");
                                break;
                                default:
                                I += " ui-datepicker-group-middle",
                                $ = ""

                            }
                            I += "'>"

                        }
                        for (I += "<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix" + $ + "'>" + (/all|left/.test($) && 0 === k ? L ? a: s: "") + (/all|right/.test($) && 0 === k ? L ? s: a: "") + this._generateMonthYearHeader(t, X, tt, G, Q, k > 0 || D > 0, f, g) + "</div><table class='ui-datepicker-calendar'><thead><tr>", P = u ? "<th class='ui-datepicker-week-col'>" + this._get(t, "weekHeader") + "</th>": "", w = 0; 7 > w; w++) T = (w + h) % 7,
                        P += "<th" + ((w + h + 6) % 7 >= 5 ? " class='ui-datepicker-week-end'": "") + "><span title='" + d[T] + "'>" + p[T] + "</span></th>";
                        for (I += P + "</tr></thead><tbody>", M = this._getDaysInMonth(tt, X), tt === t.selectedYear && X === t.selectedMonth && (t.selectedDay = Math.min(t.selectedDay, M)), z = (this._getFirstDayOfMonth(tt, X) - h + 7) % 7, j = Math.ceil((z + M) / 7), S = K && this.maxRows > j ? this.maxRows: j, this.maxRows = S, A = this._daylightSavingAdjust(new Date(tt, X, 1 - z)), F = 0; S > F; F++) {
                            for (I += "<tr>", H = u ? "<td class='ui-datepicker-week-col'>" + this._get(t, "calculateWeek")(A) + "</td>": "", w = 0; 7 > w; w++) E = m ? m.apply(t.input ? t.input[0] : null, [A]) : [!0, ""],
                            N = A.getMonth() !== X,
                            O = N && !b || !E[0] || G && G > A || Q && A > Q,
                            H += "<td class='" + ((w + h + 6) % 7 >= 5 ? " ui-datepicker-week-end": "") + (N ? " ui-datepicker-other-month": "") + (A.getTime() === C.getTime() && X === t.selectedMonth && t._keyEvent || v.getTime() === A.getTime() && v.getTime() === C.getTime() ? " " + this._dayOverClass: "") + (O ? " " + this._unselectableClass + " ui-state-disabled": "") + (N && !_ ? "": " " + E[1] + (A.getTime() === V.getTime() ? " " + this._currentClass: "") + (A.getTime() === R.getTime() ? " ui-datepicker-today": "")) + "'" + (N && !_ || !E[2] ? "": " title='" + E[2].replace(/'/g, "&#39;") + "'") + (O ? "": " data-handler='selectDay' data-event='click' data-month='" + A.getMonth() + "' data-year='" + A.getFullYear() + "'") + ">" + (N && !_ ? "&#xa0;": O ? "<span class='ui-state-default'>" + A.getDate() + "</span>": "<a class='ui-state-default" + (A.getTime() === R.getTime() ? " ui-state-highlight": "") + (A.getTime() === V.getTime() ? " ui-state-active": "") + (N ? " ui-priority-secondary": "") + "' href='#'>" + A.getDate() + "</a>") + "</td>",
                            A.setDate(A.getDate() + 1),
                            A = this._daylightSavingAdjust(A);
                            I += H + "</tr>"

                        }
                        X++,
                        X > 11 && (X = 0, tt++),
                        I += "</tbody></table>" + (K ? "</div>" + (J[0] > 0 && D === J[1] - 1 ? "<div class='ui-datepicker-row-break'></div>": "") : ""),
                        x += I

                    }
                    y += x

                }
                return y += c,
                t._keyEvent = !1,
                y

            },
            _generateMonthYearHeader: function(t, e, i, s, n, a, o, r) {
                var l,
                c,
                h,
                u,
                d,
                p,
                f,
                g,
                m = this._get(t, "changeMonth"),
                _ = this._get(t, "changeYear"),
                b = this._get(t, "showMonthAfterYear"),
                v = "<div class='ui-datepicker-title'>",
                y = "";
                if (a || !m) y += "<span class='ui-datepicker-month'>" + o[e] + "</span>";
                else {
                    for (l = s && s.getFullYear() === i, c = n && n.getFullYear() === i, y += "<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>", h = 0; 12 > h; h++)(!l || h >= s.getMonth()) && (!c || n.getMonth() >= h) && (y += "<option value='" + h + "'" + (h === e ? " selected='selected'": "") + ">" + r[h] + "</option>");
                    y += "</select>"

                }
                if (b || (v += y + (!a && m && _ ? "": "&#xa0;")), !t.yearshtml) if (t.yearshtml = "", a || !_) v += "<span class='ui-datepicker-year'>" + i + "</span>";
                else {
                    for (u = this._get(t, "yearRange").split(":"), d = (new Date).getFullYear(), p = function(t) {
                        var e = t.match(/c[+\-].*/) ? i + parseInt(t.substring(1), 10) : t.match(/[+\-].*/) ? d + parseInt(t, 10) : parseInt(t, 10);
                        return isNaN(e) ? d: e

                    },
                    f = p(u[0]), g = Math.max(f, p(u[1] || "")), f = s ? Math.max(f, s.getFullYear()) : f, g = n ? Math.min(g, n.getFullYear()) : g, t.yearshtml += "<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>"; g >= f; f++) t.yearshtml += "<option value='" + f + "'" + (f === i ? " selected='selected'": "") + ">" + f + "</option>";
                    t.yearshtml += "</select>",
                    v += t.yearshtml,
                    t.yearshtml = null

                }
                return v += this._get(t, "yearSuffix"),
                b && (v += (!a && m && _ ? "": "&#xa0;") + y),
                v += "</div>"

            },
            _adjustInstDate: function(t, e, i) {
                var s = t.drawYear + ("Y" === i ? e: 0),
                n = t.drawMonth + ("M" === i ? e: 0),
                a = Math.min(t.selectedDay, this._getDaysInMonth(s, n)) + ("D" === i ? e: 0),
                o = this._restrictMinMax(t, this._daylightSavingAdjust(new Date(s, n, a)));
                t.selectedDay = o.getDate(),
                t.drawMonth = t.selectedMonth = o.getMonth(),
                t.drawYear = t.selectedYear = o.getFullYear(),
                ("M" === i || "Y" === i) && this._notifyChange(t)

            },
            _restrictMinMax: function(t, e) {
                var i = this._getMinMaxDate(t, "min"),
                s = this._getMinMaxDate(t, "max"),
                n = i && i > e ? i: e;
                return s && n > s ? s: n

            },
            _notifyChange: function(t) {
                var e = this._get(t, "onChangeMonthYear");
                e && e.apply(t.input ? t.input[0] : null, [t.selectedYear, t.selectedMonth + 1, t])

            },
            _getNumberOfMonths: function(t) {
                var e = this._get(t, "numberOfMonths");
                return null == e ? [1, 1] : "number" == typeof e ? [1, e] : e

            },
            _getMinMaxDate: function(t, e) {
                return this._determineDate(t, this._get(t, e + "Date"), null)

            },
            _getDaysInMonth: function(t, e) {
                return 32 - this._daylightSavingAdjust(new Date(t, e, 32)).getDate()

            },
            _getFirstDayOfMonth: function(t, e) {
                return new Date(t, e, 1).getDay()

            },
            _canAdjustMonth: function(t, e, i, s) {
                var n = this._getNumberOfMonths(t),
                a = this._daylightSavingAdjust(new Date(i, s + (0 > e ? e: n[0] * n[1]), 1));
                return 0 > e && a.setDate(this._getDaysInMonth(a.getFullYear(), a.getMonth())),
                this._isInRange(t, a)

            },
            _isInRange: function(t, e) {
                var i,
                s,
                n = this._getMinMaxDate(t, "min"),
                a = this._getMinMaxDate(t, "max"),
                o = null,
                r = null,
                l = this._get(t, "yearRange");
                return l && (i = l.split(":"), s = (new Date).getFullYear(), o = parseInt(i[0], 10), r = parseInt(i[1], 10), i[0].match(/[+\-].*/) && (o += s), i[1].match(/[+\-].*/) && (r += s)),
                (!n || e.getTime() >= n.getTime()) && (!a || e.getTime() <= a.getTime()) && (!o || e.getFullYear() >= o) && (!r || r >= e.getFullYear())

            },
            _getFormatConfig: function(t) {
                var e = this._get(t, "shortYearCutoff");
                return e = "string" != typeof e ? e: (new Date).getFullYear() % 100 + parseInt(e, 10),
                {
                    shortYearCutoff: e,
                    dayNamesShort: this._get(t, "dayNamesShort"),
                    dayNames: this._get(t, "dayNames"),
                    monthNamesShort: this._get(t, "monthNamesShort"),
                    monthNames: this._get(t, "monthNames")

                }

            },
            _formatDate: function(t, e, i, s) {
                e || (t.currentDay = t.selectedDay, t.currentMonth = t.selectedMonth, t.currentYear = t.selectedYear);
                var n = e ? "object" == typeof e ? e: this._daylightSavingAdjust(new Date(s, i, e)) : this._daylightSavingAdjust(new Date(t.currentYear, t.currentMonth, t.currentDay));
                return this.formatDate(this._get(t, "dateFormat"), n, this._getFormatConfig(t))

            }

        }),
        t.fn.datepicker = function(e) {
            if (!this.length) return this;
            t.datepicker.initialized || (t(document).mousedown(t.datepicker._checkExternalClick), t.datepicker.initialized = !0),
            0 === t("#" + t.datepicker._mainDivId).length && t("body").append(t.datepicker.dpDiv);
            var i = Array.prototype.slice.call(arguments, 1);
            return "string" != typeof e || "isDisabled" !== e && "getDate" !== e && "widget" !== e ? "option" === e && 2 === arguments.length && "string" == typeof arguments[1] ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i)) : this.each(function() {
                "string" == typeof e ? t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this].concat(i)) : t.datepicker._attachDatepicker(this, e)

            }) : t.datepicker["_" + e + "Datepicker"].apply(t.datepicker, [this[0]].concat(i))

        },
        t.datepicker = new i,
        t.datepicker.initialized = !1,
        t.datepicker.uuid = (new Date).getTime(),
        t.datepicker.version = "1.10.4"

    } (jQuery),
    function(t) {
        var e = {
            buttons: !0,
            height: !0,
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0,
            width: !0

        },
        i = {
            maxHeight: !0,
            maxWidth: !0,
            minHeight: !0,
            minWidth: !0

        };
        t.widget("ui.dialog", {
            version: "1.10.4",
            options: {
                appendTo: "body",
                autoOpen: !0,
                buttons: [],
                closeOnEscape: !0,
                closeText: "close",
                dialogClass: "",
                draggable: !0,
                hide: null,
                height: "auto",
                maxHeight: null,
                maxWidth: null,
                minHeight: 150,
                minWidth: 150,
                modal: !1,
                position: {
                    my: "center",
                    at: "center",
                    of: window,
                    collision: "fit",
                    using: function(e) {
                        var i = t(this).css(e).offset().top;
                        0 > i && t(this).css("top", e.top - i)

                    }

                },
                resizable: !0,
                show: null,
                title: null,
                width: 300,
                beforeClose: null,
                close: null,
                drag: null,
                dragStart: null,
                dragStop: null,
                focus: null,
                open: null,
                resize: null,
                resizeStart: null,
                resizeStop: null

            },
            _create: function() {
                this.originalCss = {
                    display: this.element[0].style.display,
                    width: this.element[0].style.width,
                    minHeight: this.element[0].style.minHeight,
                    maxHeight: this.element[0].style.maxHeight,
                    height: this.element[0].style.height

                },
                this.originalPosition = {
                    parent: this.element.parent(),
                    index: this.element.parent().children().index(this.element)

                },
                this.originalTitle = this.element.attr("title"),
                this.options.title = this.options.title || this.originalTitle,
                this._createWrapper(),
                this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog),
                this._createTitlebar(),
                this._createButtonPane(),
                this.options.draggable && t.fn.draggable && this._makeDraggable(),
                this.options.resizable && t.fn.resizable && this._makeResizable(),
                this._isOpen = !1

            },
            _init: function() {
                this.options.autoOpen && this.open()

            },
            _appendTo: function() {
                var e = this.options.appendTo;
                return e && (e.jquery || e.nodeType) ? t(e) : this.document.find(e || "body").eq(0)

            },
            _destroy: function() {
                var t,
                e = this.originalPosition;
                this._destroyOverlay(),
                this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(),
                this.uiDialog.stop(!0, !0).remove(),
                this.originalTitle && this.element.attr("title", this.originalTitle),
                t = e.parent.children().eq(e.index),
                t.length && t[0] !== this.element[0] ? t.before(this.element) : e.parent.append(this.element)

            },
            widget: function() {
                return this.uiDialog

            },
            disable: t.noop,
            enable: t.noop,
            close: function(e) {
                var i,
                s = this;
                if (this._isOpen && this._trigger("beforeClose", e) !== !1) {
                    if (this._isOpen = !1, this._destroyOverlay(), !this.opener.filter(":focusable").focus().length) try {
                        i = this.document[0].activeElement,
                        i && "body" !== i.nodeName.toLowerCase() && t(i).blur()

                    } catch(n) {}
                    this._hide(this.uiDialog, this.options.hide, 
                    function() {
                        s._trigger("close", e)

                    })

                }

            },
            isOpen: function() {
                return this._isOpen

            },
            moveToTop: function() {
                this._moveToTop()

            },
            _moveToTop: function(t, e) {
                var i = !!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;
                return i && !e && this._trigger("focus", t),
                i

            },
            open: function() {
                var e = this;
                return this._isOpen ? void(this._moveToTop() && this._focusTabbable()) : (this._isOpen = !0, this.opener = t(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this._show(this.uiDialog, this.options.show, 
                function() {
                    e._focusTabbable(),
                    e._trigger("focus")

                }), void this._trigger("open"))

            },
            _focusTabbable: function() {
                var t = this.element.find("[autofocus]");
                t.length || (t = this.element.find(":tabbable")),
                t.length || (t = this.uiDialogButtonPane.find(":tabbable")),
                t.length || (t = this.uiDialogTitlebarClose.filter(":tabbable")),
                t.length || (t = this.uiDialog),
                t.eq(0).focus()

            },
            _keepFocus: function(e) {
                function i() {
                    var e = this.document[0].activeElement,
                    i = this.uiDialog[0] === e || t.contains(this.uiDialog[0], e);
                    i || this._focusTabbable()

                }
                e.preventDefault(),
                i.call(this),
                this._delay(i)

            },
            _createWrapper: function() {
                this.uiDialog = t("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                    tabIndex: -1,
                    role: "dialog"

                }).appendTo(this._appendTo()),
                this._on(this.uiDialog, {
                    keydown: function(e) {
                        if (this.options.closeOnEscape && !e.isDefaultPrevented() && e.keyCode && e.keyCode === t.ui.keyCode.ESCAPE) return e.preventDefault(),
                        void this.close(e);
                        if (e.keyCode === t.ui.keyCode.TAB) {
                            var i = this.uiDialog.find(":tabbable"),
                            s = i.filter(":first"),
                            n = i.filter(":last");
                            e.target !== n[0] && e.target !== this.uiDialog[0] || e.shiftKey ? e.target !== s[0] && e.target !== this.uiDialog[0] || !e.shiftKey || (n.focus(1), e.preventDefault()) : (s.focus(1), e.preventDefault())

                        }

                    },
                    mousedown: function(t) {
                        this._moveToTop(t) && this._focusTabbable()

                    }

                }),
                this.element.find("[aria-describedby]").length || this.uiDialog.attr({
                    "aria-describedby": this.element.uniqueId().attr("id")

                })

            },
            _createTitlebar: function() {
                var e;
                this.uiDialogTitlebar = t("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog),
                this._on(this.uiDialogTitlebar, {
                    mousedown: function(e) {
                        t(e.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus()

                    }

                }),
                this.uiDialogTitlebarClose = t("<button type='button'></button>").button({
                    label: this.options.closeText,
                    icons: {
                        primary: "ui-icon-closethick"

                    },
                    text: !1

                }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar),
                this._on(this.uiDialogTitlebarClose, {
                    click: function(t) {
                        t.preventDefault(),
                        this.close(t)

                    }

                }),
                e = t("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar),
                this._title(e),
                this.uiDialog.attr({
                    "aria-labelledby": e.attr("id")

                })

            },
            _title: function(t) {
                this.options.title || t.html("&#160;"),
                t.text(this.options.title)

            },
            _createButtonPane: function() {
                this.uiDialogButtonPane = t("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),
                this.uiButtonSet = t("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane),
                this._createButtons()

            },
            _createButtons: function() {
                var e = this,
                i = this.options.buttons;
                return this.uiDialogButtonPane.remove(),
                this.uiButtonSet.empty(),
                t.isEmptyObject(i) || t.isArray(i) && !i.length ? void this.uiDialog.removeClass("ui-dialog-buttons") : (t.each(i, 
                function(i, s) {
                    var n,
                    a;
                    s = t.isFunction(s) ? {
                        click: s,
                        text: i

                    }: s,
                    s = t.extend({
                        type: "button"

                    },
                    s),
                    n = s.click,
                    s.click = function() {
                        n.apply(e.element[0], arguments)

                    },
                    a = {
                        icons: s.icons,
                        text: s.showText

                    },
                    delete s.icons,
                    delete s.showText,
                    t("<button></button>", s).button(a).appendTo(e.uiButtonSet)

                }), this.uiDialog.addClass("ui-dialog-buttons"), void this.uiDialogButtonPane.appendTo(this.uiDialog))

            },
            _makeDraggable: function() {
                function e(t) {
                    return {
                        position: t.position,
                        offset: t.offset

                    }

                }
                var i = this,
                s = this.options;
                this.uiDialog.draggable({
                    cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                    handle: ".ui-dialog-titlebar",
                    containment: "document",
                    start: function(s, n) {
                        t(this).addClass("ui-dialog-dragging"),
                        i._blockFrames(),
                        i._trigger("dragStart", s, e(n))

                    },
                    drag: function(t, s) {
                        i._trigger("drag", t, e(s))

                    },
                    stop: function(n, a) {
                        s.position = [a.position.left - i.document.scrollLeft(), a.position.top - i.document.scrollTop()],
                        t(this).removeClass("ui-dialog-dragging"),
                        i._unblockFrames(),
                        i._trigger("dragStop", n, e(a))

                    }

                })

            },
            _makeResizable: function() {
                function e(t) {
                    return {
                        originalPosition: t.originalPosition,
                        originalSize: t.originalSize,
                        position: t.position,
                        size: t.size

                    }

                }
                var i = this,
                s = this.options,
                n = s.resizable,
                a = this.uiDialog.css("position"),
                o = "string" == typeof n ? n: "n,e,s,w,se,sw,ne,nw";
                this.uiDialog.resizable({
                    cancel: ".ui-dialog-content",
                    containment: "document",
                    alsoResize: this.element,
                    maxWidth: s.maxWidth,
                    maxHeight: s.maxHeight,
                    minWidth: s.minWidth,
                    minHeight: this._minHeight(),
                    handles: o,
                    start: function(s, n) {
                        t(this).addClass("ui-dialog-resizing"),
                        i._blockFrames(),
                        i._trigger("resizeStart", s, e(n))

                    },
                    resize: function(t, s) {
                        i._trigger("resize", t, e(s))

                    },
                    stop: function(n, a) {
                        s.height = t(this).height(),
                        s.width = t(this).width(),
                        t(this).removeClass("ui-dialog-resizing"),
                        i._unblockFrames(),
                        i._trigger("resizeStop", n, e(a))

                    }

                }).css("position", a)

            },
            _minHeight: function() {
                var t = this.options;
                return "auto" === t.height ? t.minHeight: Math.min(t.minHeight, t.height)

            },
            _position: function() {
                var t = this.uiDialog.is(":visible");
                t || this.uiDialog.show(),
                this.uiDialog.position(this.options.position),
                t || this.uiDialog.hide()

            },
            _setOptions: function(s) {
                var n = this,
                a = !1,
                o = {};
                t.each(s, 
                function(t, s) {
                    n._setOption(t, s),
                    t in e && (a = !0),
                    t in i && (o[t] = s)

                }),
                a && (this._size(), this._position()),
                this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", o)

            },
            _setOption: function(t, e) {
                var i,
                s,
                n = this.uiDialog;
                "dialogClass" === t && n.removeClass(this.options.dialogClass).addClass(e),
                "disabled" !== t && (this._super(t, e), "appendTo" === t && this.uiDialog.appendTo(this._appendTo()), "buttons" === t && this._createButtons(), "closeText" === t && this.uiDialogTitlebarClose.button({
                    label: "" + e

                }), "draggable" === t && (i = n.is(":data(ui-draggable)"), i && !e && n.draggable("destroy"), !i && e && this._makeDraggable()), "position" === t && this._position(), "resizable" === t && (s = n.is(":data(ui-resizable)"), s && !e && n.resizable("destroy"), s && "string" == typeof e && n.resizable("option", "handles", e), s || e === !1 || this._makeResizable()), "title" === t && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))

            },
            _size: function() {
                var t,
                e,
                i,
                s = this.options;
                this.element.show().css({
                    width: "auto",
                    minHeight: 0,
                    maxHeight: "none",
                    height: 0

                }),
                s.minWidth > s.width && (s.width = s.minWidth),
                t = this.uiDialog.css({
                    height: "auto",
                    width: s.width

                }).outerHeight(),
                e = Math.max(0, s.minHeight - t),
                i = "number" == typeof s.maxHeight ? Math.max(0, s.maxHeight - t) : "none",
                "auto" === s.height ? this.element.css({
                    minHeight: e,
                    maxHeight: i,
                    height: "auto"

                }) : this.element.height(Math.max(0, s.height - t)),
                this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())

            },
            _blockFrames: function() {
                this.iframeBlocks = this.document.find("iframe").map(function() {
                    var e = t(this);
                    return t("<div>").css({
                        position: "absolute",
                        width: e.outerWidth(),
                        height: e.outerHeight()

                    }).appendTo(e.parent()).offset(e.offset())[0]

                })

            },
            _unblockFrames: function() {
                this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks)

            },
            _allowInteraction: function(e) {
                return t(e.target).closest(".ui-dialog").length ? !0: !!t(e.target).closest(".ui-datepicker").length

            },
            _createOverlay: function() {
                if (this.options.modal) {
                    var e = this,
                    i = this.widgetFullName;
                    t.ui.dialog.overlayInstances || this._delay(function() {
                        t.ui.dialog.overlayInstances && this.document.bind("focusin.dialog", 
                        function(s) {
                            e._allowInteraction(s) || (s.preventDefault(), t(".ui-dialog:visible:last .ui-dialog-content").data(i)._focusTabbable())

                        })

                    }),
                    this.overlay = t("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()),
                    this._on(this.overlay, {
                        mousedown: "_keepFocus"

                    }),
                    t.ui.dialog.overlayInstances++

                }

            },
            _destroyOverlay: function() {
                this.options.modal && this.overlay && (t.ui.dialog.overlayInstances--, t.ui.dialog.overlayInstances || this.document.unbind("focusin.dialog"), this.overlay.remove(), this.overlay = null)

            }

        }),
        t.ui.dialog.overlayInstances = 0,
        t.uiBackCompat !== !1 && t.widget("ui.dialog", t.ui.dialog, {
            _position: function() {
                var e,
                i = this.options.position,
                s = [],
                n = [0, 0];
                i ? (("string" == typeof i || "object" == typeof i && "0" in i) && (s = i.split ? i.split(" ") : [i[0], i[1]], 1 === s.length && (s[1] = s[0]), t.each(["left", "top"], 
                function(t, e) {
                    + s[t] === s[t] && (n[t] = s[t], s[t] = e)

                }), i = {
                    my: s[0] + (0 > n[0] ? n[0] : "+" + n[0]) + " " + s[1] + (0 > n[1] ? n[1] : "+" + n[1]),
                    at: s.join(" ")

                }), i = t.extend({},
                t.ui.dialog.prototype.options.position, i)) : i = t.ui.dialog.prototype.options.position,
                e = this.uiDialog.is(":visible"),
                e || this.uiDialog.show(),
                this.uiDialog.position(i),
                e || this.uiDialog.hide()

            }

        })

    } (jQuery),
    function(t) {
        t.widget("ui.menu", {
            version: "1.10.4",
            defaultElement: "<ul>",
            delay: 300,
            options: {
                icons: {
                    submenu: "ui-icon-carat-1-e"

                },
                menus: "ul",
                position: {
                    my: "left top",
                    at: "right top"

                },
                role: "menu",
                blur: null,
                focus: null,
                select: null

            },
            _create: function() {
                this.activeMenu = this.element,
                this.mouseHandled = !1,
                this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content ui-corner-all").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({
                    role: this.options.role,
                    tabIndex: 0

                }).bind("click" + this.eventNamespace, t.proxy(function(t) {
                    this.options.disabled && t.preventDefault()

                },
                this)),
                this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"),
                this._on({
                    "mousedown .ui-menu-item > a": function(t) {
                        t.preventDefault()

                    },
                    "click .ui-state-disabled > a": function(t) {
                        t.preventDefault()

                    },
                    "click .ui-menu-item:has(a)": function(e) {
                        var i = t(e.target).closest(".ui-menu-item");
                        ! this.mouseHandled && i.not(".ui-state-disabled").length && (this.select(e), e.isPropagationStopped() || (this.mouseHandled = !0), i.has(".ui-menu").length ? this.expand(e) : !this.element.is(":focus") && t(this.document[0].activeElement).closest(".ui-menu").length && (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))

                    },
                    "mouseenter .ui-menu-item": function(e) {
                        var i = t(e.currentTarget);
                        i.siblings().children(".ui-state-active").removeClass("ui-state-active"),
                        this.focus(e, i)

                    },
                    mouseleave: "collapseAll",
                    "mouseleave .ui-menu": "collapseAll",
                    focus: function(t, e) {
                        var i = this.active || this.element.children(".ui-menu-item").eq(0);
                        e || this.focus(t, i)

                    },
                    blur: function(e) {
                        this._delay(function() {
                            t.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(e)

                        })

                    },
                    keydown: "_keydown"

                }),
                this.refresh(),
                this._on(this.document, {
                    click: function(e) {
                        t(e.target).closest(".ui-menu").length || this.collapseAll(e),
                        this.mouseHandled = !1

                    }

                })

            },
            _destroy: function() {
                this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(),
                this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").children("a").removeUniqueId().removeClass("ui-corner-all ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function() {
                    var e = t(this);
                    e.data("ui-menu-submenu-carat") && e.remove()

                }),
                this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")

            },
            _keydown: function(e) {
                function i(t) {
                    return t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$&")

                }
                var s,
                n,
                a,
                o,
                r,
                l = !0;
                switch (e.keyCode) {
                    case t.ui.keyCode.PAGE_UP:
                    this.previousPage(e);
                    break;
                    case t.ui.keyCode.PAGE_DOWN:
                    this.nextPage(e);
                    break;
                    case t.ui.keyCode.HOME:
                    this._move("first", "first", e);
                    break;
                    case t.ui.keyCode.END:
                    this._move("last", "last", e);
                    break;
                    case t.ui.keyCode.UP:
                    this.previous(e);
                    break;
                    case t.ui.keyCode.DOWN:
                    this.next(e);
                    break;
                    case t.ui.keyCode.LEFT:
                    this.collapse(e);
                    break;
                    case t.ui.keyCode.RIGHT:
                    this.active && !this.active.is(".ui-state-disabled") && this.expand(e);
                    break;
                    case t.ui.keyCode.ENTER:
                case t.ui.keyCode.SPACE:
                    this._activate(e);
                    break;
                    case t.ui.keyCode.ESCAPE:
                    this.collapse(e);
                    break;
                    default:
                    l = !1,
                    n = this.previousFilter || "",
                    a = String.fromCharCode(e.keyCode),
                    o = !1,
                    clearTimeout(this.filterTimer),
                    a === n ? o = !0: a = n + a,
                    r = RegExp("^" + i(a), "i"),
                    s = this.activeMenu.children(".ui-menu-item").filter(function() {
                        return r.test(t(this).children("a").text())

                    }),
                    s = o && -1 !== s.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : s,
                    s.length || (a = String.fromCharCode(e.keyCode), r = RegExp("^" + i(a), "i"), s = this.activeMenu.children(".ui-menu-item").filter(function() {
                        return r.test(t(this).children("a").text())

                    })),
                    s.length ? (this.focus(e, s), s.length > 1 ? (this.previousFilter = a, this.filterTimer = this._delay(function() {
                        delete this.previousFilter

                    },
                    1e3)) : delete this.previousFilter) : delete this.previousFilter

                }
                l && e.preventDefault()

            },
            _activate: function(t) {
                this.active.is(".ui-state-disabled") || (this.active.children("a[aria-haspopup='true']").length ? this.expand(t) : this.select(t))

            },
            refresh: function() {
                var e,
                i = this.options.icons.submenu,
                s = this.element.find(this.options.menus);
                this.element.toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length),
                s.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-corner-all").hide().attr({
                    role: this.options.role,
                    "aria-hidden": "true",
                    "aria-expanded": "false"

                }).each(function() {
                    var e = t(this),
                    s = e.prev("a"),
                    n = t("<span>").addClass("ui-menu-icon ui-icon " + i).data("ui-menu-submenu-carat", !0);
                    s.attr("aria-haspopup", "true").prepend(n),
                    e.attr("aria-labelledby", s.attr("id"))

                }),
                e = s.add(this.element),
                e.children(":not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "presentation").children("a").uniqueId().addClass("ui-corner-all").attr({
                    tabIndex: -1,
                    role: this._itemRole()

                }),
                e.children(":not(.ui-menu-item)").each(function() {
                    var e = t(this);
                    /[^\-\u2014\u2013\s]/.test(e.text()) || e.addClass("ui-widget-content ui-menu-divider")

                }),
                e.children(".ui-state-disabled").attr("aria-disabled", "true"),
                this.active && !t.contains(this.element[0], this.active[0]) && this.blur()

            },
            _itemRole: function() {
                return {
                    menu: "menuitem",
                    listbox: "option"

                } [this.options.role]

            },
            _setOption: function(t, e) {
                "icons" === t && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(e.submenu),
                this._super(t, e)

            },
            focus: function(t, e) {
                var i,
                s;
                this.blur(t, t && "focus" === t.type),
                this._scrollIntoView(e),
                this.active = e.first(),
                s = this.active.children("a").addClass("ui-state-focus"),
                this.options.role && this.element.attr("aria-activedescendant", s.attr("id")),
                this.active.parent().closest(".ui-menu-item").children("a:first").addClass("ui-state-active"),
                t && "keydown" === t.type ? this._close() : this.timer = this._delay(function() {
                    this._close()

                },
                this.delay),
                i = e.children(".ui-menu"),
                i.length && t && /^mouse/.test(t.type) && this._startOpening(i),
                this.activeMenu = e.parent(),
                this._trigger("focus", t, {
                    item: e

                })

            },
            _scrollIntoView: function(e) {
                var i,
                s,
                n,
                a,
                o,
                r;
                this._hasScroll() && (i = parseFloat(t.css(this.activeMenu[0], "borderTopWidth")) || 0, s = parseFloat(t.css(this.activeMenu[0], "paddingTop")) || 0, n = e.offset().top - this.activeMenu.offset().top - i - s, a = this.activeMenu.scrollTop(), o = this.activeMenu.height(), r = e.height(), 0 > n ? this.activeMenu.scrollTop(a + n) : n + r > o && this.activeMenu.scrollTop(a + n - o + r))

            },
            blur: function(t, e) {
                e || clearTimeout(this.timer),
                this.active && (this.active.children("a").removeClass("ui-state-focus"), this.active = null, this._trigger("blur", t, {
                    item: this.active

                }))

            },
            _startOpening: function(t) {
                clearTimeout(this.timer),
                "true" === t.attr("aria-hidden") && (this.timer = this._delay(function() {
                    this._close(),
                    this._open(t)

                },
                this.delay))

            },
            _open: function(e) {
                var i = t.extend({
                    of: this.active

                },
                this.options.position);
                clearTimeout(this.timer),
                this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"),
                e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(i)

            },
            collapseAll: function(e, i) {
                clearTimeout(this.timer),
                this.timer = this._delay(function() {
                    var s = i ? this.element: t(e && e.target).closest(this.element.find(".ui-menu"));
                    s.length || (s = this.element),
                    this._close(s),
                    this.blur(e),
                    this.activeMenu = s

                },
                this.delay)

            },
            _close: function(t) {
                t || (t = this.active ? this.active.parent() : this.element),
                t.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find("a.ui-state-active").removeClass("ui-state-active")

            },
            collapse: function(t) {
                var e = this.active && this.active.parent().closest(".ui-menu-item", this.element);
                e && e.length && (this._close(), this.focus(t, e))

            },
            expand: function(t) {
                var e = this.active && this.active.children(".ui-menu ").children(".ui-menu-item").first();
                e && e.length && (this._open(e.parent()), this._delay(function() {
                    this.focus(t, e)

                }))

            },
            next: function(t) {
                this._move("next", "first", t)

            },
            previous: function(t) {
                this._move("prev", "last", t)

            },
            isFirstItem: function() {
                return this.active && !this.active.prevAll(".ui-menu-item").length

            },
            isLastItem: function() {
                return this.active && !this.active.nextAll(".ui-menu-item").length

            },
            _move: function(t, e, i) {
                var s;
                this.active && (s = "first" === t || "last" === t ? this.active["first" === t ? "prevAll": "nextAll"](".ui-menu-item").eq( - 1) : this.active[t + "All"](".ui-menu-item").eq(0)),
                s && s.length && this.active || (s = this.activeMenu.children(".ui-menu-item")[e]()),
                this.focus(i, s)

            },
            nextPage: function(e) {
                var i,
                s,
                n;
                return this.active ? void(this.isLastItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.nextAll(".ui-menu-item").each(function() {
                    return i = t(this),
                    0 > i.offset().top - s - n

                }), this.focus(e, i)) : this.focus(e, this.activeMenu.children(".ui-menu-item")[this.active ? "last": "first"]()))) : void this.next(e)

            },
            previousPage: function(e) {
                var i,
                s,
                n;
                return this.active ? void(this.isFirstItem() || (this._hasScroll() ? (s = this.active.offset().top, n = this.element.height(), this.active.prevAll(".ui-menu-item").each(function() {
                    return i = t(this),
                    i.offset().top - s + n > 0

                }), this.focus(e, i)) : this.focus(e, this.activeMenu.children(".ui-menu-item").first()))) : void this.next(e)

            },
            _hasScroll: function() {
                return this.element.outerHeight() < this.element.prop("scrollHeight")

            },
            select: function(e) {
                this.active = this.active || t(e.target).closest(".ui-menu-item");
                var i = {
                    item: this.active

                };
                this.active.has(".ui-menu").length || this.collapseAll(e, !0),
                this._trigger("select", e, i)

            }

        })

    } (jQuery),
    function(t, e) {
        t.widget("ui.progressbar", {
            version: "1.10.4",
            options: {
                max: 100,
                value: 0,
                change: null,
                complete: null

            },
            min: 0,
            _create: function() {
                this.oldValue = this.options.value = this._constrainedValue(),
                this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({
                    role: "progressbar",
                    "aria-valuemin": this.min

                }),
                this.valueDiv = t("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element),
                this._refreshValue()

            },
            _destroy: function() {
                this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"),
                this.valueDiv.remove()

            },
            value: function(t) {
                return t === e ? this.options.value: (this.options.value = this._constrainedValue(t), this._refreshValue(), e)

            },
            _constrainedValue: function(t) {
                return t === e && (t = this.options.value),
                this.indeterminate = t === !1,
                "number" != typeof t && (t = 0),
                this.indeterminate ? !1: Math.min(this.options.max, Math.max(this.min, t))

            },
            _setOptions: function(t) {
                var e = t.value;
                delete t.value,
                this._super(t),
                this.options.value = this._constrainedValue(e),
                this._refreshValue()

            },
            _setOption: function(t, e) {
                "max" === t && (e = Math.max(this.min, e)),
                this._super(t, e)

            },
            _percentage: function() {
                return this.indeterminate ? 100: 100 * (this.options.value - this.min) / (this.options.max - this.min)

            },
            _refreshValue: function() {
                var e = this.options.value,
                i = this._percentage();
                this.valueDiv.toggle(this.indeterminate || e > this.min).toggleClass("ui-corner-right", e === this.options.max).width(i.toFixed(0) + "%"),
                this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate),
                this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv || (this.overlayDiv = t("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))) : (this.element.attr({
                    "aria-valuemax": this.options.max,
                    "aria-valuenow": e

                }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)),
                this.oldValue !== e && (this.oldValue = e, this._trigger("change")),
                e === this.options.max && this._trigger("complete")

            }

        })

    } (jQuery),
    function(t) {
        var e = 5;
        t.widget("ui.slider", t.ui.mouse, {
            version: "1.10.4",
            widgetEventPrefix: "slide",
            options: {
                animate: !1,
                distance: 0,
                max: 100,
                min: 0,
                orientation: "horizontal",
                range: !1,
                step: 1,
                value: 0,
                values: null,
                change: null,
                slide: null,
                start: null,
                stop: null

            },
            _create: function() {
                this._keySliding = !1,
                this._mouseSliding = !1,
                this._animateOff = !0,
                this._handleIndex = null,
                this._detectOrientation(),
                this._mouseInit(),
                this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"),
                this._refresh(),
                this._setOption("disabled", this.options.disabled),
                this._animateOff = !1

            },
            _refresh: function() {
                this._createRange(),
                this._createHandles(),
                this._setupEvents(),
                this._refreshValue()

            },
            _createHandles: function() {
                var e,
                i,
                s = this.options,
                n = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),
                a = "<a class='ui-slider-handle ui-state-default ui-corner-all' href='#'></a>",
                o = [];
                for (i = s.values && s.values.length || 1, n.length > i && (n.slice(i).remove(), n = n.slice(0, i)), e = n.length; i > e; e++) o.push(a);
                this.handles = n.add(t(o.join("")).appendTo(this.element)),
                this.handle = this.handles.eq(0),
                this.handles.each(function(e) {
                    t(this).data("ui-slider-handle-index", e)

                })

            },
            _createRange: function() {
                var e = this.options,
                i = "";
                e.range ? (e.range === !0 && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : t.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                    left: "",
                    bottom: ""

                }) : (this.range = t("<div></div>").appendTo(this.element), i = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(i + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range: ""))) : (this.range && this.range.remove(), this.range = null)

            },
            _setupEvents: function() {
                var t = this.handles.add(this.range).filter("a");
                this._off(t),
                this._on(t, this._handleEvents),
                this._hoverable(t),
                this._focusable(t)

            },
            _destroy: function() {
                this.handles.remove(),
                this.range && this.range.remove(),
                this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"),
                this._mouseDestroy()

            },
            _mouseCapture: function(e) {
                var i,
                s,
                n,
                a,
                o,
                r,
                l,
                c,
                h = this,
                u = this.options;
                return u.disabled ? !1: (this.elementSize = {
                    width: this.element.outerWidth(),
                    height: this.element.outerHeight()

                },
                this.elementOffset = this.element.offset(), i = {
                    x: e.pageX,
                    y: e.pageY

                },
                s = this._normValueFromMouse(i), n = this._valueMax() - this._valueMin() + 1, this.handles.each(function(e) {
                    var i = Math.abs(s - h.values(e));
                    (n > i || n === i && (e === h._lastChangedValue || h.values(e) === u.min)) && (n = i, a = t(this), o = e)

                }), r = this._start(e, o), r === !1 ? !1: (this._mouseSliding = !0, this._handleIndex = o, a.addClass("ui-state-active").focus(), l = a.offset(), c = !t(e.target).parents().addBack().is(".ui-slider-handle"), this._clickOffset = c ? {
                    left: 0,
                    top: 0

                }: {
                    left: e.pageX - l.left - a.width() / 2,
                    top: e.pageY - l.top - a.height() / 2 - (parseInt(a.css("borderTopWidth"), 10) || 0) - (parseInt(a.css("borderBottomWidth"), 10) || 0) + (parseInt(a.css("marginTop"), 10) || 0)

                },
                this.handles.hasClass("ui-state-hover") || this._slide(e, o, s), this._animateOff = !0, !0))

            },
            _mouseStart: function() {
                return ! 0

            },
            _mouseDrag: function(t) {
                var e = {
                    x: t.pageX,
                    y: t.pageY

                },
                i = this._normValueFromMouse(e);
                return this._slide(t, this._handleIndex, i),
                !1

            },
            _mouseStop: function(t) {
                return this.handles.removeClass("ui-state-active"),
                this._mouseSliding = !1,
                this._stop(t, this._handleIndex),
                this._change(t, this._handleIndex),
                this._handleIndex = null,
                this._clickOffset = null,
                this._animateOff = !1,
                !1

            },
            _detectOrientation: function() {
                this.orientation = "vertical" === this.options.orientation ? "vertical": "horizontal"

            },
            _normValueFromMouse: function(t) {
                var e,
                i,
                s,
                n,
                a;
                return "horizontal" === this.orientation ? (e = this.elementSize.width, i = t.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left: 0)) : (e = this.elementSize.height, i = t.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top: 0)),
                s = i / e,
                s > 1 && (s = 1),
                0 > s && (s = 0),
                "vertical" === this.orientation && (s = 1 - s),
                n = this._valueMax() - this._valueMin(),
                a = this._valueMin() + s * n,
                this._trimAlignValue(a)

            },
            _start: function(t, e) {
                var i = {
                    handle: this.handles[e],
                    value: this.value()

                };
                return this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()),
                this._trigger("start", t, i)

            },
            _slide: function(t, e, i) {
                var s,
                n,
                a;
                this.options.values && this.options.values.length ? (s = this.values(e ? 0: 1), 2 === this.options.values.length && this.options.range === !0 && (0 === e && i > s || 1 === e && s > i) && (i = s), i !== this.values(e) && (n = this.values(), n[e] = i, a = this._trigger("slide", t, {
                    handle: this.handles[e],
                    value: i,
                    values: n

                }), s = this.values(e ? 0: 1), a !== !1 && this.values(e, i))) : i !== this.value() && (a = this._trigger("slide", t, {
                    handle: this.handles[e],
                    value: i

                }), a !== !1 && this.value(i))

            },
            _stop: function(t, e) {
                var i = {
                    handle: this.handles[e],
                    value: this.value()

                };
                this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()),
                this._trigger("stop", t, i)

            },
            _change: function(t, e) {
                if (!this._keySliding && !this._mouseSliding) {
                    var i = {
                        handle: this.handles[e],
                        value: this.value()

                    };
                    this.options.values && this.options.values.length && (i.value = this.values(e), i.values = this.values()),
                    this._lastChangedValue = e,
                    this._trigger("change", t, i)

                }

            },
            value: function(t) {
                return arguments.length ? (this.options.value = this._trimAlignValue(t), this._refreshValue(), void this._change(null, 0)) : this._value()

            },
            values: function(e, i) {
                var s,
                n,
                a;
                if (arguments.length > 1) return this.options.values[e] = this._trimAlignValue(i),
                this._refreshValue(),
                void this._change(null, e);
                if (!arguments.length) return this._values();
                if (!t.isArray(arguments[0])) return this.options.values && this.options.values.length ? this._values(e) : this.value();
                for (s = this.options.values, n = arguments[0], a = 0; s.length > a; a += 1) s[a] = this._trimAlignValue(n[a]),
                this._change(null, a);
                this._refreshValue()

            },
            _setOption: function(e, i) {
                var s,
                n = 0;
                switch ("range" === e && this.options.range === !0 && ("min" === i ? (this.options.value = this._values(0), this.options.values = null) : "max" === i && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)), t.isArray(this.options.values) && (n = this.options.values.length), t.Widget.prototype._setOption.apply(this, arguments), e) {
                    case "orientation":
                    this._detectOrientation(),
                    this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" + this.orientation),
                    this._refreshValue();
                    break;
                    case "value":
                    this._animateOff = !0,
                    this._refreshValue(),
                    this._change(null, 0),
                    this._animateOff = !1;
                    break;
                    case "values":
                    for (this._animateOff = !0, this._refreshValue(), s = 0; n > s; s += 1) this._change(null, s);
                    this._animateOff = !1;
                    break;
                    case "min":
                case "max":
                    this._animateOff = !0,
                    this._refreshValue(),
                    this._animateOff = !1;
                    break;
                    case "range":
                    this._animateOff = !0,
                    this._refresh(),
                    this._animateOff = !1

                }

            },
            _value: function() {
                var t = this.options.value;
                return t = this._trimAlignValue(t)

            },
            _values: function(t) {
                var e,
                i,
                s;
                if (arguments.length) return e = this.options.values[t],
                e = this._trimAlignValue(e);
                if (this.options.values && this.options.values.length) {
                    for (i = this.options.values.slice(), s = 0; i.length > s; s += 1) i[s] = this._trimAlignValue(i[s]);
                    return i

                }
                return []

            },
            _trimAlignValue: function(t) {
                if (this._valueMin() >= t) return this._valueMin();
                if (t >= this._valueMax()) return this._valueMax();
                var e = this.options.step > 0 ? this.options.step: 1,
                i = (t - this._valueMin()) % e,
                s = t - i;
                return 2 * Math.abs(i) >= e && (s += i > 0 ? e: -e),
                parseFloat(s.toFixed(5))

            },
            _valueMin: function() {
                return this.options.min

            },
            _valueMax: function() {
                return this.options.max

            },
            _refreshValue: function() {
                var e,
                i,
                s,
                n,
                a,
                o = this.options.range,
                r = this.options,
                l = this,
                c = this._animateOff ? !1: r.animate,
                h = {};
                this.options.values && this.options.values.length ? this.handles.each(function(s) {
                    i = 100 * ((l.values(s) - l._valueMin()) / (l._valueMax() - l._valueMin())),
                    h["horizontal" === l.orientation ? "left": "bottom"] = i + "%",
                    t(this).stop(1, 1)[c ? "animate": "css"](h, r.animate),
                    l.options.range === !0 && ("horizontal" === l.orientation ? (0 === s && l.range.stop(1, 1)[c ? "animate": "css"]({
                        left: i + "%"

                    },
                    r.animate), 1 === s && l.range[c ? "animate": "css"]({
                        width: i - e + "%"

                    },
                    {
                        queue: !1,
                        duration: r.animate

                    })) : (0 === s && l.range.stop(1, 1)[c ? "animate": "css"]({
                        bottom: i + "%"

                    },
                    r.animate), 1 === s && l.range[c ? "animate": "css"]({
                        height: i - e + "%"

                    },
                    {
                        queue: !1,
                        duration: r.animate

                    }))),
                    e = i

                }) : (s = this.value(), n = this._valueMin(), a = this._valueMax(), i = a !== n ? 100 * ((s - n) / (a - n)) : 0, h["horizontal" === this.orientation ? "left": "bottom"] = i + "%", this.handle.stop(1, 1)[c ? "animate": "css"](h, r.animate), "min" === o && "horizontal" === this.orientation && this.range.stop(1, 1)[c ? "animate": "css"]({
                    width: i + "%"

                },
                r.animate), "max" === o && "horizontal" === this.orientation && this.range[c ? "animate": "css"]({
                    width: 100 - i + "%"

                },
                {
                    queue: !1,
                    duration: r.animate

                }), "min" === o && "vertical" === this.orientation && this.range.stop(1, 1)[c ? "animate": "css"]({
                    height: i + "%"

                },
                r.animate), "max" === o && "vertical" === this.orientation && this.range[c ? "animate": "css"]({
                    height: 100 - i + "%"

                },
                {
                    queue: !1,
                    duration: r.animate

                }))

            },
            _handleEvents: {
                keydown: function(i) {
                    var s,
                    n,
                    a,
                    o,
                    r = t(i.target).data("ui-slider-handle-index");
                    switch (i.keyCode) {
                        case t.ui.keyCode.HOME:
                    case t.ui.keyCode.END:
                    case t.ui.keyCode.PAGE_UP:
                    case t.ui.keyCode.PAGE_DOWN:
                    case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (i.preventDefault(), !this._keySliding && (this._keySliding = !0, t(i.target).addClass("ui-state-active"), s = this._start(i, r), s === !1)) return

                    }
                    switch (o = this.options.step, n = a = this.options.values && this.options.values.length ? this.values(r) : this.value(), i.keyCode) {
                        case t.ui.keyCode.HOME:
                        a = this._valueMin();
                        break;
                        case t.ui.keyCode.END:
                        a = this._valueMax();
                        break;
                        case t.ui.keyCode.PAGE_UP:
                        a = this._trimAlignValue(n + (this._valueMax() - this._valueMin()) / e);
                        break;
                        case t.ui.keyCode.PAGE_DOWN:
                        a = this._trimAlignValue(n - (this._valueMax() - this._valueMin()) / e);
                        break;
                        case t.ui.keyCode.UP:
                    case t.ui.keyCode.RIGHT:
                        if (n === this._valueMax()) return;
                        a = this._trimAlignValue(n + o);
                        break;
                        case t.ui.keyCode.DOWN:
                    case t.ui.keyCode.LEFT:
                        if (n === this._valueMin()) return;
                        a = this._trimAlignValue(n - o)

                    }
                    this._slide(i, r, a)

                },
                click: function(t) {
                    t.preventDefault()

                },
                keyup: function(e) {
                    var i = t(e.target).data("ui-slider-handle-index");
                    this._keySliding && (this._keySliding = !1, this._stop(e, i), this._change(e, i), t(e.target).removeClass("ui-state-active"))

                }

            }

        })

    } (jQuery),
    function(t) {
        function e(t) {
            return function() {
                var e = this.element.val();
                t.apply(this, arguments),
                this._refresh(),
                e !== this.element.val() && this._trigger("change")

            }

        }
        t.widget("ui.spinner", {
            version: "1.10.4",
            defaultElement: "<input>",
            widgetEventPrefix: "spin",
            options: {
                culture: null,
                icons: {
                    down: "ui-icon-triangle-1-s",
                    up: "ui-icon-triangle-1-n"

                },
                incremental: !0,
                max: null,
                min: null,
                numberFormat: null,
                page: 10,
                step: 1,
                change: null,
                spin: null,
                start: null,
                stop: null

            },
            _create: function() {
                this._setOption("max", this.options.max),
                this._setOption("min", this.options.min),
                this._setOption("step", this.options.step),
                "" !== this.value() && this._value(this.element.val(), !0),
                this._draw(),
                this._on(this._events),
                this._refresh(),
                this._on(this.window, {
                    beforeunload: function() {
                        this.element.removeAttr("autocomplete")

                    }

                })

            },
            _getCreateOptions: function() {
                var e = {},
                i = this.element;
                return t.each(["min", "max", "step"], 
                function(t, s) {
                    var n = i.attr(s);
                    void 0 !== n && n.length && (e[s] = n)

                }),
                e

            },
            _events: {
                keydown: function(t) {
                    this._start(t) && this._keydown(t) && t.preventDefault()

                },
                keyup: "_stop",
                focus: function() {
                    this.previous = this.element.val()

                },
                blur: function(t) {
                    return this.cancelBlur ? void delete this.cancelBlur: (this._stop(), this._refresh(), void(this.previous !== this.element.val() && this._trigger("change", t)))

                },
                mousewheel: function(t, e) {
                    if (e) {
                        if (!this.spinning && !this._start(t)) return ! 1;
                        this._spin((e > 0 ? 1: -1) * this.options.step, t),
                        clearTimeout(this.mousewheelTimer),
                        this.mousewheelTimer = this._delay(function() {
                            this.spinning && this._stop(t)

                        },
                        100),
                        t.preventDefault()

                    }

                },
                "mousedown .ui-spinner-button": function(e) {
                    function i() {
                        var t = this.element[0] === this.document[0].activeElement;
                        t || (this.element.focus(), this.previous = s, this._delay(function() {
                            this.previous = s

                        }))

                    }
                    var s;
                    s = this.element[0] === this.document[0].activeElement ? this.previous: this.element.val(),
                    e.preventDefault(),
                    i.call(this),
                    this.cancelBlur = !0,
                    this._delay(function() {
                        delete this.cancelBlur,
                        i.call(this)

                    }),
                    this._start(e) !== !1 && this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1: -1, e)

                },
                "mouseup .ui-spinner-button": "_stop",
                "mouseenter .ui-spinner-button": function(e) {
                    return t(e.currentTarget).hasClass("ui-state-active") ? this._start(e) === !1 ? !1: void this._repeat(null, t(e.currentTarget).hasClass("ui-spinner-up") ? 1: -1, e) : void 0

                },
                "mouseleave .ui-spinner-button": "_stop"

            },
            _draw: function() {
                var t = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());
                this.element.attr("role", "spinbutton"),
                this.buttons = t.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"),
                this.buttons.height() > Math.ceil(.5 * t.height()) && t.height() > 0 && t.height(t.height()),
                this.options.disabled && this.disable()

            },
            _keydown: function(e) {
                var i = this.options,
                s = t.ui.keyCode;
                switch (e.keyCode) {
                    case s.UP:
                    return this._repeat(null, 1, e),
                    !0;
                    case s.DOWN:
                    return this._repeat(null, -1, e),
                    !0;
                    case s.PAGE_UP:
                    return this._repeat(null, i.page, e),
                    !0;
                    case s.PAGE_DOWN:
                    return this._repeat(null, -i.page, e),
                    !0

                }
                return ! 1

            },
            _uiSpinnerHtml: function() {
                return "<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>"

            },
            _buttonHtml: function() {
                return "<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon " + this.options.icons.up + "'>&#9650;</span></a><a class='ui-spinner-button ui-spinner-down ui-corner-br'><span class='ui-icon " + this.options.icons.down + "'>&#9660;</span></a>"

            },
            _start: function(t) {
                return this.spinning || this._trigger("start", t) !== !1 ? (this.counter || (this.counter = 1), this.spinning = !0, !0) : !1

            },
            _repeat: function(t, e, i) {
                t = t || 500,
                clearTimeout(this.timer),
                this.timer = this._delay(function() {
                    this._repeat(40, e, i)

                },
                t),
                this._spin(e * this.options.step, i)

            },
            _spin: function(t, e) {
                var i = this.value() || 0;
                this.counter || (this.counter = 1),
                i = this._adjustValue(i + t * this._increment(this.counter)),
                this.spinning && this._trigger("spin", e, {
                    value: i

                }) === !1 || (this._value(i), this.counter++)

            },
            _increment: function(e) {
                var i = this.options.incremental;
                return i ? t.isFunction(i) ? i(e) : Math.floor(e * e * e / 5e4 - e * e / 500 + 17 * e / 200 + 1) : 1

            },
            _precision: function() {
                var t = this._precisionOf(this.options.step);
                return null !== this.options.min && (t = Math.max(t, this._precisionOf(this.options.min))),
                t

            },
            _precisionOf: function(t) {
                var e = "" + t,
                i = e.indexOf(".");
                return - 1 === i ? 0: e.length - i - 1

            },
            _adjustValue: function(t) {
                var e,
                i,
                s = this.options;
                return e = null !== s.min ? s.min: 0,
                i = t - e,
                i = Math.round(i / s.step) * s.step,
                t = e + i,
                t = parseFloat(t.toFixed(this._precision())),
                null !== s.max && t > s.max ? s.max: null !== s.min && s.min > t ? s.min: t

            },
            _stop: function(t) {
                this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", t))

            },
            _setOption: function(t, e) {
                if ("culture" === t || "numberFormat" === t) {
                    var i = this._parse(this.element.val());
                    return this.options[t] = e,
                    void this.element.val(this._format(i))

                } ("max" === t || "min" === t || "step" === t) && "string" == typeof e && (e = this._parse(e)),
                "icons" === t && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(e.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(e.down)),
                this._super(t, e),
                "disabled" === t && (e ? (this.element.prop("disabled", !0), this.buttons.button("disable")) : (this.element.prop("disabled", !1), this.buttons.button("enable")))

            },
            _setOptions: e(function(t) {
                this._super(t),
                this._value(this.element.val())

            }),
            _parse: function(t) {
                return "string" == typeof t && "" !== t && (t = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(t, 10, this.options.culture) : +t),
                "" === t || isNaN(t) ? null: t

            },
            _format: function(t) {
                return "" === t ? "": window.Globalize && this.options.numberFormat ? Globalize.format(t, this.options.numberFormat, this.options.culture) : t

            },
            _refresh: function() {
                this.element.attr({
                    "aria-valuemin": this.options.min,
                    "aria-valuemax": this.options.max,
                    "aria-valuenow": this._parse(this.element.val())

                })

            },
            _value: function(t, e) {
                var i;
                "" !== t && (i = this._parse(t), null !== i && (e || (i = this._adjustValue(i)), t = this._format(i))),
                this.element.val(t),
                this._refresh()

            },
            _destroy: function() {
                this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"),
                this.uiSpinner.replaceWith(this.element)

            },
            stepUp: e(function(t) {
                this._stepUp(t)

            }),
            _stepUp: function(t) {
                this._start() && (this._spin((t || 1) * this.options.step), this._stop())

            },
            stepDown: e(function(t) {
                this._stepDown(t)

            }),
            _stepDown: function(t) {
                this._start() && (this._spin((t || 1) * -this.options.step), this._stop())

            },
            pageUp: e(function(t) {
                this._stepUp((t || 1) * this.options.page)

            }),
            pageDown: e(function(t) {
                this._stepDown((t || 1) * this.options.page)

            }),
            value: function(t) {
                return arguments.length ? void e(this._value).call(this, t) : this._parse(this.element.val())

            },
            widget: function() {
                return this.uiSpinner

            }

        })

    } (jQuery),
    function(t, e) {
        function i() {
            return++n

        }
        function s(t) {
            return t = t.cloneNode(!1),
            t.hash.length > 1 && decodeURIComponent(t.href.replace(a, "")) === decodeURIComponent(location.href.replace(a, ""))

        }
        var n = 0,
        a = /#.*$/;
        t.widget("ui.tabs", {
            version: "1.10.4",
            delay: 300,
            options: {
                active: null,
                collapsible: !1,
                event: "click",
                heightStyle: "content",
                hide: null,
                show: null,
                activate: null,
                beforeActivate: null,
                beforeLoad: null,
                load: null

            },
            _create: function() {
                var e = this,
                i = this.options;
                this.running = !1,
                this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible", i.collapsible).delegate(".ui-tabs-nav > li", "mousedown" + this.eventNamespace, 
                function(e) {
                    t(this).is(".ui-state-disabled") && e.preventDefault()

                }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, 
                function() {
                    t(this).closest("li").is(".ui-state-disabled") && this.blur()

                }),
                this._processTabs(),
                i.active = this._initialActive(),
                t.isArray(i.disabled) && (i.disabled = t.unique(i.disabled.concat(t.map(this.tabs.filter(".ui-state-disabled"), 
                function(t) {
                    return e.tabs.index(t)

                }))).sort()),
                this.active = this.options.active !== !1 && this.anchors.length ? this._findActive(i.active) : t(),
                this._refresh(),
                this.active.length && this.load(i.active)

            },
            _initialActive: function() {
                var i = this.options.active,
                s = this.options.collapsible,
                n = location.hash.substring(1);
                return null === i && (n && this.tabs.each(function(s, a) {
                    return t(a).attr("aria-controls") === n ? (i = s, !1) : e

                }), null === i && (i = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), (null === i || -1 === i) && (i = this.tabs.length ? 0: !1)),
                i !== !1 && (i = this.tabs.index(this.tabs.eq(i)), -1 === i && (i = s ? !1: 0)),
                !s && i === !1 && this.anchors.length && (i = 0),
                i

            },
            _getCreateEventData: function() {
                return {
                    tab: this.active,
                    panel: this.active.length ? this._getPanelForTab(this.active) : t()

                }

            },
            _tabKeydown: function(i) {
                var s = t(this.document[0].activeElement).closest("li"),
                n = this.tabs.index(s),
                a = !0;
                if (!this._handlePageNav(i)) {
                    switch (i.keyCode) {
                        case t.ui.keyCode.RIGHT:
                    case t.ui.keyCode.DOWN:
                        n++;
                        break;
                        case t.ui.keyCode.UP:
                    case t.ui.keyCode.LEFT:
                        a = !1,
                        n--;
                        break;
                        case t.ui.keyCode.END:
                        n = this.anchors.length - 1;
                        break;
                        case t.ui.keyCode.HOME:
                        n = 0;
                        break;
                        case t.ui.keyCode.SPACE:
                        return i.preventDefault(),
                        clearTimeout(this.activating),
                        this._activate(n),
                        e;
                        case t.ui.keyCode.ENTER:
                        return i.preventDefault(),
                        clearTimeout(this.activating),
                        this._activate(n === this.options.active ? !1: n),
                        e;
                        default:
                        return

                    }
                    i.preventDefault(),
                    clearTimeout(this.activating),
                    n = this._focusNextTab(n, a),
                    i.ctrlKey || (s.attr("aria-selected", "false"), this.tabs.eq(n).attr("aria-selected", "true"), this.activating = this._delay(function() {
                        this.option("active", n)

                    },
                    this.delay))

                }

            },
            _panelKeydown: function(e) {
                this._handlePageNav(e) || e.ctrlKey && e.keyCode === t.ui.keyCode.UP && (e.preventDefault(), this.active.focus())

            },
            _handlePageNav: function(i) {
                return i.altKey && i.keyCode === t.ui.keyCode.PAGE_UP ? (this._activate(this._focusNextTab(this.options.active - 1, !1)), !0) : i.altKey && i.keyCode === t.ui.keyCode.PAGE_DOWN ? (this._activate(this._focusNextTab(this.options.active + 1, !0)), !0) : e

            },
            _findNextTab: function(e, i) {
                function s() {
                    return e > n && (e = 0),
                    0 > e && (e = n),
                    e

                }
                for (var n = this.tabs.length - 1; - 1 !== t.inArray(s(), this.options.disabled);) e = i ? e + 1: e - 1;
                return e

            },
            _focusNextTab: function(t, e) {
                return t = this._findNextTab(t, e),
                this.tabs.eq(t).focus(),
                t

            },
            _setOption: function(t, i) {
                return "active" === t ? (this._activate(i), e) : "disabled" === t ? (this._setupDisabled(i), e) : (this._super(t, i), "collapsible" === t && (this.element.toggleClass("ui-tabs-collapsible", i), i || this.options.active !== !1 || this._activate(0)), "event" === t && this._setupEvents(i), "heightStyle" === t && this._setupHeightStyle(i), e)

            },
            _tabId: function(t) {
                return t.attr("aria-controls") || "ui-tabs-" + i()

            },
            _sanitizeSelector: function(t) {
                return t ? t.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g, "\\$&") : ""

            },
            refresh: function() {
                var e = this.options,
                i = this.tablist.children(":has(a[href])");
                e.disabled = t.map(i.filter(".ui-state-disabled"), 
                function(t) {
                    return i.index(t)

                }),
                this._processTabs(),
                e.active !== !1 && this.anchors.length ? this.active.length && !t.contains(this.tablist[0], this.active[0]) ? this.tabs.length === e.disabled.length ? (e.active = !1, this.active = t()) : this._activate(this._findNextTab(Math.max(0, e.active - 1), !1)) : e.active = this.tabs.index(this.active) : (e.active = !1, this.active = t()),
                this._refresh()

            },
            _refresh: function() {
                this._setupDisabled(this.options.disabled),
                this._setupEvents(this.options.event),
                this._setupHeightStyle(this.options.heightStyle),
                this.tabs.not(this.active).attr({
                    "aria-selected": "false",
                    tabIndex: -1

                }),
                this.panels.not(this._getPanelForTab(this.active)).hide().attr({
                    "aria-expanded": "false",
                    "aria-hidden": "true"

                }),
                this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({
                    "aria-selected": "true",
                    tabIndex: 0

                }), this._getPanelForTab(this.active).show().attr({
                    "aria-expanded": "true",
                    "aria-hidden": "false"

                })) : this.tabs.eq(0).attr("tabIndex", 0)

            },
            _processTabs: function() {
                var e = this;
                this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist"),
                this.tabs = this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({
                    role: "tab",
                    tabIndex: -1

                }),
                this.anchors = this.tabs.map(function() {
                    return t("a", this)[0]

                }).addClass("ui-tabs-anchor").attr({
                    role: "presentation",
                    tabIndex: -1

                }),
                this.panels = t(),
                this.anchors.each(function(i, n) {
                    var a,
                    o,
                    r,
                    l = t(n).uniqueId().attr("id"),
                    c = t(n).closest("li"),
                    h = c.attr("aria-controls");
                    s(n) ? (a = n.hash, o = e.element.find(e._sanitizeSelector(a))) : (r = e._tabId(c), a = "#" + r, o = e.element.find(a), o.length || (o = e._createPanel(r), o.insertAfter(e.panels[i - 1] || e.tablist)), o.attr("aria-live", "polite")),
                    o.length && (e.panels = e.panels.add(o)),
                    h && c.data("ui-tabs-aria-controls", h),
                    c.attr({
                        "aria-controls": a.substring(1),
                        "aria-labelledby": l

                    }),
                    o.attr("aria-labelledby", l)

                }),
                this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role", "tabpanel")

            },
            _getList: function() {
                return this.tablist || this.element.find("ol,ul").eq(0)

            },
            _createPanel: function(e) {
                return t("<div>").attr("id", e).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0);

            },
            _setupDisabled: function(e) {
                t.isArray(e) && (e.length ? e.length === this.anchors.length && (e = !0) : e = !1);
                for (var i, s = 0; i = this.tabs[s]; s++) e === !0 || -1 !== t.inArray(s, e) ? t(i).addClass("ui-state-disabled").attr("aria-disabled", "true") : t(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");
                this.options.disabled = e

            },
            _setupEvents: function(e) {
                var i = {
                    click: function(t) {
                        t.preventDefault()

                    }

                };
                e && t.each(e.split(" "), 
                function(t, e) {
                    i[e] = "_eventHandler"

                }),
                this._off(this.anchors.add(this.tabs).add(this.panels)),
                this._on(this.anchors, i),
                this._on(this.tabs, {
                    keydown: "_tabKeydown"

                }),
                this._on(this.panels, {
                    keydown: "_panelKeydown"

                }),
                this._focusable(this.tabs),
                this._hoverable(this.tabs)

            },
            _setupHeightStyle: function(e) {
                var i,
                s = this.element.parent();
                "fill" === e ? (i = s.height(), i -= this.element.outerHeight() - this.element.height(), this.element.siblings(":visible").each(function() {
                    var e = t(this),
                    s = e.css("position");
                    "absolute" !== s && "fixed" !== s && (i -= e.outerHeight(!0))

                }), this.element.children().not(this.panels).each(function() {
                    i -= t(this).outerHeight(!0)

                }), this.panels.each(function() {
                    t(this).height(Math.max(0, i - t(this).innerHeight() + t(this).height()))

                }).css("overflow", "auto")) : "auto" === e && (i = 0, this.panels.each(function() {
                    i = Math.max(i, t(this).height("").height())

                }).height(i))

            },
            _eventHandler: function(e) {
                var i = this.options,
                s = this.active,
                n = t(e.currentTarget),
                a = n.closest("li"),
                o = a[0] === s[0],
                r = o && i.collapsible,
                l = r ? t() : this._getPanelForTab(a),
                c = s.length ? this._getPanelForTab(s) : t(),
                h = {
                    oldTab: s,
                    oldPanel: c,
                    newTab: r ? t() : a,
                    newPanel: l

                };
                e.preventDefault(),
                a.hasClass("ui-state-disabled") || a.hasClass("ui-tabs-loading") || this.running || o && !i.collapsible || this._trigger("beforeActivate", e, h) === !1 || (i.active = r ? !1: this.tabs.index(a), this.active = o ? t() : a, this.xhr && this.xhr.abort(), c.length || l.length || t.error("jQuery UI Tabs: Mismatching fragment identifier."), l.length && this.load(this.tabs.index(a), e), this._toggle(e, h))

            },
            _toggle: function(e, i) {
                function s() {
                    a.running = !1,
                    a._trigger("activate", e, i)

                }
                function n() {
                    i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"),
                    o.length && a.options.show ? a._show(o, a.options.show, s) : (o.show(), s())

                }
                var a = this,
                o = i.newPanel,
                r = i.oldPanel;
                this.running = !0,
                r.length && this.options.hide ? this._hide(r, this.options.hide, 
                function() {
                    i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),
                    n()

                }) : (i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"), r.hide(), n()),
                r.attr({
                    "aria-expanded": "false",
                    "aria-hidden": "true"

                }),
                i.oldTab.attr("aria-selected", "false"),
                o.length && r.length ? i.oldTab.attr("tabIndex", -1) : o.length && this.tabs.filter(function() {
                    return 0 === t(this).attr("tabIndex")

                }).attr("tabIndex", -1),
                o.attr({
                    "aria-expanded": "true",
                    "aria-hidden": "false"

                }),
                i.newTab.attr({
                    "aria-selected": "true",
                    tabIndex: 0

                })

            },
            _activate: function(e) {
                var i,
                s = this._findActive(e);
                s[0] !== this.active[0] && (s.length || (s = this.active), i = s.find(".ui-tabs-anchor")[0], this._eventHandler({
                    target: i,
                    currentTarget: i,
                    preventDefault: t.noop

                }))

            },
            _findActive: function(e) {
                return e === !1 ? t() : this.tabs.eq(e)

            },
            _getIndex: function(t) {
                return "string" == typeof t && (t = this.anchors.index(this.anchors.filter("[href$='" + t + "']"))),
                t

            },
            _destroy: function() {
                this.xhr && this.xhr.abort(),
                this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"),
                this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"),
                this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(),
                this.tabs.add(this.panels).each(function() {
                    t.data(this, "ui-tabs-destroy") ? t(this).remove() : t(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")

                }),
                this.tabs.each(function() {
                    var e = t(this),
                    i = e.data("ui-tabs-aria-controls");
                    i ? e.attr("aria-controls", i).removeData("ui-tabs-aria-controls") : e.removeAttr("aria-controls")

                }),
                this.panels.show(),
                "content" !== this.options.heightStyle && this.panels.css("height", "")

            },
            enable: function(i) {
                var s = this.options.disabled;
                s !== !1 && (i === e ? s = !1: (i = this._getIndex(i), s = t.isArray(s) ? t.map(s, 
                function(t) {
                    return t !== i ? t: null

                }) : t.map(this.tabs, 
                function(t, e) {
                    return e !== i ? e: null

                })), this._setupDisabled(s))

            },
            disable: function(i) {
                var s = this.options.disabled;
                if (s !== !0) {
                    if (i === e) s = !0;
                    else {
                        if (i = this._getIndex(i), -1 !== t.inArray(i, s)) return;
                        s = t.isArray(s) ? t.merge([i], s).sort() : [i]

                    }
                    this._setupDisabled(s)

                }

            },
            load: function(e, i) {
                e = this._getIndex(e);
                var n = this,
                a = this.tabs.eq(e),
                o = a.find(".ui-tabs-anchor"),
                r = this._getPanelForTab(a),
                l = {
                    tab: a,
                    panel: r

                };
                s(o[0]) || (this.xhr = t.ajax(this._ajaxSettings(o, i, l)), this.xhr && "canceled" !== this.xhr.statusText && (a.addClass("ui-tabs-loading"), r.attr("aria-busy", "true"), this.xhr.success(function(t) {
                    setTimeout(function() {
                        r.html(t),
                        n._trigger("load", i, l)

                    },
                    1)

                }).complete(function(t, e) {
                    setTimeout(function() {
                        "abort" === e && n.panels.stop(!1, !0),
                        a.removeClass("ui-tabs-loading"),
                        r.removeAttr("aria-busy"),
                        t === n.xhr && delete n.xhr

                    },
                    1)

                })))

            },
            _ajaxSettings: function(e, i, s) {
                var n = this;
                return {
                    url: e.attr("href"),
                    beforeSend: function(e, a) {
                        return n._trigger("beforeLoad", i, t.extend({
                            jqXHR: e,
                            ajaxSettings: a

                        },
                        s))

                    }

                }

            },
            _getPanelForTab: function(e) {
                var i = t(e).attr("aria-controls");
                return this.element.find(this._sanitizeSelector("#" + i))

            }

        })

    } (jQuery),
    function(t) {
        function e(e, i) {
            var s = (e.attr("aria-describedby") || "").split(/\s+/);
            s.push(i),
            e.data("ui-tooltip-id", i).attr("aria-describedby", t.trim(s.join(" ")))

        }
        function i(e) {
            var i = e.data("ui-tooltip-id"),
            s = (e.attr("aria-describedby") || "").split(/\s+/),
            n = t.inArray(i, s); - 1 !== n && s.splice(n, 1),
            e.removeData("ui-tooltip-id"),
            s = t.trim(s.join(" ")),
            s ? e.attr("aria-describedby", s) : e.removeAttr("aria-describedby")

        }
        var s = 0;
        t.widget("ui.tooltip", {
            version: "1.10.4",
            options: {
                content: function() {
                    var e = t(this).attr("title") || "";
                    return t("<a>").text(e).html()

                },
                hide: !0,
                items: "[title]:not([disabled])",
                position: {
                    my: "left top+15",
                    at: "left bottom",
                    collision: "flipfit flip"

                },
                show: !0,
                tooltipClass: null,
                track: !1,
                close: null,
                open: null

            },
            _create: function() {
                this._on({
                    mouseover: "open",
                    focusin: "open"

                }),
                this.tooltips = {},
                this.parents = {},
                this.options.disabled && this._disable()

            },
            _setOption: function(e, i) {
                var s = this;
                return "disabled" === e ? (this[i ? "_disable": "_enable"](), void(this.options[e] = i)) : (this._super(e, i), void("content" === e && t.each(this.tooltips, 
                function(t, e) {
                    s._updateContent(e)

                })))

            },
            _disable: function() {
                var e = this;
                t.each(this.tooltips, 
                function(i, s) {
                    var n = t.Event("blur");
                    n.target = n.currentTarget = s[0],
                    e.close(n, !0)

                }),
                this.element.find(this.options.items).addBack().each(function() {
                    var e = t(this);
                    e.is("[title]") && e.data("ui-tooltip-title", e.attr("title")).attr("title", "")

                })

            },
            _enable: function() {
                this.element.find(this.options.items).addBack().each(function() {
                    var e = t(this);
                    e.data("ui-tooltip-title") && e.attr("title", e.data("ui-tooltip-title"))

                })

            },
            open: function(e) {
                var i = this,
                s = t(e ? e.target: this.element).closest(this.options.items);
                s.length && !s.data("ui-tooltip-id") && (s.attr("title") && s.data("ui-tooltip-title", s.attr("title")), s.data("ui-tooltip-open", !0), e && "mouseover" === e.type && s.parents().each(function() {
                    var e,
                    s = t(this);
                    s.data("ui-tooltip-open") && (e = t.Event("blur"), e.target = e.currentTarget = this, i.close(e, !0)),
                    s.attr("title") && (s.uniqueId(), i.parents[this.id] = {
                        element: this,
                        title: s.attr("title")

                    },
                    s.attr("title", ""))

                }), this._updateContent(s, e))

            },
            _updateContent: function(t, e) {
                var i,
                s = this.options.content,
                n = this,
                a = e ? e.type: null;
                return "string" == typeof s ? this._open(e, t, s) : (i = s.call(t[0], 
                function(i) {
                    t.data("ui-tooltip-open") && n._delay(function() {
                        e && (e.type = a),
                        this._open(e, t, i)

                    })

                }), void(i && this._open(e, t, i)))

            },
            _open: function(i, s, n) {
                function a(t) {
                    c.of = t,
                    o.is(":hidden") || o.position(c)

                }
                var o,
                r,
                l,
                c = t.extend({},
                this.options.position);
                if (n) {
                    if (o = this._find(s), o.length) return void o.find(".ui-tooltip-content").html(n);
                    s.is("[title]") && (i && "mouseover" === i.type ? s.attr("title", "") : s.removeAttr("title")),
                    o = this._tooltip(s),
                    e(s, o.attr("id")),
                    o.find(".ui-tooltip-content").html(n),
                    this.options.track && i && /^mouse/.test(i.type) ? (this._on(this.document, {
                        mousemove: a

                    }), a(i)) : o.position(t.extend({
                        of: s

                    },
                    this.options.position)),
                    o.hide(),
                    this._show(o, this.options.show),
                    this.options.show && this.options.show.delay && (l = this.delayedShow = setInterval(function() {
                        o.is(":visible") && (a(c.of), clearInterval(l))

                    },
                    t.fx.interval)),
                    this._trigger("open", i, {
                        tooltip: o

                    }),
                    r = {
                        keyup: function(e) {
                            if (e.keyCode === t.ui.keyCode.ESCAPE) {
                                var i = t.Event(e);
                                i.currentTarget = s[0],
                                this.close(i, !0)

                            }

                        },
                        remove: function() {
                            this._removeTooltip(o)

                        }

                    },
                    i && "mouseover" !== i.type || (r.mouseleave = "close"),
                    i && "focusin" !== i.type || (r.focusout = "close"),
                    this._on(!0, s, r)

                }

            },
            close: function(e) {
                var s = this,
                n = t(e ? e.currentTarget: this.element),
                a = this._find(n);
                this.closing || (clearInterval(this.delayedShow), n.data("ui-tooltip-title") && n.attr("title", n.data("ui-tooltip-title")), i(n), a.stop(!0), this._hide(a, this.options.hide, 
                function() {
                    s._removeTooltip(t(this))

                }), n.removeData("ui-tooltip-open"), this._off(n, "mouseleave focusout keyup"), n[0] !== this.element[0] && this._off(n, "remove"), this._off(this.document, "mousemove"), e && "mouseleave" === e.type && t.each(this.parents, 
                function(e, i) {
                    t(i.element).attr("title", i.title),
                    delete s.parents[e]

                }), this.closing = !0, this._trigger("close", e, {
                    tooltip: a

                }), this.closing = !1)

            },
            _tooltip: function(e) {
                var i = "ui-tooltip-" + s++,
                n = t("<div>").attr({
                    id: i,
                    role: "tooltip"

                }).addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || ""));
                return t("<div>").addClass("ui-tooltip-content").appendTo(n),
                n.appendTo(this.document[0].body),
                this.tooltips[i] = e,
                n

            },
            _find: function(e) {
                var i = e.data("ui-tooltip-id");
                return i ? t("#" + i) : t()

            },
            _removeTooltip: function(t) {
                t.remove(),
                delete this.tooltips[t.attr("id")]

            },
            _destroy: function() {
                var e = this;
                t.each(this.tooltips, 
                function(i, s) {
                    var n = t.Event("blur");
                    n.target = n.currentTarget = s[0],
                    e.close(n, !0),
                    t("#" + i).remove(),
                    s.data("ui-tooltip-title") && (s.attr("title", s.data("ui-tooltip-title")), s.removeData("ui-tooltip-title"))

                })

            }

        })

    } (jQuery),
    function(t, e) {
        var i = "ui-effects-";
        t.effects = {
            effect: {}

        },
        function(t, e) {
            function i(t, e, i) {
                var s = u[e.type] || {};
                return null == t ? i || !e.def ? null: e.def: (t = s.floor ? ~~t: parseFloat(t), isNaN(t) ? e.def: s.mod ? (t + s.mod) % s.mod: 0 > t ? 0: t > s.max ? s.max: t)

            }
            function s(i) {
                var s = c(),
                n = s._rgba = [];
                return i = i.toLowerCase(),
                f(l, 
                function(t, a) {
                    var o,
                    r = a.re.exec(i),
                    l = r && a.parse(r),
                    c = a.space || "rgba";
                    return l ? (o = s[c](l), s[h[c].cache] = o[h[c].cache], n = s._rgba = o._rgba, !1) : e

                }),
                n.length ? ("0,0,0,0" === n.join() && t.extend(n, a.transparent), s) : a[i]

            }
            function n(t, e, i) {
                return i = (i + 1) % 1,
                1 > 6 * i ? t + 6 * (e - t) * i: 1 > 2 * i ? e: 2 > 3 * i ? t + 6 * (e - t) * (2 / 3 - i) : t

            }
            var a,
            o = "backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",
            r = /^([\-+])=\s*(\d+\.?\d*)/,
            l = [{
                re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                parse: function(t) {
                    return [t[1], t[2], t[3], t[4]]

                }

            },
            {
                re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                parse: function(t) {
                    return [2.55 * t[1], 2.55 * t[2], 2.55 * t[3], t[4]]

                }

            },
            {
                re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,
                parse: function(t) {
                    return [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)]

                }

            },
            {
                re: /#([a-f0-9])([a-f0-9])([a-f0-9])/,
                parse: function(t) {
                    return [parseInt(t[1] + t[1], 16), parseInt(t[2] + t[2], 16), parseInt(t[3] + t[3], 16)]

                }

            },
            {
                re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,
                space: "hsla",
                parse: function(t) {
                    return [t[1], t[2] / 100, t[3] / 100, t[4]]

                }

            }],
            c = t.Color = function(e, i, s, n) {
                return new t.Color.fn.parse(e, i, s, n)

            },
            h = {
                rgba: {
                    props: {
                        red: {
                            idx: 0,
                            type: "byte"

                        },
                        green: {
                            idx: 1,
                            type: "byte"

                        },
                        blue: {
                            idx: 2,
                            type: "byte"

                        }

                    }

                },
                hsla: {
                    props: {
                        hue: {
                            idx: 0,
                            type: "degrees"

                        },
                        saturation: {
                            idx: 1,
                            type: "percent"

                        },
                        lightness: {
                            idx: 2,
                            type: "percent"

                        }

                    }

                }

            },
            u = {
                "byte": {
                    floor: !0,
                    max: 255

                },
                percent: {
                    max: 1

                },
                degrees: {
                    mod: 360,
                    floor: !0

                }

            },
            d = c.support = {},
            p = t("<p>")[0],
            f = t.each;
            p.style.cssText = "background-color:rgba(1,1,1,.5)",
            d.rgba = p.style.backgroundColor.indexOf("rgba") > -1,
            f(h, 
            function(t, e) {
                e.cache = "_" + t,
                e.props.alpha = {
                    idx: 3,
                    type: "percent",
                    def: 1

                }

            }),
            c.fn = t.extend(c.prototype, {
                parse: function(n, o, r, l) {
                    if (n === e) return this._rgba = [null, null, null, null],
                    this;
                    (n.jquery || n.nodeType) && (n = t(n).css(o), o = e);
                    var u = this,
                    d = t.type(n),
                    p = this._rgba = [];
                    return o !== e && (n = [n, o, r, l], d = "array"),
                    "string" === d ? this.parse(s(n) || a._default) : "array" === d ? (f(h.rgba.props, 
                    function(t, e) {
                        p[e.idx] = i(n[e.idx], e)

                    }), this) : "object" === d ? (n instanceof c ? f(h, 
                    function(t, e) {
                        n[e.cache] && (u[e.cache] = n[e.cache].slice())

                    }) : f(h, 
                    function(e, s) {
                        var a = s.cache;
                        f(s.props, 
                        function(t, e) {
                            if (!u[a] && s.to) {
                                if ("alpha" === t || null == n[t]) return;
                                u[a] = s.to(u._rgba)

                            }
                            u[a][e.idx] = i(n[t], e, !0)

                        }),
                        u[a] && 0 > t.inArray(null, u[a].slice(0, 3)) && (u[a][3] = 1, s.from && (u._rgba = s.from(u[a])))

                    }), this) : e

                },
                is: function(t) {
                    var i = c(t),
                    s = !0,
                    n = this;
                    return f(h, 
                    function(t, a) {
                        var o,
                        r = i[a.cache];
                        return r && (o = n[a.cache] || a.to && a.to(n._rgba) || [], f(a.props, 
                        function(t, i) {
                            return null != r[i.idx] ? s = r[i.idx] === o[i.idx] : e

                        })),
                        s

                    }),
                    s

                },
                _space: function() {
                    var t = [],
                    e = this;
                    return f(h, 
                    function(i, s) {
                        e[s.cache] && t.push(i)

                    }),
                    t.pop()

                },
                transition: function(t, e) {
                    var s = c(t),
                    n = s._space(),
                    a = h[n],
                    o = 0 === this.alpha() ? c("transparent") : this,
                    r = o[a.cache] || a.to(o._rgba),
                    l = r.slice();
                    return s = s[a.cache],
                    f(a.props, 
                    function(t, n) {
                        var a = n.idx,
                        o = r[a],
                        c = s[a],
                        h = u[n.type] || {};
                        null !== c && (null === o ? l[a] = c: (h.mod && (c - o > h.mod / 2 ? o += h.mod: o - c > h.mod / 2 && (o -= h.mod)), l[a] = i((c - o) * e + o, n)))

                    }),
                    this[n](l)

                },
                blend: function(e) {
                    if (1 === this._rgba[3]) return this;
                    var i = this._rgba.slice(),
                    s = i.pop(),
                    n = c(e)._rgba;
                    return c(t.map(i, 
                    function(t, e) {
                        return (1 - s) * n[e] + s * t

                    }))

                },
                toRgbaString: function() {
                    var e = "rgba(",
                    i = t.map(this._rgba, 
                    function(t, e) {
                        return null == t ? e > 2 ? 1: 0: t

                    });
                    return 1 === i[3] && (i.pop(), e = "rgb("),
                    e + i.join() + ")"

                },
                toHslaString: function() {
                    var e = "hsla(",
                    i = t.map(this.hsla(), 
                    function(t, e) {
                        return null == t && (t = e > 2 ? 1: 0),
                        e && 3 > e && (t = Math.round(100 * t) + "%"),
                        t

                    });
                    return 1 === i[3] && (i.pop(), e = "hsl("),
                    e + i.join() + ")"

                },
                toHexString: function(e) {
                    var i = this._rgba.slice(),
                    s = i.pop();
                    return e && i.push(~~ (255 * s)),
                    "#" + t.map(i, 
                    function(t) {
                        return t = (t || 0).toString(16),
                        1 === t.length ? "0" + t: t

                    }).join("")

                },
                toString: function() {
                    return 0 === this._rgba[3] ? "transparent": this.toRgbaString()

                }

            }),
            c.fn.parse.prototype = c.fn,
            h.hsla.to = function(t) {
                if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
                var e,
                i,
                s = t[0] / 255,
                n = t[1] / 255,
                a = t[2] / 255,
                o = t[3],
                r = Math.max(s, n, a),
                l = Math.min(s, n, a),
                c = r - l,
                h = r + l,
                u = .5 * h;
                return e = l === r ? 0: s === r ? 60 * (n - a) / c + 360: n === r ? 60 * (a - s) / c + 120: 60 * (s - n) / c + 240,
                i = 0 === c ? 0: .5 >= u ? c / h: c / (2 - h),
                [Math.round(e) % 360, i, u, null == o ? 1: o]

            },
            h.hsla.from = function(t) {
                if (null == t[0] || null == t[1] || null == t[2]) return [null, null, null, t[3]];
                var e = t[0] / 360,
                i = t[1],
                s = t[2],
                a = t[3],
                o = .5 >= s ? s * (1 + i) : s + i - s * i,
                r = 2 * s - o;
                return [Math.round(255 * n(r, o, e + 1 / 3)), Math.round(255 * n(r, o, e)), Math.round(255 * n(r, o, e - 1 / 3)), a]

            },
            f(h, 
            function(s, n) {
                var a = n.props,
                o = n.cache,
                l = n.to,
                h = n.from;
                c.fn[s] = function(s) {
                    if (l && !this[o] && (this[o] = l(this._rgba)), s === e) return this[o].slice();
                    var n,
                    r = t.type(s),
                    u = "array" === r || "object" === r ? s: arguments,
                    d = this[o].slice();
                    return f(a, 
                    function(t, e) {
                        var s = u["object" === r ? t: e.idx];
                        null == s && (s = d[e.idx]),
                        d[e.idx] = i(s, e)

                    }),
                    h ? (n = c(h(d)), n[o] = d, n) : c(d)

                },
                f(a, 
                function(e, i) {
                    c.fn[e] || (c.fn[e] = function(n) {
                        var a,
                        o = t.type(n),
                        l = "alpha" === e ? this._hsla ? "hsla": "rgba": s,
                        c = this[l](),
                        h = c[i.idx];
                        return "undefined" === o ? h: ("function" === o && (n = n.call(this, h), o = t.type(n)), null == n && i.empty ? this: ("string" === o && (a = r.exec(n), a && (n = h + parseFloat(a[2]) * ("+" === a[1] ? 1: -1))), c[i.idx] = n, this[l](c)))

                    })

                })

            }),
            c.hook = function(e) {
                var i = e.split(" ");
                f(i, 
                function(e, i) {
                    t.cssHooks[i] = {
                        set: function(e, n) {
                            var a,
                            o,
                            r = "";
                            if ("transparent" !== n && ("string" !== t.type(n) || (a = s(n)))) {
                                if (n = c(a || n), !d.rgba && 1 !== n._rgba[3]) {
                                    for (o = "backgroundColor" === i ? e.parentNode: e;
                                    ("" === r || "transparent" === r) && o && o.style;) try {
                                        r = t.css(o, "backgroundColor"),
                                        o = o.parentNode

                                    } catch(l) {}
                                    n = n.blend(r && "transparent" !== r ? r: "_default")

                                }
                                n = n.toRgbaString()

                            }
                            try {
                                e.style[i] = n

                            } catch(l) {}

                        }

                    },
                    t.fx.step[i] = function(e) {
                        e.colorInit || (e.start = c(e.elem, i), e.end = c(e.end), e.colorInit = !0),
                        t.cssHooks[i].set(e.elem, e.start.transition(e.end, e.pos))

                    }

                })

            },
            c.hook(o),
            t.cssHooks.borderColor = {
                expand: function(t) {
                    var e = {};
                    return f(["Top", "Right", "Bottom", "Left"], 
                    function(i, s) {
                        e["border" + s + "Color"] = t

                    }),
                    e

                }

            },
            a = t.Color.names = {
                aqua: "#00ffff",
                black: "#000000",
                blue: "#0000ff",
                fuchsia: "#ff00ff",
                gray: "#808080",
                green: "#008000",
                lime: "#00ff00",
                maroon: "#800000",
                navy: "#000080",
                olive: "#808000",
                purple: "#800080",
                red: "#ff0000",
                silver: "#c0c0c0",
                teal: "#008080",
                white: "#ffffff",
                yellow: "#ffff00",
                transparent: [null, null, null, 0],
                _default: "#ffffff"

            }

        } (jQuery),
        function() {
            function i(e) {
                var i,
                s,
                n = e.ownerDocument.defaultView ? e.ownerDocument.defaultView.getComputedStyle(e, null) : e.currentStyle,
                a = {};
                if (n && n.length && n[0] && n[n[0]]) for (s = n.length; s--;) i = n[s],
                "string" == typeof n[i] && (a[t.camelCase(i)] = n[i]);
                else for (i in n)"string" == typeof n[i] && (a[i] = n[i]);
                return a

            }
            function s(e, i) {
                var s,
                n,
                o = {};
                for (s in i) n = i[s],
                e[s] !== n && (a[s] || (t.fx.step[s] || !isNaN(parseFloat(n))) && (o[s] = n));
                return o

            }
            var n = ["add", "remove", "toggle"],
            a = {
                border: 1,
                borderBottom: 1,
                borderColor: 1,
                borderLeft: 1,
                borderRight: 1,
                borderTop: 1,
                borderWidth: 1,
                margin: 1,
                padding: 1

            };
            t.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], 
            function(e, i) {
                t.fx.step[i] = function(t) {
                    ("none" !== t.end && !t.setAttr || 1 === t.pos && !t.setAttr) && (jQuery.style(t.elem, i, t.end), t.setAttr = !0)

                }

            }),
            t.fn.addBack || (t.fn.addBack = function(t) {
                return this.add(null == t ? this.prevObject: this.prevObject.filter(t))

            }),
            t.effects.animateClass = function(e, a, o, r) {
                var l = t.speed(a, o, r);
                return this.queue(function() {
                    var a,
                    o = t(this),
                    r = o.attr("class") || "",
                    c = l.children ? o.find("*").addBack() : o;
                    c = c.map(function() {
                        var e = t(this);
                        return {
                            el: e,
                            start: i(this)

                        }

                    }),
                    a = function() {
                        t.each(n, 
                        function(t, i) {
                            e[i] && o[i + "Class"](e[i])

                        })

                    },
                    a(),
                    c = c.map(function() {
                        return this.end = i(this.el[0]),
                        this.diff = s(this.start, this.end),
                        this

                    }),
                    o.attr("class", r),
                    c = c.map(function() {
                        var e = this,
                        i = t.Deferred(),
                        s = t.extend({},
                        l, {
                            queue: !1,
                            complete: function() {
                                i.resolve(e)

                            }

                        });
                        return this.el.animate(this.diff, s),
                        i.promise()

                    }),
                    t.when.apply(t, c.get()).done(function() {
                        a(),
                        t.each(arguments, 
                        function() {
                            var e = this.el;
                            t.each(this.diff, 
                            function(t) {
                                e.css(t, "")

                            })

                        }),
                        l.complete.call(o[0])

                    })

                })

            },
            t.fn.extend({
                addClass: function(e) {
                    return function(i, s, n, a) {
                        return s ? t.effects.animateClass.call(this, {
                            add: i

                        },
                        s, n, a) : e.apply(this, arguments)

                    }

                } (t.fn.addClass),
                removeClass: function(e) {
                    return function(i, s, n, a) {
                        return arguments.length > 1 ? t.effects.animateClass.call(this, {
                            remove: i

                        },
                        s, n, a) : e.apply(this, arguments)

                    }

                } (t.fn.removeClass),
                toggleClass: function(i) {
                    return function(s, n, a, o, r) {
                        return "boolean" == typeof n || n === e ? a ? t.effects.animateClass.call(this, n ? {
                            add: s

                        }: {
                            remove: s

                        },
                        a, o, r) : i.apply(this, arguments) : t.effects.animateClass.call(this, {
                            toggle: s

                        },
                        n, a, o)

                    }

                } (t.fn.toggleClass),
                switchClass: function(e, i, s, n, a) {
                    return t.effects.animateClass.call(this, {
                        add: i,
                        remove: e

                    },
                    s, n, a)

                }

            })

        } (),
        function() {
            function s(e, i, s, n) {
                return t.isPlainObject(e) && (i = e, e = e.effect),
                e = {
                    effect: e

                },
                null == i && (i = {}),
                t.isFunction(i) && (n = i, s = null, i = {}),
                ("number" == typeof i || t.fx.speeds[i]) && (n = s, s = i, i = {}),
                t.isFunction(s) && (n = s, s = null),
                i && t.extend(e, i),
                s = s || i.duration,
                e.duration = t.fx.off ? 0: "number" == typeof s ? s: s in t.fx.speeds ? t.fx.speeds[s] : t.fx.speeds._default,
                e.complete = n || i.complete,
                e

            }
            function n(e) {
                return ! e || "number" == typeof e || t.fx.speeds[e] ? !0: "string" != typeof e || t.effects.effect[e] ? t.isFunction(e) ? !0: "object" != typeof e || e.effect ? !1: !0: !0

            }
            t.extend(t.effects, {
                version: "1.10.4",
                save: function(t, e) {
                    for (var s = 0; e.length > s; s++) null !== e[s] && t.data(i + e[s], t[0].style[e[s]])

                },
                restore: function(t, s) {
                    var n,
                    a;
                    for (a = 0; s.length > a; a++) null !== s[a] && (n = t.data(i + s[a]), n === e && (n = ""), t.css(s[a], n))

                },
                setMode: function(t, e) {
                    return "toggle" === e && (e = t.is(":hidden") ? "show": "hide"),
                    e

                },
                getBaseline: function(t, e) {
                    var i,
                    s;
                    switch (t[0]) {
                        case "top":
                        i = 0;
                        break;
                        case "middle":
                        i = .5;
                        break;
                        case "bottom":
                        i = 1;
                        break;
                        default:
                        i = t[0] / e.height

                    }
                    switch (t[1]) {
                        case "left":
                        s = 0;
                        break;
                        case "center":
                        s = .5;
                        break;
                        case "right":
                        s = 1;
                        break;
                        default:
                        s = t[1] / e.width

                    }
                    return {
                        x: s,
                        y: i

                    }

                },
                createWrapper: function(e) {
                    if (e.parent().is(".ui-effects-wrapper")) return e.parent();
                    var i = {
                        width: e.outerWidth(!0),
                        height: e.outerHeight(!0),
                        "float": e.css("float")

                    },
                    s = t("<div></div>").addClass("ui-effects-wrapper").css({
                        fontSize: "100%",
                        background: "transparent",
                        border: "none",
                        margin: 0,
                        padding: 0

                    }),
                    n = {
                        width: e.width(),
                        height: e.height()

                    },
                    a = document.activeElement;
                    try {
                        a.id

                    } catch(o) {
                        a = document.body

                    }
                    return e.wrap(s),
                    (e[0] === a || t.contains(e[0], a)) && t(a).focus(),
                    s = e.parent(),
                    "static" === e.css("position") ? (s.css({
                        position: "relative"

                    }), e.css({
                        position: "relative"

                    })) : (t.extend(i, {
                        position: e.css("position"),
                        zIndex: e.css("z-index")

                    }), t.each(["top", "left", "bottom", "right"], 
                    function(t, s) {
                        i[s] = e.css(s),
                        isNaN(parseInt(i[s], 10)) && (i[s] = "auto")

                    }), e.css({
                        position: "relative",
                        top: 0,
                        left: 0,
                        right: "auto",
                        bottom: "auto"

                    })),
                    e.css(n),
                    s.css(i).show()

                },
                removeWrapper: function(e) {
                    var i = document.activeElement;
                    return e.parent().is(".ui-effects-wrapper") && (e.parent().replaceWith(e), (e[0] === i || t.contains(e[0], i)) && t(i).focus()),
                    e

                },
                setTransition: function(e, i, s, n) {
                    return n = n || {},
                    t.each(i, 
                    function(t, i) {
                        var a = e.cssUnit(i);
                        a[0] > 0 && (n[i] = a[0] * s + a[1])

                    }),
                    n

                }

            }),
            t.fn.extend({
                effect: function() {
                    function e(e) {
                        function s() {
                            t.isFunction(a) && a.call(n[0]),
                            t.isFunction(e) && e()

                        }
                        var n = t(this),
                        a = i.complete,
                        r = i.mode;
                        (n.is(":hidden") ? "hide" === r: "show" === r) ? (n[r](), s()) : o.call(n[0], i, s)

                    }
                    var i = s.apply(this, arguments),
                    n = i.mode,
                    a = i.queue,
                    o = t.effects.effect[i.effect];
                    return t.fx.off || !o ? n ? this[n](i.duration, i.complete) : this.each(function() {
                        i.complete && i.complete.call(this)

                    }) : a === !1 ? this.each(e) : this.queue(a || "fx", e)

                },
                show: function(t) {
                    return function(e) {
                        if (n(e)) return t.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "show",
                        this.effect.call(this, i)

                    }

                } (t.fn.show),
                hide: function(t) {
                    return function(e) {
                        if (n(e)) return t.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "hide",
                        this.effect.call(this, i)

                    }

                } (t.fn.hide),
                toggle: function(t) {
                    return function(e) {
                        if (n(e) || "boolean" == typeof e) return t.apply(this, arguments);
                        var i = s.apply(this, arguments);
                        return i.mode = "toggle",
                        this.effect.call(this, i)

                    }

                } (t.fn.toggle),
                cssUnit: function(e) {
                    var i = this.css(e),
                    s = [];
                    return t.each(["em", "px", "%", "pt"], 
                    function(t, e) {
                        i.indexOf(e) > 0 && (s = [parseFloat(i), e])

                    }),
                    s

                }

            })

        } (),
        function() {
            var e = {};
            t.each(["Quad", "Cubic", "Quart", "Quint", "Expo"], 
            function(t, i) {
                e[i] = function(e) {
                    return Math.pow(e, t + 2)

                }

            }),
            t.extend(e, {
                Sine: function(t) {
                    return 1 - Math.cos(t * Math.PI / 2)

                },
                Circ: function(t) {
                    return 1 - Math.sqrt(1 - t * t)

                },
                Elastic: function(t) {
                    return 0 === t || 1 === t ? t: -Math.pow(2, 8 * (t - 1)) * Math.sin((80 * (t - 1) - 7.5) * Math.PI / 15)

                },
                Back: function(t) {
                    return t * t * (3 * t - 2)

                },
                Bounce: function(t) {
                    for (var e, i = 4;
                    ((e = Math.pow(2, --i)) - 1) / 11 > t;);
                    return 1 / Math.pow(4, 3 - i) - 7.5625 * Math.pow((3 * e - 2) / 22 - t, 2)

                }

            }),
            t.each(e, 
            function(e, i) {
                t.easing["easeIn" + e] = i,
                t.easing["easeOut" + e] = function(t) {
                    return 1 - i(1 - t)

                },
                t.easing["easeInOut" + e] = function(t) {
                    return.5 > t ? i(2 * t) / 2: 1 - i( - 2 * t + 2) / 2

                }

            })

        } ()

    } (jQuery),
    function(t) {
        var e = /up|down|vertical/,
        i = /up|left|vertical|horizontal/;
        t.effects.effect.blind = function(s, n) {
            var a,
            o,
            r,
            l = t(this),
            c = ["position", "top", "bottom", "left", "right", "height", "width"],
            h = t.effects.setMode(l, s.mode || "hide"),
            u = s.direction || "up",
            d = e.test(u),
            p = d ? "height": "width",
            f = d ? "top": "left",
            g = i.test(u),
            m = {},
            _ = "show" === h;
            l.parent().is(".ui-effects-wrapper") ? t.effects.save(l.parent(), c) : t.effects.save(l, c),
            l.show(),
            a = t.effects.createWrapper(l).css({
                overflow: "hidden"

            }),
            o = a[p](),
            r = parseFloat(a.css(f)) || 0,
            m[p] = _ ? o: 0,
            g || (l.css(d ? "bottom": "right", 0).css(d ? "top": "left", "auto").css({
                position: "absolute"

            }), m[f] = _ ? r: o + r),
            _ && (a.css(p, 0), g || a.css(f, r + o)),
            a.animate(m, {
                duration: s.duration,
                easing: s.easing,
                queue: !1,
                complete: function() {
                    "hide" === h && l.hide(),
                    t.effects.restore(l, c),
                    t.effects.removeWrapper(l),
                    n()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.bounce = function(e, i) {
            var s,
            n,
            a,
            o = t(this),
            r = ["position", "top", "bottom", "left", "right", "height", "width"],
            l = t.effects.setMode(o, e.mode || "effect"),
            c = "hide" === l,
            h = "show" === l,
            u = e.direction || "up",
            d = e.distance,
            p = e.times || 5,
            f = 2 * p + (h || c ? 1: 0),
            g = e.duration / f,
            m = e.easing,
            _ = "up" === u || "down" === u ? "top": "left",
            b = "up" === u || "left" === u,
            v = o.queue(),
            y = v.length;
            for ((h || c) && r.push("opacity"), t.effects.save(o, r), o.show(), t.effects.createWrapper(o), d || (d = o["top" === _ ? "outerHeight": "outerWidth"]() / 3), h && (a = {
                opacity: 1

            },
            a[_] = 0, o.css("opacity", 0).css(_, b ? 2 * -d: 2 * d).animate(a, g, m)), c && (d /= Math.pow(2, p - 1)), a = {},
            a[_] = 0, s = 0; p > s; s++) n = {},
            n[_] = (b ? "-=": "+=") + d,
            o.animate(n, g, m).animate(a, g, m),
            d = c ? 2 * d: d / 2;
            c && (n = {
                opacity: 0

            },
            n[_] = (b ? "-=": "+=") + d, o.animate(n, g, m)),
            o.queue(function() {
                c && o.hide(),
                t.effects.restore(o, r),
                t.effects.removeWrapper(o),
                i()

            }),
            y > 1 && v.splice.apply(v, [1, 0].concat(v.splice(y, f + 1))),
            o.dequeue()

        }

    } (jQuery),
    function(t) {
        t.effects.effect.clip = function(e, i) {
            var s,
            n,
            a,
            o = t(this),
            r = ["position", "top", "bottom", "left", "right", "height", "width"],
            l = t.effects.setMode(o, e.mode || "hide"),
            c = "show" === l,
            h = e.direction || "vertical",
            u = "vertical" === h,
            d = u ? "height": "width",
            p = u ? "top": "left",
            f = {};
            t.effects.save(o, r),
            o.show(),
            s = t.effects.createWrapper(o).css({
                overflow: "hidden"

            }),
            n = "IMG" === o[0].tagName ? s: o,
            a = n[d](),
            c && (n.css(d, 0), n.css(p, a / 2)),
            f[d] = c ? a: 0,
            f[p] = c ? 0: a / 2,
            n.animate(f, {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: function() {
                    c || o.hide(),
                    t.effects.restore(o, r),
                    t.effects.removeWrapper(o),
                    i()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.drop = function(e, i) {
            var s,
            n = t(this),
            a = ["position", "top", "bottom", "left", "right", "opacity", "height", "width"],
            o = t.effects.setMode(n, e.mode || "hide"),
            r = "show" === o,
            l = e.direction || "left",
            c = "up" === l || "down" === l ? "top": "left",
            h = "up" === l || "left" === l ? "pos": "neg",
            u = {
                opacity: r ? 1: 0

            };
            t.effects.save(n, a),
            n.show(),
            t.effects.createWrapper(n),
            s = e.distance || n["top" === c ? "outerHeight": "outerWidth"](!0) / 2,
            r && n.css("opacity", 0).css(c, "pos" === h ? -s: s),
            u[c] = (r ? "pos" === h ? "+=": "-=": "pos" === h ? "-=": "+=") + s,
            n.animate(u, {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: function() {
                    "hide" === o && n.hide(),
                    t.effects.restore(n, a),
                    t.effects.removeWrapper(n),
                    i()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.explode = function(e, i) {
            function s() {
                v.push(this),
                v.length === u * d && n()

            }
            function n() {
                p.css({
                    visibility: "visible"

                }),
                t(v).remove(),
                g || p.hide(),
                i()

            }
            var a,
            o,
            r,
            l,
            c,
            h,
            u = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3,
            d = u,
            p = t(this),
            f = t.effects.setMode(p, e.mode || "hide"),
            g = "show" === f,
            m = p.show().css("visibility", "hidden").offset(),
            _ = Math.ceil(p.outerWidth() / d),
            b = Math.ceil(p.outerHeight() / u),
            v = [];
            for (a = 0; u > a; a++) for (l = m.top + a * b, h = a - (u - 1) / 2, o = 0; d > o; o++) r = m.left + o * _,
            c = o - (d - 1) / 2,
            p.clone().appendTo("body").wrap("<div></div>").css({
                position: "absolute",
                visibility: "visible",
                left: -o * _,
                top: -a * b

            }).parent().addClass("ui-effects-explode").css({
                position: "absolute",
                overflow: "hidden",
                width: _,
                height: b,
                left: r + (g ? c * _: 0),
                top: l + (g ? h * b: 0),
                opacity: g ? 0: 1

            }).animate({
                left: r + (g ? 0: c * _),
                top: l + (g ? 0: h * b),
                opacity: g ? 1: 0

            },
            e.duration || 500, e.easing, s)

        }

    } (jQuery),
    function(t) {
        t.effects.effect.fade = function(e, i) {
            var s = t(this),
            n = t.effects.setMode(s, e.mode || "toggle");
            s.animate({
                opacity: n

            },
            {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: i

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.fold = function(e, i) {
            var s,
            n,
            a = t(this),
            o = ["position", "top", "bottom", "left", "right", "height", "width"],
            r = t.effects.setMode(a, e.mode || "hide"),
            l = "show" === r,
            c = "hide" === r,
            h = e.size || 15,
            u = /([0-9]+)%/.exec(h),
            d = !!e.horizFirst,
            p = l !== d,
            f = p ? ["width", "height"] : ["height", "width"],
            g = e.duration / 2,
            m = {},
            _ = {};
            t.effects.save(a, o),
            a.show(),
            s = t.effects.createWrapper(a).css({
                overflow: "hidden"

            }),
            n = p ? [s.width(), s.height()] : [s.height(), s.width()],
            u && (h = parseInt(u[1], 10) / 100 * n[c ? 0: 1]),
            l && s.css(d ? {
                height: 0,
                width: h

            }: {
                height: h,
                width: 0

            }),
            m[f[0]] = l ? n[0] : h,
            _[f[1]] = l ? n[1] : 0,
            s.animate(m, g, e.easing).animate(_, g, e.easing, 
            function() {
                c && a.hide(),
                t.effects.restore(a, o),
                t.effects.removeWrapper(a),
                i()

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.highlight = function(e, i) {
            var s = t(this),
            n = ["backgroundImage", "backgroundColor", "opacity"],
            a = t.effects.setMode(s, e.mode || "show"),
            o = {
                backgroundColor: s.css("backgroundColor")

            };
            "hide" === a && (o.opacity = 0),
            t.effects.save(s, n),
            s.show().css({
                backgroundImage: "none",
                backgroundColor: e.color || "#ffff99"

            }).animate(o, {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: function() {
                    "hide" === a && s.hide(),
                    t.effects.restore(s, n),
                    i()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.pulsate = function(e, i) {
            var s,
            n = t(this),
            a = t.effects.setMode(n, e.mode || "show"),
            o = "show" === a,
            r = "hide" === a,
            l = o || "hide" === a,
            c = 2 * (e.times || 5) + (l ? 1: 0),
            h = e.duration / c,
            u = 0,
            d = n.queue(),
            p = d.length;
            for ((o || !n.is(":visible")) && (n.css("opacity", 0).show(), u = 1), s = 1; c > s; s++) n.animate({
                opacity: u

            },
            h, e.easing),
            u = 1 - u;
            n.animate({
                opacity: u

            },
            h, e.easing),
            n.queue(function() {
                r && n.hide(),
                i()

            }),
            p > 1 && d.splice.apply(d, [1, 0].concat(d.splice(p, c + 1))),
            n.dequeue()

        }

    } (jQuery),
    function(t) {
        t.effects.effect.puff = function(e, i) {
            var s = t(this),
            n = t.effects.setMode(s, e.mode || "hide"),
            a = "hide" === n,
            o = parseInt(e.percent, 10) || 150,
            r = o / 100,
            l = {
                height: s.height(),
                width: s.width(),
                outerHeight: s.outerHeight(),
                outerWidth: s.outerWidth()

            };
            t.extend(e, {
                effect: "scale",
                queue: !1,
                fade: !0,
                mode: n,
                complete: i,
                percent: a ? o: 100,
                from: a ? l: {
                    height: l.height * r,
                    width: l.width * r,
                    outerHeight: l.outerHeight * r,
                    outerWidth: l.outerWidth * r

                }

            }),
            s.effect(e)

        },
        t.effects.effect.scale = function(e, i) {
            var s = t(this),
            n = t.extend(!0, {},
            e),
            a = t.effects.setMode(s, e.mode || "effect"),
            o = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0: "hide" === a ? 0: 100),
            r = e.direction || "both",
            l = e.origin,
            c = {
                height: s.height(),
                width: s.width(),
                outerHeight: s.outerHeight(),
                outerWidth: s.outerWidth()

            },
            h = {
                y: "horizontal" !== r ? o / 100: 1,
                x: "vertical" !== r ? o / 100: 1

            };
            n.effect = "size",
            n.queue = !1,
            n.complete = i,
            "effect" !== a && (n.origin = l || ["middle", "center"], n.restore = !0),
            n.from = e.from || ("show" === a ? {
                height: 0,
                width: 0,
                outerHeight: 0,
                outerWidth: 0

            }: c),
            n.to = {
                height: c.height * h.y,
                width: c.width * h.x,
                outerHeight: c.outerHeight * h.y,
                outerWidth: c.outerWidth * h.x

            },
            n.fade && ("show" === a && (n.from.opacity = 0, n.to.opacity = 1), "hide" === a && (n.from.opacity = 1, n.to.opacity = 0)),
            s.effect(n)

        },
        t.effects.effect.size = function(e, i) {
            var s,
            n,
            a,
            o = t(this),
            r = ["position", "top", "bottom", "left", "right", "width", "height", "overflow", "opacity"],
            l = ["position", "top", "bottom", "left", "right", "overflow", "opacity"],
            c = ["width", "height", "overflow"],
            h = ["fontSize"],
            u = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"],
            d = ["borderLeftWidth", "borderRightWidth", "paddingLeft", "paddingRight"],
            p = t.effects.setMode(o, e.mode || "effect"),
            f = e.restore || "effect" !== p,
            g = e.scale || "both",
            m = e.origin || ["middle", "center"],
            _ = o.css("position"),
            b = f ? r: l,
            v = {
                height: 0,
                width: 0,
                outerHeight: 0,
                outerWidth: 0

            };
            "show" === p && o.show(),
            s = {
                height: o.height(),
                width: o.width(),
                outerHeight: o.outerHeight(),
                outerWidth: o.outerWidth()

            },
            "toggle" === e.mode && "show" === p ? (o.from = e.to || v, o.to = e.from || s) : (o.from = e.from || ("show" === p ? v: s), o.to = e.to || ("hide" === p ? v: s)),
            a = {
                from: {
                    y: o.from.height / s.height,
                    x: o.from.width / s.width

                },
                to: {
                    y: o.to.height / s.height,
                    x: o.to.width / s.width

                }

            },
            ("box" === g || "both" === g) && (a.from.y !== a.to.y && (b = b.concat(u), o.from = t.effects.setTransition(o, u, a.from.y, o.from), o.to = t.effects.setTransition(o, u, a.to.y, o.to)), a.from.x !== a.to.x && (b = b.concat(d), o.from = t.effects.setTransition(o, d, a.from.x, o.from), o.to = t.effects.setTransition(o, d, a.to.x, o.to))),
            ("content" === g || "both" === g) && a.from.y !== a.to.y && (b = b.concat(h).concat(c), o.from = t.effects.setTransition(o, h, a.from.y, o.from), o.to = t.effects.setTransition(o, h, a.to.y, o.to)),
            t.effects.save(o, b),
            o.show(),
            t.effects.createWrapper(o),
            o.css("overflow", "hidden").css(o.from),
            m && (n = t.effects.getBaseline(m, s), o.from.top = (s.outerHeight - o.outerHeight()) * n.y, o.from.left = (s.outerWidth - o.outerWidth()) * n.x, o.to.top = (s.outerHeight - o.to.outerHeight) * n.y, o.to.left = (s.outerWidth - o.to.outerWidth) * n.x),
            o.css(o.from),
            ("content" === g || "both" === g) && (u = u.concat(["marginTop", "marginBottom"]).concat(h), d = d.concat(["marginLeft", "marginRight"]), c = r.concat(u).concat(d), o.find("*[width]").each(function() {
                var i = t(this),
                s = {
                    height: i.height(),
                    width: i.width(),
                    outerHeight: i.outerHeight(),
                    outerWidth: i.outerWidth()

                };
                f && t.effects.save(i, c),
                i.from = {
                    height: s.height * a.from.y,
                    width: s.width * a.from.x,
                    outerHeight: s.outerHeight * a.from.y,
                    outerWidth: s.outerWidth * a.from.x

                },
                i.to = {
                    height: s.height * a.to.y,
                    width: s.width * a.to.x,
                    outerHeight: s.height * a.to.y,
                    outerWidth: s.width * a.to.x

                },
                a.from.y !== a.to.y && (i.from = t.effects.setTransition(i, u, a.from.y, i.from), i.to = t.effects.setTransition(i, u, a.to.y, i.to)),
                a.from.x !== a.to.x && (i.from = t.effects.setTransition(i, d, a.from.x, i.from), i.to = t.effects.setTransition(i, d, a.to.x, i.to)),
                i.css(i.from),
                i.animate(i.to, e.duration, e.easing, 
                function() {
                    f && t.effects.restore(i, c)

                })

            })),
            o.animate(o.to, {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: function() {
                    0 === o.to.opacity && o.css("opacity", o.from.opacity),
                    "hide" === p && o.hide(),
                    t.effects.restore(o, b),
                    f || ("static" === _ ? o.css({
                        position: "relative",
                        top: o.to.top,
                        left: o.to.left

                    }) : t.each(["top", "left"], 
                    function(t, e) {
                        o.css(e, 
                        function(e, i) {
                            var s = parseInt(i, 10),
                            n = t ? o.to.left: o.to.top;
                            return "auto" === i ? n + "px": s + n + "px"

                        })

                    })),
                    t.effects.removeWrapper(o),
                    i()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.shake = function(e, i) {
            var s,
            n = t(this),
            a = ["position", "top", "bottom", "left", "right", "height", "width"],
            o = t.effects.setMode(n, e.mode || "effect"),
            r = e.direction || "left",
            l = e.distance || 20,
            c = e.times || 3,
            h = 2 * c + 1,
            u = Math.round(e.duration / h),
            d = "up" === r || "down" === r ? "top": "left",
            p = "up" === r || "left" === r,
            f = {},
            g = {},
            m = {},
            _ = n.queue(),
            b = _.length;
            for (t.effects.save(n, a), n.show(), t.effects.createWrapper(n), f[d] = (p ? "-=": "+=") + l, g[d] = (p ? "+=": "-=") + 2 * l, m[d] = (p ? "-=": "+=") + 2 * l, n.animate(f, u, e.easing), s = 1; c > s; s++) n.animate(g, u, e.easing).animate(m, u, e.easing);
            n.animate(g, u, e.easing).animate(f, u / 2, e.easing).queue(function() {
                "hide" === o && n.hide(),
                t.effects.restore(n, a),
                t.effects.removeWrapper(n),
                i()

            }),
            b > 1 && _.splice.apply(_, [1, 0].concat(_.splice(b, h + 1))),
            n.dequeue()

        }

    } (jQuery),
    function(t) {
        t.effects.effect.slide = function(e, i) {
            var s,
            n = t(this),
            a = ["position", "top", "bottom", "left", "right", "width", "height"],
            o = t.effects.setMode(n, e.mode || "show"),
            r = "show" === o,
            l = e.direction || "left",
            c = "up" === l || "down" === l ? "top": "left",
            h = "up" === l || "left" === l,
            u = {};
            t.effects.save(n, a),
            n.show(),
            s = e.distance || n["top" === c ? "outerHeight": "outerWidth"](!0),
            t.effects.createWrapper(n).css({
                overflow: "hidden"

            }),
            r && n.css(c, h ? isNaN(s) ? "-" + s: -s: s),
            u[c] = (r ? h ? "+=": "-=": h ? "-=": "+=") + s,
            n.animate(u, {
                queue: !1,
                duration: e.duration,
                easing: e.easing,
                complete: function() {
                    "hide" === o && n.hide(),
                    t.effects.restore(n, a),
                    t.effects.removeWrapper(n),
                    i()

                }

            })

        }

    } (jQuery),
    function(t) {
        t.effects.effect.transfer = function(e, i) {
            var s = t(this),
            n = t(e.to),
            a = "fixed" === n.css("position"),
            o = t("body"),
            r = a ? o.scrollTop() : 0,
            l = a ? o.scrollLeft() : 0,
            c = n.offset(),
            h = {
                top: c.top - r,
                left: c.left - l,
                height: n.innerHeight(),
                width: n.innerWidth()

            },
            u = s.offset(),
            d = t("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(e.className).css({
                top: u.top - r,
                left: u.left - l,
                height: s.innerHeight(),
                width: s.innerWidth(),
                position: a ? "fixed": "absolute"

            }).animate(h, e.duration, e.easing, 
            function() {
                d.remove(),
                i()

            })

        }

    } (jQuery)

},
function(t, e) {
    "use strict";
    ! 
    function(t) {
        function e(t, e) {
            return "function" == typeof t ? t.call(e) : t

        }
        function i(t) {
            for (; t = t.parentNode;) if (t == document) return ! 0;
            return ! 1

        }
        function s(e, i) {
            this.$element = t(e),
            this.options = i,
            this.enabled = !0,
            this.fixTitle()

        }
        s.prototype = {
            show: function() {
                var i = this.getTitle();
                if (i && this.enabled) {
                    var s = this.tip();
                    s.find(".tipsy-inner")[this.options.html ? "html": "text"](i),
                    s[0].className = "tipsy",
                    s.remove().css({
                        top: 0,
                        left: 0,
                        visibility: "hidden",
                        display: "block"

                    }).prependTo(document.body);
                    var n,
                    a = t.extend({},
                    this.$element.offset(), {
                        width: this.$element[0].offsetWidth,
                        height: this.$element[0].offsetHeight

                    }),
                    o = s[0].offsetWidth,
                    r = s[0].offsetHeight,
                    l = e(this.options.gravity, this.$element[0]);
                    switch (l.charAt(0)) {
                        case "n":
                        n = {
                            top: a.top + a.height + this.options.offset,
                            left: a.left + a.width / 2 - o / 2

                        };
                        break;
                        case "s":
                        n = {
                            top: a.top - r - this.options.offset,
                            left: a.left + a.width / 2 - o / 2

                        };
                        break;
                        case "e":
                        n = {
                            top: a.top + a.height / 2 - r / 2,
                            left: a.left - o - this.options.offset

                        };
                        break;
                        case "w":
                        n = {
                            top: a.top + a.height / 2 - r / 2,
                            left: a.left + a.width + this.options.offset

                        }

                    }
                    2 == l.length && ("w" == l.charAt(1) ? n.left = a.left + a.width / 2 - 15: n.left = a.left + a.width / 2 - o + 15),
                    s.css(n).addClass("tipsy-" + l),
                    s.find(".tipsy-arrow")[0].className = "tipsy-arrow tipsy-arrow-" + l.charAt(0),
                    this.options.className && s.addClass(e(this.options.className, this.$element[0])),
                    this.options.fade ? s.stop().css({
                        opacity: 0,
                        display: "block",
                        visibility: "visible"

                    }).animate({
                        opacity: this.options.opacity

                    }) : s.css({
                        visibility: "visible",
                        opacity: this.options.opacity

                    })

                }

            },
            hide: function() {
                this.options.fade ? this.tip().stop().fadeOut(function() {
                    t(this).remove()

                }) : this.tip().remove()

            },
            fixTitle: function() {
                var t = this.$element;
                (t.attr("title") || "string" != typeof t.attr("original-title")) && t.attr("original-title", t.attr("title") || "").removeAttr("title")

            },
            getTitle: function() {
                var t,
                e = this.$element,
                i = this.options;
                this.fixTitle();
                var t,
                i = this.options;
                return "string" == typeof i.title ? t = e.attr("title" == i.title ? "original-title": i.title) : "function" == typeof i.title && (t = i.title.call(e[0])),
                t = ("" + t).replace(/(^\s*|\s*$)/, ""),
                t || i.fallback

            },
            tip: function() {
                return this.$tip || (this.$tip = t('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>'), this.$tip.data("tipsy-pointee", this.$element[0])),
                this.$tip

            },
            validate: function() {
                this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)

            },
            enable: function() {
                this.enabled = !0

            },
            disable: function() {
                this.enabled = !1

            },
            toggleEnabled: function() {
                this.enabled = !this.enabled

            }

        },
        t.fn.tipsy = function(e) {
            function i(i) {
                var n = t.data(i, "tipsy");
                return n || (n = new s(i, t.fn.tipsy.elementOptions(i, e)), t.data(i, "tipsy", n)),
                n

            }
            function n() {
                var t = i(this);
                t.hoverState = "in",
                0 == e.delayIn ? t.show() : (t.fixTitle(), setTimeout(function() {
                    "in" == t.hoverState && t.show()

                },
                e.delayIn))

            }
            function a() {
                var t = i(this);
                t.hoverState = "out",
                0 == e.delayOut ? t.hide() : setTimeout(function() {
                    "out" == t.hoverState && t.hide()

                },
                e.delayOut)

            }
            if (e === !0) return this.data("tipsy");
            if ("string" == typeof e) {
                var o = this.data("tipsy");
                return o && o[e](),
                this

            }
            if (e = t.extend({},
            t.fn.tipsy.defaults, e), e.live || this.each(function() {
                i(this)

            }), "manual" != e.trigger) {
                var r = e.live ? "live": "bind",
                l = "hover" == e.trigger ? "mouseenter": "focus",
                c = "hover" == e.trigger ? "mouseleave": "blur";
                this[r](l, n)[r](c, a)

            }
            return this

        },
        t.fn.tipsy.defaults = {
            className: null,
            delayIn: 0,
            delayOut: 0,
            fade: !1,
            fallback: "",
            gravity: "n",
            html: !1,
            live: !1,
            offset: 0,
            opacity: .8,
            title: "title",
            trigger: "hover"

        },
        t.fn.tipsy.revalidate = function() {
            t(".tipsy").each(function() {
                var e = t.data(this, "tipsy-pointee");
                e && i(e) || t(this).remove()

            })

        },
        t.fn.tipsy.elementOptions = function(e, i) {
            return t.metadata ? t.extend({},
            i, t(e).metadata()) : i

        },
        t.fn.tipsy.autoNS = function() {
            return t(this).offset().top > t(document).scrollTop() + t(window).height() / 2 ? "s": "n"

        },
        t.fn.tipsy.autoWE = function() {
            return t(this).offset().left > t(document).scrollLeft() + t(window).width() / 2 ? "e": "w"

        },
        t.fn.tipsy.autoBounds = function(e, i) {
            return function() {
                var s = {
                    ns: i[0],
                    ew: i.length > 1 ? i[1] : !1

                },
                n = t(document).scrollTop() + e,
                a = t(document).scrollLeft() + e,
                o = t(this);
                return o.offset().top < n && (s.ns = "n"),
                o.offset().left < a && (s.ew = "w"),
                t(window).width() + t(document).scrollLeft() - o.offset().left < e && (s.ew = "e"),
                t(window).height() + t(document).scrollTop() - o.offset().top < e && (s.ns = "s"),
                s.ns + (s.ew ? s.ew: "")

            }

        }

    } (jQuery)

},
function(module, exports, __webpack_require__) {
    "use strict";

    function _interopRequireDefault(t) {
        return t && t.__esModule ? t: {
            "default": t

        }

    }
    function nitalk() {
        var chat_stat = 0,
        chat_reconnect = 0,
        chat_num_users = 0,
        chat_title_status = 2,
        chat_changed_lang = !0,
        login_email,
        login_name,
        uname = "",
        uid = "",
        csname = "",
        curChatUserId = "",
        proxyUrlHeader = "",
        socket,
        conf_domain,
        conf_server_type,
        conf_server,
        conf_port,
        conf_auto_login,
        conf_debug,
        conf_sound_active,
        conf_login_popup,
        conf_tools_disabled,
        conf_tools_icon,
        conf_options_disabled,
        conf_options_icon,
        conf_bar_default_expand,
        conf_bar_icon_expand,
        conf_bar_icon_collapse,
        conf_theme_default,
        conf_themes,
        conf_lang_default,
        conf_lang_text,
        conf_lang_i18n,
        conf_shortcuts_text,
        conf_shortcuts_href,
        conf_shortcuts_icon,
        conf_shortcuts_target,
        csliid = "cs",
        csid = "",
        csname = "",
        csnickname = "",
        csmsg_cache = "",
        csmsg_sending = !1,
        maxWidth = 150,
        xhr_dlogin = $.get("/nitalk/views/dialog-login.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_toolbar = $.get("/nitalk/views/toolbar.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_mchat = $.get("/nitalk/views/main-chat.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_options = $.get("/nitalk/views/options.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_upload = $.get("/nitalk/views/upload.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_addgroup = $.get("/nitalk/views/groupadd.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_delgroup = $.get("/nitalk/views/groupdel.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_movgroup = $.get("/nitalk/views/groupmov.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_history = $.get("/nitalk/views/history.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_sysinfo = $.get("/nitalk/views/sysinfo.html", 
        function(t) {
            $("body").append(t)

        }),
        xhr_emoji = $.get("/nitalk/views/emoji.html", 
        function(t) {
            $("body").append(t)

        });
        $.when(xhr_dlogin, xhr_toolbar, xhr_mchat, xhr_options, xhr_upload, xhr_addgroup, xhr_delgroup, xhr_movgroup, xhr_history, xhr_sysinfo, xhr_emoji).done(function(r1, r2, r3, r4, r5, r6, r7, r8, r9, r10, r11) {
            function updateTips(t) {
                tips.text(t).addClass("ui-state-highlight"),
                setTimeout(function() {
                    tips.removeClass("ui-state-highlight", 1500)

                },
                500)

            }
            function checkLength(t, e, i, s) {
                return t.val().length > s || t.val().length < i ? (t.addClass("ui-state-error"), updateTips(_jsI18n_enJs2["default"].length_of + " " + e + " " + _jsI18n_enJs2["default"].must_be_between + " " + i + " " + _jsI18n_enJs2["default"].and + " " + s + "."), !1) : !0

            }
            function checkRegexp(t, e, i) {
                return e.test(t.val()) ? !0: (t.addClass("ui-state-error"), updateTips(i), !1)

            }
            function main_chat_set_dialog_lang(t) {
                t.parent().find("#warning-alert").text(_jsI18n_enJs2["default"].alert + " "),
                t.parent().find("#warning-text").text(_jsI18n_enJs2["default"].user_is + " " + _jsI18n_enJs2["default"].disconnected.toLowerCase()),
                t.parent().find("#istalking-text").first().text(clean_name(t.data("name")) + " " + _jsI18n_enJs2["default"].is_writing),
                t.parent().find(".minimize-window").attr("title", _jsI18n_enJs2["default"].minimize),
                t.dialog({
                    closeText: _jsI18n_enJs2["default"].close

                }),
                chat_changed_lang = !1

            }
            function main_set_dialog(t, e) {
                $("#Dialog" + t).dialog({
                    autoOpen: !1,
                    closeOnEscape: !0,
                    resizable: !1,
                    modal: !1,
                    minHeight: 340,
                    maxHeight: 340,
                    height: 340,
                    width: 420,
                    open: function(i, s) {
                        if (1 == chat_changed_lang && main_chat_set_dialog_lang($(this)), 1 != $(this).data("init")) {
                            var n = $(this);
                            main_chat_set_dialog_lang($(this)),
                            $(this).parent().find(".ui-dialog-title").append("<li id='dialog-status' class='" + ($(this).data("status") || "offline") + "'>" + $(this).data("name") + "</li>"),
                            $(this).parent().find("#istalking").first().addClass("no-display"),
                            $(this).data("init", 1),
                            $(this).parent().find("textarea").click(function() {
                                main_chat_user_alert(t, 1)

                            }),
                            $(this).parent().find("textarea").first().focusin(function() {
                                $(this).addClass("ui-chatbox-input-focus")

                            }),
                            $(this).parent().find("textarea").first().focusout(function() {
                                $(this).removeClass("ui-chatbox-input-focus")

                            }),
                            $(this).parent().find(".minimize-window").click(function() {
                                n.dialog("close")

                            }),
                            $(this).parent().find(".ui-dialog-titlebar-close").click(function() {
                                var t = n.attr("id").substring("Dialog".length);
                                $("#user-button-" + t).remove()

                            });
                            var a;
                            $(this).find("textarea").first().keyup(function(s) {
                                if (void 0 != a && clearTimeout(a), a = setTimeout(function() {
                                    callUserTyping(e)

                                },
                                400), n.parent().find("#progressbar-char").progressbar("option", "value", $(this).val().length), $(this).val().length > 100) {
                                    var o = $(this).val().substr(0, 100);
                                    $(this).val(o)

                                }
                                if (13 == s.which && !i.shiftKey) {
                                    var r = clean_msg($(this).val());
                                    $(this).val(""),
                                    n.parent().find("#progressbar-char").progressbar("option", "value", 0),
                                    t == csliid && csmsg_sending || append_msg_me(r, n, "me", t, "", "txt"),
                                    sendText(t, e, r)

                                }
                                return ! 1

                            }),
                            $(this).find("#openupload").click(function(e) {
                                var i = e.pageX,
                                s = e.pageY - 250;
                                curChatUserId = t,
                                $("#upload").dialog({
                                    position: [i, s],
                                    title: "选择图片"

                                }),
                                $("#upload").dialog("open")

                            }),
                            $(this).find("#openhistory").click(function(e) {
                                var i = e.pageX - 320,
                                s = e.pageY - 670;
                                curChatUserId = t,
                                userTalkhistory(curChatUserId),
                                $("#history").dialog({
                                    position: [i, s],
                                    height: 430,
                                    width: 650,
                                    title: "聊天记录"

                                }),
                                $("#history").dialog("open")

                            }),
                            $(this).find("#openmovgroup").click(function() {
                                $("#groupmov")[0].selectedIndex = 0,
                                curChatUserId = t,
                                $("#movgroup").dialog({
                                    position: [300, 300],
                                    title: "移动分组"

                                }),
                                $("#movgroup").dialog("open")

                            }),
                            $("#editContainer" + t + " .editor").keyup(function(s) {
                                if (13 == s.which && !i.shiftKey) {
                                    if (!checkWorktime(t)) return;
                                    var a = $("#editContainer" + t + " .editor").html(),
                                    o = (0, _emojiEmojieditor2["default"])(a),
                                    r = clean_msg(o);
                                    $(this).html(""),
                                    n.parent().find("#progressbar-char").progressbar("option", "value", 0),
                                    t == csliid && csmsg_sending || append_msg_me(r, n, "me", t, "", "txt"),
                                    sendText(t, e, r)

                                }
                                return ! 1

                            }),
                            $(this).find("#openface").click(function() {
                                if ($(this).find(".nitalk-face-dialog").toggle(), curChatUserId = t, _inittalk_filedir || (_inittalk_filedir = ""), !e) var e = $(".editContainer").nitalEditor({
                                    emojiConfigUrl: "/nitalk/emoji/emoji.json",
                                    emojiUrl: _inittalk_filedir + "/nitalk/emoji/unicode/",
                                    sendContentCallback: function(t) {},
                                    $sendBtn: $("#sendBtn"),
                                    $faceContainer: $("#faceContainer")

                                });
                                e.changeActiveEditContent($("#editContainer" + t)),
                                $("#faceContainer").appendTo($("#nitalk-face-dialog" + t))

                            }),
                            $(this).find("#send").click(function() {
                                if (checkWorktime(t)) {
                                    var i = $("#editContainer" + t + " .editor").html();
                                    if (i) {
                                        var s = (0, _emojiEmojieditor2["default"])(i),
                                        a = clean_msg(s);
                                        $("#editContainer" + t + " .editor").html(""),
                                        t == csliid && csmsg_sending || append_msg_me(a, n, "me", t, "", "txt"),
                                        sendText(t, e, a)

                                    }

                                }

                            }),
                            $(this).find("#progressbar-char").first().progressbar({
                                value: 0

                            })

                        }
                        $(this).parent().find("#box")[0].scrollTop = $(this).parent().find("#box")[0].scrollHeight

                    },
                    show: {
                        effect: "none"

                    },
                    hide: {
                        effect: "none"

                    }

                })

            }
            function checkWorktime(t) {
                if ("cs" == t) {
                    var e = new Date,
                    i = e.getHours(),
                    s = e.getMinutes();
                    if (i >= 2 && 9 > i && s > 10) return append_msg("he", "系统消息", t, '<font style="color: red;">很抱歉，凌晨2点10分至早晨9点为客服休息时间。</font>', "cs2u", "txt"),
                    !1

                }
                return ! 0

            }
            function user_status(t, e) {
                "offline" == e ? e = "invisible": "online" == e && (e = "visible"),
                "user_status" == t && Nitalk.user.changestat(changestat_callback, e)

            }
            function clean_msg(t) {
                try {
                    var e = t.replace(/(<([^>]+)>)/gi, "")

                } catch(i) {
                    e = t

                }
                try {
                    var s = e.replace(/(\n|\r|\r\n)$/, "")

                } catch(i) {
                    s = t

                }
                return s

            }
            function minhour() {
                var t = new Date,
                e = t.getHours(),
                i = t.getMinutes(),
                s = " PM";
                10 > e && (e = "0" + e),
                12 > e && (s = " AM"),
                10 > i && (i = "0" + i);
                var n = e + ":" + i + s;
                return n

            }
            function minhour_history(t) {
                var e = t.substring(0, 4),
                i = t.substring(4, 6),
                s = t.substring(6, 8),
                n = t.substring(8, 10),
                a = t.substring(10, 12),
                o = (t.substring(12, 14), " PM");
                10 > n && (n = "0" + n),
                12 > n && (o = " AM"),
                10 > a && (a = "0" + a);
                var r = e + "-" + i + "-" + s + " " + n + ":" + a + o;
                return r

            }
            function open_chat_box(t, e) {
                0 == $("#Dialog" + t).dialog("isOpen") ? ($(".ui-dialog-content").dialog("close"), $("#Dialog" + t).data("name", e), $("#Dialog" + t).dialog("open"), $("#editContainer" + t + " .editor").focus(), newmsg_clean(t)) : $("#Dialog" + t).dialog("close")

            }
            function clean_name(t) {
                var e = t.split(" ");
                return e[0].length > 9 && (e[0] = e[0].substr(0, 8) + ".."),
                e[0]

            }
            function main_chat_status(t, e) {
                1 == chat_reconnect && socket_reconnect(),
                "online" == e ? ($("#rerun").attr("style", "color:#a5ff00"), $("#refresh-li").removeClass("icon-spin")) : "busy" == e ? $("#rerun").attr("style", "color:#ff6000") : "offline" == e && $("#rerun").attr("style", "color:#ccc"),
                $("#chat-title-button").find("li").first().text(_jsI18n_enJs2["default"].chat + " (" + t + ") "),
                $("#chat-title-button").find("li").first().removeClass().addClass(e)

            }
            function main_chat_init() {
                $(".ui-dialog-content").dialog("close"),
                $("#users").accordion("refresh"),
                chat_stat = 1

            }
            function main_chat_set_position(t) {
                if (t > 0) {
                    var e = $("#main-users-resizer").height() + 2,
                    i = $("#main-sort-chat").height(),
                    s = $("#users-window-chat").height();
                    if (600 > e && i > s) {
                        if (1 == t) var n = e + i - s;
                        else if (2 == t) var n = e - i - s;
                        else alert("main_chat_set_position() unexpected value '" + t + "', please report this");
                        600 > n && ($("#main-users-resizer").css("height", n), $("#users").accordion("refresh"))

                    }

                }
                $("#main-users-resizer").position({
                    my: "right bottom",
                    at: "right top",
                    of: "#main",
                    collision: "flip, none"

                })

            }
            function main_chat_user_offline_new(t) {
                $("#Dialog" + t).parent().find("#warning").first().removeClass("no-display"),
                $("#Dialog" + t).parent().find("#textarea_msg").first().attr("disabled", "disabled"),
                main_chat_user_status(t, "offline"),
                $("#main-sort-chat").find("#user-" + t).remove(),
                main_chat_users_num(1, 0),
                0 == chat_num_users && 0 == $("#chat-main-title-label").length && $("#main-sort-chat").append("<div id='chat-main-title-label'>" + _jsI18n_enJs2["default"].no_users + "</div>"),
                main_chat_set_position(2)

            }
            function main_chat_user_offline(t) {
                $("#Dialog" + t).parent().find("#warning").first().removeClass("no-display"),
                $("#Dialog" + t).parent().find("#textarea_msg").first().attr("disabled", "disabled");
                var e = 180 - $("#Dialog" + t).parent().find("#warning").height() - 2;
                $("#Dialog" + t).parent().find("#box").first().css("max-height", e),
                main_chat_user_status(t, "offline")

            }
            function main_chat_user_delete(t) {
                $("#main-sort-chat").find("#user-" + t).remove(),
                $("#user-button-" + t).remove(),
                $("#Dialog" + t).remove(),
                main_chat_users_num(1, 0),
                0 == chat_num_users && 0 == $("#chat-main-title-label").length && $("#main-sort-chat").append("<div id='chat-main-title-label'>" + _jsI18n_enJs2["default"].no_users + "</div>"),
                main_chat_set_position(2)

            }
            function main_chat_user_status(t, e) {
                $("#user-" + t).find("li").removeClass().addClass(e),
                $("#user-button-" + t).find("li").removeClass().addClass(e),
                $("#Dialog" + t).parent().find("#dialog-status").removeClass().addClass(e),
                $("#Dialog" + t).data("status", e)

            }
            function main_chat_user_new(t, e, i) {
                if ($("#main-sort-chat").append("<div id='user-" + t + "' class='user user-pad scroll-content-item'><li class='" + e + "'><a href='#' style='text-decoration:none;'>" + i + "</a></li></div>"), 0 == chat_num_users && 1 == $("#chat-main-title-label").length && $("#chat-main-title-label").remove(), $("#Dialog" + t).data("status", e), $("#main-users-resizer").is(":hidden")) {
                    $("#main-users-resizer").show();
                    var s = 1

                }
                main_chat_users_num(0, 0),
                main_chat_set_position(1),
                1 == s && $("#main-users-resizer").hide()

            }
            function main_append_dialog(t, e) {
                var i = ($("#user-" + t + " li a").text(), $("#user-" + t).parent().attr("id"));
                if ("cs" != t && t != $("#userup").attr("userid") && "groupmsg" != t) {
                    i.replace("main-sort-chat-", "")

                } else;
                0 == $("#Dialog" + t).length && $("body").append("	          <div id='Dialog" + t + "' title='' user='" + e + "'>	            <div id='warning' class='highlight-padding ui-state-highlight ui-corner-all no-display'>	              <span class='window ui-icon ui-icon-info'></span>	              <strong id='warning-alert'></strong><span id='warning-text'></span>	            </div>	            <div id='box' class='ui-widget-content ui-corner-all ui-chatbox-log'>	              <span id='chatbox'>	              </span>	            </div>	            <div id='apps' class='ui-chatbox-input'>	              <span class='floater'>	                <div style='margin-bottom:9px'>	                 	                  <i type='button' id='openface' class='icon icon-expression _icon-2x hover-color nitalk-face-icon' title='表情' >	                   <div class='nitalk-face-dialog' id='nitalk-face-dialog" + t + "'></div>	                  </i>	                  <i type='button' id='openhistory' class='icon icon-history _icon-2x hover-color' title='消息历史记录' ></i>	                  <span id='send' class='send-butt'>发送</span>	               </div>	                <div id='istalking'>	                  <li>	                    <span class='ui-icon ui-icon-comment window'></span>	                    <span id='istalking-text'></span>	                  </li>	                </div>	                <div id='editContainer" + t + "' class='editContainer'><span contenteditable='true' class='editor'></span></div>	              </span>	            </div>	          </div>")

            }
            function main_do_dialog(t, e) {
                return $(t).tipsy("hide"),
                0 == $(e).dialog("isOpen") ? $(e).dialog("open") : $(e).dialog("close"),
                !1

            }
            function main_set_i18n() {
                try {
                    if (!_jsI18n_enJs2["default"]) return alert("Error, i18n not exist"),
                    !0;
                    for (var t = ["chat", "tools", "expand", "collapse", "options", "loading", "connected", "disconnected", "login", "name", "email", "me", "and", "users", "custom_message", "busy", "offline", "minimize", "close", "cancel", "info", "choose_stat", "close_session", "open_session", "char_max", "is_writing", "alert", "user_is", "theme", "lang", "search", "rm_search", "main", "sounds", "enabled", "disabled", "please_wait", "no_users", "user_not_found", "seconds", "reconnection", "try_it", "length_of", "must_be_between", "failed", "all_fields_required", "validate_username"], e = 0; e < t.length; e++) if (void 0 === _jsI18n_enJs2["default"][t[e]] || null === _jsI18n_enJs2["default"][t[e]]) return alert("Error, element i18n_" + t[e] + " is undefined or null"),
                    !0

                } catch(i) {
                    return alert(i),
                    !0

                }
                $("#tools, #tools-panel").attr("title", _jsI18n_enJs2["default"].tools),
                $("#options, #options-panel").attr("title", _jsI18n_enJs2["default"].options),
                $("#rerun-select").attr("title", _jsI18n_enJs2["default"].choose_stat),
                $("#chat-search-text").attr("placeholder", _jsI18n_enJs2["default"].search),
                $("#chat-icon-search").attr("title", _jsI18n_enJs2["default"].search),
                $("#chat-icon-close").attr("title", _jsI18n_enJs2["default"].rm_search),
                $("#min-main-chat").attr("title", _jsI18n_enJs2["default"].minimize),
                $("#text-status").val() == text_status && $("#text-status").val(_jsI18n_enJs2["default"].custom_message),
                text_status = _jsI18n_enJs2["default"].custom_message,
                text_custom_msg = "",
                $("#lang").text(_jsI18n_enJs2["default"].lang),
                $("#option-main").text(_jsI18n_enJs2["default"].main),
                $("#users-header").text(_jsI18n_enJs2["default"].users),
                $("#sounds-label").text(_jsI18n_enJs2["default"].sounds + ":"),
                $("#themes-label").text(_jsI18n_enJs2["default"].theme + ":"),
                $("#radioenabled").next().text(_jsI18n_enJs2["default"].enabled),
                $("#radiodisabled").next().text(_jsI18n_enJs2["default"].disabled),
                main_chat_title(chat_title_status),
                $("#tools-panel").dialog({
                    closeText: _jsI18n_enJs2["default"].close,
                    autoOpen: !1

                }),
                $("#options-panel").dialog({
                    closeText: _jsI18n_enJs2["default"].close,
                    autoOpen: !1

                }),
                $("#user-status-online").find("a").first().text(_jsI18n_enJs2["default"].online),
                $("#user-status-busy").find("a").first().text(_jsI18n_enJs2["default"].busy),
                $("#user-status-offline").find("a").first().text(_jsI18n_enJs2["default"].offline),
                $("#user-status-logout").find("a").first().text(_jsI18n_enJs2["default"].close_session),
                $("#dialog-login").attr("title", _jsI18n_enJs2["default"].login),
                $("#dialog-login").find("p").first().text(_jsI18n_enJs2["default"].all_fields_required),
                $("#dialog-login").find("label#label_name").text(_jsI18n_enJs2["default"].name),
                $("#dialog-login").find("label#label_email").text(_jsI18n_enJs2["default"].email)

            }
            function main_chat_users_num(t, e) {
                var i;
                0 == t ? i = chat_num_users + 1: 1 == t ? i = chat_num_users - 1: 2 == t ? i = e: alert("main_chat_users_header_num() unexpected value '" + t + "', please report this"),
                chat_num_users = i,
                $("#users-header-num").text(i)

            }
            function main_chat_title(t) {
                var e,
                i;
                1 == chat_changed_lang && $("#chat-main-title-ui").remove(),
                0 == t ? (e = "会话", i = _jsI18n_enJs2["default"].no_users, $("#progressbar").remove()) : 1 == t ? (e = _jsI18n_enJs2["default"].disconnected, i = _jsI18n_enJs2["default"].disconnected, $("#progressbar").remove(), $("#main-sort-chat").empty()) : 2 == t ? (e = "加载中...", i = "加载中...", $("#refresh-li").addClass("icon-spin")) : alert("Error, invalid action '" + t + "'"),
                0 == $("#main-sort-chat").children().length && $("#main-sort-chat").append("<div id='chat-main-title-label'></div>"),
                $("#chat-main-title-label").text(i),
                0 == $("#chat-title").find("#chat-main-title-ui").length && $("#chat-title").append("<div id='chat-main-title-ui' class='ui-widget'><div id='chat-main-title-id' class='chat-main-title'>" + e + "</div></div>"),
                $("#chat-main-title-id").text(e),
                chat_title_status = t,
                main_chat_set_position(0)

            }
            function main_set_conf() {
                try {
                    if (!_jsConfigJs2["default"]) return alert("error, conf not exist"),
                    !0;
                    conf_domain = _jsConfigJs2["default"].domain,
                    conf_server_type = _jsConfigJs2["default"].server_type,
                    conf_server = _jsConfigJs2["default"].server,
                    conf_port = _jsConfigJs2["default"].port,
                    conf_auto_login = _jsConfigJs2["default"].auto_login,
                    conf_debug = _jsConfigJs2["default"].debug,
                    conf_sound_active = _jsConfigJs2["default"].sound_active,
                    conf_login_popup = _jsConfigJs2["default"].login_popup,
                    conf_tools_disabled = _jsConfigJs2["default"].tools_disabled,
                    conf_tools_icon = _jsConfigJs2["default"].tools.icon,
                    conf_options_disabled = _jsConfigJs2["default"].options_disabled,
                    conf_options_icon = _jsConfigJs2["default"].options.icon,
                    conf_bar_default_expand = _jsConfigJs2["default"].bar.default_expand,
                    conf_bar_icon_expand = _jsConfigJs2["default"].bar.icon_expand,
                    conf_bar_icon_collapse = _jsConfigJs2["default"].bar.icon_collapse,
                    conf_theme_default = _jsConfigJs2["default"].theme_default,
                    conf_lang_default = _jsConfigJs2["default"].lang_default,
                    conf_themes = new Array,
                    conf_lang_text = new Array,
                    conf_lang_i18n = new Array,
                    conf_shortcuts_text = new Array,
                    conf_shortcuts_href = new Array,
                    conf_shortcuts_icon = new Array,
                    conf_shortcuts_target = new Array;
                    for (var t = 0; t < _jsConfigJs2["default"].shortcuts.length; t++) conf_shortcuts_text[t] = _jsConfigJs2["default"].shortcuts[t].text,
                    conf_shortcuts_href[t] = _jsConfigJs2["default"].shortcuts[t].href,
                    conf_shortcuts_icon[t] = _jsConfigJs2["default"].shortcuts[t].icon,
                    conf_shortcuts_target[t] = _jsConfigJs2["default"].shortcuts[t].target;
                    for (var t = 0; t < _jsConfigJs2["default"].themes.length; t++) conf_themes[t] = _jsConfigJs2["default"].themes[t].name;
                    for (var t = 0; t < _jsConfigJs2["default"].lang.length; t++) conf_lang_text[t] = _jsConfigJs2["default"].lang[t].text,
                    conf_lang_i18n[t] = _jsConfigJs2["default"].lang[t].i18n

                } catch(e) {
                    return alert(e),
                    !0

                }

            }
            function main_set_theme(t) {
                var e = "/nitalk/css/themes/" + t + "/jquery-ui.min.css";
                return $("#theme").attr("href", e),
                !1

            }
            function set_position() {
                $("#main-users-resizer").position({
                    my: "right bottom",
                    at: "right top",
                    of: "#main",
                    collision: "flip, none"

                }),
                1 == $("#tools-panel").dialog("isOpen") && $("#tools-panel").dialog("widget").position({
                    my: "left bottom",
                    at: "left top",
                    of: "#main",
                    collision: "flip, none"

                }),
                1 == $("#options-panel").dialog("isOpen") && $("#options-panel").dialog("widget").position({
                    my: "right bottom",
                    at: "right top",
                    collision: "flip, none",
                    of: "#main"

                })

            }
            function main_chat_user_alert(t, e) {
                0 == e ? $("#Dialog" + t).parent().find(".ui-dialog-titlebar").hasClass("ui-state-highlight") || ($("#Dialog" + t).parent().find(".ui-dialog-titlebar").addClass("ui-state-highlight", 500), $("#user-button-" + t).addClass("ui-state-error", 500)) : 1 == e ? $("#Dialog" + t).parent().find(".ui-dialog-titlebar").hasClass("ui-state-highlight") && ($("#Dialog" + t).parent().find(".ui-dialog-titlebar").removeClass("ui-state-highlight", 500), $("#user-button-" + t).removeClass("ui-state-error", 500)) : alert("main_chat_user_alert() unexpected action '" + e + "', please report this")

            }
            function main_chat_disconnect() {
                chat_num_users = 0,
                main_chat_users_num(2, 0),
                main_chat_title(1),
                main_chat_status(_jsI18n_enJs2["default"].disconnected, "offline"),
                $(".ui-dialog-content").dialog("close"),
                socket && socket_disconnect()

            }
            function socket_connect() {
                socket = io.connect("http://" + conf_server, {
                    port: conf_port,
                    "connect timeout": 5e3

                })

            }
            function socket_handle() {
                socket.on("connect_failed", 
                function(t) {
                    main_chat_disconnect()

                }),
                socket.on("reconnect_failed", 
                function(t) {
                    main_chat_disconnect()

                }),
                socket.on("error", 
                function(t) {
                    main_chat_disconnect()

                }),
                socket.on("custom_error", 
                function(t) {
                    alert(t.message)

                }),
                socket.on("disconnect", 
                function(t) {
                    main_chat_disconnect()

                }),
                socket.on("connect_timeout", 
                function(t) {
                    main_chat_disconnect()

                }),
                socket.on("reconnecting", 
                function(t) {}),
                socket.on("connecting", 
                function(t) {
                    main_chat_title(2)

                }),
                socket.on("connect", 
                function(t) {
                    setTimeout(function() {
                        main_chat_title(0),
                        main_chat_status(_jsI18n_enJs2["default"].connected, "online")

                    },
                    700)

                }),
                socket.on("chat", 
                function(t) {
                    var e = JSON.parse(t);
                    handle_incoming(e)

                }),
                socket.emit("join", {
                    user: login_email,
                    name: login_name

                })

            }
            function socket_disconnect() {
                socket.disconnect(),
                chat_reconnect = 1

            }
            function socket_reconnect() {
                socket.socket.reconnect(),
                socket.emit("join", {
                    user: login_email,
                    name: login_name

                }),
                chat_reconnect = 0

            }
            function clickUserButton(t) {
                var e = this;
                t && (e = document.getElementById("user-button-" + t));
                var i = "user-button-",
                s = $(e).attr("id").substring(i.length),
                n = $(e).text();
                if (check_dialog(s, n), main_chat_user_alert(s, 1), n.length > 15) {
                    var a = 15,
                    n = n.substring(0, a);
                    n += "..."

                }
                open_chat_box(s, n),
                $("#Dialog" + s).dialog({
                    position: {
                        my: "right bottom",
                        at: "left bottom",
                        of: $("#main-users-resizer")[0],
                        collision: "flip, none"

                    },
                    maxHeight: 295

                }),
                $(".nitalk-face-dialog").hide()

            }
            function check_dialog(t, e) {
                if (0 == $("#Dialog" + t).length) {
                    if (!i) var i = $(".editContainer").nitalEditor({
                        emojiConfigUrl: "/nitalk/emoji/emoji.json",
                        emojiUrl: _inittalk_filedir + "/nitalk/emoji/unicode/",
                        sendContentCallback: function(t) {},
                        $sendBtn: $("#sendBtn"),
                        $faceContainer: $("#faceContainer")

                    });
                    main_append_dialog(t, e),
                    main_set_dialog(t, e);
                    var s = $("#user-" + t).children("li").attr("class");
                    $("#Dialog" + t).data("status", s)

                }

            }
            function callUserTyping(t) {}
            function _inittalk(t, e) {
                0 == chat_stat && (login(t, e), main_chat_init()),
                $("#main-users-resizer").toggle(),
                main_chat_set_position(0)

            }
            function relogin(t, e) {
                main_chat_status(_jsI18n_enJs2["default"].disconnected, "offline"),
                main_chat_title(2),
                Nitalk.user.reset(),
                setTimeout(function() {
                    login(t, e)

                },
                3e3)

            }
            function login(t, e) {
                var i = new Object;
                i.success = login_callback,
                i.func_onmessage = onmessage,
                i.upformid = "up",
                i.proxyUrlHeader = _inittalk_url,
                i.platform = _inittalk_platform,
                i.logintype = "webuser",
                null != t && "" != t && (i.username = t),
                null != e && "" != e && (i.paramsessionid = e),
                Nitalk.user.login(i)

            }
            function encodeheader(t) {
                return t = base64encode(t)

            }
            function login_callback(t) {
                Nitalk.user.getFriends(getFriends_callback);
				$('#tool_addgroup,#tool_delgroup').remove();
                var e = t.Promocode,
                i = t.Agentlevel;
                $(".promo").attr("href", _inittalk_domain),
                main_chat_title(0),
                main_chat_status(_jsI18n_enJs2["default"].connected, "online"),
                i > 1 && $("#groupmsg").remove()

            }
            function getFriends_callback(t) {
                var e = t.Groups,
                i = new Object;
                i.userid = "cs",
                i.username = "客服",
                i.userstat = t.kfstatus,
                i.groupid = "cs",
                addFriend(i);
				$("#cs div h3").text(t.kfstatus == 'online' ? "在线" : '离线')
                for (var s in e) {
                    var n = e[s].Groupid,
                    a = e[s].Groupname;
                    if (null != n && "1" != n && "4" != n) {
                        "2" != n && addGroup(n, a),
                        "2" != n && "3" != n && $(".customgroups").append("<option value='" + n + "'>" + a + "</option>");
                        var o = e[s].Users;
                        if ("2" == n && null != o) {
                            var r = o[0].Userid,
                            l = o[0].Stat;
                            $("#userup").attr({
                                userid: r,
                                stat: l

                            }),
                            "online" == l && $("#userup div h3").text("在线"),
                            "offline" == l && $("#userup div h3").text("离线")

                        }
                        if (null != o) {
                            for (var c = 0; c < o.length; c++) for (var h = c + 1; h < o.length; h++) if (!compareFriendObj(o[c], o[h])) {
                                var u = o[c];
                                o[c] = o[h],
                                o[h] = u

                            }
                            $("#main-sort-chat-" + n).html("");
                            for (var d = "", c = 0; c < o.length; c++) {
                                var p = o[c].Userid,
                                f = o[c].Username,
                                g = o[c].Stat;
                                d += "<div id='user-" + p + "' class='user user-pad scroll-content-item'><li class='" + g + "'><a href='#' style='text-decoration:none;'>" + f + "</a></li></div>"

                            }
                            $("#main-sort-chat-" + n).append(d)

                        }
                        countGroupMember(n)

                    }

                }
                $("#users").accordion("refresh"),
                main_chat_set_position(0),
                firstExpandList || (firstExpandList = !0, $("#users > #ui-accordion-users-header-0").click()),
                setDraggable(),
                setDroppable()

            }
            function addgroup_callback(t, e) {
                var i = t.Groupid;
                i = clean_msg(i),
                e = clean_msg(e),
                addGroup(i, e),
                $(".customgroups").append("<option value='" + i + "'>" + e + "</option>"),
                countGroupMember(i),
                $("#users").accordion("refresh"),
                main_chat_set_position(0),
                setDroppable()

            }
            function delgroup_callback(t, e) {
                e = clean_msg(e),
                $("#main-sort-chat-" + e + " div").each(function() {
                    $(this).appendTo($("#main-sort-chat-3"))

                }),
                $("#users-header-" + e).parent().remove(),
                $("#users-window-chat-" + e).remove(),
                $(".customgroups option[value='" + e + "']").remove(),
                countGroupMember("3"),
                $("#users").accordion("refresh"),
                main_chat_set_position(0)

            }
            function movgroup_callback(t, e) {
                var i = e.targetgroupid,
                s = e.sourcegroupid;
                countGroupMember(i),
                countGroupMember(s)

            }
            function changestat_callback(t) {}
            function sendText(t, e, i) {
                $("#emoji").dialog("close");
                var s = new Object;
                if (s.msg = i, s.msgtype = "txt", s.usertype = "user", t == csliid) {
					/*
                    if (!Nitalk.user.csjoined()) {
                        if (csmsg_cache = i, csmsg_sending) return;
                        return disableSend(),
                        void Nitalk.user.assigncs(assigncs_callback)

                    }
					*/
                    s.toutype = "cs",
                    s.chattype = "u2cs"

                } else "groupmsg" == t ? (s.toutype = "lowlevel", s.chattype = "lowlevel") : (s.touserid = t, s.toutype = "user", s.chattype = "u2u");
                s.tousername = e,
                Nitalk.user.sendmsg(s, sendText_callback)

            }
            function sendText_callback(t, e) {
                var i = t.Retcode;
                "10024" == i && ($("#sysinfo-warning").html("会话失效，请点击刷新，重新连接在线客服系统。"), $("#sysinfo").dialog({
                    position: [300, 300],
                    title: "系统消息"

                }), $("#sysinfo").dialog("open"))

            }
            function assigncs_callback(t) {
                var e = t.Retcode,
                i = "";
                if ("10033" == e) i = "等待用户队列已满，请稍候再试。";
                else if ("0" == e) {
                    var s = t.WaitNum,
                    n = s;
                    5 > s && (n = 10),
                    i = s > 0 ? "您已进入用户队列，在您前面有 " + n + " 位用户，请耐心等待系统通知。": "您已进入用户队列，请耐心等待系统通知。"

                } else if ("10035" == e) {
                    var s = t.WaitNum,
                    n = s;
                    5 > s && (n = 10),
                    i = s > 0 ? "您已进入用户队列，在您前面有 " + n + " 位用户，请耐心等待系统通知。": "您已进入用户队列，请耐心等待系统通知。"

                } else i = "等待用户队列已满，请稍候再试。";
                append_msg("he", "系统消息", csliid, '<font style="color: red;">' + i + "</font>", "cs2u", "txt")

            }
            function disableSend() {
                csmsg_sending = !0,
                setTimeout("enableSend()", 3e3)

            }
            function enableSend() {
                csmsg_sending = !1

            }
            function test() {
                alert("test called")

            }
            function userTalkhistory(t) {
                if ("" != t) {
                    var e = new Object;
                    e.touserid = curChatUserId,
                    t == csliid ? e.toutype = "cs": e.toutype = "user",
                    Nitalk.user.talkdate(talkdate_callback, e)

                }

            }
            function getToday2() {
                var t = new Date,
                e = t.getFullYear(),
                i = t.getMonth() + 1,
                s = t.getDate(),
                n = "" + s + " " + i + " " + e;
                return n

            }
            function talkdate_callback(t, e) {
                var i = $("input.datepicker").data("Zebra_DatePicker");
                null != i && i.destroy(),
                $("#datepickerdiv").empty();
                var s = $("#datepickerdiv"),
                n = $("<input>").attr({
                    type: "text",
                    "class": "datepicker"

                });
                n.appendTo(s);
                var a = ($("<div>").attr({
                    id: "_container"

                }).appendTo(s), t.Dates);
                if (null != a) {
                    for (var o = new Date, r = o.getFullYear(), l = o.getMonth() + 1, c = o.getDate(), h = (new Date).setFullYear(r, l, c), u = a.length, d = 0; d < a.length; d++) {
                        var p = a[d].substring(0, 4),
                        f = a[d].substring(4, 6),
                        g = a[d].substring(6, 8),
                        m = (new Date).setFullYear(p, f, g),
                        _ = (h - m) / 864e5;
                        if (_ > 30) {
                            u = d;
                            break

                        }

                    }
                    for (var b = new Array(u), d = u - 1; d >= 0; d--) {
                        var p = a[d].substring(0, 4),
                        f = a[d].substring(4, 6),
                        g = a[d].substring(6, 8),
                        v = "" + g + " " + f + " " + p;
                        b[d] = v

                    }
                    if (0 == u) {
                        var b = new Array(1);
                        b[0] = getToday2()

                    }

                } else {
                    var b = new Array(1);
                    b[0] = getToday2()

                }
                $("input.datepicker").Zebra_DatePicker({
                    disabled_dates: ["* * * *"],
                    enabled_dates: b,
                    select_other_months: !0,
                    show_clear_date: !1,
                    show_select_today: "今日",
                    always_visible: $("#_container"),
                    format: "Ymd",
                    onChange: function(t, e) {},
                    onSelect: function(t, i) {
                        e.talkday = $(".datepicker").val(),
                        Nitalk.user.talkrecord(talkrecord_callback, e)

                    }

                }),
                $("#_container").css({
                    "margin-top": "10px",
                    position: "relative"

                }),
                $(".dp_today").click()

            }
            function talkrecord_callback(t, e) {
                $("#historyrecorddiv").html("");
                var i = t.Recs;
                if (null != i) for (var s = i.length - 1; s >= 0; s--) {
                    var n = i[s].Msg,
                    a = i[s].Msgtype,
                    o = i[s].Sendtime,
                    r = i[s].Username,
                    l = i[s].Userid,
                    c = i[s].Chattype,
                    h = i[s].Frnickname;
                    "" != h && "undefined" != h && (r = h),
                    append_msg_history(n, "", r, l, c, a, o)

                }

            }
            function onmessage(t) {
                if ("recvcsadduser" == t.Recvtype);
                else if ("recvmsg" == t.Recvtype) {
					getFriends_callback({
						'Groups': t.Groups,
						'kfstatus': t.kfstatus,
						'Crowds': t.Crowds,
					});
					for (var i in t.ms) {
						var m = t.ms[i];
						var e = "",
						i = "",
						s = m.Chattype,
						n = m.Msgtype;
						if ("cs2u" == s ? (e = '客服', i = csliid) : (e = getChatUsername(m.Userid), i = m.Userid), i == $("#userup").attr("userid") && (e = "上级"), "cs" != i && $("#userup").attr("userid") != i && $("#user-" + i).length <= 0) {
							e = m.Username;
							var a = new Object;
							a.userid = i,
							a.username = e,
							a.userstat = "online",
							a.groupid = "4",
							addFriend(a),
							countGroupMember("4")

						}
						var o = m.Msg;
						o = clean_msg(o),
						e = clean_msg(e),
						i = clean_msg(i),
						s = clean_msg(s),
						n = clean_msg(n),
						append_msg("he", e, i, o, s, n);
					}
                    $("#chat-title-warn").text("news");
                } else if ("recverror" == t.Recvtype) $("#sysinfo-warning").html("会话失效，请点击刷新，重新连接在线客服系统。"),
                $("#sysinfo").dialog({
                    position: [300, 300],
                    title: "系统消息"

                }),
                $("#sysinfo").dialog("open");
                else if ("recvforceoffline" == t.Recvtype) {
                    var r = t.Reasontype,
                    l = "";
                    l = "01" == r ? "异地登录，强制登出": "02" == r ? "系统维护，强制登出": "强制登出",
                    $("#chat-main-title-id").text(l),
                    main_chat_status(_jsI18n_enJs2["default"].disconnected, "offline"),
                    Nitalk.user.reset(),
                    $(".main-chat-window").children().remove(),
                    $(".users-header-num").text("0/0")

                } else if ("recvstat" == t.Recvtype) {
                    "cs" == t.Usertype && "offline" == t.Stat && (csname = "", csnickname = "", l = '<font style="color: red;">您已从当前客服断开。</font>', csliid = clean_msg(csliid), append_msg("he", "系统消息", csliid, l, "cs2u", "txt"));
                    var c = t.Userid,
                    h = t.Stat;
                    if ("visible" == h && (h = "online"), c == $("#userup").attr("userid"))"online" == h && $("#userup div h3").text("在线"),
                    "offline" == h && $("#userup div h3").text("离线"),
                    "busy" == h && $("#userup div h3").text("忙碌");
                    else {
                        var u = $("#user-" + c).parent().attr("id");
                        if (null == u) return;
                        var d = u.replace("main-sort-chat-", ""),
                        p = $("#user-" + c).text(),
                        a = new Object;
                        a.userid = c,
                        a.username = p,
                        a.userstat = h,
                        a.groupid = d,
                        $("#user-" + c + " li").attr({
                            "class": h

                        }),
                        moveFriend(c),
                        countGroupMember(d)

                    }
                    $("#user-button-" + c + " span li").attr({
                        "class": h

                    }),
                    $("#Dialog" + c).parent().find("#dialog-status").attr({
                        "class": h

                    })

                } else if ("recvtakeover" == t.Recvtype)"take" == t.Ttype && (csid = t.Userid, csname = t.Username);
                else if ("recvsessover" == t.Recvtype) csid = "",
                csname = "",
                l = '<font style="color: red;">您已从当前客服超时断开。</font>',
                append_msg("he", "系统消息", csliid, l, "cs2u", "txt");
                else if ("recvcsavailable" == t.Recvtype) {
                    var f = t.Retcode,
                    l = "";
                    "10026" == f ? (csid = "", csname = "", l = "客服正忙，请稍候再试。") : "0" == f ? (csname = t.Csname, csnickname = t.Nickname, l = "欢迎您， " + csnickname + "为您服务！", enableSend(), "" != csmsg_cache && (sendText(csliid, csname, csmsg_cache), csmsg_cache = "")) : (csid = "", csname = "", l = "客服正忙，请稍候再试。"),
                    append_msg("he", "系统消息", csliid, l, "cs2u", "txt")

                } else alert("unknown type message received")

            }
            function append_msg(t, e, i, s, n, a) {
                t = clean_msg(t),
                e = clean_msg(e),
                i = clean_msg(i),
                s = clean_msg(s),
                n = clean_msg(n),
                a = clean_msg(a);
                var o = $("#Dialog" + i),
                r = e,
                l = $("#user-" + i).find("li").attr("class");
                0 == $("#users-button-bar").parent().find("#user-button-" + i).length && ($("#users-button-bar").append("<button id='user-button-" + i + "' class='user-button' style='font-size: 65%;'><li class='" + l + "'>" + r + "</li></button>"), $(".user-button").button()),
                check_dialog(i, e),
                $(document).is(document.activeElement) && o.find("#textarea_msg").is(document.activeElement) || (1 == conf_sound_active && $("#audio-popup").trigger("play"), main_chat_user_alert(i, 0)),
                "me" == t ? append_msg_me(s, o, e, i, n, a) : "he" == t ? append_msg_he(s, e, i, n, a) : alert("talk src not defined ")

            }
            function getChatUsername(t) {
                return $("#user-" + t + " li a").text()

            }
            function refreshStat(t, e) {}
            function append_msg_me(t, e, i, s, n, a) {
                var o = $("#Dialog" + s + " #box #chatbox"),
                r = $("#Dialog" + s + " #box")[0];
                if ("txt" == a) t = _emojiEmoji2["default"].replace_unified(t),
                "me" == o.children().last().attr("id") ? o.children().last().append("<span class='msg-text'>" + t + "</span>") : o.append("<div id='me'><span class='msg-time'>" + minhour() + "</span><span class='msg'><b>我: </b><span class='msg-toptext'>" + t + "</span></span></div>");
                else if ("img" == a) {
                    var l = $("<img>").attr({
                        src: t,
                        width: maxWidth,
                        "class": "msgimg"

                    }).load(function() {
                        r.scrollTop = r.scrollHeight

                    }),
                    c = $("<span>").attr({
                        "class": "msg"

                    });
                    l.appendTo(c),
                    "me" == o.children().last().attr("id") ? o.children().last().append(c) : (o.append("<div id='me'><span class='msg-time'>" + minhour() + "</span><span class='msg'><b>我: </b><span class='msg-toptext'></span></span></div>"), o.children().last().append(c))

                }
                r.scrollTop = r.scrollHeight

            }
            function append_msg_he(t, e, i, s, n) {
                var a = $("#Dialog" + i + " #box #chatbox"),
                o = $("#Dialog" + i + " #box")[0];
                if ("txt" == n) t = _emojiEmoji2["default"].replace_unified(t),
                "he" == a.children().last().attr("id") ? a.children().last().append("<span class='msg-text'  style='color : #ff9040;'>" + t + "</span>") : a.append("<div id='he'  style='color : #ff9040;'><span class='msg-time'>" + minhour() + "</span><span class='msg'><b>" + e + ": </b><span class='msg-toptext'>" + t + "</span></span></div>");
                else if ("img" == n) {
                    var r = $("<img>").attr({
                        src: t,
                        width: maxWidth,
                        "class": "msgimg"

                    }).load(function() {
                        o.scrollTop = o.scrollHeight

                    }),
                    l = $("<span>").attr({
                        "class": "msg"

                    });
                    r.appendTo(l),
                    "he" == a.children().last().attr("id") ? a.children().last().append(l) : (a.append("<div id='he'><span class='msg-time'>" + minhour() + "</span><span class='msg'><b>" + e + ": </b><span class='msg-toptext'></span></span></div>"), a.children().last().append(l))

                }
                o.scrollTop = o.scrollHeight,
                newmsg_remind(i)

            }
            function newmsg_remind(t) {
                if (1 != $("#Dialog" + t).dialog("isOpen")) {
                    0 == $("#user-" + t + " li .newmsg").length && $("#user-" + t + " li").append("<span class='newmsg'>0</span>");
                    var e = $("#user-" + t + " li .newmsg").text();
                    e++,
                    $("#user-" + t + " li .newmsg").text(e),
                    newmsg_group_remind(t),
                    moveFriend(t)

                }

            }
            function newmsg_group_remind(t) {
                if ($("#userup").attr("userid") == t) {
                    if (0 == $("#newmsg_up").length) {
                        var e = "<span id='newmsg_up'>0</span>";
                        $(e).insertBefore($("#h2_up"))

                    }
                    var i = $("#newmsg_up").text();
                    return "" == i && (i = 0),
                    i++,
                    void $("#newmsg_up").text(i)

                }
                if ("cs" == t) {
                    if (0 == $("#newmsg_cs").length) {
                        var s = "<span id='newmsg_cs'>0</span>";
                        $(s).insertBefore($("#h2_cs"))

                    }
                    var i = $("#newmsg_cs").text();
                    return "" == i && (i = 0),
                    i++,
                    void $("#newmsg_cs").text(i)

                }
                var n = $("#user-" + t).parent(),
                a = $(n).attr("id").replace("main-sort-chat-", "");
                $("#group-info-" + a).html("new")

            }
            function newmsg_clean(t) {
                $("#user-" + t + " li .newmsg").remove(),
                newmsg_group_clean(t),
                moveFriend(t)

            }
            function newmsg_group_clean(t) {
                if ($("#userup").attr("userid") == t) return void $("#newmsg_up").remove();
                if ("cs" == t) return void $("#newmsg_cs").remove();
                if ("groupmsg" != t) {
                    var e = $("#user-" + t).parent(),
                    i = $(e).attr("id").replace("main-sort-chat-", "");
                    0 == $(e).find(".newmsg").length && $("#group-info-" + i).html("")

                }

            }
            function append_msg_history(t, e, i, s, n, a, o) {
                t = clean_msg(t),
                i = clean_msg(i),
                s = clean_msg(s),
                a = clean_msg(a);
                var r = $("#historyrecorddiv"),
                l = minhour_history(o),
                c = $("#historyrecorddiv")[0];
                if ("txt" == a) t = _emojiEmoji2["default"].replace_unified(t),
                r.children().last().attr("id") == s ? r.children().last().append("<span class='msg-text'>" + t + "</span>") : r.append("<div id='" + s + "'><span class='msg-time'>" + l + "</span><span class='msg'><b>" + i + ": </b><span class='msg-toptext'>" + t + "</span></span></div>");
                else if ("img" == a) {
                    var h = $("<img>").attr({
                        src: t,
                        width: maxWidth,
                        "class": "msgimg"

                    }).load(function() {
                        c.scrollTop = c.scrollHeight

                    }),
                    u = $("<span>").attr({
                        "class": "msg"

                    });
                    h.appendTo(u),
                    r.children().last().attr("id") == s ? r.children().last().append(u) : (r.append("<div id='" + s + "'><span class='msg-time'>" + l + "</span><span class='msg'><b>" + i + ": </b><span class='msg-toptext'></span></span></div>"), r.children().last().append(u))

                }
                c.scrollTop = c.scrollHeight

            }
            function getUrlParam(t) {
                var e = new RegExp("(^|&)" + t + "=([^&]*)(&|$)", "i"),
                i = window.location.search.substr(1).match(e);
                return null != i ? unescape(i[2]) : ""

            }
            function addGroup(t, e) {
                if (console.log(t), console.log(e), t = clean_msg(t), e = clean_msg(e), console.log("2 groupid:" + t), console.log("2 groupname:" + e), !($("#users-header-" + t).length > 0)) {
                    for (var i = "	      <h3 groupid='" + t + "' groupname='" + e + "'>	        <span id='users-header-" + t + "'>" + e + "</span>	         (<span class='users-header-num' id='users-header-num-" + t + "'></span>)	         <span id='group-info-" + t + "'><span>	      </h3>	      <div id='users-window-chat-" + t + "' class='slider_container'>	        <div id='main-sort-chat-" + t + "' class='main-chat-window'>	        </div>	      </div>", s = !1, n = $("#users").children("h3"), a = 0; a < n.length; a++) {
                        var o = $(n[a]).attr("groupname"),
                        r = $(n[a]).attr("groupid");
                        if ("2" != r && "3" != r && "4" != r && o > e) {
                            $(i).insertBefore($(n[a])),
                            s = !0;
                            break

                        }

                    }
                    s || $(i).insertBefore("#info-stranger")

                }

            }
            function addFriend(t) {
                var e = t.groupid,
                i = t.userstat,
                s = t.username,
                n = t.userid;
                s = clean_msg(s),
                i = clean_msg(i),
                n = clean_msg(n),
                e = clean_msg(e),
                $("#user-" + n).remove();
                for (var a = "<div id='user-" + n + "' class='user user-pad scroll-content-item ui-draggable'><li class='" + i + "'><a href='#' style='text-decoration:none;'>" + s + "</a></li></div>", o = $("#main-sort-chat-" + e).children(), r = !1, l = 0; l < o.length; l++) if (compareFriend($(a), o[l])) {
                    $($(a)).insertBefore(o[l]),
                    r = !0;
                    break

                }
                r || $("#main-sort-chat-" + e).append($(a))

            }
            function moveFriend(t) {
                t = clean_msg(t);
                var e = $("#user-" + t).parent().attr("id");
                if (null != e) {
                    for (var i = e.replace("main-sort-chat-", ""), s = $("#user-" + t), n = $("#main-sort-chat-" + i).children(), a = !1, o = 0; o < n.length; o++) if (compareFriend($(s), n[o])) {
                        $($(s)).insertBefore(n[o]),
                        a = !0;
                        break

                    }
                    a || $("#main-sort-chat-" + i).append($(s))

                }

            }
            function compareFriend(t, e) {
                t = clean_msg(t),
                e = clean_msg(e);
                var i = $(t).children("li").attr("class"),
                s = $(t).text(),
                n = $(t).find("span.newmsg").length;
                i = n > 0 ? 5: "online" == i ? 10: "busy" == i ? 20: 30;
                var a = $(e).children("li").attr("class"),
                o = $(e).text();
                return a = "online" == a || "busy" == a ? 10: "busy" == a ? 20: 30,
                a > i ? !0: i > a ? !1: o > s ? !0: !1

            }
            function compareFriendObj(t, e) {
                t = clean_msg(t),
                e = clean_msg(e);
                var i = t.Stat,
                s = t.Username,
                n = e.Stat,
                a = e.Username;
                return i = "online" == i ? 0: "busy" == i ? 1: 2,
                n = "online" == n || "busy" == n ? 0: "busy" == n ? 1: 2,
                n > i ? !0: i > n ? !1: a > s ? !0: !1

            }
            function countGroupMember(t) {
                t = clean_msg(t);
                var e = $("#main-sort-chat-" + t).children().length,
                i = $("#main-sort-chat-" + t).find(".offline").length,
                s = e - i;
                $("#users-header-num-" + t).html(s + "/" + e)

            }
            function getIframeVal(val) {
                var obj = eval("(" + decodeURIComponent(val) + ")");
                if ("0" == obj.Retcode) {
                    $("#content_info").append("<p>[" + obj.Userid + "] to [" + obj.Touid + '] :<img src="' + obj.Msg + '" height="50" width="50" /><p>'),
                    $("#sendfilesection").css("display", "none");
                    var tousername = $("#user-" + curChatUserId + " li a").text(),
                    options = new Object;
                    options.msgtype = "img",
                    options.chattype = "u2u",
                    options.msg = obj.Msg,
                    options.usertype = "user",
                    options.toutype = "user",
                    options.touserid = curChatUserId,
                    curChatUserId == csliid && (options.chattype = "u2cs", options.toutype = "cs"),
                    options.tousername = tousername,
                    options.frnickname = "",
                    options.tonickname = "",
                    append_msg_me(options.msg, "", "me", options.touserid, "", "img"),
                    Nitalk.user.sendmsg(options, sendText_callback)

                }

            }
            function handle_incoming(t) {
                var e = t.action;
                if ("message" == e) {
                    var s = t.data.user.uid,
                    n = t.data.user.name,
                    a = t.data.user.status,
                    o = t.data.msg,
                    r = $("#Dialog" + s);
                    0 == $("#users-button-bar").parent().find("#user-button-" + s).length && ($("#users-button-bar").append("<button id='user-button-" + s + "' class='user-button' style='font-size: 65%;'><li class='" + a + "'>" + n + "</li></button>"), $(".user-button").button()),
                    $(document).is(document.activeElement) && r.find("#textarea_msg").is(document.activeElement) || (1 == conf_sound_active && $("#audio-popup").trigger("play"), main_chat_user_alert(s, 0)),
                    append_msg_he(o, r, n)

                } else if ("newuser" == e) main_append_dialog(t.user.uid, t.user.user),
                main_set_dialog(t.user.uid, t.user.user),
                main_chat_user_new(t.user.uid, t.user.status, t.user.name);
                else if ("disconnect" == e) main_chat_user_offline_new(t.user.uid);
                else if ("offline" == e) main_chat_user_offline(t.user.uid);
                else if ("user_typing" == e) {
                    var l = t.data.uid,
                    r = $("#Dialog" + l);
                    r.parent().find("#istalking").first().hasClass("no-display") && (r.parent().find("#istalking").first().removeClass("no-display"), setTimeout(function() {
                        r.parent().find("#istalking").first().addClass("no-display")

                    },
                    2e3))

                } else if ("user_status" == e) main_chat_user_status(t.user.uid, t.user.status);
                else if ("usrlist" == e) for (i in t.user) main_append_dialog(t.user[i].uid, t.user[i].user),
                main_set_dialog(t.user[i].uid, t.user[i].user),
                main_chat_user_new(t.user[i].uid, t.user[i].status, t.user[i].name);
                else console.log("ERROR")

            }
            if (main_set_conf(), main_set_i18n(), main_set_theme(conf_theme_default), 0 == conf_tools_disabled && ($("#tools").removeClass("no-display"), $("#tools-icon").addClass(conf_tools_icon)/*, $("#tools-menu").append("<li><a id='tool_addgroup' href='#' target=''><span class='ui-icon ui-icon-plus'></span>添加分组</a></li>"), $("#tools-menu").append("<li><a id='tool_delgroup' href='#' target=''><span class='ui-icon ui-icon-minus'></span>删除分组</a></li>")*/), 0 == conf_options_disabled) {
                $("#options").removeClass("no-display"),
                $("#options-icon").addClass(conf_options_icon),
                $("#theme-custom").append("<option value='" + conf_theme_default + "' selected>" + conf_theme_default + "</option>");
                for (var i = 0; i < _jsConfigJs2["default"].themes.length; i++) $("#theme-custom").append("<option value='" + conf_themes[i] + "'>" + conf_themes[i] + "</option>");
                for (var i = 0; i < _jsConfigJs2["default"].lang.length; i++) conf_lang_i18n[i] == _jsConfigJs2["default"].lang_default ? $("#i18n").append("<option value='" + conf_lang_i18n[i] + "' selected='selected'>" + conf_lang_text[i] + "</option>") : $("#i18n").append("<option value='" + conf_lang_i18n[i] + "'>" + conf_lang_text[i] + "</option>")

            }
            main_chat_status(_jsI18n_enJs2["default"].disconnected, "offline"),
            main_chat_users_num(2, 0),
            0 == conf_bar_default_expand ? ($("#main").addClass("toolbar"), $("#main-rpanel").addClass("window"), $("#slide-bar-span").toggleClass(conf_bar_icon_collapse), $("#slide-bar").attr("title", _jsI18n_enJs2["default"].expand)) : ($("#main").addClass("toolbar-max"), $("#main-rpanel").removeClass("window"), $("#slide-bar-span").toggleClass(conf_bar_icon_expand), $("#slide-bar").attr("title", _jsI18n_enJs2["default"].collapse)),
            $("#tools, #options, #slide-bar").tipsy({
                fade: !0,
                gravity: $.fn.tipsy.autoBounds(150, "s")

            }),
            $("#tools, #options, #slide-bar, #chat-title-button").button(),
            $("#slide-bar").click(function() {
                return $(this).tipsy("hide"),
                $("#main").toggleClass("toolbar toolbar-max"),
                $("#main-rpanel").toggleClass("window"),
                $("#slide-bar-span").toggleClass(conf_bar_icon_expand),
                $("#slide-bar-span").toggleClass(conf_bar_icon_collapse),
                1 == $("#tools-panel").dialog("isOpen") && $("#tools-panel").dialog("close"),
                $("#main-rpanel").hasClass("window") ? $(this).attr("title", _jsI18n_enJs2["default"].expand) : $(this).attr("title", _jsI18n_enJs2["default"].collapse),
                !1

            }),
            $("#tools-menu").menu(),
            $("#tools-panel").dialog({
                autoOpen: !1,
                resizable: !1,
                modal: !1,
                minHeight: 100,
                maxHeight: 250,
                width: "auto",
                height: "auto",
                open: function() {
                    $(this).dialog("option", "title", _jsI18n_enJs2["default"].tools)

                },
                position: {
                    my: "left bottom",
                    at: "left top",
                    collision: "flip, none",
                    of: "#main"

                },
                show: {
                    effect: "clip",
                    duration: 500

                },
                hide: {
                    effect: "clip",
                    duration: 500

                }

            }),
            $("#options-accordion").accordion({
                collapsible: !1,
                heightStyle: "fill"

            }),
            $("#format").buttonset(),
            $("#options-panel").dialog({
                autoOpen: !1,
                resizable: !1,
                modal: !1,
                open: function() {
                    $(this).dialog("option", "title", _jsI18n_enJs2["default"].options)

                },
                position: {
                    my: "right bottom",
                    at: "right top",
                    collision: "flip, none",
                    of: "#main"

                },
                show: {
                    effect: "clip",
                    duration: 500

                },
                hide: {
                    effect: "clip",
                    duration: 500

                }

            });
            var name = $("#name"),
            email = $("#email"),
            allFields = $([]).add(name).add(email),
            tips = $(".validateTips");
            $("#dialog-login").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                modal: !0,
                buttons: [{
                    text: _jsI18n_enJs2["default"].login,
                    click: function() {
                        var t = !0;
                        allFields.removeClass("ui-state-error"),
                        t = t && checkLength(name, "username", 3, 16),
                        t = t && checkLength(email, "email", 6, 80),
                        t = t && checkRegexp(name, /^[a-z]([0-9a-z_])+$/i, _jsI18n_enJs2["default"].validate_username),
                        t = t && checkRegexp(email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. user@example.com"),
                        t && (login_email = email.val(), login_name = name.val(), $(this).dialog("close"), $("#chat-title-button").trigger("click"))

                    }

                },
                {
                    text: "i18n.cancel",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {
                    allFields.val("").removeClass("ui-state-error")

                }

            }),
            $("#upload").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "发送",
                    click: function() {
                        var t = $("input[name='file']").val(),
                        e = t.lastIndexOf("."),
                        i = t.substring(e, t.length).toUpperCase();
                        if (".BMP" != i && ".PNG" != i && ".GIF" != i && ".JPG" != i && ".JPEG" != i) return alert("图片限于bmp,png,gif,jpeg,jpg格式"),
                        !1;
                        var s = $("#sendfiletype").val();
                        "pic" == s && ($("#up").submit(), $(this).dialog("close"))

                    }

                },
                {
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#addgroup").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "添加",
                    click: function() {
                        var t = $("#groupname").val();
                        t = clean_msg(t),
                        "" != t && (Nitalk.user.addgroup(addgroup_callback, t), $(this).dialog("close"))

                    }

                },
                {
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#delgroup").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "删除",
                    click: function() {
                        var t = $("#groupdel").val(); - 1 != t && (Nitalk.user.delgroup(delgroup_callback, t), $(this).dialog("close"))

                    }

                },
                {
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#movgroup").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "移动",
                    click: function() {
                        var t = $("#groupmov").val();
                        if ( - 1 != t) {
                            var e = $("#user-" + curChatUserId),
                            i = $("#user-" + curChatUserId).parent().attr("id");
                            sourcegroupid = i.replace("main-sort-chat-", "");
                            var s = new Object;
                            s.userid = curChatUserId,
                            s.username = $(e).text(),
                            s.userstat = $(e).children("li").attr("class"),
                            s.groupid = t,
                            addFriend(s);
                            var n = new Object;
                            n.success = movgroup_callback,
                            n.sourcegroupid = sourcegroupid,
                            n.targetgroupid = t,
                            n.changeuserid = curChatUserId,
                            Nitalk.user.movgroup(n),
                            $(this).dialog("close")

                        }

                    }

                },
                {
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#history").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#emoji").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 270,
                modal: !0,
                buttons: [{
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#sysinfo").dialog({
                autoOpen: !1,
                resizable: !1,
                width: 350,
                height: 150,
                modal: !0,
                buttons: [{
                    text: "取消",
                    click: function() {
                        $(this).dialog("close")

                    }

                }],
                close: function() {}

            }),
            $("#tools").click(function() {
                main_do_dialog(this, "#tools-panel")

            }),
            $("#options").click(function() {
                main_do_dialog(this, "#options-panel"),
                $("#options-accordion").accordion("refresh")

            }),
            $("#refresh-li").click(function() {
                relogin(_inittalk_username, _inittalk_s)

            }),
            $(document).on("click", ".button-user", 
            function() {
                var t = $(this).attr("id"),
                e = $(this).attr("status"),
                i = $(this).text();
                main_append_dialog(t),
                main_set_dialog(t),
                main_chat_user_new(t, e, i)

            });
            var text_status = _jsI18n_enJs2["default"].custom_message,
            text_custom_msg = "",
            text_custom_msg_last;
            $("#text-status").val(text_status).button({}),
            $("#users").accordion({
                collapsible: !1,
                icons: {
                    header: "ui-icon-circle-arrow-e",
                    activeHeader: "ui-icon-circle-arrow-s"

                },
                heightStyle: "fill"

            }),
            $("#main-users-resizer").resizable({
                handles: "n, w",
                minHeight: 200,
                minWidth: 200,
                create: function() {
                    main_chat_set_position(0)

                },
                resize: function() {
                    $("#users").accordion("refresh")

                }

            }),
            $("#main-users-resizer").hide(),
            $("#main-sort-chat").sortable().disableSelection(),
            $(document).on("mouseover", ".user", 
            function() {
                var t = $(this).attr("id");
                $("#" + t).addClass("ui-state-default")

            }),
            $(document).on("mouseout", ".user", 
            function() {
                var t = $(this).attr("id");
                $("#" + t).removeClass("ui-state-default")

            }),
            $(document).on("click", ".user", 
            function() {
                if ($(this).hasClass("offline")) return ! 1;
                var t = "user-";
                if (null != $(this).attr("id")) {
                    var e = $(this).attr("id").substring(t.length);
                    if ("cs" == $(this).attr("id") && (e = "cs", 0 == $("#Dialogcs").find("#he").length && append_msg("he", "客服", csliid, '<font style="color: red;">您好，欢迎使用' + _inittalk_platformname + "在线客服，请问有什么可以为您服务？</font>", "cs2u", "txt")), "userup" == $(this).attr("id")) {
                        if ("none" == $(this).attr("userid")) return;
                        e = $(this).attr("userid")

                    }
                    if ("groupmsg" == $(this).attr("id") && (e = "groupmsg"), 0 == $("#users-button-bar").parent().find("#user-button-" + e).length) {
                        var i = $(this).text(),
                        s = $(this).find("li").attr("class");
                        "cs" == $(this).attr("id") && (i = "客服", s = $(this).attr("stat")),
                        "userup" == $(this).attr("id") && (i = "上级", s = $(this).attr("stat")),
                        "groupmsg" == $(this).attr("id") && (i = "群发下级"),
                        $("#users-button-bar").append("<button id='user-button-" + e + "' class='user-button' style='font-size: 65%;'><li class='" + s + "'>" + i + "</li></button>"),
                        $(".user-button").button()

                    }
                    return clickUserButton(e),
                    !1

                }

            }),
            $("#chat-icon-search").button({
                icons: {
                    primary: "ui-icon-search"

                },
                text: !1

            }),
            $("#chat-search-text").button().next().button({
                text: !1,
                icons: {
                    primary: "ui-icon-close"

                }

            }).parent().buttonset(),
            $("#chat-search-text").keyup(function() {
                if ($(this).val().length >= 1) {
                    var t = $(this).val();
                    $(".main-chat-window").find("a:not(:Contains(" + t + "))").parent().slideUp().parent().hide(),
                    $(".main-chat-window").find("a:Contains(" + t + ")").parent().slideDown().parent().show()

                } else $(".main-chat-window").find("li").slideDown().parent().show();
                return ! 1

            }),
            $("#chat-icon-close").click(function() {
                return $("#chat-search-text").val(""),
                $("#main-sort-chat").find("li").slideDown().parent().show(),
                $(".main-chat-window").find("li").slideDown().parent().show(),
                $("#no-users-found").length > 0 && $("#no-users-found").remove(),
                !1

            }),
            $("#chat-title-button").click(function() {
                $("#chat-title-warn").text(""),
                0 == chat_stat && (login(), main_chat_init()),
                $("#main-rpanel").hide(),
                $("#main-users-resizer").toggle(),
                main_chat_set_position(0)

            }),
            $("#rerun").button().click(function() {
                console.log("user status")

            }).next().button({
                text: !1,
                icons: {
                    primary: "ui-icon-triangle-1-s"

                }

            }).click(function() {
                var t = $(this).parent().next().show().position({
                    my: "left top",
                    at: "left bottom",
                    of: this

                });
                return $(document).one("click", 
                function() {
                    t.hide()

                }),
                !1

            }).parent().buttonset().next().hide().menu(),
            $(".user-status").click(function() {
                var t,
                e,
                i = $(this).attr("id"),
                s = $("#rerun-img").attr("src");
                if ("user-status-online" == i && "/images/nitalk/button_online.png" != s) {
                    if (!Nitalk.user.checkLogin()) return void relogin(_inittalk_username, _inittalk_s);
                    t = "online",
                    e = _jsI18n_enJs2["default"].connected

                } else if ("user-status-busy" == i && "/images/nitalk/busy.png" != s) {
                    if (!Nitalk.user.checkLogin()) return void relogin(_inittalk_username, _inittalk_s);
                    t = "busy",
                    e = _jsI18n_enJs2["default"].busy

                } else {
                    if ("user-status-offline" != i || "/images/nitalk/button_offline.png" == s) return "user-status-logout" == i ? (main_chat_disconnect(), !0) : !1;
                    t = "offline",
                    e = _jsI18n_enJs2["default"].offline

                }
                main_chat_status(e, t),
                user_status("user_status", t)

            }),
            $("#min-main-chat").click(function() {
                $("#chat-title-warn").text(""),
                $("#main-users-resizer").hide(),
                $("#main-rpanel").show()

            }),
            $("#text-status").focusin(function() {
                return text_custom_msg.length < 1 ? $(this).val("") : $(this).val(text_custom_msg),
                !1

            }),
            $("#text-status").focusout(function() {
                return text_custom_msg.length < 1 ? $(this).val(text_status) : $(this).val(text_custom_msg),
                !1

            }),
            $("#text-status").keydown(function(t) {
                return 13 == t.which ? ($(this).val().length < 1 ? ($(this).val(text_status), text_custom_msg = "") : text_custom_msg = clean_msg($(this).val()), text_custom_msg_last != text_custom_msg && user_status("user_status_msg", text_custom_msg), text_custom_msg_last = text_custom_msg, $(this).blur(), !1) : void 0

            }),
            $(document).ready(function() {
                1 == conf_auto_login && $("#chat-title-button").trigger("click")

            }),
            $(window).resize(function() {
                set_position()

            }),
            $(document).on("click", ".user-button", clickUserButton),
            $(document).on("click", ".msgimg", 
            function() {
                var t = $(this).attr("src");
                window.open(t)

            }),
			/*
            $(document).on("click", "#tool_addgroup", 
            function(t) {
                var e = t.pageX,
                i = t.pageY - 200;
                $("#groupname").val(""),
                $("#addgroup").dialog({
                    position: [e, i],
                    title: "增加分组"

                }),
                $("#addgroup").dialog("open")

            }),
            $(document).on("click", "#tool_delgroup", 
            function(t) {
                var e = t.pageX,
                i = t.pageY - 200;
                $("#groupdel")[0].selectedIndex = 0,
                $("#delgroup").dialog({
                    position: [e, i],
                    title: "删除分组"

                }),
                $("#delgroup").dialog("open")

            }),
			*/
            $(document).on("click", "#tool_groupinfo", 
            function(t) {
                alert("群发消息")

            });
            var setDraggable = function() {
                $(".user.user-pad").draggable({
                    revert: "invalid",
                    helper: "clone"

                })

            },
            setDroppable = function() {
                $("[id|=ui-accordion-users-header]").droppable({
                    hoverClass: "nitalk-group-drop-hover",
                    drop: function(t, e) {
                        user = $(e.draggable),
                        group = $(t.target);
                        var i = $(user).parent().attr("id");
                        sourcegroupid = i.replace("main-sort-chat-", "");
                        var s = new Object;
                        s.userid = $(user).attr("id").replace("user-", ""),
                        s.username = $(user).text(),
                        s.userstat = $(user).children("li").attr("class"),
                        s.groupid = $(group).attr("aria-controls").replace("users-window-chat-", ""),
                        addFriend(s),
                        $("#users").accordion("refresh"),
                        main_chat_set_position(0),
                        setDraggable();
                        var n = new Object;
                        n.success = movgroup_callback,
                        n.sourcegroupid = sourcegroupid,
                        n.targetgroupid = s.groupid,
                        n.changeuserid = s.userid,
                        Nitalk.user.movgroup(n)

                    }

                })

            },
            firstExpandList = !1;
            $("#theme-custom").change(function() {
                main_set_theme($(this).val())

            }),
            $("#radioenabled, #radiodisabled").change(function() {
                var t = $(this).attr("id");
                "radioenabled" == t ? conf_sound_active = !0: "radiodisabled" == t && (conf_sound_active = !1)

            }),
            $("#i18n").change(function() {
                var t = "i18n_" + $(this).val() + ".js";
                $.getScript(t, 
                function(t, e, i) {
                    main_set_i18n(),
                    $("#format").buttonset("destroy").buttonset(),
                    $(".ui-dialog-content").dialog("close"),
                    $("#main-users-resizer").hide(),
                    chat_changed_lang = !0

                })

            }),
            $("#slider").hide();
            var scrollPane = $(".slider_container"),
            scrollContent = $(".main-chat-window");
            $("#users-window-chat, #slider").mouseover(function() {
                var t = $("#users-window-chat").height(),
                e = $("#main-users-resizer").height() + 2,
                i = $("#main-sort-chat").height(),
                s = $("#users-window-chat").height();
                600 > e && i > s && ($("#slider").css("height", t), $("#slider").show())

            }),
            $("#users-window-chat, #slider").mouseout(function() {
                $("#slider").hide()

            });
            var scrollbar = $("#slider").slider({
                orientation: "vertical",
                value: 0,
                slide: function(t, e) {
                    scrollContent.height() > scrollPane.height() ? scrollContent.css("margin-top", -1 * (scrollPane.height() - scrollPane.height() * e.value / 100) + "px") : scrollContent.css("margin-top", 0)

                }

            });
            window._inittalk = _inittalk,
            window._inittalk_done || (window._inittalk_done = !0, window._inittalk(_inittalk_username, _inittalk_s, _inittalk_url)),
            window.getIframeVal = getIframeVal,
            window.enableSend = enableSend

        }).fail(function() {
            console.log("fail")

        }).always(function() {
            function t() {
                document.getElementById("main").style.display = "block",
                document.getElementById("options-panel").style.display = "block"

            }
            t()

        })

    }
    function configtalk(t, e, i, s, n, a, o) {
        window._inittalk_username = t,
        window._inittalk_s = e,
        window._inittalk_url = i,
        window._inittalk_platform = s,
        window._inittalk_platformname = n,
        window._inittalk_domain = a,
        window._inittalk_filedir = o

    }
    function inittalk() {
        window._inittalk && !_inittalk_done && (window._inittalk_done = !0, window._inittalk(_inittalk_username, _inittalk_s, _inittalk_url, _inittalk_platform))

    }
    Object.defineProperty(exports, "__esModule", {
        value: !0

    });
    var _nitalkSdk = __webpack_require__(11),
    _nitalkSdk2 = _interopRequireDefault(_nitalkSdk),
    _emojiEmoji = __webpack_require__(3),
    _emojiEmoji2 = _interopRequireDefault(_emojiEmoji),
    _emojiEmojieditor = __webpack_require__(7),
    _emojiEmojieditor2 = _interopRequireDefault(_emojiEmojieditor),
    _jsConfigJs = __webpack_require__(4),
    _jsConfigJs2 = _interopRequireDefault(_jsConfigJs),
    _jsI18n_enJs = __webpack_require__(5),
    _jsI18n_enJs2 = _interopRequireDefault(_jsI18n_enJs),
    Nitalk = new _nitalkSdk2["default"];
	console.log(_jsConfigJs2);
    exports.nitalk = nitalk,
    exports.configtalk = configtalk,
    exports.inittalk = inittalk

},
function(module, exports) {
    "use strict";

    function _classCallCheck(t, e) {
        if (! (t instanceof e)) throw new TypeError("Cannot call a class as a function")

    }
    function checkstat() {
        if (reconnect) {
            var t = "";
            $.ajax({
                type: "post",
                url: urlHeader + "gate",
                dataType: "json",
                data: "data=" + encodeUrl("method=checkstat&utype=user&userid=" + _uid + "&sessid=" + _sessid),
                success: function(e) {
					if (e && e.hasOwnProperty('Recvtype')) ws_onmessage(e);
                }

            })

        }

    }
    Object.defineProperty(exports, "__esModule", {
        value: !0

    });
    var _createClass = function() {
        function t(t, e) {
            for (var i = 0; i < e.length; i++) {
                var s = e[i];
                s.enumerable = s.enumerable || !1,
                s.configurable = !0,
                "value" in s && (s.writable = !0),
                Object.defineProperty(t, s.key, s)

            }

        }
        return function(e, i, s) {
            return i && t(e.prototype, i),
            s && t(e, s),
            e

        }

    } (),
    ws = null,
    reconnect = !1,
    urlHeader = "",
    filenodes = "",
    gatenodes = "",
    recordCount = 30,
    promoCode = "",
    promourl = "",
    isLogin = !1,
    _uid = "",
    _uname = "",
    _sessid = "",
    ws_onmessage = null,
    defaultHost = "",
    _proxyUrlHeader = "",
    _csid = "",
    _prefercsid = "",
    _csname = "",
    _csnickname = "",
    _logintype = "",
    _platform = "",
	_checkstat,
    nitalk_reset = function() {
        isLogin = !1,
        reconnect = !1,
        _uid = "",
        _uname = "",
        _sessid = "",
        _csid = "",
        _prefercsid = "",
        _csname = "",
        _csnickname = "",
        _logintype = "";
		clearInterval(_checkstat);
    },
    nitalk_init = function(t) {
        if ("object" != typeof t) throw new Error("Options is not a Object!");
        _proxyUrlHeader = t.proxyUrlHeader,
        _platform = t.platform,
        $.ajax({
            type: "post",
            url: _proxyUrlHeader + "init",
            dataType: "json",
            data: "utype=user",
            crossDomain: !0,
            success: function(e) {
                var i = e.Retcode;
                if (0 != i) return void alert("初始化失败");
                var s = e.Gatenode;
                gatenodes = s.split(","),
                nitalk_login(t)

            }

        })

    },
    nitalk_login = function t(e) {
        if ("object" != typeof e) throw new Error("Options is not a Object!");
        var i = e.success,
        s = e.func_onmessage,
        n = e.username,
        a = e.password,
        o = e.upformid,
        r = e.logintype,
        l = e.paramsessionid,
        c = Math.floor(Math.random() * gatenodes.length);
        defaultHost = gatenodes[c];
        var h = "";
        h = "webuser" == r ? "method=login&username=" + n + "&usertype=user&platform=" + _platform + "&s=" + l: "method=login&username=" + n + "&usertype=user&platform=" + _platform + "&userattr=usepass&password=" + a,
        urlHeader = "http://" + defaultHost + "/",
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl(h),
            crossDomain: !0,
            success: function(t) {
                if (_uid = t.Userid, _uname = n, reconnect = !0, promoCode = t.Promocode, promourl = urlHeader + "promo?u=" + promoCode, $("#promoUrl").html(promourl), $("#promoUrl").attr("href", promourl), filenodes = t.Filenodes, _sessid = t.Sessid, setUpformaction(filenodes, o), "0" == t.Retcode) {
                    isLogin = !0,
                    ws_onmessage = s;
                    _checkstat = setInterval(checkstat, 3000);
                    i(t);
                }

            },
            error: function() {
                for (var i = new Array(gatenodes.length - 1), s = 0, n = 0; n < gatenodes.length; n++) gatenodes[n] != defaultHost && (i[s] = gatenodes[n], s++);
                gatenodes = i,
                t(e)

            }

        })

    },
    nitalk_getFriends = function(t) {
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=getgroups&utype=user&username=" + _uname + "&userid=" + _uid + "&sessid=" + _sessid),
            success: function(e) {
                t(e)

            }

        })

    },
    nitalk_sendmsg = function(t, e) {
        if ("object" != typeof t) throw new Error("Options is not a Object!");
        var i = e,
        s = t.msgtype,
        n = t.chattype,
        a = t.msg,
        o = t.usertype,
        r = t.toutype,
        l = t.touserid,
        c = t.tousername,
        h = t.frnickname,
        u = t.tonickname;
        "cs" == r && (l = _csid, c = _csname, u = _csnickname),
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=sendmsg&msgtype=" + s + "&chattype=" + n + "&utype=" + o + "&toutype=" + r + "&touid=" + l + "&touname=" + c + "&frnickname=" + h + "&tonickname=" + u + "&username=" + _uname + "&userid=" + _uid + "&sessid=" + _sessid + "&msg=" + a),
            success: function(e) {
                i(e, t)

            }

        })

    },
    nitalk_assigncs = function(t) {
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=assigncs&utype=user&userid=" + _uid + "&sessid=" + _sessid + "&preferid=" + _prefercsid),
            success: function(e) {
                t(e)

            }

        })

    },
    nitalk_csjoined = function() {
        return "" == _csid ? !1: !0

    },
    nitalk_changestat = function(t, e) {
		if (e == 'busy') {
			clearInterval(_checkstat);
		} else {
			$("#refresh-li").trigger('click');
		}
    },
    nitalk_addgroup = function(t, e) {
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=manage&optype=addgroup&utype=user&groupname=" + e + "&userid=" + _uid + "&sessid=" + _sessid),
            success: function(i) {
                t(i, e)

            }

        })

    },
    nitalk_delgroup = function(t, e) {
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=manage&optype=delgroup&utype=user&groupid=" + e + "&userid=" + _uid + "&sessid=" + _sessid),
            success: function(i) {
                t(i, e)

            }

        })

    },
    nitalk_movgroup = function(t) {
        var e = t.success,
        i = t.sourcegroupid,
        s = t.targetgroupid,
        n = t.changeuserid;
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=manage&optype=movmember&utype=user&ogroupid=" + i + "&touid=" + n + "&groupid=" + s + "&userid=" + _uid + "&sessid=" + _sessid),
            success: function(i) {
                e(i, t)

            }

        })

    },
    nitalk_talkdate = function(t, e) {
        var i = e.touserid,
        s = e.toutype;
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=chatrecsdate&userid=" + _uid + "&utype=user&touid=" + i + "&toutype=" + s + "&fruid=" + _uid + "&frutype=user&sessid=" + _sessid),
            success: function(i) {
                t(i, e)

            }

        })

    },
    nitalk_talkrecord = function(t, e) {
        var i = e.touserid,
        s = e.toutype,
        n = e.talkday;
        $.ajax({
            type: "post",
            url: urlHeader + "gate",
            dataType: "json",
            data: "data=" + encodeUrl("method=chatrecs&userid=" + _uid + "&utype=user&touid=" + i + "&date=" + n + "&toutype=" + s + "&fruid=" + _uid + "&frutype=user&sessid=" + _sessid),
            success: function(i) {
                t(i, e)

            }

        })

    },
    nitalk_logout = function() {
        _uid = "",
        _uname = "",
        _sessid = "",
        reconnect = !1

    },
    nitalk_checkLogin = function() {
        return isLogin

    },
    setUpformaction = function(t, e) {
        var i = null;
        for (var s in t) if (i = t[s], null != i) break;
        var n = "http://" + window.location.host + "/nitalk/js/cb.html",
        a = "http://" + i + "/upload?file_utype=user&file_uid=" + _uid + "&file_sessid=" + _sessid + "&cb=" + n;
        $("#" + e).attr("action", a)

    },
    encodeUrl = function(t) {
        return encodeURIComponent(t)

    },
    Nitalk = function() {
        function t() {
            _classCallCheck(this, t),
            this.user = {
                login: nitalk_init,
                getFriends: nitalk_getFriends,
                sendmsg: nitalk_sendmsg,
                logout: nitalk_logout,
                assigncs: nitalk_assigncs,
                csjoined: nitalk_csjoined,
                changestat: nitalk_changestat,
                addgroup: nitalk_addgroup,
                delgroup: nitalk_delgroup,
                movgroup: nitalk_movgroup,
                talkdate: nitalk_talkdate,
                talkrecord: nitalk_talkrecord,
                reset: nitalk_reset,
                checkLogin: nitalk_checkLogin

            }

        }
        return _createClass(t, [{
            key: "getPromourl",
            value: function() {
                return promourl

            }

        },
        {
            key: "warn",
            value: function(t) {
                alert(t)

            }

        }]),
        t

    } ();
    exports["default"] = Nitalk,
    module.exports = exports["default"]

},
function(t, e) {
    "use strict";
    ! 
    function(t) {
        t.Zebra_DatePicker = function(e, i) {
            var s,
            n,
            a,
            o,
            r,
            l,
            c,
            h,
            u,
            d,
            p,
            f,
            g,
            m,
            _,
            b,
            v,
            y,
            w,
            k,
            x,
            D,
            C,
            $,
            I,
            P,
            T,
            M,
            z,
            j,
            S,
            A,
            F,
            H,
            E,
            N,
            O = {
                always_visible: !1,
                container: t("body"),
                days: ["日", "一", "二", "三", "四", "五", "六"],
                days_abbr: !1,
                default_position: "above",
                direction: 0,
                disabled_dates: !1,
                enabled_dates: !1,
                first_day_of_week: 1,
                format: "Y-m-d",
                header_captions: {
                    days: "F, Y",
                    months: "Y",
                    years: "Y1 - Y2"

                },
                header_navigation: ["&#171;", "&#187;"],
                inside: !0,
                lang_clear_date: "Clear date",
                months: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                months_abbr: !1,
                offset: [5, -5],
                pair: !1,
                readonly_element: !0,
                select_other_months: !1,
                show_clear_date: 0,
                show_icon: !0,
                show_other_months: !0,
                show_select_today: "今日",
                show_week_number: !1,
                start_date: !1,
                strict: !1,
                view: "days",
                weekend_days: [0, 6],
                zero_pad: !1,
                onChange: null,
                onClear: null,
                onOpen: null,
                onSelect: null

            },
            W = this;
            W.settings = {};
            var R = t(e),
            L = function lt(e) {
                if (!e) {
                    W.settings = t.extend({},
                    O, i);
                    for (var D in R.data()) 0 === D.indexOf("zdp_") && (D = D.replace(/^zdp\_/, ""), void 0 !== O[D] && (W.settings[D] = "pair" == D ? t(R.data("zdp_" + D)) : R.data("zdp_" + D)))

                }
                W.settings.readonly_element && R.attr("readonly", "readonly");
                var M = {
                    days: ["d", "j", "D"],
                    months: ["F", "m", "M", "n", "t"],
                    years: ["o", "Y", "y"]

                },
                z = !1,
                j = !1,
                lt = !1,
                L = null;
                for (L in M) t.each(M[L], 
                function(t, e) {
                    W.settings.format.indexOf(e) > -1 && ("days" == L ? z = !0: "months" == L ? j = !0: "years" == L && (lt = !0))

                });
                S = z && j && lt ? ["years", "months", "days"] : !z && j && lt ? ["years", "months"] : z && j && !lt ? ["months", "days"] : z || j || !lt ? z || !j || lt ? ["years", "months", "days"] : ["months"] : ["years"],
                -1 == t.inArray(W.settings.view, S) && (W.settings.view = S[S.length - 1]),
                x = [],
                k = [];
                for (var B, J = 0; 2 > J; J++) B = 0 === J ? W.settings.disabled_dates: W.settings.enabled_dates,
                t.isArray(B) && B.length > 0 && t.each(B, 
                function() {
                    for (var e = this.split(" "), i = 0; 4 > i; i++) {
                        e[i] || (e[i] = "*"),
                        e[i] = e[i].indexOf(",") > -1 ? e[i].split(",") : new Array(e[i]);
                        for (var s = 0; s < e[i].length; s++) if (e[i][s].indexOf("-") > -1) {
                            var n = e[i][s].match(/^([0-9]+)\-([0-9]+)/);
                            if (null !== n) {
                                for (var a = nt(n[1]); a <= nt(n[2]); a++) - 1 == t.inArray(a, e[i]) && e[i].push(a + "");
                                e[i].splice(s, 1)

                            }

                        }
                        for (s = 0; s < e[i].length; s++) e[i][s] = isNaN(nt(e[i][s])) ? e[i][s] : nt(e[i][s])

                    }
                    0 === J ? x.push(e) : k.push(e)

                });
                var q,
                Z,
                K = new Date,
                V = W.settings.reference_date ? W.settings.reference_date: R.data("zdp_reference_date") && void 0 !== R.data("zdp_reference_date") ? R.data("zdp_reference_date") : K;
                if (C = void 0, $ = void 0, f = V.getMonth(), u = K.getMonth(), g = V.getFullYear(), d = K.getFullYear(), m = V.getDate(), p = K.getDate(), W.settings.direction === !0) C = V;
                else if (W.settings.direction === !1) $ = V,
                T = $.getMonth(),
                P = $.getFullYear(),
                I = $.getDate();
                else if (!t.isArray(W.settings.direction) && Q(W.settings.direction) && nt(W.settings.direction) > 0 || t.isArray(W.settings.direction) && ((q = Y(W.settings.direction[0])) || W.settings.direction[0] === !0 || Q(W.settings.direction[0]) && W.settings.direction[0] > 0) && ((Z = Y(W.settings.direction[1])) || W.settings.direction[1] === !1 || Q(W.settings.direction[1]) && W.settings.direction[1] >= 0)) C = q ? q: new Date(g, f, m + nt(t.isArray(W.settings.direction) ? W.settings.direction[0] === !0 ? 0: W.settings.direction[0] : W.settings.direction)),
                f = C.getMonth(),
                g = C.getFullYear(),
                m = C.getDate(),
                Z && +Z >= +C ? $ = Z: !Z && W.settings.direction[1] !== !1 && t.isArray(W.settings.direction) && ($ = new Date(g, f, m + nt(W.settings.direction[1]))),
                $ && (T = $.getMonth(), P = $.getFullYear(), I = $.getDate());
                else if (!t.isArray(W.settings.direction) && Q(W.settings.direction) && nt(W.settings.direction) < 0 || t.isArray(W.settings.direction) && (W.settings.direction[0] === !1 || Q(W.settings.direction[0]) && W.settings.direction[0] < 0) && ((q = Y(W.settings.direction[1])) || Q(W.settings.direction[1]) && W.settings.direction[1] >= 0)) $ = new Date(g, f, m + nt(t.isArray(W.settings.direction) ? W.settings.direction[0] === !1 ? 0: W.settings.direction[0] : W.settings.direction)),
                T = $.getMonth(),
                P = $.getFullYear(),
                I = $.getDate(),
                q && +$ > +q ? C = q: !q && t.isArray(W.settings.direction) && (C = new Date(P, T, I - nt(W.settings.direction[1]))),
                C && (f = C.getMonth(), g = C.getFullYear(), m = C.getDate());
                else if (t.isArray(W.settings.disabled_dates) && W.settings.disabled_dates.length > 0) for (var X in x) if ("*" == x[X][0] && "*" == x[X][1] && "*" == x[X][2] && "*" == x[X][3]) {
                    var it = [];
                    if (t.each(k, 
                    function() {
                        var t = this;
                        "*" != t[2][0] && it.push(parseInt(t[2][0] + ("*" == t[1][0] ? "12": st(t[1][0], 2)) + ("*" == t[0][0] ? "*" == t[1][0] ? "31": new Date(t[2][0], t[1][0], 0).getDate() : st(t[0][0], 2)), 10))

                    }), it.sort(), it.length > 0) {
                        var ot = (it[0] + "").match(/([0-9]{4})([0-9]{2})([0-9]{2})/);
                        g = parseInt(ot[1], 10),
                        f = parseInt(ot[2], 10) - 1,
                        m = parseInt(ot[3], 10)

                    }
                    break

                }
                if (G(g, f, m)) {
                    for (; G(g);) C ? (g++, f = 0) : (g--, f = 11);
                    for (; G(g, f);) C ? (f++, m = 1) : (f--, m = new Date(g, f + 1, 0).getDate()),
                    f > 11 ? (g++, f = 0, m = 1) : 0 > f && (g--, f = 11, m = new Date(g, f + 1, 0).getDate());
                    for (; G(g, f, m);) C ? m++:m--,
                    K = new Date(g, f, m),
                    g = K.getFullYear(),
                    f = K.getMonth(),
                    m = K.getDate();
                    K = new Date(g, f, m),
                    g = K.getFullYear(),
                    f = K.getMonth(),
                    m = K.getDate()

                }
                var ct = Y(R.val() || (W.settings.start_date ? W.settings.start_date: ""));
                if (ct && W.settings.strict && G(ct.getFullYear(), ct.getMonth(), ct.getDate()) && R.val(""), e || void 0 === C && void 0 === ct || at(void 0 !== C ? C: ct), !W.settings.always_visible) {
                    if (!e) {
                        if (W.settings.show_icon) {
                            "firefox" == rt.name && R.is('input[type="text"]') && "inline" == R.css("display") && R.css("display", "inline-block");
                            var ht = t('<span class="Zebra_DatePicker_Icon_Wrapper"></span>').css({
                                display: R.css("display"),
                                position: "static" == R.css("position") ? "relative": R.css("position"),
                                "float": R.css("float"),
                                top: R.css("top"),
                                right: R.css("right"),
                                bottom: R.css("bottom"),
                                left: R.css("left")

                            });
                            R.wrap(ht).css({
                                position: "relative",
                                top: "auto",
                                right: "auto",
                                bottom: "auto",
                                left: "auto"

                            }),
                            a = t('<button type="button" class="Zebra_DatePicker_Icon' + ("disabled" == R.attr("disabled") ? " Zebra_DatePicker_Icon_Disabled": "") + '">Pick a date</button>'),
                            W.icon = a,
                            A = a.add(R)

                        } else A = R;
                        A.bind("click", 
                        function(t) {
                            t.preventDefault(),
                            R.attr("disabled") || (n.hasClass("dp_visible") ? W.hide() : W.show())

                        }),
                        void 0 !== a && a.insertAfter(R)

                    }
                    if (void 0 !== a) {
                        a.attr("style", ""),
                        W.settings.inside && a.addClass("Zebra_DatePicker_Icon_Inside");
                        var ut = R.outerWidth(),
                        dt = R.outerHeight(),
                        pt = parseInt(R.css("marginLeft"), 10) || 0,
                        ft = parseInt(R.css("marginTop"), 10) || 0,
                        gt = a.outerWidth(),
                        mt = a.outerHeight(),
                        _t = parseInt(a.css("marginLeft"), 10) || 0,
                        bt = parseInt(a.css("marginRight"), 10) || 0;
                        W.settings.inside ? a.css({
                            top: ft + (dt - mt) / 2,
                            left: pt + (ut - gt - bt)

                        }) : a.css({
                            top: ft + (dt - mt) / 2,
                            left: pt + ut + _t

                        }),
                        a.removeClass(" Zebra_DatePicker_Icon_Disabled"),
                        "disabled" == R.attr("disabled") && a.addClass("Zebra_DatePicker_Icon_Disabled")

                    }

                }
                if (E = W.settings.show_select_today !== !1 && t.inArray("days", S) > -1 && !G(d, u, p) ? W.settings.show_select_today: !1, !e) {
                    t(window).bind("resize.Zebra_DatePicker", 
                    function() {
                        W.hide(),
                        void 0 !== a && (clearTimeout(N), N = setTimeout(function() {
                            W.update()

                        },
                        100))

                    });
                    var vt = '<div class="Zebra_DatePicker"><table class="dp_header"><tr><td class="dp_previous">' + W.settings.header_navigation[0] + '</td><td class="dp_caption">&#032;</td><td class="dp_next">' + W.settings.header_navigation[1] + '</td></tr></table><table class="dp_daypicker"></table><table class="dp_monthpicker"></table><table class="dp_yearpicker"></table><table class="dp_footer"><tr><td class="dp_today"' + (W.settings.show_clear_date !== !1 ? ' style="width:50%"': "") + ">" + E + '</td><td class="dp_clear"' + (E !== !1 ? ' style="width:50%"': "") + ">" + W.settings.lang_clear_date + "</td></tr></table></div>";
                    n = t(vt),
                    W.datepicker = n,
                    o = t("table.dp_header", n),
                    r = t("table.dp_daypicker", n),
                    l = t("table.dp_monthpicker", n),
                    c = t("table.dp_yearpicker", n),
                    H = t("table.dp_footer", n),
                    F = t("td.dp_today", H),
                    h = t("td.dp_clear", H),
                    W.settings.always_visible ? R.attr("disabled") || (W.settings.always_visible.append(n), W.show()) : W.settings.container.append(n),
                    n.delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", "mouseover", 
                    function() {
                        t(this).addClass("dp_hover")

                    }).delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", "mouseout", 
                    function() {
                        t(this).removeClass("dp_hover")

                    }),
                    U(t("td", o)),
                    t(".dp_previous", o).bind("click", 
                    function() {
                        "months" == s ? b--:"years" == s ? b -= 12: --_ < 0 && (_ = 11, b--),
                        tt()

                    }),
                    t(".dp_caption", o).bind("click", 
                    function() {
                        s = "days" == s ? t.inArray("months", S) > -1 ? "months": t.inArray("years", S) > -1 ? "years": "days": "months" == s ? t.inArray("years", S) > -1 ? "years": t.inArray("days", S) > -1 ? "days": "months": t.inArray("days", S) > -1 ? "days": t.inArray("months", S) > -1 ? "months": "years",
                        tt()

                    }),
                    t(".dp_next", o).bind("click", 
                    function() {
                        "months" == s ? b++:"years" == s ? b += 12: 12 == ++_ && (_ = 0, b++),
                        tt()

                    }),
                    r.delegate("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", "click", 
                    function() {
                        W.settings.select_other_months && null !== (ot = t(this).attr("class").match(/date\_([0-9]{4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/)) ? et(ot[1], ot[2] - 1, ot[3], "days", t(this)) : et(b, _, nt(t(this).html()), "days", t(this))

                    }),
                    l.delegate("td:not(.dp_disabled)", "click", 
                    function() {
                        var e = t(this).attr("class").match(/dp\_month\_([0-9]+)/);
                        _ = nt(e[1]),
                        -1 == t.inArray("days", S) ? et(b, _, 1, "months", t(this)) : (s = "days", W.settings.always_visible && R.val(""), tt())

                    }),
                    c.delegate("td:not(.dp_disabled)", "click", 
                    function() {
                        b = nt(t(this).html()),
                        -1 == t.inArray("months", S) ? et(b, 1, 1, "years", t(this)) : (s = "months", W.settings.always_visible && R.val(""), tt())

                    }),
                    t(F).bind("click", 
                    function(e) {
                        e.preventDefault(),
                        et(d, u, p, "days", t(".dp_current", r)),
                        W.settings.always_visible && W.show(),
                        W.hide()

                    }),
                    t(h).bind("click", 
                    function(e) {
                        e.preventDefault(),
                        R.val(""),
                        W.settings.always_visible ? (v = null, y = null, w = null, t("td.dp_selected", n).removeClass("dp_selected")) : (v = null, y = null, w = null, _ = null, b = null),
                        W.hide(),
                        W.settings.onClear && "function" == typeof W.settings.onClear && W.settings.onClear.call(R, R)

                    }),
                    W.settings.always_visible || t(document).bind({
                        "mousedown.Zebra_DatePicker": function(e) {
                            if (n.hasClass("dp_visible")) {
                                if (W.settings.show_icon && t(e.target).get(0) === a.get(0)) return ! 0;
                                0 === t(e.target).parents().filter(".Zebra_DatePicker").length && W.hide()

                            }

                        },
                        "keyup.Zebra_DatePicker": function(t) {
                            n.hasClass("dp_visible") && 27 == t.which && W.hide()

                        }

                    }),
                    tt()

                }

            };
            W.destroy = function() {
                void 0 !== W.icon && W.icon.remove(),
                W.datepicker.remove(),
                t(document).unbind("keyup.Zebra_DatePicker"),
                t(document).unbind("mousedown.Zebra_DatePicker"),
                t(window).unbind("resize.Zebra_DatePicker"),
                R.removeData("Zebra_DatePicker")

            },
            W.hide = function() {
                W.settings.always_visible || (V("hide"), n.removeClass("dp_visible").addClass("dp_hidden"))

            },
            W.show = function() {
                s = W.settings.view;
                var e = Y(R.val() || (W.settings.start_date ? W.settings.start_date: ""));
                if (e ? (y = e.getMonth(), _ = e.getMonth(), w = e.getFullYear(), b = e.getFullYear(), v = e.getDate(), G(w, y, v) && (W.settings.strict && R.val(""), _ = f, b = g)) : (_ = f, b = g), tt(), W.settings.always_visible) n.removeClass("dp_hidden").addClass("dp_visible");
                else {
                    if (W.settings.container.is("body")) {
                        var i = n.outerWidth(),
                        o = n.outerHeight(),
                        r = (void 0 !== a ? a.offset().left + a.outerWidth(!0) : R.offset().left + R.outerWidth(!0)) + W.settings.offset[0],
                        l = (void 0 !== a ? a.offset().top: R.offset().top) - o + W.settings.offset[1],
                        c = t(window).width(),
                        h = t(window).height(),
                        u = t(window).scrollTop(),
                        d = t(window).scrollLeft();
                        "below" == W.settings.default_position && (l = (void 0 !== a ? a.offset().top: R.offset().top) + W.settings.offset[1]),
                        r + i > d + c && (r = d + c - i),
                        d > r && (r = d),
                        l + o > u + h && (l = u + h - o),
                        u > l && (l = u),
                        n.css({
                            left: r,
                            top: l

                        })

                    } else n.css({
                        left: 0,
                        top: 0

                    });
                    n.removeClass("dp_hidden").addClass("dp_visible"),
                    V()

                }
                W.settings.onOpen && "function" == typeof W.settings.onOpen && W.settings.onOpen.call(R, R)

            },
            W.update = function(e) {
                W.original_direction && (W.original_direction = W.direction),
                W.settings = t.extend(W.settings, e),
                L(!0)

            };
            var Y = function(e) {
                if (e += "", "" !== t.trim(e)) {
                    for (var i = B(W.settings.format), s = ["d", "D", "j", "l", "N", "S", "w", "F", "m", "M", "n", "Y", "y"], n = [], a = [], o = null, r = null, l = 0; l < s.length; l++)(o = i.indexOf(s[l])) > -1 && n.push({
                        character: s[l],
                        position: o

                    });
                    if (n.sort(function(t, e) {
                        return t.position - e.position

                    }), t.each(n, 
                    function(t, e) {
                        switch (e.character) {
                            case "d":
                            a.push("0[1-9]|[12][0-9]|3[01]");
                            break;
                            case "D":
                            a.push("[a-z]{3}");
                            break;
                            case "j":
                            a.push("[1-9]|[12][0-9]|3[01]");
                            break;
                            case "l":
                            a.push("[a-z]+");
                            break;
                            case "N":
                            a.push("[1-7]");
                            break;
                            case "S":
                            a.push("st|nd|rd|th");
                            break;
                            case "w":
                            a.push("[0-6]");
                            break;
                            case "F":
                            a.push("[a-z]+");
                            break;
                            case "m":
                            a.push("0[1-9]|1[012]+");
                            break;
                            case "M":
                            a.push("[a-z]{3}");
                            break;
                            case "n":
                            a.push("[1-9]|1[012]");
                            break;
                            case "Y":
                            a.push("[0-9]{4}");
                            break;
                            case "y":
                            a.push("[0-9]{2}")

                        }

                    }), a.length && (n.reverse(), t.each(n, 
                    function(t, e) {
                        i = i.replace(e.character, "(" + a[a.length - t - 1] + ")")

                    }), a = new RegExp("^" + i + "$", "ig"), r = a.exec(e))) {
                        var c,
                        h = new Date,
                        u = 1,
                        d = h.getMonth() + 1,
                        p = h.getFullYear(),
                        f = ["日", "一", "二", "三", "四", "五", "六"],
                        g = ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
                        m = !0;
                        if (n.reverse(), t.each(n, 
                        function(e, i) {
                            if (!m) return ! 0;
                            switch (i.character) {
                                case "m":
                            case "n":
                                d = nt(r[e + 1]);
                                break;
                                case "d":
                            case "j":
                                u = nt(r[e + 1]);
                                break;
                                case "D":
                            case "l":
                            case "F":
                            case "M":
                                c = "D" == i.character || "l" == i.character ? W.settings.days: W.settings.months,
                                m = !1,
                                t.each(c, 
                                function(t, s) {
                                    if (m) return ! 0;
                                    if (r[e + 1].toLowerCase() == s.substring(0, "D" == i.character || "M" == i.character ? 3: s.length).toLowerCase()) {
                                        switch (i.character) {
                                            case "D":
                                            r[e + 1] = f[t].substring(0, 3);
                                            break;
                                            case "l":
                                            r[e + 1] = f[t];
                                            break;
                                            case "F":
                                            r[e + 1] = g[t],
                                            d = t + 1;
                                            break;
                                            case "M":
                                            r[e + 1] = g[t].substring(0, 3),
                                            d = t + 1

                                        }
                                        m = !0

                                    }

                                });
                                break;
                                case "Y":
                                p = nt(r[e + 1]);
                                break;
                                case "y":
                                p = "19" + nt(r[e + 1])

                            }

                        }), m) {
                            var _ = new Date(p, (d || 1) - 1, u || 1);
                            if (_.getFullYear() == p && _.getDate() == (u || 1) && _.getMonth() == (d || 1) - 1) return _

                        }

                    }
                    return ! 1

                }

            },
            U = function(t) {
                "firefox" == rt.name ? t.css("MozUserSelect", "none") : "explorer" == rt.name ? t.bind("selectstart", 
                function() {
                    return ! 1

                }) : t.mousedown(function() {
                    return ! 1

                })

            },
            B = function(t) {
                return t.replace(/([-.,*+?^${}()|[\]\/\\])/g, "\\$1")

            },
            J = function(e) {
                for (var i = "", s = e.getDate(), n = e.getDay(), a = W.settings.days[n], o = e.getMonth() + 1, r = W.settings.months[o - 1], l = e.getFullYear() + "", c = 0; c < W.settings.format.length; c++) {
                    var h = W.settings.format.charAt(c);
                    switch (h) {
                        case "y":
                        l = l.substr(2);
                        case "Y":
                        i += l;
                        break;
                        case "m":
                        o = st(o, 2);
                        case "n":
                        i += o;
                        break;
                        case "M":
                        r = t.isArray(W.settings.months_abbr) && void 0 !== W.settings.months_abbr[o - 1] ? W.settings.months_abbr[o - 1] : W.settings.months[o - 1].substr(0, 3);
                        case "F":
                        i += r;
                        break;
                        case "d":
                        s = st(s, 2);
                        case "j":
                        i += s;
                        break;
                        case "D":
                        a = t.isArray(W.settings.days_abbr) && void 0 !== W.settings.days_abbr[n] ? W.settings.days_abbr[n] : W.settings.days[n].substr(0, 3);
                        case "l":
                        i += a;
                        break;
                        case "N":
                        n++;
                        case "w":
                        i += n;
                        break;
                        case "S":
                        i += s % 10 == 1 && "11" != s ? "st": s % 10 == 2 && "12" != s ? "nd": s % 10 == 3 && "13" != s ? "rd": "th";
                        break;
                        default:
                        i += h

                    }

                }
                return i

            },
            q = function() {
                var e = new Date(b, _ + 1, 0).getDate(),
                i = new Date(b, _, 1).getDay(),
                s = new Date(b, _, 0).getDate(),
                n = i - W.settings.first_day_of_week;
                n = 0 > n ? 7 + n: n,
                X(W.settings.header_captions.days);
                var a = "<tr>";
                W.settings.show_week_number && (a += "<th>" + W.settings.show_week_number + "</th>");
                for (var o = 0; 7 > o; o++) a += "<th>" + (t.isArray(W.settings.days_abbr) && void 0 !== W.settings.days_abbr[(W.settings.first_day_of_week + o) % 7] ? W.settings.days_abbr[(W.settings.first_day_of_week + o) % 7] : W.settings.days[(W.settings.first_day_of_week + o) % 7].substr(0, 2)) + "</th>";
                for (a += "</tr><tr>", o = 0; 42 > o; o++) {
                    o > 0 && o % 7 === 0 && (a += "</tr><tr>"),
                    o % 7 === 0 && W.settings.show_week_number && (a += '<td class="dp_week_number">' + ot(new Date(b, _, o - n + 1)) + "</td>");
                    var l = o - n + 1;
                    if (W.settings.select_other_months && (n > o || l > e)) {
                        var c = new Date(b, _, l),
                        h = c.getFullYear(),
                        f = c.getMonth(),
                        g = c.getDate();
                        c = h + st(f + 1, 2) + st(g, 2)

                    }
                    if (n > o) a += '<td class="' + (W.settings.select_other_months && !G(h, f, g) ? "dp_not_in_month_selectable date_" + c: "dp_not_in_month") + '">' + (W.settings.select_other_months || W.settings.show_other_months ? st(s - n + o + 1, W.settings.zero_pad ? 2: 0) : "&nbsp;") + "</td>";
                    else if (l > e) a += '<td class="' + (W.settings.select_other_months && !G(h, f, g) ? "dp_not_in_month_selectable date_" + c: "dp_not_in_month") + '">' + (W.settings.select_other_months || W.settings.show_other_months ? st(l - e, W.settings.zero_pad ? 2: 0) : "&nbsp;") + "</td>";
                    else {
                        var m = (W.settings.first_day_of_week + o) % 7,
                        k = "";
                        G(b, _, l) ? (t.inArray(m, W.settings.weekend_days) > -1 ? k = "dp_weekend_disabled": k += " dp_disabled", _ == u && b == d && p == l && (k += " dp_disabled_current")) : (t.inArray(m, W.settings.weekend_days) > -1 && (k = "dp_weekend"), _ == y && b == w && v == l && (k += " dp_selected"), _ == u && b == d && p == l && (k += " dp_current")),
                        a += "<td" + ("" !== k ? ' class="' + t.trim(k) + '"': "") + ">" + (W.settings.zero_pad ? st(l, 2) : l) + "</td>"

                    }

                }
                a += "</tr>",
                r.html(t(a)),
                W.settings.always_visible && (M = t("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month, .dp_week_number)", r)),
                r.show()

            },
            Z = function() {
                X(W.settings.header_captions.months);
                for (var e = "<tr>", i = 0; 12 > i; i++) {
                    i > 0 && i % 3 === 0 && (e += "</tr><tr>");
                    var s = "dp_month_" + i;
                    G(b, i) ? s += " dp_disabled": y !== !1 && y == i && b == w ? s += " dp_selected": u == i && d == b && (s += " dp_current"),
                    e += '<td class="' + t.trim(s) + '">' + (t.isArray(W.settings.months_abbr) && void 0 !== W.settings.months_abbr[i] ? W.settings.months_abbr[i] : W.settings.months[i].substr(0, 3)) + "</td>"

                }
                e += "</tr>",
                l.html(t(e)),
                W.settings.always_visible && (z = t("td:not(.dp_disabled)", l)),
                l.show()

            },
            K = function() {
                X(W.settings.header_captions.years);
                for (var e = "<tr>", i = 0; 12 > i; i++) {
                    i > 0 && i % 3 === 0 && (e += "</tr><tr>");
                    var s = "";
                    G(b - 7 + i) ? s += " dp_disabled": w && w == b - 7 + i ? s += " dp_selected": d == b - 7 + i && (s += " dp_current"),
                    e += "<td" + ("" !== t.trim(s) ? ' class="' + t.trim(s) + '"': "") + ">" + (b - 7 + i) + "</td>"

                }
                e += "</tr>",
                c.html(t(e)),
                W.settings.always_visible && (j = t("td:not(.dp_disabled)", c)),
                c.show()

            },
            V = function(e) {
                if ("explorer" == rt.name && 6 == rt.version) {
                    if (!D) {
                        var i = nt(n.css("zIndex")) - 1;
                        D = t("<iframe>", {
                            src: 'javascript:document.write("")',
                            scrolling: "no",
                            frameborder: 0,
                            css: {
                                zIndex: i,
                                position: "absolute",
                                top: -1e3,
                                left: -1e3,
                                width: n.outerWidth(),
                                height: n.outerHeight(),
                                filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=0)",
                                display: "none"

                            }

                        }),
                        t("body").append(D)

                    }
                    switch (e) {
                        case "hide":
                        D.hide();
                        break;
                        default:
                        var s = n.offset();
                        D.css({
                            top: s.top,
                            left: s.left,
                            display: "block"

                        })

                    }

                }

            },
            G = function(e, i, s) {
                if ((void 0 === e || isNaN(e)) && (void 0 === i || isNaN(i)) && (void 0 === s || isNaN(s))) return ! 1;
                if (t.isArray(W.settings.direction) || 0 !== nt(W.settings.direction)) {
                    var n = nt(it(e, "undefined" != typeof i ? st(i, 2) : "", "undefined" != typeof s ? st(s, 2) : "")),
                    a = (n + "").length;
                    if (8 == a && ("undefined" != typeof C && n < nt(it(g, st(f, 2), st(m, 2))) || "undefined" != typeof $ && n > nt(it(P, st(T, 2), st(I, 2))))) return ! 0;
                    if (6 == a && ("undefined" != typeof C && n < nt(it(g, st(f, 2))) || "undefined" != typeof $ && n > nt(it(P, st(T, 2))))) return ! 0;
                    if (4 == a && ("undefined" != typeof C && g > n || "undefined" != typeof $ && n > P)) return ! 0

                }
                "undefined" != typeof i && (i += 1);
                var o = !1,
                r = !1;
                return x && t.each(x, 
                function() {
                    if (!o) {
                        var n = this;
                        if ((t.inArray(e, n[2]) > -1 || t.inArray("*", n[2]) > -1) && ("undefined" != typeof i && t.inArray(i, n[1]) > -1 || t.inArray("*", n[1]) > -1) && ("undefined" != typeof s && t.inArray(s, n[0]) > -1 || t.inArray("*", n[0]) > -1)) {
                            if ("*" == n[3]) return o = !0;
                            var a = new Date(e, i - 1, s).getDay();
                            if (t.inArray(a, n[3]) > -1) return o = !0

                        }

                    }

                }),
                k && t.each(k, 
                function() {
                    if (!r) {
                        var n = this;
                        if ((t.inArray(e, n[2]) > -1 || t.inArray("*", n[2]) > -1) && (r = !0, "undefined" != typeof i)) if (r = !0, t.inArray(i, n[1]) > -1 || t.inArray("*", n[1]) > -1) {
                            if ("undefined" != typeof s) if (r = !0, t.inArray(s, n[0]) > -1 || t.inArray("*", n[0]) > -1) {
                                if ("*" == n[3]) return r = !0;
                                var a = new Date(e, i - 1, s).getDay();
                                if (t.inArray(a, n[3]) > -1) return r = !0;
                                r = !1

                            } else r = !1

                        } else r = !1

                    }

                }),
                k && r ? !1: x && o ? !0: !1

            },
            Q = function(t) {
                return (t + "").match(/^\-?[0-9]+$/) ? !0: !1

            },
            X = function(e) {
                ! isNaN(parseFloat(_)) && isFinite(_) && (e = e.replace(/\bm\b|\bn\b|\bF\b|\bM\b/, 
                function(e) {
                    switch (e) {
                        case "m":
                        return st(_ + 1, 2);
                        case "n":
                        return _ + 1;
                        case "F":
                        return W.settings.months[_];
                        case "M":
                        return t.isArray(W.settings.months_abbr) && void 0 !== W.settings.months_abbr[_] ? W.settings.months_abbr[_] : W.settings.months[_].substr(0, 3);
                        default:
                        return e

                    }

                })),
                !isNaN(parseFloat(b)) && isFinite(b) && (e = e.replace(/\bY\b/, b).replace(/\by\b/, (b + "").substr(2)).replace(/\bY1\b/i, b - 7).replace(/\bY2\b/i, b + 4)),
                t(".dp_caption", o).html(e)

            },
            tt = function() {
                if ("" === r.text() || "days" == s) {
                    if ("" === r.text()) {
                        W.settings.always_visible || n.css("left", -1e3),
                        n.css("visibility", "visible"),
                        q();
                        var e = r.outerWidth(),
                        i = r.outerHeight();
                        l.css({
                            width: e,
                            height: i

                        }),
                        c.css({
                            width: e,
                            height: i

                        }),
                        o.css("width", e),
                        H.css("width", e),
                        n.css("visibility", "").addClass("dp_hidden")

                    } else q();
                    l.hide(),
                    c.hide()

                } else "months" == s ? (Z(), r.hide(), c.hide()) : "years" == s && (K(), r.hide(), l.hide());
                if (W.settings.onChange && "function" == typeof W.settings.onChange && void 0 !== s) {
                    var a = "days" == s ? r.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)") : "months" == s ? l.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)") : c.find("td:not(.dp_disabled, .dp_weekend_disabled, .dp_not_in_month)");
                    a.each(function() {
                        if ("days" == s) if (t(this).hasClass("dp_not_in_month_selectable")) {
                            var e = t(this).attr("class").match(/date\_([0-9]{4})(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])/);
                            t(this).data("date", e[1] + "-" + e[2] + "-" + e[3])

                        } else t(this).data("date", b + "-" + st(_ + 1, 2) + "-" + st(nt(t(this).text()), 2));
                        else if ("months" == s) {
                            var e = t(this).attr("class").match(/dp\_month\_([0-9]+)/);
                            t(this).data("date", b + "-" + st(nt(e[1]) + 1, 2))

                        } else t(this).data("date", nt(t(this).text()))

                    }),
                    W.settings.onChange.call(R, s, a, R)

                }
                H.show(),
                W.settings.show_clear_date === !0 || 0 === W.settings.show_clear_date && "" !== R.val() || W.settings.always_visible && W.settings.show_clear_date !== !1 ? (h.show(), E ? (F.css("width", "50%"), h.css("width", "50%")) : (F.hide(), h.css("width", "100%"))) : (h.hide(), E ? F.show().css("width", "100%") : H.hide())

            },
            et = function(t, e, i, s, n) {
                var a = new Date(t, e, i, 12, 0, 0),
                o = "days" == s ? M: "months" == s ? z: j,
                r = J(a);
                R.val(r),
                W.settings.always_visible && (y = a.getMonth(), _ = a.getMonth(), w = a.getFullYear(), b = a.getFullYear(), v = a.getDate(), o.removeClass("dp_selected"), n.addClass("dp_selected"), "days" == s && n.hasClass("dp_not_in_month_selectable") && W.show()),
                W.hide(),
                at(a),
                W.settings.onSelect && "function" == typeof W.settings.onSelect && W.settings.onSelect.call(R, r, t + "-" + st(e + 1, 2) + "-" + st(i, 2), a, R, ot(a)),
                R.focus()

            },
            it = function() {
                for (var t = "", e = 0; e < arguments.length; e++) t += arguments[e] + "";
                return t

            },
            st = function(t, e) {
                for (t += ""; t.length < e;) t = "0" + t;
                return t

            },
            nt = function(t) {
                return parseInt(t, 10)

            },
            at = function(e) {
                W.settings.pair && t.each(W.settings.pair, 
                function() {
                    var i = t(this);
                    if (i.data && i.data("Zebra_DatePicker")) {
                        var s = i.data("Zebra_DatePicker");
                        s.update({
                            reference_date: e,
                            direction: 0 === s.settings.direction ? 1: s.settings.direction

                        }),
                        s.settings.always_visible && s.show()

                    } else i.data("zdp_reference_date", e)

                })

            },
            ot = function(t) {
                var e,
                i,
                s,
                n,
                a,
                o,
                r,
                l,
                c,
                h = t.getFullYear(),
                u = t.getMonth() + 1,
                d = t.getDate();
                return 3 > u ? (e = h - 1, i = (e / 4 | 0) - (e / 100 | 0) + (e / 400 | 0), s = ((e - 1) / 4 | 0) - ((e - 1) / 100 | 0) + ((e - 1) / 400 | 0), n = i - s, a = 0, o = d - 1 + 31 * (u - 1)) : (e = h, i = (e / 4 | 0) - (e / 100 | 0) + (e / 400 | 0), s = ((e - 1) / 4 | 0) - ((e - 1) / 100 | 0) + ((e - 1) / 400 | 0), n = i - s, a = n + 1, o = d + ((153 * (u - 3) + 2) / 5 | 0) + 58 + n),
                r = (e + i) % 7,
                d = (o + r - a) % 7,
                l = o + 3 - d,
                c = 0 > l ? 53 - ((r - n) / 5 | 0) : l > 364 + n ? 1: (l / 7 | 0) + 1

            },
            rt = {
                init: function() {
                    this.name = this.searchString(this.dataBrowser) || "",
                    this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || ""

                },
                searchString: function(t) {
                    for (var e = 0; e < t.length; e++) {
                        var i = t[e].string,
                        s = t[e].prop;
                        if (this.versionSearchString = t[e].versionSearch || t[e].identity, i) {
                            if ( - 1 != i.indexOf(t[e].subString)) return t[e].identity

                        } else if (s) return t[e].identity

                    }

                },
                searchVersion: function(t) {
                    var e = t.indexOf(this.versionSearchString);
                    return - 1 != e ? parseFloat(t.substring(e + this.versionSearchString.length + 1)) : void 0

                },
                dataBrowser: [{
                    string: navigator.userAgent,
                    subString: "Firefox",
                    identity: "firefox"

                },
                {
                    string: navigator.userAgent,
                    subString: "MSIE",
                    identity: "explorer",
                    versionSearch: "MSIE"

                }]

            };
            rt.init(),
            L()

        },
        t.fn.Zebra_DatePicker = function(e) {
            return this.each(function() {
                void 0 !== t(this).data("Zebra_DatePicker") && t(this).data("Zebra_DatePicker").destroy();
                var i = new t.Zebra_DatePicker(this, e);
                t(this).data("Zebra_DatePicker", i)

            })

        }

    } (jQuery)

},
function(t, e, i) {
    e = t.exports = i(1)(),
    e.push([t.id, 'body{font-family:Trebuchet MS,Helvetica,Arial,Verdana,"sans-serif"}#text-status,.main-right{float:right}.apps,.panels,.shortcut,.window{float:left}.apps,.shortcut{position:relative}.apps{width:185px}.window-tab{z-index:6;cursor:pointer;display:block;position:relative;border-width:0;padding-left:1px;text-decoration:none;border-left-width:1px;font-size:65%}.highlight-padding{padding:3px}.ui-menu{width:180}.toolbar,.toolbar-max{padding:0;display:inline-block;position:fixed;bottom:0;right:2em;float:left;z-index:50000}#tools-menu{min-width:150px}.toolbar-max{width:90%}*+html .toolbar{display:inline}.textarea-msg{font-size:10px;float:left;width:190px;height:40px}.msg,.msg-text{padding-left:6px;padding-right:6px;padding-top:4px;display:block}.msg-toptext{padding-left:4px;padding-right:4px}.msg-time{float:right}.msg-custom,.msg-time{margin:0;padding:0;font-size:80%;zoom:1;filter:alpha(opacity=50);opacity:.5}.floater{position:absolute;bottom:5px}.minimize-window{right:2.4em}.externally-window{right:4.9em}.externally-window,.minimize-window{position:absolute;top:50%;width:21px;margin:-10px -8px 0 0;padding:1px;height:20px}.minimize-main{float:right;margin:0}.minimize-window:before{content:"\\2014";color:#005c3f;font-size:10px;font-weight:600}.ui-dialog-titlebar-close:before{content:"\\D7";color:#005c3f;font-weight:600;font-size:12px;line-height:18px}.online{background-image:url("/nitalk/images/button_online.png")}.busy{background-image:url("/nitalk/images/busy.png")}.away{background-image:url("/nitalk/images/status-away.png")}.logout,.offline{background-image:url("/nitalk/images/button_offline.png")}.away,.busy,.logout,.offline,.online{color:#fff;background-repeat:no-repeat;display:inline;background-position:0 2px;padding-left:15px}.ui-chatbox-log{min-height:100px;max-height:200px;overflow-y:auto}.ui-chatbox-input-box{border:2px solid #d3d3d3;margin-bottom:1.3em;overflow-y:auto}.ui-chatbox-input-focus{border-color:#69f}.warning-conection{position:absolute;float:left;width:79%}#chat-title-button{min-width:120px}.chat-main-title{text-align:center;margin:.3em;font-size:1.1em}#main-users-resizer{width:202px;min-height:200px;display:inline-block;position:fixed;z-index:50000;font-size:65%}.main-chat-window{margin-left:-2em}.user-pad{padding:5px;z-index:9999}#text-status{margin-top:3px;font-size:9px;width:66%;text-align:left;background-image:url("/nitalk/images/mini-comment.png");background-repeat:no-repeat;display:inline;background-position:2px 5px;padding-left:15px;padding-top:3px}#user-status{z-index:1;position:fixed;list-style-image:none;list-style:none}.progress-label{float:left;margin-left:30%;margin-top:5px;font-weight:700;text-shadow:1px 1px 0 #fff}.ui-dialog{display:inline-block;position:fixed;z-index:50000;font-size:12px}#tools-panel,.no-display{display:none}#progressbar-char{width:55px;float:left;margin-top:1.2em;margin-bottom:.4em;height:6px}#istalking{list-style-image:none;list-style:none;font-size:9px;margin-top:1em;float:left}#options-panel{padding:0;border:1px solid #d3d3d3}#format{padding:4px;overflow-y:auto}.x-input{border:1px solid #ccc;padding-top:4px;padding-bottom:2px}.x-input input.x-input-text{border:0;outline:0;width:70%}.chat-search-main{padding-top:4px;padding-bottom:2px}#chat-icon-close,#chat-icon-search{min-width:20px;min-height:24px}.chat-search-text-st{max-width:140px}#slider{float:right;margin-top:30px}.validateTips{border:1px solid transparent;padding:.3em}input.login_text{margin-bottom:12px;width:95%;padding:.4em}.ui-widget-header{background-image:none}.ui-dialog .ui-dialog-titlebar{padding:1px 1px 1px 10px}.ui-widget-overlay{background:#aaa 50% 50% repeat-x}#tool_promo{background-image:url("/nitalk/images/music138.png");width:19px;height:14px;margin-bottom:2px;text-decoration:none}', ""]);

},
function(t, e, i) {
    e = t.exports = i(1)(),
    e.push([t.id, ".tipsy{font-size:11px;position:absolute;padding:5px;z-index:100000}.tipsy-inner{background-color:#000;color:#fff;max-width:200px;padding:4px 7px 3px;text-align:center;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;box-shadow:0 0 5px #000;-webkit-box-shadow:0 0 5px #000;-moz-box-shadow:0 0 5px #000}.tipsy-arrow{position:absolute;width:0;height:0;line-height:0;border:5px dashed #000}.tipsy-arrow-n{border-bottom-color:#000}.tipsy-arrow-s{border-top-color:#000}.tipsy-arrow-e{border-left-color:#000}.tipsy-arrow-w{border-right-color:#000}.tipsy-n .tipsy-arrow{left:50%;margin-left:-5px}.tipsy-n .tipsy-arrow,.tipsy-nw .tipsy-arrow{top:0;border-bottom-style:solid;border-top:none;border-left-color:transparent;border-right-color:transparent}.tipsy-nw .tipsy-arrow{left:10px}.tipsy-ne .tipsy-arrow{top:0;right:10px;border-bottom-style:solid;border-top:none;border-left-color:transparent;border-right-color:transparent}.tipsy-s .tipsy-arrow{left:50%;margin-left:-5px}.tipsy-s .tipsy-arrow,.tipsy-sw .tipsy-arrow{bottom:0;border-top-style:solid;border-bottom:none;border-left-color:transparent;border-right-color:transparent}.tipsy-sw .tipsy-arrow{left:10px}.tipsy-se .tipsy-arrow{bottom:0;right:10px;border-top-style:solid;border-bottom:none;border-left-color:transparent;border-right-color:transparent}.tipsy-e .tipsy-arrow{right:0;border-left-style:solid;border-right:none}.tipsy-e .tipsy-arrow,.tipsy-w .tipsy-arrow{top:50%;margin-top:-5px;border-top-color:transparent;border-bottom-color:transparent}.tipsy-w .tipsy-arrow{left:0;border-right-style:solid;border-left:none}", ""])

},
function(t, e, i) {
    e = t.exports = i(1)(),
    e.push([t.id, ".Zebra_DatePicker *,.Zebra_DatePicker :after,.Zebra_DatePicker :before{box-sizing:content-box!important}.Zebra_DatePicker{position:absolute;background:#666;border:3px solid #666;z-index:999;font-family:Tahoma,Arial,Helvetica,sans-serif;font-size:13px;top:0}.Zebra_DatePicker *{margin:0;padding:0;color:#c40000;background:transparent;border:none}.Zebra_DatePicker table{border-collapse:collapse;border-spacing:0;width:auto;table-layout:auto}.Zebra_DatePicker td,.Zebra_DatePicker th{text-align:center;padding:5px 0}.Zebra_DatePicker td{cursor:pointer}.Zebra_DatePicker .dp_daypicker,.Zebra_DatePicker .dp_monthpicker,.Zebra_DatePicker .dp_yearpicker{margin-top:3px}.Zebra_DatePicker .dp_daypicker td,.Zebra_DatePicker .dp_daypicker th,.Zebra_DatePicker .dp_monthpicker td,.Zebra_DatePicker .dp_yearpicker td{background:#e8e8e8;width:30px;border:1px solid #7bacd2}.Zebra_DatePicker,.Zebra_DatePicker .dp_footer .dp_hover,.Zebra_DatePicker .dp_header .dp_hover{border-radius:5px}.Zebra_DatePicker.dp_visible{visibility:visible;filter:alpha(opacity=100);-khtml-opacity:1;-moz-opacity:1;opacity:1;transition:opacity .2s ease-in-out}.Zebra_DatePicker.dp_hidden{visibility:hidden;filter:alpha(opacity=0);-khtml-opacity:0;-moz-opacity:0;opacity:0}.Zebra_DatePicker .dp_header td{color:#fff}.Zebra_DatePicker .dp_header .dp_next,.Zebra_DatePicker .dp_header .dp_previous{width:30px}.Zebra_DatePicker .dp_header .dp_caption{font-weight:700}.Zebra_DatePicker .dp_header .dp_hover{background:#222;color:#fff}.Zebra_DatePicker .dp_daypicker th{background:#fc3}.Zebra_DatePicker td.dp_not_in_month{background:#f3f3f3;color:#cdcdcd;cursor:default}.Zebra_DatePicker td.dp_not_in_month_selectable{background:#f3f3f3;color:#c40000;cursor:pointer}.Zebra_DatePicker td.dp_weekend{background:#d8d8d8}.Zebra_DatePicker td.dp_weekend_disabled{color:#ccc;cursor:default}.Zebra_DatePicker td.dp_selected{background:#5a4b4b;color:#fff!important}.Zebra_DatePicker td.dp_week_number{background:#fc3;color:#555;cursor:text;font-style:italic}.Zebra_DatePicker .dp_monthpicker td,.Zebra_DatePicker .dp_yearpicker td{width:33%}.Zebra_DatePicker .dp_footer{margin-top:3px}.Zebra_DatePicker .dp_footer .dp_hover{background:#222;color:#fff}.Zebra_DatePicker .dp_clear,.Zebra_DatePicker .dp_today{color:#fff;padding:3px}.Zebra_DatePicker td.dp_current{color:#c40000}.Zebra_DatePicker td.dp_disabled_current{color:#e38585}.Zebra_DatePicker td.dp_disabled{background:#f3f3f3;color:#cdcdcd;cursor:default}.Zebra_DatePicker td.dp_hover{background:#482424;color:#fff}button.Zebra_DatePicker_Icon{display:block;position:absolute;width:16px;height:16px;background:url(" + i(24) + ") no-repeat left top;text-indent:-9000px;border:none;cursor:pointer;padding:0;line-height:0;vertical-align:top}button.Zebra_DatePicker_Icon_Disabled{background-image:url(" + i(23) + ")}button.Zebra_DatePicker_Icon{margin:0 0 0 3px}button.Zebra_DatePicker_Icon_Inside{margin:0 3px 0 0}", ""])

},
function(t, e, i) {
    e = t.exports = i(1)(),
    e.push([t.id, "jpan.emoji{display:-moz-inline-box;-moz-box-orient:vertical;display:inline-block;vertical-align:baseline;*vertical-align:auto;*zoom:1;*display:inline;width:2em;height:2em;background-size:2em;background-repeat:no-repeat;text-indent:-9999px}span.emoji-sizer{line-height:.81em;font-size:1em;margin:-2px 0}span.emoji-outer{display:-moz-inline-box;display:inline-block;*display:inline;height:1em;width:1em}span.emoji-inner{display:-moz-inline-box;display:inline-block;text-indent:-9999px;width:100%;height:100%;vertical-align:baseline;*vertical-align:auto;*zoom:1}img.emoji{width:2em;height:2em}.face-item img{width:25px;height:25px}.editor img{width:25px}.faceContainer{padding-left:10px;overflow-y:scroll;height:150px}.editor{width:95%;min-height:100%;display:inline-block;padding:0 5px;outline:none}.editContainer{overflow-y:auto;height:60px;width:98%;display:inline-block;border:1px solid #aaa;border-top-left-radius:4px;border-top-right-radius:4px;border-bottom-left-radius:4px;border-bottom-right-radius:4px;margin-bottom:5px}", ""])

},
function(t, e, i) {
    e = t.exports = i(1)(),
    e.push([t.id, "body{font:12px Microsoft Yahei,Arial}a,button,i,input{padding:0;margin:0}input.ui-button{padding:0}#main-users-resizer{border:none}.editContainer{padding:5px 0}.ui-state-default,.ui-widget-content .ui-state-default,.ui-widget-header .ui-state-default{border:none;background:none;color:#12b35e}.ui-state-highlight,.ui-widget-content .ui-state-highlight,.ui-widget-header .ui-state-highlight{border:2px solid #009062;background:none;background-color:#12b35e}.user-button{margin-left:8px}h3.ui-accordion-header{font-size:12px}.ui-widget-header{background:#12b35e;color:#fff;border:2px solid #009062;border-top-right-radius:4px;-webkit-border-top-left-radius:4px}.chat-main-title{padding-left:20px}.ui-buttonset{background:#2b2b2b;margin-right:0}#chat-icon-close,#chat-icon-search,#chat-search-text{background:#fff;border:0}#chat-icon-search{margin-left:4px}input#chat-search-text{height:24px;width:70%;font-size:12px;text-align:left;cursor:auto}#chat-icon-close{border-left:1px solid #b7b7b7}a.promo{font-size:12px}.cus-top{border-bottom:1px solid #b7b7b7;overflow:hidden}a.haft-width{display:block;cursor:pointer;background:#fff;width:100px;height:50px;display:inline-block}a.row-top,a.row-top:hover{border-left:1px solid #b7b7b7;float:right}.row-cos-icon,.row-top-iocn{width:50px;height:100%;float:left}.row-a{width:49px;float:right;height:100%}.row-a h2,.row-a h3{letter-spacing:2px;font-weight:400;font-size:16px;margin:0;padding:0;line-height:28px}.row-a h3{color:#b7b7b7;font-weight:400;text-align:left;margin-top:-7px;font-size:12px;padding-left:5px}button#magnifier-icon{margin-left:8px;font-size:12px}button#chat-icon-close,button#magnifier-icon{background-color:#fff;height:24px;width:24px;line-height:24px}button#chat-icon-close{border-left:1px solid #b7b7b7;background-image:none;font-size:8px;color:#b7b7b7}.ui-state-default .ui-icon{background-image:none}.chat-search-main{background:#2b2b2b;margin-right:0;padding-bottom:5px}span.ui-accordion-header-icon{display:none}h3.ui-helper-reset{background-color:#f4f4f4;border-radius:0;border-bottom:1px solid #b7b7b7}span.users-header-3{font-weight:700}.ui-accordion .ui-accordion-header{margin-top:0;background-color:#f4f4f4;border-radius:0;border-bottom:1px solid #b7b7b7}.ui-accordion-header{margin-top:0}.slider_container{border:none;border-top:1px solid #b7b7b7}.ui-button-text-only .ui-button-text{padding:0}#rerun{color:#a5ff00;margin-left:15px;font-size:12px}#rerun-select{color:#12b35e;font-size:12px;margin:0 5px 0 -5px;border:none}#refresh-btn,span.ui-button-text{display:none}.transform-icon{-webkit-transform:rotate(90deg)!important;-ms-transform:rotate(90deg)!important;transform:rotate(90deg)!important},li.offline,li.online{background:none}li.offline:hover,li.online:hover{background:none;color:#2b2b2b}li.offline:before{background-color:#b7b7b7}li.offline:before,li.online:before{content:'';display:inline-block;padding-left:0;width:8px;height:8px;border-radius:100%;margin-right:8px}li.online:before{background-color:#a5ff00}li.busy:before{content:'';display:inline-block;padding-left:0;width:8px;height:8px;background-color:#ff6000;border-radius:100%;margin-right:8px}a.online:before{background-color:#a5ff00}a.busy:before,a.online:before{content:'';display:inline-block;padding-left:0;width:8px;height:8px;border-radius:100%;margin-right:2px}a.busy:before{background-color:#ff6000}a.offline:before{content:'';display:inline-block;padding-left:0;width:8px;height:8px;background-color:#b7b7b7;border-radius:100%;margin-right:2px}.ui-corner-all:hover{background-image:none}a.ui-state-focus{border:none;margin:0}.away,.busy,.logout,.offline,.online{padding-left:5px;background:none}.busy:hover,.offline:hover,.online:hover{border:none;border-radius:0;background-color:#f4f4f4}#user-status{border-radius:0}.apps{padding:0 3px}#users-button-bar button:last-child span{padding-right:15px;border-right:1px solid #009062}.toolbar-max{width:auto;padding:5px}.shortcut{display:none}.ui-widget-content{border-color:#b7b7b7}.ui-chatbox-log{height:190px;border:2px solid #e1e1e1}.floater{width:390px}#box{width:385px}textarea#textarea_msg{padding:5px;width:100%;height:60px;border:2px solid #e1e1e1;outline:none;moz-box-shadow:0 1px 5px #e9e9e9 inset;box-shadow:0 1px 5px #e9e9e9 inset;overflow:hidden}input#openupload{background-color:#fff}.icon-expression,.icon-group-shift,.icon-history,.icon-picture{color:#b7b7b7;font-size:24px;padding:0 3px 5px}.send-butt{padding:1px 15px;color:#fff;letter-spacing:2px;background-color:#12b35e;cursor:pointer;float:right;margin:0 5px 4px 0;border:2px solid #009062;border-radius:4px}.send-butt:hover{background-color:#009062}.send-butt:active{color:#00c586}span.mini-window:before{content:\"\\2014\";color:#005c3f;font-size:10px;font-weight:600;line-height:24px}i.icon-add-group{color:#12b35e;font-size:14px;margin:5px 0 0 5px}i.icon-dele-group,i.icon-group-info,i.icon-refresh-fa{color:#12b35e;font-size:14px;margin:5px 0 0 5px}i.icon-customer{color:#12b35e;margin:10px 0 0 20px}i.icon-superiors{color:#fc0;margin:10px 0 0 20px}i.hover-color:hover{color:#12b35e}.floater i{font-size:18px}.ui-state-error,.ui-widget-content .ui-state-error,.ui-widget-header .ui-state-error{color:#a5ff00}#datepickerdiv input{display:none}.nitalk-face-icon{position:relative}.nitalk-face-dialog{display:none;position:absolute;top:-185px;left:-20px;width:350px;height:160px;border:1px solid #ccc;z-index:99999;background:#fff;padding:5px;color:#b7b7b7}.nitalk-face-dialog:before{border-top-color:#000}.nitalk-face-dialog:after,.nitalk-face-dialog:before{content:'';width:0;height:0;border:10px solid transparent;position:absolute;top:170px;left:20px}.nitalk-face-dialog:after{border-top-color:#fff}.nitalk-group-drop-hover{background-color:#ccc!important}#dialog-status:hover{color:#fff}div[id|=Dialog].ui-dialog-content{height:295!important}.ui-dialog-content{overflow:hidden!important}.newmsg{position:relative;display:inline-block;margin:-2px 0 0 5px}#newmsg_cs,#newmsg_up,.newmsg{width:20px;height:20px;line-height:20px;background-color:#009062;border-radius:20px;text-align:center;color:#fff}#newmsg_cs,#newmsg_up{position:absolute;margin:2px 0 0 -43px}.ui-accordion-header span:last-child{display:inline-block;position:absolute;margin-left:5px;color:#e00}#main{padding:0;border:none}#main-rpanel,#users-button-bar{display:none}#main-rpanel>div{padding:5px}", ""])

},
function(t, e, i) {
    var s = i(13);
    "string" == typeof s && (s = [
    [t.id, s, ""]
    ]);
    i(2)(s, {});
    s.locals && (t.exports = s.locals)

},
function(t, e, i) {
    var s = i(14);
    "string" == typeof s && (s = [
    [t.id, s, ""]
    ]);
    i(2)(s, {});
    s.locals && (t.exports = s.locals)

},
function(t, e, i) {
    var s = i(15);
    "string" == typeof s && (s = [
    [t.id, s, ""]
    ]);
    i(2)(s, {});
    s.locals && (t.exports = s.locals)

},
function(t, e, i) {
    var s = i(16);
    "string" == typeof s && (s = [
    [t.id, s, ""]
    ]);
    i(2)(s, {});
    s.locals && (t.exports = s.locals)

},
function(t, e, i) {
    var s = i(17);
    "string" == typeof s && (s = [
    [t.id, s, ""]
    ]);
    i(2)(s, {});
    s.locals && (t.exports = s.locals)

},
function(t, e) {
    t.exports = "data:image/png;base64,"

},
function(t, e) {
    t.exports = "data:image/png;base64,"

}]);