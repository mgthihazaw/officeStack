<template>
  <div class="row">
    <table class="mx-5 table  table-hover">
      <thead>
        <tr class=" heading">
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td scope="row">1</td>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <td scope="row">2</td>
          <td>Jacob</td>
          <td>tdornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <td scope="row">3</td>
          <td>Larry</td>
          <td>the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
    data(){
        return {

        }
    }
};
</script>

<style scoped>
.table{
    width:100%;
    height: 100%;
    font-family: Poppins-Regular;
    font-size: 15px;
    color: #666666;
    line-height: 1.2;
    font-weight: unset !important;
    padding-top: 20px;
}
table {
  border: 1px solid rgb(111, 161, 136); 
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}
 .heading{
    background:  rgb(91, 189, 176); 

}
.heading th{
    padding:20px;
}
tbody tr{
    background:  rgb(243, 243, 243); 
}

 td {
  padding: 1em;
  background: #fff;
  border-bottom: 1px solid rgba(191, 236, 197, 0.87); 
}
.table-hover tbody tr:hover td {
    background: #E9ECEF;
}

</style>
