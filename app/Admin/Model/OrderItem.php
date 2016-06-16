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
            AdminColumn::text('id')->setLabel('#'),
            AdminColumn::custom()
                ->setLabel("Referencia")
                ->setCallback(function ($instance) {
                    $link  = url("admin/references?id=".$instance->reference->id);
                    $label = $instance->reference->reference;
                    return '<a href="'.$link.'">'.$label.'</a>';
                }),
            AdminColumn::text('price')->setLabel('Precio'),
            AdminColumn::text('qty')->setLabel('Cantidad'),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px')
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