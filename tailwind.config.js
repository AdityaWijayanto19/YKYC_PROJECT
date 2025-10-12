import defaultTheme from 'tailwindcss/defaultTheme';

export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#5483B3',   
                secondary: '#7DA0CA', 
                success: '#10B981',
                warning: '#F59E0B',   
                danger: '#EF4444',    
                light: '#C1E8FF',
                dark: '#052659',      
                background: '#f3f4f6',      
            },
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
