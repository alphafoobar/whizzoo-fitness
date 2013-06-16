/**
 * panoramio.js
 *
 * copyright James Little 2009
 *
 * Author: James Little
 * Version: $Id: panoramio.js 26 2009-03-10 10:00:16Z alphafoobar $
 */
 
function loadLocationImages(element, point)
{
	$.getJSON("http://api.flickr.com/services/feeds/photos_public.gne?tags=cat&tagmode=any&format=json&jsoncallback=?",
        function(data){
          $.each(data.photos, function(i,item){
            $("<img/>").attr("src", item.media.m).appendTo("#images");
            if ( i == 3 ) return false;
          });
        });
}
