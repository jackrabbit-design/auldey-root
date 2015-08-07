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
        $('#results li:nth-of-type(odd)').each(function(){
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

function _subNav(){
    $('.sub-menu li.brand').each(function(){
        var subImg = $(this).data('image');
        var subText = $('a',this).text();
        var img = $('<img src="'+subImg+'" alt="'+subText+'" />');
        $('a',this).html(img);
    })
}

function _ageCheck(){
    $('#agecheck a.yes').on('click',function(){
        $('#agecheck').slideUp(200);
        $('#contact').slideDown(200);
        return false;
    });
    $('#agecheck a.no').on('click',function(){
        $('#agecheck').slideUp(200);
        $('#denied').slideDown(200);
        return false;
    });
}

function _brandSort(){
    $('#manual-brands a').on('click',function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#results li').show();
            $('#manual-results .sort-text span').text("All");
        }else{
            $(this).addClass('active').siblings('.active').removeClass('active');
            var brand = $(this).data('brand');
            $('#results li').hide();
            $('#results li[data-brand='+brand+']').show();
            var name = $(this).data('name');
            $('#manual-results .sort-text span').text(name);
        }
        return false;
    });

    $('#manual-types ul li').on('click',function(){
        window.location.href = $(this).data('href');
    });
}

function _toyPage(){
    $(document).on('click','#pagination a',function(e){

        e.preventDefault();
        var link = $(this).attr('href');

        var $content = '.everything';

        $.post(link+'', function(data){
            var $new_content = $($content,data);
            console.log($new_content);
            //$(content).html($new_content); // Append the new content
        },'html');
    });
}

jQuery(function(){

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
    _subNav();
    _ageCheck();
    _brandSort();
    _toyPage();

});
