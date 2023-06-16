<script >

import axios from 'axios'

export default {
    props: {
        listId: {
            type: Number,
            required: true
        }
    },
    watch: {
        listId(newId, oldId) {
            console.log("Getriggert: ", newId)
            if(newId !== oldId) {
                this.getList(newId)
            }
        }
    },
    data() {
        return {
            list: null,
            formData: {
                name: null
            }
        }
    },
    methods: {
        toggleItem(item) {
            console.log(item.is_completed)

            if (item.is_completed) {
                this.uncheckItem(item)
            } else {
                this.checkItem(item)
            }
        },
        uncheckItem(item) {
            axios.patch('http://localhost:80/api/check-list-items/' + item.id + '/unfinish')
                .then(r => {
                    console.log(r)
                })
                .catch(e => {
                    console.warn(e)
                })
        },
        checkItem(item) {
            axios.patch('http://localhost:80/api/check-list-items/' + item.id + '/finish')
                .then(r => {
                    console.log(r)
                })
                .catch(e => {
                    console.warn(e)
                })
        },
        getList(listId) {
            console.log("Get list", listId)
            axios.get('http://localhost:80/api/check-lists/' + listId)
            .then(r => {
                console.log(r)
                this.list = r.data
            })
            .catch(e => {
                console.warn(e)
            })
        },
        addNewItem() {
            axios.post("http://localhost:80/api/check-list-items", {
                check_list_id: this.list.id,
                name: this.formData.name
            })
            .then(r => {
                console.log(r)
                this.formData.name = null
                this.list.items.push(r.data.data)
            })
            .catch(e => {
                console.warn(e)
            })
        },
        deleteItem(itemId, index) {
            axios.delete("http://localhost:80/api/check-list-items/" + itemId)
            .then(r => {
                this.list.items.splice(index, 1)
                console.log("Deleted", r)
            })
            .catch(e => {
                console.warn(e)
            })
        }
    }
}
</script>

<template>
    <div v-if="list">
        <hr>
        <h3>{{ list.name }}</h3>

        <p>
            User: {{ list.user.name }}<br>
            Email: {{ list.user.email }}
        </p>

        <ul>
            <li v-for="(item, index) in list.items" :index="index" :key="item.id">
                <input type="checkbox" :checked="item.is_completed" @change="toggleItem(item)" />
                {{ item.name }}
                <small><button type="button" @click="deleteItem(item.id, index)">delete</button></small>
            </li>
        </ul>

        <input type="text" v-model="formData.name" />
        <button type="button" @click="addNewItem">Add</button>
    </div>
</template>