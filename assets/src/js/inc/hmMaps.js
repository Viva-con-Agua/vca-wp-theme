/* eslint-disable no-undef */
/* Map Box  ++++++++++++++++++++++++++++++++++++++++++*/
export default function mapBox() {
    const token = wp_urls.mapBoxToken;
    const jsonUrl = `https://api.mapbox.com/geocoding/v5/mapbox.places/${wp_urls.adress}.json?access_token=${token}`;
    let center = '';

    if (token !== '') {
        fetch(jsonUrl).then((response) => response.json())
            .then((data) => {
            // Get Center coordinates from Map Box Search API
                center = data.features[0].center;
                mapboxgl.accessToken = token;

            // Create Map Box Object & Options
                const map = new mapboxgl.Map({
                    container: 'map',
                    style: 'mapbox://styles/herrlich-media/cjtu65p5h1jh91fppcxugqmkt',
                    center,
                    offset: 300,
                    zoom: 14.5
                });

            // set Marker options
                const geojson = {
                    type: 'FeatureCollection',
                    features: [{
                        type: 'Feature',
                        geometry: {
                            type: 'Point',
                            coordinates: center
                        },
                    // Set Mapbox infoBox Text
                        properties: {
                            title: 'Box Title',
                            description: 'Marker Text'
                        }
                    }]
                };

            // add markers to map
                geojson.features.forEach((marker) => {
                // create a HTML element for each feature
                    const el = document.createElement('div');
                    el.className = 'marker';

                // make a marker for each feature and add to the map
                    new mapboxgl.Marker(el)
                        .setLngLat(marker.geometry.coordinates)
                        .setPopup(new mapboxgl.Popup({ offset: 25 }) // add popups
                            .setHTML(`<h3>${marker.properties.title}</h3><p>${marker.properties.description}</p>`))
                        .addTo(map);
                });

            // Add zoom and rotation controls to the map.
            // map.addControl(new mapboxgl.NavigationControl(), 'top-left');
            }).catch((error) => {
            // eslint-disable-next-line no-console
                console.log(error);
            });
    }
}
