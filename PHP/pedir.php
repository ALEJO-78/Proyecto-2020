<html>
<?php
    ini_set("memory_limit","16M");
    include 'conexion.php';
    
    //hay que ver como se llena este carrito
    $carrito = array("Empanada de carne media docena", "Empanada de carne media docena", "Empanada de carne media docena");
    for($i=0; $i < count($carrito); $i++){
        $strSQL = "SELECT cnIngrediente, cnCantidad FROM tbingredientesenreceta WHERE cnReceta = '$carrito[$i]'";
        $resultado = mysqli_query($conexion, $strSQL);
        $ingredientes[$i] = mysqli_fetch_all($resultado, MYSQLI_ASSOC);
    }
    //aca ya se recolectaron todos los ingredientes necesarios(no estan sumados)
    //print_r($ingredientes);
    $ingredientesTotales = array();
    for($i=0; $i < count($carrito); $i++){
        for($o=0; $o < count($ingredientes[$i]); $o++){ 
            //$ingredientesTotales[] = $ingredientes[$i][$o];
            $ingredientesTotales[] = array("cnIngrediente" => $ingredientes[$i][$o]['cnIngrediente'],
                                           "cnCantidad" => $ingredientes[$i][$o]['cnCantidad'],
                                           "cnFueSumado" => "No");
        }
    }
    //vaciamos $ingredientes
    foreach($ingredientes as $key => $value){
        unset($ingredientes[$key]);
    }
    //aca los ingresientes estan sumados en un array comun entre si, sin distinguir la receta

    //no lo cambio pq funciona, pero intento
    //if(count($carrito) > 1){
    //    $ingredientesSumados = array();
    //    $ingredienteASumar = array();
    //    for($i=0; $i < count($ingredientesTotales); $i++){ 
            //print_r($ingredienteASumar);
    //        for($o=0; $o < count($ingredientesTotales); $o++){ 
     //           if($ingredientesTotales[$i]['cnIngrediente'] == $ingredientesTotales[$o]['cnIngrediente'] AND $i != $o){
    //                //echo "Funciona";
    //                $cantidadSumada = $ingredientesTotales[$i]['cnCantidad'] + $ingredientesTotales[$o]['cnCantidad'];
    //                $ingredientesSumados[] = array("cnIngrediente" => $ingredientesTotales[$i]['cnIngrediente'], "cnCantidad" => $cantidadSumada);
    //            }
    //        }
            //foreach ($ingredienteASumar as $key => $value) {
            //    unset($ingredienteASumar[$key]);
            //}
        //}
    //    print_r($ingredientesSumados);
    //}
    //else{
    //    $ingredientesSumados = $ingredientesTotales;
    //    print_r($ingredientesTotales);
    //}

    if(count($carrito) > 1){
        $ingredientesSumados = array();
        for($i=0; $i < count($ingredientesTotales); $i++){ 
            for($o=0; $o < count($ingredientesTotales); $o++){ 
                if($ingredientesTotales[$i]['cnIngrediente'] == $ingredientesTotales[$o]['cnIngrediente'] AND $i != $o AND $ingredientesTotales[$i]['cnFueSumado'] == "No" AND $ingredientesTotales[$o]['cnFueSumado'] == "No"){
                    $ingredientesTotales[$o]['cnFueSumado'] = "Si";
                    //aca hay que sumar con el ingredientes sumados
                    for($n=0; $n < count($ingredientesSumados); $n++){ 
                        if($ingredientesTotales[$i]['cnIngrediente'] == $ingredientesSumados[$n]['cnIngrediente']){
                            $cantidadSumada = $ingredientesSumados[$n]['cnCantidad'] + $ingredientesTotales[$o]['cnCantidad'];
                            $ingredientesSumados[] = array("cnIngrediente" => $ingredientesTotales[$i]['cnIngrediente'], "cnCantidad" => $cantidadSumada);
                        }
                        else{
                            $cantidadSumada = $ingredientesTotales[$i]['cnCantidad'] + $ingredientesTotales[$o]['cnCantidad'];
                            $ingredientesSumados[] = array("cnIngrediente" => $ingredientesTotales[$i]['cnIngrediente'], "cnCantidad" => $cantidadSumada);
                        }
                    }
                }
                if($o + 1 == count($ingredientesTotales)){
                    $ingredientesTotales[$i]['cnFueSumado'] = "Si";
                }
            }
        }
    }
    
    print_r($ingredientesSumados);
?> 
</html>