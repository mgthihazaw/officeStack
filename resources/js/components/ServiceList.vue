<template>
	<div>
		<div class="row">
		    <div class="col-12">
		        <h1 class="page-header">Service List</h1>
		        <router-link class="btn btn-info btn-sm mt-2 mb-3 text-white" to="/services/create" v-if="User.isSaleperson()">New Service</i></router-link>
		        
		        <table class="table table-bordered">
		            <thead>
		                <tr>
		                    <th>No</th>
		                    <th>Customer</th>
		                    <th>Customer Address</th>
		                    <th>Customer Phone</th>
		                    <th>Received Staff</th>
		                    <th>Service Engineer</th>
		                    <th>Description</th>
		                    <th>Remark</th>
		                    <th>Status</th>
		                    <th>Action</th>
		                </tr>
		            </thead>
		            <tbody>
		                <tr v-for="(service,index) in service_list" :key="service.id">
		                	<td>{{ index+1 }}</td>
		                	<td>{{ service.customer_name }}</td>
		                	<td>{{ service.township }}</td>
		                	<td>{{ service.customer_phone }}</td>
		                	<td>{{ service.staff }}</td>
		                	<td>{{ service.service_engineer }}</td>
		                	<td>{{ service.description }}</td>
		                	<td>{{ service.remark }}</td>
		                	<td>
		                		<span class="badge" style="{ padding-top : 5px ; padding-bottom : 5px" :class="[service.pending ? 'badge-success' : 'badge-danger']">{{ service.pending ? "Finished" : "Not Finished" }}</span>
		                	</td>
		                	<td>
		                        <button class="btn btn-info btn-sm text-white" @click="editServicebySaleperson(service.id)" v-if="User.isSaleperson() && !service.pending"><i class="fa fa-edit"></i></button>
								<button class="btn btn-secondary btn-sm" @click="printView(service.id)" v-if="User.isSaleperson() && !service.pending"><i class="fas fa-print"></i></button>
		                        <button class="btn btn-primary btn-sm text-white" @click="editServicebyServiceEngineer(service.id)" v-if="User.isServiceEngineer()"><i class="fa fa-edit"></i></button>
		                        
		                        <router-link :to="'/services/'+service.id+'/show'" class="btn btn-success btn-sm text-white" v-if="service.pending == 1"><i class="fa fa-eye"></i></router-link>
		                    </td>
		                </tr>
		            </tbody>
		        </table>
		    </div>
    	</div>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				User : '',
				service_list : [],
			}
		},
		methods : {
			getServiceList(){
				axios.get('/api/services')
					.then(response => {
						this.service_list = response.data
					})
					.catch(error => {
						console.log(error);
					})
			},
			editServicebySaleperson(id){
				this.$router.push('/services/edit/'+id)
			},
			printView(id){
				this.$router.push({name: 'print', params : { id : `${id}`}, query : { type: 'start'}})
			},
			editServicebyServiceEngineer(id){
				this.$router.push('/services/edit/'+id)
			},
			deleteService(id){
				axios.delete(`/api/services/${id}`)
					.then(response => {
						Bus.$emit('afterServiceDeleted')
					})
					.catch(error => {
						console.log(error)
					})
			}
		},
		created(){
			this.User = Gate;
			this.getServiceList();
			Bus.$on('afterServiceDeleted', () => {
				this.getServiceList();
			})
		}
	}
</script>

<style scoped>
	td{
		font-family: 'Zawgyi-One';
	}
</style>