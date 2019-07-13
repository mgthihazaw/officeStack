export class Gate{
	
	setUser(roles,permissions){
		this.role = roles;
		this.permissions = permissions
	}
	
	isServiceEngineer(){
		if(Array.isArray(this.role)){
			return this.role.includes('service_engineer')
		}
	}
	isSaleperson(){
		if(Array.isArray(this.role)){
			return this.role.includes('receptionist')
		}
	}
	isDeveloper(){
		if(Array.isArray(this.role)){
			return this.role.includes('developer')
		}
	}
	can(permis){
		console.log('permisison',this.permissions);
		return this.permissions.includes(permis)
	}
}
// export default Gate = new Gate();



