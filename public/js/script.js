// Side-bar de navigation en version mobile
$(document).ready(function(){
    $('.sidenav').sidenav({
        edge: 'left',
        inDuration : 200,
        menuWidth: 200,
    });
    });

    $(document).ready(function(){
        $('.carousel-video').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false,
            autoplaySpeed: 5000,
            
            responsive: [
                {
                breakpoint: 1024,
                settings: {
        
                    slidesToShow: 1
                }
                },
                {
                    breakpoint: 768,
                    settings: {
                
                    slidesToShow: 1
                    }
                },
                {
                breakpoint: 480,
                settings: {
    
                    slidesToShow: 1
                }
                }
            ]
        });
        });
    setTimeout(function(){
        $(".video").play()
    }, 2000);

        
    // Carousel
    // $(document).ready(function(){
    //     $('.carousel').carousel({
    //         duration : 500,
    //         indicators : true,
    //         dist : -150,
    //         fullWidth : true,
    //     });
    //     setInterval(function(){
    //         $('.carousel').carousel('next');
    //     }, 2000);
    // })

    
          






























// // Background pushing

//     $('.target').pushpin({
//         top : 0,
//         bottom : 1000,
//         offset : 0
//     });
    
// $('.pushpin-demo-nav').each(function() {
//     var $this = $(this);
//     var $target = $('#' + $(this).attr('data-target'));
//     $this.pushpin({
//         top: $target.offset().top,
//         bottom: $target.offset().top + $target.outerHeight() - $this.height()
//     });
    
//     });
//     $(function() { // Dropdown toggle
//         $('.dropdown-toggle').click(function() {
//             $(this).next('.dropdown').slideToggle();
//         });
//         $(document).click(function(e) 
//         { 
//         var target = e.target; 
//         if (!$(target).is('.dropdown-toggle') && !$(target).parents().is('.dropdown-toggle')) 
//         { $('.dropdown').slideUp(); }
//         });
//         });
// CALENDAR

