import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/default/Default.vue'),
    children: [
      {
        path: '',
        name: 'Home',
        component: () => import('@/views/Home.vue'),
      },
      {
        path: '/products/create',
        name: 'Products',
        component: () => import('@/views/Products.vue'),
      },
      {
        path: '/products/list',
        name: 'Productslist',
        component: () => import('@/views/ProductsList.vue'),
      },
      {
        path: '/type/create',
        name: 'Type',
        component: () => import('@/views/TypeProducts.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router
