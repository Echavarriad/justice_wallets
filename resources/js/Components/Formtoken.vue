<template>
    <div class="px-6 py-6 lg:px-8">
        <h3 class="mb-4 text-xl font-medium text-white dark:text-white">
            Pay method!
        </h3>
        <form class="space-y-6" @submit.prevent="submit">
            <div>
                <label
                    for="Document"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Your document</label
                >
                <input
                    type="number"
                    name="document"
                    id="document"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    placeholder="1234"
                    required
                    v-model="form.document"
                />
            </div>
            <div>
                <label
                    for="phone"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                    >Your token</label
                >
                <input
                    type="text"
                    name="token"
                    id="token"
                    placeholder="123456"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                    required
                    v-model="form.token"
                />
            </div>

            <button
                type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                v-on:click="token()"
                @click="$emit('close')"
            >
                validar
            </button>
        </form>
    </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
    name: "Formtoken",
    data() {
        return {
            form: {
                document: "",
                token: "",
            },
        };
    },
    methods: {
        token() {
            axios
                .post("http://127.0.0.1:8000/api/valtoken", this.form)
                .then((res) => {
                    console.log(res);
                    Swal.fire(
                        "Good job!",
                        "An email has been sent to the email address you are registered with",
                        "success"
                    );
                })
                .catch(function (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Token erroneo!",
                    });
                });
        },
    },
};
</script>
