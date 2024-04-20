<script setup>
import { Head, usePage, Link, router } from "@inertiajs/vue3";
import { computed, ref, reactive } from "vue";
import Paginate from "@/Components/Paginate.vue";

const props = defineProps({
  pollId: {
    type: String,
  },
  questions: Object,
  poll: String,
  days: String,
});

const page = usePage();

const user = computed(() => page.props.auth.user);
const consumable = computed(() => page.props.consumable);
const questions = ref(props.questions);
const poll = ref(props.poll);
const days = ref(props.days);

const userPolls = 100;
const userParticipation = 90;

let choices = ref(2);

const form = reactive({
  pollId: props.pollId,
  question_description: null,
  choices: [],
});

// Function to update choices array when inputs change
const updateChoice = (index, value) => {
  form.choices[index] = value;
};

const handleQuestionSubmit = () => {
  router.post(route("questions.store"), form, {
    onSuccess: (data) => {
      questions.value = data.props.questions;
      form.question_description = "";
      form.choices = [];
    },
  });
};
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
                        Poll-Title: {{ poll.poll_tittle }}
                      </div>
                      <div class="flex-auto text-gray-400 my-1">
                        <span class="mr-3">{{ poll.votes }} votes</span
                        ><span
                          class="mr-3 border-r border-gray-600 max-h-0"
                        ></span
                        ><span>{{ days }}</span>
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

        <div
          class="grid gap-4 grid-cols-1 md:grid-cols-2 overflow-scroll min-h-[770px]"
        >
          <!--confirm modal-->
          <div
            class="flex p-4 relative items-center justify-center bg-gray-800 border border-gray-800 shadow-lg rounded-2xl h-auto"
          >
            <div class="w-full">
              <div
                class="mx-auto my-4 p-10 flex flex-row items-center justify-evenly"
              >
                <h1 class="text-gray-300 font-bold mb-5">
                  Add Questions to this poll <br />
                  and <span class="text-green-400">monitor</span> live polls
                  interactions.
                </h1>

                <button
                  type="button"
                  @click="
                    () => {
                      choices += 1;
                    }
                  "
                  class="text-white bg-transparent border border-green-400 hover:bg-[#24292F]/90 focus:ring-4 focus:outline-none focus:ring-[#24292F]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-500 dark:hover:bg-[#050708]/30 me-2 mb-2"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="w-6 h-6"
                  >
                    <path
                      fill-rule="evenodd"
                      d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                      clip-rule="evenodd"
                    />
                  </svg>

                  Add a choice
                </button>
              </div>
              <form
                @submit.prevent="handleQuestionSubmit"
                class="max-w-sm h-auto mx-auto"
              >
                <div class="mb-5">
                  <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >Question Description</label
                  >
                  <textarea
                    type="text"
                    id="question_description"
                    v-model="form.question_description"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="Enter your question here?..."
                    required
                  ></textarea>
                </div>

                <div
                  v-for="(question_choice, index) in choices"
                  :key="index"
                  class="mb-5"
                >
                  <label
                    for="email"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >Choice {{ question_choice }}</label
                  >
                  <input
                    type="text"
                    :id="id"
                    v-model="form.choices[index]"
                    @input="updateChoice(index, $event.target.value)"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    :placeholder="`choice ${index + 1}  .....`"
                    required
                  />
                </div>
                <button
                  type="submit"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  Create Questions with Choices
                </button>
              </form>
            </div>
          </div>
          <!--elements-->
          <div class="flex flex-col space-y-4 overflow-y-scroll">
            <!--elements 2-->
            <div
              v-for="question in questions.data"
              :key="question.id"
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
                      {{ question.question_description }} ?
                    </div>
                    <p class="text-sm text-gray-500 leading-none mt-1 truncate">
                      question total votes : {{ question.votes }}
                    </p>
                  </div>
                </div>
                <div class="flex flex-col space-y-3">
                  <Link
                    :href="route('questions.index')"
                    :data="{ question_id: question }"
                    class="mx-auto"
                  >
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
                  </Link>

                  <Link
                    :href="route('poll-voting.index')"
                    :data="{ question_id: question.id }"
                    class="bg-green-400 rounded-full hover:bg-green-500 px-2 ml-2 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white transition ease-in duration-300"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="w-6 h-6"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"
                      />
                    </svg>
                  </Link>
                </div>
              </div>
            </div>

            <div
              v-show="questions.data.length == 0"
              class="flex text-gray-300 font-bold font-serif item-center justify-center min-w-[230px] mt-[110px]"
            >
              <h2>No questions at the moment ...</h2>
            </div>

            <Paginate
              v-show="questions.data.length > 0"
              :links="questions.links"
            />
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
