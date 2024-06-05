(function () {
    "use strict";

    var style = getComputedStyle(document.body);
    var primaryColor = style.getPropertyValue('--primary');
    var secondaryColor = style.getPropertyValue('--secondary');
    var warningColor = style.getPropertyValue('--warning');
    var colors = [primaryColor, secondaryColor, warningColor]; // Add more colors if needed

    function hexToRgb(hex, rgba = null) {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        var rgb = '';

        if (result) {
            rgb = `rgb(${parseInt(result[1], 16)},${parseInt(result[2], 16)},${parseInt(result[3], 16)})`;

            if (rgba) {
                rgb = `rgba(${parseInt(result[1], 16)},${parseInt(result[2], 16)},${parseInt(result[3], 16)}, ${rgba})`;
            }
        }

        return rgb;
    }

    function pieChart($el, labels, datasets, backgroundColors) {
        new Chart($el, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: '',
                    data: datasets,
                    borderWidth: 0,
                    borderColor: '',
                    backgroundColor: backgroundColors,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#6777ef',
                    pointRadius: 4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                segmentShowStroke: false,
                legend: {
                    display: true // Show legend to identify labels
                }
            }
        });
    }

    window.makeDownloadsPieChart = function (elId, labels, datasets) {
        var bodyEl = document.getElementById(elId).getContext('2d');
        pieChart(bodyEl, labels, datasets, [primaryColor]);
    };

    window.makeUserRolesPieChart = function (elId, labels, datasets) {
        var bodyEl = document.getElementById(elId).getContext('2d');
        var backgroundColors = colors.slice(0, datasets.length);
        pieChart(bodyEl, labels, datasets, backgroundColors);
    };

})(jQuery);