<script setup lang="ts">
import { usePage } from "@inertiajs/vue3";
import { PageProps } from "@/types";

// const {
//     props: { setting },
// } = usePage<PageProps>();

const t = usePage();

console.log(t);
</script>
<template>
    <a class="size-[32px]" href="/">
        <img
            class="size-full object-contain"
            :src="'/images/admin/settings/' + setting.logo"
            alt="logo"
        />
    </a>
</template>
