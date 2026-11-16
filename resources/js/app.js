import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.addEventListener('pageshow', () => document.documentElement.classList.remove('is-loading'));
