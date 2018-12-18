import api from '~/api'
import {
  setAuthToken,
  resetAuthToken
} from '~/utils/auth'
import cookies from 'js-cookie'


export const state = () => ({
  user: null,
  loading: false,
})

export const mutations = {
  set_loading(store) {
    store.loading = true
  },
  clear_loading(store) {
    store.loading = false
  },
  set_user(store, data) {
    store.user = data
  },
  reset_user(store) {
    store.user = null
  },
}

export const getters = {
  topNavMenu(state) {
    if (state.user) {
      return [{
          icon: "home",
          title: "Dashboard",
          to: "/dashboard"
        },

      ]
    }
    return [{
        icon: "home",
        title: "Login",
        to: "/login",
      },
      {
        icon: "",
        title: "Register",
        to: "/register"
      }
    ]

  },


  isLoggedIn(state) {
    return !!state.user
  }
}

export const actions = {
  fetch({
    commit
  }) {
    return new Promise((resolve, reject) => {
      api.auth.me()
        .then(response => {
          console.log(response)
          commit('set_user', response.data.user)
          return resolve(response)
        })
        .catch(error => {
          commit('reset_user')
          return reject(error)
        })
    })
  },
  login({
    commit
  }, data) {
    commit('set_loading')
    return new Promise((resolve, reject) => {
      api.auth.login(data)
        .then(response => {
          commit('set_user', response.data.user)
          setAuthToken(response.data.token)
          cookies.set('x-access-token', response.data.token)
          commit('clear_loading')
          return resolve(response)
        })
        .catch(error => {
          console.log(error)
          commit('clear_loading')
          return reject(error)

        })
    })

  },

  logout({
    commit
  }) {
    return new Promise((resolve, reject) => {
      api.auth.logout()
        .then(response => {
          cookies.remove('x-access-token')
          resetAuthToken()
          commit('reset_user')
          return resolve(response)
        })
        .catch(error => {
          console.log(error)
          return reject(error)
        })
    })
  },

  register({
    commit
  }, data) {
    commit('set_loading')
    return new Promise((resolve, reject) => {
      api.auth.register(data)
        .then(response => {
          console.log(response)
          commit('set_user', response.data.user)
          setAuthToken(response.data.token)
          cookies.set('x-access-token', response.data.token)
          commit('clear_loading')
          return resolve(response)
        })
        .catch(error => {
          console.log(error)
          commit('clear_loading')
          return reject(error)
        })
    })
  }
}