class User {

    storeUser(user) {
        localStorage.setItem('user', user);
    }

    getUser() {
        return JSON.parse(localStorage.getItem('user'));
    }

    isLogged() {
        return this.getUser() !== null ? this.getUser() : false;
    }

    logout() {
        localStorage.removeItem('user');
    }

    isadmin() {
        return this.isLogged().admin ? true : false;
    }

}

export default User = new User();