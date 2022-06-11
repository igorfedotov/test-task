<template>
    <div class="display">
        <div class="wrapper">

            <div class="page-header">
                <div class="page-header__title">Главная</div>
            </div>

            <nav class="top-nav">
                <ul class="top-menu">
                    <li><router-link :to="'/product'">Товар</router-link></li>
                    <li><router-link :to="'/reviews'">Отзывы</router-link></li>
                    <li><router-link :to="'/questions'">Вопросы</router-link></li>
                </ul>
            </nav>

        </div>
    </div>
</template>
<script>
export default {}
</script>
