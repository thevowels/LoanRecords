<template>
    <AppLayout :title="consumer.name">
        <Container>
            <TransitionRoot as="template" :show="open">
                <Dialog class="relative z-10" @close="open = false">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
                    </TransitionChild>

                    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
                        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                                <DialogPanel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                        <div class="sm:flex sm:items-start">
                                            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">
                                                <ExclamationTriangleIcon class="size-6 text-red-600" aria-hidden="true" />
                                            </div>
                                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                                <DialogTitle as="h3" class="text-base font-semibold text-gray-900">Add new {{'loan'}} Record</DialogTitle>
                                                <div class="mt-2 w-full">
                                                    <form @submit.prevent="submitRecord" >
                                                        <div class="w-full">
                                                            <InputLabel for="amount">Amount</InputLabel>
                                                            <TextInput id="amount" v-model="form.amount" class="w-full"/>
                                                            <InputError :message="form.errors.amount" />
                                                        </div>
                                                        <div class="mt-3 w-full">
                                                            <select id="is_loan" v-model="form.is_loan" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                                                <option :value="true">
                                                                    Loan
                                                                </option>
                                                                <option :value="false">
                                                                    Return
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="mt-3">
                                                            <InputLabel for="comment">Comment</InputLabel>
                                                            <TextInput id="comment" v-model="form.comment" class="w-full"/>
                                                            <InputError :message="form.errors.comment" />
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                        <button type="button" class="inline-flex w-full justify-center rounded-md bg-gray-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-500 sm:ml-3 sm:w-auto" @click="submitRecord">Add Record</button>
                                        <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto" @click="open = false" ref="cancelButtonRef">Cancel</button>
                                    </div>
                                </DialogPanel>
                            </TransitionChild>
                        </div>
                    </div>
                </Dialog>
            </TransitionRoot>

            <div class="container">
                <div class="grid grid-cols-1 sm:grid-cols-2 ">
                    <div class="mx-auto">
                        <img src="https://dummyjson.com/icon/abc123/512" class="w-16 sm:w-fit" />
                    </div>
                    <div class="space-y-2 ">
                        <h1 class="text-left text-xl font-bold pl-4">{{ consumer.name }}</h1>
                        <p v-if="consumer.phone"><span class="font-bold">Phone:</span> {{consumer.phone}}</p>
                        <p v-if="consumer.email">{{consumer.email}}</p>
                        <p>
                            <span v-if="consumer.identification_type" class="mr-2">{{ consumer.identification_type}}</span>
                            <span v-if="consumer.identification_number" > {{consumer.identification_number}}</span>
                        </p>
                        <p>{{consumer.country}}</p>
                        <p>{{consumer.city}}</p>
                        <div class="py-3 px-4 font-bold text-lg  ">
                            Accounts
                            <Card class="flex flex-col mb-3 w-fit " v-for="account in accounts">
                                <Link   :href="route('debts.show', account.id)" class=" py-3 px-4">
                                    <div class="flex flex-row space-x-4">
                                        <div >
                                            <p>Currency {{account.currency}}</p>
                                            <p>Current: {{account.balance}}</p>
                                            <p>Limit  : {{account.limit}}</p>
                                        </div>
                                        <div >
                                            
                                        </div>

                                    </div>
                                </Link>

                            </Card>
                        </div>
                        <div class="py-4 space-x-8 text-center">
<!--                            <Link v-if="consumer.amount === 0" :href="route('people.destroy', consumer)" method="delete" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">-->
<!--                                Archive-->
<!--                            </Link>-->

<!--                            <div v-if="bahts.data.length !== 0 " class="text-center max-w-sm mx-auto mt-12">-->
<!--                                <PrimaryButton @click="switchShow">Add Record</PrimaryButton>-->
<!--                            </div>-->

                            <div class="text-center max-w-sm mx-auto mt-12">
                                <Link :href="route('people.debts.create', consumer)" method="get" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150">
                                    Create Account
                                </Link>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="mt-4" v-if="bahts.data.length !== 0 ">
                    <div class="text-center font-serif text-lg font-semibold text-gray-800">
                        Loan / Return
                    </div>

                    <table v-if="bahts.data.length > 0" class=" mt-4 table table-auto border-collapse border border-gray-400 mx-auto">
                        <thead>
                            <tr>

                                <th>Amount</th>
                                <th>Date & Time</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tr v-for="baht in bahts.data" :key="baht.id" >
                            <td class="border border-gray-300 px-4 font-bold" :class=" baht.is_loan ? 'text-red-500':'text-blue-500' ">{{baht.amount}}</td>
                            <td class="border border-gray-300 px-4">{{formattedDate(baht.created_at)}}</td>
                            <td class="border border-gray-300 px-4 text-sm">{{baht.comment}}</td>
                        </tr>
                    </table>
                    <Pagination :meta="bahts.meta" class="max-w-xl  mx-auto text-xs"></Pagination>
                </div>
                <div v-if="bahts.data.length === 0 " class="text-center max-w-sm mx-auto mt-12">
                    <div>
                        Add new Loan / Return Records by clicking Add New Record Button

                    </div>
                    <PrimaryButton @click="switchShow">Add Record</PrimaryButton>

                </div>

            </div>
        </Container>
    </AppLayout>
</template>
<script setup >

import PrimaryButton from "@/Components/PrimaryButton.vue";

const props = defineProps(['consumer','bahts','accounts'])

const formattedDate = (date) => computed( () => formatDate(date))
import {Link, useForm} from "@inertiajs/vue3";
import Container from "@/Components/Container.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {computed, ref} from "vue";
import {formatDate} from "@/Utilities/date.js";
import {Dialog, DialogPanel, DialogTitle, RadioGroup, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {ExclamationTriangleIcon} from "@heroicons/vue/24/outline/index.js";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import Pagination from "@/Components/Pagination.vue";
import {Card} from "@/components/ui/card/index.js";


const form = useForm({
    'amount': '0',
    'is_loan': true,
    'comment': '-',
})
const submitRecord = () => {
    form.post(route('consumers.bahts.store', props.consumer.id),{
        preserveScroll: false,
        onSuccess: () => {
            form.reset();
            open.value=false;
            }
    });

    console.log('submitted data', form.data());


}

const open = ref(false)

const switchShow = () => open.value=!open.value;
</script>
