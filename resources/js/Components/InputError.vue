<script setup lang="ts">
defineProps<{ message?: string }>();
</script>

<template>
    <div class="text-red-400 border-red-400" v-if="message">
        {{ message }}
    </div>
</template>
