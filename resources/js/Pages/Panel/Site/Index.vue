<template>

  <Panel>
    <template v-slot:header>
      <title>{{__('panel')}}</title>
    </template>


    <template v-slot:content>
      <!-- Content header -->
      <div
          class="flex items-center justify-start px-4 py-2 text-primary-500 border-b md:py-4 dark:border-primary-darker">
        <Bars2Icon class="h-7 w-7 mx-3"/>
        <h1 class="text-2xl font-semibold">{{ __('sites_list') }}</h1>
      </div>
      <!-- Content -->
      <div class="px-2  md:px-4">

        <div class="relative overflow-x-auto shadow-lg  rounded-lg">
          <div class="flex items-center justify-between py-4 bg-white dark:bg-gray-800 p-4">
            <div>
              <button id="dropdownActionButton" data-dropdown-toggle="dropdownAction"
                      class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                      type="button">
                <span class="sr-only">Action button</span>
                Action
                <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m1 1 4 4 4-4"/>
                </svg>
              </button>
              <!-- Dropdown menu -->
              <div id="dropdownAction"
                   class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownActionButton">
                  <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Reward</a>
                  </li>
                  <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Promote</a>
                  </li>
                  <li>
                    <a href="#"
                       class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Activate
                      account</a>
                  </li>
                </ul>
                <div class="py-1">
                  <a href="#"
                     class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete
                    User</a>
                </div>
              </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
              </div>
              <input type="text" id="table-search-users"
                     class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                     placeholder="Search for users">
            </div>
          </div>
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="p-4">
                <div class="flex items-center">
                  <input id="checkbox-all-search" type="checkbox"
                         class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  <label for="checkbox-all-search" class="sr-only">checkbox</label>
                </div>
              </th>
              <th scope="col" class="px-2 py-3">
                Name
              </th>
              <th scope="col" class="px-2 py-3">
                Position
              </th>
              <th scope="col" class="px-2 py-3">
                Status
              </th>
              <th scope="col" class="px-2 py-3">
                Action
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(d,idx) in data"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
              <td class="w-4 p-4">
                <div class="flex items-center">
                  <input id="checkbox-table-search-1" type="checkbox"
                         class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                  <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                </div>
              </td>
              <th scope="row"
                  class="flex items-center px-2 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                <Image class="w-10 h-10 rounded-full" :src="`${route('storage.sites')}/${d.id}.jpg`"
                       :alt="cropText(d.name,5)"/>
                <div class="px-3">
                  <div class="text-base font-semibold">{{ d.name }}</div>
                  <div class="font-normal text-gray-500">{{ }}</div>
                </div>
              </th>
              <td class="px-2 py-4">
                <a target="_blank" class="text-primary-500" :href="d.link">
                  {{ cropText(d.link, 20)}}
                </a>
              </td>
              <td class="px-2 py-4">
                <div class="flex items-center">
                  <div class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></div>
                  {{ d.views }}
                </div>
              </td>
              <td class="px-2 py-4">
                <!-- Modal toggle -->
                <Link href="#" type="button" data-modal-target="editUserModal"
                      data-modal-show="editUserModal"
                      class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit user
                </Link>
              </td>
            </tr>

            </tbody>
          </table>

        </div>

      </div>
    </template>


  </Panel>
</template>

<script>
import Scaffold from "@/Layouts/Scaffold.vue";
import Panel from "@/Layouts/Panel/User.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import {ChevronDownIcon, HomeIcon} from "@heroicons/vue/24/outline";
import {
  Bars2Icon,

} from "@heroicons/vue/24/outline";
import Image from "@/Components/Image.vue"

export default {
  data() {
    return {
      params: {
        page: 1,
      },
      data: [],
      paginate: {},
    }
  },
  components: {
    Head,
    Link,
    HomeIcon,
    ChevronDownIcon,
    Panel,
    Bars2Icon,
    Image
  },
  mounted() {

    this.getData();
  },
  methods: {
    getData() {


      window.axios.get(route('site.search'), {
        params: this.params
      }, {
        onUploadProgress: function (axiosProgressEvent) {
          console.log(axiosProgressEvent);
          /*{
            loaded: number;
            total?: number;
            progress?: number; // in range [0..1]
            bytes: number; // how many bytes have been transferred since the last trigger (delta)
            estimated?: number; // estimated time in seconds
            rate?: number; // upload speed in bytes
            upload: true; // upload sign
          }*/
        },

        onDownloadProgress: function (axiosProgressEvent) {
          console.log(axiosProgressEvent);

          /*{
            loaded: number;
            total?: number;
            progress?: number;
            bytes: number;
            estimated?: number;
            rate?: number; // download speed in bytes
            download: true; // download sign
          }*/
        }
      })
          .then((response) => {
            console.log(response);
            this.data = response.data.data;

          })

          .catch((error) => {
            if (error.response) {
              // The request was made and the server responded with a status code
              // that falls out of the range of 2xx
              console.log(error.response.data);
              console.log(error.response.status);
              console.log(error.response.headers);
            } else if (error.request) {
              // The request was made but no response was received
              // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
              // http.ClientRequest in node.js
              console.log(error.request);
            } else {
              // Something happened in setting up the request that triggered an Error
              console.log('Error', error.message);
            }
            console.log(error.config);
            this.showToast('danger', error)
          })
          .finally(function () {
            // always executed
          });
    },
  },

}
</script>
