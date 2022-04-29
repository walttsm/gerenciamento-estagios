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
            'blue': '#2E5266',
            'silverblue': '#9FB1BC',
            'gray': '#D3D0CB',
            'bg-beige': '#F2F2F2',
            'white': '#ffffff',

        }
    },

    plugins: [require('@tailwindcss/forms')],
};
