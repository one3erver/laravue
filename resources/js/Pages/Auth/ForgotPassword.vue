<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import MainLayout from "@/Layouts/MainLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
</script>

<template>
    <MainLayout hidden>
        <div
            class="h-svh w-full flex items-center justify-center px-4 relative"
        >
            <!-- home button -->
            <a class="absolute left-6 top-5" href="/">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="size-7"
                >
                    <path
                        d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z"
                    />
                    <path
                        d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z"
                    />
                </svg>
            </a>

            <section
                class="w-full max-w-[450px] rounded-lg shadow-md border-[1px] bg-light_platform border-light dark:bg-dark_platform dark:border-dark px-4 py-6"
            >
                <Head title="Forgot Password" />

                <h2 class="mt-0 w-full text-center text-xl">Password Reset</h2>

                <div class="mb-4 text-sm">
                    Forgot your password? No problem. Just enter your email
                    address and we will send you a password reset link.
                </div>

                <div
                    v-if="status"
                    class="mb-4 font-medium text-sm text-green-600"
                >
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="flex flex-col gap-2">
                        <label title="email">Email</label>

                        <input
                            class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                            type="email"
                            placeholder="email"
                            v-model="form.email"
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <button
                        :class="[
                            'w-full py-2 px-4 mt-6 text-white font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700',
                            form.processing ? 'animate-pulse' : '',
                        ]"
                        type="submit"
                        :disabled="form.processing"
                    >
                        {{
                            form.processing
                                ? "Sending Email..."
                                : "Send Reset Password"
                        }}
                    </button>
                </form>
            </section>
        </div>
    </MainLayout>
</template>
