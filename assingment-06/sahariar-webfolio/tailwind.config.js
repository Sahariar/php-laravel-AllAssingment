/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {
            colors: {
                'pm-dev': '#64F4AB',
                'prime-bg': '#2D2E31',
                'sd-bg': '#252629',
                'btext':'#8B8D90'
},
        },
    },
    plugins: [
        require('preline/plugin'),
    ],
};
