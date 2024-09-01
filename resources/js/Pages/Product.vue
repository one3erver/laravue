<script setup lang="ts">
import { ProductType } from "@/types/Products";
import StockAvailability from "@/Components/product/StockAvailability.vue";
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import AddToCart from "@/Components/product/AddToCart.vue";

const { product } = defineProps<{ product: ProductType }>();
</script>

<template>
    <Head :title="product.title" />
    <MainLayout>
        <section class="w-full max-w-screen-lg mx-auto px-4 lg:px-6 py-12">
            <!-- products details -->
            <div
                class="flex flex-col md:grid grid-cols-6 p-2 shadow-md border-[1px] border-light dark:border-dark w-full bg-light_platform dark:bg-dark_platform rounded-xl overflow-hidden"
            >
                <!-- image -->
                <div
                    class="relative aspect-square w-full col-span-3 rounded-lg overflow-hidden border-[1px] border-light dark:border-dark bg-light_platform dark:bg-dark_platform"
                >
                    <!-- thumbnail image -->
                    <img
                        class="absolute left-0 top-0 w-full object-contain"
                        :src="product.image_thumbnail"
                    />

                    <img
                        class="absolute left-0 top-0 w-full object-contain"
                        :src="'/images/admin/products/' + product.image"
                        :alt="product.title"
                    />
                </div>

                <!-- content -->
                <div
                    class="w-full h-full flex flex-col items-start justify-start px-4 pt-2 pb-6 col-span-3"
                >
                    <h1 class="mt-3 mb-5">{{ product.title }}</h1>

                    <div
                        class="prose-headings:mt-2 prose-headings:mb-4 prose-p:my-0"
                        v-html="product.caption"
                    ></div>

                    <div class="mt-auto w-full space-y-3">
                        <span
                            class="text-lg font-semibold text-emerald-500 dark:text-emerald-400"
                            >{{ product.price }}$</span
                        >
                        <StockAvailability :stock="product.stock" />

                        <AddToCart
                            :product_id="product.id"
                            :count="product.count"
                            :limit="product.stock"
                        />
                    </div>
                </div>
            </div>
        </section>
    </MainLayout>
</template>
