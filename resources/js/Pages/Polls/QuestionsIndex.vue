<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import ApexCharts from "apexcharts";

import { onMounted } from "vue";
import Chart from "chart.js/auto";

const props = defineProps({
  question_id: {
    type: String,
  },
  choices: Array,
});

const page = usePage();

const user = computed(() => page.props.auth.user);

const choices = ref(props.choices);

const userPolls = 100;
const userParticipation = 90;

var questions = ref(2);

var chartCanvas = ref(null);
let chartInstance = null;

const generateBgColors = (_length) => {
  const colors = [];
  for (let i = 0; i < _length; i++) {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    colors.push(`rgb(${r}, ${g}, ${b})`);
  }
  return colors;
};

var loadChoiceAttribution = (_question) => {
  if (!chartCanvas.value) {
    console.error("Canvas element not found!");
    return;
  }

  if (chartInstance) {
    chartInstance.destroy();
  }

  // Array of background colors
  const colors = generateBgColors(20);

  // Generate random background colors for each choice
  const data = [12, 19, 3, 10, 19, 28]; // Sample data

  const backgroundColors = data.map((value, index) => {
    return colors[index];
  });
  const choices = data.map((value, index) => {
    return `Choice ${index}`;
  });

  chartInstance = new Chart(chartCanvas.value.getContext("2d"), {
    type: "doughnut",
    data: {
      labels: choices,
      datasets: [
        {
          label: "# of Votes",
          data: data,
          backgroundColor: backgroundColors,
          borderWidth: 1,
        },
      ],
    },
    options: {
      // Chart options
    },
  });
};

onMounted(() => {
  loadChoiceAttribution();
});
</script>




<template>
  <Head title="Polling View"> </Head>

  <!-- component -->
  <link
    href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
    rel="stylesheet"
  />
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-900"
  >
    <!-- dark theme -->
    <div class="container m-4">
      <div class="max-w-5xl w-full mx-auto grid gap-4 grid-cols-1">
        <!-- profile card -->
        <div class="flex flex-col sticky top-0 z-10">
          <div
            class="bg-gray-800 border border-green-800 shadow-lg rounded-2xl p-4"
          >
            <div class="flex-none sm:flex">
              <div class="relative h-32 w-32 sm:mb-0 mb-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="w-28 h-28 object-cover rounded-2xl bg-green-400 border-green-800 text-gray-200"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"
                  />
                </svg>
              </div>
              <div class="flex-auto sm:ml-5">
                <div class="flex items-center justify-between sm:mt-2 mt-4">
                  <div class="flex items-center">
                    <div class="flex flex-col">
                      <div
                        class="w-full flex-none text-lg text-gray-200 font-bold leading-none"
                      >
                        {{ question_id.question_description }} ?
                      </div>
                      <div class="flex-auto text-gray-400 my-1">
                        <span class="mr-3">{{ question_id.votes }} votes</span
                        ><span
                          class="mr-3 border-r border-gray-600 max-h-0"
                        ></span
                        ><span>{{ question_id.choices }} choices</span>
                      </div>
                    </div>
                  </div>
                  <div
                    class="flex items-end justify-end pt-2 text-sm text-gray-400"
                  >
                    <a
                      href="https://www.behance.net/ajeeshmon"
                      target="_blank"
                      class="flex flex-row space-x-5 items-center justify-center bg-transparent hover:bg-transparent px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-red-500 hover:border-red-800 hover:text-red-500 text-white rounded-full transition ease-in duration-300"
                    >
                      <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-6 h-6"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                          clip-rule="evenodd"
                        />
                      </svg>

                      Delete</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!---stats-->
        <div class="grid grid-cols-12 gap-4">
          <div class="col-span-12 sm:col-span-4">
            <div
              class="p-4 relative bg-gray-800 border border-gray-800 shadow-lg rounded-2xl"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-14 w-14 absolute bottom-4 right-3 text-green-400"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
              </svg>

              <div class="text-2xl text-gray-100 font-medium leading-8 mt-5">
                {{ userPolls }}
              </div>
              <div class="text-sm text-gray-500">Poll Number of votes</div>
            </div>
          </div>
          <div class="col-span-12 sm:col-span-4">
            <div
              class="p-4 relative bg-gray-800 border border-gray-800 shadow-lg rounded-2xl"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-14 w-14 absolute bottom-4 right-3 text-blue-500"
                viewBox="0 0 20 20"
                fill="currentColor"
              >
                <path
                  d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"
                />
              </svg>
              <div class="flex justify-between items-center">
                <i class="fab fa-behance text-xl text-gray-400"></i>
              </div>
              <div class="text-2xl text-gray-100 font-medium leading-8 mt-5">
                {{ userParticipation }}
              </div>
              <div class="text-sm text-gray-500">Poll participation</div>
            </div>
          </div>
          <div class="col-span-12 sm:col-span-4">
            <div
              class="p-4 relative bg-gray-800 border border-gray-800 shadow-lg rounded-2xl"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-14 w-14 absolute bottom-4 right-3 text-yellow-300"
              >
                <path
                  fill-rule="evenodd"
                  d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z"
                  clip-rule="evenodd"
                />
              </svg>

              <div class="flex justify-between items-center">
                <i class="fab fa-codepen text-xl text-gray-400"></i>
              </div>
              <div class="text-2xl text-gray-100 font-medium leading-8 mt-5">
                {{ userParticipation }}
              </div>
              <div class="text-sm text-gray-500">Poll Rating</div>
            </div>
          </div>
        </div>

        <div class="grid gap-4 grid-cols-1 md:grid-cols-2 overflow-scroll">
          <!--confirm modal-->
          <!--elements-->
          <div class="flex flex-col space-y-4 overflow-y-scroll">
            <!--elements 2-->
            <div
              v-for="(choice, index) in choices"
              :key="index"
              class="flex flex-col p-4 bg-gray-800 border-gray-800 shadow-md hover:shodow-lg rounded-2xl cursor-pointer transition ease-in duration-100 transform hover:scale-95"
            >
              <div class="flex flex-row items-center justify-between">
                <div class="flex items-center mr-auto">
                  <div class="w-12 h-12">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-12 h-12 p-2 object-cover rounded-2xl bg-green-400 border-green-800 text-gray-200"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"
                      />
                    </svg>
                  </div>

                  <div class="flex flex-col ml-3 min-w-0">
                    <div class="font-medium leading-none text-gray-100">
                      {{ choice.index }} {{ choice.choice_desc }}
                    </div>
                    <p class="text-sm text-gray-500 leading-none mt-1 truncate">
                      {{ choice.votes }} votes
                    </p>
                  </div>
                </div>
                <div class="mx-auto">
                  <button @click="loadChoiceAttribution(Choice)">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="currentColor"
                      class="w-6 h-6 text-green-400 hover:text-green-800"
                    >
                      <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                      <path
                        fill-rule="evenodd"
                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                        clip-rule="evenodd"
                      />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!--  chart-->

          <div class="shadow-lg bg-gray-800 rounded-lg overflow-hidden">
            <div
              class="py-3 px-5 items-center justify-center text-gray-300 font-bold"
            >
              Doughnut chart
            </div>
            <canvas ref="chartCanvas" class="p-10" id="chartDoughnut"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.bg-dots-darker {
  background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
  .dark\:bg-dots-lighter {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
  }
}
</style>
