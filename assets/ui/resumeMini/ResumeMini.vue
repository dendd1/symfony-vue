<template>
  <div class="form-row p-3">

    <p class="fs-5 mb-2 fw-bold text-danger">{{ profession }}</p>


    <img :src="photo" class="form-out-img">


    <p class="fs-5 form-input my-3">{{ surname }} {{name}} {{patronymic}}</p>


    <p class="fs-5 form-input my-3">{{bDate}}</p>

    <router-link :to="{ name: 'edit', params: {id: id} }" class=" fs-5 text-center nav-link text-danger fw-bolder">
      Редактировать
    </router-link>

<!--    <app-button @click.stop="clickCard(id)"-->
<!--                label="Редактировать">-->

<!--    </app-button>-->

  </div>
</template>

<script>
import AppButton from "../appButton/AppButton.vue";

export default {
  name: "ResumeMini",
  components: {AppButton},
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
      type: String,
      required: false,
    },
    id: {
      type: Number,
      required: false,
    }
  },
  methods:{
    clickCard(item) {
      // item.fixed = !item.fixed;
      console.log(1);
      this.$router.push({ name: 'edit', params: { id: item.id } });
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



.form-input {
  background: white;
  border-width: 0 !important;
  width: 100%;
  padding: 0 0 0 10px;
  outline: 0 none;
}

.form-out-img {
  width: 100%;
  max-height: 300px;
  object-fit: cover;
}


</style>