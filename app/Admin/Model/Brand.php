<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Brand;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Brand::class, function (ModelConfiguration $model) {
    $model->setTitle("Marcas");
    $model->setAlias('brands');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
            AdminColumn::image('image')->setLabel('Logo'),
            AdminColumn::text('name')->setLabel('Marca'),
            AdminColumn::datetime('created_at')
                                    ->setLabel('Date')
                                    ->setFormat('d.m.Y')
                                    ->setWidth('150px'),
        ]);
        $display->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required(),
            AdminFormElement::image('image', 'Logo')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
