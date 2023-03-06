<template>
  <h4 style="margin-top: 15px">Sum of nutritions facts: {{ this.nutrition_sum }}</h4>
  <a-table
      :dataSource='fruits'
      :columns='columns'
      rowKey='id'
      bordered
  >
  </a-table>
</template>

<script>
import api from "../api";

export default {
  name: "FavoriteList",
  data(){
    return {
      nutrition_sum: null,
      fruits: [],
      columns: [
        {
          title: 'Name',
          dataIndex: 'name',
          key: 'name',
          ellipsis: true
        },
        {
          title: 'Genus',
          dataIndex: 'genus',
          key: 'genus',
        },
        {
          title: 'Family',
          dataIndex: 'family',
          key: 'family',
        },
        {
          title: 'Order',
          key: 'order',
          dataIndex: 'order',
        }
      ]
    }
  },
  async mounted() {
    await this.fetchData();
  },
  methods: {
    async fetchData(){
      let favorites = localStorage.getItem('favorites');
      this.fruits = await api.helpGet('fruits?ids='+favorites);

      for (let key in this.fruits){
        this.nutrition_sum += this.fruits[key].nutrition_sum;
      }
    }
  }
}
</script>

<style scoped>

</style>
