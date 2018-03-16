const header = {
        fixed: false,
        controller() {
            if (window.pageYOffset >= 300) {
                if (this.fixed === false) {
                    this.fixed = true;
                    $('.fixed-top').fadeIn(() => {
                        this.fixed = false;
                    });
                }
            }
            $('.toggle-btn').click(function () {
                $('.header .menu').slideToggle();
            });
            $(window).scroll(() => {
                if (window.pageYOffset >= 300) {
                    if (this.fixed === false) {
                        this.fixed = true;
                        $('.fixed-top').fadeIn(() => {
                            this.fixed = false;
                        });
                    }
                } else if ($('.fixed-top').css('display') === 'block') {
                    if (this.fixed === false) {
                        this.fixed = true;
                        $('.fixed-top').fadeOut(() => {
                            this.fixed = false;
                        });
                    }
                }
            });
        }
    },
    carouselCatalog = {
        addSrc(next) {
            let src = next.attr('src');
            $('.carousel .big').css('background-image', `url('${src}')`);
        },
        controller() {
            $('.carousel-right').click((e) => {
                e.preventDefault();
                let next = $('.miniatures .active').next();
                if (next.length) {
                    $('.miniatures .active').removeClass('active');
                    next.addClass('active');
                    this.addSrc(next);
                } else {
                    $('.miniatures .active').removeClass('active');
                    first = $('.miniatures img:first-child');
                    first.addClass('active');
                    this.addSrc(first);
                }
            });
            $('.carousel-left').click((e) => {
                e.preventDefault();
                let prev = $('.miniatures .active').prev();
                if (prev.length) {
                    $('.miniatures .active').removeClass('active');
                    prev.addClass('active');
                    this.addSrc(prev);
                } else {
                    $('.miniatures .active').removeClass('active');
                    last = $('.miniatures img:last-child');
                    last.addClass('active');
                    this.addSrc(last);
                }
            });
            $(document).on('click', '.miniatures img:not(.active)', (e) => {
                $('.miniatures .active').removeClass('active');
                $this = $(e.currentTarget);
                $this.addClass('active');
                this.addSrc($this);
            });
        }
    },
    timer = {
        time: 60,
        int: null,
        controller() {
            this.time = parseInt($('.title .time').text());
            this.int = setInterval(() => {
                this.time--;
                if (this.time > 0) {
                    let string = 'секунд';
                    let int = parseInt(this.time / 10);
                    let float = this.time - int * 10;
                    switch (float) {
                        case 1:
                            string = 'секунду';
                            break;
                        case 2:
                            string = 'секунды';
                            break;
                        case 3:
                            string = 'секунды';
                            break;
                        case 4:
                            string = 'секунды';
                            break;
                    }
                    $('.modal .time').text(`${this.time} ${string}`)
                } else {
                    clearInterval(this.int);
                    $('#callback').modal('hide');
                }
            }, 1000);
        }
    },
    forms = {
        controller() {
            $('.wpcf7 .ref').val(location.href);
            $(".wpcf7").on('wpcf7:mailsent', function (event) {
                console.log(event)
                if ($('.main .wpcf7-response-output').hasClass('wpcf7-mail-sent-ok')) {
                    $('.main .form-wrap').fadeOut();
                } else if ($('.modal .wpcf7-response-output').hasClass('wpcf7-mail-sent-ok')) {
                    $('.modal .flex-form').fadeOut(function () {
                        $('.modal .wpcf7').html("<p class='form-good'>сейчас С вами свяжется наш специалист </p>");
                        timer.controller();
                    });
                }
            });
            if ($('body').hasClass('page-template-page-reviews')) {
                $(".wpcf7").on('wpcf7:mailsent', function (event) {
                    $('.reviews-content .form .form-flex').fadeOut();
                });
            }
        }
    };

function catalogSidebar() {
    $('a[data-toggle=dropdown-catalog]').parent().click(function (e) {
       // e.preventDefault();
        e.stopPropagation();
        $(this).toggleClass('show');
        $(this).find('ul').eq(0).slideToggle();
    });
}

$(function () {
    header.controller();
    catalogSidebar();
    carouselCatalog.controller();
    //timer.controller();
    forms.controller();
    if ($('body').hasClass('single-product')) {
        $('.menu a:contains(\'Цены\')').addClass('active');
    }
});



