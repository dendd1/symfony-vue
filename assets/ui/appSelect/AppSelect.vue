<template>
  <!--  <div class="mb-3">-->
  <!--    <label :for="id" class="form-label">-->
  <!--      <slot></slot>-->
  <!--    </label>-->
  <!--    <select-->
  <!--        class="form-select"-->
  <!--        :id="id"-->
  <!--        :value="value"-->
  <!--        @change="changeSelect($event.target.value)">-->
  <!--      <option v-for="(option, key) in options" :key="key" :value="option.value">-->
  <!--        {{ option.caption }}-->
  <!--      </option>-->
  <!--    </select>-->
  <!--  </div>-->


  <div class="d-flex form-row-card-education justify-content-center align-items-center">
    <p class="fs-5 form-label">{{ label }}</p>
    <select
        :value="value"
        @change="changeSelect($event.target.value)"
    >
      <option v-for="(option, key) in options" :key="key" :value="option.value">
        {{ option.caption }}
      </option>
    </select>
  </div>
</template>

<script>
export default {
  name: 'AppSelect',
  props: {
    itemKey: {
      type: String,
      required: false,
    },
    label: {
      type: String,
      required: false,
    },

    options: {
      type: Array,
      required: true,
    },

    value: {
      type: String,
      required: false,
      default: '',
    },
  },
  emits: ['changeSelect'],
  methods: {
    changeSelect(value) {
      this.$emit('changeSelect', {
        key: this.itemKey,
        value: value,
      });
    }
  }
};
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

.card-education {
  border: 4px solid rgba(214, 214, 214, .6);
  border-radius: 10px;
  height: 400px;
}

.form-row-card-education {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 40px 10px 40px;
  border-radius: 6px;
  background: rgba(214, 214, 214, .6);
}

.input-border-message {
  background: #FFFFFF;
  position: relative;
  border-radius: 10px;
  box-shadow: 3px 1px 50px rgb(122 122 122 / 25%);
  max-height: 220px;
  overflow-y: auto;
}
</style>