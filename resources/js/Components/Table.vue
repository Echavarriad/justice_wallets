<template>
    <div class="relative overflow-x-auto">
        <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
        >
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
                <tr>
                    <th scope="col" class="px-6 py-3">id</th>
                    <th scope="col" class="px-6 py-3">Document</th>
                    <th scope="col" class="px-6 py-3">Estatus</th>
                    <th scope="col" class="px-6 py-3">Referencia</th>
                    <th scope="col" class="px-6 py-3">Total</th>
                    <th scope="col" class="px-6 py-3">Validar</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="(dato, index) in datos"
                    :key="index"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                >
                    <td v-text="dato.id"></td>
                    <td v-text="dato.document"></td>
                    <td v-text="dato.estatus"></td>
                    <td v-text="dato.ref"></td>
                    <td v-text="dato.total"></td>
                    <td>
                        <button
                            class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            @click="showModaltoken = true"
                        >
                            Validar token
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <DialogModaltoken :show="showModaltoken" @close="closetoken" />
    </div>
</template>
<script>
import Swal from "sweetalert2";
import DialogModaltoken from "./DialogModaltoken.vue";
export default {
    name: "Formcheck",
    data() {
        return {
            datos: [],
            showModaltoken: false,
        };
    },
    components: {
        DialogModaltoken,
    },
    methods: {
        getshop() {
            axios
                .get("http://127.0.0.1:8000/api/historyshop")
                .then((res) => {
                    console.log(res.data);
                    this.datos = res.data;
                })
                .catch(function (error) {});
        },
        closetoken() {
            this.showModaltoken = false;
        },
    },
    mounted() {
        this.getshop();
    },
};
</script>
