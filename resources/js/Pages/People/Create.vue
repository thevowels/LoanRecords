<template>
    <AppLayout title="Create People">
        <Container>
                Create People
            <form @submit.prevent="submitConsumer" class="space-y-4 p-8 border-indigo-700 border-2 rounded-lg mt-6  max-w-xl mx-auto">
                <div>
                    <InputLabel for="name" >Name</InputLabel>
                    <TextInput id="name" v-model="form.name" placeholder="Name" class="w-full"></TextInput>
                    <InputError :message="form.errors.name"></InputError>
                </div>
                <div>
                    <InputLabel for="email" >Email</InputLabel>
                    <TextInput id="email" v-model="form.email" placeholder="Email" class="w-full"></TextInput>
                    <InputError :message="form.errors.email"></InputError>
                </div>
                <div>
                    <InputLabel for="phone" >Phone</InputLabel>
                    <TextInput id="phone" v-model="form.phone" placeholder="Phone" class="w-full"> </TextInput>
                    <InputError :message="form.errors.phone"></InputError>
                </div>
                <div>
                    <InputLabel for="identification_type" >Identification Type</InputLabel>
                    <select id="identification_type" v-model="form.identification_type">
                        <option value="NRC">NRC</option>
                        <option value="Passport">Passport</option>
                        <option value="WorkPermit">WorkPermit</option>
                    </select>
                    <InputError :message="form.errors.identification_type"></InputError>
                </div>
                <div>
                    <InputLabel for="identification_number" >Identification Number</InputLabel>
                    <TextInput id="identification_number" v-model="form.identification_number" placeholder="Identification Number" class="w-full"> </TextInput>
                    <InputError :message="form.errors.identification_number"></InputError>

                </div>
                <div>
                    <InputLabel for="country" >Country</InputLabel>
                    <select id="country" v-model="form.country">
                        <option value="Thailand">Thailand</option>
                        <option value="Myanmar">Myanmar</option>
                    </select>
                    <InputError :message="form.errors.country"></InputError>
                </div>
                <div>
                    <InputLabel for="city" >City</InputLabel>
                    <TextInput id="city" v-model="form.city" placeholder="City" class="w-full"> </TextInput>
                    <InputError :message="form.errors.city"></InputError>
                </div>
                <div class="text-right space-x-4 justify-between">
                    <SecondaryButton >Cancel</SecondaryButton>
                    <PrimaryButton >Submit</PrimaryButton>
                </div>
            </form>
        </Container>
    </AppLayout>
</template>

<script setup>

import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import InputError from "@/Components/InputError.vue";

const form = useForm({
    'name': '',
    'email': '',
    'phone': '',
    'identification_type': 'NRC',
    'identification_number': '',
    'country': 'Myanmar',
    'city': '',
});

const submitConsumer =  () => {
    form.post(route('people.store'));
}

</script>
