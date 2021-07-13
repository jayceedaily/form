<template>
    <div class="tooltip"><slot/>  <span class="tooltiptext">{{tooltipValue}}</span></div>
</template>

<script>
import moment from 'moment';
export default {
    name: 'Timeago',

    props: ['tooltipValue'],



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
