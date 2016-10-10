<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\ShippingArea;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(ShippingArea::class, function (ModelConfiguration $model) {
    $model->setTitle("Areas de entrega");
    $model->setAlias('shipping-areas');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('name', 'asc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('name')->setLabel('Nombre'),
            AdminColumn::text('price')->setLabel('Precio'),
        ]);
        $display->paginate(10);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required(),
            AdminFormElement::text('price', 'Precio')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
