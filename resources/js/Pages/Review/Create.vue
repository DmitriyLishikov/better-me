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
    <h2 v-text="`Create a review for ` + book.title"
        class="font-semibold text-xl text-gray-800 leading-tight">
    </h2>
    <form class="flex flex-col w-1/2" method="post" :action="route('reviews.store')">
        <input type="hidden" name="book_id" :value="book.id">
        <input type="hidden" name="_token" :value="csrf">

        <div class="flex flex-col m-2">
            <label>Rating</label>
            <select name="rate" required>
                <option value="1" >1</option>
                <option value="2" >2</option>
                <option value="3" >3</option>
                <option value="4" >4</option>
                <option value="5" >5</option>
            </select>
        </div>
        <div class="flex flex-col m-2">
            <label>Text review</label>
            <textarea required name="content"></textarea>
        </div>
        <div class="flex justify-between">
            <input type="submit" class="bg-indigo-600 p-1 text-white" value="Submit">
            <a @click="previous" class="cursor-pointer bg-red-600 p-1 text-white" >Back</a>
        </div>
    </form>
</template>

<script>

import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },
    props: {
        book: {},
    },

    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },

    methods: {
        previous() {
            window.history.back();
        },
    }
}
</script>
