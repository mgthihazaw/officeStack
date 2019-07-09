<template>
  <div></div>
</template>
<script>
export default {
  data(){
      return {
        prevRoute: '/'
      }
    },
  mounted() {
    
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
          Bus.$emit("logout");
        } else {
          if(this.prevRoute){
             this.$router.push(this.prevRoute.fullPath);
          }
          
        }
      });
  },
  beforeRouteEnter(to, from, next) {
    next(vm => {
      vm.prevRoute = from;
    });
  }
};
</script>