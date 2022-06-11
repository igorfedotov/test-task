<template>
    <div>
        <div class="review__head">
            <div class="user">
                <img src="/img/avatar.svg" alt="">
                <span>{{ author }}</span>
            </div>
            <div class="date">{{ formatDate(createdAt) }}</div>
        </div>
        <p class="review__text">{{ text }}</p>
    </div>
</template>
<script>
export default {
    props: ['author', 'createdAt', 'text'],
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('ru-RU').format(date);
        }
    }
}
</script>
