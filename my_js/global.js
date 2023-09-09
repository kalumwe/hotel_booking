function addLoadEvent(func) {
    var oldonload = window.onload;
    if (typeof window.onload != 'function') {
    window.onload = func;
    } else {
    window.onload = function() {
    oldonload();
    func();
    }
    }
    }



    function highlightPage() {
        if (!document.getElementsByTagName) return false;
        if (!document.getElementById) return false;
        if (!document.getElementById("accordionSidebar")) return false;
        var nav = document.getElementById("accordionSidebar");
        var links = nav.getElementsByTagName("a");
        for (var i=0; i<links.length; i++) {
            var linkurl = links[i].getAttribute("href");
            var currenturl = document.location.href;
            if (currenturl.indexOf(linkurl) != -1) {
               links[i].className = "active";
               var linktext = links[i].lastChild.nodeValue.toLowerCase();
               document.body.setAttribute("id",linktext);
           }
        }
    }
        
        addLoadEvent(highlightPage);


