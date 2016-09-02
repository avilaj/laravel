<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Podcast;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Podcast::class, function (ModelConfiguration $model) {
    $model->setTitle("Podcast");
    $model->setAlias('podcast');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('title')->setLabel('Título'),
            AdminColumn::image('image')->setLabel('Imagen'),
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
            AdminFormElement::text('title', 'Titulo')->required(),
            AdminFormElement::image('image', 'Imágen'),
            AdminFormElement::wysiwyg('content', 'Contenido'),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
