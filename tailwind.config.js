const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue'
    ],

    theme: {
        themeVariants: ['dark'],
        customForms: (theme) => ({
            default: {
                'input, textarea': {
                    '&::placeholder': {
                        color: theme('colors.gray.400'),
                    },
                },
            },
        }),
        colors: {
            transparent: 'transparent',
            white: '#ffffff',
            black: '#000000',
            gray: colors.gray,
            red: colors.red,
            yellow: colors.yellow,
            green: colors.green,
            blue: colors.blue,
            purple: colors.purple,
            teal: colors.teal,
            orange: colors.orange,
            pink: colors.pink,
        },
        extend: {
            minWidth: {
                '1/4': '25%',
                '1/2': '50%',
                '3/4': '75%',
                'full': '100%',
                '90vw': '90vw',
            },
            maxHeight: {
                '0': '0',
                xl: '36rem',
            },
            fontFamily: {
                sans: ['Nunito', 'sans-serif'],
                cursive: ['Cedarville Cursive', 'cursive'],
            },
            height: {
                '60-screen': '65vh',
            },
            width: {
                '47p': '47%',
            },
            colors: {
                kaki: {
                    '300': '#98d2fb',
                    '800': '#757459',
                    '900': '#5F5E48',
                  },
                primary: {
                    100: "#FAFAFA",
                    200: "#F6EFE4",
                    300: "#F1EDEA",
                    400: "#E3B7A0",
                    500: "#E4A075",
                    600: "#AD836B",
                    700: "#edddc5",
                },
            },
            zIndex: {
                '-1': -1,
                1: 1,
                60: 60,
                70: 70,
                80: 80,
                90: 90,
                100: 100,
              },
        },
    },

    variants: {
        backgroundColor: [
            'hover',
            'focus',
            'active',
            'odd',
            'dark',
            'dark:hover',
            'dark:focus',
            'dark:active',
            'dark:odd',
            'responsive'
        ],
        display: ['responsive', 'dark'],
        textColor: [
            'focus-within',
            'hover',
            'active',
            'dark',
            'dark:focus-within',
            'dark:hover',
            'dark:active',
        ],
        placeholderColor: ['focus', 'dark', 'dark:focus'],
        borderColor: ['focus', 'hover', 'dark', 'dark:focus', 'dark:hover'],
        divideColor: ['dark'],
        boxShadow: ['focus', 'dark:focus', 'responsive'],
        opacity: ['responsive', 'hover', 'focus', 'disabled', 'group-hover'],
        ringOpacity: ['hover', 'active', 'focus'],
        outline: ['focus', 'responsive', 'hover'],
        borderRadius: ['hover', 'group-hover'],
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('tailwindcss-multi-theme'),
    ],
}
