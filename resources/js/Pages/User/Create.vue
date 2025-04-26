<template>
    <AppLayout title="Create New User">
        <Container>
            <form @submit.prevent="submitNewUser" class="space-y-4 p-8 border-indigo-700 border-2 rounded-lg mt-6  max-w-xl mx-auto">
                <div>
                    <InputLabel for="name"> Name</InputLabel>
                    <TextInput id="name" v-model="form.name"/>
                    <InputError :message="form.errors.name"></InputError>
                </div>
                <div>
                    <InputLabel for="email">Email</InputLabel>
                    <TextInput id="email" v-model="form.email"/>
                    <InputError :message="form.errors.email"></InputError>
                </div>
                <div>
                    <InputLabel for="password">Password</InputLabel>
                    <TextInput type="password" id="password" v-model="form.password" ></TextInput>
                </div>
                <div class="text-center">
                    <PrimaryButton>Submit</PrimaryButton>
                </div>
            </form>
        </Container>
    </AppLayout>
</template>
<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Container from "@/Components/Container.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const form = useForm({
    name: "",
    email: "",
    password: "",

})
const submitNewUser = () => {
    form.post(route("admin.users.store"));
    console.log("submitNewUser");
}
</script>
