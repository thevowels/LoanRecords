<template>
    <div>
        <div class="flex flex-row justify-between">
            <div>
                <h1 class="font-bold text-lg uppercase font-serif " :class=" edit ? 'text-red-500': 'text-primary'">{{limit.currency}}</h1>
                <h1 v-if="!edit">User Limit: {{limit.limit}}</h1>
                <div v-if="edit">
                    <form @submit.prevent="updateLimit">
                        <div>
                            <InputLabel for="limit" class="text-lg" value="User Limit:"></InputLabel>
                            <TextInput  class="mr-8" v-model="form.limit"> </TextInput>
                            <InputError :message="form.errors.limit" ></InputError>
                            <PrimaryButton> Update</PrimaryButton>
                        </div>
                    </form>
                </div>

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
            <span class="text-sm font-medium text-blue-700 dark:text-white">Used : {{percentage}}</span>
        </div>
        <div class="w-full bg-blue-600 rounded-full h-4 dark:bg-gray-700">
            <div class="bg-amber-600 h-4 rounded-full" :style="{width: percentage}"></div>
        </div>
        <div class="flex justify-between mb-1">
            <span class="text-base font-medium text-blue-700 dark:text-white"></span>
            <span class="text-sm font-medium text-amber-600 dark:text-white">Used : {{limit.usedAmount}} {{limit.currency}}</span>
        </div>
    </div>

</template>


<script setup>

import axios from "axios";
import {computed, ref} from "vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {useForm} from "@inertiajs/vue3";
import {route} from "ziggy-js";

const edit = ref(false);

const props = defineProps(['limit']);
const form =useForm({
    'limit': props.limit.limit,
})

const updateLimit = () => {
        form.put(route('admin.users.updateLimit', [props.limit.user_id, props.limit.id]),{
            onSuccess: data => {
                form.reset();
                edit.value= false;
            }
        });
}

const percentage = computed(() => {
    return Math.floor((props.limit.usedAmount / props.limit.limit) * 100) + '%';
})

</script>
