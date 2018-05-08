/*
* @author     Chanaka Mannapperuma <irusri@gmail.com>
* @date       2013-08-20
* @version    Beta 1.0
* @usage      Expression view create new elements
* @licence    GNU GENERAL PUBLIC LICENSE
* @link       http://irusri.com
*/

//Basic parameters
var data, maxRatio = 0,
    legenditems = 11,
    private_mode = "",
    private_view = "",
    private_id = "",
    errorboolean = !1,
    notloaded = !1,
    get_zoom = 1,
    get_exlink = !1,
    replicate_flag = !1,
    experiment_object = {
        experiment_1: ["mature_laves", "young_leaves", "wood", "shoots"],
        experiment_2: ["mature_laves", "young_leaves", "wood", "shoots"]
    },
    tmpSampleRemoved = [],
    tmpSampleObject = {},
    active_draggable_samples = [],
    removed_draggable_samples = [],
    drag = chanaka.behavior.drag();

function setCookietxtChange() {
    private_id = document.getElementById("input_id").value;
    var e = document.getElementById("input_id").value;
    setCookie("cookie_input_id", e, 10)
}

//initialize function
function init() {
    if (0 == notloaded && ("gp" == get_from && (setTimeout(function() {
            init()
        }, 500), notloaded = !0), first_gene), "" != get_zoom && (document.body.style.zoom = 100 * get_zoom + "%", document.body.style.WebkitTransform = "scale(" + 100 * get_zoom + "%)", document.body.style.transform = "scale(" + get_zoom + ")", document.body.style.MozTransformOrigin = "0 0"), "false" == get_allcontrols && (document.getElementById("header_exptable").style.visibility = "hidden", document.getElementById("inputtoolbox").style.visibility = "hidden", document.getElementById("newtable_2").style.visibility = "hidden", document.getElementById("newtable_3", "header").style.visibility = "hidden", document.getElementById("header").style.visibility = "hidden"), "true" == get_download && (document.getElementById("download").style.visibility = "visible"), "" == get_id) {
        var e = getCookie("cookie_input_id");
        private_id = null != e && void 0 != e ? e : "Zosma228g00150"
    } else private_id = get_id;
    if (private_id = "Zosma228g00150", "" == get_view) {
        var t = getCookie("cookie_view");
        private_view = null != t && void 0 != t ? t : "experiment_1"
    } else private_view = get_view;
    if ("" == get_mode) {
        var a = getCookie("cookie_mode");
        private_mode = null != a && void 0 != a ? a : "relative"
    } else private_mode = get_mode;
    changeview(private_view)
}

//change different datasets
function changeview(e) {
    removerootsvg();
    var t = document.getElementById("experiment_1"),
        l = document.getElementById("experiment_2");
     "experiment_1" == e ? (t.checked = !0, chanaka.xml("plugins/eximage/svg/zosma_scheme_8.svg", "image/svg+xml", function(e) {
        document.importNode(e.documentElement, !0);
        chanaka.select("#viz").node().appendChild(e.documentElement), retrievedata()
    })) : "experiment_2" == e && (l.checked = !0, chanaka.xml("plugins/eximage/svg/experiment_2.svg", "image/svg+xml", function(e) {
        document.importNode(e.documentElement, !0);
        chanaka.select("#viz").node().appendChild(e.documentElement), retrievedata()
    })), private_view = e
}

function rgbchecked() {
    document.getElementsByName("modergb")[0].checked ? mode = "relative" : mode = "absolute", private_mode = mode, setCookie("cookie_mode", private_mode, 10), retrievedata()
}

//retrieve data and JSON call to MySQL database
function retrievedata() {
    var e = document.getElementsByName("modergb");
    "relative" == private_mode ? e[0].checked = !0 : e[1].checked = !0, document.getElementById("input_id").value = private_id, setCookie("cookie_input_id", private_id, 10), setCookie("cookie_mode", private_mode, 10), setCookie("cookie_view", private_view, 10);
    var t = "";
    t = private_view;
    var a;
    chanaka.json("plugins/eximage/service/eplant_service.php?primaryGene=" + private_id + "&view=" + t, function(e, t) {
        if (e) return console.warn(e);
        if (null == (a = t).popdata) return errorboolean = !0, void callerror();
        if (errorboolean = !1, "experiment_1" == private_view && (document.getElementById("externallink2").innerHTML = "<a target='_blank' href='https://doi.org/10.1038/nature16548'>The genome of the seagrass Zostera marina reveals angiosperm adaptation to the sea.</a><br><FONT size='2px'>Olsen JL, Rouzé P, Verhelst B, Lin YC et al. The genome of the seagrass Zostera marina reveals angiosperm adaptation to the sea. Nature 2016 Feb 18;530(7590):331-5</FONT>"), "experiment_2" == private_view && (document.getElementById("externallink2").innerHTML = "<a target='_blank' href='http://plantgenie.org'>To be published when EucGenIE launches in PlantGenIE</a><br>"), "experiment_3" == private_view && (document.getElementById("externallink2").innerHTML = "<a target='_blank' href='http://dx.doi.org/10.1111/nph.13152'><FONT size='2px'>Investigating the molecular underpinnings underlying morphology and changes in carbon partitioning during tension wood formation in Eucalyptus</a><br>Eshchar Mizrachi, Victoria J. Maloney, Janine Silberbauer, Charles A. Hefer, Dave K. Berger, Shawn D. Mansfield and Alexander A. Myburg</FONT>"), "experiment_4" == private_view && (document.getElementById("externallink2").innerHTML = ""), "phytophthora_cinnamomi" != private_view && "leptocybe_invasa" != private_view && "chrysoporthe_austroafricana" != private_view || (document.getElementById("externallink2").innerHTML = "<a target='_blank' href='http://plantgenie.org'>To be published when EucGenIE launches in PlantGenIE</a><br>"), 0 != removed_draggable_samples.length)
            for (var l = 0; l < removed_draggable_samples.length; l++) {
                var n = removed_draggable_samples[l];
                tmpSampleRemoved = "wood" == n ? tmpSampleRemoved.filter(function(e) {
                    if ("xylem" != e.sample && "phloem" != e.sample && "immature_xylem" != e.sample) return e.sample
                }) : tmpSampleRemoved.filter(function(e) {
                    return e.sample !== n
                })
            } else tmpSampleRemoved = a.popdata;
        if (tmpSampleObject.popdata = tmpSampleRemoved, "relative" == private_mode) {
            var o = new Array;
            for (var r in tmpSampleObject.popdata) tstx = parseFloat(tmpSampleObject.popdata[r].log2fc), o.push(tstx);
            for (var i = [], s = {}, d = o.reduce(function(e, t) {
                    return e + t
                }) / o.length, c = 0; c < tmpSampleObject.popdata.length; c++)(s = new Object).log2 = tmpSampleObject.popdata[c].log2 - d, s.sample = tmpSampleObject.popdata[c].sample, s.log2fc = tmpSampleObject.popdata[c].log2fc - d, i.push(s);
            tmpSampleObject.popdata = i
        }
        getthemaxvalue(tmpSampleObject), "false" != get_exptable && "false" != get_allcontrols && createexpressiontable(tmpSampleObject)
    })
}

//color samples by expression value
function colourobjects(e, t, a) {
    if ("20leaves" == private_view) l = private_mode.charAt(0).toUpperCase() + private_mode.slice(1) + " mode</br>Value: " + roundNumber(a, 2);
    else var l = private_mode.charAt(0).toUpperCase() + private_mode.slice(1) + " mode</br>Value: " + roundNumber(a, 2);
    if ("exatlas_matureleaf" == e) {
        for (var n = 1; n < 6; n++)(r = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("#" + e).selectAll("path")).attr("fill", t), (o = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("#" + e + n)).attr("fill", t), (r = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("#" + e + n).selectAll("path")).attr("fill", t);
        show_tooltips(o, l, t)
    } else {
        var o = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("#" + e);
        o.attr("fill", t);
        var r = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("#" + e).selectAll("path");
        r.attr("fill", t), show_tooltips(chanaka.selectAll("svg").selectAll("#" + e), l, t)
    }
}

//show error SVG
function callerror() {
    removexpressiontable(), removerootsvg(), chanaka.xml("plugins/eximage/svg/error.svg", "image/svg+xml", function(e) {
        document.importNode(e.documentElement, !0);
        chanaka.select("#viz").node().appendChild(e.documentElement)
    })
}

//CSV data table
function toggleMe() {
    var e = document.getElementById("newtable_3");
    return !e || ("none" == e.style.display ? (document.getElementById("newtable_3").style.display = "block", document.getElementById("newtable_2").style.display = "none") : (document.getElementById("newtable_3").style.display = "none", document.getElementById("newtable_2").style.display = "block"), !0)
}

function selectidfromlist(e) {
    private_id = e, 1 == errorboolean ? changeview(private_view) : retrievedata()
}

//Show tooltips when mouse over
function show_tooltips(e, t, a) {
    if ((get_zoom > .4 || "" == get_zoom) && ("" == get_zoom && (get_zoom = 1), null != e)) {
        var l = chanaka.select("body").append("viz").attr("class", "tooltip").style("position", "absolute").style("z-index", "10").style("visibility", "hidden").html(t + '<br>Legend color: <span style="background-color:' + a + ';width:50px">&nbsp;&nbsp;&nbsp;</span>');
        e.on("mouseover", function() {
            return e.attr("flood-opacity", "0.0"), e.attr("fill-opacity", "0.8"), l.style("visibility", "visible")
        }), e.on("mousemove", function() {
            return l.style("top", (chanaka.event.pageY - 10) / get_zoom + "px").style("left", (chanaka.event.pageX + 16) / get_zoom + "px")
        }), e.on("mouseout", function() {
            return  e.attr("flood-opacity", "1"), e.attr("fill-opacity", "1"), l.style("visibility", "hidden")
        })
    }
}

function trimTail(e) {
    return e.substring(0, e.length - 1)
}

function readTable(e) {
    for (var t = document.getElementById(e), a = t.rows.length, l = t.rows[0].cells.length, n = "", o = "", r = 0; r < l; r++) n = n + t.rows[0].cells[r].innerHTML + ",";
    n = trimTail(n);
    for (var i = 1; i < a; i++) {
        for (var s = 0; s < l; s++) o = o + t.rows[i].cells[s].innerHTML + ",";
        o = trimTail(o) + "\r\n"
    }
    saveFile(o = n + "\r\n" + o)
}

//Save as CSV file
function saveFile(e) {
    "Microsoft Internet Explorer" != navigator.appName ? window.open("data:text/csv;charset=utf-8," + escape(e)) : window.open("", "csv", "").document.body.innerHTML = "<pre>" + e + "</pre>"
}

//Enable drag and drop samples if needed
function enable_drag_drop() {
    chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll(".dragme").call(drag), chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll(".dragme").on("mousemove", function(e) {
        var t = chanaka.select(this)[0][0].id;
        if ("tree" != t) {
            var a = chanaka.select(document.getElementById("viz")).selectAll("svg").select("g#" + t).append("g").attr("class", "delete_class");
            chanaka.xml("plugins/eximage/svg/close.svg", "image/svg+xml", function(e) {
                document.importNode(e.documentElement, !0);
                a.node().appendChild(e.documentElement);
                var l = a.select("svg");
                l.attr("class", "delete_sub_class"), l.attr("x", 60), l.attr("y", 0).on("click", function(e) {
                    remove_draggable_samples(chanaka.select(document.getElementById("viz")).selectAll("svg").select("g#" + t), t), a.transition().duration(600).style("opacity", 0).remove()
                })
            })
        }
    });
    var e = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll(".dragme").on("mouseout", function(t) {
        e.selectAll(".delete_class").transition().duration(600).style("opacity", 0).remove()
    });
    $("#close-button").click(function() {
        $("#sample_holder").hide("slide", {
            direction: "left"
        }, 400)
    }), $("#open-button").click(function() {
        $("#sample_holder").show("slide", {
            direction: "left"
        }, 400)
    })
}

//remove sample from the main area
function remove_draggable_samples(e, t) {
    e.transition().duration(600).style("opacity", 0), removed_draggable_samples.push(t), $.unique(removed_draggable_samples), update_draggable_samples(), removed_draggable_samples.length > 0 && $("#sample_holder").show("slide", {
        direction: "left"
    }, 400), retrievedata()
}

function clone(e) {
    var t = chanaka.select(e).node();
    return chanaka.select(t.parentNode.insertBefore(t.cloneNode(!0), t.nextSibling))
}

function cloneAll(e) {
    var t = chanaka.selectAll(e);
    return t.each(function(e, a) {
        t[0][a] = this.parentNode.insertBefore(this.cloneNode(!0), this.nextSibling)
    }), t
}

function update_draggable_samples() {
    $("#viz").droppable({
        accept: ".ui-draggable",
        drop: function(e, t) {
            if (t.position.left + 40 > chanaka.selectAll("div#sample_holder").node().offsetWidth) {
                t.draggable.remove();
                chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("g#" + t.draggable[0].__data__).node().getBBox();
                chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("g#" + t.draggable[0].__data__).attr("transform", "translate(" + (t.position.left - e.offsetX) + "," + t.position.top + ")"), chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("g#" + t.draggable[0].__data__).style("opacity", 1), "wood" == t.draggable[0].__data__ ? (removed_draggable_samples.splice($.inArray("phloem", removed_draggable_samples), 1), removed_draggable_samples.splice($.inArray("xylem", removed_draggable_samples), 1), removed_draggable_samples.splice($.inArray("immature_xylem", removed_draggable_samples), 1)) : removed_draggable_samples.splice($.inArray(t.draggable[0].__data__, removed_draggable_samples), 1), retrievedata()
            }
        }
    });
    var e = chanaka.select(".sample_holder_list").selectAll("li").data(removed_draggable_samples).enter().append("li").attr("class", "ui-draggable").attr("cursor", "move").attr("float", "left").attr("margin-top", "6px").append("svg");
    e.select(function(t) {
        var a = clone(chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("g#" + t).node());
        a.attr("transform", "scale(0.7)translate(20,20)"), a.selectAll("path").attr("fill", "#cccccc"), a.selectAll(".delete_class").remove();
        var l = chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll("g#" + t).node().getBBox();
        return e.attr("height", function(e) {
            return l.height > 200 ? 200 : l.height
        }), e.attr("width", function(e) {
            return l.width > 200 ? 200 : l.width
        }), this.appendChild(a.node())
    }), $(".ui-draggable").draggable({
        revert: !0,
        containment: "viz"
    })
}

function myHelper(e) {
    chanaka.select(e.currentTarget).select("svg").node().innerHTML;
    return "<div><svg>" + group_element + "</svg></div>"
}

function initme() {
    $(".sample_holder_list li").draggable({
        revert: !0,
        revertDuration: 200,
        cursorAt: {
            left: -2,
            top: -2
        },
        start: function(e) {
            DragDropManager.dragged = chanaka.select(e.target).datum()
        },
        drag: function(e) {
            matches = DragDropManager.draggedMatchesTarget(), $(e.target).draggable("option", "revertDuration", matches ? 0 : 200)
        },
        stop: function(e, t) {
            DragDropManager.draggedMatchesTarget() && $(e.target).draggable("disable")
        }
    })
}

drag.origin(function() {
    var e = chanaka.select(this);
    return null != e.attr("transform") ? {
        x: e.attr("x") + chanaka.transform(e.attr("transform")).translate[0],
        y: e.attr("y") + chanaka.transform(e.attr("transform")).translate[1]
    } : {
        x: 0,
        y: 0
    }
}).on("dragstart", function() {
    chanaka.event.sourceEvent.stopPropagation()
}).on("drag", function() {
    var e = chanaka.select(this),
        t = chanaka.event.x,
        a = chanaka.event.y,
        l = chanaka.select(document.getElementById("viz")).selectAll("svg").node().clientHeight - e.node().getBBox().height,
        n = chanaka.select(document.getElementById("viz")).selectAll("svg").node().clientWidth - e.node().getBBox().width;
    0 > t && (t = 0), t > n && (t = n), 0 > a && (a = 0), a > l && (a = l), e.attr("transform", "translate(" + t + "," + a + ")").attr("class", "dragme_true")
}).on("dragend", function() {
    chanaka.select(this).attr("class", "dragme")
});
var zoom = chanaka.behavior.zoom().scaleExtent([-1, 8]).on("zoom", function() {
        chanaka.select(document.getElementById("viz")).selectAll("svg").selectAll(".dragme").attr("transform", "translate(" + chanaka.event.translate + ")scale(" + chanaka.event.scale + ")")
    }),
    DragDropManager = {
        dragged: null,
        droppable: null,
        draggedMatchesTarget: function() {
            return !!this.droppable && removed_draggable_samples[this.droppable].indexOf(this.dragged) >= 0
        }
    };
