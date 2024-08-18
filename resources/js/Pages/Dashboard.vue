<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import OrderData from "@/Pages/Customer/Orders/OrderData.vue";

const props = defineProps<{
    orders: Array<{
        id: number;
        user: {
            name: string;
        };
        order_list: string;
        total_cost: number;
        tracking_code: string;
    }>
}>();

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
        <div class="p-8 bg-gray-100 min-h-screen">
            <!-- Ensure orders are being passed to OrderData -->
            <OrderData :orders="props.orders"/>
        </div>
    </AuthenticatedLayout>
</template>
