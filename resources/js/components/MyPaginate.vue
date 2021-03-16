<template >
<div class="columns is-vcentered">
    <div class="column">

        <p class="has-text-grey">{{from}} - {{to}} of {{totalItem}}</p>
        <p>
            <div class="select">
                <select v-model="limitx">
                    <option value="15">15</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </p>
    </div>
    <div class="column">

        <nav  v-if="lastPage != 1" class="pagination is-pulled-right mb-0" role="navigation" aria-label="pagination">
            <ul class="pagination-list">
                <li>
                    <a v-if="hasPrevPage" class="pagination-previous" @click="changePage(currentPage-1)"><i class="material-icons">navigate_before</i></a>
                </li>
                <li v-for="(page, index) in pages" :key=index>
                    <a class="pagination-link" aria-label="Goto page 1" :class="page.isCurrent ? 'is-current disabled' : ''" @click="changePage(page.number)">{{page.number}}</a>
                </li>

                <li>
                    <a v-if="hasNextPage" class="pagination-next" @click="changePage(currentPage+1)"><i class="material-icons">navigate_next</i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

</template>

<script>
export default {
    name: 'MyPaginate',
    props: {
        currentPage: {
            type: Number,
            required: true,
            default: 1
        },

        lastPage: {
            type: Number,
            required: true,
            default: 1
        },

        totalItem: {
            type: Number,
            required: true,
            default: 1
        },

        from: {
            type: Number,
            required: false,
            default: 0,
        },

        to: {
            type: Number,
            required: false,
            default: 0,
        },

        limit: {
            type: Number,
            required: false,
            default: 15
        }
    },

    data: function() {
        return {
            limitx: 50
        }
    },

    computed: {

        pages: function() {

            let pages = [];


            let start_page = 1;

            if(this.currentPage > 3 ) {

                start_page = this.currentPage - 2
            }

            let end = start_page + 5 > this.lastPage ? this.lastPage + 1 : start_page + 5;

            for (let index = start_page; index < end; index++) {

                pages.push({

                    number: index,

                    isCurrent: index == this.currentPage

                });
            }

            return pages;
        },

        hasNextPage: function()
        {
            return this.currentPage != this.lastPage;
        },

        hasPrevPage: function()
        {
            return this.currentPage != 1;
        }
    },

    watch: {
        limitx: function(limit) {
            if(limit != this.limit) {

                this.$emit('limitChange', limit);
            }
        }
    },

    methods: {

        changePage: function(page) {

            if(page != this.currentPage) {

                this.$emit('pageChange', page);
            }
        },

        changeLimit: function(limit) {
            console.log(limit)
            if(limit != this.limit) {

                this.$emit('limitChange', limit);
            }
        }

    },
}
</script>

<style>

</style>
