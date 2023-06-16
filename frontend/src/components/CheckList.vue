<script setup>
import { onMounted, ref} from 'vue'
import axios from 'axios'

let checkLists = []
let foo = "bar"

defineProps({
    title: String
})

onMounted(() => {
    console.log("Test")
    console.log("Checklists", checkLists)

    axios.get('http://localhost:80/api/check-lists')
    .then(r => {
        console.log(r)
        checkLists = r.data.data.data
    })
    .catch(e => {
        console.warn(e.message)
    })
    console.log("Checklists neu", checkLists)
})

</script>

<template>
    <div>
        <h1>{{ title }}</h1>
    </div>
</template>