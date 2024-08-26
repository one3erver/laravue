<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import PasswordInput from "@/Components/PasswordInput.vue";
import MainLayout from "@/Layouts/MainLayout.vue";

const { status, canResetPassword } = defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const loading = ref(false);

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

function onSubmit() {
    loading.value = true;

    form.post(route("login"), {
        onFinish: () => {
            form.reset("password");
            loading.value = false;
        },
        onError: (e) => {
            loading.value = false;
        },
    });
}
</script>

<template>
    <Head title="Log in" />

    <MainLayout hidden>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <div
            class="w-full h-svh flex items-center justify-center px-4 relative"
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
                class="w-full space-y-6 bg-light_platform border-light dark:bg-dark_platform dark:border-dark border-[1px] max-w-[450px] px-5 pt-8 pb-7 mx-auto rounded-lg shadow-md"
            >
                <h2 class="w-full text-center mt-6">Login to Laravue</h2>

                <form @submit.prevent="onSubmit" class="w-full">
                    <!-- email -->
                    <div class="flex flex-col gap-1 mb-6">
                        <label title="email">Email</label>
                        <TextInput
                            :placeholder="'email'"
                            v-model="form.email"
                        />

                        <!-- error -->
                        <InputError :message="form.errors.email" />
                    </div>

                    <!-- password -->
                    <div class="flex flex-col gap-1 mb-6">
                        <label title="password">Password</label>

                        <PasswordInput v-model="form.password" />

                        <a
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="underline-offset-4 mt-2 text-sm text-sky-500 dark:text-sky-300"
                            style="text-decoration: underline"
                        >
                            Forgot your password?
                        </a>

                        <!-- error -->
                        <InputError :message="form.errors.password" />
                    </div>

                    <!-- remember me -->
                    <div class="mb-2 flex items-center gap-1">
                        <Checkbox
                            name="remember"
                            v-model:checked="form.remember"
                        />
                        <label title="remember">Remember Me</label>
                    </div>

                    <button
                        :class="[
                            'w-full py-2 px-4 mt-4 text-white font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700',
                            form.processing ? 'animate-pulse' : '',
                        ]"
                        type="submit"
                        :disabled="form.processing"
                    >
                        {{ loading ? "Logging in..." : "Login" }}
                    </button>

                    <!-- register -->
                    <span class="w-full block text-center mt-6 text-base italic"
                        >Dont't have an Account?
                        <a
                            class="text-sky-500 dark:text-sky-300 underline bold"
                            href="/register"
                            style="text-decoration: underline"
                            >Register</a
                        ></span
                    >
                </form>
            </section>
        </div>
    </MainLayout>
</template>
