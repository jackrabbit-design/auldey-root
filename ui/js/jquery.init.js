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
    var wh = $(window).height();
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
    var mh = 0;
    $('.gallery-small span').each(function(){
        if($(this).data('h') > mh){
            mh = $(this).data('h');
        };
    }).on('click',function(){
        $(this).addClass('x').siblings('.x').removeClass('x');
        $('.gallery img').attr('src',$(this).data('big'));
    });
    var gh = $('.gallery-small').outerHeight(true);
    $('#product .gallery').height(mh + gh);
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
    $('#results li:nth-of-type(odd)').each(function(){
        $(this).css('height','auto').children('a').css('height','auto');
        $(this).next().css('height','auto').children('a').css('height','auto');
        var h1 = $(this).height();
        var h2 = $(this).next().height();
        var p = $(this).children('a').css('padding-top').substr(0,2) * 2;
        if(h1 < h2){
            $(this).height(h2).children('a').height(h2 - p);
        }else{
            $(this).next().height(h1).children('a').height(h1 - p);
        }
    });
}

function _subNav(){
    $('.sub-menu li').each(function(){
        var subImg = $(this).data('image');
        var subText = $('a',this).text();
        var img = $('<img src="'+subImg+'" alt="'+subText+'" />');
        $('a',this).html(img);
    })
    $('#nav li.search a span').text('').html('<img src="/ui/images/menu-search.png" alt="Search" />');
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
    $('#results li:visible:even:last').addClass('noborder')
    $('#manual-brands a').on('click',function(){
        $('#manual-brands').removeClass('init');
        if($(this).hasClass('active')){
            $(this).removeClass('active');
            $('#results li').show().removeClass('noborder');
            $('#manual-results .sort-text span').text("All");
        }else{
            $(this).addClass('active').siblings('.active').removeClass('active');
            var brand = $(this).data('brand');
            $('#results li').hide();
            $('#results li[data-brand='+brand+']').show();
            var name = $(this).data('name');
            $('#manual-results .sort-text span').text(name);
        }
        var vis = 0;
        $('#results li:visible:even:last').addClass('noborder')
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
        var $content = '#everything';
        $($content).addClass('loading');
        $.post(link+'', function(data){
            var $new_content = $('<div>').append(data).find($content).html();
            $($content).html($new_content); // Append the new content
        },'html').done(function(){
            $($content).removeClass('loading');
            _toyGrid();
        });
    });
}

function _toySort(){
    $('#sort ul li').on('click',function(){
        if($(this).hasClass('data-1') || $(this).hasClass('data-2')){
            if($(this).hasClass('data-1')){
                var t = $(this).data('2t');
                $(this).removeClass('data-1').addClass('data-2').children('span').text(t);
                var $target = $(this).data('2');
            }else{
                var t = $(this).data('1t');
                $(this).removeClass('data-2').addClass('data-1').children('span').text(t);
                var $target = $(this).data('1');
            }
        }else{
            var t = $(this).data('1t');
            $(this).addClass('data-1').siblings('li').removeClass();
            $('span', this).text(t);
            var $target = $(this).data('1');
        }
        $(this).siblings('li').each(function(){
            var d = $(this).data('d');
            $('span', this).text(d);
        });
        var $content = '#everything';
        $($content).addClass('loading');
        $('#spaces').data('url', $target);
        $.post($target+'', function(data){
            var $new_content = $('<div>').append(data).find($content).html();
            $($content).html($new_content); // Append the new content
        },'html').done(function(){
            $($content).removeClass('loading');
            _toyGrid();
        });
    });
}

function _spaces(){
    if($('#spaces').length){

        $('#sort ul li').on('click',function(){
            $('#spaces input').each(function(){
                $(this).prop("checked", true);
            });
        });

        $('#spaces input').on('change',function(){
            var $target = $('#spaces').data('url');
            var $checks = '';
            $('#spaces input').each(function(){
                if($(this).is(':checked')){
                    $checks += $(this).val() + ',';
                }
            });
            $checks = $checks.slice(0,-1);
            if($target.indexOf("?") > -1){
                var $link = $target += '&space=' + $checks;
            }else{
                var $link = $target += '?space=' + $checks;
            }
            var $content = '#everything';
            $($content).addClass('loading');
            $.post($link+'', function(data){
                var $new_content = $('<div>').append(data).find($content).html();
                $($content).html($new_content); // Append the new content
            },'html').done(function(){
                $($content).removeClass('loading');
                _toyGrid();
            });
        });
    }
}

function _toyGrid(){
    var m = 0;
    $('#toy-grid ul li').height('auto').each(function(){
        var h = $(this).height();
        if(h > m){ m = h };
    }).height(m).each(function(){
        var p = m - $('a',this).height();
        console.log(p);
        $('a',this).css('padding-top',p+'px');
    });
}

function _moreToys(){
    if($('#more-toys').length){
        mh = 0;
        $('#more-toys .toy').each(function(){
            h = $('img',this).height();
            if(h > mh){
                mh = h;
            }
        });
        $('#more-toys .toy').each(function(){
            m = Math.floor((mh - $('img',this).height()) / 2);
            $('img',this).css('padding',m+'px 0px');
        });
    }
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
    _subNav();
    _ageCheck();
    _brandSort();
    _toyPage();
    _toySort();
    _spaces();
    _moreToys();
    _resultsHeight();
    _toyGrid();

    $(window).on('load resize',function(){
        _moreToys();
        _resultsHeight();
        _toyGrid();
    })

    $('a.btn[href=#toy-grid]').on('click',function(e){
        e.preventDefault;
        $('html, body').animate({
            scrollTop: $("#toy-grid").offset().top - 200
        }, 1000);
        return false;
    });

    $('#toys .more-toys').on('click',function(){
        if($('span',this).text() == 'More Toys'){
            $('span',this).text('Hide Toys');
        }else{
            $('span',this).text('More Toys');
        }
        $('#more-toys-show').toggleClass('show');
    });

    $('a.nolink').addClass('btn').on('click',function(e){
        e.preventDefault();
        return false;
    });

});
