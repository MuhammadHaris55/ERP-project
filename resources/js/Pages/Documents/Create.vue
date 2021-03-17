<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transactions
      </h2>
    </template>
    <div class="">
      <form @submit.prevent="submit">
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

        <div class="p-2 mr-2 mb-2 ml-6 flex flex-wrap">
          <select
            v-model="form.ref"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="voucher"
            placeholder="Enter Voucher"
          >
            <option
              v-for="type in custom_object"
              :key="type.id"
              :value="type.id"
            >
              {{ type.name }}
            </option>
          </select>
          <div v-if="errors.type">{{ errors.type }}</div>
        </div>

        <div class="p-2 mr-2 mb-2 mt-4 ml-6 flex flex-wrap">
          <input
            type="text"
            v-model="form.ref"
            class="pr-2 pb-2 w-full lg:w-1/4 rounded-md"
            label="ref"
            readonly
            :value="custom_object.prefix"
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
                    v-model="form.accounts.type_id"
                    class="rounded-md w-36"
                  >
                    <option
                      v-for="account in account_types"
                      :key="account.id"
                      :value="account.id"
                    >
                      {{ account.name }}
                    </option>
                  </select>
                </td>
                <td>
                  <input
                    v-model="form.accounts.debit"
                    type="text"
                    class="rounded-md w-36"
                  />
                </td>
                <td>
                  <input
                    v-model="form.accounts.credit"
                    type="text"
                    class="rounded-md w-36"
                  />
                </td>
              </tr> -->

              <tr v-for="(account, index) in form.accounts" :key="account.id">
                <td>
                  <select v-model="account.type_id" class="rounded-md w-36">
                    <option
                      v-for="account in account_types"
                      :key="account.id"
                      :value="account.id"
                    >
                      {{ account.name }}
                    </option>
                  </select>
                </td>
                <td>
                  <input
                    v-model="account.debit"
                    type="text"
                    class="rounded-md w-36"
                  />
                </td>
                <td>
                  <input
                    v-model="account.credit"
                    type="text"
                    class="rounded-md w-36"
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
                  <input type="text" class="rounded-md w-36" readonly />
                </td>
                <td>
                  <input type="text" class="rounded-md w-36" readonly />
                </td>
                <td>
                  <input type="text" class="rounded-md w-36" readonly />
                </td>
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

    account_types: Object,
    account_first: Object,

    // doc_types: Object,
    // doc_first: Object,

    // refe: Object,

    companies: Object,
    comp_first: Object,

    years: Object,
    year_first: Object,

    custom_object: Object,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: null,
        // type_id: this.account_first.id,
        date: "",
        ref: this.custom_object[0].id,
        company_id: this.comp_first.id,
        year_id: this.year_first.id,
        accounts: [
          {
            type_id: this.account_first.id,
            debit: 0,
            credit: 0,
          },
        ],
      }),
    };
  },

  methods: {
    submit() {
      this.form.date = format(this.form.date, "yyyy-MM-dd");
      this.$inertia.post(route("documents.store"), this.form);
    },

    addRow() {
      this.form.accounts.push({
        type_id: this.account_first.id,
        debit: 0,
        credit: 0,
        // ledger: "",
        // statement: "",
        // confirmation: "",
        // company_id: "",
        // account_id: "",
        // account_id: this.accounts[0].id,
        // year_id: "",
      });
    },

    deleteRow(index) {
      this.form.accounts.splice(index, 1);
    },
  },
};
</script>
