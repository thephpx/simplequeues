import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/print/:station_id',
      name: 'home',
      component: () => import('./views/PrintToken.vue')
    },
    {
      path: '/board/:station_id',
      name: 'board',
      component: () => import('./views/BoardToken.vue')
    },
    {
      path: '/agent/:station_id/:agent_id',
      name: 'agent',
      component: () => import('./views/AgentToken.vue')
    }
  ]
})
