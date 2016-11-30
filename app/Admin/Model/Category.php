<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Category;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Category::class, function (ModelConfiguration $model) {
    $model->setTitle("Categorías");
    $model->setAlias('categories');
    $model->onDisplay(function () {
        return AdminDisplay::tree()->setValue('name');
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required()
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
