import { createRouter, createWebHistory } from 'vue-router'
import CustomerList from './components/CustomerList.vue'
import CustomerQuotations from './components/CustomerQuotations.vue'
import QuotationDetail from './components/QuotationDetail.vue'

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
  },
  {
    path: '/customers/:customerId/quotations/:quotationId',
    name: 'quotation-detail',
    component: QuotationDetail,
    props: true
  },
  
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router