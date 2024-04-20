<script setup>
import { Head, usePage, Link, router } from "@inertiajs/vue3";
import { computed, ref, reactive, onMounted } from "vue";
import Paginate from "@/Components/Paginate.vue";

const props = defineProps({
  questions: Object,
});

const page = usePage();

const user = computed(() => page.props.auth.user);
const consumable = computed(() => page.props.consumable);
const questions = ref(props.questions);

// If you need to perform some action when the component is mounted
onMounted(() => {
  console.log("data", questions);
});
</script>

<template>
  <Head title="Polling View" />

  <!-- component -->
  <link
    href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
    rel="stylesheet"
  />
  <div
    class="flex flex-col items-center justify-center min-h-screen bg-gray-900"
  >
    <!-- dark theme -->
    <div
      class="container m-4"
      v-for="question in questions.data"
      :key="question.id"
    >
      <div class="max-w-5xl w-full mx-auto grid gap-4 grid-cols-1">
        <h3 class="mb-4 font-semibold text-gray-300 dark:text-white">
          {{ question.question_description }} ?
        </h3>
        <ul
          class="w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        >
          <li
            v-for="choice in question.choice"
            :key="choice.id"
            class="w-full border-b border-gray-200 rounded-t-lg dark:border-gray-600"
          >
            <div class="flex items-center ps-3">
              <input
                id="angular-checkbox"
                type="checkbox"
                value=""
                class="w-4 h-4 text-green-400 bg-gray-100 border-gray-300 rounded focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
              />
              <label
                for="angular-checkbox"
                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >{{ choice.choice_desc }}</label
              >
            </div>
          </li>
        </ul>
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
