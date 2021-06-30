import 'gsap';
import { TweenMax, Expo, ScrollToPlugin } from 'gsap/all';

import dataStore from './dataStore';

const activated = [
    TweenMax,
    Expo,
    ScrollToPlugin
];
activated.test = false;

let translate = '';
let transPerPix = '';
let currentScrollAtWindowBottom = '';

// Parallax Obj
export function parallaxObject() {
    dataStore.docHeight = $(document).height();
    dataStore.winHeight = $(window).height();

    //  Parallax Scroll Img  ++++++++++++++++++++++++++++++++++++++++++*/
    if (dataStore.docWidth > 986 && dataStore.parallaxImg) {
        dataStore.parallaxObject = [];

        dataStore.parallaxWrap.each((i, el) => {
            const elHeight = $(el).height();
            let topEl = $(el).offset().top;
            let speed = $(el).data('speed');
            let diretionChanged = false;

            if (topEl < dataStore.winHeight) {
                topEl = dataStore.winHeight;
            }

            if (speed === 'random') {
                const min = 60;
                const max = 100;
                const random = Math.random() * (+max - +min) + +min;
                speed = random;
            }

            if ($(el).data('direction') === 'down') {
                diretionChanged = true;
            }

            const tempObject = {
                el: $(el),
                elHeight,
                maxTransPix: speed,
                topEl,
                direction: diretionChanged
            };
            dataStore.parallaxObject.push(tempObject);
        });
    }
}

// Parallax Scroll Function
export function parallaxScroll() {
    if (dataStore.docWidth > 986 && dataStore.parallaxImg && !dataStore.touch) {
        for (let a = 0, aLen = dataStore.parallaxObject.length; a < aLen; a++) {
            transPerPix = dataStore.parallaxObject[a].maxTransPix / (dataStore.winHeight
                + dataStore.parallaxObject[a].elHeight); //Faktor je nach Höhe von Bildschirm und IMg im verhältnis.
            currentScrollAtWindowBottom = dataStore.docScroll + dataStore.winHeight;
            translate = (currentScrollAtWindowBottom - dataStore.parallaxObject[a].topEl) * transPerPix;

            if (translate > dataStore.parallaxObject[a].maxTransPix) {
                translate = dataStore.parallaxObject[a].maxTransPix;
            } else if (translate < 0) {
                translate = 0;
            }
            if (dataStore.parallaxObject[a].direction) {
                TweenMax.to(dataStore.parallaxObject[a].el, 1.1, {
                    y: translate,
                    ease: Expo.easeOut,
                    overwrite: 5
                });
            } else {
                TweenMax.to(dataStore.parallaxObject[a].el, 1.1, {
                    y: -translate,
                    ease: Expo.easeOut,
                    overwrite: 5
                });
            }
        }
    } else if (dataStore.parallaxImg) {
        TweenMax.to(dataStore.parallaxWrap, 1.1, {
            y: 0,
            ease: Expo.easeOut,
            overwrite: 5
        });
    }
}
