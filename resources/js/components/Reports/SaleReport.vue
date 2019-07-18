<template>
  <div v-if="show">
    <div class="row justify-content-center" v-if="can('staff-list')">
      <h2 class="text-info">This Page is not ready for yet</h2>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    this.auth();
  }
};
</script>

<style>
</style>
