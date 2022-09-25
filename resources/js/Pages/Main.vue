<template>
        <div class="relative flex items-top justify-center sm:items-center sm:pt-0">
            <div class="hidden px-6 py-4 sm:block">
                <Link  href='/' class="mr-4 text-sm text-gray-700 dark:text-gray-500 underline">Library Manager</Link>
                <Link v-if="$page.props.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>
                <template v-else>
                    <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                    <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
                </template>
            </div>
        </div>

        <h2 class="flex flex-col w-3/4">
            <p class="h2-custom">Library</p>
            <p class="h2-custom ml-auto">Manager</p>
        </h2>

        <search-form></search-form>

        <div class="flex flex-col col-span-12 m-2">
            <div class="col-span-12 md:col-span-2 align-self-start">
                <div v-if="books.data.length < 1">
                    Empty library
                </div>
                <div v-else>
                    <v-table>
                        <template #head>
                            <table-heading>Title</table-heading>
                            <table-heading>Author</table-heading>
                            <table-heading>Date</table-heading>
                            <table-heading></table-heading>
                        </template>
                        <template #body>
                            <table-row v-for="book in books.data" :key="book.id">
                                <table-cell class="">
                                    <span v-text="book.title"></span>
                                </table-cell>
                                <table-cell class="">
                                    <span v-text="book.author"></span>
                                </table-cell>
                                <table-cell class="">
                                    <span v-text="book.create_date"></span>
                                </table-cell>
                                <table-cell class="text-center">
                                    <Link  :href="route('books.show', book.id)" class="underline">
                                        <svg class="my-0 mx-auto" width="26" height="26" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.62884 0.75H1.37884V1V2.33441V2.58441H1.62884H22.1186L0.823223 23.8798L0.646415 24.0566L0.823255 24.2334L1.76701 25.1768L1.94379 25.3535L2.12054 25.1768L23.3966 3.90074V24.3521V24.6021H23.6466H24.981H25.231V24.3521V2.33441V1V0.75H24.981H23.6466H1.62884Z" fill="black" stroke="black" stroke-width="0.5"/>
                                        </svg>
                                    </Link>
                                </table-cell>
                            </table-row>
                        </template>
                    </v-table>
                    <pagination class="mt-6" :items="books"></pagination>
                </div>
            </div>
        </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import VTable from "@/Components/Table/Table.vue";
import TableHeading from "@/Components/Table/Heading.vue";
import TableRow from "@/Components/Table/Row.vue";
import TableCell from "@/Components/Table/Cell.vue";
import Pagination from '@/Components/Pagination.vue';
import SearchForm from '@/Components/SearchForm.vue';

export default {
    components: {
        Link,
        VTable,
        SearchForm,
        Pagination,
        TableCell,
        TableRow,
        TableHeading,
    },

    props: ['books'],
}
</script>
