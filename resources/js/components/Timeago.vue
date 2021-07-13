<template>
    <div class="tooltip">{{timeagoOrExact(datetime)}}<span class="tooltiptext">{{emojoOftime}} {{moment(datetime).format('LLL')}}  </span></div>
</template>

<script>
import moment from 'moment';
export default {
    name: 'Timeago',

    props: ['datetime'],

    computed: {
        emojoOftime: function() {


            let reference = moment(this.datetime).clone();

            // if(reference.isBetween(moment('00:00:01','hh:mm:ss'),moment('05:00:00','hh:mm:ss'))) return '🌃';
            // if(reference.isBetween(moment('05:00:00','hh:mm:ss'),moment('06:00:00','hh:mm:ss'))) return '🌄';
            // if(reference.isBetween(moment('06:00:00','hh:mm:ss'),moment('17:00:00','hh:mm:ss'))) return '😎';
            // if(reference.isBetween(moment('17:00:00','hh:mm:ss'),moment('18:00:00','hh:mm:ss'))) return '🌆';
            // if(reference.isBetween(moment('18:00:00','hh:mm:ss'),moment('23:59:59','hh:mm:ss'))) return '🌃';
        }
    },

    methods: {
        moment: function(value) {
            return moment(value);
        },

        timeagoOrExact: function(value) {

            let A_WEEK_OLD = moment().clone().subtract(7, 'days').startOf('day');

            let reference = moment(value).clone();

            if(!reference.clone().isAfter(A_WEEK_OLD)) {
                 return moment(value).format('MMM D, YYYY')
            } else {
                return moment(value).fromNow()
            }
        },
    }

}
</script>

<style>

 /* Tooltip container */
.tooltip {
    position: relative;
    cursor: pointer;
    display: inline-block;
    /* // border-bottom: 1px dotted black; If you want dots under the hoverable text */
  }

  /* Tooltip text */
  .tooltip .tooltiptext {
    visibility: hidden;
    width: 200px;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 5px 5px;
    border-radius: 6px;

    /* Position the tooltip text - see examples below! */
    position: absolute;
    z-index: 1;
  }

  /* Show the tooltip text when you mouse over the tooltip container */
  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>
