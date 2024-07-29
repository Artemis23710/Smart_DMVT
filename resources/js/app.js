import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';


const appName = import.meta.env.VITE_APP_NAME || 'Smart DMVT';


// Import Bootstrap
import 'bootstrap/dist/js/bootstrap.bundle.min.js';



const loadbootrapIcons = () => {
  const script = document.createElement('script');
  script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js';
  script.crossOrigin = 'anonymous';
  document.head.appendChild(script);
};


// Import Material-UI (using a CDN)
const loadMaterialUI = () => {
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/material-ui/4.12.4/index.js';
    script.integrity = 'sha512-wEnX3bNd/CdyrOFR0KIGlHihK/w9x3/It8Vc18aymEF/F/f1q0Mq8T+GSxF1wYUACLEGECapuIYQdQlKY1LBJw==';
    script.crossOrigin = 'anonymous';
    script.referrerPolicy = 'no-referrer';
    document.head.appendChild(script);
  };
  
  // Import Font Awesome (using a CDN)
  const loadFontAwesome = () => {
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js';
    script.crossOrigin = 'anonymous';
    document.head.appendChild(script);
  };
  
  // Import Feather Icons (using a CDN)
  const loadFeatherIcons = () => {
    const script = document.createElement('script');
    script.src = 'https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js';
    script.crossOrigin = 'anonymous';
    document.head.appendChild(script);
  };



createInertiaApp({
    title: (title) => `${title}  ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
loadbootrapIcons();
loadMaterialUI();
loadFontAwesome();
loadFeatherIcons();
