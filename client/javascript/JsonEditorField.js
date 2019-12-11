var ss = ss || {};

(function($) {
    $.entwine('ss', function($) {
        $('input.jsonfield').entwine({
            // Constructor: onmatch
            onmatch: function() {
		initJsonField();
            }
        });
    });
}(jQuery));

//function initJsonField() {
//	console.log("foo!");
//}
