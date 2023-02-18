<template>
  <div class="d-flex form-row justify-content-center align-items-center">
    <p class="fs-5 form-label">{{ label }}</p>
    <input
        v-model="value"
        :type="type"
        @input="changeInput"
        class="form-input  fs-5" type="text" maxlength="35">

  </div>
</template>

<script>
export default {
  name: "AppInput",
  emits: ['changeInput'],
  props: {
    itemKey: {
      type: String,
      required: false,
    },
    type: {
      type: String,
      required: false,
      default: 'text',
    },
    label:{
      type: String,
      required: false,
    }
  },
  data() {
    return {
      value: '',
    }
  },

  methods: {
    changeInput() {
      if (this.itemKey === 'telephone' && this.value) {
        if (/\D/.test(this.value)) this.value = this.value.substring(0, this.value.length - 1);
      }

      this.$emit('changeInput', {
        key: this.itemKey,
        value: this.value,
      });
    },
  },
}
</script>

<style scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 70px 10px 0;
  border-radius: 6px;
  background: rgba(214, 214, 214, .6);
}

.form-label {
  height: 100%;
  padding: 0 8px 0 8px;
  white-space: nowrap;
}

.form-input {
  background: white;
  border-width: 0 !important;
  width: 100%;
  padding: 0 0 0 10px;
  outline: 0 none;
}


</style>