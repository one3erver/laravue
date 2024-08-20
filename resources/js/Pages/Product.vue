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
        <section class="container-md mx-auto px-4 lg:px-6 py-12">
            <!-- products details -->
            <div
                class="flex flex-col lg:grid grid-cols-6 shadow-md border-[1px] border-light dark:border-dark w-full bg-light_platform dark:bg-dark_platform rounded-xl overflow-hidden"
            >
                <div class="h-full col-span-3">
                    <img
                        class="w-full h-full object-cover"
                        :src="product.image"
                    />
                </div>

                <div
                    class="w-full h-full flex flex-col items-start justify-start px-4 pt-2 pb-6 col-span-3"
                >
                    <h1 class="mt-4 mb-2">{{ product.title }}</h1>

                    <p>
                        {{ product.caption }}
                    </p>

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
