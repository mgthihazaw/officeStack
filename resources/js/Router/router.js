 import Vue from 'vue'
 import VueRouter from 'vue-router'
  Vue.use(VueRouter)

import AppHome from '../components/AppHome';
import Dashboard from '../components/Dashboard';
import Staffs from '../components/Staffs';
import CreateStaff from '../components/Staff/CreateStaff';
import EditStaff from '../components/Staff/EditStaff';
import Service from '../components/Service/Service';
import ServiceList from '../components/ServiceList';
import CreateService from '../components/Service/CreateService';
import EditService from '../components/Service/EditService';
import StartServiceReport from '../components/Service/StartServiceReport';
import FinishServiceReport from '../components/Service/FinishServiceReport';
import Login from '../components/Login';
import NotFound404 from '../components/errors/NotFound404';


import Logout from '../components/Logout';

const routes = [
 	  { 
      path: '/', 
      component: Dashboard,
      name:'dashboard',
      meta : {
        requiresAuth : true,
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
      meta : {
        requiresAuth : true,
      }
    },
  	{ 
      path: '/staffs/create',
      component: CreateStaff,
      meta : {
        requiresAuth : true,
      }
    },
  	{ 
      path: '/staffs/edit/:id', 
      component: EditStaff,
      meta : {
        requiresAuth : true,
      }
    },
  	{ 
      path: '/services', 
      component: ServiceList,
      meta : {
        requiresAuth : true,
      }
    },
    { 
      path: '/services/:id/show', 
      component: Service,
      meta : {
        requiresAuth : true,
      }
    },
    { 
      path : '/services/create', 
      component : CreateService,
      meta : {
        requiresAuth : true,
      }
    },
    { 
      path : '/services/edit/:id', 
      component : EditService,
      meta : {
        requiresAuth : true,
      }
    },
    {
      path : '/logout', 
      component : Logout,
      meta : {
        requiresAuth : true,
      }
    },
    {
      path : '*',
      component : NotFound404,
    },
    { 
      path: '/service/print/:id',
      name : 'print',
      component: StartServiceReport,
      meta : {
        requiresAuth : true,
      }
    },
    { 
      path: '/fprint',
      name : 'fprint',
      component: FinishServiceReport,
      
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

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!User.getToken()) {
      next({
        path: '/login',
      });
    } else {
      next();
    }
  } else {
    next();
  }
})

export default router