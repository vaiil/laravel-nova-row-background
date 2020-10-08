<template>
</template>
<script>
function hexToLuma (colour) {
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

function makeTextColour (backgroundColor) {
  return hexToLuma(backgroundColor) > 0.5 ? '#000' : '#fff'
}

export default {
  props: ['resourceName', 'field'],
  data () {
    const value = this.field.value
    const isValueObject = value && typeof value === 'object'
    const backgroundColor = isValueObject ? value.backgroundColor : value
    const textColor = isValueObject && value.textColor ? value.textColor : (backgroundColor && makeTextColour(backgroundColor))
    return {
      backgroundColor,
      textColor
    }
  },
  mounted () {
    this.updateStyle()
    this.removeHeadColumn()
    this.removeCell()
  },
  methods: {
    removeHeadColumn () {
      const table = this.$el.closest('table')
      if (table) {
        const theadColumns = [...table.querySelectorAll('th')]
        const item = theadColumns.find((el) => el.innerText.toUpperCase() === this.field.name.toUpperCase())
        if (item) {
          item.remove()
        }
      }
    },
    removeCell () {
      const col = this.$el.closest('td')
      if (col) {
        col.remove()
      }
    },
    updateStyle () {
      const row = this.$el.closest('tr')
      if (row) {
        if (this.backgroundColor || this.textColor) {
          row.classList.add('colored-row')
        }
        if (this.backgroundColor) {
          row.style.backgroundColor = this.backgroundColor
        }
        if (this.textColor) {
          row.style.color = this.textColor
        }
      }
    }
  },
  updated () {
    console.warn('This component should not be updated!')
  }
}
</script>
<style>
.colored-row *, .colored-row td {
  color: inherit;
}

/* make background hover darken */
.table .colored-row:hover td {
  background-color: #0002;
}
</style>
