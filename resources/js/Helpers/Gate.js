class Gate{
	setUser(role){
		this.role = role;
	}
	isServiceEngineer(){
		return this.role == 2
	}
	isSaleperson(){
		return this.role == 3
	}
	isDeveloper(){
		return this.role == 1
	}
}
export default Gate = new Gate();



