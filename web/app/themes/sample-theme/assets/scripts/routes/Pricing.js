import {validation} from '../util/validation';
import {launchCommunity as initLaunchCommunity} from '../util/pricingLaunchCommunity';
import {processForm} from '../util/processForm';
import {processEvent} from '../util/events';
import {sendEvents} from '../util/dataLayer';
import {sendToMarketo} from '../util/munchkin';
import {getGeoData as user} from '../util/ipAddressGeoLocate';


export default {
  init() {
    // Enable dropdown on Community edition
    initLaunchCommunity();

    // Temp
    function processModalForm(modal) {
      $(modal).form({
        on: 'submit',
        selector: {
          field: 'input, textarea, select',
          group: '.field',
          input: 'input',
        },
        fields: validation,
        onSuccess: () => {
          const dataArray = $(modal).serializeArray().reduce(
            function(a, x) {
              a[x.name] = x.value;
              return a;
            }, {});
          dataArray.country = user.country_name;
          processForm(dataArray, modal, true);
          sendToMarketo(dataArray);
          sendEvents(modal, 'Modal');
          processEvent('eval');
          return false;
        },
      });
    }



    // Note that issue is that form HTML is not in the same parent element
    // as the modal trigger
    // const modalContainer = $('.o-modal');

    // const modal = document.querySelector('.js-modal-tryit');
    // const modals = document.querySelectorAll('.js-modal-tryit');
    const modalTriggers = document.querySelectorAll('.js-modal-trigger');

    Array.from(modalTriggers, trigger => {
      // Find each modal that relates to trigger
      let modalName = trigger.dataset.modal;
      let modalContainer = document.querySelector(modalName);

      modalContainer
        .modal({
          inverted: true,
          allowMultiple: false,
          selector: {
            approve: '.js-approve',
            close: '.js-modal-close',
          },
          onApprove: () => {
            return false;
          },
          onHidden: () => {
            $('.c-form--modal').removeClass('h-hidden').clearForm();
            $('.c-modal__header').removeClass('h-hidden');
            $('.c-modal .c-form-validation').addClass('h-hidden');
            $('.c-modal .c-form-validation__processing').addClass('h-hidden');
            $('.c-modal .c-form-validation__success').addClass('h-hidden');
          },
        })
      ;
      // Bind on page load or when clicked?
      let form = modalContainer.querySelector('.c-form');
      processModalForm($(form));
    });
  },
  finalize() {
    // JavaScript to be fired on the pricing page, after the init JS
  },
  // init() {
  //   // JavaScript to be fired on the pricing page
  //   initLaunchCommunity();
  //
  //   // Temp
  //   // Note that issue is that form HTML is not in the same parent element
  //   // as the modal trigger
  //   const modalContainer = $('.o-modal');
  //
  //   const modal = document.querySelector('.js-modal-tryit');
  //   const modals = document.querySelectorAll('.js-modal-tryit');
  //
  //   // const modalContainerTryItProfessional = $('.js-modal-tryit js-modal-tryit--professional');
  //   // const modalContainerBuyItProfessional = $('.c-modal-buyit--professional');
  //   // const modalContainerTryItEnterprise = $('.js-modal-tryit js-modal-tryit--enterprise');
  //   // const modalContainerBuyItEnterprise = $('.c-modal-buyit--enterprise');
  //   // const modalContainerApply = $('.c-modal-apply--startup');
  //   // const modalContainerTryItVendorSmall = $('.js-modal-tryit js-modal-tryit--vendor-small');
  //   // const modalContainerBuyItVendorSmall = $('.c-modal-buyit--vendor-small');
  //   // const modalContainerTryItVendorBig = $('.js-modal-tryit js-modal-tryit--vendor-big');
  //   // const modalContainerBuyItVendorBig = $('.c-modal-buyit--vendor-big');
  //
  //   // $('.js-modal-trigger-tryit--professional').click('a', () => {
  //   //   modalContainerTryItProfessional.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-buyit--professional').click('a', () => {
  //   //   modalContainerBuyItProfessional.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-tryit--enterprise').click('a', () => {
  //   //   modalContainerTryItEnterprise.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-buyit--enterprise').click('a', () => {
  //   //   modalContainerBuyItEnterprise.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-apply--startup').click('a', () => {
  //   //   modalContainerApply.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-tryit--vendor-small').click('a', () => {
  //   //   modalContainerTryItVendorSmall.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-buyit--vendor-small').click('a', () => {
  //   //   modalContainerBuyItVendorSmall.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-tryit--vendor-big').click('a', () => {
  //   //   modalContainerTryItVendorBig.modal('show');
  //   //   return false;
  //   // });
  //   // $('.js-modal-trigger-buyit--vendor-big').click('a', () => {
  //   //   modalContainerBuyItVendorBig.modal('show');
  //   //   return false;
  //   // });
  //
  //   Array.from(modals, modal => {
  //   });
  //     // Array.from(modals, modal => {
  //     //   let form = modal.querySelector('.c-form');
  //     //   $(form)
  //
  //   function processModal(modal) {
  //     $(modal).form({
  //       on: 'submit',
  //       selector: {
  //         field: 'input, textarea, select',
  //         group: '.field',
  //         input: 'input',
  //       },
  //       fields: validation,
  //       onSuccess: () => {
  //         const dataString = $(modal).serialize();
  //         const dataArray = $(modal).serializeArray().reduce(
  //           function(a, x) {
  //             a[x.name] = x.value;
  //             return a;
  //           }, {});
  //         dataArray.country = user.country_name;
  //         processForm(dataString, modal, true);
  //         sendToMarketo(dataArray);
  //         sendEvents(modal, 'Modal');
  //         processEvent('eval');
  //         return false;
  //       },
  //     });
  //   }
  //
  //   processModal(modalContainerTryItProfessional.querySelector('.js-form'));
  //   processModal(modalContainerBuyItProfessional.querySelector('.js-form'));
  //   processModal(modalContainerTryItEnterprise.querySelector('.js-form'));
  //   processModal(modalContainerBuyItEnterprise.querySelector('.js-form'));
  //   processModal(modalContainerApply.querySelector('.js-form'));
  //   processModal(modalContainerTryItVendorSmall.querySelector('.js-form'));
  //   processModal(modalContainerBuyItVendorSmall.querySelector('.js-form'));
  //   processModal(modalContainerTryItVendorBig.querySelector('.js-form'));
  //   processModal(modalContainerBuyItVendorBig.querySelector('.js-form'));
  //
  //   modalContainer
  //     .modal({
  //       inverted: true,
  //       allowMultiple: false,
  //       selector: {
  //         approve: '.js-approve',
  //         close: '.js-modal-close',
  //       },
  //       onApprove: () => {
  //         return false;
  //       },
  //       onHidden: () => {
  //         $('.c-form--modal').removeClass('h-hidden').clearForm();
  //         $('.c-modal__header').removeClass('h-hidden');
  //         $('.c-modal .c-form-validation').addClass('h-hidden');
  //         $('.c-modal .c-form-validation__processing').addClass('h-hidden');
  //         $('.c-modal .c-form-validation__success').addClass('h-hidden');
  //       },
  //     })
  //   ;
  // }
};
