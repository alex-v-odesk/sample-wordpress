import {validation} from './validation';
import {processForm} from './processForm';
import {processEvent} from './events';
import {sendEvents, sendDemo} from './dataLayer';
import {sendToMarketo} from './munchkin';
import {getGeoData as user} from './ipAddressGeoLocate';

function modalLogic() {

  // TODO: Hacky you amateur
  const modal = document.querySelector('.js-modal-tryit');
  const modals = document.querySelectorAll('.js-modal-tryit');

  Array.from(modals, modal => {
    let form = modal.querySelector('.c-form');
    $(form)
      .form({
        on: 'submit',
        selector: {
          field: 'input, textarea, select',
          group: '.field',
          input: 'input',
        },
        fields: validation,
        onSuccess: () => {
          processForm(form, true, user.country_name);
          sendToMarketo(form);
          sendEvents(form, 'Modal');
          processEvent('eval');
          return false;
        },
      })
    })
  ;

  $(modal)
    .modal({
      inverted: true,
      selector: {
        approve: '.js-approve',
        close: '.js-modal-close',
      },
      onApprove: () => {
        return false;
      },
      onHidden: () => {
        modal.querySelector('.c-form--modal').classList.remove('h-hidden');
        modal.querySelector('.c-modal__header').classList.remove('h-hidden');
        const form = modal.querySelector('.c-form-container');
        form.querySelector('.c-form-validation').classList.add('h-hidden');
        form.querySelector('.c-form-validation__processing').classList.add('h-hidden');
        form.querySelector('.c-form-validation__processing').classList.add('h-hidden');
      },
    })
  ;

  $('.js-modal-trigger--tryit').click('a', () => {
    sendDemo();
    $(modal).modal('show');
    return false;
  });

  $('.js-modal-video').click('a', (event) => {
    const modalWindow = event.currentTarget.parentElement;
    const modalVideo = $(modalWindow).find('.c-modal-video');
    modalVideo.modal({
      detachable: false,
      inverted: false,
      allowMultiple: false,
      selector: {
        close: '.js-modal-close',
      },
      onHide: () => {
        // Tell YouTube API to pause the video on close modal
        const iframe = modalWindow.querySelector('iframe').contentWindow;
        iframe.postMessage('{"event":"command", "func":"pauseVideo", "args":""}', '*');
      },
    })
    .modal('show');
    event.preventDefault();
  });

}

export {modalLogic}
