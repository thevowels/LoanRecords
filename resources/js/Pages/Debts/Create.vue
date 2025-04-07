<template>
    <AppLayout title="Create Debt">
        <Container>
            <form @submit.prevent="submitDebt" class="space-y-4 p-8 border-indigo-700 border-2 rounded-lg mt-6  max-w-xl mx-auto">
                <div>
                    <InputLabel for="currency">currency</InputLabel>
                    <select id="currency" v-model="form.currency" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm min-w-44">
                        <option v-for="currency in Currencies" :key="currency" :value="currency">{{currency}}</option>
                    </select>
                    <InputError :message="form.errors.currency"></InputError>

                </div>

                <div>
                    <InputLabel for="limit" >Loan Limit</InputLabel>
                    <TextInput id="limit" v-model="form.limit" ></TextInput>
                    <InputError :message="form.errors.limit"></InputError>

                </div>
                <div class="text-right">
                    <PrimaryButton>Create</PrimaryButton>

                </div>

            </form>
        </Container>
    </AppLayout>

</template>

<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import {useForm, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Container from "@/Components/Container.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

const Currencies = ['kyat', 'baht'];

const page = usePage();
const submitDebt = () => {
    form.post(route('people.debts.store', page.props.person))
}


const form = useForm({
    'currency': 'kyat',
    'limit': ''
});
</script>
