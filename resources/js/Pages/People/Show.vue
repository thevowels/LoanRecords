<template>
    <AppLayout :title="consumer.name">
        <Container>

            <div class="container">
                <div class="text-right max-w-5xl mx-auto my-3">
                    <PrimaryButton @click="goBack">Back</PrimaryButton>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 ">
                    <div class="mx-auto">
                        <img :src="consumer.id_url" class="w-16 sm:w-fit" />
                    </div>
                    <div class="space-y-2 mx-auto">
                        <h1 class="text-left text-xl font-bold pl-4">{{ consumer.name }}</h1>
                        <p v-if="consumer.phone"><span class="font-bold">Phone:</span> {{consumer.phone}}</p>
                        <p v-if="consumer.email">{{consumer.email}}</p>
                        <p>
                            <span v-if="consumer.identification_type" class="mr-2">{{ consumer.identification_type}}</span>
                            <span v-if="consumer.identification_number" > {{consumer.identification_number}}</span>
                        </p>
                        <p>{{consumer.country}}</p>
                        <p>{{consumer.city}}</p>
                        <div class=" px-4 font-bold text-lg" v-for="account in accounts">
                            <DebtCard :account="account"/>
                        </div>
                        <div class="py-4 space-x-8 text-center">
                            <div class="text-center max-w-sm mx-auto mt-12">
                                <Link :href="route('people.debts.create', consumer)" method="get" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                    Create Account
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </Container>
    </AppLayout>
</template>
<script setup >

import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['consumer','accounts'])

const formattedDate = (date) => computed( () => formatDate(date))
import {Link, useForm} from "@inertiajs/vue3";
import Container from "@/Components/Container.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {computed, ref} from "vue";
import {formatDate} from "@/Utilities/date.js";
import Pagination from "@/Components/Pagination.vue";
import DebtCard from "@/Components/Cards/DebtCard.vue";

const goBack = () => window.history.back();

const switchShow = () => open.value=!open.value;
</script>
