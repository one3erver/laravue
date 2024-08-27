<script setup lang="ts">
import { defineProps, ref } from 'vue';
import {router} from "@inertiajs/vue3";

interface Order {
    id: number;
    user: {
        name: string;
    };
    total_cost: string;
    order_list: Array<{
        title: string;
        count: number;
        price: number;
    }>;
    tracking_code: string | null;
    created_at: string;
    payment: {
        status: string;
        paid_at: string;
        transaction_id: string;
    };
}

const props = defineProps<{ orders: Order[] }>();

const dropdownOpen = ref<number | null>(null);

const toggleDropdown = (orderId: number) => {
    dropdownOpen.value = dropdownOpen.value === orderId ? null : orderId;
};


const copyied = ref(false)
function copyToClipboard(text: string) {
    navigator.clipboard.writeText(text);

    copyied.value = true;

    setTimeout(() => (copyied.value = false), 1000);
}
const redirectToCheckout = (orderId: number) => {
    router.post(route('checkouts.show'), { order_id: orderId });
};



</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-semibold mb-4">Your Orders</h2>
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Cost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                        <tr v-for="order in orders" :key="order.id">
                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                :class="{
                                    'text-green-500': order.tracking_code?.length > 0 || order.tracking_code,
                                    'text-red-500': order.tracking_code?.length <= 0 || !order.tracking_code
                                }">
                                {{ order.tracking_code?.length > 0 ? 'Paid' : 'Unpaid' }}
                            </td>
                            <!-- Tracking Code -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <span v-if="order.tracking_code?.length > 0">{{ order.tracking_code || 'N/A' }}</span>

                                <button
                                    v-if="order.tracking_code?.length > 0" @click="
                                () =>
                                    copyToClipboard(order.tracking_code)
                            "
                                    :class="[
                                ' h-[30px] aspect-square rounded-lg d-flex m-2 border-2 transition-all duration-300',
                                copyied
                                    ? 'bg-emerald-500 border-emerald-600 stroke-white scale-110'
                                    : 'bg-gray-300 border-gray-400 stroke-black scale-100',
                            ]"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="2"
                                        stroke="inherit"
                                        class="size-6"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184"
                                        />
                                    </svg>
                                </button>
                                <!--                                <button v-if="order.tracking_code?.length > 0" @click="copyToClipboard(order.tracking_code || '')" class="bg-blue-400 dark:bg-blue-600 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Copy</button>-->
                            </td>
                            <!-- Total Cost -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ order.total_cost }}
                            </td>
                            <!-- Paid At -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ order.payment?.paid_at ? new Date(order.payment.paid_at).toLocaleDateString() : 'N/A' }}
                            </td>
                            <!-- Details Dropdown -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300 flex flex-col space-y-2">
                                <button @click="toggleDropdown(order.id)" class="rounded-md bg-blue-300 hover:bg-blue-200 px-3 py-2 dark:hover:bg-blue-600">
                                    {{ dropdownOpen === order.id ? 'Hide Details' : 'Show Details' }}
                                </button>
                                <div v-if="dropdownOpen === order.id" class="mt-2 p-2 border border-gray-200 bg-gray-50 rounded-md dark:border-gray-600 dark:bg-gray-900">
                                    <ul>
                                        <li v-for="(product, index) in order.order_list" :key="index">
                                            {{ product.title }} - {{ product.count }} x {{ product.price }}
                                        </li>
                                        <li class="mt-2">Transaction ID: {{ order.payment?.transaction_id || 'N/A' }}</li>
                                    </ul>
                                </div>

                                    <button
                                        v-if="!order.tracking_code || order.tracking_code.length === 0"
                                        @click="redirectToCheckout(order.id)"
                                        class="bg-red-400 hover:bg-green-600 text-white font-bold py-1 px-3 rounded pos">
                                        Pay Now
                                    </button>

                            </td>
                            <!--  payment-->

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
