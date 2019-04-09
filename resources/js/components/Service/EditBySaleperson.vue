<template>
	<div class="container" v-if="!show">
		<div class="row">
			<div class="col-12">
				<h3>Edit by saleperson</h3>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<form @submit.prevent="updateService">
					<div class="form-group row">
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Name" v-model="form.customer_name">
							<div class="error" v-for="(error,index) in form_errors['customer_name']" :key="index">{{ error }}</div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Phone" v-model="form.customer_phone">
							<div class="error" v-for="(error,index) in form_errors['customer_phone']" :key="index">{{ error }}</div>
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Address" v-model="form.customer_address">
							<div class="error" v-for="(error,index) in form_errors['customer_address']" :key="index">{{ error }}</div>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select label="name" :options="receptionists" value="id" placeholder="Choose Received Staff" v-model="form.receive_staff"></v-select>
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
						<button type="submit" class="btn btn-primary">Save</button>
						<button class="btn btn-secondary" @click="close">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return {
				show:true,
				service:'',
				receptionists : [],
				form : {
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
						console.log(error)
					})
			},
			loadService(){
				let id = this.$route.params.id
				
				axios.get(`/api/services/${id}`)
				  .then(res=> {
							this.service = res.data.data
							this.form.customer_name = this.service.customer_name
							this.form.customer_phone = this.service.customer_phone
							this.form.description = this.service.description
							this.form.remark = this.service.remark
							this.form.customer_address = this.service.township
							this.form.receive_staff = this.service.staff_id
							this.form.receive_staff = this.receptionists.find(staff => {
								return staff.no == this.form.receive_staff
							})
							this.show=this.service.pending
				   })
			},
			updateService(){
				if(this.form.receive_staff){
					this.form.receive_staff = this.form.receive_staff.no
				}
				
				console.log(this.form);
				axios.put(`/api/services/${this.service.id}`,this.form)
					.then(res => {
							console.log(res)
							this.$router.push('/services')
					})
					.catch(error =>{
						this.form.receive_staff = this.receptionists.find(staff => {
							return staff.no === this.form.receive_staff
						})
						if(error.response.status == 422){
							this.form_errors = error.response.data.errors
							console.log(this.form_errors);
						}
					})
			},
			close(){
				this.$router.push('/services');
			}
		},
		created(){
			this.loadReceptionists()
			this.loadService()
		}
	}
</script>
<style scoped>
	.error{
		color : red;
	}
</style>
