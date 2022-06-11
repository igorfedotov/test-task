<template>
    <div>
        <a @click="$router.back()" class="back"><img src="/img/arrow-back.svg" alt="Назад"></a>

        <div class="page-header">
            <div class="page-header__title">{{ title }}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['title']
}
</script>
