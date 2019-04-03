<template>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h3>Edit SERVICE</h3>
			</div>
		</div>
		<div class="row mt-4">
			<div class="col-12">
				<form @submit.prevent="updateService">
					<div class="form-group row">
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Name" v-model="form.customer_name">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Phone" v-model="form.customer_phone">
						</div>
						<div class="col-md-4">
							<input type="text" class="form-control" placeholder="Customer Address" v-model="form.customer_address">
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select label="name" :options="receptionists" :value="form.receptionist" placeholder="Choose Received Staff" v-model="form.receptionist"></v-select>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-12">
							<v-select :options="service_engineers":value="form.service_engineer" label="name" placeholder="Choose Service Engineer" v-model="form.service_engineer"></v-select>
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
				service:'',
				receptionists : [],
				service_engineers : [],
				form : {

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
			loadServiceEngineers(){
				axios.get('/api/service_engineers')
					.then(response => {
						this.service_engineers = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			loadService(){
				let id = this.$route.params.id
				
				axios.get(`/api/services/${id}`)
				  .then(res=>{
				  	this.service=res.data.data
				  	console.log(this.service)
                        this.form.customer_name=this.service.customer_name
                        this.form.customer_phone=this.service.customer_phone
                        this.form.description=this.service.description
                        this.form.remark=this.service.remark
                        this.form.service_engineer=this.service.service_engineer
                        this.form.service_engineer=this.service.service_engineer
                        this.form.customer_address=this.service.township
                        this.form.receptionist=this.service.staff
				   })
			},
			updateService(){
				if(this.form.receptionist instanceof Object){
					this.form.receptionist=this.form.receptionist.no
				}
				else{
					
					this.form.receptionist=this.service.staff_id
				}
				if(this.form.service_engineer instanceof Object){
					this.form.service_engineer=this.form.service_engineer.no
				}
				else{
					this.form.service_engineer=this.service.service_engineer_id
				}
				
				
                axios.put(`/api/services/${this.service.id}`,this.form)
                  .then(res=>{
                     console.log(res.data)

                     this.$router.push('/services')
                  })
                  .catch(err=>{
                  	console.log(err)
                  })
			},
			close(){
				this.$router.push('/services');
			}
		},
		created(){
           this.loadService()
           this.loadServiceEngineers()
           this.loadReceptionists()
			
		}
	}
</script>