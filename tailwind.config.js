module.exports = {
  theme: {
    fontFamily: {
      display: ['Barlow', 'sans-serif'],
      body: ['Barlow', 'sans-serif']
    },
    inset: {
      '0': 0,
      auto: 'auto',
      '1': '1em',
    },
    extend: {
      spacing: {
        '72': '18rem',
        'nav': '18.888%',
        'container': 'calc(18.888% + 2.5rem)'
      },
      screens: {
        'mobile-only': {'max': '1024px'},
      }
    },
  },
  variants: {
    tableLayout: ['responsive', 'hover', 'focus'],
  },
  plugins: []
}
