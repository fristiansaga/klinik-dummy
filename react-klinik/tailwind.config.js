/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        zeni: {
          primary: '#2E5339',
          'primary-dark': '#1E3926',
          'primary-light': '#3F6E4D',
          accent: '#D97706',
          'accent-light': '#F59E0B',
          success: '#10B981',
          warning: '#F59E0B',
          danger: '#EF4444',
          surface: '#0F172A',
          card: '#1E293B',
          border: '#334155'
        }
      },
      fontFamily: {
        sans: ['Outfit', 'Inter', 'system-ui', 'sans-serif'],
      },
      boxShadow: {
        'glow-primary': '0 0 25px -5px rgba(46, 83, 57, 0.5)',
        'glow-accent': '0 0 25px -5px rgba(217, 119, 6, 0.5)',
        'glow-success': '0 0 25px -5px rgba(16, 185, 129, 0.5)',
      }
    },
  },
  plugins: [],
}
