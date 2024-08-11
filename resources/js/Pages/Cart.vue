<script setup lang="ts">
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import CartProduct from "@/Components/product/CartProduct.vue";
import { Head } from "@inertiajs/vue3";

const user_cart_items = Array(3).fill(null);

const total_cost = 12.99;
</script>

<template>
    <Head title="Cart" />

    <Header />
    <section
        class="container mx-auto px-0 md:px-8 mt-4 md:mt-8 flex flex-col items-center justify-start pb-12"
    >
        <h2 class="mt-2">{User} Cart</h2>

        <hr class="w-4/5" />

        <div class="w-full px-6 gap-6 flex flex-col md:grid grid-cols-5">
            <!-- cart list -->
            <div
                class="md:rounded-lg border-[1px] border-light dark:border-dark overflow-hidden divide-y-[1px] divide-light dark:divide-gray-700 col-span-3"
            >
                <CartProduct v-for="items in user_cart_items" />
            </div>

            <!-- checkout section -->
            <div
                class="border-0 md:border-[1px] border-light bg-light_platform dark:border-dark dark:bg-dark dark:md:bg-dark_platform rounded-lg col-span-2 flex flex-col items-center justify-start py-6 px-6 gap-4"
            >
                <div
                    class="w-full flex justify-between items-center text-base sm:text-lg"
                >
                    <span>Total Quantitiy : </span>
                    <span>{{ user_cart_items.length }}</span>
                </div>
                <div
                    class="w-full flex justify-between items-center text-base sm:text-lg"
                >
                    <span>Total Cost : </span>
                    <span class="text-emerald-500 font-semibold"
                        >{{ total_cost }}$
                    </span>
                </div>

                <hr class="w-full mt-auto mb-2" />

                <div class="flex items-center justify-center gap-3">
                    <input type="checkbox" />
                    <span>I Agree with Terms and Services</span>
                </div>

                <button
                    class="w-full py-4 px-6 mt-4 bg-emerald-500 hover:bg-emerald-600 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 transition-colors duration-150 rounded-lg font-semibold"
                >
                    Checkout
                </button>
            </div>
        </div>
    </section>

    <Footer />
</template>
