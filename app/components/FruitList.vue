<template>
  <a-input-group size="medium">
    <a-row style="margin: 15px 15px " :gutter="8">
      <a-col :span="2">
        <a-button
            type='primary'
            style='margin-bottom: 8px'
            @click='showAddFruitForm'
        >
          Add Fruit
        </a-button>
      </a-col>
      <a-col :span="4" :offset="10">
        <a-input placeholder="Name" v-model:value="filter.name"  />
      </a-col>
      <a-col :span="4">
        <a-input placeholder="Family" v-model:value="filter.family" />
      </a-col>
      <a-col :span="2">
        <a-button type="primary" @click="filterFruits()">
          Filter
        </a-button>
      </a-col>
      <a-col :span="2">
        <a-button type="default" @click="resetFilter()">
          Reset
        </a-button>
      </a-col>
    </a-row>
  </a-input-group>
  <a-table
      :dataSource='fruits'
      :columns='columns'
      rowKey='id'
      bordered
  >
    <template #action='{ record }'>
      <div>
        <a-button
            v-if="!record.isFavorite"
            type='primary'
            @click='toggleFavorite(record)'
            style='margin-right: 5px'
            ghost
        >
          <star-outlined />
          Add To Favorites
        </a-button>
        <a-button
            v-else
            type='primary'
            @click='toggleFavorite(record)'
            style='margin-right: 5px'
        >
          <star-filled />
          Favorite
        </a-button>
      </div>
    </template>
  </a-table>
  <a-modal v-model:visible="visible" title="New Fruit" @ok="saveFruit">
      <a-form-item has-feedback label="Name">
        <a-input v-model:value="fruit.name" type="text" autocomplete="off" />
      </a-form-item>
      <a-form-item has-feedback label="Genus">
        <a-input v-model:value="fruit.genus" type="text" autocomplete="off" />
      </a-form-item>
      <a-form-item has-feedback label="Family">
        <a-input v-model:value="fruit.family" type="text" autocomplete="off" />
      </a-form-item>
      <a-form-item has-feedback label="Order">
        <a-input v-model:value="fruit.order" />
      </a-form-item>
      <h6>Nutrition</h6>
      <hr>
      <a-form-item has-feedback label="Sugar">
        <a-input v-model:value="fruit.sugar" />
      </a-form-item>
      <a-form-item has-feedback label="Fat">
        <a-input v-model:value="fruit.fat" />
      </a-form-item>
      <a-form-item has-feedback label="Protein">
        <a-input v-model:value="fruit.protein" />
      </a-form-item>
      <a-form-item has-feedback label="Carbohydrates">
        <a-input v-model:value="fruit.carbohydrates" />
      </a-form-item>
      <a-form-item has-feedback label="Calories">
        <a-input v-model:value="fruit.calories" />
      </a-form-item>

  </a-modal>
</template>
<script>
import api from '../api';
import {reactive, ref} from 'vue';
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DeleteOutlined,
  WarningOutlined,
  StarOutlined,
  StarFilled
} from '@ant-design/icons-vue';

export default {
  components: {
    PlusOutlined,
    EditOutlined,
    EyeOutlined,
    DeleteOutlined,
    WarningOutlined,
    StarOutlined,
    StarFilled
  },
  setup(props) {
    let fruit = reactive({
      name: '',
      genus: '',
      family: '',
      order: '',
      sugar: '',
      fat: '',
      calories: '',
      protein: '',
      carbohydrates: ''
    });

    const visible = ref(false);
    const showAddFruitForm = () => {
      visible.value = true;
    };
    const handleOk = async e => {
      await api.helpPost('fruits', fruit)

      visible.value = false;

    };
    return {
      fruit,
      visible,
      showAddFruitForm,
      handleOk,
    };
  },
  data() {
    return {
      filter: {
        name: '',
        family: ''
      },
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
        },
        {
          title: 'Action',
          key: 'action',
          slots: {customRender: 'action'},
        },
      ]
    };
  },
  methods: {
    async saveFruit(){
      this.handleOk();
      this.fetchData();
    },
    async filterFruits(){
      this.fruits = await api.helpGet(`fruits?name=`+this.filter.name+'&family='+this.filter.family);

      let favorites = localStorage.getItem('favorites');

      let favorites_array = JSON.parse(favorites);

      for (let key in this.fruits){
        if(favorites_array.indexOf(this.fruits[key].id) !== -1){
          this.fruits[key].isFavorite = true;
        }
      }
    },
    async resetFilter(){
      this.filter.name = '';
      this.filter.family = '';
      await this.fetchData();
    },
    toggleFavorite(record) {

      let favorite_fruits = localStorage.getItem('favorites');
      let favorites_array = JSON.parse(favorite_fruits);
      if(favorites_array && favorites_array.length >= 10 && !record.isFavorite){
        alert('You can add only 10 fruits on favorite list')
        return;
      }

      record.isFavorite = !record.isFavorite;

      let favorites = [];
      this.fruits.forEach(fruit => {
        if(fruit.isFavorite){
          favorites.push(fruit.id);
        }
      })

      localStorage.setItem('favorites', JSON.stringify(favorites));
    },
    async fetchData(){
      this.fruits = await api.helpGet('fruits');
      let favorites = localStorage.getItem('favorites');

      let favorites_array = JSON.parse(favorites);

      if(favorites){
        for (let key in this.fruits){
          if(favorites_array.indexOf(this.fruits[key].id) !== -1){
            this.fruits[key].isFavorite = true;
          }
        }
      }

    },
  },

  async mounted() {
     await this.fetchData();
  }
};
</script>

