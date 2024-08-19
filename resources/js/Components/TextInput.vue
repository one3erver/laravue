<script setup lang="ts">
import { onMounted, ref } from "vue";

const { placeholder } = defineProps(["placeholder"]);

const model = defineModel<string>({
    required: true,
});

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });
</script>

<template>
    <input
        class="w-full placeholder:text-gray-400 placeholder:italic border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
        type="text"
        :placeholder="placeholder"
        v-model="model"
        ref="input"
        autocomplete="current-password"
    />
</template>
