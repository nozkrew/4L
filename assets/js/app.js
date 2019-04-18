
var $ = require('jquery');

require('bootstrap/dist/css/bootstrap.min.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('magnific-popup/dist/magnific-popup.css');
require('../css/creative/creative.css');
require('../css/app.css');


require('bootstrap');
require('magnific-popup');
require('jquery.easing');
import 'bootstrap/js/dist/scrollspy.js';
import ScrollReveal from 'scrollreveal';


//require('../js/creative/creative.js');

const imagesContext = require.context('../img', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

(function($) {
  "use strict"; // Start of use strict

     // Collapse Navbar
    var navbarCollapse = function() {
        if ($("#mainNav").offset().top > 100) {
          $("#mainNav").addClass("navbar-shrink");
        } else {
          $("#mainNav").removeClass("navbar-shrink");
        }
      };
    // Collapse now if page is not at top
    navbarCollapse();
    // Collapse the navbar when page is scrolled
    $(window).scroll(navbarCollapse);
    
})(jQuery); // End of use strict

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});