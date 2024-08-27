<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import OrderData from "@/Pages/Customer/Orders/OrderData.vue";
import { ref, onMounted } from 'vue';

const props = defineProps<{
    orders: Array<{
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
        tracking_code: string;
        payment: {
            status: string;
            paid_at: string;
            transaction_id: string;
        } | null;
    }>
}>();

const showMessage = ref(true);

onMounted(() => {
    setTimeout(() => {
        showMessage.value = false;
    }, 10000);
});

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
                    <div v-if="showMessage" class="p-6 text-gray-900">You're logged in!</div>
                </div>
            </div>
        </div>
        <div class="p-8 bg-gray-100 min-h-screen dark:bg-gray-900">
            <!-- Ensure orders are being passed to OrderData -->
            <OrderData :orders="props.orders"/>
        </div>
    </AuthenticatedLayout>
</template>
