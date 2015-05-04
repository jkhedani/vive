/**
 * Javascript Gallery
 *
 * @thanks http://stackoverflow.com/questions/6504726/how-can-i-pass-parameters-to-a-module-pattern-to-override-default-values-privat
 * @thanks http://stackoverflow.com/questions/574904/get-next-previous-element-using-javascript
 *
 * <div class="galleryjs">
 *    <ul class="gallery">
 *    </ul>
 *    <ul class="gallery-breadcrumbs">
 *    </ul>
 * </div>
 */

 // leftoff@: Making getElementById & getElementsByClassName to identify the
 //           proper element. I believe getElementsByClassName returns array

var galleryjs = (function() {

  var gallery_slide_interval;

  // Default options
  var _config = {
    gallery_id: "galleryjs",
    interval : 3000
  };

  // Initialization to be run on page load
  var init = function(options) {
    // If options exists, replace necessary options
    for ( var prop in options ) {
      if ( options.hasOwnProperty(prop) ) {
        _config[prop] = options[prop];
      }
    }
    // Options
    var gallery_id = _config.gallery_id;
    // Functions: Start Slide Animation
    var _startSlideAnimation = function( interval ) {
      gallery_slide_interval = setInterval( _slideGallery, interval);
    };

    // Functions: Define Gallery
    var _slideGallery = function() {
      // Find gallery list
      var gallery_slide_list = document.getElementById(gallery_id).getElementsByClassName('gallery')[0];
      var gallery_slide_list_children = gallery_slide_list.children;

      // Find gallery breadcrumbs
      var gallery_breadcrumbs = document.getElementById(gallery_id).getElementsByClassName('gallery-breadcrumbs')[0];

      // Find active element
      var next_active_slide, next_active_breadcrumb;
      var active_slide      = document.getElementById(gallery_id).getElementsByClassName('gallery')[0].getElementsByClassName('active')[0];
      var active_breadcrumb = document.getElementById(gallery_id).getElementsByClassName('gallery-breadcrumbs')[0].getElementsByClassName('active')[0];

      // Move Active Class For Gallery & Breadcrumbs
      // If not, go back to first
      if (gallery_slide_list.children[gallery_slide_list_children.length - 1].className === 'animated slideInLeft active') {
        // Find next element to make active
        next_active_slide = gallery_slide_list.children[0];
        next_active_breadcrumb = gallery_breadcrumbs.children[0];
        active_slide.className = active_slide.className.replace('active','');
        active_breadcrumb.className = active_breadcrumb.className.replace('active','');
        next_active_slide.className = next_active_slide.className += 'active';
        next_active_breadcrumb.className = next_active_breadcrumb.className += 'active';
      } else {
        // Find next element to make active
        next_active_slide = active_slide.nextElementSibling;
        next_active_breadcrumb = active_breadcrumb.nextElementSibling;
        active_slide.className = active_slide.className.replace('active','');
        active_breadcrumb.className = active_breadcrumb.className.replace('active','');
        next_active_slide.className = next_active_slide.className += 'active';
        next_active_breadcrumb.className = next_active_breadcrumb.className += 'active';
      }
    };

    // Set active element on click
    var _setActiveSlide = function() {

      // A. Move linear (next/prev)


      // B. Move non-linear (breadcrumbs)
      var breadcrumbs = document.getElementsByClassName('gallery-breadcrumbs')[0].children;
      for ( var i = 0; i < breadcrumbs.length; i++ ) {
        breadcrumbs[i].addEventListener('click', function() {

          // Remove current active class from all gallery children & breadcrumb
          var gallery_children = document.getElementsByClassName('gallery')[0].children;
          for ( var j = 0; j < gallery_children.length; j++ ) {
            gallery_children[j].className = '';
            breadcrumbs[j].className = '';
          }

          // Set the active class on the appropriate child based on data attr
          var slide_to_go_to = this.getAttribute('data-go-to-slide');
          gallery_children[slide_to_go_to].className = 'active';
          this.className = 'active';
        });
      }

    };

    _startSlideAnimation( _config.interval );
    _setActiveSlide();
  };

  var public_method = function() {

  };

  return {
    init : init,
    public_method : public_method
  };

}(galleryjs));


/**
 *  Run scripts on page load
 */
var vive_init = function() {
  // Initialize gallery
  var options = {
    gallery_id: "galleryjs-home",
    interval: 7000
  };
  galleryjs.init(options);



  // Hide Intro Video
  // var viveStorage = localStorage;
  // var close_intro_video_trigger = document.getElementById('close-intro-video');
  // close_intro_video_trigger.addEventListener("click", function() {
  //   var intro_video_container = document.getElementById('intro-video-container');
  //   intro_video_container.className = intro_video_container.className + ' hide';
  //   viveStorage.setItem('video_played',true);
  // });
  //
  // if ( viveStorage.getItem('video_played') === "true" ) {
  //   var intro_video_container = document.getElementById('intro-video-container');
  //   intro_video_container.className = intro_video_container.className + ' hide';
  // }

  // HasClass
  Element.prototype.hasClass = function(className) {
    return this.className && new RegExp("(^|\\s)" + className + "(\\s|$)").test(this.className);
  };

  // Load Calenars fields
  // http://sonnyt.com/javascript-check-if-element-has-class/
  var arrive = new Pikaday({
    field: document.getElementById('check-in'),
    format: 'MM/D/YYYY'
  });
  var depart = new Pikaday({
    field: document.getElementById('check-out'),
    format: 'MM/D/YYYY'
  });

  // Click: Show Book Now Menu
  var book_now_btn = document.getElementById('book-now');
  book_now_btn.addEventListener('click', function() {
    var book_now_content = document.getElementById('book-now-content');
    if ( book_now_content.hasClass('hide') ) {
      book_now_content.className = book_now_content.className.replace('hide', 'show');
      book_now_content.className = book_now_content.className.replace('slideInUp', 'slideInDown');
    } else {
      book_now_content.className = book_now_content.className.replace('show', 'hide');
      book_now_content.className = book_now_content.className.replace('slideInDown', 'slideInUp');
    }
  });


  // Click: Check Availability
  var check_availability = document.getElementById('check-availability');
  check_availability.addEventListener("click", function() {
    // Construct URL
    var reservation_url = 'https://gc.synxis.com/rez.aspx?hotel=60663&chain=16093';
    if ( document.getElementById('check-in').value !== '' ) {
      var arrive = '&arrive=' + document.getElementById('check-in').value;
      reservation_url = reservation_url + arrive;
    }
    if ( document.getElementById('check-out').value !== '' ) {
      var depart = '&depart=' + document.getElementById('check-out').value;
      reservation_url = reservation_url + depart;
    }
    if ( document.getElementById('adult-count').value !== '' ) {
      var adults = '&adult=' + document.getElementById('adult-count').value;
      reservation_url = reservation_url + adults;
    }
    if ( document.getElementById('special-select').value !== '' ) {
      var promo = '&promo=' + document.getElementById('special-select').value;
      reservation_url = reservation_url + promo;
    }
    window.open(
      reservation_url,
      '_blank' // <- This is what makes it open in a new window.
    );
  });

  // Initialize smooth scroll
  smoothScroll.init();
};

window.onload = vive_init();
