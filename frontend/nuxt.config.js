module.exports = {
  /*
   ** Headers of the page
   */
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
    '~/api/init.js'
  ],
  css: [
    '~/assets/style/app.styl'
  ],
  modules: [
    '@nuxtjs/pwa',
  ],
  workbox: {
    // Workbox options
    // runtimeCaching: [{
    //   // Should be a regex string. Compiles into new RegExp('https://my-cdn.com/.*')
    //   urlPattern: 'https://my-cdn.com/.*',
    //   // Defaults to `networkFirst` if omitted
    //   handler: 'cacheFirst',
    //   // Defaults to `GET` if omitted
    //   method: 'GET'
    // }],
  },
  manifest: {
    name: 'Nuxt + Laravel',
    lang: 'en'
  },
  /*
   ** Customize the progress bar color
   */
  loading: {
    color: '#3B8070'
  }
  /*
   ** Build configuration
   */
  // build: {
  //   extractCSS: true,
  //   extend (config, ctx) {
  //     // Run ESLint on save
  //     if (ctx.isDev && ctx.isClient) {
  //       config.module.rules.push({
  //         enforce: 'pre',
  //         test: /\.(js|vue)$/,
  //         loader: 'eslint-loader',
  //         exclude: /(node_modules)/
  //       })
  //     }
  //   }
}