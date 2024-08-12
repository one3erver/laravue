<script setup lang="ts">
import { AuthTypes } from "@/types";
import { onMounted, onUnmounted, ref } from "vue";

const { auth } = defineProps<AuthTypes>();

console.log(auth.user);

const hideThreshold = 120;

let prevScroll = 0;
let currentScroll = 0;

const isHidden = ref(false);

onMounted(() => {
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});

function handleScroll() {
    currentScroll = window.scrollY;

    if (currentScroll > hideThreshold) {
        isHidden.value = true;
    }

    if (window.scrollY < hideThreshold || currentScroll < prevScroll) {
        isHidden.value = false;
    }

    prevScroll = window.scrollY;
}

const header_height = "h-[55px] md:h-[65px]";
</script>

<template>
    <!-- dom placeholder for header -->
    <div :class="header_height"></div>

    <!-- header -->
    <header
        :class="[
            header_height,
            'w-full px-6 bg-white dark:text-white dark:bg-dark bg-opacity-80 backdrop-blur-md border-b-[1px] border-gray-300 dark:border-gray-400 flex fixed items-center justify-between transition-[top] duration-200 z-50',
            isHidden ? '-top-[70px]' : 'top-0',
        ]"
    >
        <div class="flex gap-6 items-center justify-between">
            <a
                v-if="auth.user"
                href="/dashboard"
                class="px-3 py-1 border-[1px] border-gray-500 dark:border-dark rounded-lg"
            >
                {{ auth.user.email }}
            </a>
            <a
                v-else
                href="/login"
                class="px-3 py-1 border-[1px] border-gray-500 dark:border-dark rounded-lg"
            >
                Login
            </a>

            <!-- cart svg -->
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.3"
                stroke="currentColor"
                class="size-6 md:size-8"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z"
                />
            </svg>
        </div>

        <div>LOGO</div>
    </header>
</template>
