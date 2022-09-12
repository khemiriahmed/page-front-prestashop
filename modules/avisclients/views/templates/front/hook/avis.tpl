

{if $infolist}
<section id="block-avis-client" class="block-avis-client py-4">
  <h1 class='text-center py-2'>Ils ont choisi simply you box</h1>
  <h3 class='text-center pb-4'>Et sont aux anges</h3>
 
  <div class="row">
    {foreach from= $infolist item=element}
      <div class="col-md-4">
       <div class="avis">
        <div class="bloc-note pb-3">
          <div class="star pr-2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
           </div>
          <div class='note'>
              {$element.note}/5
          </div>
        </div>
     
        <p class="pb-3">{$element.testimonial nofilter}</p>
         <h4>Publié par {$element.signature}</h4>
        </div>
      </div>
      {/foreach}
   </div>
</section>
{/if}
