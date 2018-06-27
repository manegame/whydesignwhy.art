import Vue from 'vue'
import Router from 'vue-router'
import mainmenu from '@/components/views/mainmenu'
import main from '@/components/views/main'
import bookpage from '@/components/views/bookpage'
import videopage from '@/components/views/videopage'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'main',
      components: {
        menu: mainmenu,
        content: main
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
    }
  ]
})
