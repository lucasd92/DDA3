<template>
<div v-if="mostrarLog" class = "display: block">
    

    <h2 style="display : inline">{{dispositivo.nombre}}</h2>
    <span style="float: right">
    <button class="btn btn-primary btn-sm" @click="ocultarLog()">Ocultar</button>
    <button class="btn btn-primary btn-sm" @click="actualizar()">Actualizar</button>
    </span>

    <div class = "display: block">
    <GChart
        type="LineChart"
        :data="chartData"
        :options="chartOptions"
        :resizeDebounce="500"
    />
    </div>
</div>
</template>

<script>
export default {
  data () {
    return {
        mostrarLog: 0,
        listaLogs: [],
        dispositivo: {id:'',nombre:''},
      // Array will be automatically processed with visualization.arrayToDataTable function
      
      chartData: [],
      chartOptions: {
        chart: {
          title: 'Company Performance'
        }
      }
    }
  },
    created(){

    // Me suscribo al bus de comunicaciones
    this.$bus.$on('emit_graf',(mensaje)=> {
        this.dispositivo = mensaje;
        axios.get(`/log_disp/${mensaje.id}`).then((res)=>{
           
                this.chartData = [['Fecha', 'Temperatura', 'Humedad']];
                res.data.forEach(element => {
                    this.chartData.push([element.timestamp,element.temperatura,element.humedad]);
                });

                this.mostrarLog = 1;
            });
        });
    },
    methods:{
        ocultarLog(){
            this.mostrarLog = 0;
        },
        actualizar(){
            axios.get(`/log_disp/${this.dispositivo.id}`).then((res)=>{
                    this.chartData = [['Fecha', 'Temperatura', 'Humedad']];
                    res.data.forEach(element => {
                        this.chartData.push([element.timestamp,element.temperatura,element.humedad]);
                    });
                });
        },
        beforeDestroy(){
            // Me desuscribo al bus de comunicaciones
            this.$eventBus.$off('emit_graf');
        }
    }
}
</script>

