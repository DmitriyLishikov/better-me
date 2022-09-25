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

    <search-form></search-form>

    <div class="my-2">
        <Link :href="route('books.create')" class="bg-indigo-500 p-1 text-white">Create Book</Link>
    </div>


    <div class="flex flex-col">
        <h3 class="font-medium my-4">My books</h3>

        <div class="flex flex-col col-span-12 my-2">
            <div class="col-span-12 md:col-span-2 align-self-start">
                <div v-if="books.data.length < 1">
                    Not books
                </div>
                <div v-else>
                    <v-table>
                        <template #head>
                            <table-heading>№</table-heading>
                            <table-heading>Author</table-heading>
                            <table-heading>Title</table-heading>
                            <table-heading></table-heading>
                            <table-heading></table-heading>
                            <table-heading></table-heading>
                        </template>
                        <template #body>
                            <table-row v-for="(book, index)  in books.data" :key="book.id">
                                <table-cell>
                                    <span v-text="index + 1"></span>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('books.show', {book: book.id})" v-text="book.title"></Link>
                                </table-cell>
                                <table-cell>
                                    <span v-text="book.author"></span>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('books.show', {book: book.id})">Show</Link>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('books.edit', {book: book.id})">Update</Link>
                                </table-cell>
                                <table-cell>
                                    <form method="post" :action="route('books.destroy', {book: book.id})">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="submit" value="Delete" class="cursor-pointer">
                                    </form>
                                </table-cell>
                            </table-row>
                        </template>
                    </v-table>
                    <pagination class="mt-6" :items="books.data"></pagination>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col">
        <h3 class="font-medium my-4">My reviews</h3>

        <div class="flex flex-col col-span-12 my-2">
            <div class="col-span-12 md:col-span-2 align-self-start">
                <div v-if="reviews.data.length < 1">
                    Not reviews
                </div>
                <div v-else>
                    <v-table>
                        <template #head>
                            <table-heading>№</table-heading>
                            <table-heading>Title</table-heading>
                            <table-heading>Content</table-heading>
                            <table-heading>Year</table-heading>
                            <table-heading></table-heading>
                            <table-heading></table-heading>
                            <table-heading></table-heading>
                        </template>
                        <template #body>
                            <table-row v-for="(review, index)  in reviews.data" :key="review.id">
                                <table-cell>
                                    <span v-text="index + 1"></span>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('books.show', {book: review.book_id})" v-text="review.book.title"></Link>
                                </table-cell>
                                <table-cell>
                                    <span v-text="review.shortContent"></span>
                                </table-cell>
                                <table-cell>
                                    <span v-text="review.created_at"></span>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('reviews.show', {review: review.id})">Show</Link>
                                </table-cell>
                                <table-cell>
                                    <Link :href="route('reviews.edit', {review: review.id})">Update</Link>
                                </table-cell>
                                <table-cell>
                                    <form method="post" :action="route('reviews.destroy', {review: review.id})">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" name="_method" value="delete" />
                                        <input type="submit" value="Delete" class="cursor-pointer">
                                    </form>
                                </table-cell>
                            </table-row>
                        </template>
                    </v-table>
                    <pagination class="mt-6" :items="reviews.data"></pagination>
                </div>
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

    props: ['reviews', 'books'],

    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
}
</script>
