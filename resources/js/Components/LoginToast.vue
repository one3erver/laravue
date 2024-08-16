<script setup lang="ts">
import { ref } from "vue";
import { provide } from "vue";

const isHidden = ref(true);

const toast_duration = 4000;

function displayToast() {
    isHidden.value = false;

    setTimeout(() => {
        isHidden.value = true;
    }, toast_duration);
}

provide("displayToast", displayToast);
</script>

<template>
    <slot />
    <div
        :class="[
            'fixed overflow-hidden transition-all duration-150 z-[9999] bottom-10 right-8 backdrop-blur-sm bg-opacity-80 bg-dark font-semibold rounded-xl border-[1px] border-light dark:border-dark',
            isHidden ? 'translate-x-[200px]' : 'translate-x-0',
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
            <p class="my-0">
                Please
                <a
                    class="underline-offset-2 text-sky-500 dark:text-sky-400"
                    style="text-decoration: underline"
                    href="/login"
                    >Login</a
                >
                First
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
