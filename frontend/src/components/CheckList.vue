<script >

import axios from 'axios'

import SingleList from './SingleList.vue'

export default {
    components: {
        SingleList
    },
    data() {
        return {
            checkLists: [],
            list: null
        }
    },
    props: {
        title: {
            type: String,
            required: false,
            default: "Platzhalter"
        }
    },
    mounted() {
        axios.get('http://localhost:80/api/check-lists')
            .then(r => {
                this.checkLists = r.data.data
            })
            .catch(e => {
                console.warn(e.message)
            })
    },
    methods: {
        showListDetails(listId){
            this.list = listId
        }
    }
}
</script>

<template>
    <div>
        <h1>{{ title }}</h1>

        <table>
            <thead>
                <tr>
                    <th>Liste</th>
                    <th>Aktion</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(checkList, index) in checkLists" :key="checkList.id" :index="index">
                    <td>{{ checkList.name }}</td>
                    <td>
                        <button type="button" @click="showListDetails(checkList.id)">Details</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <SingleList v-if="list" :listId="list" />

        <div v-else>
            <p>Bitte Liste wählen</p>
        </div>
    </div>
</template>