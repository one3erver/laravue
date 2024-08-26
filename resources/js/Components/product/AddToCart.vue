<script setup lang="ts">
import { inject, onMounted, onUnmounted, ref } from "vue";
import { useAddToLocalCart, useDoesExistinCart } from "@/util/useCart";
import { usePage } from "@inertiajs/vue3";
import { injectedDisplayToastType } from "@/util/useToast";

const { product_id, count, limit } = defineProps<{
    product_id: number;
    count: number;
    limit: number;
}>();

const {
    props: { auth },
} = usePage();

const quantity = ref(count > 0 ? count : 0);

const displayToast = inject("displayToast") as ({
    message,
}: injectedDisplayToastType) => void;

const addToCartWidth = ref(0);

onMounted(() => {
    const itExistInCart = useDoesExistinCart(product_id);
    if (itExistInCart) {
        quantity.value = itExistInCart.count;
    }
});

function IncrementFromCart() {
    if (!auth.user) {
        displayToast({
            message: "please Login to continue",
        });
        return;
    }

    //pop animation - add scale and remove it after a short time
    if (!add_to_cart.value) return;
    add_to_cart.value.classList.add("scale-105");

    setTimeout(() => {
        if (!add_to_cart.value) return;
        add_to_cart.value.classList.remove("scale-105");
    }, 200);

    //only add to cart if its lower then limit (stock)
    if (quantity.value < limit || limit === -1) {
        quantity.value += 1;
        useAddToLocalCart(product_id, quantity.value);
    } else {
        displayToast({
            message: "cannot add more, out of stock",
        });
    }
}

function DecrementFromCart() {
    if (!auth.user) {
        displayToast({
            message: "please Login to continue",
        });
        return;
    }

    //pop animation - add scale and remove it after a short time
    if (!add_to_cart.value) return;
    add_to_cart.value.classList.add("scale-105");

    setTimeout(() => {
        if (!add_to_cart.value) return;
        add_to_cart.value.classList.remove("scale-105");
    }, 200);

    //remove until it reaches 0 items
    if (quantity.value > 0) {
        quantity.value -= 1;
        useAddToLocalCart(product_id, quantity.value);
    }
}

const add_to_cart_placeholder = ref<HTMLButtonElement | null>(null);
const add_to_cart = ref<HTMLButtonElement | null>(null);

let observer = new ResizeObserver(
    (e) => (addToCartWidth.value = e[0].contentRect.width)
);

onMounted(() => {
    if (add_to_cart_placeholder.value) {
        observer.observe(add_to_cart_placeholder.value);
    }
});

onUnmounted(() => observer.disconnect());

function onAddtoCart() {
    if (!auth.user) {
        displayToast({
            message: "please Login to continue",
        });
        return;
    }

    //pop animation - add scale and remove it after a short time
    if (!add_to_cart.value) return;
    add_to_cart.value.classList.add("scale-105");

    setTimeout(() => {
        if (!add_to_cart.value) return;
        add_to_cart.value.classList.remove("scale-105");
    }, 200);

    //add item only if there is no instance of it
    if (quantity.value == 0) {
        quantity.value++;
    }

    // addToLocalstorage();
    useAddToLocalCart(product_id, quantity.value);
}
</script>

<template>
    <div class="flex items-center justify-between gap-2 h-11 relative">
        <!-- decrememt -->
        <button
            class="bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 dark:active:bg-emerald-800 transition-colors duration-150 text-base font-semibold h-full aspect-square rounded-lg flex items-center justify-center"
            @click.prevent="DecrementFromCart"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="3"
                stroke="currentColor"
                class="size-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5 12h14"
                />
            </svg>
        </button>

        <!-- add to cart dom ref-->
        <div ref="add_to_cart_placeholder" class="appearance-none w-full"></div>

        <!--actual add to cart -->
        <button
            ref="add_to_cart"
            @click.prevent="onAddtoCart"
            class="bg-emerald-600 z-50 hover:bg-emerald-500 active:bg-emerald-700 text-white transition-all duration-150 h-full w-full text-base font-semibold rounded-lg absolute left-2/4 -translate-x-2/4 top-2/4 -translate-y-2/4 dark:bg-emerald-700 dark:hover:bg-emerald-600 dark:active:bg-emerald-800"
            :style="{
                width: quantity == 0 ? '100%' : `${addToCartWidth}px`,
            }"
        >
            {{ quantity > 0 ? "Added" : "Add To Cart" }}
            {{ quantity > 0 ? quantity : "" }}
        </button>

        <!-- increment -->
        <button
            class="bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 dark:active:bg-emerald-800 transition-colors duration-75 text-base font-semibold h-full aspect-square rounded-lg flex items-center justify-center"
            @click.prevent="IncrementFromCart"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="3"
                stroke="currentColor"
                class="size-4"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 4.5v15m7.5-7.5h-15"
                />
            </svg>
        </button>
    </div>
</template>
