<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

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

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
        {{ status }}
    </div>

    <div class="w-full h-svh flex items-center justify-center px-4">
        <section
            class="w-full space-y-6 bg-light_platform border-light dark:bg-dark_platform dark:border-dark border-[1px] max-w-[450px] px-5 pt-8 pb-7 mx-auto rounded-lg shadow-md"
        >
            <h2 class="w-full text-center mt-6">Login to Laravue</h2>

            <form @submit.prevent="onSubmit" class="w-full">
                <!-- email -->
                <div class="flex flex-col space-y-1 mb-6">
                    <label title="password">Email</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="email"
                        placeholder="email"
                        v-model="form.email"
                    />

                    <!-- error -->
                    <div
                        class="text-red-400 border-red-400"
                        v-if="form.errors.email"
                    >
                        {{ form.errors.email }}
                    </div>
                </div>

                <!-- password -->
                <div class="flex flex-col space-y-1 mb-6">
                    <label title="password">Password</label>
                    <input
                        class="border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                        type="password"
                        placeholder="password"
                        v-model="form.password"
                    />

                    <!-- error -->
                    <div
                        class="text-red-400 border-red-400"
                        v-if="form.errors.password"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>

                <!-- remember me -->
                <div class="mb-2 flex items-center gap-1">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <label title="remember">Remember Me</label>
                </div>

                <button
                    class="w-full py-2 px-4 mt-6 text-white font-semibold rounded-lg bg-emerald-600 hover:bg-emerald-500 active:bg-emerald-700"
                    type="submit"
                >
                    {{ loading ? "Logging in..." : "Login" }}
                </button>

                <!-- register -->
                <span class="w-full block text-center mt-6 text-base italic"
                    >Dont't have an Account?
                    <a
                        class="text-sky-500 dark:text-sky-300 underline bold"
                        href="/register"
                        >Register</a
                    ></span
                >
            </form>
        </section>
    </div>
</template>
