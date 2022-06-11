<template>
    <div>
        <div class="answer__head">
            <img src="/img/bel.svg" alt="">
            <span>Беллавка</span>
        </div>
        <p class="answer__text">{{ responseText }}</p>
    </div>
</template>
<script>
export default {
    props: ['responseText'],
    methods: {
        formatDate(dateString) {
            const date = new Date(dateString);
            return new Intl.DateTimeFormat('ru-RU').format(date);
        }
    }
}
</script>
