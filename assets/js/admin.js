
var $ = require('jquery');

require('bootstrap/dist/css/bootstrap.min.css');
require('@fortawesome/fontawesome-free/css/all.min.css');
require('../css/admin/simple-sidebar.css');
require('../css/admin/login.css');
require('../css/admin/admin.css');
require('../js/bootstrap-select');
//require('jquery-ui');

require('bootstrap');

(function($) {
  "use strict"; // Start of use strict
    
})(jQuery); // End of use strict

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
});