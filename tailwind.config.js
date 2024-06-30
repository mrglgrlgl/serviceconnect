import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/auth/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/components/*.blade.php',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/**/*.blade.php',
        './storage/framework/views/**/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            height:{
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
            },
            maxHeight: {
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
            },
            minHeight: {
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
            },
            height:{
                '128': '32rem',
                '144': '36rem',
                '160': '40rem',
                '176': '44rem',
                '192': '48rem',
            },
            fontFamily: {
                'open-sans': ['Open Sans', 'sans-serif'],
                'nunito-sans': ['Nunito Sans', 'sans-serif'],
            },
            fontSize: {
                'xs': '0.75rem', // Extra small         12px
                'sm': '0.875rem', // Small              14px
                'base': '1rem', // Base/default size    16px  
                'lg': '1.125rem', // Large              18px
                'xl': '1.25rem', // Extra large         20px
                '2xl': '1.5rem', // 2 times large       24px
                '3xl': '1.875rem', // 3 times large //header 30px
                '4xl': '2.25rem', // 4 times large      36px
                '5xl': '3rem', // 5 times large         48px
                '6xl': '4rem', // 6 times large         60px
                '7xl': '5rem', // 7 times large         72px
                '8xl': '6rem', // 8 times large         96px
                '9xl': '7rem', // 9 times large         128px
            },
            colors: {
                custom: {
                    'bg': '#FAFAFA',
                    'default-text': '#2F3033',
                    'light-blue': '#204860',
                    'dark-blue': '#1A202C',
                    'header': '#333333',
                    'dark-text': '#111111',
                    'light-text': '#666666', 
                    'nav-bg': '#EBEDEF', 
                    'yellow': '#F8A619',
                    'fields': '#BABABA',
                    'cat-border': '486284'
        },
            width:{
                custom: {
                    'map': '1524px'
            }
        }
    },
},
    plugins: [forms],
}
};
