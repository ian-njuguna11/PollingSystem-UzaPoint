<script setup>
import { Head, usePage, Link, router } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed, onMounted, ref, reactive } from "vue";

import Paginate from "@/Components/Paginate.vue";

const props = defineProps({
  pollId: String,
  polls: Object,
  system_polls: Number,
  poll_participation: Number,
});

// Access props

const page = usePage();

const user = computed(() => page.props.auth.user);
const consumable = computed(() => page.props.consumable);

const pollId = ref(props.pollId);
const polls = ref(props.polls);

const system_polls = ref(props.system_polls);
const userParticipation = ref(props.poll_participation);

// If you need to perform some action when the component is mounted
// onMounted(() => {
//   console.log(props.system_polls);
// });

const form = reactive({
  poll_tittle: null,
  votes: null,
  questions: null,
  end_date: null,
});

const handleSubmitPollForm = () => {
  router.post(route("polls.store"), form, {
    onSuccess: (data) => {
      // reactive elements

      system_polls.value = props.system_polls;
      // const userParticipation = ref(props.poll_participation);

      polls.value = data.props.polls;
      form.poll_tittle = "";
      form.votes = "";
      form.questions = "";
      form.userId = "";
      form.end_date = "";
    },
  });
};
</script>

<template>
  <Head
    title="Polling System Uzapoint Techical Assessment -- Wambugu Ian Njuguna"
  />

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
              <div class="flex-auto sm:ml-5 justify-evenly">
                <div class="flex items-center justify-between sm:mt-2">
                  <div class="flex items-center">
                    <div class="flex flex-col">
                      <div
                        class="w-full flex-none text-lg text-gray-200 font-bold leading-none"
                      >
                        {{ user.name }}
                      </div>
                      <div class="flex-auto text-gray-400 my-1">
                        <span class="mr-3">{{ user.email }}</span
                        ><span
                          class="mr-3 border-r border-gray-600 max-h-0"
                        ></span
                        ><span>kenya , NRB</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="flex pt-2 text-sm text-gray-400">
                  <div class="flex-1 inline-flex items-center">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5 mr-2"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"
                      ></path>
                    </svg>
                    <p class="">{{ system_polls }} polls per user</p>
                  </div>
                  <div class="flex-1 inline-flex items-center">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="h-5 w-5 mr-2"
                      viewBox="0 0 20 20"
                      fill="currentColor"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                    <p class="">{{ userParticipation }} user participation</p>
                  </div>
                  <Link
                    :href="route('profile.edit')"
                    class="flex-no-shrink bg-green-400 hover:bg-green-500 px-5 ml-4 py-2 text-xs shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300"
                    >Profile</Link
                  >
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
                {{ system_polls }}
              </div>
              <div class="text-sm text-gray-500">System Polls</div>
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
                {{ userParticipation }} / {{ system_polls }}
              </div>
              <div class="text-sm text-gray-500">Poll Rating</div>
            </div>
          </div>
        </div>

        <div class="grid gap-4 grid-cols-1 md:grid-cols-2">
          <!--confirm modal-->
          <div
            class="flex p-4 relative items-center justify-center bg-gray-800 border border-gray-800 shadow-lg rounded-2xl h-[38rem]"
          >
            <div class="w-full">
              <form
                @submit.prevent="handleSubmitPollForm"
                class="max-w-sm mx-auto"
              >
                <h1 class="text-gray-300 font-bold mb-5">
                  Create poll <br />
                  and <span class="text-green-400">monitor</span> live polls
                  interactions.
                </h1>

                <div class="mb-5">
                  <label
                    for="poll_tittle"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >Poll Tittle *
                  </label>
                  <input
                    v-model="form.poll_tittle"
                    type="poll_tittle"
                    id="poll_tittle"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="This is poll for households .... (example)"
                    required
                  />
                </div>

                <div class="mb-5">
                  <label
                    for="votes"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >How many votes are you expecting to consider the poll a
                    success? *
                  </label>
                  <input
                    v-model="form.votes"
                    type="number"
                    id="votes"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="example ( 100 ) ...."
                    required
                  />
                </div>

                <div class="mb-5">
                  <label
                    for="questions"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >How many question does the poll have? *
                  </label>
                  <input
                    v-model="form.questions"
                    type="number"
                    id="questions"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="example ( 20  questions ) ...."
                    required
                  />
                </div>

                <div class="mb-5">
                  <label
                    for="end_date"
                    class="block mb-2 text-sm font-medium text-gray-300 dark:text-white"
                    >Expected end date for this exercise ? *
                  </label>
                  <input
                    v-model="form.end_date"
                    type="date"
                    id="end_date"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="10-10-2024"
                    required
                  />
                </div>

                <button
                  type="submit"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                  Create a New Poll
                </button>
              </form>
            </div>
          </div>
          <!--elements-->
          <div class="flex flex-col space-y-3.5">
            <!--elements 2-->
            <div
              v-for="poll in polls.data"
              :key="poll.id"
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
                      {{ poll.poll_tittle ?? "title" }}
                    </div>
                    <p class="text-sm text-gray-500 leading-none mt-1 truncate">
                      poll total votes {{ poll.votes ?? 0 }}
                    </p>
                  </div>
                </div>
                <Link
                  :href="route('polls.index')"
                  :data="{ 'poll-id': poll.id ?? 0 }"
                  as="button"
                  type="button"
                  class="justify-end"
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
              </div>
            </div>

            <div
              v-show="polls.data.length == 0"
              class="flex text-gray-300 font-bold font-serif item-center justify-center min-w-[230px] mt-[110px]"
            >
              <h2>No Polls at the moment ...</h2>
            </div>

            <!-- //paginate componet -->
            <div class="mx-auto">
              <Paginate v-show="polls.data.length > 0" :links="polls.links" />
            </div>
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
