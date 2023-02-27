const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    DEFAULT: "#27C473",
                    600: "#2AA373"
                },

                secondary: {
                    DEFAULT: "#4760C1",
                    50: "#A3AFE0",
                    200: "#6680C7",
                    500: "#3E51B2",
                    600: "#364EAE",
                    600: "#364EAE",
                    700: "#334392",
                    text: "#FFFFFF"
                },

                accent: {
                    DEFAULT: "#4760C1",
                    600: "#4354A9",
                    text: "#FFFFFF"

                }
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
