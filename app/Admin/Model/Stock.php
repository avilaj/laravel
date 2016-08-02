<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Stock;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Stock::class, function (ModelConfiguration $model) {
    $model->setTitle("Movimientos de inventario");
    $model->setAlias('stock');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables()
        ->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setColumns([
            AdminColumn::text('reference.product.title')->setLabel('Producto'),
            AdminColumn::text('reference.color.name')->setLabel('Color'),
            AdminColumn::text('size.label')->setLabel('Talle'),
            AdminColumn::text('qty')->setLabel('Cant.'),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
            AdminColumn::text('message')->setLabel('Razón'),
        ])->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::select('reference_id', 'Referencia')
              ->setModelForOptions('App\Model\Reference')
              ->setDisplay('color.name')
              ->required(),
              AdminFormElement::select('size_id', 'Talle')
                ->setModelForOptions('App\Model\Size')
                ->setDisplay('label')
                ->required(),
            AdminFormElement::text('qty', 'Cantidad')->required(),
            AdminFormElement::text('message', 'Razón')->required()
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
