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
    // Private Init Functions
    var _startSlideAnimation = function( interval ) {
      gallery_slide_interval = setInterval( _slideGallery, interval);
    };
    var _slideGallery = function() {
      // Find active element
      var active_element = document.getElementById(gallery_id).getElementsByClassName('gallery')[0].getElementsByClassName('active')[0];

      // // Find next element to make active
      var next_active_element = active_element.nextElementSibling;

      //active_element.className = '';
      next_active_element.className = 'active';

      // // If not, go back to first
    };

    _startSlideAnimation( _config.interval );

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
  // var options = {
  //   gallery_id: "galleryjs-home",
  //   interval: 2000
  // };
  // galleryjs.init(options);

  // Hide Intro Video
  // var close_intro_video_trigger = document.getElementById('close-intro-video');
  // close_intro_video_trigger.addEventListener("click", function() {
  //   var intro_video_container = document.getElementById('intro-video-container');
  //   intro_video_container.className = intro_video_container.className + ' hide';
  // });

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
