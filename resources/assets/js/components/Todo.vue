<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="text-center">My Todo App</h3></div>

                    <div class="panel-body">
                        
                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <div class="alert">
                                <ul>
                                    <li v-for="err in errors" :key="err.key">{{ err }}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="input-group">
                            <input type="text" name="todo" v-validate="'required'" 
                            class="form-control" v-model="todo.title">
                            <span class="input-group-btn">
                                <button name="" type="button" class="btn btn-primary" @click="createtodo">Add</button>
                            </span>  
                        </div>
                        <p  class="text-danger">{{ val_errors.first('todo') }}</p>

                        <div v-if="!todos.length">
                            <div class="alert"><p>You do not have any todos</p></div>
                        </div>
                        
                        <div v-else>

                            <div class="todo_content">
                                
                                <ul>
                                    <li v-for="todo in todos" :key="todo.key">
                                        
                                        <div class="todo_edit_wrap">
                                            <input type="checkbox" class="check_box" v-model="todo.completed" @change="markDone(todo)">
                                            <div class="todo_text" :class="{done:todo.completed}">{{todo.title}}</div>
                                            
                                        </div>
                                        
                                        <button type="button" @click="removetodo(todo)" class="btn btn-danger btn-sm pull-right">Delete</button>
                                        
                                    </li>
                                </ul>
                            </div>

                            <div class="todo_extras">
                                <!--<button type="button" class="btn btn-primary pull-left" @click="allDone">Mark All Done</button>
                                <button type="button" class="btn btn-danger" @click="removeAll">Delete All</button>-->
                                <div class="pull-right">
                                    <span class="label label-default">You have {{todos.length}} todos</span>

                                    <span class="label label-warning">{{remainingtodos()}} todos left</span>

                                    <span class="label label-success">{{completedtodos()}} completed</span>
                                </div>
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
        mounted() {
            this.fetchData();
        },

        data() {
            return {
                todo: {
                    title: ''
                },
                todos: [],
                update_todo: {},
                delete_todo: {},
                delete_todo_index: null,
                errors: [],

            }
        },

        methods: {
            remainingtodos(){
                return this.todos.filter(todo=>{return !todo.completed}).length
            },

            completedtodos() {
                return this.todos.filter(todo=>{return todo.completed}).length
            },

            fetchData() {
                axios.get('api/todos').then((res)=>{
                    this.todos = res.data
                }).catch((err)=>{
                    console.log(err)
                })
            },

            createtodo() {
                let todo = this.todo.title;
                const completed = 0;
                //console.log(todo + ' '+completed);
                axios.post('api/todos/store', {
                    title:this.todo.title,
                    completed:completed
                }).then((res)=>{
                    this.todos = res.data;
                    this.todo.title='';
                }).catch((err)=>{
                    console.log(err)
                })
            },


            markDone(todo) {
                //console.log('marked done '+todo.id);
                axios.post('api/todos/update/'+todo.id, {
                    title:todo.title,
                    completed:todo.completed
                }).then((res)=>{
                    this.todos= res.data
                }).catch((err)=>{
                    console.log(err)
                })
            },


            updatetodo(todo) {
                axios.post('api/todos/update/'+todo.id, {
                    title:todo.title,
                    completed:todo.completed
                }).then((res)=>{
                    this.todos= res.data
                }).catch((err)=>{
                    console.log(err)
                })
            },


            removetodo(todo) {
                axios.delete('api/todos/delete/'+todo.id, {
                    id:todo.id,
                    title:todo.title
                }).then((res)=>{
                    this.todos= res.data;
                }).catch((err)=>{
                    console.log(err)
                })
            },


            allDone() {
                while (this.todos.length) {
                    axios.post('api/todos/update').then({

                    }).catch()
                }
            },

            

            removeAll() {
                axios.delete('api/todos/delete').then((res)=>{
                    this.todos = res.data
                }).catch((err)=>{
                    console.log(err);
                    /*
                    this.errors = [];
                    if (err.response.data.errors.name) {
                        this.errors.push(err.response.data.errors.name[0]);
                    }
                    */
                })
            }

        }
    }
</script>
