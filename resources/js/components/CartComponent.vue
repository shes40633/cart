<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <table class="table table-dark">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">name</th>
              <th scope="col">price</th>
              <th scope="col">qty</th>
              <th scope="col">sub_price</th>
              <th scope="col">delete</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,i) in Cartcontent">
              <th scope="row">{{i}}</th>
              <td>{{item.name}}</td>
              <td>{{item.price}}</td>
              <td><input type="text" v-model="item.quantity" @change="changeQty"></td>
              <td>{{item.price * item.quantity}}</td>
              <td><button class="btn btn-danger" @click="deleteItem(i)">Delete</button></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["propsCartcontent"],
  data: function() {
        return {
            Cartcontent: JSON.parse(this.propsCartcontent)
        }
    },
    methods:{
        changeQty: function () {
            console.log("test");
        },
        deleteItem:function (i) {
        }
    }
};
</script>
