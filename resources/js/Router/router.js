 import Vue from 'vue'
 import VueRouter from 'vue-router'
  Vue.use(VueRouter)

import AppHome from '../components/AppHome';
import Dashboard from '../components/Dashboard';
import Staffs from '../components/Staffs';
import CreateStaff from '../components/Staff/CreateStaff';
import EditStaff from '../components/Staff/EditStaff';
import ServiceList from '../components/ServiceList';
import CreateService from '../components/Service/CreateService';
import EditService from '../components/Service/EditService';
import Login from '../components/Login';
import NotFound404 from '../components/errors/NotFound404';
import Logout from '../components/Logout';

const routes = [
 	  { 
      path: '/', 
      component: Dashboard,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      }
    },
    { 
      path: '/login' ,
      component : Login,
      beforeEnter: (to, from, next) => {
        if(User.getToken()){
          next('/');
        }
        next()
      }
    },
  	{ 
      path: '/staffs',
      component: Staffs,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      }
    },
  	{ 
      path: '/staffs/create',
      component: CreateStaff,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      }
    },
  	{ 
      path: '/staffs/edit/:id', 
      component: EditStaff,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      } 
    },
  	{ 
      path: '/services', 
      component: ServiceList,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      }
    },
    { 
      path : '/services/create', 
      component : CreateService,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      } 
    },
    { 
      path : '/services/edit/:id', 
      component : EditService,
      beforeEnter: (to, from, next) => {
        if(!User.getToken()){
          next('/login');
        }
        next();
      }
    },
    {
      path : '/logout', 
      component : Logout,
    },
    {
      path : '*',
      component : NotFound404,
    }
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