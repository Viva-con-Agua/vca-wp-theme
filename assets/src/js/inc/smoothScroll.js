import { gsap, TweenMax, Expo } from 'gsap/all';
import { ScrollToPlugin } from 'gsap/ScrollToPlugin';
import dataStore from './dataStore';

gsap.registerPlugin(ScrollToPlugin);

// Smooth Mousewheel Scrolling
export default function smoothScroll() {
    if (!dataStore.isIe) {
        document.onmousewheel = () => {
            customScroll();
        };
        preventWheelScroll();
    }

    // Custom Scroll Function
    function customScroll(event) {
        if (dataStore.smoothDisabled) {
            return;
        }

        let _event;
        let delta = 0;

        if (!event) {
            _event = window.event;
        } else {
            _event = event;
        }

        if (_event.wheelDelta) {
            delta = _event.wheelDelta / 300;
        } else if (_event.detail) {
            delta = -_event.detail / 3;
        }

        if (delta) {
            const scrollTop = dataStore.win.scrollTop();
            const finScroll = scrollTop - (parseInt(delta * 100, 10) * 3);

            TweenMax.to(dataStore.win, 1.1, {
                scrollTo: { y: finScroll },
                ease: Expo.easeOut,
                overwrite: 5
            });
        }

        preventWheelScroll();
        _event.returnValue = false;
    }

    // Prevent Default Scrolling
    function preventWheelScroll() {
        if (document.addEventListener) {
            document.addEventListener(dataStore.scrollEventListener, customScroll, { passive: false });
        }
    }
}
