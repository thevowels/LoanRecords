<template>
        <div @scroll.passive="handleScroll" ref="scrollContainer" class="overflow-y-auto h-[600px] ">
            <div v-for="transaction in transactions" :key="transaction.id" class="flex flex-row mb-4 ">
                <!-- render your transaction here -->
                <div class="mr-2">
                    <CreditCardIcon class="size-12 text-indigo-500  text-primary" v-if="transaction.type === 'loan' "/>
                    <BanknotesIcon class="size-12  text-green-600" v-if="transaction.type !== 'loan' "/>
                </div>
                <div class="flex-auto">
                    <div >
                        <span class="font-extrabold capitalize ">{{transaction.type}} : </span>
                        <span class="font-light">
                                    {{ transaction.comment }}
                                </span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <div class="text-left text-sm">
                            {{formatDate(transaction.created_at)}}
                        </div>
                        <div class="font-extrabold" :class="transaction.type === 'loan' ? 'text-gray-800': 'text-green-500'">
                            {{transaction.amount}} {{account.currencyCode}}
                        </div>
                    </div>
                </div>
            </div>
            <div v-if="loading">Loading...</div>
            <div v-if="!loading && hasMore" class="text-center text-gray-500"> <button @click="fetchTransactions">Load more ...</button> </div>
            <div v-if="!hasMore" class="text-center">No more transactions</div>
        </div>

</template>

<script setup>
import {ref, onMounted, watch, computed} from 'vue'
import axios from 'axios'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {formatDate} from "@/Utilities/date.js";
import {BanknotesIcon, CreditCardIcon} from "@heroicons/vue/24/outline/index.js";

const props = defineProps({
    account: {
        type:Object,
        required:true
    }
})


const transactions = ref([])
const currentPage = ref(1)
const loading = ref(false)
const hasMore = ref(true)
const debtId = props.account.id

const fetchTransactions = async () => {
    if(loading.value || !hasMore.value) return

    loading.value = true

    const response = await axios.get(`/api/transactions?debt_id=${debtId}&page=${currentPage.value}`, {withCredentials: true})
    // const response = await axios.get(`/api/transactions`, {withCredentials: true})
    if (response.data.data.length) {
        transactions.value.push(...response.data.data)
        currentPage.value++
    } else {
        hasMore.value = false
    }

    loading.value = false

    console.log(response.data);
}

const handleScroll = (e) => {
    const bottom = e.target.scrollTop + e.target.clientHeight >= e.target.scrollHeight - 50
    if (bottom) {
        fetchTransactions()
    }
}

onMounted(fetchTransactions)

</script>
