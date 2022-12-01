import { createRouter, createWebHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Article from '../views/Article.vue'
import Page from '../views/Page.vue'

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/article/:aid',
    name: 'Article',
    component: Article,
    props: true,
    children: [
      {
        path: 'pages/:page_num',
        name: 'Page',
        component: Page,
        props: true,
      },
      {
        path: '',
        name: 'PageOne',
        component: Page,
        props: { page_num: 1 }
      }      
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
