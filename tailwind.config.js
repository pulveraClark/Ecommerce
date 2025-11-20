import forms from '@tailwindcss/forms';

export default {
    darkMode: false, // <-- add this line to disable dark mode
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",

        // Livewire views
        "./vendor/livewire/livewire/src/**/*.blade.php",

        // Laravel pagination views
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",

        // Preline UI
        "./node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        forms,
    ],
};
