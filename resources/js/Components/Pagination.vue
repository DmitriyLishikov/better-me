<template>
    <nav v-if="items.last_page > 1" role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between px-6 py-4">
        <div class="flex justify-between flex-1 sm:hidden">
            <span>
                <span v-if="items.current_page === 1" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    Предыдущая
                </span>
                <nav-link v-else :href="items.prev_page_url" preserve-scroll dusk="previousPage.before" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Предыдущая
                </nav-link>
            </span>

            <span>
                <nav-link v-if="items.next_page_url !== null" :href="items.next_page_url" preserve-scroll dusk="nextPage.before" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    Следующая
                </nav-link>
                <span v-else class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    Следующая
                </span>
            </span>
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-700 leading-5">
                    <span>Показано </span>
                    <span class="font-medium" v-text="items.from"></span>
                    <span> до </span>
                    <span class="font-medium" v-text="items.to"></span>
                    <span> из </span>
                    <span class="font-medium" v-text="items.total"></span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rounded-md shadow-sm">
                    <span>
<!--                    Previous Page Link -->
                        <span v-if="items.current_page === 1" aria-disabled="true" aria-label="Previous">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                        <nav-link v-else :href="items.prev_page_url" preserve-scroll dusk="previousPage.after" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Previous">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </nav-link>
                    </span>

<!--                Pagination Elements -->
                    <span v-for="(link, index) in items.links" :key="index">
                        <span v-if="index > 0 && index < items.links.length - 1">
<!--                        "Three Dots" Separator -->
                            <span v-if="link.url === null" aria-disabled="true">
                                <span v-text="link.label" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5"></span>
                            </span>
<!--                        Array Of Links -->
                            <span v-else>
                                <span v-if="link.active" aria-current="page">
                                    <span v-text="link.label" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5"></span>
                                </span>
                                <nav-link v-else v-text="link.label" :href="link.url" preserve-scroll class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" :aria-label="`Go to page ${link.label}`">
                                </nav-link>
                            </span>
                        </span>
                    </span>

                    <span>
<!--                    Next Page Link-->
                        <nav-link v-if="items.next_page_url !== null" :href="items.next_page_url" preserve-scroll dusk="nextPage.after" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="Next">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </nav-link>
                        <span v-else aria-disabled="true" aria-label="Next">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    </span>
                </span>
            </div>
        </div>
    </nav>
</template>

<script>
import NavLink from './NavLink.vue';

export default {
    components: {
        NavLink
    },
    props: {
        items: Object,
    },
}
</script>
