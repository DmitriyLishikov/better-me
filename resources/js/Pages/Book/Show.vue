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

        <div class="flex flex-col col-span-12">
            <h2 class="h2-custom">
                {{book.title}}
            </h2>

            <search-form></search-form>

            <div class="flex justify-between">
                <div>
                    <Link class="filters" :href="route('reviews.create', {'book':book.id})">Add review</Link>
                </div>
                <div class="flex">
                    <button class="filters mr-4" @click="filterReview('author')">author</button>
                    <button class="filters" @click="filterReview('date')">date</button>
                </div>
            </div>

            <div class="col-span-12 md:col-span-2 align-self-start">
                <div v-if="reviews.length < 1">
                    Not reviews
                </div>
                <div v-else>
                    <v-table>
                        <template #head>
                            <table-heading>№</table-heading>
                            <table-heading>User</table-heading>
                            <table-heading>Content</table-heading>
                            <table-heading>Year</table-heading>
                        </template>
                        <template #body>
                            <table-row v-for="(review, index)  in reviews" :key="book.id">
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <Link :href="route('reviews.show', {review: review.id})" v-text="index + 1"></Link>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="review.user.name"></span>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="review.content"></span>
                                </table-cell>
                                <table-cell class="text-sm font-medium text-gray-900">
                                    <span v-text="review.created_at"></span>
                                </table-cell>
                            </table-row>
                        </template>
                    </v-table>
                    <pagination class="mt-6" :items="book.reviews"></pagination>
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

    props: ['book'],

    data() {
        return {
            reviews: {},
            filterDateOrder: 'DESC',
            filterAuthorOrder: 'DESC',
        }
    },
    created() {
        this.reviews = this.book.reviews;
    },

    methods: {
        filterReview(filter) {
            axios.post("/book-review-filter", {
                book_id: this.book.id,
                filter: filter,
                filterDateOrder: this.filterDateOrder,
                filterAuthorOrder: this.filterAuthorOrder
            }).then(response => {
                this.filterDateOrder === 'DESC' ? this.filterDateOrder = 'ASC' : this.filterDateOrder = 'DESC';
                this.filterAuthorOrder === 'DESC' ? this.filterAuthorOrder = 'ASC' : this.filterAuthorOrder = 'DESC';
                this.reviews = response.data;
            }).catch(error => {
                console.error("There was an error!", error);
            });
        }
    },
}
</script>
