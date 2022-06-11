import Home from './components/Home.vue';
import ProductCard from './components/ProductCard.vue';
import Reviews from './components/Reviews.vue';
import Questions from './components/Questions.vue';
import NotFound from './components/404.vue';


export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'product',
        path: '/product',
        component: ProductCard
    },
    {
        name: 'reviews',
        path: '/reviews',
        component: Reviews
    },
    {
        name: 'questions',
        path: '/questions',
        component: Questions
    },
    {
        name: 'notfound',
        path: '*',
        component: NotFound
    },
];
