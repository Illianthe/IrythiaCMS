// On document ready...
$(function() {
    // Add padding and border to certain form elements, compensating for the change in width
    $("input:text, input:password").each(function() {
        $(this).css({"padding" : "2px", "border" : "1px solid #cccccc"});
    });
    $("textarea").each(function() {
        $(this).width(($(this).width() - 6));
        $(this).css({"padding" : "2px", "border" : "1px solid #cccccc"});
    });
    
    // Add a confirmation box for article deletion
    $(".deletebutton a").click(function() {
        var value = confirm("Are you sure you want to delete this item?");
        if (!value) {
            return false;
        }
    });
    
    // On window resize...
    $(window).resize(function() {
        $("textarea").each(function() {
            $(this).css("width", "100%");
            $(this).width(($(this).width() - 6));
            $(this).css({"padding" : "2px", "border" : "1px solid #cccccc"});
        });
    });
});