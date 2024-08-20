<script setup lang="ts">
import { AuthTypes } from "@/types";
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useNumberOfItemsInCart } from "@/util/useCart";
import { Link } from "@inertiajs/vue3";

const { auth } = defineProps<AuthTypes>();

const hideThreshold = 120;

let prevScroll = 0;
let currentScroll = 0;

const isHidden = ref(false);
const itemsInCart = ref(useNumberOfItemsInCart());

const cart_badge = ref<HTMLSpanElement | null>(null);

onMounted(() => {
    window.addEventListener("cartchange", handleCartChange);
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("cartchange", handleCartChange);
    window.removeEventListener("scroll", handleScroll);
});

function handleCartChange(event: any) {
    //animate the badge on cart change
    if (cart_badge) {
        cart_badge.value?.classList.add("scale-110");

        setTimeout(() => {
            cart_badge.value?.classList.remove("scale-110");
        }, 150);
    }

    itemsInCart.value = event.detail.itemsInCart;
    isHidden.value = false;
}

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
            'w-full z-[99] px-6 bg-white dark:text-white dark:bg-dark bg-opacity-70 dark:bg-opacity-70 backdrop-blur-md border-b-[1px] border-gray-300 dark:border-gray-400 flex fixed items-center justify-between transition-[top] duration-200 ',
            isHidden ? '-top-[70px]' : 'top-0',
        ]"
    >
        <div class="flex gap-6 items-center justify-between">
            <Link
                v-if="auth.user"
                :href="auth.user.is_admin ? '/admin' : '/dashboard'"
                class="px-3 py-1 max-w-[150px] inline-block text-nowrap text-ellipsis overflow-hidden border-[1px] border-gray-500 dark:border-dark rounded-lg transition-all duration-75 hover:bg-gray-500 hover:text-white dark:hover:bg-gray-700"
            >
                {{ auth.user.name }}
            </Link>
            <Link
                v-else
                href="/login"
                class="px-3 py-1 border-[1px] border-gray-500 dark:border-dark rounded-lg transition-all duration-75 hover:bg-gray-500 hover:text-white dark:hover:bg-gray-700"
            >
                Login
            </Link>

            <!-- cart link -->
            <Link class="relative" href="carts">
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

                <!-- cart item badge -->
                <span
                    ref="cart_badge"
                    class="absolute flex items-center justify-center size-5 bg-red-500 text-white font-bold -right-3 -bottom-1 rounded-full text-sm transition-all duration-75"
                    >{{ itemsInCart }}</span
                >
            </Link>
        </div>

        <a href="/">LOGO</a>
    </header>
</template>
