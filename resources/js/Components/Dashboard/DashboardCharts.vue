<template>
    <div>
<!--        <div class="text-right max-w-4xl mx-auto">-->
<!--            <Switch :model-value="control.currency" @update:model-value="toggleCurrency"/>-->
<!--            <span class="text-2xl font-bold ml-2">{{ control.currency ? 'Kyat': 'Baht' }}</span>-->
<!--        </div>-->

<!--        <div class="flex space-x-4 border-b mb-4 justify-center">-->
<!--            <button-->
<!--                v-for="tab in tabs"-->
<!--                :key="tab"-->
<!--                @click="activeTab = tab"-->
<!--                :class="[-->
<!--                      'px-4 py-2 font-medium',-->
<!--                      activeTab === tab-->
<!--                        ? 'border-b-2 border-blue-500 text-blue-600'-->
<!--                        : 'text-gray-500 hover:text-gray-700',-->
<!--                    ]"-->
<!--            >-->
<!--                {{ tab }}-->
<!--            </button>-->
<!--        </div>-->
<!--        <div v-if="activeTab === 'Loan'">-->
<!--                Loan Charts-->
<!--            <span class="sr-only">{{control.currency}}</span>-->
<!--            <Linechart :data="getLoanChartData()" :title="'Loan Amounts Over the Last 10 Days'"/>-->
<!--            <Barchart :data="getLoanChartData()"/>-->
<!--        </div>-->
<!--        <div v-if="activeTab === 'Return'">-->
<!--            Return Chart-->
<!--            <Linechart :data="getReturnChartData()" :title="'Return amounts Over the last 10 Days'"/>-->
<!--            <Barchart :data="getReturnChartData()"/>-->
<!--        </div>-->
<!--        <div v-if="activeTab === 'Compare'">-->
<!--            Return Chart-->
<!--            <Linechart :data="getCompareChartData()" :title="'Loan and Return comparison Over the last 10 Days'"/>-->
<!--            <Barchart :data="getCompareChartData()"/>-->
<!--        </div>-->
        <div class="flex flex-row flex-wrap justify-center">

            <div class="w-96 h-72">
                <Linechart  :data="getData('Kyat', props.series.kyat.loan,'#3b82f6', 'rgba(59, 130, 246, 0.2)')" :title="'Kyat Loans Over last 15 days'"/>
            </div>

            <div class="w-96 h-72">
                <Linechart  :data="getData('Baht', props.series.baht.return,  '#da1f18','#da1f1820')" :title="'Baht Returns Over the Last 15 Days'"/>
            </div>

            <div class="w-96 h-72">
                <Barchart :data="kyatCompareChartData()"/>
            </div>
        </div>

        <div class="flex flex-row flex-wrap justify-center">

            <div class="w-96 h-72">
                <Linechart  :data="getData('Kyat ', props.series.kyat.return, '#da1f18', '#da1f1820')" :title="'Kyat returns Over the Last 15 Days'"/>
            </div>
            <div class="w-96 h-72">
                <Linechart  :data="getData('Baht', props.series.baht.loan,'#3b82f6', 'rgba(59, 130, 246, 0.2)')" :title="'Baht Loans Over last 15 days'"/>
            </div>

            <div class="w-96 h-72">
                <Barchart :data="bahtCompareChartData()"/>
            </div>

        </div>




    </div>
</template>

<script setup>

import Linechart from "@/Components/Dashboard/Linechart.vue";
import {ref} from "vue";
import {parse, format } from "date-fns";
import Barchart from "@/Components/Dashboard/Barchart.vue";
import { reactive } from 'vue'
import { Switch } from '@/components/ui/switch'


const props = defineProps(['series']);

const tabs=['Loan', 'Return', 'Compare'];

const currency = ref(true)

const control= reactive({
    currency: true
})


const toggleCurrency = () => {
    control.currency = !control.currency;
}

const activeTab = ref('Loan');

const getData = (label, data,borderColor, bgColor ) => {
    return {
        labels: Object.keys(data),
        datasets: [
            {
                label: label,
                data: Object.values(data),
                borderColor: borderColor,
                backgroundColor: bgColor,
                tension: 0.3,
                pointRadius: 0,
                pointHoverRadius: 6,
                fill: true,
            }
        ]
    }

}


const kyatCompareChartData = () =>{
    const loan_data =  props.series.kyat.loan ;
    const return_data =  props.series.kyat.return;

    return{
        labels: Object.keys(loan_data),
        datasets: [
            {
                label: 'Total Daily Loans',
                data: Object.values(loan_data),
                borderColor: '#3b82f6',
                backgroundColor: '#3b82f650',
                tension: 0.3,
                fill: true,
            },
            {
                label: 'Total Daily Returns',
                data: Object.values(return_data),
                borderColor: '#da1f18',
                backgroundColor: '#da1f1850',
                tension: 0.3,
                fill: true,
            },
        ]
    }
}
const bahtCompareChartData = () =>{
    const loan_data = props.series.baht.loan
    const return_data = props.series.baht.return;

    return{
        labels: Object.keys(loan_data),
        datasets: [
            {
                label: 'Total Daily Loans',
                data: Object.values(loan_data),
                borderColor: '#3b82f6',
                backgroundColor: '#3b82f650',
                tension: 0.3,
                fill: true,
            },
            {
                label: 'Total Daily Returns',
                data: Object.values(return_data),
                borderColor: '#da1f18',
                backgroundColor: '#da1f1850',
                tension: 0.3,
                fill: true,
            },
        ]
    }
}


</script>
