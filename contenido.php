 <?php
     $arrNoticias = array(
          array("titulo" => "Hiberus Tecnología", "cuerpo" => "<p>Es difícil encontrar una compañía como Hiberus.

     Nos caracteriza nuestra apuesta por la especialización y la gestión de talento. Con una orientación innata a que nuestros proyectos sean innovadores y orientados desde el primer momento a convertirse en productos y en nuevas áreas de negocio o incluso empresas. Cada área/empresas está especializada en un servicio o producto innovador. Hasta hoy, hemos creado más de 38 áreas de competencia que en Hiberus reciben el nombre de Hiberus Business Units integradas en 6 áreas de negocio que reciben el nombre de Hiberus Management Areas.</p> ", "autor" => "Hiberus", "fecha" => "2021-07-21"),
          array("titulo" => "Digital", "cuerpo" => "<p>La aparición de nuevos negocios digitales ha revolucionado completamente el mundo IT con nuevas plataformas y formas de conceptualizar productos digitales que no existían hasta hace poco tiempo. Además, los clientes se han vuelto más exigentes ante la amplia oferta existente en el mercado y debemos ser capaces de crear nuevas experiencias que les acompañen de principio a fin. </p>", "autor" => "Hiberus", "fecha" => "2021-07-21"),
          array("titulo" => "Soluciones", "cuerpo" => "<p>El éxito en la sociedad digital actual comienza por situar a la tecnología y a los equipos al frente de las organizaciones, utilizando el software como empuje para cubrir todas sus necesidades. Esto permitirá a las empresas ofrecer mejores experiencias a los clientes, con mayor agilidad y con mayor calidad. </p>", "autor" => "Hiberus", "fecha" => "2021-07-21"),
          array("titulo" => "Sistemas", "cuerpo" => "<p>Hiberus  Sistemas es una empresa transversal a todo IT. Ayudamos a tu compañía a alcanzar sus objetivos de negocio manteniéndola al día de los últimos avances tecnológicos que puedan añadir valor. Podrás sacar el máximo partido de tus inversiones en tecnología confiando en nuestros expertos.</p>", "autor" => "Hiberus", "fecha" => "2021-07-21"),
     );
     ?>
 <?php /*foreach ($arrNoticias as $item) { ?>
      <article class="noticia">
           <h1><?= $item["titulo"] ?></h1>
           <div class="contenido">
                <?= $item["cuerpo"] ?>
           </div>
           <footer>
                <p>Publicada el -> <?= $item["fecha"] ?> por <?= $item["autor"] ?> </p>
           </footer>
      </article>

 <?php  } */ ?>
 <?php
     require_once("noticias.php");

     ?>

 