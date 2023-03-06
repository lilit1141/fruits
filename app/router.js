import {createRouter, createWebHistory} from 'vue-router';
import BookItem from './components/BookItem';
import BookForm from './components/BookForm';
import FruitList from "./components/FruitList";
import FavoriteList from "./components/FavoriteList";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            name: 'fruits',
            path: '/',
            component: FruitList,
        },
        {
            name: 'favorites',
            path: '/favorites',
            component: FavoriteList,
        },
        {
            name: 'book-form',
            path: '/book/edit/:bookId?',
            component: BookForm,
            props: true,
            alias: '/book/add'
        },
        {
            name: 'book-item',
            path: '/book/:bookId(\\d+)',
            component: BookItem,
            props: true
        },
    ],
});

export default router;
