<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import {usePage} from "@inertiajs/vue3";
const page = usePage();


const props = defineProps(['people', 'summaries', 'series'])

const kpiCards =  [
    { label: "Consumer Count" , value: props.summaries.total_people, suffix:'',  click_route:'/people'},
    { label: "Bahts", value: props.summaries.baht_loan , suffix: 'THB', click_route: false},
    { label: "Kyats", value: props.summaries.kyat_loan , suffix: 'MMK', click_route: false},
]


</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 bg-gray-50 ">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <a
                            v-for="(item, index) in kpiCards"
                            :key="index"
                            :href="item.click_route ? item.click_route: '#'"
                            class="bg-white p-4 rounded-2xl shadow-md flex flex-col gap-2 hover:shadow-lg transition"
                        >
                            <h2 class="text-xl text-gray-900 font-bold">{{ item.label }}</h2>
                            <p class="text-2xl font-extrabold  text-right"><span class="text-green-500">{{ item.value }} </span>
                                {{ item.suffix }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>
