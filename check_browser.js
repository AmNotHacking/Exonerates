/**
 * This javascript file checks for the brower/browser tab action.
 * It is based on the file menstioned by Daniel Melo.
 * Reference: http://stackoverflow.com/questions/1921941/close-kill-the-session-when-the-browser-or-tab-is-closed
 */
var validNavigation = 0;
function endSession() {
    // Browser or broswer tab is closed
    // Do sth here ...
    alert("end");
}

function wireUpEvents() {
    /*
    * For a list of events that triggers onbeforeunload on IE
    * check http://msdn.microsoft.com/en-us/library/ms536907(VS.85).aspx
    */
    $(window).unload(function()
    {
        if (validNavigation==0)
        {
            endSession();
        }
    }

// Attach the event keypress to exclude the F5 refresh
    $(document).keydown(function(e)
    {
        var key=e.which || e.keyCode;
        if (key == 116)
        {
            validNavigation = 1;
        }
    });

// Attach the event click for all links in the page
    $("a").bind("click", function()
    {
        validNavigation = 1;
    });

    // Attach the event submit for all forms in the page
    $("form").bind("submit", function()
    {
        validNavigation = 1;
    });

    // Attach the event click for all inputs in the page
    $("input[type=submit]").bind("click", function()
    {
        validNavigation = 1;
    });
}

// Wire up the events as soon as the DOM tree is ready
$(document).ready(function() {
    wireUpEvents();
});