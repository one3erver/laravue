<script setup lang="ts">
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import { usePage } from "@inertiajs/vue3";
import LoginToast from "@/Components/LoginToast.vue";

const { auth } = usePage().props;

const { hidden } = defineProps<{ hidden?: boolean }>();
</script>

<template>
    <Header v-if="!hidden" :auth="auth" />
    <LoginToast>
        <slot />
    </LoginToast>
    <Footer v-if="!hidden" />
</template>
