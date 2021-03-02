const Color = require('color');
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
            gray: {
                '50': '#f9fafb',
                '100': '#f4f5f7',
                '200': '#e5e7eb',
                '300': '#d5d6d7',
                '400': '#9e9e9e',
                '500': '#707275',
                '600': '#4c4f52',
                '700': '#24262d',
                '800': '#1a1c23',
                '900': '#121317',
            },
            red: {
                '50': '#fdf2f2',
                '100': '#fde8e8',
                '200': '#fbd5d5',
                '300': '#f8b4b4',
                '400': '#f98080',
                '500': '#f05252',
                '600': '#e02424',
                '700': '#c81e1e',
                '800': '#9b1c1c',
                '900': '#771d1d',
            },
            yellow: {
                '50': '#fdfdea',
                '100': '#fdf6b2',
                '200': '#fce96a',
                '300': '#faca15',
                '400': '#e3a008',
                '500': '#c27803',
                '600': '#9f580a',
                '700': '#8e4b10',
                '800': '#723b13',
                '900': '#633112',
            },
            green: {
                '50': '#f3faf7',
                '100': '#def7ec',
                '200': '#81C784',
                '300': '#84e1bc',
                '400': '#31c48d',
                '500': '#0e9f6e',
                '600': '#057a55',
                '700': '#046c4e',
                '800': '#03543f',
                '900': '#014737',
            },
            blue: {
                '50': '#ebf5ff',
                '100': '#e1effe',
                '200': '#c3ddfd',
                '300': '#a4cafe',
                '400': '#76a9fa',
                '500': '#3f83f8',
                '600': '#1c64f2',
                '700': '#1a56db',
                '800': '#1e429f',
                '900': '#233876',
            },
            purple: {
                '50': '#f6f5ff',
                '100': '#edebfe',
                '200': '#dcd7fe',
                '300': '#cabffd',
                '400': '#ac94fa',
                '500': '#9061f9',
                '600': '#7e3af2',
                '700': '#6c2bd9',
                '800': '#5521b5',
                '900': '#4a1d96',
            },
        },
        extend: {
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
