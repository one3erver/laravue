<script setup lang="ts">
import VueQrcode from "vue-qrcode";
import { Head, router, useForm } from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import InputError from "@/Components/InputError.vue";

interface checkout {
    submittedContent: {
        invoive_id: number;
        order_list: {
            products: [
                { id: number; price: string; title: string; count: number }
            ];
            totalCost: number;
        };
        wallet_id: string;
    };
}

const { submittedContent } = defineProps<checkout>();

const eth_for_dollar = 0.98;

const copyied = ref(false);

const payying = ref(false);

function copyToClipboard(text: string) {
    navigator.clipboard.writeText(text);

    copyied.value = true;

    setTimeout(() => (copyied.value = false), 1000);
}

const form = useForm({
    user_wallet: "",
});

function onPay() {
    payying.value = true;

    if (form.user_wallet.length < 1) {
        form.errors.user_wallet = "Please Enter You'r Wallet Address";
        payying.value = false;
        return;
    } else {
        form.errors.user_wallet = undefined;
    }

    router.post(
        route("checkouts.checkoutValidate"),
        {
            transaction_id: form.user_wallet,
            invoice_id: submittedContent.invoive_id,
        },
        {
            onSuccess: (e) => {
                console.log(e);
            },
            onError: (e) => {
                console.log(e);
                payying.value = false;
            },
        }
    );
}
</script>

<template>
    <Head title="Checkout" />
    <MainLayout>
        <section class="max-w-[450px] w-full mx-auto text-center py-8 px-4">
            <form
                @submit.prevent="onPay"
                class="w-full flex flex-col items-center py-4 px-6 bg-light_platform dark:bg-dark_platform border-[1px] border-light dark:border-dark overflow-hidden rounded-lg shadow-md"
            >
                <h2 class="mt-4 mb-0">Checkout</h2>

                <div class="w-full h-[1px] bg-gray-500 my-5"></div>

                <!-- price -->
                <div>
                    <!-- price in dollar -->
                    <h3 class="text-emerald-500 mt-0">
                        {{ submittedContent.order_list.totalCost }}$
                    </h3>

                    <!-- price in eth -->
                    <span
                        >=
                        {{
                            submittedContent.order_list.totalCost *
                            eth_for_dollar
                        }}
                        eth</span
                    >
                </div>

                <span class="mb-3 block">Paying with ETH</span>

                <VueQrcode :value="`${submittedContent.wallet_id}`" />

                <!-- copy reciver wallet -->
                <div class="w-full text-left mt-6">
                    <label class="text-base font-semibold" value="wallet"
                        >Reciver Wallet</label
                    >

                    <div class="flex gap-2 items-center justify-between w-full">
                        <input
                            class="w-full bg-gray-300 placeholder:italic border-gray-500 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                            type="text"
                            readonly
                            :value="submittedContent.wallet_id"
                        />

                        <!-- copy button -->
                        <button
                            @click="
                                () =>
                                    copyToClipboard(submittedContent.wallet_id)
                            "
                            :class="[
                                ' h-[40px] aspect-square rounded-lg flex items-center justify-center border-2 transition-all duration-300',
                                copyied
                                    ? 'bg-emerald-500 border-emerald-600 stroke-white scale-110'
                                    : 'bg-gray-300 border-gray-400 stroke-black scale-100',
                            ]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="inherit"
                                class="size-6"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- user wallet -->
                <div class="w-full text-left mt-6">
                    <label class="text-base font-semibold" value="wallet"
                        >You'r Wallet</label
                    >
                    <TextInput
                        placeholder="you'r wallet"
                        v-model="form.user_wallet"
                    />
                    <InputError :message="form.errors.user_wallet" />
                </div>

                <!-- pay -->
                <button
                    :disabled="payying"
                    type="submit"
                    class="w-full py-4 px-6 mt-4 disabled:saturate-50 disabled:brightness-50 bg-emerald-500 hover:bg-emerald-600 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 transition-colors duration-150 rounded-lg font-semibold"
                >
                    Pay
                </button>
            </form>
        </section>
    </MainLayout>
</template>
