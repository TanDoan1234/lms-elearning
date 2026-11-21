import './bootstrap';

// Livewire 3 ships its own Alpine build. Bundle both from the Livewire ESM entry
// so only one Alpine instance runs (a separate `alpinejs` import caused double
// initialization and broke `$wire` inside Alpine components).
import { Livewire } from '../../vendor/livewire/livewire/dist/livewire.esm';

// Pages that render @livewireScriptConfig start Livewire here; other pages (guest
// layout) are auto-started by the ESM build on DOMContentLoaded.
if (window.livewireScriptConfig !== undefined) {
    Livewire.start();
}

window.addEventListener('pageshow', () => document.documentElement.classList.remove('is-loading'));
