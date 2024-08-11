<script setup lang="ts"></script>

<template>
    <div
        class="py-4 px-6 w-full flex gap-2 justify-between items-center bg-white odd:bg-dark odd:bg-opacity-5 dark:bg-gray-400 dark:bg-opacity-5 dark:odd:bg-black dark:odd:bg-opacity-25"
    >
        <div class="flex gap-2 md:gap-4">
            <img
                class="h-[80px] md:h-[100px] object-contain"
                src="/placeholder.webp"
            />

            <div class="flex flex-col justify-between">
                <h3 class="mt-0 text-base">Product Title</h3>
                <span class="block md:hidden font-semibold text-emerald-500"
                    >2.99$</span
                >
            </div>
        </div>

        <div class="h-full flex items-center">
            <!-- minus svg -->
            <button
                class="border-2 border-gray-600 stroke-gray-600 dark:border-white dark:stroke-white flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14"
                    />
                </svg>
            </button>

            <!-- quantitiy  -->
            <span class="font-semibold px-3">1</span>

            <!-- plus svg -->
            <button
                class="border-2 border-gray-600 stroke-gray-600 dark:border-white dark:stroke-white flex items-center justify-center"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>
            </button>
        </div>

        <span class="hidden md:block font-semibold text-emerald-500"
            >2.99$</span
        >
    </div>
</template>
