export default $axios => ({
    auth: {
        me: () => $axios.$get('/me'),
        login: (data) => $axios.$post('/login', data),
        logout: () => $axios.$post('/logout'),
        register: (data) => $axios.$post('/register', data),
    },

});