import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class", // ✅ ini baris penting untuk mendukung toggle dark mode
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                "select-arrow": 'url("data:image/svg+xml;base64,...")',
            },
            boxShadow: {
                soft: "0 20px 27px 0 rgba(0,0,0,0.05)",
            },
        },
    },
    plugins: [forms],
};
