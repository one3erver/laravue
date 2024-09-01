<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import CartProduct from "@/Components/product/CartProduct.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { clearCart, useSyncCart } from "@/util/useCart";
import { Head, router, usePage } from "@inertiajs/vue3";
import { onMounted, ref } from "vue";

const { props: AuthProps } = usePage();

const disableCheckout = ref(false);

interface SubmittedContentType {
    submittedContent: {
        products: [
            {
                id: number;
                count: number;
                image: string;
                image_thumbnail: string | null;
                price: string;
                title: string;
                stock: number;
            }
        ];
        totalCost: number;
    };
}

const { submittedContent } = defineProps<SubmittedContentType>();

const clear_cart_dialog = ref(false);
const clear_cart_loading = ref(false);


function CloseClearCartDialog() {
    clear_cart_dialog.value = false;
}
function OpenClearCartDialog() {
    clear_cart_dialog.value = true;
}
function ClearCart() {
    clear_cart_loading.value = true;

    clearCart(
        //on success
        () => {
            window.location.reload();
        },
        //on fail
        () => {
            (clear_cart_loading.value = false),
                (clear_cart_dialog.value = false);
        }
    );
}

const total_items = submittedContent.products.reduce(
    (acum, current) => acum + current.count,
    0
);

const local_item_count = ref(total_items);

function onCheckout() {
    disableCheckout.value = true;

    let local_cart = localStorage.getItem("cart");

    if (!local_cart) {
        //set the current products to localstoage
        localStorage.setItem("cart", JSON.stringify(submittedContent.products));
        local_cart = JSON.stringify(submittedContent.products);
    }

    const local_cart_as_array = JSON.parse(local_cart) as [
        { id: number; count: number }
    ];

    const products_for_checkout = local_cart_as_array.map((item) => {
        return { product_id: item.id, count: item.count };
    });

    useSyncCart(
        //on sucsess
        () => {
            router.post(
                route("orders.store"),
                { cartsList: JSON.stringify(products_for_checkout) },
                {
                    onSuccess: () => {
                        //clear cart in localstorage
                        window.dispatchEvent(
                            new CustomEvent("cartchange", {
                                detail: {
                                    itemsInCart: 0,
                                    storage: JSON.stringify([]),
                                },
                            })
                        );

                        //atlast store a empty cart in localhost
                        localStorage.setItem("cart", JSON.stringify([]));
                    },
                }
            );
        },
        //on fail
        () => (disableCheckout.value = false)
    );
}

onMounted(()=>{
    addEventListener('cartchange',(e)=>local_item_count.value =e.detail.itemsInCart)
})
</script>

<template>
    <Head title="Cart" />

    <MainLayout>
        <section
            class="container mx-auto px-0 md:px-8 mt-4 md:mt-8 flex flex-col items-center justify-start pb-12"
        >
            <h2 class="mt-2">{{ AuthProps.auth.user.name }}'s Cart</h2>

            <hr class="w-4/5" />

            <!-- clear cart dialog box -->
            <div
                @click.prevent="CloseClearCartDialog"
                :class="[
                    'fixed flex items-center justify-center z-50 left-0 top-0 w-full h-full bg-black dark:bg-opacity-50 backdrop-blur-sm transition-all duration-100',
                    clear_cart_dialog
                        ? 'opacity-100 pointer-events-auto'
                        : 'pointer-events-none opacity-0',
                ]"
            >
                <div
                    class="bg-dark_platform px-10 py-6 border-2 rounded-xl border-dark text-center space-y-5"
                >
                    <h4 class="mt-2">Clear You'r Whole Cart?</h4>
                    <div class="space-x-4 mt-auto mb-6">
                        <button
                            :disabled="clear_cart_loading"
                            @click.prevent="CloseClearCartDialog"
                            class="border-2 text-white hover:bg-white hover:text-black font-semibold px-2 py-1 rounded-md transition-all disabled:text-gray-400 disabled:border-gray-400 disabled:bg-transparent"
                        >
                            Cancele
                        </button>

                        <button
                            :disabled="clear_cart_loading"
                            @click.prevent="ClearCart"
                            :class="[
                                'border-2 hover:bg-red-600 text-red-500 border-red-600 hover:text-white font-semibold px-2 py-1 rounded-md transition-all',
                                clear_cart_loading
                                    ? 'animate-pulse text-white bg-red-600 border-red-600'
                                    : '',
                            ]"
                        >
                            {{ clear_cart_loading ? "Clearing.." : "Clear" }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- if there is a product in cart dispay them with checkout -->
            <div
                v-if="submittedContent.products.length > 0"
                class="w-full px-6 gap-6 flex flex-col xl:grid grid-cols-5"
            >
                <!-- cart list -->
                <div
                    class="xl:rounded-lg h-fit border-[1px] border-light dark:border-dark overflow-hidden divide-y-[1px] divide-light dark:divide-gray-700 col-span-3"
                >
                    <!-- list of carts -->
                    <CartProduct
                        :key="product.id"
                        v-for="product in submittedContent.products"
                        v-bind="product"
                    />

                    <!-- clear the whole cart  -->
                    <button
                        @click="OpenClearCartDialog"
                        class="w-full pb-2 pt-3 px-6 flex gap-2 items-center justify-end stroke-red-500 text-red-500"
                    >
                        <!-- trash svg -->
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="inherit"
                            class="size-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                            />
                        </svg>

                        <span>Clear All</span>
                    </button>
                </div>

                <!-- checkout section -->
                <div
                    class="border-0 h-fit xl:border-[1px] border-light bg-light_platform dark:border-dark dark:bg-dark dark:xl:bg-dark_platform rounded-lg col-span-2 flex flex-col items-center justify-start py-6 px-6 gap-4"
                >
                    <div
                        class="w-full flex justify-between items-center text-base sm:text-lg"
                    >
                        <span>Total Items : </span>
                        <span>{{ local_item_count }}</span>
                    </div>
                    <div
                        class="w-full flex justify-between items-center text-base sm:text-lg"
                    >
                        <span>Total Cost : </span>
                        <span class="text-emerald-500 font-semibold"
                            >{{ submittedContent.totalCost }}$
                        </span>
                    </div>

                    <hr class="w-full mt-auto mb-2" />

                    <div class="flex items-center justify-center gap-3">
                        <Checkbox name="remember" />
                        <span>I Agree with Terms and Services</span>
                    </div>

                    <button
                        :disabled="disableCheckout"
                        @click="onCheckout"
                        class="w-full py-4 px-6 mt-4 disabled:saturate-50 disabled:brightness-50 bg-emerald-500 hover:bg-emerald-600 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 transition-colors duration-150 rounded-lg font-semibold"
                    >
                        Checkout
                    </button>
                </div>
            </div>

            <!-- if the products in cart is empty display a message -->
            <div
                v-if="submittedContent.products.length == 0"
                class="w-full flex flex-col items-center justify-start text-center"
            >
                <!-- empty-cart svg -->
                <svg
                    width="311"
                    height="290"
                    viewBox="0 0 311 290"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-[200px] fill-gray-800 dark:fill-gray-100"
                >
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M3.50844 3.63344C5.59478 1.54709 8.42447 0.375 11.375 0.375H31.934C38.0632 0.374091 44.021 2.39787 48.8816 6.13179C53.7421 9.86572 57.2331 15.1007 58.812 21.023L62.2533 33.8835C142.977 32.4128 223.533 41.7771 301.767 61.7257C303.248 62.1051 304.636 62.7858 305.842 63.7253C307.049 64.6648 308.049 65.843 308.779 67.1862C309.51 68.5294 309.956 70.0089 310.089 71.5322C310.223 73.0556 310.041 74.59 309.555 76.0398C297.249 112.689 282.583 148.502 265.648 183.255C264.734 185.128 263.312 186.706 261.544 187.811C259.777 188.915 257.734 189.5 255.65 189.5H89.25C82.3465 189.498 75.6122 191.637 69.975 195.622C64.3377 199.606 60.0748 205.241 57.7737 211.75H278.375C281.326 211.75 284.155 212.922 286.242 215.008C288.328 217.095 289.5 219.924 289.5 222.875C289.5 225.826 288.328 228.655 286.242 230.742C284.155 232.828 281.326 234 278.375 234H44.75C38.609 234 33.625 229.016 33.625 222.875C33.6276 210.56 37.7149 198.593 45.2468 188.849C52.7787 179.105 63.3298 172.135 75.2473 169.03L37.3037 26.7487C36.651 24.316 34.4557 22.625 31.934 22.625H11.375C8.42447 22.625 5.59478 21.4529 3.50844 19.3666C1.4221 17.2802 0.25 14.4505 0.25 11.5C0.25 8.54947 1.4221 5.71978 3.50844 3.63344ZM40.1419 251.642C35.9692 255.815 33.625 261.474 33.625 267.375C33.625 273.276 35.9692 278.935 40.1419 283.108C44.3146 287.281 49.9739 289.625 55.875 289.625C61.7761 289.625 67.4354 287.281 71.6081 283.108C75.7808 278.935 78.125 273.276 78.125 267.375C78.125 261.474 75.7808 255.815 71.6081 251.642C67.4354 247.469 61.7761 245.125 55.875 245.125C49.9739 245.125 44.3146 247.469 40.1419 251.642ZM229.267 251.642C225.094 255.815 222.75 261.474 222.75 267.375C222.75 273.276 225.094 278.935 229.267 283.108C233.44 287.281 239.099 289.625 245 289.625C250.901 289.625 256.56 287.281 260.733 283.108C264.906 278.935 267.25 273.276 267.25 267.375C267.25 261.474 264.906 255.815 260.733 251.642C256.56 247.469 250.901 245.125 245 245.125C239.099 245.125 233.44 247.469 229.267 251.642ZM136 106C146.493 106 155 97.4934 155 87C155 76.5066 146.493 68 136 68C125.507 68 117 76.5066 117 87C117 97.4934 125.507 106 136 106ZM214 106C224.493 106 233 97.4934 233 87C233 76.5066 224.493 68 214 68C203.507 68 195 76.5066 195 87C195 97.4934 203.507 106 214 106ZM110.867 149.514C125.113 131.561 147.905 120 173.504 120C199.103 120 221.894 131.561 236.141 149.514C237.095 150.716 237.277 152.358 236.609 153.74C235.942 155.122 234.542 156 233.008 156H231.723C230.519 156 229.378 155.457 228.619 154.522C216.066 139.071 196.108 129 173.504 129C150.9 129 130.942 139.071 118.389 154.522C117.629 155.457 116.489 156 115.284 156H114C112.465 156 111.066 155.122 110.398 153.74C109.731 152.358 109.913 150.716 110.867 149.514Z"
                        fill="inherit"
                    />
                </svg>

                <h3 class="text-2xl">You'r Cart is Empty</h3>
                <p>
                    Add some
                    <a
                        class="underline-offset-2 text-sky-500"
                        style="text-decoration: underline"
                        href="/"
                        >Products</a
                    >
                    then comeback
                </p>
            </div>
        </section>
    </MainLayout>
</template>
