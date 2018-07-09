import Vue from 'vue'
import Router from 'vue-router'
import mainmenu from '@/components/views/mainmenu'
import mainpage from '@/components/views/mainpage'
import bookpage from '@/components/views/bookpage'
import videopage from '@/components/views/videopage'
import importancepage from '@/components/views/importancepage'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'main',
      components: {
        menu: mainmenu,
        content: mainpage
      }
    },
    {
      path: '/book',
      name: 'book',
      components: {
        menu: mainmenu,
        content: bookpage
      }
    },
    {
      path: '/video',
      name: 'video',
      components: {
        menu: mainmenu,
        content: videopage
      }
    },
    {
      path: '/importance',
      name: 'importance',
      components: {
        menu: mainmenu,
        content: importancepage
      }
    }
  ]
})
