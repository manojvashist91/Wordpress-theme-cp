jQuery(function($) {
    $('.load_more_posts').click(function(e) {
    
        limit =  $(this).attr('limit');
        page =  $(this).attr('page');
        category =  $(this).attr('category');
        maxpage = $(this).attr('maxpage');

        e.preventDefault();
        //var category = $('.btn.cmn-btn.bg-grey.space-normal.h-auto.shadow-none.min-width-initial.active').attr('category');
        var button = $(this),
            data = {
                'action': 'loadmore',
                'limit': limit,
                'page': page,
                'maxpage': maxpage,
                'category': category
            };
        $.ajax({
            url: loadmore_params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text(loadmore_params.loading_text); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                
                if (data) {
                $(".wrapping").append(data);
                    page++;
                    button.text(loadmore_params.load_more_text); // load more
                    button.attr('page', page);
                    if (page == maxpage){
                         button.hide(); // if last page, remove the button
                    }
                } else {
                    button.hide(); // if no data, remove the button as well
                }
            }
        });
    });
    
    $('.load_all_posts').click(function(e) {
    
        limit =  $(this).attr('limit');
        page =  $(this).attr('page');
        category =  $(this).attr('category');
        maxpages = $(this).attr('maxpages');

        e.preventDefault();
        //var category = $('.btn.cmn-btn.bg-grey.space-normal.h-auto.shadow-none.min-width-initial.active').attr('category');
        var button = $(this),
            data = {
                'action': 'loadall',
                'limit': limit,
                'page': page,
                'maxpages': maxpages,
                'category': category
            };
        $.ajax({
            url: loadmore_params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text(loadmore_params.loading_text); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                
                if (data) {
                $(".wrappingall").append(data);
                    page++;
                    button.text(loadmore_params.load_more_text);
                    button.attr('page', page);
                    if (page == maxpages){
                         button.hide(); // if last page, remove the button
                    }
                } else {
                    button.hide(); // if no data, remove the button as well
                }
            }
        });
    });
    $('.load_all_posts_search').click(function(e) {

        limit =  $(this).attr('limit');
        page =  $(this).attr('page');
        maxpages = $(this).attr('maxpages');
        keyword =  $(this).attr('keyword');


        e.preventDefault();
        //var category = $('.btn.cmn-btn.bg-grey.space-normal.h-auto.shadow-none.min-width-initial.active').attr('category');
        var button = $(this),
            data = {
                'action': 'loadall_search',
                'limit': limit,
                'page': page,
                's':keyword,
                'maxpages': maxpages,
            };
        $.ajax({
            url: loadmore_params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                button.text(loadmore_params.loading_text); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                if (data) {
                    $(".wrapping").append(data);
                    page++;
                    button.text(loadmore_params.load_more_text);
                    button.attr('page', page);
                    if (page == maxpages){
                        button.hide(); // if last page, remove the button
                    }
                } else {
                    button.hide(); // if no data, remove the button as well
                }
            }
        });
    });
});

jQuery(document).ready(function($){
   
    $('.btn.cmn-btn.bg-grey.h-auto.shadow-none.nav-link.min-width-initial').on('click', function(){

        $('.btn.cmn-btn.bg-grey.h-auto.shadow-none.nav-link.min-width-initial.active').not(this).removeClass('active');
        $('.appended').remove();
        $('.appendedall').remove();
        $('.btn.bg-blue.cmn-btn.curve-left.load-more.mt-5.load_more_posts').attr('page', '1');
        $('.btn.bg-blue.cmn-btn.curve-left.load-more.mt-5.load_more_posts').show();
        $('.btn.bg-blue.cmn-btn.curve-left.load-more.mt-5.load_all_posts').attr('page', '1');
        $('.btn.bg-blue.cmn-btn.curve-left.load-more.mt-5.load_all_posts').show();
    });

});