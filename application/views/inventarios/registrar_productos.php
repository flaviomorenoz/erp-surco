<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $product_id = $maestro_id = $unidad = "";
    $cantidad = 0;
?>
<style type="text/css">
    .zonas{
        border-style: solid; 
        border-color: gray; 
        border-width: 1px; 
        margin: 15px 0px;
        padding:  10px 0px;
    }
    .ventas{
        border-style:none; border-width: 1px; border-color:rgb(120,120,120);
    }
    .filitas{
        margin-top: 15px;
        border-style:none; border-width: 2px; border-color:orange;
    }

    .cubo{
        background-color: white;
        border-style:solid; border-width: 1px; border-color:rgb(170,170,170);
        height: 150px;
        width:  150px;
        float:  left;
        margin: 5px;
    }
    .marco-producto{
        margin:2px 0px; 
        height:160px;
    }
    .celdas_totales{
        background-color: rgb(130,170,200); /*rgb(140,160,180);*/
        height: 25px!important;
    }
    .table th{
        height: 35px;
        padding: 4px !important;
    }
    .dropdown {
      display: inline-block;
      position: relative;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      width: 100%;
      overflow: auto;
      box-shadow: 0px 10px 10px 0px rgba(0,0,0,0.3);
      background-color:rgb(220,220,220);
    }
    .dropdown:hover .dropdown-content {
      display: block;
    }
    .dropdown-content a {
      display: block;
      color: #000000;
      padding: 5px;
      text-decoration: none;
    }
    .dropdown-content a:hover {
      color: #FFFFFF;
      background-color: #00A4BD;
    }   

    ::selection{
      color: #fff;
      background: #664AFF;
    }

    .wrapper{
      max-width: 450px;
      margin: 10px auto;
    }

    .wrapper .search-input{
      background: #fff;
      width: 100%;
      border-radius: 5px;
      position: relative;
      box-shadow: 0px 1px 5px 3px rgba(0,0,0,0.12);
    }

    .search-input input{
    }

    .search-input.active input{
    }

    .search-input .autocom-box{
      padding: 0;
      opacity: 0;
      pointer-events: none;
      max-height: 280px;
      overflow-y: auto;
    }

    .search-input.active .autocom-box{
      padding: 10px 8px;
      opacity: 1;
      pointer-events: auto;
    }

    .autocom-box li{
      list-style: none;
      /*padding: 8px 12px;*/
      display: none;
      width: 100%;
      cursor: default;
      border-radius: 3px;
    }

    .search-input.active .autocom-box li{
      display: block;
    }
    .autocom-box li:hover{
      background: #efefef;
    }

    .search-input .icon{
      position: absolute;
      right: 0px;
      top: -10px;
      height: 55px;
      width: 55px;
      text-align: center;
      line-height: 55px;
      font-size: 20px;
      color: #644bff;
      cursor: pointer;
    }

    .ubica-drop{
        width:140px;
        left:-60px;
    }

    .ver{
        border-style: solid;
        border-color: red;
        border-width:1px;
    }
    .label-control{
        margin-bottom:0px;
        color:rgb(20,170,20);
        font-style: italic;
    }
</style>

<?= form_open_multipart("inventarios/registrar_productos", 'class="validation" id="form1"') ?>

<div class="row zonas">
    <div class="col-xs-8 col-sm-6 col-md-4">
        <label>Seleccione el inventario a desarrollar:</label>
        <?php
            $cSql = "select a.id, concat(a.id,') ',substr(a.fecha_i,1,10),'-',b.state) frase, b.state tienda 
                from tec_maestro_inv a
                inner join tec_stores b on a.store_id = b.id
                where a.finaliza!='1'";
            $result = $this->db->query($cSql)->result_array();
            $indice = "id";
            $descrip = "frase";
            $ar     = $this->fm->conver_dropdown($result, $indice, $descrip);
            echo form_dropdown('maestro_id', $ar, $maestro_id, 'class="form-control tip" id="maestro_id" required="required"');
        ?>
        <input type="hidden" name="modo" value="1">
    </div>
    <div class="col-xs-4 col-sm-3 col-md-2">
        <br>
        <button type="button" onclick="seleccionar()" class="btn btn-primary">Seleccionar</button>
    </div>
</div>

<div class="row zonas">
    <div class="col-xs-6 col-sm-4 col-md-4">
        <label class="label-control" id="lbl_busqueda">Codigo de Barras  </label><br>
        <div class="search-input">
            <a href="" target="_blank" hidden></a>
            <input type="text" class="form-control" name="hdn_descrip" id="hdn_descrip" placeholder="Type to search.." onblur="ejecutar_libre()">

            <div class="autocom-box">
                
            </div>
            
        </div>
        <input type="hidden" name="product_id" id="product_id">
        <input type="hidden" name="category_id" id="category_id">
        <input type="hidden" name="impuesto" id="impuesto">
        <input type="hidden" name="hdn_codigo" id="hdn_codigo" value="PRODUCTO">
    </div>

    <div class="col-xs-6 col-sm-3 col-md-3">
        <label>Unidades:</label>
        <?php
            $cSql = "select a.id, a.descrip from tec_unidades a";
            $result = $this->db->query($cSql)->result_array();
            $indice = "id";
            $descrip = "descrip";
            $ar     = $this->fm->conver_dropdown($result, $indice, $descrip);
            echo form_dropdown('unidad', $ar, $unidad, 'class="form-control tip" id="unidad" required="required"');
        ?>
    </div>

    <div class="col-xs-5 col-sm-3 col-md-2">
        <label>Cantidad:</label>
        <?php
            $ar = array(
               "name"  =>"cantidad",
               "id"    =>"cantidad",
               "type"  =>"text",
               "value" => $cantidad,
               "class" =>"form-control tip"
            );
            echo form_input($ar);
        ?>
    </div>

    <div class="col-xs-5 col-sm-3 col-md-2">
        <br><button type="button" class="btn btn-danger" onclick="registrar_productos()">Registrar</button>
    </div>
</div>

<div class="row zonas">


</div>

<div class="row zonas">
    <div class="col-sm-12 col-md-10 col-lg-8" id="pizarra1">
    </div>
    <div class="col-sm-12 col-md-12 col-lg-12">
        Nota.- Solo muestra los ultimos 30 registros...
    </div>
</div>

<?= form_close(); ?>

<?= form_open_multipart(base_url("inventarios/finalizar_inventario"), 'class="validation" id="form2"') ?>
<div class="row zonas">
    <div class="col-sm-2">
        <button type="button" class="btn btn-danger" onclick="$('#maestro_id2').val( $('#maestro_id').val() );document.getElementById('form2').submit();">Finalizar</button>
        <input type="hidden" name="maestro_id2" id="maestro_id2">
    </div>
    <div class="col-sm-10">
        Nota.- Al finalizar se pueden realizar movimientos virtuales para nivelar el inventario calculado (kardex) con el inventario fisico.
    </div>
</div>
<?= form_close(); ?>

<script type="text/javascript">
    function seleccionar(){
        $.ajax({
            data    :{
                maestro_id  : $("#maestro_id").val(),
                limit       : 30
            },
            type    : 'get',
            url     : '<?= base_url("inventarios/get_inventario") ?>',
            success : function(res){
                document.getElementById("pizarra1").innerHTML = res 
            }
        })
    }

    function registrar_productos(){
        $.ajax({
            data    :{
                product_id  : $("#product_id").val(),
                unidad      : $("#unidad").val(),
                cantidad    : $("#cantidad").val(),
                maestro_id  : $("#maestro_id").val()
            },
            type    : 'get',
            url     : '<?= base_url("inventarios/registrar_productos_ajax") ?>',
            success : function(res){
                var obj = JSON.parse(res)
                seleccionar()
                alert(obj.msg)
                limpiar_busqueda()
            }
        })
    }

    var gIgv = 18
    function expand(obj) { obj.size = 5; } 
    function unexpand(obj) { obj.size = 1; }

    function ejecutar_libre(){
        if(document.getElementById('hdn_codigo').value == 'LIBRE'){
            let texto = $("#hdn_descrip").val()
            $('#product_id').val(99999)
            //$('#quantity').val(1)
            //$('#cost').focus()
            //$('#impuesto').val(gIgv)
            alert("nose que hago")
        }
    }

    function ejecutar_codigo_barra(){
        $.ajax({
            data    : {code : $("#hdn_descrip").val()},
            type    : "POST",
            url     : "<?= base_url("sales/buscar_codigo") ?>",
            error: function(){
                alert("error petición ajax");
            },
            success: function(data){                                                    
                var obj = JSON.parse(data)
                
                for(registro in obj){
                    $("#product_id").val(obj[registro]["id"])
                    $("#hdn_descrip").val(obj[registro]["name"] + " [" + obj[registro]["stock"] + "]")
                    $("#impuesto").val(obj[registro]["impuesto"])
                }
                
                //busqueda_precio()

            }
        })
    }

    let suggestions = [];

    // getting all required elements
    const searchWrapper     = document.querySelector(".search-input");
    const inputBox          = searchWrapper.querySelector("input");
    const suggBox           = searchWrapper.querySelector(".autocom-box");
    const icon              = searchWrapper.querySelector(".icon");
    let linkTag             = searchWrapper.querySelector("a");
    let webLink;
    var sanson = document.getElementById("sanson")

    // if user press any key and release
    inputBox.onkeyup = (e)=>{
        
        if(document.getElementById('hdn_codigo').value == 'CODIGO'){ // por codigo de barra)    

            if(e.key == 'Enter'){

                ejecutar_codigo_barra()

            }

        }else if(document.getElementById('hdn_codigo').value == 'PRODUCTO'){
        
            let userData = e.target.value; //user enetered data
            
            //console.log(userData)
            $.ajax({
                data : {b : userData},
                url  : '<?= base_url("sales/buscar") ?>',
                type : 'post',
                success : function(res){

                    if(res.length > 0){
                        
                        let resx = res.replace('/},/g','},\n')
                        //console.log("RAP:"+resx)

                        let obj = JSON.parse(res)

                        let emptyArray = [];

                        for(let i in obj){
                            let cad_stock = ""
                            if (obj[i]['prod_serv'] == 'P'){
                                cad_stock = " [" + obj[i]['stock'] + "]"
                            }
                            emptyArray.push("<li mio=\"" + obj[i]['id'] + "\" categoria=\"" + obj[i]['categoria'] + "\" impuesto=\"" + obj[i]['impuesto'] + "\">" + obj[i]['name'] + cad_stock + "</li>")
                        
                        }

                        searchWrapper.classList.add("active"); //show autocomplete box

                        // Limpiando antes de agregar
                        $(".autocom-box").empty()

                        showSuggestions(emptyArray)

                        let allList = suggBox.querySelectorAll("li");
                        for (let i = 0; i < allList.length; i++){
                            //adding onclick attribute in all li tag
                            allList[i].setAttribute("onclick", "$('#product_id').val(this.getAttribute('mio'));$('#category_id').val(this.getAttribute('categoria'));$('#impuesto').val(this.getAttribute('impuesto'));select(this);document.getElementById('hdn_descrip').readOnly=true;");
                        }
                        
                        if(userData){
                        }else{
                            searchWrapper.classList.remove("active"); //hide autocomplete box
                        }
                        
                    }
                }
            })

        
        }else if(document.getElementById('hdn_codigo').value == 'LIBRE'){

            if(e.key == 'Enter'){
                ejecutar_libre()
            }

        }
    }

    function select(element){
        let selectData = element.textContent;
        //busqueda_precio()
        inputBox.value = selectData;
        searchWrapper.classList.remove("active");
    }

    function limpiar_busqueda(){
        $('#hdn_descrip').val("");
        document.getElementById('hdn_descrip').readOnly = false;
        $('#product_id').val("");
        $('#category_id').val("");
        $('#impuesto').val("");
        searchWrapper.classList.remove("active"); //oculta el autocom-box
        $('#hdn_descrip').focus();
    }

    function showSuggestions(list){
        let listData;
        listData = list.join('');
        suggBox.innerHTML = listData;
    }
</script>