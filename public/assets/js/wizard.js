$(document).ready(function () {   

    $(".next-btn").click(function (e) {       
        var $active = $('.nav-link .active');  
        alert($active);      
        $active.removeClass('disabled');        
        // nextTab($active);    
    });    
    
    $(".prev-btn").click(function (e) {        
        var $active = $('.nav-link active');        
        prevTab($active);    
    });
});
    
    function nextTab(elem) {    
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    
    function prevTab(elem) {    
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }