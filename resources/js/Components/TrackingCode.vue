<script setup lang="ts">
import { injectedDisplayToastType } from '@/util/useToast';
import { inject } from 'vue';


const {tracking_code} = defineProps<{tracking_code:string}>()

const displayToast = inject("displayToast") as ({
    message,
}: injectedDisplayToastType) => void;

function copyTracingCode(){
    navigator.clipboard.writeText(tracking_code);

    if(displayToast){
        displayToast({message:"copied to clipboard"})
    }
}

</script>


<template>
    <span
        @click="copyTracingCode"
     class="px-2 py-1 bg-gray-600 text-white rounded-md cursor-pointer">{{
                        tracking_code
                    }}</span>
</template>