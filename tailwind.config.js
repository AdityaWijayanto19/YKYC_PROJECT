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
                primary: "#5483B3",
                secondary: "#7DA0CA",
                success: "#10B981",
                warning: "#F59E0B",
                danger: "#EF4444",
                light: "#C1E8FF",
                dark: "#052659",
                background: "#f3f4f6",
                "navy-dark": "#021024",
                "navy-primary": "#052659",
                "blue-medium": "#5483B3",
                "blue-light": "#7DA0CA",
                "blue-pale": "#C1E8FF",
                "status-success": "#10B981",
                "status-pending": "#F59E0B",
            },
            fontFamily: {
                sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    plugins: [],
};
