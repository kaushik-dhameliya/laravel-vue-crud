<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{FormTitle}}</h1>
                <div class="form-group mb-3">
                    <label for="name">Enter Name</label>
                    <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control" v-model="item.name">
                </div>
                <div class="form-group mb-3">
                    <label for="phone">Enter Phone</label>
                    <input type="text" name="phone" id="phone" placeholder="Enter Phone" class="form-control" v-model="item.phone">
                </div>
                <button @click="submit" class="btn btn-info">{{isEditing?'Update':'Save'}}</button>
            </div>
            <h2 class="text-secondary text-center">{{TableTitle}}</h2>
            <div class="col-md-6 col-sm-12" v-if="lists.length > 0">
                <table class="table table-stripped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="item in lists" :key="item.id">
                            <th>{{item.id}}</th>
                            <th>{{ item.name }}</th>
                            <th>{{ item.phone }}</th>
                            <th><button class="btn btn-warning mx-2" @click="editData(item)">Edit</button><button class="btn btn-danger" @click="deleteData(item.id)">Delete</button></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { Axios } from "axios";

    export default {
        name:'Directory',
        data(){
            return {
                FormTitle:'Insert Data',
                TableTitle:'View Data',
                Api:'http://127.0.0.1:8000/api/tel',
                lists: [],
                item:{
                    name:'',
                    phone:'',
                },
                temp_id:null,
                isEditing:false
            }
        },
        mounted(){
            this.fetch();
        },

        methods:{
            fetch(){
                axios.get(this.Api).then(res=>{
                    this.lists = res.data
                    console.log(res.data);
                });
            },
            submit(){
                let method = axios.post;
                let url = this.Api;
                if(this.isEditing){
                    method = axios.put;
                    url = this.Api+'/'+this.temp_id;
                }
                try {
                    method(url,this.item).then(res=>{
                        console.log(res);
                            this.fetch();
                            this.item={
                                name:'',
                                phone:'',
                            };
                            this.temp_id = null
                            this.isEditing = false

                    });
                } catch (error) {
                    console.log(error);
                }
            },
            editData(tel){
                this.item={
                    name: tel.name,
                    phone:tel.phone
                }
                this.temp_id = tel.id;
                this.isEditing = true
            },
            deleteData(id){
                try {
                    axios.delete(this.Api+'/'+id).then(res=>{
                        console.log(res);
                        this.fetch();
                    });
                } catch (error) {
                    console.log(error);
                }
            },

        }
    }
</script>
