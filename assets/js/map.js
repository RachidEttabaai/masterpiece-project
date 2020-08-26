let $ = require("jquery");

require('jvectormap-next')($);
$.fn.vectorMap('addMap', 'world_mill', require('jvectormap-content/world-mill'));

$(document).ready(function() {

    $("#world-map-markers").vectorMap({
        map: 'world_mill',
        backgroundColor: 'transparent',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        markerStyle: {
            initial: {
                fill: '#F8E23B',
                stroke: '#383f47'
            }
        },
        backgroundColor: '#006994',
        onRegionTipShow: function(e, el, code) {
            let popup = $("#" + code).html();
            el.html(popup);
        }
    });
});