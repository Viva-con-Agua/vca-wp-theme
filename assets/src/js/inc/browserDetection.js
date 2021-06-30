import dataStore from './dataStore';

/* Browser Detection  ++++++++++++++++++++++++++++++++++++++++++*/
export default function browserDetection() {
    const browser_ = navigator.userAgent.toLowerCase();

    if (browser_.indexOf('msie') > -1 || !!browser_.match(/trident.*rv:11\./)) {
        dataStore.isIe = true;
        $('body').addClass('ie');
    } else if (browser_.indexOf('edge') > -1) {
        dataStore.isIe = true;
        $('body').addClass('ie');
    } else if (browser_.indexOf('firefox') > -1) {
        dataStore.isFirefox = true;
        dataStore.isNoIe = true;
        dataStore.scrollEventListener = 'DOMMouseScroll';
        $('body').addClass('firefox no-ie');
    } else if (browser_.indexOf('chrome') > -1) {
        dataStore.isNoIe = true;
        $('body').addClass('chrome no-ie');
    } else if (browser_.indexOf('safari') > -1) {
        dataStore.isSafari = true;
        dataStore.isNoIe = true;
        $('body').addClass('safari no-ie');
    } else {
        dataStore.isNoIe = true;
        $('body').addClass('no-ie');
    }

    /* touch check ++++++++++++++++++++++++++++++++++++++++++*/
    if (isTouchEnabled()) {
        dataStore.touch = true;
        $('html').addClass('touchEnabled');
    }

    function isTouchEnabled() {
        return ('ontouchstart' in window)
            || (navigator.maxTouchPoints > 0)
            || (navigator.msMaxTouchPoints > 0);
    }
}
