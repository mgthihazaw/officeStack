<template>
	<div>
		<saleperson-editview v-if="isSaleperson()"></saleperson-editview>
		<engineer-editview v-if="isServiceEngineer()"></engineer-editview>
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
				User : new Object,
			}
		},
		methods : {
			isServiceEngineer(){
				return Gate.isServiceEngineer();
			},
			isSaleperson(){
				return Gate.isSaleperson();
			}
		},
		created(){
			
		},
		
	}
</script>