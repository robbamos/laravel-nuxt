export default {
  env: {
    baseUrl: process.env.BASE_URL || 'http://localhost:3000',
    apiUrl: process.env.API_URL || 'http://localhost:3001'
  },
  head: {
    title: 'Laravel + Nuxt',
    meta: [{
        charset: 'utf-8'
      },
      {
        name: 'viewport',
        content: 'width=device-width, initial-scale=1'
      },
      {
        hid: 'description',
        name: 'description',
        content: 'A Nuxt.js front powered by Laravel backend'
      }
    ],
    link: [{
        rel: 'icon',
        type: 'image/x-icon',
        href: '/favicon.ico'
      },
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons'
      }
    ]
  },
  plugins: [
    '~/plugins/vuetify.js',
    '~/plugins/api.js',
  ],
  css: [
    '~/assets/style/app.styl'
  ],
  modules: [
    '@nuxtjs/axios',
    '@nuxtjs/auth'
  ],
  axios: {
    proxy: true,
    prefix: '/api',
    credentials: true,
    debug: true,

  },
  proxy: {
    '/api/': {
      target: process.env.API_URL || 'http://localhost:3001'
    }
  },
  auth: {
    redirect: {
      login: '/login',
      logout: '/',
      callback: '/login',
      home: '/dashboard'
    },

    strategies: {
      local: {
        endpoints: {
          login: {
            url: '/login',
            method: 'post',
            propertyName: 'access_token'
          },
          logout: {
            url: '/logout',
            method: 'post'
          },
          user: {
            url: '/me',
            method: 'get',
            propertyName: 'user'
          }
        },
        tokenRequired: true,
        tokenType: 'Bearer',
      }
    }
  },
  manifest: {
    name: 'Laravel + Nuxt',
    lang: 'en'
  },
  loading: {
    color: '#3B8070'
  },
  build: {
    extractCSS: true,
  }
}