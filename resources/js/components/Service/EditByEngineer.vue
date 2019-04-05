<template>
     <div>
         <div class="card col-md-12">
                 	<div class="m-3">
                      <h3 class="text-capitalize text-success">
                      	
                      		<i class="fas fa-arrow-circle-left" @click="back" style="cursor: pointer"></i>                      	
                       Edit By Engineer
                   </h3>
                    </div>
                    <hr>
					  <div class="card-body">
                   
						 <div class="row">
						 	<div class="col-5">
						 		  <div class="pb-3"><h6 class="card-title">Customer Name</h6>
						           <p class="card-text  text-secondary">{{ service.customer_name}}</p></div>

								   <div class="pb-3"><h5 class="card-title">Customer Phone</h5>
								   <p class="card-text  text-secondary">{{ service.customer_phone}}</p></div>

								   <div class="pb-3"><h5 class="card-title">Customer Address</h5>
								   <p class="card-text  text-secondary">{{ service.township}}</p></div>

								   <div class="pb-3"><h5 class="card-title">Received Staff</h5>
								   <p class="card-text  text-secondary">{{ service.staff}}</p></div>

								  

	                               <div class="pb-5">
						 		 	<h5 class="card-title">Description</h5>
						           <p class="card-text  text-secondary">{{ service.description}}</p>
						            </div>

								    <div class="pb-5">
								    	<h5 class="card-title">Remarks</h5>
								        <p class="card-text  text-secondary">{{ service.remark}}</p>
								    </div>
		                    </div>

						 	<div class="col-7 ">
						 		 
	                        
							    <form @submit.prevent="updateService">
									<div class="form-group row">
										<label for="service_descriptioin" class=" form-control-label card-title">Service Description</label>
										<textarea class="form-control " v-model="form.service_description" style="height:160px;"></textarea>
										<div class="error" v-for="(error,index) in form_errors['service_description']" :key="index">{{ error }}</div>
									</div>

									<div class="form-group row">
										<label for="service_descriptioin" class=" form-control-label card-title">Service Remark</label>
										<textarea class="form-control " v-model="form.service_remark"  style="height:160px;"></textarea>
										<div class="error" v-for="(error,index) in form_errors['service_remark']" :key="index">{{ error }}</div>
									</div>

									<div class="form-group row">
										<label for="service_engineer" class=" form-control-label card-title">Choose Service Engineer</label>
										<v-select class="col-12" :options="service_engineers" value="id" label="name" placeholder="Choose Service Engineer" v-model="form.service_engineer"></v-select>
										<div v-if="service_engineer_error" class="error">Select the service engineer</div>
									</div>

									<div class="form-group row">
										<div class="col-10 text-right offset-2">
											<button type="submit" class="btn btn-success">Submit</button>
										</div>
										
									</div>
								</form>
						    </div>
						 </div>

					  </div>
					</div>


		<div class="modal fade" id="secretModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<h5 class="modal-title" id="exampleModalLabel">Enter secret code</h5>
		        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          			<span aria-hidden="true">&times;</span>
		        		</button>
		      		</div>
		     	 <div class="modal-body">
                  	<form>
		                <div class="form-group">
		                    <label for="street">Your Secret Code</label>
		                    <input type="password" class="form-control" id="street" v-model="form.secret" >
		                </div> 
		            </form>
		        </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-primary" @click="close()">Save</button>
	            </div>
		    </div>
		      
		    </div>
		  </div>
		</div>


		
	</div>

</template>

<script>
	export default{
		data(){
			return {
				service:'',
				service_engineers : [],
				form : {
					service_description : '',
					service_remark : '',
					service_engineer : '',
					secret : '',
				},
				form_errors : [],
				service_engineer_error : false,
			}
		},
		methods : {
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
				  		this.service = res.data.data
				   	})
				   	.catch(error => {
				   		console.log(error.response)
				   	})
			},
			updateService(){
				if(!this.form.service_engineer){
						this.service_engineer_error = true
						return;
				}
				if(this.form.secret){
					let id = this.$route.params.id
					this.form.service_engineer = this.form.service_engineer.no
					axios.put(`/api/services/${id}`, this.form)
						.then(response => {
							if(response.status == 200){
								this.$router.push('/services');
							}
						})
						.catch(error => {
							console.log(error.response)
							if(error.response.status == 422){
								this.form_errors = error.response.data.errors
								this.form.service_engineer = this.service_engineers.find(staff => {
									return staff.no === this.form.service_engineer
								})
								console.log(this.form_errors);
							}

							if(error.response.status == 401 && error.response.data == 'Your secret is wrong'){
								this.form.service_engineer = this.service_engineers.find(staff => {
									return staff.no === this.form.service_engineer
								})
								alert(error.response.data)
								this.form.secret = '';
							}
						})
				}else{
					$('#secretModal').modal('show');
				}
				
			},
			close(){
				$('#secretModal').modal('hide')
			},
			back(){
			this.$router.go(-1);
		   }
		},
		created(){
           this.loadService()
			this.loadServiceEngineers()
		}
	}
</script>
<style scoped>
	.error{
		color : red;
	}
</style>

