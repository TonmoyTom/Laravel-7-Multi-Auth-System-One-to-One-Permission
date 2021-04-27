$(document).ready(function() {
  $('.sideMenuToggler').on('click', function() {
    $('.wrapper').toggleClass('active');
  });

  var adjustSidebar = function() {
    $('.sidebar').slimScroll({
      height: document.documentElement.clientHeight - $('.navbar').outerHeight()
    });
  };

  adjustSidebar();
  $(window).resize(function() {
    adjustSidebar();
  });

  $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
});
