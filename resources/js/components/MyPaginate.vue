<template >
    <nav  v-if="lastPage != 1" class="pagination is-centered" role="navigation" aria-label="pagination">
        <a v-if="hasPrevPage" class="pagination-previous" @click="changePage(currentPage-1)">Previous</a>
        <a v-if="hasNextPage" class="pagination-next" @click="changePage(currentPage+1)">Next page</a>
        <ul class="pagination-list">
            <li v-for="(page, index) in pages" :key=index>
                <a class="pagination-link" aria-label="Goto page 1" :class="page.isCurrent ? 'is-current disabled' : ''" @click="changePage(page.number)">{{page.number}}</a>
            </li>
        </ul>
    </nav>

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

    methods: {

        changePage: function(page) {

            if(page != this.currentPage) {

                this.$emit('pageChange', page);
            }

        }

    },


}
</script>

<style>

</style>
