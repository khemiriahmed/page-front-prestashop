
{if $data}
<section id="block-testimonial" class="block-testimonial py-3">
  <h1 class='text-center'>Ils dévorent déjà nos recettes</h1>
  <h3 class='text-center pb-5'>(Et ils les recommandent ! )</h3>
 
  <div class="row">
    {foreach from= $data item=element}
      <div class="col-md-4 mb-2">
       <div class="testimonial">
       <div class="contenu d-flex justify-content-between align-items-center">
       <div class='d-flex align-items-center'>
            <img src="{$urls.base_url}modules/testimonial/views/img/{$element.image}" alt="{$element.title}" class="img-fluid pr-4">
         <div class='bloc-text'>
          <span class="titre d-block">{$element.title}</span>
          <span class='nbcommande'>{$element.nbcommande} Commandes</span>
         </div>
       </div> 
    
        
        <div class='rating'>
        <img src='{$urls.base_url}modules/testimonial/views/img/star.svg' class='text-right img-fluid'>
         <span class='note d-block text-center'>{$element.note}<span>/5</span></span>

        </div>
    
      
       </div>
        <div class="description pt-3"><p>{$element.description}</p></div>
        </div>
      </div>
      {/foreach}
   </div>
</section>
{/if}
