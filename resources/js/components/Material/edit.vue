<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Editar Material</h4>
                            </div>
                            <div>&nbsp&nbsp
                                <router-link :to="{name:'materialIndex'}" class="btn btn-success">Ver Materiales</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="materialEdit">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre Material<span class="text-danger">*</span></label>
                                        <input v-model="form.nombre" type="text" class="form-control" placeholder="Ingrese el Nombre del Material">
                                        <small class="text-danger" v-if="errors.nombre">{{errors.nombre[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Modelo<span class="text-danger">*</span></label>
                                        <input v-model="form.modelo" type="text" class="form-control" placeholder="Ingres el Modelo">
                                        <small class="text-danger" v-if="errors.modelo">{{errors.modelo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Caracteristicas del Componente<span class="text-danger">*</span></label>
                                        <input v-model="form.caracteristicas" type="text" class="form-control" placeholder="Ingrese las Carcateristicas del Componente">
                                        <small class="text-danger" v-if="errors.caracteristicas">{{errors.caracteristicas[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad Total<span class="text-danger">*</span></label>
                                        <input v-model="form.cantidad_total" type="text" class="form-control" placeholder="Ingrese la Cantidad Total de Componentes">
                                        <small class="text-danger" v-if="errors.cantidad_total">{{errors.cantidad_total[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cantidad en Prestamo<span class="text-danger">*</span></label>
                                        <input v-model="form.cantidad_prestamo" type="text" class="form-control" placeholder="Ingrese Cantidad bajo prestamo">
                                        <small class="text-danger" v-if="errors.cantidad_prestamo">{{errors.cantidad_prestamo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha</label>
                                        <input v-model="form.fecha" type="date" class="form-control" placeholder="MM/DD/YYYY">
                                        <small class="text-danger" v-if="errors.fecha">{{errors.fecha[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subir foto de Material</label>
                                        <input type="file" class="form-control" @change="onSelectFile">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img :src="form.newimagen" id="imgHide" style="width:80px;height:100px;display:none" class="image-fluid mb-1">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info"><i class="fas fa-plus"></i>&nbsp Actualizar</button>
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
        name: "edit",
        data(){
            return {
                form:{
                    nombre:'',
                    modelo:'',
                    caracteristicas:'',
                    cantidad_total:'',
                    cantidad_prestado:'',
                    fecha:'',
                    newimagen:'',

                },
                errors:{},
            }
        },
        created() {


            let id = this.$route.params.id;

            axios.get('api/materials/'+id)
            .then(res=>{
                this.form = res.data;
            })
                .catch(error=>{})
        },
        methods:{
            materialEdit(){
                let id = this.$route.params.id;
                axios.patch('api/materials/'+id,this.form)
                    .then(res=>{
                        //Notification.success();
                        Toast.fire({
                            icon: 'success',
                            title: 'Actualizacion Exitosa'

                        });
                        this.$router.push({name:'materialIndex'})
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors;
                        console.log(error.response.data.errors)
                    })
            },
            onSelectFile(e){
                let file = e.target.files[0];
                if(file.size > 2091540){
                    Notification.imageValidation();
                }else{
                    let reader = new FileReader();
                    reader.onload = e=>{
                        $("#imgHide").show()
                        this.form.newimagen = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
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
    }
</script>

<style scoped>

</style>
