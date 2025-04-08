<template>
    <AppLayout :title="account.currency.toUpperCase() + ' - '+  person.name ">
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
            <div class="flex flex-col md:flex-row">
                <div class="flex-1 text-center mb-8">
                    <h1 class="text-2xl font-extrabold text-gray-600 ">{{person.name}}</h1>
                    <h1>{{person.phone}}</h1>
                    <div class="text-lg font-bold text-gray-900">
                    </div>
                </div>
                <div class="flex-1">
                    <Card class="max-w-[350px] mx-auto">
                        <CardHeader>
                            <CardTitle>Active Loan</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <div>
                                <Pie :data="pieData" :options="options"/>
                            </div>
                        </CardContent>
                        <CardFooter>
                            <div class="text-right text-gray-700 font-semibold grid grid-cols-2 space-y-2 space-x-3">
                                <h1>Max Loan Limit</h1><h1>{{account.limit}}</h1>
                                <h1>Current Loan</h1><h1>{{account.balance}}</h1>
                            </div>
                        </CardFooter>
                    </Card>
                </div>
            </div>
            <div class="max-w-3xl mx-auto">
                <PrimaryButton @click="switchShow">Add Record</PrimaryButton>

            </div>
        </Container>

    </AppLayout>

</template>

<script setup>
import { Pie } from 'vue-chartjs'
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
ChartJS.register(ArcElement, Tooltip, Legend)


import { Progress } from '@/components/ui/progress'
import {computed, ref} from "vue";
import Container from "@/Components/Container.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {Dialog, DialogPanel, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {ExclamationTriangleIcon} from "@heroicons/vue/24/outline/index.js";
import InputLabel from "@/Components/InputLabel.vue";
const props = defineProps(['account', 'person'])


import AppLayout from "@/Layouts/AppLayout.vue";

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from '@/components/ui/card'
import {useForm} from "@inertiajs/vue3";
const options = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        tooltip: {
            usePointStyle: true,
            callbacks: {
                afterLabel: function (context) {
                    return props.account.currencyCode
                },
            }
        }
    }
}
const pieData = computed(() => ({

    labels: ['Current Loan', 'Available'],
    datasets : [
        {
            backgroundColor:[ '#ff3131', '#35EC0B',],
            data: [props.account.balance, props.account.limit - props.account.balance, ]
        }
    ]
}))



const form = useForm({
    'amount': '0',
    'is_loan': true,
    'comment': '-',
})

const open = ref(false)
const switchShow = () => open.value=!open.value;

</script>
