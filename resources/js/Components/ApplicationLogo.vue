<script setup lang="ts">
import {usePage} from "@inertiajs/vue3";
import {PageProps} from "@/types";

const {
    props: {setting},
} = usePage<PageProps>();
</script>
<template>

    <a class="size-[32px]" href="/">
        <img
            class="size-full object-contain"
            :src="setting.logo"
            alt="logo"
        />
    </a>
</template>

 
