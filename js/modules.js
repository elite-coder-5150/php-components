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
    }
})