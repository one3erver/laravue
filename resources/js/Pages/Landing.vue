<script setup lang="ts">
import ProductItem from "@/Components/product/ProductItem.vue";
import { Head, usePage } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { ProductsType } from "@/types/Products";
import { onMounted } from "vue";
import { PageProps } from "@/types";

const { products } = defineProps<ProductsType>();
const {
    props: { auth, setting },
} = usePage<PageProps>();

onMounted(() => {
    if (!auth.user) {
        localStorage.removeItem("cart");
        return;
    }

    const cartItems = products
        .filter((product) => product.count > 0)
        .map((product) => {
            return { id: product.id, count: product.count };
        });

    localStorage.setItem("cart", JSON.stringify(cartItems));

    const total_count = cartItems.reduce(
        (sum, current) => sum + current.count,
        0
    );

    window.dispatchEvent(
        new CustomEvent("cartchange", {
            detail: {
                itemsInCart: total_count,
                storage: localStorage.getItem("cart"),
            },
        })
    );
});
</script>

<template>
    <Head title="Welcome" />

    <MainLayout>
        <section
            class="container mx-auto px-8 mt-4 md:mt-8 flex flex-col items-center justify-start pb-12"
        >
            <!-- landing content -->
            <div v-html="setting.landing_content" class="w-full max-w-3xl text-center"></div>

            <hr class="w-full" />

            <!-- products -->
            <div
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch"
            >
                <ProductItem v-for="product in products" v-bind="product" />
            </div>
        </section>
    </MainLayout>
</template>
