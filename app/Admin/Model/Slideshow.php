<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Slideshow;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Slideshow::class, function (ModelConfiguration $model) {
    $model->setTitle("Slideshow");
    $model->setAlias('slideshows');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#')->setWidth('50px'),
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
          AdminFormElement::text('id', 'Id')->required(),
          AdminFormElement::images('images_for_admin', 'Imagenes')->required(),
          AdminFormElement::hidden('urls', 'Enlaces')
        ])->setHtmlAttribute('class','links-manager');
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
