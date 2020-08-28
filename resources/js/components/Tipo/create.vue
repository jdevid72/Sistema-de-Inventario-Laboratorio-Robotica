<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Nueva Persona</h4>
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'tipoIndex'}" class="btn btn-success">Ver Tipo Persona</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="Addtipo">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tipo Descripcion <span class="text-danger">*</span></label>
                                        <input v-model="form.descripcion" type="text" class="form-control" placeholder="Tipo Descripcion">
                                        <small class="text-danger" v-if="errors.descripcion">{{errors.descripcion[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info"><i class="fas fa-plus"></i>&nbsp Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "create",
        data() {
            return {
                form: {
                    descripcion: '',
                },
                errors: {},
            }
        },
     mounted() {
        if(!User.loggedIn()){
            Toast.fire({
                icon: 'warning',
                title: 'Inicia sesión primero!',
            });
            this.$router.push({name:'login'})
        }
    },
        methods:{
            Addtipo(){
                axios.post('api/tipos',this.form)
                    .then(res=>{
                        Notification.success();
                        this.$router.push({name:'tipoIndex'})
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors;
                        console.log(error.response.data.errors)
                    })
            },
    
        }
    }
</script>

<style scoped>

</style>
