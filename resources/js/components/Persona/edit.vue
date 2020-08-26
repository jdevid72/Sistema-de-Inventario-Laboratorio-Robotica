<template>
    <div class="section-body">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Actualizar Datos de Persona</h4>
                            </div>
                            <div>
                                <router-link :to="{name:'personaIndex'}" class="btn btn-success">Listar Registro Personas</router-link>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="personaEdit" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre<span class="text-danger">*</span></label>
                                        <input v-model="form.nombre" type="text" class="form-control" placeholder="Ingrese su Nombre">
                                        <small class="text-danger" v-if="errors.nombre">{{errors.nombre[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Apellido<span class="text-danger">*</span></label>
                                        <input v-model="form.apellido" type="text" class="form-control" placeholder="Ingrese su Apellido">
                                        <small class="text-danger" v-if="errors.apellido">{{errors.apellido[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CI<span class="text-danger">*</span></label>
                                        <input v-model="form.ci" type="text" class="form-control" placeholder="Ingrese el numero de su CI">
                                        <small class="text-danger" v-if="errors.ci">{{errors.ci[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CU<span class="text-danger">*</span></label>
                                        <input v-model="form.cu" type="text" class="form-control" placeholder="Ingrese el Numero de su Carnet de Universidad">
                                        <small class="text-danger" v-if="errors.cu">{{errors.cu[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefono<span class="text-danger">*</span></label>
                                        <input v-model="form.telefono" type="text" class="form-control" placeholder="Ingrese su N° de Telefono">
                                        <small class="text-danger" v-if="errors.telefono">{{errors.telefono[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tipo</label>
                                        <select v-model="form.tipo_id" class="form-control">
                                            <option value="">--seleccionar tipo--</option>

                                            <option v-for="tipo in tipos" :value="tipo.id">{{tipo.descripcion}}</option>

                                        </select>
                                         <small class="text-danger" v-if="errors.tipo_id">{{errors.tipo_id[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de Nacimiento</label>
                                        <input v-model="form.fecha_nacimiento" type="date" class="form-control" placeholder="MM/DD/YYYY">
                                        <small class="text-danger" v-if="errors.fecha_nacimiento">{{errors.fecha_nacimiento[0]}}</small>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Direccion</label>
                                        <textarea v-model="form.direccion" cols="10" rows="3" type="text" class="form-control" placeholder="Ingrese la Direccion donde Vive"></textarea>
                                        <small class="text-danger" v-if="errors.direccion">{{errors.direccion[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nombre de Persona Garante<span class="text-danger">*</span></label>
                                        <input v-model="form.nombre_respaldo" type="text" class="form-control" placeholder="Ingrese el Nombre de la persona de Respaldo">
                                        <small class="text-danger" v-if="errors.nombre_respaldo">{{errors.nombre_respaldo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Telefono de Respaldo<span class="text-danger">*</span></label>
                                        <input v-model="form.telefono_respaldo" type="text" class="form-control" placeholder="Ingrese el telefono de Respaldo">
                                        <small class="text-danger" v-if="errors.telefono_respaldo">{{errors.telefono_respaldo[0]}}</small>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Subir foto de Perfil</label>
                                        <input type="file" class="form-control" @change="onSelectFile">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <img :src="form.newPerfil" id="imgHide" style="width:80px;height:100px;display:none" class="image-fluid mb-1">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-info"><i class="fas fa-plus"></i>Actualizar Datos Persona</button>
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
                    apellido:'',
                    direccion:'',
                    tipo_id:'',
                    telefono:'',
                    ci:'',
                    cu:'',
                    newPerfil:'',
                    fecha_nacimiento:'',
                    nombre_respaldo:'',
                    telefono_respaldo:'',

                },
                errors:{},
                tipos:{},
            }
        },
        created() {

            axios.get('api/tipos')
            .then(res=>{this.tipos = res.data})


            let id = this.$route.params.id;

            axios.get('api/personas/'+id)
            .then(res=>{
                this.form = res.data;
            })
                .catch(error=>{})
        },
        methods:{
            personaEdit(){
                let id = this.$route.params.id;
                axios.patch('api/personas/'+id,this.form)
                    .then(res=>{
                        Notification.success();
                        this.$router.push({name:'personaIndex'})
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
                        this.form.newPerfil = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            }
        },
        mounted() {
            if(!User.loggedIn()){
                Toast.fire({
                    icon: 'warning',
                    title: '¡Inicie sesión primero!',
                });
                this.$router.push({name:'login'})
            }
        },
    }
</script>

<style scoped>

</style>
