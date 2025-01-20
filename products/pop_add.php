   <!--  -->
   <div class="pop_bl pop_bl2 product_add_block">
      <div class="pop_bl_a product_add_back"></div>
      <div class="pop_bl_c">
         <div class="head_c">
            <h4>Добавить товар</h4>
            <div class="btn btn_dd product_add_back"><i class="fal fa-times"></i></div>
         </div>
         <div class="pop_bl_cl">
            <div class="form_c">
               <div class="form_head">Основные:</div>
               <div class="form_im">
                  <div class="form_span">Наименование товара:</div>
                  <input type="text" class="form_txt pr_name" placeholder="Введите наименование" data-lenght="1">
                  <i class="fal fa-text form_icon"></i>
               </div>
               <div class="form_im">
                  <div class="form_span">Цена продажи:</div>
                  <input type="tel" class="form_txt fr_price pr_price" placeholder="0" data-lenght="1">
                  <i class="fal fa-tenge form_icon"></i>
               </div>
               <div class="form_im form_sel">
                  <div class="form_span">Категория товара:</div>
                  <!-- <i class="fal fa-inventory form_icon"></i> -->
                  <div class="form_im_txt sel_clc pr_catalog" data-val="">Выберите категорию</div>
                  <i class="fal fa-caret-down form_icon_sel"></i>
                  <div class="form_im_sel sel_clc_i">
                     <? $catalog = db::query("select * from product_catalog"); ?>
                     <? while ($catalog_d = mysqli_fetch_assoc($catalog)): ?>
                        <div class="form_im_seli" data-val="<?=$catalog_d['id']?>"><?=$catalog_d['name_ru']?></div>
                     <? endwhile ?>
                  </div>
               </div>
            </div>

            <div class="form_c">
               <div class="form_im">
                  <div class="btn product_add"><span>Добавить</span></div>
               </div>
            </div>

         </div>
      </div>
   </div>


   <!--  -->
   <div class="pop_bl pop_bl2 product2_add_block">
      <div class="pop_bl_a product2_add_back"></div>
      <div class="pop_bl_c">
         <div class="head_c">
            <h4>Дублировать товар</h4>
            <div class="btn btn_dd product2_add_back"><i class="fal fa-times"></i></div>
         </div>
         <div class="pop_bl_cl"></div>
      </div>
   </div>

   <!-- upd item quantity -->
   <div class="pop_bl pop_bl2 pitem_updq_block">
      <div class="pop_bl_a pitem_updq_back"></div>
      <div class="pop_bl_c">
         <div class="head_c">
            <h4>Корректировка количество</h4>
            <div class="btn btn_dd pitem_updq_back"><i class="fal fa-times"></i></div>
         </div>
         <div class="pop_bl_cl lazy_c"></div>
      </div>
   </div>