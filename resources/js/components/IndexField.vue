<template>
</template>
<script>
const hexToLuma = (colour) => {
    const hex = colour.replace(/#/, '')
    const r = parseInt(hex.substr(0, 2), 16)
    const g = parseInt(hex.substr(2, 2), 16)
    const b = parseInt(hex.substr(4, 2), 16)

    return [
        0.299 * r,
        0.587 * g,
        0.114 * b
    ].reduce((a, b) => a + b) / 255
}
export default {
    props: ['resourceName', 'field'],
    row: null,
    mounted () {
        const table = this.$el.closest('table')
        const col = this.$el.closest('td')
        const row = this.$el.closest('tr')
        if (row && this.backgroundColor) {
            row.classList.add('colored-row')
            row.style.backgroundColor = this.backgroundColor
            row.style.color = this.textColor
        }
        if (col) {
            col.remove()
        }
        if (table) {
            const item = [...table.querySelectorAll('th')].find((el) => el.innerText.toUpperCase() === this.field.name.toUpperCase())
            if (item) {
                item.remove()
            }
        }
    },
    computed: {
        backgroundColor () {
            return this.field.value
        },
        luma () {
            return hexToLuma(this.backgroundColor)
        },
        textColor () {
            return this.luma > 0.5 ? '#000' : '#fff'
        }
    }
}
</script>
<style>
.colored-row:not(:hover) * {
    color: inherit;
}

.colored-row:not(:hover) td {
    color: inherit;
}
</style>
