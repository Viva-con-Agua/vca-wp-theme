import '@fancyapps/fancybox';
import Headroom from 'headroom.js';
import './plugins/inView';
import Swiper, {
    Navigation,
    Pagination,
    EffectFade,
    Controller
} from 'swiper';
// import { TweenMax, Expo } from 'gsap/all';

import {
    parallaxObject,
    parallaxScroll
} from './inc/parallaxScroll';

import mapBox from './inc/hmMaps';
// import smoothScroll from './inc/smoothScroll';
import dataStore from './inc/dataStore';
import volunteerMap from './templateParts/volunteerMap';
import { herrlichesMenu, mobileSubmenu, hmNavInit } from './inc/header';
import browserDetection from './inc/browserDetection';

Swiper.use([Navigation, Pagination, EffectFade, Controller]);

const LazyLoad = require('vanilla-lazyload');

window.jQuery = jQuery;
window.$ = jQuery;

/* Author: herrlich media */
$(document).ready(() => {
    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* Ready Inits +++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    /* browser/touch detection ++++++++++++++++++++++++++++++++++++++++++*/
    browserDetection();

    /* Herrlich Media Nav Init ++++++++++++++++++++++++++++++++++++++++++*/
    hmNavInit();

    // Smooth Mousewheel Scrolling for Chrome & Safari
    // smoothScroll();

    // Appned Button Svgs
    btnSvg();

    // Appned linkLine Svgs
    linkLine();

    // Appned Footer Menu Svgs
    footerLink();

    // Wrapper Padding Top By Header Hight
    headerHeight();

    // team More Button/Function
    teamGroupMoreBtn();

    // volunteerMap
    volunteerMap();

    // headroom header
    headroom();

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* Eventlistener +++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FAQs Toggle
    $('.faqsContainer .question').on('click touch', (e) => {
        $(e.currentTarget).siblings('.answer').slideToggle('300', 'swing').parent()
            .toggleClass('active');
    });

    // Donate Now Click
    const donateNow = $('.donateNow');
    if (donateNow.length && $('iframe').length) {
        $('.donateNow').on('click touch', (e) => {
            $('.open').removeClass('open');
            $('html,body').animate({
                scrollTop: $('iframe').offset().top - 150
            }, 300);
            e.preventDefault();
        });
    } else if (donateNow.length) {
        donateNow.hide();
    }

    // FakeNav Header
    // if (dataStore.fakeNavigation.length) {
    //     $('#frontPageHeader .fakeNavigation .swiper-button-prev').on('click touch', () => {
    //         $('#frontpageSliderContent .swiper-button-prev, #frontpageSliderImg .swiper-button-next')
    //               .trigger('click');
    //     });
    //     $('#frontPageHeader .fakeNavigation .swiper-button-next').on('click touch', () => {
    //         $('#frontpageSliderContent .swiper-button-next, #frontpageSliderImg .swiper-button-next')
    //            .trigger('click');
    //     });
    // }

    //Fakenav Goles
    // if (dataStore.golesFakeNavigation.length) {
    //     $('#goles .fakeNavigation .swiper-button-prev').on('click touch', () => {
    //         $('#golesContentSlider .swiper-button-prev, #golesImgSlider .swiper-button-next').trigger('click');
    //     });
    //     $('#goles .fakeNavigation .swiper-button-next').on('click touch', () => {
    //         $('#golesContentSlider .swiper-button-next, #golesImgSlider .swiper-button-next').trigger('click');
    //     });
    // }

    // Team More Button
    $('.teamGroupRow .btn.more').on('click touch', (e) => {
        $(e.currentTarget).hide().siblings('.hidden').fadeIn();
    });

    // Goles img mouse parallax
    // #### Auskommentiert weil zum start nicht gewollte, kommt später wieder rein
    // $(document).on('mousemove', '.golesImgSlide', (event) => {
    //     const golesImg = $(event.currentTarget).find('.golesImg');
    //     const mousePosition = (event.pageX - (dataStore.docWidth / 2)) / 70;

    //     for (let golesImgIndex = 0; golesImgIndex < golesImg.length; golesImgIndex++) {
    //         if (golesImgIndex > 0) {
    //             const aboutImgX = mousePosition * (golesImgIndex * 1.3);
    //             TweenMax.to($(golesImg[golesImgIndex]), 1.1, {
    //                 x: -aboutImgX,
    //                 ease: Expo.easeOut,
    //                 overwrite: 5
    //             });
    //         }
    //     }
    // });

    // Video Block Poster Img
    $('.videoBlock .posterImg').on('click tocuh', (e) => {
        const $this = $(e.currentTarget);
        const type = $this.attr('data-type');
        const url = $this.attr('data-url');
        const appendTo = $this.parent();

        $this.remove();
        if (type === 'youtube') {
            appendTo.append(`<iframe src="${url}&showinfo=0" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write;
                encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`);
        } else {
            appendTo.append(`<video controls autoplay ><source src="${url}" type="video/mp4"></video>`);
        }
    });

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* Plugins +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // FANCYBOX
    $('[data-fancybox]').fancybox({
        afterLoad() {
            dataStore.smoothDisabled = true;
        },
        beforeClose() {
            dataStore.smoothDisabled = false;
        }
    });

    /**** Map Box ***/
    if ($('#map').length) {
        mapBox();
    }

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* Scroll ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    $(window).scroll(() => {
        dataStore.docScroll = $(window).scrollTop();

        // Parallax Scroll Funnction
        parallaxScroll();

        // Contact Bar Vis Class
        dataStore.contactBar.toggleClass('vis', dataStore.docScroll >= 600);
    });
}); /* ready end ++++++++++++++++++++++++++++++++++++++++++*/

$(window).resize(() => {
    dataStore.docWidth = $(document).width();
    dataStore.docHeight = $(document).height();
    dataStore.winHeight = $(window).height();

    clearTimeout(dataStore.endOfResize);
    dataStore.endOfResize = setTimeout(() => {
        afterResize();
    }, 250);
});

function afterResize() {
    // Menu
    mobileSubmenu();
    herrlichesMenu.destroy();
    herrlichesMenu.init();

    // Wrapper Padding Top By Header Hight
    headerHeight();

    // Parallax Object Creare on resize
    parallaxObject();

    $(window).trigger('scroll');
}

$(window).on('load', () => {
    // Parallax Object Creare on resize
    parallaxObject();

    // ###### Auskommentiert da Borlabs deaktiviert wird
    // Check for cookie Consent
    // checkCookie();

    /*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* Plguins ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
    /* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

    // /* Swiper  ++++++++++++++++++++++++++++++++++++++++++*/

    /* Frontpage Slider Swiper  ++++++++++++++++++++++++++++++++++++++++++*/
    dataStore.frontpageSliderContent = new Swiper('#frontpageSliderContent', {
        loop: true,
        speed: 450,
        spaceBetween: 30,
        autoHeight: true,
        allowTouchMove: false,
        fadeEffect: { crossFade: true },
        slidesPerView: 1,
        effect: 'fade',
        on: {
            init: (e) => {
                $(e.el).addClass('vis');

                setTimeout(() => {
                    swiperPaginationNumbert();
                }, 100);
            }
        }
    });

    // dataStore.frontpageSliderContent.on('slideChange', (e) => {
    //     const currentBullet = dataStore.fakeNavigation.find('.swiper-pagination-bullet').eq(e.realIndex);
    //     dataStore.fakeNavigation.find('.swiper-pagination-bullet').not(currentBullet)
    //         .removeClass('swiper-pagination-bullet-active');
    //     currentBullet.addClass('swiper-pagination-bullet-active');
    // });

    dataStore.frontpageSliderImg = new Swiper('#frontpageSliderImg', {
        loop: true,
        slidesPerView: 1,
        speed: 450,
        allowTouchMove: false,
        pagination: {
            el: '.frontpageSliderImgNavigation .swiper-pagination',
            clickable: true
        },
        navigation: {
            nextEl: '.frontpageSliderImgNavigation .swiper-button-next',
            prevEl: '.frontpageSliderImgNavigation .swiper-button-prev',
        },
        on: {
            init: (e) => {
                $(e.el).addClass('vis');
            }
        }
    });

    if ($('#frontpageSliderImg').length) {
        dataStore.frontpageSliderImg.controller.control = dataStore.frontpageSliderContent;
        dataStore.frontpageSliderContent.controller.control = dataStore.frontpageSliderImg;
    }

    /* Gole Slider Swiper  ++++++++++++++++++++++++++++++++++++++++++*/
    dataStore.golesImgSlider = new Swiper('#golesImgSlider', {
        loop: true,
        speed: 450,
        spaceBetween: 0,
        allowTouchMove: true,
        slidesPerView: 1,
        on: {
            init: (e) => {
                $(e.el).addClass('vis');
            }
        }
    });

    dataStore.golesImgSlider.on('slideChange', () => {
        lazyloadUpdate();
    });

    dataStore.golesContentSlider = new Swiper('#golesContentSlider', {
        loop: true,
        speed: 450,
        spaceBetween: 0,
        allowTouchMove: false,
        fadeEffect: { crossFade: true },
        autoHeight: true,
        slidesPerView: 1,
        effect: 'fade',
        navigation: {
            nextEl: '.golesSliderNav .swiper-button-next',
            prevEl: '.golesSliderNav .swiper-button-prev',
        },
        pagination: {
            el: '.golesSliderNav .swiper-pagination',
            clickable: true
        },
        on: {
            init: (e) => {
                $(e.el).addClass('vis');
            }
        }
    });

    if ($('#golesContentSlider').length) {
        dataStore.golesImgSlider.controller.control = dataStore.golesContentSlider;
        dataStore.golesContentSlider.controller.control = dataStore.golesImgSlider;
    }

    /* Block Slider Swiper  ++++++++++++++++++++++++++++++++++++++++++*/
    dataStore.gallerySliderBlock = new Swiper('.gallerySliderBlock:not(.galleryGrid)', {
        loop: true,
        slidesPerView: 1,
        centeredSlides: false,
        spaceBetween: 20,
        autoHeight: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        breakpoints: {
            768: {
                slidesPerView: 'auto',
                centeredSlides: true,
                autoHeight: false
            }
        },
        on: {
            init: (e) => {
                $(e.el).addClass('vis');
                lazyloadUpdate();
            }
        }
    });

    dataStore.gallerySliderBlock.on('slideChange', () => {
        lazyloadUpdate();
    });

    /* Block Slider Swiper  ++++++++++++++++++++++++++++++++++++++++++*/
    dataStore.ownHeaderSlider = new Swiper('#ownHeaderSlider', {
        loop: false,
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '#ownHeaderSlider .swiper-button-next',
            prevEl: '#ownHeaderSlider .swiper-button-prev',
        },
        on: {
            init: (e) => {
                $(e.el).addClass('vis');
                lazyloadUpdate();
            }
        }
    });

    dataStore.ownHeaderSlider.on('slideChange', () => {
        lazyloadUpdate();
    });

    /* IN VIEW  ++++++++++++++++++++++++++++++++++++++++++*/
    $('.fadeIn, #bottle').one('inview', (e, visible) => {
        if (visible === true) {
            $(e.currentTarget).not('.vis').addClass('vis');
        }
    });

    $('.fadeInRow').one('inview', (e, visible) => {
        if (visible === true) {
            $(e.currentTarget).find('> div, > li, > p').not('.vis').each((i, el) => {
                setTimeout(() => {
                    $(el).addClass('vis');
                }, 150 * i);
            });
        }
    });

    // End of Load
});

// Append Backgroudn Svgs in Button
function btnSvg() {
    $('.btn, #BorlabsCookieBox ._brlbs-accept a').not('.secondary').append('<div class="btnBg"></div>');
    $('.btn.secondary').append(
        `<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
            width="109.311" height="11.018" viewBox="0 0 109.311 11.018">
            <path id="Pfad_869" data-name="Pfad 869"
            d="M-15759.9,4601.545c.84.038,70.216-2.55,70.216-2.55l-94.2-2.246,102.661-3.17-106.3,1.258,106.3,1.031"
            transform="translate(15789.017 -4592.08)" fill="none" stroke="#002e6d" stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="3"/>
        </svg>`
    );
}

// Append Backgroudn Svgs in Button
function linkLine() {
    $('.linkLine, .wpml-ls-current-language > a').append(
        `<svg xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" viewBox="0 0 167 6">
            <path fill="#fff" stroke="#fff" d="M90 1a7 7 0 012 0 17 17 0 012 0h4a7 7 0 013 0h3a8 8
            0 003 0 2 2 0 011 0h3a8 8 0 011 0 2 2 0 012 0 12 12 0 004 0 9 9 0 012 0 6 6 0 002 0 15
            15 0 013 0s0 1 0 0a9 9 0 015 1 9 9 0 002 0 10 10 0 014 0 3 3 0 001 0 9 9 0 013 0 2 2
            0 001 0 2 2 0 012 0 1 1 0 000 0 9 9 0 014 0l3 1h3a2 2 0 011 0 2 2 0 002 0 4 4 0 012
            0l5 1 3 1s1 0 0 0a1 1 0 010 0h-3-1a7 7 0 01-1 0h-2 0-8a4 4 0 01-1 0 29 29 0 00-5 0 7
            7 0 01-2-1h-8a44 44 0 01-7 0l-2-1a1 1 0 00-1 0 3 3 0 01-1 1l-6-1H96h-4a13 13 0 00-4
            0 1 1 0 010 0 6 6 0 00-4 0 3 3 0 010 0 10 10 0 00-4 1 4 4 0 01-2-1 3 3 0 00-1 0 8
            8 0 01-3 0 3 3 0 00-1 1 9 9 0 01-3 0h-4a5 5 0 00-3 0 1 1 0 010 0H51a6 6 0 010 0 3
            3 0 00-3 0 1 1 0 01-1 0 3 3 0 00-2 0h-5a3 3 0 00-1 0 9 9 0 01-4 0 2 2 0 00-1 0 4 4
            0 01-2 0 8 8 0 00-3 0h-6-2a5 5 0 00-1 0 19 19 0 01-4 1 13 13 0 00-2 0h-2H2L1 4a5 5 0
            010-1l1-1h19a17 17 0 014 0 7 7 0 001 0 14 14 0 013-1 42 42 0 008 0 17 17 0 014 0 4 4 0
            001 0h13a25 25 0 015 0h4a2 2 0 011 0 2 2 0 001 0 14 14 0 014 0 27 27 0 003 0h8a4 4 0 003
            0 2 2 0 010 0h6z"/>
        </svg>`
    ).addClass('linkLine');
}

// Footer Link SVG append
function footerLink() {
    $('.footer #contact-menu a, .footer #cat1-menu a, .footer #cat2-menu a').append(
        `<svg preserveAspectRatio="none"  xmlns="http://www.w3.org/2000/svg" width="106.998" height="9.44"
            viewBox="0 0 106.998 9.44">
            <path d="M-15727.065,6690.123h-4.443l-26.122.8-34.3.821-23.63.624-6.267,
            2.389,26.752.467h28.661l34.66.341,14.191-.143"
            transform="translate(15822.536 -6688.123)" fill="none" stroke="#002e6d" stroke-linecap="square"
            stroke-linejoin="bevel" stroke-width="4"/>
        </svg>`
    );
}

// Header Height -> Wrapper Padding Top
function headerHeight() {
    dataStore.wrapper.css({
        'padding-top': dataStore.header.height()
    });
}

function headroom() {
    const element = dataStore.header[0];

    const options = {
        // vertical offset in px before element is first unpinned
        offset: 400,
        // scroll tolerance in px before state changes
        tolerance: 15
    };

    const headroomElement = new Headroom(element, options);
    headroomElement.init();
}

function swiperPaginationNumbert() {
    const pagination = $('.swiper-pagination');

    for (let paginationI = 0; paginationI < pagination.length; paginationI++) {
        const bullets = $(pagination[paginationI]).find('.swiper-pagination-bullet');
        for (let bulletsI = 0; bulletsI < bullets.length; bulletsI++) {
            $(bullets[bulletsI]).attr('data-number', `0${bulletsI + 1}`).append(`
                <svg xmlns="http://www.w3.org/2000/svg" width="52.892" height="17.672"
                viewBox="0 0 52.892 17.672">
                    <path id="Pfad_853" data-name="Pfad 853"
                    d="M-16180.987-980.523c-14.67-3.325-50.887-2.715-50.887-2.715s24.974-9.388,43.433-7.874"
                    transform="translate(16233.105 994.781)" fill="none" stroke="#002e6d" stroke-width="7"/>
                </svg>`);
        }
    }
}

function teamGroupMoreBtn() {
    const teamGroupRow = $('.teamGroupRow');
    if (teamGroupRow.length) {
        for (let teamIndex = 0; teamIndex < teamGroupRow.length; teamIndex++) {
            const members = $(teamGroupRow[teamIndex]).find('> div');

            if (members.length > 4) {
                $(teamGroupRow[teamIndex]).find('.btn.more').fadeIn();
                for (let membersIndex = 0; membersIndex < members.length; membersIndex++) {
                    if (membersIndex > 3) {
                        $(members[membersIndex]).css({
                            display: 'none'
                        }).addClass('hidden');
                    }
                }
            }
        }
    }
}

// Lazyload Update
const lazyloadUpdate = function lazyloadUpdate() {
    if (dataStore.lazyLoadInstance !== '') {
        dataStore.lazyLoadInstance.update();
    }
};

// ###### Auskommentiert da Borlabs deaktiviert wird
// Allow Instagram
// const allowInstagram = function allowInstragram() {
//     lazyloadUpdate();
//     const imgArray = Array.from(document.getElementsByClassName('instaContainer'));
//     imgArray.forEach((img) => {
//         img.classList.add('vis');
//     });
// };

// window.allowInstagram = allowInstagram;
// function checkCookie() {
//     if (window.BorlabsCookie.checkCookieConsent('instagram')) {
//         lazyloadUpdate();
//     }
// }

/* Webp Support Detection  ++++++++++++++++++++++++++++++++++++++++++*/
async function supportsWebp() {
    if (!window.self.createImageBitmap) return false;

    const webpData = 'data:image/webp;base64,UklGRh4AAABXRUJQVlA4TBEAAAAvAAAAAAfQ//73v/+BiOh/AAA=';
    const blob = await fetch(webpData).then((r) => r.blob());
    return createImageBitmap(blob).then(() => true, () => false);
}

// Add Webp to Background Imgaes when supported
(async() => {
    if (await supportsWebp()) {
        dataStore.body.addClass('webp');
        const lazyBg = document.querySelectorAll('[data-bg]');
        lazyBg.forEach((element) => {
            let { bg } = element.dataset;
            if (bg.match(new RegExp('.*(.jpg|.jpeg|.png)')) && !bg.includes('.webp') && !bg.includes('cdninstagram')) {
                bg = `${bg}.webp`;
                element.setAttribute('data-bg', bg);
            }
        });
    }

    /* lazy load  ++++++++++++++++++++++++++++++++++++++++++*/
    dataStore.lazyLoadInstance = new LazyLoad({
        elements_selector: '.lazy'
    });
    lazyloadUpdate();
})();
