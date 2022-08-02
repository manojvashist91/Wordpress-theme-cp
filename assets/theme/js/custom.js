/**
 * @var {object} DIFFERED_SCRIPT_LOADING
 */

function initSelfHostedPlayer() {
    const $uploadModal = $('#Modalupload');
    const $iframePick = $('#iframe_pick');
    const $video = $('#video_poster');

    $('.btn.cmn-play[type_video="uploaded"]').click( function() {
        const video_poster_src = $(this).attr('video_poster');
        const video_src = $(this).attr('video_link');

        $video.attr('poster', video_poster_src);
        $video.attr('src', video_src);

        $video.get(0).play();
    });

    $('.play-icon').click( function() {
        $iframePick.attr('src','');
        var link = $(this).attr('video_link');
        $iframePick.attr('src',link);
    })
    $('#nav-tab-0').click();


    $uploadModal.on('hidden.bs.modal', function () {
        const iframe_src = $iframePick.attr('src');
        if ( typeof iframe_src === 'string' ) {
            const urlSplit = iframe_src.split("?");
            const iframe_uri = urlSplit[0];
            $iframePick.attr('src', iframe_uri);
        }

        $video.get(0).pause();
        $video.get(0).currentTime = 0;

        $video.html('');
    })
}

function initYoutubePlayer() {
    const $youtubeModal = $('#Modal');
    let isOpened = false;
    let activeVideoId = null;

    let yPlayer = null;
    const makeYoutubePlayer = () => {
        yPlayer = new YouTubePlayer('#yt-player', {
            autoplay: true,
            related: false,
        });
        yPlayer.on('unstarted', () => {
            yPlayer.play();
        });
        yPlayer.on('playing', () => {
            if ( !isOpened ) {
                yPlayer.pause();
            }
        });

        if ( activeVideoId ) {
            yPlayer.load(activeVideoId);
        }
    };

    setTimeout(() => {
        const tag = document.createElement('script');
        tag.src = DIFFERED_SCRIPT_LOADING.youtube_api.src
        tag.onload = () => makeYoutubePlayer();
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }, DIFFERED_SCRIPT_LOADING.youtube_api.delay);


    $('.btn.cmn-play[type_video="youtube"]').click( function() {
        isOpened = true;

        activeVideoId = $(this).attr('video_link').split('/').pop();
        yPlayer?.load(activeVideoId);
    });

    $youtubeModal.on('hidden.bs.modal', function () {
        isOpened = false;
        activeVideoId = null;

        yPlayer?.pause();
    });
}

$( document ).ready(function() {
    $('.dropdown-item.js-active').on('click', function(){
        $(this).addClass('active');
        $('.dropdown-item.js-active.active').not(this).removeClass('active');
    });

    $('.btn.bg-blue.cmn-btn.curve-left.mt-4.selected-mfa').on('click',function(){
        $('body #Modal-fa').find('form').find('li :first').click();
    });

    $('.btn.bg-blue.cmn-btn.curve-left.mt-4.selected-rfa').on('click',function(){
        $('body #Modal-rfa').find('form').find('li :first').click();
    });

    $('.swiper-slide .btn.cmn-btn').on('click',function(){
        var tab_id = window.location.href.split('#')[1];
        var tab_id_main =$(this).text().toLowerCase().replace(/ +/g, "-");
        var opens = window.location.href.replace(tab_id,tab_id_main);
        window.location.href = opens

        $('.dropdown-item.js-active').each(function( index ) {
            let main_url =  $( this ).attr('href').split('#')[1];
            if(tab_id_main == main_url){
                $(this).addClass('active');
            }else{
                $(this).removeClass('active');
            }
        });
    });

    $('#menu-item-11179').on('click',function(){
        $('#nav-profile-tab-blog').click();
    });

});


$(window).on('load', function() {
    initSelfHostedPlayer();
    initYoutubePlayer();

    let url = location.href.split('/').slice(3).join('/');
    $('.dropdown-item.js-active').each(function( index ) {
        let main_url =  $( this ).attr('href');
        if('/'+url == main_url) {
            $(this).addClass('active');
            var tab_id = url.split('/')[1].split('#')[1];
            $('#nav-profile-tab-'+tab_id).click();
            $('#nav-home-tab').removeClass('active');
        }else{
        }

    });
})


$('.dropdown-item.js-active').on('click', function(){
    let main_url =  $( this ).attr('href');
    let url = main_url.split('/').slice(2).join('/');
    urls = []
    $('.dropdown-item.js-active').each(function( index ) {
        let main_url =  $( this ).attr('href');
        let url_array = main_url.split('/').slice(2).join('/');
        urls.push(url_array);
    });
    if(jQuery.inArray(url , urls) == true){
        $(''+url+' .bg-white.cmn-radius-box').children('button').click();
        var tab_id = url.split('#')[1];
        $('#nav-profile-tab-'+tab_id).click();
    }else{
        //$(''+url+' .bg-white.cmn-radius-box').children('button').click();
        var tab_id = url.split('#')[1];
        $('#nav-profile-tab-'+tab_id).click();
    }
});