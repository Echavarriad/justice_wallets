<template>
    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <div class="items-center justify-center">
                <div
                    class="border-2 border-cyan-500 rounded-3xl m-1 text-center p-8"
                >
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 m-4">
                        wallet balance!
                    </h1>
                    <div class="flex items-center justify-center">
                        <h1 class="p-4 m-2">
                            <strong>$0,00</strong>
                        </h1>
                    </div>
                    <button
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        @click="showModalsaldo = true"
                    >
                        Consultar saldo
                    </button>
                </div>
                <div
                    class="border-2 border-cyan-500 rounded-3xl m-1 justify-center"
                >
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 m-4">
                        Reload justice wallet!
                    </h1>
                    <div class="flex items-center justify-center">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            @click="showModal = true"
                        >
                            Reload
                        </button>
                    </div>
                </div>
                <div class="border-2 border-cyan-500 rounded-3xl m-1">
                    <h1 class="mt-8 text-2xl font-medium text-gray-900 m-4">
                        Payment method!
                    </h1>
                    <div class="flex items-center justify-center">
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            @click="showModalpay = true"
                        >
                            Pay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <Transition>
        <div>
            <DialogModal :show="showModal" @close="close" />

            <DialogModalpay :show="showModalpay" @close="closepay" />

            <DialogModalsaldo :show="showModalsaldo" @close="closesaldo" />
        </div>
    </Transition>
</template>
<script>
import DialogModal from "./DialogModal.vue";
import DialogModalpay from "./DialogModalpay.vue";
import DialogModalsaldo from "./DialogModalsaldo.vue";
import DialogModaltoken from "./DialogModaltoken.vue";
import CustomModal from "@/Components/CustomModal.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import PrimaryButton from "./PrimaryButton.vue";
import axios from "axios";

export default {
    name: "Content",
    data() {
        return {
            showModal: false,
            showModalpay: false,
            showModalsaldo: false,
        };
    },
    components: {
        DialogModal,
        DialogModalpay,
        DialogModalsaldo,
        DialogModaltoken,
    },
    methods: {
        consultar() {
            console.log(this);
        },
        pagar() {
            console.log("pagar");
        },
        close() {
            this.showModal = false;
        },
        closepay() {
            this.showModalpay = false;
        },
        closesaldo() {
            this.showModalsaldo = false;
        },
    },
};
</script>
