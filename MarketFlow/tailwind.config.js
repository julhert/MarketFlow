import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors:{
                //Color del boton
                'btn-buy': '#E98800',
                'btn-success': '#00AB1F',
                'btn-danger': '#B20000',

                //Color del texto
                'main-black': '#000000',

                //Paleta de colores para lo demas
                'brand-blue': {
                    50: '#A4B7D7',
                    100: '#5C7AA3',
                    200: '#274472',
                    300: '#1B3454',
                    400: '#0E1A2B',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'title': ['"Juliues Sans One"', 'sans-serif'],
                'body': ['Inter', 'sans-serif'],
            },
        },
    },

    plugins: [forms, typography],
};
