var ss = ss || {};

(function($) {
    $.entwine('ss', function($) {
        $('input.jsoneditorfield').entwine({
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
