const hidePreloader = () => {
    $(".pre-loader lottie-player").fadeOut( "slow" );
    $(".pre-loader").fadeOut( "slow" );
    $("body").removeClass("preloader-show");
};

const initVideoLazyLoading = () => {
    let lazyLoadVideos = [].slice.call(document.querySelectorAll("video.lazy-load"));

    /** @param {HTMLVideoElement} video */
    const setVideoSource = video => {
        for ( let source in video.children ) {
            const videoSource = video.children[source];

            if ( typeof videoSource.tagName === "string" && videoSource.tagName === "SOURCE" ) {
                videoSource.src = videoSource.dataset.src;
            }
        }

        video.load();
        video.classList.remove("lazy-load");
    };

    if ( ! "IntersectionObserver" in window) {
        lazyLoadVideos.forEach( video => setVideoSource(video) );
        return;
    }

    const intersectionObserver = new IntersectionObserver(function(entries) {
        entries.forEach( video => {
            if ( !video.isIntersecting ) {
                return;
            }
            console.log('Video loaded lazy');
            setVideoSource(video.target);

            intersectionObserver.unobserve(video.target);
        });
    });

    lazyLoadVideos.forEach( video => intersectionObserver.observe(video) );
}

window.addEventListener('load', () => {
    initVideoLazyLoading();
    hidePreloader();
})

$(document).ready(function () {
    // Customize Navbar when hamburger gets clicked 
    $(".navbar-toggler").click(function () {
        $("body").toggleClass("navbar-open");
        $(".main-header").toggleClass("navbar-collapse");
    });

    // close Navbar whne Internal links gets clicked
    if (screen.width < 1199) {
        $('.js-active').click(function () {
            $('#hamburger').click()
        })
    }

    // Scroll page when submit button gets clicked
    jQuery(document).on('nfFormSubmitResponse', function () {
        $('html ,body').animate({
            scrollTop: 300
        }, 100);
    });

    // Split UL when items are greater tan 5
    $('.block-collapse .collapse').find('ul').each(function () {
        var listItems = $(this).find('li').length

        if (listItems > 5) {
            $(this).addClass("column-count-2");
        }
    });

    // Make Dropdown clickable on Desktop
    /* Bootstrap dropdown on hover */
    if (screen.width > 1199) {
        $(".navbar-nav > .dropdown")
            .mouseover(function () {
                $(this)
                    .addClass("show")
                    .attr("aria-expanded", "true");
                $(this)
                    .find(".dropdown-menu")
                    .addClass("show");
            })
            .mouseout(function () {
                $(this)
                    .removeClass("show")
                    .attr("aria-expanded", "false");
                $(this)
                    .find(".dropdown-menu")
                    .removeClass("show");
            });
    } else {}

    // Custom Play Button on Youtube Video
    $('#play').on('click', function (e) {
        // Youtube Video
        $('#play').hide(2500);
        // var src = $("#iframe_pick").attr('src');
        $("#iframe_pick")[0].src += "?autoplay=1";
        e.preventDefault();
        // HTML Video Tag
        var myVideo = document.getElementById("video1");
        if (myVideo.length == 1) {
            myVideo.play();
        }
    });

    $('.btn-close').click(function () {
        $('#play').show();
    });

    // Show & Hide data for block collapse section (Referral Partners Page)
    var href = window.location.href
    var elmId = href.split('/')[4]
    console.log(href, elmId)
    $(elmId).find('.collapse').addClass('show')
    $(elmId).find('button').attr('aria-expanded', 'true')

    $(".js-active").click(function () {
        var href = $(this).attr("href");
        var sectionId = href.split('/')[2];
        if (!$(sectionId).find('.collapse').hasClass('show')) {
            $(".block-collapse").find(".collapse").removeClass("show");
            $(".block-collapse").find('button').attr('aria-expanded', 'false')
            $(sectionId).find('.collapse').addClass('show')
            $(sectionId).find('button').attr('aria-expanded', 'true')
        }
    });

    // Toggle Show Class on Accordion
    jQuery(".accordion-button").click(function () {
        var ariaExpanded = jQuery(this).attr("aria-expanded")
        jQuery(".accordion-item").removeClass("show")
        if (ariaExpanded === 'true') {
            jQuery(this).closest(".accordion-item").addClass("show");
        }
    })

    // Steps Circles Ratio
    $(window).resize(function () {
        resizeWindow();
    });
});
window.addEventListener('load', resizeWindow)

const selectElement = $('.steps-circle');
if (selectElement.length) {
    const circleElm = document.querySelector('.steps-circle');
    new ResizeObserver(function () {
        resizeWindow();
    }).observe(circleElm)
}


function resizeWindow() {
    var winSize = $(window).width();
    if (winSize > 1200) {
        $(".desktop-dials .steps-circle").each(function (i, vl) {
            var ratio = $(this).width()
            console.log(ratio)
            $(this).height(ratio)
        })
    } else {
        $(".tablet-dials .steps-circle").each(function (i, vl) {
            var ratio = $(this).width()
            $(this).height(ratio)
        })
    }
}
// Add Dynamic Height in Blog Wrapper
var $height = $(".main-aside aside").height();
$(".single-blog-wrap").css({
    "min-height": 'calc(8.75rem + ' + $height + 'px)'
});

// Banner Swiper

var bannerSlider = new Swiper(".banner-slider", {
    slidesPerView: 6,
    freeMode: true,
    navigation: {
        nextEl: '.banner-slide-next',
        prevEl: '.banner-slide-prev',
    },
    breakpoints: {
        '1599': {
            spaceBetween: 58,
            slidesPerView: 6,
        },
        '1025': {
            spaceBetween: 50,
            slidesPerView: 4,
        },
        '719': {
            spaceBetween: 50,
            slidesPerView: 3,
        },
        '320': {
            spaceBetween: 50,
            slidesPerView: 2,
        },
    },
});

// Lightbox Slides
var swiper = new Swiper(".lightbox-slides", {
    slidesPerView: 5.2,
    spaceBetween: 0,
    freeMode: true,
    // watchSlidesProgress: true,
    navigation: {
        nextEl: ".lightbox-slide-next",
        prevEl: ".lightbox-slide-prev",
    },
    breakpoints: {
        '1199': {
            slidesPerView: 5.05,
            spaceBetween: 0,
        },
        '719': {
            slidesPerView: 5,
            spaceBetween: 0,
        },
        '320': {
            slidesPerView: 3.5,
            spaceBetween: 0,
        },
    },
});
// Lightbox Block
var swiper2 = new Swiper(".lightbox-block", {
    freeMode: true,
    spaceBetween: 20,
});

// Custom Cards Swiper
var cardsSlider = new Swiper(".cards-slider", {
    slidesPerView: 1.25,
    spaceBetween: 10,
    freeMode: true,
    navigation: {
        nextEl: '.card-slide-next',
        prevEl: '.card-slide-prev',
    },
    observer: true,
    observeParents: true,
    breakpoints: {
        '1199': {
            spaceBetween: 30,
            slidesPerView: 3,
        },
        '719': {
            slidesPerView: 2.3,
        },
    },
});

// Custom Tabs Swiper
var customNavTabs = new Swiper(".custom-nav-tabs", {
    slidesPerView: 1,
    spaceBetween: 21,
    breakpoints: {
        '1599': {
            slidesPerView: 4,
        },
        '1199': {
            slidesPerView: 3,
        },
        '719': {
            slidesPerView: 2,
        },
        '360': {
            slidesPerView: 1,
        }
    },
    navigation: {
        nextEl: '.tab-slide-next',
        prevEl: '.tab-slide-prev',
    },
});

// Resource Tabs Swiper
var customNavTabs2 = new Swiper(".resources-nav-tabs", {
    slidesPerView: 3.1,
    freeMode: true,
    disableOnInteraction: true,
    breakpoints: {
        '1799': {
            spaceBetween: 21,
            slidesPerView: 4.8,
        },
        '1199': {
            slidesPerView: 4,
        },
        '719': {
            slidesPerView: 5,
        },
        '360': {
            slidesPerView: 2.5,
        }
    },
    navigation: {
        nextEl: '.resources-slide-next',
        prevEl: '.resources-slide-prev',
    },
});

// Our Partners Tabs Swiper
var ourPartners = new Swiper(".our-partners", {
    slidesPerView: 3,
    breakpoints: {
        '1499': {
            slidesPerView: 6.7,
        },
        '1199': {
            slidesPerView: 5,
        },
        '576': {
            slidesPerView: 3,
        },
        '360': {
            slidesPerView: 1.8,
        },
    },
    spaceBetween: 0,
    centeredSlides: true,
    speed: 3000,
    autoplay: {
        delay: 1,
    },
    loop: true,
    slidesPerView: 'auto',
    allowTouchMove: false,
    disableOnInteraction: true
});