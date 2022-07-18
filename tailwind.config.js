/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    "50": "#E9FBF0",
                    "100": "#D4F7E1",
                    "200": "#A4EFBF",
                    "300": "#78E7A1",
                    "400": "#4DE083",
                    "500": "#25D366",
                    "600": "#1EA951",
                    "700": "#167E3C",
                    "800": "#0E5227",
                    "900": "#082B15"
                },
                "primary-deep": {
                    "50": "#E5FAEE",
                    "100": "#CBF5DC",
                    "200": "#98ECB9",
                    "300": "#60E294",
                    "400": "#2CD871",
                    "500": "#1FA855",
                    "600": "#198544",
                    "700": "#126333",
                    "800": "#0D4523",
                    "900": "#062212"
                },
                "primary-light": {
                    "50": "#DBFFF7",
                    "100": "#BDFFF1",
                    "200": "#75FFE1",
                    "300": "#33FFD3",
                    "400": "#00EBB8",
                    "500": "#00A884",
                    "600": "#008568",
                    "700": "#006650",
                    "800": "#004234",
                    "900": "#00241C"
                }
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
