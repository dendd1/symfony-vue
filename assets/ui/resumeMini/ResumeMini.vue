<template>
  <div class="form-row p-3">

    <p class="fs-5 mb-2 fw-bold text-danger">{{ profession }}</p>


    <img :src="photo" class="form-out-img">


    <p class="fs-5 form-input my-3">{{ surname }} {{name}} {{patronymic}}</p>


    <p class="fs-5 form-input my-3">{{bDate}}</p>

  </div>
</template>

<script>
export default {
  name: "ResumeMini",
  props: {
    profession: {
      type: String,
      required: false,
    },
    photo: {
      type: String,
      required: false,
    },
    surname: {
      type: String,
      required: false,
    },
    name: {
      type: String,
      required: false,
    },
    patronymic: {
      type: String,
      required: false,
    },
    bDate: {
      type: Date,
      required: false,
    }
  },
}
</script>

<style scoped>
.form-row {
  border: 4px solid rgba(214, 214, 214, .6);
  margin: 10px 0 10px 0;
  border-radius: 6px;
  background: rgba(214, 214, 214, .6);
}



.form-input {
  background: white;
  border-width: 0 !important;
  width: 100%;
  padding: 0 0 0 10px;
  outline: 0 none;
}

.form-out-img {
  width: 100%;
  max-height: 400px;
  object-fit: cover;
}


</style>