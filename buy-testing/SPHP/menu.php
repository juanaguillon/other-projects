<?php require_once '../PHP/clases.php';?>
<?php  if (isset($_GET["close"])){ session_destroy(); header('location:registro'); } ?>
<header>
  <nav id="key_menu" class="body_all">
    <input type="checkbox" id="appear_search">
    <h1 id="nav_primary_title">OpenCol</h1>
    <form id="form_search" action="mostrar_productos">
      <input type="text" placeholder="Busqueda" name="search_text" id="search_text" autocomplete="off">
      <button type="submit" form="form_search" value="submit" name="send_search">
        <input id="button_search" type="submit" name="send_search" value="search_text"> 
        <i class="fa fa-search"></i>
      </button>  
      <div id="result_search">
      </div> 
    </form>

    <label for="checkbox_nav"><i class="fa fa-bars"></i>
    </label>
    <label for="appear_search"><i class="fa fa-search"></i></label>
    <input type="checkbox" id="checkbox_nav">
    <div id="ul_primary_key">
      <ul>
        <li><a href="#" id="favorite_link"><i class="fa fa-heart"></i><div class="add_prop" style="display: none;"><p>Agregado a favoritos</p></div></a>
        <div class="show_product_favorite" style="display: none;position: absolute;top: 100%;right: 1em;">
          <?php 

          if(isset($_SESSION["username"])) {
            
            $sesion = ID_SESION;
            $sql_show_p = "SELECT cod_p,image,name_product,f_date FROM product_inf WHERE cod_user = '$sesion' LIMIT 5 ";
            $ss = new add_bd_with_inject;
            $ssa = $ss->select_table($sql_show_p,false);
            if($ssa->rowCount()>0){
              while($rr = $ssa->fetch(PDO::FETCH_OBJ)){

                $img_f = $rr->image;
                $link_f = "../SPHP/ver_producto_creado?id_prd=".$rr->cod_p;
                $name_f = $rr->name_product;
                $date_f = $rr->f_date;
                ?>
                 <a class="link_f" href="<?php echo $link_f;?>"> 
                <div class="fav_div">
                  <div class="img_f list_f">
                      <img src="../resources/Users/<?php echo $img_f; ?>">
                    </div>
                    <div class="title_f list_f">
                      <h3><?php echo $name_f; ?></h3>
                    </div>
                    <div class="date_f">
                      <span class="span_alert">Agregado el <?php echo $date_f; ?></span>
                    </div>
                </div></a>
                <?php
                }    
            }else{
              ?>

              <div class="fav_div">
                <h3 style="font-size: 13px;">Aún no has agregado ningún producto a lista de favoritos</h3>
              </div>

              <?php
            }

          }else{

            ?>
            
            <div class="block_info">
              <h3>Ingresa como usuario para agregar productos</h3>
              <a class="linka_success" href="../SPHP/ingresar">Ingresar aquí</a>
              <h3>¿No eres usuario?</h3>
              <a class="linka_success" href="../SPHP/registro">Regístrate aquí</a>
            </div>
            <?php

          }
          



          ?>
          
        </div>
        </li>

        <li><a href="i_home" id="home"><i class="fa fa-home"></i>Inicio</a>
          
        </li>        
        <?php if(!isset($_SESSION["username"])){ ?>
        <li>
          <a href="ingresar" id="login"><i class="fa fa-sign-in"></i>Ingresar</a>          
        </li>
        <?php } else if(isset($_SESSION["username"])){?>
        <li><a href="#" id="options"><i class="fa fa-cog"></i>Opciones</a>
          <ul >
            <li><a href="opciones"><i class="fa fa-user-circle"></i>Opciones</a></li>  
            <li><a href="">Mi perfil</a></li>            
            <li><a href="?close=true"><i class="fa fa-sign-out"></i>Cerrar Sesión
            
            </a></li> 
          </ul>
        </li>
       
        
        
        <?php } 
       ?>
        
      </ul>
    </div>
  </nav>
</header>
