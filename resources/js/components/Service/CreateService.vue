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
							<v-select :options="customers" label="name" value="id" placeholder="Choose Existing Customer" v-model="form.customer_id" @change="makeDisable()"></v-select>
							
						</div>
					</div>
					<div class="form-group row">
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Name" v-model="form.customer_name" :disabled="disable">
							<div class="error" v-for="(error,index) in form_errors['customer_name']" :key="index">{{ error }}</div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Phone" v-model="form.customer_phone" :disabled="disable">
							<div class="error" v-for="(error,index) in form_errors['customer_phone']" :key="index">{{ error }}</div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Address" v-model="form.customer_address" :disabled="disable">
							<div class="error" v-for="(error,index) in form_errors['customer_address']" :key="index">{{ error }}</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select label="name" :options="receptionists"  placeholder="Choose Received Staff" v-model="form.receive_staff"></v-select>
							<div class="error" v-for="(error,index) in form_errors['receive_staff']" :key="index">{{ error }}</div>
						</div>
					</div>

					<div class="form-group">
						<label for="description">Service Description</label>
						<textarea name="description" id="description" cols="30" rows="5" class="form-control" v-model="form.description"></textarea>
						<div class="error" v-for="(error,index) in form_errors['description']" :key="index">{{ error }}</div>
					</div>

					<div class="form-group">
						<label for="remark">Product Remarks</label>
						<textarea name="remark" id="remark" cols="30" rows="5" class="form-control" v-model="form.remark"></textarea>
						<div class="error" v-for="(error,index) in form_errors['remark']" :key="index">{{ error }}</div>
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
				authorized : false, 
				disable : false,
				receptionists : [],
				customers : [],
				form : {
					customer_id : '',
					customer_name : '',
					customer_phone : '',
					customer_address : '',
					receive_staff : '',
					description : '',
					remark : '',
				},
				form_errors : [],
			}
		},
		methods : {
			loadReceptionists(){
				axios.get('/api/receptionists')
					.then(response => {
						this.receptionists = response.data
					})
					.catch(error => {
						console.log(error.response)
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
			addNewService(){
				if(this.form.receive_staff)
				this.form.receive_staff = this.form.receive_staff.no
				if(this.form.customer_id){
					this.form.customer_id = this.form.customer_id.id
				}

				console.log(this.form);
				if(this.form_errors.length > 0){
					return
				}
				axios.post('/api/services', this.form)
					.then(response => {
						console.log(response.status);
						if(response.status == 200){
							this.$router.push('/services');
						}
					})
					.catch(error => {
						if(error.response.status == 422){
							this.form_errors = error.response.data.errors
							this.form.receive_staff = this.receptionists.find(staff => {
								return staff.no === this.form.receive_staff
							})
							console.log(this.form_errors);
							console.log(this.errors);
						}
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
			if(User.isLoggedIn()){
            axios.post('/api/auth/me')
              .then(response => {
            Gate.setUser(response.data.role_id);
             if(!Gate.isSaleperson()){
				this.authorized = false;
			}else{
				this.authorized = true;
			}
           })
          }
			this.loadReceptionists();
			this.loadCustomers();
		}
	}
</script>
<style scopde>
	@media(max-width : 768px){
		.col-md-4{
			margin-bottom: 15px;
		}
	}
	.error{
		color : red;
	}
</style>
