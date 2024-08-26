import { Ref } from "vue";

interface displayToast {
    ref: Ref<boolean>;
    content: Ref<string>;
    message: string;
}

export function privateDisplayToast({ ref, content, message }: displayToast) {
    content.value = message;

    if (ref.value === false) {
        return;
    }

    ref.value = false;

    setTimeout(() => {
        ref.value = true;
    }, 2500);
}

interface injectedDisplayToast {
    message: string;
}

export type { injectedDisplayToast as injectedDisplayToastType };
