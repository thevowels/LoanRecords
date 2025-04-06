<template>
    <div>
        Dashboard charts component
        <div class="flex space-x-4 border-b mb-4 justify-center">
            <button
                v-for="tab in tabs"
                :key="tab"
                @click="activeTab = tab"
                :class="[
                      'px-4 py-2 font-medium',
                      activeTab === tab
                        ? 'border-b-2 border-blue-500 text-blue-600'
                        : 'text-gray-500 hover:text-gray-700',
                    ]"
            >
                {{ tab }}
            </button>
        </div>
        <div v-if="activeTab === 'Loan'">
            <Linechart :data="getLoanChartData()" :title="'Loan Amounts Over the Last 10 Days'"/>
            <Barchart :data="getLoanChartData()"/>
        </div>
        <div v-if="activeTab === 'Return'">
            Return Chart
            <Linechart :data="getReturnChartData()" :title="'Return amounts Over the last 10 Days'"/>
            <Barchart :data="getReturnChartData()"/>
        </div>
        <div v-if="activeTab === 'Compare'">
            Return Chart
            <Linechart :data="getCompareChartData()" :title="'Loan and Return comparison Over the last 10 Days'"/>
            <Barchart :data="getCompareChartData()"/>
        </div>


    </div>
</template>

<script setup>

import Linechart from "@/Components/Dashboard/Linechart.vue";
import {ref} from "vue";
import {parse, format } from "date-fns";
import Barchart from "@/Components/Dashboard/Barchart.vue";

const props = defineProps(['series']);

const tabs=['Loan', 'Return', 'Compare'];

const activeTab = ref('Loan');

const getLoanChartData = () =>{
    return {
        labels: Object.keys(props.series.daily_loan).map(x =>  format(parse(x, 'yyyy-MM-dd', new Date()), 'MMM-dd')),
        datasets: [
            {
                label: 'Total Daily Loans',
                data: Object.values(props.series.daily_loan),
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.3,
                fill: true,
            }
        ]
    }
}

const getReturnChartData = () =>{
    return{
        labels: Object.keys(props.series.daily_return).map(x =>  format(parse(x, 'yyyy-MM-dd', new Date()), 'MMM-dd')),
        datasets: [
            {
                label: 'Total Daily Returns',
                data: Object.values(props.series.daily_return),
                borderColor: '#da1f18',
                backgroundColor: '#da1f1820',
                tension: 0.3,
                fill: true,
            },
        ]
    }
}

const getCompareChartData = () =>{
    return{
        labels: Object.keys(props.series.daily_return).map(x =>  format(parse(x, 'yyyy-MM-dd', new Date()), 'MMM-dd')),
        datasets: [
            {
                label: 'Total Daily Loans',
                data: Object.values(props.series.daily_loan),
                borderColor: '#3b82f6',
                backgroundColor: '#3b82f630',
                tension: 0.3,
                fill: true,
            },
            {
                label: 'Total Daily Returns',
                data: Object.values(props.series.daily_return),
                borderColor: '#da1f18',
                backgroundColor: '#da1f1830',
                tension: 0.3,
                fill: true,
            },
        ]
    }
}


</script>
