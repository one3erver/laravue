<script setup lang="ts">
import { onMounted, ref, watch } from "vue";

const model = defineModel<string>({ required: true });

const input = ref<HTMLInputElement | null>(null);

onMounted(() => {
    if (input.value?.hasAttribute("autofocus")) {
        input.value?.focus();
    }
});

defineExpose({ focus: () => input.value?.focus() });

const visiable = ref(false);

function toggleEye() {
    visiable.value = !visiable.value;
}

watch(visiable, () => {
    if (input.value) {
        if (visiable.value === true) {
            input.value.type = "text";
        } else {
            input.value.type = "password";
        }
    }
});
</script>

<template>
    <div class="relative w-full">
        <input
            class="w-full placeholder:text-gray-400 placeholder:italic border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
            type="password"
            placeholder="password"
            v-model="model"
            ref="input"
            autocomplete="current-password"
        />

        <!-- visiablity toggle -->
        <div
            class="absolute top-2/4 flex items-center justify-center -translate-y-2/4 right-3 z-10"
        >
            <!-- visiable eye -->
            <button
                v-if="!visiable"
                @click="toggleEye"
                type="button"
                class="stroke-black"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"
                    />
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                    />
                </svg>
            </button>

            <!-- invisiable eye -->
            <button
                v-else
                @click="toggleEye"
                type="button"
                class="stroke-black"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke-width="1.5"
                    stroke="inherit"
                    class="size-6"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
