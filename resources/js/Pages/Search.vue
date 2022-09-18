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

        <h2 class="h2-custom">
            Search results
        </h2>

        <search-form></search-form>

        <div class="flex flex-col col-span-12 m-2">
            <div class="col-span-12 md:col-span-2 align-self-start">
                <div v-if="results.length < 1">
                    Not reviews
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
                            <table-row v-for="result in results.data" :key="result.id">
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="result.title"></span>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="result.author"></span>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="result.create_date"></span>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <Link  :href="route('books.show', result.id)" class="text-sm text-gray-700 dark:text-gray-500 underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <polygon points="7 7 15.586 7 5.293 17.293 6.707 18.707 17 8.414 17 17 19 17 19 5 7 5 7 7"/>
                                        </svg>
                                    </Link>
                                </table-cell>
                            </table-row>
                        </template>
                    </v-table>
                    <pagination class="mt-6" :items="results.data"></pagination>
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
        Pagination,
        TableCell,
        TableRow,
        TableHeading,
        SearchForm
    },

    props: ['results'],

    created() {
        console.log(this.results.data)
    }

}
</script>
