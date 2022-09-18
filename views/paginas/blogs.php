<article class="entrada_blog">
            <div class="imagen">
                <pinture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <source srcset="build/img/blog1.jpeg" type="image/jpeg">
                    <img loading="lazy" width="200" height="300"  src="/imagenesblog/<?php echo $entrada->imagen; ?>" alt="Entrada Blog">
                </picture>
            </div>
        

            <div class="entrada_texto">
                 <a href="/entrada?id=<?php echo $entrada->id;?>">
                     <h4><?php echo $entrada->titulo; ?></h4>
                     <p>Escrito el: <span><?php echo $entrada->fecha; ?></span> por: <span><?php echo $entrada->creador; ?></span></p>
                     <p><?php echo truncate($entrada->descripcion, 200); ?></p>
                 </a>
            </div>
       
    </article>