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
        $display = AdminDisplay::table();
        $display->setApply(function($query) {
            $query->orderBy('order', 'asc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::text('name')->setLabel('Categoría'),
            AdminColumn::order()->setLabel('Orden'),
        ]);
        $display->paginate(15);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required(),
            new App\SleepyElements\ReferenceManager('banner', 'Banner'),
            AdminFormElement::image('banner', 'Banner')->required(),
            AdminFormElement::textarea('description', 'Descripción')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
