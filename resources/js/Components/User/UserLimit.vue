<template>
    <div>
        <div class="flex flex-row justify-between">
            <div>
                <h1 class="font-bold text-lg uppercase font-serif " :class=" edit ? 'text-red-500': 'text-primary'">{{limit.currency}}</h1>
                <h1>User Limit: {{limit.limit}}</h1>
                <h1>Active Loans: {{limit.usedAmount}}</h1>
            </div>
            <div>
                <SecondaryButton @click="()=> edit= true">
                    Edit
                </SecondaryButton>
            </div>

        </div>
        <div class="flex justify-between mb-1">
            <span class="text-base font-medium text-blue-700 dark:text-white">Limit: {{limit.limit}}</span>
            <span class="text-sm font-medium text-blue-700 dark:text-white">{{percentage}}%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4 dark:bg-gray-700">
            <div class="bg-blue-600 h-4 rounded-full" :style="{width: percentage}"></div>
        </div>
        <div class="flex justify-between mb-1">
            <span class="text-base font-medium text-blue-700 dark:text-white"></span>
            <span class="text-sm font-medium text-blue-700 dark:text-white">Used Amount: {{limit.usedAmount}}</span>
        </div>
    </div>

</template>


<script setup>

import axios from "axios";
import {computed, ref} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

const edit = ref(false);

const props = defineProps(['limit']);

const percentage = computed(() => {
    return Math.floor((props.limit.usedAmount / props.limit.limit) * 100) + '%';
})

</script>
