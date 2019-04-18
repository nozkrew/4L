require('../js/post.js');

var Masonry = require('masonry-layout');
var imagesLoaded = require('imagesloaded');

var msnry = new Masonry( '.grid', {
  itemSelector: '.grid-item',
  columnWidth: '.grid-sizer',
  percentPosition: true,
  gutter: 10
});

imagesLoaded( msnry ).on( 'progress', function() {
  // layout Masonry after each image loads
  msnry.layout();
});


// Magnific popup calls
$('.popup-gallery').magnificPopup({
  delegate: 'a',
  type: 'image',
  tLoading: "Chargement de l'image #%curr%...",
  mainClass: 'mfp-img-mobile',
  gallery: {
    enabled: true,
    navigateByImgClick: true,
    preload: [0, 1]
  },
  image: {
    tError: "<a href='%url%'>L'image #%curr%</a> n'a pas pu être chargée."
  }
});