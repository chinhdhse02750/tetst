let newsMarquee = function(news) {
    let currentNews = 0;
    let totalNews = Object.keys(news).length;
    let $mq = $('.marquee');

    function showRandomMarquee() {
        if (currentNews >= totalNews) {
            currentNews = 0;
        }

        let durationCustom = 5000;
        if (totalNews > 0) {
            if ($.inArray(news[currentNews]['direction'], ['up', 'down']) !== -1) {
                durationCustom = 2000;
            }
            $mq.marquee('destroy')
                .html(news[currentNews]['content'])
                .marquee({
                    duration: durationCustom,
                    direction: news[currentNews]['direction']
                });
        }
        currentNews++;
    }

    $mq.bind('finished', showRandomMarquee);
    showRandomMarquee();
}
