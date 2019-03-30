 import Vue from 'vue'
 import VueRouter from 'vue-router'
  Vue.use(VueRouter)

import AppHome from '../components/AppHome';
import Staffs from '../components/Staffs';
import CreateStaff from '../components/Staff/CreateStaff';
import EditStaff from '../components/Staff/EditStaff';
import ServiceList from '../components/ServiceList';
import CreateService from '../components/Service/CreateService';
import EditService from '../components/Service/EditService';

const routes = [
 	{ path: '/', component: AppHome },
  	{ path: '/staffs', component: Staffs },
  	{ path: '/staffs/create', component: CreateStaff },
  	{ path: '/staffs/edit/:id', component: EditStaff },
  	{ 
      path: '/services', component: ServiceList,
    },
    { path : '/services/create', component : CreateService },
    { path : '/services/edit/:id', component : EditService },
]

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
  routes,
  hashbang:false,
  cache:false,
  mode:'history',
   // short for `routes: routes`
})
export default router