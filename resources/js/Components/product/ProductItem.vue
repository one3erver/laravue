<script setup lang="ts">
import { ProductType } from "@/types/Products";
import AddToCart from "./AddToCart.vue";
import { Link } from "@inertiajs/vue3";

const { id, title, caption, image, price, count, stock } = defineProps([
    "title",
    "count",
    "caption",
    "price",
    "id",
    "image",
    "stock",
]);
</script>

<template>
    <Link
        :href="`products/${id}`"
        class="border-[1px] h-full flex flex-col items-center justify-between border-light rounded-xl pb-5 overflow-hidden shadow-md bg-light_platform dark:bg-dark_platform dark:border-dark"
    >
        <img :src="image" :alt="title" />
        <div class="w-full flex flex-col items-center justify-start px-3">
            <!-- title -->
            <h3 class="w-full text-center mt-3 mb-5">{{ title }}</h3>

            <p class="text-center line-clamp-2">
                {{ caption }}
            </p>
        </div>

        <div class="w-full px-3">
            <!-- price -->
            <span
                class="w-full block pb-3 text-right text-lg font-semibold text-emerald-500 dark:text-emerald-400 mt-auto"
                >{{ price }}$</span
            >
            <AddToCart :product_id="id" :count="count" :limit="stock" />
        </div>
    </Link>
</template>
