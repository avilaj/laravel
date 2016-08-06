<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Color;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Color::class, function (ModelConfiguration $model) {
    $model->setTitle("Colores");
    $model->setAlias('colors');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('name', 'asc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('name')->setLabel('Color'),
        ]);
        $display->paginate(10);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required(),
            AdminFormElement::text('hex', 'Codigo HEX (#FFFFFF)')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
