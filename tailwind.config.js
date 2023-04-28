/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './storage/framework/views/*.php',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
    './**/*.{html,js,php,blade.php,vue}',

  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms'),


  ],
}
