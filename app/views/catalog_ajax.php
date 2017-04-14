<? if (count($products) > 0): ?>
<div class="products-list">
    <div class="row page-actions">
        <div class="col-md-12">
            
            <div class="controls pull-right">
                <select id="page-length" class="form-control input-sm" name="length">
					<? foreach ($filters['length'] as $length): ?>
						<option value="<?= $length ?>" <? if (isset($request['length']) && $request['length'] == $length): ?> selected<? endif ?>><?= $length ?></option>
				    <? endforeach ?>
                </select>
                <select id="sort-by-field" class="form-control input-sm" name="field">
                	<? foreach ($filters['field'] as $key => $value): ?>
						<option value="<?= $key ?>" <? if (isset($request['field']) && $request['field'] == $key): ?> selected<? endif ?>><?= $value ?></option>
				    <? endforeach ?>
                </select>
                <select id="sort-order" class="form-control input-sm" name="order">
                    <? foreach ($filters['order'] as $key => $value): ?>
						<option value="<?= $key ?>" <? if (isset($request['order']) && $request['order'] == $key): ?> selected<? endif ?>><?= $value ?></option>
				    <? endforeach ?>
                </select>      

                <ul class="pagination pagination-sm">
                    <li <? if ($pagination[1] == 1) : ?> class="disabled"<? endif ?>>
                        <a href="#" <? if ($pagination[1] != 1) : ?> data-page="<?= $pagination[1]-1 ?>" <? endif ?> aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <? foreach ($pagination[0] as $p): ?>
                        <li <? if ($p == $pagination[1]): ?> class="active"<? endif ?>>
                        	<a href="#" data-page="<?= $p ?>"><?= $p ?></a>
                        </li>
                    <? endforeach ?>
                    
                    <li <? if ($pagination[1] == $pagination[2]) : ?> class="disabled"<? endif ?>>
                        <a href="#" aria-label="Next" <? if ($pagination[1] != $pagination[2]) : ?> data-page="<?= $pagination[1]+1 ?>">
                            <span aria-hidden="true" <? endif ?>">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </div>
        
            <a href="#" data-action="add-product" class="btn btn-sm btn-primary">Добавить  товар</a>  
        </div>
    </div>

    <? for ($i = 0, $j = 0; $i < count($products); $i++): ?>
        <? if ($j == 0): ?>
            <div class="row">
        <? endif ?>
            <div class="col-md-4">
                <div id="product-<?= $products[$i]->getId() ?>" class="product">
                	<div class="product-content">
                		<div class="product-title"><?= $products[$i]->getName() ?></div>
	                    <div class="product-description"><?= $products[$i]->getDescription() ?></div>
	                    <div class="product-summary">
	                        <div class="product-price"><?= $products[$i]->getPrice() ?>$</div>
	                        <div class="product-status <? if ($products[$i]->getStatus() == Product::IN_STOCK): ?> in-stock <? else: ?> out-of-stock <? endif ?>"><?= $products[$i]->getStatusLabel() ?></div>
	                    </div>
	                    <div class="actions">
	                        <a href="#" class="btn btn-sm btn-danger" data-action="delete-product" data-id="<?= $products[$i]->getId() ?>"><span class="glyphicon glyphicon-trash"></span> Удалить</a>
	                        <a href="#" class="btn btn-sm btn-default" data-action="edit-product" data-id="<?= $products[$i]->getId() ?>"><span class="glyphicon glyphicon-edit"></span> Редактировать</a>
	                    </div>	
                	</div>
                </div>
            </div>
        <? if ($j == 2): ?>
            </div>
            <? $j = 0; ?>
        <? else: ?>
            <? $j++;?>
        <? endif ?>
    <? endfor ?>
</div>
<? endif ?>

<div class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-labelledby="edit-product-modal-label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="edit-product-modal-label">Создание / редактирование товара</h4>
      </div>
      <div class="modal-body">
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
        <button type="button" class="btn btn-primary" data-action="save-product">Сохранить изменения</button>
      </div>
    </div>
  </div>
</div>