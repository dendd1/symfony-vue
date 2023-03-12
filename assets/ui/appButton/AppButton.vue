<template>
  <div class="d-flex form-row justify-content-center align-items-center">
    <button
        class="fs-4 w-100" style="border: none"
    >
      {{label}}
    </button>
  </div>
</template>

<script>
export default {
  name: "AppButton",
  props: {
    label: {
      type: String,
      required: false,
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
</style>