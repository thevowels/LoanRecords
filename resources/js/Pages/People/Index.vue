<template>

    <AppLayout>
        <Container >
            Hello
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-y-4 gap-x-4 ">
                <div v-for="consumer in people.data" class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 min-w-full  ">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center ">{{consumer.name}}</h5>
                    <p class="font-normal text-gray-700 dark:text-gray-400">{{consumer.city}}</p>
                    <p class="font-mono text-gray-800 ">
                        <span>Amount : </span>
                        {{consumer.amount}} KS
                    </p>
                    <div class="text-center">
                        <a :href="route('people.show', consumer)" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Details</a>
                    </div>
                </div>
            </div>
            <Pagination :meta="props.people.meta"></Pagination>
        </Container>
    </AppLayout>


</template>
<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";


const props = defineProps(['people']);

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
</script>
