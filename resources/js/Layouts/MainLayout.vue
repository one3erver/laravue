<script setup lang="ts">
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import { usePage } from "@inertiajs/vue3";
import Toast from "@/Components/Toast.vue";

const { auth } = usePage().props;

const { hidden } = defineProps<{ hidden?: boolean }>();
</script>

<template>
    <Header :hidden="hidden" :auth="auth" />
    <Toast>
        <slot />
    </Toast>
    <Footer v-if="!hidden" />
</template>
