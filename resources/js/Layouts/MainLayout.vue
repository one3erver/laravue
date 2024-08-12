<script setup lang="ts">
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
import { AuthTypes } from "@/types";
import { usePage } from "@inertiajs/vue3";

const { auth } = usePage().props;
</script>

<template>
    <Header :auth="auth" />
    <slot />
    <Footer />
</template>
