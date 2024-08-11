    <?php include('function.php'); ?>
   <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>SistemSMB</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />       
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        
        <style type="text/css">            

            .notItemOne option:first-child {
              display: none; 
              }                
              
            .ModalProducto {
              position: fixed;
              width: 100%;
              height: 100vh;              
              background-color: rgba(0, 0, 0, 0.81); 
              display: none;
              z-index: 1040;
            }

            .bodyModalProducto {
              width: 100%;
              height: 100%;                                          
              display: -o-inline-flex; /* Para Opera */
              display: -ms-inline-flex; /* Para Internet Explorer */
              display: -moz-inline-flex; /* Para Firefox */
              display: -webkit-inline-flex; /* Para navegadores WebKit (Safari, Chrome) */
              justify-content: center;
              align-items: center;   
              z-index: 1042;
            }

            .bodyModalProducto h2 {
              font-size: 30px;
              text-align: center;
              color: #0d6efd;
            }
            
            .bodyModalProducto h3 {
              font-size: 24px;
              text-align: center;              
            }
            
            .bodyModalProducto form {
              padding: 35px;
              width: 375px;
              background-color: #fff;  
            }

            .bodyModalProducto form input[type="text"],
            .bodyModalProducto form input[type="number"] {
              margin-top: 10px;
              width: 100%;
              border-radius: 3px;
            }  

          </style>              
    </head>

    <div class="ModalProducto">                              
      <div class="bodyModalProducto">
            <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault();">
              <h2><i class="fas fa-cubes"></i><br>Agregar Producto</h2>  
              <h3 class="namePrducto">Monitor LCD 17</h3><br>
              <input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del Producto" require><br>
              <input type="text" name="precio" id="txtPrecio" placeholder="Precio del Producto" require>
              <input type="hidden" name="product_id" id="product_id" require>
              <input type="hidden" name="action" value="addProducto" require>
              <div class="alert alertProduct"></p></div>
              <button type="submit" class="btn btn-*"><i class="fas fa-plus"></i> Agregar</button>
              <a href="#" class="btn btn-danger closeModal" onclick="closeModalProduct()"><i class="fas fa-ban"></i> Cerrar</a>
            </form>
      </div>
    </div>