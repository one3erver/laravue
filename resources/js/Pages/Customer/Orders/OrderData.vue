<script setup lang="ts">
import { defineProps, ref } from 'vue';

interface Order {
    id: number;
    user: {
        name: string;
    };
    total_cost: string;
    order_list: Array<{ // Ensure this is defined as an array of objects
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

const dropdownOpen = ref  <number | null>(null); // Initialize dropdownOpen as null

const toggleDropdown = (orderId: number) => {
    dropdownOpen.value = dropdownOpen.value === orderId ? null : orderId; // Toggle dropdownOpen
};

const copyToClipboard = (text: string) => {
    navigator.clipboard.writeText(text).then(() => {
        alert('Tracking code copied to clipboard!');
    });
};

console.log(props.orders); // Log orders to verify data structure
// const order_as_json = JSON.parse(props.orders[0].order_list)
// console.log(order_as_json)
</script>

<template>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-xl font-semibold mb-4">Your Orders</h2>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tracking Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Cost</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paid At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="order in orders" :key="order.id">
                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium"
                                :class="{
                                    'text-green-500': order.payment?.status === 'P',
                                    'text-red-500': order.payment?.status === 'U'
                                }">
                                {{ order.payment?.status === 'P' ? 'Paid' : 'Unpaid' }}
                            </td>
                            <!-- Tracking Code -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <sapn v-if="order.tracking_code?.length>0 ">{{ order.tracking_code || 'N/A' }}</sapn>

                                <button v-if="order.tracking_code?.length>0 " @click="copyToClipboard(order.tracking_code || '')" class="bg-blue-400 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded">Copy</button>
                            </td>
                            <!-- Total Cost -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ order.total_cost }}
                            </td>
                            <!-- Paid At -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ order.payment?.paid_at ? new Date(order.payment.paid_at).toLocaleDateString() : 'N/A' }}
                            </td>
                            <!-- Details Dropdown -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <button @click="toggleDropdown(order.id)" class=" rounded-md bg-blue-300 hover:bg-blue-200 px-3 py-2">
                                    {{ dropdownOpen === order.id ? 'Hide Details' : 'Show Details' }}
                                </button>
                                <div v-if="dropdownOpen" class="mt-2 p-2 border border-gray-200 bg-gray-50 rounded-md">
                                    <ul>
                                        <li v-for="(product, index) in order.order_list" :key="index">
                                            {{ product.title }} - {{ product.count }} x {{ product.price }}
                                        </li>
                                        <li class="mt-2">Transaction ID: {{ order.payment?.transaction_id || 'N/A' }}</li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
