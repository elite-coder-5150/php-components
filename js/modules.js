const DIR = 'kaylios';

(($) => {
    $.fn.notify = (opts) => {
        let defaults = {
            beforeTop: "105%",
            afterTop: "90%",
            value: 'hi',
            action: null
        }

        let settings = $.extend({}, defaults, opts);

        this.children().filter('open').html(settings.value);

        let div = this

        this.animate({
            top: settings.afterTop
        }, "fast", () => {
            setTimeout(() => {
                div.animate({
                    top: settings.beforeTop
                }, "fast", () => {
                    if (settings.action != null) {
                        settings.action()
                    }
                })
            }, 3000);
        })

        this.on('click', () => {
            if (settings.action != null) {
                window.location.href = settings.action
            }

            div.animate({
                top: settings.beforeTop
            })
        });

        return this
    }
})(jQuery)

//? simple little search plugin
(($) => {
    $.fn.search = (opts) => {
        let defaults = {},
            settings = $.extend({}, defaults, opts),
            elem = $(this)
            div = $('.search')
            spinner = /*html*/ `
                <div class="spinner">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            `;

        elem.on('keyup', (e) => {
            let value = $(this).val().trim();

            if (value == '') {
                div.fadeOut(100);
            } else if (value != '') {
                $.ajax({
                    url: DIR + '/ajax/requrests/search_request.php',
                    data: { search: value },
                    method: 'POST',
                    beforeSend: () => {
                        div.html(spinnter)
                    },
                    success: (data) => {
                        div.fadeIn(100);
                        div.html(data);
                    }
                })
            }
        })
    }
})(jQuery)
//? plugin for removing favorites
(($) => {
    $.fn.removeFav = (opts) => {
        this.each((e) => {
            let defaults = {},
                settings = $.extend({}, defaults, opts),
                elem = $(this)

            elem.on('click', (e) => {
                let username = $(this).data('username')

                $e.preventDefault();

                $('.prompt').SimplePrompt({
                    title: 'Remove Favorite',
                    value: 'Remove " + username + " from your favorites?',
                    dontText: 'Remove',
                    type: 'rem_fav',
                    post: $(this)
                })
            })
        })

        return this
    }
}

//? plugin for sticky.
(($) => {
    $.fn.sticky = (opts) => {
        this.each((e) => {
            let defaults = {},
                settings = $.extend({}, defaults, opts);,
                elem = $(this)

            $(document).on('scroll', () => {
                let top = $(this).scrollTop(),

                if (top >= 285) {
                    elem.find('.home').fadeOut(100);
                    elem.css({'position': 'fixed', 'top': '45px'})
                } else if (top == 0) {
                    elem.find('.home').fadeIn(100);
                    elem.css({'position': 'relative', 'top': '0'})
                }
            })
        })

        return this
    }
})(jQuery)
//? plugin for toggling the menu
(($) => {
    $.fn.toggleMenu = (opts) => {
        let div = this;

        let defaults = {
            menu: $('.options')
        }
        let settings = $.extend({}, defaults, opts);

        this.on('click', (e) => {
            e.preventDefault();

            settings.menu.toggle()
            div.toggleClass('show-more-toggle');
        })
    }
})(jQuery);

const notificationFeed = () => {
    $(window).on('scroll', (e) => {
        if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            $('.notification-feed').html('looking for more notifications...');

            $.ajax({
                url: '/ajax/requrests/notications_request.php',
                data: {notfyFeeds: $('.notify:last').data('notify-id')},
                beforeSend: () => {
                    $('.notification-feed').html('looking for more notifications...')
            
                },

                success: (data) => {
                    $('.notification-feed').html('Looks like you\'ve reached the end of the notifications')
                    $('.notification-feed').after(data);
                    $('.notification-feed').notify(':last').remove();

                    $('.follow').follow();
                    $('.unfollow').unfollow();

                    $('.post-end').on('click', (e) => {
                        $('html, body').animate({scrollTop: 0}, 450);
                    })
                }
            })
        }
    })
}

const followersFeed = (when) => {
    $(window).on('scroll', (e) => {
        if ($(window.scrollTop() + $(window).height == $(document).height())) {
            if (when == 'followers') {
                let data = {
                    follwersFeed: $('.followers-m-on:last').data('followers-id'),
                    followersUser: $('.followers-m-on:last').data('user-id')
                }
            } else if (when == 'followings') {
                let data = {
                    follwersFeed: $('.following-m-on:last').data('followers-id'),
                    followersUser: $('.following-m-on:last').data('user-id')
                }
            }

            $('.notification-feed').html('looking for more followers...');

            $.ajax({
                url: DIR + '/ajax/requrests/followers_request.php',
                data: data,
                beforeSend: () => {
                    $('.notification-feed').html('looking for more followers...')
            
                },

                success: (data) => {
                    $('.notification-feed').html('Looks like you\'ve reached the end of the followers')
                    $('.notification-feed').after(data);
                    $('.notification-feed').notify(':last').remove();

                    $('.follow').follow();
                    $('.unfollow').unfollow();

                    $('.post-end').on('click', (e) => {
                        $('html, body').animate({scrollTop: 0}, 450);
                    })
                }
            })
        }
    })
}

const notificatinModel = () => {
    let div = $('.notification'),
        span = div.find('span'),
        val = div.find('.notify-hidden').val();

    if (val) {
        span.html(val);
        div.fadeIn(100);

        setTimeout(() => {
            div.fadeOut(200);
        }, 10000)
    }
}