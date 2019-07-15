
export default {

    data() {
        return {
            show: false,
        }
    },
    methods: {

        
        can(permis) {
            return Gate.can(permis);
        },
        auth(){
            if (User.isLoggedIn()) {
                axios.post("/api/auth/me").then(response => {
                    Gate.setUser(response.data.user.roles, response.data.user.permissions);
                    this.User = Gate;
    
                    this.show = true
                });
            }
        }
    },
};