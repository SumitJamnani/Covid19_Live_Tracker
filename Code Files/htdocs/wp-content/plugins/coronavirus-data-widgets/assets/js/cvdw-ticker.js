jQuery(document).ready(function($){
  
   $('.cvdw-ticker').each(function(index){
        var style = $(this).data('ticker-style');
        var ticker_position_cls = $('.cvdw-ticker').data('ticker-position-cls');
        
        //class for header and footer position
        $('body').addClass(ticker_position_cls); 

        if(style =='style-1'){
            $(".cvdw-tooltip").not(".tooltipstered").tooltipster({
                animation: "fade",
                contentCloning: true,
                contentAsHTML: true,
                interactive: true,
                delayTouch:[200,200]
            }); 
        }
    
    });

});