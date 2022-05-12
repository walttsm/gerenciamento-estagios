const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            'blue': {
                '100':'#ebf2f6',
                '200':'#c4d9e5',
                '300':'#9dc0d3',
                '400':'#76a7c1',
                '500':'#4f8db0',
                '600':'#3e6e89',
                '700':'#2c4e62',
                '800':'#1a2f3b',
                '900':'#1a2f3b',
            },
            'silverblue': '#9FB1BC',
            'gray': '#D3D0CB',
            'bg-beige': '#F2F2F2',
            'white': '#ffffff',
            'red': '#DD4141',
            'purple': '#552b7c',
        }
    },

    plugins: [require('@tailwindcss/forms')],
};
