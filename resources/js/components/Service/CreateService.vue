<template>
	<unauthorized v-if="!authorized"></unauthorized>
	<div class="container" v-else>
		<div class="row">
			<div class="col-12">
				<h3>ADD NEW SERVICE</h3>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<form @submit.prevent="addNewService">
					<div class="form-group row">
						<div class="col-md-4">
							<v-select :options="customers" label="name" placeholder="Choose Existing Customer" v-model="form.customer_id" @change="makeDisable()"></v-select>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Name" v-model="form.customer_name" :disabled="disable">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Phone" v-model="form.customer_phone" :disabled="disable">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Address" v-model="form.customer_address" :disabled="disable">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select label="name" :options="receptionists"  placeholder="Choose Received Staff" v-model="form.receptionist"></v-select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select :options="service_engineers" label="name" placeholder="Choose Service Engineer" v-model="form.service_engineer"></v-select>
						</div>
					</div>

					<div class="form-group">
						<label for="description">Service Description</label>
						<textarea name="description" id="description" cols="30" rows="5" class="form-control" v-model="form.description"></textarea>
					</div>

					<div class="form-group">
						<label for="remark">Product Remarks</label>
						<textarea name="remark" id="remark" cols="30" rows="5" class="form-control" v-model="form.remark"></textarea>
					</div>
					<div class="form-group text-right">
						<button type="submit" class="btn btn-primary">ADD</button>
						<button class="btn btn-secondary" @click="close">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>
<script>
	import Unauthorized403 from '../errors/Unauthorized403';

	export default{
		components : {
			'Unauthorized' : Unauthorized403,
		},
		data(){
			return {
				authorized : true, 
				disable : false,
				receptionists : [],
				service_engineers : [],
				customers : [],
				form : {
					customer_id : '',
					customer_name : '',
					customer_phone : '',
					customer_address : '',
					receptionist : '',
					service_engineer : '',
					description : '',
					remark : '',
				}
			}
		},
		methods : {
			loadReceptionists(){
				axios.get('/api/receptionists')
					.then(response => {
						this.receptionists = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			loadCustomers(){
				axios.get('/api/customers')
					.then(response => {
						//console.log(response)
						this.customers = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			loadServiceEngineers(){
				axios.get('/api/service_engineers')
					.then(response => {
						this.service_engineers = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			addNewService(){
				this.form.receptionist = this.form.receptionist.no
				this.form.service_engineer = this.form.service_engineer.no

				this.form.customer_id = this.form.customer_id.id

				//console.log(this.form);
				
				axios.post('/api/services', this.form)
					.then(response => {
						console.log(response.status);
						if(response.status == 200){
							this.$router.push('/services');
						}
					})
					.catch(error => {
						console.log(error);
					})
			},
			close(){
				this.$router.push('/services');
			},
			makeDisable(){
				if(this.form.customer_id){
					this.disable = true
				}else{
					this.disable = false
				}
			}
		},
		created(){
			if(!Gate.isSaleperson()){
				this.authorized = false;
			}
			this.loadReceptionists();
			this.loadServiceEngineers();
			this.loadCustomers();
		}
	}
</script>