/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./public/index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
    "./node_modules/primevue/**/*.{vue,js,ts,jsx,tsx}"
  ],

  theme: {
    extend: {
      colors:{
        "green-pri":"#128364",
        "green-sec":"#005B41",
        "green-font":'#508D69',
      },
      fontFamily:{
        MavenPro:["Maven Pro, sans-serif"]
      },
      container:{
        padding:"2rem",
        center:true
      }
    },
  },
  plugins: [],
}

