<template>
<div class = "display: block">

    <ul class="list-group">
        <li class="list-group-item" v-for="(item,index) in dispositivos" :key="index" >   
            <h4 style="display : inline">{{item.nombre}}</h4>
            <span style="float: right">
                <button class="btn btn-info btn-sm" @click="activarDisp(item,index)">Activar</button>
                <button class="btn btn-danger btn-sm" @click="eliminarDisp(item,index)">Eliminar</button>
            </span>
        </li>
    </ul>
 
</div>
</template>

<script>
export default{
    data(){
        return{
            dispositivos: [],
            dispositivo: {id:'',nombre:''}
        }
    },
    created(){
        axios.get('/disp_no_aceptados').then(res => {this.dispositivos = res.data});
    },
    methods:{
        enviarMjeADispActivos(mensaje){
            this.$bus.$emit('emit_disp',mensaje);
        },
        activarDisp(item,index){
            axios.delete(`/disp_no_aceptados/${item.id}`).then(()=>{this.dispositivos.splice(index,1);});
            const params = {nombre: item.nombre, id: item.id};
            axios.post('/disp_aceptados',params)
            .then((res)=>{
                this.enviarMjeADispActivos(res.data);
            });
        },
        eliminarDisp(item,index){
            const confirmacion = confirm(`Eliminar dispositivo ${item.nombre}`);
            if(confirmacion){
                axios.delete(`/disp_no_aceptados/${item.id}`).then(()=>{this.dispositivos.splice(index,1);});
            }
            
        }
    }
}
</script>