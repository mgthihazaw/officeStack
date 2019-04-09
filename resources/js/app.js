
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VeeValidate from 'vee-validate';

Vue.use(VeeValidate);

import moment from 'moment';
Vue.filter('myDate',function(created){
	return moment().format("MMM Do YY");
})


window.Bus = new Vue();


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from './Router/router.js';
import vSelect from 'vue-select'
import User from './Helpers/User.js';
import Gate from './Helpers/Gate.js';

axios.interceptors.response.use(function (response) {
    // Do something with response data
    return response;
}, function (error) {
	if(error.response.data.type == 'token_invalid'){
		alert(error.response.data.error)
		Bus.$emit('logout')
	}else if(error.response.data.type == 'token_expired'){
		alert(error.response.data.error)
		Bus.$emit('logout')
	}
});


window.User = User
window.Gate = Gate

if(User.isLoggedIn()){
	axios.post('/api/auth/me')
		.then(response => {
			Gate.setUser(response.data.role_id);
		})
}

Vue.component('v-select', vSelect)

Vue.component('app-home', require('./components/AppHome.vue'));

const app = new Vue({
    el: '#app',
    router,
});
