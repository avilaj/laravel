<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Reference;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(OrderItem::class, function (ModelConfiguration $model) {
    $model->setTitle("Ordenes: detalles");
    // $model->setAlias('order_items');
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setFilters([
            AdminDisplayFilter::related('order_id')
                ->setModel(Order::class)
        ]);
        $display->setColumns([
            AdminColumn::text('order_id')->setLabel('Orden'),
            AdminColumn::text('product.title')->setLabel('Producto'),
            AdminColumn::text('product.brand.name')->setLabel('Marca'),
            AdminColumn::text('reference.color.name')->setLabel('color'),
            AdminColumn::text('size.label')->setLabel('Talle'),
            AdminColumn::text('price')->setLabel('Precio'),
            AdminColumn::text('qty')->setLabel('Cantidad')
        ]);
        $display->with('reference');
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Producto')->required(),
            AdminFormElement::text('subtitle', 'Subtitulo')->required(),
            // AdminFormElement::jsonField('references', 'Referencias'),
            // AdminFormElement::select('category_id', 'Categoria')->setModelForOptions('App\Model\Category')->setDisplay('name')->required(),
            AdminFormElement::wysiwyg('description', 'Descripción', 'tinymce')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
