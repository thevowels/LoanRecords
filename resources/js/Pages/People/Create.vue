<template>
    <AppLayout title="Create People">
        <Container>
            <form @submit.prevent="submitConsumer" class="space-y-4 p-8 border-indigo-700 border-2 rounded-lg mt-6  max-w-xl mx-auto">
                <div>
                    <InputLabel for="name" >Name</InputLabel>
                    <TextInput id="name" v-model="form.name" placeholder="Name" class="w-full"></TextInput>
                    <InputError :message="form.errors.name"></InputError>
                </div>
                <div >
                    <InputLabel for="portrait" >Portrait</InputLabel>
                    <input v-if="!portraitPreview" type="file" @change="handlePortrait" accept=".jpg,.jpeg,.png"/>
                    <InputError :message="form.errors.portrait"></InputError>
                </div>
                <div v-if="portraitPreview" class="space-y-2">
                    <img :src="portraitPreview" alt="Preview" class="w-32 h-32 object-cover rounded"/>
                    <SecondaryButton
                        @click="removePortrait"
                    >
                        Remove
                    </SecondaryButton>
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
                    <select id="identification_type" v-model="form.identification_type" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
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
                <div >
                    <InputLabel for="photo" >ID Photo</InputLabel>
                    <input v-if="!IdPreview" type="file" @change="handleId" accept=".jpg,.jpeg,.png"/>
                    <InputError :message="form.errors.photo"></InputError>
                </div>
                <div v-if="IdPreview" class="space-y-2">
                    <img :src="IdPreview" alt="Preview" class="w-32 h-32 object-cover rounded"/>
                    <SecondaryButton
                        @click="removeIdFile"
                    >
                        Remove
                    </SecondaryButton>
                </div>

                <div>
                    <InputLabel for="city" >City</InputLabel>
                    <select id="city" v-model="form.city" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option v-for="city in provinces" :value="city" :key="city">{{city}}</option>
                    </select>
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

import {ref} from "vue";

const portraitPreview = ref(null);

const IdPreview = ref(null);




function handleId(e) {
    const file = e.target.files[0]
    updateId(file)
}

function handlePortrait(e) {
    const file = e.target.files[0];
    updatePortrait(file);
}

function updateId(file) {
    if(file && file.type.startsWith("image/")){
        form.photo = file;

        const reader = new FileReader();

        reader.onload = e => {
            IdPreview.value = e.target.result;
        }
        reader.readAsDataURL(file);
    }else{
        form.photo = null;
        IdPreview.value = null;
    }
}

function updatePortrait(file) {
    if(file && file.type.startsWith("image/")){
        form.portrait = file;

        const reader = new FileReader();
        reader.onload = e => {
            portraitPreview.value = e.target.result;
        }
        reader.readAsDataURL(file);
    }else {
        form.portrait = null;
        portraitPreview.value = null;
    }
}


function removePortrait(e) {
    form.portrait= null;
    portraitPreview.value = null;
}

function removeIdFile(e) {
    form.photo =null;
    IdPreview.value = null;
}

const provinces = [
    "Krabi", "Bangkok", "Kanchanaburi", "Kalasin", "KamphaengPhet", "KhonKaen",
    "Chanthaburi", "Chachoengsao", "ChonBuri", "ChaiNat", "Chaiyaphum", "Chumphon",
    "ChiangRai", "ChiangMai", "Trang", "Trat", "Tak", "NakhonNayok", "NakhonPathom",
    "NakhonPhanom", "NakhonRatchasima", "NakhonSiThammarat", "NakhonSawan",
    "Nonthaburi", "Narathiwat", "Nan", "BeungKan", "BuriRam", "PathumThani",
    "PrachuapKhiriKhan", "PrachinBuri", "Pattani", "PhraNakhonSiAyutthaya", "Phayao",
    "Phang-nga", "Phatthalung", "Phichit", "Phitsanulok", "Phetchaburi", "Phetchabun",
    "Phrae", "Phuket", "MahaSarakham", "Mukdahan", "MaeHongSon", "Yasothon", "Yala",
    "RoiEt", "Ranong", "Rayong", "Ratchaburi", "LopBuri", "Lampang", "Lamphun", "Loei",
    "SiSaKet", "SakonNakhon", "Songkhla", "Satun", "SamutPrakan", "SamutSongkhram",
    "SamutSakhon", "SaKaeo", "Saraburi", "SingBuri", "Sukhothai", "SuphanBuri",
    "SuratThani", "Surin", "NongKhai", "NongBuaLamPhu", "AngThong", "AmnatCharoen",
    "UdonThani", "Uttaradit", "UthaiThani", "UbonRatchathani"
];


const form = useForm({
    'name': '',
    'email': '',
    'phone': '',
    'identification_type': 'NRC',
    'identification_number': '',
    'country': 'Thailand',
    'photo': null,
    'portrait': null,
    'city': provinces[1] ,
});

const submitConsumer =  () => {
    console.log(form);
    form.post(route('people.store'));
}

</script>
