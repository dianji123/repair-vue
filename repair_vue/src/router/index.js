import { createRouter, createWebHistory } from 'vue-router';
import Home from '../views/Home.vue';
import Login from '../views/Login.vue';
import ListOrder from '../views/ListOrder.vue';
import UpdateOrder from '../views/UpdateOrder.vue';
import RepairMan from '../views/RepairMan.vue';
import UpdateRepairMan from '../views/UpdateRepairMan.vue';
import AddRepairMan from '../views/AddRepairMan.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/Login',
    name: 'Login',
    component: Login
  },
  {
    path: '/ListOrder',
    name: 'ListOrder',
    component: ListOrder
  },
  {
    path: '/RepairMan',
    name: 'RepairMan',
    component: RepairMan
  },
  {
    path: '/UpdateOrder',
    name: 'UpdateOrder',
    component: UpdateOrder
  },
  {
    path: '/UpdateRepairMan',
    name: 'UpdateRepairMan',
    component: UpdateRepairMan
  },
  {
    path: '/AddRepairMan',
    name: 'AddRepairMan',
    component: AddRepairMan
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
