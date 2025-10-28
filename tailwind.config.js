import defaultTheme from "tailwindcss/defaultTheme";

export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "#004D40", 
                secondary: "#E0F2F1", 
                success: "#10B981", 
                warning: "#F59E0B", 
                danger: "#EF4444", 
                light: "#E0F2F1",
                dark: "#00251A", 
                background: "#f3f4f6", 
                "teal-darker": "#00251A", 
                "teal-dark": "#004D40", 
                "teal-medium": "#26A69A", 
                "teal-light": "#80CBC4", 
                "teal-pale": "#E0F2F1", 
                "status-success": "#10B981",
                "status-pending": "#F59E0B",
                "status-danger": "#EF4444",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
