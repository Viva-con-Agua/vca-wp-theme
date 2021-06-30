/* eslint-disable max-len */
/* eslint-disable func-names */
/* eslint-disable no-undef */
import dataStore from '../inc/dataStore';

const mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');
const he = require('he');

mapboxgl.accessToken = wp_urls.mapBoxToken;

/* Map Box  ++++++++++++++++++++++++++++++++++++++++++*/
export default function volunteerMap() {
    const createMap = function(teams) {
        // eslint-disable-next-line max-len
        const locations = teams.map((team) => {
            if (team.acf.volunteerTeamLocation) {
                return [parseFloat(team.acf.volunteerTeamLocation.lng), parseFloat(team.acf.volunteerTeamLocation.lat)];
            }
            return null;
        });

        const coordinates = locations.filter((loc) => loc != null);

        const map = new mapboxgl.Map({
            container: 'volunteerMap',
            style: 'mapbox://styles/herrlich-media/ckgkx3mi615k919nvxkiuweg4',
            // bounds: coordinates,
            zoom: 2,
            antialias: true
        });

        const nav = new mapboxgl.NavigationControl({
            showCompass: false
        });
        map.addControl(nav, 'bottom-left');
        map.scrollZoom.disable();

        const striphtml = (str) => {
            const div = document.createElement('div');
            div.innerHTML = str;
            const text = div.textContent || div.innerText || '';
            return text;
        };

        teams.forEach((team) => {
            let imgUrl = '';
            if (team._embedded) {
                imgUrl = team._embedded['wp:featuredmedia'][0].media_details.sizes.tiny.source_url;
            } else {
                imgUrl = '';
            }

            const content = `
            <div class="popupContentContainer">
                <div class="volunteerTeamContent">
                    <div class="popupTitle">
                        ${he.decode(team.title.rendered)}
                    </div>
                    ${striphtml(team.acf.volunteerTeamInfotext)}
                </div>
                <div class="popupImage">
                    <img src="${imgUrl}" />
                </div>
                ${team.acf.volunteerTeamInstagram
        // eslint-disable-next-line max-len
        ? `<div class="instagram linkBtn"><a href="${team.acf.volunteerTeamInstagram}" title="${he.decode(team.title.rendered)} Instagram" target="_blank"></a></div>`
        : ''}
        ${team.acf.volunteerTeamEmail
        // eslint-disable-next-line max-len
        ? `<div class="email linkBtn"><a href="mailto:${team.acf.volunteerTeamEmail}" title="${he.decode(team.title.rendered)} Email"></a></div>`
        : ''}
            </div>
        `;

            const popup = new mapboxgl.Popup({
                offset: 40,
                className: 'mapPopup',
                closeButton: false
            })
                .setHTML(content);

            const el = document.createElement('div');
            el.className = 'marker';

            const location = [
                +parseFloat(team.acf.volunteerTeamLocation.lng).toFixed(7),
                +parseFloat(team.acf.volunteerTeamLocation.lat).toFixed(7)
            ];

            new mapboxgl.Marker(el, {
                offset: [0, -15]
            })
                .setLngLat(location)
                .setPopup(popup)
                .addTo(map);
        });

        const corners = coordinates.reduce((bounds, coord) => bounds.extend(coord),
            new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));

        map.fitBounds(corners, {
            padding: 120,
            easing(t) {
                return t * (2 - t);
            }
        });

        let firstMove = false;
        map.on('moveend', () => {
            if (firstMove === false && dataStore.gallerySliderBlock.activeIndex !== undefined) {
                dataStore.gallerySliderBlock.update();
                firstMove = true;
            }
        });

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
            const isTouchEvent = (e) => e.originalEvent && 'touches' in e.originalEvent;
            const isTwoFingerTouch = (e) => e.originalEvent.touches.length >= 2;

            map.on('dragstart', (event) => {
                if (isTouchEvent(event) && !isTwoFingerTouch(event)) {
                    map.dragPan.disable();
                }
            });

            map.on('touchstart', (event) => {
                if (isTouchEvent(event) && isTwoFingerTouch(event)) {
                    map.dragPan.enable();
                }
            });
        }
    };

    if (document.getElementById('volunteerMap')) {
        fetch(`${window.location.origin}/wp-json/wp/v2/volunteerteam?_embed=1`).then((response) => response.json())
            .then((data) => {
                createMap(data);
            })
            .catch((error) => {
                // eslint-disable-next-line no-console
                console.log(error);
            });
    }
}
