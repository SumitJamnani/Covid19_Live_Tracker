! function(n) {
    "use strict";
    n(document).ready(function() {
        t.ready()
    }), n(window).load(function() {
        t.load()
    });
    var t = window.$cov_Btncov = {
        ready: function() {
            this.btncov_site(), this.btncov_c(), this.btncov_g(), this.btncov_t(), this.btncov_full()
        },
        load: function() {},
        btncov_site: function() {
            n("select[name=covid_country]").on("change", function(t) {
                var e = "",
                    c = n(this).val();
                e = "[BTCORONA-WIDGET", c && (e += ' country="' + c + '" title_widget="' + c + '"'), e += ' confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered"]', n("#covidsh").html(e)
            })
        },
        btncov_c: function() {
            n("select[name=covid_country_line]").on("change", function(t) {
                var e = "",
                    c = n(this).val();
                e = "[BTCORONA-LINE", c && (e += ' country="' + c + '"'), e += ' confirmed_title="confirmed" deaths_title="deaths" recovered_title="recovered"]', n("#covidsh-line").html(e)
            })
        },
        btncov_g: function() {
            n("select[name=covid_country_graph]").on("change", function(t) {
                var e = "",
                    c = n(this).val();
                e = "[BTCORONA-GRAPH", c && (e += ' country="' + c + '" title="' + c + '"'), e += ' confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered"]', n("#covidsh-graph").html(e)
            })
        },
        btncov_t: function() {
            n("select[name=covid_country_ticker]").on("change", function(t) {
                var e = "",
                    c = n(this).val();
                e = "[BTCORONA-TICKER", c && (e += ' country="' + c + '" ticker_title="' + c + '"'), e += ' style="vertical" confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered"]', n("#covidsh-ticker").html(e)
            })
        },
        btncov_full: function() {
            n("select[name=covid_country_full]").on("change", function(t) {
                var e = "",
                    c = n(this).val();
                e = "[BTCORONA-WIDGET", c && (e += ' country="' + c + '" title_widget="' + c + '"'), e += ' format="full" confirmed_title="Confirmed" deaths_title="Deaths" recovered_title="Recovered" active_title="Active" today_cases="24h" today_deaths="24h"]', n("#covidsh-full").html(e)
            })
        }
    }
}(jQuery);