<script setup lang="ts">
import AddToCart from "./AddToCart.vue";

const { id, title, caption, image, price, count, stock, image_thumbnail } =
    defineProps([
        "title",
        "count",
        "caption",
        "price",
        "id",
        "image",
        "stock",
        "image_thumbnail",
    ]);
</script>

<template>
    <a
        :href="`products/${id}`"
        class="border-[1px] h-full flex flex-col items-center justify-start border-light rounded-xl pb-5 overflow-hidden shadow-md bg-light_platform dark:bg-dark_platform dark:border-dark"
    >
        <!-- image container -->
        <div class="w-full aspect-square relative">
            <!-- thumbnail image -->
            <img
                class="absolute left-0 top-0 size-full"
                :src="image_thumbnail"
            />

            <img
                class="absolute left-0 top-0 size-full object-contain"
                :src="'/images/admin/products/' + image"
                :alt="title"
            />
        </div>

        <div class="w-full flex flex-col items-center justify-start px-3">
            <!-- title -->
            <h3 class="w-full text-center mt-3 mb-5">{{ title }}</h3>

            <div
                class="line-clamp-2 prose-headings:my-0 prose-p:my-0 prose-a:my-0 text-center"
                v-html="caption"
            ></div>
        </div>

        <div class="w-full px-3 mt-auto">
            <!-- price -->
            <span
                class="w-full block pb-3 text-right text-lg font-semibold text-emerald-500 dark:text-emerald-400 mt-auto"
                >{{ price }}$</span
            >
            <AddToCart :product_id="id" :count="count" :limit="stock" />
        </div>
    </a>
</template>
