<script setup lang="ts">
import AddToCart from "./AddToCart.vue";
</script>

<template>
    <div
        class="border-[1px] border-light rounded-xl pb-5 overflow-hidden shadow-md bg-light_platform dark:bg-dark_platform dark:border-dark"
    >
        <img src="/placeholder.webp" alt="placeholder" />
        <div class="w-full px-3">
            <!-- title -->
            <h3 class="w-full text-center mt-3 mb-5">The Title of Product</h3>

            <p class="text-center line-clamp-2">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                Dolores, voluptatum possimus! Quod eius consequatur commodi,
                quaerat laborum neque perferendis nihil eaque pariatur error,
                repellendus, aspernatur deserunt voluptatem tempora voluptatum
                molestias.
            </p>

            <!-- price -->
            <span
                class="w-full block pb-3 text-right text-lg font-semibold text-emerald-500 dark:text-emerald-400"
                >2.99$</span
            >
        </div>

        <AddToCart />
    </div>
</template>
