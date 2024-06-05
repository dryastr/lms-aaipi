const map = L.map('map').setView([-0.7893, 113.9213], 5);

const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// control that shows state info on hover
const info = L.control();

info.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'info');
    this.update();
    return this._div;
};

info.update = function (props) {
    const contents = props ? `<b>${props.NAME_1}` : 'Arahkan kursor pada wilayah yang ingin dituju';
    this._div.innerHTML = `<h4 style="font-size: 18px;">Wilayah Indonesia</h4>${contents}`;
};

info.addTo(map);

function highlightFeature(e) {
    const layer = e.target;

    layer.setStyle({
        weight: 5,
        color: '#666',
        dashArray: '',
        fillOpacity: 0.7
    });

    layer.bringToFront();

    info.update(layer.feature.properties);
}

fetch('/admin/getKabkotaGeoJSON/32') // Sesuaikan dengan endpoint yang sesuai
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const geojson = L.geoJson(data, {
            style,
            onEachFeature
        }).addTo(map);
    })
    .catch(error => {
        console.error('Error:', error);
    });

function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
}

function zoomToFeature(e) {
    map.fitBounds(e.target.getBounds());
}

function onEachFeature(feature, layer) {
    layer.on({
        mouseover: highlightFeature,
        mouseout: resetHighlight,
        click: zoomToFeature
    });
}

map.attributionControl.addAttribution('Population data &copy; <a href="http://census.gov/">US Census Bureau</a>');

const legend = L.control({ position: 'bottomright' });
legend.addTo(map);
