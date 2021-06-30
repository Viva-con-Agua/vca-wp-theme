import './hmNav';
import dataStore from './dataStore';

function navDropdown() {
    const config = {
        sensitivity: 3, // number = sensitivity threshold (must be 1 or higher)
        interval: 0,  // number = milliseconds for onMouseOver polling interval
        over: doOpen,   // function = onMouseOver callback (REQUIRED)
        timeout: 100,   // number = milliseconds delay before onMouseOut
        out: doClose    // function = onMouseOut callback (REQUIRED)
    };

    function doOpen() {
        if ($(this).hasClass('menu-item-has-children')) {
            $(this).addClass('hover');
            $('ul:first', this).addClass('vis');
        }
    }

    function doClose() {
        if ($(this).hasClass('menu-item-has-children')) {
            $(this).removeClass('hover');
            $('ul:first', this).removeClass('vis');
        }
    }

    $('#mainnavCon ul li').hoverIntent(config);
}

// Herrliches Menu v2
export const herrlichesMenu = {
    init: () => {
        if (!dataStore.touch && dataStore.docWidth > dataStore.touchBreakPoint) {
            const $headerMenu = $('#header-menu');
            const $menuItems = $headerMenu.find('.menu-item:not(.more-links)');
            let headerHeight = $headerMenu.outerHeight();
            const menuItemHeight = $menuItems.outerHeight();

            if (headerHeight > menuItemHeight) {
                const $moreButton = $(`<li class="more-links menu-item-has-children menu-item"><a class="#">
                    <strong>Mehr</strong></a><ul class="sub-menu"></ul></li>`);
                $headerMenu.append($moreButton);

                $menuItems.toArray().reverse().forEach((item) => {
                    const $item = $(item);

                    if (headerHeight > menuItemHeight) {
                        $moreButton.find('.sub-menu').prepend($item);

                        headerHeight = $headerMenu.outerHeight();
                    }
                });
            }
        }

        navDropdown();
    },
    destroy: () => {
        const $headerMenu = $('#header-menu');
        const $moreButton = $('.more-links');
        const $menuItems = $moreButton.find('.menu-item');

        if ($menuItems.length > 0) {
            $menuItems.toArray().forEach((item) => {
                const $item = $(item);
                $headerMenu.append($item);
            });

            $moreButton.remove();
        }
    }
};

/* Mobile Submenu  ++++++++++++++++++++++++++++++++++++++++++*/
export function mobileSubmenu() {
    if (dataStore.touch === true || dataStore.docWidth < dataStore.touchBreakPoint) {
        let mobileSubmenuFlag = true;

        $('.menuPlus').off('touchStart click').on('touchStart click', (event) => {
            if (mobileSubmenuFlag === true) {
                const $target = $(event.currentTarget);
                mobileSubmenuFlag = false;

                $target.toggleClass('active');
                $target.siblings('.sub-menu').slideToggle(250, 'swing', () => {
                    mobileSubmenuFlag = true;
                });
            }
        });
    }
}

/* HM Nav  Init ++++++++++++++++++++++++++++++++++++++++++*/
export function hmNavInit() {
    /* Mobile NAV ++++++++++++++++++++++++++++++++++++++++++*/
    $('#navToggle').click(() => {
        const nav = $('#mainnavCon');

        $('#navToggle, #mainnavCon, body').toggleClass('open');

        if (nav.hasClass('open')) {
            setTimeout(() => {
                nav.addClass('overflowScroll');
            }, 300);
        } else {
            nav.removeClass('overflowScroll');
        }
    });

    /* NAV more ++++++++++++++++++++++++++++++++++++++++++*/
    herrlichesMenu.init();

    /* Mobile Submenu  ++++++++++++++++++++++++++++++++++++++++++*/
    mobileSubmenu();

    // zIndex Menu
    if ($('ul.sub-menu').length) {
        let zIndex = 1;

        $('#header-menu li.menu-item').mouseover(() => {
            $(this).css('z-index', zIndex);
            zIndex++;
        });
    }
}

export default { herrlichesMenu, mobileSubmenu, hmNavInit };
