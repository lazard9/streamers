// Filter streamers and page jump #filteres to href
$("#paginate-streamers a").each(function() {
    var $this = $(this);       
    var _href = $this.attr("href"); 
    $this.attr("href", _href + '#filters');
 });