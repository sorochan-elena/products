<form action="#" id="edit-product-form">
    <div class="alert alert-danger" style="display:none;"></div>
    
    <input type="hidden" name="id" value="<?= $product->getId() ?>">

    <div class="form-group">
        <label class="control-label">Название товара: <span class="required">*</span></label>
        <div>
            <input type="text" class="form-control" name="name" value="<?= $product->getName() ?>" placeholder="Название товара" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Цена: <span class="required">*</span></label>
        <div>
            <input type="text" class="form-control" name="price" value="<?= $product->getPrice() ?>" placeholder="Цена" required>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Статус: <span class="required">*</span></label>
        <div>
            <select name="status" class="form-control" required>
                <option value="<?= Product::IN_STOCK ?>" <? if ($product->getStatus() == Product::IN_STOCK): ?> selected<? endif ?>>В наличии</option>
                <option value="<?= Product::OUT_OF_STOCK ?>" <? if ($product->getStatus() == Product::OUT_OF_STOCK): ?> selected<? endif ?>>Нет в наличии</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Описание: </label>
        <div>
            <textarea class="form-control" name="description" placeholder="Описание" cols="15" rows="7"><?= $product->getDescription() ?></textarea>
        </div>
    </div>
</form>