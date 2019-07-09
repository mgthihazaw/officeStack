<template>
	<div>
		
	</div>
</template>
<script>
	export default{
		mounted(){
			swal
        .fire({
          title: "Are you sure to logout?",

          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes,Logout"
        })
        .then(result => {
          if (result.value) {
            //Send Delete Request to sever
           Bus.$emit('logout');
            
		  }
		  else{
           this.$router.go(-1)
		  }
		  
        })
        
		
			
		}
	}
</script>