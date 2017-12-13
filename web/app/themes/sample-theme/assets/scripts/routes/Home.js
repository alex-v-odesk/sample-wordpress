export default {
  init() {
    // JavaScript to be fired on the home page
    $('.js-main')
      .visibility({
        continuous: true,
        onPassed: {
          80: () => {
            $('.js-menu').addClass('has-white-bg has-colour-logo');
          },
        },
        onUpdate: () => {
          if ($(window).scrollTop() <= 80) {
            $('.js-menu').removeClass('has-white-bg has-colour-logo');
          }
        },
      })
    ;
  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
