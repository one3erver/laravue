<script setup lang="ts">
import { useAddToLocalCart } from "@/util/useCart";
import { ref } from "vue";

interface Product {
    id: number;
    count: number;
    image: string;
    image_thumbnail: string | null;
    price: string;
    title: string;
}

const { id, image, count, price, title } = defineProps<Product>();

const local_count = ref(count);
const delete_dialog = ref(false);

const deleting = ref(false);

function IncrementFromCart() {
    local_count.value += 1;

    useAddToLocalCart(id, local_count.value);
}

function DecrementFromCart() {
    if (local_count.value == 1) {
        delete_dialog.value = true;
        return;
    }
    local_count.value -= 1;

    useAddToLocalCart(id, local_count.value);
}

function DeleteFromCart() {
    deleting.value = true;
    useAddToLocalCart(id, 0, () => {
        delete_dialog.value = false;
    });
}
</script>

<template>
    <div
        class="relative py-4 px-6 w-full flex gap-2 justify-start items-center bg-white odd:bg-dark odd:bg-opacity-5 dark:bg-gray-400 dark:bg-opacity-5 dark:odd:bg-black dark:odd:bg-opacity-25"
    >
        <!-- delete dialog box -->
        <div
            :class="[
                'absolute left-0 top-0 w-full h-full flex flex-col gap-2 items-center justify-start z-50 transition-all scale-100',
                delete_dialog
                    ? 'backdrop-brightness-[0.25] dark:backdrop-brightness-[0.15] backdrop-blur-sm pointer-events-auto opacity-100'
                    : 'backdrop-brightness-100 backdrop-blur-0 pointer-events-none opacity-0',
            ]"
        >
            <h4 class="text-white">Delete From Cart?</h4>
            <div class="space-x-4 mt-auto mb-6">
                <button
                    @click="delete_dialog = false"
                    class="border-2 text-white hover:bg-white hover:text-black font-semibold px-2 py-1 rounded-md transition-all"
                >
                    Cancele
                </button>

                <button
                    @click="DeleteFromCart"
                    :class="[
                        'border-2 hover:bg-red-600 text-red-500 border-red-600 hover:text-white font-semibold px-2 py-1 rounded-md transition-all',
                        deleting
                            ? 'animate-pulse bg-red-600 border-red-600'
                            : '',
                    ]"
                >
                    {{ deleting ? "Deleting.." : "Delete" }}
                </button>
            </div>
        </div>

        <div class="flex gap-2 w-full md:gap-4">
            <img class="h-[80px] md:h-[100px] object-contain" :src="image" />

            <div class="flex flex-col justify-between">
                <h3 class="mt-0 text-base line-clamp-5">
                    {{ title }}
                </h3>
                <span class="block md:hidden font-semibold text-emerald-500"
                    >{{ price }}$</span
                >
            </div>
        </div>

        <div
            class="h-full flex flex-col-reverse md:flex-row justify-between gap-2 md:gap-0 items-center text-center mr-0 lg:mr-4"
        >
            <!-- minus svg / delete svg-->
            <button
                @click="DecrementFromCart"
                :class="[
                    'border-2 flex items-center justify-center p-1 hover:scale-105 transition-all duration-100 rounded-md',
                    local_count <= 1
                        ? 'stroke-red-600 border-red-600 hover:border-red-500 hover:stroke-red-500'
                        : 'border-gray-600 stroke-gray-600 dark:border-white dark:stroke-white',
                ]"
            >
                <!-- minus svg -->
                <svg
                    v-if="local_count > 1"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 12h14"
                    />
                </svg>

                <!-- delete svg -->
                <svg
                    v-else
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                    />
                </svg>
            </button>

            <!-- count  -->
            <span class="font-semibold w-10">
                {{ local_count }}
            </span>

            <!-- plus svg -->
            <button
                @click="IncrementFromCart"
                class="border-2 border-gray-600 stroke-gray-600 dark:border-white dark:stroke-white p-1 hover:scale-105 transition-all duration-100 rounded-md"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-5"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 4.5v15m7.5-7.5h-15"
                    />
                </svg>
            </button>
        </div>

        <span
            class="hidden md:block font-semibold text-emerald-500 ml-2 text-center"
            >{{ price }}$</span
        >
    </div>
</template>
