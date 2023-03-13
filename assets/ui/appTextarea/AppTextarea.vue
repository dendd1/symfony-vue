<!--Текст-зона
принмиает тип, значение и заголовок
передает данные в родительский компонент при изменении
-->
<template>
  <div class="d-flex form-row justify-content-center align-items-center">

    <p class="fs-5 form-label">{{label}}</p>


    <!--Поле для ввода информации о ключевых навыков-->
    <textarea
        @input="changeInput"
        v-model="value" class="form-input  fs-5" maxlength="150"
        rows="7"></textarea>

  </div>
</template>

<script>
export default {
  name: "AppTextarea",
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
    valueFrom: {
      type: String,
      required: false,
      default: '',
    },
    label: {
      type: String,
      required: false,
    }
  },
  watch: {
    valueFrom(){
      this.value = this.valueFrom;
    }
  },
  data() {
    return {
      value: '',
      apiCities: [],
      apiUniversity: [],
      errorMessage: '',
    }
  },
  methods: {
    changeInput() {
      this.broadcastValue();
    },
    broadcastValue() {
      this.$emit('changeInput', {
        key: this.itemKey,
        value: this.value,
      })
    },
  }
}
</script>

<style scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 0 10px 0;
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