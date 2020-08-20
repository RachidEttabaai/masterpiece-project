$(document).ready(function() {

    $("#select_country").change(function() {
        let str;
        $("select option:selected").each(function() {
            str = $(this).text();
        });
        if (str != "Choose a country") {
            alert(str);
        }

    }).change()

    let options = $("#select_country option");

    let values = $.map(options, function(option) {
        if (option.value != "none") {
            let coord = option.value.split(" ");
            return { "latLng": [coord[0], coord[1]], "name": option.text };
        }
    });

    //console.log(values);

    $("#world-map-markers").vectorMap({
        map: 'world_mill',
        backgroundColor: 'transparent',
        series: {
            regions: [{
                values: values,
                scale: ['#C8EEFF', '#0071A4'],
                normalizeFunction: 'polynomial'
            }]
        },
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        markerStyle: {
            initial: {
                fill: '#F8E23B',
                stroke: '#383f47'
            }
        },
        backgroundColor: '#383f47',
        markers: values
    });
});