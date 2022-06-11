<template>
    <div class="display" v-if="product">
        <div class="wrapper">

            <a @click="$router.back()" class="back"><img src="/img/arrow-back.svg" alt="Назад"></a>

            <button class="search">
                <img src="/img/search.svg" alt="Поиск">
            </button>

            <section class="gallery">
                <ul class="gallery__list">
                    <li class="gallery__item" v-for="item in product.photos">
                        <img :src="item" :alt="product.name">
                    </li>
                </ul>
                <span class="gallery__sale bg-maroon" v-if="product.salePercent">-{{ product.salePercent }}%</span>
            </section>

            <section class="buttons-tags">
                <ul class="buttons__list">
                    <li class="buttons__item">
                        <button>
                            <img src="/img/like.svg" alt="Лайк">
                        </button>
                    </li>
                    <li class="buttons__item">
                        <button>
                            <img src="/img/share.svg" alt="Поделиться">
                        </button>
                    </li>
                </ul>
                <ul class="tags__list">
                    <li class="tags__item bg-maroon" v-if="product.favorite">лучше</li>
                    <li class="tags__item bg-gold" v-if="product.status">{{ product.status }}</li>
                    <li class="tags__item" v-if="product.isCotton">хлопок</li>
                </ul>
            </section>

            <section class="tips">
                <ul class="tips__list">
                    <li class="tips__item">
                        <a href="#">
                            <img src="/img/video.svg" alt="Видео">
                            <span>+{{ product.videosCnt }}</span>
                            <img src="/img/arrow-right.svg" alt="arrow-right">
                            <p>Смотреть видеообзоры</p>
                        </a>
                    </li>
                    <li class="tips__item">
                        <router-link :to="'/reviews'">
                            <img src="/img/message.svg" alt="Отзывы">
                            <span>+{{ product.reviewsCnt }}</span>
                            <img src="/img/arrow-right.svg" alt="arrow-right">
                            <p>Отзывы покупателей</p>
                        </router-link>
                    </li>
                    <li class="tips__item">
                        <router-link :to="'/questions'">
                            <img src="/img/help.svg" alt="Вопросы">
                            <span>+{{ product.questionsCnt }}</span>
                            <img src="/img/arrow-right.svg" alt="arrow-right">
                            <p>Вопросы по&nbsp;модели</p>
                        </router-link>
                    </li>
                </ul>
            </section>

            <section class="title">
                <h2>{{ product.name }}</h2>
                <p>{{ product.category.value }}</p>
            </section>

            <section class="last">
                <h3>Вы&nbsp;недавно смотрели</h3>
                <ul class="last__list">
                    <li class="last__item">
                        <img src="/img/recently/recently-1.jpg" alt="Asv">
                        <div class="last__wrap">
                            <div class="last_wrap-price">
                                <div class="last__price">6420₽</div>
                                <div class="last__old-price"></div>
                            </div>
                            <h4>Asv</h4>
                            <p>Платье</p>
                            <button class="last__add">
                                <img src="/img/add.svg" alt="Добавить в корзину">
                            </button>
                        </div>
                    </li>
                    <li class="last__item">
                        <img src="/img/recently/recently-2.jpg" alt="Anastasia Mak">
                        <div class="last__wrap">
                            <div class="last_wrap-price">
                                <div class="last__price">5490₽</div>
                                <div class="last__old-price">6210₽</div>
                            </div>
                            <h4>Anastasia Mak</h4>
                            <p>Брюки, Жакет</p>
                            <button class="last__add">
                                <img src="/img/add.svg" alt="Добавить в корзину">
                            </button>
                        </div>
                    </li>
                    <li class="last__item">
                        <img src="/img/recently/recently-3.jpg" alt="Beautiful&Free">
                        <div class="last__wrap">
                            <div class="last_wrap-price">
                                <div class="last__price">5850₽</div>
                                <div class="last__old-price">6840₽</div>
                            </div>
                            <h4>Beautiful&Free</h4>
                            <p>Брюки, Жакет</p>
                            <button class="last__add">
                                <img src="/img/add.svg" alt="Добавить в корзину">
                            </button>
                        </div>
                    </li>
                </ul>
            </section>

            <BottomNav></BottomNav>

        </div>
    </div>
</template>

<script>
import BottomNav from './BottomNav.vue';

export default {
    components: {
        BottomNav
    },
    data() {
        return {
            product: null,
            properties: null
        }
    },
    created() {
        this.axios
            .get('http://localhost/api/v1/product')
            .then((response) => {
                this.product = response.data;
                this.product.questionsCnt = this.product.questions.meta.count;
                this.product.reviewsCnt = this.product.reviews.meta.count;
                this.product.videosCnt = this.product.videos.length;
            });
    },
}
</script>
