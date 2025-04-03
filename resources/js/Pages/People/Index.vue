<template>

    <AppLayout>
        <Container >
            <div v-if="people.data.length === 0" class="flex pt-40 items-center justify-center text-center space-y-8 flex-col">
                <div class="text-xl font-semibold ">
                    You don't have any people added yet.

                </div>
                <div class="font-mono text-gray-600">
                    You can start adding new people by clicking the Add People Button below

                </div>
                <div class="text-center mb-4 mr-2 flex ">
                    <a :href="route('people.create')" class="inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Add New Person</a>
                </div>
            </div>
            <div v-if="people.data.length !== 0">
                <div class="text-right mb-4 mr-2 flex  justify-between">
                    <div>
                        <a :href="route('people.create')" class="inline-flex items-center px-4 py-4 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">Add New Person</a>
                    </div>
                    <div>
                        <div v-if="!filter">
                            <PrimaryButton @click=" () => filter=true" >Filter</PrimaryButton>
                        </div>
                        <form @submit.prevent="search" class="m-3" v-if="filter">
                            <div>
                                <div class="space-x-2 flex mt-1 ">
                                    <select v-model="searchForm.sort" @select="search">
                                        <option value="id">Latest</option>
                                        <option value="name">Name</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                    <InputLabel for="query" class="sr-only">Search</InputLabel>
                                    <TextInput v-model="searchForm.query" id="query" class="w-full"/>
                                    <SecondaryButton type="submit">Search</SecondaryButton>
                                    <DangerButton v-if="searchForm.query" @click="clearSearch">Reset</DangerButton>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
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
                <div v-if="people.meta.last_page !== 1">
                    <Pagination :meta="props.people.meta"></Pagination>
                </div>
            </div>
        </Container>
    </AppLayout>


</template>
<script setup>

import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import Pagination from "@/Components/Pagination.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps(['people', 'query']);

const page = usePage();

const filter = ref(false);

const searchForm = useForm({
    query: props.query,
    sort: 'id',
    page: 1
});

const search = () => searchForm.get(page.url);


</script>
