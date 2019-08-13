<template>
  <div class="row">
    <div class="container">
      <div class="row justify-content-center mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <form>
                <div class="form-group row pt-2">
                  <div class="col-md-4">
                    <multiselect
                      v-model="itemType"
                      track-by="name"
                      :block-keys="['Delete']"
                      placeholder="Choose Item Type"
                      label="name"
                      selectLabel="Select"
                      deselectLabel="Deselect"
                      :options="itemTypes"
                      :reset-after="false"
                      @input="loadItem($event)"
                      @select="loadAttributeGroup"
                    ></multiselect>
                  </div>
                  <div class="col-md-4">
                    <multiselect
                      v-model="brand"
                      track-by="name"
                      :block-keys="['Delete']"
                      placeholder="Choose Item Brand"
                      label="name"
                      selectLabel="Select"
                      deselectLabel="Deselect"
                      :options="brands"
                      :reset-after="false"
                      @input="loadItem"
                    ></multiselect>
                  </div>
                  <div class="col-md-4">
                    <multiselect
                      v-model="attributes"
                      :options="attributeGroups"
                      :multiple="true"
                      selectLabel="Select"
                      deselectLabel="Deselect"
                      group-values="attributes"
                      group-label="name"
                      :group-select="false"
                      placeholder="Choose Attribute"
                      track-by="name"
                      label="name"
                      @input="loadItem"
                    >
                      <span
                        slot="noResult"
                      >Oops! No elements found. Consider changing the search query.</span>
                    </multiselect>
                  </div>
                </div>
              </form>
            </div>
            <div class="card-footer">
              <div class="itemTable" v-if="items.length>0">
                <div class="p-0 col-md-12">
                  <table class="table table-hover">
                    <tbody>
                      <tr class="heading"></tr>
                      <tr class="heading">
                        <th style="width: 100px">#</th>
                        <th>Name</th>

                        <th>Attributes</th>
                        <th>Price</th>

                        <th style="width: 100px"></th>
                      </tr>

                      <tr v-for="(item,index) in items" :key="index" class="animated fadeIn">
                        <td>{{ paginationData.meta.from + index }}</td>
                        <td class="ml-2">
                          {{ item.brand.name }} {{ item.model_no }}
                          
                        </td>

                        <td class="ml-2">
                          <span
                            v-for="(attribute,index) in item.attributes"
                            :key="index"
                          >{{ attribute.name }} &nbsp;</span>
                        </td>

                        <td class="ml-2">{{ item. price}}</td>

                        <td>
                          <button
                            type="button"
                            class="btn btn-primary btn-circle"
                            @click="addItemForService(item)"
                          >
                            <i class="fas fa-plus-circle fa-2x"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <pagination :data="paginationData" @pagination-change-page="getResults"></pagination>
                </div>
              </div>
              <div v-else class="text-center">
                <h1 class="text-info">This Item is Not Found</h1>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: "",
      paginationData: {},
      itemTypes: [],
      itemType: "",
      type: [],
      brands: [],
      brand: "",
      attributeGroups: [],
      attributes: [],
      searchForm: {
        item_type: "",
        brand: "",
        attributes: []
      }
    };
  },
  methods: {
    getItems() {
      axios
        .get("/api/items")
        .then(res => {
          this.items = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    getItemType() {
      axios
        .get(`/api/itemtypes`)
        .then(res => {
          this.itemTypes = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    getBrand() {
      axios
        .get("/api/brands")
        .then(res => {
          this.brands = res.data.data;
        })
        .catch(err => {
          console.log(err);
        });
    },

    loadAttributeGroup(type) {
      if (type) {
        axios
          .get(`/api/itemtypes/${type.id}/attributegroups`)
          .then(res => {
            this.attributeGroups = res.data.data;
          })
          .catch(err => {
            console.log(err);
          });
        axios
          .get(`/api/itemtypes/${type.id}/brands`)
          .then(res => {
            this.brands = res.data.data;
          })
          .catch(err => {
            console.log(err);
          });
      }
    },
    loadItem(data) {
      if (this.itemType) {
        this.searchForm.item_type = this.itemType.id;
      }
      if (this.brand) {
        this.searchForm.brand = this.brand.id;
      }
      if (this.attributes.length > 0) {
        this.attributes.forEach((attr, key) => {
          this.searchForm.attributes[key] = `${attr.id}`;
        });
      }

      axios.get("/api/search/items", { params: this.searchForm }).then(res => {
        this.paginationData = res.data;

        this.items = res.data.data;
        this.clearForm();
      });
    },
    getResults(page = 1) {
      if (this.itemType) {
        this.searchForm.item_type = this.itemType.id;
      }
      if (this.brand) {
        this.searchForm.brand = this.brand.id;
      }
      if (this.attributes.length > 0) {
        this.attributes.forEach((attr, key) => {
          this.searchForm.attributes[key] = `${attr.id}`;
        });
      }

      axios
        .get("/api/search/items?page=" + page, { params: this.searchForm })
        .then(res => {
          this.paginationData = res.data;

          this.items = res.data.data;
          this.clearForm();
        });
    },
    addItemForService(item) {
      Bus.$emit("addItemForService", item);
    },

    clearForm() {
      (this.searchForm.item_type = ""), (this.searchForm.brand = "");
      this.searchForm.attributes = [];
    }
  },
  created() {
    // this.getItems();
    this.getItemType();
    // this.getBrand();
  }
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
.btn-circle {
  width: 30px;
  height: 30px;
  padding: 6px 0px;
  border-radius: 15px;
  text-align: center;
  font-size: 12px;
  line-height: 1.42857;
}
.table {
  width: 100%;
  height: 100%;
  font-family: "Poppins", sans-serif !important;
  font-size: 15px;

  line-height: 1.2;
  font-weight: unset !important;
  padding-top: 20px;

  padding-bottom: 20px;
}
table {
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}
.heading {
  background: rgb(140, 177, 226);
}
.heading th {
  padding: 20px;
}
tbody tr {
  background: rgb(243, 243, 243);
}

td {
  padding-top: 1em;
  padding-bottom: 1em;
  background: #fff;
  border-bottom: 1px solid rgb(140, 177, 226);
}
.table-hover tbody tr:hover td {
  background: #e9ecef;
}
</style>
