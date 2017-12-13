// Carousel / slider package
import {lory} from 'lory.js';

// Autoplay slideshow
(function () {
  Array.from(document.querySelectorAll('.js-slideshow.has-autoplay')).forEach(slideshow => {
    loryAutoplay(slideshow, 5);
  });
})();

// https://codepen.io/nstanard/pen/yaKxzK
function loryAutoplay (slider, slidesToScroll) {
  // http://stackoverflow.com/questions/19764018/controlling-fps-with-requestanimationframe
  let stop = false;
  var fpsInterval, now, then, elapsed;

  // Need to set a default position as LoryJS seems to calculate 48px offset
  // TODO: Remove event listener after it is used once / initially
  function handleEvents(e) {
    if (e.type === 'before.lory.slide') {
      slider.querySelector('.c-slideshow__slides').classList.remove('is-not-loaded');
    }
    if (e.type === 'before.lory.init') {
      slider.classList.add('is-loading');
    }
    if (e.type === 'after.lory.init') {
      slider.classList.remove('is-loading');
      slider.classList.add('has-loaded');
    }
    if (e.type === 'after.lory.destroy') {
      slider.classList.remove('is-loading', 'has-loaded');
    }
  }
  slider.addEventListener('before.lory.init', handleEvents);
  slider.addEventListener('after.lory.init', handleEvents);
  slider.addEventListener('before.lory.slide', handleEvents);
  slider.addEventListener('after.lory.destroy', handleEvents);

  // init the slider
  var lorySlider = lory(slider, {
    classNameFrame: 'c-slideshow',
    classNameSlideContainer: 'c-slideshow__slides',
    enableMouseEvents: true,
    infinite: slidesToScroll,
    rewindSpeed: 0,
    slideSpeed: 1000,
    slidesToScroll: slidesToScroll,
  });

  // begin animation (autoplay)
  function startAnimating(fps) {
    fpsInterval = 1000 / fps;
    then = Date.now();
    animate();
  }

  // animate (autoplay)
  function animate() {
    // setTimeout(function() {
    //   requestAnimationFrame(animate);
    // }, 2000);
    requestAnimationFrame(animate);

    now = Date.now();
    elapsed = now - then;

    if (elapsed > fpsInterval && !stop) {
      then = now - (elapsed % fpsInterval);
      lorySlider.next();
    }
  }

  // reset timer
  function resetTimer() {
    now = Date.now();
    elapsed = now - then;
    then = now - (elapsed % fpsInterval);
  }

  // start the animation process with seed time
  // 0.25 = once every 4 seconds
  // 0.5 = once every 2 seconds
  startAnimating(0.25);

  // mouseover
  slider.addEventListener('mouseover', function() {
    stop = true;
  });

  // mouseout
  slider.addEventListener('mouseout', function() {
    resetTimer();
    stop = false;
  });
}

// export {lory as default};
