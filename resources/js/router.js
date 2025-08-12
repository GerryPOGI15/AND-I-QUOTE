import { createRouter, createWebHistory } from 'vue-router'
import CustomerList from './components/CustomerList.vue'
import CustomerQuotations from './components/CustomerQuotations.vue'

const routes = [
  {
    path: '/',
    name: 'customers',
    component: CustomerList
  },
  {
    path: '/customers/:customerId/quotations',
    name: 'customer-quotations',
    component: CustomerQuotations,
    props: true
  }
  
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router