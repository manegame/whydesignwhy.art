// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import VueYoutube from 'vue-youtube'
import VueVimeoPlayer from 'vue-vimeo-player'
import VueDisqus from 'vue-disqus'
import VueScrollTo from 'vue-scrollto'

Vue.use(VueYoutube)
Vue.use(VueVimeoPlayer)
Vue.use(VueDisqus)
Vue.use(VueScrollTo)

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
