<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Reference;
use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Reference::class, function (ModelConfiguration $model) {
    $model->setTitle("Referencias");
    $model->onDisplay(function () {
        return AdminDisplay::table()->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setColumns([
            AdminColumn::text('reference')->setLabel('Código de referencia'),
            AdminColumn::link('product_id')->setLabel('Producto')
        ])->paginate(5);
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('reference', 'Código de referencia')->required(),
            AdminFormElement::select('product_id', 'Producto')->setModelForOptions('App\Model\Product')->setDisplay('title')->required(),
            AdminFormElement::text('specs', 'Especificaciones')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});