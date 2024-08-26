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

const copyied = ref(false);

const payying = ref(false);

const paymentErr = ref("");

function copyToClipboard(text: string) {
    navigator.clipboard.writeText(text);

    copyied.value = true;

    setTimeout(() => (copyied.value = false), 1000);
}

const items_being_bought = submittedContent.order_list.products.reduce(
    (acum, currentVal) => (acum += currentVal.count),
    0
);

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
        route("checkouts.validate"),
        {
            transaction_id: form.user_wallet,
            invoice_id: submittedContent.invoice_id,
        },
        {
            onSuccess: (e) => {},
            onCancel: () => {
                console.log("camc");
            },
            onError: (err) => {
                payying.value = false;
                // console.log(err);

                // paymentErr.value=err;
            },
        }
    );
}

const orderDialogOpen = ref(false);
const cancleDialogOpen = ref(false);

function toggleOrderDialog() {
    orderDialogOpen.value = !orderDialogOpen.value;
}
function toggleCancleDialog() {
    cancleDialogOpen.value = !cancleDialogOpen.value;
}
</script>

<template>
    <Head title="Checkout" />
    <MainLayout>
        <!-- order dialog box -->
        <div
            @click="toggleOrderDialog"
            :class="[
                'absolute flex items-center justify-center left-0 top-0 size-full z-50 bg-black bg-opacity-40 backdrop-blur-sm transition-all duration-300',
                orderDialogOpen
                    ? 'pointer-events-auto opacity-100'
                    : 'pointer-events-none opacity-0',
            ]"
        >
            <div
                @click.stop
                class="px-5 py-4 bg-light_platform border-light border-[1px] rounded-lg dark:bg-dark_platform dark:border-dark"
            >
                <h3 class="my-2 text-center">Items in Order</h3>

                <hr class="my-5" />

                <div class="">
                    <!-- list -->
                    <div
                        class="w-full flex justify-between items-center gap-5"
                        v-for="item in submittedContent.order_list.products"
                    >
                        <!-- title -->
                        <h4 class="my-3">{{ item.title }}</h4>

                        <div>
                            <!-- count -->
                            <span class="font-semibold text-sm"
                                >{{ item.count }} x
                            </span>
                            <!-- price -->
                            <span class="font-semibold text-emerald-500"
                                >{{ parseFloat(item.price) * item.count }}$
                            </span>
                        </div>
                    </div>
                </div>
                <button
                    @click.prevent="toggleOrderDialog"
                    class="w-full border-2 font-semibold py-1 px-2 mt-2 border-red-600 text-red-500 rounded-lg hover:bg-red-600 hover:text-white"
                >
                    Close
                </button>
            </div>
        </div>

        <!-- cancle dialog box -->
        <div
            @click="toggleCancleDialog"
            :class="[
                'absolute flex items-center justify-center left-0 top-0 size-full z-50 bg-black bg-opacity-40 backdrop-blur-sm transition-all duration-300',
                cancleDialogOpen
                    ? 'pointer-events-auto opacity-100'
                    : 'pointer-events-none opacity-0',
            ]"
        >
            <div
                @click.stop
                class="px-5 py-4 bg-light_platform border-light border-[1px] rounded-lg dark:bg-dark_platform dark:border-dark"
            >
                <h3 class="my-2 text-lg text-center">Cancle you'r Order?</h3>

                <hr class="my-5" />

                <div class="flex gap-2 items-center justify-center">
                    <button
                        @click.prevent="toggleCancleDialog"
                        class="w-full border-2 font-semibold py-1 px-2 mt-2 border-red-600 text-red-500 rounded-lg hover:bg-red-600 hover:text-white"
                    >
                        No
                    </button>
                    <button
                        @click.prevent="() => router.visit('/')"
                        class="w-full border-2 border-emerald-500 font-semibold py-1 px-2 mt-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-500"
                    >
                        Yes
                    </button>
                </div>
            </div>
        </div>

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
                    <h3 class="text-emerald-500 mt-0 mb-2">
                        {{ submittedContent.order_list.totalCost }}
                        <span class="text-base">USDT</span>
                    </h3>

                    <!-- tether logo and detail -->
                    <div
                        class="mb-0 flex gap-2 items-center justify-center w-full"
                    >
                        <span>(trc20)</span>
                        <img class="size-[24px]" src="/tether-usdt.svg" />
                    </div>
                </div>

                <span class="mb-3 block">Paying with Tether</span>

                <VueQrcode :value="`${submittedContent.wallet_id}`" />

                <!-- products that are being bought -->
                <div
                    class="w-full flex justify-between items-center mt-5 border-[1px] px-2 py-2 rounded-xl border-light dark:border-dark"
                >
                    <span>{{ items_being_bought }} Items in Order</span>

                    <button
                        @click="toggleOrderDialog"
                        type="button"
                        class="px-3 py-1 border-b-2 transition-all duration-150 border-sky-500 text-sky-500 dark:text-sky-400 hover:bg-sky-500 hover:text-white hover:rounded-lg"
                    >
                        View Order
                    </button>
                </div>

                <!-- copy reciver wallet -->
                <div class="w-full text-left mt-6">
                    <label class="text-base font-semibold" value="wallet"
                        >Reciver Wallet</label
                    >

                    <div class="flex gap-2 items-center justify-between w-full">
                        <input
                            class="w-full bg-gray-100 dark:bg-gray-300 placeholder:italic border-gray-300 dark:border-gray-500 focus:border-emerald-500 focus:ring-emerald-500 rounded-md shadow-sm text-black"
                            type="text"
                            readonly
                            :value="submittedContent.wallet_id"
                        />

                        <!-- copy button -->
                        <button
                            type="button"
                            @click="
                                () =>
                                    copyToClipboard(submittedContent.wallet_id)
                            "
                            :class="[
                                ' h-[40px] aspect-square rounded-lg flex items-center justify-center border-2 transition-all duration-300',
                                copyied
                                    ? 'bg-emerald-500 border-emerald-600 stroke-white scale-110'
                                    : 'bg-gray-100 border-gray-300 dark:bg-gray-300 dark:border-gray-400 stroke-black scale-100',
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
                        >You'r Hash Code</label
                    >
                    <TextInput
                        class="shadow-md"
                        placeholder="you'r hash code"
                        v-model="form.user_wallet"
                    />
                    <InputError :message="form.errors.user_wallet" />
                </div>

                <div
                    class="flex flex-col gap-2 items-center justify-between w-full"
                >
                    <!-- pay -->
                    <button
                        :disabled="payying"
                        type="submit"
                        class="w-full px-6 py-2 mt-4 disabled:saturate-50 disabled:brightness-50 bg-emerald-500 hover:bg-emerald-600 text-white dark:bg-emerald-700 dark:hover:bg-emerald-600 transition-colors duration-150 rounded-lg font-semibold"
                    >
                        Pay
                    </button>
                    <InputError :message="paymentErr" />

                    <!-- cancel -->
                    <button
                        :disabled="payying"
                        type="button"
                        class="w-full px-6 py-2 flex items-center justify-center bg-red-500 text-red-600 hover:text-white disabled:saturate-50 disabled:brightness-50 border-[1px] border-red-600 bg-transparent hover:bg-red-600 transition-colors duration-150 rounded-lg font-semibold"
                        @click="toggleCancleDialog"
                    >
                        Cancle
                    </button>
                </div>
            </form>
        </section>
    </MainLayout>
</template>
