class User{

	setToken(token){
		localStorage.setItem('token',token);
	}
	setUser(user){
		localStorage.setItem('user', user.username);
	}
	setPermissions(permissions){
		//localStorage.setItem('permissions',permissions);
	}
	store(user,permissions,token){
		this.setUser(user);
		this.setPermissions(permissions)
		this.setToken(token)
	}
	getUser(){
		return localStorage.getItem('user');
	}
	getPermissions(){
		return localStorage.getItem('permissions');
	}
	
	getToken(){
		return localStorage.getItem('token');
	}
	isLoggedIn(){
		return (this.getToken()) ? true : false;
	}
	clear(){
		if(this.isLoggedIn()){
			localStorage.removeItem('token');
			localStorage.removeItem('permissions');
			localStorage.removeItem('user');
		} 
	}
}
export default User = new User();