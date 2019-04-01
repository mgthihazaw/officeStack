<template>
	<div>
		
	</div>
</template>
<script>
	export default{
		created(){
			Bus.$emit('logout');
		}
	}
</script>