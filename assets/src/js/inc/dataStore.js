class DataStore {
    constructor() {
        /* scrolling ++++++++++++++++++++++++++++++++++++++++++*/
        this.docScroll = '';
        this.win = $(window);
        this.body = $('body');

        /* window ++++++++++++++++++++++++++++++++++++++++++*/

        this.docWidth = $(document).width();
        this.docHeight = $(document).height();
        this.winHeight = $(window).height();

        /* non editable ++++++++++++++++++++++++++++++++++++++++++*/
        this.endOfResize = false;

        /* browser ++++++++++++++++++++++++++++++++++++++++++*/

        this.isIe = false;
        this.isFirefox = false;
        this.isSafari = false;
        this.isNoIe = false;
        this.touch = false;
        this.touchBreakPoint = 768;

        /* ids ++++++++++++++++++++++++++++++++++++++++++*/

        this.globalIds = JSON.parse(window.wp_urls.globalIds);

        /* fancybox ++++++++++++++++++++++++++++++++++++++++++*/
        this.fancyBoxOnceOpened = false;

        /* smoothscrolling ++++++++++++++++++++++++++++++++++++++++++*/
        this.scrollEventListener = 'wheel';
        this.smoothDisabled = false;

        /* masonry ++++++++++++++++++++++++++++++++++++++++++*/
        this.grid = '';

        /* lazyload ++++++++++++++++++++++++++++++++++++++++++*/
        this.lazyLoadInstance = '';

        /* Map ++++++++++++++++++++++++++++++++++++++++++*/
        this.mapMarkers = [];
        this.map = '';

        /* Header ++++++++++++++++++++++++++++++++++++++++++*/
        this.header = $('.header');
        this.wrapper = $('.wrapper');

        /* Slider ++++++++++++++++++++++++++++++++++++++++++*/
        this.ownHeaderSlider = $('#ownHeaderSlider');

        this.frontpageSliderContent = $('#frontpageSliderContent');
        this.frontpageSliderImg = $('#frontpageSliderImg');

        this.fakeNavigation = $('#frontPageHeader .fakeNavigation .swiper-pagination');
        this.golesFakeNavigation = $('#goles .fakeNavigation .swiper-pagination');

        this.golesImgSlider = $('#golesImgSlider');
        this.golesContentSlider = $('#golesContentSlider');

        this.gallerySliderBlock = $('.gallerySliderBlock');

        this.ownHeaderSlider = $('#ownHeaderSlider');

        /* Parapllax ++++++++++++++++++++++++++++++++++++++++++*/
        this.parallaxWrap = $('[data-parallaxWrap]');
        this.parallaxImg = this.parallaxWrap.length;
        this.parallaxObject = [];
        this.allowScroll = true;

        /* Sonstiges ++++++++++++++++++++++++++++++++++++++++++*/
        this.contactBar = $('#contactBar');

        // End of Datastore
    }
}

export default (new DataStore());
