import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import { ZiggyVue } from 'ziggy'
import '../css/app.css'

createInertiaApp({
  resolve: async name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    let page =  await pages[`./Pages/${name}.vue`]
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  progress: {
    delay: 250,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el)
  },
})
