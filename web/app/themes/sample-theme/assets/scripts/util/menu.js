function menuLogic() {

  // Class to add to HTML to disable all functionality of element
  $('.js-null')
    .click('a', (event) => {
      event.preventDefault();
    })
  ;

  // Launch (Jan 2017) hack to disable main menu items
  $('li.js-disable .c-nav-menu__link')
    .click((event) => {
      event.preventDefault();
    })
  ;
  // Launch hack to disable mega menu dropdown items
  $('li.js-disable.c-mega-menu__item > a')
    .click((event) => {
      event.preventDefault();
    })
  ;

  // Header BG colour change triggered on scroll on homepage
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

  // Mobile menu toggle visibility to push onto page
  $('.js-nav-toggle')
    .click('a', (event) => {
      $('.ui.sidebar').sidebar('setting', 'transition', 'push').sidebar('toggle');
      event.preventDefault();
    })
  ;
}

export {menuLogic}
