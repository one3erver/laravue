<script setup lang="ts">
import { Ref, ref } from "vue";
import { provide } from "vue";
import { privateDisplayToast } from "@/util/useToast";

const isHidden = ref(true);
const toastContent = ref("");

const toast_duration = 2500;

interface displayToastInterface {
    content: Ref<string>;
    message: string;
}

provide("displayToast", ({ message }: displayToastInterface) =>
    privateDisplayToast({
        ref: isHidden,
        content: toastContent,
        message: message,
    })
);
</script>

<template>
    <slot />
    <div
        :class="[
            'fixed overflow-hidden transition-all duration-150 max-w-[450px] z-[9999] bottom-10 right-8 backdrop-blur-sm bg-opacity-80 bg-dark font-semibold rounded-xl border-[1px] border-light dark:border-dark',
            isHidden ? `translate-x-[500px]` : 'translate-x-0',
        ]"
    >
        <div class="w-full h-full relative px-5 py-2">
            <!-- toast timeline -->
            <div
                :class="[
                    'absolute right-0 top-0 w-0 h-1 bg-emerald-500',
                    !isHidden ? 'timeline-animation' : '',
                ]"
            ></div>

            <!-- toast content -->
            <p class="my-0 text-[#f1f1f1]">
                {{ toastContent }}
            </p>
        </div>
    </div>
</template>

<style scoped>
.timeline-animation {
    animation: timeline linear forwards v-bind(`${toast_duration}ms`);
}

@keyframes timeline {
    from {
        width: 100%;
    }

    to {
        width: 0%;
    }
}
</style>
