<template>
	<div v-if="show">
		<unauthorized v-if="!authorized"></unauthorized>
		<div v-else>
			<saleperson-editview v-if="isSaleperson()"></saleperson-editview>
			<engineer-editview v-if="isServiceEngineer()"></engineer-editview>
		</div>
		
	</div>
</template>

<script>
import EditBySaleperson from './EditBySaleperson';
import EditByEngineer from './EditByEngineer';
import Unauthorized403 from '../errors/Unauthorized403';

	export default{
		components : {
			'saleperson-editview' : EditBySaleperson,
			'engineer-editview' : EditByEngineer,
			'unauthorized' : Unauthorized403,
		},
		data(){
			return {
				show:false,
				authorized : false,
				User : new Object,
			}
		},
		methods : {
			isServiceEngineer(){
				return Gate.isServiceEngineer();
			},
			isSaleperson(){
				return Gate.isSaleperson();
			},
			shows(){
				this.show=true
			}
		},
		created(){
			if(User.isLoggedIn()){
            axios.post('/api/auth/me')
            	.then(response => {
            	Gate.setUser(response.data.role_id);
            	
             	if(!(Gate.isSaleperson() || Gate.isServiceEngineer())){
					 this.shows()
					this.authorized = false;
				}else{
					this.shows()
					this.authorized = true;
				}
           	})
        }
		},
		
	}
</script>