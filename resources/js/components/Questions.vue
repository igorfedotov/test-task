<template>
    <div class="display" v-if="questions">
        <div class="wrapper">

            <Title title="Вопросы"></Title>

            <nav class="top-nav">
                <ul class="top-menu">
                    <li><a href="#">Видеобзоры</a></li>
                    <li><router-link :to="'/reviews'">Отзывы</router-link></li>
                    <li class="selected"><a href="#">Вопросы</a></li>
                </ul>
            </nav>

            <section class="review-list">
                <div class="review" v-for="item in questions">

                    <ReviewItem :author="item.author" :createdAt="item.createdAt" :text="item.text">
                    </ReviewItem>

                    <div class="answer" v-if="item.answer">
                        <ReviewResponseItem :responseText="item.answer"></ReviewResponseItem>
                    </div>

                </div>
                <button class="review__button">Задать вопрос</button>
            </section>

            <BottomNav></BottomNav>

        </div>
    </div>
</template>
<script>
import BottomNav from './BottomNav.vue';
import Title from './Title.vue';
import ReviewItem from './ReviewItem.vue';
import ReviewResponseItem from './ReviewResponseItem.vue';

export default {
    components: {
        BottomNav,
        Title,
        ReviewItem,
        ReviewResponseItem
    },
    data() {
        return {
            questions: null,
        }
    },
    created() {
        this.axios
            .get('http://localhost/api/v1/questions')
            .then((response) => {
                this.questions = response.data.data;
            });
    },
    methods: {}
}
</script>
