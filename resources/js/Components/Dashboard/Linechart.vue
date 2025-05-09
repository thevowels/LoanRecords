<template>
    <Line :data="data" :options="{
    responsive: true,
    plugins: {
      legend: { display: false },
      title: {
        display: true,
        text: title
      }
    },
    scales: {
          y: {
            beginAtZero: true,
            ticks: {
                callback: function (value) {
                    if( value >= 1000) {
                        return value/1000 + 'k';
                    }
                    return value;
                }
            }
          },
        x: {
          ticks: {
            callback: function (value, index, ticks) {
              const label = this.getLabelForValue(value);
              const date = new Date(label); // assuming label is 'YYYY-MM-DD'

              const day = date.getDate();
              const month = date.toLocaleString('default', { month: 'short' });

              if (index === 0) return `${day} ${month}`;

              const prevDate = new Date(this.getLabelForValue(ticks[index - 1].value));
              const prevMonth = prevDate.getMonth();

              if (date.getMonth() !== prevMonth) {
                return `${day} ${month}`;
              }
              return `${day}`; // Just day
            }
          }
        }
    }
  }" />
</template>

<script setup>

import {computed} from "vue";

const props = defineProps(['data', 'title']);

const data = computed(() => props.data);
import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Filler,
    Legend
} from 'chart.js'

import { Line } from "vue-chartjs";

ChartJS.register(
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Filler,
    Legend
);

const options = {
    responsive: true,
    maintainAspectRatio: false
}


</script>
