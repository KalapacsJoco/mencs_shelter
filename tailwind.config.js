import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                comfortaa: ['Comfortaa', 'cursive'],
            },
            colors: {
                btnprimary: {
                    DEFAULT:    'rgba(242, 221, 193, 1)',
                    hover:      'rgba(242, 221, 193, 1)',
                    pressed:    'rgba(219, 182, 132, 1)'
                },
                btnsecondary: {
                    DEFAULT:    'rgba(255, 250, 250, 1)',
                    hover:      'rgba(242, 221, 193, 0.3)',
                    pressed:    'rgba(255, 250, 250, 1)'
                },
                background: {
                    DEFAULT:    'rgba(242, 221, 193, 0.3)',
                    noopacity:  'rgb(242, 221, 193)',
                    base:       'rgba(255, 250, 250, 1)',
                }
            }
        },
    },

    plugins: [forms],
};
