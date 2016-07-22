/*
 * scripts
 */
Drupal.behaviors.headingColors = {};
Drupal.behaviors.headingColors.attach = function(context) {
  (function($){
    var i = 0;
    var colors = new Array("#6e0028","#c00014","#ec9d00","#00326d", "#4b82d1", "#545836");
    var colorsLength = colors.length;
    
    $('h1, h2', context).each(function(){
      if(i == colorsLength) {
        i= 0;
      }
      // als de kleur van deze titel donkergrijs is, kleur deze dan
      if($(this).css('color') == 'rgb(45, 40, 40)') {
        $(this).css({'color': colors[i]});
        $(this).find('a:eq(0)').css({'color': colors[i]});
        i++;        
      }      
    });
  })(jQuery);
};

/*
 * Fade out messages 
 */
Drupal.behaviors.scrollTop = {};
Drupal.behaviors.scrollTop.attach = function(context) {
  (function($){
    $('#back-to-top a', context).click(function(){
        $("html, body", context).animate({ scrollTop: 0 }, 600);
        return false;
    });
  })(jQuery);
};

/*
 * Fade out messages 
 */
Drupal.behaviors.singleOrderedList = {};
Drupal.behaviors.singleOrderedList.attach = function(context) {
  (function($){
    $('ol', context).each(function(){
      var li = $(this).find('> li');
      if(li.length == 1) {
        $(this).addClass('single-ordered-list');
      }
    });
  })(jQuery);
};