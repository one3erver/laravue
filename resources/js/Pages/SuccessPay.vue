<script setup lang="ts">
import MainLayout from "@/Layouts/MainLayout.vue";

const {submittedContent} = defineProps(['submittedContent'])

const tracking_code = "test";
</script>

<template>
    <Head title="Successful Payment" />
    <MainLayout>
        <section class="max-w-[500px] w-full mx-auto text-center py-8 px-4">
            <div
                class="w-full flex flex-col items-center py-4 px-6 bg-light_platform dark:bg-dark_platform border-[1px] border-light dark:border-dark overflow-hidden rounded-lg shadow-md"
            >
                <h2 class="mt-4 mb-0">Payment was Successful</h2>

                <div class="w-full h-[1px] bg-gray-500 my-5"></div>

                <p class="mb-2">
                    this is you'r tracking code :
                    <span class="px-2 py-1 bg-gray-600 text-white rounded-md">{{
                        submittedContent.tracking_code
                    }}</span>
                </p>

                <p class="mt-2 mb-4">
                    you can always access it in you'r
                    <a
                        class="text-sky-500 dark:text-sky-400 font-semibold mt-2 underline-offset-2"
                        style="text-decoration: underline"
                        href="/dashboard"
                        >Dashboard</a
                    >
                </p>

                <div class="flex flex-col gap-1">
                    <a
                        class="bg-emerald-600 hover:bg-emerald-500 py-3 px-3 rounded-lg transition-all duration-150"
                        href="/"
                        >Go Home</a
                    >
                </div>
            </div>
        </section>
    </MainLayout>
</template>
