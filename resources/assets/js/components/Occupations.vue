<template>
    <ul>
        <li v-for="occ in occupations" :key="occ.label">
            <div class="label">{{ occ.label }}</div>
            <div class="value">{{ occ.value }}</div>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "Occupations",
        props: [
            'occupations'
        ]

    }
</script>

<style lang="scss" scoped>
    ul {
        li{
            display:flex;
            align-content: space-between;
            justify-content: space-between;
            div{
                font-size: 14px;
                &.value{
                    font-weight:bold;
                }
            }
        }
    }
</style>
