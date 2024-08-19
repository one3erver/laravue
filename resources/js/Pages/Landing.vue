<script setup lang="ts">
import ProductItem from "@/Components/product/ProductItem.vue";
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import { Head } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import { ProductsType } from "@/types/Products";
import { AuthTypes } from "@/types";
import { onMounted } from "vue";

const { products, auth } = defineProps<ProductsType & AuthTypes>();

onMounted(() => {
    if (!auth.user) {
        localStorage.removeItem("cart");
        return;
    }

    const cartItems = products.filter(product=>product.count>0).map(product=>{
    return {id:product.id,count:product.count}
})

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
            <div class="w-full max-w-3xl text-center">
                <img
                    class="mx-auto"
                    src="/placeholder.webp"
                    alt="placeholder"
                />

                <p class="text-center text-lg">
                    Lorem ipsum dolor sit amet elit. Veniam omnis quod ad
                    tempore pariatur eos tempora, porro nostrum optio soluta. Et
                    debitis, repellat cum reprehenderit aperiam error id
                    veritatis!
                </p>
            </div>

            <hr class="w-full" />

            <!-- products -->
            <div
                class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch"
            >
                <ProductItem v-for="product in products" v-bind="product"/>
            </div>
        </section>
    </MainLayout>
</template>
