function launchCommunity() {
  // Launch external URL
  $('.js-pricing--launch').click('a', () => {
    const url = $('.is-dropdown--community').dropdown('get value');
    if (url!='') {
      var open = window.open(url, '_blank');
      if (open) {
          open.focus();
      } else {
          alert('Please allow popups for this website, or open this page manually:' + url);
      }
    }
    return false;
  });
}

export {launchCommunity}
