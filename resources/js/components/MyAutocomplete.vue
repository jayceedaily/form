<template>
<div class="field"  @blur="showOptions=false" tabindex="1">

    <p><label for="">{{label}}</label></p>


    <div class="field"  style="margin-bottom:2px;">
        <p><label>{{label}}</label></p>
        <div class="control" :class="isSearching ? 'is-loading' : ''">
            <input type="input" class="input" @keypress="searchItems" v-model="textValue" @focus="showOptions=true" :placeholder="placeholder">
        </div>

    </div>

    <!-- <input type="text" class="input is-loading"> -->
    <div class="columns" v-if="showOptions" style="height:20%; ">
        <div class="column" >
            <div class="columns" style="position:absolute; z-index:9999 !important">
                <div class="column">
                    <div class="card" style="overflow-y:auto; max-height:300px; width: 100%" tabindex="1" >
                        <div class="" >
                            <!-- <a href="" class="delete"></a> -->

                            <ul v-if="isSearching">
                                <li class="my-autocomplete-item" >Searching</li>
                            </ul>

                            <ul v-else-if="localItems.length > 0" >

                                <li tabindex="0" class="my-autocomplete-item" @click="handleSelect(false)">{{placeholder}}</li>

                                <li tabindex="0" class="my-autocomplete-item" v-for="item in localItems"
                                :key="item.id"
                                :item="item"
                                @click="handleSelect(item)">
                                    <span v-for="(value, index) in keyValue" :key="index">{{item[value]}} </span>
                                </li>
                            </ul>
                            <ul v-else>
                                <div class="notification">
                                        <button href="" class="delete" @click="showOptions=false"></button>
                                    <li>
                                        <div class="columns">
                                            <div class="column">
                                                No result found
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                Create <b>{{textValue}}</b>?
                                            </div>
                                        </div>
                                        <div class="columns">
                                            <div class="column">
                                                <a class="button is-fullwidth is-success" :class="isSaving ? 'is-loading' : ''" @click="handleSave">Save</a>
                                            </div>
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'MyAutoComplete',
    props: {
        endpoint:{
            required: true,
            type: String
        },

        items: {
            required: false,
            type: Array
        },

        label: {
            required: false,
            type: String,
            default: '',
        },

        value: {
            required: false,
            type: Number
        },

        placeholder: {
            required: false,
            type: String
        },

        allowCreate: {
            required: false,
            type: Boolean,
            default: false
        },

        keyValue: {
            required: false,
            type: Array,
            default: function() {
                return ['name']
            }
        }

    },

    data: function() {
        return {
            showOptions: false,
            isSearching: false,
            isSaving: false,
            textValue: '',
            localItems:[],
        }
    },

    computed: {
        listeners: function() {
            return {
                ...this.$listeners,
                input: event => this.$emit('input', event.target.value)
            }
        },

    },

    created: function() {


        this.localItems =  this.items;
        if(this.value != null) {

            let _value =  this.localItems.find(item => {
                return item.id == this.value
            });

            let _texValue = '';

            this.keyValue.forEach((value)=>{
                _texValue += _value[value] + ' ';
            });

            this.textValue = _texValue;

        }
    },
    watch: {
        showOptions: function(value) {
            if(value) {
                this.loadItems();
            }
        }
    },

    methods: {

        handleSelect: function(data) {

            if(data)
            {
                let _texValue = '';

                this.keyValue.forEach((value)=>{
                    _texValue += data[value] + ' ';
                });

                this.textValue = _texValue;

                this.$emit('input', data.id);

            } else {

                this.textValue = this.placeholder;

                this.$emit('input', null);
            }

            this.showOptions = false;

        },

        handleSave: function(data) {

            this.isSaving = true;
            http.store(this.endpoint, {name: this.textValue}).then((response) => {
                if(response.status == 201) {
                    this.handleSelect(response.data);
                    this.localItems.unshift(response.data);
                }
                this.isSaving = false;

            })
        },

        loadItems: function() {

            this.isSearching = true;

            http.get(this.endpoint).then((response)=> {
                this.localItems = response.data.data;
                this.isSearching = false;

            });
        },

        searchItems: function() {
            this.isSearching = true;
            http.get(this.endpoint + '?search=' + this.textValue).then((response) => {
                this.isSearching = false;

                this.localItems = response.data.data
            });
        }
    }

}
</script>

<style>

li.my-autocomplete-item {
    margin-bottom: 5px;
    cursor: pointer;
    padding: 10px;;
}

li.my-autocomplete-item:hover {
    background-color: #e2e2e2;
}


</style>
