<template>
    <form method="get" :action="route('search')" class="my-6">
        <input type="text" name="search" placeholder="Search..." required minlength="3" class="p-1"/>
        <input type="submit" value="Search" class="bg-indigo-600 p-1 h-full border-2 text-white">
    </form>
</template>
