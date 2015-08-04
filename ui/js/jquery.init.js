/* ========================================================================= */
/* BE SURE TO COMMENT CODE/IDENTIFY PER PLUGIN CALL */
/* ========================================================================= */

function _brandGrid(){
    $('#brand-grid .brand').hover(function(){
        $(this).addClass('big').siblings('.brand').addClass('small');
    },function(){
        $('.brand').removeClass('big').removeClass('small');
    });
}

function _banner(){
    $('#banner').owlCarousel({
        items: 1,
        nav: true,
        loop: true,
        navText: ['&#x25c0;','&#x25b6']
    });
}

function _toySlider(){
    $('#toys-slider').owlCarousel({
        stagePadding: 1,
        loop:true,
        margin:10,
        nav:true,
        navText: ['&#x25c0;','&#x25b6'],
        items: 1,
        responsive: {
            768: {
                stagePadding: 150
            },
            1080: {
                stagePadding: 250
            },
            1200: {
                stagePadding: 300
            }
        }
    }).on('changed.owl.carousel',function(){
        $('.popup').removeClass('active').siblings('img').removeClass('active');
    });

    $('.popup .expand, #toys-slider img').on('click',function(){
        $(this).parents('.slide').children('.popup').toggleClass('active').siblings('img').toggleClass('active');
    });
}

function _brandSlider(){
    $('#brand-slides').owlCarousel({
        loop:true,
        nav:true,
        navText: ['&#x25c0;','&#x25b6'],
        items: 1
    });
}

function _faq(){
    $('.faq .q').on('click', function(){
        $(this).toggleClass('x').siblings('.a').slideToggle(150);
    });
}

function _gallery(){
    $('.gallery-small span').on('click',function(){
        $(this).addClass('x').siblings('.x').removeClass('x');
        $('.gallery img').attr('src',$(this).data('big'));
    });
}

function _mobileNav(){
    $('#nav-icon').on('click',function(){
        $(this).toggleClass('x').siblings('#nav').toggleClass('x');
    });
    $('#nav ul li.menu-item-has-children > a').on('click',function(){
        $(this).parents('li').toggleClass('x');
        return false;
    });
}

function _lbVideo(){
    $('a.lb.video').magnificPopup({
        type: 'iframe',
        preloader: false
    });
}

function _linkCheck(){
    $(document).on('click', 'a.external', function(e){
        e.preventDefault;
        var url = e.currentTarget.href;
        console.log(e);
        $('.external-lb a.btn').attr('href',url);
        $.magnificPopup.open({
            mainClass: 'mfp-fade',
            items: {
                src: '.external-lb',
                type: 'inline'
            }
        }, 0);
        return false;
    });
    $('.external-lb a').on('click',function(){
        $.magnificPopup.close();
        if($(this).hasClass('right')){
            return false;
        }
    });
}

function _resultsHeight(){
    $(window).on('load resize',function(){
        $('#results.videos li:nth-child(odd)').each(function(){
            $(this).css('height','auto').next().css('height','auto');
            var h1 = $(this).height();
            var h2 = $(this).next().height();
            if(h1 < h2){
                $(this).height(h2);
            }else{
                $(this).next().height(h1);
            }
        });
    });
}

jQuery(function(){

    console.log(window.location.hostname);

    _brandGrid();
    _banner();
    _toySlider();
    _brandSlider();
    _faq();
    _gallery();
    _mobileNav();
    _lbVideo();
    _linkCheck();
    _resultsHeight();

});
