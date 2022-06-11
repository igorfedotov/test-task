<template>
    <div class="display" v-if="reviews">
        <div class="wrapper">

            <Title title="Отзывы"></Title>

            <nav class="top-nav">
                <ul class="top-menu">
                    <li><a href="#">Видеобзоры</a></li>
                    <li class="selected"><a href="#">Отзывы</a></li>
                    <li><router-link :to="'/questions'">Вопросы</router-link></li>
                </ul>
            </nav>

            <section class="review-list">
                <div class="reviews-sum">
                    <div class="reviews-sum__stars">
                        <img src="/img/star_full.svg" v-for="item in reviews.mean">
                        <img src="/img/star_empty.svg" v-for="item in reviews.empty">
                    </div>
                    <div class="reviews-sum__text">{{ reviews.reviewsCnt }} {{ numWord(reviews.reviewsCnt, ['отзыв',
                            'отзыва', 'отзывов'])
                    }}</div>
                    <div class="reviews-sum-params">
                        <div class="reviews-sum__row">
                            <div class="reviews-sum__cell">Маломерит</div>
                            <div class="reviews-sum__cell">
                                <div class="reviews-sum__chart">
                                    <span class="line-empty">
                                        <span class="line-full" :style="{ width: reviews.smallSize + '%' }"></span>
                                    </span>
                                </div>
                                <div class="reviews-sum__mark">{{ reviews.smallSize }}%</div>
                            </div>
                        </div>
                        <div class="reviews-sum__row">
                            <div class="reviews-sum__cell">Соответствует размеру</div>
                            <div class="reviews-sum__cell">
                                <div class="reviews-sum__chart">
                                    <span class="line-empty">
                                        <span class="line-full" :style="{ width: reviews.fitSize + '%' }"></span>
                                    </span>
                                </div>
                                <div class="reviews-sum__mark">{{ reviews.fitSize }}%</div>
                            </div>
                        </div>
                        <div class="reviews-sum__row">
                            <div class="reviews-sum__cell">Большемерит</div>
                            <div class="reviews-sum__cell">
                                <div class="reviews-sum__chart">
                                    <span class="line-empty">
                                        <span class="line-full" :style="{ width: reviews.bigSize + '%' }"></span>
                                    </span>
                                </div>
                                <div class="reviews-sum__mark">{{ reviews.bigSize }}%</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="review" v-for="item in reviews">

                    <ReviewItem :author="item.author" :createdAt="item.createdAt" :text="item.text">
                    </ReviewItem>

                    <div class="answer" v-if="item.responseText">
                        <ReviewResponseItem :responseText="item.responseText"></ReviewResponseItem>
                    </div>
                </div>

                <button class="review__button">Оставить отзыв</button>
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
            reviews: null
        }
    },
    created() {
        this.axios
            .get('http://localhost/api/v1/reviews')
            .then((response) => {
                this.reviews = response.data.data;
                this.reviews.reviewsCnt = response.data.meta.count;
                this.reviews.sumGrade = this.reviews.reduce((a, b) => a + (b['grade'] || 0), 0);
                this.reviews.mean = Math.round(this.reviews.sumGrade / this.reviews.reviewsCnt);
                this.reviews.empty = 5 - this.reviews.mean;
                this.reviews.smallSize = 20;
                this.reviews.fitSize = 50;
                this.reviews.bigSize = 30;
            });
    },
    methods: {
        numWord(value, words) {
            const absValue = Math.abs(value) % 100;
            const num = value % 10;
            if (absValue > 10 && absValue < 20) return words[2];
            if (num > 1 && num < 5) return words[1];
            if (num == 1) return words[0];
            return words[2];
        }
    }
}
</script>
