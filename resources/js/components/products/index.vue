<template>
    <div class="container">
        <h2 class="text-center">Products List</h2>
        <div class="row">
            <div class="col-md-12">
                <router-link :to="{ name: 'ProductCreate' }" class="btn btn-primary btn-sm float-right mb-2">Add Product</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(product, key) of products" v-bind:key="key">
                            <td>{{ key+1 }}</td>
                            <td>{{ product.name }}</td>
                            <td>{{ product.description }}</td>
                            <td>{{ product.price }}</td>
                            <td>
                                <router-link class="btn btn-success btn-sm" :to="{ name: 'ProductEdit', params: { productId: product.id }}">Edit</router-link>
                                <button class="btn btn-danger btn-sm" @click="deleteProduct(product.id)">Delete</button>
                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                loggedIn: localStorage.getItem('loggedIn'),
                products: {},
                user: [],
                token: ''
            }
        },
        // created() {
        //     token = "Bearer" + localStorage.getItem("token");
        //     this.getProducts();
        // },
        created() {
            this.token = "Bearer " + localStorage.getItem("token");
        },
        methods: {
            getProducts() {
                
                // this.axios.get('http://127.0.0.1:8000/api/products', this.product, {headers: {'Authorization': this.token}})
              this.axios.get('http://127.0.0.1:8000/api/products', { 
                    headers : {
                        Authorization: this.token
                    }
                })
                  .then(response => {
                      this.products = response.data;
                      console.log(response);
                  });
            },
            deleteProduct(productId) {
                // this.axios.delete('http://127.0.0.1:8000/api/products/${productId}', this.product, {headers: {'Authorization': this.token}})
                this.axios
                    .delete(`http://127.0.0.1:8000/api/products/${productId}`, { 
                    headers : {
                        Authorization: this.token
                    }
                })
                    .then(response => {
                        let i = this.products.map(data => data.id).indexOf(productId);
                        this.products.splice(i, 1)
                    });
            }
        },

        mounted() {
            if(!this.loggedIn) {
                return this.$router.push({ name: 'Login' })
            }
        }
    }
</script>