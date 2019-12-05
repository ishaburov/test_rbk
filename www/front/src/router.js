import Vue from 'vue'
import Router from 'vue-router'
import Articles from './components/Articles/Articles'
import Article from './components/Article/Article'
import NotFound from './components/NotFound/NotFound'

Vue.use(Router);

export default new Router({
  mode: "history",
  routes: [
    {
      path: '/articles',
      name: 'articles',
      component: Articles,
    },
    {
      path: '/articles/:id',
      name: 'article',
      component: Article,
    },
    {
      path: '/404',
      name: '404',
      component: NotFound,
      meta: {auth: true}
    },
    {
      path: '*',
      redirect: '/404',
      meta: {auth: true}
    }
  ]
})
