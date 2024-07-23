/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
         subtleBounce: {
           '0%, 100%': { transform: 'translateY(-3%)' },
           '50%': { transform: 'translateY(0)' }
        },
      },
      animation: {
        'subtle-bounce': 'subtleBounce 1s infinite ease-in-out',
      },
    },
  },
  plugins: [],
}