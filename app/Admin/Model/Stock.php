<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Stock;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Stock::class, function (ModelConfiguration $model) {
    $model->setTitle("Historico de inventario");
    // $model->with('reference');
    $model->setAlias('stock');
    $model->onDisplay(function () {
        return AdminDisplay::table()->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setColumns([
            AdminColumn::text('reference.reference')->setLabel('Producto'),
            AdminColumn::text('qty')->setLabel('Cant.'),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
            AdminColumn::text('message')->setLabel('Razón'),
        ])->paginate(5);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::select('reference_id', 'Referencia')->setModelForOptions('App\Model\Reference')->setDisplay('reference')->required(),
            AdminFormElement::text('qty', 'Cantidad')->required(),
            AdminFormElement::text('message', 'Razón')->required()
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});