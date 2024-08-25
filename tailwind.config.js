import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            backgroundColor: {
                dark: "#0b0f1a",
                dark_platform: "#121727",
                light: "#f9f9f9",
                light_platform: "#fefefe",
            },
            borderColor: {
                dark: "#374151",
                light: "#D1D5DB",
            },
            divideColor: {
                dark: "#374151",
                light: "#D1D5DB",
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
        },
    },
    darkMode: "selector",
    plugins: [forms, require("@tailwindcss/typography")],
};
