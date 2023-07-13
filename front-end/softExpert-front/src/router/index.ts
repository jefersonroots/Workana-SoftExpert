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
      {
        path: '/products/buy',
        name: 'Buy',
        component: () => import('@/views/ProductSelling.vue'),
      },
      {
        path: '/buy/list',
        name: 'BuyList',
        component: () => import('@/views/BuyList.vue'),
      },
    ],
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
})

export default router
