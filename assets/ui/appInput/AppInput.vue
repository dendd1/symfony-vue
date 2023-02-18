<template>
  <div class="d-flex form-row justify-content-center align-items-center">
    <p class="fs-5 form-label">Профессия</p>
    <!--Поле для ввода профессии-->
<!--    <input-->
<!--        :id="id"-->
<!--        :type="type"-->
<!--        :placeholder="placeholder"-->
<!--        :list="itemKey"-->
<!--        @update:modelValue="changeInput"-->
<!--        @input="broadcastResume"-->
<!--        v-model="resume.profession" class="form-input  fs-5" type="text" maxlength="35">-->

  </div>
</template>

<script>
export default {
  name: "AppInput",
  props: {
    placeholder: {
      type: String,
      required: true,
    },
    itemKey: {
      type: String,
      required: false,
    },
    type: {
      type: String,
      required: false,
      default: 'text',
    },
    hints: {
      type: Array,
      required: false,
      default: null,
    },
  }
}
</script>

<style scoped>

</style>