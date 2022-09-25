<template>
    <div class="flex flex-col relative">
        <div class="overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full">
                <div class="overflow-hidden border-b border-gray-200">
                    <table class="min-w-full">
                        <thead class="">
                        <tr>
                            <slot name="head"/>
                        </tr>
                        </thead>

                        <tbody class="">
                        <slot name="body"/>
                        </tbody>

                        <tbody v-if="$slots.summary" class="">
                        <slot name="summary"/>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VTable"
}
</script>

<style scoped>

</style>
