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

    <h2 v-text="review.book.title"
        class="font-semibold text-xl text-gray-800 leading-tight">
    </h2>

    <div class="m-2">
        <h4>Content</h4>
        <div class="content m-2" v-text="review.content"></div>
    </div>
    <div class="rate m-2" v-text="'Rate: ' + review.content"></div>
    <div class="author-review m-2" v-text="'Author book: ' + review.book.author"></div>
    <div class="author-review m-2" v-text="'Author review: ' + this.user.name"></div>
</template>

<script>

import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: ['review', 'user'],
}
</script>
