<template>
<div class = "display: block">

    <ul class="list-group">
        <li class="list-group-item" v-for="(item,index) in dispositivos" :key="index" >   
            <h4 style="display : inline">{{item.nombre}}</h4>
            <span style="float: right">
                <button class="btn btn-success btn-sm" @click="mostrarGraf(item,index)">Gráficos</button>
                <button class="btn btn-primary btn-sm" @click="mostrarLog(item,index)">Log</button>
                <button class="btn btn-danger btn-sm" @click="eliminarDisp(item,index)">Eliminar</button>
                <button class="btn btn-danger btn-sm" @click="encenderLED(item.nombre)">Encender LED</button>
                <button class="btn btn-danger btn-sm" @click="apagarLED(item.nombre)">Apagar LED</button>
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
        //Traigo la lista de dispositivos de la base de datos
        axios.get('/disp_aceptados').then(res => {this.dispositivos = res.data});
        // Me suscribo al bus de comunicaciones
        this.$bus.$on('emit_disp',(mensaje)=> {this.dispositivos.push({id: mensaje.id,nombre: mensaje.nombre});});
    },
    methods:{
        mostrarLog(item,index){
            this.$bus.$emit('emit_log',item);
        },
        mostrarGraf(item,index){
            this.$bus.$emit('emit_graf',item);
        },
        encenderLED(topc) {
            this.$mqtt.publish('disp/' + topc, 'ON')
        },
        apagarLED(topc) {
            this.$mqtt.publish('disp/' + topc, 'OFF')
        },
        eliminarDisp(item,index){
            const confirmacion = confirm(`Eliminar dispositivo ${item.nombre}`);
            if(confirmacion){
                axios.delete(`/disp_aceptados/${item.id}`).then(()=>{this.dispositivos.splice(index,1);});
            }  
        },
        beforeDestroy(){
            // Me desuscribo al bus de comunicaciones
            this.$eventBus.$off('emit_disp');
        }
    }
}
</script>