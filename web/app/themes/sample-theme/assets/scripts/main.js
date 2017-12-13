// Import external dependencies via WP enqueue scripts

// Disabled as jQuery is bundled with main.js
// import 'jquery';

// UI framework using Semantic UI
import 'semantic-ui-css/components/checkbox';
import 'semantic-ui-css/components/dimmer';
import 'semantic-ui-css/components/dropdown';
import 'semantic-ui-css/components/form';
import 'semantic-ui-css/components/modal';
import 'semantic-ui-css/components/sidebar';
import 'semantic-ui-css/components/transition';
import 'semantic-ui-css/components/visibility';

// VideoJS player and Youtube plugin
import 'video.js/dist/video';
import 'videojs-youtube/dist/Youtube';

// Flexbox hack
import flexibility from 'flexibility/flexibility';

// Import local dependencies
import Router from './util/router';
import forms from './util/forms';
import common from './common';
import {default as slideshow} from './util/slideShow';
import * as events from './util/events';

// Routes
import home from './routes/Home';
import hPricing from './routes/Pricing';
import hCampaign from './routes/Campaign';

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
const routes = {
  // All pages
  common,
  // Slideshow
  slideshow,
  // Form validation + logic (note modal logic in common)
  forms,
  // Event tracking
  events,

  // Fire on individual pages
  home,
  hPricing,
  hCampaign,
};

// Load JS logic and events
document.addEventListener('DOMContentLoaded', () => new Router(routes).loadEvents());

// Flexbox hack for our less enabled browser buddies
flexibility(document.documentElement);
