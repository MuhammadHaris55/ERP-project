<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transactions
      </h2>
    </template>
    <div class="">
      <form @submit.prevent="submit">
        <!-- COMPANY ID -->
        <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
          <select
            v-model="form.company_id"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="company"
            placeholder="Enter Company"
          >
            <option v-for="type in companies" :key="type.id" :value="type.id">
              {{ type.name }}
            </option>
          </select>
          <div v-if="errors.type">{{ errors.type }}</div>
        </div>
        <!-- YEAR ID -->
        <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
          <select
            v-model="form.year_id"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="year"
            placeholder="Enter Year"
          >
            <option v-for="type in years" :key="type.id" :value="type.id">
              {{ type.id }}
            </option>
          </select>
          <div v-if="errors.type">{{ errors.type }}</div>
        </div>
        <!-- DOCUMENT TYPE ID -->
        <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
          <select
            v-model="form.type_id"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="voucher"
            placeholder="Enter Voucher"
          >
            <option v-for="type in doc_types" :key="type.id" :value="type.id">
              {{ type.name }}
            </option>
          </select>
          <div v-if="errors.type">{{ errors.type }}</div>
        </div>
        <!-- REFERENCE -->
        <!-- <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
          <select
            v-model="form.ref"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="voucher"
            placeholder="Enter Voucher"
          >
            <option
              v-for="type in accounts"
              :key="type.id"
              :value="type.ref"
            >
              {{ type.ref }}
            </option>
          </select>
          <div v-if="errors.type">{{ errors.type }}</div>
        </div> -->

        <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
          <input
            type="text"
            v-model="form.ref"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="ref"
          />
          <div v-if="errors.ref">{{ errors.ref }}</div>
        </div>

        <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
          <input
            type="text"
            v-model="form.description"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="description"
          />
          <div v-if="errors.description">{{ errors.description }}</div>
        </div>

        <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
          <datepicker
            v-model="form.date"
            class="pr-2 pb-2 w-full rounded-md"
            label="date"
          />
          <div v-if="errors.date">{{ errors.date }}</div>
        </div>

        <!-- <div class="row-auto place-items-auto"> -->
        <!-- <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
            <select
              v-model="form.type_id"
              class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
              label="voucher"
              placeholder="Enter Voucher"
              id="source"
            >
              <option
                v-for="type in account_types"
                :key="type.id"
                :value="type.id"
              >
                {{ type.name }}
              </option>
            </select>
            <div v-if="errors.type">{{ errors.type }}</div>
          </div> -->

        <!-- <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
            <input
              type="text"
              class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
              label="ref"
            />
            <div v-if="errors.ref">{{ errors.ref }}</div>
          </div>

          <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
            <input
              type="text"
              v-model="credit"
              class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
              label="ref"
            />
            <div v-if="errors.ref">{{ errors.ref }}</div>
          </div> -->
        <!-- <button
            class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"
            @click.prevent="addRow"
          >
            Add row
          </button>
          <div v-if="isError">{{ firstError }}</div> -->

        <!-- </div> -->

        <!-- <div
          class="px-4 py-2 bg-gray-100 border-t border-gray-200 flex justify-start items-center"
        >
          <button
            class="border bg-indigo-300 rounded-xl px-4 py-2 ml-4 mt-4"
            type="submit"
          >
            Create Transaction
          </button>
          <button
            class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"
            @click.prevent="addRow"
          >
            Add row
          </button>
        </div> -->

        <!-- APNA CODE -->
        <div class="panel-body">
          <button
            class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"
            @click.prevent="addRow"
          >
            Add row
          </button>
          <div v-if="isError">{{ firstError }}</div>
          <table class="table border">
            <thead class="">
              <tr>
                <th>Account:</th>
                <th>Debit:</th>
                <th>Credit:</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td>
                  <select
                    v-model="form.entries.account_id"
                    class="rounded-md w-36"
                  >
                    <option
                      v-for="account in accounts"
                      :key="account.id"
                      :value="account.id"
                    >
                      {{ account.name }}
                    </option>
                  </select>
                </td>
                <td>
                  <input
                    v-model="form.entries.debit"
                    type="text"
                    class="rounded-md w-36"
                  />
                </td>
                <td>
                  <input
                    v-model="form.entries.credit"
                    type="text"
                    class="rounded-md w-36"
                  />
                </td>
              </tr> -->
              <!-- :disabled="!!form.accounts.debit" -->

              <tr v-for="(entry, index) in form.entries" :key="entry.id">
                <td>
                  <select v-model="entry.account_id" class="rounded-md w-36">
                    <option
                      v-for="account in accounts"
                      :key="account.id"
                      :value="account.id"
                    >
                      {{ account.name }}
                    </option>
                  </select>
                </td>
                <td>
                  <!-- @change="see($event)" -->
                  <input
                    v-model="entry.debit"
                    type="text"
                    class="rounded-md w-36"
                    :v-bind="cal"
                  />
                </td>
                <!-- @change="see($event)" -->
                <td>
                  <input
                    v-model="entry.credit"
                    type="text"
                    class="rounded-md w-36"
                    :v-bind="cal"
                  />
                </td>
                <td>
                  <button
                    @click.prevent="deleteRow(index)"
                    class="border bg-indigo-300 rounded-xl px-4 py-2 m-4"
                  >
                    Delete
                  </button>
                </td>
              </tr>

              <tr>
                <th>Difference:</th>
                <th>Debit:</th>
                <th>Credit:</th>
              </tr>

              <tr>
                <td>
                  <input type="text" v-model="debit" class="rounded-md w-36" />
                </td>
                <td>
                  <input
                    type="text"
                    v-model="credit"
                    value="0"
                    class="rounded-md w-36"
                  />
                </td>
                <!-- <td>
                  <input type="text" class="rounded-md w-36" readonly />
                </td>
                <td>
                  <input type="text" class="rounded-md w-36" readonly />
                </td>
                <td>
                  <input type="text" class="rounded-md w-36" readonly />
                </td> -->
              </tr>
            </tbody>
          </table>
        </div>
        <div
          class="px-4 py-2 bg-gray-100 border-t border-gray-200 flex justify-start items-center"
        >
          <button
            class="border bg-indigo-300 rounded-xl px-4 py-2 ml-4 mt-4"
            type="submit"
          >
            Create Transaction
          </button>
        </div>
      </form>
      <!-- <div id="app">
        <select v-model="firstOption">
          <option v-for="(item, index) in list">{{ index }}</option>
        </select>
        <select v-model="secondOption" v-if="firstOption">
          <option v-for="option in list[firstOption]" value="option.size">
            {{ option.prize }}
          </option>
        </select>
      </div> -->

      <!-- <option v-for="option in list[firstOption]" value="option.size">{{option.prize}}</option> -->
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Label from "../../Jetstream/Label.vue";
import Datepicker from "vue3-datepicker";
import format from "date-fns/format";

export default {
  components: {
    AppLayout,
    Datepicker,
    format,
  },

  props: {
    errors: Object,

    companies: Object,
    comp_first: Object,

    years: Object,
    year_first: Object,

    doc_types: Object,
    doc_type_first: Object,

    accounts: Object,
    account_first: Object,

    // doc_types: Object,
    // doc_first: Object,

    // refe: Object,

    // account_type_first: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        company_id: this.comp_first.id,
        year_id: this.year_first.id,
        type_id: this.doc_type_first.id,
        // ref: this.accounts[0].id,
        date: "",

        entries: [
          {
            account_id: this.account_first.id,
            debit: 0,
            credit: 0,
          },
        ],
      }),
      debit: 0,
      credit: 0,
    };
  },

  methods: {
    submit() {
      this.form.date = format(this.form.date, "yyyy-MM-dd");
      this.$inertia.post(route("documents.store"), this.form);
    },

    addRow() {
      this.form.entries.push({
        account_id: this.account_first.id,
        debit: 0,
        credit: 0,
      });
    },

    deleteRow(index) {
      this.form.entries.splice(index, 1);
    },

    el: "#example",
    data: {
      message: "Hello",
    },
    computed: {
      // a computed getter
      reversedMessage: function () {
        // `this` points to the vm instance
        return this.message.split("").reverse().join("");
      },
    },

    // mounted(){
    //   this.debit = this.cal_debit,
    // },

    computed: {
      cal: function () {
        var cal_debit = 0;
        var cal_credit = 0;
        foreach((entry, index) in form.entries);
        {
          cal_debit = cal_debit + entry.debit[index];
          cal_credit = cal_credit + entry.credit[index];
        }
        console.log(cal_debit);
      },
    },
  },
};
</script>
