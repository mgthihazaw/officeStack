<template>
	<div>
		<saleperson-editview v-if="User.isSaleperson"></saleperson-editview>
		<engineer-editview v-if="User.isServiceEngineer"></engineer-editview>
	</div>
</template>

<script>
	import EditBySaleperson from './EditBySaleperson';
	import EditByEngineer from './EditByEngineer';

	export default{
		components : {
			'saleperson-editview' : EditBySaleperson,
			'engineer-editview' : EditByEngineer,
		},
		data(){
			return {
				User : '',
			}
		},
		created(){
			this.User = Gate;
		}
		
	}
</script>