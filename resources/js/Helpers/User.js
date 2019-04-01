class User{

	setToken(token){
		localStorage.setItem('token',token);
	}
	setUser(user){
		localStorage.setItem('user',user.username);
	}
	store(user,token){
		this.setUser(user)
		this.setToken(token)
	}
	getUser(){
		return localStorage.getItem('user');
	}
	getToken(){
		return localStorage.getItem('token');
	}
	isLoggedIn(){
		return (this.getUser() && this.getToken()) ? true : false;
	}
	clear(){
		if(this.isLoggedIn()){
			localStorage.removeItem('token');
			localStorage.removeItem('user');

		} 
	}
}
export default User = new User();