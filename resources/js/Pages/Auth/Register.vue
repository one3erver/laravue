<script setup lang="ts">
import InputError from "@/Components/InputError.vue";
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => {
            form.reset("password", "password_confirmation");
        },
    });
};
</script>

<template>
    <Head title="Register" />

    <div class="w-full h-svh flex items-center justify-center px-4 relative">
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
            class="w-full bg-light_platform border-light dark:bg-dark_platform dark:border-dark border-[1px] max-w-[450px] px-5 pt-8 pb-7 mx-auto rounded-lg shadow-md"
        >
            <h2 class="w-full text-center mt-6">Register in Laravue</h2>

            <form @submit.prevent="submit" class="w-full flex flex-col gap-2">
                <!-- name -->
                <div class="flex flex-col space-y-1 mb-1">
                    <label title="Name">Name</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="text"
                        placeholder="name"
                        v-model="form.name"
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <!-- email -->
                <div class="flex flex-col space-y-1 mb-1">
                    <label title="password">Email</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="email"
                        placeholder="email"
                        v-model="form.email"
                    />

                    <InputError :message="form.errors.email" />
                </div>
                <!-- password -->
                <div class="flex flex-col space-y-1 mb-1">
                    <label title="password">Password</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="password"
                        placeholder="password"
                        v-model="form.password"
                    />

                    <InputError :message="form.errors.password" />
                </div>

                <!-- pass confirm -->
                <div class="flex flex-col space-y-1">
                    <label title="password">Password Confirm</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="password"
                        placeholder="password confirm"
                        v-model="form.password_confirmation"
                    />

                    <InputError :message="form.errors.password_confirmation" />
                </div>

                <!-- submit -->
                <button
                    :class="[
                        'w-full py-2 px-4 mt-4 text-white font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700',
                        form.processing ? 'animate-pulse' : '',
                    ]"
                    type="submit"
                    :disabled="form.processing"
                >
                    {{ form.processing ? "Registering..." : "Register" }}
                </button>

                <!-- register -->
                <span class="w-full block text-center mt-1 text-base italic"
                    >Already Registered?
                    <a
                        class="text-sky-500 dark:text-sky-300 underline bold"
                        href="/login"
                        >Login</a
                    ></span
                >
            </form>
        </section>
    </div>
</template>
