'use strict'

module.exports = ctx => {
  return {
    plugins: {
      autoprefixer: {
        cascade: false
      }
    }
  }
}
