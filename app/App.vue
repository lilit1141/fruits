<template>
  <div class='container'>
    <a-menu v-model:selectedKeys="current" mode="horizontal">
      <a-menu-item key="fruits">
        <router-link to="/">
          <template #icon>
            <unordered-list-outlined />
          </template>
          All Fruits
        </router-link>
      </a-menu-item>
      <a-menu-item key="favorites">
        <router-link to="favorites">
          <template #icon>
            <star-filled />
          </template>
          Favorites
        </router-link>
      </a-menu-item>
    </a-menu>
    <router-view></router-view>
  </div>
</template>

<script>
import BooksList from './components/FruitList.vue';
import BookItem from './components/BookItem';
import { StarFilled, UnorderedListOutlined } from '@ant-design/icons-vue';
import { ref } from 'vue';



export default {
  components: {
    UnorderedListOutlined,
    StarFilled,
    BooksList,
    BookItem
  },
  setup() {
    const current = ref(['fruits']);
    return {
      current,
    };
  },
}
</script>

<style scoped>
.container {
  padding: 2%;
}
</style>
