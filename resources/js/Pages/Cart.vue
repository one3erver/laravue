<script setup lang="ts">
import CartProduct from "@/Components/product/CartProduct.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, usePage } from "@inertiajs/vue3";

const { props: AuthProps } = usePage();

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
            }
        ];
        totalCost: number;
    };
}

const { submittedContent } = defineProps<SubmittedContentType>();
</script>

<template>
    <Head title="Cart" />

    <MainLayout>
        <section
            class="container mx-auto px-0 md:px-8 mt-4 md:mt-8 flex flex-col items-center justify-start pb-12"
        >
            <h2 class="mt-2">{{ AuthProps.auth.user.name }}'s Cart</h2>

            <hr class="w-4/5" />

            <div class="w-full px-6 gap-6 flex flex-col xl:grid grid-cols-5">
                <!-- cart list -->
                <div
                    class="xl:rounded-lg h-fit border-[1px] border-light dark:border-dark overflow-hidden divide-y-[1px] divide-light dark:divide-gray-700 col-span-3"
                >
                    <CartProduct
                        v-for="product in submittedContent.products"
                        v-bind="product"
                    />
                </div>

                <!-- checkout section -->
                <div
                    class="border-0 h-fit xl:border-[1px] border-light bg-light_platform dark:border-dark dark:bg-dark dark:xl:bg-dark_platform rounded-lg col-span-2 flex flex-col items-center justify-start py-6 px-6 gap-4"
                >
                    <div
                        class="w-full flex justify-between items-center text-base sm:text-lg"
                    >
                        <span>Total Quantitiy : </span>
                        <span>{{ submittedContent.products.length }}</span>
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
    </MainLayout>
</template>
